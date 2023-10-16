@extends('layouts.admin')

@section('content')
<div class="my-3">
    <a class="text-decoration-none" href="{{route('orders')}}"><i class="fa fa-chevron-left"></i> {{__('Orders')}}</a>
    <div class="d-flex align-items-center">
        <h2 class="mt-4">{{__('Order details')}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{__('Order')}} #{{$order->id}}</h3>
                <p>{{__('Order date')}}: {{$order->created_at->isoFormat('L')}}</p>
                <dl>
                    <dl><span class="fw-bold">{{__('Customer name')}}:</span> {{ $order->customer_name }}</dl>
                    <dl><span class="fw-bold">{{__('Shipping address')}}:</span> {{ $order->shipping_address }}</dl>
                    <dl><span class="fw-bold">{{__('Order status')}}:</span> <span class="badge bg-secondary rounded-pill">{{ $orderStatusName }}</span></dl>
                    <dl><span class="fw-bold">{{__('Payment method')}}:</span> <span class="badge bg-secondary rounded-pill">{{ $paymentOptionName }}</span></dl>
                </dl>
                <hr>
                <h5>{{ __('Products') }}</h5>
                @foreach($orderDetails as $orderDetail)
                    <div class="d-flex">
                        <span class="text-break"><span class="text-muted">{{$orderDetail->bought_quantity}}x</span> {{$orderDetail->product_name}}</span>
                        <span class="text-primary ms-auto">${{number_format($orderDetail->price, 2, ',', ' ')}}</span>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex mt-2">
                    <span class="fs-4">{{__('Total')}}</span>
                    <span class="fs-4 text-primary ms-auto">${{number_format($order->total_price, 2, ',', ' ')}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection