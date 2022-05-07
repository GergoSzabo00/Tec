@extends('layouts.main')

@section('content')
<div class="row d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        @if (Session::has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-fw fa-circle-check"></i>
                <span>{{Session::get('status')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-fw fa-circle-exclamation"></i>
                <span>{{$error}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
        @endif
        <div class="card border-0 shadow">
            <div class="card-body p-5 text-center">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input id="email" type="hidden" name="email" value="{{old('email', $request->email)}}"/>
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="mb-4">
                        <img src="{{url('images/logo.svg')}}" width="120" height="120">
                        <h3>{{ __('Reset password') }}</h3>
                    </div>
                    <p>{{__('Type in your new password and click on the button below.')}}</p>
                    <div class="row g-3">
                        <x-forms.input id="password" name="password" type="password" icon="lock" placeholder="{{ __('Password') }}" />
                        <x-forms.input id="password_confirmation" name="password_confirmation" type="password" icon="lock" placeholder="{{ __('Confirm password') }}" />
                    </div>
                    <div class="d-grid my-3">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill">{{ __('Reset password') }}</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection