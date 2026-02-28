# Quick Reference: Antigravity IDE Setup

## How It Works

Antigravity IDE auto-loads skills from these paths **at startup** (no manual paste needed):

| Scope | Path |
|-------|------|
| **Global** | `~/.gemini/antigravity/skills/whmcs/SKILL.md` |
| **Workspace** | `<project>/.agent/skills/whmcs/SKILL.md` |

---

## 1-Minute Setup

```bash
npx github:TheRabbiRifat/whmcs-skills install --agent antigravity
```

Then **restart Antigravity**. The skill auto-loads. Done. ✅

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

### Skill not found
```bash
# Check path exists
ls ~/.gemini/antigravity/skills/whmcs/SKILL.md

# Re-install if missing
npx github:TheRabbiRifat/whmcs-skills install --agent antigravity
```
Then restart Antigravity.

### Old-style code generated
- Path might be wrong — check with `ls` above
- Make sure SKILL.md has YAML frontmatter at the top (`name:` / `description:`)

### Old incorrect path exists
```bash
rm -rf ~/.antigravity/skills  # Remove old/wrong path
```

---

## Full Guide
→ [docs/setup/antigravity.md](docs/setup/antigravity.md)
