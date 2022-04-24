@extends('layouts.admin')

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/translations/hu.js"></script>
<script>
    $(document).ready(function() {
        ClassicEditor
        .create(document.querySelector('#description'), {
            language: 'en',
        })
        .catch(error => {
            console.error( error )
        });

        $('#productImage').on('change', function(e) {
            var previewImage = URL.createObjectURL(event.target.files[0]);
            $('#imagePreview').attr('src', previewImage);
            $('#imagePreviewContainer').addClass('d-block');
            $('#removeImgBtn').removeClass('d-none');
            $('#imagePreview').on('load', function() {
                URL.revokeObjectURL($('#imagePreview').attr('src'));
            });
        });

        $('#removeImgBtn').click(function() {
            $('#removeImgBtn').addClass('d-none');
            $('#productImage').val([]);
            $('#imagePreview').attr('src', '{{$product->product_image}}');
        });

    });
</script>
@endpush

@section('content')
<form method="POST" action="{{route('product.edit', $product)}}" enctype="multipart/form-data">
    @csrf
    <div class="my-3">
        <a class="text-decoration-none" href="{{route('products')}}"><i class="fa fa-chevron-left"></i> {{__('Products')}}</a>
        <div class="d-flex align-items-center">
        <h2 class="mt-4">{{__('Update product')}}</h2>
        <button class="btn btn-primary rounded-pill ms-auto" type="submit"><i class="fa fa-pen-to-square"></i> {{__('Update')}}</button>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12 col-lg-8"> 
            <div class="card">
                <div class="card-body">
                    <h5>{{__('Default information')}}</h5>
                    <div class="row mt-2 g-3">    
                        <x-forms.input id="product_name" name="product_name" icon="rectangle-list" label="{{ __('Product name') }}" placeholder="{{ __('Product name') }}" value="{{$product->product_name}}" />
                        <x-forms.input type="number" id="price" name="price" icon="dollar" label="{{ __('Price') }}" placeholder="{{ __('Price') }}" value="{{$product->price}}" min="0" max="99999999.99" step=".01" />
                        <div>
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5">{{$product->description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">{{__('Product image')}}</label>
                            <div id="imagePreviewContainer" class="d-block">
                                <img id="imagePreview" class="img-fluid rounded mb-3" width="100" height="100" src="{{$product->product_image}}" alt="{{__('Product image of')}} {{$product->product_name}}">
                                <button id="removeImgBtn" class="btn action-btn btn-danger d-none" type="button"><i class="fa fa-xmark"></i></button>
                            </div>
                            <div class="my-2">
                                <input type="hidden" name="deleteProductImg" value="0">
                                <x-forms.checkbox id="deleteProductImg" name="deleteProductImg" value="1" label="{{__('Delete product image')}}" errorMessage="" />
                            </div>
                            <input class="form-control" type="file" id="productImage" name="product_image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5>{{__('Organization')}}</h5>
                    <div class="row mt-4">
                        <div class="col-12">
                            <label class="ms-3" for="manufacturerSelect">{{__('Manufacturer')}}</label>
                            <div class="form-group">
                                <select id="manufacturerSelect" name="manufacturer" class="selectpicker mb-3" data-width="100%" data-live-search="true" title="{{$manufacturers->isEmpty() ? __('No manufacturers') : __('Choose a manufacturer')}}" {{$manufacturers->isEmpty() ? 'disabled': ''}}>
                                    <option></option>
                                    @foreach ($manufacturers as $manufacturer)
                                        <option {{ $product->manufacturer_id == $manufacturer->id  ? 'selected' : '' }} value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="ms-3" for="categorySelect">{{__('Category')}}</label>
                            <div class="form-group">
                                <select id="categorySelect" name="category[]" class="selectpicker mb-3" data-width="100%" data-live-search="true" title="{{$categories->isEmpty() ? __('No categories') : __('Choose categories')}}" {{$categories->isEmpty() ? 'disabled': ''}} multiple>
                                    @foreach ($categories as $category)
                                        <option {{ in_array($category->id, $selectedCategories) ? 'selected': ''}} value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <x-forms.input type="number" id="quantity_in_stock" name="quantity_in_stock" icon="boxes-stacked" label="{{__('Quantity in stock')}}" placeholder="{{__('Quantity in stock')}}" value="{{$product->quantity_in_stock}}" min="1" max="1000" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection