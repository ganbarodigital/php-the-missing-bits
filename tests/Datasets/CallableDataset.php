<?php

use GanbaroDigital\MissingBits\TypeChecks\IsArray;

class CallableDataset
{
    public static function provideCallables()
    {
        return array_append_values(
            static::provideCallableArrays(),
            static::provideCallableFunctions(),
            static::provideCallableStrings(),
            static::provideCallableObjects()
        );
    }

    public static function provideCallableArrays()
    {
        return [
            'callable(static method array)' => [ [IsArray::class, 'check'] ],
            'callable(object array)' => [ [new IsArray, 'check'] ],
        ];
    }

    public static function provideCallableFunctions()
    {
        return [
            'callable(anonymous function)' => [ function() {} ],
        ];
    }

    public static function provideCallableObjects()
    {
        return [
            'callable(invokeable object)' => [ new CallableInvokeableObject ],
        ];
    }

    public static function provideCallableStrings()
    {
        return [
            'callable(built-in function string)' => [ 'str_replace' ],
            'callable(static method string)' => [ IsArray::class . '::check' ],
        ];
    }

    public static function provideNonCallables()
    {
        $retval = array_append_values(
            ArrayDataset::provideArrays(),
            BooleanDataset::provideBooleans(),
            DoubleDataset::provideDoubles(),
            IntegerDataset::provideIntegers(),
            NullDataset::provideNull(),
            ObjectDataset::provideObjects(),
            ResourceDataset::provideResources(),
            StringDataset::provideStrings()
        );

        foreach ($retval as $key => $params) {
            if (is_callable($params[0])) {
                unset($retval[$key]);
            }
        }

        return $retval;
    }
}

class CallableInvokeableObject
{
    public function __invoke()
    {

    }
}