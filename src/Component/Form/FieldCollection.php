<?php

declare(strict_types=1);

namespace App\Component\Form;

use App\Component\Form\Field\AbstractField;
use Countable;
use Iterator;
use ValueError;

class FieldCollection implements Countable, Iterator
{
    private int $position = 0;
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
            throw new ValueError(sprintf('Field "%s" has already been added to the collection.', $field->getName()));
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

    public function current() : AbstractField
    {
        return $this->elements[$this->position];
    }

    public function rewind() : void
    {
        $this->position = 0;
    }

    public function key() : int
    {
        return $this->position;
    } 

    public function next() : void
    {
        ++$this->position;
    }

    public function valid() : bool
    {
        return isset($this->elements[$this->position]);
    }
}