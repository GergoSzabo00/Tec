@extends('layouts.admin')

@push('scripts')
<script>
    $(document).ready(function() 
    {
        dataTable = $('#dataTable').DataTable({
            serverSide: true,
            ajax: '{{ route('products') }}',
            dom: 'tp',
            lengthChange: false,
            ordering: true,
            stripeClasses: [],
            columnDefs: [
                {
                    targets: 1,
                    render: function(data, type, row)
                    {
                        return '<img src="'+data+'" width="50" height="50" class="img-fluid rounded" alt="{{__('Product image of')}} '+row.product_name+'" />'
                    }
                },
                {
                    targets: 5,
                    render: function(data, type, row)
                    {
                        var badges = '';
                        for (i=0; i < data.length; i++) 
                        {
                            badges += '<span class="badge rounded-pill bg-secondary mx-1">'+data[i]+'</span>';
                        }
                        return badges;
                    }
                },    
                {
                    targets: 7,
                    render: $.fn.dataTable.render.moment('','L LTS', '{{ str_replace('_', '-', app()->getLocale()) }}')
                }
            ],
            columns: [
                {data: 'checkbox', orderable: false, searchable: false},
                {data: 'product_image', orderable: false, searchable: false},
                {data: 'product_name', orderable: true, searchable: true},
                {data: 'price', orderable: true, searchable: false},
                {data: 'manufacturer', orderable: true, searchable: false},
                {data: 'categories', orderable: true, searchable: false},
                {data: 'quantity_in_stock', orderable: true, searchable: false},
                {data: 'created_at', orderable: true, searchable: false},
                {data: 'action', orderable: false, searchable: false}
            ],
            order: [[7, 'desc']],
            language: {
                emptyTable: '{{__('No items found in database')}}',
                zeroRecords: '{{__('No matching item found')}}',
                paginate: {
                    previous: '{{__('Previous')}}',
                    next: '{{__('Next')}}'
                }
            }
        });

        dataTable.on('page.dt', function() {
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });

        dataTable.on('draw', function(){
            $('[data-bs-tooltip="tooltip"]').tooltip();
        });

        $('#dataTableSearch').keyup(function()
        {
            dataTable.search($(this).val()).draw();
        });

        function showDeleteConfirmModal(ids, text, successMsg)
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
                        url: '{{route('product.delete')}}',
                        type: 'POST',
                        dataType:'json',
                        data: {'_token': '{{csrf_token()}}', 'ids': ids},
                        success: function (data) {
                            Swal.fire({
                                icon: 'success',
                                title: '{{__('Deleted')}}!',
                                text: successMsg,
                                confirmButtonColor: '#007bff'
                            });
                            dataTable.ajax.reload();
                        } 
                    });
                }
            });
        }

        $(document).on('click', '.deleteBtn', function(e)
        {
            var itemId = [];
            itemId.push($(this).attr('data-bs-id'));
            showDeleteConfirmModal(
                itemId,
                '{{__('Do you really want to delete this product?')}}',
                '{{__('Product deleted successfully!')}}'
            );
        });

        $('#deleteSelected').on('click', function()
        {
            var selectedItems = $('input:checkbox[name=ids]:checked');
            if(selectedItems.length > 0)
            {
                var ids = [];
                selectedItems.map(function() {
                    ids.push($(this).val())
                });
                showDeleteConfirmModal(
                    ids,
                    '{{__('Do you really want to delete the selected products?')}}',
                    '{{__('Selected products deleted successfully!')}}'
                );
            }
            
        });
    });
</script>
@endpush

@section('content')
<div class="d-flex align-items-center">
    <h2>{{__('Products')}}</h2>
    <a class="btn btn-primary rounded-pill ms-auto" href="{{route('product.create')}}"><i class="fa fa-plus"></i> {{__('New product')}}</a>
</div>
<div class="table-responsive of-y-hidden p-1 mt-3">
    <table id="dataTable" class="table align-middle">
        <x-forms.input id="dataTableSearch" name="dataTableSearch" icon="search" placeholder="{{__('Search')}}" />
        <thead>
            <tr class="align-middle">
                <th class="w-1 text-center" scope="col">
                    <input id="checkAll" class="form-check-input" type="checkbox">
                </th>
                <th scope="col">{{__('Image')}}</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Price')}}</th>
                <th scope="col">{{__('Manufacturer')}}</th>
                <th scope="col">{{__('Category')}}</th>
                <th scope="col">{{__('Quantity in stock')}}</th>
                <th scope="col">{{__('Creation')}}</th>
                <th class="col-2 text-center" scope="col">
                    <button class="btn btn-danger disabled" id="deleteSelected" disabled aria-disabled="true">{{__('Delete Selected')}}</button>
                </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection