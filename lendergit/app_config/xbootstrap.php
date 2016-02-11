<?php
/**
* Bootstrap Variables.
*/

/**
 * From app/Config/core.php 
 */
Configure::write('debug', 0); //always 0 for production site.

Cache::config('default', array('engine' => 'File'));

$custom_log_base_path = "/var/log";
$custom_log_folder    = "cakephp";
$custom_log_full_path = $custom_log_base_path.DS.$custom_log_folder;
$custom_log_file_name = $custom_log_base_path.DS.$custom_log_folder.DS.date('m_Y_');
if (!file_exists($custom_log_full_path)) {
    mkdir($custom_log_full_path, 0777, true);
} 
CakeLog::config('default', array(
    'engine' => 'FileLog',
    'types' => array('info', 'error', 'warning'),
    'path' => $custom_log_file_name,
));  

define('ENCRYPT_KEY','lpstellalp12345');
define('ORDER_PATH','files/orders');
define('ORDER_DIGIT',3);
define('UPLOAD_DIR','uploads');

// define user_type
define('CLIENT', 1 );
define('CLIENT_ADMIN', 2 );
define('VENDOR', 3 );
define('CUSTOMER_SERVICE', 4 );
define('SYSTEM_ADMIN', 5 );

//Amazon AWS SES credentilas settings
switch($_SERVER['SERVER_NAME']) {
	
	/** 
	*	Dev Servers Explicitly Defined.
	*/
        case (preg_match('/.lenderplatform.com/', $_SERVER['SERVER_NAME']) ? true : false) :
        case (preg_match('/.memberclose.com/', $_SERVER['SERVER_NAME']) ? true : false) :
        case (preg_match('/.nbssglobal.com/', $_SERVER['SERVER_NAME']) ? true : false) :
	
		if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAI5WHKNDR5ITCM33A');
		if (!defined('awsSecretKey')) define('awsSecretKey', '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');
		if (!defined('bucket')) define('bucket', 'lp-files-dev');
		if (!defined('awsSesKey')) define('awsSesKey', 'AKIAI5WHKNDR5ITCM33A');
		if (!defined('awsSesSecretKey')) define('awsSesSecretKey', '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');
		if (!defined('awsSesFromEmail')) define('awsSesFromEmail', 'dev-noreply@lenderplatform.com'); //needs to be verified address in SES
		if (!defined('awsSesSupportEmail')) define('awsSesSupportEmail', 'support@lenderplatform.com'); //needs to be verified address in SES
		if (!defined('awsSesBccEmail')) define('awsSesBccEmail', 'support@lenderplatform.com'); //needs to be verified address in SES
		if (!defined('orderSuggestedClosingDate')) define('orderSuggestedClosingDate', '84');
		if (!defined('orderSuggestedClosingLocation')) define('orderSuggestedClosingLocation', '85');
		if (!defined('orderSuggestedClosingConfirmed')) define('orderSuggestedClosingConfirmed', '86');		
		if (!defined('closingProductFieldIDs')) define('closingProductFieldIDs', '121,122'); //products.id
		if (!defined('creditProductType')) define('creditProductType', '1'); //product_types.id
		if (!defined('docPrepProductType')) define('docPrepProductType', '10'); //product_types.id
		if (!defined('closingProductType')) define('closingProductType', '12'); //product_types.id
		if (!defined('SalesInquiriesTo')) define('SalesInquiriesTo', 'andy.sharp@lenderplatform.com'); // for sign up
                if (!defined('OrdersPathProcessor')) define('OrdersPathProcessor', '/ebs/data/processor/log/orders/emails'); // for processor email
		/* Password Security Setup */
		if (!defined('failed_login_attempts')) define('failed_login_attempts', 5 ); 
		if (!defined('lockout_seconds')) define('lockout_seconds', 300 );
		if (!defined('failed_login_notification')) define('failed_login_notification', "andy.sharp@lenderplatform.com,support@lenderplatform.com");	
		//if (!defined('failed_login_notification')) define('failed_login_notification', "dmishra@q3tech.com,deepakmishra83@gmail.com");				
                if (!defined('userPasswordReminderFromEmail')) define('userPasswordReminderFromEmail', 'orders@lenderplatform.com');
                if (!defined('signaturPlatform')) define('signaturPlatform', 'Lenderplatform Team');
	break;
	case (preg_match('/.simplified.com/', $_SERVER['SERVER_NAME']) ? true : false) :
	//case "secure.simplified.com":
		if (!defined('SalesInquiriesTo')) define('SalesInquiriesTo', 'van@simplified.com'); // for sign up
                if (!defined('OrdersPathProcessor')) define('OrdersPathProcessor', '/ebs/data/httpd/simplified.processor/log/orders/emails'); // for processor email
		/* Password Security Setup */
		if (!defined('failed_login_attempts')) define('failed_login_attempts', 5 ); 
		if (!defined('lockout_seconds')) define('lockout_seconds', 300 );
		if (!defined('failed_login_notification')) define('failed_login_notification', "andy.sharp@lenderplatform.com,support@lenderplatform.com");
		if (!defined('userPasswordReminderFromEmail')) define('userPasswordReminderFromEmail', 'orders@lenderplatform.com');
                if (!defined('signaturPlatform')) define('signaturPlatform', 'Lenderplatform Team');
	/** 
	*	Production Servers - Application can allow reseller domains to be setup on the fly.
	*/
	default:
	
		if (!defined('awsAccessKey')) define('awsAccessKey','AKIAJDJMMEJY5ZMVJAKA');
		if (!defined('awsSecretKey')) define('awsSecretKey', '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');
		if (!defined('bucket')) define('bucket', 'lp-files-live');
		if (!defined('awsSesKey')) define('awsSesKey', 'AKIAJDJMMEJY5ZMVJAKA');
		if (!defined('awsSesSecretKey')) define('awsSesSecretKey', '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');
		if (!defined('awsSesFromEmail')) define('awsSesFromEmail', 'nbss-noreply@lenderplatform.com'); //needs to be verified address in SES
		if (!defined('awsSesSupportEmail')) define('awsSesSupportEmail', 'customerservice@nbssglobal.com'); //needs to be verified address in SES
		if (!defined('awsSesBccEmail')) define('awsSesBccEmail', 'support@lenderplatform.com'); //needs to be verified address in SES
		if (!defined('orderSuggestedClosingDate')) define('orderSuggestedClosingDate', '84');
		if (!defined('orderSuggestedClosingLocation')) define('orderSuggestedClosingLocation', '85');
		if (!defined('orderSuggestedClosingConfirmed')) define('orderSuggestedClosingConfirmed', '86');
		if (!defined('closingProductFieldIDs')) define('closingProductFieldIDs', '121,122'); //products.id
		if (!defined('creditProductType')) define('creditProductType', '1'); //product_types.id
		if (!defined('docPrepProductType')) define('docPrepProductType', '10'); //product_types.id
		if (!defined('closingProductType')) define('closingProductType', '12'); //product_types.id
		if (!defined('SalesInquiriesTo')) define('SalesInquiriesTo', 'memberclose@CUCenter.org'); // for sign up
                if (!defined('OrdersPathProcessor')) define('OrdersPathProcessor', '/ebs/data/httpd/processor.lenderplatform.com/log/orders/emails'); // for processor email
		/* Password Security Setup */
		if (!defined('failed_login_attempts')) define('failed_login_attempts', 5 ); 
		if (!defined('lockout_seconds')) define('lockout_seconds', 300 );
		if (!defined('failed_login_notification')) define('failed_login_notification', "andy.sharp@lenderplatform.com,support@lenderplatform.com");
                if (!defined('userPasswordReminderFromEmail')) define('userPasswordReminderFromEmail', 'orders@lenderplatform.com');
                if (!defined('signaturPlatform')) define('signaturPlatform', 'Lenderplatform Team');
	break;
}
if (!defined('hmda_dat_agency_code')) define('hmda_dat_agency_code', 5);
//5 - National Credit Union Administration (NCUA)
if (!defined('password_lifetime_days')) define('password_lifetime_days', 15);
if (!defined('loans_import_folder')) define('loans_import_folder', 'uploads/loans/import');
if (!defined('loans_import_single_folder')) define('loans_import_single_folder', 'uploads/loans/import_single');
if (!defined('s3_loans_import_folder')) define('s3_loans_import_folder', 'loans/import');
if (!defined('s3_loans_import_single_folder')) define('s3_loans_import_single_folder', 'loans/import_single');
if (!defined('s3_order_wizard_folder')) define('s3_order_wizard_folder', 'order/wizard');
if (!defined('s3_order_folder')) define('s3_order_folder', 'orders');
if (!defined('s3_loan_folder')) define('s3_loan_folder', 'loans');
if (!defined('s3_order_upload_folder')) define('s3_order_upload_folder', 'uploads');
if (!defined('contactSupportRequestEmailFrom')) define('contactSupportRequestEmailFrom', 'Customer Support<support@lenderplatform.com>');
if (!defined('roleAllowedVendor')) define('roleAllowedVendor', "1");
if (!defined('roleAllowedClientAdmin')) define('roleAllowedClientAdmin', "1,3");
if (!defined('roleAllowedCustomerService')) define('roleAllowedCustomerService', "1,2,3,4");
if (!defined('roleAllowedSystemAdmin')) define('roleAllowedSystemAdmin', "1,2,3,4,5");

if (!defined('userTypeAllowedVendor')) define('userTypeAllowedVendor', "1");
if (!defined('userTypeAllowedClientAdmin')) define('userTypeAllowedClientAdmin', "1,3");
if (!defined('userTypeAllowedCustomerService')) define('userTypeAllowedCustomerService', "1,2,3,4");
if (!defined('userTypeAllowedSystemAdmin')) define('userTypeAllowedSystemAdmin', "1,2,3,4,5");

if (!defined('maxLimit')) define('maxLimit', "1000");
if (!defined('Limit')) define('Limit', "1000");

Configure::write('Loan.header', 
				array(
				'client_identifier',
				'dept_name',
				'username',
				'loan_number',
				'other_identifier',
				'loan_amount',			
				'loan_type',
				'parcel_identification_number',
				'escrow',
				'closed',
				'property_type',
				'property_occupancy',
				'property_address1',
				'property_address2',
				'property_city',
				'property_state',
				'property_zip',
				'property_legal_description',
				'primary_first_name',
				'primary_last_name',
				'primary_middle_name',
				'primary_prefix',
				'primary_suffix',
				'primary_title',
				'primary_email',
				'primary_phone',
				'primary_phone2',
				'primary_address1',
				'primary_address2',
				'primary_city',
				'primary_state',
				'primary_zip',
				'secondary_first_name',
				'secondary_last_name',
				'secondary_middle_name',
				'secondary_prefix',
				'secondary_suffix',
				'secondary_title',
				'secondary_email',
				'secondary_phone',
				'secondary_phone2',
				'secondary_address1',
				'secondary_address1',
				'secondary_address2',
				'secondary_city',
				'secondary_state',
				'secondary_zip',
				'additional_first_name',
				'additional_last_name',
				'additional_middle_name',
				'additional_prefix',
				'additional_suffix',
				'additional_title',
				'additional_email',
				'additional_phone',
				'additional_phone2',
				'additional_address1',
				'additional_address2',
				'additional_city',
				'additional_state',
				'additional_zip'
				
				)
				);

if (!defined('GOOGLE_MAP_KEY')) define('GOOGLE_MAP_KEY', "AIzaSyD1UHi15sfXjPX09UpCK4lQVWl2LefHnLw");
if (!defined('LIVE_ADDRESS_AUTH_ID')) define('LIVE_ADDRESS_AUTH_ID', "0a00da0f-58f8-477e-a092-5e398edb365a");
if (!defined('LIVE_ADDRESS_AUTH_TOKEN')) define('LIVE_ADDRESS_AUTH_TOKEN', "BvvxL9IxjvCbUwnH%2FaFDRr606ebxFthe0cgLd%2BeSPnhW1F0rmUzNLLYoJOs3Poaxl5cCbGi7%2F9LUpXjncoHunw%3D%3D");