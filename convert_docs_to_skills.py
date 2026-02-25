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
        # Maybe no separator? Unlikely in standard md but possible.
        pass

    rows = []
    for line in lines[2:]:
        if not line.strip():
            continue
        # Split by pipe, but handle potential escaped pipes? (Simplification: just split)
        cells = [c.strip() for c in line.split('|')[1:-1]]

        # Create dict if cell count matches header count
        if len(cells) == len(headers):
            rows.append(dict(zip(headers, cells)))
        elif len(cells) > len(headers):
             # Try to fit
            rows.append(dict(zip(headers, cells[:len(headers)])))
        else:
            # Pad with empty strings
            padded_cells = cells + [""] * (len(headers) - len(cells))
            rows.append(dict(zip(headers, padded_cells)))

    return rows

def parse_api_file(filepath):
    """
    Parses an API reference markdown file to extract command info.
    """
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
    except Exception as e:
        print(f"Error reading {filepath}: {e}")
        return None

    # Extract Title (API Command Name)
    # Check frontmatter first
    title_match = re.search(r'^title\s*=\s*"([^"]+)"', content, re.MULTILINE)
    name = title_match.group(1) if title_match else os.path.basename(filepath).replace('.md', '')

    # Remove frontmatter for body processing
    body = content
    if content.startswith('+++'):
        parts = content.split('+++', 2)
        if len(parts) >= 3:
            body = parts[2].strip()

    # Extract Description
    # Usually the first paragraph after title/frontmatter
    # Find first non-empty line that isn't a header
    lines = body.split('\n')
    description = ""
    for line in lines:
        line = line.strip()
        if line and not line.startswith('#'):
            description = line
            break

    # Extract Request Parameters Table
    # Look for "Request Parameters" header
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
    """
    Parses a Hooks reference markdown file to extract hook info.
    Each file might contain multiple hooks (H2 headers).
    """
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
    except Exception as e:
        print(f"Error reading {filepath}: {e}")
        return []

    # Remove frontmatter
    body = content
    if content.startswith('+++'):
        parts = content.split('+++', 2)
        if len(parts) >= 3:
            body = parts[2].strip()

    # Split by H2 headers (## HookName)
    # Using re.split with capturing group to keep the delimiters (headers)
    # But re.split consumes the delimiter. Better to find all H2 positions.

    # Simple approach: split by `\n## `
    sections = re.split(r'\n##\s+', '\n' + body) # Prepend \n to match first header if at start

    hooks = []
    for section in sections:
        if not section.strip():
            continue

        lines = section.strip().split('\n')
        header = lines[0].strip()

        # Check if header looks like a Hook Name (e.g. CamelCase, no spaces usually)
        # Some headers might be "Introduction" or something else.
        # WHMCS hooks usually don't have spaces.
        if ' ' in header:
            # Maybe skipping sections like "Introduction" or "Example Code" if they are H2
            # But in hooks-reference/client.md, H2 are hooks.
            # Let's assume if it has a Parameters table, it's a hook.
            pass

        name = header

        # Extract Description
        # Text between header and next sub-header (### or ####)
        desc_lines = []
        for line in lines[1:]:
            if line.strip().startswith('#'):
                break
            if line.strip():
                desc_lines.append(line.strip())
        description = " ".join(desc_lines)

        # Extract Parameters Table
        # Look for "Parameters" or "Variables" header (usually #### Parameters)
        params_match = re.search(r'####\s*Parameters\s*(.*?)(?=\n####|\n###|$)', section, re.DOTALL)
        parameters = []
        if params_match:
            parameters = parse_markdown_table(params_match.group(1))

        # Only add if it looks like a hook (has parameters or valid name)
        # Filter out "Introduction" sections if they don't have params
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
    all_skills = []

    # 1. API Reference
    api_dir = 'api-reference'
    if os.path.isdir(api_dir):
        print(f"Scanning {api_dir}...")
        for filename in sorted(os.listdir(api_dir)):
            if filename.endswith('.md') and filename != 'index.md':
                filepath = os.path.join(api_dir, filename)
                skill = parse_api_file(filepath)
                if skill:
                    all_skills.append(skill)

    # 2. Hooks Reference
    hooks_dir = 'hooks-reference'
    if os.path.isdir(hooks_dir):
        print(f"Scanning {hooks_dir}...")
        for filename in sorted(os.listdir(hooks_dir)):
            if filename.endswith('.md') and filename != 'index.md':
                filepath = os.path.join(hooks_dir, filename)
                skills = parse_hooks_file(filepath)
                all_skills.extend(skills)

    # Output to JSON
    output_file = 'whmcs_skills.json'
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(all_skills, f, indent=2)

    print(f"Successfully generated {output_file} with {len(all_skills)} skills.")

if __name__ == "__main__":
    main()
