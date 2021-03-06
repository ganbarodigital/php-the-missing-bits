<?php

trait ExampleTrait
{
    // FilterClassProperties::from() will find these, depending on the
    // $filter that you pass to it
    public static $trait1 = "I am public static trait1";
    protected static $trait2 = "I am protected static trait2";
    private static $trait3 = "I am private static trait3";

    // FilterClassProperties::from() will not find these, because they are not
    // static propertes
    public $trait4 = "I am public trait4";
    protected $trait5 = "I am protected trait5";
    private $trait6 = "I am private trait6";
}

class ExampleClass
{
    use ExampleTrait;

    // FilterClassProperties::from() will find these, depending on the
    // $filter that you pass to it
    public static $value1 = "I am public static value1";
    protected static $value2 = "I am protected static value2";
    private static $value3 = "I am private static value3";

    // FilterClassProperties::from() will not find these, because they are not
    // static propertes
    public $value4 = "I am public value4";
    protected $value5 = "I am protected value5";
    private $value6 = "I am private value6";
}