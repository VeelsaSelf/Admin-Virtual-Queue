<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('user_cart', []);
        if (empty($cart)) return redirect()->route('user.menu.index');
        $subtotal  = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        $tax       = (int)($subtotal * 0.10);
        $total     = $subtotal + $tax;
        $cartCount = count($cart);
        return view('user.checkout.index', compact('cart', 'subtotal', 'tax', 'total', 'cartCount'));
    }

    public function store(Request $request)
    {
        $cart     = session('user_cart', []);
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        $tax      = (int)($subtotal * 0.10);
        $total    = $subtotal + $tax;
        $orderId  = strtoupper(substr(uniqid(), -8));
        $name      = trim($request->customer_name ?? '');
        $method    = trim($request->payment_method ?? '');
        $orderType = trim($request->order_type ?? 'Dine In');
        $status = ($name === '' || $method === '') ? 'failed' : 'processing';
        $order = [
            'id'             => $orderId,
            'order_number'   => rand(10, 99),
            'customer_name'  => $name ?: 'Guest',
            'payment_method' => $method ?: '-',
            'order_type'     => $orderType,
            'items'          => $cart,
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            'total'          => $total,
            'status'         => $status,
            'date'           => now()->format('d-m-Y'),
            'time'           => now()->format('h:i A'),
        ];
        session(['user_order_' . $orderId => $order]);
        session()->forget('user_cart');
        return redirect()->route('user.payment.status', $orderId);
    }

    public function restoreFromOrder(string $orderId)
    {
        $order = session('user_order_' . $orderId);
        if (!$order) return redirect()->route('user.menu.index');
        session(['user_cart' => $order['items']]);
        return redirect()->route('user.checkout.index');
    }
}