<?php

class DoubleDataset
{
    public static function provideDoubles()
    {
        return [
            'double(zero)'     => [ 0.0 ],
            'double(negative)' => [ -3.1415927 ],
            'double(positive)' => [ 3.1415927 ],
        ];
    }

    public static function provideNonDoubles()
    {
        $retval = array_append_values(
            ArrayDataset::provideArrays(),
            BooleanDataset::provideBooleans(),
            CallableDataset::provideCallables(),
            IntegerDataset::provideIntegers(),
            NullDataset::provideNull(),
            ObjectDataset::provideObjects(),
            ResourceDataset::provideResources(),
            StringDataset::provideStrings()
        );

        foreach ($retval as $key => $params) {
            if (is_double($params[0])) {
                unset($retval[$key]);
            }
        }

        return $retval;
    }
}