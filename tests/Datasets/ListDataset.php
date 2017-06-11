<?php

class ListDataset
{
    public static function provideNonLists()
    {
        $retval = array_append_values(
            BooleanDataset::provideBooleans(),
            CallableDataset::provideCallables(),
            DoubleDataset::provideDoubles(),
            NullDataset::provideNull(),
            ObjectDataset::provideObjects(),
            ResourceDataset::provideResources(),
            StringDataset::provideStrings()
        );

        foreach ($retval as $key => $params) {
            if (is_array($params[0])) {
                unset($retval[$key]);
            }
        }

        return $retval;
    }
}