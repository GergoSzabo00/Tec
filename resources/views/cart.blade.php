@extends('layouts.main')

@section('content')
<div class="row g-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h5 class="card-title">{{__('Cart')}}</h5>
                    <button id="removeAllItemsFromCartBtn" class="btn btn-sm btn-danger ms-auto removeAllItemsFromCartBtn">
                        <i class="fa fa-fw fa-xmark"></i>
                        {{__('Remove all')}}
                    </button>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>{{__('Product')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Price')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cartItemsTableHolder">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{__('Order summary')}}</h5>
                <p class="card-text">{{__('Subtotal')}}<span class="subtotal text-primary float-end"></span></p>
                <p class="card-text">{{__('Shipping cost')}}<span class="shippingCost text-primary float-end"></span></p>
                <div class="couponDiscountHolder d-none">
                    <hr>
                    <p class="card-text">{{__('Coupon discount')}}<span class="couponDiscount text-danger float-end"></span></p>
                    <div class="d-flex align-items-center">
                        <span class="text-muted appliedCouponCode"></span>
                        <button class="removeCouponBtn btn btn-danger ms-auto" type="button">
                            {{ __('Remove') }}
                        </button>
                    </div>
                </div>
                <hr>
                <p class="card-text fs-4">{{__('Total')}}<span class="totalPrice text-primary float-end"></span></p>
                <div class="d-grid gap-2">
                    <a href="{{route('checkout')}}" class="btn btn-primary checkoutBtn">{{__('Checkout')}}</a>
                    <a href="{{route('home')}}" class="btn btn-secondary">{{__('Continue shopping')}}</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <x-forms.input class="w-100" type="text" id="coupon_code" name="code" placeholder="{{__('Coupon code')}}" />
                    <button id="applyCouponBtn" class="btn btn-primary rounded-pill ms-2">{{ __('Apply') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection