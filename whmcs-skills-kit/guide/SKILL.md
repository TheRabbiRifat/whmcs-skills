---
name: whmcs-dev-skills
description: >
  Senior WHMCS Developer & Architect skill for AI coding agents. Builds,
  debugs, and maintains WHMCS Addon Modules, Provisioning (Server) Modules,
  Domain Registrar Modules, Payment Gateway Modules, and Action Hooks.
  Enforces WHMCS 8.x / 9.x best practices, modern PHP 8.1+ standards,
  Laravel Capsule ORM, Smarty v4 templating, and PSR-1/PSR-2 coding style.
  Use this skill whenever a user needs to create, modify, debug, or audit
  any WHMCS module, hook, or integration.
license: GPL-2.0
compatibility: >
  Works with all AI coding agents including Claude Code, GitHub Copilot,
  Cursor, Windsurf, VS Code, Amp, Goose, and OpenCode. Requires PHP 8.1+
  and WHMCS 8.x or 9.x environment for generated code.
metadata:
  author: Jules (AI Agent)
  version: "1.0.0"
---

# WHMCS Dev Skills — AI Agent Skill

> **Scope**: Full-stack WHMCS module development covering Addon Modules,
> Provisioning (Server) Modules, Domain Registrar Modules, Payment Gateway
> Modules (Third-Party, Merchant, Tokenised), Action Hooks, Internal/External
> API integration, and Theme/Template customisation.

> **Modular Skills**: This skill relies on external JSON files for detailed reference data to conserve tokens.
> Refer to `manifest.json` for the full list of available skill modules (API, Hooks, Provisioning, etc.).

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
6. [Action Hooks](#6-action-hooks)
7. [API Integration](#7-api-integration)
8. [Templating & UI](#8-templating--ui)
9. [Security Checklist](#9-security-checklist)
10. [Error Handling & Logging](#10-error-handling--logging)
11. [Module Upgrade Pattern](#11-module-upgrade-pattern)
12. [Common Pitfalls & Anti-Patterns](#12-common-pitfalls--anti-patterns)
13. [Official References](#13-official-references)

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
- Write code compatible with **PHP 8.1+** (prefer 8.2 / 8.3) with strict type hints.

### ⚠️ ASK FIRST

- Before performing bulk refunds or mass invoice operations.
- Before performing `DROP TABLE` operations in deactivation functions.
- Before changing a client's password or authentication settings.
- Before modifying any server-level configuration.
- Before deleting or merging client accounts.

### 🚫 NEVER

- Modify WHMCS core files (`/admin/`, `/includes/`, `/vendor/`). Use Hooks or Modules instead.
- Modify `configuration.php` directly.
- Use `mysql_*`, `mysqli_*`, or raw PDO — always use Capsule.
- Use deprecated `{php}` tags in Smarty templates.
- Use `$_REQUEST` — be explicit with `$_POST` or `$_GET`.
- Hardcode absolute file paths — use `ROOTDIR`, `$CONFIG['SystemURL']`, or WHMCS constants.
- Store sensitive data (passwords, API keys) in plain text — use WHMCS's `encrypt()` / `decrypt()` helpers.
- Use `echo` or `print` for output in module files (except Addon `_output`) — return structured arrays.

---

## 2. Platform Requirements

| Component          | WHMCS 8.x (8.11+)       | WHMCS 9.x               |
|--------------------|--------------------------|--------------------------|
| **PHP**            | 8.1 min, 8.2 recommended | 8.2 min, 8.3 recommended |
| **Smarty**         | v3.1.x                   | v4.3.4                   |
| **GuzzleHTTP**     | v7.4                     | v7.4.5                   |
| **Illuminate**     | v7.x                     | v9.0                     |
| **MySQL/MariaDB**  | 5.7+ / 10.2+             | 8.0+ / 10.6+            |

---

## 3. Coding Standards

```
✓  Use <?php ?> full tags only.
✓  Omit closing ?> in pure-PHP files.
✓  Indent with 4 spaces.
✓  No trailing whitespace.
✓  Follow PSR-1 & PSR-2.
✓  Use strict_types declaration: declare(strict_types=1);
```

### Naming Conventions

| Element             | Convention                     | Example                  |
|---------------------|--------------------------------|--------------------------|
| Module Directory    | lowercase, letters & numbers   | `mymodule`               |
| Module Functions    | `{modulename}_FunctionName`    | `mymodule_config()`      |
| Hook Functions      | Unique prefixed name           | `mymodule_hookClientAdd` |
| Database Tables     | `mod_{modulename}_{entity}`    | `mod_mymodule_settings`  |
| Config Fields       | camelCase keys                 | `apiKey`                 |
| Template Files      | lowercase with hyphens         | `admin-dashboard.tpl`    |
| Language Keys       | snake_case                     | `module_description`     |

---

## 4. Database Operations

### ✅ Modern Pattern — Laravel Capsule

```php
<?php
use Illuminate\Database\Capsule\Manager as Capsule;

// SELECT
$clients = Capsule::table('tblclients')->where('status', 'Active')->get();

// INSERT
Capsule::table('mod_mymodule_logs')->insert([
    'client_id' => $clientId,
    'created_at' => date('Y-m-d H:i:s'),
]);

// SCHEMA (in _activate)
Capsule::schema()->create('mod_mymodule_data', function ($table) {
    $table->increments('id');
    $table->unsignedInteger('client_id');
    $table->string('key');
    $table->text('value')->nullable();
    $table->timestamps();
});
```

---

## 5. Module Development

> **Note**: Refer to the respective JSON files in `modules/` for detailed function signatures and parameters.

### 5.1 Addon Modules
*   **File**: `modules/addon_modules.json`
*   **Structure**: `modules/addons/{modulename}/`
*   **Key Functions**: `_config`, `_activate`, `_deactivate`, `_upgrade`, `_output` (Admin), `_clientarea` (Client).

### 5.2 Provisioning (Server) Modules
*   **File**: `modules/provisioning_modules.json`
*   **Structure**: `modules/servers/{modulename}/`
*   **Key Functions**: `_MetaData`, `_CreateAccount`, `_SuspendAccount`, `_TerminateAccount`, `_ClientArea`.

### 5.3 Domain Registrar Modules
*   **File**: `modules/registrar_modules.json`
*   **Structure**: `modules/registrars/{modulename}/`
*   **Key Functions**: `_getConfigArray`, `_RegisterDomain`, `_RenewDomain`, `_GetNameservers`, `_Sync`.

### 5.4 Payment Gateway Modules
*   **File**: `modules/payment_gateways.json`
*   **Structure**: `modules/gateways/{modulename}.php`
*   **Key Functions**: `_link` (Third-Party), `_capture` (Merchant).

---

## 6. Action Hooks

*   **File**: `modules/hooks.json`
*   **Usage**: `add_hook($hookPoint, $priority, $callbackFunction);`
*   **Locations**: `/includes/hooks/` or within module `hooks.php`.

### Most-Used Hook Points
*   **Client**: `ClientAdd`, `ClientEdit`, `ClientChangePassword`
*   **Invoice**: `InvoiceCreated`, `InvoicePaid`, `AddInvoicePayment`
*   **Ticket**: `TicketOpen`, `TicketAdminReply`, `TicketUserReply`
*   **Module**: `AfterModuleCreate`, `AfterModuleSuspend`

---

## 7. API Integration

*   **File**: `modules/api.json`
*   **Internal**: Use `localAPI($command, $values)`. No auth required in hooks/modules.
*   **External**: Use `WHMCS\Module\Guzzle` client.

```php
$results = localAPI('GetClientsDetails', ['clientid' => $id, 'stats' => true]);
```

---

## 8. Templating & UI

*   **File**: `modules/themes.json`
*   **Engine**: Smarty v4 (WHMCS 9.x).
*   **Syntax**: `{$variable}`, `{if $condition}...{/if}`, `{foreach $array as $item}...{/foreach}`.
*   **No PHP**: `{php}` tags are forbidden.

---

## 9. Security Checklist

1.  **Access Guard**: `defined("WHMCS") or die("Access Denied");` at start of files.
2.  **Input Validation**: Sanitize `$_POST` / `$_GET`.
3.  **DB Security**: Use Capsule (PDO binding). No raw SQL injection.
4.  **Logging**: Scrub secrets (passwords, keys) from `logModuleCall`.
5.  **Output**: Escape user data in HTML (`{$var|escape}`).

---

## 10. Error Handling & Logging

*   **Module Log**: `logModuleCall('module', 'action', $request, $response, $data, [$secrets]);`
*   **Activity Log**: `logActivity("Message here");`

---

## 11. Module Upgrade Pattern

Use `_upgrade($vars)` to handle schema changes.

```php
function mymodule_upgrade($vars) {
    $version = $vars['version'];
    if ($version < '1.1') {
        // Run updates
    }
}
```

---

## 12. Common Pitfalls & Anti-Patterns

*   **Using `mysql_*` functions**: Removed in PHP 7/8. Use Capsule.
*   **Hardcoded Paths**: Use `ROOTDIR`.
*   **Direct Core File Edits**: Never. Use hooks.
*   **Returning in Admin Output**: Addon `_output` must `echo` HTML.
*   **Echoing in Client Area**: Addon `_clientarea` must `return` array.

---

## 13. Official References

See `manifest.json` for the full list of generated skill files available in this package.
