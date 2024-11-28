<?php
include_once 'models/User.php';

class UserService
{
    public function getAllUsers()
    {
        return User::getAllUsers();
    }

    public function getUserById($id)
    {
        $user = User::getUserById($id);
        if (!$user) throw new Exception("User not found", 404);

        return $user;
    }

    public function createUser($values)
    {
        return User::createUser($values);
    }

    public function updateUser($id, $values)
    {
        $user = User::updateUser($id, $values);
        if (!$user) throw new Exception("User not found", 404);

        return $user;
    }

    public function deleteUserById($id)
    {
        $result = User::deleteUserById($id);
        if (!$result) throw new Exception("User not found");

        return $result;
    }
}
