# WHMCS Module Development Templates

**Copy and customize these templates to start building modules quickly!**

---

## Quick Navigation

1. [Addon Module Template](#addon-module-template)
2. [Provisioning Module Template](#provisioning-module-template)
3. [Registrar Module Template](#registrar-module-template)
4. [Payment Gateway Template](#payment-gateway-template)
5. [Hook Template](#hook-template)

---

## Addon Module Template

### Main Module File: `modules/addons/mymodule/mymodule.php`

```php
<?php
/**
 * WHMCS Addon Module
 * 
 * @package    WHMCS
 * @author     Your Name
 * @version    1.0.0
 * @copyright  2024
 * @license    GPL-2.0
 */

declare(strict_types=1);

defined("WHMCS") or die("Access Denied");

use Illuminate\Database\Capsule\Manager as Capsule;
use WHMCS\Module\Addon\MyModule;

/**
 * Module configuration
 */
function mymodule_config(): array {
    return [
        'name' => 'My Awesome Module',
        'description' => 'This module does awesome things in WHMCS',
        'version' => '1.0.0',
        'author' => 'Your Name',
        'language' => 'english',
        'fields' => [
            'enable_admin_widget' => [
                'FriendlyName' => 'Enable Admin Dashboard Widget',
                'Type' => 'yesno',
                'Default' => 'on',
            ],
            'api_key' => [
                'FriendlyName' => 'API Key',
                'Type' => 'password',
                'Size' => '50',
                'Description' => 'Enter your API key',
            ],
            'api_secret' => [
                'FriendlyName' => 'API Secret',
                'Type' => 'password',
                'Size' => '50',
                'Description' => 'Enter your API secret',
            ],
        ],
    ];
}

/**
 * Module activation
 */
function mymodule_activate(): array {
    try {
        // Create custom tables
        if (!Capsule::schema()->hasTable('mod_mymodule_settings')) {
            Capsule::schema()->create('mod_mymodule_settings', function ($table) {
                $table->increments('id');
                $table->unsignedInteger('client_id')->nullable()->index();
                $table->string('key', 100)->index();
                $table->text('value')->nullable();
                $table->timestamps();
                $table->unique(['client_id', 'key']);
            });
        }
        
        if (!Capsule::schema()->hasTable('mod_mymodule_logs')) {
            Capsule::schema()->create('mod_mymodule_logs', function ($table) {
                $table->increments('id');
                $table->string('action', 100)->index();
                $table->text('request')->nullable();
                $table->text('response')->nullable();
                $table->boolean('success')->default(false)->index();
                $table->timestamp('created_at')->index();
            });
        }
        
        logActivity("MyModule activated successfully");
        
        return [
            'status' => 'success',
            'description' => 'Module activated successfully',
        ];
        
    } catch (\Exception $e) {
        logActivity("MyModule activation failed: " . $e->getMessage());
        
        return [
            'status' => 'error',
            'description' => 'Failed to activate module: ' . $e->getMessage(),
        ];
    }
}

/**
 * Module deactivation
 */
function mymodule_deactivate(): array {
    try {
        // Option 1: Keep tables for data retention (recommended)
        // Tables are preserved, module can be reactivated without data loss
        
        // Option 2: Drop tables on deactivation (uncomment if preferred)
        // WARNING: This permanently deletes all module data
        // if (Capsule::schema()->hasTable('mod_mymodule_settings')) {
        //     Capsule::schema()->drop('mod_mymodule_settings');
        // }
        // if (Capsule::schema()->hasTable('mod_mymodule_logs')) {
        //     Capsule::schema()->drop('mod_mymodule_logs');
        // }
        
        logActivity("MyModule deactivated");
        
        return [
            'status' => 'success',
            'description' => 'Module deactivated successfully',
        ];
        
    } catch (\Exception $e) {
        logActivity("MyModule deactivation failed: " . $e->getMessage());
        
        return [
            'status' => 'error',
            'description' => 'Failed to deactivate module: ' . $e->getMessage(),
        ];
    }
}

/**
 * Module upgrade
 */
function mymodule_upgrade($vars): array {
    $version = $vars['version'];
    
    try {
        if ($version < '1.1') {
            // Upgrade to 1.1
            if (!Capsule::schema()->hasColumn('mod_mymodule_settings', 'metadata')) {
                Capsule::schema()->table('mod_mymodule_settings', function ($table) {
                    $table->json('metadata')->nullable();
                });
            }
        }
        
        logActivity("MyModule upgraded to version " . $vars['version']);
        
        return [
            'status' => 'success',
            'description' => 'Upgrade completed successfully',
        ];
        
    } catch (\Exception $e) {
        logActivity("MyModule upgrade failed: " . $e->getMessage());
        
        return [
            'status' => 'error',
            'description' => 'Upgrade failed: ' . $e->getMessage(),
        ];
    }
}

/**
 * Admin area output
 */
function mymodule_output($vars): array {
    try {
        // Get module settings
        $settings = Capsule::table('mod_mymodule_settings')
            ->get()
            ->pluck('value', 'key');
        
        // Get recent logs
        $logs = Capsule::table('mod_mymodule_logs')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return [
            'templatefile' => 'admin-dashboard',
            'vars' => [
                'settings' => $settings,
                'logs' => $logs,
                'version' => $vars['version'],
            ],
        ];
        
    } catch (\Exception $e) {
        logActivity("MyModule admin output error: " . $e->getMessage());
        
        return [
            'templatefile' => 'error',
            'vars' => [
                'error' => 'Failed to load module dashboard',
            ],
        ];
    }
}

/**
 * Client area output (optional)
 */
function mymodule_clientarea($vars): array {
    try {
        $clientId = Auth::user()->id;
        
        // Get client-specific data
        $clientData = Capsule::table('mod_mymodule_settings')
            ->where('client_id', $clientId)
            ->get()
            ->pluck('value', 'key');
        
        return [
            'templatefile' => 'client-widget',
            'vars' => [
                'clientData' => $clientData,
            ],
        ];
        
    } catch (\Exception $e) {
        return [
            'templatefile' => 'error',
            'vars' => [
                'error' => 'Failed to load client data',
            ],
        ];
    }
}

/**
 * Hook example
 */
function mymodule_hookClientAdd($vars) {
    try {
        $clientId = $vars['userid'];
        
        // Record that new client was added
        Capsule::table('mod_mymodule_logs')->insert([
            'action' => 'client_add',
            'request' => json_encode($vars),
            'response' => 'ok',
            'success' => true,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        
        logActivity("MyModule: New client added (ID: $clientId)");
        
    } catch (\Exception $e) {
        logActivity("MyModule hook error: " . $e->getMessage());
    }
}

// Register hooks
if (!function_exists('add_hook')) {
    die('WHMCS functions not available');
}
add_hook('ClientAdd', 1, 'mymodule_hookClientAdd');
```

### Language File: `modules/addons/mymodule/lang/english.php`

```php
<?php
/**
 * English language file
 */

$_LANG['mymodule'] = 'My Module';
$_LANG['mymodule_description'] = 'This module does awesome things';
$_LANG['enable_admin_widget'] = 'Enable Admin Dashboard Widget';
$_LANG['api_key'] = 'API Key';
$_LANG['api_secret'] = 'API Secret';
$_LANG['welcome'] = 'Welcome to My Module';
$_LANG['error'] = 'An error occurred';
$_LANG['success'] = 'Operation completed successfully';
```

### Admin Template: `modules/addons/mymodule/templates/admin-dashboard.tpl`

```smarty
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>My Module Dashboard</h2>
            <p>Welcome to the My Module admin panel.</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Settings</h3>
                </div>
                <div class="panel-body">
                    {foreach $settings as $key => $value}
                        <p>
                            <strong>{$key|escape}:</strong>
                            {$value|escape}
                        </p>
                    {/foreach}
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Recent Activity</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $logs as $log}
                                <tr>
                                    <td>{$log->action|escape}</td>
                                    <td>
                                        {if $log->success}
                                            <span class="label label-success">Success</span>
                                        {else}
                                            <span class="label label-danger">Failed</span>
                                        {/if}
                                    </td>
                                    <td>{$log->created_at|escape}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
```

---

## Provisioning Module Template

### File: `modules/servers/myhost/myhost.php`

```php
<?php
declare(strict_types=1);

defined("WHMCS") or die("Access Denied");

use Illuminate\Database\Capsule\Manager as Capsule;

function myhost_MetaData(): array {
    return [
        'DisplayName' => 'My Host Provisioning',
        'APIVersion' => '1.0',
        'RequiresServer' => true,
    ];
}

/**
 * Create hosting account
 */
function myhost_CreateAccount(array $params): array {
    try {
        $serverId = $params['serverid'];
        $accountId = $params['username'];
        $password = $params['password'];
        $domain = $params['domain'];
        
        // Connect to server
        $api = new MyHostAPI($params['serverip'], $params['serverusername'], $params['serverpassword']);
        
        // Create account via API
        $result = $api->createAccount([
            'username' => $accountId,
            'password' => $password,
            'domain' => $domain,
            'package' => $params['configoption1'],
        ]);
        
        if (!$result) {
            return [
                'success' => false,
                'error' => 'Failed to create account',
            ];
        }
        
        logModuleCall('myhost', 'CreateAccount', $params, $result, 'Success', ['serverpassword', 'password']);
        
        return [
            'success' => true,
        ];
        
    } catch (\Exception $e) {
        logActivity("MyHost: Account creation failed - " . $e->getMessage());
        logModuleCall('myhost', 'CreateAccount', $params, 'Error', $e->getMessage());
        
        return [
            'success' => false,
            'error' => $e->getMessage(),
        ];
    }
}

function myhost_SuspendAccount(array $params): array {
    // Similar pattern
}

function myhost_UnsuspendAccount(array $params): array {
    // Similar pattern
}

function myhost_TerminateAccount(array $params): array {
    // Similar pattern
}

function myhost_ClientArea(array $params): array {
    // Return client-facing interface
}
```

---

## Registrar Module Template

### File: `modules/registrars/myregistrar/myregistrar.php`

```php
<?php
declare(strict_types=1);

defined("WHMCS") or die("Access Denied");

function myregistrar_getConfigArray(): array {
    return [
        'Description' => [
            'Type' => 'System',
            'Value' => 'Manage domain registrations',
        ],
        'API Key' => [
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your API key',
        ],
        'API Secret' => [
            'Type' => 'password',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your API secret',
        ],
    ];
}

function myregistrar_RegisterDomain(array $params): array {
    // Domain registration implementation
}

function myregistrar_RenewDomain(array $params): array {
    // Domain renewal implementation
}

function myregistrar_GetNameservers(array $params): array {
    // Get nameservers
}

function myregistrar_SaveNameservers(array $params): array {
    // Update nameservers
}

function myregistrar_Sync(string $domain): array {
    // Sync domain status
}
```

---

## Payment Gateway Template

### File: `modules/gateways/mypaymentgateway.php`

```php
<?php
declare(strict_types=1);

defined("WHMCS") or die("Access Denied");

function mypaymentgateway_MetaData(): array {
    return [
        'DisplayName' => 'My Payment Gateway',
        'APIVersion' => '1.2',
        'TokenisedStorage' => true,
    ];
}

function mypaymentgateway_config(): array {
    return [
        'FriendlyName' => [
            'Type' => 'System',
            'Value' => 'My Payment Gateway',
        ],
        'apiKey' => [
            'FriendlyName' => 'API Key',
            'Type' => 'password',
            'Size' => '50',
            'Description' => 'Enter API key',
        ],
        'testMode' => [
            'FriendlyName' => 'Test Mode',
            'Type' => 'yesno',
            'Description' => 'Enable test mode',
        ],
    ];
}

function mypaymentgateway_link(array $params): string {
    // Third-party gateway redirect
    $invoiceId = $params['invoiceid'];
    $amount = $params['amount'];
    $currency = $params['currency'];
    
    return '<form method="post" action="https://gateway.example.com/pay">'
        . '<input type="hidden" name="invoice_id" value="' . htmlspecialchars($invoiceId) . '">'
        . '<input type="hidden" name="amount" value="' . htmlspecialchars($amount) . '">'
        . '<button type="submit">Pay Now</button>'
        . '</form>';
}

function mypaymentgateway_capture(array $params): array {
    // Merchant gateway capture
    return [
        'status' => 'success',
        'transid' => 'TXN123',
        'rawresponse' => 'Payment captured',
    ];
}
```

---

## Hook Template

### File: `includes/hooks/mymoduleplugin.php`

```php
<?php
declare(strict_types=1);

defined("WHMCS") or die("Access Denied");

use Illuminate\Database\Capsule\Manager as Capsule;

add_hook('ClientAdd', 1, 'mymodule_hookClientAdded');
add_hook('InvoicePaid', 1, 'mymodule_hookInvoicePaid');
add_hook('DailyCronJob', 1, 'mymodule_hookDailyCron');

/**
 * Hook: Client Added
 */
function mymodule_hookClientAdded($vars) {
    try {
        $clientId = $vars['userid'];
        
        // Your logic here
        Capsule::table('mod_mymodule_log')->insert([
            'event' => 'client_added',
            'client_id' => $clientId,
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
        
    } catch (\Exception $e) {
        logActivity("Hook error: " . $e->getMessage());
    }
}

/**
 * Hook: Invoice Paid
 */
function mymodule_hookInvoicePaid($vars) {
    try {
        $invoiceId = $vars['invoiceid'];
        
        // Your logic here
        
    } catch (\Exception $e) {
        logActivity("Hook error: " . $e->getMessage());
    }
}

/**
 * Hook: Daily Cron Job
 */
function mymodule_hookDailyCron($vars) {
    try {
        // Run daily tasks
        
    } catch (\Exception $e) {
        logActivity("Cron hook error: " . $e->getMessage());
    }
}
```

---

## Next Steps

1. Copy the template for your module type
2. Replace `mymodule` with your actual module name
3. Update the configuration and language strings
4. Implement your business logic
5. Test thoroughly
6. Follow security best practices (see BEST-PRACTICES.md)

---

For detailed examples, check the `whmcs-skills-kit/samples/` directory!
