@extends('layouts.main')

@section('content')
<div class="mt-5 text-center">
    <h3 class="text-uppercase">{{__('Our services')}}</h3>
</div>
<div class="row g-3 mt-3">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div>
                    <span class="fa-stack fa-2x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-screwdriver-wrench fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="card-title mt-3">{{__('Servicing')}}</h4>
                </div>
                <div class="mt-auto">
                    <p class="card-text">
                        {{__('Our shop offers servicing of computers, laptops, phones and gaming consoles, televisions pc parts, and other electronic devices.')}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div>
                    <span class="fa-stack fa-2x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-handshake fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="card-title mt-3">{{__('Technical support')}}</h4>
                </div>
                <div class="mt-auto">
                    <p class="card-text">
                        {{__("Don't know which product would be ideal for you? Our shop can help you choose the best option. We can even calibrate screens and apply protectors the your phone.")}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div>
                    <span class="fa-stack fa-2x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-coins fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="card-title mt-3">{{__('Money-back guarantee')}}</h4>
                </div>
                <div class="mt-auto">
                    <p class="card-text">
                        {{__("It can happen that the chosen product will fail, it doesn't satisfy your expectations. If the warranty is not expired yet, we can pay your money back.")}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection