<?php

namespace Mch\ChoiceListTypeBundle\Tests\Model;

class TestObject
{
    private $tests;

    public function __construct()
    {
        $this->tests = [];
    }

    public function getTests(): array
    {
        return $this->tests;
    }

    public function setTests(array $tests): TestObject
    {
        $this->tests = $tests;

        return $this;
    }
}
