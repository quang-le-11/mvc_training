<?php

class Connection
{
    private static $instance = null, $conn = null;

    private function __construct($config)
    {
        //connection Database
        try {
            //config dsn
            $dns = 'mysql:dbname='.$config['db'].';host='.$config['host'];
            //config $options
            /**
             * - utf 8
             *  - config ngoai le when queue bi error
             */
            $options = [
                PDO::MYSQL_ATTR_COMPRESS => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            //connection
            $con = new PDO($dns, $config['user'], $config['pass'], $options);
            self::$conn = $con;
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            App::$app->loadError('database', ['message' => $mess]);
            die();
        }
    }

    public static function getInstance($config)
    {
        if(self::$instance == null) {
           $connection = new Connection($config);
            self::$instance = self::$conn;
        }
        return self::$instance;
    }
}