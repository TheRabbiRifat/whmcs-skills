# Claude API Configuration for WHMCS Development
# Reference: whmcs-skills-kit/guide/AI-INTEGRATION.md
# Purpose: Use Claude 3.5 Sonnet or Claude 3 Opus for WHMCS module development

## Setup Instructions

### 1. Get Your API Key
Visit https://console.anthropic.com/ and create an API key.

### 2. System Prompt
When creating a conversation or batch job, use this system prompt:

```
You are a senior WHMCS development expert with 10+ years of experience. Your expertise includes:

1. WHMCS 8.x and 9.x architecture, APIs, and module development patterns
2. PHP 8.1+ coding with strict type hints and PSR-12 compliance
3. Laravel Capsule ORM for database operations with proper query optimization
4. Smarty template engine (v3.1 for WHMCS 8, v4 for WHMCS 9)
5. Module types: Addon modules, Payment gateways, Provisioning modules, Domain registrars, Action hooks
6. Security best practices: input validation, SQL injection prevention, XSS prevention, encryption
7. WHMCS localAPI, hooks system, email templates, and client portal integration
8. GuzzleHTTP for external API integration with proper error handling
9. WHMCS module testing, validation, and deployment procedures

## Core Rules

1. **Security First**: Every PHP file starts with `defined("WHMCS") or die("Access Denied");`
2. **Database Pattern**: Use `Illuminate\Database\Capsule\Manager as Capsule` for all DB operations
3. **Error Handling**: Wrap external API calls in try/catch blocks with proper logging
4. **Validation**: Validate and sanitize all user inputs (POST, GET, SESSION)
5. **Encryption**: Use `encrypt()` and `decrypt()` for sensitive data
6. **Logging**: Use `logModuleCall()` for API calls and `logActivity()` for user actions
7. **Standards**: Follow PSR-12, use type hints, declare(strict_types=1)
8. **Module Structure**: Config/Activate/Deactivate + output/hook functions
9. **Naming**: Use pattern {modulename}_{FunctionName} for consistency
10. **Testing**: Generate code that passes security and coding standard validation

## Reference Files

Load these documentation files from whmcs-skills-kit/ when relevant:

- **guide/SKILLS.md** - Full expertise system prompt (load first)
- **guide/QUICK-START.md** - 5-minute getting started guide
- **guide/CHEATSHEET.md** - PHP syntax, Capsule queries, patterns
- **guide/EXAMPLES-AND-PROMPTS.md** - 25+ real-world scenarios
- **guide/BEST-PRACTICES.md** - Advanced patterns and optimization
- **guide/TROUBLESHOOTING.md** - Debug common issues
- **modules/addon_modules.json** - Addon module structure
- **modules/payment_gateways.json** - Payment gateway interface
- **modules/provisioning_modules.json** - Server provisioning
- **modules/registrar_modules.json** - Domain registrar requirements
- **modules/hooks.json** - Available action hooks
- **modules/api.json** - WHMCS API reference
- **templates/README.md** - Module boilerplate code
- **samples/** - 1000+ code examples by module type
- **tools/validate_module.py** - Code validation tool

## Usage Patterns

### Pattern 1: Quick Module Generation
**Prompt**: "Generate a {type} module that {does something}. Use whmcs-skills-kit/guide/SKILLS.md as reference."

**Expected Context**:
- Module type (addon, payment gateway, provisioning, registrar, hook)
- Specific functionality required
- Security requirements
- Integration points

**Claude Response**:
- Complete module code with all required functions
- Language file with strings
- Template files (if applicable)
- Validation notes

**User Action**:
1. Save to modules/ folder
2. Run: `python3 whmcs-skills-kit/tools/validate_module.py path/to/module`
3. Fix any issues identified
4. Upload to WHMCS test environment

### Pattern 2: Debugging Existing Code
**Prompt**: "Debug this WHMCS module code:\n[paste code]\n\nUse whmcs-skills-kit/guide/TROUBLESHOOTING.md for reference."

**Expected Context**:
- Error message or unexpected behavior
- Which module type it is
- WHMCS version
- Code snippet

**Claude Response**:
- Root cause analysis
- Corrected code
- Explanation of fix
- How to prevent similar issues

### Pattern 3: Security Audit
**Prompt**: "Audit this module for security issues:\n[paste code]\n\nUse whmcs-skills-kit/guide/BEST-PRACTICES.md section on security."

**Expected Context**:
- Full module code
- External APIs it uses
- Data it handles

**Claude Response**:
- Security vulnerabilities identified
- Corrected code with security enhancements
- Security checklist applied
- Testing recommendations

### Pattern 4: Code Optimization
**Prompt**: "Optimize this database query for WHMCS using whmcs-skills-kit/guide/CHEATSHEET.md\n[paste code]"

**Expected Context**:
- Current implementation
- Performance issue (slow queries, N+1, etc.)
- Database schema

**Claude Response**:
- Optimized query using Capsule
- Performance improvement explanation
- Alternative patterns suggested
- Testing method

### Pattern 5: API Integration
**Prompt**: "Create code to integrate with {API} in WHMCS. Reference whmcs-skills-kit/modules/api.json and guide/EXAMPLES-AND-PROMPTS.md (API Integration)"

**Expected Context**:
- External API documentation
- What WHMCS data to send
- What to do with returned data

**Claude Response**:
- Integration code with Guzzle HTTP
- Error handling
- WHMCS API calls to update data
- Logging/debugging
- Security considerations

## Token Budget Optimization

For API calls, structure your requests efficiently:

### Efficient Context Loading (Option 1)
```
1. Send base SKILLS.md (~5K tokens)
2. Send module-specific JSON (~1-2K tokens)  
3. Send code/question (your tokens)
4. Send templates/examples as needed
```

### Efficient Context Loading (Option 2 - Summary Mode)
```
1. Send concise summary of SKILLS.md key rules
2. Send specific module JSON
3. Send relevant code examples (3-5 snippets)
4. Send your specific request
```

**Recommendation**: Use Option 1 for complex tasks, Option 2 for quick fixes.

## Example API Request

```python
import anthropic

client = anthropic.Anthropic(api_key="your-api-key")

# Read the skill system prompt
with open("whmcs-skills-kit/guide/SKILLS.md", "r") as f:
    skill_prompt = f.read()

# Create a message
message = client.messages.create(
    model="claude-3-5-sonnet-20241022",
    max_tokens=2048,
    system=skill_prompt,  # Use SKILLS.md as system prompt
    messages=[
        {
            "role": "user",
            "content": "Generate an addon module that displays client credit balance on the dashboard."
        }
    ]
)

print(message.content[0].text)
```

## Batch Processing for Multiple Modules

```python
import anthropic
import json

client = anthropic.Anthropic(api_key="your-api-key")

# Define batch of module generation tasks
modules = [
    {"type": "addon", "name": "Dashboard Balance Widget", "description": "..."},
    {"type": "payment_gateway", "name": "Custom Processor", "description": "..."},
    {"type": "hook", "name": "Auto Invoice Email", "description": "..."}
]

# Process each in sequence
results = []
with open("whmcs-skills-kit/guide/SKILLS.md", "r") as f:
    system_prompt = f.read()

for module in modules:
    message = client.messages.create(
        model="claude-3-5-sonnet-20241022",
        max_tokens=2048,
        system=system_prompt,
        messages=[{
            "role": "user",
            "content": f"Generate a {module['type']} module: {module['description']}"
        }]
    )
    results.append({
        "module": module['name'],
        "code": message.content[0].text
    })

# Save results
with open("generated_modules.jsonl", "w") as f:
    for result in results:
        f.write(json.dumps(result) + "\n")
```

## Code Validation Workflow

After Claude generates code:

```bash
# 1. Save the generated code
echo "Generated code" > modules/my_module/my_module.php

# 2. Validate against standards
python3 whmcs-skills-kit/tools/validate_module.py modules/my_module/

# 3. Fix any errors returned
# (Have Claude fix specific errors)

# 4. Verify in WHMCS
# - Upload to test environment
# - Install/activate module
# - Check admin/client area functionality
# - Review logs for errors

# 5. Deploy to production
# - Backup current module
# - Upload production version
# - Test in production
```

## Common Requests

### "Build a {type} module that does X"
→ Use **Pattern 1** with SKILLS.md + module JSON

### "Why is my module throwing an error?"
→ Use **Pattern 2** with TROUBLESHOOTING.md

### "How do I improve security in this code?"
→ Use **Pattern 3** with BEST-PRACTICES.md security section

### "This query is slow, how to optimize?"
→ Use **Pattern 4** with CHEATSHEET.md database section

### "How do I integrate with external API in WHMCS?"
→ Use **Pattern 5** with api.json + EXAMPLES-AND-PROMPTS.md

### "What's the structure of a {module type}?"
→ Reference templates/README.md + modules/{type}.json

## Supported Models

**Recommended**:
- `claude-3-5-sonnet-20241022` - Best for code generation (fastest, most capable)
- `claude-3-opus-20250219` - Best for complex debugging (most powerful)

**Acceptable**:
- `claude-3-haiku-20250307` - Budget option (smaller context window)

## Rate Limits & Costs

- **Sonnet**: ~$3 per 1M input tokens, ~$15 per 1M output tokens
- **Opus**: ~$15 per 1M input tokens, ~$75 per 1M output tokens
- **Haiku**: ~$0.80 per 1M input tokens, ~$4 per 1M output tokens

**Budget Tips**:
- Use Haiku for simple fixes, Sonnet for generation, Opus for complex debugging
- Use batch processing to amortize API call overhead
- Cache SKILLS.md and module JSONs to reduce token usage
- Summarize long error logs before sending

## Support & Resources

- **API Documentation**: https://docs.anthropic.com/
- **Skill Kit Quick Start**: whmcs-skills-kit/guide/QUICK-START.md
- **Module Examples**: whmcs-skills-kit/guide/EXAMPLES-AND-PROMPTS.md
- **Troubleshooting**: whmcs-skills-kit/guide/TROUBLESHOOTING.md
- **Validation Tool**: whmcs-skills-kit/tools/validate_module.py

## Next Steps

1. Create API key at console.anthropic.com
2. Choose a model (Sonnet recommended for best results)
3. Load SKILLS.md from whmcs-skills-kit/guide/
4. Use one of the 5 patterns above
5. Validate generated code with tools/validate_module.py
6. Deploy to your WHMCS test environment
7. Test thoroughly before production

---

**Configuration Version**: 1.0
**Last Updated**: 2024
**Compatible With**: WHMCS 8.x, 9.x and Claude 3.5 Sonnet/Opus
