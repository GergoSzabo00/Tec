@extends('layouts.admin')

@section('content')
<form method="POST" action="{{route('manufacturer.edit', $manufacturer)}}">
    @csrf
    <div class="my-3">
        <a class="text-decoration-none" href="{{route('manufacturers')}}"><i class="fa fa-chevron-left"></i> {{__('Manufacturers')}}</a>
        <div class="d-flex align-items-center">
            <h2 class="mt-4">{{ __('Edit manufacturer') }}</h2>
            <button class="btn btn-primary rounded-pill ms-auto" type="submit"><i class="fa fa-pen-to-square"></i> {{__('Update')}}</button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <x-forms.input id="manufacturer_name" name="name" icon="rectangle-list" label="{{ __('Manufacturer name') }}" placeholder="{{ __('Manufacturer name') }}" value="{{$manufacturer->name}}" />
        </div>
    </div>
</form>
@endsection