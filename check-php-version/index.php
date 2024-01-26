<?php

/*if (PHP_MAJOR_VERSION < 8) {
    die("Require PHP Version >= 8");
}*/

if (version_compare(phpversion(), '8.1.0') == -1) {
    die("Require PHP Version >= 8.1.0");
}

var_dump(PHP_VERSION); // 7.4.30
var_dump(phpversion()); // 7.4.30
var_dump(PHP_VERSION_ID); // 70430
var_dump(PHP_MAJOR_VERSION); // 7

var_dump(str_contains('hello', 'o'));
