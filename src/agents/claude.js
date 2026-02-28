import os from 'node:os';
import path from 'node:path';

/**
 * Claude Code agent — installs to ~/.ai-skills/whmcs
 * @returns {string} Absolute destination path
 */
export function getDestination() {
  return path.join(os.homedir(), '.ai-skills', 'whmcs');
}
