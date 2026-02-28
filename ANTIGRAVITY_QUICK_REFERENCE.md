# Quick Reference: Antigravity IDE Setup

## How It Works

Antigravity IDE auto-loads skills from these paths **at startup** (no manual paste needed):

| Scope | Path |
|-------|------|
| **Global** | `~/.gemini/antigravity/skills/whmcs/SKILL.md` |
| **Workspace** | `<project>/.agent/skills/whmcs/SKILL.md` |

---

## ⚡ 60-Second Setup

```bash
# 1. Install globally (one time)
npx github:TheRabbiRifat/whmcs-skills install --agent antigravity

# 2. Restart Antigravity (Cmd/Ctrl + Shift + P → "Restart Agent")

# 3. Done! ✅
```

---

## Verify It Worked

After restarting, ask Antigravity:

```
Create a WHMCS action hook that logs when an invoice is paid.
Use Capsule ORM, strict types, and PSR-12.
```

✅ **Working** if the code uses `Capsule::table(...)`, `declare(strict_types=1)`, and type hints.

---

## Workspace-Specific Install

If you want the skill only for one project:

```bash
# From your WHMCS project root:
mkdir -p .agent/skills/whmcs
cp ~/.gemini/antigravity/skills/whmcs/SKILL.md .agent/skills/whmcs/SKILL.md
```

> **Already done**: The `whmcs-skills` repo itself ships a `.agent/skills/whmcs/SKILL.md`
> so opening the repo in Antigravity works with zero setup.

---

## Using Reference Files

Pass JSON reference files for deeper context:

```
@file:.gemini/antigravity/skills/whmcs/references/payment_gateways.json
Build a Stripe payment gateway module.
```

| File | Use for |
|------|---------|
| `references/api.json` | API call integrations |
| `references/hooks.json` | Action hook parameters |
| `references/addon_modules.json` | Addon module structure |
| `references/payment_gateways.json` | Payment gateway structure |

---

## Troubleshooting

### Skill not found/not loading
```bash
# Verify path exists:
ls ~/.gemini/antigravity/skills/whmcs/SKILL.md

# Restart Antigravity:
# Cmd/Ctrl + Shift + P → "Restart Agent"

# Re-install if needed:
npx github:TheRabbiRifat/whmcs-skills install --agent antigravity
```

### Generated code is old-style
- Verify SKILL.md has proper YAML frontmatter at the top (`name:` and `description:` fields)
- Try a prompt that explicitly mentions WHMCS module types
- Check the agent's reasoning trace (Cmd/Ctrl + Shift + P → "Show Agent Trace")

### Having issues?
Open an issue: [GitHub Issues](https://github.com/TheRabbiRifat/whmcs-skills/issues)

---

## Full Guide
→ [docs/setup/antigravity.md](docs/setup/antigravity.md)
