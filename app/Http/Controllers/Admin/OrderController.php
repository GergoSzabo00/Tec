<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentOption;
use Yajra\Datatables\Datatables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            return DataTables::of(Order::with(['order_status_object','payment_option_object'])->select('orders.*'))
                ->addColumn('checkbox', function ($row)
                {
                    return '<input type="checkbox" class="form-check-input" name="ids" value="'.$row->id.'">';
                })
                ->addColumn('order_status', function($row)
                {
                    return $row->order_status_object->name;
                })
                ->addColumn('payment_option', function($row)
                {
                    return $row->payment_option_object->name;
                })
                ->addColumn('action', function ($row)
                {
                    $btns = '
                    <div class="d-flex justify-content-center">
                    <a href="'.route('order.details', $row).'" class="btn action-btn btn-primary me-2" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Preview').'">
                    <i class="fa fa-fw fa-eye"></i>
                    </a>
                    <a href="'.route('order.edit', $row).'" id="editBtn" class="btn action-btn btn-secondary me-2" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Edit').'">
                    <i class="fa fa-fw fa-pen-to-square"></i>
                    </a>
                    <button class="btn action-btn btn-danger deleteBtn" data-bs-id="'.$row->id.'" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Delete').'">
                    <i class="fa fa-fw fa-xmark"></i>
                    </button>
                    </div>';
                    return $btns;
                })
                ->rawColumns(['checkbox', 'action'])
                ->orderColumn('customer_name', function($query, $order){
                        $query->orderBy('customer_name', $order);
                })
                ->orderColumn('customer_name', function($query, $order){
                    $query->orderBy('customer_name', $order);
                })
                ->orderColumn('shipping_address', function($query, $order){
                    $query->orderBy('shipping_address', $order);
                })
                ->make(true);
        }
        return view('admin.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orderDetails = $order->order_details;
        $orderStatusName = $order->order_status_object->name;
        $paymentOptionName = $order->payment_option_object->name;
        return view('admin.orders.show')->with(compact('order', 'orderDetails', 'orderStatusName', 'paymentOptionName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $statuses = OrderStatus::all();
        return view('admin.orders.edit')->with(compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\OrderUpdateRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $order->update($request->except('_token'));

        return redirect()->route('order.edit', $order)->with('success', __('Order updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        Order::whereIn('id', $ids)->delete();

        return response()->json(['data'=>'success']);
    }
}
