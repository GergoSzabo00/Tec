@extends('layouts.main')

@section('content')
<div class="mt-4 flex items-center justify-between">
    <h3 class="card-title">{{__('Verify email')}}</h3>
    @if (Session::has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-fw fa-circle-check"></i>
                <span>{{Session::get('status')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <input type="hidden" id="email" name="email" value="{{$email}}">
        <div>
            <button class="btn btn-primary rounded-pill" type="submit">
                {{ __('Resend Verification Email') }}
            </button>
        </div>
    </form>
</div>
@endsection