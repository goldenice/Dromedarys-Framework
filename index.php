<?hh
/**
 * Kamele Framework Hack v0.1
 * 
 * @author      Rick Lubbers            <me@ricklubbers.nl>
 * @license     MIT licens			    see LICENSE.txt
 * 
 * 04 February 2014
 */

// Define the run mode.
define('MODE', 			'development');
define('ENVIRONMENT', 	'HHVM');

if (defined('MODE')) {
	switch (MODE) {
		case 'development':
			error_reporting(E_ALL);
            ini_set('display_errors', 1);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

// Define the config directory.
$configdir = 'config';

// Load config files
$cfg = opendir($configdir);
while ($item = readdir($cfg)) {
    $ext = explode('.', $item);
    if (end($ext) == 'php') {
        require($configdir.'/'.$item);
    }
}

// Let us include the router class
require_once 'system/core.php';

// Fire up the router, and start the rest of the loading procedure.
// It's not like we're going to do more stuff in index.php
new \System\Core;