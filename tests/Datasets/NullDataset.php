<?php

class NullDataset
{
    public static function provideNull()
    {
        return [
            'null' => [ null ],
        ];
    }

    public static function provideNonNulls()
    {
        return array_append_values(
            ArrayDataset::provideArrays(),
            BooleanDataset::provideBooleans(),
            CallableDataset::provideCallables(),
            DoubleDataset::provideDoubles(),
            IntegerDataset::provideIntegers(),
            ObjectDataset::provideObjects(),
            ResourceDataset::provideResources(),
            StringDataset::provideStrings()
        );
    }
}