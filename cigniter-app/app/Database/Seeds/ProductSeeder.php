<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name'        => 'Pro Developer Laptop',
                'description' => 'A top-of-the-line laptop with 32GB RAM and a 1TB SSD. Perfect for compiling anything.',
                'price'       => 2499.99,
                'image_url'   => '/images/laptop.jpg', // Assumes image is in public/images/laptop.jpg
            ],
            [
                'name'        => 'Clicky Mechanical Keyboard',
                'description' => 'Feel the power with every keystroke. RGB lighting included for maximum productivity.',
                'price'       => 159.50,
                'image_url'   => '/images/keyboard.jpg',
            ],
            [
                'name'        => 'Ergonomic Vertical Mouse',
                'description' => 'Save your wrists with this comfortable and precise vertical mouse. Your carpal tunnel will thank you.',
                'price'       => 89.00,
                'image_url'   => '/images/mouse.jpg',
            ],
            [
                'name'        => '4K UltraWide Monitor',
                'description' => 'See all your code, terminals, and browser tabs at once on this stunning 34-inch display.',
                'price'       => 750.00,
                'image_url'   => '/images/monitor.jpg',
            ],
        ];

        // Using the Query Builder to insert data in a batch
        $this->db->table('products')->insertBatch($products);

        echo "Seeded " . count($products) . " products.\n";
    }
}