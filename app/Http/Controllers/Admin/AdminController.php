<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;

class AdminController extends Controller
{
    function index()
    {
        $total_revenue = Order::join('order_status', 'orders.order_status', '=', 'order_status.id')
        ->where('order_status.name', 'Completed')->sum('total_price');
        $total_orders = Order::count();
        $registered_users = User::count();

        $recent_orders = Order::orderBy('created_at','desc')->limit(5)->get();

        $top_selling = OrderDetail::selectRaw('product_name, SUM(bought_quantity) as total')
        ->groupBy('product_name')
        ->orderBy('total', 'desc')->limit(5)->get();

        return view('admin.admin')
        ->with(compact('total_revenue', 'total_orders', 'registered_users', 'recent_orders', 'top_selling'));
    }

    function getMonthlySales(Request $request)
    {
        if($request->ajax())
        {
            $monthly_sales = Order::selectRaw('month(orders.created_at) as month, SUM(total_price) as total_sale')
            ->join('order_status', 'orders.order_status', '=', 'order_status.id')
            ->where('order_status.name', 'Completed')
            ->whereYear('orders.created_at', now()->year)
            ->groupBy('month')->get();
            
            $monthly_sales_array = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            foreach($monthly_sales as $sale)
            {
                $monthly_sales_array[$sale->month-1] = $sale->total_sale;
            }

            return response()->json($monthly_sales_array);

        }
    }

}
