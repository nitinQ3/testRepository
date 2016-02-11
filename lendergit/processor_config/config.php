<?php

	/**
	*   Lender Platform, LLC (c)2012.
	*   Order Processor Config File.
	*
        *   Move and rename this file to processor_config/config.php outside of git repo
	*/

        //Set the timezone for the application.
	date_default_timezone_set('America/Chicago');
        
        /**
         * SET THIS FOR YOUR SERVER ENVIRONMENT.  ALL INCLUDES ARE ABSOLUTE TO THIS.
         */
        define(ROOT,"D:/xampp/htdocs/lendergit/processor/"); //path to processor.
        define(TMP,"D:/xampp/htdocs/lendergit/processor_tmp/"); //needs write access on server.
	
	//Debug Mode
	$DEBUG = true;
	$LOGFILE = TMP."log/processor_dev_".date("YmdH").".log";
        $LOGFILE_PRICING = TMP."log/processor_pricing_".date("YmdH").".log";
        $ORDERSPATH = TMP."log/orders/";
        $WEBSERVICEPATH = "http://webservices-dev.lenderplatform.com/placeorder.asmx";
        $ORDERNAMEPREFIX = "LP_Place_Order_Dev_";
        $WSDL = "http://processor-dev.lenderplatform.com/orders/default.php?WSDL";
	
	//Config Variables.
	$DBHOST = "localhost";
	$DBDATABASE = "lenderplatform_dev";
	$DBUSER = "root";
	$DBPASSWORD = "";
	
	/* --- AMAZON KEYS - For Email. --- */
	$AWS_KEY= 'AKIAI5WHKNDR5ITCM33A';
	$AWS_SECRET_KEY=  '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';
	$AWS_SES_FROM_EMAIL = "Orders <orders@lenderplatform.com>";
        $ORDERS_BCC_EMAIL = "Orders <orders@lenderplatform.com>";
	
	/* --- From CakePHP App --- */
	define('ENCRYPT_KEY','lpstellalp12345');
	define('ORDER_PATH','files/orders');
	define('ORDER_DIGIT',3);
	define('UPLOAD_DIR','uploads');
	
	/*--- USED FOR AMAZON S3 Server Side Encryption ---*/
	define('AMAZON_S3_ENCRYPT_KEY','12345678901234567890123456789012');
        
	if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAI5WHKNDR5ITCM33A'); 
	if (!defined('awsSecretKey')) define('awsSecretKey', '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'); 
	if (!defined('bucket')) define('bucket', 'lp-files-dev');
	if (!defined('s3_order_folder')) define('s3_order_folder', 'orders');
	if (!defined('s3_order_upload_folder')) define('s3_order_upload_folder', 'uploads');
	if (!defined('temp_file_path')) define('temp_file_path', TMP.'log/files/');
                      
        require_once(ROOT."includes/database.pdo.php");
        require_once(ROOT."includes/order_functions.php"); //contains reference to other functions used below.
        require_once(ROOT."email_handler/ses.php"); //Amazon SES Email class.
        require_once(ROOT."php-wsdl/class.phpwsdl.php");
        require_once(ROOT."orders/LP_ProcessorSoapClient.php");
        //require_once(ROOT."htdocs/orders/LP_ProcessorSoapClientExport.php"); //not used.
        //require_once(ROOT."sdk.v1.6.0/sdk.class.php"); //Amazon AWS SDK. 1.6.0
        require_once(ROOT."sdk.v2.7.0/aws-autoloader.php"); //Amazon AWS SDK. 2.7.0
        //require_once(ROOT."sdk/sdk.class.php"); //Amazon AWS SDK. 1.6.0
        require_once(ROOT."googleapi/autoload.php");
        define('APPLICATION_NAME', 'Gmail API Service');
        define('CREDENTIALS_PATH', dirname(ROOT) . '/.credentials/gmail-api-lenderplatform_dev.json');
        define('CLIENT_SECRET_PATH', dirname(ROOT) . '/client_secret_lender_dev.json');
        define('SCOPES', implode(' ', array(
            Google_Service_Gmail::GMAIL_MODIFY,
            Google_Service_Gmail::GMAIL_COMPOSE)
        ));

        if (!defined('IMAPGmailUsername')) define('IMAPGmailUsername', 'itq32015@gmail.com'); 
        if (!defined('IMAPGmailPassword')) define('IMAPGmailPassword', 'Q3tech123'); 
        if (!defined('IMAPGmailHostname')) define('IMAPGmailHostname', '{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}');     