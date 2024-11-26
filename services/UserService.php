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
        return User::getUserById($id);
    }

    public function createUser($values)
    {
        return User::createUser($values);
    }

    public function updateUser($id, $values)
    {
        return User::updateUser($id, $values);
    }
}
