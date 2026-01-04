<?php
declare(strict_types=1);

final class Db
{
    public static function pdo(): PDO
    {
        $host = getenv('DB_HOST') ?: 'mysql';
        $db   = getenv('DB_NAME') ?: 'demo';
        $user = getenv('DB_USER') ?: 'app';
        $pass = getenv('DB_PASS') ?: 'secret';
        $charset = getenv('DB_CHARSET') ?: 'utf8mb4';

        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
