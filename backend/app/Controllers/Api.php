<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Api extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $data = [
            'status' => 'success',
            'message' => 'Welcome to the CI4_SPA API',
            'version' => '1.0.0',
        ];

        return $this->respond($data);
    }

    /**
     * User authentication endpoint
     */
    public function login()
    {
        // Validation rules
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Use the UserModel to attempt login
        $model = new UserModel();
        $result = $model->attemptLogin($email, $password);

        if (!$result['success']) {
            return $this->failUnauthorized($result['message']);
        }

        return $this->respond([
            'status' => 'success',
            'user' => $result['user'],
            'message' => 'Login successful',
        ]);
    }

    /**
     * Get current user information
     */
    public function user()
    {
        // This would check the authenticated user from the request
        // and return the user data
        
        // For demonstration, we're just returning static data
        $userData = [
            'id' => 1,
            'username' => 'demo_user',
            'email' => 'demo@example.com',
            'roles' => ['admin'],
        ];

        return $this->respond([
            'status' => 'success',
            'user' => $userData,
        ]);
    }
}