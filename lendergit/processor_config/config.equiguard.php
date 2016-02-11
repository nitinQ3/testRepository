<?php

	/**
	*
	*   Lender Platform, LLC (c)2012-2015.
	*   Order Processor for Equiguard.
	*
	*/

        //Set the timezone for the application.
	date_default_timezone_set('America/Chicago');

        define(ROOT,"/ebs/data/processor/"); //path to processor.
        define(TMP,"/ebs/data/processor_tmp/"); //path to processor. Needs write access.  
        
        //Debug Mode
	$DEBUG = true; //writes to log files.
	$WEBSERVICEPATH = "http://webservices-dev.lenderplatform.com/placeorder.asmx";
        
        $ORDERNAMEPREFIX = "Equiguard_Place_Order_Dev_";
        $LOGFILE = TMP."log/equiguard/equiguard_".date("YmdH").".log";	
        $ORDERSPATH = TMP."log/equiguard/orders/";
        $EQUIGUARD_WSDL = "http://processor-dev.lenderplatform.com/equiguard/default.php?WSDL";
        
        //See application database for values here.
        $ELR_PRODUCT_ID = 112;
        $ELR_PRODUCT_ID_SINGLE = 52;
        $ELR_PRODUCT_ID_JOINT = 52;
        $CLR_PRODUCT_ID = "MortgageOnly"; //product from credit plus
        $CREDIT_PRODUCT_ID_SINGLE = "transunion";
        $CREDIT_PRODUCT_ID_JOINT = "transunion";
        $CREDIT_PRODUCT_TYPE_ID = 1;
        $COMPLETE_STATUS_TYPE_ID = 5;
        $CREDIT_VENDOR_CODE = "MLINK";
	
	//Config Variables.
	$DBHOST = "localhost";
	$DBDATABASE = "lenderplatform";
	$DBUSER = "lps-user";
	$DBPASSWORD = "csdR3ZybVTn6WPMH";
	
	/* --- AMAZON KEYS - For Email. --- */
	$AWS_KEY= 'AKIAI5WHKNDR5ITCM33A';
	$AWS_SECRET_KEY=  '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';
	$AWS_SES_FROM_EMAIL = "Orders <orders@lenderplatform.com>";
	
	/* --- From CakePHP App --- */
	define('ENCRYPT_KEY','lpstellalp12345');
	define('ORDER_PATH','files/orders');
	define('ORDER_DIGIT',3);
	define('UPLOAD_DIR','uploads');
        
	if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAI5WHKNDR5ITCM33A'); //not used.
	if (!defined('awsSecretKey')) define('awsSecretKey', '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'); //not used.
	if (!defined('bucket')) define('bucket', 'lp-files-dev');
	if (!defined('s3_order_folder')) define('s3_order_folder', 'orders');
	if (!defined('s3_order_upload_folder')) define('s3_order_upload_folder', 'uploads');
	if (!defined('temp_file_path')) define('temp_file_path', TMP.'log/equiguard/files/');
                      
        require_once(ROOT."includes/database.pdo.php");
        require_once(ROOT."includes/order_functions.php"); //contains reference to other functions used below.
        require_once(ROOT."email_handler/ses.php"); //Amazon SES Email class.
        require_once(ROOT."php-wsdl/class.phpwsdl.php");
        require_once(ROOT."sdk/sdk.class.php"); //Amazon AWS SDK.
        
        require_once(ROOT."equiguard/includes/equiguard_functions.php"); //contains reference to other functions used below.
        require_once(ROOT."equiguard/tcpdf/tcpdf.php"); //PDF Tools
        require_once(ROOT."equiguard/PDFMerger/PDFMerger.php"); //PDF Merge Tools
        require_once(ROOT."equiguard/Equiguard_ProcessorSoapClient.php");
        
        


