<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // For testing purposes, we'll use a simple password.
        // In a real application, you might generate random passwords or use more complex ones.
        $password = 'password123';
        
        // IMPORTANT: Never seed plain-text passwords. Always hash them.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $users = [
            // Admin User
            [
                'username'      => 'admin',
                'email'         => 'admin@example.com',
                'password_hash' => $hashedPassword,
                'role'          => 'admin',
            ],
            // Regular User
            [
                'username'      => 'testuser',
                'email'         => 'user@example.com',
                'password_hash' => $hashedPassword,
                'role'          => 'user',
            ],
        ];

        // Using the Query Builder to insert data
        $this->db->table('users')->insertBatch($users);

        // --- Output to console for clarity ---
        // This is a nice touch to let the developer know what happened.
        echo "Seeded 2 users.\n";
        echo "Default password for all users is: '{$password}'\n";
    }
}