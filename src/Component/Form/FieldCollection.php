<?php

declare(strict_types=1);

namespace App\Component\Form;

use App\Component\Form\Field\AbstractField;
use ReturnTypeWillChange;

class FieldCollection implements \Countable, \Iterator, \ArrayAccess
{
    private array $elements = [];

    /**
     * Adds a field to the collection
     * 
     * NOTE: Uses the 'name' property of the field as a key in the collection
     * 
     * @param \App\Component\Form\Field\AbstractField[] ...$fields
     * @throws ValueError if a field has already the same name in the collection
     * @return self
     */
    public function add(AbstractField $field) : self
    {
        if($this->isset($field->getName())) {
            throw new \ValueError(sprintf('Field "%s" has already been added to the collection.', $field->getName()));
        }

        $this->elements[$field->getName()] = $field;

        return $this;
    }

    /**
     * Gets one field from the collection
     * 
     * @return \App\Component\Form\Field\AbstractField
     */
    public function get(string $key) : AbstractField
    {
        return $this->elements[$key];
    } 

    /**
     * Returns true if key exist in array, false otherwise
     * 
     * @return bool
     */
    public function isset(string $key) : bool
    {
        return isset($this->elements[$key]);
    }

    /**
     * Returns the elements in the collection as an array
     *
     * @return \App\Components\Form\Field\AbstractField[]
     */
    public function toArray() : array
    {
        return $this->elements;
    }

    public function count() : int
    {
        return count($this->elements);
    }

    #[ReturnTypeWillChange]
    public function current()
    {
        return current($this->elements);
    }

    public function rewind() : void
    {
        reset($this->elements);
    }

    #[ReturnTypeWillChange]
    public function key()
    {
        return key($this->elements);
    } 

    public function next() : void
    {
        next($this->elements);
    }

    public function valid() : bool
    {
        return key($this->elements) !== null;
    }

    public function offsetSet(mixed $offset, mixed $field): void
    {
        if(!is_object($field) || !($field instanceof AbstractField)) {
            throw new \ValueError('Cannot add an element in the collection which is not an instance of : ' . AbstractField::class);
        }

        $this->add($field);
    }

    public function offsetGet(mixed $offset): AbstractField|null
    {
        return $this->isset($offset) ? $this->get($offset) : null;
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->isset($offset);
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->elements[$offset]);
    }
}