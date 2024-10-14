<?php
require_once '../app/models/RegisterModel.php';

if ($argc < 2) {
    die("Usage: php validateActiveSessions.php <hours>\n");
}

$hours = (int)$argv[1];
$timeLimit = date('Y-m-d H:i:s', strtotime("-$hours hours"));

$registerModel = new RegisterModel('users');

try {
    $activeUsers = $registerModel->getActiveUsers($timeLimit);
    foreach ($activeUsers as $user) {
        $registerModel->markAsInactive($user['id']);
    }
    echo count($activeUsers) . " usuarios marcados como inactivos.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}