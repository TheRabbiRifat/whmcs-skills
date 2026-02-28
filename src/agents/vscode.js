import path from 'node:path';

/**
 * VS Code / GitHub Copilot agent — installs to ./.vscode/ai-skills/whmcs (project-local)
 * @returns {string} Absolute destination path
 */
export function getDestination() {
  return path.join(process.cwd(), '.vscode', 'ai-skills', 'whmcs');
}
