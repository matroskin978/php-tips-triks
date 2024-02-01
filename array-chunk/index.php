<?php

ini_set('memory_limit', '32M');
//var_dump(ini_get('memory_limit'));

/*$menu = [
    'Item 1',
    'Item 2',
    'Item 3',
    'Item 4',
    'Item 5',
    'Item 6',
    'Item 7',
    'Item 8',
    'Item 9',
    'Item 10',
    'Item 11',
    'Item 12',
];

$menu_chunks = array_chunk($menu, 4);

foreach ($menu_chunks as $menu_chunk) {
    foreach ($menu_chunk as $item) {
        echo "<div style='width: 25%; float: left;'>{$item}</div>";
    }
}*/

$data = file(__DIR__ . '/big.txt');

/*$tmp = '';
foreach ($data as $item) {
    $tmp .= $item;
}*/

$chunks = array_chunk($data, 10);
foreach ($chunks as $chunk) {
    $tmp = '';
    foreach ($chunk as $item) {
        $tmp .= $item;
    }
}
