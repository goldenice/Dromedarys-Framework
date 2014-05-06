<?php
namespace Modules\System;

abstract class Basecontroller {
	protected Loader $loader;
    protected Events $events;
	
	function __construct() {
		$this->loader = Loader::getInstance();
        $this->events = Events::getInstance();
	}
}