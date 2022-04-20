@extends('layouts.admin')

@push('scripts')
<script>
    $(document).ready(function() 
    {
        dataTable = $('#dataTable').DataTable({
            serverSide: true,
            ajax: '{{ route('categories') }}',
            dom: 'tp',
            lengthChange: false,
            ordering: true,
            stripeClasses: [],
            columnDefs: [{
                targets: 2,
                render: $.fn.dataTable.render.moment('','L LTS', '{{ str_replace('_', '-', app()->getLocale()) }}')
            }],
            columns: [
                {data: 'checkbox', orderable: false, searchable: false},
                {data: 'category_name', orderable: true, searchable: true},
                {data: 'created_at', orderable: true, searchable: false},
                {data: 'action', orderable: false, searchable: false}
            ],
            order: [[1, 'asc']],
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
                        url: '{{route('category.delete')}}',
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
                '{{__('Do you really want to delete this category?')}}',
                '{{__('Category deleted successfully!')}}'
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
                    '{{__('Do you really want to delete the selected categories?')}}',
                    '{{__('Selected categories deleted successfully!')}}'
                );
            }
            
        });
    });
</script>
@endpush

@section('content')
<div class="d-flex align-items-center">
    <h2>{{__('Categories')}}</h2>
    <a class="btn btn-primary rounded-pill ms-auto" href="{{route('category.create')}}"><i class="fa fa-plus"></i> {{__('New category')}}</a>
</div>
<div class="table-responsive of-y-hidden p-1 mt-3">
    <table id="dataTable" class="table align-middle">
        <x-forms.input id="dataTableSearch" name="dataTableSearch" icon="search" placeholder="{{__('Search')}}" />
        <thead>
            <tr class="align-middle">
                <th class="w-1 text-center" scope="col">
                    <input id="checkAll" class="form-check-input" type="checkbox">
                </th>
                <th scope="col">{{__('Name')}}</th>
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