<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    // This serves as the main dashboard for the admin area.
    public function dashboard()
    {
        // You could pass data like sales stats, recent orders, etc. here.
        $data = [
            'page_title' => 'Admin Dashboard',
        ];

        return view('admin/dashboard', $data);
    }
}