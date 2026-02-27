# WHMCS AI Skills Kit - Complete Setup Guide
**All 5 AI Platforms Configured** | February 2026

---

## 🚀 Quick Overview

This WHMCS Skills Kit now supports **5 major AI platforms**:

| Platform | Type | Config File | Status |
|----------|------|-------------|--------|
| **GitHub Copilot** | IDE Extension | `.copilot-instructions` | ✅ Ready |
| **Claude (API)** | Direct API | `CLAUDE-API-SETUP.md` | ✅ Ready |
| **Google Gemini** | Direct API | `GEMINI-API-SETUP.md` | ✅ Ready |
| **Anti Gravity** | IDE Extension | `.antigravity-config` | ✅ Ready |
| **Cursor/Windsurf** | IDE Extension | `.cursorrules` / `.windsurf-context` | ✅ Ready |
| **VS Code** | Editor Config | `.vscode/settings.json` | ✅ Ready |

All configuration files are **ready to use immediately** - no additional setup needed beyond the platform's initial installation.

---

## 📦 What's Included

### Core Skill Files (8 guides)
- **SKILL.md** (267 lines) — Core AI expertise system prompt
- **QUICK-START.md** — 5-minute getting started tutorial
- **AI-INTEGRATION.md** — Platform-specific setup guides
- **EXAMPLES-AND-PROMPTS.md** — 25+ real-world scenarios
- **CHEATSHEET.md** — Quick reference for common tasks
- **BEST-PRACTICES.md** — Advanced patterns and optimization
- **TROUBLESHOOTING.md** — Debug 30+ common issues
- **templates/README.md** — Module boilerplate for 5 module types

### Reference Data (12 JSON files)
- **api.json** — 200+ WHMCS API commands
- **hooks.json** — 100+ action hook points
- **addon_modules.json** — Addon module specifications
- **payment_gateways.json** — Payment gateway interface
- **provisioning_modules.json** — Server provisioning requirements
- **registrar_modules.json** — Domain registrar interface
- Plus 6 additional reference files

### Code Samples (1000+ snippets)
- Real-world PHP examples for every module type
- API integration patterns
- Capsule ORM queries
- Smarty template examples

### AI Configuration Files (6 files)
1. `.copilot-instructions`
2. `CLAUDE-API-SETUP.md`
3. `GEMINI-API-SETUP.md`
4. `.antigravity-config`
5. `.cursorrules` / `.windsurf-context`
6. `.vscode/settings.json`

### Validation Tools
- **validate_module.py** — Automated code validation
- Checks security, coding standards, required functions
- JSON output for CI/CD integration

---

## 🔧 Platform-by-Platform Setup

### 1. GitHub Copilot
**File**: `.copilot-instructions`

**Setup** (2 minutes):
```bash
# Already in your project root
# Just start using Copilot with WHMCS questions
# It will auto-load SKILL.md rules

# Try in Copilot chat:
# "Create an addon module that shows client dashboard stats"
```

**Supported IDEs**:
- VS Code
- JetBrains IDEs
- Neovim
- GitHub.com

---

### 2. Claude (Anthropic API)
**File**: `CLAUDE-API-SETUP.md`

**Setup** (5 minutes):
```bash
# 1. Get API key: https://console.anthropic.com
# 2. Read: CLAUDE-API-SETUP.md (in root directory)
# 3. Copy Python example code
# 4. Set API key: export ANTHROPIC_API_KEY="sk-..."
# 5. Run: python3 script.py
```

**Features**:
- Full system prompt control
- Batch processing support
- Token budget optimization
- Streaming responses
- Cost breakdown included

**Recommended Models**:
- `claude-3-5-sonnet-20241022` — Best speed/quality ratio
- `claude-3-opus-20250219` — Most powerful, highest cost

---

### 3. Google Gemini (Google AI API)
**File**: `GEMINI-API-SETUP.md`

**Setup** (5 minutes):
```bash
# 1. Get API key: https://makersuite.google.com/app/apikey
# 2. Install: pip install google-generativeai
# 3. Read: GEMINI-API-SETUP.md (in root directory)
# 4. Set: export GOOGLE_API_KEY="your-key"
# 5. Run: python3 script.py
```

**Features**:
- Fast model (`gemini-1.5-flash`)
- Large context window (up to 1M tokens)
- Vision support (image analysis)
- Batch processing examples
- Cost optimization strategies

**Recommended Models**:
- `gemini-1.5-flash` — Fastest, cheapest
- `gemini-pro` — Balanced for WHMCS
- `gemini-1.5-pro` — Most powerful

---

### 4. Anti Gravity IDE
**File**: `.antigravity-config`

**Setup** (2 minutes):
```bash
# 1. Install Anti Gravity IDE
# 2. Open WHMCS project
# 3. File already present: .antigravity-config
# 4. Reload IDE or restart
# 5. Type "addon" or "payment" - auto-loads context
```

**Auto-Loading**:
- Detects WHMCS task types automatically
- Loads relevant JSON files
- Loads code examples
- Loads security guidelines
- Provides module-specific templates

---

### 5. Cursor IDE / Windsurf
**Files**: `.cursorrules` / `.windsurf-context`

**Setup** (2 minutes):
```bash
# Cursor:
# 1. Files already present
# 2. Open project in Cursor IDE
# 3. Rules auto-load from .cursorrules
# 4. Start building!

# Windsurf:
# Similar setup with .windsurf-context
```

**Features**:
- @ symbol references to load files
- Multi-priority context strategy
- Module type detection
- Security checklist enforcement
- PSR-12 formatting rules

---

### 6. VS Code
**File**: `.vscode/settings.json`

**Setup** (3 minutes):
```bash
# 1. File already present: .vscode/settings.json
# 2. Install GitHub Copilot extension
# 3. Install PHP Intelephense
# 4. Install PHP CS Fixer
# 5. Workspace auto-configures

# Formatters:
# - PSR-12 compliant (4-space indent)
# - Auto-format on save
# - Rulers at 80 and 120 chars
```

**Configured For**:
- PHP 8.1+ with strict types
- Smarty template files (.tpl)
- WHMCS module files (.module)
- Python script files (for validate_module.py)

---

## 🎯 Choosing Your Platform

### I want **quick IDE integration** (2 min setup):
→ Use **Cursor IDE** or **GitHub Copilot in VS Code**
- Install extension, auto-loads SKILL.md
- Works offline in IDE
- No API costs

### I want **maximum power**:
→ Use **Claude (Anthropic API)**
- Best code quality
- Strongest reasoning
- Larger context window (200K tokens)
- Cost: $3-15 per 1M tokens

### I want **speed and cost efficiency**:
→ Use **Google Gemini API**
- Fastest responses (gemini-1.5-flash)
- Large context (1M tokens)
- Cheapest option ($0.80 per 1M tokens)
- Best for batch processing

### I want **full IDE experience**:
→ Use **Anti Gravity** or **Cursor**
- Works while coding
- Auto-completes WHMCS patterns
- Context auto-loads by task type
- No API calls = no costs

### I use **VS Code professionally**:
→ Use **GitHub Copilot + VS Code**
- Integrated into editor
- Enterprise support
- Works with existing extensions
- Seamless workflow

---

## 📊 Platform Comparison

| Feature | Copilot | Claude | Gemini | Anti Gravity | Cursor | VS Code |
|---------|---------|--------|--------|------|--------|---------|
| **Setup Time** | 2 min | 5 min | 5 min | 2 min | 2 min | 3 min |
| **Cost** | $10-20/mo | $$$ | $ | Free | $20/mo | Free |
| **Speed** | Fast | Med | ⚡⚡⚡ | Med | Med | Depends |
| **Context** | Unknown | 200K | 1M | Real-time | 200K | Unlimited |
| **Offline** | ✅ | ❌ | ❌ | ✅ | ✅ | ✅ |
| **Image Support** | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ |
| **Best For** | General dev | Complex tasks | Batch jobs | Beginners | Daily coding | Budget |

---

## 🚀 Getting Started

### Option A: IDE Users (Fastest)
```bash
# 1. Install Cursor IDE or VS Code + Copilot
# 2. Open this project
# 3. In chat: "Build addon module for [task]"
# 4. Use @whmcs-skills-kit/guide/SKILL.md
# 5. Done! (5-15 min to production code)
```

### Option B: API Users (Most Powerful)
```bash
# 1. Choose: Claude or Gemini
# 2. Get API key from their website
# 3. Read setup file (CLAUDE-API-SETUP.md or GEMINI-API-SETUP.md)
# 4. Copy Python example
# 5. Run: python3 script.py
# 6. Done! (5-15 min to production code)
```

### Option C: Mixed Approach (Flexible)
```bash
# Use Cursor IDE for quick edits
# Use Claude API for complex modules
# Use Copilot for general C help
# Use validate_module.py to check all
```

---

## 📚 Complete File Reference

### At Project Root:
- **README.md** ← You are here
- **.copilot-instructions** — GitHub Copilot config
- **CLAUDE-API-SETUP.md** — Claude setup & examples
- **GEMINI-API-SETUP.md** — Gemini setup & examples
- **.antigravity-config** — Anti Gravity IDE config
- **.cursorrules** — Cursor IDE rules
- **.windsurf-context** — Windsurf IDE config
- **.vscode/** → settings.json (VS Code config)

### In whmcs-skills-kit/:
- **guide/** → 8 comprehensive guides
- **modules/** → 12 JSON reference files
- **samples/** → 1000+ PHP code examples
- **templates/** → Module boilerplate
- **tools/** → validate_module.py validator

---

## ✅ Validation Workflow

After **any AI generates code**:

```bash
# 1. Generate module (use any AI platform)
# 2. Save to: modules/addons/mymodule/ (or appropriate folder)
# 3. Run validator:
python3 whmcs-skills-kit/tools/validate_module.py modules/addons/mymodule/

# 4. Check for:
# - Missing required functions
# - Security vulnerabilities
# - SQL injection risks
# - XSS vulnerabilities
# - PSR-12 compliance
# - Missing language files

# 5. Fix any issues (ask AI to fix specific errors)
# 6. Re-run validator to confirm
# 7. Deploy to WHMCS test environment
# 8. Test in admin/client areas
# 9. Check error logs
# 10. Deploy to production
```

---

## 🎓 Learning Path

1. **Start**: Read `README.md` (you are here) - 5 min
2. **Learn**: Open `whmcs-skills-kit/guide/QUICK-START.md` - 5 min
3. **Setup**: Choose platform → Follow setup guide - 2-5 min
4. **Build**: Pick scenario from `EXAMPLES-AND-PROMPTS.md` - 5-15 min
5. **Validate**: Run `validate_module.py` - 1 min
6. **Debug**: Reference `TROUBLESHOOTING.md` if needed - varies
7. **Optimize**: Read `BEST-PRACTICES.md` for pro tips - optional

**Total Time to First Production Module**: ~30-40 minutes

---

## 💡 Pro Tips

1. **Load SKILL.md first** in every conversation
2. **Use module JSON files** for your specific task
3. **Validate early & often** - catch errors before deployment
4. **Save money with Gemini** - same quality, 1/10th cost
5. **Use Cursor for daily work**, Claude for complex features
6. **Batch process similar modules** with API platforms
7. **Keep TROUBLESHOOTING.md open** while building
8. **Study samples/** folder for real patterns

---

## 🆘 Support Resources

| Issue | Resource |
|-------|----------|
| Getting started | `whmcs-skills-kit/guide/QUICK-START.md` |
| Setup help | This file (README-MULTI-PLATFORM.md) |
| Code examples | `whmcs-skills-kit/guide/EXAMPLES-AND-PROMPTS.md` |
| Quick syntax | `whmcs-skills-kit/guide/CHEATSHEET.md` |
| Troubleshooting | `whmcs-skills-kit/guide/TROUBLESHOOTING.md` |
| Best practices | `whmcs-skills-kit/guide/BEST-PRACTICES.md` |
| WHMCS API reference | https://developers.whmcs.com/ |
| Claude API docs | https://docs.anthropic.com/ |
| Gemini API docs | https://ai.google.dev/ |

---

## ⚡ Next Steps

```bash
# Option 1: GitHub Copilot in VS Code (Recommend for beginners)
1. Install "GitHub Copilot" extension
2. Sign in with GitHub account
3. Open this project
4. In Copilot chat: "Create an addon module for [task]"
5. Use @whmcs-skills-kit/guide/SKILL.md

# Option 2: Claude API (Recommend for complex features)
1. Go to https://console.anthropic.com
2. Create API key
3. Read: CLAUDE-API-SETUP.md
4. Copy Python example code
5. Run: python3 script.py

# Option 3: Cursor IDE (Recommend for daily development)
1. Download and install https://cursor.com
2. Open this project folder
3. Start coding - SKILL.md loads automatically
4. In chat: ask anything about WHMCS

# Option 4: Google Gemini API (Recommend for cost-efficiency)
1. Go to https://makersuite.google.com/app/apikey
2. Create API key
3. Read: GEMINI-API-SETUP.md
4. Copy Python example
5. Run: python3 script.py
```

---

**Ready to build production-ready WHMCS modules 10x faster with AI?**

Pick your platform above and get started now! 🚀

---

**Version**: 1.0 (February 2026)  
**Compatible With**: WHMCS 8.x, 9.x | PHP 8.1+ | All Major AI Platforms  
**Support**: See links above
