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
