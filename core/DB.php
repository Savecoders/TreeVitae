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
        $dir = __DIR__ . '/../.env';

        $DB_NAME = 'tree_database';
        $DB_USER = 'root';
        $DB_PASSWORD = '';
        $DB_HOST = 'localhost';

      
        $DB_PORT = '3306'; //no olvidarme de cambiar el puerto cuando tenga todo 


        try {
            loadEnv($dir);
            $DB_NAME = $_ENV['DB_NAME'];
            $DB_USER = $_ENV['DB_USER'];
            $DB_PASSWORD = $_ENV['DB_PASSWORD'];
            $DB_HOST = $_ENV['DB_HOST'];
            $DB_PORT = $_ENV['DB_PORT'];
        } catch (Exception $e) {
        }

        $dsn = "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME";

        if (!self::$instance) {
            self::$instance = new PDO($dsn, $DB_USER, $DB_PASSWORD);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
