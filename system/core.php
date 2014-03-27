<?php
namespace System;

final class Core {
    private $events;
    private $router;
    
    function __construct() {
        // Make sure we don't get headers erroring all over the place
        ob_start();

        // And get us a session
        session_start();
        
        // Include the router class (the rest of the classes will be autoloaded)
        require_once 'system/router.php';
        
        // Register the class autoloader
        spl_autoload_register('\System\Router::autoloader');
        
        // Register exception handler
        set_exception_handler(array('\System\Exceptions', 'handleException'));
        
        // Trigger the system_start event
        $this->events = \System\Events::getInstance();
        $this->events->fireEvent('system_start');
        
        // Create router object
        $this->router = new \System\Router;
    }
    
    function __destruct() {
        // Trigger system_stop event
        $this->events->fireEvent('system_stop');
    }
}