@extends('layouts.main')

@section('content')
<a class="text-decoration-none" href="{{route('cart')}}">
    <i class="fa fa-chevron-left"></i>
    {{__('Back to cart')}}
</a>
<form method="POST" action="{{route('checkout')}}">
    @csrf
    <div class="row g-3 mt-2">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{__('Contact info')}}</h5>
                    <div class="row g-3 mt-2">
                        <x-forms.input id="firstname" name="firstname" type="text" class="col-lg-6" icon="user" placeholder="{{ __('First name') }}" />
                        <x-forms.input id="lastname" name="lastname" type="text" class="col-lg-6" icon="user" placeholder="{{ __('Last name') }}" />
                        <x-forms.input id="email" name="email" type="email" icon="envelope" placeholder="{{ __('Email') }}" />
                        <x-forms.input id="phone" name="phone" type="text" class="col-lg-6" icon="phone" placeholder="{{ __('Phone') }}" />
                    </div>
                    <h5 class="card-title mt-4 fw-bold">{{__('Shipping address')}}</h5>
                    <div class="row mt-4">
                        <select id="country" name="country" class="{{$errors->has('country') ? 'is-invalid ' : ''}}selectpicker" title="{{ __('Country') }}" data-live-search="true" data-size="5" data-virtual-scroll="true">
                            @foreach ($countries as $country)
                                <option {{ old('country') == $country->id ? 'selected' : '' }} data-content="<span class='fi fi-{{ strtolower($country->code) }}'></span> {{$country->name}}" value="{{$country->id}}"></option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                        <div class="text-start invalid-feedback">
                            {{ $errors->first('country') }}
                        </div>
                        @endif
                    </div>
                    <div class="row g-3 mt-1">
                        <x-forms.input id="city" name="city" type="text" class="col-lg-4" icon="building" placeholder="{{ __('City') }}" />
                        <x-forms.input id="state" name="state" type="text" class="col-lg-4" icon="building" placeholder="{{ __('State') }}" />
                        <x-forms.input id="zip_code" name="zip_code" type="text" class="col-lg-4" icon="at" placeholder="{{ __('Zip code') }}" />
                        <x-forms.input id="address" name="address" type="text" icon="location-dot" placeholder="{{ __('Address') }}" />
                    </div>
                    <h5 class="card-title mt-4 fw-bold">{{__('Payment method')}}</h5>
                    <div class="row">
                        @foreach($paymentOptions as $paymentOption)
                        <div class="col-md-4 col-lg-4">
                            <div class="card form-check my-2">
                                <label class="card-body">
                                    <input class="form-check-input {{$errors->has('payment_option') ? 'is-invalid ' : ''}}" type="radio" name="payment_option" value="{{$paymentOption->id}}">
                                    <span class="card-title">{{$paymentOption->name}}</span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                        @if($errors->has('payment_option'))
                        <div class="d-block invalid-feedback">
                            {{$errors->first('payment_option')}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{__('Order summary')}}</h5>
                    <p class="card-text">{{__('Subtotal')}}<span class="subtotal text-primary float-end"></span></p>
                    <p class="card-text">{{__('Shipping cost')}}<span class="shippingCost text-primary float-end"></span></p>
                    <hr>
                    <p class="card-text fs-4">{{__('Total')}}<span class="totalPrice text-primary float-end"></span></p>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary checkoutBtn">{{__('Checkout')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection