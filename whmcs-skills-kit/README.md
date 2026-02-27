# Complete WHMCS Development Skill Kit

**A comprehensive, production-ready skill package for AI-powered WHMCS development.**

---

## Overview

This skill kit empowers AI coding agents (Cursor, Copilot, Windsurf, Claude) to build, debug, and maintain WHMCS modules with enterprise-grade quality. It combines:

- **Expert Guidance**: SKILLS.md with comprehensive best practices
- **Integration Guides**: Step-by-step setup for your favorite AI editor
- **Code Templates**: Ready-to-customize module boilerplate
- **Real Scenarios**: Copy-paste prompts for common tasks
- **Quick References**: Cheatsheet and troubleshooting guides
- **Code Samples**: 1000+ extracted PHP snippets
- **Validation Tools**: Automated checks for code quality

---

## Quick Links

| Document | Purpose |
|----------|---------|
| [SKILLS.md](./guide/SKILLS.md) | Core skill: Best practices & standards |
| [QUICK-START.md](./guide/QUICK-START.md) | 5-minute setup & first module |
| [AI-INTEGRATION.md](./guide/AI-INTEGRATION.md) | Setup for Cursor, Copilot, Windsurf, Claude |
| [EXAMPLES-AND-PROMPTS.md](./guide/EXAMPLES-AND-PROMPTS.md) | Copy-paste prompts for real projects |
| [CHEATSHEET.md](./guide/CHEATSHEET.md) | One-page quick reference |
| [BEST-PRACTICES.md](./guide/BEST-PRACTICES.md) | Advanced patterns & optimization |
| [TROUBLESHOOTING.md](./guide/TROUBLESHOOTING.md) | Debug common issues |
| [templates/README.md](./templates/README.md) | Module development templates |

---

## File Structure

```
whmcs-skills-kit/
├── guide/                           # Documentation
│   ├── SKILLS.md                    # Core skill definition
│   ├── QUICK-START.md              # Get started in 5 minutes
│   ├── AI-INTEGRATION.md           # AI agent integration guide
│   ├── EXAMPLES-AND-PROMPTS.md     # Real-world scenarios
│   ├── CHEATSHEET.md               # Quick reference
│   ├── BEST-PRACTICES.md           # Advanced patterns
│   ├── TROUBLESHOOTING.md          # Problem solving
│   └── README.md                    # (this file)
├── modules/                         # JSON reference data
│   ├── api.json                     # API command reference
│   ├── hooks.json                   # Hook points & parameters
│   ├── addon_modules.json           # Addon module reference
│   ├── provisioning_modules.json    # Provisioning module reference
│   ├── registrar_modules.json       # Domain registrar reference
│   ├── payment_gateways.json        # Payment gateway reference
│   ├── themes.json                  # Theme variables reference
│   ├── mail_providers.json          # Mail provider reference
│   ├── notification_providers.json  # Notification provider reference
│   ├── languages.json               # Language file reference
│   ├── oauth.json                   # OAuth integration reference
│   └── advanced.json                # Advanced topics reference
├── samples/                         # PHP code snippets
│   ├── addon_*.php                  # Addon module examples
│   ├── api_*.php                    # API call examples
│   ├── hooks_*.php                  # Hook implementation examples
│   ├── provisioning_*.php           # Provisioning module examples
│   ├── registrar_*.php              # Registrar module examples
│   ├── payment_*.php                # Payment gateway examples
│   ├── themes_*.php                 # Theme examples
│   └── ... (600+ more examples)
├── templates/                       # Module templates
│   └── README.md                    # Use as boilerplate
├── tools/                           # Utility scripts
│   ├── validate_module.py           # Validate modules
│   └── validate_module.sh           # Bash wrapper
├── manifest.json                    # Manifest of all skills
└── README.md                        # This file
```

---

## 🚀 Getting Started

### For New Users (5 minutes)

1. Read [QUICK-START.md](./guide/QUICK-START.md) — Get your first module building
2. Choose your AI editor and follow setup in [AI-INTEGRATION.md](./guide/AI-INTEGRATION.md)
3. Pick a task from [EXAMPLES-AND-PROMPTS.md](./guide/EXAMPLES-AND-PROMPTS.md)
4. Ask your AI agent to build it, loading the SKILLS.md file

### For Experienced Developers

1. Review [SKILLS.md](./guide/SKILLS.md) — Understand the rules and standards
2. Use [CHEATSHEET.md](./guide/CHEATSHEET.md) for quick lookups
3. Reference [BEST-PRACTICES.md](./guide/BEST-PRACTICES.md) for advanced patterns
4. Copy templates from [templates/README.md](./templates/README.md)
5. Validate output with [tools/validate_module.py](./tools/validate_module.py)

---

## Core Principles

This skill kit enforces WHMCS excellence across 5 core areas:

### 1. Code Quality
- PSR-12 coding standards
- Strict type hints (PHP 8.1+)
- 4-space indentation
- Clear naming conventions
- Comprehensive error handling

### 2. Security
- Access guards on every file
- Input validation & sanitization
- SQL injection prevention (Capsule ORM)
- XSS prevention (template escaping)
- Secure credential storage (encryption)
- CSRF protection in forms

### 3. Performance
- Efficient database queries
- Proper indexing strategy
- Query caching where applicable
- Pagination for large result sets
- Batch operations optimization

### 4. Reliability
- Try/catch error handling
- Comprehensive logging (activity & module logs)
- Graceful degradation
- Transaction management
- Proper database schema design

### 5. Maintainability
- Clear code organization
- Modular architecture
- Comprehensive documentation
- Version upgrade patterns
- Easy debugging & testing

---

## Supported WHMCS Versions

| Version | PHP | Smarty | Status |
|---------|-----|--------|--------|
| **WHMCS 8.x** (8.11+) | 8.1+ | 3.1 | ✅ Supported |
| **WHMCS 9.x** | 8.2+ | 4.3 | ✅ Supported |

---

## Module Types Supported

| Type | Skill File | Complexity | Time |
|------|-----------|-----------|------|
| **Addon Module** | `addon_modules.json` | ⭐⭐ | 5 min |
| **Provisioning Module** | `provisioning_modules.json` | ⭐⭐⭐ | 15 min |
| **Registrar Module** | `registrar_modules.json` | ⭐⭐⭐ | 15 min |
| **Payment Gateway** | `payment_gateways.json` | ⭐⭐ | 10 min |
| **Action Hook** | `hooks.json` | ⭐ | 2 min |
| **Mail Provider** | `mail_providers.json` | ⭐⭐ | 8 min |
| **Notification Provider** | `notification_providers.json` | ⭐⭐ | 8 min |
| **Custom Theme** | `themes.json` | ⭐⭐⭐⭐ | 30 min |

---

## Using Each AI Agent

### 🔵 Cursor IDE

```
Load this in .cursorrules:
@whmcs-skills-kit/guide/SKILLS.md

In chat:
@whmcs-skills-kit/modules/addon_modules.json
@whmcs-skills-kit/samples/addon_*.php

Build me an addon that...
```

**See**: [AI-INTEGRATION.md → Cursor IDE](./guide/AI-INTEGRATION.md#using-with-cursor-ide)

---

### 🟡 GitHub Copilot

```
Create .copilot-instructions in project root with:
[See AI-INTEGRATION.md for full template]

In chat:
@whmcs-skills-kit/guide/SKILLS.md
@whmcs-skills-kit/modules/hooks.json

Write a hook that...
```

**See**: [AI-INTEGRATION.md → GitHub Copilot](./guide/AI-INTEGRATION.md#using-with-github-copilot)

---

### 🟣 Windsurf

```
Create .windsurf-context with module type mappings

In chat:
@skill: whmcs-skills-kit/guide/SKILLS.md
@api: whmcs-skills-kit/modules/api.json

Build a provisioning module...
```

**See**: [AI-INTEGRATION.md → Windsurf](./guide/AI-INTEGRATION.md#using-with-windsurf)

---

### 🔴 VS Code + Copilot

```
Use @file: mentions in chat

@file:whmcs-skills-kit/guide/SKILLS.md
@file:whmcs-skills-kit/modules/payment_gateways.json

Create a Stripe payment gateway...
```

**See**: [AI-INTEGRATION.md → VS Code](./guide/AI-INTEGRATION.md#using-with-vs-code)

---

### 🟠 Claude (API)

```python
import anthropic

with open('whmcs-skills-kit/guide/SKILLS.md') as f:
    skill = f.read()

client = anthropic.Anthropic()
message = client.messages.create(
    model="claude-3-5-sonnet-20241022",
    max_tokens=4096,
    system=skill,
    messages=[{"role": "user", "content": "Build me a..."}]
)
```

**See**: [AI-INTEGRATION.md → Claude API](./guide/AI-INTEGRATION.md#using-with-claude-api)

---

## Example: Build Your First Module

### Step 1: Load the Skill
```
@whmcs-skills-kit/guide/SKILLS.md
@whmcs-skills-kit/modules/addon_modules.json
```

### Step 2: Ask for Your Module
```
Create an addon module that displays client registration dates
as a widget in their dashboard.

Module name: client_signup_widget
Use Capsule ORM for database operations.
Include proper error handling and logging.
```

### Step 3: Validate the Output
```bash
python3 whmcs-skills-kit/tools/validate_module.py modules/addons/client_signup_widget/
```

### Step 4: Deploy
```bash
# Copy to WHMCS
cp -r modules/addons/client_signup_widget/ /path/to/whmcs/modules/addons/

# Activate in admin panel
```

---

## Document Guide

### 🎯 Start Here
- **New to WHMCS?** → [QUICK-START.md](./guide/QUICK-START.md)
- **Setting up AI?** → [AI-INTEGRATION.md](./guide/AI-INTEGRATION.md)

### 📚 Reference
- **Quick lookup?** → [CHEATSHEET.md](./guide/CHEATSHEET.md)
- **Code snippets?** → Check `samples/` folder
- **Module structure?** → [templates/README.md](./templates/README.md)

### 🔧 Building
- **Core rules?** → [SKILLS.md](./guide/SKILLS.md)
- **Best practices?** → [BEST-PRACTICES.md](./guide/BEST-PRACTICES.md)
- **Real scenarios?** → [EXAMPLES-AND-PROMPTS.md](./guide/EXAMPLES-AND-PROMPTS.md)

### 🐛 Debugging
- **Something broken?** → [TROUBLESHOOTING.md](./guide/TROUBLESHOOTING.md)
- **Validate code?** → Run `python3 tools/validate_module.py`

---

## Token Budget Tips

The skill is modular to save tokens:

| Task | Load This | Cost |
|------|-----------|------|
| Quick fix | SKILLS.md section only | ~2K tokens |
| Start new addon | SKILLS.md + addon_modules.json | ~8K tokens |
| Payment gateway | SKILLS.md + payment_gateways.json | ~10K tokens |
| Full project | All modules | ~30K tokens |

**Strategy**: Load SKILLS.md always, then add specific module JSON only when needed.

---

## Security Checklist

Before deploying ANY module, verify:

- ✅ `defined("WHMCS") or die("Access Denied");` — First line
- ✅ Input validation — All `$_POST`/`$_GET` sanitized
- ✅ Database security — Using Capsule ORM with binding
- ✅ Output escaping — Data escaped in templates
- ✅ Secret encryption — API keys encrypted with `encrypt()`
- ✅ Logging — No secrets in logs, use `logModuleCall()`
- ✅ Error handling — Try/catch around external operations
- ✅ Language file — Has all English strings

See [SKILLS.md Section 9](./guide/SKILLS.md#9-security-checklist) for full checklist.

---

## Validation & Testing

### Automated Validation

```bash
# Validate a single file
python3 whmcs-skills-kit/tools/validate_module.py modules/addons/mymodule/mymodule.php

# Validate entire module directory
python3 whmcs-skills-kit/tools/validate_module.py modules/addons/mymodule/

# Output as JSON
python3 whmcs-skills-kit/tools/validate_module.py --json modules/addons/mymodule/
```

### Manual Syntax Check

```bash
php -l modules/addons/mymodule/mymodule.php
```

### Run Tests

```bash
php vendor/bin/phpunit tests/
```

---

## Manifest

The `manifest.json` file lists all available skills and reference files:

```json
{
  "version": "1.0",
  "role": "WHMCS Expert Developer",
  "skills": [
    {
      "name": "API",
      "file": "modules/api.json",
      "description": "WHMCS API reference for all commands"
    },
    // ... more skills
  ]
}
```

Load it to see what's available without reading entire files.

---

## Contribution

Found an issue or want to improve the skill?

1. Check the [WHMCS Developer Docs](https://developers.whmcs.com/)
2. Review the relevant skill file
3. Submit improvements via pull request
4. Update version in manifest.json

---

## License

This skill kit is provided as educational and development assistance for WHMCS module creation. Follow WHMCS licensing requirements for your modules.

---

## Support & Resources

### Documentation
- [Official WHMCS Developer Docs](https://developers.whmcs.com/)
- [WHMCS Community Forums](https://community.whmcs.com/)
- [Laravel Capsule Docs](https://laravel.com/docs/9.x/database)
- [Smarty Template Engine](https://www.smarty.net/docs/)

### Your Skill Kit
- Quick Start: [QUICK-START.md](./guide/QUICK-START.md)
- Troubleshooting: [TROUBLESHOOTING.md](./guide/TROUBLESHOOTING.md)
- Examples: [EXAMPLES-AND-PROMPTS.md](./guide/EXAMPLES-AND-PROMPTS.md)

---

## Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | Feb 2026 | Initial release |

---

## Ready to Build?

1. **First time?** →  Read [QUICK-START.md](./guide/QUICK-START.md) (5 min)
2. **Choose AI?** → Follow [AI-INTEGRATION.md](./guide/AI-INTEGRATION.md)
3. **Load skill** → Use `whmcs-skills-kit/guide/SKILLS.md` as system prompt
4. **Ask away!** → Pick a scenario from [EXAMPLES-AND-PROMPTS.md](./guide/EXAMPLES-AND-PROMPTS.md)

**Happy developing! 🚀**

---

*Built with ❤️ for the WHMCS developer community.*
