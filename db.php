<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'BD201');
define('DB_USER', 'root');
define('DB_PASS', isset($_ENV['MYSQL_ROOT_PASSWORD']) ? $_ENV['MYSQL_ROOT_PASSWORD'] : '');
define('DB_CHAR', 'utf8');
define('SITE_ROOT', __DIR__);
define('SITE_FOLDER', basename(dirname(__FILE__)));
class DB
{
    protected static $instance = null;

    public static function instance()
    {
        if (self::$instance === null) {
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            );
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        if (!$args) {
            return self::instance()->query($sql);
        }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
