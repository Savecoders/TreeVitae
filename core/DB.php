<?php

require __DIR__ . '/../utils/loadenv.php';
class DB
{

    private $DB_NAME = '';
    private $DB_USER = '';
    private $DB_PASSWORD = '';
    private $DB_HOST = '';
    private $DB_PORT = '';

    private static $instance = null;

    /**
     * Conexión con nuestra base de datos
     */
    public static function getInstance()
    {
        loadEnv(__DIR__ . '/.env');
        $DB_NAME = $_ENV['DB_NAME'] ? $_ENV['DB_NAME'] :  'ejemplo-mvc-php';
        $DB_USER = $_ENV['DB_USER'] ? $_ENV['DB_USER'] :  'root';
        $DB_PASSWORD = $_ENV['DB_PASSWORD'] ? $_ENV['DB_PASSWORD'] : '12345';
        $DB_HOST = $_ENV['DB_HOST'] ? $_ENV['DB_HOST'] : 'localhost';
        $DB_PORT = $_ENV['DB_PORT'] ? $_ENV['DB_PORT'] : '3306';

        $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";

        if (!self::$instance) {
            self::$instance = new PDO($dsn, $DB_USER, $DB_PASSWORD);
        }
        return self::$instance;
    }
}
