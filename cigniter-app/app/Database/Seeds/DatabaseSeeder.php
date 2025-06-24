<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // The order can be important. It makes sense to seed users first,
        // then products, and then if you had orders, you would seed them last.
        
        $this->call('UserSeeder');
        $this->call('ProductSeeder');

        echo "All seeders run successfully.\n";
    }
}