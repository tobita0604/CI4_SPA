<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Authentication check for API requests
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the request has a valid token
        $token = $request->getHeaderLine('Authorization');
        
        // If no token is present in the request
        if (empty($token)) {
            return $this->failUnauthorized();
        }
        
        // TODO: Validate token logic here
        // This would typically involve checking the token against a database
        // or validating a JWT
        
        return $request;
    }

    /**
     * After filter is not needed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do here
    }
    
    /**
     * Return unauthorized response
     */
    protected function failUnauthorized($description = 'Unauthorized')
    {
        $response = service('response');
        $response->setStatusCode(401);
        $response->setJSON([
            'status' => 401,
            'error' => 'Unauthorized',
            'message' => $description,
        ]);
        
        return $response;
    }
}