<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\AdminModel;

class AdminLogin extends ResourceController
{
    protected $modelName = 'App\Models\AdminModel'; 
    private $secretKey; 

    public function __construct()
    {
        $this->secretKey = getenv('JWT_SECRET');
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $this->model->where('email', $email)->first(); 

        if (!$admin) {
            return $this->failNotFound('Invalid Email ID');
        }

        if (!password_verify($password, $admin['password'])) {
            return $this->failUnauthorized('Invalid Password');
        }

        // Generate JWT Tokens
        $accessToken = $this->generateJWT([
            'sub' => 'admin',
            'loginId' => $admin['id'],
            'iat' => time(),
            'exp' => time() + 3600, // 1 hour
        ]);

        $refreshToken = $this->generateJWT([
            'sub' => 'admin',
            'loginId' => $admin['id'],
            'iat' => time(),
            'exp' => time() + (7 * 24 * 3600), // 7 days
        ]);

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Login successful',
            'token' => $accessToken,
            'refresh_token' => $refreshToken,
        ]);
    }

    public function chpwd()
    {
        $adminId = $this->request->getPost('adminId');
        $password = $this->request->getPost('password');

        $admin = $this->model->where('id', $adminId)->first();

        if (!$admin) {
            return $this->failNotFound('Invalid User ID');
        }

        $data = ['password' => password_hash($password, PASSWORD_DEFAULT)];
        $this->model->update($adminId, $data);  

        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Password changed successfully. Please log in again.',
        ]);
    }

    public function logout()
    {
        session_destroy();
        return $this->respond([
            'status'  => "Success",
            'code'    => 200,
            'message' => 'Logged out successfully',
        ]);
    }

    private function generateJWT($payload)
    {
        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function verifyToken()
    {
        $token = $this->request->getHeaderLine('Authorization');
        if (!$token) {
            return $this->failUnauthorized('Token required');
        }

        try {
            $decoded = JWT::decode(str_replace('Bearer ', '', $token), new Key($this->secretKey, 'HS256'));
            return $this->respond(['status' => 'Success', 'message' => 'Token valid', 'data' => $decoded]);
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token');
        }


        
        
    }
}
