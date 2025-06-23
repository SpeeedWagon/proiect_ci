<?php namespace App\Libraries;

// You will need to use these models in the trait
use App\Models\AuthTokenModel;
use App\Models\UserModel;

trait AuthTrait
{
    /**
     * Creates a standard user session.
     */
    protected function setUserSession(array $user): void
    {
        $sessionData = [
            'is_logged_in' => true,
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'role'         => $user['role'],
        ];
        session()->set($sessionData);
    }

    /**
     * Creates and sets a "Remember Me" token and cookie.
     */
    protected function createRememberMeToken(int $userId): void
    {
        $selector  = bin2hex(random_bytes(16));
        $validator = bin2hex(random_bytes(32));

        $tokenData = [
            'selector'         => $selector,
            'hashed_validator' => password_hash($validator, PASSWORD_DEFAULT),
            'user_id'          => $userId,
            'expires'          => date('Y-m-d H:i:s', time() + 86400 * 30), // Expires in 30 days
        ];
        
        $tokenModel = new AuthTokenModel();
        $tokenModel->insert($tokenData);
        
        service('response')->setCookie('remember_me', $selector . ':' . $validator, 86400 * 30);
    }
}