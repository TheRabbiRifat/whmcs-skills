import os from 'node:os';
import path from 'node:path';

/**
 * Cursor IDE agent — installs to ~/.cursor/skills/whmcs
 * @returns {string} Absolute destination path
 */
export function getDestination() {
  return path.join(os.homedir(), '.cursor', 'skills', 'whmcs');
}
