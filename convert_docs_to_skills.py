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

def generate_api_skills():
    print("Generating API skills...")

    skill_data = {
        "type": "api",
        "description": "WHMCS API Reference.",
        "functions": []
    }

    api_dir = "api-reference"
    if os.path.exists(api_dir):
        for filename in os.listdir(api_dir):
            if not filename.endswith(".md") or filename == "index.md":
                continue

            filepath = os.path.join(api_dir, filename)

            # Simple parsing: Title is command name. Tables are parameters.
            with open(filepath, "r", encoding="utf-8") as f:
                content = f.read()

            title_match = re.search(r'title\s*=\s*"([^"]+)"', content)
            command_name = title_match.group(1) if title_match else filename.replace(".md", "")

            # Extract description (text before first header or table)
            # This is a bit rough but works for most files
            description = ""
            desc_match = re.search(r'\+\+\+\n\n([\s\S]+?)(?:###|##|\|)', content)
            if desc_match:
                 description = desc_match.group(1).strip()

            # Parse tables
            # Assuming first table is Request Parameters, second is Response (if exists)
            # But parse_markdown_table only gets one.
            # We might need to split content by "### Request Parameters" etc.

            request_params = []
            req_match = re.search(r'Request Parameters\s*\n\s*(\|[\s\S]+?)\n\n', content)
            if req_match:
                # We need a temporary way to parse a string table
                # Reuse existing logic by writing to temp file or refactoring.
                # Refactoring `parse_markdown_table` to accept string content is better.
                pass

            # For now, let's just grab the whole file content as "documentation"
            # and maybe try to parse the first table if it looks like params.

            # Actually, let's use the file path for `parse_markdown_table`.
            # It grabs the FIRST table. In API docs, first table is usually Request Parameters.
            params = parse_markdown_table(filepath)

            skill_data["functions"].append({
                "command": command_name,
                "description": description,
                "parameters": params,
                "documentation_file": filepath
            })

    output_path = os.path.join(SKILLS_DIR, "api.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_theme_skills():
    print("Generating Theme skills...")
    # Just list files and sections as themes are more about guides
    generate_generic_skills("themes", "themes.json", "WHMCS Theme Development")

def generate_mail_provider_skills():
    print("Generating Mail Provider skills...")
    generate_generic_skills("mail-providers", "mail_providers.json", "WHMCS Mail Provider Modules")

def generate_notification_provider_skills():
    print("Generating Notification Provider skills...")
    generate_generic_skills("notification-providers", "notification_providers.json", "WHMCS Notification Provider Modules")

def generate_advanced_skills():
    print("Generating Advanced skills...")
    generate_generic_skills("advanced", "advanced.json", "Advanced WHMCS Development")

def generate_oauth_skills():
    print("Generating OAuth skills...")
    generate_generic_skills("oauth", "oauth.json", "WHMCS OAuth Integration")

def generate_language_skills():
    print("Generating Language skills...")
    generate_generic_skills("languages", "languages.json", "WHMCS Language Files")

def generate_generic_skills(source_dir, output_filename, description):
    skill_data = {
        "type": "guide",
        "category": source_dir,
        "description": description,
        "topics": []
    }

    if os.path.exists(source_dir):
        for filename in os.listdir(source_dir):
            if not filename.endswith(".md") or filename == "index.md":
                continue

            filepath = os.path.join(source_dir, filename)
            sections = parse_markdown_sections(filepath)

            topic_name = filename.replace(".md", "").replace("-", " ").title()

            skill_data["topics"].append({
                "title": topic_name,
                "content": sections, # This might be large, but it's modular by file at least
                "file": filepath
            })

    output_path = os.path.join(SKILLS_DIR, output_filename)
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(skill_data, f, indent=2)
    print(f"Created {output_path}")

def generate_manifest():
    print("Generating Skills Manifest...")
    manifest = {
        "version": "1.0",
        "role": "WHMCS Expert Developer",
        "description": "A comprehensive, modular set of skills for developing, debugging, and maintaining WHMCS modules, themes, and integrations.",
        "skills": [
            {"name": "Provisioning Modules", "file": "provisioning_modules.json", "description": "Functions and parameters for provisioning products/services."},
            {"name": "Addon Modules", "file": "addon_modules.json", "description": "Structure and functions for Admin Area addon modules."},
            {"name": "Payment Gateways", "file": "payment_gateways.json", "description": "Interfaces for Merchant and Third-Party payment gateways."},
            {"name": "Registrar Modules", "file": "registrar_modules.json", "description": "Functions for domain registration and management modules."},
            {"name": "Hooks", "file": "hooks.json", "description": "Comprehensive list of system hooks and their parameters."},
            {"name": "API", "file": "api.json", "description": "Reference for the WHMCS Local and External API commands."},
            {"name": "Themes", "file": "themes.json", "description": "Guides and variables for Client Area and Admin Area theme development."},
            {"name": "Mail Providers", "file": "mail_providers.json", "description": "Integration skills for custom Mail Providers."},
            {"name": "Notification Providers", "file": "notification_providers.json", "description": "Integration skills for Notification Providers."},
            {"name": "Advanced", "file": "advanced.json", "description": "Advanced topics including DB interaction, Authentication, and Logging."},
            {"name": "OAuth", "file": "oauth.json", "description": "Implementing OAuth Single Sign-On and credentials."},
            {"name": "Languages", "file": "languages.json", "description": "Working with WHMCS language files and overrides."}
        ]
    }

    output_path = os.path.join(SKILLS_DIR, "manifest.json")
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(manifest, f, indent=2)
    print(f"Created {output_path}")

def generate_system_prompt():
    print("Generating System Prompt...")
    prompt_content = """# Role: WHMCS Expert Developer

You are an expert software engineer specializing in WHMCS development. You possess deep knowledge of the internal architecture, module systems (Provisioning, Addon, Registrar, Gateway), Hook system, and the API.

## Capabilities

1.  **Module Development**: You can create and debug modules for provisioning, payments, and domain registration.
2.  **Hook Implementation**: You know how to use hooks to intervene in WHMCS lifecycle events.
3.  **API Usage**: You are proficient in using the internal (LocalAPI) and external APIs.
4.  **Theme Customization**: You understand Smarty templates and the WHMCS theme structure.

## Knowledge Base (Skills)

You have access to a modular set of JSON "skill" files. When answering user queries, you should identify the relevant domain and refer to the specific skill file for accurate function signatures, parameters, and behaviors.

*   **Provisioning**: Use `provisioning_modules.json` for `CreateAccount`, `SuspendAccount`, etc.
*   **Addons**: Use `addon_modules.json` for `_config`, `_activate`, `_output`.
*   **Gateways**: Use `payment_gateways.json` for `capture`, `refund`, `link`.
*   **Registrars**: Use `registrar_modules.json` for `RegisterDomain`, `GetNameservers`.
*   **Hooks**: Use `hooks.json` to find the correct hook point (e.g., `ClientAdd`, `InvoicePaid`) and its variables.
*   **API**: Use `api.json` for commands like `AddClient`, `OpenTicket`.
*   **Themes**: Use `themes.json` for template variables and structure.

## Guidelines

*   **Code Quality**: Always produce secure, PSR-compliant PHP code.
*   **Security**: Sanitize inputs (using `Capsule` or WHMCS helpers) and escape outputs.
*   **Context**: Load only the specific skill JSON related to the user's immediate request to conserve context window.
"""
    output_path = os.path.join(SKILLS_DIR, "system_prompt.md")
    with open(output_path, "w", encoding="utf-8") as f:
        f.write(prompt_content)
    print(f"Created {output_path}")

def generate_index():
    index_content = """# WHMCS Module Development Skills

This directory contains modular skills for developing WHMCS modules.

## Meta
* [Manifest (JSON)](manifest.json)
* [System Prompt / Persona](system_prompt.md)

## Skills
* [Provisioning Modules](provisioning_modules.json)
* [Addon Modules](addon_modules.json)
* [Payment Gateways](payment_gateways.json)
* [Registrar Modules](registrar_modules.json)
* [Hooks](hooks.json)
* [API](api.json)
* [Themes](themes.json)
* [Mail Providers](mail_providers.json)
* [Notification Providers](notification_providers.json)
* [Advanced](advanced.json)
* [OAuth](oauth.json)
* [Languages](languages.json)
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
    generate_api_skills()
    generate_theme_skills()
    generate_mail_provider_skills()
    generate_notification_provider_skills()
    generate_advanced_skills()
    generate_oauth_skills()
    generate_language_skills()
    generate_manifest()
    generate_system_prompt()
    generate_index()
