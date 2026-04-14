<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function status(string $orderId)
    {
        $order = session('user_order_'.$orderId);
        if (!$order) return redirect()->route('user.menu.index');
        $cartCount = 0;
        return view('user.payment.status', compact('order', 'cartCount'));
    }

    public function confirm(Request $request, string $orderId)
    {
        $order = session('user_order_'.$orderId);
        if (!$order) return redirect()->route('user.menu.index');
        $order['status'] = $request->payment_status;
        session(['user_order_'.$orderId => $order]);
        return redirect()->route('user.payment.status', $orderId);
    }

    public function receipt(string $orderId)
    {
        $order = session('user_order_'.$orderId);
        if (!$order) return redirect()->route('user.menu.index');
        $cartCount = 0;
        return view('user.payment.receipt', compact('order', 'cartCount'));
    }
}