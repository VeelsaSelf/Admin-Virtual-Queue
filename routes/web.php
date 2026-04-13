<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', fn() => view('pages.login'))->name('login');
Route::post('/login', fn() => redirect()->route('dashboard'))->name('login.post');
Route::post('/logout', fn() => redirect()->route('login'))->name('logout');

Route::get('/dashboard',        fn() => view('pages.dashboard'))->name('dashboard');
Route::get('/orders',           fn() => view('pages.orders'))->name('orders');
Route::get('/payments',         fn() => view('pages.payments'))->name('payments');
Route::get('/menu-management',  fn() => view('pages.menu-management'))->name('menu-management');
Route::get('/menu-management/add', fn() => view('pages.menu-add'))->name('menu-add');
Route::get('/staff-management', fn() => view('pages.staff-management'))->name('staff-management');
Route::get('/staff-management/edit', fn() => view('pages.staff-edit'))->name('staff-edit');
Route::get('/staff-management/add', fn() => view('pages.staff-add'))->name('staff-add');
Route::get('/sales-report',     fn() => view('pages.sales-report'))->name('sales-report');


// ───── ADDON ─────
Route::post('/addon', function () {
    session()->flash('success', 'Add-On berhasil disimpan!');
    return redirect()->route('menu-management');
})->name('addon.store');

Route::delete('/addon/{id}', function ($id) {
    session()->flash('success', 'Add-On berhasil dihapus!');
    return redirect()->route('menu-management');
})->name('addon.destroy');


// ───── MENU EDIT ─────
Route::get('/menu-edit', function () {

    $menu = [
        'id' => 1,
        'name' => 'Chicken Teriyaki Rice Bowl',
        'category' => 'Food',
        'price' => 42000,
        'stock' => 10,
        'description' => 'Steamed rice topped with grilled chicken and teriyaki sauce.',
        'status' => 'available',
        'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=300',
        'variant' => 'Normal',
        'addons' => [
            ['id' => 1, 'name' => 'Egg', 'price' => 3000],
            ['id' => 2, 'name' => 'Extra Chicken', 'price' => 8000],
        ],
    ];

    $categories = [
        ['name' => 'Food'],
        ['name' => 'Drink'],
    ];

    $allAddons = [
        ['id' => 1, 'name' => 'Egg', 'price' => 3000],
        ['id' => 2, 'name' => 'Extra Chicken', 'price' => 8000],
        ['id' => 3, 'name' => 'Cheese', 'price' => 5000],
    ];

    $variants = [
        ['name' => 'Normal'],
        ['name' => 'Large'],
    ];

    return view('pages.menu-edit', compact(
        'menu',
        'categories',
        'allAddons',
        'variants'
    ));

})->name('menu.edit');


// ───── MENU UPDATE ─────
Route::put('/menu-update/{id}', function ($id) {
    session()->flash('success', 'Menu berhasil diupdate (dummy)');
    return redirect()->route('menu-management');
})->name('menu.update');


// ───── MENU DELETE ─────
Route::delete('/menu/{id}', function ($id) {
    session()->flash('success', 'Menu berhasil dihapus!');
    return redirect()->route('menu-management');
})->name('menu.destroy');