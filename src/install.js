import path from 'node:path';
import { fileURLToPath } from 'node:url';
import fs from 'fs-extra';

// Resolve the repository root (one level up from src/)
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const REPO_ROOT = path.resolve(__dirname, '..');

// Dynamically import the correct agent config
const SUPPORTED_AGENTS = ['claude', 'cursor', 'vscode', 'jules', 'antigravity', 'project'];

/**
 * Content items to copy from the repo root into the agent's skill directory.
 * Each entry is a relative path from the repo root.
 * Files are copied directly; directories are copied recursively.
 */
const CONTENT_ITEMS = [
  'SKILL.md',
  'docs',
  'guides',
  'references',
  'samples',
];

/**
 * Install WHMCS skills for the specified agent.
 * @param {string} agentName
 */
export async function install(agentName) {
  const agent = agentName.toLowerCase().trim();

  if (!SUPPORTED_AGENTS.includes(agent)) {
    throw new Error(
      `Unknown agent "${agent}". Supported agents: ${SUPPORTED_AGENTS.join(', ')}`
    );
  }

  // Dynamically load the agent module to get the destination path
  const agentModule = await import(`./agents/${agent}.js`);
  const destDir = agentModule.getDestination();

  // Ensure destination exists
  await fs.ensureDir(destDir);

  // Copy each content item
  for (const item of CONTENT_ITEMS) {
    const src = path.join(REPO_ROOT, item);
    const dest = path.join(destDir, item);

    // Skip items that don't exist in the repo (graceful)
    if (!(await fs.pathExists(src))) {
      continue;
    }

    const stat = await fs.stat(src);

    if (stat.isDirectory()) {
      await fs.copy(src, dest, { overwrite: true });
    } else {
      await fs.copy(src, dest, { overwrite: true });
    }
  }

  console.log(`\n✔ WHMCS skills installed for agent: ${agent}`);
  console.log(`  → ${destDir}`);
  printAgentNote(agent, destDir);
}

/**
 * Print agent-specific post-install instructions.
 * @param {string} agent
 * @param {string} destDir
 */
function printAgentNote(agent, destDir) {
  const notes = {
    antigravity: [
      '',
      '✅ Antigravity auto-loads skills from this global directory.',
      '   No manual configuration is required — the skill is active immediately.',
      '',
      '   The skill folder must contain SKILL.md with YAML frontmatter (name + description).',
      '   This installer copies SKILL.md with the correct frontmatter already in place.',
      '',
      '   Tip: For project-specific skills, copy the whmcs/ folder to:',
      '        <your-project>/.agent/skills/whmcs/',
    ],
    claude: [
      '',
      '   Add the skill to your Claude project system prompt, or reference',
      `   ${destDir}/SKILL.md in your conversation context.`,
    ],
    cursor: [
      '',
      '   Reference the skill in your .cursorrules or via @SKILL.md in chat.',
    ],
    vscode: [
      '',
      '   Reference files in .vscode/ai-skills/whmcs/ via @file: mentions in Copilot Chat.',
    ],
    jules: [
      '',
      '   Add the skill directory to your Jules agent configuration.',
    ],
    project: [
      '',
      '   Skill files are ready in the project directory.',
      '   Reference SKILL.md in your agent prompt or instructions file.',
    ],
  };

  const lines = notes[agent] ?? [];
  for (const line of lines) {
    console.log(line);
  }
  console.log('');
}
