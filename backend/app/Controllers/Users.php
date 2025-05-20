<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Shield\Models\UserModel;

class Users extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'CodeIgniter\Shield\Models\UserModel';
    protected $format    = 'json';

    public function index()
    {
        $users = $this->model->findAll();
        return $this->respond(['users' => $users]);
    }

    public function show($id = null)
    {
        $user = $this->model->find($id);

        if (!$user) {
            return $this->failNotFound('No user found with id ' . $id);
        }

        return $this->respond(['user' => $user]);
    }

    public function create()
    {
        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $userModel = model(UserModel::class);
        
        $user = $userModel->create([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        // Add to default group
        $userModel->addToDefaultGroup($user);

        return $this->respondCreated(['user' => $user, 'message' => 'User created successfully']);
    }

    public function update($id = null)
    {
        $user = $this->model->find($id);

        if (!$user) {
            return $this->failNotFound('No user found with id ' . $id);
        }

        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username,id,' . $id . ']',
            'email'    => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->model->update($id, [
            'username' => $this->request->getRawInput()['username'],
            'email'    => $this->request->getRawInput()['email'],
        ]);

        return $this->respond(['message' => 'User updated successfully']);
    }

    public function delete($id = null)
    {
        $user = $this->model->find($id);

        if (!$user) {
            return $this->failNotFound('No user found with id ' . $id);
        }

        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'User deleted successfully']);
    }
}