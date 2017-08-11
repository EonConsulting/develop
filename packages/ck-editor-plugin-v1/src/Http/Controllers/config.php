<?php

// Configuration file - copy from config-dist.php to config.php
// and then edit.  Since config.php has passwords and other secrets
// never check config.php into a source repository

// If we just are using Tsugi but not part of another site
$apphome = false;
$wwwroot = 'http://localhost/tsugi';
// $wwwroot = 'http://localhost:8888/tsugi';
// $wwwroot = "https://fb610139.ngrok.io/tsugi";

// If we embed Tsugi in a web site it has a parent folder.
// $apphome = "http://localhost/tsugi-org";
// $apphome = "http://localhost:8888/tsugi-org"
// $apphome = "https://www.tsugi.org";
// $wwwhost = $apphome . '/tsugi';
// Make sure to check for all the "Embedded Tsugi" configuration options below

$dirroot = realpath(__DIR__);

require_once(__DIR__."/../../../vendor/autoload.php");

// We store the configuration in a global object
// Additional documentation on these fields is
// available in that class or in the PHPDoc for that class
unset($CFG);
global $CFG;
$CFG = new \Tsugi\Config\ConfigInfo($dirroot, $wwwroot);
unset($wwwroot);
unset($dirroot);
if ( $apphome ) $CFG->apphome = $apphome; // Leave unset if not embedded
unset($apphome);

// Database connection information to configure the PDO connection
// You need to point this at a database with am account and password
// that can create tables.   To make the initial tables go into Admin
// to run the upgrade.php script which auto-creates the tables.
$CFG->pdo       = 'mysql:host=' . env('DB_HOST', '127.0.0.1') . ';dbname=' . env('DB_DATABASE', 'tsugi');
// $CFG->pdo       = 'mysql:host=127.0.0.1;port=8889;dbname=tsugi'; // MAMP
$CFG->dbuser    = env('DB_USERNAME', 'root');
$CFG->dbpass    = env('DB_PASSWORD', '');

// You can use the CDN copy of the static content - it is the
// default unless you override it.
// $CFG->staticroot = 'https://www.dr-chuck.net/tsugi-static';

// If you check out a copy of the static content locally and do not
// want to use the CDN copy (perhaps you are on a plane or are otherwise
// not connected) use this configuration option instead of the above:
// $CFG->staticroot = 'http://localhost/tsugi-static';  // For normal
// $CFG->staticroot = 'http://localhost:8888/tsugi-static';   // For MAMP

// The dbprefix allows you to give all the tables a prefix
// in case your hosting only gives you one database.  This
// can be short like "t_" and can even be an empty string if you
// can make a separate database for each instance of TSUGI.
// This allows you to host multiple instances of TSUGI in a
// single database if your hosting choices are limited.
$CFG->dbprefix  = '';

// This is the PW that you need to access the Administration
// features of this application. Protect it like the database
// password in this file.
// $CFG->adminpw = 'warning:please-change-adminpw-89b543!';
$CFG->adminpw = false;

// If we are running Embedded Tsugi we need to set the
// "course title" for the course that represents
// the "local" students that log in through Google.
// $CFG->context_title = "Web Applications for Everybody";

// If we are going to use the lessons tool and/or badges, we need to
// create and point to a lessons.json file
// $CFG->lessons = $CFG->dirroot.'/../lessons.json';

// This allows you to include various tool folders.  These are scanned
// for register.php, database.php and index.php files to do automatic
// table creation as well as making lists of tools in various UI places
// such as ContentItem or LTI 2.0

// For nomal tsugi, by default we use the built-in admin tools, and
// install new tools (see /admin/install/) into mod.
$CFG->tool_folders = array("admin", "mod");
$CFG->install_folder = $CFG->dirroot.'/mod';

// For Embedded Tsugi, you probably want to ignore the mod folder
// in /tsugi and instead install new tools into "mod" in the parent folder
if ( isset($CFG->apphome) ) {
    $CFG->tool_folders = array("admin", "../tools", "../mod");
    $CFG->install_folder = $CFG->dirroot.'/../mod';
}

// You can also include tool/module folders that are outside of this folder
// using the following pattern:
// $CFG->tool_folders = array("admin", "mod",
//      "../tsugi-php-standalone", "../tsugi-php-module",
//      "../tsugi-php-samples", "../tsugi-php-exercises");

// Set to true to redirect to the upgrading.php script
// Also copy upgrading-dist.php to upgrading.php and add your message
$CFG->upgrading = false;

// This is how the system will refer to itself.
$CFG->servicename = 'TSUGI';
$CFG->servicedesc = false;

// Information on the owner of this system and whether we
// allow folks to request keys for the service
$CFG->ownername = false;  // 'Charles Severance'
$CFG->owneremail = false; // 'csev@example.com'
$CFG->providekeys = false;  // true

// Go to https://console.developers.google.com/apis/credentials
// create a new OAuth 2.0 credential for a web application,
// get the key and secret, and put them here:
$CFG->google_client_id = false; // '96041-nljpjj8jlv4.apps.googleusercontent.com';
$CFG->google_client_secret = false; // '6Q7w_x4ESrl29a';

// Go to https://console.developers.google.com/apis/credentials
// Create and configure an API key and enter it here
$CFG->google_map_api_key = false; // 'Ve8eH490843cIA9IGl8';

// Badge generation settings - once you set these values to something
// other than false and start issuing badges - don't change these or
// existing badge images that have been downloaded from the system
// will be invalidated.
$CFG->badge_encrypt_password = false; // "somethinglongwithhex387438758974987";
$CFG->badge_assert_salt = false; // "mediumlengthhexstring";

// This folder contains the badge images - This example
// is for Embedded Tsugi and the badge images are in the
// parent folder.
// $CFG->badge_path = $CFG->dirroot . '/../badges';

// From LTI 2.0 spec: A globally unique identifier for the service provider.
// As a best practice, this value should match an Internet domain name
// assigned by ICANN, but any globally unique identifier is acceptable.
$CFG->product_instance_guid = parse_url($CFG->wwwroot)['host'];
// $CFG->product_instance_guid = 'lti2.example.com';

// From the CASA spec: originator_id a UUID picked by a publisher
// and used for all apps it publishes
$CFG->casa_originator_id = md5($CFG->product_instance_guid);

// When this is true it enables a Developer test harness that can launch
// tools using LTI.  It allows quick testing without setting up an LMS
// course, etc.
$CFG->DEVELOPER = true;

// These values configure the cookie used to record the overall
// login in a long-lived encrypted cookie.   Look at the library
// code createSecureCookie() for more detail on how these operate.
$CFG->cookiesecret = 'warning:please-change-cookie-secret-a289b543';
$CFG->cookiename = 'TSUGIAUTO';
$CFG->cookiepad = '390b246ea9';

// Where the bulk mail comes from - should be a real address with a wildcard box you check
$CFG->maildomain = false; // 'mail.example.com';
$CFG->mailsecret = 'warning:please-change-mailsecret-92ds29';
$CFG->maileol = "\n";  // Depends on your mailer - may need to be \r\n

// Set the nonce clearing factor and expiry time
$CFG->noncecheck = 100;
$CFG->noncetime = 1800;

// This is used to make sure that our constructed session ids
// based on resource_link_id, oauth_consumer_key, etc are not
// predictable or guessable.   Just make this a long random string.
// See LTIX::getCompositeKey() for detail on how this operates.
$CFG->sessionsalt = "warning:please-change-sessionsalt-89b543";

// Timezone
$CFG->timezone = 'Pacific/Honolulu'; // Nice for due dates

// Universal Analytics
$CFG->universal_analytics = false; // "UA-57880800-1";

// Effectively an "airplane mode" for the appliction.
// Setting this to true makes it so that when you are completely
// disconnected, various tools will not access network resources
// like Google's map library and hang.  Also the Google login will
// be faked.  Don't run this in production.

$CFG->OFFLINE = false;

// In order to run git from the a PHP script, we may need a setuid version
// of git - example commands:
//
//    cd /home/csev
//    cp /usr/bin/git .
//    chmod a+s git
//
// This of course is something to consider carefully.
// $CFG->git_command = '/home/csev/git';

// The vendor include and root - generally leave these alone
// unless you have a very custom checkout
$CFG->vendorroot = __DIR__ . "/../../../vendor/tsugi/lib/util";
$CFG->vendorinclude = __DIR__ . "/../../../vendor/tsugi/lib/include";
$CFG->vendorstatic = __DIR__ . "/../../../vendor/tsugi/lib/static";

// Leave these here
require_once __DIR__ . "/../../../vendor/tsugi/lib/include/setup.php";
require_once __DIR__ . "/../../../vendor/tsugi/lib/include/lms_lib.php";
// No trailing tag to avoid inadvertent white space