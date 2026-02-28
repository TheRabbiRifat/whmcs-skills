import os from 'node:os';
import path from 'node:path';

/**
 * Antigravity (Google DeepMind VS Code fork) agent.
 *
 * Antigravity auto-scans TWO skill locations:
 *   Global  → ~/.gemini/antigravity/skills/<skill-name>/SKILL.md
 *   Project → <workspace-root>/.agent/skills/<skill-name>/SKILL.md
 *
 * This installer targets the GLOBAL path so the skill is available
 * in every project without any manual copy-paste step.
 *
 * @returns {string} Absolute destination path
 */
export function getDestination() {
  return path.join(os.homedir(), '.gemini', 'antigravity', 'skills', 'whmcs');
}
