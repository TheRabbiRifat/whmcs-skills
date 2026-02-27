# 🧠 WHMCS Dev Skills

<p align="center">
  <img src="banner.png" alt="WHMCS Dev Skills Banner" width="100%">
</p>

### AI Agent Skill for WHMCS Module Development

An industrial-grade skill file that turns any AI coding agent into a **Senior WHMCS Developer & Architect**.

[Quick Install](#-quick-install) • [What It Covers](#-what-it-covers) • [IDE Setup](#️-ide-setup-guides) • [Compatible Agents](#-compatible-agents) • [Contributing](#-contributing)

---

## ⚡ Quick Install

### One Command (Recommended)

```
npx ai-agent-skills install whmcs-dev-skills
```

That's it. The skill installs to the right location for your agent automatically.

#### Install for a Specific Agent

```bash
# Claude Code (default)
npx ai-agent-skills install whmcs-dev-skills

# Cursor IDE
npx ai-agent-skills install whmcs-dev-skills --agent cursor

# VS Code / GitHub Copilot
npx ai-agent-skills install whmcs-dev-skills --agent vscode

# Windsurf
npx ai-agent-skills install whmcs-dev-skills --agent windsurf

# Amp
npx ai-agent-skills install whmcs-dev-skills --agent amp

# Goose
npx ai-agent-skills install whmcs-dev-skills --agent goose

# OpenCode
npx ai-agent-skills install whmcs-dev-skills --agent opencode

# Any project (generic)
npx ai-agent-skills install whmcs-dev-skills --agent project
```

### Manual Install

```bash
# Clone the repository
git clone https://github.com/TheRabbiRifat/whmcs-skills.git

# Then copy to your agent's skills directory (see IDE Setup below)
```

---

## 📖 What Is This?

This repository contains a **SKILL.md** file — a comprehensive instruction set designed for AI coding agents. When loaded, it transforms the AI into a WHMCS expert that writes **production-ready, secure, and maintainable** code following WHMCS 8.x / 9.x best practices.

```
SKILL.md
```

The skill follows the [Agent Skills Specification](https://agentskills.io/specification) — the universal open standard for AI agent skills — making it compatible with every major AI coding agent.

---

## ✨ What It Covers

| Area | Examples |
|------|----------|
| `localAPI` | `GetClientsDetails`, `CreateInvoice`, `OpenTicket` |
| `GuzzleHTTP` | External API calls with proper error handling |
| `logModuleCall` | API debugging with credential scrubbing |
| `logActivity` | System activity logging best practices |
| `Capsule ORM` | All database operations, schema, migrations |
| `Smarty v4` | Templates, escaping, CSRF protection |

### Key Highlights

- 🔒 **Security-first** — Forces Capsule ORM, CSRF protection, credential scrubbing
- 🆕 **WHMCS 9.x ready** — Covers Smarty v4, Illuminate v9, PHP 8.2+ breaking changes
- 📋 **Production-ready code** — Every template is battle-tested, not hello-world
- ⚠️ **Anti-pattern protection** — 18+ real-world failures developers actually make
- 📁 **Proper structure** — Directory templates matching official WHMCS samples
- 🧩 **All module types** — Addon, Provisioning, Registrar, Payment Gateway, Mail Provider, Notification Provider
- 🐛 **Debugging guide** — Quick diagnosis checklist for common issues
- 📚 **765+ code samples** — Supplementary PHP examples across 12 categories

---

## 🤖 Compatible Agents

This skill works with every major AI coding agent that supports the [Agent Skills specification](https://agentskills.io):

| Agent | Skills Directory | Install Flag |
|-------|-----------------|--------------|
| Claude Code | `~/.claude/skills/` | `--agent claude` |
| GitHub Copilot | `.github/skills/` | `--agent vscode` |
| Cursor IDE | `.cursor/skills/` | `--agent cursor` |
| Windsurf | `.windsurf/skills/` | `--agent windsurf` |
| Amp | `~/.amp/skills/` | `--agent amp` |
| Goose | `~/.config/goose/skills/` | `--agent goose` |
| OpenCode | `~/.opencode/skills/` | `--agent opencode` |
| Generic | `.skills/` | `--agent project` |

---

## 🛠️ IDE Setup Guides

### Claude Code

```bash
# Option 1: npx (recommended)
npx ai-agent-skills install whmcs-dev-skills

# Option 2: Manual
mkdir -p ~/.claude/skills/whmcs-dev-skills
cp SKILL.md ~/.claude/skills/whmcs-dev-skills/
```

The skill is automatically available in all Claude Code sessions.

### GitHub Copilot (VS Code)

```bash
# Option 1: npx
npx ai-agent-skills install whmcs-dev-skills --agent vscode

# Option 2: Manual — As a skill file
mkdir -p .github/skills/whmcs-dev-skills
cp SKILL.md .github/skills/whmcs-dev-skills/

# Option 3: Manual — As copilot instructions
cp SKILL.md .github/copilot-instructions.md
```

> **Tip:** After adding the file, open VS Code, and Copilot will automatically apply these instructions to all suggestions in the repository.

### Cursor IDE

```bash
# Option 1: npx
npx ai-agent-skills install whmcs-dev-skills --agent cursor

# Option 2: Manual — Project-level (recommended)
mkdir -p .cursor/skills/whmcs-dev-skills
cp SKILL.md .cursor/skills/whmcs-dev-skills/

# Option 3: Manual — Global (applies to all projects)
mkdir -p ~/.cursor/skills/whmcs-dev-skills
cp SKILL.md ~/.cursor/skills/whmcs-dev-skills/

# Option 4: As a Cursor Rule (.mdc format)
mkdir -p .cursor/rules
cp SKILL.md .cursor/rules/whmcs-dev-skills.mdc
```

> **Tip:** You can also import directly via `Cursor Settings → Rules, Commands → Add Rule → Remote Rule (GitHub)` and point it to this repo.

### Windsurf (Codeium)

```bash
# Option 1: npx
npx ai-agent-skills install whmcs-dev-skills --agent windsurf

# Option 2: Manual — Project-level
mkdir -p .windsurf/rules
cp SKILL.md .windsurf/rules/whmcs-dev-skills.md

# Option 3: Manual — As project rules
cp SKILL.md .windsurfrules

# Option 4: Manual — Global rules
cat SKILL.md >> ~/.codeium/windsurf/memories/global_rules.md
```

### Gemini (Google AI)

```bash
# Project-level skill
mkdir -p .gemini/skills/whmcs-dev-skills
cp SKILL.md .gemini/skills/whmcs-dev-skills/

# Or as agent instructions
mkdir -p .agent/skills
cp SKILL.md .agent/skills/whmcs-dev-skills.md
```

### Amp

```bash
# Option 1: npx
npx ai-agent-skills install whmcs-dev-skills --agent amp

# Option 2: Manual
mkdir -p ~/.amp/skills/whmcs-dev-skills
cp SKILL.md ~/.amp/skills/whmcs-dev-skills/
```

### Any Other Agent

```bash
# Project-level (works with any agent)
mkdir -p .skills/whmcs-dev-skills
cp SKILL.md .skills/whmcs-dev-skills/
```

Or simply place the `SKILL.md` file in whatever directory your agent reads skill/instruction files from.

---

## 📁 Repository Structure

```
whmcs-dev-skills/
├── SKILL.md          # 📘 The comprehensive AI agent skill file (1600+ lines, 16 sections)
├── README.md         # 📖 This file — documentation & install guide
├── LICENSE           # ⚖️ GPL-2.0 License
├── banner.png        # 🎨 Repository banner image
├── .gitignore        # 🙈 Git ignore rules
│
├── docs/             # 📚 Supplementary documentation (architecture, patterns, examples)
├── guides/           # 📋 Detailed guides (best practices, cheatsheet, troubleshooting, AI integration)
├── references/       # 📖 JSON reference data (API, Hooks, Modules — 12 files)
└── samples/          # 💻 Real PHP code examples (765+ files across 12 categories)
```

> **Note:** The `SKILL.md` is **fully self-contained** — the supplementary directories (`docs/`, `guides/`, `references/`, `samples/`) provide additional detail for users who want deeper reference material but are **not required** for the skill to function.

---

## 🔬 Research-Backed

This skill file was built from deep research of:

- ✅ [WHMCS Official Developer Documentation](https://developers.whmcs.com/) — Every module type page
- ✅ [WHMCS GitHub Sample Modules](https://github.com/WHMCS) — All 5 official samples
- ✅ WHMCS 8.x → 9.x breaking changes — Smarty v4, Illuminate v9, PHP 8.2+
- ✅ Common developer issues from [WHMCS Community Forums](https://whmcs.community/)
- ✅ Security best practices and anti-patterns from real-world deployments
- ✅ [Agent Skills Specification](https://agentskills.io/specification) — Universal skill format

---

## ❓ FAQ

**Does this work with my AI agent?**
This skill follows the [Agent Skills Specification](https://agentskills.io), which is supported by Claude Code, GitHub Copilot, Cursor, Windsurf, Amp, Goose, OpenCode, and any agent that reads `SKILL.md` files.

**Do I need Node.js?**
Only if you use the `npx` install method. You can also manually copy the `SKILL.md` file to the appropriate directory for your agent.

**Will this modify my WHMCS installation?**
No! This skill file only provides instructions to your AI coding agent. It doesn't touch your WHMCS installation, database, or configuration in any way.

**Does it support WHMCS 9.x?**
Yes! The skill includes specific guidance for WHMCS 9.x breaking changes including Smarty v4, Illuminate v9, and PHP 8.2+ requirements.

**Can I use this commercially?**
Absolutely. The skill is GPL-2.0 licensed. Use it for personal, commercial, or open-source module development.

**Why not just use the WHMCS developer docs?**
This skill is specifically formatted for AI agents — it includes operational boundaries (ALWAYS/NEVER rules), anti-pattern protection, security checklists, and production-ready code templates that documentation alone doesn't provide. The AI uses this as a continuous reference while coding.

---

## 🤝 Contributing

Contributions are welcome! Whether it's fixing a typo, adding a new hook point, or documenting another anti-pattern:

1. Fork this repository
2. Create a feature branch: `git checkout -b feature/awesome-improvement`
3. Make your changes to `SKILL.md`
4. Commit: `git commit -m "feat: add awesome improvement"`
5. Push: `git push origin feature/awesome-improvement`
6. Open a Pull Request

### Contribution Ideas

- 📝 Add more WHMCS 9.x breaking changes as they're discovered
- 🪝 Document additional hook points with examples
- 🔒 Add more security best practices
- 🐛 Document common bugs and their fixes
- 🌍 Add non-English language file examples

---

## ⭐ Star History

If this skill saved you time building WHMCS modules, please give it a ⭐!

---

## 📄 License

This project is licensed under the [GNU GPL v2.0](LICENSE).

---

## 👤 Author

[🌐 therabbirifat.com](https://therabbirifat.com)
[🐙 @TheRabbiRifat](https://github.com/TheRabbiRifat)

Built with ❤️ for the WHMCS developer community · If this helped you, consider giving it a ⭐ on GitHub!
