<?php

namespace Mch\ChoiceListTypeBundle\Tests\Form\Type;

use Mch\ChoiceListTypeBundle\Form\Type\ChoiceListType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tests', ChoiceListType::class, [
            'entry_options' => $options['entry_options'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entry_options' => [],
        ]);
    }
}
