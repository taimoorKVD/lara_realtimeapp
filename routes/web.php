<?php

use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome')->withItems(Item::get());
});

Route::get('/admin', function () {
    return view('admin')->withOrders(Order::with('items')->orderBy('created_at', 'DESC')->get());
});
