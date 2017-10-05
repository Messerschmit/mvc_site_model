<?php

class DB
{
    /*
     * Return connection to main database
     *
     * */

    public static function getConnection()
    {
        $paramsPath = ROOT.'/config/db_params.php';

        $params = include ($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        $db = new PDO($dsn, $params['user'], $params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        return $db;
    }
}