<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        
        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- BOOTSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <!-- FONTAWESOME -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet"  integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- BOOTSTRAP SELECT -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- CUSTOM STYLES -->
        <link href="{{ url('/css/main.css') }}" rel="stylesheet">
        <link href="{{ url('/css/flag-icons.css') }}" rel="stylesheet">
        @stack('styles')

        <!-- ICONS -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/images/favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/images/favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/images/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ url('/images/favicons/android-chrome-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="512x512" href="{{ url('/images/favicons/android-chrome-512x512.png') }}">
        <link rel="manifest" href="{{ url('/images/favicons/site.webmanifest') }}">

    </head>
    <body>
        @include('layouts._header')

        <main class="container py-3 min-vh-100">
            @include('layouts._alerts')
            @yield('content')
        </main>

        <template id="cartEmptyTemplate">
            <div class="cart-item">
                <span>{{__('Cart is empty')}}</span>
            </div>
        </template>
        <template id="cartItemTemplate">
            <div class="cart-item">
                <div class="flex-shrink-0">
                    <img width="50" height="50" class="rounded">
                </div>
                <div class="flex-grow-1 ms-3">
                    <span class="cart-item-name"></span>
                    <span class="cart-item-price"></span>
                </div>
                <button class="flex-shrink-0 ms-2 btn btn-danger action-btn action-btn-sm remove-item-from-cart-btn">
                    <i class="fa fa-fw fa-x"></i>
                </button>
            </div>
        </template>

        @include('layouts._footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() 
            {

                function updateCartItemCount(cartItemCount)
                {
                    $('#cartItemCount').text(cartItemCount);
                }

                function updateCartItemsInDropdown(cartItemCount, itemsInCart, totalPrice)
                {
                    $('#cartItems').html('');

                    if(cartItemCount == 0)
                    {
                        var clone = document.getElementById('cartEmptyTemplate').content.cloneNode(true);
                        $('#cartItems').html(clone);
                    }
                    else
                    {
                        var items = [];
                        
                        var cartItem = document.getElementById('cartItemTemplate').content;

                        for (item in itemsInCart) {
                            var clone = cartItem.cloneNode(true);

                            var cartImage = clone.querySelector('img');
                            var cartItemName = clone.querySelector('.cart-item-name');
                            var cartItemPrice = clone.querySelector('.cart-item-price');

                            cartImage.src = itemsInCart[item].product_image;
                            cartItemName.textContent = itemsInCart[item].product_name;
                            cartItemPrice.textContent = "$"+parseFloat(itemsInCart[item].price).toLocaleString(undefined, { minimumFractionDigits: 2 });

                            items.push(clone);
                        };
                        $('#cartItems').html(items);
                    }
                    
                }

                function getCartInfo()
                {
                    $.ajax({
                        url: "{{route('get.cart.info')}}",
                        type: 'GET',
                        success: function(data)
                        {
                            var cartItemCount = data.cartItemCount;
                            var itemsInCart = data.cartItems;
                            var totalPrice = data.totalPrice;
                            updateCartItemCount(cartItemCount);
                            updateCartItemsInDropdown(cartItemCount, itemsInCart, totalPrice);
                        }
                    });
                }

                getCartInfo();

                $(document).on('click', '.addToCartBtn', function(e)
                {
                    var productId = $(this).attr('data-bs-id');
                    console.log(productId);
                    if(productId)
                    {
                        $.ajax({
                            url: "{{route('add.to.cart')}}",
                            type: 'POST',
                            dataType: 'json',
                            data: {'_token': '{{csrf_token()}}', 'id': productId},
                            success: function(data)
                            {
                                getCartInfo();
                                console.log(data);
                            }
                        });
                    }
                });
            });
        </script>
        @stack('scripts')
    </body>
</html>
