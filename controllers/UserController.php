<?php
include_once 'services/UserService.php';

class UserController
{
    public function getAllUser()
    {
        $service = new UserService();
        $users = $service->getAllUsers();

        echo json_encode($users);
    }

    public function getUserById($id)
    {
        $service = new UserService();
        $user = $service->getUserById($id);

        echo json_encode($user);
    }

    public function createUser()
    {
        $input = file_get_contents('php://input');
        $values = json_decode($input, true);

        $service = new UserService();
        $result = $service->createUser($values);

        echo json_encode([
            "success" => true,
            "response" => $result
        ]);
    }

    public function updateUser($id)
    {
        $values = json_encode(file_get_contents('php://input'));

        $service = new UserService();
        $result = $service->updateUser($id, $values);

        echo json_encode([
            "success" => true,
            "response" => $result
        ]);
    }
}
