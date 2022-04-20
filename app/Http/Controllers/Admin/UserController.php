<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Yajra\Datatables\Datatables;

class UserController extends Controller
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
            return DataTables::of(
                User::leftJoin('customer_info', 'customer_info.user_id', '=', 'users.id')
                ->select([
                    'users.id',
                    'users.email',
                    'customer_info.firstname',
                    'customer_info.lastname',
                    'customer_info.phone',
                    'users.is_verified',
                    'users.is_admin',
                    'users.created_at'
                ]))
                ->addColumn('checkbox', function ($row)
                {
                    return '<input type="checkbox" class="form-check-input" name="ids" value="'.$row->id.'">';
                })
                ->addColumn('action', function ($row)
                {
                    $btns = '
                    <div class="d-flex justify-content-center">
                    <a href="'.route('user.edit', $row).'" id="editBtn" class="btn action-btn btn-secondary me-2" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Edit').'">
                    <i class="fa fa-fw fa-pen-to-square"></i>
                    </a>
                    <button class="btn action-btn btn-danger deleteBtn" data-bs-id="'.$row->id.'" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Delete').'">
                    <i class="fa fa-fw fa-xmark"></i>
                    </button>
                    </div>';
                    return $btns;
                })
                ->rawColumns(['checkbox', 'action'])
                ->orderColumn('email', function($query, $order){
                        $query->orderBy('email', $order);
                })
                ->orderColumn('firstname', function($query, $order){
                        $query->orderBy('firstname', $order);
                })
                ->orderColumn('lastname', function($query, $order){
                    $query->orderBy('lastname', $order);
            })
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->unguard();
        $user->update($request->except('_token'));
        $user->reguard();
        return redirect()->route('user.edit', $user)->with('success', __('User updated successfully!'));
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
        User::whereIn('id', $ids)->delete();
        return response()->json(['data'=>'success']);
    }
}
