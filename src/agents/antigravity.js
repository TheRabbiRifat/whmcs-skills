import os from 'node:os';
import path from 'node:path';

/**
 * Antigravity agent — installs to ~/.antigravity/skills/whmcs
 * @returns {string} Absolute destination path
 */
export function getDestination() {
  return path.join(os.homedir(), '.antigravity', 'skills', 'whmcs');
}
