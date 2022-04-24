@extends('layouts.main')

@section('content')
<div class="my-3">
<x-forms.input id="productSearchbar" name="productSearchbar" placeholder="{{__('Search for products')}}" icon="search" />
</div>
<div class="row g-3">
    @forelse($products as $product)
    <div class="col-md-4 col-lg-3">
        <div class="card h-100">
            <img src="{{$product->product_image}}" class="card-img-top" alt="{{__('Product image of')}} {{$product->product_name}}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{$product->product_name}}</h5>
                <div class="d-grid mt-auto">
                    <p class="card-text text-danger fw-bold">${{number_format($product->price, 2)}}</p>
                    <a href="#" class="btn btn-primary rounded-pill"><i class="fa fa-fw fa-shopping-cart"></i> {{__('Add to cart')}}</a>
                </div>
            </div>
        </div>
    </div>
    @empty
        <div class="card">
            <div class="card-body">
                {{__('No products to show')}}
            </div>
        </div>
    @endforelse
    {{ $products->links() }}
</div>
@endsection