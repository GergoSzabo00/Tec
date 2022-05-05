@extends('layouts.admin')

@section('content')
<form method="POST" action="{{route('order.edit', $order)}}">
    @csrf
    <div class="my-3">
        <a class="text-decoration-none" href="{{route('orders')}}"><i class="fa fa-chevron-left"></i> {{__('Orders')}}</a>
        <div class="d-flex align-items-center">
            <h2 class="mt-4">{{ __('Edit order') }}</h2>
            <button class="btn btn-primary rounded-pill ms-auto" type="submit"><i class="fa fa-pen-to-square"></i> {{__('Update')}}</button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row mt-4">
                <div class="col-12">
                    <label class="ms-3" for="order_status">{{__('Status')}}</label>
                    <div class="form-group">
                        <select id="order_status" name="order_status" class="selectpicker mb-3" data-width="100%" title="{{__('Choose a status')}}">
                            @foreach ($statuses as $status)
                                <option {{ $order->order_status == $status->id  ? 'selected' : '' }} value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection