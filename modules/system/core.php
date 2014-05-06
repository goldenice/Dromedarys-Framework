<?hh
namespace Modules\System;

final class Core {
    private Events $events;
    private Router $router;
    
    function __construct() {
        // Make sure we don't get headers erroring all over the place
        ob_start();

        // And get us a session
        session_start();
        
        // Include the router class (the rest of the classes will be autoloaded)
        require_once 'modules/system/router.php';
        
        // Register the class autoloader
        spl_autoload_register(array('\Modules\System\Router', 'autoloader'));
        
        // Register exception and error handlers
        set_exception_handler(array('\Modules\System\Exceptions', 'handleException'));
        set_error_handler(array('\Modules\System\Exceptions', 'errorToException'));
        
        // Trigger the system_start event
        $this->events = Events::getInstance();
        $this->events->fireEvent('system_start');
        
        // Create router object
        $this->router = new Router;
    }
    
    function __destruct() {
        // Trigger system_stop event
        $this->events->fireEvent('system_stop');
    }
}