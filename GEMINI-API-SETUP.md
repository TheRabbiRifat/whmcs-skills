# Google Gemini Configuration for WHMCS Development
# Documentation: whmcs-skills-kit/guide/AI-INTEGRATION.md
# Purpose: Using Google's Gemini API for WHMCS module generation

## Setup Instructions

### 1. Get API Key
Visit https://makersuite.google.com/app/apikey and create a Gemini API key.

### 2. Install Google Generative AI SDK
```bash
pip install google-generativeai
```

### 3. Set API Key
```bash
# Windows (PowerShell)
$env:GOOGLE_API_KEY = "your-api-key-here"

# Windows (CMD)
set GOOGLE_API_KEY=your-api-key-here

# MacOS/Linux
export GOOGLE_API_KEY="your-api-key-here"
```

### 4. Test Connection
```python
import google.generativeai as genai

genai.configure(api_key="your-api-key")
model = genai.GenerativeModel('gemini-pro')
response = model.generate_content("Hello!")
print(response.text)
```

---

## System Prompt for Gemini

Use this system prompt when calling Gemini for WHMCS development:

```
You are a senior WHMCS PHP developer with 10+ years of experience. Your expertise includes:

1. **WHMCS Versions**: 8.x (8.11+) with PHP 8.1+, and 9.x with PHP 8.2+
2. **Module Development**: Addon modules, Payment gateways, Provisioning modules, Registrar modules, Action hooks
3. **Database**: Laravel Capsule ORM for all database operations with proper query optimization
4. **Templates**: Smarty v3.1 (WHMCS 8.x) and v4 (WHMCS 9.x)
5. **Security**: Input validation, SQL injection prevention, XSS prevention, encryption, access controls
6. **APIs**: GuzzleHTTP for external APIs, WHMCS localAPI, hook system integration
7. **Standards**: PSR-12 code standards, strict type hints, proper error handling
8. **Logging**: logModuleCall() for module operations, logActivity() for user actions

## Generation Rules

1. **Security Headers**: Start every PHP file with:
   defined("WHMCS") or die("Access Denied");

2. **Type Hints**: Use strict typing on all functions
   declare(strict_types=1);

3. **Database**: Always use Capsule ORM, never raw SQL
   use Illuminate\Database\Capsule\Manager as Capsule;

4. **Error Handling**: Wrap external API calls in try/catch
   logModuleCall() for API calls with request/response

5. **Input Validation**: Validate/sanitize all POST, GET, SESSION inputs
   Use htmlspecialchars() for output in templates

6. **Encryption**: Use encrypt()/decrypt() for sensitive data
   Never store plaintext credentials

7. **Module Structure**: Config → Activate → Deactivate → output/hook functions
   Follow {modulename}_{FunctionName} naming pattern

8. **Language Files**: Create lang/english.php with all user-facing strings
   Load with getConfigOption() and language array

9. **Testing**: Generate code that passes security and coding standard validation
   User will run validate_module.py on your code

10. **Documentation**: Add comments for complex logic
    DocBlocks for functions with parameters and return types

When generating code, always follow these patterns and best practices.
```

---

## Usage Examples

### Example 1: Generate Addon Module

```python
import google.generativeai as genai
import os

# Configure API
api_key = os.getenv('GOOGLE_API_KEY')
genai.configure(api_key=api_key)
model = genai.GenerativeModel('gemini-pro')

# Read skill system prompt
with open('whmcs-skills-kit/guide/SKILL.md', 'r') as f:
    skill_prompt = f.read()

# Create conversation
chat = model.start_chat(history=[])

# First message: Set context
response = chat.send_message(
    f"You are a WHMCS expert. Here's your expertise:\n\n{skill_prompt}"
)

# Second message: Ask for addon module
response = chat.send_message(
    "Generate an addon module called 'order_tracker' that shows admin "
    "dashboard widget with recent orders and revenue. Use Capsule ORM. "
    "Include proper error handling. Target WHMCS 9.x."
)

print(response.text)
```

### Example 2: Debug Existing Module

```python
import google.generativeai as genai
import os

api_key = os.getenv('GOOGLE_API_KEY')
genai.configure(api_key=api_key)
model = genai.GenerativeModel('gemini-pro')

# Read skill and troubleshooting
with open('whmcs-skills-kit/guide/SKILL.md', 'r') as f:
    skill = f.read()
with open('whmcs-skills-kit/guide/TROUBLESHOOTING.md', 'r') as f:
    troubleshooting = f.read()

# Read problematic module code
with open('modules/addons/mymodule/mymodule.php', 'r') as f:
    module_code = f.read()

# Send for debugging
chat = model.start_chat(history=[])
chat.send_message(f"Expertise:\n{skill}\n\nReference:\n{troubleshooting}")

response = chat.send_message(
    f"Debug this WHMCS module. Error: [Your error message]\n\n"
    f"Code:\n{module_code}"
)

print(response.text)
```

### Example 3: Batch Generate Multiple Modules

```python
import google.generativeai as genai
import json
import os

api_key = os.getenv('GOOGLE_API_KEY')
genai.configure(api_key=api_key)
model = genai.GenerativeModel('gemini-pro')

# Load skill
with open('whmcs-skills-kit/guide/SKILL.md', 'r') as f:
    skill = f.read()

# Module requests
modules = [
    {
        "type": "addon",
        "name": "dashboard_stats",
        "description": "Dashboard widget showing daily revenue"
    },
    {
        "type": "hook",
        "name": "auto_invoice_email",
        "description": "Auto-email invoices on generation"
    },
    {
        "type": "payment_gateway",
        "name": "paypal_advanced",
        "description": "PayPal Advanced payment processor"
    }
]

# Process batch
results = []
chat = model.start_chat(history=[])
chat.send_message(f"Expertise:\n{skill}")

for module in modules:
    response = chat.send_message(
        f"Generate a {module['type']} module called '{module['name']}' "
        f"that {module['description']}. Use WHMCS 9.x standards."
    )
    
    results.append({
        "module": module['name'],
        "type": module['type'],
        "code": response.text
    })

# Save results
with open('generated_modules.jsonl', 'w') as f:
    for result in results:
        f.write(json.dumps(result) + '\n')

print(f"Generated {len(results)} modules")
```

### Example 4: Code with Vision (Image Analysis)

```python
import google.generativeai as genai
import os
from pathlib import Path

api_key = os.getenv('GOOGLE_API_KEY')
genai.configure(api_key=api_key)
model = genai.GenerativeModel('gemini-pro-vision')

# You can analyze screenshots or diagrams
image_path = "screenshots/error_message.png"
image = genai.upload_file(image_path)

response = model.generate_content([
    "Analyze this WHMCS error screenshot and tell me the root cause. "
    "Then generate the fix. Use expertise from whmcs-skills-kit/guide/SKILL.md",
    image
])

print(response.text)
```

---

## Token Budget Optimization

Gemini has different pricing than Claude. Optimize:

### Efficient Single Request
```python
prompt = """You are a WHMCS expert.

Reference Key Rules:
- Security: defined("WHMCS") or die("Access Denied");
- Database: Always use Capsule ORM
- Standards: PSR-12, type hints, strict_types=1
- Module pattern: Config → Activate → Deactivate → Output/Hooks
- Naming: {modulename}_{FunctionName}

Request: Generate an addon module called "quick_dashboard" that shows 
admin dashboard stats (pending invoices, recent orders, support tickets).
Use Capsule ORM. Include error handling. Target WHMCS 9.x.
"""

model = genai.GenerativeModel('gemini-pro')
response = model.generate_content(prompt)
print(response.text)
```

### Efficient Batch Processing
```python
import google.generativeai as genai

api_key = os.getenv('GOOGLE_API_KEY')
genai.configure(api_key=api_key)

# Read skill once
with open('whmcs-skills-kit/guide/SKILL.md', 'r') as f:
    skill = f.read()

# Reuse skill in chat (more efficient)
model = genai.GenerativeModel('gemini-pro')
chat = model.start_chat(history=[])

# Set expert context once
chat.send_message(f"Load this expertise:\n{skill}")

# Now ask multiple questions
requests = [
    "Generate addon module for dashboard stats",
    "Generate hook for auto-invoicing",
    "Generate payment gateway for Stripe"
]

for req in requests:
    response = chat.send_message(req)
    print(response.text)
    print("---")
```

---

## Model Selection

| Model | Best For | Speed | Cost | Context |
|-------|----------|-------|------|---------|
| **gemini-pro** | Code generation | ⚡⚡⚡ | $ | 30K tokens |
| **gemini-pro-vision** | Image analysis + code | ⚡⚡ | $$ | 30K tokens |
| **gemini-1.5-pro** | Complex tasks | ⚡ | $$$ | 1M tokens |
| **gemini-1.5-flash** | Quick requests | ⚡⚡⚡⚡ | $ | 1M tokens |

**Recommendation for WHMCS**:
- Use `gemini-pro` for most module generation
- Use `gemini-1.5-flash` for quick fixes and debugging
- Use `gemini-1.5-pro` for complex features and batch processing

---

## Code Quality Validation

After Gemini generates code:

```bash
# Validate the generated module
python3 whmcs-skills-kit/tools/validate_module.py modules/addons/mymodule/

# Fix any issues
# Ask Gemini to fix specific validation errors
```

Example validation prompt:
```
This validation failed:
ERROR: Missing access guard in line 42
ERROR: Possible SQL injection in getConfig()
ERROR: Missing lang file

Here's the code: [paste code]

Fix these issues following WHMCS best practices.
```

---

## Common Gemini Prompts for WHMCS

### Addon Module
```
Generate a WHMCS addon module named "{name}" that {description}. 
Include dashboard widget, proper security guards, error handling, 
and WHMCS 9.x compatibility. Use Capsule ORM only.
```

### Payment Gateway
```
Generate a WHMCS payment gateway module for {payment_processor}. 
Include capture, refund, webhook handling, and SCA support. 
Follow PSR-12 standards and use GuzzleHTTP.
```

### Provisioning Module
```
Generate a provisioning module for {hosting_provider}. 
Include create, suspend, terminate, password reset, and status 
check functions. Use their API via GuzzleHTTP.
```

### Registrar Module
```
Generate a domain registrar module for {registrar_api}. 
Include register, renew, transfer, and DNS management. 
Follow WHMCS registrar interface.
```

### Hook Function
```
Generate a WHMCS hook function for {event_name} that {action}. 
Include proper parameter validation, logging, and error handling.
```

---

## Streaming Responses

For long module generation, use streaming:

```python
import google.generativeai as genai
import os

api_key = os.getenv('GOOGLE_API_KEY')
genai.configure(api_key=api_key)
model = genai.GenerativeModel('gemini-pro')

# Stream output
response = model.generate_content(
    "Generate a payment gateway module for Stripe...",
    stream=True
)

# Print as it generates
for chunk in response:
    print(chunk.text, end='', flush=True)
```

---

## Safety Settings

Gemini has safety filters. For WHMCS development, no issues:

```python
import google.generativeai as genai
from google.generativeai.types import HarmCategory, HarmBlockThreshold

api_key = os.getenv('GOOGLE_API_KEY')
genai.configure(api_key=api_key)

model = genai.GenerativeModel(
    'gemini-pro',
    safety_settings=[
        {
            "category": HarmCategory.HARM_CATEGORY_DANGEROUS_CONTENT,
            "threshold": HarmBlockThreshold.BLOCK_NONE,
        }
    ]
)

# Now safe for security/encryption code generation
```

---

## File Organization

Recommended folder structure:

```
whmcs-gemini-tools/
├── config.py              # API key and settings
├── skill_loader.py        # Load SKILL.md
├── module_generator.py    # Generate modules
├── batch_processor.py     # Process multiple modules
├── validator.py           # Validate output
└── generated/
    ├── addons/
    ├── payment_gateways/
    ├── provisioning/
    └── registrars/
```

Example `config.py`:
```python
import os
from pathlib import Path

GOOGLE_API_KEY = os.getenv('GOOGLE_API_KEY')
SKILL_KIT_PATH = Path('whmcs-skills-kit')
SKILL_PROMPT = (SKILL_KIT_PATH / 'guide' / 'SKILL.md').read_text()

MODEL = 'gemini-pro'  # or gemini-1.5-flash for speed
MAX_TOKENS = 2048
TEMPERATURE = 0.7  # Lower for consistency, higher for creativity
```

---

## Comparison with Other AI Platforms

| Feature | Gemini | Copilot | Claude | Cursor |
|---------|--------|---------|--------|--------|
| **WHMCS Setup** | This file | `.copilot-instructions` | CLAUDE-API-SETUP.md | `.cursorrules` |
| **Speed** | ⚡⚡⚡⚡ | ⚡⚡⚡ | ⚡⚡ | ⚡⚡⚡ |
| **Cost** | $ | $$ | $$$ | $$ |
| **Context** | 30K-1M | Unknown | 200K | 200K |
| **File Loading** | Code uploads | Instructions | System prompt | @references |
| **Batch Support** | ✅ | ✅ | ✅ | Manual |
| **Image Analysis** | ✅ | ✅ | ✅ | No |

---

## Support & Resources

- **Gemini API Docs**: https://ai.google.dev/
- **Python SDK**: https://github.com/google/generative-ai-python
- **WHMCS Skill Kit**: whmcs-skills-kit/
- **Quick Start**: whmcs-skills-kit/guide/QUICK-START.md
- **Examples**: whmcs-skills-kit/guide/EXAMPLES-AND-PROMPTS.md

---

## Next Steps

1. Get API key at makersuite.google.com
2. Install: `pip install google-generativeai`
3. Set environment variable: `GOOGLE_API_KEY=your-key`
4. Copy code examples above
5. Load SKILL.md from whmcs-skills-kit/guide/
6. Start generating WHMCS modules!
7. Validate with: `python3 whmcs-skills-kit/tools/validate_module.py`

**Ready to build WHMCS modules with Gemini?** 🚀

---

**Version**: 1.0  
**Created**: February 2026  
**Compatible With**: WHMCS 8.x, 9.x, Google Gemini API
