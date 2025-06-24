<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;

class OrdersController extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        
        // This query finds all orders and then joins them with their items.
        // This is a more advanced but efficient way to get all data at once.
        $data['orders'] = $orderModel
            ->where('user_id', session()->get('user_id'))
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data['page_title'] = 'My Order History';
        return view('orders_view', $data);
    }

    public function checkout()
    {
        $cart = $this->session->get('cart');
        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $total = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $orderModel = new OrderModel();
        $orderId = $orderModel->insert([
            'user_id'     => session()->get('user_id'),
            'total_price' => $total,
        ]);

        $orderItemModel = new OrderItemModel();
        $itemsToInsert = [];
        foreach ($cart as $item) {
            $itemsToInsert[] = [
                'order_id'   => $orderId,
                'product_id' => $item['id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ];
        }
        $orderItemModel->insertBatch($itemsToInsert);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'There was a problem placing your order.');
        }
        
        $this->session->remove('cart');
        return redirect()->to('/orders')->with('success', 'Your order has been placed successfully!');
    }
}