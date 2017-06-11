<?php

class IntegerDataset
{
    public static function provideIntegers()
    {
        return [
            'int(zero)'     => [ 0 ],
            'int(negative)' => [ -100 ],
            'int(positive)' => [ 100 ],
        ];
    }

    public static function provideNonIntegers()
    {
        $retval = array_append_values(
            ArrayDataset::provideArrays(),
            BooleanDataset::provideBooleans(),
            CallableDataset::provideCallables(),
            DoubleDataset::provideDoubles(),
            NullDataset::provideNull(),
            ObjectDataset::provideObjects(),
            ResourceDataset::provideResources(),
            StringDataset::provideStrings()
        );

        foreach ($retval as $key => $params) {
            if (is_int($params[0])) {
                unset($retval[$key]);
            }
        }

        return $retval;
    }
}