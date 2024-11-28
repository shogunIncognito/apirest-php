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
        try {
            $service = new UserService();
            $user = $service->getUserById($id);

            $this->sendResponse(200, $user);
        } catch (Exception $e) {
            $this->sendResponse($e->getCode(), [
                "error" => true,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function createUser()
    {
        try {
            $input = file_get_contents('php://input');
            $values = json_decode($input, true);

            $service = new UserService();
            $result = $service->createUser($values);

            $this->sendResponse(201, [
                "error" => false,
                "response" => $result
            ]);
        } catch (Exception $e) {
            $this->sendResponse($e->getCode(), [
                "error" => true,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function updateUser($id)
    {
        try {
            $values = json_decode(file_get_contents('php://input'), true);

            $service = new UserService();
            $result = $service->updateUser($id, $values);

            $this->sendResponse(201, [
                "error" => false,
                "response" => $result
            ]);
        } catch (Exception $e) {
            $this->sendResponse($e->getCode(), [
                "error" => true,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function deleteUserById($id)
    {
        try {
            $service = new UserService();
            $result = $service->deleteUserById($id);

            $this->sendResponse(201, [
                "error" => false,
                "response" => $result
            ]);
        } catch (Exception $e) {
            $this->sendResponse($e->getCode(), [
                "error" => true,
                "message" => $e->getMessage()
            ]);
        }
    }

    private function sendResponse($status, $data)
    {
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
}
