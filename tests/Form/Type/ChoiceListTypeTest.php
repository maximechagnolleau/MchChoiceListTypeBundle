<?php

namespace Mch\ChoiceListTypeBundle\Tests\Form\Type;

use Mch\ChoiceListTypeBundle\Tests\Model\TestObject;
use Symfony\Component\Form\Test\TypeTestCase;

class ChoiceListTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'tests' => ['test1', 'test3', 'test5'],
        ];

        $objectToCompare = new TestObject();
        $objectToCompare->setTests([null, null, null]);

        $choicesConfig = [
            ['test1' => 'test1', 'test2' => 'test2'],
            ['test3' => 'test3', 'test4' => 'test4'],
            ['test5' => 'test5', 'test6' => 'test6'],
        ];

        $form = $this->factory->create(TestType::class, $objectToCompare, [
            'entry_options' => [
                'choices_config' => $choicesConfig,
            ],
        ]);

        $object = new TestObject();
        $object->setTests(['test1', 'test3', 'test5']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        $this->assertArrayHasKey('tests', $children);
        $this->assertEquals(count($choicesConfig), $children['tests']->count());
    }
}
