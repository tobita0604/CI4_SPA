<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

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
        // Sample login implementation
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // This would be replaced with actual authentication logic
        $userData = [
            'id' => 1,
            'username' => 'demo',
            'email' => $this->request->getVar('email'),
            'token' => md5(time()),
        ];

        return $this->respond([
            'status' => 'success',
            'user' => $userData,
            'message' => 'Login successful',
        ]);
    }
}