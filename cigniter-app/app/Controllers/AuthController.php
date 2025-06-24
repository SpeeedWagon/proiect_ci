<?php

namespace App\Controllers;

use App\Libraries\AuthTrait;
use App\Models\AuthTokenModel;
use App\Models\UserModel;

class AuthController extends BaseController
{
    use AuthTrait; // Gives this controller access to setUserSession() etc.

    public function register()
    {
        // Just shows the registration form
        return view('auth/register');
    }

    public function attemptRegister()
    {
        $validationRules = [
            'username'     => 'required|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[8]',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($validationRules)) {
            // If validation fails, redirect back to the form with errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'user', // Default role for new users
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful! Please log in.');
    }

    public function login()
    {
        // Just shows the login form
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $validationRules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid login credentials.');
        }

        // --- Login Success ---
        // 1. Create the user's main session
        $this->setUserSession($user);

        // 2. Handle the "Remember Me" functionality if checked
        if ($this->request->getPost('remember')) {
            $this->createRememberMeToken($user['id']);
        }
        
        // 3. Redirect user to their intended page or the homepage
        $redirectURL = session()->get('redirect_url') ?? '/';
        session()->remove('redirect_url');

        return redirect()->to($redirectURL)->with('success', 'Welcome back!');
    }

    public function logout()
    {
        // Handle "Remember Me" token removal
        if ($cookie = $this->request->getCookie('remember_me')) {
            [$selector] = explode(':', $cookie);
            
            $tokenModel = new AuthTokenModel();
            $tokenModel->where('selector', $selector)->delete();
            
            service('response')->deleteCookie('remember_me');
        }
        
        // Destroy the regular session
        $this->session->destroy();
        
        return redirect()->to('/login')->with('success', 'You have been successfully logged out.');
    }
}