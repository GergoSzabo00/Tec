@extends('layouts.main')

@section('content')
<div class="row g-5">
    <div class="col-12">
        <div class="d-flex flex-column flex-md-row">
            <div class="flex-grow-0">
                <img class="img fluid rounded" height="350" widht="350" src="{{$product->product_image}}" alt="{{__('Product image of')}} {{$product->product_name}}">
                <div class="flex-wrap mt-3">
                    @foreach ($product->categories as $category)
                        <span class="badge rounded-pill bg-secondary mx-1">{{$category->category_name}}</span>
                    @endforeach
                </div>
            </div>
            <div class="flex-grow-1 ms-3 mt-3">
                <h1>{{$product->product_name}}</h1>
                <h4 class="text-primary">${{number_format($product->price, 2, ',', ' ')}}</h4>
                <div class="mt-3">
                    <span>{{__('Manufacturer')}}:</span>
                    <span>{{$product->manufacturer ? $product->manufacturer->name : __('not given')}}</span>
                </div>
                <div class="mt-3">
                    <span><i class="fa fa-fw fa-boxes"></i> {{__('In stock')}}:</h5>
                    <span>{{$product->quantity_in_stock}} {{__('piece')}}</span>
                </div>
                @if($product->quantity_in_stock > 0)
                <div class="mt-3">
                    <button class="btn btn-primary rounded-pill addToCartBtn" data-bs-id="{{$product->id}}">
                        <i class="fa fa-fw fa-cart-shopping"></i>
                        {{__('Add to cart')}}
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-12">
        <h3>{{__('Description')}}</h3>
        <div class="ms-2">
            @if ($product->description)
                {!!$product->description!!}
            @else
                {{__('No description given')}}
            @endif
        </div>
    </div>
</div>
@endsection