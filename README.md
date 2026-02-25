# WHMCS Developer Documentation

This is the repository for the WHMCS Developer Documentation located at http://developers.whmcs.com/

We welcome you to create issues and submit pull requests for any suggestions, corrections and improvements you would like to see.

## WHMCS AI Skills Kit

This repository now includes a **WHMCS AI Skills Kit** designed to supercharge AI coding agents with deep, modular knowledge of WHMCS development.

Located in the [`whmcs-skills-kit/`](whmcs-skills-kit/) directory, this kit provides:

*   **Modular Knowledge Base**: Structured JSON files in `modules/` covering API, Hooks, Provisioning, Addons, and more. This allows AI agents to consume only the context they need, saving tokens.
*   **Expert Persona**: A comprehensive `SKILL.md` guide in `guide/` that defines operational boundaries, coding standards, and best practices for an AI acting as a Senior WHMCS Developer.
*   **Manifest**: A machine-readable `manifest.json` indexing all available skills.

### Usage for AI Agents

Point your AI agent (like Cursor, Windsurf, or custom LLM scripts) to the `whmcs-skills-kit/` directory.

1.  **System Prompt**: Load `whmcs-skills-kit/guide/SKILL.md` as the core system instruction.
2.  **Context Loading**: Based on the task (e.g., "Create a Provisioning Module"), the AI should load the corresponding JSON module (e.g., `whmcs-skills-kit/modules/provisioning_modules.json`) to get precise function signatures and parameters.

[WHMCS](http://www.whmcs.com/) | [Contact Support](https://www.whmcs.com/support/) | [WHMCS.Community](https://whmcs.community/)
