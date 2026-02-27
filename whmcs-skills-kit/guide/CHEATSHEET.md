# WHMCS Development Cheatsheet

**Quick reference for WHMCS module development. Keep this handy!**

---

## File Structure Cheatsheet

### Addon Module
```
modules/addons/{modulename}/
├── {modulename}.php              (main file)
├── hooks.php                     (optional, for hooks)
└── lang/
    └── english.php
```

### Provisioning Module
```
modules/servers/{modulename}/
├── {modulename}.php              (main file)
└── lib/
    └── Client.php
```

### Registrar Module
```
modules/registrars/{modulename}/
├── {modulename}.php              (main file)
└── lib/
    └── Registrar.php
```

### Payment Gateway
```
modules/gateways/
└── {modulename}.php              (single file)
```

### Hook Module
```
includes/hooks/
└── {modulename}.php              (hook file)
```

---

## First Line of Every PHP File

```php
<?php
declare(strict_types=1);

defined("WHMCS") or die("Access Denied");
```

---

## Import Common Classes

```php
use Illuminate\Database\Capsule\Manager as Capsule;
use WHMCS\Module\Addon\{ModuleName}\Client;
use Illuminate\Support\Facades\DB;
use WHMCS\Module\Guzzle;
use GuzzleHttp\Client as GuzzleClient;
```

---

## Module Config Function

```php
function {modulename}_config() {
    return array(
        'name' => 'Human Readable Name',
        'description' => 'Brief description',
        'version' => '1.0.0',
        'author' => 'Your Name',
        'language' => 'english',
        'fields' => array(
            'apikey' => array(
                'FriendlyName' => 'API Key',
                'Type' => 'password',
                'Size' => '50',
                'Description' => 'Enter your API key',
            ),
        ),
    );
}
```

---

## Common Configuration Field Types

| Type | Usage |
|------|-------|
| `text` | Simple text input |
| `password` | Hidden password field |
| `textarea` | Multi-line text |
| `dropdown` | Select from options |
| `radio` | Radio button group |
| `checkbox` | Checkbox option |
| `yesno` | Yes/No toggle |

---

## Database Operations (Capsule)

### SELECT
```php
// Get all
$clients = Capsule::table('tblclients')->get();

// Get one
$client = Capsule::table('tblclients')->find($id);

// With where
$active = Capsule::table('tblclients')
    ->where('status', '=', 'Active')
    ->get();

// With limit
$recent = Capsule::table('tblclients')
    ->orderBy('datecreated', 'desc')
    ->limit(10)
    ->get();
```

### INSERT
```php
Capsule::table('mod_mymodule_logs')->insert([
    'client_id' => $clientId,
    'action' => 'login',
    'ip_address' => $_SERVER['REMOTE_ADDR'],
    'created_at' => date('Y-m-d H:i:s'),
]);

// Or with multiple rows
Capsule::table('table_name')->insert([
    ['col1' => 'val1', 'col2' => 'val2'],
    ['col1' => 'val3', 'col2' => 'val4'],
]);
```

### UPDATE
```php
Capsule::table('tblclients')
    ->where('id', $id)
    ->update([
        'firstname' => 'John',
        'lastname' => 'Doe',
    ]);
```

### DELETE
```php
Capsule::table('mod_mymodule_logs')
    ->where('id', '<', 100)
    ->delete();
```

### TRANSACTIONS
```php
try {
    Capsule::beginTransaction();
    
    Capsule::table('tblclients')->update(['status' => 'Active']);
    Capsule::table('mod_logs')->insert(['message' => 'Updated']);
    
    Capsule::commit();
} catch (\Exception $e) {
    Capsule::rollback();
    logActivity("Error: " . $e->getMessage());
}
```

---

## Schema Operations (in _activate)

```php
function mymodule_activate() {
    if (!Capsule::schema()->hasTable('mod_mymodule_data')) {
        Capsule::schema()->create('mod_mymodule_data', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('client_id')->index();
            $table->string('api_key')->nullable();
            $table->text('settings')->nullable();
            $table->timestamps();
            $table->foreign('client_id')
                ->references('id')
                ->on('tblclients')
                ->onDelete('cascade');
        });
    }
    return array('success' => true);
}
```

### Column Types
| Type | SQL |
|------|-----|
| `increments('id')` | AUTO_INCREMENT INT |
| `string('name')` | VARCHAR(255) |
| `string('email', 100)` | VARCHAR(100) |
| `integer('count')` | INT |
| `unsignedInteger()` | INT UNSIGNED |
| `decimal('price', 10, 2)` | DECIMAL(10,2) |
| `text('description')` | LONGTEXT |
| `json('data')` | JSON |
| `timestamp() / timestamps()` | created_at, updated_at |
| `boolean('active')` | TINYINT(1) |
| `date('birthdate')` | DATE |
| `datetime('created')` | DATETIME |

---

## API Calls

### Using localAPI (Internal)
```php
$result = localAPI('AddClient', [
    'firstname' => 'John',
    'lastname' => 'Doe',
    'email' => 'john@example.com',
    'address1' => '123 Main St',
    'city' => 'New York',
    'state' => 'NY',
    'postcode' => '10001',
    'country' => 'US',
    'phonenumber' => '2015551234',
    'password2' => 'securepass123',
]);

if ($result['result'] == 'success') {
    $clientId = $result['clientid'];
} else {
    echo "Error: " . $result['message'];
}
```

### Using Guzzle (External)
```php
$client = new GuzzleClient([
    'base_uri' => 'https://api.example.com/',
    'timeout' => 10,
]);

try {
    $response = $client->post('accounts', [
        'json' => [
            'client_id' => $clientId,
            'domain' => 'example.com',
        ],
        'headers' => [
            'Authorization' => 'Bearer ' . $apiKey,
        ],
    ]);
    
    $result = json_decode($response->getBody(), true);
    logModuleCall('mymodule', 'create_account', [], $result, serialize($result));
    
} catch (\Exception $e) {
    logActivity("API Error: " . $e->getMessage());
    logModuleCall('mymodule', 'create_account', [], 'Error', $e->getMessage());
}
```

---

## Templates (Smarty v4)

### Assignment
```php
// In PHP
return [
    'templatefile' => 'mytemplate',
    'vars' => [
        'clientName' => 'John Doe',
        'invoices' => $invoices,
    ],
];

// In .tpl file
<h1>Welcome {$clientName}</h1>
```

### Loops
```smarty
{foreach $invoices as $invoice}
    <tr>
        <td>{$invoice.invoicenum}</td>
        <td>${$invoice.total|string_format:"%.2f"}</td>
        <td>{$invoice.datecreated|date_format:"%Y-%m-%d"}</td>
    </tr>
{/foreach}
```

### Conditionals
```smarty
{if $status == 'Active'}
    <span class="label label-success">Active</span>
{elseif $status == 'Suspended'}
    <span class="label label-danger">Suspended</span>
{else}
    <span class="label label-default">Unknown</span>
{/if}
```

### Output & Escaping
```smarty
{$variable}                    {* Safe - auto-escaped *}
{$variable|escape}             {* Explicitly escaped *}
{$variable|escape:'html'}      {* HTML entities *}
{$variable|escape:'url'}       {* URL encoded *}
{$variable|strip_tags}         {* Remove HTML tags *}
```

### Formatting
```smarty
{$price|string_format:"%.2f"}  {* Format as float *}
{$date|date_format:"%Y-%m-%d"} {* Format date *}
{$url|urlencode}               {* URL encode *}
```

---

## Hook Functions

### Hook Pattern
```php
function mymodule_hookClientAdd($vars) {
    $clientId = $vars['userid'];
    
    try {
        // Your logic here
        logActivity("New client added: #$clientId");
        
    } catch (\Exception $e) {
        logActivity("Hook Error: " . $e->getMessage());
    }
}

// Register in hooks.php or _output
add_hook('ClientAdd', 1, 'mymodule_hookClientAdd');
```

### Common Hook Points
```
ClientAdd, ClientEdit, ClientChangePassword
InvoiceCreated, InvoicePaid, AddInvoicePayment
TicketOpen, TicketAdminReply, TicketUserReply, TicketClose
AfterModuleCreate, AfterModuleSuspend, AfterModuleTerminate
DailyCronJob, TicketSplitTicketReminder
ProductAdded, ProductEdited, OrderCreated
EmailPreSend, EmailPostSend
```

---

## Security & Encryption

### Input Validation
```php
// Sanitize POST/GET
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$id = (int) $_GET['id'];
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);

// Check if key exists
$apiKey = isset($_POST['apikey']) ? $_POST['apikey'] : '';
```

### Encrypt Data
```php
// Store
$encrypted = encrypt('secret-data');
Capsule::table('table')->insert(['data' => $encrypted]);

// Retrieve
$row = Capsule::table('table')->find($id);
$decrypted = decrypt($row->data);
```

### Password Data
```php
// NEVER store plain passwords
// Use encrypt() for storage
$password = encrypt($_POST['password']);

// Verify with localAPI or compare
if (md5($_POST['password']) == $record['password']) { // If MD5 hashed
    // Valid
}
```

---

## Logging

### Module Log (for API calls)
```php
logModuleCall(
    'modulename',              // Module name
    'action_name',             // Action
    $request_array,            // Input array (sanitize!)
    $response,                 // Response data
    $success_or_failure_data,  // Details
    ['api_key', 'password']    // Secrets to exclude (optional)
);
```

### Activity Log
```php
logActivity("Client #$clientId accepted quote #$quoteId");
logActivity("Error processing payment: " . $error);
```

---

## Common Pitfalls Checklist

| Problem | ❌ BAD | ✅ GOOD |
|---------|--------|--------|
| DB Query | `WHERE id = $id` | Use Capsule with binding |
| Paths | `/var/www/whmcs/` | `ROOTDIR . "/modules/"` |
| Passwords | Store plain text | Encrypt with `encrypt()` |
| Output HTML | `echo "<html>"` | Return array for templates |
| HTML in Template | `{php}echo $x{/php}` | `{$x}` (auto-escaped) |
| No access guard | Just code | `defined("WHMCS")` first |
| Mysql functions | `mysql_query()` | Capsule ORM |
| API secrets | Hardcoded | Config fields + `encrypt()` |
| No error handling | Direct calls | Try/catch + logging |
| SQL Injection | String concat | Parameter binding (Capsule) |

---

## Version Requirements

| Component | WHMCS 8.x | WHMCS 9.x |
|-----------|-----------|-----------|
| PHP | 8.1+ | 8.2+ |
| Smarty | v3.1 | v4.3 |
| GuzzleHTTP | v7.4 | v7.4.5 |
| Illuminate | v7.x | v9.0 |

---

## Function Signature Templates

### Addon Functions
```php
function mymodule_config()           // Config
function mymodule_activate()         // On install
function mymodule_deactivate()       // On uninstall
function mymodule_upgrade($vars)     // On upgrade
function mymodule_output($vars)      // Admin area
function mymodule_clientarea($vars)  // Client area
function mymodule_{hookname}($vars)  // Hooks
```

### Provisioning Functions
```php
function servername_MetaData()
function servername_CreateAccount($args)
function servername_SuspendAccount($args)
function servername_UnsuspendAccount($args)
function servername_TerminateAccount($args)
function servername_ChangePackage($args)
function servername_ClientArea($args)
```

### Registrar Functions
```php
function registrarname_getConfigArray()
function registrarname_RegisterDomain($params)
function registrarname_RenewDomain($params)
function registrarname_GetNameservers($params)
function registrarname_SaveNameservers($params)
function registrarname_GetDomainInformation($params)
function registrarname_Sync($domain)
```

### Payment Gateway Functions
```php
function gatewayname_config()
function gatewayname_link($params)              // Third-Party
function gatewayname_capture($params)           // Merchant
function gatewayname_refund($params)            // Refund
```

---

## Email from Module

```php
$command = 'SendEmail';
$value = array(
    'messagename' => 'Invoice Payment Confirmation',
    'id' => $invoiceId,
);
$results = localAPI($command, $value);
```

---

## Get Configuration Value

```php
$value = localAPI('GetConfigurationValue', ['setting' => 'CompanyName']);
echo $value['result'];
```

---

## Multi-Language Support

```php
// In lang/english.php
$_LANG['module_description'] = "My module does X";
$_LANG['module_feature'] = "Cool feature";

// In PHP
echo Lang::trans('module::module.description');

// In Smarty
{lang key="module::module.description"}
```

---

## Testing Module Locally

```bash
# Syntax check
php -l modules/addons/mymodule/mymodule.php

# Check functions exist
grep -E "function mymodule_" modules/addons/mymodule/mymodule.php
```

---

## Resources

- **WHMCS Developer Docs**: https://developers.whmcs.com/
- **Illuminate/Database Docs**: https://laravel.com/docs/9.x/database
- **Smarty Docs**: https://www.smarty.net/docs/
- **Guzzle Docs**: http://docs.guzzlephp.org/

---

Print this page or bookmark for quick reference! 🚀
