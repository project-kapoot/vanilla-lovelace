<?php

namespace Test\Unit\Component\Form;

use App\Component\Form\Field\ChoiceField;
use App\Component\Form\Field\NumberField;
use App\Component\Form\Field\TextField;
use App\Component\Form\FieldCollection;
use PHPUnit\Framework\TestCase;
use ValueError;

class FieldCollectionTest extends TestCase
{
    private readonly FieldCollection $fieldCollection;

    public function setUp() : void
    {
        $this->fieldCollection = new FieldCollection();
    }

    public function testAddOne()
    {
        $field = new NumberField('age', 'Age');

        $this->fieldCollection->add($field);

        $this->assertSame(1, count($this->fieldCollection));
    }

    public function testAddMultiple()
    {
        $fields = [
            new NumberField('age',''),
            new TextField('password',''),
            new ChoiceField('cities',''),
        ];

        $this->fieldCollection->add($fields[0]);
        $this->fieldCollection->add($fields[1]);
        $this->fieldCollection->add($fields[2]);

        $this->assertSame(count($fields), count($this->fieldCollection));
    }

    public function testAddCannotOverrideExistingValue()
    {
        $key = 'age';

        $numberField = new NumberField($key, '');

        $this->fieldCollection->add($numberField);

        $textField = new TextField($key, '');

        $this->expectException(\ValueError::class);

        $this->fieldCollection->add($textField);
    }

    public function testGetOne()
    {
        $field = new NumberField('age', 'Age');

        $this->fieldCollection->add($field);

        $this->assertSame($field, $this->fieldCollection->get($field->getName()));
    }

    public function testGetMultiple()
    {
        $fields = [
            new NumberField('age',''),
            new TextField('password',''),
            new ChoiceField('cities',''),
        ];

        $this->fieldCollection->add($fields[0]);
        $this->fieldCollection->add($fields[1]);
        $this->fieldCollection->add($fields[2]);

        $this->assertSame($fields[0], $this->fieldCollection->get($fields[0]->getName()));
        $this->assertSame($fields[1], $this->fieldCollection->get($fields[1]->getName()));
        $this->assertSame($fields[2], $this->fieldCollection->get($fields[2]->getName()));
    }

    public function testIterable()
    {
        $fields = [
            new NumberField('age',''),
            new TextField('password',''),
            new ChoiceField('cities',''),
        ];

        $this->fieldCollection->add($fields[0]);
        $this->fieldCollection->add($fields[1]);
        $this->fieldCollection->add($fields[2]);

        $this->assertIsIterable($this->fieldCollection);
    }
}