import path from 'node:path';

/**
 * Generic project agent — installs to ./ai-skills/whmcs (project-local)
 * @returns {string} Absolute destination path
 */
export function getDestination() {
  return path.join(process.cwd(), 'ai-skills', 'whmcs');
}
