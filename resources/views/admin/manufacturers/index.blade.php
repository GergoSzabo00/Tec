@extends('layouts.admin')

@push('scripts')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
@endpush

@section('content')
<div class="d-flex align-items-center">
    <h2>{{__('Manufacturers')}}</h2>
    <a class="btn btn-primary rounded-pill ms-auto" href="{{route('manufacturer.create')}}"><i class="fa fa-plus"></i> {{__('New manufacturer')}}</a>
</div>
<div class="table-responsive mt-3">
    <table class="table align-middle">
        <thead>
            <tr>
                <th class="w-1 text-center" scope="col">
                    <input id="checkAll" class="form-check-input" type="checkbox">
                </th>
                <th scope="col">{{__('Name')}}</th>
                <th class="col-2" scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($manufacturers as $manufacturer)
            <tr class="table-list-item">
                <td>
                    <input class="form-check-input" type="checkbox" value="{{$manufacturer->id}}">
                </td>
                <td>{{$manufacturer->name}}</td>
                <td>
                    <div class="d-flex flex-row justify-content-center">
                        <a href="{{route('manufacturer.edit', $manufacturer)}}" class="btn action-btn btn-secondary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Edit')}}">
                            <i class="fa fa-pen-to-square"></i>
                        </a>
                        <button class="btn action-btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Delete')}}">
                            <i class="fa fa-xmark"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @if(!($loop->last))
                <tr class="table-spacing">
                    <td colspan="2"></td>
                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@if($manufacturers->hasPages())
    <div class="d-flex justify-content-center">
        {{$manufacturers->links()}}
    </div>
@endif
@endsection