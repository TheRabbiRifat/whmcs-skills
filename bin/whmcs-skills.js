#!/usr/bin/env node

import { Command } from 'commander';
import { install } from '../src/install.js';

const program = new Command();

program
  .name('whmcs-skills')
  .description('Install WHMCS AI development skills for your coding agent')
  .version('0.1.0');

program
  .command('install')
  .description('Install WHMCS skills to the target agent\'s skills directory')
  .option('--agent <agent>', 'Target AI agent (claude, cursor, vscode, jules, antigravity, project)', 'claude')
  .action(async (options) => {
    try {
      await install(options.agent);
    } catch (err) {
      console.error(`\n✖ ${err.message}\n`);
      process.exit(1);
    }
  });

program.parse();
