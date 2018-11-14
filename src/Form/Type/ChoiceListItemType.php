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
     * List of available options in fields_config
     */
    private const FIELDS_CONFIG_OPTIONS = [
        'label',
        'expanded',
        'multiple',
        'required',
        'placeholder',
        'preferred_choices',
        'group_by',
    ];

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        // required options
        $resolver->setRequired([
            'choices_config',
        ]);

        // default options
        $resolver->setDefaults([
            'fields_config' => [],
        ]);

        // set choices based on choices_config values
        $resolver->setDefault('choices', function (Options $options) {
            // get index
            $index = intval(str_replace(['[', ']'], '', $options['property_path']));

            return $options['choices_config'][$index];
        });

        // set other options values based on fields_config values
        foreach (self::FIELDS_CONFIG_OPTIONS as $option) {
            $this->setResolverNormalizer($resolver, $option);
        }
    }

    /**
     * Set values for an option based on fields_config
     * If fields_config entry doesn't exist: keep old 'classic' value
     * @param OptionsResolver $resolver
     * @param string $option
     */
    private function setResolverNormalizer(OptionsResolver $resolver, string $option)
    {
        $resolver->setNormalizer($option, function (Options $options, $previous) use ($option) {
            // get index
            $index = intval(str_replace(['[', ']'], '', $options['property_path']));

            return $options['fields_config'][$index][$option] ?? $previous;
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
