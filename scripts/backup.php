<?php

$date = date('Y-m-d_H-i-s');

$host = 'mysql-mediatekformation-test.alwaysdata.net';
$dbname = '';
$user = '';
$password = '';

$backupDir = __DIR__ . '/../backup';

if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

$filename = $backupDir . '/backup_' . $date . '.sql';

$command = sprintf(
    'mysqldump --host=%s --user=%s --password=%s %s > %s 2>&1',
    escapeshellarg($host),
    escapeshellarg($user),
    escapeshellarg($password),
    escapeshellarg($dbname),
    escapeshellarg($filename)
);

exec($command, $output, $resultCode);

if ($resultCode !== 0) {
    echo "Erreur lors de la sauvegarde.\n";
    echo implode("\n", $output);
    exit;
}

foreach (glob($backupDir . '/backup_*.sql') as $file) {
    if (filemtime($file) < time() - (7 * 24 * 60 * 60)) {
        unlink($file);
    }
}

echo "Sauvegarde réussie : " . $filename;