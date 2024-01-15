<?php

$db_config = require_once __DIR__ . '/db.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/vendor/autoload.php';

$db = Database::getInstance($db_config);
$data = $db->findAll('tags');
$data2 = $db->findOne('categories', 3);
$data3 = $db->query("SELECT * FROM tags WHERE id > ?", [5])->getAll();
$db->query("UPDATE tags SET slug = ? WHERE id = ?", ['travel!', 7]);

//dump($data);
//dump($data2);
//dump($data3);

dump($db->getQueries());
