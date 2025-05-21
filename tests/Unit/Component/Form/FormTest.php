<?php

namespace Test\Unit\Component\Form;

use Kapoot\Form\Abstract\AbstractForm;
use Kapoot\Form\Field\ChoiceField;
use Kapoot\Form\Field\NumberField;
use Kapoot\Form\Field\TextField;
use Kapoot\Form\FieldCollection;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use TypeError;

class FormTest extends TestCase
{
    public AbstractForm $form;

    public static function isSubmittedProvider() : array
    {
        return [
            'expectSubmitted' => [
                'test',
                ['test' => []],
                true,
            ],
            'multipleKeys' => [
                'patate',
                ['test' => [], 'patate' => []],
                true,
            ],

            'expectFailure' => [
                'patate',
                ['test' => []],
                false,
            ],
            'emptyString' => [
                'test',
                ['' => []],
                false,
            ],
            'indexedArray' => [
                'test',
                ['hello'],
                false,
            ],
        ];
    }

    #[DataProvider('isSubmittedProvider')]
    public function testIsSubmitted(string $formName, array $requestData, bool $expectSubmitted)
    {
        $form = new class($formName, []) extends AbstractForm {
            protected function configureFields(FieldCollection $fields, array|object $data) : FieldCollection
            {
                return $fields;
            }
        };

        [$isSubmitted, $isValid, $error] = $form->validate($requestData);

        $this->assertSame($expectSubmitted, $isSubmitted);
    }

    public function testGetField()
    {
        $form = new class('test', []) extends AbstractForm {
            protected function configureFields(FieldCollection $fields, array|object $data) : FieldCollection
            {
                $fields[] = (new TextField('potatoe', ''));
                $fields[] = (new ChoiceField('test', ''));
                $fields[] = (new NumberField('', ''));

                return $fields;
            }
        };

        $this->assertInstanceOf(TextField::class, $form->getField('potatoe'));
        $this->assertInstanceOf(ChoiceField::class, $form->getField('test'));
        $this->assertInstanceOf(NumberField::class, $form->getField(''));
        
        $this->expectException(TypeError::class);

        $form->getField('inexistant');
    }

    public function testGetFields()
    {
        $form = new class('test', []) extends AbstractForm {
            protected function configureFields(FieldCollection $fields, array|object $data) : FieldCollection
            {
                $fields[] = (new TextField('potatoe', ''));
                $fields[] = (new ChoiceField('test', ''));
                $fields[] = (new NumberField('', ''));

                return $fields;
            }
        };

        $fields = $form->getFields();

        $this->assertSame(3, count($fields));
    }
}