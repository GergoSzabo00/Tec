<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    function index()
    {
        $total_revenue = Order::join('order_status', 'orders.order_status', '=', 'order_status.id')
        ->where('order_status.name', 'Completed')->sum('total_price');
        $total_orders = Order::count();
        $registered_users = User::count();
        return view('admin.admin')->with(compact('total_revenue', 'total_orders', 'registered_users'));
    }
}
