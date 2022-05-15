@extends('layouts.admin')

@section('content')
<form method="POST" action="{{route('storesettings.edit')}}">
    @csrf
    <div class="my-3">
        <div class="d-flex align-items-center">
            <h2 class="mt-4">{{ __('Store settings') }}</h2>
            <button class="btn btn-primary rounded-pill ms-auto" type="submit"><i class="fa fa-pen-to-square"></i> {{__('Update')}}</button>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <h5>{{__('Contact info')}}</h5>
                        <x-forms.input id="address" name="address" icon="location-dot" label="{{ __('Address') }}" placeholder="{{ __('Address') }}" value="{{$storeInfo->address}}" />
                        <x-forms.input id="phone" name="phone" icon="phone" label="{{ __('Phone') }}" placeholder="{{ __('Phone') }}" value="{{$storeInfo->phone}}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <h5>{{__('Payment information')}}</h5>
                        <x-forms.input id="shipping_cost" name="shipping_cost" type="number" icon="dollar" label="{{ __('Shipping cost') }}" placeholder="{{ __('Shipping cost') }}" value="{{$storeInfo->shipping_cost}}" min="0" max="99.99" step=".01" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection