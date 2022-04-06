@extends('layouts.main')

@section('content')
<div class="row d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
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
                    <x-forms.input id="email" name="email" type="email" icon="envelope" placeholder="{{ __('Email') }}" />
                    <x-forms.input id="password" name="password" type="password" icon="lock" placeholder="{{ __('Password') }}" />
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill">{{ __('Login') }}</button>
                    </div>
                    <a href="#" class="text-decoration-none">{{ _('Forgot password') }}</a>
                </form> 
            </div>
        </div>
</div>
@endsection