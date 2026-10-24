<?php

// Pastikan direktori cache & storage tersedia di /tmp untuk lingkungan Vercel Serverless
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $dirs = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
    }
}

// Teruskan semua request ke public/index.php Laravel
require __DIR__ . '/../public/index.php';
