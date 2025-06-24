<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * This method checks if a logged-in user has the 'admin' role.
     * It is designed to be run AFTER the AuthFilter.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the 'role' session key is set to 'admin'.
        if (session()->get('role') !== 'admin') {
            // The user is logged in but is not an administrator.

            // It's good practice to not reveal that an admin page exists.
            // Redirecting to the homepage with a generic error is a good approach.
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }

        // If the check passes (user is an admin), allow the request to proceed.
    }

    /**
     * We don't need to do anything after the controller has run.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed.
    }
}