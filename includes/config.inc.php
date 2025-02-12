<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// DB-RELATED CONFIGURATIONS ///////////////////////////////////////////////////////

 define('DB_SERVER', 'localhost');
 define('DB_USERNAME', 'root');
 define('DB_PASSWORD', 'global@123');
 define('DB_DATABASE', 'terumope_omsdb');
 define('DB_PREFIX', '');
 
//SERVER CONGIFURATIONS ////////////////////////////////////////////////////////////
  define("HTTP_SERVER", "http://omstest.terumopenpol.com/");

  define("DIR_INCLUDES", "includes/");
  define("DIR_CLASSES", DIR_INCLUDES . "classes/");
  define("DIR_FUNCTIONS", DIR_INCLUDES . "functions/");
  define("DIR_LANGUAGES", DIR_INCLUDES . "languages/");
  
//SITE CONFIGURATIONS /////////////////////////////////////////////////////////////
	define("SITE_NAME", "Terumo Penpol");
	define("SITE_OWNER", "Syamnath");
 	define("SITE_EMAIL", "terumopenpol2021@gmail.com");
	define("FROM_EMAIL", "terumopenpol2021@gmail.com");
	define("EMAIL_PASSWORD", "terumo@2021");	
	define("IS_SMTP", true);
	define("SMTP_AUTH", true);
	define("SMTP_SECURE", 'ssl'); //for gmail change ssl
	define("MAIL_HOST", 'smtp.gmail.com'); //For gmail "smtp.gmail.com";
	define("SMTP_PORT", 465); //for gmail 465 else 25; 
// COOKIES CONFIGURATIONS ////////////////////////////////////////////////////////
	define("COOKIE_EXP_TIME", 7 * 24 * 60 * 60); //One week
	define("COOKIE_KEY", "c2F0aGVlc2ggY2hhbmRyYXNla2hhcg==");
    
//DEFINE LANGUAGES ////////////////////////////////////////////////////////////////
	define("LANGUAGE", "english");

//IMAGE CONFIGURATIONS ////////////////////////////////////////////////////////////
	define("PICTURES_ALLOWED_EXTENTIONS", "gif,jpg,jpeg,png,JPG,PNG,GIF");
	define("IMAGE_MAX_FILE_SIZE", 1024 * 1024); //Limited to 250 KB

//DEFINE TEMPATE /////////////////////////////////////////////////////////////////
	define("TEMPLATE", "default");
	define("TEMPLATE_PATH", "templates/" . TEMPLATE . "/");

      
//SEARCH CONFIGURATIONS /////////////////////////////////////////////////////////
	define("SEARCH_RESULTS_PER_PAGE", 10);
	define("SEARCH_RESULTS_PADDING", 4);
 
//DATE FORMAT
	define("SHORT_DATE_WITHTIME", "'%d-%m-%Y %r'");
	define("SHORT_DATE", "'%d-%m-%Y'");
  
//UPLOADBLE FILE EXTENSIONS  ////////////////////////////////////////////////////
	define("ALLOWABLE_DOC_EXT", "htm,docx,doc,xls,xlsx,pdf,pps,txt,html,xml,rtf");
	define("ALLOWABLE_DOC_SIZE",6 * 1024 * 1024); 

//TIME ZONE SETTING  ////////////////////////////////////////////////////
	date_default_timezone_set('Asia/Calcutta');  
 
// BROCHURE UPLOAD PATH //////////////////////////////////////////////////////
	define("BROCHURE_UPLOAD_PATH" ,"files/brochure/");
	define("QC_REPORT_UPLOAD_PATH" ,"files/qc/");
	define("COMPLAINT_UPLOAD_PATH" ,"files/complaint_pic/");  
	define("COMPLAINT_QAREPORT_UPLOAD_PATH" ,"files/complaintreport/");  
// default group name
	define("ORDER_CANCEL_REQUEST_GROUP" ,"Cancel order request");
	define("COMPLAINT_BB_GROUP" ,"BB complaint");
	define("COMPLAINT_BBE_GROUP" ,"BBE complaint");
	define("COMPLAINT_TCE_GROUP" ,"TCE complaint");
	define("COMPLAINT_TCD_GROUP" ,"TCD complaint");
	
	
// default role id. If any change in id please update it here.
	define("ZH" ,"6");
	define("LOGISTICS" ,"4");
	define("ED" ,"8");
	
// default time for edit mode
        define("TIME_LEFT","15");

// default access for CCD to make all orders in active mode
        define("ORDER_ACCESS","OFF");	      
?>
