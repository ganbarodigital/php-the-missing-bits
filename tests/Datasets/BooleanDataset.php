<?php

class BooleanDataset
{
    public static function provideBooleans()
    {
        return [
            'bool(true)'  => [ true ],
            'bool(false)' => [ false ],
        ];
    }

    public static function provideNonBooleans()
    {
        return array_append_values(
            ArrayDataset::provideArrays(),
            CallableDataset::provideCallables(),
            DoubleDataset::provideDoubles(),
            IntegerDataset::provideIntegers(),
            NullDataset::provideNull(),
            ObjectDataset::provideObjects(),
            ResourceDataset::provideResources(),
            StringDataset::provideStrings()
        );
    }
}