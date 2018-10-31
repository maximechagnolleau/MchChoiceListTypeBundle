MchChoiceListTypeBundle Documentation
=====================================

## 1. Installation

``` bash
$ composer require mch/choicelist-type-bundle
```

## 2. Configuration (without Flex)

If you're not using Flex, enable the bundle in the kernel:

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = [
        // ...
        new Mch\ChoiceListTypeBundle\MchChoiceListTypeBundle(),
        // ...
    ];
}
```

## 3. Basic Usage

Usage is mainly similar to a traditionnal [CollectionType field](https://symfony.com/doc/current/reference/forms/types/collection.html),
specifically used with a [ChoiceType field](https://symfony.com/doc/current/reference/forms/types/choice.html) collection.

The ChoiceListType simply adds a new "choices_config" option in the "entry_options" option.
This option allows to specify different dataset for each field in the collection:

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

Other options (ex. "required", "expanded" or "multiple") are still availabled and could be added to the "entry_options":

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
        'multiple' => true,
        'expanded' => true,
        'required' => true,
    ],
]);
```

## 4. Form Rendering and Default Data Values

Form rendering in twig is similar to a classic [CollectionType rendering](https://symfony.com/doc/current/reference/forms/types/collection.html#basic-usage).
Notice that a collection field only render if associated form data already exists.

In the case of a ChoiceListType, each field must have a default value for a correct rendering.
For example, to initialize and render the previous example with default value:

If select multiple option is not enabled:

```
// ...

// first field default value is empty,
// second field default value is 'test3'
$data = [
    'choices_list' => ['', 'test3'];
];

$builder = $this->createFormBuilder($data);

//...
```

If select multiple option is enabled:

```
// ...

// first field default values are 'test1' and 'test2'
// second field default value is empty
$data = [
    'choices_list' => [['test1', 'test2'], []];
];

$builder = $this->createFormBuilder($data);

//...
```
