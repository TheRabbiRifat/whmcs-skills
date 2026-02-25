import os
import re
import json

def parse_markdown_table(table_text):
    """
    Parses a markdown table into a list of dictionaries.
    Assumes standard markdown table format.
    """
    lines = table_text.strip().split('\n')
    if len(lines) < 3:
        return []

    # Parse headers
    header_line = lines[0]
    headers = [h.strip() for h in header_line.split('|') if h.strip()]

    # Check separator line
    separator_line = lines[1]
    if not all(c in '|-: ' for c in separator_line):
        pass

    rows = []
    for line in lines[2:]:
        if not line.strip():
            continue
        cells = [c.strip() for c in line.split('|')[1:-1]]

        if len(cells) == len(headers):
            rows.append(dict(zip(headers, cells)))
        elif len(cells) > len(headers):
            rows.append(dict(zip(headers, cells[:len(headers)])))
        else:
            padded_cells = cells + [""] * (len(headers) - len(cells))
            rows.append(dict(zip(headers, padded_cells)))

    return rows

def parse_api_file(filepath):
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
    except Exception as e:
        print(f"Error reading {filepath}: {e}")
        return None

    title_match = re.search(r'^title\s*=\s*"([^"]+)"', content, re.MULTILINE)
    name = title_match.group(1) if title_match else os.path.basename(filepath).replace('.md', '')

    body = content
    if content.startswith('+++'):
        parts = content.split('+++', 2)
        if len(parts) >= 3:
            body = parts[2].strip()

    lines = body.split('\n')
    description = ""
    for line in lines:
        line = line.strip()
        if line and not line.startswith('#'):
            description = line
            break

    params_match = re.search(r'###\s*Request Parameters\s*(.*?)(?=\n###|\n##|$)', body, re.DOTALL)
    parameters = []
    if params_match:
        parameters = parse_markdown_table(params_match.group(1))

    return {
        "type": "api_command",
        "name": name,
        "description": description,
        "parameters": parameters,
        "source_file": filepath
    }

def parse_hooks_file(filepath):
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
    except Exception as e:
        print(f"Error reading {filepath}: {e}")
        return []

    body = content
    if content.startswith('+++'):
        parts = content.split('+++', 2)
        if len(parts) >= 3:
            body = parts[2].strip()

    sections = re.split(r'\n##\s+', '\n' + body)

    hooks = []
    for section in sections:
        if not section.strip():
            continue

        lines = section.strip().split('\n')
        header = lines[0].strip()

        if ' ' in header:
            pass

        name = header

        desc_lines = []
        for line in lines[1:]:
            if line.strip().startswith('#'):
                break
            if line.strip():
                desc_lines.append(line.strip())
        description = " ".join(desc_lines)

        params_match = re.search(r'####\s*Parameters\s*(.*?)(?=\n####|\n###|$)', section, re.DOTALL)
        parameters = []
        if params_match:
            parameters = parse_markdown_table(params_match.group(1))

        if parameters or (name and " " not in name and len(name) > 3):
             hooks.append({
                "type": "hook",
                "name": name,
                "description": description,
                "parameters": parameters,
                "source_file": filepath
            })

    return hooks

def main():
    api_skills = []
    hook_skills = []

    # 1. API Reference
    api_dir = 'api-reference'
    if os.path.isdir(api_dir):
        print(f"Scanning {api_dir}...")
        for filename in sorted(os.listdir(api_dir)):
            if filename.endswith('.md') and filename != 'index.md':
                filepath = os.path.join(api_dir, filename)
                skill = parse_api_file(filepath)
                if skill:
                    # Save individual JSON
                    json_filename = filename.replace('.md', '.json')
                    json_filepath = os.path.join(api_dir, json_filename)
                    with open(json_filepath, 'w', encoding='utf-8') as f:
                        json.dump(skill, f, indent=2)

                    api_skills.append({
                        "name": skill['name'],
                        "path": json_filepath,
                        "description": skill['description']
                    })

    # 2. Hooks Reference
    hooks_dir = 'hooks-reference'
    if os.path.isdir(hooks_dir):
        print(f"Scanning {hooks_dir}...")
        for filename in sorted(os.listdir(hooks_dir)):
            if filename.endswith('.md') and filename != 'index.md':
                filepath = os.path.join(hooks_dir, filename)
                skills = parse_hooks_file(filepath)
                if skills:
                    # Save individual JSON containing list of hooks
                    json_filename = filename.replace('.md', '.json')
                    json_filepath = os.path.join(hooks_dir, json_filename)
                    with open(json_filepath, 'w', encoding='utf-8') as f:
                        json.dump(skills, f, indent=2)

                    for s in skills:
                        hook_skills.append({
                            "name": s['name'],
                            "path": json_filepath,
                            "description": s['description']
                        })

    # Generate Master Skills Index (Markdown)
    with open('skills.md', 'w', encoding='utf-8') as f:
        f.write("# WHMCS AI Agent Skills Index\n\n")

        f.write("## API Commands\n\n")
        f.write("| Command | Description | Definition |\n")
        f.write("| --- | --- | --- |\n")
        for skill in api_skills:
            # Markdown link to local file
            link = f"[{skill['name']}]({skill['path']})"
            desc = skill['description'][:100].replace('\n', ' ') + "..." if len(skill['description']) > 100 else skill['description']
            f.write(f"| {skill['name']} | {desc} | {link} |\n")

        f.write("\n## Hooks\n\n")
        f.write("| Hook | Description | Definition |\n")
        f.write("| --- | --- | --- |\n")
        for skill in hook_skills:
            link = f"[{skill['name']}]({skill['path']})"
            desc = skill['description'][:100].replace('\n', ' ') + "..." if len(skill['description']) > 100 else skill['description']
            f.write(f"| {skill['name']} | {desc} | {link} |\n")

    print(f"Generated skills.md with {len(api_skills)} API commands and {len(hook_skills)} Hooks.")

if __name__ == "__main__":
    main()
