# WHMCS Skills Kit — Enterprise Development Framework

**Professional-grade AI-powered WHMCS module development platform**

> Build production-ready WHMCS modules, integrations, and extensions using AI agents (Claude, GPT-4, Copilot, Cursor, etc.)

---

## 🚀 Quick Start

1. **Load the skill**: Use [SKILLS.md](./SKILLS.md) as your AI system prompt
2. **Pick your module type**: Addon | Payment Gateway | Provisioning | Registrar
3. **Reference examples**: See `/samples` for real code
4. **Deploy**: Follow `/docs/guides/deployment.md`

**Time to first working module**: 5-15 minutes with AI

---

## 📁 Project Structure

```
whmcs-skills/
├── SKILLS.md                 # ⭐ Core AI system prompt (START HERE)
├── README.md                 # This file
├── manifest.json             # Project metadata
│
├── docs/                     # 📚 Complete Documentation
│   ├── quickstart.md         # 5-minute setup guide
│   ├── architecture/         # Module type guides
│   │   ├── addon-modules.md
│   │   ├── payment-gateways.md
│   │   ├── provisioning.md
│   │   └── registrar-modules.md
│   ├── patterns/             # Code & design patterns
│   │   ├── database.md
│   │   ├── security.md
│   │   ├── error-handling.md
│   │   ├── performance.md
│   │   └── api-integration.md
│   ├── reference/            # Quick lookup
│   │   ├── naming-conventions.md
│   │   ├── api-commands.md
│   │   ├── hook-points.md
│   │   └── cheatsheet.md
│   ├── setup/                # IDE configuration
│   │   ├── claude-api.md
│   │   ├── cursor.md
│   │   ├── vs-code.md
│   │   └── windsurf.md
│   ├── guides/               # Workflows & checklists
│   │   ├── debugging.md
│   │   ├── deployment.md
│   │   ├── security-checklist.md
│   │   └── troubleshooting.md
│   └── examples/             # Real code scenarios
│       ├── complete-addon.md
│       ├── payment-gateway.md
│       ├── provisioning.md
│       └── hooks.md
│
├── reference/                # 📖 JSON Reference Data
│   ├── addon_modules.json
│   ├── payment_gateways.json
│   ├── provisioning_modules.json
│   ├── registrar_modules.json
│   ├── hooks.json
│   └── api.json
│
├── samples/                  # 💻 Real PHP Examples
│   ├── addon/
│   │   ├── complete-dashboard/
│   │   ├── dashboard-widget.php
│   │   └── client-area.php
│   ├── gateways/
│   │   ├── stripe.php
│   │   ├── paypal.php
│   │   └── custom-processor.php
│   ├── provisioning/
│   └── hooks/
│
├── guides/                   # 📋 Workflows & Resources
│   ├── AI-INTEGRATION.md
│   ├── BEST-PRACTICES.md
│   ├── CHEATSHEET.md
│   ├── QUICK-START.md
│   └── troubleshooting.md
│
├── configs/                  # ⚙️ Configuration Templates
│   └── (future environment configs)
│
└── references/               # 📖 JSON Reference Data
    └── (API specs, hooks, modules)
```

---

## 🎯 Common Tasks

### "I want to build an addon module"
1. Read: [docs/quickstart.md](./docs/quickstart.md)
2. Load: [SKILLS.md](./SKILLS.md) + [reference/addon_modules.json](./reference/addon_modules.json)
3. Study: [samples/addon/complete-dashboard](./samples/addon/complete-dashboard)
4. Follow: [docs/architecture/addon-modules.md](./docs/architecture/addon-modules.md)

### "I need to build a payment gateway"
1. Load: [SKILLS.md](./SKILLS.md) + [reference/payment_gateways.json](./reference/payment_gateways.json)
2. Study: [samples/gateways/stripe.php](./samples/gateways/stripe.php)
3. Follow: [docs/architecture/payment-gateways.md](./docs/architecture/payment-gateways.md)

### "My module has bugs"
1. Check: [docs/guides/troubleshooting.md](./guides/troubleshooting.md)
2. Review: [docs/guides/debugging.md](./guides/debugging.md)
3. Validate: Follow security checklist in [docs/guides/BEST-PRACTICES.md](./guides/BEST-PRACTICES.md)

### "I need to deploy to production"
1. Follow: [docs/guides/deployment.md](./docs/guides/deployment.md)
2. Check: [docs/guides/security-checklist.md](./docs/guides/security-checklist.md)
3. Test: Run full test suite

---

## 📚 Documentation by Purpose

| Need | Document |
|------|----------|
| **Getting started** | [quickstart.md](./docs/quickstart.md) |
| **Choose module type** | [architecture/](./docs/architecture/) |
| **Code patterns** | [patterns/](./docs/patterns/) |
| **Quick lookup** | [reference/](./docs/reference/) |
| **Set up IDE** | [setup/](./docs/setup/) |
| **Common workflows** | [guides/](./docs/guides/) |
| **See real code** | [samples/](./samples/) or [examples/](./docs/examples/) |

---

## 🤖 Supported AI Platforms

| Platform | Setup |
|----------|-------|
| Claude 3.5 Sonnet | [docs/setup/claude-api.md](./docs/setup/claude-api.md) |
| GitHub Copilot | [config/.copilot-instructions](./config/.copilot-instructions) |
| Cursor IDE | [config/.cursorrules](./config/.cursorrules) |
| VS Code | [docs/setup/vs-code.md](./docs/setup/vs-code.md) |
| Windsurf | [config/.windsurf-context](./config/.windsurf-context) |
| AntiGravity | [config/.antigravity-config](./config/.antigravity-config) |

---

## ✨ Key Features

✅ **Production-Ready** — Enterprise-grade code standards  
✅ **Secure by Default** — Security baked into every pattern  
✅ **AI-Optimized** — Structures that work with AI agents  
✅ **Comprehensive** — Every module type covered  
✅ **Well-Documented** — 100+ pages of guidance  
✅ **Real Examples** — Copy-paste ready code  
✅ **Validation Tools** — Automated quality checks  
✅ **Professional** — Follows WHMCS & PHP best practices  

---

## 🏗️ What You Can Build

- ✅ **Addon Modules** — Admin dashboards, management tools
- ✅ **Payment Gateways** — Stripe, PayPal, custom processors
- ✅ **Provisioning Modules** — Server automation
- ✅ **Registrar Modules** — Domain registration
- ✅ **Action Hooks** — Event automation
- ✅ **API Integrations** — Third-party services
- ✅ **Custom Themes** — Client area customization

---

## 🎓 Platform Support

| | WHMCS 8.x | WHMCS 9.x | PHP 7.4 | PHP 8.0-8.3 |
|---|-----------|-----------|---------|-------------|
| **Addon** | ✅ | ✅ | ✅ | ✅ |
| **Gateway** | ✅ | ✅ | ✅ | ✅ |
| **Provisioning** | ✅ | ✅ | ✅ | ✅ |
| **Registrar** | ✅ | ✅ | ✅ | ✅ |
| **Hooks** | ✅ | ✅ | ✅ | ✅ |

---

## 🚀 Getting Started (5 Minutes)

### Step 1: Load the skill
```
Use SKILLS.md as your AI system prompt
```

### Step 2: Choose your module
```
Addon Module      → docs/architecture/addon-modules.md
Payment Gateway   → docs/architecture/payment-gateways.md
Provisioning      → docs/architecture/provisioning.md
Registrar         → docs/architecture/registrar-modules.md
Action Hooks      → docs/architecture/action-hooks.md
```

### Step 3: Ask your AI
```
"Build me a {module type} that {does something}
Reference: SKILLS.md + reference/{module}_modules.json
Study: samples/{module}/..."
```

### Step 4: Deploy
```bash
# Deploy following guides/deployment guide
# Reference: guides/ folder for deployment & security checklists
```

---

## 📖 Full Navigation

```
START HERE
  ↓
[SKILLS.md]  ← Core system prompt
  ↓
[docs/quickstart.md]  ← 5-minute overview
  ↓
Choose your module type (docs/architecture/)
  ↓
Load reference data (reference/)
  ↓
Study samples (samples/)
  ↓
Follow patterns (docs/patterns/)
  ↓
Deploy with checklist (docs/guides/)
```

---

## 🔗 Quick Links

| | |
|---|---|
| 🎯 **Start** | [SKILLS.md](./SKILLS.md) |
| 📚 **Learn** | [docs/quickstart.md](./docs/quickstart.md) |
| 💻 **Code** | [samples/](./samples/) |
| 🏗️ **Architecture** | [docs/architecture/](./docs/architecture/) |
| 🔧 **Patterns** | [docs/patterns/](./docs/patterns/) |
| 📖 **Reference** | [docs/reference/](./docs/reference/) |
| ⚙️ **Setup** | [docs/setup/](./docs/setup/) |
| 🚀 **Deploy** | [docs/guides/deployment.md](./docs/guides/deployment.md) |

---

## 💡 Pro Tips

1. **Always load SKILLS.md first** — It's your AI's expertise guide
2. **Use reference JSON files** — They contain module specifications
3. **Study samples before building** — Real code is better than theory
4. **Run validation tools** — Catch issues before deployment
5. **Follow security checklist** — Non-negotiable for production
6. **Keep patterns consistent** — Makes maintenance easier

---

## 🆘 Need Help?

- **Getting started?** → [docs/quickstart.md](./docs/quickstart.md)
- **Module structure?** → [docs/architecture/](./docs/architecture/)
- **Code patterns?** → [docs/patterns/](./docs/patterns/)
- **Something broken?** → [docs/guides/troubleshooting.md](./docs/guides/troubleshooting.md)
- **Quick reference?** → [docs/reference/cheatsheet.md](./docs/reference/cheatsheet.md)
- **Real examples?** → [samples/](./samples/)

---

**Version 2.0 | Professional AI-Driven WHMCS Development**

Built for: Claude, GPT-4, Copilot, Cursor, VS Code, Windsurf, Anti-Gravity IDE
