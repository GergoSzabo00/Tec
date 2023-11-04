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
                        <x-forms.input id="firstname" name="firstname" type="text" class="col-lg-6" icon="user" label="{{__('First name') }}" placeholder="{{ __('First name') }}" value="{{$customerInfo->firstname ?? ''}}" />
                        <x-forms.input id="lastname" name="lastname" type="text" class="col-lg-6" icon="user" label="{{__('Last name') }}" placeholder="{{ __('Last name') }}" value="{{$customerInfo->lastname ?? ''}}" />
                        <x-forms.input id="email" name="email" type="email" icon="envelope" label="{{__('Email') }}" placeholder="{{ __('Email') }}" value="{{Auth::user()->email ?? ''}}" />
                        <x-forms.input id="phone" name="phone" type="text" class="col-lg-6" icon="phone" label="{{__('Phone') }}" placeholder="{{ __('Phone') }}" value="{{$customerInfo->phone ?? ''}}" />
                    </div>
                    <h5 class="card-title mt-4 fw-bold">{{__('Shipping address')}}</h5>
                    @if ($customerAddresses != null)
                    <div class="row g-3">    
                        @foreach ($customerAddresses as $customerAddress)
                        <div class="col-lg-4">   
                            <div class="card h-100 form-check">
                                <label class="d-flex card-body">
                                    <input class="form-check-input flex-shrink-0{{$errors->has('addresses') ? ' is-invalid' : ''}}" {{old('addresses') == $customerAddress->id ? 'checked' : ''}} data-bs-toggle="collapse" data-bs-target="#newAddressCollapse.show" aria-expanded="false" aria-controls="newAddressCollapse" type="radio" name="addresses" value="{{$customerAddress->id}}">
                                    <span class="mx-2 text-break">{{$customerAddress->country.' '.$customerAddress->state.' '.$customerAddress->zip_code.' '.$customerAddress->city.' '.$customerAddress->address}}</span>
                                    <a class="ms-auto text-decoration-none text-nowrap" href="{{route('address.edit', $customerAddress)}}">
                                        <i class="fa fa-fw fa-pen-to-square"></i>
                                        {{__('Edit')}}
                                    </a>
                                </label>
                            </div>
                        </div> 
                        @endforeach
                        <div class="col-lg-12">
                            <div class="card h-100 form-check">
                                <label class="card-body">
                                    <input class="form-check-input{{$errors->has('addresses') ? ' is-invalid' : ''}}" {{old('addresses') == 'newAddress' ? 'checked' : ''}} data-bs-toggle="collapse" data-bs-target="#newAddressCollapse:not(.show)" aria-expanded="false" aria-controls="newAddressCollapse" type="radio" name="addresses" value="newAddress">
                                    <span>{{__('Set new address')}}</span>
                                    <div class="collapse p-1 mt-4{{old('addresses') == 'newAddress' ? ' show' : ''}}" id="newAddressCollapse">
                                        <div class="row">
                                            <select id="country" name="newAddressCountry" class="{{$errors->has('newAddressCountry') ? 'is-invalid ' : ''}}selectpicker" title="{{ __('Country') }}" data-live-search="true" data-size="5" data-virtual-scroll="true">
                                                @foreach ($countries as $country)
                                                    <option {{ old('newAddressCountry') == $country->id ? 'selected' : '' }} data-content="<span class='fi fi-{{ strtolower($country->code) }}'></span> {{$country->name}}" value="{{$country->id}}"></option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('newAddressCountry'))
                                            <div class="text-start invalid-feedback">
                                                {{ $errors->first('newAddressCountry') }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="row g-3 mt-1">
                                            <x-forms.input id="newAddressCity" name="newAddressCity" type="text" class="col-lg-4" icon="building" label="{{__('City')}}" placeholder="{{ __('City') }}" />
                                            <x-forms.input id="newAddressState" name="newAddressState" type="text" class="col-lg-4" icon="building" label="{{__('State')}}" placeholder="{{ __('State') }}" />
                                            <x-forms.input id="newAddressZip_code" name="newAddressZip_code" type="text" class="col-lg-4" icon="at" label="{{_('Zip code')}}" placeholder="{{ __('Zip code') }}" />
                                            <x-forms.input id="newAddressAddress" name="newAddressAddress" type="text" icon="location-dot" label="{{__('Address')}}" placeholder="{{ __('Address') }}" />
                                            <div class="ms-2">
                                                <input type="hidden" name="save_address" value="0">
                                                <x-forms.checkbox id="save_address" name="save_address" value="1" label="{{__('Save address')}}" errorMessage="{{$errors->has('save_address') ? $errors->first('save_address') : ''}}" />
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('addresses'))
                            <div class="d-block invalid-feedback">
                                {{$errors->first('addresses')}}
                            </div>
                        @endif
                    </div>
                    @else
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
                        <x-forms.input id="city" name="city" type="text" class="col-lg-4" icon="building" label="{{__('City')}}" placeholder="{{ __('City') }}" />
                        <x-forms.input id="state" name="state" type="text" class="col-lg-4" icon="building" label="{{__('State')}}" placeholder="{{ __('State') }}" />
                        <x-forms.input id="zip_code" name="zip_code" type="text" class="col-lg-4" icon="at" label="{{_('Zip code')}}" placeholder="{{ __('Zip code') }}" />
                        <x-forms.input id="address" name="address" type="text" icon="location-dot" label="{{__('Address')}}" placeholder="{{ __('Address') }}" />
                    </div>
                    @endif
                    <h5 class="card-title mt-4 fw-bold">{{__('Payment method')}}</h5>
                    <div class="row g-3">
                        @foreach($paymentOptions as $paymentOption)
                        <div class="col-md-4 col-lg-4">
                            <div class="card form-check">
                                <label class="card-body">
                                    <input class="form-check-input{{$errors->has('payment_option') ? ' is-invalid ' : ''}}" type="radio" name="payment_option" value="{{$paymentOption->id}}" {{ $paymentOption->id == 1 ? 'data-bs-toggle=collapse data-bs-target=#creditCardCollapse:not(.show) aria-expanded=false' : '' }}>
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
                    <div class="collapse p-1 mt-4{{old('payment_option') == '1' ? ' show' : ''}}" id="creditCardCollapse">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <x-forms.input id="cardNumber" name="cardNumber" type="text" icon="credit-card" placeholder="{{ __('Card number') }}" />
                                    <x-forms.input id="cardHolderName" name="cardHolderName" type="text" icon="user" placeholder="{{ __('Card holder name') }}" />
                                    <x-forms.input id="cardExpiryDate" name="cardExpiryDate" type="text" class="col-lg-6" icon="calendar" placeholder="{{ __('MM/YY') }}" />
                                    <x-forms.input id="cardCode" name="cardCode" type="text" class="col-lg-6" icon="lock" placeholder="{{ __('CVC/CVV code') }}" />
                                </div>
                            </div>
                        </div>
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
                    <div class="couponDiscountHolder d-none">
                        <hr>
                        <p class="card-text">{{__('Coupon discount')}}<span class="couponDiscount text-danger float-end"></span></p>
                        <div class="d-flex align-items-center">
                            <span class="text-muted appliedCouponCode"></span>
                        </div>
                    </div>
                    <hr>
                    <p class="card-text fs-4">{{__('Total')}}<span class="totalPrice text-primary float-end"></span></p>
                    <x-forms.checkbox id="terms" name="terms" label="{{ __('Agree terms and conditions') }}" errorMessage="{{ __('You must agree the terms and conditions.') }}" value="1" />
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary checkoutBtn mt-2">{{__('Checkout')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection