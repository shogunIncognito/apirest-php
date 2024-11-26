<?php
class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (self::$connection === null) {
            try {
                $hostname = "localhost";
                $dbname = "phptest";
                $username = "root";
                $password = "";

                self::$connection = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $th) {
                json_encode([
                    "success" => false,
                    "message" => $th->getMessage()
                ]);
                die("Error de conexion " . $th->getMessage());
            }
        }

        return self::$connection;
    }
}
