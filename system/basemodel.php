<?php
namespace System;

abstract class Basemodel {
    protected Database $db;
    protected Loader $loader;
    protected Events $events;
 
    function __construct() {
        $this->db = \System\Database::getInstance();
        $this->loader = \System\Loader::getInstance();
        $this->events = \System\Events::getInstance();
    }   
}