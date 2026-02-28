# AI Integration Guide: WHMCS Development Skills

**Last Updated**: February 28, 2026  
**Skill Version**: 4.0.0  
**Target AI Agents**: Claude, GitHub Copilot, Cursor IDE, Windsurf, VS Code, Gemini, OpenCode

---

## Table of Contents

1. [Overview](#overview)
2. [Setup Instructions](#setup-instructions)
3. [Using with Cursor IDE](#using-with-cursor-ide)
4. [Using with GitHub Copilot](#using-with-github-copilot)
5. [Using with Windsurf](#using-with-windsurf)
6. [Using with VS Code](#using-with-vs-code)
7. [Using with Claude (API)](#using-with-claude-api)
8. [Loading Context Strategically](#loading-context-strategically)
9. [Chat Patterns for WHMCS Development](#chat-patterns-for-whmcs-development)
10. [Skill Files Quick Reference](#skill-files-quick-reference)

---

## Overview

The WHMCS Developer Skills Kit transforms static documentation into **actionable intelligence** for AI coding agents. Rather than searching endless docs, AI agents can access:

- **System Prompt**: `SKILL.md` — enforces best practices, security standards, and operational boundaries
- **Modular Knowledge Bases**: JSON files for APIs, Hooks, Modules, etc.
- **Code Samples**: Pre-extracted PHP snippets for common tasks
- **Manifest**: A directory of all available skill modules

### Benefits

✅ **Token Efficient**: Load only the knowledge needed for your task  
✅ **Consistent**: All generated code follows WHMCS best practices  
✅ **Secure**: Built-in security checklist and validation patterns  
✅ **Production-Ready**: Enforces PSR-12, Laravel Capsule, Smarty v4 standards  

---

## Setup Instructions

### Step 1: Locate Skill Files

Navigate to the WHMCS skills repository:

```bash
cd /path/to/whmcs-skills/
```

You should have:

```
.
├── SKILL.md                    # Main system prompt
├── guides/
│   ├── AI-INTEGRATION.md      # This file
│   ├── QUICK-START.md
│   └── ...
├── references/
│   ├── api.json
│   ├── hooks.json
│   ├── addon_modules.json
│   ├── payment_gateways.json
│   ├── provisioning_modules.json
│   ├── registrar_modules.json
│   └── ...
└── samples/
    ├── addon_*.php
    ├── api_*.php
    └── hooks_*.php
```

### Step 2: Choose Your AI Agent

Each agent has a different way to load system prompts and context. See sections below for specific instructions.

---

## Using with Cursor IDE

**Cursor** integrates natural system prompts and context files seamlessly.

### Method 1: Use Cursor Rules (.cursorrules)

1. Create or open `.cursorrules` in your WHMCS project root:

```bash
touch .cursorrules
```

2. Add this reference to your `.cursorrules`:

```
# WHMCS Development Skill
You are an expert WHMCS developer. Follow the guidelines in:
- File: SKILL.md
- Reference data: references/ directory

When building modules, always:
1. Check references/ for the module type details
2. Reference the appropriate JSON file (e.g., references/addon_modules.json)
3. Load samples from samples/ folder
4. Follow the security checklist in SKILL.md section 9

Load context for specific tasks:
- Payment Gateway? → Load references/payment_gateways.json
- Writing hooks? → Load references/hooks.json
- API integration? → Load references/api.json
```

3. In Cursor, press `Ctrl+K` and mention the SKILL.md file:

```
@SKILL.md
I need to create a payment gateway module. What's the structure?
```

### Method 2: Inline Context (@mentions)

In any Cursor chat:

```
@SKILL.md
@references/payment_gateways.json

Help me create a Stripe payment gateway module for WHMCS 9.x
```

---

## Using with GitHub Copilot

**GitHub Copilot** works best with inline prompts and `.copilot-instructions` files.

### Method 1: Copilot Instructions File

1. Create `.copilot-instructions` in your project root:

```
You are an expert WHMCS developer. Always enforce:
- PSR-12 coding standards
- Laravel Capsule ORM for database operations
- Smarty v4 templating
- WHMCS 8.x/9.x best practices

Reference documentation:
- Main Skill Guide: SKILL.md
- Reference Data: references/ folder
- Code Samples: samples/ folder

For any task, first consult the relevant JSON file in references/
and then provide sample code patterns from the samples/ folder.
```

2. Use Copilot Chat with file references:

```
@SKILL.md
Write a complete Addon Module for WHMCS 9.x
```

### Method 2: Inline Chat with Context Links

```
Based on references/addon_modules.json,
create an admin dashboard widget addon. Follow the patterns
in samples/addon_*.php examples.
```

---

## Using with Windsurf

**Windsurf** (Codeium's IDE) supports multiple ways to load documentation.

### Method 1: Project Context

1. Open Windsurf settings (`Cmd+,` or `Ctrl+,`)
2. Add to workspace `.windsurf-context`:

```json
{
  "skillPath": "SKILL.md",
  "referencePath": "references/",
  "samplesPath": "samples/",
  "moduleTypes": {
    "addon": "references/addon_modules.json",
    "provisioning": "references/provisioning_modules.json",
    "gateway": "references/payment_gateways.json",
    "registrar": "references/registrar_modules.json",
    "hook": "references/hooks.json",
    "api": "references/api.json"
  }
}
```

### Method 2: Chat with Document References

```
@skill: SKILL.md
@api: references/api.json

Build a provisioning module that creates accounts on a remote server.
Include error handling and logging per the security checklist.
```

---

## Using with VS Code

**VS Code** with Copilot extension or similar AI extensions.

### Method 1: Workspace Settings

1. Create `.vscode/settings.json`:

```json
{
  "codeium.enableConfigCommand": true,
  "codeium.contextPath": "SKILL.md"
}
```

2. Create a `.vscode/prompt.md` with your skill reference:

```markdown
# WHMCS Development Skill

Reference: `SKILL.md`

When generating code:
- Load the skill file first
- Check samples/ for patterns
- Validate against security checklist (Section 9 of SKILL.md)
```

### Method 2: Usage in Copilot Chat

```
@file:SKILL.md
@file:references/hooks.json

I need to write a hook that runs when an invoice is paid.
Follow WHMCS best practices and security standards.
```

---

## Using with Claude (API)

**Claude API** users can directly include the skill files in system prompts.

### Method 1: Python Script with Skill Context

```python
import anthropic
import json
from pathlib import Path

def load_skill_file(filepath):
    with open(filepath, 'r') as f:
        return f.read()

def create_whmcs_expert(task_description, file_context=None):
    client = anthropic.Anthropic()
    
    # Load main skill guide
    skill_md = load_skill_file('SKILL.md')
    
    # Load additional context if specified
    context = skill_md
    if file_context:
        for file_path in file_context:
            context += "\n\n---\n\n" + load_skill_file(file_path)
    
    # Call Claude with skill
    message = client.messages.create(
        model="claude-3-5-sonnet-20241022",
        max_tokens=4096,
        system=context,
        messages=[
            {
                "role": "user",
                "content": task_description
            }
        ]
    )
    
    return message.content[0].text

# Example usage
result = create_whmcs_expert(
    "Create a complete payment gateway module for Stripe",
    file_context=[
        'modules/payment_gateways.json',
        'samples/payment_merchant_merchant-gateway_sample_1.php'
    ]
)

print(result)
```

### Method 2: Direct System Prompt Integration

```python
import anthropic

client = anthropic.Anthropic()

# Read skill guide
with open('SKILL.md', 'r') as f:
    skill_guide = f.read()

# Read module reference
with open('references/hooks.json', 'r') as f:
    hooks_reference = json.load(f)

system_prompt = f"""
{skill_guide}

---

## Hook Reference Data

{json.dumps(hooks_reference, indent=2)}
"""

message = client.messages.create(
    model="claude-3-5-sonnet-20241022",
    max_tokens=4096,
    system=system_prompt,
    messages=[
        {
            "role": "user",
            "content": "Write a complete hook module that logs all client password changes"
        }
    ]
)

print(message.content[0].text)
```

---

## Loading Context Strategically

### The Token Budget Mindset

Large language models have token limits. Load context strategically:

| Task Type | Required Files | Estimated Tokens |
|-----------|----------------|------------------|
| API Integration | `SKILL.md` + `api.json` | ~8K |
| Payment Gateway | `SKILL.md` + `payment_gateways.json` + samples | ~12K |
| Action Hook | `SKILL.md` + `hooks.json` | ~15K |
| Complete Addon Module | `SKILL.md` + `addon_modules.json` + samples | ~20K |
| Database Query | `SKILL.md` (section 4 only) + relevant sample | ~4K |

### Context Loading Strategy

1. **Always load**: `SKILL.md` (core rules and standards)
2. **Load for task**: The specific module type JSON
3. **Load if stuck**: Relevant sample code from `samples/`
4. **Load only once**: Reference files are just a directory reference

### Example: Minimal Context for Quick Fix

```
# For a small bugfix, load minimal context:
@file:SKILL.md (Section 4: Database Operations)

Fix this SQL injection vulnerability in my Capsule query...
```

---

## Chat Patterns for WHMCS Development

### Pattern 1: "I want to build X module"

```
I need to build a provisioning module for [cloud provider].

Reference files:
@SKILL.md
@references/provisioning_modules.json
@samples/provisioning_*.php

Requirements:
- Account creation with custom parameters
- Automatic suspension/termination
- Error handling and logging

Please provide the complete module structure.
```

### Pattern 2: "I found a bug"

```
This hook isn't firing when clients are added. Here's the code:
[paste code]

Reference:
@SKILL.md (Section 6: Action Hooks)
@references/hooks.json

Help me debug according to WHMCS best practices.
```

### Pattern 3: "How do I call the API?"

```
I need to:
- Get client details
- Create an invoice
- Mark it as paid

Show me the proper way using WHMCS standards:
@SKILL.md (Section 7: API Integration)
@references/api.json
```

### Pattern 4: "Refactor my old code"

```
This is my old WHMCS 7.x addon module:
[paste code]

Modernize it to WHMCS 9.x standards:
@SKILL.md
@references/addon_modules.json
@samples/addon_*.php

Make it follow PSR-12, use Capsule ORM, and enforce the security checklist.
```

---

## Skill Files Quick Reference

### Primary Files

| File | Purpose | When to Load |
|------|---------|--------------|
| `guide/SKILL.md` | Core rules, standards, boundaries | Always |
| `manifest.json` | Directory of all available modules | Once, for reference |

### Module References (JSON)

| File | Content | Use Case |
|------|---------|----------|
| `modules/api.json` | API command reference | Building API integrations |
| `modules/hooks.json` | Hook points and parameters | Writing action hooks |
| `modules/addon_modules.json` | Addon module structure | Building admin/client area addons |
| `modules/provisioning_modules.json` | Server provisioning functions | Hosting/VPS modules |
| `modules/registrar_modules.json` | Domain registrar functions | Domain registration modules |
| `modules/payment_gateways.json` | Payment gateway structure | Payment integration modules |
| `modules/themes.json` | Theme variables and functions | Custom theme development |
| `modules/mail_providers.json` | Email provider integration | Custom email drivers |
| `modules/notification_providers.json` | Notification system | Custom notification channels |

### Sample Code

All files in `samples/` follow the naming pattern: `{module_type}_{topic}_{number}.php`

**Examples**:
- `addon_client-area-output_sample_1.php` — Client area addon display
- `api_addclient_sample_1.php` — How to use AddClient API
- `hooks_client_sample_1.php` — Client-related hooks
- `registrar_domain-syncing_sample_1.php` — Domain syncing in registrar modules

---

## Best Practices for AI Agents

### When Generating Code

1. ✅ **Start with SKILL.md** — It defines all constraints
2. ✅ **Check the JSON files** — They have detailed function signatures
3. ✅ **Look at samples** — They show real patterns
4. ✅ **Validate against checklist** — SKILL.md Section 9 (Security)
5. ✅ **Explain decisions** — Why you chose a particular approach

### When Debugging

1. ✅ **Check SKILL.md Section 12** — Common Pitfalls
2. ✅ **Validate patterns** — Does it match samples?
3. ✅ **Review security** — Is input validated? DB safe?
4. ✅ **Test locally first** — Don't deploy untested

### When Migrating Code

1. ✅ **Reference SKILL.md Section 11** — Upgrade patterns
2. ✅ **Check version requirements** — SKILL.md Section 2
3. ✅ **Modernize standards** — Use Capsule, Smarty v4, etc.
4. ✅ **Run the validation script** — Test against standards

---

## Example: Full Chat Workflow

### User Request
```
I need to create a payment gateway that integrates with Stripe.
It should support regular payments and subscriptions.
```

### AI Agent Response (with loaded context)

1. **Loads files**:
   - `guide/SKILL.md` → Gets standards and boundaries
   - `modules/payment_gateways.json` → Understands structure
   - `samples/payment_*` → Gets code patterns

2. **Generates**: Full module with proper structure

3. **Validates**:
   - Uses `encrypt()` for API keys (Section 9)
   - Implements proper error handling (Section 10)
   - Follows naming conventions (Section 5)

4. **Explains**: Why each approach was chosen

5. **Provides tests**: Example test cases for validation

---

## Troubleshooting

### "Skill file not found"
- Ensure you're in the workspace directory
- Check file paths are relative to project root

### "AI generating old-style code"
- Include `guide/SKILL.md` explicitly in every request
- Mention "WHMCS 8.x+", "PSR-12", "Capsule ORM"

### "Context too long"
- Don't load entire `manifest.json` (it's just a reference)
- Load only the specific JSON module you need
- Use samples sparingly (load specific file, not whole folder)

### "Code doesn't validate"
- Run the validation script (see next section)
- Check against SKILL.md Section 12
- Share output with AI agent for fixing

---

## Next Steps

1. **Setup**: Choose your AI agent and follow the setup section above
2. **Test**: Ask AI agent a simple question to load the skill
3. **Build**: Start building WHMCS modules with AI assistance
4. **Validate**: Use the validation script to check output
5. **Deploy**: Follow security checklist before going to production

---

For questions, consult:
- `SKILL.md` (main reference)
- `references/` directory (module type details)
- Official WHMCS docs: https://developers.whmcs.com/
