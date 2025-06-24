<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Shop extends BaseController
{
    public function index()
    {
        $model = new ProductModel();

        $data = [
            'products'   => $model->findAll(),
            'page_title' => 'Welcome to Our Shop!',
        ];

        return view('shop_view', $data);
    }
}