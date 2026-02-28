---
name: whmcs-dev-skills
description: >
  Senior WHMCS Developer & Architect skill for AI coding agents. Builds,
  debugs, and maintains all WHMCS module types: Addon, Provisioning (Server),
  Domain Registrar, Payment Gateway, Mail Provider, and Notification Provider.
  Enforces WHMCS 8.x / 9.x best practices, PHP 8.1–8.3 compatibility,
  Laravel Capsule ORM, Smarty v3/v4 templating, and PSR-1/PSR-2 coding style.
  Use this skill whenever a user needs to create, modify, debug, or audit
  any WHMCS module, hook, or integration.
license: GPL-2.0
compatibility: >
  Works with all AI coding agents including Claude Code, GitHub Copilot,
  Cursor, Windsurf, VS Code, Gemini, Amp, Goose, OpenCode, and others.
  Requires PHP 8.1–8.3 and WHMCS 8.x or 9.x environment for generated code.
metadata:
  author: Rabbi Rifat
  version: "4.0.0"
  category: web-hosting
  tags: [whmcs, php, modules, hooks, api, billing, hosting]
  min_whmcs: "8.11"
---

# WHMCS Dev Skills — AI Agent Skill

> **Scope** — Full-stack WHMCS module development: Addon Modules ·
> Provisioning (Server) Modules · Domain Registrar Modules · Payment Gateway
> Modules (Third-Party, Merchant, Tokenised) · Mail Provider Modules ·
> Notification Provider Modules · Action Hooks · Internal & External API
> Integration · Theme & Template Customisation.

---

## Table of Contents

1. [Operational Boundaries](#1-operational-boundaries)
2. [Platform Requirements](#2-platform-requirements)
3. [Coding Standards](#3-coding-standards)
4. [Database Operations](#4-database-operations)
5. [Module Development](#5-module-development)
   - 5.1 [Addon Modules](#51-addon-modules)
   - 5.2 [Provisioning (Server) Modules](#52-provisioning-server-modules)
   - 5.3 [Domain Registrar Modules](#53-domain-registrar-modules)
   - 5.4 [Payment Gateway Modules](#54-payment-gateway-modules)
   - 5.5 [Mail Provider Modules](#55-mail-provider-modules)
   - 5.6 [Notification Provider Modules](#56-notification-provider-modules)
6. [Action Hooks](#6-action-hooks)
7. [API Integration](#7-api-integration)
8. [Templating & UI](#8-templating--ui)
9. [Security Checklist](#9-security-checklist)
10. [Error Handling & Logging](#10-error-handling--logging)
11. [Module Upgrade Pattern](#11-module-upgrade-pattern)
12. [Common Pitfalls & Anti-Patterns](#12-common-pitfalls--anti-patterns)
13. [Project Structure Templates](#13-project-structure-templates)
14. [Quick-Reference Code Snippets](#14-quick-reference-code-snippets)
15. [Debugging & Troubleshooting](#15-debugging--troubleshooting)
16. [Official References](#16-official-references)

---

## 1. Operational Boundaries

### ✅ ALWAYS

- Add `defined("WHMCS") or die("Access Denied");` as the **first line** of every PHP file.
- Use `Illuminate\Database\Capsule\Manager` (Laravel Capsule) for **all** database operations.
- Use `logModuleCall()` for **every** external API request to enable the WHMCS Module Log.
- Use `logActivity()` to write meaningful entries to the System Activity Log.
- Use Smarty `.tpl` template files for **all** HTML output — never echo raw HTML in logic files.
- Follow PSR-1 and PSR-2 coding standards.
- Use `<?php` full opening tags; omit the closing `?>` tag in pure-PHP files.
- Wrap all external API calls and database schema changes in `try/catch` blocks.
- Use parameter binding (Capsule / PDO) — **never** concatenate user input into SQL.
- Validate and sanitise all `$_POST` and `$_GET` input.
- Prefix custom database tables with `mod_` (e.g., `mod_yourmodule_data`).
- Provide a `lang/english.php` language file for every module.
- Run unit/integration tests before committing module changes.
- Write code compatible with **PHP 8.1+** (prefer 8.2 / 8.3) with `declare(strict_types=1)` and type hints.
- Use CSRF tokens (`{csrf_field}`) in all forms.
- Scrub credentials from `logModuleCall()` using the `$replaceVars` parameter.
- Check `Capsule::schema()->hasTable()` before creating tables in `_activate`.

### ⚠️ ASK FIRST

- Before performing bulk refunds or mass invoice operations.
- Before performing `DROP TABLE` operations in deactivation functions.
- Before changing a client's password or authentication settings.
- Before modifying any server-level configuration.
- Before deleting or merging client accounts.
- Before running operations that touch more than 1000 records at a time.

### 🚫 NEVER

- Modify WHMCS core files (`/admin/`, `/includes/`, `/vendor/`). Use Hooks or Modules instead.
- Modify `configuration.php` directly.
- Use `mysql_*`, `mysqli_*`, or raw PDO — always use Capsule.
- Use deprecated `{php}` tags in Smarty templates.
- Use `$_REQUEST` — be explicit with `$_POST` or `$_GET`.
- Hardcode absolute file paths — use `ROOTDIR`, `$CONFIG['SystemURL']`, or WHMCS constants.
- Store sensitive data (passwords, API keys) in plain text — use WHMCS's `encrypt()` / `decrypt()` helpers.
- Use `echo` or `print` for output in module files (except Addon `_output`) — return structured arrays.
- Return strings from `_activate` / `_deactivate` — always return arrays.
- Use global variables — pass data via function arguments or `$vars`.

---

## 2. Platform Requirements

| Component          | WHMCS 8.x (8.11+)       | WHMCS 9.x               |
|:-------------------|:-------------------------|:-------------------------|
| **PHP**            | 8.1 – 8.3               | 8.2 – 8.3               |
| **Smarty**         | v3.1.x                   | v4.3.4                   |
| **GuzzleHTTP**     | v7.4                     | v7.4.5                   |
| **Illuminate**     | v7.x                     | v9.0                     |
| **MySQL/MariaDB**  | 5.7+ / 10.2+             | 8.0+ / 10.6+            |

### WHMCS 9.x Breaking Changes

- **Smarty v4**: The `{php}` tag is removed entirely. All templates must use Smarty syntax only.
- **Illuminate v9**: Some query-builder method signatures changed. Test all Capsule calls.
- **PHP 8.2+**: Dynamic properties trigger deprecation warnings. Use `#[\AllowDynamicProperties]` or declare properties explicitly.
- **Named arguments**: Available in PHP 8.0+ but avoid for backward-compatible modules.
- **Union types**: Available in PHP 8.0+; use for PHP 8.0+ targets only.
- **`match` expression**: Available in PHP 8.0+; use instead of `switch` where appropriate.

### PHP Version Notes

- **PHP 8.1+**: Minimum for modern WHMCS 8.11+. Use `declare(strict_types=1)`, enums, fibers, readonly properties.
- **PHP 8.2+**: Required for WHMCS 9.x. Dynamic properties deprecated — declare properties explicitly.
- **PHP 8.3**: Fully supported. Use typed class constants, `json_validate()`, `#[Override]` attribute.

---

## 3. Coding Standards

```
✓  Use <?php full tags only.
✓  Omit closing ?> in pure-PHP files.
✓  Indent with 4 spaces — no tabs.
✓  No trailing whitespace.
✓  Follow PSR-1 & PSR-2.
✓  Strict types: Always add declare(strict_types=1).
✓  Type hints: Use parameter and return types on all functions.
✓  Comments: Inline comments for complex logic; DocBlocks for all functions.
✓  UTF-8 encoding without BOM.
```

### Naming Conventions

| Element             | Convention                     | Example                  |
|:--------------------|:-------------------------------|:-------------------------|
| Module Directory    | lowercase, letters & numbers   | `mymodule`               |
| Module Functions    | `{modulename}_FunctionName`    | `mymodule_config()`      |
| Hook Functions      | Unique prefixed name           | `mymodule_hookClientAdd` |
| Database Tables     | `mod_{modulename}_{entity}`    | `mod_mymodule_settings`  |
| Config Fields       | camelCase keys                 | `apiKey`                 |
| Template Files      | lowercase with hyphens         | `admin-dashboard.tpl`    |
| Language Keys       | snake_case                     | `module_description`     |
| PHP Classes         | PascalCase with namespaces     | `PaymentProcessor`       |
| Constants           | UPPER_SNAKE_CASE               | `MAX_RETRY_COUNT`        |

---

## 4. Database Operations

### ✅ Modern Pattern — Laravel Capsule

```php
<?php
use Illuminate\Database\Capsule\Manager as Capsule;

// SELECT — single record
$client = Capsule::table('tblclients')->find($id);

// SELECT — with conditions
$clients = Capsule::table('tblclients')
    ->where('status', 'Active')
    ->orderBy('datecreated', 'desc')
    ->limit(10)
    ->get();

// INSERT
Capsule::table('mod_mymodule_logs')->insert([
    'client_id' => $clientId,
    'action'    => 'login',
    'created_at' => date('Y-m-d H:i:s'),
]);

// UPDATE
Capsule::table('tblclients')
    ->where('id', $id)
    ->update([
        'firstname' => 'John',
        'lastname'  => 'Doe',
    ]);

// DELETE
Capsule::table('mod_mymodule_logs')
    ->where('created_at', '<', date('Y-m-d', strtotime('-90 days')))
    ->delete();
```

### Schema Creation (in `_activate`)

```php
function mymodule_activate() {
    try {
        if (!Capsule::schema()->hasTable('mod_mymodule_data')) {
            Capsule::schema()->create('mod_mymodule_data', function ($table) {
                $table->increments('id');
                $table->unsignedInteger('client_id')->index();
                $table->string('key');
                $table->text('value')->nullable();
                $table->timestamps();

                $table->foreign('client_id')
                    ->references('id')
                    ->on('tblclients')
                    ->onDelete('cascade');
            });
        }
        return ['status' => 'success', 'description' => 'Module activated'];
    } catch (\Exception $e) {
        return ['status' => 'error', 'description' => $e->getMessage()];
    }
}
```

### Column Types Quick Reference

| Type                          | SQL Equivalent       |
|:------------------------------|:---------------------|
| `increments('id')`            | AUTO_INCREMENT INT   |
| `string('name')`              | VARCHAR(255)         |
| `string('email', 100)`        | VARCHAR(100)         |
| `integer('count')`            | INT                  |
| `unsignedInteger('client_id')`| INT UNSIGNED         |
| `decimal('price', 10, 2)`     | DECIMAL(10,2)        |
| `text('description')`         | LONGTEXT             |
| `json('data')`                | JSON                 |
| `boolean('active')`           | TINYINT(1)           |
| `timestamps()`                | created_at, updated_at |
| `softDeletes()`               | deleted_at           |

### Transactions

```php
try {
    Capsule::beginTransaction();

    Capsule::table('tblclients')->where('id', $id)->update(['status' => 'Active']);
    Capsule::table('mod_mymodule_logs')->insert(['message' => 'Activated', 'created_at' => now()]);

    Capsule::commit();
} catch (\Exception $e) {
    Capsule::rollback();
    logActivity("Transaction error: " . $e->getMessage());
}
```

### Avoiding N+1 Queries

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
    ->select('mod_payments.*', 'tblclients.firstname', 'tblclients.lastname')
    ->get();
```

### Batch Operations

```php
// ❌ BAD: Individual inserts in loop
foreach ($items as $item) {
    Capsule::table('mod_data')->insert(['name' => $item['name']]);
}

// ✅ GOOD: Batch insert
$data = array_map(fn($item) => [
    'name'       => $item['name'],
    'created_at' => date('Y-m-d H:i:s'),
], $items);
Capsule::table('mod_data')->insert($data);
```

### Pagination

```php
$page    = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 25;

$records = Capsule::table('mod_mymodule_logs')
    ->skip(($page - 1) * $perPage)
    ->take($perPage)
    ->orderBy('created_at', 'desc')
    ->get();

$total      = Capsule::table('mod_mymodule_logs')->count();
$totalPages = (int) ceil($total / $perPage);
```

---

## 5. Module Development

### 5.1 Addon Modules

**Location**: `modules/addons/{modulename}/`

#### Required Functions

```php
<?php
defined("WHMCS") or die("Access Denied");

use Illuminate\Database\Capsule\Manager as Capsule;

function mymodule_config() {
    return [
        'name'        => 'My Module',
        'description' => 'A professional WHMCS addon module',
        'version'     => '1.0.0',
        'author'      => 'Your Name',
        'language'    => 'english',
        'fields'      => [
            'apiKey' => [
                'FriendlyName' => 'API Key',
                'Type'         => 'password',
                'Size'         => '50',
                'Description'  => 'Enter your API key',
            ],
            'enableLogging' => [
                'FriendlyName' => 'Enable Logging',
                'Type'         => 'yesno',
                'Description'  => 'Tick to enable debug logging',
            ],
        ],
    ];
}

function mymodule_activate() {
    try {
        if (!Capsule::schema()->hasTable('mod_mymodule_data')) {
            Capsule::schema()->create('mod_mymodule_data', function ($table) {
                $table->increments('id');
                $table->unsignedInteger('client_id')->index();
                $table->string('key');
                $table->text('value')->nullable();
                $table->timestamps();
            });
        }
        return ['status' => 'success', 'description' => 'Module activated successfully'];
    } catch (\Exception $e) {
        return ['status' => 'error', 'description' => $e->getMessage()];
    }
}

function mymodule_deactivate() {
    // ⚠️ ASK FIRST before dropping tables
    return ['status' => 'success', 'description' => 'Module deactivated'];
}

function mymodule_upgrade($vars) {
    $version = $vars['version'];
    if (version_compare($version, '1.1', '<')) {
        if (!Capsule::schema()->hasColumn('mod_mymodule_data', 'status')) {
            Capsule::schema()->table('mod_mymodule_data', function ($table) {
                $table->string('status', 20)->default('active')->after('value');
            });
        }
    }
    return ['status' => 'success'];
}

function mymodule_output($vars) {
    $moduleLink = $vars['modulelink'];
    $LANG       = $vars['_lang'];

    $data = Capsule::table('mod_mymodule_data')
        ->orderBy('created_at', 'desc')
        ->limit(50)
        ->get();

    // Addon _output MUST echo HTML (exception to the "no echo" rule)
    echo '<h2>' . ($LANG['dashboard_title'] ?? 'Dashboard') . '</h2>';
    echo '<table class="datatable" width="100%">';
    echo '<tr><th>ID</th><th>Client</th><th>Key</th><th>Created</th></tr>';
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . (int) $row->id . '</td>';
        echo '<td>' . (int) $row->client_id . '</td>';
        echo '<td>' . htmlspecialchars($row->key) . '</td>';
        echo '<td>' . htmlspecialchars($row->created_at) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

function mymodule_clientarea($vars) {
    // Addon _clientarea MUST return array (not echo)
    return [
        'pagetitle'    => 'My Module',
        'breadcrumb'   => ['index.php?m=mymodule' => 'My Module'],
        'templatefile' => 'client-area',
        'vars'         => [
            'data' => Capsule::table('mod_mymodule_data')
                ->where('client_id', $vars['clientdetails']['userid'])
                ->get(),
        ],
    ];
}
```

#### Configuration Field Types

| Type       | Usage                  |
|:-----------|:-----------------------|
| `text`     | Simple text input      |
| `password` | Hidden password field  |
| `textarea` | Multi-line text        |
| `dropdown` | Select from options    |
| `radio`    | Radio button group     |
| `checkbox` | Checkbox option        |
| `yesno`    | Yes/No toggle          |

---

### 5.2 Provisioning (Server) Modules

**Location**: `modules/servers/{modulename}/`

#### Required Functions

```php
<?php
defined("WHMCS") or die("Access Denied");

use Illuminate\Database\Capsule\Manager as Capsule;

function myserver_MetaData() {
    return [
        'DisplayName'  => 'My Server Module',
        'APIVersion'   => '1.1',
        'RequiresServer' => true,
    ];
}

function myserver_ConfigOptions() {
    return [
        'Package Name' => [
            'Type'        => 'text',
            'Size'        => '25',
            'Default'     => 'basic',
            'Description' => 'Server package name',
        ],
    ];
}

function myserver_CreateAccount(array $params): string {
    try {
        $apiKey   = $params['serveraccesshash'];
        $domain   = $params['domain'];
        $username = $params['username'];
        $password = $params['password'];
        $package  = $params['configoption1'];

        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://' . $params['serverhostname'] . '/api/',
            'timeout'  => 30,
        ]);

        $response = $client->post('accounts', [
            'json' => [
                'domain'   => $domain,
                'username' => $username,
                'password' => $password,
                'package'  => $package,
            ],
            'headers' => ['Authorization' => 'Bearer ' . $apiKey],
        ]);

        $result = json_decode($response->getBody(), true);

        logModuleCall('myserver', 'CreateAccount', $params, $result, null, ['password', 'serveraccesshash']);

        return 'success';
    } catch (\Exception $e) {
        logModuleCall('myserver', 'CreateAccount', $params, $e->getMessage(), null, ['password', 'serveraccesshash']);
        return 'Error: ' . $e->getMessage();
    }
}

function myserver_SuspendAccount(array $params): string {
    try {
        // Suspend logic
        logModuleCall('myserver', 'SuspendAccount', $params, 'success', null, ['serveraccesshash']);
        return 'success';
    } catch (\Exception $e) {
        logModuleCall('myserver', 'SuspendAccount', $params, $e->getMessage(), null, ['serveraccesshash']);
        return 'Error: ' . $e->getMessage();
    }
}

function myserver_UnsuspendAccount(array $params): string {
    try {
        // Unsuspend logic
        return 'success';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
}

function myserver_TerminateAccount(array $params): string {
    try {
        // Terminate logic
        return 'success';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
}

function myserver_ChangePackage(array $params): string {
    try {
        // Change package logic
        return 'success';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
}

function myserver_ClientArea(array $params): string {
    return '<h2>Service Overview</h2><p>Domain: ' . htmlspecialchars($params['domain']) . '</p>';
}
```

---

### 5.3 Domain Registrar Modules

**Location**: `modules/registrars/{modulename}/`

#### Required Functions

```php
<?php
defined("WHMCS") or die("Access Denied");

function myregistrar_getConfigArray() {
    return [
        'FriendlyName' => ['Type' => 'System', 'Value' => 'My Registrar'],
        'ApiKey'       => ['FriendlyName' => 'API Key', 'Type' => 'password', 'Size' => '50'],
        'TestMode'     => ['FriendlyName' => 'Test Mode', 'Type' => 'yesno', 'Description' => 'Enable sandbox'],
    ];
}

function myregistrar_RegisterDomain($params) {
    try {
        $sld = $params['sld'];
        $tld = $params['tld'];
        $domain = $sld . '.' . $tld;
        $regPeriod = $params['regperiod'];

        // Call registrar API to register domain
        $apiKey = $params['ApiKey'];
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.registrar.com/', 'timeout' => 30]);

        $response = $client->post('domains/register', [
            'json' => [
                'domain' => $domain,
                'period' => $regPeriod,
                'ns1'    => $params['ns1'],
                'ns2'    => $params['ns2'],
            ],
            'headers' => ['Authorization' => 'Bearer ' . $apiKey],
        ]);

        $result = json_decode($response->getBody(), true);
        logModuleCall('myregistrar', 'RegisterDomain', $params, $result, null, ['ApiKey']);

        return ['success' => true];
    } catch (\Exception $e) {
        logModuleCall('myregistrar', 'RegisterDomain', $params, $e->getMessage(), null, ['ApiKey']);
        return ['error' => $e->getMessage()];
    }
}

function myregistrar_RenewDomain($params)        { /* Similar pattern */ }
function myregistrar_GetNameservers($params)      { /* Return ns1..ns5 */ }
function myregistrar_SaveNameservers($params)     { /* Update ns */ }
function myregistrar_GetDomainInformation($params){ /* Return domain info */ }
function myregistrar_Sync($params)               { /* Sync expiry/status */ }
```

---

### 5.4 Payment Gateway Modules

**Location**: `modules/gateways/{modulename}.php`

#### Third-Party Gateway (Redirect)

```php
<?php
defined("WHMCS") or die("Access Denied");

function mygw_MetaData() {
    return [
        'DisplayName' => 'My Gateway',
        'APIVersion'  => '1.1',
    ];
}

function mygw_config() {
    return [
        'FriendlyName' => ['Type' => 'System', 'Value' => 'My Payment Gateway'],
        'apiKey'        => ['FriendlyName' => 'API Key', 'Type' => 'password', 'Size' => '50'],
        'testMode'      => ['FriendlyName' => 'Test Mode', 'Type' => 'yesno'],
    ];
}

function mygw_link($params) {
    $invoiceId   = $params['invoiceid'];
    $amount      = $params['amount'];
    $currency    = $params['currency'];
    $callbackUrl = $params['systemurl'] . 'modules/gateways/callback/mygw.php';
    $returnUrl   = $params['returnurl'];

    $form  = '<form method="POST" action="https://pay.gateway.com/checkout">';
    $form .= '<input type="hidden" name="invoice_id" value="' . $invoiceId . '">';
    $form .= '<input type="hidden" name="amount" value="' . $amount . '">';
    $form .= '<input type="hidden" name="currency" value="' . $currency . '">';
    $form .= '<input type="hidden" name="callback" value="' . $callbackUrl . '">';
    $form .= '<input type="hidden" name="return" value="' . $returnUrl . '">';
    $form .= '<button type="submit" class="btn btn-primary">Pay Now</button>';
    $form .= '</form>';

    return $form;
}
```

#### Merchant Gateway (Direct Capture)

```php
function mygw_capture($params) {
    try {
        $apiKey    = $params['apiKey'];
        $amount    = $params['amount'];
        $invoiceId = $params['invoiceid'];

        $client = new \GuzzleHttp\Client(['timeout' => 30]);
        $response = $client->post('https://api.gateway.com/charge', [
            'json' => [
                'amount'   => $amount * 100, // cents
                'currency' => $params['currency'],
                'source'   => $params['cardnum'],
            ],
            'headers' => ['Authorization' => 'Bearer ' . $apiKey],
        ]);

        $result = json_decode($response->getBody(), true);
        logModuleCall('mygw', 'capture', $params, $result, null, ['apiKey', 'cardnum', 'cardcvv']);

        return [
            'status'  => 'success',
            'transid' => $result['transaction_id'],
            'rawdata' => $result,
        ];
    } catch (\Exception $e) {
        logModuleCall('mygw', 'capture', $params, $e->getMessage(), null, ['apiKey', 'cardnum', 'cardcvv']);
        return [
            'status'  => 'declined',
            'rawdata' => $e->getMessage(),
        ];
    }
}

function mygw_refund($params) {
    try {
        // Refund logic
        return [
            'status'  => 'success',
            'transid' => $refundTransId,
            'rawdata' => $result,
        ];
    } catch (\Exception $e) {
        return [
            'status'  => 'declined',
            'rawdata' => $e->getMessage(),
        ];
    }
}
```

#### Gateway Callback Handler

**Location**: `modules/gateways/callback/{modulename}.php`

```php
<?php
require_once __DIR__ . '/../../../init.php';
require_once __DIR__ . '/../../../includes/gatewayfunctions.php';
require_once __DIR__ . '/../../../includes/invoicefunctions.php';

$gatewayModuleName = 'mygw';
$gatewayParams = getGatewayVariables($gatewayModuleName);

if (!$gatewayParams['type']) {
    die("Module Not Activated");
}

$invoiceId     = (int) $_POST['invoice_id'];
$transactionId = $_POST['transaction_id'];
$amount        = (float) $_POST['amount'];
$signature     = $_POST['signature'];

// Validate webhook signature
$expectedSig = hash_hmac('sha256', $invoiceId . $amount, $gatewayParams['apiKey']);
if (!hash_equals($expectedSig, $signature)) {
    logModuleCall($gatewayModuleName, 'callback', $_POST, 'Invalid signature');
    die("Invalid Signature");
}

$invoiceId = checkCbInvoiceID($invoiceId, $gatewayModuleName);
checkCbTransID($transactionId);

addInvoicePayment($invoiceId, $transactionId, $amount, 0, $gatewayModuleName);
logTransaction($gatewayModuleName, $_POST, 'Success');
```

---

### 5.5 Mail Provider Modules

**Location**: `modules/mail/{modulename}/`

Mail provider modules implement `SenderModuleInterface` to integrate custom email delivery services.

#### Required Structure

```php
<?php
namespace WHMCS\Module\Mail;

use WHMCS\Authentication\CurrentUser;
use WHMCS\Exception\Mail\SendFailure;
use WHMCS\Exception\Module\InvalidConfiguration;
use WHMCS\Mail\Message;
use WHMCS\Module\Contracts\SenderModuleInterface;
use WHMCS\Module\MailSender\DescriptionTrait;

class MyMailProvider implements SenderModuleInterface
{
    use DescriptionTrait;

    public function settings(): array
    {
        return [
            'api_key' => [
                'FriendlyName' => 'API Key',
                'Type'         => 'password',
                'Description'  => 'Your mail provider API key',
            ],
            'from_name' => [
                'FriendlyName' => 'Default From Name',
                'Type'         => 'text',
                'Description'  => 'Default sender name',
            ],
        ];
    }

    public function getName(): string
    {
        return 'MyMailProvider';
    }

    public function getDisplayName(): string
    {
        return 'My Mail Provider';
    }

    public function testConnection(array $settings): void
    {
        $currentAdmin = (new CurrentUser)->admin();

        try {
            $client = new \GuzzleHttp\Client(['timeout' => 15]);
            $client->post('https://api.mailprovider.com/validate', [
                'headers' => ['Authorization' => 'Bearer ' . $settings['api_key']],
                'json'    => ['email' => $currentAdmin->email],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Unable to authenticate: ' . $e->getMessage());
        }
    }

    public function send(array $settings, Message $message): void
    {
        try {
            $postFields = [
                'from'      => $message->getFromEmail(),
                'from_name' => $message->getFromName(),
                'subject'   => $message->getSubject(),
                'html'      => $message->getBody(),
                'text'      => $message->getPlainText() ?: ' ',
            ];

            // Collect recipients
            foreach ($message->getRecipients('to') as $to) {
                $postFields['to'][] = ['email' => $to[0], 'name' => $to[1]];
            }
            foreach ($message->getRecipients('cc') as $cc) {
                $postFields['cc'][] = ['email' => $cc[0], 'name' => $cc[1]];
            }
            foreach ($message->getRecipients('bcc') as $bcc) {
                $postFields['bcc'][] = ['email' => $bcc[0], 'name' => $bcc[1]];
            }

            // Handle attachments
            foreach ($message->getAttachments() as $attachment) {
                $postFields['attachments'][] = [
                    'filename' => $attachment['filename'],
                    'data'     => $attachment['data'] ?? file_get_contents($attachment['filepath']),
                ];
            }

            $client = new \GuzzleHttp\Client(['timeout' => 30]);
            $response = $client->post('https://api.mailprovider.com/send', [
                'headers' => ['Authorization' => 'Bearer ' . $settings['api_key']],
                'json'    => $postFields,
            ]);

            logModuleCall('MyMailProvider', 'send', $postFields, (string) $response->getBody(), null, ['api_key']);
        } catch (\Exception $e) {
            logModuleCall('MyMailProvider', 'send', $postFields ?? [], $e->getMessage(), null, ['api_key']);
            throw new SendFailure('Mail send failed: ' . $e->getMessage());
        }
    }
}
```

#### Project Structure

```
modules/mail/mymailprovider/
├── MyMailProvider.php     # Main module class (SenderModuleInterface)
└── logo.png              # Provider logo (optional)
```

---

### 5.6 Notification Provider Modules

**Location**: `modules/notifications/{modulename}/`

Notification provider modules implement `NotificationModuleInterface` for custom alert channels (Slack, Discord, SMS, etc.).

#### Required Structure

```php
<?php
namespace WHMCS\Module\Notification\MyNotifier;

use WHMCS\Module\Contracts\NotificationModuleInterface;
use WHMCS\Notification\Contracts\NotificationInterface;

class MyNotifier implements NotificationModuleInterface
{
    public function settings(): array
    {
        return [
            'webhook_url' => [
                'FriendlyName' => 'Webhook URL',
                'Type'         => 'text',
                'Description'  => 'The webhook endpoint for notifications',
            ],
            'api_token' => [
                'FriendlyName' => 'API Token',
                'Type'         => 'password',
                'Description'  => 'Authentication token',
            ],
        ];
    }

    public function testConnection(array $settings): bool
    {
        try {
            $client = new \GuzzleHttp\Client(['timeout' => 10]);
            $response = $client->post($settings['webhook_url'], [
                'json'    => ['text' => 'WHMCS connection test'],
                'headers' => ['Authorization' => 'Bearer ' . $settings['api_token']],
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            throw new \Exception('Connection test failed: ' . $e->getMessage());
        }
    }

    public function notificationSettings(): array
    {
        return [
            'channel' => [
                'FriendlyName' => 'Channel',
                'Type'         => 'text',
                'Description'  => 'Notification channel or target',
            ],
        ];
    }

    public function getDynamicField(string $fieldName, array $settings): array
    {
        // Return dynamic dropdown options (e.g., list of channels from API)
        if ($fieldName === 'channel') {
            return [
                'values' => [
                    ['id' => 'general', 'name' => '#general', 'desc' => 'Main channel'],
                    ['id' => 'alerts',  'name' => '#alerts',  'desc' => 'Alert channel'],
                ],
            ];
        }
        return [];
    }

    public function sendNotification(
        NotificationInterface $notification,
        array $moduleSettings,
        array $notificationSettings
    ): void {
        try {
            $payload = [
                'channel' => $notificationSettings['channel'],
                'title'   => $notification->getTitle(),
                'message' => $notification->getMessage(),
                'url'     => $notification->getUrl(),
            ];

            // Add attributes (key-value metadata)
            foreach ($notification->getAttributes() as $attribute) {
                $payload['fields'][] = [
                    'title' => $attribute->getLabel(),
                    'value' => $attribute->getValue(),
                    'url'   => $attribute->getUrl(),
                ];
            }

            $client = new \GuzzleHttp\Client(['timeout' => 15]);
            $client->post($moduleSettings['webhook_url'], [
                'json'    => $payload,
                'headers' => ['Authorization' => 'Bearer ' . $moduleSettings['api_token']],
            ]);

            logModuleCall('MyNotifier', 'send', $payload, 'success', null, ['api_token']);
        } catch (\Exception $e) {
            logModuleCall('MyNotifier', 'send', $payload ?? [], $e->getMessage(), null, ['api_token']);
            throw new \Exception('Notification failed: ' . $e->getMessage());
        }
    }
}
```

#### Project Structure

```
modules/notifications/mynotifier/
├── MyNotifier.php        # Main module class (NotificationModuleInterface)
└── logo.png              # Provider logo (optional)
```

---

## 6. Action Hooks

### Hook Registration

**Location**: `/includes/hooks/` or within module `hooks.php`

```php
<?php
defined("WHMCS") or die("Access Denied");

// Method 1: Named function
function mymodule_hookClientAdd($vars) {
    $clientId = $vars['userid'];
    try {
        logActivity("New client registered: #$clientId");
    } catch (\Exception $e) {
        logActivity("Hook error (ClientAdd): " . $e->getMessage());
    }
}
add_hook('ClientAdd', 1, 'mymodule_hookClientAdd');

// Method 2: Closure (anonymous function)
add_hook('InvoicePaid', 1, function ($vars) {
    $invoiceId = $vars['invoiceid'];
    logActivity("Invoice #{$invoiceId} paid");
});
```

### Most-Used Hook Points

#### Client Hooks
- `ClientAdd` — new client created
- `ClientEdit` — client details updated
- `ClientChangePassword` — password changed
- `ClientLogin` — client logged in

#### Invoice Hooks
- `InvoiceCreated` — new invoice generated
- `InvoicePaid` — invoice marked paid
- `AddInvoicePayment` — payment applied to invoice
- `InvoiceCancelled` — invoice cancelled

#### Ticket Hooks
- `TicketOpen` — new ticket opened
- `TicketAdminReply` — admin replied
- `TicketUserReply` — client replied
- `TicketClose` — ticket closed

#### Module Hooks
- `AfterModuleCreate` — product provisioned
- `AfterModuleSuspend` — product suspended
- `AfterModuleTerminate` — product terminated

#### System Hooks
- `DailyCronJob` — runs once daily
- `EmailPreSend` — before email is sent
- `EmailPostSend` — after email is sent

---

## 7. API Integration

### Internal API — `localAPI()`

No authentication required when called from hooks or modules.

```php
// Get client details
$result = localAPI('GetClientsDetails', [
    'clientid' => $clientId,
    'stats'    => true,
]);

if ($result['result'] === 'success') {
    $email = $result['email'];
}

// Create an invoice
$result = localAPI('CreateInvoice', [
    'userid'    => $clientId,
    'itemdescription1' => 'Custom Service',
    'itemamount1'      => '49.99',
    'autoapplyCredit'  => true,
]);

// Open a support ticket
$result = localAPI('OpenTicket', [
    'clientid'   => $clientId,
    'deptid'     => 1,
    'subject'    => 'Welcome!',
    'message'    => 'Thanks for signing up.',
    'priority'   => 'Low',
]);
```

### External API — GuzzleHTTP

```php
use GuzzleHttp\Client as GuzzleClient;

function mymodule_callExternalAPI(string $endpoint, array $data, string $apiKey): array {
    $client = new GuzzleClient([
        'base_uri' => 'https://api.example.com/',
        'timeout'  => 30,
        'headers'  => [
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type'  => 'application/json',
        ],
    ]);

    try {
        $response = $client->post($endpoint, ['json' => $data]);
        $result   = json_decode($response->getBody(), true);

        logModuleCall('mymodule', $endpoint, $data, $result, null, ['apiKey']);

        return ['success' => true, 'data' => $result];
    } catch (\GuzzleHttp\Exception\RequestException $e) {
        $errorMsg = $e->hasResponse()
            ? $e->getResponse()->getBody()->getContents()
            : $e->getMessage();

        logModuleCall('mymodule', $endpoint, $data, $errorMsg, null, ['apiKey']);

        return ['success' => false, 'error' => $errorMsg];
    }
}
```

---

## 8. Templating & UI

### Smarty v4 Basics

**Template location**: `modules/addons/{modulename}/templates/`

```smarty
{* Variables *}
<h1>Welcome, {$clientName}</h1>

{* Conditionals *}
{if $status == 'Active'}
    <span class="label label-success">Active</span>
{elseif $status == 'Suspended'}
    <span class="label label-danger">Suspended</span>
{else}
    <span class="label label-default">Unknown</span>
{/if}

{* Loops *}
{foreach $invoices as $invoice}
    <tr>
        <td>{$invoice.invoicenum}</td>
        <td>${$invoice.total|string_format:"%.2f"}</td>
        <td>{$invoice.datecreated|date_format:"%Y-%m-%d"}</td>
    </tr>
{/foreach}

{* Output Escaping *}
{$userInput|escape}              {* HTML entities *}
{$url|escape:'url'}              {* URL encoded *}
{$variable|strip_tags}           {* Remove HTML *}

{* CSRF Protection (REQUIRED in forms) *}
<form method="POST">
    {csrf_field}
    <input type="text" name="data">
    <button type="submit">Submit</button>
</form>

{* FORBIDDEN — never use: *}
{* {php}echo $x;{/php} *}
```

### Assigning Template Variables from PHP

```php
// In _clientarea function:
return [
    'pagetitle'    => 'My Module',
    'templatefile' => 'client-dashboard',
    'vars'         => [
        'clientName' => $clientDetails['firstname'],
        'invoices'   => $invoices,
        'status'     => 'Active',
    ],
];
```

### Admin Area UI (using WHMCS native CSS)

```php
function mymodule_output($vars) {
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading"><h3 class="panel-title">Dashboard</h3></div>';
    echo '<div class="panel-body">';
    echo '<div class="row">';
    echo '<div class="col-sm-4"><div class="panel panel-info">';
    echo '<div class="panel-heading">Total Clients</div>';
    echo '<div class="panel-body text-center"><h1>' . $totalClients . '</h1></div>';
    echo '</div></div>';
    echo '</div></div></div>';
}
```

---

## 9. Security Checklist

1. ✅ **Access Guard**: `defined("WHMCS") or die("Access Denied");` at top of every file.
2. ✅ **CSRF Protection**: Use `{csrf_field}` in all forms; validate tokens server-side.
3. ✅ **Input Validation**: Cast and sanitise all `$_POST` / `$_GET` values.
   ```php
   $clientId = (int) ($_POST['client_id'] ?? 0);
   $email    = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
   $name     = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES);
   ```
4. ✅ **Parameter Binding**: Use Capsule ORM — never concatenate user data into SQL.
5. ✅ **Credential Storage**: Use `encrypt()` / `decrypt()` for API keys and passwords.
   ```php
   $encrypted = encrypt($apiKey);
   $decrypted = decrypt($row->api_key);
   ```
6. ✅ **Credential Scrubbing**: Always exclude secrets from `logModuleCall()`.
   ```php
   logModuleCall('module', 'action', $request, $response, null, ['api_key', 'password']);
   ```
7. ✅ **Output Escaping**: Use `{$var|escape}` in Smarty; `htmlspecialchars()` in PHP.
8. ✅ **Webhook Validation**: Use `hash_hmac()` + `hash_equals()` for signature verification.
   ```php
   $expected = hash_hmac('sha256', $payload, $secret);
   if (!hash_equals($expected, $signature)) { die('Invalid'); }
   ```
9. ✅ **Error Messages**: Never expose internal details (DB structure, file paths) to end users.
10. ✅ **File Paths**: Use `ROOTDIR` and WHMCS constants — never hardcode absolute paths.
11. ✅ **Session Security**: Don't store sensitive data in `$_SESSION` client-side.
12. ✅ **Least Privilege**: Grant only required DB permissions for module operations.
13. ✅ **Dependency Security**: Keep Guzzle and other dependencies up to date.

---

## 10. Error Handling & Logging

### Module Log — `logModuleCall()`

Used for debugging API calls. Visible in **Admin → Utilities → Logs → Module Log**.

```php
logModuleCall(
    'mymodule',                        // Module name
    'create_account',                  // Action
    ['domain' => $domain],             // Request data
    $response,                         // Response data
    json_encode($processedData),       // Processed response
    ['api_key', 'password']            // Secrets to scrub
);
```

### Activity Log — `logActivity()`

Used for business-level events. Visible in **Admin → Utilities → Logs → Activity Log**.

```php
logActivity("Client #{$clientId} order processed successfully");
logActivity("MyModule: Payment of $amount failed for invoice #{$invoiceId}");
```

### Structured Error Handling Pattern

```php
function mymodule_processOrder(int $orderId): array {
    try {
        if ($orderId <= 0) {
            throw new \InvalidArgumentException('Invalid order ID');
        }

        $order = Capsule::table('tblorders')->find($orderId);
        if (!$order) {
            throw new \RuntimeException("Order #{$orderId} not found");
        }

        // Process with external API
        $response = callExternalAPI($order);

        Capsule::table('tblorders')
            ->where('id', $orderId)
            ->update(['status' => 'Processed']);

        logActivity("Order #{$orderId} processed successfully");
        return ['success' => true, 'message' => 'Order processed'];

    } catch (\InvalidArgumentException $e) {
        logActivity("Invalid input for order #{$orderId}: " . $e->getMessage());
        return ['success' => false, 'message' => 'Invalid order data'];

    } catch (\RuntimeException $e) {
        logActivity("Runtime error for order #{$orderId}: " . $e->getMessage());
        return ['success' => false, 'message' => $e->getMessage()];

    } catch (\Exception $e) {
        logModuleCall('mymodule', 'processOrder', ['orderId' => $orderId], $e->getMessage());
        logActivity("Error processing order #{$orderId}: " . $e->getMessage());
        return ['success' => false, 'message' => 'An unexpected error occurred'];
    }
}
```

---

## 11. Module Upgrade Pattern

Use `_upgrade($vars)` to handle database schema changes between versions.

```php
function mymodule_upgrade($vars) {
    $version = $vars['version'];

    if (version_compare($version, '1.1', '<')) {
        // v1.0 → v1.1: Add status column
        if (!Capsule::schema()->hasColumn('mod_mymodule_data', 'status')) {
            Capsule::schema()->table('mod_mymodule_data', function ($table) {
                $table->string('status', 20)->default('active');
            });
        }
    }

    if (version_compare($version, '1.2', '<')) {
        // v1.1 → v1.2: Add index for performance
        Capsule::schema()->table('mod_mymodule_data', function ($table) {
            $table->index('client_id');
            $table->index('status');
        });
    }

    if (version_compare($version, '2.0', '<')) {
        // v1.x → v2.0: Major schema change
        if (!Capsule::schema()->hasTable('mod_mymodule_v2_data')) {
            Capsule::schema()->create('mod_mymodule_v2_data', function ($table) {
                $table->increments('id');
                $table->unsignedInteger('client_id')->index();
                $table->json('settings')->nullable();
                $table->timestamps();
            });
        }
    }

    return ['status' => 'success'];
}
```

---

## 12. Common Pitfalls & Anti-Patterns

### 🔴 Critical — Will Break Your Module

| # | Anti-Pattern | Correct Approach |
|:--|:------------|:-----------------|
| 1 | Using `mysql_*` or `mysqli_*` functions | Use `Capsule` ORM |
| 2 | Building SQL with string concatenation | Use Capsule parameter binding |
| 3 | Using `{php}` tags in Smarty templates | Use Smarty syntax: `{$var}`, `{if}`, `{foreach}` |
| 4 | Modifying WHMCS core files | Use Hooks and Modules |
| 5 | No `defined("WHMCS")` guard | Add as first line of every PHP file |
| 6 | Returning strings from `_activate` / `_deactivate` | Return `['status' => 'success']` array |

### 🟡 Common Mistakes

| # | Anti-Pattern | Correct Approach |
|:--|:------------|:-----------------|
| 7 | Hardcoded file paths (`/var/www/whmcs/`) | Use `ROOTDIR . '/modules/'` |
| 8 | Storing API keys in plain text | Use `encrypt()` / `decrypt()` |
| 9 | Echoing in `_clientarea` | Return array with `templatefile` and `vars` |
| 10 | No error handling on API calls | Wrap in `try/catch` + `logModuleCall()` |
| 11 | Using `$_REQUEST` | Use `$_POST` or `$_GET` explicitly |
| 12 | Using `global` variables | Pass via function `$vars` argument |
| 13 | No CSRF tokens in forms | Use `{csrf_field}` in all Smarty forms |

### 🟢 Performance / Best Practice

| # | Anti-Pattern | Correct Approach |
|:--|:------------|:-----------------|
| 14 | Loading all records without pagination | Use `->limit()` and `->skip()` |
| 15 | N+1 query problem in loops | Use `->join()` or batch queries |
| 16 | Individual inserts inside loops | Use batch `->insert([...])` |
| 17 | No indexes on queried columns | Add `->index()` in schema creation |
| 18 | Exposing internal errors to users | Return generic messages; log details |

---

## 13. Project Structure Templates

### Addon Module

```
modules/addons/mymodule/
├── mymodule.php              # Main entry point
├── hooks.php                 # Hook registrations (optional)
├── lib/
│   ├── PaymentProcessor.php  # Business logic classes
│   └── WebhookHandler.php
├── templates/
│   ├── admin-dashboard.tpl   # Admin area template
│   ├── admin-settings.tpl
│   └── client-widget.tpl     # Client area template
├── lang/
│   └── english.php           # Language strings
└── tests/
    └── PaymentProcessorTest.php
```

### Provisioning Module

```
modules/servers/myserver/
├── myserver.php              # Main entry point
├── lib/
│   └── ApiClient.php         # API wrapper class
├── templates/
│   └── client-area.tpl       # Client area template (optional)
└── lang/
    └── english.php
```

### Registrar Module

```
modules/registrars/myregistrar/
├── myregistrar.php           # Main entry point
├── lib/
│   └── RegistrarClient.php   # API wrapper class
└── lang/
    └── english.php
```

### Payment Gateway

```
modules/gateways/
├── mygw.php                  # Main gateway file
└── callback/
    └── mygw.php              # Webhook/callback handler
```

---

## 14. Quick-Reference Code Snippets

### Language File Template

```php
<?php
// lang/english.php
$_LANG['module_title']       = 'My Module';
$_LANG['module_description'] = 'Manages client data efficiently';
$_LANG['dashboard_title']    = 'Dashboard';
$_LANG['error_not_found']    = 'The requested item was not found';
$_LANG['success_saved']      = 'Settings saved successfully';
```

### Table Exists Check

```php
if (Capsule::schema()->hasTable('mod_mymodule_data')) {
    // Table exists, safe to query
}
```

### Column Exists Check

```php
if (Capsule::schema()->hasColumn('mod_mymodule_data', 'status')) {
    // Column exists
}
```

### Encrypt / Decrypt Credentials

```php
// Store encrypted
$encrypted = encrypt($apiKey);
Capsule::table('mod_settings')->insert(['key' => 'api_key', 'value' => $encrypted]);

// Retrieve and decrypt
$row  = Capsule::table('mod_settings')->where('key', 'api_key')->first();
$apiKey = decrypt($row->value);
```

### Email from Module

```php
$result = localAPI('SendEmail', [
    'messagename' => 'Invoice Payment Confirmation',
    'id'          => $invoiceId,
]);
```

### Get Configuration Value

```php
$companyName = localAPI('GetConfigurationValue', ['setting' => 'CompanyName']);
```

### Multi-Language Support in Templates

```php
// In PHP
echo Lang::trans('module::mymodule.dashboard_title');

// In Smarty
{lang key="module::mymodule.dashboard_title"}
```

### Cron Batch Processing with Timeout

```php
add_hook('DailyCronJob', 1, function ($vars) {
    $startTime = time();
    $maxTime   = 30; // seconds

    $records = Capsule::table('mod_data')
        ->where('processed', false)
        ->limit(100)
        ->get();

    foreach ($records as $record) {
        if ((time() - $startTime) > $maxTime) {
            logActivity("MyModule cron: timeout, resuming next run");
            break;
        }
        Capsule::table('mod_data')
            ->where('id', $record->id)
            ->update(['processed' => true]);
    }
});
```

### Webhook Signature Validation

```php
function mymodule_validateWebhookSignature(string $payload, string $signature, string $secret): bool {
    $calculated = hash_hmac('sha256', $payload, $secret, false);
    return hash_equals($calculated, $signature);
}
```

### Custom Debug Logging Table

```php
function mymodule_debugLog(string $context, $data): void {
    Capsule::table('mod_mymodule_debug')->insert([
        'context'    => $context,
        'data'       => json_encode($data),
        'created_at' => date('Y-m-d H:i:s'),
    ]);
}
```

### Testing Module Locally

```bash
# Syntax check
php -l modules/addons/mymodule/mymodule.php

# Verify required functions exist
grep -E "function mymodule_" modules/addons/mymodule/mymodule.php

# Run unit tests
php vendor/bin/phpunit tests/
```

---

## 15. Debugging & Troubleshooting

### Quick Diagnosis Checklist

| Symptom | Likely Cause | Fix |
|:--------|:------------|:----|
| Module won't activate | Return type wrong | Return `['status' => 'success']` array, **not** a string |
| "Access Denied" | Missing WHMCS guard | Add `defined("WHMCS") or die("Access Denied");` as first line |
| Fatal error in module | PHP syntax error | Run `php -l modules/addons/mymodule/mymodule.php` |
| Hook not firing | Wrong hook name | Verify exact name from Hook Reference (e.g., `ClientAdd` not `client_add`) |
| Table not found | Missing `_activate` logic | Check `Capsule::schema()->hasTable()` and run activate |
| Blank admin page | Echo/return mismatch | `_output` must `echo`; `_clientarea` must `return` array |
| Template not found | Wrong path or name | File must be at `templates/{name}.tpl` (no extension in code) |
| Slow queries | Missing indexes | Add `->index()` on frequently queried columns |
| Credentials not saved | Not encrypted | Use `encrypt()` / `decrypt()` for sensitive config values |
| XSS vulnerability | Unescaped output | Use `{$var|escape}` in Smarty, `htmlspecialchars()` in PHP |

### Debugging Tools

```php
// 1. Check Module Log (Admin → Utilities → Logs → Module Log)
logModuleCall('mymodule', 'debug', $requestData, $responseData, null, ['password']);

// 2. Activity Log (Admin → Utilities → Logs → Activity Log)
logActivity("MyModule Debug: variable = " . print_r($data, true));

// 3. Custom debug table (for detailed tracing)
Capsule::table('mod_mymodule_debug')->insert([
    'context'    => __FUNCTION__,
    'data'       => json_encode($debugData),
    'created_at' => date('Y-m-d H:i:s'),
]);

// 4. PHP error log (when WHMCS logging isn't available)
error_log("MyModule: " . print_r($data, true));
```

### Common PHP 8.x Errors in WHMCS

```php
// ❌ "Trying to access array offset on value of type null"
$email = $_POST['email'];  // Key might not exist

// ✅ Fix: Use null coalescing
$email = $_POST['email'] ?? '';

// ❌ "Undefined property" (PHP 8.2 dynamic properties deprecated)
$obj->newProp = 'value';

// ✅ Fix: Declare properties or use #[AllowDynamicProperties]
#[\AllowDynamicProperties]
class MyClass { /* ... */ }

// ❌ "Call to undefined function" 
localAPI('GetClients', []);  // WHMCS not loaded

// ✅ Fix: Ensure WHMCS guard is present
defined("WHMCS") or die("Access Denied");
```

### Testing Workflow

```bash
# 1. Syntax check before deploying
php -l modules/addons/mymodule/mymodule.php

# 2. Verify required functions exist
grep -E "function mymodule_" modules/addons/mymodule/mymodule.php

# 3. Check for common anti-patterns
grep -rn "mysql_query\|mysqli_query\|\$_REQUEST\|{php}" modules/addons/mymodule/

# 4. Run unit tests
php vendor/bin/phpunit tests/

# 5. Check WHMCS module log after testing
# Admin → Utilities → Logs → Module Log
```

---

## 16. Official References

- **WHMCS Developer Documentation**: [developers.whmcs.com](https://developers.whmcs.com/)
- **WHMCS API Index**: [developers.whmcs.com/api/](https://developers.whmcs.com/api/)
- **WHMCS Hook Reference**: [developers.whmcs.com/hooks/](https://developers.whmcs.com/hooks/)
- **WHMCS GitHub Sample Modules**: [github.com/WHMCS](https://github.com/WHMCS)
- **WHMCS Class Documentation**: [classdocs.whmcs.com](https://classdocs.whmcs.com/)
- **Laravel Capsule**: [laravel.com/docs/9.x/database](https://laravel.com/docs/9.x/database)
- **Smarty Template Engine**: [smarty.net/docs/](https://www.smarty.net/docs/)
- **GuzzleHTTP**: [docs.guzzlephp.org](http://docs.guzzlephp.org/)
- **WHMCS Community Forums**: [whmcs.community](https://whmcs.community/)
- **Agent Skills Specification**: [agentskills.io/specification](https://agentskills.io/specification)

