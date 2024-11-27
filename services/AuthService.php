<?php
include_once 'models/Admin.php';

class AuthService
{
    public function authAdmin($credentials)
    {
        $admin = Admin::getAdminByUsername($credentials["username"]);

        if (!$admin || $admin["password"] !== $credentials["password"]) {
            throw new Exception("Invalid credentials", 401);
        } else {
            // sign token
            return $this->signToken($admin["username"]);
        }
    }

    private function signToken($username)
    {
        return base64_encode(json_encode([
            "username" => $username,
            "iat" => time(),
            "exp" => time() + 3600 // Expira en 1 hora
        ]));
    }
}
