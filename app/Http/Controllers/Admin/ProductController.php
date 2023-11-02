<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use Yajra\Datatables\Datatables;
use Image;

class ProductController extends Controller
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
            return DataTables::of(Product::with(['manufacturer','categories'])->select('products.*'))
                ->addColumn('checkbox', function ($row)
                {
                    return '<input type="checkbox" class="form-check-input" name="ids" value="'.$row->id.'">';
                })
                ->addColumn('manufacturer', function($row)
                {
                    if ($row->manufacturer)
                    {
                        return $row->manufacturer->name;
                    }
                    return '';
                    
                })
                ->addColumn('categories', function($row)
                {
                    if ($row->categories)
                    {
                        return $row->categories->pluck('category_name')->toArray();
                    }
                    return '';
                })
                ->addColumn('action', function ($row)
                {
                    $btns = '
                    <div class="d-flex justify-content-center">
                    <a href="'.route('product.details', $row).'" class="btn action-btn btn-primary me-2" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Preview').'">
                    <i class="fa fa-fw fa-eye"></i>
                    </a>
                    <a href="'.route('product.edit', $row).'" id="editBtn" class="btn action-btn btn-secondary me-2" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Edit').'">
                    <i class="fa fa-fw fa-pen-to-square"></i>
                    </a>
                    <button class="btn action-btn btn-danger deleteBtn" data-bs-id="'.$row->id.'" data-bs-tooltip="tooltip" data-bs-placement="top" title="'.__('Delete').'">
                    <i class="fa fa-fw fa-xmark"></i>
                    </button>
                    </div>';
                    return $btns;
                })
                ->rawColumns(['checkbox', 'action'])
                ->orderColumn('product_name', function($query, $order){
                        $query->orderBy('product_name', $order);
                })
                ->make(true);
        }
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        $manufacturers = Manufacturer::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        return DB::transaction(function () use ($request) 
        {
            $product = Product::create([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'manufacturer_id' => $request->manufacturer,
                'price' => $request->price,
                'quantity_in_stock' => $request->quantity_in_stock
            ]);

            $image = $this->uploadImage($request);

            if ($image)
            {
                $product->product_image = $image->basename;
                $product->save();
            }

            $categories = Category::find($request->category);
            $product->categories()->attach($categories);

            return redirect()->route('product.create')->with('success', __('Product created successfully!'));

        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('category_name')->get();
        // The pluck method retrieves all of the values for the id key and the toArray creates an array from it
        $selectedCategories = $product->categories->pluck('id')->toArray();
        $manufacturers = Manufacturer::orderBy('name')->get();
        return view('admin.products.edit')->with(compact('product', 'categories', 'selectedCategories', 'manufacturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->except('_token'));

        if($request->deleteProductImg == 1)
        {
            if($product->product_image)
            {
                $this->removeImage($product->product_image_filename);
                $product->product_image = null;
                $product->save();
            }
        }

        $image = $this->uploadImage($request);

        if ($image)
        {
            if ($product->product_image)
            {
                $this->removeImage($product->product_image_filename);
            }

            $product->product_image = $image->basename;
            $product->save();
        }

        $product->categories()->sync($request->category);

        return redirect()->route('product.edit', $product)->with('success', __('Product updated successfully!'));
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
        $products = Product::whereIn('id', $ids)->get();

        foreach($products as $product)
        {
            if($product->product_image)
            {
                $this->removeImage($product->product_image_filename);
            }
        }
        Product::whereIn('id', $ids)->delete();

        return response()->json(['data'=>'success']);
    }

    /**
     * Uploads image to the server
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Intervention\Image\Facades\Image
     */
    private function uploadImage(Request $request)
    {
        $file = $request->file('product_image');

        if(!$file)
        {
            return;
        }
        
        $fileName = uniqid();

        $product_image = Image::make($file)->save(public_path("images/products/{$fileName}.png"), 90, 'png');
        return $product_image;
    }

    /**
     * Deletes image from the server
     *
     * @param string $fileName
     */
    private function removeImage($fileName)
    {
        if(File::exists(public_path("images/products/{$fileName}")))
        {
            File::delete(public_path("images/products/{$fileName}"));
        }
    }

}
