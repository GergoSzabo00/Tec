@extends('layouts.main')

@section('content')
<div class="my-3">
    <div class="d-flex align-items-center">
        <h2>{{__('My recent orders')}}</h2>
    </div>
</div>
<div class="row g-3">
    @forelse($orders as $order)
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{__('Order')}} #{{$order->id}}</h3>
                <p>{{__('Order date')}}: {{$order->created_at->isoFormat('L')}}</p>
                @foreach($order->order_details as $orderDetail)
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
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{__("You didn't order yet.")}}
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection