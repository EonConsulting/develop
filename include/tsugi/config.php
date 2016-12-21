<?php

// Configuration file - copy from config-dist.php to config.php
// and then edit.  Since config.php has passwords and other secrets
// never check config.php into a source repository

// This is the URL where the software is hosted
// Do not add a trailing slash to this string
$wwwroot = env('APP_URL');  /// For normal
// $wwwroot = 'http://localhost:8888/tsugi';   // For MAMP

$dirroot = realpath(dirname(__FILE__));

# Obsolete - Please upgrade to autoloading
# require_once($dirroot."/lib/vendor/Tsugi/Config/ConfigInfo.php");
require_once($dirroot."/vendor/autoload.php");

// We store the configuration in a global object
// Additional documentation on these fields is 
// available in that class or in the PHPDoc for that class
unset($CFG);
global $CFG;
$CFG = new \Tsugi\Config\ConfigInfo($dirroot, $wwwroot);
unset($wwwroot);
unset($dirroot);

// The application's home - if different from the Tsugi wwwroot
// $CFG->apphome = 'http://localhost:8888/php-intro';   

// Database connection information to configure the PDO connection
// You need to point this at a database with am account and password
// that can create tables.   To make the initial tables go into Admin
// to run the upgrade.php script which auto-creates the tables.
$CFG->pdo       = 'mysql:host=' . env('TSUGI_DB_HOST', '127.0.0.1') . ';dbname=' . env('TSUGI_DB', 'tsugi');
// $CFG->pdo       = 'mysql:host=127.0.0.1;port=8889;dbname=tsugi'; // MAMP
$CFG->dbuser    = env('TSUGI_DB_USER', 'root');
$CFG->dbpass    = env('TSUGI_DB_PASS', 'root');

// You can use my CDN copy of the static content in testing or 
// light production if you like:
// $CFG->staticroot = 'https://www.dr-chuck.net/tsugi-static';

// If you check out a copy of the static content locally and do not
// want to use the CDN copy (perhaps you are on a plane or are otherwise
// not connected) use this configuration option instead of the above:
// $CFG->staticroot = $CFG->wwwroot . "/../tsugi-static";
// $CFG->staticroot = 'http://localhost/tsugi-static';  // For normal
// $CFG->staticroot = 'http://localhost:8888/tsugi-static';   // For MAMP

// The dbprefix allows you to give all the tables a prefix
// in case your hosting only gives you one database.  This
// can be short like "t_" and can even be an empty string if you
// can make a separate database for each instance of TSUGI.
// This allows you to host multiple instances of TSUGI in a
// single database if your hosting choices are limited.
$CFG->dbprefix  = env('TSUGI_DB_PREFIX', '');

// This is the PW that you need to access the Administration
// features of this application.
$CFG->adminpw = env('TSUGI_ADMIN_PASS', '1234');

// This allows you to include various tool folders.  These are scanned
// for register.php, database.php and index.php files to do automatic
// table creation as well as making lists of tools in various UI places.
$CFG->tool_folders = array("admin", "mod");

// Mod is empty by default.  This will re-checkout the mod folder: 
//     cd htdocs/tsugi
//     git clone https://github.com/csev/tsugi-php-mod mod

// You can include tool/module folders that are outside of this folder
// using the following pattern:
// $CFG->tool_folders = array("admin", "mod",
//      "../tsugi-php-standalone", "../tsugi-php-module",
//      "../tsugi-php-samples", "../tsugi-php-exercises");

// Set to true to redirect to the upgrading.php script
// Also copy upgrading-dist.php to upgrading.php and add your message
$CFG->upgrading = false;

// This is how the system will refer to itself.
$CFG->servicename = env('TSUGI_SERVICE_NAME', 'TSUGI');
$CFG->servicedesc =  env('TSUGI_SERVICE_NAME', false);

// Information on the owner of this system
$CFG->ownername = env('TSUGI_OWNER_NAME', false);  // 'Charles Severance'
$CFG->owneremail = env('TSUGI_OWNER_MAIL', false); // 'csev@example.com'
$CFG->providekeys = env('TSUGI_PROVIDE_KEYS', false);  // true

// Set these to your API key for your Google Sign on and Maps
// https://console.developers.google.com/
$CFG->google_client_id = env('TSUGI_GOOGLE_CLIENT_ID', false); // '96041-nljpjj8jlv4.apps.googleusercontent.com';
$CFG->google_client_secret = env('TSUGI_GOOGLE_CLIENT_SECRET', false); // '6Q7w_x4ESrl29a';
$CFG->google_map_api_key = env('TSUGI_GOOGLE_MAP_API_KEY', false); // 'Ve8eH49498430843cIA9IGl8';

// Badge generation settings - once you start issuing badges - don't change these 
$CFG->badge_encrypt_password = env('TSUGI_BADGE_ENCRYPT_PASSWORD', false); // "somethinglongwithhex387438758974987";
$CFG->badge_assert_salt = env('TUSIG_BADGE_ASSERT_SALT', false); // "mediumlengthhexstring";
$CFG->badge_path = $CFG->dirroot . '/../badges'; 

// From LTI 2.0 spec: A globally unique identifier for the service provider. 
// As a best practice, this value should match an Internet domain name 
// assigned by ICANN, but any globally unique identifier is acceptable.
$CFG->product_instance_guid = env('TSUGI_PRODUCT_INSTANCE_GUID', 'lti2.example.com');

// From the CASA spec: originator_id a UUID picked by a publisher 
// and used for all apps it publishes
$CFG->casa_originator_id = md5($CFG->product_instance_guid);

// The vendor include and root
$CFG->vendorroot = $CFG->wwwroot."/vendor/tsugi/lib/util";
$CFG->vendorinclude = $CFG->dirroot."/vendor/tsugi/lib/include";
$CFG->vendorstatic = $CFG->wwwroot."/vendor/tsugi/lib/static";

// When this is true it enables a Developer test harness that can launch
// tools using LTI.  It allows quick testing without setting up an LMS
// course, etc.
$CFG->DEVELOPER = env('TSUGI_DEVELOPER', true);

// These values configure the cookie used to record the overall
// login in a long-lived encrypted cookie.   Look at the library
// code createSecureCookie() for more detail on how these operate.
$CFG->cookiesecret = env('TSUGI_COOKIE_SECRET', 'warning:please-change-cookie-secret-a289b543');
$CFG->cookiename = env('TSUGI_COOKIE_NAME', 'TSUGIAUTO');
$CFG->cookiepad = env('TSUGI_COOKIE_PAD', '390b246ea9');

// Where the bulk mail comes from - should be a real address with a wildcard box you check
$CFG->maildomain = env('TSUGI_MAIL_DOMAIN', false); // 'mail.example.com';
$CFG->mailsecret = env('TSUGI_MAIL_SECRET', 'warning:please-change-mailsecret-92ds29');
$CFG->maileol = env('TSUGI_MAILEOL', "\n");  // Depends on your mailer - may need to be \r\n

// Set the nonce clearing factor and expiry time
$CFG->noncecheck = env('TSUGI_NONCE_CHECK', 100);
$CFG->noncetime = env('TSUGI_NONCE_TIME', 1800);

// This is used to make sure that our constructed session ids
// based on resource_link_id, oauth_consumer_key, etc are not
// predictable or guessable.   Just make this a long random string.
// See LTIX::getCompositeKey() for detail on how this operates.
$CFG->sessionsalt = env('TSUGI_SESSION_SALT', "warning:please-change-sessionsalt-89b543");

// Timezone
$CFG->timezone = env('TSUGI_TIMEZONE', 'Pacific/Honolulu'); // Nice for due dates

// Old analytics
$CFG->analytics_key = env('TSUGI_OLD_ANALYTICS_KEY', false);  // "UA-423997-16";
$CFG->analytics_name = env('TSUGI_OLD_ANALYTICS_NAME', false); // "dr-chuck.com";

// Universal Analytics
$CFG->universal_analytics = env('TSUGI_UNIVERSAL_ANALYTICS', false); // "UA-57880800-1";

// Only define this if you are using Tsugi in single standalone app that 
// will never be in iframes - because most browsers will *not* set cookies in
// cross-domain iframes.   If you use this, you cannot be a different
// user in a different tab or be in a different course in a different
// tab.  
// if ( !defined('COOKIE_SESSION') ) define('COOKIE_SESSION', true);

// Effectively an "airplane mode" for the appliction.
// Setting this to true makes it so that when you are completely 
// disconnected, various tools will not access network resources 
// like Google's map library and hang.  Also the Google login will 
// be faked.  Don't run this in production.

$CFG->OFFLINE = env('TSUGI_OFFLINE', false);

// Leave these here
require_once $CFG->vendorinclude."/setup.php";
require_once $CFG->vendorinclude."/lms_lib.php";
// No trailing tag to avoid inadvertent white space
