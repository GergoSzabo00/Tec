@extends('layouts.main')

@section('content')
<form method="POST" action="{{route('address.edit', $address)}}">
    @csrf
    <div class="my-3">
        <a class="text-decoration-none" href="{{route('addresses')}}">
            <i class="fa fa-fw fa-chevron-left"></i>
            {{__('Addresses')}}
        </a>
        <div class="d-flex align-items-center">
            <h2 class="mt-4">{{__('Edit address')}}</h2>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-lg-12"> 
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <select id="country" name="country" class="{{$errors->has('country') ? 'is-invalid ' : ''}}selectpicker" title="{{ __('Country') }}" data-live-search="true" data-size="5" data-virtual-scroll="true">
                            @foreach ($countries as $country)
                                <option {{ $address->country == $country->name  ? 'selected' : '' }} data-content="<span class='fi fi-{{ strtolower($country->code) }}'></span> {{$country->name}}" value="{{$country->id}}"></option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                        <div class="text-start invalid-feedback">
                            {{ $errors->first('country') }}
                        </div>
                        @endif
                    </div>
                    <div class="row g-3 mt-1">
                        <x-forms.input id="city" name="city" type="text" class="col-lg-4" icon="building" label="{{__('City')}}" placeholder="{{ __('City') }}" value="{{$address->city}}" />
                        <x-forms.input id="state" name="state" type="text" class="col-lg-4" icon="building" label="{{__('State')}}" placeholder="{{ __('State') }}" value="{{$address->state}}" />
                        <x-forms.input id="zip_code" name="zip_code" type="text" class="col-lg-4" icon="at" label="{{__('Zip code')}}" placeholder="{{ __('Zip code') }}" value="{{$address->zip_code}}" />
                        <x-forms.input id="address" name="address" type="text" class="col-lg-6" icon="location-dot" label="{{__('Address')}}" placeholder="{{ __('Address') }}" value="{{$address->address}}" />
                    </div>
                    <button class="btn btn-primary mt-4 float-end" type="submit">
                        <i class="fa fa-fw fa-pen-to-square"></i>
                        {{__('Update')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection