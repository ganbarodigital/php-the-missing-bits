<?php

class ExampleClass1
{
    // HasClassProperties::check() will find these, depending on the
    // $filter that you pass to it
    public static $value1 = "I am public static value1";
    protected static $value2 = "I am protected static value2";
    private static $value3 = "I am private static value3";

    // HasClassProperties::check() will not find these, because they are not
    // static propertes
    public $value4 = "I am public value4";
    protected $value5 = "I am protected value5";
    private $value6 = "I am private value6";
}

class ExampleClass2
{
    // HasClassProperties::check() will find these, depending on the
    // $filter that you pass to it
    public static $value7 = "I am public static value7";
    protected static $value8 = "I am protected static value8";
    private static $value9 = "I am private static value9";

    // HasClassProperties::check() will not find these, because they are not
    // static propertes
    public $value10 = "I am public value10";
    protected $value11 = "I am protected value11";
    private $value12 = "I am private value12";
}

class ExampleClass3
{
    // we have no static properties!
}