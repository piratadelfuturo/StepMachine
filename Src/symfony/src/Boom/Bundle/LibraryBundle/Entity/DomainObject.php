<?php

namespace Boom\Bundle\LibraryBundle\Entity;


abstract class DomainObject implements \ArrayAccess
{
    public function offsetExists($offset) {
        // In this example we say that exists means it is not null
        $value = $this->{"get$offset"}();
        return $value !== null;
    }

    public function offsetSet($offset, $value) {
        //$this->{"set$offset"}($value);
        throw new BadMethodCallException("Array access of class " . get_class($this) . " is read-only!");
    }

    public function offsetGet($offset) {
        return $this->{"get$offset"}();
    }

    public function offsetUnset($offset) {
        //$this->{"set$offset"}(null);
        throw new BadMethodCallException("Array access of class " . get_class($this) . " is read-only!");
    }
}