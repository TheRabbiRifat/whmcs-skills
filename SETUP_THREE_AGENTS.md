# Setup Guide: Claude, VS Code, and Antigravity

**Quick Reference for the Three Main AI Agents**

This guide covers setup for:
1. **Claude Code** (Web) — Claude API access
2. **VS Code** (GitHub Copilot) — VS Code extension
3. **Antigravity** (Google) — Antigravity IDE

---

## 📊 Quick Comparison

| Feature | Claude Code | VS Code | Antigravity |
|---------|-------------|---------|-------------|
| **Type** | Web IDE | Code Editor + Extension | IDE |
| **Install Path** | `~/.ai-skills/whmcs/` | `.vscode/ai-skills/whmcs/` | `~/.gemini/antigravity/skills/whmcs/` |
| **Auto-loads** | Yes | Yes | Yes (on restart) |
| **Scope** | Global (all sessions) | Project-local | Global or project |
| **Setup Time** | 1 minute | 2 minutes | 1 minute |
| **Manual Paste** | Not needed | Not needed | Not needed |

---

## 1. Claude Code Setup

**Platform**: [claude.ai](https://claude.ai)  
**Type**: Global (works across all Claude projects)

### Installation

```bash
# Automated (recommended)
npx github:TheRabbiRifat/whmcs-skills install --agent claude

# Manual
mkdir -p ~/.ai-skills/whmcs
cp SKILL.md ~/.ai-skills/whmcs/
```

### How It Works

- Installs to `~/.ai-skills/whmcs/` (global location)
- Skill automatically loads in **all Claude Code sessions**
- No restart needed
- No configuration required

### Usage

Start a Claude Code session and ask:

```
@SKILL.md

Create a WHMCS payment gateway module for Stripe.
Include error handling and logging.
```

Or reference files:

```
@SKILL.md
@file:references/payment_gateways.json

Build a complete payment gateway following the JSON specification.
```

### Verification

After installation, test with:

```
Write a WHMCS addon module that adds a dashboard widget.
Use Capsule ORM, type hints, and PSR-12 formatting.
```

✅ Success if code includes: `Capsule::table(...)`, `declare(strict_types=1)`, type hints

### Quick Tips

- Use `@SKILL.md` to reference the main skill file
- Use `@file:references/<filename>` for specific module types
- Include `samples/` paths for code examples
- Skill is available in every Claude Code session automatically

---

## 2. VS Code (GitHub Copilot) Setup

**Platform**: VS Code with GitHub Copilot extension  
**Type**: Project-local (one project at a time)

### Installation

```bash
# Automated (recommended)
npx github:TheRabbiRifat/whmcs-skills install --agent vscode

# Manual
mkdir -p .vscode/ai-skills/whmcs
cp SKILL.md .vscode/ai-skills/whmcs/

# Alternative: As Copilot instructions
mkdir -p .github
cp SKILL.md .github/copilot-instructions.md
```

### How It Works

- Installs to `.vscode/ai-skills/whmcs/` (project-local)
- Skill loads automatically in **Copilot Chat** for that workspace
- Works across all files in the project
- Version-controlled (check into git)

### Usage in Copilot Chat

**Method 1: File references**
```
@file:.vscode/ai-skills/whmcs/SKILL.md
@file:.vscode/ai-skills/whmcs/references/hooks.json

Create an action hook that logs when an invoice is paid.
```

**Method 2: Slash commands**
```
/ask Create a WHMCS provisioning module
```

**Method 3: Inline chat (Ctrl/Cmd+K)**
```
Follow .vscode/ai-skills/whmcs/SKILL.md and create a payment gateway.
```

### Workspace Settings (Optional)

Create `.vscode/settings.json`:

```json
{
  "github.copilot.enable": {
    "*": true,
    "plaintext": false,
    "markdown": false
  }
}
```

Create `.vscode/prompt.md`:

```markdown
# WHMCS Development

Reference: SKILL.md in .vscode/ai-skills/whmcs/

When generating code:
- Load the skill file first
- Check _vendor/whmcs/ structure
- Validate against security checklist (SKILL.md Section 9)
- Use Capsule ORM, not raw SQL
```

### Verification

Test in Copilot Chat:

```
@file:.vscode/ai-skills/whmcs/SKILL.md

Show me how to create a WHMCS hook.
```

✅ Success if response references SKILL.md content and WHMCS patterns

### Quick Tips

- Link to `.vscode/ai-skills/whmcs/SKILL.md` in prompts
- Commit to git so teammates get the same skill
- Use reference JSON files for specific module types
- Copilot will auto-complete when it recognizes WHMCS context

---

## 3. Antigravity Setup

**Platform**: [Google Antigravity IDE](https://gemini.google.com/)  
**Type**: Global or workspace (auto-scans both)

### Installation

```bash
# Automated (recommended) — global install
npx github:TheRabbiRifat/whmcs-skills install --agent antigravity

# Manual — workspace install
mkdir -p .agent/skills/whmcs
cp SKILL.md .agent/skills/whmcs/
```

### How It Works

**Global Install** → `~/.gemini/antigravity/skills/whmcs/`
- Available in **all projects**
- Antigravity scans this directory on startup
- One-time setup

**Workspace Install** → `.agent/skills/whmcs/`
- Available in **this project only**
- Version-controlled
- No manual configuration needed

### Usage in Antigravity

After installation, **restart Antigravity**:
- Press `Cmd/Ctrl + Shift + P`
- Type "Restart Agent"
- Select and run

Then ask:

```
Create a WHMCS payment gateway module.
```

Antigravity will automatically detect and load the skill.

For reference files:

```
@file:~/.gemini/antigravity/skills/whmcs/references/hooks.json

Show me invoice-related hooks.
```

Or in workspace:

```
@file:.agent/skills/whmcs/references/addon_modules.json

Create an addon module following this structure.
```

### How Antigravity Finds Skills

1. **Scans** `~/.gemini/antigravity/skills/` (global)
2. **Scans** `.agent/skills/` (workspace)
3. **Reads** YAML frontmatter from `SKILL.md`
4. **Matches** user prompt to skill `description` field
5. **Loads** skill context automatically

**Key**: Description field must have keywords matching your task.

### Verification

Test after restart:

```
Create a WHMCS action hook that logs client password changes.
```

✅ Success if:
- Antigravity recognizes WHMCS context
- Generated code uses Capsule ORM
- Includes type hints and error handling
- Follows PSR-12 formatting

### Troubleshooting

**"Skill not loading"**
```bash
# Verify path exists
ls ~/.gemini/antigravity/skills/whmcs/SKILL.md

# Restart Antigravity
# Cmd/Ctrl + Shift + P → "Restart Agent"
```

**"Old-style code generated"**
- Check Antigravity agent trace (Cmd/Ctrl + Shift + P → "Show Agent Trace")
- Verify SKILL.md starts with YAML frontmatter (`name:`, `description:`)
- Try a prompt mentioning a specific WHMCS module type

### Quick Tips

- Global install works everywhere; workspace install is project-specific
- Always **restart Antigravity** after installing
- Use `@file:` to reference specific JSON or skill files
- Description field acts as semantic trigger (what skills to load)

---

## Side-by-Side: When to Use Each

### Use Claude Code When:
- Building complex WHMCS architecture
- Need deep reasoning across multiple files
- Working with API integrations
- Want persistent skill across all projects
- Benefit from Claude's extended context window

### Use VS Code When:
- Working in a team (skill in git)
- Building within existing VS Code project
- Want project-specific customization
- Need Copilot's quick suggestions
- Integrating with VS Code extensions

### Use Antigravity When:
- Need a dedicated IDE experience
- Want automatic skill detection
- Building with Google's AI stack
- Prefer workspace scoping
- Need workspace-local skills

---

## Installation Side-by-Side

Run all three for complete WHMCS AI coverage:

```bash
# Install for Claude
npx github:TheRabbiRifat/whmcs-skills install --agent claude

# Install for VS Code (in your project)
npx github:TheRabbiRifat/whmcs-skills install --agent vscode

# Install for Antigravity
npx github:TheRabbiRifat/whmcs-skills install --agent antigravity
```

Then:
1. Claude Code automatically loads the skill
2. VS Code Copilot discovers `.vscode/ai-skills/whmcs/`
3. Antigravity scans and loads on restart

---

## File Paths Reference

```
After installation, you'll have:

~/.ai-skills/whmcs/              (Claude Code — global)
  ├── SKILL.md
  ├── guides/
  ├── references/
  └── samples/

~/.gemini/antigravity/skills/whmcs/   (Antigravity — global)
  ├── SKILL.md
  ├── guides/
  ├── references/
  └── samples/

.vscode/ai-skills/whmcs/         (VS Code — project-local)
  ├── SKILL.md
  ├── guides/
  ├── references/
  └── samples/

.agent/skills/whmcs/             (Antigravity — project-local)
  └── SKILL.md
```

---

## Quick Test Commands

### Claude Code
```
@SKILL.md
Create a hook for invoice payments with Capsule ORM.
```

### VS Code
```
@file:.vscode/ai-skills/whmcs/SKILL.md

Generate a payment gateway module.
```

### Antigravity
(After restart)
```
Build a WHMCS provisioning module.
```

All three should generate production-ready WHMCS code following modern standards.

---

## Support & Next Steps

- **Full Setup Guides**: [docs/setup/](../docs/setup/)
- **Integration Guide**: [guides/AI-INTEGRATION.md](../guides/AI-INTEGRATION.md)
- **Quick Start**: [guides/QUICK-START.md](../guides/QUICK-START.md)
- **Best Practices**: [guides/BEST-PRACTICES.md](../guides/BEST-PRACTICES.md)
- **Issues**: [GitHub Issues](https://github.com/TheRabbiRifat/whmcs-skills/issues)

---

**Version**: 4.0.0  
**Last Updated**: February 28, 2026  
**Status**: ✅ Production Ready
