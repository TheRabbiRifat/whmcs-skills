# WHMCS AI Skill — Quick Start Guide

**Get building in 5 minutes!**

---

## TL;DR

```
1. Load SKILL.md as your system prompt
2. Ask the AI to build what you need
3. Validate against the security checklist
4. Deploy
```

---

## 60-Second Setup

### For Cursor Users
```
@whmcs-skills-kit/guide/SKILL.md
Build me a complete Addon Module that displays stats on the admin dashboard.
```

### For Copilot Users
```
Create a WHMCS Addon Module with admin dashboard.
Reference: whmcs-skills-kit/guide/SKILL.md
```

### For VS Code
```
Open whmcs-skills-kit/guide/SKILL.md
Then ask Copilot: Build an invoice payment processor module.
```

---

## 5-Minute Tutorial: Build Your First Module

### Task: Create a Simple Addon Module

1. **Tell the AI what you want**

   ```
   @whmcs-skills-kit/guide/SKILL.md
   @whmcs-skills-kit/modules/addon_modules.json
   
   I want to create an addon that adds a widget to the client area
   showing their domain registration dates.
   ```

2. **AI generates the module structure** ✅

3. **Review the code against the checklist**

   - ✅ Has `defined("WHMCS") or die("Access Denied");`?
   - ✅ Uses `Capsule` for database queries?
   - ✅ Escapes output in templates?
   - ✅ Has error handling?

4. **Ask for tests/fixes if needed**

   ```
   Add unit tests and make sure the output is escaped properly.
   ```

5. **Deploy!** 🚀

---

## Common Tasks & Prompts

### "Build me a Payment Gateway"

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/payment_gateways.json
@whmcs-skills-kit/samples/payment_merchant_merchant-gateway_sample_1.php

Create a complete Stripe payment gateway module for WHMCS 9.x.
Include webhook handling, error handling, and logging.
```

**Time to first module**: ~2 min  
**Quality level**: Production-ready

---

### "Build me a Provisioning Module for [Provider]"

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/provisioning_modules.json
@whmcs-skills-kit/samples/

Create a provisioning module for Linode that:
- Creates accounts via the Linode API
- Handles suspension and termination
- Provides admin and client area outputs
- Includes proper error logging
```

**Time to first module**: ~3 min  
**Quality level**: Production-ready with API integration

---

### "Build me a Registrar Module"

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/registrar_modules.json

Create a registrar module for [registrar] that:
- Registers domains
- Handles renewals
- Syncs nameservers
- Supports domain locking
```

**Time to implementation**: ~5 min  
**Quality level**: Full domain management

---

### "I need a Hook that does X"

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/hooks.json

Write a hook that executes every time a ticket is created.
It should:
- Log the ticket details to a custom table
- Send a webhook to my external system
- Handle errors gracefully
```

**Time to implementation**: ~1 min  
**Quality level**: Production-ready

---

## Module Types at a Glance

| Module Type | What It Does | Load This | Time |
|------------|-------------|-----------|------|
| **Addon** | Adds features to admin/client area | `addon_modules.json` | 5 min |
| **Provisioning** | Manages hosting accounts & VPS | `provisioning_modules.json` | 10 min |
| **Registrar** | Manages domain registration | `registrar_modules.json` | 8 min |
| **Payment Gateway** | Accepts payments | `payment_gateways.json` | 5 min |
| **Hook** | Reacts to system events | `hooks.json` | 2 min |
| **Theme** | Custom client area design | `themes.json` | 15 min |
| **Mail Provider** | Custom email integration | `mail_providers.json` | 10 min |
| **Notification** | Custom notification channels | `notification_providers.json` | 8 min |

---

## The WHMCS Module Template

Every module follows this structure:

```
modules/
└── {moduletype}/
    └── {modulename}/
        ├── hooks.php               (optional, for hooks)
        ├── lib/
        │   └── Client.php          (optional, for provisioning)
        ├── lang/
        │   └── english.php         (required)
        ├── templates/              (required for UI)
        │   └── admin-view.tpl
        └── {modulename}.php        (main file)
```

### The Main Module File Skeleton

```php
<?php
declare(strict_types=1);

defined("WHMCS") or die("Access Denied");

use Illuminate\Database\Capsule\Manager as Capsule;
use WHMCS\Module\Addon\{ModuleName}\Client;

function {modulename}_config() {
    return [
        'name' => 'Module Name',
        'description' => 'What it does',
        'version' => '1.0.0',
    ];
}

function {modulename}_activate() {
    // Run on module activation
}

function {modulename}_deactivate() {
    // Run on module deactivation
}

function {modulename}_upgrade($vars) {
    // Handle version upgrades
}

// For addons:
function {modulename}_output($vars) {
    // Admin area output
}

function {modulename}_clientarea($vars) {
    // Client area output
}

// For hooks:
function {modulename}_hookClientAdd($vars) {
    // Your hook code
}
```

---

## Security Checklist (Quick Version)

Before deploying ANY module, verify:

- ✅ **Access Guard**: First line is `defined("WHMCS") or die("Access Denied");`
- ✅ **Input Validation**: All `$_POST`/`$_GET` validated
- ✅ **Database**: Uses Capsule ORM with parameter binding
- ✅ **Output**: All user data escaped in templates (`{$var|escape}`)
- ✅ **Secrets**: API keys encrypted with `encrypt()` / `decrypt()`
- ✅ **Logging**: All API calls use `logModuleCall()`
- ✅ **Error Handling**: Try/catch around external calls
- ✅ **Language File**: Has `lang/english.php` with all keys

---

## Common Gotchas

### ❌ Using `mysql_*` functions
```php
// BAD
$result = mysql_query("SELECT * FROM tblclients");

// GOOD
$clients = Capsule::table('tblclients')->get();
```

### ❌ Hardcoding paths
```php
// BAD
$path = "/var/www/whmcs/storage/";

// GOOD
$path = ROOTDIR . "/storage/";
```

### ❌ Echoing in Client Output
```php
// BAD (for _clientarea)
function mymodule_clientarea($vars) {
    echo "<h1>Hello</h1>";
}

// GOOD
function mymodule_clientarea($vars) {
    return array(
        'templatefile' => 'mytemplate',
        'vars' => array('name' => 'John'),
    );
}
```

### ❌ Storing secrets in plain text
```php
// BAD
$config['api_key'] = "sk_live_abc123";

// GOOD
$config['api_key'] = encrypt("sk_live_abc123");
// Later: $key = decrypt($config['api_key']);
```

---

## Testing Your Module

### 1. Syntax Check
```bash
php -l modules/addons/mymodule/mymodule.php
```

### 2. Ask AI to validate
```
Review this code against WHMCS 9.x standards:
@whmcs-skills-kit/guide/SKILL.md

[paste your code]

Check it against the security checklist and modernization standards.
```

### 3. Run the validation script
```bash
python3 whmcs-skills-kit/tools/validate_module.py mymodule.php
```

---

## What If Something Goes Wrong?

### Module won't activate
```
@whmcs-skills-kit/guide/SKILL.md

My addon module won't activate. Here's the config:
[paste code]

Debug this using WHMCS best practices.
```

### Hook isn't firing
```
@whmcs-skills-kit/modules/hooks.json

My TicketOpen hook isn't firing. Is the hook point correct?
[paste code]
```

### Database errors
```
@whmcs-skills-kit/guide/SKILL.md (Section 4)

I'm getting database errors. Verify my Capsule ORM usage:
[paste code]
```

---

## Next Steps

1. **Pick a module type** (from table above)
2. **Prepare your request** with specific details
3. **Load the skill** (`@SKILL.md` + module JSON)
4. **Ask the AI** to build it
5. **Validate** against the checklist
6. **Deploy!**

---

## Resources

- **Main Guide**: `whmcs-skills-kit/guide/SKILL.md`
- **Integration Guide**: `whmcs-skills-kit/guide/AI-INTEGRATION.md` (detailed AI setup)
- **Manifest**: `whmcs-skills-kit/manifest.json` (what's available)
- **Official WHMCS Docs**: https://developers.whmcs.com/

---

**Ready to build?** Load the skill and start asking! 🚀
