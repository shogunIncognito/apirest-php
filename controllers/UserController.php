<?php
include_once 'services/UserService.php';

class UserController
{
    public function getAllUser()
    {
        $service = new UserService();
        $users = $service->getAllUsers();

        $this->sendResponse(200, $users);
    }

    public function getUserById($id)
    {
        $service = new UserService();
        $user = $service->getUserById($id);

        $this->sendResponse(200, $user);
    }

    public function createUser()
    {
        $input = file_get_contents('php://input');
        $values = json_decode($input, true);

        $service = new UserService();
        $result = $service->createUser($values);

        $this->sendResponse(201, [
            "error" => false,
            "response" => $result
        ]);
    }

    public function updateUser($id)
    {
        $values = json_decode(file_get_contents('php://input'), true);

        $service = new UserService();
        $result = $service->updateUser($id, $values);

        $this->sendResponse(201, [
            "error" => false,
            "response" => $result
        ]);
    }

    public function deleteUserById($id)
    {
        $service = new UserService();
        $result = $service->deleteUserById($id);

        $this->sendResponse(201, [
            "error" => false,
            "response" => $result
        ]);
    }

    private function sendResponse($status, $data)
    {
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
}
