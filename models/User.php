<?php
include_once 'config/Database.php';

class User
{
    public static function getAllUsers()
    {
        $conn = Database::getConnection();
        $query = $conn->query("SELECT * FROM users");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserById($id)
    {
        $conn = Database::getConnection();
        $query = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $query->execute([$id]);

        $user = $query->fetch();

        return $user;
    }

    public static function createUser($values)
    {
        $conn = Database::getConnection();
        $query = $conn->prepare("INSERT INTO users (firstname, lastname, age, email) VALUES (:firstname, :lastname, :age, :email)");
        $query->execute([
            ":firstname" => $values["firstname"],
            ":lastname" => $values["lastname"],
            ":age" => $values["age"],
            ":email" => $values["email"]
        ]);

        return $conn->lastInsertId();
    }

    public static function updateUser($id, $values)
    {
        $conn = Database::getConnection();

        // verificar si existe el usuario
        $userQuery = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $userQuery->execute([$id]);
        $userExist = $userQuery->fetch();

        if (!$userExist) {
            return null;
        }

        $query = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, age = ?, email = ? WHERE id = ?");
        $query->execute([
            $values["firstname"],
            $values["lastname"],
            $values["age"],
            $values["email"],
            $id
        ]);

        return $query->rowCount() > 0 ? 'User updated' : 'No changes made';
    }

    public static function deleteUserById($id)
    {
        $conn = Database::getConnection();
        $query = $conn->prepare("DELETE FROM users WHERE id = ?");
        $query->execute([$id]);

        $query->rowCount() > 0 ? 'User deleted' : null;
    }
}
