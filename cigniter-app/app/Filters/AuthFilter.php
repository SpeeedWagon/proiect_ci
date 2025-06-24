<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * This method is called before a controller is executed.
     * It checks if the user is logged in.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the 'is_logged_in' session key exists and is true.
        if (! session()->get('is_logged_in')) {
            // The user is not logged in.

            // Store the current URL in the session so we can redirect back to it after login.
            // This provides a better user experience.
            session()->set('redirect_url', current_url());

            // Redirect the user to the login page with an error message.
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }

        // If the check passes (user is logged in), we do nothing, and the
        // request is allowed to proceed to its intended controller.
    }

    /**
     * This method is called after a controller is executed.
     * We don't need to do anything here for authentication.
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