<?php

$max = 100;
$min = 1;

for ($i = $min; $i <= $max; $i++) {
    if ($i % 3 === 0 && $i % 5 === 0) {
        echo "foobar ";
    } elseif ($i % 5 === 0) {
        echo "bar ";
    } elseif ($i % 3 === 0) {
        echo "foo ";
    } else {
        echo "{$i} ";
    }
}