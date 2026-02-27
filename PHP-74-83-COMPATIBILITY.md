# PHP 7.4-8.3 Compatibility Guide
**WHMCS Skills Kit - Complete PHP Version Support**

---

## Overview

This WHMCS Skills Kit is fully compatible with **PHP 7.4, 8.0, 8.1, 8.2, and 8.3**. All examples, templates, and documentation follow patterns that work across this entire version range.

| Version | Status | Notes |
|---------|--------|-------|
| **PHP 7.4** | ✅ Supported | Recommended minimum for WHMCS 8.x |
| **PHP 8.0** | ✅ Full support | Transitional version; type hints fully supported |
| **PHP 8.1** | ✅ Full support | Readonly properties, enums available |
| **PHP 8.2** | ✅ Full support | Recommended for WHMCS 9.x |
| **PHP 8.3** | ✅ Full support | Latest stable; best performance |

---

## Key Compatibility Rules

### 1. **No `declare(strict_types=1)` Required**

All code samples in this kit **comment out** strict_types for PHP 7.4 compatibility:

```php
<?php
// declare(strict_types=1);  // PHP 8.0+ only; remove for PHP 7.4 compatibility

defined("WHMCS") or die("Access Denied");
```

**When to Enable**:
- If targeting PHP 8.0+, uncomment `declare(strict_types=1)` at the top of each file
- If supporting PHP 7.4, leave it commented out

---

### 2. **Array Syntax Options**

Both syntaxes work across all versions:

```php
// ✅ Short array syntax (PHP 7.4+) — PREFERRED
$array = ['key' => 'value', 'id' => 123];

// ✅ Old array syntax (PHP 7.4+) — Also works
$array = array('key' => 'value', 'id' => 123);
```

**Recommendation**: Use `[]` syntax exclusively for consistency.

---

### 3. **Type Hints — Optional in PHP 7.4**

```php
// ✅ Without type hints (PHP 7.4+ compatible)
function processPayment($amount, $currency) {
    return ['status' => 'success'];
}

// ✅ With type hints (PHP 8.0+ preferred, optional in 7.4)
function processPayment($amount: float, $currency: string): array {
    return ['status' => 'success'];
}
```

**Best Practice**: Use type hints for clarity on PHP 8.0+ targets; omit for PHP 7.4 support.

---

### 4. **Nullable Types**

```php
// ✅ PHP 7.4-8.3 compatible
function getClient($id) {
    if (!$id) return null;
    return ['id' => $id, 'name' => 'John'];
}

// ✅ PHP 8.0+ with type hints
function getClient(int $id): ?array {
    if (!$id) return null;
    return ['id' => $id, 'name' => 'John'];
}
```

---

### 5. **Union Types — PHP 8.0+ Only**

```php
// ❌ AVOID for PHP 7.4
// function getValue(): int|string { }  // PHP 8.0+ syntax

// ✅ Use this for PHP 7.4 compatibility
function getValue() {
    // Returns int or string depending on context
    return is_numeric($val) ? (int)$val : (string)$val;
}

// ✅ PHP 8.0+ can use union types
// But avoid if supporting PHP 7.4
```

**Rule**: Don't use union types if supporting PHP 7.4.

---

### 6. **Named Arguments** — PHP 8.0+ Only

```php
// ❌ AVOID for PHP 7.4
// localAPI('CreateInvoice', userid: 123, itemdescription: 'Test');

// ✅ Use positional/associative arrays for PHP 7.4 compatibility
localAPI('CreateInvoice', ['userid' => 123, 'itemdescription' => 'Test']);
```

**Rule**: Always use associative arrays instead of named arguments.

---

### 7. **Match Expression** — PHP 8.0+ Only

```php
// ❌ AVOID for PHP 7.4
// $status = match($code) {
//     200 => 'OK',
//     404 => 'Not Found',
//     default => 'Unknown',
// };

// ✅ Use switch statements for PHP 7.4 compatibility
switch ($code) {
    case 200:
        $status = 'OK';
        break;
    case 404:
        $status = 'Not Found';
        break;
    default:
        $status = 'Unknown';
}
```

**Rule**: Use switch/if statements, avoid match expressions for PHP 7.4.

---

### 8. **Attributes** — PHP 8.0+ Only

```php
// ❌ AVOID for PHP 7.4
// #[Route('/api/user')]
// function getUser() { }

// ✅ Use comments/docblocks for PHP 7.4 compatibility
/**
 * @route /api/user
 * @method GET
 */
function getUser() {
}
```

**Rule**: Use DocBlock comments instead of attributes for PHP 7.4.

---

### 9. **Constructor Property Promotion** — PHP 8.0+ Only

```php
// ❌ AVOID for PHP 7.4
// class Order {
//     public function __construct(
//         public int $id,
//         public string $email,
//     ) {}
// }

// ✅ Use traditional constructor for PHP 7.4 compatibility
class Order {
    public $id;
    public $email;
    
    public function __construct($id, $email) {
        $this->id = $id;
        $this->email = $email;
    }
}
```

**Rule**: Avoid constructor property promotion if supporting PHP 7.4.

---

### 10. **Nullsafe Operator** — PHP 8.0+ Only

```php
// ❌ AVOID for PHP 7.4
// $email = $order?->customer?->email;

// ✅ Use traditional null checks for PHP 7.4
$email = null;
if ($order && $order->customer && $order->customer->email) {
    $email = $order->customer->email;
}
```

**Rule**: Use traditional null checks for PHP 7.4 compatibility.

---

## Feature Checklist by PHP Version

| Feature | 7.4 | 8.0 | 8.1 | 8.2 | 8.3 | Use? |
|---------|-----|-----|-----|-----|-----|------|
| Type hints (basic) | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ Yes (8.0+) |
| Union types | ❌ | ✅ | ✅ | ✅ | ✅ | ❌ Avoid 7.4 |
| Named arguments | ❌ | ✅ | ✅ | ✅ | ✅ | ❌ Avoid 7.4 |
| Match expression | ❌ | ✅ | ✅ | ✅ | ✅ | ❌ Avoid 7.4 |
| Constructor promotion | ❌ | ✅ | ✅ | ✅ | ✅ | ❌ Avoid 7.4 |
| Attributes | ❌ | ✅ | ✅ | ✅ | ✅ | ❌ Avoid 7.4 |
| Nullsafe operator | ❌ | ✅ | ✅ | ✅ | ✅ | ❌ Avoid 7.4 |
| Readonly properties | ❌ | ❌ | ✅ | ✅ | ✅ | ⚠️ Optional |
| Enums | ❌ | ❌ | ✅ | ✅ | ✅ | ⚠️ Optional |
| Fibers | ❌ | ❌ | ✅ | ✅ | ✅ | ⚠️ Optional |

---

## WHMCS Compatibility by PHP Version

| WHMCS | Recommended PHP | Minimum PHP | Maximum PHP |
|-------|-----------------|-------------|-------------|
| **8.11+** | 8.2 | 7.4 | 8.3 |
| **9.0+** | 8.2 | 8.0 | 8.3 |

---

## Code Generation Guidance

### For Maximum Compatibility (PHP 7.4+)

Use these patterns in all generated code:

```php
<?php
// declare(strict_types=1);  // Omit for PHP 7.4

defined("WHMCS") or die("Access Denied");

function modulefunction($param1, $param2) {
    // Use associative arrays
    $config = ['key' => 'value'];
    
    // Use switch statements instead of match
    switch ($param1) {
        case 'option1':
            return ['status' => 'success'];
        default:
            return ['status' => 'error'];
    }
}
```

### For Modern Standards (PHP 8.0+)

Optionally enable modern features:

```php
<?php
declare(strict_types=1);

defined("WHMCS") or die("Access Denied");

function modulefunction(string $param1, array $param2): array {
    // Use modern syntax
    return match ($param1) {
        'option1' => ['status' => 'success'],
        default => ['status' => 'error'],
    };
}
```

---

## Testing Across Versions

### Check Your PHP Version

```bash
php --version
```

### Test Code on Different Versions

```bash
# PHP 7.4
php74 -l modules/addons/mymodule/mymodule.php

# PHP 8.2
php82 -l modules/addons/mymodule/mymodule.php

# PHP 8.3
php83 -l modules/addons/mymodule/mymodule.php
```

### Validation Script

All code samples should pass:

```bash
python3 whmcs-skills-kit/tools/validate_module.py modules/addons/mymodule/
```

---

## Common Issues & Fixes

### Issue: `Undefined constant` Error

**Cause**: Using newer PHP syntax on PHP 7.4  
**Fix**: Remove `declare(strict_types=1)` and type hints

```php
// ❌ PHP 7.4 Error
function getValue(): string { }

// ✅ PHP 7.4 Compatible
function getValue() { }
```

---

### Issue: `Syntax Error: unexpected token`

**Cause**: Using PHP 8.0+ syntax on PHP 7.4  
**Fix**: Replace with compatible alternatives

```php
// ❌ PHP 7.4 Error (match expression)
$result = match ($code) { ... };

// ✅ PHP 7.4 Compatible (switch statement)
switch ($code) { ... }
```

---

## Recommended Setup

### For Production (Maximum Stability)

- **PHP Version**: 8.2 (best balance of stability and features)
- **Type Hints**: Yes (use them)
- **Strict Types**: Optional (comment out for compatibility)
- **Modern Syntax**: Use conservatively

```
PHP 8.1 (minimum for WHMCS 8.x) → Most compatible across all versions
PHP 8.2 (recommended) → Best stability and features
PHP 8.3 (latest) → Best performance
```

### For Development (Maximum Features)

- **PHP Version**: 8.3 (latest features)
- **Type Hints**: Yes
- **Strict Types**: Yes (`declare(strict_types=1)`)
- **Modern Syntax**: Use freely

### Build for PHP 7.4, Test on 8.3

Create code compatible with PHP 7.4, then test on PHP 8.0+ to ensure it works everywhere:

```bash
# Write for PHP 7.4
# - No strict_types
# - No type hints (optional)
# - Use switch, not match
# - Use arrays, not attributes

# Test on PHP 8.0+
# - Code still works
# - No warnings or errors

# Deploy to production
# - Works on PHP 7.4-8.3
```

---

## References

- **PHP 7.4**: https://www.php.net/releases/7.4/
- **PHP 8.0**: https://www.php.net/releases/8.0/
- **PHP 8.1**: https://www.php.net/releases/8.1/
- **PHP 8.2**: https://www.php.net/releases/8.2/
- **PHP 8.3**: https://www.php.net/releases/8.3/
- **WHMCS Compatibility**: https://developers.whmcs.com/

---

**Version**: 1.0  
**Last Updated**: February 2026  
**Scope**: PHP 7.4 through 8.3 compatibility across WHMCS 8.x and 9.x
