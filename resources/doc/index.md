MchChoiceListTypeBundle Documentation
=====================================

## 1. Installation

``` bash
$ composer require mch/choicelist-type-bundle
```

## 2. Basic Usage

Usage is mainly similar to a traditionnal [CollectionType field](https://symfony.com/doc/current/reference/forms/types/collection.html),
specifically used with a [ChoiceType field](https://symfony.com/doc/current/reference/forms/types/choice.html) collection.

The ChoiceListType simply add a new "choices_config" option in the "entry_options" option.
This option allow to specify different dataset for each field in the collection :

``` php
use Mch\ChoiceListTypeBundle\Form\Type\ChoiceListType;
// ...

// fields configuration (lists of choices)
$choicesConfig = [
    ['Test 1' => 'test1', 'Test 2' => 'test2'],
    ['Test 3' => 'test3', 'Test 4' => 'test4'],
];
// form builder
$builder->add('choices_list', ChoiceListType::class, [
    'entry_options' => [
        'choices_config' => $choicesConfig,
    ],
]);
```
