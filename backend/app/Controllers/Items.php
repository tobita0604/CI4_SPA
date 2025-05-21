<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ItemModel;

class Items extends ResourceController
{
    protected $format = 'json';
    protected $modelName = 'App\Models\ItemModel';

    /**
     * Return an array of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $items = $this->model->findAll();
        
        return $this->respond([
            'status' => 'success',
            'data' => $items
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $item = $this->model->find($id);

        if ($item === null) {
            return $this->failNotFound('Item not found with id ' . $id);
        }

        return $this->respond([
            'status' => 'success',
            'data' => $item
        ]);
    }

    /**
     * Create a new resource object
     *
     * @return mixed
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $id = $this->model->insert($data);

        if ($id === false) {
            return $this->failServerError('Failed to create item');
        }

        $item = $this->model->find($id);

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Item created successfully',
            'data' => $item
        ]);
    }

    /**
     * Update a resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->find($id)) {
            return $this->failNotFound('Item not found with id ' . $id);
        }

        if (!$this->model->validate($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        if ($this->model->update($id, $data) === false) {
            return $this->failServerError('Failed to update item');
        }

        $item = $this->model->find($id);

        return $this->respond([
            'status' => 'success',
            'message' => 'Item updated successfully',
            'data' => $item
        ]);
    }

    /**
     * Delete a resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Item not found with id ' . $id);
        }

        if ($this->model->delete($id) === false) {
            return $this->failServerError('Failed to delete item');
        }

        return $this->respondDeleted([
            'status' => 'success',
            'message' => 'Item deleted successfully',
            'id' => $id
        ]);
    }
}