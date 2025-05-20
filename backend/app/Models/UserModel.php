<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = [
        'username', 'email', 'password_hash', 'reset_hash', 'reset_at', 
        'activate_hash', 'status', 'status_message', 'active', 'force_pass_reset', 
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'email'    => 'required|valid_email|is_unique[users.email,id,{id}]',
    ];
    
    protected $validationMessages = [];
    protected $skipValidation = false;
    
    /**
     * Attempt user login
     */
    public function attemptLogin(string $email, string $password): array
    {
        $user = $this->where('email', $email)
                     ->where('active', 1)
                     ->first();
        
        if (is_null($user)) {
            return [
                'success' => false,
                'message' => 'User not found or account is inactive',
            ];
        }
        
        if (!password_verify($password, $user['password_hash'])) {
            return [
                'success' => false,
                'message' => 'Invalid password',
            ];
        }
        
        // Generate token
        $token = bin2hex(random_bytes(16));
        
        // In a real application, you would store this token in a database
        // and associate it with the user
        
        return [
            'success' => true,
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'token' => $token,
            ],
        ];
    }
}