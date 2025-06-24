<?php

namespace App\Controllers;

class Cart extends BaseController
{
    // Display the cart contents
    public function index()
    {
        $cart = $this->session->get('cart') ?? [];

        $data = [
            'cart_items' => $cart,
            'page_title' => 'Your Shopping Cart'
        ];
        return view('cart_view', $data);
    }

    // Add an item to the cart
    public function add()
    {
        $cart = $this->session->get('cart') ?? [];
        $productId = $this->request->getPost('product_id');

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id'       => $productId,
                'name'     => $this->request->getPost('product_name'),
                'price'    => $this->request->getPost('product_price'),
                'quantity' => 1
            ];
        }

        $this->session->set('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Remove an item from the cart
    public function remove($productId)
    {
        $cart = $this->session->get('cart') ?? [];
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        $this->session->set('cart', $cart);

        return redirect()->to('/cart')->with('success', 'Product removed from cart!');
    }
    
    // Clear the entire cart
    public function clear()
    {
        $this->session->remove('cart');
        return redirect()->to('/cart')->with('success', 'Cart has been cleared!');
    }
}