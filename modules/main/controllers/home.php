<?php
namespace Modules\Main\Controllers;

class Home extends \Modules\System\Basecontroller {
    function index($arg = null) {
        $layout = new \Modules\System\Layout('modules/main/views/home');

        $test = $this->loader['\Modules\Main\Models\Example'];
        $content = $test->exampleMethod();
        
        $layout->render(array('content'=>$content, 'title'=>'Home'));
    }
    
    static function systemStart() {
        echo 'This is an event that runs because of static listeners. Awesome stuff.';
    }
}