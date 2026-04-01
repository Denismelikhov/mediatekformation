<?php

$host = 'mysql-mediatekformation-test.alwaysdata.net';
$dbname = '';
$user = '';
$password = '';

$file = __DIR__ . '/../backup/backup_a_restaurer.sql';

$command = sprintf(
    'mysql --host=%s --user=%s --password=%s %s < %s 2>&1',
    escapeshellarg($host),
    escapeshellarg($user),
    escapeshellarg($password),
    escapeshellarg($dbname),
    escapeshellarg($file)
);

exec($command, $output, $resultCode);

if ($resultCode === 0) {
    echo "Restauration réussie.";
} else {
    echo "Erreur lors de la restauration.\n";
    echo implode("\n", $output);
}