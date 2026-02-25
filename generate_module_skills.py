import os
import re
import json

SKILLS_DIR = "skills"
if not os.path.exists(SKILLS_DIR):
    os.makedirs(SKILLS_DIR)

def parse_markdown_table(file_path):
    """
    Parses a markdown table from a file.
    Assumes the first table found is the one to parse.
    Returns a list of dictionaries with column headers as keys.
    """
    if not os.path.exists(file_path):
        return []

    with open(file_path, "r", encoding="utf-8") as f:
        lines = f.readlines()

    headers = []
    parsed_data = []
    in_table = False

    for i, line in enumerate(lines):
        line = line.strip()
        if not line:
            in_table = False
            continue

        if "|" in line:
            # check if it is a separator line
            if re.match(r'^\|?[-:| ]+\|?$', line):
                continue

            # extract cells
            cells = [c.strip() for c in line.split('|')]
            # remove empty start/end cells if they exist due to leading/trailing pipes
            if line.startswith('|'):
                cells = cells[1:]
            if line.endswith('|'):
                cells = cells[:-1]

            if not headers:
                headers = cells
                in_table = True
            elif in_table:
                # Merge if number of cells matches, or best effort
                # Sometimes description has pipes, simpler split might fail.
                # But for now assume simple split is enough for this doc.
                if len(cells) == len(headers):
                    parsed_data.append(dict(zip(headers, cells)))
                elif len(cells) > len(headers):
                     # combine extra cells into the last column
                     last_col = " | ".join(cells[len(headers)-1:])
                     row_data = cells[:len(headers)-1] + [last_col]
                     parsed_data.append(dict(zip(headers, row_data)))
                else:
                    # Partial row?
                    pass
        else:
            in_table = False

    return parsed_data

def parse_markdown_sections(file_path):
    """
    Parses markdown sections starting with H2 headers (##).
    Returns a dictionary where keys are section titles and values are content.
    """
    if not os.path.exists(file_path):
        return {}

    with open(file_path, "r", encoding="utf-8") as f:
        content = f.read()

    sections = {}
    current_section = None
    current_content = []

    for line in content.split('\n'):
        match = re.match(r'^##\s+(.+?)(?:\s*<a.*>)?$', line)
        if match:
            if current_section:
                sections[current_section] = '\n'.join(current_content).strip()
            current_section = match.group(1).strip()
            current_content = []
        elif current_section:
            current_content.append(line)

    if current_section:
        sections[current_section] = '\n'.join(current_content).strip()

    return sections

def generate_provisioning_skills():
    print("Generating Provisioning Module skills...")

    # 1. Parse Parameters
    params_file = "provisioning-modules/module-parameters.md"
    params = parse_markdown_table(params_file)

    # 2. Parse Supported Functions
    funcs_file = "provisioning-modules/supported-functions.md"
    funcs = parse_markdown_sections(funcs_file)

    skill_data = {
        "module_type": "provisioning",
        "description": "Skills for developing WHMCS Provisioning Modules. These modules allow you to provision and manage products and services.",
        "common_parameters": params,
        "functions": []
    }

    for name, desc in funcs.items():
        skill_data["functions"].append({
            "name": name,
            "description": desc,
            "arguments": "$params (array)",
            "return_value": "string 'success' or error message"
        })

    output_path = os.path.join(SKILLS_DIR, "provisioning_modules.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_addon_skills():
    print("Generating Addon Module skills...")

    # Addon modules are less structured. We'll define known functions and search for descriptions.
    known_functions = {
        "Config": "addon-modules/configuration.md",
        "Activate": "addon-modules/installation-uninstallation.md",
        "Deactivate": "addon-modules/installation-uninstallation.md",
        "Upgrade": "addon-modules/upgrades.md",
        "Output": "addon-modules/admin-area-output.md",
        "Sidebar": "addon-modules/admin-area-output.md",
        "ClientArea": "addon-modules/client-area-output.md"
    }

    skill_data = {
        "module_type": "addon",
        "description": "Skills for developing WHMCS Addon Modules. These modules provide additional functionality within WHMCS.",
        "functions": []
    }

    for func_name, file_path in known_functions.items():
        if not os.path.exists(file_path):
            continue

        with open(file_path, "r", encoding="utf-8") as f:
            content = f.read()

        # Try to find a section for the function or just use the whole file content as context
        # Heuristic: look for 'function module_name_funcname' or similar patterns
        # Or just describe what the file is about.

        description = f"See {file_path} for details."

        # specific extraction for Config
        if func_name == "Config":
             # Look for text around "function demo_config"
             match = re.search(r'function demo_config\(\) \{([\s\S]+?)\}', content)
             if match:
                 description = "Defines module configuration. Example:\n" + match.group(0)
             else:
                 description = "Defines module configuration (name, version, author, fields)."

        elif func_name == "Output":
            match = re.search(r'function demo_output\(\$vars\) \{([\s\S]+?)\}', content)
            if match:
                description = "Defines admin area output. Example:\n" + match.group(0)
            else:
                description = "Defines admin area output. Receives $vars array."

        skill_data["functions"].append({
            "name": func_name,
            "description": description,
            "arguments": "$vars (array) for Output/ClientArea, none for Config (returns array)",
            "source_file": file_path
        })

    output_path = os.path.join(SKILLS_DIR, "addon_modules.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_payment_skills():
    print("Generating Payment Gateway skills...")

    # Payment Gateways
    # Merchant Gateway: merchant-gateway.md
    # Third Party Gateway: third-party-gateway.md

    skill_data = {
        "module_type": "payment_gateway",
        "description": "Skills for developing WHMCS Payment Gateway Modules.",
        "functions": []
    }

    # Merchant Gateway functions
    merchant_file = "payment-gateways/merchant-gateway.md"
    if os.path.exists(merchant_file):
        funcs = parse_markdown_sections(merchant_file)
        # The file structure might not be strictly H2 sections for functions.
        # Let's just manually add known ones if parsing fails or returns little.

        if not funcs:
             skill_data["functions"].append({
                 "name": "MetaData",
                 "description": "Define module metadata like DisplayName, APIVersion, etc.",
                 "arguments": "None",
                 "return_value": "Array"
             })
             skill_data["functions"].append({
                 "name": "config",
                 "description": "Define configuration fields.",
                 "arguments": "None",
                 "return_value": "Array"
             })
             skill_data["functions"].append({
                 "name": "capture",
                 "description": "Attempt to capture payment.",
                 "arguments": "$params",
                 "return_value": "Array (status, transid, fee, rawdata)"
             })
             skill_data["functions"].append({
                 "name": "refund",
                 "description": "Attempt to refund payment.",
                 "arguments": "$params",
                 "return_value": "Array (status, transid, fee, rawdata)"
             })
        else:
             for name, desc in funcs.items():
                 skill_data["functions"].append({
                     "name": name,
                     "description": desc,
                     "arguments": "$params",
                     "return_value": "See description"
                 })

    # Third Party Gateway functions (Link)
    third_party_file = "payment-gateways/third-party-gateway.md"
    if os.path.exists(third_party_file):
        # usually just 'link' function
        skill_data["functions"].append({
            "name": "link",
            "description": "Returns HTML code for a button/form to redirect user to payment gateway.",
            "arguments": "$params",
            "return_value": "HTML String"
        })

    output_path = os.path.join(SKILLS_DIR, "payment_gateways.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_registrar_skills():
    print("Generating Registrar Module skills...")

    skill_data = {
        "module_type": "registrar",
        "description": "Skills for developing WHMCS Domain Registrar Modules.",
        "common_parameters": [],
        "functions": []
    }

    # Parse parameters
    params_file = "domain-registrars/module-parameters.md"
    skill_data["common_parameters"] = parse_markdown_table(params_file)

    # Parse functions
    funcs_file = "domain-registrars/function-index.md"
    funcs = parse_markdown_table(funcs_file)

    for row in funcs:
        # Assuming the table columns are roughly "Parameter" (Function Name) and "Description"
        # We need to adapt based on exact headers found.
        name_key = next((k for k in row.keys() if "Parameter" in k or "Function" in k), None)
        desc_key = next((k for k in row.keys() if "Description" in k), None)

        if name_key and desc_key:
            skill_data["functions"].append({
                "name": row[name_key],
                "description": row[desc_key],
                "arguments": "$params (array)",
                "return_value": "Various (see docs)"
            })

    output_path = os.path.join(SKILLS_DIR, "registrar_modules.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_hook_skills():
    print("Generating Hook skills...")

    skill_data = {
        "type": "hooks",
        "description": "List of WHMCS Hooks.",
        "hooks": []
    }

    hooks_dir = "hooks-reference"
    if os.path.exists(hooks_dir):
        for filename in os.listdir(hooks_dir):
            if not filename.endswith(".md") or filename == "index.md":
                continue

            filepath = os.path.join(hooks_dir, filename)
            # Use sections parser. Each section is usually a hook name.
            sections = parse_markdown_sections(filepath)

            for hook_name, desc in sections.items():
                skill_data["hooks"].append({
                    "name": hook_name,
                    "description": desc,
                    "category": filename.replace(".md", "")
                })

    output_path = os.path.join(SKILLS_DIR, "hooks.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_index():
    index_content = """# WHMCS Module Development Skills

This directory contains modular skills for developing WHMCS modules.

* [Provisioning Modules](provisioning_modules.json)
* [Addon Modules](addon_modules.json)
* [Payment Gateways](payment_gateways.json)
* [Registrar Modules](registrar_modules.json)
* [Hooks](hooks.json)
"""
    with open(os.path.join(SKILLS_DIR, "skills.md"), "w", encoding="utf-8") as f:
        f.write(index_content)
    print("Created skills/skills.md")

if __name__ == "__main__":
    generate_provisioning_skills()
    generate_addon_skills()
    generate_payment_skills()
    generate_registrar_skills()
    generate_hook_skills()
    generate_index()
