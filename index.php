<?hh
/**
 * Dromedarys Framework
 * 
 * @author      Rick Lubbers            <me@ricklubbers.nl>
 * @license     MIT licens			    see LICENSE.txt
 * 
 * 06 May 2014
 */

namespace Kamele {

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

}
namespace Modules {
	require_once 'modules/system/core.php';
	new \Modules\System\Core;
}