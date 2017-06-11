<?php

class ArrayDataset
{
    public static function provideArrays()
    {
        return [
            'array(empty)' => [ [] ]
        ];
    }

    public static function provideIterableObjects()
    {
        return [
            'object(ArrayIterator)' => [ new ArrayIterator([]) ],
            'object(IteratorAggregate)' => [ new ArrayDataset_IteratorAggregate ],
            'object(stdClass)' => [ new stdClass ],
        ];
    }

    public static function provideObjectsThatLookLikeArrays()
    {
        return [
            'object(ArrayObject)' => [ new ArrayObject([]) ],
        ];
    }

    public static function provideNonArrays()
    {
        $retval = array_append_values(
            BooleanDataset::provideBooleans(),
            CallableDataset::provideCallables(),
            DoubleDataset::provideDoubles(),
            IntegerDataset::provideIntegers(),
            NullDataset::provideNull(),
            ObjectDataset::provideObjects(),
            ResourceDataset::provideResources(),
            StringDataset::provideStrings(),
            self::provideIterableObjects(),
            self::provideObjectsThatLookLikeArrays()
        );

        foreach ($retval as $key => $params) {
            if (is_array($params[0])) {
                unset($retval[$key]);
            }
        }

        return $retval;
    }
}

class ArrayDataset_IteratorAggregate implements IteratorAggregate
{
    public function getIterator()
    {
        return new ArrayIterator([]);
    }

}