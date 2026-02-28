import os from 'node:os';
import path from 'node:path';

/**
 * Jules agent — installs to ~/.jules/skills/whmcs
 * @returns {string} Absolute destination path
 */
export function getDestination() {
  return path.join(os.homedir(), '.jules', 'skills', 'whmcs');
}
