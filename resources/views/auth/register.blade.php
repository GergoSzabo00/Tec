@extends('layouts.main')

@section('content')
<div class="row d-flex justify-content-center align-items-center py-5 min-vh-100">
    <div class="col-12 col-md-8 col-lg-8 col-xl-6">
        <div class="card border-0 shadow">
            <div class="card-body p-5 text-center">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <img src="images/logo.svg" width="120" height="120">
                        <h3>{{ __('Register') }}</h3>
                    </div>
                    <div class="row g-3">
                        <x-forms.input id="firstname" name="firstname" type="text" class="col-lg-6" icon="user" placeholder="{{ __('First name') }}" />
                        <x-forms.input id="lastname" name="lastname" type="text" class="col-lg-6" icon="user" placeholder="{{ __('Last name') }}" />
                        <x-forms.input id="email" name="email" type="email" icon="envelope" placeholder="{{ __('Email') }}" />
                        <x-forms.input id="password" name="password" type="password" class="col-lg-6" icon="lock" placeholder="{{ __('Password') }}" />
                        <x-forms.input id="password_confirmation" name="password_confirmation" type="password" class="col-lg-6" icon="lock" placeholder="{{ __('Confirm password') }}" />
                        <div class="row mt-5">
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
                        <x-forms.input id="city" name="city" type="text" class="col-lg-4" icon="building" placeholder="{{ __('City') }}" />
                        <x-forms.input id="state" name="state" type="text" class="col-lg-4" icon="building" placeholder="{{ __('State') }}" />
                        <x-forms.input id="zip_code" name="zip_code" type="text" class="col-lg-4" icon="at" placeholder="{{ __('Zip code') }}" />
                        <x-forms.input id="address" name="address" type="text" icon="location-dot" placeholder="{{ __('Address') }}" />
                        <x-forms.input id="phone" name="phone" type="text" class="col-lg-6" icon="phone" placeholder="{{ __('Phone') }}" />
                    </div>
                    <div class="my-3 text-start">
                        <x-forms.checkbox id="terms" name="terms" label="{{ __('Agree terms and conditions') }}" errorMessage="{{ __('You must agree the terms and conditions.') }}" value="1" />
                    </div>
                    <div class="d-grid my-3">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill">{{ __('Register') }}</button>
                    </div>
                </form> 
            </div>
        </div>
</div>
@endsection