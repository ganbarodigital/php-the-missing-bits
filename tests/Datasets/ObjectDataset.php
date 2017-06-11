<?php

class ObjectDataset
{
    public static function provideObjects()
    {
        return [
            'object(stdClass)' => [ new stdClass ],
        ];
    }

    public static function provideNonObjects()
    {
        $retval = array_append_values(
            ArrayDataset::provideArrays(),
            BooleanDataset::provideBooleans(),
            CallableDataset::provideCallables(),
            DoubleDataset::provideDoubles(),
            IntegerDataset::provideIntegers(),
            NullDataset::provideNull(),
            ResourceDataset::provideResources(),
            StringDataset::provideStrings()
        );

        foreach ($retval as $key => $params) {
            if (is_object($params[0])) {
                unset($retval[$key]);
            }
        }

        return $retval;
    }
}