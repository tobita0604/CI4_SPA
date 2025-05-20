<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table      = 'items';
    protected $primaryKey = 'id';
    
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = [
        'name', 'description', 'price', 'status', 
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'name'        => 'required|min_length[3]|max_length[100]',
        'description' => 'permit_empty|max_length[500]',
        'price'       => 'required|numeric',
        'status'      => 'required|in_list[active,inactive]',
    ];
    
    protected $validationMessages = [];
    protected $skipValidation = false;
}