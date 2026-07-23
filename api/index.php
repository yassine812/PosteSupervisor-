<?php

// Vercel serverless runtime booster for Laravel
// 1. Setup writable storage folders
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/app/public/avatars',
    '/tmp/storage/app/public/logos',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Set environment overrides for Laravel
putenv('APP_KEY=base64:m9t5n8F6H3J2K5N8P0Q3R5S8T0U2W5Y8Z0A1B2C3D4E=');
putenv('APP_DEBUG=true');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_EVENTS_CACHE=/tmp/events.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('SESSION_DRIVER=cookie'); // Store sessions in cookie to avoid stateful session files
putenv('LOG_CHANNEL=stderr');    // Log to stdout/stderr for Vercel console

// 3. SQLite writeable database copy
$dbPath = '/tmp/database.sqlite';
$source = __DIR__ . '/../database/database.sqlite';
$depId = getenv('VERCEL_DEPLOYMENT_ID') ?: 'local';
$depIdPath = '/tmp/vercel_dep_id.txt';

$needsCopy = false;
if (!file_exists($dbPath)) {
    $needsCopy = true;
} else if (file_exists($depIdPath)) {
    $lastDepId = trim(file_get_contents($depIdPath));
    if ($lastDepId !== $depId) {
        $needsCopy = true;
    }
} else {
    $needsCopy = true;
}

if ($needsCopy && file_exists($source)) {
    copy($source, $dbPath);
    chmod($dbPath, 0666);
    file_put_contents($depIdPath, $depId);
} else if (!file_exists($dbPath)) {
    touch($dbPath);
}
putenv('DB_CONNECTION=sqlite');
putenv("DB_DATABASE=" . $dbPath);

// 4. Forward execution to public/index.php
require __DIR__ . '/../public/index.php';
