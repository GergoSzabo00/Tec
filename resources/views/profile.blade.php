@extends('layouts.main')

@section('content')
<div class="my-3">
    <h2>{{__('My profile')}}</h2>
</div>
<nav class="ms-1">
    <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
      <button class="nav-link{{ session()->get('tab') == 'personal-info' ? ' active' : '' }}" id="nav-personal-info-tab" data-bs-toggle="tab" data-bs-target="#nav-personal-info" type="button" role="tab" aria-controls="nav-personal-info" aria-selected="true">{{__('Personal info')}}</button>
      <button class="nav-link{{ session()->get('tab') == 'security' ? ' active' : '' }}" id="nav-security-tab" data-bs-toggle="tab" data-bs-target="#nav-security" type="button" role="tab" aria-controls="nav-security" aria-selected="false">{{__('Security')}}</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade{{ session()->get('tab') == 'personal-info' ? ' show active' : '' }}" id="nav-personal-info" role="tabpanel" aria-labelledby="nav-personal-info-tab">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5>{{__('Personal information')}}</h5>
                    <form method="POST" action="{{route('update.personal.info')}}">
                        @csrf
                        <div class="row g-3">
                            <x-forms.input id="firstname" name="firstname" type="text" class="col-lg-6" icon="user" label="{{__('First name')}}" placeholder="{{ __('First name') }}" value="{{$customerInfo->firstname}}" />
                            <x-forms.input id="lastname" name="lastname" type="text" class="col-lg-6" icon="user" label="{{__('Last name')}}" placeholder="{{ __('Last name') }}" value="{{$customerInfo->lastname}}" />
                            <x-forms.input id="email" name="email" type="email" icon="envelope" label="{{__('Email')}}" placeholder="{{ __('Email') }}" value="{{$user->email}}" />
                            <x-forms.input id="phone" name="phone" type="text" class="col-lg-6" icon="phone" label="{{__('Phone')}}" placeholder="{{ __('Phone') }}" value="{{$customerInfo->phone}}" />
                        </div>
                        <button class="btn btn-primary rounded-pill mt-3" type="submit">{{__('Update profile')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade{{ session()->get('tab') == 'security' ? ' show active' : '' }}"" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5>{{__('Change password')}}</h5>
                    <form method="POST" action="{{route('change.password')}}">
                        @csrf
                        <div class="row g-3">
                            <x-forms.input id="password" name="password" type="password" class="col-lg-6" icon="lock" label="{{__('New password')}}" placeholder="{{ __('New password') }}" />
                            <x-forms.input id="password_confirmation" name="password_confirmation" type="password" class="col-lg-6" icon="lock" label="{{__('Confirm new password')}}" placeholder="{{ __('Confirm new password') }}" />
                        </div>
                        <button class="btn btn-primary rounded-pill mt-3" type="submit">{{__('Change password')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection