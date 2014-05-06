<?php
namespace System;

abstract class Basecontroller {
	protected Loader $loader;
    protected Events $events;
	
	function __construct() {
		$this->loader = \System\Loader::getInstance();
        $this->events = \System\Events::getInstance();
	}
}