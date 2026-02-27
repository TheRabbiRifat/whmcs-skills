# Example Scenarios & AI Prompts

**Copy-paste ready prompts for common WHMCS development tasks!**

---

## Table of Contents

1. [Addon Modules](#addon-modules)
2. [Provisioning Modules](#provisioning-modules)
3. [Registrar Modules](#registrar-modules)
4. [Payment Gateways](#payment-gateways)
5. [Action Hooks](#action-hooks)
6. [API Integration](#api-integration)
7. [Debugging & Refactoring](#debugging--refactoring)
8. [Advanced Scenarios](#advanced-scenarios)

---

## Addon Modules

### Scenario 1: Admin Dashboard Widget

**Business Need**: Display order statistics on the admin dashboard

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/addon_modules.json
@whmcs-skills-kit/samples/addon_admin-area-output_sample_1.php

I need an addon module that adds a dashboard widget to the admin area.
The widget should:
- Display total orders this month
- Show total revenue
- List top 5 clients by spending
- Refresh every hour (cache implementation)
- Use Capsule ORM to query data

Module name: order_dashboard
Follow WHMCS 9.x standards and PSR-12 coding style.
Include unit tests.
```

**Expected Output**: Complete addon with proper structure, tests, and language files

**Time to Delivery**: ~3 minutes (with AI)

---

### Scenario 2: Client Area Announcement Banner

**Business Need**: Show clients special announcements in their client area

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/addon_modules.json
@whmcs-skills-kit/samples/addon_client-area-output_sample_1.php

Create an addon module that:
- Allows admin to create/edit announcements via admin-only interface
- Displays announcements as a banner in client area
- Stores announcements in custom database table
- Has configuration to set announcement priority
- Includes client-specific announcement filtering (by product/group)

Module name: client_announcements
Use Smarty v4 for templates.
Include database initialization in _activate function.
```

**Expected Output**: Full addon with admin config, client display, templates, schema

---

### Scenario 3: Client Activity Tracker

**Business Need**: Track and display client dashboard activities

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/addon_modules.json

I need an addon that tracks client activities:
- Log every client action (login, invoice view, ticket create)
- Display activity timeline in client dashboard widget
- Provide admin reporting page
- Include activity export to CSV

Module name: activity_tracker
Include:
- Admin configuration panel
- Client area widget display
- Custom table schema
- Hook implementations for activity logging
- Error handling and logging
```

**Expected Output**: Comprehensive addon with hooks, templates, reporting

---

## Provisioning Modules

### Scenario 1: cPanel/WHM Provisioning Module

**Business Need**: Automate hosting account provisioning on cPanel servers

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/provisioning_modules.json
@whmcs-skills-kit/samples/

Create a provisioning module for cPanel/WHM that:
- Creates hosting accounts with custom packages
- Automatically generates email accounts
- Creates FTP accounts
- Handles suspension/unsuspension via API
- Properly handles termination
- Includes admin notes and password display
- Implements error logging and API call logging

Module name: cpanel_provisioner
Server type: Hosting
Include:
- Proper error handling for API failures
- Retry logic for transient failures
- Admin area output showing account details
- Client area output for password reset
- Security: encrypt API credentials
```

**Expected Output**: Full provisioning module with API integration, error handling

---

### Scenario 2: Docker/Cloud VPS Module

**Business Need**: Provision virtualized containers for clients

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/provisioning_modules.json

Create a provisioning module for Docker-based VPS:
- Create containers with specified resources (CPU, RAM, disk)
- Support custom OS images
- Handle reboot, suspend, resume operations
- Display real-time resource usage in admin/client area
- Allow clients to reboot/resize their container
- Include webhook integration for container events

Module name: docker_vps_provisioner
Include configuration fields for:
- Docker daemon connection details
- Resource limits (min/max CPU, RAM)
- Allowed OS images
- Implement proper API error handling
- Use Capsule for local data storage
```

**Expected Output**: Cloud VPS provisioning module with client control panel

---

### Scenario 3: Email Hosting Provisioning

**Business Need**: Manage email accounts and servers

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/provisioning_modules.json

Create a provisioning module for managed email hosting:
- Create mailboxes with specified quota
- Create distribution lists
- Manage spam/virus filtering settings
- Display webmail access links
- Allow password resets
- Quota usage monitoring

Module name: email_hosting_provisioner
Include:
- Admin configuration for email server settings
- Client area for mailbox management
- Real-time quota reporting
- Automatic provisioning of default accounts
- Error recovery for failed operations
```

**Expected Output**: Email management provisioning module

---

## Registrar Modules

### Scenario 1: Namecheap Registrar Integration

**Business Need**: Register and manage domains via Namecheap API

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/registrar_modules.json
@whmcs-skills-kit/samples/registrar_*.php

Create a registrar module for Namecheap:
- Register new domains
- Renew existing domains
- Update nameservers
- Manage domain locking
- Check domain availability
- Handle ID protection (WHOIS privacy)
- Sync domain status and expiration dates

Module name: namecheap
Include:
- Proper API error handling
- Automatic pricing sync
- Admin notes field for tracking
- Webhook support for domain events
- Test mode support
```

**Expected Output**: Full registrar module with API integration

---

### Scenario 2: Cloudflare Registrar

**Business Need**: Manage domains through Cloudflare's registrar service

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/registrar_modules.json

Create a registrar module for Cloudflare:
- Domain registration and renewal
- Automatic nameserver pointing to Cloudflare
- DNS management integration display
- Transfer in/out support
- DNSSEC configuration UI
- Domain locking and auto-renewal settings

Module name: cloudflare_registrar
Include:
- OAuth integration (secure credential storage)
- Admin configuration panel
- Client area domain management
- Automatic SSL/TLS certificate provisioning display
- Rate limiting and error handling
```

**Expected Output**: Cloudflare registrar module with advanced features

---

## Payment Gateways

### Scenario 1: Stripe Payment Gateway (Merchant)

**Business Need**: Accept payments directly via Stripe

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/payment_gateways.json
@whmcs-skills-kit/samples/payment_merchant_merchant-gateway_sample_1.php
@whmcs-skills-kit/samples/payment_merchant_merchant-gateway_sample_2.php

Create a merchant payment gateway for Stripe:
- Accept credit/debit card payments
- Handle 3D Secure authentication
- Support one-time and recurring payments
- Implement SCA/PCI compliance
- Add webhook handling for payment events
- Include refund processing

Module name: stripe_merchant
Features:
- Seamless integration with WHMCS payment system
- Test mode and live mode support
- Admin configuration for API keys
- Card tokenization for recurring billing
- Proper error messages for declined cards
- Full webhook signature validation
- Database logging of transactions
```

**Expected Output**: Production-ready Stripe payment gateway

---

### Scenario 2: PayPal Third-Party Gateway

**Business Need**: Redirect payments to PayPal

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/payment_gateways.json
@whmcs-skills-kit/samples/payment_thirdparty_third-party-gateway_sample_1.php

Create a third-party payment gateway for PayPal:
- Redirect clients to PayPal checkout
- Handle return/callback from PayPal
- Support IPN (Instant Payment Notification) webhook
- Properly validate return amounts
- Error handling for failed transactions
- Transaction logging and reconciliation

Module name: paypal_thirdparty
Include:
- Admin configuration panel
- Test/live mode toggle
- Currency conversion support
- Proper SQL injection prevention
- Webhook validation and signature checking
- User-friendly error messages
```

**Expected Output**: Third-party PayPal gateway module

---

### Scenario 3: Cryptocurrency Payment Gateway

**Business Need**: Accept Bitcoin/Ethereum payments

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/payment_gateways.json

Create a cryptocurrency payment gateway:
- Support Bitcoin, Ethereum, and Litecoin
- Real-time price conversion
- Automatic payment verification via blockchain
- Client receives crypto address for payment
- Automatic invoice marking when payment received
- Admin notification of incoming payments

Module name: crypto_payments
Authentication system: Use external API (Coinbase Commerce, BTCPay)
Include:
- Real-time exchange rate fetching
- Transaction tracking
- Refund capability (crypto refund address)
- Webhook integration for payment confirmation
- Timeout handling for unpaid invoices
- Logging and error handling
```

**Expected Output**: Cryptocurrency payment processing module

---

## Action Hooks

### Scenario 1: Client Onboarding Automation

**Business Need**: Automate actions when new clients register

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/hooks.json

Create a hook-based addon for client onboarding:
- Trigger on client registration (ClientAdd hook)
- Automatically send welcome email with resources
- Create welcome support ticket
- Assign account manager (if configured)
- Log activity in system log
- Add client to mailing list

Module name: client_onboarding_hooks
Include hooks for:
- ClientAdd: Initial welcome sequence
- AfterClientRegister: Post-registration activities
- Implement logging and error handling
- Use localAPI for any API calls
- No database modifications in hooks
```

**Expected Output**: Hook-based automation addon

---

### Scenario 2: Invoice Automation

**Business Need**: Automatically process invoices and send reminders

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/hooks.json

Create hooks for invoice automation:
- Send reminder before invoice due (DaylyCronJob)
- Automatically suspend services if unpaid (DailyCronJob)
- Send thank you email when paid (InvoicePaid)
- Log payment receipts
- Update internal notes when past due

Module name: invoice_automation_hooks
Implement hooks:
- DailyCronJob: Check overdue invoices
- InvoicePaid: Payment confirmation workflow
- Use Capsule for data tracking
- Proper error handling and logging
```

**Expected Output**: Invoice automation hook system

---

### Scenario 3: Support Ticket Enhancement

**Business Need**: Add features to support ticketing

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/hooks.json

Create hooks to enhance support tickets:
- Auto-assign based on department rules (TicketOpen)
- Add canned responses based on keywords (TicketAdminReply)
- Log ticket activity to external system (TicketUserReply)
- Track resolution time metrics (TicketClose)
- Escalate tickets with no response after 24h (DailyCronJob)

Module name: ticket_enhancement_hooks
Implement hooks:
- TicketOpen: Smart assignment
- TicketAdminReply: Canned response suggestion
- DailyCronJob: Escalation checker
- Use Capsule for tracking data
- Proper logging and error handling
- Webhook integration if needed
```

**Expected Output**: Support ticket enhancement system

---

## API Integration

### Scenario 1: Third-Party CRM Sync

**Business Need**: Keep clients synchronized between WHMCS and external CRM

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/api.json

Create an addon that syncs WHMCS data to external CRM:
- Use ClientAdd/ClientEdit hooks to trigger sync
- Send client data to CRM via API
- Sync orders and transactions
- Update client notes with CRM reference ID
- Handle API failures gracefully

Module name: crm_connector
API endpoint: Configurable
Include:
- Admin configuration for API credentials
- Test connection functionality
- Sync history and logs
- Retry logic for failed syncs
- Proper error handling and user feedback
- Use encrypt() for API credentials
```

**Expected Output**: CRM integration addon

---

### Scenario 2: Custom Reporting System

**Business Need**: Build advanced reports pulling WHMCS API data

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/api.json

Create an addon with custom API-based reporting:
- Financial reports (revenue, profit by product)
- Client analytics (acquisition, churn, LTV)
- Performance metrics (support response time)
- Export to PDF/CSV/JSON
- Scheduled email reporting

Module name: advanced_reports
Use APIs:
- GetStats: System statistics
- GetInvoices: Invoice data
- GetClients: Client and transaction data
- GetTickets: Support metrics
Include:
- Caching for performance
- Scheduled report generation
- Email delivery
- Chart visualizations
```

**Expected Output**: Advanced reporting system

---

## Debugging & Refactoring

### Scenario 1: Modernize Legacy Addon Module

**Business Need**: Update old WHMCS 6.x module to WHMCS 9.x standards

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/addon_modules.json
@whmcs-skills-kit/samples/addon_*.php

Modernize this old WHMCS module to WHMCS 9.x standards:
[paste your entire module code here]

Specifically:
- Replace mysql_* with Capsule ORM
- Update Smarty v2 templates to v4 syntax
- Apply PSR-12 coding standards
- Add strict types declaration
- Replace deprecated functions
- Add proper error handling
- Optimize database queries
- Add security improvements

Generate the modernized version with explanation of all changes.
```

**Expected Output**: Fully modernized module with change log

---

### Scenario 2: Debug Module Activation Error

**Business Need**: Fix a module that won't activate

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/guide/QUICK-START.md (Gotchas section)

My addon module won't activate. Here's the error message:

[paste error message]

Here's my module code:

[paste your module code]

Debug this using WHMCS best practices.
Check for:
- Syntax errors
- Missing required functions
- Database schema issues
- Permission problems
- Path issues
```

**Expected Output**: Identified issue and fixed code

---

### Scenario 3: Performance Optimization

**Business Need**: Speed up a slow module

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/guide/SKILL.md (Section 4: Database Operations)

My admin dashboard widget is loading slowly. Here's the code:

[paste your code]

Optimize this for performance by:
- Adding database indexes
- Implementing caching
- Reducing API calls
- Using query optimization
- Proper Capsule usage

Explain the performance improvements made.
```

**Expected Output**: Optimized code with performance metrics

---

## Advanced Scenarios

### Scenario 1: Real-Time Notification System

**Business Need**: Send real-time notifications to clients and admins

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/notification_providers.json

Create an advanced notification system addon:
- WebSocket/SSE support for real-time updates
- Email notifications with templates
- SMS notifications (configurable gateway)
- In-app notifications with unread counter
- Notification preferences per user

Module name: realtime_notifications
Include:
- Notification dispatcher
- Custom table schema for notifications
- Hook integration for all events
- Admin notification management
- Client notification preferences UI
- Proper error handling and retry logic
```

**Expected Output**: Real-time notification system

---

### Scenario 2: Custom SSL Certificate Management

**Business Need**: Manage SSL certificates for hosted domains

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/provisioning_modules.json

Create a provisioning module for SSL certificates:
- Integration with Let's Encrypt API (ACME)
- Support for domain validation methods (DNS, HTTP)
- Automatic certificate renewal before expiry
- CSR generation and installation
- Admin area for bulk actions
- Client area for certificate management

Module name: ssl_cert_manager
Include:
- Automated renewal checking (cron)
- Webhook support for certificate events
- Database tracking of certificates
- Email notifications before expiry
- Proper error logging and recovery
```

**Expected Output**: SSL certificate management module

---

### Scenario 3: Full Multi-Tenant SAAS Module

**Business Need**: Build a complete SAAS product with WHMCS

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/provisioning_modules.json

Create a complete SAAS addon module:
- Provision isolated tenant environments
- Domain/subdomain management
- Database isolation
- Client management and user roles
- API for tenant applications
- Usage tracking and billing
- Admin panel for tenant oversight

Module name: saas_manager
Highly complex - include:
- Provisioning module for tenant creation
- Addon module for admin/client management
- Custom API endpoints
- Database schema for multi-tenancy
- Backup and disaster recovery
- Security isolation between tenants
- Comprehensive error handling and logging
- Unit and integration tests
```

**Expected Output**: Complete SAAS platform module

---

## Prompt Template

Copy this template for your own scenarios:

```
@whmcs-skills-kit/guide/SKILL.md
@whmcs-skills-kit/modules/[RELEVANT_JSON_FILES]
@whmcs-skills-kit/samples/[RELEVANT_SAMPLES]

[Your Scenario/Business Need]

Module name: [name]
Requirements:
- [Feature 1]
- [Feature 2]
- [Feature 3]

Include:
- [Code pattern 1]
- [Code pattern 2]
- [Testing approach]

Follow WHMCS [version] standards and [specific requirements].
```

---

For more examples and discussion, check:
- Official WHMCS Marketplace modules for inspiration
- WHMCS Developer Forums
- Community GitHub repositories

Happy building! 🚀
