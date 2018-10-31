<?php

namespace Mch\ChoiceListTypeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ChoiceListType
 * CollectionType extension:
 * > only for a ChoiceType collection
 * > use ChoiceListItemnType instead of ChoiceType
 * @package Mch\ChoiceListTypeBundle\Form\Type
 */
class ChoiceListType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entry_type' => ChoiceListItemType::class,
        ]);
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return CollectionType::class;
    }
}
