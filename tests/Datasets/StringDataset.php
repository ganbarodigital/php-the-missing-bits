<?php

class StringDataset
{
    public static function provideStrings()
    {
        return [
            'string'        => [ 'hello, world!' ],
            'string(empty)' => [ '' ],
        ];
    }

    public static function provideNonStrings()
    {
        $retval = array_append_values(
            ArrayDataset::provideArrays(),
            BooleanDataset::provideBooleans(),
            CallableDataset::provideCallables(),
            DoubleDataset::provideDoubles(),
            IntegerDataset::provideIntegers(),
            NullDataset::provideNull(),
            ObjectDataset::provideObjects(),
            ResourceDataset::provideResources()
        );

        foreach ($retval as $key => $params) {
            if (is_string($params[0])) {
                unset($retval[$key]);
            }
        }

        return $retval;
    }
}