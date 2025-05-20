<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ItemModel;

class Items extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\ItemModel';
    protected $format    = 'json';

    public function index()
    {
        $items = $this->model->findAll();
        return $this->respond(['items' => $items]);
    }

    public function show($id = null)
    {
        $item = $this->model->find($id);

        if (!$item) {
            return $this->failNotFound('No item found with id ' . $id);
        }

        return $this->respond(['item' => $item]);
    }

    public function create()
    {
        $rules = [
            'name'        => 'required|min_length[3]',
            'description' => 'required|min_length[10]',
            'price'       => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
        ];

        $id = $this->model->insert($data);

        if (!$id) {
            return $this->fail('An error occurred while creating the item.');
        }

        $item = $this->model->find($id);
        return $this->respondCreated(['item' => $item, 'message' => 'Item created successfully']);
    }

    public function update($id = null)
    {
        $item = $this->model->find($id);

        if (!$item) {
            return $this->failNotFound('No item found with id ' . $id);
        }

        $rules = [
            'name'        => 'required|min_length[3]',
            'description' => 'required|min_length[10]',
            'price'       => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'name'        => $this->request->getRawInput()['name'],
            'description' => $this->request->getRawInput()['description'],
            'price'       => $this->request->getRawInput()['price'],
        ];

        $this->model->update($id, $data);

        return $this->respond(['message' => 'Item updated successfully']);
    }

    public function delete($id = null)
    {
        $item = $this->model->find($id);

        if (!$item) {
            return $this->failNotFound('No item found with id ' . $id);
        }

        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'Item deleted successfully']);
    }
}