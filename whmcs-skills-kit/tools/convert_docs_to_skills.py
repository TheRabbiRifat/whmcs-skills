import os
import re
import json

# Define paths relative to this script (whmcs-skills-kit/tools/convert_docs_to_skills.py)
SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))
KIT_ROOT = os.path.dirname(SCRIPT_DIR)
REPO_ROOT = os.path.dirname(KIT_ROOT)

MODULES_DIR = os.path.join(KIT_ROOT, "modules")
GUIDE_DIR = os.path.join(KIT_ROOT, "guide")

# Ensure directories exist
for d in [MODULES_DIR, GUIDE_DIR]:
    if not os.path.exists(d):
        os.makedirs(d)

def parse_markdown_table(file_path):
    """
    Parses a markdown table from a file.
    Assumes the first table found is the one to parse.
    Returns a list of dictionaries with column headers as keys.
    """
    if not os.path.exists(file_path):
        return []

    with open(file_path, "r", encoding="utf-8") as f:
        lines = f.readlines()

    headers = []
    parsed_data = []
    in_table = False

    for i, line in enumerate(lines):
        line = line.strip()
        if not line:
            in_table = False
            continue

        if "|" in line:
            # check if it is a separator line
            if re.match(r'^\|?[-:| ]+\|?$', line):
                continue

            # extract cells
            cells = [c.strip() for c in line.split('|')]
            # remove empty start/end cells if they exist due to leading/trailing pipes
            if line.startswith('|'):
                cells = cells[1:]
            if line.endswith('|'):
                cells = cells[:-1]

            if not headers:
                headers = cells
                in_table = True
            elif in_table:
                # Merge if number of cells matches, or best effort
                # Sometimes description has pipes, simpler split might fail.
                # But for now assume simple split is enough for this doc.
                if len(cells) == len(headers):
                    parsed_data.append(dict(zip(headers, cells)))
                elif len(cells) > len(headers):
                     # combine extra cells into the last column
                     last_col = " | ".join(cells[len(headers)-1:])
                     row_data = cells[:len(headers)-1] + [last_col]
                     parsed_data.append(dict(zip(headers, row_data)))
                else:
                    # Partial row?
                    pass
        else:
            in_table = False

    return parsed_data

def parse_markdown_sections(file_path):
    """
    Parses markdown sections starting with H2 headers (##).
    Returns a dictionary where keys are section titles and values are content.
    """
    if not os.path.exists(file_path):
        return {}

    with open(file_path, "r", encoding="utf-8") as f:
        content = f.read()

    sections = {}
    current_section = None
    current_content = []

    for line in content.split('\n'):
        match = re.match(r'^##\s+(.+?)(?:\s*<a.*>)?$', line)
        if match:
            if current_section:
                sections[current_section] = '\n'.join(current_content).strip()
            current_section = match.group(1).strip()
            current_content = []
        elif current_section:
            current_content.append(line)

    if current_section:
        sections[current_section] = '\n'.join(current_content).strip()

    return sections

def get_source_path(relative_path):
    return os.path.join(REPO_ROOT, relative_path)

def generate_provisioning_skills():
    print("Generating Provisioning Module skills...")

    # 1. Parse Parameters
    params_file = get_source_path("provisioning-modules/module-parameters.md")
    params = parse_markdown_table(params_file)

    # 2. Parse Supported Functions
    funcs_file = get_source_path("provisioning-modules/supported-functions.md")
    funcs = parse_markdown_sections(funcs_file)

    skill_data = {
        "module_type": "provisioning",
        "description": "Skills for developing WHMCS Provisioning Modules. These modules allow you to provision and manage products and services.",
        "common_parameters": params,
        "functions": []
    }

    for name, desc in funcs.items():
        skill_data["functions"].append({
            "name": name,
            "description": desc,
            "arguments": "$params (array)",
            "return_value": "string 'success' or error message"
        })

    output_path = os.path.join(MODULES_DIR, "provisioning_modules.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_addon_skills():
    print("Generating Addon Module skills...")

    # Addon modules are less structured. We'll define known functions and search for descriptions.
    known_functions = {
        "Config": "addon-modules/configuration.md",
        "Activate": "addon-modules/installation-uninstallation.md",
        "Deactivate": "addon-modules/installation-uninstallation.md",
        "Upgrade": "addon-modules/upgrades.md",
        "Output": "addon-modules/admin-area-output.md",
        "Sidebar": "addon-modules/admin-area-output.md",
        "ClientArea": "addon-modules/client-area-output.md"
    }

    skill_data = {
        "module_type": "addon",
        "description": "Skills for developing WHMCS Addon Modules. These modules provide additional functionality within WHMCS.",
        "functions": []
    }

    for func_name, rel_path in known_functions.items():
        file_path = get_source_path(rel_path)
        if not os.path.exists(file_path):
            continue

        with open(file_path, "r", encoding="utf-8") as f:
            content = f.read()

        # Try to find a section for the function or just use the whole file content as context
        # Heuristic: look for 'function module_name_funcname' or similar patterns
        # Or just describe what the file is about.

        description = f"See {file_path} for details."

        # specific extraction for Config
        if func_name == "Config":
             # Look for text around "function demo_config"
             match = re.search(r'function demo_config\(\) \{([\s\S]+?)\}', content)
             if match:
                 description = "Defines module configuration. Example:\n" + match.group(0)
             else:
                 description = "Defines module configuration (name, version, author, fields)."

        elif func_name == "Output":
            match = re.search(r'function demo_output\(\$vars\) \{([\s\S]+?)\}', content)
            if match:
                description = "Defines admin area output. Example:\n" + match.group(0)
            else:
                description = "Defines admin area output. Receives $vars array."

        skill_data["functions"].append({
            "name": func_name,
            "description": description,
            "arguments": "$vars (array) for Output/ClientArea, none for Config (returns array)",
            "source_file": rel_path
        })

    output_path = os.path.join(MODULES_DIR, "addon_modules.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_payment_skills():
    print("Generating Payment Gateway skills...")

    # Payment Gateways
    # Merchant Gateway: merchant-gateway.md
    # Third Party Gateway: third-party-gateway.md

    skill_data = {
        "module_type": "payment_gateway",
        "description": "Skills for developing WHMCS Payment Gateway Modules.",
        "functions": []
    }

    # Merchant Gateway functions
    merchant_file = get_source_path("payment-gateways/merchant-gateway.md")
    if os.path.exists(merchant_file):
        funcs = parse_markdown_sections(merchant_file)
        # The file structure might not be strictly H2 sections for functions.
        # Let's just manually add known ones if parsing fails or returns little.

        if not funcs:
             skill_data["functions"].append({
                 "name": "MetaData",
                 "description": "Define module metadata like DisplayName, APIVersion, etc.",
                 "arguments": "None",
                 "return_value": "Array"
             })
             skill_data["functions"].append({
                 "name": "config",
                 "description": "Define configuration fields.",
                 "arguments": "None",
                 "return_value": "Array"
             })
             skill_data["functions"].append({
                 "name": "capture",
                 "description": "Attempt to capture payment.",
                 "arguments": "$params",
                 "return_value": "Array (status, transid, fee, rawdata)"
             })
             skill_data["functions"].append({
                 "name": "refund",
                 "description": "Attempt to refund payment.",
                 "arguments": "$params",
                 "return_value": "Array (status, transid, fee, rawdata)"
             })
        else:
             for name, desc in funcs.items():
                 skill_data["functions"].append({
                     "name": name,
                     "description": desc,
                     "arguments": "$params",
                     "return_value": "See description"
                 })

    # Third Party Gateway functions (Link)
    third_party_file = get_source_path("payment-gateways/third-party-gateway.md")
    if os.path.exists(third_party_file):
        # usually just 'link' function
        skill_data["functions"].append({
            "name": "link",
            "description": "Returns HTML code for a button/form to redirect user to payment gateway.",
            "arguments": "$params",
            "return_value": "HTML String"
        })

    output_path = os.path.join(MODULES_DIR, "payment_gateways.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_registrar_skills():
    print("Generating Registrar Module skills...")

    skill_data = {
        "module_type": "registrar",
        "description": "Skills for developing WHMCS Domain Registrar Modules.",
        "common_parameters": [],
        "functions": []
    }

    # Parse parameters
    params_file = get_source_path("domain-registrars/module-parameters.md")
    skill_data["common_parameters"] = parse_markdown_table(params_file)

    # Parse functions
    funcs_file = get_source_path("domain-registrars/function-index.md")
    funcs = parse_markdown_table(funcs_file)

    for row in funcs:
        # Assuming the table columns are roughly "Parameter" (Function Name) and "Description"
        # We need to adapt based on exact headers found.
        name_key = next((k for k in row.keys() if "Parameter" in k or "Function" in k), None)
        desc_key = next((k for k in row.keys() if "Description" in k), None)

        if name_key and desc_key:
            skill_data["functions"].append({
                "name": row[name_key],
                "description": row[desc_key],
                "arguments": "$params (array)",
                "return_value": "Various (see docs)"
            })

    output_path = os.path.join(MODULES_DIR, "registrar_modules.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_hook_skills():
    print("Generating Hook skills...")

    skill_data = {
        "type": "hooks",
        "description": "List of WHMCS Hooks.",
        "hooks": []
    }

    hooks_dir = get_source_path("hooks-reference")
    if os.path.exists(hooks_dir):
        for filename in os.listdir(hooks_dir):
            if not filename.endswith(".md") or filename == "index.md":
                continue

            filepath = os.path.join(hooks_dir, filename)
            # Use sections parser. Each section is usually a hook name.
            sections = parse_markdown_sections(filepath)

            for hook_name, desc in sections.items():
                skill_data["hooks"].append({
                    "name": hook_name,
                    "description": desc,
                    "category": filename.replace(".md", "")
                })

    output_path = os.path.join(MODULES_DIR, "hooks.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_api_skills():
    print("Generating API skills...")

    skill_data = {
        "type": "api",
        "description": "WHMCS API Reference.",
        "functions": []
    }

    api_dir = get_source_path("api-reference")
    if os.path.exists(api_dir):
        for filename in os.listdir(api_dir):
            if not filename.endswith(".md") or filename == "index.md":
                continue

            filepath = os.path.join(api_dir, filename)

            # Simple parsing: Title is command name. Tables are parameters.
            with open(filepath, "r", encoding="utf-8") as f:
                content = f.read()

            title_match = re.search(r'title\s*=\s*"([^"]+)"', content)
            command_name = title_match.group(1) if title_match else filename.replace(".md", "")

            # Extract description (text before first header or table)
            # This is a bit rough but works for most files
            description = ""
            desc_match = re.search(r'\+\+\+\n\n([\s\S]+?)(?:###|##|\|)', content)
            if desc_match:
                 description = desc_match.group(1).strip()

            # Parse tables
            # Assuming first table is Request Parameters, second is Response (if exists)
            # But parse_markdown_table only gets one.
            # We might need to split content by "### Request Parameters" etc.

            request_params = []
            req_match = re.search(r'Request Parameters\s*\n\s*(\|[\s\S]+?)\n\n', content)
            if req_match:
                # We need a temporary way to parse a string table
                # Reuse existing logic by writing to temp file or refactoring.
                # Refactoring `parse_markdown_table` to accept string content is better.
                pass

            # For now, let's just grab the whole file content as "documentation"
            # and maybe try to parse the first table if it looks like params.

            # Actually, let's use the file path for `parse_markdown_table`.
            # It grabs the FIRST table. In API docs, first table is usually Request Parameters.
            params = parse_markdown_table(filepath)

            skill_data["functions"].append({
                "command": command_name,
                "description": description,
                "parameters": params,
                "documentation_file": os.path.join("api-reference", filename)
            })

    output_path = os.path.join(MODULES_DIR, "api.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_theme_skills():
    print("Generating Theme skills...")
    # Just list files and sections as themes are more about guides
    generate_generic_skills("themes", "themes.json", "WHMCS Theme Development")

def generate_mail_provider_skills():
    print("Generating Mail Provider skills...")
    generate_generic_skills("mail-providers", "mail_providers.json", "WHMCS Mail Provider Modules")

def generate_notification_provider_skills():
    print("Generating Notification Provider skills...")
    generate_generic_skills("notification-providers", "notification_providers.json", "WHMCS Notification Provider Modules")

def generate_advanced_skills():
    print("Generating Advanced skills...")
    generate_generic_skills("advanced", "advanced.json", "Advanced WHMCS Development")

def generate_oauth_skills():
    print("Generating OAuth skills...")
    generate_generic_skills("oauth", "oauth.json", "WHMCS OAuth Integration")

def generate_language_skills():
    print("Generating Language skills...")
    generate_generic_skills("languages", "languages.json", "WHMCS Language Files")

def generate_generic_skills(source_rel_path, output_filename, description):
    skill_data = {
        "type": "guide",
        "category": source_rel_path,
        "description": description,
        "topics": []
    }

    source_dir = get_source_path(source_rel_path)

    if os.path.exists(source_dir):
        for filename in os.listdir(source_dir):
            if not filename.endswith(".md") or filename == "index.md":
                continue

            filepath = os.path.join(source_dir, filename)
            sections = parse_markdown_sections(filepath)

            topic_name = filename.replace(".md", "").replace("-", " ").title()

            skill_data["topics"].append({
                "title": topic_name,
                "content": sections, # This might be large, but it's modular by file at least
                "file": os.path.join(source_rel_path, filename)
            })

    output_path = os.path.join(MODULES_DIR, output_filename)
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_manifest():
    print("Generating Skills Manifest...")
    manifest = {
        "version": "1.0",
        "role": "WHMCS Expert Developer",
        "description": "A comprehensive, modular set of skills for developing, debugging, and maintaining WHMCS modules, themes, and integrations.",
        "skills": [
            {"name": "Provisioning Modules", "file": "modules/provisioning_modules.json", "description": "Functions and parameters for provisioning products/services."},
            {"name": "Addon Modules", "file": "modules/addon_modules.json", "description": "Structure and functions for Admin Area addon modules."},
            {"name": "Payment Gateways", "file": "modules/payment_gateways.json", "description": "Interfaces for Merchant and Third-Party payment gateways."},
            {"name": "Registrar Modules", "file": "modules/registrar_modules.json", "description": "Functions for domain registration and management modules."},
            {"name": "Hooks", "file": "modules/hooks.json", "description": "Comprehensive list of system hooks and their parameters."},
            {"name": "API", "file": "modules/api.json", "description": "Reference for the WHMCS Local and External API commands."},
            {"name": "Themes", "file": "modules/themes.json", "description": "Guides and variables for Client Area and Admin Area theme development."},
            {"name": "Mail Providers", "file": "modules/mail_providers.json", "description": "Integration skills for custom Mail Providers."},
            {"name": "Notification Providers", "file": "modules/notification_providers.json", "description": "Integration skills for Notification Providers."},
            {"name": "Advanced", "file": "modules/advanced.json", "description": "Advanced topics including DB interaction, Authentication, and Logging."},
            {"name": "OAuth", "file": "modules/oauth.json", "description": "Implementing OAuth Single Sign-On and credentials."},
            {"name": "Languages", "file": "modules/languages.json", "description": "Working with WHMCS language files and overrides."},
            {"name": "Best Practices", "file": "guide/SKILL.md", "description": "Core development guidelines and operational boundaries."}
        ]
    }

    output_path = os.path.join(KIT_ROOT, "manifest.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(manifest, f, indent=2)
    print(f"Created {output_path}")

def generate_skill_md():
    print("Generating SKILL.md...")
    content = r"""---
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
"""
    output_path = os.path.join(GUIDE_DIR, "SKILL.md")
    with open(output_path, "w", encoding="utf-8") as f:
        f.write(content)
    print(f"Created {output_path}")

if __name__ == "__main__":
    generate_provisioning_skills()
    generate_addon_skills()
    generate_payment_skills()
    generate_registrar_skills()
    generate_hook_skills()
    generate_api_skills()
    generate_theme_skills()
    generate_mail_provider_skills()
    generate_notification_provider_skills()
    generate_advanced_skills()
    generate_oauth_skills()
    generate_language_skills()
    generate_manifest()
    generate_skill_md()
