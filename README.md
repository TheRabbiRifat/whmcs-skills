# 🤖 WHMCS AI Skills Kit
> **Professional WHMCS module development, supercharged with AI agents.**

Build production-ready WHMCS modules 10x faster using Github Copilot, Claude, Gemini, Anti Gravity, or Cursor.

[![Status](https://img.shields.io/badge/status-production%20ready-green)]()
[![WHMCS](https://img.shields.io/badge/WHMCS-8.x%20%7C%209.x-blue)]()
[![PHP](https://img.shields.io/badge/PHP-7.4%20to%208.3-blue)]()
[![License](https://img.shields.io/badge/license-GPL%202.0-blue)]()

---

## ⚡ Quick Start (60 Seconds)

### For GitHub Copilot
```
1. Create .copilot-instructions in project root
2. Paste: whmcs-skills-kit/guide/SKILL.md
3. In chat: Create a payment gateway module
```

### For Claude (API)
```python
with open('whmcs-skills-kit/guide/SKILL.md') as f:
    system = f.read()  # Use as system prompt
```

### For Gemini (API)
```bash
export GOOGLE_API_KEY="your-key"
python3 GEMINI-API-SETUP.py  # See GEMINI-API-SETUP.md
```

### For Anti Gravity / Cursor
```
Create .antigravity-config or .cursorrules:
@whmcs-skills-kit/guide/SKILL.md
```

### For VS Code
```
Use .vscode/settings.json (included)
+ Install GitHub Copilot extension
```

👉 **[Full setup guides → AI-INTEGRATION.md](whmcs-skills-kit/guide/AI-INTEGRATION.md)**

---

## 🎯 What Is This?

A **complete skill package** that turns any AI agent into a WHMCS expert developer:

- ✅ **Expert System Prompt** — Enforces WHMCS best practices, security, PSR-12 standards
- ✅ **Complete API Reference** — 200+ WHMCS API commands with parameters
- ✅ **Module Templates** — Ready-to-customize boilerplate for all module types
- ✅ **1000+ Code Samples** — Real PHP snippets for every common task
- ✅ **Security Checklist** — Production-ready validation & compliance
- ✅ **Real Scenarios** — Copy-paste prompts for addon modules, payment gateways, provisioning, etc.
- ✅ **Troubleshooting Guide** — Debug 30+ common issues
- ✅ **Validation Tools** — Python scripts to validate your code

---

## � Directory Structure

```
whmcs-skills-kit/                      # ← AI Skills Start Here
├── guide/
│   ├── SKILL.md                       # Core AI system prompt (LOAD THIS FIRST)
│   ├── QUICK-START.md                 # 5-minute tutorial
│   ├── AI-INTEGRATION.md              # Setup for your AI editor
│   ├── EXAMPLES-AND-PROMPTS.md        # Copy-paste prompts (25+ scenarios)
│   ├── CHEATSHEET.md                  # Quick reference
│   ├── BEST-PRACTICES.md              # Advanced patterns
│   ├── TROUBLESHOOTING.md             # Debug guide
│   └── README.md                      # Navigation guide
├── modules/                           # JSON reference data
│   ├── api.json                       # 200+ API commands
│   ├── hooks.json                     # 100+ hook points
│   ├── addon_modules.json             # Addon module config
│   ├── provisioning_modules.json      # Server provisioning
│   ├── registrar_modules.json         # Domain registrars
│   ├── payment_gateways.json          # Payment integration
│   ├── themes.json                    # Theme variables
│   └── ...
├── samples/                           # 1000+ PHP code snippets
│   ├── addon_*.php                    # Addon examples
│   ├── api_*.php                      # API call examples
│   ├── hooks_*.php                    # Hook implementations
│   ├── provisioning_*.php             # Server module examples
│   └── ...
├── templates/                         # Module boilerplate
│   └── README.md                      # Copy & customize
├── tools/
│   └── validate_module.py             # Code validation
└── README.md                          # (you are here)
```

---

## 🚀 Use Cases

| Goal | Load This | Time |
|------|-----------|------|
| Build **Addon Module** | `SKILL.md` + `addon_modules.json` | 5 min |
| Build **Payment Gateway** | `SKILL.md` + `payment_gateways.json` | 10 min |
| Build **Provisioning Module** | `SKILL.md` + `provisioning_modules.json` | 15 min |
| Build **Domain Registrar** | `SKILL.md` + `registrar_modules.json` | 15 min |
| Write **Action Hooks** | `SKILL.md` + `hooks.json` | 2 min |
| Debug **Existing Module** | `SKILL.md` + `TROUBLESHOOTING.md` | 5 min |
| Validate **Code Quality** | Run `validate_module.py` | 1 min |

---

## 📚 Navigation

### 🆕 First Time?
1. **[QUICK-START.md](whmcs-skills-kit/guide/QUICK-START.md)** — Get your first module working in 5 minutes
2. **[AI-INTEGRATION.md](whmcs-skills-kit/guide/AI-INTEGRATION.md)** — Setup your AI editor (Cursor, Copilot, Windsurf)
3. **[EXAMPLES-AND-PROMPTS.md](whmcs-skills-kit/guide/EXAMPLES-AND-PROMPTS.md)** — Pick a real scenario and copy the prompt

### 🎯 Building Modules?
1. **[SKILL.md](whmcs-skills-kit/guide/SKILL.md)** — Load this as your AI's system prompt
2. **[templates/README.md](whmcs-skills-kit/templates/README.md)** — Use starter templates
3. **[CHEATSHEET.md](whmcs-skills-kit/guide/CHEATSHEET.md)** — Quick reference while building

### 🔧 Advanced Development?
1. **[BEST-PRACTICES.md](whmcs-skills-kit/guide/BEST-PRACTICES.md)** — Enterprise patterns
2. **[TROUBLESHOOTING.md](whmcs-skills-kit/guide/TROUBLESHOOTING.md)** — Solve any issue
3. **`samples/` folder** — Study real code examples
4. **`modules/` folder** — Reference API & hook specifications

### 🐛 Something Broken?
1. Check **[TROUBLESHOOTING.md](whmcs-skills-kit/guide/TROUBLESHOOTING.md)** (30+ common issues)
2. Run **[validate_module.py](whmcs-skills-kit/tools/validate_module.py)** to check code quality
3. Ask your AI agent for help (load SKILL.md + TROUBLESHOOTING.md)

---

## � AI Agent Setup (Pick Your Tool)

### 1. GitHub Copilot (VS Code, JetBrains, Neovim)
```bash
# File: .copilot-instructions (included)
Reference: whmcs-skills-kit/guide/AI-INTEGRATION.md
```
[Full Setup →](whmcs-skills-kit/guide/AI-INTEGRATION.md#using-with-github-copilot)

### 2. Claude (Direct API)
```bash
# Setup: CLAUDE-API-SETUP.md (included)
# Use SKILL.md as system prompt
```
[Full Setup →](CLAUDE-API-SETUP.md)

### 3. Google Gemini (API)
```bash
# Setup: GEMINI-API-SETUP.md (included)
# Get API key at makersuite.google.com/app/apikey
```
[Full Setup →](GEMINI-API-SETUP.md)

### 4. Anti Gravity IDE
```bash
# File: .antigravity-config (included)
# Auto-loads SKILL.md and module references
```
[Full Setup →](.antigravity-config)

### 5. Cursor IDE / Windsurf
```bash
# File: .cursorrules or .windsurf-context (included)
@whmcs-skills-kit/guide/SKILL.md
```
[Cursor Setup →](whmcs-skills-kit/guide/AI-INTEGRATION.md#using-with-cursor-ide) | [Windsurf Setup →](whmcs-skills-kit/guide/AI-INTEGRATION.md#using-with-windsurf)

### 6. VS Code with Extensions
```bash
# File: .vscode/settings.json (included)
# Install: GitHub Copilot extension
```
[Full Setup →](whmcs-skills-kit/guide/AI-INTEGRATION.md#using-with-vs-code)

---

## 🎓 Example: Build Your First Module (2 Minutes)

**Step 1: Load the skill**
```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/addon_modules.json
```

**Step 2: Ask your AI**
```
Build an addon module called "order_tracker" that:
- Displays client order history as a chart on admin dashboard
- Uses Capsule ORM
- Includes proper error handling
- Follows WHMCS 9.x standards
```

**Step 3: Validate**
```bash
python3 whmcs-skills-kit/tools/validate_module.py modules/addons/order_tracker/
```

**Step 4: Deploy**
```bash
cp -r modules/addons/order_tracker /path/to/whmcs/modules/addons/
```

✅ **Done! Production-ready module, built by AI.**

---

## ✨ Supported WHMCS & AI Agents

| Component | Support |
|-----------|---------|
| **WHMCS 8.x** (8.11+) | ✅ Full support |
| **WHMCS 9.x** | ✅ Full support |
| **PHP 7.4** | ✅ Supported |
| **PHP 8.0-8.3** | ✅ Full support |
| **Claude 3.5 Sonnet** | ✅ Tested |
| **GPT-4o** | ✅ Tested |
| **GitHub Copilot** | ✅ Tested |
| **Google Gemini** | ✅ Tested |
| **Anti Gravity IDE** | ✅ Tested |
| **Cursor IDE** | ✅ Tested |
| **VS Code** | ✅ Tested |
| **Windsurf** | ✅ Tested |

---

## 📖 Complete File Guide

| File | Purpose | Read When |
|------|---------|-----------|
| **[SKILL.md](whmcs-skills-kit/guide/SKILL.md)** | Core AI system prompt | Building any module |
| **[QUICK-START.md](whmcs-skills-kit/guide/QUICK-START.md)** | 5-min tutorial | First time |
| **[AI-INTEGRATION.md](whmcs-skills-kit/guide/AI-INTEGRATION.md)** | Setup guides (5 editors) | Setting up your AI |
| **[EXAMPLES-AND-PROMPTS.md](whmcs-skills-kit/guide/EXAMPLES-AND-PROMPTS.md)** | 25+ real scenarios | Need a prompt to copy |
| **[CHEATSHEET.md](whmcs-skills-kit/guide/CHEATSHEET.md)** | One-page reference | Quick lookups |
| **[BEST-PRACTICES.md](whmcs-skills-kit/guide/BEST-PRACTICES.md)** | Advanced patterns | Optimizing code |
| **[TROUBLESHOOTING.md](whmcs-skills-kit/guide/TROUBLESHOOTING.md)** | Debug 30+ issues | Something's broken |
| **[templates/README.md](whmcs-skills-kit/templates/README.md)** | Module boilerplate | Starting a new module |

---

## ⚙️ AI Configuration Files

| File | AI Platform | Purpose |
|------|-------------|---------|
| **.copilot-instructions** | GitHub Copilot | Direct system prompt for Copilot |
| **CLAUDE-API-SETUP.md** | Claude (Anthropic) | API setup, Python examples, usage patterns |
| **GEMINI-API-SETUP.md** | Google Gemini | API setup, batch processing, streaming |
| **.antigravity-config** | Anti Gravity IDE | Context rules & auto-loading |
| **.cursorrules** | Cursor IDE | Rule-based context loading |
| **.windsurf-context** | Windsurf IDE | Multi-priority context strategy |
| **.vscode/settings.json** | VS Code | PHP formatting, linting, extensions |

---

## 🔒 Security & Quality

Every module generated with this skill includes:

✅ Access guards & CSRF protection  
✅ SQL injection prevention (Capsule ORM)  
✅ XSS prevention (template escaping)  
✅ Credential encryption  
✅ Comprehensive error handling  
✅ PSR-12 code standards  
✅ Automated validation via `validate_module.py`  

---

## 🌟 Real-World Examples

### Addon Module: Client Dashboard Widget
```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/addon_modules.json

Create an addon that shows clients their next invoice due date,
current balance, and domain expiration dates. Include caching.
```
**Result**: 200-line production module in < 2 minutes

### Payment Gateway: Stripe Integration
```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/payment_gateways.json

Build a Stripe payment gateway with webhook handling,
SCA support, and automatic invoice marking.
```
**Result**: Full merchant gateway in < 5 minutes

### Provisioning Module: cPanel/WHM
```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/provisioning_modules.json

Create a cPanel provisioning module with account creation,
suspension, termination, and password reset features.
```
**Result**: Complete hosting module in < 10 minutes

👉 **[See 25+ more examples →](whmcs-skills-kit/guide/EXAMPLES-AND-PROMPTS.md)**

---

## 💡 Pro Tips

1. **Load SKILL.md first** — It's the foundation for everything
2. **Use + operators** — Keep your prompts focused and add files as needed
3. **Validate output** — Run `validate_module.py` on generated code
4. **Check samples/** — Study real code from the 1000+ snippets
5. **Read TROUBLESHOOTING.md** — 80% of issues are covered there

---

## 🛠️ Tools Included

### Module Validator
```bash
# Validate single file
python3 whmcs-skills-kit/tools/validate_module.py modules/addons/mymodule/mymodule.php

# Validate entire module
python3 whmcs-skills-kit/tools/validate_module.py modules/addons/mymodule/

# Output as JSON (for CI/CD)
python3 whmcs-skills-kit/tools/validate_module.py --json modules/addons/mymodule/
```

Checks for:
- Missing required functions
- Security issues (SQL injection, XSS, etc.)
- Coding standard violations
- Missing language files
- And much more!

---

## 📊 What's Included

| Component | Count |
|-----------|-------|
| **Core Guides** | 8 comprehensive docs |
| **API Specifications** | 200+ commands |
| **Hook Points** | 100+ documented |
| **Code Samples** | 1000+ snippets |
| **Module Templates** | 5 types |
| **Real Scenarios** | 25+ with prompts |
| **Security Checks** | 20+ validations |

---

## 🤝 Contributing

Found a bug? Want to improve the skill? Have a scenario to add?

**Please contribute!** This kit improves with community input.

---

## � Support

- **Questions?** → Check [TROUBLESHOOTING.md](whmcs-skills-kit/guide/TROUBLESHOOTING.md)
- **Need setup help?** → See [AI-INTEGRATION.md](whmcs-skills-kit/guide/AI-INTEGRATION.md)  
- **Want examples?** → Browse [EXAMPLES-AND-PROMPTS.md](whmcs-skills-kit/guide/EXAMPLES-AND-PROMPTS.md)
- **Official WHMCS Docs** → https://developers.whmcs.com/

---

## 📄 License

Professional WHMCS development skill kit. Educational and commercial use permitted.

---

## 🚀 Get Started Now

1. **[Open QUICK-START.md](whmcs-skills-kit/guide/QUICK-START.md)** (5 min read)
2. **[Setup your AI editor](whmcs-skills-kit/guide/AI-INTEGRATION.md)** (2 min setup)
3. **[Pick a scenario](whmcs-skills-kit/guide/EXAMPLES-AND-PROMPTS.md)** (1 min)
4. **[Build your module!](whmcs-skills-kit/guide/SKILL.md)** (5-15 min with AI)

**That's it. You're building production-ready WHMCS modules with AI.** 🎉

---

*Professional AI-assisted WHMCS development. Built by developers, for developers.*
