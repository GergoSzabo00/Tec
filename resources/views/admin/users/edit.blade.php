@extends('layouts.admin')

@section('content')
<form method="POST" action="{{route('user.edit', $user)}}">
    @csrf
    <div class="my-3">
        <a class="text-decoration-none" href="{{route('users')}}"><i class="fa fa-chevron-left"></i> {{__('Users')}}</a>
        <div class="d-flex align-items-center">
            <h2 class="mt-4">{{ __('Edit user') }}</h2>
            <button class="btn btn-primary rounded-pill ms-auto" type="submit"><i class="fa fa-pen-to-square"></i> {{__('Update')}}</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <x-forms.input id="email" name="email" type="email" icon="envelope" label="{{ __('Email') }}" placeholder="{{ __('Email') }}" value="{{$user->email}}" />
                        <div class="p-3">
                            <div class="form-check form-switch">
                                <input type="hidden" value="0" name="is_verified"/>
                                <input class="form-check-input" type="checkbox" id="is_verified" name="is_verified" value="1" {{$user->is_verified ? 'checked' : ''}}>
                                <label class="form-check-label" for="isVerifiedSwitch">{{__('Verified')}}</label>
                            </div>
                            <div class="form-check form-switch mt-2">
                                <input type="hidden" value="0" name="is_admin"/>
                                <input class="form-check-input" type="checkbox" id="isAdminSwitch" name="is_admin" value="1" {{$user->is_admin ? 'checked' : ''}}>
                                <label class="form-check-label" for="isAdminSwitch">{{__('Admin')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection