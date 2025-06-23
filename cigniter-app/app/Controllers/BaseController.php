<?php

namespace App\Controllers;

use App\Libraries\AuthTrait; // <-- Use our new Trait
use App\Models\AuthTokenModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    use AuthTrait; // <-- This "mixes in" the methods from our trait

    protected $request;
    protected $helpers = ['form', 'url']; // Good idea to load these helpers globally
    protected $session; // A property to hold the session instance

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // --- OUR MODIFICATIONS START HERE ---

        // 1. Load the session service for use in all controllers
        $this->session = \Config\Services::session();

        // 2. Attempt to automatically log in the user from the "Remember Me" cookie
        $this->attemptLoginFromCookie();
    }

    /**
     * Checks for a "Remember Me" cookie and logs the user in if it's valid.
     */
    private function attemptLoginFromCookie(): void
    {
        // Get the request service
        $request = service('request');
        
        // Guard clause: If we are already logged in or there is no cookie, do nothing.
        if (session()->get('is_logged_in') || ! $request->getCookie('remember_me')) {
            return;
        }

        // Try to parse the cookie.
        $cookieData = explode(':', $request->getCookie('remember_me'));
        if (count($cookieData) !== 2) {
            return;
        }
        [$selector, $validator] = $cookieData;
        
        // Look up the token by its selector in the database.
        $tokenModel = new AuthTokenModel();
        $token = $tokenModel->where('selector', $selector)->first();
        
        // If a token was found and the validator matches the hash in the DB...
        if ($token && password_verify($validator, $token['hashed_validator'])) {
            // Find the associated user.
            $userModel = new UserModel();
            $user = $userModel->find($token['user_id']);

            if ($user) {
                // SUCCESS! The token is valid.
                // 1. Create a new session for the user.
                $this->setUserSession($user); // Method from our AuthTrait
                
                // 2. (Security) Invalidate the old token and create a fresh one.
                $tokenModel->delete($token['id']);
                $this->createRememberMeToken($user['id']); // Method from our AuthTrait
            }
        }
    }
}