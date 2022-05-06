@extends('layouts.main')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js" integrity="sha256-aHuHTU7SdMUuRBFzJX+PRkbfy9kd0uGHS8uc4M/NVBo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function()
    {

        function listAddresses(data)
        {
            $('#addressesHolder').html('');
            if(data.length == 0)
            {
                var clone = document.getElementById('noAddressTemplate').content.cloneNode(true);
                $('#addressesHolder').html(clone);
            }
            else
            {    
                var items = [];  
                var addressItem = document.getElementById('addressTemplate').content;

                for (var item in data) 
                {
                    clone = addressItem.cloneNode(true);

                    var addressText = clone.querySelector('.addressText');
                    var editBtn = clone.querySelector('.editBtn');
                    var deleteBtn = clone.querySelector('.deleteBtn');

                    var addressString = data[item].country + " " + data[item].state + " " + data[item].zip_code +" " + data[item].city + " " + data[item].address;

                    addressText.textContent = addressString;

                    var editUrl = "{{route('address.edit', 'addressID')}}";
                    editUrl = editUrl.replace('addressID', data[item].id);

                    editBtn.setAttribute('href', editUrl);
                    deleteBtn.setAttribute('data-bs-id', data[item].id);

                    items.push(clone);
                };
                $('#addressesHolder').html(items);
            }
        }

        function getAddresses()
        {
            $.ajax({
                url: '{{route('addresses')}}',
                type: 'GET',
                success: function (data) {
                    listAddresses(data);
                } 
            });
        }

        function showDeleteConfirmModal(id, text, successMsg)
        {
            Swal.fire({
                title: '{{__('Are you sure?')}}',
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                cancelButtonText: '{{__('Cancel')}}',
                confirmButtonText: '{{__('Delete')}}',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('address.delete')}}',
                        type: 'POST',
                        dataType:'json',
                        data: {'_token': '{{csrf_token()}}', 'id': id},
                        success: function (data) {
                            Swal.fire({
                                icon: 'success',
                                title: '{{__('Deleted')}}!',
                                text: successMsg,
                                confirmButtonColor: '#007bff'
                            });
                            getAddresses();
                        } 
                    });
                }
            });
        }

        $(document).on('click', '.deleteBtn', function(e)
        {
            var itemId = $(this).attr('data-bs-id');
            showDeleteConfirmModal(
                itemId,
                '{{__('Do you really want to delete this address?')}}',
                '{{__('Address deleted successfully!')}}'
            );
        });
    });
</script>
@endpush

@section('content')
<div class="my-3">
    <div class="d-flex align-items-center">
        <h2>{{__('My addresses')}}</h2>
        <a href="{{route('address.create')}}" class="btn btn-primary ms-auto">{{__('Add new address')}}</a>
    </div>
</div>
<div id="addressesHolder" class="row g-3">    
    @forelse($addresses as $address)
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="d-flex card-body">
                <span class="mx-2 text-break">{{$address->country.' '.$address->state.' '.$address->zip_code.' '.$address->city.' '.$address->address}}</span>
                <a class="ms-auto text-decoration-none text-nowrap align-self-start" href="{{route('address.edit', $address)}}">
                    <i class="fa fa-fw fa-pen-to-square"></i>
                    {{__('Edit')}}
                </a>
                <a class="ms-2 text-decoration-none text-nowrap align-self-start deleteBtn" data-bs-id="{{$address->id}}" href="#" role="button">
                    <i class="fa fa-fw fa-trash"></i>
                    {{__('Delete')}}
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{__("You don't have any saved address.")}}
            </div>
        </div>
    </div>
    @endforelse
</div>
<template id="noAddressTemplate">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{__("You don't have any saved address.")}}
            </div>
        </div>
    </div>
</template>
<template id="addressTemplate">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="d-flex card-body">
                <span class="mx-2 text-break addressText"></span>
                <a class="ms-auto text-decoration-none text-nowrap align-self-start editBtn" href="#">
                    <i class="fa fa-fw fa-pen-to-square"></i>
                    {{__('Edit')}}
                </a>
                <a class="ms-2 text-decoration-none text-nowrap align-self-start deleteBtn" href="#" role="button">
                    <i class="fa fa-fw fa-trash"></i>
                    {{__('Delete')}}
                </a>
            </div>
        </div>
    </div>
</template>
@endsection