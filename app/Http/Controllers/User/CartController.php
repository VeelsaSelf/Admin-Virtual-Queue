<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('user_cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        $cartCount = count($cart);
        return view('user.cart.index', compact('cart', 'total', 'cartCount'));
    }

    public function add(Request $request)
    {
        $cart = session('user_cart', []);
        $id = uniqid();
        $parts = [];
        if ($request->size)   $parts[] = $request->size;
        if ($request->sugar)  $parts[] = $request->sugar;
        if ($request->ice)    $parts[] = $request->ice;
        if ($request->rice)   $parts[] = $request->rice;
        if ($request->spicy)  $parts[] = $request->spicy;
        if ($request->serve)  $parts[] = $request->serve;
        if ($request->addons) {
            foreach ((array)$request->addons as $a) $parts[] = 'Add '.$a;
        }
        $cart[$id] = [
            'id'      => $id,
            'name'    => $request->name,
            'price'   => (int)$request->price,
            'img'     => $request->img,
            'qty'     => max(1,(int)$request->qty),
            'options' => implode(' • ', $parts),
            'notes'   => $request->notes,
        ];
        session(['user_cart' => $cart]);
        return redirect()->route('user.cart.index');
    }

    public function update(Request $request)
    {
        $cart = session('user_cart', []);
        $id = $request->id;
        if (isset($cart[$id])) {
            if ($request->action === 'increase') $cart[$id]['qty']++;
            else { $cart[$id]['qty']--; if ($cart[$id]['qty'] <= 0) unset($cart[$id]); }
        }
        session(['user_cart' => $cart]);
        return redirect()->route('user.cart.index');
    }

    public function remove(string $id)
    {
        $cart = session('user_cart', []);
        unset($cart[$id]);
        session(['user_cart' => $cart]);
        return redirect()->route('user.cart.index');
    }
}