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
    <body class="bg-light">
        @include('layouts._header')

        <main class="container py-3 min-vh-100">
            @include('layouts._alerts')
            @yield('content')
        </main>

        <template id="cartEmptyDropdownTemplate">
            <div class="cart-item">
                <h5>{{__('Cart is empty')}}</h5>
            </div>
        </template>

        <template id="cartItemDropdownTemplate">
            <div class="cart-item">
                <div class="flex-shrink-0">
                    <img width="50" height="50" class="rounded">
                </div>
                <div class="flex-grow-1 text-start ms-3">
                    <span class="cart-item-name text-break"></span>
                    <div class="d-flex">
                        <span class="cart-item-price text-primary"></span>
                        <span class="cart-item-quantity text-muted ms-1"></span>
                    </div>
                </div>
                <button class="flex-shrink-0 ms-2 btn btn-danger action-btn action-btn-sm remove-item-from-cart-btn">
                    <i class="fa fa-fw fa-x"></i>
                </button>
            </div>
        </template>

        <template id="cartEmptyTableTemplate">
            <tr class="align-middle">
                <td colspan="4" class="text-center">
                    <h5>{{__('Cart is empty')}}</h5>
                </td>
            </tr>
        </template>

        <template id="cartItemTableTemplate">
            <tr class="align-middle">
                <td>
                    <div class="d-flex">
                        <div>
                            <img width="100" height="100" class="rounded"/>
                        </div>
                        <div class="align-self-center text-break ms-3">
                            <h5 class="cart-item-name"></h5>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group quantity-setter">
                        <button class="btn decrement-quantity update-quantity">
                            <i class="fa fa-fw fa-minus"></i>
                        </button>
                        <input class="form-control cart-item-quantity-input" type="number" value="1" min="1" max="10">
                        <button class="btn increment-quantity update-quantity">
                            <i class="fa fa-fw fa-plus"></i>
                        </button>
                    </div>
                </td>
                <td>
                    <span class="cart-item-price"></span>
                </td>
                <td>
                    <button class="btn btn-danger action-btn action-btn-sm remove-item-from-cart-btn"><i class="fa fa-x"></i></button>
                </td>
            </tr>
        </template>

        @include('layouts._footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>

            var cartItemCount = 0;
            var itemsInCart = [];
            var subtotal = 0;
            var shippingCost = 0;
            var totalPrice = 0;
            var couponCode = "";
            var couponDiscount = 0;
            var couponDiscountStr = "";

            $(document).ready(function() 
            {
                function updateCartItemCount()
                {
                    $('#cartItemCountText').text(cartItemCount);
                }

                function updatePrices()
                {
                    $('.subtotal').text(subtotal);
                    $('.shippingCost').text(shippingCost);
                    $('.totalPrice').text(totalPrice);
                    $('.couponDiscount').text(couponDiscountStr);
                }

                function updateBtnStates()
                {
                    if(cartItemCount > 0)
                    {
                        $('.checkoutBtn').removeClass('disabled');
                        $('.removeAllItemsFromCartBtn').removeClass('disabled');
                        $('#applyCouponBtn').removeClass('disabled');
                    }
                    else
                    {
                        $('.checkoutBtn').addClass('disabled');
                        $('.removeAllItemsFromCartBtn').addClass('disabled');
                        $('#applyCouponBtn').addClass('disabled');
                    }
                    
                }

                function updateDiscountVisibility() {
                    if (couponDiscount > 0) {
                        $('.couponDiscountHolder').removeClass('d-none');
                    } else {
                        $('.couponDiscountHolder').addClass('d-none');
                    }
                }

                function generateItemsFromTemplate(template, emptyTemplate, itemHolder)
                {
                    $(itemHolder).html('');
                    if(cartItemCount == 0)
                    {
                        var clone = document.getElementById(emptyTemplate).content.cloneNode(true);
                        $(itemHolder).html(clone);
                    }
                    else
                    {    
                        var items = [];  
                        var cartItem = document.getElementById(template).content;

                        for (item in itemsInCart) 
                        {
                            clone = cartItem.cloneNode(true);

                            var cartImage = clone.querySelector('img');
                            var cartItemName = clone.querySelector('.cart-item-name');
                            var cartItemPrice = clone.querySelector('.cart-item-price');
                            var cartItemQuantityInput = clone.querySelector('.cart-item-quantity-input');
                            var cartItemQuantity = clone.querySelector('.cart-item-quantity');
                            var removeItemFromCartBtn = clone.querySelector('.remove-item-from-cart-btn');

                            if(cartItemQuantityInput != null)
                            {
                                cartItemQuantityInput.setAttribute('data-bs-id', item);
                                cartItemQuantityInput.value = itemsInCart[item].quantity;
                            }

                            if(cartItemQuantity != null)
                            {
                                cartItemQuantity.textContent = itemsInCart[item].quantity + "x";
                            }

                            cartImage.src = itemsInCart[item].product_image;
                            cartItemName.textContent = itemsInCart[item].product_name;
                            cartItemPrice.textContent = "$"+parseFloat(itemsInCart[item].price).toLocaleString(undefined, { minimumFractionDigits: 2 });
                            removeItemFromCartBtn.setAttribute('data-bs-id', item);

                            items.push(clone);
                        };
                        $(itemHolder).html(items);
                    }
                }

                function updateItems()
                {
                    generateItemsFromTemplate('cartItemDropdownTemplate', 'cartEmptyDropdownTemplate', '#cartItemsDropdown');
                    generateItemsFromTemplate('cartItemTableTemplate', 'cartEmptyTableTemplate', '#cartItemsTableHolder');
                }

                function getCartInfo()
                {
                    $.ajax({
                        url: "{{route('get.cart.info')}}",
                        type: 'GET',
                        success: function(data)
                        {
                            cartItemCount = data.cartItemCount;
                            itemsInCart = data.cartItems;
                            subtotal = "$"+parseFloat(data.subtotal).toLocaleString(undefined, { minimumFractionDigits: 2 });
                            shippingCost = "$"+parseFloat(data.shippingCost).toLocaleString(undefined, { minimumFractionDigits: 2 });
                            totalPrice = "$"+parseFloat(data.totalPrice).toLocaleString(undefined, { minimumFractionDigits: 2 });
                            couponCode = data.couponCode;
                            couponDiscount = data.couponDiscount;
                            couponDiscountStr = "-$"+parseFloat(data.couponDiscount).toLocaleString(undefined, { minimumFractionDigits: 2 });
                            updateCartItemCount();
                            updatePrices();
                            updateItems();
                            updateBtnStates();
                            updateDiscountVisibility();
                        }
                    });
                }

                getCartInfo();

                $(document).on('click', '.increment-quantity', function(e)
                {
                    if($(this).prev().val() < 1000)
                    {
                        $(this).prev().val(+$(this).prev().val() + 1);
                    }
                });

                $(document).on('click', '.decrement-quantity', function(e)
                {
                    if($(this).next().val() > 1)
                    {
                        $(this).next().val(+$(this).next().val() - 1);
                    }
                });

                $(document).on('click', '.update-quantity', function(e)
                {
                    var parent = this.parentNode;
                    var quantityInput = parent.querySelector('.cart-item-quantity-input');
                    var productId = $(quantityInput).attr('data-bs-id');
                    var quantity = $(quantityInput).val();
                    $.ajax({
                        url: "{{route('update.cart.quantity')}}",
                        type: 'POST',
                        dataType: 'json',
                        data: {'_token': '{{csrf_token()}}', 'id': productId, 'quantity': quantity},
                        success: function(data)
                        {
                            getCartInfo();
                        }
                    });
                });

                $(document).on('click', '.addToCartBtn', function(e)
                {
                    var productId = $(this).attr('data-bs-id');
                    if(productId != null)
                    {
                        $.ajax({
                            url: "{{route('add.to.cart')}}",
                            type: 'POST',
                            dataType: 'json',
                            data: {'_token': '{{csrf_token()}}', 'id': productId},
                            success: function(data)
                            {
                                getCartInfo();
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                });

                $(document).on('click', '.remove-item-from-cart-btn', function(e)
                {
                    var productId = $(this).attr('data-bs-id');
                    if(productId != null)
                    {
                        $.ajax({
                            url: "{{route('remove.from.cart')}}",
                            type: 'POST',
                            dataType: 'json',
                            data: {'_token': '{{csrf_token()}}', 'id': productId},
                            success: function(data)
                            {
                                getCartInfo();
                            }
                        });
                    }
                });

                $('#removeAllItemsFromCartBtn').on('click', function(e)
                {
                    if(cartItemCount > 0)
                    {
                        removeAllItemsFromCart();
                    }
                    else
                    {
                        e.preventDefault();
                    }
                });

                
                $('#applyCouponBtn').on('click', function(e) {
                    let couponCodeInput = $('#coupon_code');
                    
                    if (!couponCodeInput) {
                        return;
                    }

                    let couponCode = couponCodeInput.val();

                    $.ajax({
                        url: "{{route('apply.coupon')}}",
                        type: 'POST',
                        dataType: 'json',
                        data: {'_token': '{{csrf_token()}}', 'code': couponCode},
                        success: function(data)
                        {
                            switch(data.status) {
                                case 200:
                                    console.log(data.data);
                                    getCartInfo();
                                    break;
                                case 422:
                                    console.log(data.error);
                                    break;
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            switch(xhr.status) {
                                case 404:
                                    console.log("Coupon code invalid!");
                                    break;
                            }
                        }
                    });

                });


                function removeAllItemsFromCart()
                {
                    $.ajax({
                        url: "{{route('remove.all.from.cart')}}",
                        type: 'POST',
                        data: {'_token': '{{csrf_token()}}'},
                        success: function(data)
                        {
                            getCartInfo();
                        }
                    });
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>
