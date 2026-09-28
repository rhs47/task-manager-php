<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';
require_once __DIR__ . '/../classes/Task.php';

$database = new Database();
$pdo = $database->connect();

$taskModel = new Task($pdo);

session_start();