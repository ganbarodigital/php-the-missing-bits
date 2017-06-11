<?php

class ResourceDataset
{
    public static function provideResources()
    {
        return [
            'resource(stdin)' => [ STDIN ],
        ];
    }

    public static function provideNonResources()
    {
        $retval = array_append_values(
            ArrayDataset::provideArrays(),
            BooleanDataset::provideBooleans(),
            CallableDataset::provideCallables(),
            DoubleDataset::provideDoubles(),
            IntegerDataset::provideIntegers(),
            NullDataset::provideNull(),
            ObjectDataset::provideObjects(),
            StringDataset::provideStrings()
        );

        foreach ($retval as $key => $params) {
            if (is_resource($params[0])) {
                unset($retval[$key]);
            }
        }

        return $retval;
    }
}