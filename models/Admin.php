<?php
include_once 'config/Database.php';

class Admin
{
    public static function getAdminByUsername($username)
    {
        $conn = Database::getConnection();
        $query = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $query->execute([$username]);

        return $query->fetch();
    }
}
