# WHMCS AI Agent Skills Index

## API Commands

| Command | Description | Definition |
| --- | --- | --- |
| AcceptOrder | Accepts a pending order | [AcceptOrder](api-reference/acceptorder.json) |
| AcceptQuote | Accepts a quote | [AcceptQuote](api-reference/acceptquote.json) |
| ActivateModule | Activates a given module. | [ActivateModule](api-reference/activatemodule.json) |
| AddAnnouncement | Adds an announcement. | [AddAnnouncement](api-reference/addannouncement.json) |
| AddBannedIp | Adds an IP to the ban list. | [AddBannedIp](api-reference/addbannedip.json) |
| AddBillableItem | Adds a Billable Item | [AddBillableItem](api-reference/addbillableitem.json) |
| AddCancelRequest | Adds a Cancellation Request | [AddCancelRequest](api-reference/addcancelrequest.json) |
| AddClient | Adds a client. | [AddClient](api-reference/addclient.json) |
| AddClientNote | Adds a Client Note | [AddClientNote](api-reference/addclientnote.json) |
| AddContact | Adds a contact to a client account. | [AddContact](api-reference/addcontact.json) |
| AddCredit | Adds credit to a given client. | [AddCredit](api-reference/addcredit.json) |
| AddInvoicePayment | Adds payment to a given invoice. | [AddInvoicePayment](api-reference/addinvoicepayment.json) |
| AddOrder | Adds an order to a client. For more flow control, this method ignores the "Automatically setup the p... | [AddOrder](api-reference/addorder.json) |
| AddPayMethod | Add a Pay Method to a given client. Supports the creation of credit card and bank account pay method... | [AddPayMethod](api-reference/addpaymethod.json) |
| AddProduct | Adds a product to the system to be available for purchase | [AddProduct](api-reference/addproduct.json) |
| AddProjectMessage | Adds a Message to a project | [AddProjectMessage](api-reference/addprojectmessage.json) |
| AddProjectTask | Adds a Task to a project | [AddProjectTask](api-reference/addprojecttask.json) |
| AddTicketNote | Add a note to a ticket by Ticket ID or Ticket Number. | [AddTicketNote](api-reference/addticketnote.json) |
| AddTicketReply | Add a reply to a ticket by Ticket ID. | [AddTicketReply](api-reference/addticketreply.json) |
| AddTransaction | Add a transaction to the system | [AddTransaction](api-reference/addtransaction.json) |
| AddUser | Add a user. | [AddUser](api-reference/adduser.json) |
| AffiliateActivate | Activate affiliate referrals for a client. | [AffiliateActivate](api-reference/affiliateactivate.json) |
| ApplyCredit | Applies the Client's Credit to an invoice | [ApplyCredit](api-reference/applycredit.json) |
| BlockTicketSender | Blocks a ticket sender. | [BlockTicketSender](api-reference/blockticketsender.json) |
| CancelOrder | Cancel a Pending Order | [CancelOrder](api-reference/cancelorder.json) |
| CapturePayment | Attempt to capture a payment on an unpaid CC Invoice | [CapturePayment](api-reference/capturepayment.json) |
| CloseClient | Close a Client. | [CloseClient](api-reference/closeclient.json) |
| CreateClientInvite | Send an invite to manage a client. | [CreateClientInvite](api-reference/createclientinvite.json) |
| CreateInvoice | Create an invoice using the provided parameters. | [CreateInvoice](api-reference/createinvoice.json) |
| CreateOAuthCredential | Create an OAuth Credential | [CreateOAuthCredential](api-reference/createoauthcredential.json) |
| CreateOrUpdateTLD | Create or Update a TLD Extension. If a TLD exists, the existing record will be updated. If it does n... | [CreateOrUpdateTLD](api-reference/createorupdatetld.json) |
| CreateProject | Creates a new project | [CreateProject](api-reference/createproject.json) |
| CreateQuote | Creates a new quote | [CreateQuote](api-reference/createquote.json) |
| CreateSsoToken | Create a single use, client or user single sign-on access token | [CreateSsoToken](api-reference/createssotoken.json) |
| DeactivateModule | Deactivates a given module. | [DeactivateModule](api-reference/deactivatemodule.json) |
| DecryptPassword | Decrypt an encrypted string | [DecryptPassword](api-reference/decryptpassword.json) |
| DeleteAnnouncement | Delete an announcement | [DeleteAnnouncement](api-reference/deleteannouncement.json) |
| DeleteClient | Deletes a client. | [DeleteClient](api-reference/deleteclient.json) |
| DeleteContact | Deletes a contact. | [DeleteContact](api-reference/deletecontact.json) |
| DeleteOAuthCredential | Deletes an OAuth Credential Record. | [DeleteOAuthCredential](api-reference/deleteoauthcredential.json) |
| DeleteOrder | Deletes a cancelled or fraud order. | [DeleteOrder](api-reference/deleteorder.json) |
| DeletePayMethod | Delete a Pay Method. | [DeletePayMethod](api-reference/deletepaymethod.json) |
| DeleteProjectTask | Deletes a task associated with a project | [DeleteProjectTask](api-reference/deleteprojecttask.json) |
| DeleteQuote | Deletes a quote. | [DeleteQuote](api-reference/deletequote.json) |
| DeleteTicket | Deletes a ticket. | [DeleteTicket](api-reference/deleteticket.json) |
| DeleteTicketNote | Deletes a ticket note. | [DeleteTicketNote](api-reference/deleteticketnote.json) |
| DeleteTicketReply | Deletes a ticket reply. | [DeleteTicketReply](api-reference/deleteticketreply.json) |
| DeleteUserClient | Delete relationship between user and client. | [DeleteUserClient](api-reference/deleteuserclient.json) |
| DomainGetLockingStatus | Obtains the current lock status of the domain. | [DomainGetLockingStatus](api-reference/domaingetlockingstatus.json) |
| DomainGetNameservers | Obtains the current nameservers for the domain. | [DomainGetNameservers](api-reference/domaingetnameservers.json) |
| DomainGetWhoisInfo | Obtains the current whois information for the domain. | [DomainGetWhoisInfo](api-reference/domaingetwhoisinfo.json) |
| DomainRegister | Sends the Register command to the registrar for the domain | [DomainRegister](api-reference/domainregister.json) |
| DomainRelease | Sends the Release command to the registrar for the domain to a new tag | [DomainRelease](api-reference/domainrelease.json) |
| DomainRenew | Sends the Renew command to the registrar for the domain | [DomainRenew](api-reference/domainrenew.json) |
| DomainRequestEPP | Sends the Request EPP command to the registrar for the domain | [DomainRequestEPP](api-reference/domainrequestepp.json) |
| DomainToggleIdProtect | Sends the Toggle ID Protect command to the registrar for the domain | [DomainToggleIdProtect](api-reference/domaintoggleidprotect.json) |
| DomainTransfer | Sends the Transfer command to the registrar for the domain | [DomainTransfer](api-reference/domaintransfer.json) |
| DomainUpdateLockingStatus | Sends the Update Lock command to the registrar for the domain | [DomainUpdateLockingStatus](api-reference/domainupdatelockingstatus.json) |
| DomainUpdateNameservers | Sends the Save Nameservers command to the registrar for the domain | [DomainUpdateNameservers](api-reference/domainupdatenameservers.json) |
| DomainUpdateWhoisInfo | Sends the Save Whois command to the registrar for the domain | [DomainUpdateWhoisInfo](api-reference/domainupdatewhoisinfo.json) |
| DomainWhois | Retrieve domain whois information. | [DomainWhois](api-reference/domainwhois.json) |
| EncryptPassword | Encrypt a string. | [EncryptPassword](api-reference/encryptpassword.json) |
| EndTaskTimer | Ends a started timer for a project | [EndTaskTimer](api-reference/endtasktimer.json) |
| FraudOrder | Marks an order as fraudulent. | [FraudOrder](api-reference/fraudorder.json) |
| GenInvoices | Generate any invoices that are due to be generated | [GenInvoices](api-reference/geninvoices.json) |
| GetActivityLog | Obtain the Activity Log that matches passed criteria | [GetActivityLog](api-reference/getactivitylog.json) |
| GetAdminDetails | Obtain the details for the current Admin User | [GetAdminDetails](api-reference/getadmindetails.json) |
| GetAdminUsers | Retrieve a list of administrator user accounts. | [GetAdminUsers](api-reference/getadminusers.json) |
| GetAffiliates | Obtain an array of affiliates | [GetAffiliates](api-reference/getaffiliates.json) |
| GetAnnouncements | Obtain an array of announcements | [GetAnnouncements](api-reference/getannouncements.json) |
| GetAutomationLog | Get Automation Task Log. | [GetAutomationLog](api-reference/getautomationlog.json) |
| GetCancelledPackages | Obtain an array of cancellation requests | [GetCancelledPackages](api-reference/getcancelledpackages.json) |
| GetClientGroups | Obtain an array of client groups | [GetClientGroups](api-reference/getclientgroups.json) |
| GetClientPassword | Obtain the encrypted client password | [GetClientPassword](api-reference/getclientpassword.json) |
| GetClients | Obtain the Clients that match passed criteria | [GetClients](api-reference/getclients.json) |
| GetClientsAddons | Obtain the Clients Product Addons that match passed criteria | [GetClientsAddons](api-reference/getclientsaddons.json) |
| GetClientsDetails | Obtain the Clients Details for a specific client | [GetClientsDetails](api-reference/getclientsdetails.json) |
| GetClientsDomains | Obtain a list of Client Purchased Domains matching the provided criteria | [GetClientsDomains](api-reference/getclientsdomains.json) |
| GetClientsProducts | Obtain a list of Client Purchased Products matching the provided criteria | [GetClientsProducts](api-reference/getclientsproducts.json) |
| GetConfigurationValue | Retrieve a System Configuration Value. | [GetConfigurationValue](api-reference/getconfigurationvalue.json) |
| GetContacts | Obtain the Client Contacts that match passed criteria | [GetContacts](api-reference/getcontacts.json) |
| GetCredits | Obtain the Credit Log for a Client Account | [GetCredits](api-reference/getcredits.json) |
| GetCurrencies | Obtain the Currencies configured in the System | [GetCurrencies](api-reference/getcurrencies.json) |
| GetEmails | Obtain a list of emails sent to a specific Client ID | [GetEmails](api-reference/getemails.json) |
| GetEmailTemplates | Obtain a list of email templates from the system | [GetEmailTemplates](api-reference/getemailtemplates.json) |
| GetHealthStatus | Get health status. | [GetHealthStatus](api-reference/gethealthstatus.json) |
| GetInvoice | Retrieve a specific invoice | [GetInvoice](api-reference/getinvoice.json) |
| GetInvoices | Retrieve a list of invoices. | [GetInvoices](api-reference/getinvoices.json) |
| GetModuleConfigurationParameters | Obtains the Module Configuration Parameters | [GetModuleConfigurationParameters](api-reference/getmoduleconfigurationparameters.json) |
| GetModuleQueue | Obtains the Module Queue for Incomplete Failed Actions | [GetModuleQueue](api-reference/getmodulequeue.json) |
| GetOrders | Obtain orders matching the passed criteria | [GetOrders](api-reference/getorders.json) |
| GetOrderStatuses | Retrieve a list of order statuses and related counts | [GetOrderStatuses](api-reference/getorderstatuses.json) |
| GetPaymentMethods | Retrieve Activated Payment Methods | [GetPaymentMethods](api-reference/getpaymentmethods.json) |
| GetPayMethods | Obtain the Pay Methods associated with a provided client id. | [GetPayMethods](api-reference/getpaymethods.json) |
| GetPermissionsList | Retrieve a list of permissions that can be used when creating a user | [GetPermissionsList](api-reference/getpermissionslist.json) |
| GetProducts | Retrieve configured products matching provided criteria | [GetProducts](api-reference/getproducts.json) |
| GetProject | Retrieve a specific Project | [GetProject](api-reference/getproject.json) |
| GetProjects | Obtain orders matching the passed criteria | [GetProjects](api-reference/getprojects.json) |
| GetPromotions | Obtain promotions matching the passed criteria | [GetPromotions](api-reference/getpromotions.json) |
| GetQuotes | Obtain quotes matching the passed criteria | [GetQuotes](api-reference/getquotes.json) |
| GetRegistrars | Get Registrars. | [GetRegistrars](api-reference/getregistrars.json) |
| GetServers | Get servers. | [GetServers](api-reference/getservers.json) |
| GetStaffOnline | Retrieve a list of currently logged in admin users. | [GetStaffOnline](api-reference/getstaffonline.json) |
| GetStats | Get business performance metrics and statistics. | [GetStats](api-reference/getstats.json) |
| GetSupportDepartments | Get the support departments and associated ticket counts | [GetSupportDepartments](api-reference/getsupportdepartments.json) |
| GetSupportStatuses | Get the support statuses and number of tickets in each status | [GetSupportStatuses](api-reference/getsupportstatuses.json) |
| GetTicket | Obtain a specific ticket | [GetTicket](api-reference/getticket.json) |
| GetTicketAttachment | Retrieve a single attachment. | [GetTicketAttachment](api-reference/getticketattachment.json) |
| GetTicketCounts | Get ticket counts. | [GetTicketCounts](api-reference/getticketcounts.json) |
| GetTicketNotes | Obtain a specific ticket notes | [GetTicketNotes](api-reference/getticketnotes.json) |
| GetTicketPredefinedCats | Obtain the Predefined Ticket Reply Categories | [GetTicketPredefinedCats](api-reference/getticketpredefinedcats.json) |
| GetTicketPredefinedReplies | Obtain the Predefined Ticket Replies | [GetTicketPredefinedReplies](api-reference/getticketpredefinedreplies.json) |
| GetTickets | Obtain tickets matching the passed criteria | [GetTickets](api-reference/gettickets.json) |
| GetTLDPricing | Retrieve TLD pricing | [GetTLDPricing](api-reference/gettldpricing.json) |
| GetToDoItems | Get To-Do List Items. | [GetToDoItems](api-reference/gettodoitems.json) |
| GetToDoItemStatuses | Obtain To Do item statuses and counts | [GetToDoItemStatuses](api-reference/gettodoitemstatuses.json) |
| GetTransactions | Obtain transactions matching the passed criteria | [GetTransactions](api-reference/gettransactions.json) |
| GetUserPermissions | Provide the permissions of a user for a client. | [GetUserPermissions](api-reference/getuserpermissions.json) |
| GetUsers | Obtain the Users that match passed criteria | [GetUsers](api-reference/getusers.json) |
| ListOAuthCredentials | List OAuth Credentials matching passed criteria | [ListOAuthCredentials](api-reference/listoauthcredentials.json) |
| LogActivity | Creates an activity log entry. | [LogActivity](api-reference/logactivity.json) |
| MergeTicket | Merge tickets. | [MergeTicket](api-reference/mergeticket.json) |
| ModuleChangePackage | Runs a change package action for a given service. | [ModuleChangePackage](api-reference/modulechangepackage.json) |
| ModuleChangePw | Runs a change password action for a given service. | [ModuleChangePw](api-reference/modulechangepw.json) |
| ModuleCreate | Runs the module create action for a given service. | [ModuleCreate](api-reference/modulecreate.json) |
| ModuleCustom | Runs a custom module action for a given service. | [ModuleCustom](api-reference/modulecustom.json) |
| ModuleSuspend | Runs the module suspend action for a given service. | [ModuleSuspend](api-reference/modulesuspend.json) |
| ModuleTerminate | Runs a terminate action for a given service. | [ModuleTerminate](api-reference/moduleterminate.json) |
| ModuleUnsuspend | Runs an unsuspend action for a given service. | [ModuleUnsuspend](api-reference/moduleunsuspend.json) |
| OpenTicket | Open a new ticket | [OpenTicket](api-reference/openticket.json) |
| OrderFraudCheck | Run a fraud check on a passed Order ID using the active fraud module. | [OrderFraudCheck](api-reference/orderfraudcheck.json) |
| PendingOrder | Sets an order, and all associated order items to Pending status | [PendingOrder](api-reference/pendingorder.json) |
| ResetPassword | Starts the password reset process for a user. | [ResetPassword](api-reference/resetpassword.json) |
| SendAdminEmail | Send an Admin Email Notification | [SendAdminEmail](api-reference/sendadminemail.json) |
| SendEmail | Send a client Email Notification. | [SendEmail](api-reference/sendemail.json) |
| SendQuote | Send a quote to the associated client | [SendQuote](api-reference/sendquote.json) |
| SetConfigurationValue | Set a System Configuration Value via the local API only. | [SetConfigurationValue](api-reference/setconfigurationvalue.json) |
| StartTaskTimer | Starts a timer for a project | [StartTaskTimer](api-reference/starttasktimer.json) |
| TriggerNotificationEvent | Trigger a Custom Notification Event. | [TriggerNotificationEvent](api-reference/triggernotificationevent.json) |
| UpdateAdminNotes | Update the admin notes | [UpdateAdminNotes](api-reference/updateadminnotes.json) |
| UpdateAnnouncement | Update a specific announcement | [UpdateAnnouncement](api-reference/updateannouncement.json) |
| UpdateClient | Updates a client with the passed parameters. | [UpdateClient](api-reference/updateclient.json) |
| UpdateClientAddon | Updates a Client Addon | [UpdateClientAddon](api-reference/updateclientaddon.json) |
| UpdateClientDomain | Updates a Client Domain | [UpdateClientDomain](api-reference/updateclientdomain.json) |
| UpdateClientProduct | Updates a Client Service | [UpdateClientProduct](api-reference/updateclientproduct.json) |
| UpdateContact | Updates a contact with the passed parameters. | [UpdateContact](api-reference/updatecontact.json) |
| UpdateInvoice | Update an invoice using the provided parameters. | [UpdateInvoice](api-reference/updateinvoice.json) |
| UpdateModuleConfiguration | Activates a given module. | [UpdateModuleConfiguration](api-reference/updatemoduleconfiguration.json) |
| UpdateOAuthCredential | Updates a given OAuth API Client Credential. | [UpdateOAuthCredential](api-reference/updateoauthcredential.json) |
| UpdatePayMethod | Update a Credit Card Pay Method. | [UpdatePayMethod](api-reference/updatepaymethod.json) |
| UpdateProject | Updates a project | [UpdateProject](api-reference/updateproject.json) |
| UpdateProjectTask | Adds a Task to a project | [UpdateProjectTask](api-reference/updateprojecttask.json) |
| UpdateQuote | Updates an existing quote | [UpdateQuote](api-reference/updatequote.json) |
| UpdateTicket | Updates an existing ticket | [UpdateTicket](api-reference/updateticket.json) |
| UpdateTicketReply | Updates a ticket reply message. | [UpdateTicketReply](api-reference/updateticketreply.json) |
| UpdateToDoItem | Update To-Do Item. | [UpdateToDoItem](api-reference/updatetodoitem.json) |
| UpdateTransaction | Updates a transaction in the system | [UpdateTransaction](api-reference/updatetransaction.json) |
| UpdateUser | Update a user. | [UpdateUser](api-reference/updateuser.json) |
| UpdateUserPermissions | Update the permissions of a user for a client. | [UpdateUserPermissions](api-reference/updateuserpermissions.json) |
| UpgradeProduct | Upgrade, or calculate an upgrade on, a product | [UpgradeProduct](api-reference/upgradeproduct.json) |
| ValidateLogin | This command can be used to validate an email address and password against a registered user in WHMC... | [ValidateLogin](api-reference/validatelogin.json) |
| WhmcsDetails | Obtain details pertaining to the current WHMCS installation | [WhmcsDetails](api-reference/whmcsdetails.json) |

## Hooks

| Hook | Description | Definition |
| --- | --- | --- |
| AddonActivated | Executes when an addon status is changed to Active. | [AddonActivated](hooks-reference/addon.json) |
| AddonActivation | Executes when a product addon becomes active as part of invoice payment or order acceptance, followi... | [AddonActivation](hooks-reference/addon.json) |
| AddonAdd | Executes when an addon is added to a product/service. | [AddonAdd](hooks-reference/addon.json) |
| AddonCancelled | Executes when an addon is cancelled. | [AddonCancelled](hooks-reference/addon.json) |
| AddonConfig | Executes as an addon is being displayed. | [AddonConfig](hooks-reference/addon.json) |
| AddonConfigSave | Executes as an addon is being saved. | [AddonConfigSave](hooks-reference/addon.json) |
| AddonDeleted | Executes when an addon has been deleted. | [AddonDeleted](hooks-reference/addon.json) |
| AddonEdit | Executes when an addon is modified or updated except for status updates. | [AddonEdit](hooks-reference/addon.json) |
| AddonRenewal | Executes when a product addon is being automatically renewed as part of an invoice payment. | [AddonRenewal](hooks-reference/addon.json) |
| AddonSuspended | Executes when an addon is suspended. | [AddonSuspended](hooks-reference/addon.json) |
| AddonTerminated | Executes when an addon is terminated. | [AddonTerminated](hooks-reference/addon.json) |
| AddonUnsuspended | Executes when an addon is unsuspended. | [AddonUnsuspended](hooks-reference/addon.json) |
| AfterAddonUpgrade | Executes after an addon upgrade has been processed. | [AfterAddonUpgrade](hooks-reference/addon.json) |
| LicensingAddonReissue | Executes as a license is being reissued | [LicensingAddonReissue](hooks-reference/addon.json) |
| LicensingAddonVerify | Executes as a license remote check is being completed | [LicensingAddonVerify](hooks-reference/addon.json) |
| ProductAddonDelete | Executes when a product addon is being deleted. | [ProductAddonDelete](hooks-reference/addon.json) |
| AdminAreaClientSummaryActionLinks | Allows returning of links for display on the client summary page in the Action Links section. | [AdminAreaClientSummaryActionLinks](hooks-reference/admin-area.json) |
| AdminAreaClientSummaryPage | Allows returning of output for display on the client summary page. | [AdminAreaClientSummaryPage](hooks-reference/admin-area.json) |
| AdminAreaPage | Runs on every admin area page load. All template variables defined at the time the hook is invoked a... | [AdminAreaPage](hooks-reference/admin-area.json) |
| AdminAreaViewQuotePage | Executes as the quote is being viewed. | [AdminAreaViewQuotePage](hooks-reference/admin-area.json) |
| AdminClientDomainsTabFields | Executes when a domain is being viewed in the Admin area. | [AdminClientDomainsTabFields](hooks-reference/admin-area.json) |
| AdminClientDomainsTabFieldsSave | Executes when the Domains tab in the Admin area is being saved. Receives all the $_REQUEST parameter... | [AdminClientDomainsTabFieldsSave](hooks-reference/admin-area.json) |
| AdminClientFileUpload | Executes as a client file is being uploaded from the Client Summary. | [AdminClientFileUpload](hooks-reference/admin-area.json) |
| AdminClientProfileTabFields | Executes when a client profile is being viewed in the Admin area. | [AdminClientProfileTabFields](hooks-reference/admin-area.json) |
| AdminClientProfileTabFieldsSave | Executes when the Profile in the Admin area is being saved. Receives all the $_REQUEST parameters as... | [AdminClientProfileTabFieldsSave](hooks-reference/admin-area.json) |
| AdminClientServicesTabFields | Executes when a service is being viewed in the Admin area. | [AdminClientServicesTabFields](hooks-reference/admin-area.json) |
| AdminClientServicesTabFieldsSave | Executes when the Services tab in the Admin area is being saved. Receives all the $_REQUEST paramete... | [AdminClientServicesTabFieldsSave](hooks-reference/admin-area.json) |
| AdminHomepage | Allows returning of output for display on the admin homepage | [AdminHomepage](hooks-reference/admin-area.json) |
| AdminLogin | Executes post successful authentication of an admin user | [AdminLogin](hooks-reference/admin-area.json) |
| AdminLogout | Executes on Admin log out | [AdminLogout](hooks-reference/admin-area.json) |
| AdminPredefinedAddons | Executes as the Create New Addon page is loaded. | [AdminPredefinedAddons](hooks-reference/admin-area.json) |
| AdminProductConfigFields | Executes as a product is being edited. | [AdminProductConfigFields](hooks-reference/admin-area.json) |
| AdminProductConfigFieldsSave | Executes as a product is being saved. Access The Request variables to save custom config fields. | [AdminProductConfigFieldsSave](hooks-reference/admin-area.json) |
| AdminServiceEdit | Executes when the Service has been edited by an Admin. After the changes have been made. | [AdminServiceEdit](hooks-reference/admin-area.json) |
| AuthAdmin | Executes during Admin form-based password authentication | [AuthAdmin](hooks-reference/admin-area.json) |
| AuthAdminApi |  | [AuthAdminApi](hooks-reference/admin-area.json) |
| InvoiceCreationAdminArea | Executes as an invoice is being created in the admin area | [InvoiceCreationAdminArea](hooks-reference/admin-area.json) |
| PreAdminServiceEdit | Executes as the service is being saved, before any changes have been made. | [PreAdminServiceEdit](hooks-reference/admin-area.json) |
| ViewOrderDetailsPage | Executes as the order details page is being displayed | [ViewOrderDetailsPage](hooks-reference/admin-area.json) |
| ClientLoginShare | Executes as part of client login if user does not exist. | [ClientLoginShare](hooks-reference/authentication.json) |
| UserLogin | Executes when a user logs in. | [UserLogin](hooks-reference/authentication.json) |
| UserLogout | Executes when a user logs out. | [UserLogout](hooks-reference/authentication.json) |
| ClientAreaDomainDetails | Executes when the domain details page is loaded within the client area. This hook runs regardless of... | [ClientAreaDomainDetails](hooks-reference/client-area-interface.json) |
| ClientAreaHomepage | Executes on rendering of the client area homepage. | [ClientAreaHomepage](hooks-reference/client-area-interface.json) |
| ClientAreaHomepagePanels | Executes prior to rendering the Client Area Homepage panels. This can be used to manipulate and add ... | [ClientAreaHomepagePanels](hooks-reference/client-area-interface.json) |
| ClientAreaNavbars | Executes when generating the navigation bars in the client area | [ClientAreaNavbars](hooks-reference/client-area-interface.json) |
| ClientAreaPage | Executes on all pages of the client area and accepts a return of key/value pairs to be made availabl... | [ClientAreaPage](hooks-reference/client-area-interface.json) |
| ClientAreaPageAddContact | Executes on the client area add contact page and accepts a return of key/value pairs to be made avai... | [ClientAreaPageAddContact](hooks-reference/client-area-interface.json) |
| ClientAreaPageAddFunds | Executes on the client area add funds page and accepts a return of key/value pairs to be made availa... | [ClientAreaPageAddFunds](hooks-reference/client-area-interface.json) |
| ClientAreaPageAddonModule | Executes on client pages created by an addon module and accepts a return of key/value pairs to be ma... | [ClientAreaPageAddonModule](hooks-reference/client-area-interface.json) |
| ClientAreaPageAffiliates | Executes on the client area affiliates page and accepts a return of key/value pairs to be made avail... | [ClientAreaPageAffiliates](hooks-reference/client-area-interface.json) |
| ClientAreaPageAnnouncements | Executes on the client area announcements page and accepts a return of key/value pairs to be made av... | [ClientAreaPageAnnouncements](hooks-reference/client-area-interface.json) |
| ClientAreaPageBanned | Executes on the banned user page and accepts a return of key/value pairs to be made available as add... | [ClientAreaPageBanned](hooks-reference/client-area-interface.json) |
| ClientAreaPageBulkDomainManagement | Executes on the client area bulk domain management page and accepts a return of key/value pairs to b... | [ClientAreaPageBulkDomainManagement](hooks-reference/client-area-interface.json) |
| ClientAreaPageCancellation | Executes on the client area cancellation request page and accepts a return of key/value pairs to be ... | [ClientAreaPageCancellation](hooks-reference/client-area-interface.json) |
| ClientAreaPageCart | Executes on the shopping cart page and accepts a return of key/value pairs to be made available as a... | [ClientAreaPageCart](hooks-reference/client-area-interface.json) |
| ClientAreaPageChangePassword | Executes on the client area change password page and accepts a return of key/value pairs to be made ... | [ClientAreaPageChangePassword](hooks-reference/client-area-interface.json) |
| ClientAreaPageConfigureSSL | Executes on the client area SSL configuration page and accepts a return of key/value pairs to be mad... | [ClientAreaPageConfigureSSL](hooks-reference/client-area-interface.json) |
| ClientAreaPageContact | Executes on the contact form page and accepts a return of key/value pairs to be made available as ad... | [ClientAreaPageContact](hooks-reference/client-area-interface.json) |
| ClientAreaPageContacts | Executes on the client area contacts/sub-accounts management page and accepts a return of key/value ... | [ClientAreaPageContacts](hooks-reference/client-area-interface.json) |
| ClientAreaPageCreditCard | Executes on the client area manage credit card page and accepts a return of key/value pairs to be ma... | [ClientAreaPageCreditCard](hooks-reference/client-area-interface.json) |
| ClientAreaPageCreditCardCheckout | Executes on the credit card payment page and accepts a return of key/value pairs to be made availabl... | [ClientAreaPageCreditCardCheckout](hooks-reference/client-area-interface.json) |
| ClientAreaPageDomainAddons | Executes on the client area domain add-ons page and accepts a return of key/value pairs to be made a... | [ClientAreaPageDomainAddons](hooks-reference/client-area-interface.json) |
| ClientAreaPageDomainContacts | Executes on the client area domain WHOIS contact information page and accepts a return of key/value ... | [ClientAreaPageDomainContacts](hooks-reference/client-area-interface.json) |
| ClientAreaPageDomainDNSManagement | Executes on the client area domain DNS Host Record management page and accepts a return of key/value... | [ClientAreaPageDomainDNSManagement](hooks-reference/client-area-interface.json) |
| ClientAreaPageDomainDetails | Executes on the client area domain overview page and accepts a return of key/value pairs to be made ... | [ClientAreaPageDomainDetails](hooks-reference/client-area-interface.json) |
| ClientAreaPageDomainEPPCode | Executes on the client area domain EPP Code page and accepts a return of key/value pairs to be made ... | [ClientAreaPageDomainEPPCode](hooks-reference/client-area-interface.json) |
| ClientAreaPageDomainEmailForwarding | Executes on the client area domain Email Forwarding rules page and accepts a return of key/value pai... | [ClientAreaPageDomainEmailForwarding](hooks-reference/client-area-interface.json) |
| ClientAreaPageDomainRegisterNameservers | Executes on the client area domain Register Private Nameservers page and accepts a return of key/val... | [ClientAreaPageDomainRegisterNameservers](hooks-reference/client-area-interface.json) |
| ClientAreaPageDomains | Executes on the client area domains list page and accepts a return of key/value pairs to be made ava... | [ClientAreaPageDomains](hooks-reference/client-area-interface.json) |
| ClientAreaPageDownloads | Executes on the client area downloads page and accepts a return of key/value pairs to be made availa... | [ClientAreaPageDownloads](hooks-reference/client-area-interface.json) |
| ClientAreaPageEmails | Executes on the client area email history page and accepts a return of key/value pairs to be made av... | [ClientAreaPageEmails](hooks-reference/client-area-interface.json) |
| ClientAreaPageHome | Executes on the client area homepage and accepts a return of key/value pairs to be made available as... | [ClientAreaPageHome](hooks-reference/client-area-interface.json) |
| ClientAreaPageInvoices | Executes on the client area invoices page and accepts a return of key/value pairs to be made availab... | [ClientAreaPageInvoices](hooks-reference/client-area-interface.json) |
| ClientAreaPageKnowledgebase | Executes on the client area knowledgebase page and accepts a return of key/value pairs to be made av... | [ClientAreaPageKnowledgebase](hooks-reference/client-area-interface.json) |
| ClientAreaPageLogin | Executes on the login page of the client area. The following is a list of template variables common ... | [ClientAreaPageLogin](hooks-reference/client-area-interface.json) |
| ClientAreaPageLogout | Executes on the client area logout page and accepts a return of key/value pairs to be made available... | [ClientAreaPageLogout](hooks-reference/client-area-interface.json) |
| ClientAreaPageMassPay | Executes on the client area mass invoice payment page and accepts a return of key/value pairs to be ... | [ClientAreaPageMassPay](hooks-reference/client-area-interface.json) |
| ClientAreaPageNetworkIssues | Executes on the client area network issues page and accepts a return of key/value pairs to be made a... | [ClientAreaPageNetworkIssues](hooks-reference/client-area-interface.json) |
| ClientAreaPagePasswordReset | Executes on the client area password reset page and accepts a return of key/value pairs to be made a... | [ClientAreaPagePasswordReset](hooks-reference/client-area-interface.json) |
| ClientAreaPageProductDetails | Executes on the client area product overview page and accepts a return of key/value pairs to be made... | [ClientAreaPageProductDetails](hooks-reference/client-area-interface.json) |
| ClientAreaPageProductsServices | Executes on the client area product and services list page and accepts a return of key/value pairs t... | [ClientAreaPageProductsServices](hooks-reference/client-area-interface.json) |
| ClientAreaPageProfile | Executes on the client area profile page and accepts a return of key/value pairs to be made availabl... | [ClientAreaPageProfile](hooks-reference/client-area-interface.json) |
| ClientAreaPageQuotes | Executes on the client area quotes page and accepts a return of key/value pairs to be made available... | [ClientAreaPageQuotes](hooks-reference/client-area-interface.json) |
| ClientAreaPageRegister | Executes on the client registration page and accepts a return of key/value pairs to be made availabl... | [ClientAreaPageRegister](hooks-reference/client-area-interface.json) |
| ClientAreaPageSecurity | Executes on the client area security page and accepts a return of key/value pairs to be made availab... | [ClientAreaPageSecurity](hooks-reference/client-area-interface.json) |
| ClientAreaPageServerStatus | Executes on the client area server status page and accepts a return of key/value pairs to be made av... | [ClientAreaPageServerStatus](hooks-reference/client-area-interface.json) |
| ClientAreaPageUnsubscribe | Executes on the email unsubscribe page and accepts a return of key/value pairs to be made available ... | [ClientAreaPageUnsubscribe](hooks-reference/client-area-interface.json) |
| ClientAreaPageUpgrade | Executes on the client area upgrade/downgrade page and accepts a return of key/value pairs to be mad... | [ClientAreaPageUpgrade](hooks-reference/client-area-interface.json) |
| ClientAreaPageViewEmail | Executes on the client area view email page and accepts a return of key/value pairs to be made avail... | [ClientAreaPageViewEmail](hooks-reference/client-area-interface.json) |
| ClientAreaPageViewInvoice | Executes on the client area view invoice page and accepts a return of key/value pairs to be made ava... | [ClientAreaPageViewInvoice](hooks-reference/client-area-interface.json) |
| ClientAreaPageViewQuote | Executes on the client area view quote page and accepts a return of key/value pairs to be made avail... | [ClientAreaPageViewQuote](hooks-reference/client-area-interface.json) |
| ClientAreaPaymentMethods | Executes on the client area payment methods management page and accepts a return of key/value pairs ... | [ClientAreaPaymentMethods](hooks-reference/client-area-interface.json) |
| ClientAreaPrimaryNavbar | Executes when generating the primary navigation bar in the client area | [ClientAreaPrimaryNavbar](hooks-reference/client-area-interface.json) |
| ClientAreaPrimarySidebar | Executes when generating the primary side bar in the client area | [ClientAreaPrimarySidebar](hooks-reference/client-area-interface.json) |
| ClientAreaProductDetails | Executes when the product details page is loaded within the client area. This hook runs regardless o... | [ClientAreaProductDetails](hooks-reference/client-area-interface.json) |
| ClientAreaProductDetailsPreModuleTemplate | Executes when rendering the client area product details page prior to module template invocation all... | [ClientAreaProductDetailsPreModuleTemplate](hooks-reference/client-area-interface.json) |
| ClientAreaRegister | Executes after a client has used the register.php file to create a client account. | [ClientAreaRegister](hooks-reference/client-area-interface.json) |
| ClientAreaSecondaryNavbar | Executes when generating the secondary navigation bar in the client area | [ClientAreaSecondaryNavbar](hooks-reference/client-area-interface.json) |
| ClientAreaSecondarySidebar | Executes when generating the secondary side bar in the client area | [ClientAreaSecondarySidebar](hooks-reference/client-area-interface.json) |
| ClientAreaSidebars | Executes when generating the side bars in the client area | [ClientAreaSidebars](hooks-reference/client-area-interface.json) |
| AfterClientMerge | Executes after a client merge has completed. | [AfterClientMerge](hooks-reference/client.json) |
| ClientAdd | Executes as a client is being added to WHMCS. | [ClientAdd](hooks-reference/client.json) |
| ClientAlert | Executes when Client Alerts are being defined | [ClientAlert](hooks-reference/client.json) |
| ClientChangePassword | Executed when a change of password occurs for a client. | [ClientChangePassword](hooks-reference/client.json) |
| ClientClose | Executes after a client has been closed | [ClientClose](hooks-reference/client.json) |
| ClientDelete | DEPRECATED (since 8.0.0-beta.1): See PreDeleteClient hook as replacement. | [ClientDelete](hooks-reference/client.json) |
| ClientDetailsValidation | Executes before adding a client or updating a client through the Admin or Client area. | [ClientDetailsValidation](hooks-reference/client.json) |
| ClientEdit | Executes when a client is edited through the Client Area, Admin Area, or API. | [ClientEdit](hooks-reference/client.json) |
| PreDeleteClient | Executes immediately before a client is deleted | [PreDeleteClient](hooks-reference/client.json) |
| ContactAdd | Executes as a contact is being added to WHMCS. | [ContactAdd](hooks-reference/contact.json) |
| ContactDelete | Executes on Contact Delete after the contact has been removed. | [ContactDelete](hooks-reference/contact.json) |
| ContactDetailsValidation | Executes on validation of contact details. | [ContactDetailsValidation](hooks-reference/contact.json) |
| ContactEdit | Runs when a contact is edited. | [ContactEdit](hooks-reference/contact.json) |
| AfterCronJob | Runs each time that the system calls the system cron job. This occurs after all scheduled tasks fini... | [AfterCronJob](hooks-reference/cron.json) |
| DailyCronJob | Runs at the very end of the daily automation cron execution. | [DailyCronJob](hooks-reference/cron.json) |
| DailyCronJobPreEmail | Runs after tasks have completed but before email report is sent. | [DailyCronJobPreEmail](hooks-reference/cron.json) |
| PopEmailCollectionCronCompleted | Executes when the POP email collection cron completes. | [PopEmailCollectionCronCompleted](hooks-reference/cron.json) |
| PostAutomationTask | Executes after an automation task occurs | [PostAutomationTask](hooks-reference/cron.json) |
| PreAutomationTask | Executes before an automation task occurs | [PreAutomationTask](hooks-reference/cron.json) |
| PreCronJob | Runs before the daily automation cron execution. | [PreCronJob](hooks-reference/cron.json) |
| DomainDelete | Executes when a domain is being deleted from the client account. | [DomainDelete](hooks-reference/domain.json) |
| DomainEdit | Executes when the domain is being edited via the Client Profile Summary and Domains tabs in the Admi... | [DomainEdit](hooks-reference/domain.json) |
| DomainTransferCompleted | Executes when a domain transfer is set to completed by the domain sync cron. | [DomainTransferCompleted](hooks-reference/domain.json) |
| DomainTransferFailed | Executes when a domain transfer is set to failed by the domain sync cron. | [DomainTransferFailed](hooks-reference/domain.json) |
| DomainValidation | Executes as domain validation is being run | [DomainValidation](hooks-reference/domain.json) |
| PreDomainRegister | Executes before a domain register command | [PreDomainRegister](hooks-reference/domain.json) |
| PreDomainTransfer | Executes before a domain transfer command | [PreDomainTransfer](hooks-reference/domain.json) |
| PreRegistrarRegisterDomain | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarRegisterDomain](hooks-reference/domain.json) |
| PreRegistrarRenewDomain | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarRenewDomain](hooks-reference/domain.json) |
| PreRegistrarTransferDomain | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarTransferDomain](hooks-reference/domain.json) |
| TopLevelDomainAdd | Executes when a new domain extension is added. | [TopLevelDomainAdd](hooks-reference/domain.json) |
| TopLevelDomainDelete | Executes when a domain extension is deleted. | [TopLevelDomainDelete](hooks-reference/domain.json) |
| TopLevelDomainPricingUpdate | Executes when domain extension pricing is updated. | [TopLevelDomainPricingUpdate](hooks-reference/domain.json) |
| TopLevelDomainUpdate | Executes when domain extensions configuration is updated. | [TopLevelDomainUpdate](hooks-reference/domain.json) |
| AffiliateActivation | Executes as an affiliate is being activated. | [AffiliateActivation](hooks-reference/everything-else.json) |
| AffiliateClickthru | Executes when a user has clicked an affiliate referral link. | [AffiliateClickthru](hooks-reference/everything-else.json) |
| AffiliateCommission | Executes as affiliate commission is being applied to an affiliate to clear later. | [AffiliateCommission](hooks-reference/everything-else.json) |
| AffiliateWithdrawalRequest | Executes when an affiliate withdrawal request is submitted. | [AffiliateWithdrawalRequest](hooks-reference/everything-else.json) |
| AfterConfigOptionsUpgrade | Executes after a product configurable options upgrade has been processed | [AfterConfigOptionsUpgrade](hooks-reference/everything-else.json) |
| CCUpdate | Executes after CC details have been stored for a client or the remote storage functions completed. | [CCUpdate](hooks-reference/everything-else.json) |
| CalcAffiliateCommission | Executes as the amount of commission is being calculated | [CalcAffiliateCommission](hooks-reference/everything-else.json) |
| CustomFieldLoad | Executes when custom fields are being loaded | [CustomFieldLoad](hooks-reference/everything-else.json) |
| CustomFieldSave | Executes when custom fields are being saved | [CustomFieldSave](hooks-reference/everything-else.json) |
| EmailPreLog | Runs prior to email being logged. | [EmailPreLog](hooks-reference/everything-else.json) |
| EmailPreSend | Runs prior to any templated email being sent. | [EmailPreSend](hooks-reference/everything-else.json) |
| EmailTplMergeFields | Executes when editing an email template. | [EmailTplMergeFields](hooks-reference/everything-else.json) |
| FetchCurrencyExchangeRates | Executes when updating currency exchange rates. All supported automatic update currencies are return... | [FetchCurrencyExchangeRates](hooks-reference/everything-else.json) |
| IntelligentSearch | Executes as the Intelligent Search is being completed | [IntelligentSearch](hooks-reference/everything-else.json) |
| LinkTracker | Executes when a link.php link is being used. | [LinkTracker](hooks-reference/everything-else.json) |
| LogActivity | Executes after an activity log entry has been created. | [LogActivity](hooks-reference/everything-else.json) |
| NotificationPreSend | Executes prior to a notification being sent to allow for additional conditional criteria to be appli... | [NotificationPreSend](hooks-reference/everything-else.json) |
| PayMethodMigration | Executes when legacy payment details are being migrated. | [PayMethodMigration](hooks-reference/everything-else.json) |
| PreEmailSendReduceRecipients | Runs prior to a client email being sent and allows selective removal of CC and BCC recipients. | [PreEmailSendReduceRecipients](hooks-reference/everything-else.json) |
| PreUpgradeCheckout | Executes on checkout of an upgrade order, after the price calculation. The upgrade order may have co... | [PreUpgradeCheckout](hooks-reference/everything-else.json) |
| PremiumPriceOverride | Executes when searching for a premium domain. The return can alter the registration & renewal costs,... | [PremiumPriceOverride](hooks-reference/everything-else.json) |
| PremiumPriceRecalculationOverride | Executes when a premium domain price is being automatically recalculated. | [PremiumPriceRecalculationOverride](hooks-reference/everything-else.json) |
| VatNumberVerification | Verification of a VAT Number. | [VatNumberVerification](hooks-reference/everything-else.json) |
| AcceptQuote | Executes when a client is accepting a quote. | [AcceptQuote](hooks-reference/invoices-and-quotes.json) |
| AddInvoiceLateFee | Executes when a late fee has been added to an invoice | [AddInvoiceLateFee](hooks-reference/invoices-and-quotes.json) |
| AddInvoicePayment | Invoked when a payment is applied to an invoice (including partial payments). | [AddInvoicePayment](hooks-reference/invoices-and-quotes.json) |
| AddTransaction | Executes when a transaction is created. Can be a payment or a refund. | [AddTransaction](hooks-reference/invoices-and-quotes.json) |
| AfterInvoicingGenerateInvoiceItems | Executes after invoice generation allowing for after invoicing clean-up. | [AfterInvoicingGenerateInvoiceItems](hooks-reference/invoices-and-quotes.json) |
| CancelAndRefundOrder | Runs when an order is requested to be cancelled and refunded, prior to the change of status actually... | [CancelAndRefundOrder](hooks-reference/invoices-and-quotes.json) |
| InvoiceCancelled | Executes when an invoice is being cancelled | [InvoiceCancelled](hooks-reference/invoices-and-quotes.json) |
| InvoiceChangeGateway | Executes when changing the gateway on an invoice. | [InvoiceChangeGateway](hooks-reference/invoices-and-quotes.json) |
| InvoiceCreated | Executed when an invoice has left "Draft" status and is available to its respective client. Executio... | [InvoiceCreated](hooks-reference/invoices-and-quotes.json) |
| InvoiceCreation | Executes when an invoice is first created. The invoice has not been finalised and delivered to the c... | [InvoiceCreation](hooks-reference/invoices-and-quotes.json) |
| InvoiceCreationPreEmail | Executes as an invoice is being created in the admin area before the email is being sent | [InvoiceCreationPreEmail](hooks-reference/invoices-and-quotes.json) |
| InvoicePaid | Executes when an invoice is Paid following the email receipt having been sent and any automation tas... | [InvoicePaid](hooks-reference/invoices-and-quotes.json) |
| InvoicePaidPreEmail | Executes when an invoice is Paid prior to any email or automation tasks associated with the payment ... | [InvoicePaidPreEmail](hooks-reference/invoices-and-quotes.json) |
| InvoicePaymentReminder | Executes when an automated invoice payment reminder is sent. | [InvoicePaymentReminder](hooks-reference/invoices-and-quotes.json) |
| InvoiceRefunded | Executes when an invoice status is changed to Refunded. | [InvoiceRefunded](hooks-reference/invoices-and-quotes.json) |
| InvoiceSplit | Executes as an invoice is being split | [InvoiceSplit](hooks-reference/invoices-and-quotes.json) |
| InvoiceUnpaid | Executes when an invoice is being marked as Unpaid | [InvoiceUnpaid](hooks-reference/invoices-and-quotes.json) |
| LogTransaction | Runs any time a payment gateway callback is received and logged. | [LogTransaction](hooks-reference/invoices-and-quotes.json) |
| ManualRefund | Executes when an invoice is refunded via the Manual Refund option. | [ManualRefund](hooks-reference/invoices-and-quotes.json) |
| PreInvoiceAutomaticCancellation | Executes prior to an invoice being automatically cancelled. Allows the action to be aborted. | [PreInvoiceAutomaticCancellation](hooks-reference/invoices-and-quotes.json) |
| PreInvoicingGenerateInvoiceItems | Executes prior to invoice generation to allow for manipulation of stored data prior to aggregation o... | [PreInvoicingGenerateInvoiceItems](hooks-reference/invoices-and-quotes.json) |
| QuoteCreated | Executes when a quote is created. | [QuoteCreated](hooks-reference/invoices-and-quotes.json) |
| QuoteStatusChange | Executes when a quote status is updated | [QuoteStatusChange](hooks-reference/invoices-and-quotes.json) |
| UpdateInvoiceTotal | Executes when an invoice is updated with changes to or additions of line items. Can be used to manip... | [UpdateInvoiceTotal](hooks-reference/invoices-and-quotes.json) |
| ViewInvoiceDetailsPage | Executes as the invoice is being viewed as a client | [ViewInvoiceDetailsPage](hooks-reference/invoices-and-quotes.json) |
| AddonModuleConfigSave |  | [AddonModuleConfigSave](hooks-reference/module.json) |
| AfterModuleChangePackage | Executes upon successful completion of the module function. | [AfterModuleChangePackage](hooks-reference/module.json) |
| AfterModuleChangePackageFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleChangePackageFailed](hooks-reference/module.json) |
| AfterModuleChangePassword | Executes upon successful completion of a remote module API password change. | [AfterModuleChangePassword](hooks-reference/module.json) |
| AfterModuleChangePasswordFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleChangePasswordFailed](hooks-reference/module.json) |
| AfterModuleCreate | Executes upon successful completion of the module function. | [AfterModuleCreate](hooks-reference/module.json) |
| AfterModuleCreateFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleCreateFailed](hooks-reference/module.json) |
| AfterModuleCustom | Executes upon successful completion of the module custom function. | [AfterModuleCustom](hooks-reference/module.json) |
| AfterModuleCustomFailed | Executes upon failure of the module custom function to complete successfully. The failure reason is ... | [AfterModuleCustomFailed](hooks-reference/module.json) |
| AfterModuleDeprovisionAddOnFeature | Executes upon successful completion of the module function. | [AfterModuleDeprovisionAddOnFeature](hooks-reference/module.json) |
| AfterModuleDeprovisionAddOnFeatureFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleDeprovisionAddOnFeatureFailed](hooks-reference/module.json) |
| AfterModuleProvisionAddOnFeature | Executes upon successful completion of the module function. | [AfterModuleProvisionAddOnFeature](hooks-reference/module.json) |
| AfterModuleProvisionAddOnFeatureFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleProvisionAddOnFeatureFailed](hooks-reference/module.json) |
| AfterModuleSuspend | Executes upon successful completion of the module function. | [AfterModuleSuspend](hooks-reference/module.json) |
| AfterModuleSuspendAddOnFeature | Executes upon successful completion of the module function. | [AfterModuleSuspendAddOnFeature](hooks-reference/module.json) |
| AfterModuleSuspendAddOnFeatureFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleSuspendAddOnFeatureFailed](hooks-reference/module.json) |
| AfterModuleSuspendFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleSuspendFailed](hooks-reference/module.json) |
| AfterModuleTerminate | Executes upon successful completion of the module function. | [AfterModuleTerminate](hooks-reference/module.json) |
| AfterModuleTerminateFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleTerminateFailed](hooks-reference/module.json) |
| AfterModuleUnsuspend | Executes upon successful completion of the module function. | [AfterModuleUnsuspend](hooks-reference/module.json) |
| AfterModuleUnsuspendAddOnFeature | Executes upon successful completion of the module function. | [AfterModuleUnsuspendAddOnFeature](hooks-reference/module.json) |
| AfterModuleUnsuspendAddOnFeatureFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleUnsuspendAddOnFeatureFailed](hooks-reference/module.json) |
| AfterModuleUnsuspendFailed | Executes upon failure of the module function to complete successfully. The failure reason is provide... | [AfterModuleUnsuspendFailed](hooks-reference/module.json) |
| OverrideModuleUsernameGeneration | Executes as a username is being generated on module creation. | [OverrideModuleUsernameGeneration](hooks-reference/module.json) |
| PreModuleChangePackage | Executes prior to the module change package function being run for a service. Allows the action to b... | [PreModuleChangePackage](hooks-reference/module.json) |
| PreModuleChangePassword | Executes prior to the module change password function being run for a service. Allows the action to ... | [PreModuleChangePassword](hooks-reference/module.json) |
| PreModuleCreate | Executes prior to the module create function being run for a service. Allows the action to be aborte... | [PreModuleCreate](hooks-reference/module.json) |
| PreModuleCustom | Executes prior to the module custom function being run for a service. Allows the action to be aborte... | [PreModuleCustom](hooks-reference/module.json) |
| PreModuleDeprovisionAddOnFeature | Executes prior to the module deprovision function being run for a Add-On Feature. Allows the action ... | [PreModuleDeprovisionAddOnFeature](hooks-reference/module.json) |
| PreModuleProvisionAddOnFeature | Executes prior to the module provision function being run for an Add-On Feature. Allows the action t... | [PreModuleProvisionAddOnFeature](hooks-reference/module.json) |
| PreModuleRenew | Executes prior to the module create function being run for a service. Allows the action to be aborte... | [PreModuleRenew](hooks-reference/module.json) |
| PreModuleSuspend | Executes prior to the module suspend function being run for a service. Allows the action to be abort... | [PreModuleSuspend](hooks-reference/module.json) |
| PreModuleSuspendAddOnFeature | Executes prior to the module suspend function being run for an Add-On Feature. Allows the action to ... | [PreModuleSuspendAddOnFeature](hooks-reference/module.json) |
| PreModuleTerminate | Executes prior to the module terminate function being run for a service. Allows the action to be abo... | [PreModuleTerminate](hooks-reference/module.json) |
| PreModuleUnsuspend | Executes prior to the module unsuspend function being run for a service. Allows the action to be abo... | [PreModuleUnsuspend](hooks-reference/module.json) |
| PreModuleUnsuspendAddOnFeature | Executes prior to the module unsuspend function being run for an Add-On Feature. Allows the action t... | [PreModuleUnsuspendAddOnFeature](hooks-reference/module.json) |
| AdminAreaFooterOutput | Runs on every admin area page load. All template variables defined at the time the hook is invoked a... | [AdminAreaFooterOutput](hooks-reference/output.json) |
| AdminAreaHeadOutput | Runs on every admin area page load. All template variables defined at the time the hook is invoked a... | [AdminAreaHeadOutput](hooks-reference/output.json) |
| AdminAreaHeaderOutput | Runs on every admin area page load. All template variables defined at the time the hook is invoked a... | [AdminAreaHeaderOutput](hooks-reference/output.json) |
| AdminInvoicesControlsOutput | Allows returning of output for display on the invoice edit page | [AdminInvoicesControlsOutput](hooks-reference/output.json) |
| ClientAreaDomainDetailsOutput | Allows returning of output for display in the client area domain details page. | [ClientAreaDomainDetailsOutput](hooks-reference/output.json) |
| ClientAreaFooterOutput | Executes when a client area page is being output. The following is a list of template variables comm... | [ClientAreaFooterOutput](hooks-reference/output.json) |
| ClientAreaHeadOutput | Executes when a client area page is being output. The following is a list of template variables comm... | [ClientAreaHeadOutput](hooks-reference/output.json) |
| ClientAreaHeaderOutput | Executes when a client area page is being output. The following is a list of template variables comm... | [ClientAreaHeaderOutput](hooks-reference/output.json) |
| ClientAreaProductDetailsOutput | Allows returning of output for display in the client area product details page. | [ClientAreaProductDetailsOutput](hooks-reference/output.json) |
| FormatDateForClientAreaOutput | Allows for transformation of a date prior to output within the Client Area. | [FormatDateForClientAreaOutput](hooks-reference/output.json) |
| FormatDateTimeForClientAreaOutput | Allows for transformation of a date/time prior to output within the Client Area. | [FormatDateTimeForClientAreaOutput](hooks-reference/output.json) |
| ReportViewPostOutput | Executes as a report is being displayed, after the output occurs | [ReportViewPostOutput](hooks-reference/output.json) |
| ReportViewPreOutput | Executes as a report is being displayed, before the output occurs | [ReportViewPreOutput](hooks-reference/output.json) |
| ShoppingCartCheckoutOutput | Allows returning of output for display on the Shopping Cart Checkout page. | [ShoppingCartCheckoutOutput](hooks-reference/output.json) |
| ShoppingCartConfigureProductAddonsOutput |  | [ShoppingCartConfigureProductAddonsOutput](hooks-reference/output.json) |
| ShoppingCartViewCartOutput | Allows returning of output for display on the Shopping Cart View Cart page. | [ShoppingCartViewCartOutput](hooks-reference/output.json) |
| AfterProductUpgrade |  | [AfterProductUpgrade](hooks-reference/products-and-services.json) |
| ProductDelete | Executes a product is being deleted. | [ProductDelete](hooks-reference/products-and-services.json) |
| ProductEdit | Executes as a Product is being edited. | [ProductEdit](hooks-reference/products-and-services.json) |
| ServerAdd | Executes as a server is created | [ServerAdd](hooks-reference/products-and-services.json) |
| ServerDelete | Executes as a server is being deleted. | [ServerDelete](hooks-reference/products-and-services.json) |
| ServerEdit | Executes as a server is being edited. | [ServerEdit](hooks-reference/products-and-services.json) |
| AfterRegistrarGetContactDetails | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarGetContactDetails](hooks-reference/registrar-module.json) |
| AfterRegistrarGetDNS | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarGetDNS](hooks-reference/registrar-module.json) |
| AfterRegistrarGetEPPCode | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarGetEPPCode](hooks-reference/registrar-module.json) |
| AfterRegistrarGetNameservers | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarGetNameservers](hooks-reference/registrar-module.json) |
| AfterRegistrarRegister | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarRegister](hooks-reference/registrar-module.json) |
| AfterRegistrarRegistration | Executes after a successful domain register command | [AfterRegistrarRegistration](hooks-reference/registrar-module.json) |
| AfterRegistrarRegistrationFailed | Executes after a failed domain register command | [AfterRegistrarRegistrationFailed](hooks-reference/registrar-module.json) |
| AfterRegistrarRenew | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarRenew](hooks-reference/registrar-module.json) |
| AfterRegistrarRenewal | Executes after a successful domain renewal command | [AfterRegistrarRenewal](hooks-reference/registrar-module.json) |
| AfterRegistrarRenewalFailed | Executes after a failed domain renewal command | [AfterRegistrarRenewalFailed](hooks-reference/registrar-module.json) |
| AfterRegistrarRequestDelete | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarRequestDelete](hooks-reference/registrar-module.json) |
| AfterRegistrarSaveContactDetails | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarSaveContactDetails](hooks-reference/registrar-module.json) |
| AfterRegistrarSaveDNS | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarSaveDNS](hooks-reference/registrar-module.json) |
| AfterRegistrarSaveNameservers | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarSaveNameservers](hooks-reference/registrar-module.json) |
| AfterRegistrarTransfer | Executes upon completion of the registrar module function. Will execute regardless of success state. | [AfterRegistrarTransfer](hooks-reference/registrar-module.json) |
| AfterRegistrarTransferFailed | Executes after a failed domain transfer command | [AfterRegistrarTransferFailed](hooks-reference/registrar-module.json) |
| PreRegistrarGetContactDetails | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarGetContactDetails](hooks-reference/registrar-module.json) |
| PreRegistrarGetDNS | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarGetDNS](hooks-reference/registrar-module.json) |
| PreRegistrarGetEPPCode | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarGetEPPCode](hooks-reference/registrar-module.json) |
| PreRegistrarGetNameservers | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarGetNameservers](hooks-reference/registrar-module.json) |
| PreRegistrarRequestDelete | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarRequestDelete](hooks-reference/registrar-module.json) |
| PreRegistrarSaveContactDetails | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarSaveContactDetails](hooks-reference/registrar-module.json) |
| PreRegistrarSaveDNS | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarSaveDNS](hooks-reference/registrar-module.json) |
| PreRegistrarSaveNameservers | Executes prior to the registrar function being executed for a domain. Allows the action to be aborte... | [PreRegistrarSaveNameservers](hooks-reference/registrar-module.json) |
| CancellationRequest | Executes as a cancellation request is being created | [CancellationRequest](hooks-reference/service.json) |
| PreServiceEdit | Executes as the service is being saved, before any changes have been made. | [PreServiceEdit](hooks-reference/service.json) |
| ServiceDelete | Executes when the Service has been deleted. | [ServiceDelete](hooks-reference/service.json) |
| ServiceEdit | Executes when the Service has been edited. After the changes have been made. | [ServiceEdit](hooks-reference/service.json) |
| ServiceRecurringCompleted | Executes when the Recurring Cycles Limit is reached for a product. | [ServiceRecurringCompleted](hooks-reference/service.json) |
| AcceptOrder | Runs when an order is accepted prior to any acceptance actions being executed. | [AcceptOrder](hooks-reference/shopping-cart.json) |
| AddonFraud | Executes when an addon is set as fraud. | [AddonFraud](hooks-reference/shopping-cart.json) |
| AfterCalculateCartTotals | Executes after the cart totals have been calculated. | [AfterCalculateCartTotals](hooks-reference/shopping-cart.json) |
| AfterFraudCheck | Executes after a fraud check has been completed | [AfterFraudCheck](hooks-reference/shopping-cart.json) |
| AfterShoppingCartCheckout | Upon completion of checkout once the order has been created, invoice generated and all email notific... | [AfterShoppingCartCheckout](hooks-reference/shopping-cart.json) |
| CancelOrder | Runs when an order is requested to be cancelled, prior to the change of status actually occurring. | [CancelOrder](hooks-reference/shopping-cart.json) |
| CartItemsTax | Invoked as tax is being calculated for both cart and checkout, this can be used to manipulate the ta... | [CartItemsTax](hooks-reference/shopping-cart.json) |
| CartSubdomainValidation | Executes when Cart Subdomain Validation is occurring | [CartSubdomainValidation](hooks-reference/shopping-cart.json) |
| CartTotalAdjustment | Invoked as the order total is being calculated, this can be used to manipulate the final total. | [CartTotalAdjustment](hooks-reference/shopping-cart.json) |
| DeleteOrder | Runs when an order is requested to be deleted, prior to the deletion actually occurring. | [DeleteOrder](hooks-reference/shopping-cart.json) |
| FraudCheckAwaitingUserInput | Executes when the fraud check is awaiting user input. | [FraudCheckAwaitingUserInput](hooks-reference/shopping-cart.json) |
| FraudCheckFailed | Executes when the fraud check fails for a new order. | [FraudCheckFailed](hooks-reference/shopping-cart.json) |
| FraudCheckPassed | Executes when the fraud check passes successfully for a new order. | [FraudCheckPassed](hooks-reference/shopping-cart.json) |
| FraudOrder | Runs when an order is requested to be set as fraud, prior to the change of status actually occurring... | [FraudOrder](hooks-reference/shopping-cart.json) |
| OrderAddonPricingOverride | Executes as an addon price is being calculated in the cart. | [OrderAddonPricingOverride](hooks-reference/shopping-cart.json) |
| OrderDomainPricingOverride | Executes as a domain price is being calculated in the cart. | [OrderDomainPricingOverride](hooks-reference/shopping-cart.json) |
| OrderPaid | Executes when the first invoice for a new order is marked paid. This will execute in addition to the... | [OrderPaid](hooks-reference/shopping-cart.json) |
| OrderProductPricingOverride | Executes as a product price is being calculated in the cart. | [OrderProductPricingOverride](hooks-reference/shopping-cart.json) |
| OrderProductUpgradeOverride | Executes as a product upgrade order is being calculated. | [OrderProductUpgradeOverride](hooks-reference/shopping-cart.json) |
| OverrideOrderNumberGeneration | Executes prior to checkout. All cart information is passed to the hook. | [OverrideOrderNumberGeneration](hooks-reference/shopping-cart.json) |
| PendingOrder | Runs when an order is requested to be set back to pending, prior to the change of status actually oc... | [PendingOrder](hooks-reference/shopping-cart.json) |
| PreCalculateCartTotals | Executes as the cart totals are being calculated. All cart information is passed to the hook. Exampl... | [PreCalculateCartTotals](hooks-reference/shopping-cart.json) |
| PreFraudCheck |  | [PreFraudCheck](hooks-reference/shopping-cart.json) |
| PreShoppingCartCheckout | Executes prior to checkout. All cart information is passed to the hook. | [PreShoppingCartCheckout](hooks-reference/shopping-cart.json) |
| RunFraudCheck | Executes as the fraud module is being checked for an order. | [RunFraudCheck](hooks-reference/shopping-cart.json) |
| ShoppingCartCheckoutCompletePage | Executes when the Complete Page is displayed on checkout. | [ShoppingCartCheckoutCompletePage](hooks-reference/shopping-cart.json) |
| ShoppingCartValidateCheckout | Executes during checkout completion, which occurs before order and invoice creation. Use this to pre... | [ShoppingCartValidateCheckout](hooks-reference/shopping-cart.json) |
| ShoppingCartValidateDomain | Executes when Cart Domain Validation is occurring | [ShoppingCartValidateDomain](hooks-reference/shopping-cart.json) |
| ShoppingCartValidateDomainsConfig | Executes when Domain Update is occurring | [ShoppingCartValidateDomainsConfig](hooks-reference/shopping-cart.json) |
| ShoppingCartValidateProductUpdate | Executes when Product Update is occurring | [ShoppingCartValidateProductUpdate](hooks-reference/shopping-cart.json) |
| ShoppingCartValidateUpgrade | Executes during an upgrade/downgrade request to validate resource limits. | [ShoppingCartValidateUpgrade](hooks-reference/shopping-cart.json) |
| AnnouncementAdd | Executes as an announcement is being added. | [AnnouncementAdd](hooks-reference/support-tools.json) |
| AnnouncementEdit | Executes as an announcement is being added. | [AnnouncementEdit](hooks-reference/support-tools.json) |
| FileDownload | Executes when a file is being downloaded. | [FileDownload](hooks-reference/support-tools.json) |
| NetworkIssueAdd | Executes as a network issue is being crated. | [NetworkIssueAdd](hooks-reference/support-tools.json) |
| NetworkIssueClose | Executes as a network issue is being resolved. | [NetworkIssueClose](hooks-reference/support-tools.json) |
| NetworkIssueDelete | Executes as a network issue is being deleted. | [NetworkIssueDelete](hooks-reference/support-tools.json) |
| NetworkIssueEdit | Executes as a network issue is being edited. | [NetworkIssueEdit](hooks-reference/support-tools.json) |
| NetworkIssueReopen | Executes as a network issue is being re-opened. | [NetworkIssueReopen](hooks-reference/support-tools.json) |
| AdminAreaViewTicketPage | Executes when an admin views a support ticket within the admin area. | [AdminAreaViewTicketPage](hooks-reference/ticket.json) |
| AdminAreaViewTicketPageSidebar | Executes when an admin views a support ticket within the admin area. | [AdminAreaViewTicketPageSidebar](hooks-reference/ticket.json) |
| AdminSupportTicketPagePreTickets | Executes prior to aggregation and output of the support tickets listing page within the admin area. | [AdminSupportTicketPagePreTickets](hooks-reference/ticket.json) |
| ClientAreaPageSubmitTicket | Executes on the client area ticket submission page and accepts a return of key/value pairs to be mad... | [ClientAreaPageSubmitTicket](hooks-reference/ticket.json) |
| ClientAreaPageSupportTickets | Executes on the client area support tickets overview page and accepts a return of key/value pairs to... | [ClientAreaPageSupportTickets](hooks-reference/ticket.json) |
| ClientAreaPageViewTicket | Executes on the client area view ticket page and accepts a return of key/value pairs to be made avai... | [ClientAreaPageViewTicket](hooks-reference/ticket.json) |
| SubmitTicketAnswerSuggestions | Executes prior to looking up knowledgebase article suggestions related to the message body of a tick... | [SubmitTicketAnswerSuggestions](hooks-reference/ticket.json) |
| TicketAddNote | Executes when a ticket note is added. | [TicketAddNote](hooks-reference/ticket.json) |
| TicketAdminReply | Executes when a reply is added to a ticket by an admin user. | [TicketAdminReply](hooks-reference/ticket.json) |
| TicketClose | Executes when a ticket is closed. | [TicketClose](hooks-reference/ticket.json) |
| TicketDelete | Executes when a ticket is deleted. | [TicketDelete](hooks-reference/ticket.json) |
| TicketDeleteReply | Executes when a ticket reply is deleted. | [TicketDeleteReply](hooks-reference/ticket.json) |
| TicketDepartmentChange | Executes as a ticket department is changed | [TicketDepartmentChange](hooks-reference/ticket.json) |
| TicketFlagged | Executes as a ticket is flagged | [TicketFlagged](hooks-reference/ticket.json) |
| TicketMerge | Executes when tickets are merged into each other. | [TicketMerge](hooks-reference/ticket.json) |
| TicketOpen | Executes when a ticket is opened by an end user. | [TicketOpen](hooks-reference/ticket.json) |
| TicketOpenAdmin | Executes when a ticket is opened by an admin user. | [TicketOpenAdmin](hooks-reference/ticket.json) |
| TicketOpenValidation | Executes when an end user provides data for a new ticket submission. | [TicketOpenValidation](hooks-reference/ticket.json) |
| TicketPiping | Executes when a ticket is being imported via email. | [TicketPiping](hooks-reference/ticket.json) |
| TicketPriorityChange | Executes when a ticket priority is changed | [TicketPriorityChange](hooks-reference/ticket.json) |
| TicketSplit | Executes when ticket replies are being split into a new ticket. | [TicketSplit](hooks-reference/ticket.json) |
| TicketStatusChange | Executes as a ticket status is changed manually by an admin. | [TicketStatusChange](hooks-reference/ticket.json) |
| TicketSubjectChange | Executes when a ticket subject is changed. The 'subject' variable now contains the new subject. | [TicketSubjectChange](hooks-reference/ticket.json) |
| TicketUserReply | Executes when a reply is added to a ticket by an end user. | [TicketUserReply](hooks-reference/ticket.json) |
| TransliterateTicketText | Invoked when a ticket is imported from email. | [TransliterateTicketText](hooks-reference/ticket.json) |
| PreUserAdd | Executes just prior to a user being added to WHMCS. Changes to hook variables will not be honored. | [PreUserAdd](hooks-reference/user.json) |
| UserAdd | Executes as a user is being added to WHMCS. | [UserAdd](hooks-reference/user.json) |
| UserChangePassword | Executed when a change of password occurs for a user. | [UserChangePassword](hooks-reference/user.json) |
| UserEdit | Executes when a user is edited. | [UserEdit](hooks-reference/user.json) |
| UserEmailVerificationComplete | Executes upon successful completion of email verification by a user. | [UserEmailVerificationComplete](hooks-reference/user.json) |
