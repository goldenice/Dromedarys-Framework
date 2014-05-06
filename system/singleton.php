<?hh
namespace System;

class Singleton {
    private static Array $instances = array();
    
    protected function __construct() {}
    protected function __clone() {}
    public function __wakeup() {}

    public final static function getInstance(): self {
        $cls = get_called_class();      // late-static-bound class name
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }
        return self::$instances[$cls];
    }
}