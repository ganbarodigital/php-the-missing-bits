<?php

function typeinspector_run_dataitem($inspectorName, $dataItemAsString)
{
    $code = '';
    if (strpos($dataItemAsString, 'GetStrictTypes') !== false) {
        $code = "use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;" . PHP_EOL . PHP_EOL;
    }
    $code .= 'var_dump(' . $inspectorName . '(' . $dataItemAsString . '));';
    ob_start();
    eval($code);
    $varDump = ob_get_clean();

    $output = '```php' . PHP_EOL
         . $code . PHP_EOL . PHP_EOL
         . "// outputs" . PHP_EOL
         . "//" . PHP_EOL;

    foreach (explode("\n", trim($varDump)) as $line) {
        $output .= "// {$line}" . PHP_EOL;
    }

    $output .= '```' . PHP_EOL . PHP_EOL;

    // now, we need to know the return value, to help our caller work out
    // whether this data item is a success or not

    $code = '';
    if (strpos($dataItemAsString, 'GetStrictTypes') !== false) {
        $code = "use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;" . PHP_EOL . PHP_EOL;
    }
    $code .= 'return ' . $inspectorName . '(' . $dataItemAsString . ');';
    $retval = eval($code);

    // all done
    return [ $retval, $output ];
}

function typeinspector_run_dataset($inspectorName, $failureTypes)
{
    $dataSet = require __DIR__ . '/typeinspector_dataset.php';

    $successList = $failureList = [];

    foreach ($dataSet as $dataItem)
    {
        $failed = false;
        list($retval, $output) = typeinspector_run_dataitem($inspectorName, $dataItem);
        foreach ($failureTypes as $failureType) {
            if ($retval === $failureType) {
                $failureList[] = $output;
                $failed = true;
                break;
            }
        }

        if (!$failed) {
            $successList[] = $output;
        }
    }

    // output the final results

    if (count($successList)) {
        echo "Here's a list of examples of accepted input values:" . PHP_EOL . PHP_EOL;
        foreach ($successList as $output) {
            echo $output;
        }
    }

    if (count($failureList)) {
        echo "Here's a list of examples of ingored input values:" . PHP_EOL . PHP_EOL;
        foreach ($failureList as $output) {
            echo $output;
        }
    }
}
