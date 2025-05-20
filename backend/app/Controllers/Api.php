<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        return $this->respond([
            'status' => 'success',
            'message' => 'Welcome to the CI4_SPA API',
            'version' => '1.0.0',
        ]);
    }
}