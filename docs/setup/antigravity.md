# Antigravity IDE Setup Guide

**Last Updated**: February 28, 2026  
**Skill Version**: 4.0.0

---

## How Antigravity Loads Skills

Antigravity IDE (by Google DeepMind) auto-scans **two** locations for skills at startup:

| Scope | Path | When to use |
|-------|------|-------------|
| **Global** | `~/.gemini/antigravity/skills/<skill-name>/SKILL.md` | Available in all projects |
| **Workspace** | `<project-root>/.agent/skills/<skill-name>/SKILL.md` | Project-specific skills |

Each skill folder must contain a `SKILL.md` file with YAML frontmatter (`name` + `description` fields).  
The WHMCS skill's `SKILL.md` already has the correct frontmatter — no edits needed.

> **Note**: The path `~/.antigravity/skills/` does **not** exist and is **not** scanned.  
> The correct global path is `~/.gemini/antigravity/skills/`.

---

## Installation

### Option A — Global Install (Recommended)

Installs to `~/.gemini/antigravity/skills/whmcs/` so the skill is available in every project:

```bash
npx github:TheRabbiRifat/whmcs-skills install --agent antigravity
```

**What this does:**
- Creates `~/.gemini/antigravity/skills/whmcs/`
- Copies `SKILL.md`, `docs/`, `guides/`, `references/`, `samples/`
- Antigravity picks it up automatically on the next restart

✅ **No manual configuration required.** Restart Antigravity after running the command.

---

### Option B — Workspace Install (Project-Specific)

If you want the skill only for a specific WHMCS project, copy the skill folder into that project:

```bash
# From inside your WHMCS project directory:
npx github:TheRabbiRifat/whmcs-skills install --agent project
mkdir -p .agent/skills
cp -r ~/.gemini/antigravity/skills/whmcs .agent/skills/whmcs
```

Or manually clone and copy:

```bash
git clone https://github.com/TheRabbiRifat/whmcs-skills.git /tmp/whmcs-skills
mkdir -p .agent/skills/whmcs
cp /tmp/whmcs-skills/SKILL.md .agent/skills/whmcs/SKILL.md
```

> **Bonus**: If you open *this* repository (`TheRabbiRifat/whmcs-skills`) directly in Antigravity,
> the skill is already pre-loaded from `.agent/skills/whmcs/SKILL.md` — no install step needed.

---

## Verification

After restarting Antigravity, test with this prompt:

```
Create a simple WHMCS action hook that logs when an invoice is marked as paid.
Include Capsule ORM, type hints, and PSR-12 formatting.
```

✅ **Skill is working** if the generated code:
- Uses `Illuminate\Database\Capsule\Manager` (not raw SQL)
- Has `declare(strict_types=1)` at the top
- Has type-hinted function parameters
- Follows PSR-2/PSR-12 style

---

## File Structure After Install

```
~/.gemini/antigravity/skills/
└── whmcs/
    ├── SKILL.md              ← Auto-loaded by Antigravity (YAML frontmatter inside)
    ├── docs/                 ← Architecture docs
    ├── guides/               ← Integration guides
    ├── references/           ← JSON module references (api, hooks, addon_modules, etc.)
    └── samples/              ← Real PHP code samples
```

---

## Using Reference Files in Prompts

Once the skill is loaded, reference specific files for deeper context:

```
@.gemini/antigravity/skills/whmcs/references/payment_gateways.json

Build a Stripe payment gateway module. Use the function signatures above.
```

```
@.gemini/antigravity/skills/whmcs/references/hooks.json

Show me all available invoice hooks and their parameters.
```

---

## Troubleshooting

### "Skill not found / AI generates old-style code"

1. Confirm the path exists:
   ```bash
   ls ~/.gemini/antigravity/skills/whmcs/SKILL.md
   ```
2. Re-run the installer if the file is missing:
   ```bash
   npx github:TheRabbiRifat/whmcs-skills install --agent antigravity
   ```
3. **Restart Antigravity** — skills are scanned at startup, not live-reloaded.
4. Verify `SKILL.md` has the YAML frontmatter block (`name:` and `description:` fields at the top).

### "The installer shows a different path"

The installer uses the global path `~/.gemini/antigravity/skills/whmcs/`.  
If you see `~/.antigravity/skills/whmcs/` — that was the old incorrect path.  
Delete it and re-run the installer to fix it:

```bash
# Remove old incorrect path (if it exists)
rm -rf ~/.antigravity/skills/whmcs

# Re-install to the correct path
npx github:TheRabbiRifat/whmcs-skills install --agent antigravity
```

### "I get an ENOENT or permission error on Windows"

The `~` tilde expands to `C:\Users\<YourName>` on Windows. Run:

```powershell
# Check if files are there
ls "$env:USERPROFILE\.gemini\antigravity\skills\whmcs\SKILL.md"

# Re-run install if missing
npx github:TheRabbiRifat/whmcs-skills install --agent antigravity
```

---

## Next Steps

- **Quick Start**: [guides/QUICK-START.md](../../guides/QUICK-START.md)
- **Best Practices**: [guides/BEST-PRACTICES.md](../../guides/BEST-PRACTICES.md)
- **Code Examples**: [samples/](../../samples/)
- **Full Integration Guide**: [guides/AI-INTEGRATION.md](../../guides/AI-INTEGRATION.md)
- **GitHub Issues**: [Report a bug](https://github.com/TheRabbiRifat/whmcs-skills/issues)
