@extends('layouts.admin')

@push('scripts')

<script>
    $(document).ready(function() {

        const codeInput = $("#code");
        const valueInput = $('#value');
        const valueInputIcon = $("#value-icon");

        function generateRandomCode(length) {
            
            let code = '';
            const possibleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let charIndex = 0;

            for (let i = 0; i < length; i++) {
                charIndex = Math.floor(Math.random() * possibleChars.length);
                code += possibleChars[charIndex];
            }

            return code;

        }

        $("#generateCodeBtn").on("click", function() {
            codeInput.val(generateRandomCode(5));
        });

        $('#typeSelect').change(function() {
            if ($(this).val() == 'numeric') {
                valueInputIcon.removeClass('fa-percent');
                valueInputIcon.addClass('fa-dollar');

                valueInput.prop('min', .01);
                valueInput.prop('max', 99999999.99);
                valueInput.prop('step', .01);

            } else if ($(this).val() == 'percentage') {
                valueInputIcon.removeClass('fa-dollar');
                valueInputIcon.addClass('fa-percent');

                valueInput.prop('min', 1);
                valueInput.prop('max', 100);
                valueInput.prop('step', 1);

                if(isNaN(valueInput.val()) || valueInput.val().trim() === "") {
                    return;
                }

                let value = parseFloat(valueInput.val());

                let snappedValue = Math.round(value / 1);

                if (snappedValue < 1) {
                    snappedValue = 1;
                } else if (snappedValue > 100) {
                    snappedValue = 100;
                }

                valueInput.val(snappedValue);
            }
        });

    });
</script>

@endpush

@section('content')
<form method="POST" action="{{route('coupon.create')}}">
    @csrf
    <div class="my-3">
        <a class="text-decoration-none" href="{{route('coupons')}}"><i class="fa fa-chevron-left"></i> {{__('Coupons')}}</a>
        <div class="d-flex align-items-center">
            <h2 class="mt-4">{{__('Add coupon')}}</h2>
            <button class="btn btn-primary rounded-pill ms-auto" type="submit"><i class="fa fa-plus"></i> {{__('Add coupon')}}</button>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-md-9 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <x-forms.input id="code" name="code" icon="rectangle-list" label="{{ __('Code') }}" placeholder="{{ __('Code') }}" />
                        <div>
                            <button id="generateCodeBtn" class="btn btn-primary rounded-pill" type="button">
                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                                {{ __('Generate code') }}
                            </button>
                        </div>
                        <div>
                            <label class="form-label ms-2" for="typeSelect">{{__('Type')}}</label>
                            <select id="typeSelect" name="type" class="form-select form-select-lg rounded-pill mb-2">
                                <option selected value="numeric">{{ __('Numeric') }}</option>
                                <option value="percentage">{{ __('Percentage') }}</option>
                            </select>
                        </div>
                        <x-forms.input type="number" id="value" name="value" icon="dollar" label="{{ __('Value') }}" placeholder="{{ __('Value') }}" min=".01" max="99999999.99" step=".01" />
                        <x-forms.input type="number" id="minimum_cart_amount" name="minimum_cart_amount" icon="dollar" label="{{ __('Minimum cart amount') }}" placeholder="{{ __('Minimum cart amount') }}" value="0" min="0" max="99999999.99" step=".01" />
                        <x-forms.input type="date" id="expires_at" name="expires_at" label="{{ __('Expires at') }}" placeholder="{{ __('Expires at') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection