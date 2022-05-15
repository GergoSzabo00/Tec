@extends('layouts.admin')

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/translations/hu.js"></script>
<script>
    $(document).ready(function() {
        ClassicEditor
        .create(document.querySelector('#description'), {
            language: '{{app()->getLocale()}}',
        })
        .catch(error => {
            console.error( error )
        });

        $('#productImage').on('change', function(e) {
            var previewImage = URL.createObjectURL(event.target.files[0]);
            $('#imagePreview').attr('src', previewImage);
            $('#imagePreviewContainer').addClass('d-block');
            $('#imagePreview').on('load', function() {
                URL.revokeObjectURL($('#imagePreview').attr('src'));
            });
        });

        $('#removeImgBtn').click(function() {
            $('#productImage').val([]);
            $('#imagePreview').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=');
            $('#imagePreviewContainer').removeClass('d-block');
        });

    });
</script>
@endpush

@section('content')
<form method="POST" action="{{route('product.create')}}" enctype="multipart/form-data">
    @csrf
    <div class="my-3">
        <a class="text-decoration-none" href="{{route('products')}}"><i class="fa fa-chevron-left"></i> {{__('Products')}}</a>
        <div class="d-flex align-items-center">
            <h2 class="mt-4">{{__('Add product')}}</h2>
            <button class="btn btn-primary rounded-pill ms-auto" type="submit"><i class="fa fa-plus"></i> {{__('Add product')}}</button>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-12 col-lg-8"> 
            <div class="card">
                <div class="card-body">
                    <h5>{{__('Default information')}}</h5>
                    <div class="row mt-2 g-3">    
                        <x-forms.input id="product_name" name="product_name" icon="rectangle-list" label="{{ __('Product name') }}" placeholder="{{ __('Product name') }}" />
                        <x-forms.input type="number" id="price" name="price" icon="dollar" label="{{ __('Price') }}" placeholder="{{ __('Price') }}" min="0" max="99999999.99" step=".01" />
                        <div>
                            <label for="description">{{__('Description')}}</label>
                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">{{__('Product image')}}</label>
                            <div id="imagePreviewContainer">
                                <img id="imagePreview" class="img-fluid rounded mb-3" width="100" height="100" src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=" alt="{{__('Product image')}}">
                                <button id="removeImgBtn" class="btn action-btn btn-danger" type="button"><i class="fa fa-xmark"></i></button>
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
                                        <option {{ old('manufacturer') == $manufacturer->id ? 'selected' : '' }} value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="ms-3" for="categorySelect">{{__('Category')}}</label>
                            <div class="form-group">
                                <select id="categorySelect" name="category[]" class="selectpicker mb-3" data-width="100%" data-live-search="true" title="{{$categories->isEmpty() ? __('No categories') : __('Choose categories')}}" {{$categories->isEmpty() ? 'disabled': ''}} multiple>
                                    @foreach ($categories as $category)
                                        <option {{ is_array(old('category')) && in_array($category->id, old('category')) ? 'selected' : '' }} value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <x-forms.input type="number" id="quantity_in_stock" name="quantity_in_stock" icon="boxes-stacked" label="{{__('Quantity in stock')}}" placeholder="{{__('Quantity in stock')}}" value="1" min="1" max="1000" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection