@extends('layouts.admin')

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/translations/hu.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            language: 'en',
        })
        .catch(error => {
            console.error( error )
        })
</script>
@endpush

@section('content')
<form method="POST" action="{{route('product.create')}}" enctype="multipart/form-data">
    @csrf
    <div class="my-3">
        <a class="text-decoration-none" href="#"><i class="fa fa-chevron-left"></i> {{__('Products')}}</a>
        <div class="d-flex align-items-center">
        <h2 class="mt-4">{{ __('Add product') }}</h2>
        <button class="btn btn-primary rounded-pill ms-auto" type="submit"><i class="fa fa-plus"></i> {{__('Add product')}}</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mb-3"> 
            <div class="card">
                <div class="card-body">
                    <h5>{{__('Default information')}}</h5>
                    <div class="row mt-2 g-3">    
                        <x-forms.input id="product_name" name="product_name" icon="rectangle-list" label="{{ __('Product name') }}" placeholder="{{ __('Product name') }}" />
                        <x-forms.input type="number" id="price" name="price" icon="dollar" label="{{ __('Price') }}" placeholder="{{ __('Price') }}" />
                        <div>
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">{{__('Product image')}}</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>{{__('Organization')}}</h5>
                    <div class="row mt-4">
                        <div class="col-12">
                            <label class="ms-3" for="manufacturer">{{__('Manufacturer')}}</label>
                            <div class="form-group">
                                <select id="manufacturer_select" name="manufacturer" class="selectpicker mb-3" data-width="100%" title="{{__('Choose a manufacturer')}}">

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="ms-3" for="manufacturer">{{__('Category')}}</label>
                            <div class="form-group">
                                <select id="category_select" name="category" class="selectpicker mb-3" data-width="100%" title="{{__('Choose categories')}}" multiple>

                                </select>
                            </div>
                        </div>
                        <x-forms.input type="number" id="quantity_in_stock" name="quantity_in_stock" icon="boxes-stacked" label="{{__('Quantity in stock')}}" placeholder="{{__('Quantity in stock')}}" value="1" min="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection