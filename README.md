# WHMCS Developer Documentation & AI Skills Kit
> The official developer documentation for WHMCS, supercharged for AI-assisted development.

Welcome to the WHMCS Developer Documentation repository. This resource serves two purposes:
1.  **Human Developers**: A reference for building Modules, Hooks, APIs, and Themes for WHMCS.
2.  **AI Agents**: A structured "Skills Kit" to empower AI coding assistants (Cursor, Windsurf, Copilot) with deep context about WHMCS internals.

---

## 🚀 WHMCS AI Skills Kit

Located in the [`whmcs-skills-kit/`](whmcs-skills-kit/) directory, this kit transforms static documentation into actionable intelligence for your AI agent.

### Features
*   **Modular Context**: Structured JSON files (`api.json`, `hooks.json`, `addon_modules.json`) allow AI to load only the specific knowledge needed for a task, saving tokens.
*   **Expert Persona**: The `guide/SKILL.md` acts as a system prompt, enforcing best practices, security standards (PSR-12, Capsule, Sanitization), and operational boundaries.
*   **Code Samples Library**: A collection of extracted, ready-to-use PHP snippets (`samples/`) for every module type.

### How to Use with AI Agents

1.  **Set the Persona**: Load [`whmcs-skills-kit/guide/SKILL.md`](whmcs-skills-kit/guide/SKILL.md) as your agent's system prompt or "Memory".
2.  **Load Context**: When working on a specific task, point the agent to the relevant module:
    *   *Building a Payment Gateway?* -> Load `whmcs-skills-kit/modules/payment_gateways.json`
    *   *Writing a Hook?* -> Load `whmcs-skills-kit/modules/hooks.json`
3.  **Reference Samples**: Ask the agent to "check the samples folder for configuration examples" to get boilerplate code.

---

## 📂 Documentation Structure

*   [`whmcs-skills-kit/`](whmcs-skills-kit/) - **Start Here for AI**. Contains the processed skills, manifest, and samples.
    *   `guide/` - The master skill guide / system prompt.
    *   `modules/` - JSON data files for API, Hooks, Provisioning, Addons, etc.
    *   `samples/` - Extracted PHP code snippets for quick reuse.
    *   `tools/` - Scripts used to generate this kit.
*   [`api-reference/`](api-reference/) - Source markdown for API commands.
*   [`hooks-reference/`](hooks-reference/) - Source markdown for Hook points.
*   [`modules/`](modules/) - Documentation for Module Development (Addons, Gateways, Registrars, Servers).
*   [`themes/`](themes/) - Theme development and template guides.

---

## 🤝 Contributing

We welcome contributions! Whether you're fixing a typo in the docs or improving the AI skills generation logic:

1.  **Fork** the repository.
2.  **Edit** the source markdown files (e.g., in `api-reference/`) or the generator tools in `whmcs-skills-kit/tools/`.
3.  **Run** the generator to update the skills kit: `python3 whmcs-skills-kit/tools/convert_docs_to_skills.py`
4.  **Test** your changes: `python3 whmcs-skills-kit/tools/test_skills_generation.py`
5.  **Submit** a Pull Request.

---

## 🔗 Resources

*   [WHMCS Official Website](https://www.whmcs.com/)
*   [Developer Documentation](https://developers.whmcs.com/)
*   [Community Forums](https://whmcs.community/)
*   [Contact Support](https://www.whmcs.com/support/)

---
*Built with ❤️ for the WHMCS Community.*
