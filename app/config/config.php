<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// نقرأ ملف الـ .env
$envPath = realpath(__DIR__ . '/../../.env');
if (!file_exists($envPath)) {
    die('.env file is missing!');
}

// نقرأ القيم في مصفوفة
$env = parse_ini_file($envPath, false, INI_SCANNER_TYPED);

// نحولها لثوابت
define('DB_HOST', $env['DB_HOST']);
define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASS', $env['DB_PASS']);

define('BASE_URL', $env['BASE_URL'] ?? '/');
define('UPLOAD_DIR', $env['UPLOAD_DIR'] ?? 'public/uploads/');

// إعدادات البريد الإلكتروني 

define('MAIL_USERNAME', $env['MAIL_USERNAME'] );
define('MAIL_PASSWORD', $env['MAIL_PASSWORD'] );
define('MAIL_HOST', $env['MAIL_HOST'] );
define('MAIL_PORT', $env['MAIL_PORT'] );
define('MAIL_ENCRYPTION', $env['MAIL_ENCRYPTION'] );