# WHMCS Module Troubleshooting Guide

**Diagnose and fix common module development issues.**

---

## Table of Contents

1. [Module Won't Activate](#module-wont-activate)
2. [Hooks Not Firing](#hooks-not-firing)
3. [Database Issues](#database-issues)
4. [API Integration Problems](#api-integration-problems)
5. [Template & Display Issues](#template--display-issues)
6. [Security Problems](#security-problems)
7. [Performance Issues](#performance-issues)
8. [Debugging Tools](#debugging-tools)

---

## Module Won't Activate

### Symptom: "Module contains invalid function names"

**Cause**: Missing required functions

**Solution**:
```php
// Check you have all required functions for your module type

// For Addon Modules:
function mymodule_config() {}        ✓ REQUIRED
function mymodule_activate() {}      ✓ REQUIRED
function mymodule_deactivate() {}    ✓ REQUIRED

// For Provisioning Modules:
function myhost_MetaData() {}        ✓ REQUIRED
function myhost_CreateAccount() {}   ✓ REQUIRED
function myhost_SuspendAccount() {}  ✓ REQUIRED

// Check function naming: {modulename}_FunctionName
```

**Test**:
```bash
grep -E "function (mymodule|myhost)_" mymodule.php
```

---

### Symptom: "Fatal error in module"

**Cause**: Syntax error in PHP code

**Solution**:
```bash
php -l modules/addons/mymodule/mymodule.php
# Should output: "No syntax errors detected"
```

**Common errors**:
```php
// ❌ Missing semicolon
function mymodule_config()
{
    return array()  // Missing semicolon here
}

// ❌ Missing closing brace
function mymodule_output($vars) {
    // code
    // Missing }

// ❌ Undefined variable
function mymodule_activate() {
    logActivity($undefined_var);  // $undefined_var not defined
}
```

---

### Symptom: DB connection error during activation

**Cause**: Capsule not properly initialized or syntax error in schema

**Solution**:
```php
// ✅ GOOD: Use Capsule properly
function mymodule_activate(): array {
    try {
        if (!Capsule::schema()->hasTable('mod_mymodule_data')) {
            Capsule::schema()->create('mod_mymodule_data', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();
            });
        }
        return ['status' => 'success'];
    } catch (\Exception $e) {
        return ['status' => 'error', 'description' => $e->getMessage()];
    }
}
```

---

### Symptom: Return value not array

**Cause**: Function returns wrong type

**Solution**:
Check that `_activate` and `_deactivate` return arrays:

```php
// ❌ BAD: Returns string
function mymodule_activate() {
    return "success";
}

// ✅ GOOD: Returns array
function mymodule_activate() {
    return [
        'status' => 'success',
        'description' => 'Module activated'
    ];
}
```

---

## Hooks Not Firing

### Symptom: Hook function never executes

**Cause**: Hook point name is wrong or not registered

**Solution**:
```php
// Verify hook name from modules/hooks.json
// For example: ClientAdd, not client_add

function mymodule_hookClientAdd($vars) {
    // This hook runs when a client is added
}

// Register the hook (this is handled by WHMCS automatically
// if you name it correctly)
```

**Common hook points**:
- `ClientAdd` (not `ClientAdded`)
- `ClientEdit` (not `ClientUpdate`)
- `InvoicePaid` (not `PaymentReceived`)
- `TicketOpen` (not `NewTicket`)
- `DailyCronJob` (for scheduled tasks)

---

### Symptom: Hook receives wrong/empty variables

**Cause**: Trying to access variables that don't exist

**Solution**:
```php
// Check what variables are actually passed
function mymodule_hookClientAdd($vars) {
    logActivity("Hook vars: " . print_r($vars, true));
    
    // Now check the log to see what's available
}
```

**Common variables by hook**:
```php
// ClientAdd hook
$vars['userid'];      // Client ID
$vars['firstname'];
$vars['lastname'];
$vars['email'];

// InvoicePaid hook
$vars['invoiceid'];   // Invoice ID
$vars['userid'];      // Client ID
$vars['amount'];      // Amount paid

// TicketOpen hook
$vars['ticketid'];    // Ticket ID
$vars['userid'];      // Client ID
$vars['subject'];
$vars['message'];
```

---

## Database Issues

### Symptom: "Table not found" error

**Cause**: Custom table doesn't exist or has wrong name

**Solution**:
```php
// Verify table name: mod_{modulename}_{entity}
// Examples: mod_mymodule_settings, mod_mymodule_logs

// Check if table exists
function mymodule_checkDatabase() {
    if (Capsule::schema()->hasTable('mod_mymodule_settings')) {
        logActivity("Table exists");
    } else {
        logActivity("Table NOT found");
    }
}
```

**Common causes**:
- Table name is wrong (e.g., `mymodule_settings` instead of `mod_mymodule_settings`)
- Module was never activated (activate function not run)
- Previous deactivation dropped the table

---

### Symptom: "Column not found" in query

**Cause**: Column doesn't exist in table

**Solution**:
```php
// Verify column exists before using it
if (Capsule::schema()->hasColumn('mod_mymodule_data', 'my_column')) {
    $data = Capsule::table('mod_mymodule_data')
        ->select('my_column')
        ->get();
} else {
    // Column doesn't exist - migrate or add it
    Capsule::schema()->table('mod_mymodule_data', function ($table) {
        if (!Capsule::schema()->hasColumn('mod_mymodule_data', 'my_column')) {
            $table->string('my_column')->nullable();
        }
    });
}
```

---

### Symptom: Queries running slowly

**Cause**: Missing indexes or inefficient queries

**Solution**:
```php
// Add indexes for frequently queried columns
function mymodule_upgrade($vars) {
    $version = $vars['version'];
    
    if ($version < '1.1') {
        Capsule::schema()->table('mod_mymodule_data', function ($table) {
            // Add indexes to improve query performance
            $table->index('client_id');
            $table->index('status');
            $table->index('created_at');
        });
    }
}

// Optimize queries: use select() to limit columns
$data = Capsule::table('mod_mymodule_data')
    ->select('id', 'name', 'status')  // Only needed columns
    ->where('status', 'active')
    ->orderBy('created_at', 'desc')
    ->limit(100)
    ->get();
```

---

## API Integration Problems

### Symptom: API calls always fail

**Cause**: Wrong credentials, incorrect endpoint, or network issue

**Solution**:
```php
// Test API connection
function mymodule_testAPIConnection($apiKey, $apiSecret) {
    try {
        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.example.com/',
            'timeout' => 10,
        ]);
        
        $response = $client->get('status', [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
        ]);
        
        logActivity("API test: Status " . $response->getStatusCode());
        return true;
        
    } catch (\Exception $e) {
        logActivity("API test failed: " . $e->getMessage());
        return false;
    }
}
```

---

### Symptom: API credentials not saved

**Cause**: Not using encrypt() for sensitive data

**Solution**:
```php
// ❌ BAD: Plain text
Capsule::table('mod_settings')->insert([
    'api_key' => $_POST['api_key'],
]);

// ✅ GOOD: Encrypted
Capsule::table('mod_settings')->insert([
    'api_key' => encrypt($_POST['api_key']),
]);

// Later: decrypt
$apiKey = decrypt($setting->api_key);
```

---

### Symptom: "Invalid webhook signature"

**Cause**: Not validating webhook signature properly

**Solution**:
```php
function mymodule_validateWebhookSignature($payload, $signature, $secret) {
    $calculatedSignature = hash_hmac(
        'sha256',
        $payload,
        $secret,
        false
    );
    
    // Use timing-safe comparison
    if (!hash_equals($calculatedSignature, $signature)) {
        logActivity("Invalid webhook signature");
        return false;
    }
    
    return true;
}
```

---

## Template & Display Issues

### Symptom: Admin output shows blank

**Cause**: Template file not found or variables not passed

**Solution**:
```php
// ✅ GOOD: Return template with variables
function mymodule_output($vars) {
    $data = ['items' => ['item1', 'item2']];
    
    return [
        'templatefile' => 'admin-dashboard',  // Must exist in templates/
        'vars' => $data,
    ];
}

// Check template file exists
// File should be: modules/addons/mymodule/templates/admin-dashboard.tpl
```

---

### Symptom: Client area widget doesn't show

**Cause**: Function not returning template or widget not enabled

**Solution**:
```php
function mymodule_clientarea($vars) {
    // Must return array with templatefile
    return [
        'templatefile' => 'client-widget',
        'vars' => [
            'data' => 'value',
        ],
    ];
}

// Verify the template file path is correct
// File should be: modules/addons/mymodule/templates/client-widget.tpl
```

---

### Symptom: Smarty template shows raw variables

**Cause**: Using wrong Smarty syntax or PHP tags

**Solution**:
```smarty
// ✅ GOOD Smarty v4 syntax
{$variable}
{if $condition}Content{/if}
{foreach $items as $item}{$item}{/foreach}

// ❌ BAD: Deprecated syntax
{php}echo $variable;{/php}
{$variable|escape}  // May need escaping
```

Verify Smarty version:
```php
// WHMCS 8.x: Smarty 3.1
// WHMCS 9.x: Smarty 4.3
```

---

## Security Problems

### Symptom: SQL Injection vulnerability warnings

**Cause**: Building SQL queries without parameter binding

**Solution**:
```php
// ❌ BAD: SQL Injection vulnerable
$clientId = $_GET['client_id'];
$query = "SELECT * FROM tblclients WHERE id = $clientId";

// ✅ GOOD: Use Capsule (safe)
$clientId = (int) $_GET['client_id'];
$client = Capsule::table('tblclients')
    ->where('id', '=', $clientId)
    ->first();
```

---

### Symptom: Stored XSS vulnerability (user data in output)

**Cause**: Not escaping user-supplied data in templates

**Solution**:
```smarty
// ❌ BAD: User data not escaped
<h1>{$user_input}</h1>

// ✅ GOOD: Always escape
<h1>{$user_input|escape}</h1>
<a href="{$url|escape:'html'}">Link</a>
<script>var data = {$json|json_encode};</script>
```

---

### Symptom: API key exposed in logs

**Cause**: Logging sensitive data

**Solution**:
```php
// ✅ GOOD: Exclude secrets from logs
logModuleCall(
    'mymodule',
    'action',
    ['api_key' => $apiKey, 'user_id' => 123],
    $response,
    'success',
    ['api_key']  // This key will be excluded from logs
);
```

---

## Performance Issues

### Symptom: Admin dashboard loads slowly

**Cause**: Inefficient database queries or large result sets

**Solution**:
```php
// ❌ BAD: Loads all records
function mymodule_output($vars) {
    $allLogs = Capsule::table('mod_logs')->get();
    
    // ...rest of code
}

// ✅ GOOD: Limit and paginate
function mymodule_output($vars) {
    $recentLogs = Capsule::table('mod_logs')
        ->orderBy('created_at', 'desc')
        ->limit(50)  // Only 50 records
        ->get();
    
    return ['templatefile' => 'dashboard', 'vars' => ['logs' => $recentLogs]];
}
```

---

### Symptom: Module timeout on cron jobs

**Cause**: Long-running operations without proper handling

**Solution**:
```php
function mymodule_hookDailyCron($vars) {
    try {
        $startTime = time();
        $maxExecutionTime = 30;  // 30 seconds max
        
        $records = Capsule::table('mod_data')
            ->where('processed', false)
            ->limit(100)  // Process in batches
            ->get();
        
        foreach ($records as $record) {
            if ((time() - $startTime) > $maxExecutionTime) {
                logActivity("Cron timeout - resuming next run");
                break;
            }
            
            // Process record
            Capsule::table('mod_data')
                ->where('id', $record->id)
                ->update(['processed' => true]);
        }
        
    } catch (\Exception $e) {
        logActivity("Cron error: " . $e->getMessage());
    }
}
```

---

## Debugging Tools

### 1. Enable Debug Mode

```php
// In your module
if (defined('WHMCS_DEBUG')) {
    logActivity("Debug: var = " . print_r($var, true));
}
```

### 2. Module Call Log

The module log provides API call history:

```
Admin Panel → Utilities → Logs → Module Call Log
```

View it programmatically:

```php
$calls = Capsule::table('tblmodulelog')
    ->where('module', 'mymodule')
    ->orderBy('datetime', 'desc')
    ->limit(10)
    ->get();

foreach ($calls as $call) {
    echo $call->function . ": " . $call->response;
}
```

---

### 3. Activity Log

```
Admin Panel → Utilities → Logs → Activity Log
```

Write to it:

```php
logActivity("My module event: " . $details);
```

---

### 4. Custom Logging Table

```php
// Create for detailed debugging
function mymodule_activate() {
    if (!Capsule::schema()->hasTable('mod_mymodule_debug')) {
        Capsule::schema()->create('mod_mymodule_debug', function ($table) {
            $table->increments('id');
            $table->string('context', 100);
            $table->longText('data');
            $table->timestamp('created_at');
        });
    }
}

// Use it
Capsule::table('mod_mymodule_debug')->insert([
    'context' => 'webhook_received',
    'data' => json_encode($_REQUEST),
    'created_at' => date('Y-m-d H:i:s'),
]);
```

---

### 5. PHP Error Logs

```bash
# Location varies by server, common paths:
tail -f /var/log/php-fpm/error.log
tail -f /var/log/apache2/error.log
tail -f /var/log/nginx/error.log

# With timestamps
tail -f /var/log/php-fpm/error.log | grep "mymodule"
```

---

### 6. Database Query Debugging

```php
// Log all queries your module makes
if (DB::logging()) {
    $queries = DB::getQueryLog();
    foreach ($queries as $query) {
        logActivity("Query: " . $query['query']);
    }
}
```

---

## Common Error Messages

### "Trying to access array offset on value of type null"

**Cause**: Array key doesn't exist

```php
// ❌ BAD
$email = $_POST['email'];  // Might not exist

// ✅ GOOD
$email = isset($_POST['email']) ? $_POST['email'] : '';
// Or
$email = $_POST['email'] ?? '';
```

---

### "Call to undefined function"

**Cause**: Function not available or WHMCS not loaded

```php
// ✅ GOOD: Always verify WHMCS is available
defined("WHMCS") or die("Access Denied");

// Use WHMCS functions
logActivity("test");  // This will work
```

---

### "Class not found"

**Cause**: Missing use statement or wrong namespace

```php
// ✅ GOOD: Use proper namespaces
use Illuminate\Database\Capsule\Manager as Capsule;

// Then use it
Capsule::table('tblclients')->get();
```

---

## Getting Help

1. **Check the logs first**: Activity Log and Module Call Log
2. **Enable debug mode**: See what's actually happening
3. **Read the error**: The error message usually points to the issue
4. **Test in isolation**: Create a test function to verify the issue
5. **Ask for help**: Include error messages and relevant code

---

For more help, check:
- **SKILLS.md**: Core rules and standards
- **CHEATSHEET.md**: Quick reference
- **EXAMPLES-AND-PROMPTS.md**: Real scenarios
- Official **WHMCS Developers Forum**: https://developers.whmcs.com/
