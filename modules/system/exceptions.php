<?hh
namespace Modules\System;

class Exceptions extends Singleton {
    static function handleException(Array $e): void {
        $event = Events::getInstance();
        $event->fireEvent('exception_caught', $e);
        if (!empty($e)) {
            echo "\n<br />".'Exception: '.$e->getMessage();
            echo "\n<br /> In".$e->getFile().' on line '.$e->getLine();
        }
    }
    
    static function errorToException(int $num, string $str, string $file, int $line, mixed $context = null): void {
        throw new \ErrorException($str, 0, $num, $file, $line);
    }
}