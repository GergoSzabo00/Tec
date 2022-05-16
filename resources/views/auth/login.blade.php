@extends('layouts.main')

@section('content')
<div class="row d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        @if (request()->get('verified') == 1)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-fw fa-circle-check"></i>
                <span>{{__('verification.verified')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-fw fa-circle-check"></i>
                <span>{{Session::get('status')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card border-0 shadow">
            <div class="card-body p-5 text-center">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <img src="images/logo.svg" width="120" height="120">
                        <h3>{{ __('Login') }}</h3>
                    </div>
                    @if($errors->has('login.invalid'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('login.invalid') }}
                        </div>
                    @endif
                    <div class="row g-3">
                        <x-forms.input id="email" name="email" type="email" icon="envelope" placeholder="{{ __('Email') }}" />
                        <x-forms.input id="password" name="password" type="password" icon="lock" placeholder="{{ __('Password') }}" />
                    </div>
                    <div class="d-grid my-3">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill">{{ __('Login') }}</button>
                    </div>
                    <a href="{{route('password.request')}}" class="text-decoration-none">{{ __('Forgot password') }}</a>
                </form> 
            </div>
        </div>
</div>
@endsection