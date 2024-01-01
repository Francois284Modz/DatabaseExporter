<?php

require 'DatabaseExporter.php';

header('Content-Type: text/plain');

$databaseConfig = [
    'database_type' => 'mysql',
    'database_name' => '',
    'server' => '',
    'username' => '',
    'password' => ''
];

$exporter = new DatabaseExporter($databaseConfig);
$backupSql = $exporter->exportAllTables();

// Save to SQLDumper file
file_put_contents('backup.sql', $backupSql);