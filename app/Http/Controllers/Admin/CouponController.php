<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use Yajra\Datatables\Datatables;

class CouponController extends Controller
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
            return DataTables::of(Coupon::query())
                ->addColumn('checkbox', function ($row)
                {
                    return '<input type="checkbox" class="form-check-input" name="ids" value="'.$row->id.'">';
                })
                ->addColumn('action', function ($row)
                {
                    $btns = '
                    <div class="d-flex justify-content-center">
                    <a href="'.route('coupon.edit', $row).'" id="editBtn" class="btn action-btn btn-secondary me-2" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Edit').'">
                    <i class="fa fa-fw fa-pen-to-square"></i>
                    </a>
                    <button class="btn action-btn btn-danger deleteBtn" data-bs-id="'.$row->id.'" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Delete').'">
                    <i class="fa fa-fw fa-xmark"></i>
                    </button>
                    </div>';
                    return $btns;
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('admin.coupons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $coupon = Coupon::create([
            'code' => $request->code,
            'type' => $request->type,
            'coupon_value' => $request->coupon_value,
            'minimum_cart_amount' => $request->minimum_cart_amount,
            'expires_at' => $request->expires_at
        ]);

        return redirect()->route('coupon.create')->with('success', __('Coupon added successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit')->with(compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(CouponUpdateRequest $request, Coupon $coupon)
    {
        $coupon->update($request->except('_token'));

        return redirect()->route('coupon.edit', $coupon)->with('success', __('Coupon updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        Coupon::whereIn('id', $ids)->delete();
        return response()->json(['data'=>'success']);
    }
}
