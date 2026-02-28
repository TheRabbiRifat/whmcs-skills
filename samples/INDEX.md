# PHP Sample Files Index

**Total Organized:** 764 PHP sample files  
**Categories:** 12 main categories with focused subcategories  
**Last Updated:** February 27, 2026

---

## 📊 Category Overview

### 🔲 Hooks (339 files) - 44%
Event-driven programming patterns for WHMCS extensions.

- **addon/** (16) - Addon module hooks
- **admin-area/** (23) - Admin interface hooks
- **authentication/** (3) - User authentication hooks
- **client/** (9) - Client object hooks
- **client-area/** (59) - Client portal hooks
- **contact/** (4) - Contact management hooks
- **cron/** (7) - Scheduled task hooks
- **domain/** (14) - Domain management hooks
- **invoices-quotes/** (25) - Billing document hooks
- **module/** (36) - Service module hooks
- **output/** (39) - Page output hooks
- **products-services/** (11) - Product/service hooks
- **registrar/** (24) - Domain registrar hooks
- **shopping-cart/** (31) - Cart & checkout hooks
- **support/** (8) - Support ticket hooks
- **ticket/** (25) - Ticket system hooks
- **user/** (5) - User account hooks

**Best For:** Learning hook-based customizations, page manipulation, event handling

---

### 🔗 API (334 files) - 44%
WHMCS internal API integration examples.

- **clients/** (46) - Client, contact, and credit management
- **domains/** (26) - Domain registration and management
- **invoices/** (37) - Billing, payments, and transactions
- **modules/** (24) - Service module operations
- **orders/** (21) - Order processing and management
- **system/** (142) - Admin, security, configuration
- **tickets/** (38) - Support ticket operations

**Best For:** Backend integration, data manipulation, system automation

**Example Use Cases:**
- Creating clients programmatically
- Managing invoices and payments
- Automating domain operations
- Service module orchestration

---

### 🏗️ Advanced (25 files) - 3%
Advanced WHMCS development patterns and techniques.

- **admin-area/** (4) - Admin page customization
- **authentication/** (6) - Auth systems and SSO
- **database/** (7) - Direct database operations
- **formatting/** (5) - Currency and date formatting
- **logging/** (2) - Application logging
- **pages/** (1) - Custom page creation

**Best For:** Complex customizations, performance optimization, system extension

---

### 🎨 Themes (21 files) - 3%
Frontend template and theme customization.

- **conditionals/** (1) - Smarty conditional logic
- **functions/** (6) - Custom Smarty functions
- **navigation/** (8) - Navigation menu manipulation
- **sidebars/** (6) - Sidebar customization

**Best For:** Client portal customization, template techniques, frontend styling

---

### 📱 Registrar (15 files) - 2%
Domain registrar module implementation.

- **config/** (4) - Configuration and parameters
- **extended/** (4) - Advanced registrar features
- **operations/** (7) - Domain operations (register, transfer, renew)

**Best For:** Building registrar modules, domain automation

---

### 📧 Notifications (7 files) - 1%
Notification provider implementation.

All files in root - email and notification delivery systems

**Best For:** Custom notification channels, alert systems

---

### 🌐 Languages (7 files) - 1%
Multilingual support and localization.

- **locales/** (1) - Locale configuration
- **overrides/** (3) - Language string overrides
- **translating/** (3) - Translation systems

**Best For:** Internationalization, language support, custom translations

---

### 💳 Gateways (6 files) - 1%
Payment gateway integration.

- **merchant/** (2) - Direct merchant gateways (e.g., Stripe, PayPal)
- **third-party/** (4) - Third-party gateway integration

**Best For:** Payment processing, gateway development

---

### 📨 Addon Modules (6 files) - 1%
Core addon module structure.

- **admin-area/** (1) - Admin interface output
- **client-area/** (1) - Client portal output
- **configuration/** (1) - Module configuration
- **installation/** (2) - Installation/activation
- **upgrades/** (1) - Version upgrades

**Best For:** Creating new addon modules, module structure

---

### 📬 Mail Providers (4 files) - 0.5%
Email delivery system integration.

All files in root - mail provider implementation

**Best For:** Custom email delivery, SMTP integration

---

### 🔌 Provisioning (Empty) - Ready
Server provisioning and automation modules.

**Note:** Structure ready for provisioning module samples. Currently no examples.

---

### 🛠️ Utilities (Empty) - Ready
Helper classes and utility functions.

**Note:** Structure ready for utility code samples. Currently no examples.

---

## 🎯 Quick Navigation by Use Case

### Building Your First Addon Module
1. Start: `addon/installation/` - Module structure
2. Add Output: `addon/admin-area/`, `addon/client-area/`
3. Add Config: `addon/configuration/`
4. Add Hooks: `hooks/addon/`

### Creating API Integrations
1. API Basics: `api/clients/`, `api/orders/`
2. Advanced: `api/system/`, `api/invoices/`
3. Auto Docs: See `reference/api.json`

### Custom Theme/Portal
1. Templates: `themes/functions/`, `themes/navigation/`
2. Customization: `themes/sidebars/`, `themes/conditionals/`
3. Hooks: `hooks/client-area/`

### Domain Management
1. Registrar Module: `registrar/config/`, `registrar/operations/`
2. Domain Hooks: `hooks/domain/`
3. API: `api/domains/`

### Payment Processing
1. Gateways: `gateways/merchant/`, `gateways/third-party/`
2. Invoices API: `api/invoices/`
3. Hooks: `hooks/invoices-quotes/`

### Advanced Development
1. Database: `advanced/database/`
2. Authentication: `advanced/authentication/`
3. Performance: `advanced/formatting/`

---

## 📖 File Naming Convention

Sample files follow a pattern for easy identification:

```
{category}_{feature}_{sample-number}.php

Examples:
- api_addclient_sample_1.php      (API: Add client, first example)
- hooks_admin-area_sample_5.php   (Hook: Admin area, 5th example)
- themes_navigation_sample_3.php  (Template: Navigation, 3rd example)
```

---

## ✨ Organization Benefits

✅ **Clear Structure** - Files grouped by functional area  
✅ **Easy Discovery** - Find examples by feature, not alphabetically  
✅ **Learning Path** - Start simple (addon) → advance (API, hooks)  
✅ **Copy-Paste Ready** - All files are directly usable  
✅ **AI-Friendly** - Organized for semantic search and context injection  
✅ **Scalable** - Easy to add new categories or examples  

---

## 🔗 Related Resources

- [SKILL.md](../SKILL.md) - AI system prompt with full WHMCS expertise
- [reference/](../references/) - JSON reference specifications
- [docs/](../docs/) - Complete documentation
- [guides/](../guides/) - Development guides and best practices

---

## 📝 Tips for Using These Samples

1. **Copy & Adapt**: Each file is a complete, working example
2. **Combine Multiple**: Mix patterns from different samples for your module
3. **Follow Conventions**: Use naming and structure from examples
4. **Check APIs**: Refer to `reference/` for current WHMCS API specs
5. **Error Handling**: Review `advanced/database/` for proper patterns
6. **Security**: Always use escaping - see `api/clients/` examples

---

## 🚀 Next Steps

1. Choose your module type (addon, gateway, registrar)
2. Find appropriate samples in this index
3. Review 2-3 similar examples
4. Adapt for your use case
5. Test thoroughly
6. Deploy with confidence!

---

**Project:** whmcs-skills  
**Maintained:** WHMCS Development Skills Kit  
**Purpose:** AI-powered development reference  

For questions or improvements, refer to the project documentation.
