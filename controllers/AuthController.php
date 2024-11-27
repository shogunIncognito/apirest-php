<?php
include_once 'services/AuthService.php';

class AuthController
{
    public function AuthAdmin()
    {
        try {
            $credentials = json_decode(file_get_contents('php://input'), true);
            $service = new AuthService();
            $token = $service->authAdmin($credentials);

            $this->sendResponse(200, [
                "error" => false,
                "token" => $token
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
