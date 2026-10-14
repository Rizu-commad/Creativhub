<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Ensure Vercel environment flag
putenv('VERCEL=1');
$_ENV['VERCEL'] = '1';
$_SERVER['VERCEL'] = '1';

// Create all required writable storage and cache directories in /tmp
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/app/public',
    '/tmp/storage/logs',
    '/tmp/views',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
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
