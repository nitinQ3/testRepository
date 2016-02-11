<?php

/**
* Lender Platform, LLC.  (c)2012-2015.
 * Global Application Environment.
 * 
 * Purpose: 
 * This config file excludes configuration options from the source code stored
 * in GIT managed directories.  Each environment should have its own config
 * options setup.  The base Cake Framework keeps config values inside the 
 * codebase directly.  This is a security change to that methodology to separate 
 * environments and control access to production information and data.
 * 
 * Installation - New Server.
 * 1) Pull app, Cake, www repos from git.
 * 2) Create app_config/config.php outside web root of app.
 *    e.g.
 *    ~/webroot/app/(files here)
 *    ~/webroot/app_config/config.php (code looks for this file here)
 * 
 * This example file is maintained inside the platform source code to track
 * configuration options as they are introduced to the system.
*/

/**
* Bootstrap Variables.
*/

/**
 * --- From app/Config/core.php 
 */

/**
 * CakePHP Debug Level:
 *
 * Production Mode:
 * 	0: No error messages, errors, or warnings shown. Flash messages redirect.
 *
 * Development Mode:
 * 	1: Errors and warnings shown, model caches refreshed, flash messages halted.
 * 	2: As in 1, but also with full debug messages and SQL output.
 *
 * In production mode, flash messages redirect after a time interval.
 * In development mode, you need to click the flash message to continue.
 */
Configure::write('debug', 1); //always 0 for production site. 1 or 2 for debug mode.

/**
 * --- END app/Config/core.php 
 */


/**
* Database Setup.
* Note - each environment will have its own DB setup.  Configure here.
* Recommend use password generator for this password.
* See Cake documentation for minimum permissions required for user.
*/
$GLOBALS["database"] = array(
    'datasource' => 'Database/Mysql',
    'persistent' => false,
    'host' => 'localhost',
    'login' => 'root',
    'password' => '',
    'database' => 'lenderplatform_dev',
    'prefix' => ''
    //'encoding' => 'utf8',
);
/**
 * END - Database Setup
 */

/**
 * See /www/index for additional config customizations.
 */

//Use File Cache with new tmp location.
Cache::config('default', array('engine' => 'File', 'path' => ROOT.DS.'tmp'.DS) );


/* --- LOG Files 
 * Create date stamped logs to keep individual filesize down and longer retention.
 * Check permissions of directory to be able to write logs.
 */
//$custom_log_base_path = "/var/log"; //hard coded path.
$custom_log_base_path = TMP.'/logs'; //inside tmp by default.
$custom_log_file_name = date('Y_m_d').'.log'; //1 file per day.

CakeLog::config('default', array(
    'engine' => 'FileLog',
    'types' => array('info', 'error', 'warning'),
    'path' => $custom_log_base_path
));  
/**
 * -- END Log File Setup.
 */

/**
 * GLOBAL VARIABLES
 * 
 * Set these per installation.
 * 
 */
if (true===false) { //someting 
    
}
if (!defined('awsAccessKey')) { define('awsAccessKey', 'AKIAI5WHKNDR5ITCM33A') ; }
if (!defined('awsSecretKey')) {define('awsSecretKey', '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');}
if (!defined('bucket')) {define('bucket', 'lp-files-dev');}
if (!defined('awsSesKey')) {define('awsSesKey', 'AKIAI5WHKNDR5ITCM33A');}
if (!defined('awsSesSecretKey')) {define('awsSesSecretKey', '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');}
if (!defined('awsSesFromEmail')) {define('awsSesFromEmail', 'dev-noreply@lenderplatform.com');} //needs to be verified address in SES
if (!defined('awsSesSupportEmail')) {define('awsSesSupportEmail', 'support@lenderplatform.com');} //needs to be verified address in SES
if (!defined('awsSesBccEmail')) {define('awsSesBccEmail', 'support@lenderplatform.com');} //needs to be verified address in SES
if (!defined('orderSuggestedClosingDate')) {define('orderSuggestedClosingDate', '84');}
if (!defined('orderSuggestedClosingLocation')) {define('orderSuggestedClosingLocation', '85');}
if (!defined('orderSuggestedClosingConfirmed')) {define('orderSuggestedClosingConfirmed', '86');}		
if (!defined('closingProductFieldIDs')) {define('closingProductFieldIDs', '121,122');} //products.id
if (!defined('creditProductType')) {define('creditProductType', '1');} //product_types.id
if (!defined('docPrepProductType')) {define('docPrepProductType', '10');} //product_types.id
if (!defined('closingProductType')) {define('closingProductType', '12');} //product_types.id
if (!defined('SalesInquiriesTo')) {define('SalesInquiriesTo', 'andy.sharp@lenderplatform.com');} // for sign up
if (!defined('OrdersPathProcessor')) {define('OrdersPathProcessor', '/ebs/data/processor/log/orders/emails');} // for processor email
/* Password Security Setup */
if (!defined('failed_login_attempts')) {define('failed_login_attempts', 5 );} 
if (!defined('lockout_seconds')) {define('lockout_seconds', 300 );}
if (!defined('failed_login_notification')) {define('failed_login_notification', "andy.sharp@lenderplatform.com,support@lenderplatform.com");}	
//if (!defined('failed_login_notification')) define('failed_login_notification', "dmishra@q3tech.com,deepakmishra83@gmail.com");				
if (!defined('userPasswordReminderFromEmail')) {define('userPasswordReminderFromEmail', 'orders@lenderplatform.com');}
if (!defined('signaturPlatform')) {define('signaturPlatform', 'Lenderplatform Team');}


define('AMAZON_S3_ENCRYPT_KEY','12345678901234567890123456789012');
if (!defined('GOOGLE_MAP_KEY')) {define('GOOGLE_MAP_KEY', "AIzaSyD1UHi15sfXjPX09UpCK4lQVWl2LefHnLw");}
if (!defined('LIVE_ADDRESS_AUTH_ID')) {define('LIVE_ADDRESS_AUTH_ID', "0a00da0f-58f8-477e-a092-5e398edb365a");}
if (!defined('LIVE_ADDRESS_AUTH_TOKEN')) {define('LIVE_ADDRESS_AUTH_TOKEN', "BvvxL9IxjvCbUwnH%2FaFDRr606ebxFthe0cgLd%2BeSPnhW1F0rmUzNLLYoJOs3Poaxl5cCbGi7%2F9LUpXjncoHunw%3D%3D");}


/** 
 * CONSTANTS - These should not change between installations.
 */
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

if (!defined('hmda_dat_agency_code')) {define('hmda_dat_agency_code', 5);} //5 - National Credit Union Administration (NCUA)
if (!defined('password_lifetime_days')) {define('password_lifetime_days', 15);}
if (!defined('loans_import_folder')) {define('loans_import_folder', 'uploads/loans/import');}
if (!defined('loans_import_single_folder')) {define('loans_import_single_folder', 'uploads/loans/import_single');}
if (!defined('s3_loans_import_folder')) {define('s3_loans_import_folder', 'loans/import');}
if (!defined('s3_loans_import_single_folder')) {define('s3_loans_import_single_folder', 'loans/import_single');}
if (!defined('s3_order_wizard_folder')) {define('s3_order_wizard_folder', 'order/wizard');}
if (!defined('s3_order_folder')) {define('s3_order_folder', 'orders');}
if (!defined('s3_loan_folder')) {define('s3_loan_folder', 'loans');}
if (!defined('s3_order_upload_folder')) {define('s3_order_upload_folder', 'uploads');}
if (!defined('contactSupportRequestEmailFrom')) {define('contactSupportRequestEmailFrom', 'Customer Support<support@lenderplatform.com>');}
if (!defined('roleAllowedVendor')) {define('roleAllowedVendor', "1");}
if (!defined('roleAllowedClientAdmin')) {define('roleAllowedClientAdmin', "1,3");}
if (!defined('roleAllowedCustomerService')) {define('roleAllowedCustomerService', "1,2,3,4");}
if (!defined('roleAllowedSystemAdmin')) {define('roleAllowedSystemAdmin', "1,2,3,4,5");}

if (!defined('userTypeAllowedVendor')) {define('userTypeAllowedVendor', "1");}
if (!defined('userTypeAllowedClientAdmin')) {define('userTypeAllowedClientAdmin', "1,3");}
if (!defined('userTypeAllowedCustomerService')) {define('userTypeAllowedCustomerService', "1,2,3,4");}
if (!defined('userTypeAllowedSystemAdmin')) {define('userTypeAllowedSystemAdmin', "1,2,3,4,5");}

if (!defined('maxLimit')) {define('maxLimit', "1000");}
if (!defined('Limit')) {define('Limit', "1000");}

define('APPLICATION_NAME', 'Gmail API Service');
define('CREDENTIALS_PATH', ROOT.'/app_config/.credentials/gmail-api-lenderplatform_dev.json');
define('CLIENT_SECRET_PATH',ROOT.'/app_config/client_secret_lender_dev.json');

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

/**
 * END CONSTANTS
 */
