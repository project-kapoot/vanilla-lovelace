<?php

namespace Test\Unit\Component\Form;

use Kapoot\Form\Field\ChoiceField;
use Kapoot\Form\Field\NumberField;
use Kapoot\Form\Field\TextField;
use Kapoot\Form\FormBuilder;
use Exception;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypeError;

class FormBuilderTest extends TestCase
{
    public static function addingFieldReturnFieldInstanceProvider()
    {
        return [
            'test ChoiceField' => [ChoiceField::class],
            'test NumberField' => [NumberField::class],
            'test TextField' => [TextField::class],
        ];
    }

    #[DataProvider('addingFieldReturnFieldInstanceProvider')]
    public function testAddingFieldReturnFieldInstance(string $fieldFqcn)
    {
        $formBuilder = new FormBuilder('test');

        $field = $formBuilder->addField($fieldFqcn, '', '');

        $this->assertInstanceOf($fieldFqcn, $field);
    }

    public static function addingIncorrectFieldTypeThrowsException() : array
    {
        return [
            'empty string' => ['', Exception::class],
            'random string' => ['bonjour', Exception::class],
            'incorrect fqcn' => [Exception::class, Exception::class],
            'number' => [0, Exception::class],
            'boolean' => [true, Exception::class],

            'empty array' => [[], TypeError::class],
            'filled array' => [array_fill(0, 5, 'test'), TypeError::class],
            'empty object' => [new stdClass(), TypeError::class],
        ];
    }

    #[DataProvider('addingIncorrectFieldTypeThrowsException')]
    public function testAddingIncorrectFieldTypeThrowsException(mixed $type, string $expectedExceptionFqcn)
    {
        $formBuilder = new FormBuilder('test');

        $this->expectException($expectedExceptionFqcn);

        $formBuilder->addField($type, '', '');
    }

    public function testBuildFormDontThrowIfCalledRightAfterContruct()
    {
        $this->expectNotToPerformAssertions();

        $form = (new FormBuilder('name'))->build();
    }
}