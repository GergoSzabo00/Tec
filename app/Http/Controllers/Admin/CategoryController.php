<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
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
            return DataTables::of(Category::query())
                ->addColumn('checkbox', function ($row)
                {
                    return '<input type="checkbox" class="form-check-input" name="ids" value="'.$row->id.'">';
                })
                ->addColumn('action', function ($row)
                {
                    $btns = '
                    <div class="d-flex justify-content-center">
                    <a href="'.route('category.edit', $row).'" id="editBtn" class="btn action-btn btn-secondary me-2" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Edit').'">
                    <i class="fa fa-fw fa-pen-to-square"></i>
                    </a>
                    <button class="btn action-btn btn-danger deleteBtn" data-bs-id="'.$row->id.'" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Delete').'">
                    <i class="fa fa-fw fa-xmark"></i>
                    </button>
                    </div>';
                    return $btns;
                })
                ->rawColumns(['checkbox', 'action'])
                ->orderColumn('category_name', function($query, $order){
                        $query->orderBy('category_name', $order);
                })
                ->make(true);
        }

        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('category.create')->with('success', __('Category added successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->except('_token'));

        return redirect()->route('category.edit', $category)->with('success', __('Category updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        Category::whereIn('id', $ids)->delete();
        return response()->json(['data'=>'success']);
    }
}
