<?php

namespace Mch\ChoiceListTypeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ChoiceListItemType
 * ChoiceType Extension:
 * > default "choices" option is set by using "choices_config" option
 * @package Mch\ChoiceListTypeBundle\Form\Type
 */
class ChoiceListItemType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired([
            'choices_config',
        ]);

        $resolver->setDefault('choices', function (Options $options) {
            // get index
            $index = intval(str_replace(['[', ']'], '', $options['property_path']));

            return $options['choices_config'][$index];
        });
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
