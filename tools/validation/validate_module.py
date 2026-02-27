#!/usr/bin/env python3
"""
WHMCS Module Validator
Validates WHMCS modules against best practices and security standards.
"""

import os
import re
import sys
import json
import argparse
from pathlib import Path
from typing import List, Dict, Tuple

class ModuleValidator:
    """Validates WHMCS modules for compliance with best practices"""
    
    REQUIRED_FUNCTIONS = {
        'addon': ['config', 'activate', 'deactivate'],
        'provisioning': ['MetaData', 'CreateAccount', 'SuspendAccount', 'UnsuspendAccount', 'TerminateAccount'],
        'registrar': ['getConfigArray', 'RegisterDomain', 'RenewDomain', 'Sync'],
        'payment': ['config'],
    }
    
    SECURITY_CHECKS = [
        ('access_guard', r'defined\("WHMCS"\)\s+or\s+die'),
        ('no_mysql_functions', r'\$_(GET|POST)\['),
        ('proper_escaping', r'\{(\$\w+)\|escape'),
        ('use_capsule', r'Capsule::table'),
    ]
    
    def __init__(self, filepath: str):
        self.filepath = filepath
        self.filename = os.path.basename(filepath)
        self.content = None
        self.module_type = None
        self.module_name = None
        self.errors = []
        self.warnings = []
        self.info = []
        
    def validate(self) -> bool:
        """Run all validations"""
        
        if not self._read_file():
            return False
        
        self._check_syntax()
        self._detect_module_type()
        self._check_access_guard()
        self._check_required_functions()
        self._check_security()
        self._check_coding_standards()
        
        return len(self.errors) == 0
    
    def _read_file(self) -> bool:
        """Read module file"""
        try:
            with open(self.filepath, 'r', encoding='utf-8') as f:
                self.content = f.read()
            return True
        except FileNotFoundError:
            self.errors.append(f"File not found: {self.filepath}")
            return False
        except Exception as e:
            self.errors.append(f"Error reading file: {str(e)}")
            return False
    
    def _check_syntax(self):
        """Check PHP syntax"""
        # Basic PHP syntax check
        if not self.content.startswith('<?php'):
            self.warnings.append("File should start with <?php")
        
        # Check for balanced braces
        open_braces = self.content.count('{')
        close_braces = self.content.count('}')
        if open_braces != close_braces:
            self.errors.append(f"Unbalanced braces: {open_braces} open, {close_braces} close")
    
    def _detect_module_type(self):
        """Detect the module type"""
        
        # Check file path for clues
        if 'addon' in self.filepath or 'modules/addons' in self.filepath:
            self.module_type = 'addon'
        elif 'provisioning' in self.filepath or 'modules/servers' in self.filepath:
            self.module_type = 'provisioning'
        elif 'registrar' in self.filepath or 'modules/registrars' in self.filepath:
            self.module_type = 'registrar'
        elif 'gateway' in self.filepath or 'modules/gateways' in self.filepath:
            self.module_type = 'payment'
        else:
            self.module_type = 'unknown'
        
        # Extract module name
        match = re.search(r'function (\w+)_config\(', self.content)
        if match:
            self.module_name = match.group(1)
    
    def _check_access_guard(self):
        """Check for WHMCS access guard"""
        pattern = r'defined\s*\(\s*"WHMCS"\s*\)\s+or\s+die'
        if not re.search(pattern, self.content):
            self.errors.append("Missing: defined(\"WHMCS\") or die(\"Access Denied\");")
    
    def _check_required_functions(self):
        """Check for required functions based on module type"""
        if self.module_type not in self.REQUIRED_FUNCTIONS:
            return
        
        required = self.REQUIRED_FUNCTIONS[self.module_type]
        module_prefix = self.module_name or 'modulename'
        
        for func in required:
            # Handle different naming conventions
            func_patterns = [
                rf'function {module_prefix}_{func}\s*\(',
                rf'public function {func}\s*\(',
            ]
            
            found = False
            for pattern in func_patterns:
                if re.search(pattern, self.content):
                    found = True
                    break
            
            if not found:
                self.warnings.append(f"Missing recommended function: {module_prefix}_{func}()")
    
    def _check_security(self):
        """Check for security issues"""
        
        # Check for direct $_GET/$_POST usage
        if re.search(r'\$_(?:GET|POST|REQUEST)\[\s*[\'"][^\'"]*[\'"]\s*\]', self.content):
            # Check if it's properly validated
            unsafe_count = 0
            for match in re.finditer(r'\$_(?:GET|POST|REQUEST)\[', self.content):
                # Simple heuristic: check if there's type casting/validation nearby
                context = self.content[max(0, match.start()-50):match.end()+50]
                if not re.search(r'\(int\)|\(float\)|\(string\)|filter_var|htmlspecialchars', context):
                    unsafe_count += 1
            
            if unsafe_count > 0:
                self.errors.append(f"Potential security issue: {unsafe_count} unvalidated $_GET/$_POST access")
        
        # Check for SQL injection vulnerabilities
        if re.search(r'["\']\s*\.\s*\$_', self.content):
            self.errors.append("Potential SQL injection: String concatenation with user input detected")
        
        # Check for hardcoded API keys
        if re.search(r'["\']sk_(?:live|test)_[a-zA-Z0-9]{20,}["\']', self.content):
            self.errors.append("Security: Hardcoded API key found in code")
        
        # Check for plain password storage
        if re.search(r'password.*=.*\$_POST', self.content) and not re.search(r'encrypt\(', self.content):
            self.warnings.append("Warning: Password from user input should be encrypted with encrypt()")
    
    def _check_coding_standards(self):
        """Check PSR-12 coding standards"""
        
        lines = self.content.split('\n')
        
        for i, line in enumerate(lines, 1):
            # Check indentation (should be 4 spaces or tabs)
            if line and line[0] == ' ' and not line.startswith('    ') and not line.startswith('        '):
                if len(line) - len(line.lstrip()) not in [0, 4, 8, 12, 16, 20, 24, 28]:
                    self.info.append(f"Line {i}: Non-standard indentation (should be 4 spaces)")
            
            # Check for trailing whitespace
            if line != line.rstrip():
                self.info.append(f"Line {i}: Trailing whitespace")
            
            # Check for PHP closing tag in pure PHP files
            if line.strip() == '?>':
                self.warnings.append(f"Line {i}: Unnecessary closing ?> tag in PHP-only file")
        
        # Check for proper use statement
        if 'Capsule' in self.content and 'use Illuminate\\Database\\Capsule' not in self.content:
            if 'use WHMCS\\Module\\Addon' not in self.content:
                self.warnings.append("Missing proper 'use' statement for Capsule")
    
    def print_report(self):
        """Print validation report"""
        print("\n" + "="*60)
        print(f"WHMCS Module Validation Report")
        print(f"File: {self.filepath}")
        if self.module_name:
            print(f"Module: {self.module_name}")
        if self.module_type:
            print(f"Type: {self.module_type}")
        print("="*60 + "\n")
        
        # Errors
        if self.errors:
            print(f"❌ ERRORS ({len(self.errors)}):")
            for error in self.errors:
                print(f"   • {error}")
            print()
        
        # Warnings
        if self.warnings:
            print(f"⚠️  WARNINGS ({len(self.warnings)}):")
            for warning in self.warnings:
                print(f"   • {warning}")
            print()
        
        # Info
        if self.info and '--verbose' in sys.argv:
            print(f"ℹ️  INFO ({len(self.info)}):")
            for info in self.info[:10]:  # Show first 10
                print(f"   • {info}")
            if len(self.info) > 10:
                print(f"   ... and {len(self.info) - 10} more")
            print()
        
        # Summary
        status = "✓ PASS" if len(self.errors) == 0 else "✗ FAIL"
        print(f"Status: {status}")
        print(f"Errors: {len(self.errors)}, Warnings: {len(self.warnings)}, Info: {len(self.info)}")
        print("="*60 + "\n")
        
        return len(self.errors) == 0
    
    def get_json_report(self) -> Dict:
        """Return validation report as JSON"""
        return {
            'file': self.filepath,
            'module_name': self.module_name,
            'module_type': self.module_type,
            'valid': len(self.errors) == 0,
            'errors': self.errors,
            'warnings': self.warnings,
            'info': self.info,
        }


def find_php_files(directory: str) -> List[str]:
    """Find all PHP files in directory"""
    php_files = []
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file.endswith('.php'):
                php_files.append(os.path.join(root, file))
    return php_files


def main():
    parser = argparse.ArgumentParser(
        description='Validate WHMCS modules against best practices and security standards'
    )
    parser.add_argument('path', help='Path to PHP file or module directory')
    parser.add_argument('--json', action='store_true', help='Output results as JSON')
    parser.add_argument('--verbose', action='store_true', help='Show verbose output')
    
    args = parser.parse_args()
    
    if not os.path.exists(args.path):
        print(f"Error: Path not found: {args.path}")
        sys.exit(1)
    
    # Collect files to validate
    files_to_validate = []
    
    if os.path.isfile(args.path):
        if args.path.endswith('.php'):
            files_to_validate.append(args.path)
        else:
            print(f"Error: File is not a PHP file: {args.path}")
            sys.exit(1)
    else:
        # Directory: find all PHP files
        files_to_validate = find_php_files(args.path)
    
    if not files_to_validate:
        print(f"No PHP files found in: {args.path}")
        sys.exit(1)
    
    # Validate all files
    results = []
    all_valid = True
    
    for filepath in files_to_validate:
        validator = ModuleValidator(filepath)
        validator.validate()
        
        if args.json:
            results.append(validator.get_json_report())
        else:
            if not validator.print_report():
                all_valid = False
    
    # Output JSON if requested
    if args.json:
        print(json.dumps(results, indent=2))
    
    # Exit with appropriate code
    sys.exit(0 if all_valid else 1)


if __name__ == '__main__':
    main()
