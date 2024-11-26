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

        if (!$user) {
            http_response_code(404);
            return "User not found";
        }

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
        $query = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, age = ?, email = ? WHERE id = ?");
        $query->execute([
            $values["firstname"],
            $values["lastname"],
            $values["age"],
            $values["email"],
            $values[$id]
        ]);

        if ($query->rowCount() > 0) {
            return "User updated succesfully";
        } else {
            return "No changes made or user not found";
        }
    }
}
