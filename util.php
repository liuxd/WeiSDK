<?php
/**
 * Show variables with good style.
 */
function see()
{
    $cnt = func_num_args();
    $values = func_get_args();

    if (php_sapi_name() === 'cli') {
        print_r($values);
        return false;
    }

    if ($cnt > 1) {
        foreach ($values as $k => $v) {
            see($v);
        }
        return;
    } else {
        $value = $values[0];
    }
    $echo = function ($value, $color, $type) {
        $len = '';
        if (extension_loaded('mbstring') && $type === 'string') {
            $len = '(' . mb_strlen($value, 'UTF-8') . ')';
        }
        echo '<font color="',
        $color,
        '" style="font-family: arial;word-wrap: break-word;word-break: normal;"><b>',
        $type,
        $len,
        '</b> : ',
        $value,
        '</font><br>';
    };
    switch (true) {
        case is_string($value):
            $echo($value, 'red', 'string');
            break;
        case is_float($value):
            $echo($value, 'BlueViolet', 'float');
            break;
        case is_int($value):
            $echo($value, 'blue', 'int');
            break;
        case is_null($value):
            $echo('null', 'Coral ', 'null');
            break;
        case is_bool($value):
            $v = ($value) ? 'true' : 'false';
            $echo($v, 'green', 'bool');
            break;
        case is_array($value):
            echo '<b style="font-family:arial">array</b>(', count($value);
            echo ')<div style="margin:10px 20px;font-family:arial">';
            foreach ($value as $kk => $vv) {
                echo '<font color="#555">', $kk, '</font> => ', see($vv);
            }
            echo '</div>';
            break;
    }
}

# end of this file
