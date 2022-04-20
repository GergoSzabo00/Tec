<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSettingsRequest;

class StoreSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\StoreInfo  $storeInfo
     * @return \Illuminate\Http\Response
     */
    public function show(StoreInfo $storeInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $storeInfo = StoreInfo::first();
        return view('admin.storesettings')->with(compact('storeInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreSettingsRequest  $request
     * @param  \App\Models\StoreInfo  $storeInfo
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSettingsRequest $request)
    {
        $storeInfo = StoreInfo::first();
        $storeInfo->update($request->except('_token'));

        return redirect()->route('storesettings.edit', $storeInfo)->with('success', __('Store settings updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreInfo  $storeInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreInfo $storeInfo)
    {
        //
    }
}
