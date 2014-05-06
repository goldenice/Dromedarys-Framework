<?hh
namespace Modules\System;

final class Loader extends Singleton implements \ArrayAccess {
    private Array $saved = array();
    
    final function offsetSet(mixed $offset, mixed $value): bool {
        return false;   // Because interface this function needed to be implemented, but doesn't do anything
    }
    
    final function offsetExists(mixed $offset): bool {
        return isset($this->saved[$offset]);
    }
    
    final function offsetUnset(mixed $offset): void {
        unset($this->saved[$offset]);
    }
    
    final function offsetGet(mixed $name): ?mixed {
        if (!isset($this->saved[$name])) {
            if (class_exists($name)) {
                if (is_subclass_of($name, '\Modules\System\Singleton')) {
                    $this->saved[$name] = $name::getInstance();
                }
                else {
                    $this->saved[$name] = new $name;
                }
            }
            else {
                return null;
            }
        }
        return $this->saved[$name];
    }
}