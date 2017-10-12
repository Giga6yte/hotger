<?php

function getInt($mn, $mx = null) {
    if ($mx != null && $mn > $mx) {
        return 'Переданы два значения, но max < min. Мы так не договаривались.';
    }
    switch ($mn <=> $mx) {
        case 0:
        case -1:
            $result = random_int($mn, $mx);
            break;
        case 1:
            $mx = $mn;
            $result = random_int(0, $mx);
            break;
    }
    return $result;
}

echo getInt(filter_input(INPUT_GET, 'min'), filter_input(INPUT_GET, 'max'));
