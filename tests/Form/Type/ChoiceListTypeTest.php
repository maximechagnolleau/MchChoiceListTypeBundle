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

    public function testFieldsConfig()
    {
        $formData = [
            'tests' => [['test1'], 'test3', 'test5'],
        ];

        $choicesConfig = [
            ['test1' => 'test1', 'test2' => 'test2'],
            ['test3' => 'test3', 'test4' => 'test4'],
            ['test5' => 'test5', 'test6' => 'test6'],
        ];

        $fieldsConfig = [
            [
                'label' => '1st select',
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'placeholder' => 'please, select...',
                'preferred_choices' => ['test1'],
            ],
            [
                'label' => null,
                'expanded' => false,
                'multiple' => false,
                'required' => true,
                'placeholder' => null,
                'preferred_choices' => [],
            ],
            [],
        ];

        $objectToCompare = new TestObject();
        $objectToCompare->setTests([null, null, null]);

        $form = $this->factory->create(TestType::class, $objectToCompare, [
            'entry_options' => [
                'choices_config' => $choicesConfig,
                'fields_config' => $fieldsConfig,
            ],
        ]);

        $object = new TestObject();
        $object->setTests([['test1'], 'test3', 'test5']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        $this->assertArrayHasKey('tests', $children);
        $this->assertEquals(count($choicesConfig), $children['tests']->count());

        $this->assertFielConfigurationIsOk($children['tests'][0]->vars, $fieldsConfig[0]);
        $this->assertFielConfigurationIsOk($children['tests'][1]->vars, $fieldsConfig[1]);
        $this->assertFielConfigurationIsOk($children['tests'][2]->vars, $fieldsConfig[1]);
    }

    /**
     * Asserts that a field configuration matches with the configuration parameters
     * @param $field
     * @param $configuration
     */
    private function assertFielConfigurationIsOk($field, $configuration)
    {
        $this->assertEquals($field['label'], $configuration['label']);
        $this->assertEquals($field['expanded'], $configuration['expanded']);
        $this->assertEquals($field['multiple'], $configuration['multiple']);
        $this->assertEquals($field['required'], $configuration['required']);
        $this->assertEquals($field['placeholder'], $configuration['placeholder']);
        if (empty($field['preferred_choices'])) {
            $this->assertEmpty($configuration['preferred_choices']);
        } else {
            $this->assertEquals($field['preferred_choices'][0]->value, $configuration['preferred_choices'][0]);
        }
    }
}
