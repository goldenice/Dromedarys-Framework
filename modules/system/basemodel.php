<?php
namespace Modules\System;

abstract class Basemodel {
    protected Database $db;
    protected Loader $loader;
    protected Events $events;
 
    function __construct() {
        $this->db = Database::getInstance();
        $this->loader = Loader::getInstance();
        $this->events = Events::getInstance();
    }   
}