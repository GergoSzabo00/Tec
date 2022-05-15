@extends('layouts.main')

@section('content')
<div class="mt-5 text-center">
    <h3 class="text-uppercase">{{__('Contact us')}}</h3>
    <p>{{__('If you have any problem or question, feel free to reach us on any of the given options below.')}}</p>
</div>
<div class="mt-2">
    <iframe
        width="100%"
        height="450"
        style="border:0"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCrxvaOIt6fOCFA347oVGXpMaiQ8fIEjwI
            &q={{urlencode($storeInfo->address)}}">
    </iframe>
</div>
<div class="row g-3 mt-2">
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <span class="fa-stack fa-2x">
                    <i class="fa-regular fa-circle fa-stack-2x"></i>
                    <i class="fa fa-phone fa-stack-1x"></i>
                  </span>
                <h5 class="text-uppercase card-text mt-3">{{__('Phone')}}</h5>
                <p>{{$storeInfo->phone}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <span class="fa-stack fa-2x">
                    <i class="fa-regular fa-circle fa-stack-2x"></i>
                    <i class="fa fa-location-dot fa-stack-1x"></i>
                  </span>
                <h5 class="text-uppercase card-text mt-3">{{__('Address')}}</h5>
                <p>{{$storeInfo->address}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <span class="fa-stack fa-2x">
                    <i class="fa-regular fa-circle fa-stack-2x"></i>
                    <i class="fa fa-envelope fa-stack-1x"></i>
                  </span>
                <h5 class="text-uppercase card-text mt-3">{{__('Email')}}</h5>
                <p>{{config('mail.from.address')}}</p>
            </div>
        </div>
    </div>
</div>
@endsection