<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Ensure Vercel environment flag
putenv('VERCEL=1');
$_ENV['VERCEL'] = '1';
$_SERVER['VERCEL'] = '1';

// Ensure APP_KEY exists
if (empty($_ENV['APP_KEY']) && empty($_SERVER['APP_KEY']) && !getenv('APP_KEY')) {
    $defaultKey = 'base64:sCOiKQoWFj/wdAiTrxNGWcZAU72fdquuJxGlf6IaImc=';
    putenv("APP_KEY={$defaultKey}");
    $_ENV['APP_KEY'] = $defaultKey;
    $_SERVER['APP_KEY'] = $defaultKey;
}

// Redirect all Laravel cache & storage paths to writable /tmp
$baseTmp = '/tmp/storage';

putenv("APP_SERVICES_CACHE={$baseTmp}/bootstrap/cache/services.php");
putenv("APP_PACKAGES_CACHE={$baseTmp}/bootstrap/cache/packages.php");
putenv("APP_CONFIG_CACHE={$baseTmp}/bootstrap/cache/config.php");
putenv("APP_ROUTES_CACHE={$baseTmp}/bootstrap/cache/routes.php");
putenv("APP_EVENTS_CACHE={$baseTmp}/bootstrap/cache/events.php");
putenv("VIEW_COMPILED_PATH={$baseTmp}/framework/views");

$_ENV['APP_SERVICES_CACHE'] = "{$baseTmp}/bootstrap/cache/services.php";
$_ENV['APP_PACKAGES_CACHE'] = "{$baseTmp}/bootstrap/cache/packages.php";
$_ENV['APP_CONFIG_CACHE'] = "{$baseTmp}/bootstrap/cache/config.php";
$_ENV['APP_ROUTES_CACHE'] = "{$baseTmp}/bootstrap/cache/routes.php";
$_ENV['APP_EVENTS_CACHE'] = "{$baseTmp}/bootstrap/cache/events.php";
$_ENV['VIEW_COMPILED_PATH'] = "{$baseTmp}/framework/views";

$_SERVER['APP_SERVICES_CACHE'] = "{$baseTmp}/bootstrap/cache/services.php";
$_SERVER['APP_PACKAGES_CACHE'] = "{$baseTmp}/bootstrap/cache/packages.php";
$_SERVER['APP_CONFIG_CACHE'] = "{$baseTmp}/bootstrap/cache/config.php";
$_SERVER['APP_ROUTES_CACHE'] = "{$baseTmp}/bootstrap/cache/routes.php";
$_SERVER['APP_EVENTS_CACHE'] = "{$baseTmp}/bootstrap/cache/events.php";
$_SERVER['VIEW_COMPILED_PATH'] = "{$baseTmp}/framework/views";

// Create all required writable storage and cache directories in /tmp
$dirs = [
    "{$baseTmp}/bootstrap/cache",
    "{$baseTmp}/framework/views",
    "{$baseTmp}/framework/cache/data",
    "{$baseTmp}/framework/sessions",
    "{$baseTmp}/app/public",
    "{$baseTmp}/logs",
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    echo '<div style="font-family: sans-serif; padding: 30px; background: #fff; color: #111;">';
    echo '<h1 style="color: #e11d48;">Laravel Error on Vercel</h1>';
    echo '<p style="font-size: 16px;"><strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . ':' . $e->getLine() . '</p>';
    echo '<pre style="background: #f1f5f9; padding: 15px; border-radius: 8px; overflow: auto; font-size: 13px;">' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    echo '</div>';
}
