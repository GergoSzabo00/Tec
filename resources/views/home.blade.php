@extends('layouts.main')

@push('scripts')
<script>
    $(document).ready(function() {
        $('#productSearchbar').keyup(function() {
            var search_term = $(this).val();

            if (search_term == null || search_term.trim() === '' || search_term.length < 3)
            {
                $('#productSearchbarItems').fadeOut(200);
                return;
            }

            $.ajax({
                url: "{{route('search.product')}}",
                method: 'POST',
                data: {'search_term': search_term, '_token': '{{csrf_token()}}'},
                success: function(products)
                {
                    displayFoundProducts(products);
                }
            });
        });

        function displayFoundProducts(products)
        {
            if(products.length > 0)
            {
                var productlist = [];

                for (product in products)
                {
                    var product_id = products[product]['id'];
                    var product_name = products[product]['product_name'];
                    var listItem = '<li><a href="{{route('user.product.detail', ':id')}}">'+product_name+'</a></li>';
                    listItem = listItem.replace(':id', product_id);
                    productlist.push(listItem);
                } 
                
                $('#productSearchbarItems').html(productlist);
                $('#productSearchbarItems').fadeIn(200);
            }
            else
            {
                $('#productSearchbarItems').fadeOut(200);
            }
            
        }

    });
</script>
@endpush

@section('content')
<div class="my-3">
    <x-forms.input id="productSearchbar" name="productSearchbar" placeholder="{{__('Search for products')}}" icon="search" />
    <ul id="productSearchbarItems" class="mt-2"></ul>
</div>
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-text">{{ __('Filter products') }}</h5>
        <form method="GET" action="{{ route('home') }}">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <label class="ms-3" for="categorySelect">{{__('Category')}}</label>
                    <div class="form-group">
                        <select id="categorySelect" name="category" class="selectpicker mb-3" data-width="100%" data-live-search="true" title="{{$categories->isEmpty() ? __('No categories') : __('Choose a category')}}" {{$categories->isEmpty() ? 'disabled': ''}}>
                            <option></option>
                            @foreach ($categories as $category)
                                <option {{ $categoryQueryParam == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="ms-3" for="manufacturerSelect">{{__('Manufacturer')}}</label>
                    <div class="form-group">
                        <select id="manufacturerSelect" name="manufacturer" class="selectpicker mb-3" data-width="100%" data-live-search="true" title="{{$manufacturers->isEmpty() ? __('No manufacturers') : __('Choose a manufacturer')}}" {{$manufacturers->isEmpty() ? 'disabled': ''}}>
                            <option></option>
                            @foreach ($manufacturers as $manufacturer)
                                <option {{ $manufacturerQueryParam == $manufacturer->id ? 'selected' : '' }} value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('home') }}" class="btn btn-danger rounded-pill" type="submit">{{ __('Clear filters') }}</a>
                    <button class="btn btn-primary rounded-pill" type="submit">{{ __('Apply filters') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row g-3">
    @forelse($products as $product)
    <div class="col-md-4 col-lg-3">
        <div class="card h-100 product-item">
            <a class="text-decoration-none text-reset" href="{{route('user.product.detail', $product->id)}}">
                <img src="{{$product->product_image}}" class="card-img-top" alt="{{__('Product image of')}} {{$product->product_name}}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{$product->product_name}}</h5>
                    <div class="mt-auto">
                        <p class="card-text text-primary fw-bold">${{number_format($product->price, 2, ',', ' ')}}</p>
                        <p>
                            <i class="fa fa-fw fa-boxes"></i> 
                            {{__('In stock')}}:
                            <span>{{$product->quantity_in_stock}} {{__('piece')}}
                        </p>
                    </div>
                </div>
            </a>
            @if($product->quantity_in_stock > 0)
            <div class="d-grid p-3">
                <button class="btn btn-primary rounded-pill addToCartBtn" data-bs-id="{{$product->id}}" type="button">
                    <i class="fa fa-fw fa-shopping-cart"></i>
                    {{__('Add to cart')}}
                </button>
            </div>
            @endif
        </div>
    </div>
    {{ $products->links() }}
    @empty
        <div class="card">
            <div class="card-body">
                {{__('No products to show')}}
            </div>
        </div>
    @endforelse
</div>
@endsection