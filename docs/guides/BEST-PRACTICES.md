# WHMCS Development Best Practices Guide

**Learn the professional approach to building WHMCS modules.**

---

## Table of Contents

1. [Code Organization](#code-organization)
2. [Security Best Practices](#security-best-practices)
3. [Database Design](#database-design)
4. [Error Handling](#error-handling)
5. [Performance Optimization](#performance-optimization)
6. [Testing Strategy](#testing-strategy)
7. [Documentation](#documentation)
8. [Deployment](#deployment)
9. [Maintenance & Updates](#maintenance--updates)
10. [Common Anti-Patterns](#common-anti-patterns)

---

## Code Organization

### Single Responsibility Principle

Each function should do one thing well:

```php
// ❌ BAD: Function does too much
function mymodule_handleWebhook($vars) {
    // Validate input
    // Process payment
    // Update database
    // Send email
    // Log activity
    // Handle errors
}

// ✅ GOOD: Separated concerns
function mymodule_validateWebhook($payload) {
    // Just validation
}

function mymodule_processPayment($data) {
    // Just processing
}

function mymodule_updateOrderStatus($orderId, $status) {
    // Just database update
}
```

### Class-Based Organization

For complex modules, use classes:

```php
<?php
declare(strict_types=1);

namespace WHMCS\Module\Addon\MyModule;

use Illuminate\Database\Capsule\Manager as Capsule;

class PaymentProcessor {
    private $apiKey;
    private $apiSecret;
    
    public function __construct(string $apiKey, string $apiSecret) {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }
    
    public function processPayment(int $invoiceId, float $amount): array {
        // Process
    }
    
    public function refund(string $transactionId, float $amount): array {
        // Refund
    }
}

class LogManager {
    public function log(string $action, array $data): void {
        Capsule::table('mod_mymodule_logs')->insert([
            'action' => $action,
            'data' => json_encode($data),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
```

### File Structure Best Practice

```
modules/addons/mymodule/
├── mymodule.php                 (main entry point)
├── hooks.php                    (optional, for hooks)
├── lib/
│   ├── PaymentProcessor.php     (business logic)
│   ├── WebhookHandler.php
│   └── LogManager.php
├── templates/                   (Smarty templates)
│   ├── admin-dashboard.tpl
│   ├── client-widget.tpl
│   └── admin-settings.tpl
├── lang/
│   └── english.php              (language strings)
├── tests/                       (unit tests)
│   ├── PaymentProcessorTest.php
│   └── WebhookHandlerTest.php
└── .gitignore
```

---

## Security Best Practices

### 1. Input Validation

```php
// ❌ BAD: No validation
function mymodule_processData($vars) {
    $clientId = $_POST['client_id'];
    $amount = $_POST['amount'];
    Capsule::table('tblpayments')->insert(['client_id' => $clientId, 'amount' => $amount]);
}

// ✅ GOOD: Proper validation
function mymodule_processData($vars) {
    $clientId = (int) ($_POST['client_id'] ?? 0);
    $amount = (float) ($_POST['amount'] ?? 0);
    
    if (!$clientId || !$amount || $amount <= 0) {
        throw new \Exception('Invalid input data');
    }
    
    // Verify client exists
    $client = Capsule::table('tblclients')->find($clientId);
    if (!$client) {
        throw new \Exception('Client not found');
    }
    
    Capsule::table('mod_payments')->insert([
        'client_id' => $clientId,
        'amount' => $amount,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
}
```

### 2. Prevent SQL Injection

```php
// ❌ BAD: SQL Injection vulnerable
$sql = "SELECT * FROM tblclients WHERE email = '" . $_POST['email'] . "'";
$result = Capsule::select($sql);

// ✅ GOOD: Capsule prevents SQL injection
$clients = Capsule::table('tblclients')
    ->where('email', '=', $_POST['email'])
    ->get();
```

### 3. Secure API Keys

```php
// ❌ BAD: Saving in plain text
$config['api_key'] = 'sk_live_abc123';

// ✅ GOOD: Encrypt sensitive data
$config['api_key'] = encrypt($_POST['api_key']);

// Later: retrieve and decrypt
$apiKey = decrypt(Capsule::table('mod_settings')->where('key', 'api_key')->first()->value);
```

### 4. CSRF Protection

```php
// ❌ BAD: No CSRF protection
<form method="POST">
    <input type="text" name="data">
    <button>Submit</button>
</form>

// ✅ GOOD: CSRF tokens in WHMCS forms
<form method="POST">
    {csrf_field}
    <input type="text" name="data">
    <button>Submit</button>
</form>

// In PHP, validate:
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die('CSRF token invalid');
}
```

### 5. XSS Prevention

```smarty
// ❌ BAD: User data not escaped
<h1>{$userInput}</h1>

// ✅ GOOD: Escape output
<h1>{$userInput|escape}</h1>

// Or specific escaping
<a href="{$url|escape:'html'}">Link</a>
<script>var data = {$json|json_encode};</script>
```

### 6. Least Privilege

```php
// ❌ BAD: Root permissions
$wpdb->query("GRANT ALL ON *.* TO 'whmcs'@'localhost'");

// ✅ GOOD: Only needed permissions
$wpdb->query("GRANT SELECT, INSERT, UPDATE ON whmcs.mod_mymodule_* TO 'whmcs'@'localhost'");
```

---

## Database Design

### 1. Schema Naming Conventions

```php
// Main table: mod_{modulename}_{entity}
// Example: mod_stripe_payments

function mymodule_activate() {
    if (!Capsule::schema()->hasTable('mod_mymodule_payments')) {
        Capsule::schema()->create('mod_mymodule_payments', function ($table) {
            // Name columns clearly
            $table->increments('id');
            $table->unsignedInteger('client_id')->index();
            $table->string('transaction_id', 50)->unique();
            $table->decimal('amount', 10, 2);
            $table->string('status', 20)->default('pending');
            $table->text('webhook_data')->nullable();
            $table->timestamps();
            
            // Add foreign keys
            $table->foreign('client_id')
                ->references('id')
                ->on('tblclients')
                ->onDelete('cascade');
            
            // Create indexes for queries
            $table->index('client_id');
            $table->index('status');
            $table->index('created_at');
        });
    }
    
    return array('success' => true);
}
```

### 2. Avoid N+1 Queries

```php
// ❌ BAD: N+1 query problem
$payments = Capsule::table('mod_payments')->get();
foreach ($payments as $payment) {
    $client = Capsule::table('tblclients')->find($payment->client_id);
    echo $client->firstname;
}

// ✅ GOOD: Single query with join
$payments = Capsule::table('mod_payments')
    ->join('tblclients', 'mod_payments.client_id', '=', 'tblclients.id')
    ->select('mod_payments.*', 'tblclients.firstname')
    ->get();

foreach ($payments as $payment) {
    echo $payment->firstname;
}
```

### 3. Use Indexes Wisely

```php
// Always index:
// - Foreign keys
// - Columns used in WHERE clauses
// - Columns used in JOINs
// - Columns used in ORDER BY

Capsule::schema()->create('mod_logs', function ($table) {
    $table->increments('id');
    $table->unsignedInteger('client_id')->index();    // Foreign key
    $table->string('action', 50)->index();             // WHERE searches
    $table->timestamp('created_at')->index();          // ORDER BY
    
    // Avoid indexing large text fields
    $table->text('details');                           // NOT indexed
});
```

### 4. Soft Deletes (Optional)

```php
// For data that shouldn't be permanently deleted
function mymodule_activate() {
    Capsule::schema()->create('mod_items', function ($table) {
        $table->increments('id');
        $table->string('name');
        $table->softDeletes();  // Adds deleted_at column
    });
}

// Query only non-deleted
$items = Capsule::table('mod_items')
    ->whereNull('deleted_at')
    ->get();
```

---

## Error Handling

### 1. Try/Catch Pattern

```php
// ✅ GOOD: Proper error handling
function mymodule_processOrder($orderId) {
    try {
        // Validate
        if (!$orderId || $orderId <= 0) {
            throw new \InvalidArgumentException('Invalid order ID');
        }
        
        // Get order
        $order = Capsule::table('tblorders')->find($orderId);
        if (!$order) {
            throw new \RuntimeException('Order not found');
        }
        
        // Process with external API
        $response = $this->callExternalAPI($order);
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('API error: ' . $response->getBody());
        }
        
        // Update database
        Capsule::table('tblorders')->where('id', $orderId)->update([
            'status' => 'Processed',
        ]);
        
        logActivity("Order #$orderId processed successfully");
        
        return ['success' => true, 'message' => 'Order processed'];
        
    } catch (\InvalidArgumentException $e) {
        logActivity("Invalid argument for order #$orderId: " . $e->getMessage());
        return ['success' => false, 'message' => 'Invalid order data'];
        
    } catch (\RuntimeException $e) {
        logActivity("Runtime error for order #$orderId: " . $e->getMessage());
        return ['success' => false, 'message' => 'Order not found'];
        
    } catch (\Exception $e) {
        logActivity("Unexpected error processing order #$orderId: " . $e->getMessage());
        logModuleCall('mymodule', 'processOrder', ['orderId' => $orderId], 'Error', $e->getMessage());
        return ['success' => false, 'message' => 'An error occurred'];
    }
}
```

### 2. Informative Error Messages

```php
// ❌ BAD: Unhelpful error
throw new \Exception('Error');

// ✅ GOOD: Descriptive error
throw new \Exception('Failed to create account on DigitalOcean: ' . $response->getBody());
```

### 3. Logging Errors

```php
// Always log errors for debugging
logModuleCall(
    'mymodule',
    'create_account',
    [
        'domain' => $domain,
        'api_endpoint' => $endpoint,
    ],
    $response,
    json_encode($error),
    ['api_key', 'api_secret']  // Exclude from logs
);
```

---

## Performance Optimization

### 1. Query Optimization

```php
// ❌ BAD: Inefficient query
$data = Capsule::table('tblorders')
    ->where('status', 'Active')
    ->where('datecreated', '>', '2024-01-01')
    ->get();

// ✅ GOOD: Add indexes and optimize
// First, ensure indexes exist on status and datecreated
$data = Capsule::table('tblorders')
    ->select('id', 'invoiceid', 'total')  // Only needed columns
    ->where('status', 'Active')
    ->where('datecreated', '>', '2024-01-01')
    ->orderBy('datecreated', 'desc')
    ->limit(100)
    ->get();
```

### 2. Caching Results

```php
// Cache expensive queries
function mymodule_getClientStats($clientId) {
    $cacheKey = "mymodule_stats_{$clientId}";
    
    // Try to get from cache
    $stats = cache_retrieve($cacheKey);
    if ($stats !== false) {
        return json_decode($stats, true);
    }
    
    // Calculate expensive stats
    $stats = [
        'total_orders' => Capsule::table('tblorders')
            ->where('userid', $clientId)
            ->count(),
        'total_spent' => Capsule::table('tblorders')
            ->where('userid', $clientId)
            ->sum('total'),
    ];
    
    // Cache for 1 hour (3600 seconds)
    cache_store($cacheKey, json_encode($stats), 3600);
    
    return $stats;
}
```

### 3. Pagination for Large Results

```php
// ❌ BAD: Load all records
$records = Capsule::table('mod_logs')->get();

// ✅ GOOD: Paginate
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$perPage = 25;

$records = Capsule::table('mod_logs')
    ->skip(($page - 1) * $perPage)
    ->take($perPage)
    ->orderBy('created_at', 'desc')
    ->get();

$total = Capsule::table('mod_logs')->count();
$totalPages = ceil($total / $perPage);
```

### 4. Batch Operations

```php
// ❌ BAD: Individual inserts in loop
foreach ($items as $item) {
    Capsule::table('mod_data')->insert([
        'name' => $item['name'],
        'value' => $item['value'],
    ]);
}

// ✅ GOOD: Batch insert
$data = [];
foreach ($items as $item) {
    $data[] = [
        'name' => $item['name'],
        'value' => $item['value'],
        'created_at' => date('Y-m-d H:i:s'),
    ];
}
Capsule::table('mod_data')->insert($data);
```

---

## Testing Strategy

### 1. Unit Tests

```php
<?php
namespace WHMCS\Module\Addon\MyModule\Tests;

use PHPUnit\Framework\TestCase;
use WHMCS\Module\Addon\MyModule\PaymentProcessor;

class PaymentProcessorTest extends TestCase {
    private $processor;
    
    protected function setUp(): void {
        $this->processor = new PaymentProcessor(
            'test_api_key',
            'test_api_secret'
        );
    }
    
    public function testProcessPaymentWithValidData() {
        $result = $this->processor->processPayment(123, 99.99);
        
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('transaction_id', $result);
    }
    
    public function testProcessPaymentWithInvalidAmount() {
        $result = $this->processor->processPayment(123, -50);
        
        $this->assertFalse($result['success']);
        $this->assertStringContainsString('Invalid amount', $result['error']);
    }
}
```

### 2. Integration Tests

```php
// Test with actual database
public function testOrderProcessingWithDatabase() {
    // Create test order
    $orderId = Capsule::table('tblorders')->insertGetId([
        'userid' => 1,
        'status' => 'Pending',
        'total' => 99.99,
        'datecreated' => date('Y-m-d H:i:s'),
    ]);
    
    // Process order
    $result = mymodule_processOrder($orderId);
    
    // Verify result
    $this->assertTrue($result['success']);
    
    // Verify database changed
    $order = Capsule::table('tblorders')->find($orderId);
    $this->assertEquals('Completed', $order->status);
}
```

### 3. Run Tests Before Deployment

```bash
# Run all tests
php vendor/bin/phpunit

# Run specific test file
php vendor/bin/phpunit tests/PaymentProcessorTest.php

# Run with coverage
php vendor/bin/phpunit --coverage-html coverage/
```

---

## Documentation

### 1. Code Comments

```php
/**
 * Process a payment from a client
 *
 * @param int $invoiceId The ID of the invoice to pay
 * @param float $amount The amount being paid
 * @param string $paymentMethod The payment method (credit_card, paypal, etc)
 * @param array $cardData Optional card details for credit card payments
 *
 * @return array Array with 'success' boolean and 'message' string
 *
 * @throws \InvalidArgumentException If amount is negative
 * @throws \RuntimeException If API call fails
 */
public function processPayment(
    int $invoiceId,
    float $amount,
    string $paymentMethod,
    array $cardData = []
): array {
    // Implementation
}
```

### 2. README File

```markdown
# My WHMCS Module

## Overview
Brief description of what the module does.

## Features
- Feature 1
- Feature 2

## Installation
1. Download the module
2. Extract to modules/addons/mymodule/
3. Activate in WHMCS admin

## Configuration
- API Key: Your API key from provider
- API Secret: Your API secret

## Troubleshooting
Common issues and solutions.
```

### 3. API Documentation

Document any custom APIs your module provides:

```php
/**
 * GET /api/mymodule/stats
 * 
 * Get statistics for a client
 * 
 * Parameters:
 *   - client_id (required): The client ID
 *   - period (optional): 'day', 'week', 'month' (default: 'week')
 * 
 * Response:
 *   {
 *     "success": true,
 *     "data": {
 *       "orders": 10,
 *       "revenue": 999.99
 *     }
 *   }
 */
public function stats(Request $request) {
    // Implementation
}
```

---

## Deployment

### 1. Pre-Deployment Checklist

- ✅ All tests passing
- ✅ Code reviewed
- ✅ Security checklist complete
- ✅ Performance tested
- ✅ Documentation updated
- ✅ Backup created
- ✅ Deployment plan documented

### 2. Staging First

```
1. Test in staging environment
2. Verify all functionality
3. Check logs for errors
4. Performance test
5. Security scan
6. Then deploy to production
```

### 3. Version Control

```bash
# Tag releases
git tag -a v1.0.0 -m "Initial release"
git push origin v1.0.0

# Use semantic versioning: MAJOR.MINOR.PATCH
```

---

## Maintenance & Updates

### 1. Version Upgrade Function

```php
function mymodule_upgrade($vars) {
    $version = $vars['version'];
    
    if ($version < '1.1') {
        // Upgrade from 1.0 to 1.1
        if (!Capsule::schema()->hasColumn('mod_mymodule_data', 'new_field')) {
            Capsule::schema()->table('mod_mymodule_data', function ($table) {
                $table->string('new_field')->nullable();
            });
        }
    }
    
    if ($version < '2.0') {
        // Upgrade from 1.x to 2.0
        // Major changes
    }
    
    return array('success' => true);
}
```

### 2. Backup Strategy

```bash
# Before major updates
mysqldump -u user -p database mod_mymodule_% > backup.sql

# Restore if needed
mysql -u user -p database < backup.sql
```

### 3. Monitoring

Track module health:

```php
// Monitor failed operations
function mymodule_monitorHealth() {
    $failedCount = Capsule::table('mod_logs')
        ->where('status', 'failed')
        ->where('created_at', '>', date('Y-m-d H:i:s', strtotime('-24 hours')))
        ->count();
    
    if ($failedCount > 10) {
        logActivity("WARNING: MyModule has $failedCount failures in last 24h");
    }
}
```

---

## Common Anti-Patterns

### 1. Global Variables

```php
// ❌ BAD: Using globals
global $whmcs;
$clientId = $whmcs->get_req_var('clientid');

// ✅ GOOD: Pass via function arguments
function mymodule_process($vars) {
    $clientId = $vars['clientid'];
}
```

### 2. Direct File Access

```php
// ❌ BAD: Direct file paths
include '/var/www/whmcs/storage/logs.php';

// ✅ GOOD: Use WHMCS constants
include ROOTDIR . '/includes/functions.php';
```

### 3. Mixing Logic and Presentation

```php
// ❌ BAD: Logic in template
function mymodule_output($vars) {
    echo "<h1>" . $vars['title'] . "</h1>";
    $data = Capsule::table('..')->get();
    foreach ($data as $item) {
        echo "<p>" . $item->name . "</p>";
    }
}

// ✅ GOOD: Separate logic and presentation
function mymodule_output($vars) {
    $data = Capsule::table('..')->get();
    return [
        'templatefile' => 'mytemplate',
        'vars' => [
            'items' => $data,
            'title' => $vars['title'],
        ],
    ];
}
```

### 4. Ignoring Deprecation Warnings

```php
// ❌ BAD: Using deprecated functions
getConfig('setting'); // Deprecated

// ✅ GOOD: Use current functions
localAPI('GetConfigurationValue', ['setting' => 'value']);
```

---

## Summary

| Practice | Benefit |
|----------|---------|
| Code organization | Maintainability |
| Security best practices | Safety |
| Good database design | Performance |
| Error handling | Reliability |
| Performance optimization | User experience |
| Testing | Quality assurance |
| Documentation | Usability |
| Deployment procedures | Safety |
| Maintenance | Longevity |

Build for quality, not just functionality! 🚀
