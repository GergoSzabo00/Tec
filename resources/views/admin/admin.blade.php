@extends('layouts.admin')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js" integrity="sha256-ErZ09KkZnzjpqcane4SCyyHsKAXMvID9/xwbl/Aq1pc=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function()
    {

        var salesData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        const labels = [
        '{{__('Jan')}}',
        '{{__('Feb')}}',
        '{{__('Mar')}}',
        '{{__('Apr')}}',
        '{{__('May')}}',
        '{{__('Jun')}}',
        '{{__('Jul')}}',
        '{{__('Aug')}}',
        '{{__('Sept')}}',
        '{{__('Oct')}}',
        '{{__('Nov')}}',
        '{{__('Dec')}}'
        ];

        const data = {
        labels: labels,
        datasets: [{
            label: 'Sales',
            backgroundColor: '#198754',
            borderWidth: 0,
            borderSkipped: false,
            borderRadius: Number.MAX_VALUE,
            data: salesData,
        }]
        };
    
        const config = {
            type: 'bar',
            data: data,
            options: 
            {
                plugins: 
                {
                    legend: false,
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.formattedValue;
                                return "$" + label;
                            }
                        }
                    }
                },
                scales: 
                {
                    x: 
                    {
                        grid: {
                            drawBorder: false,
                            drawTicks: false,
                            drawOnChartArea: false
                        }
                    },
                    y: {
                        ticks: {
                            callback: function(value, index, ticks) {
                            return '$' + Chart.Ticks.formatters.numeric.apply(this, [value, index, ticks]);
                        }
                        },
                        grid: {
                            drawBorder: false,
                            drawTicks: false,
                            beginAtZero: true,
                            borderDash: [5, 5]
                        }
                    }
                }
            }
        };

        const salesChart = new Chart(document.getElementById('salesChart'), config);

        function getMonthlySalesData()
        {
            $.ajax({
                url: "{{route('get.monthly.sales')}}",
                type: 'GET',
                success: function(data)
                {
                    salesChart.data.datasets[0].data = data
                    salesChart.update();
                }
            });
        }

        getMonthlySalesData();
    });

  </script>
@endpush

@section('content')
<h2>{{__('Analytics')}}</h2>
<div class="row g-3 mt-2">
    <div class="col-lg-4">
        <div class="card bg-success bg-gradient">
            <div class="card-body">
                <div class="row text-white">
                    <div class="col-3 card-icon-holder">
                        <div class="card-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                    </div>
                    <div class="col-9 card-detail">
                        <h4 class="card-title">{{$total_revenue}}</h4>
                        <p class="card-text">{{__('Total Revenue')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card bg-primary bg-gradient">
            <div class="card-body">
                <div class="row text-white">
                    <div class="col-3 card-icon-holder">
                        <div class="card-icon">
                            <i class="fa fa-basket-shopping"></i>
                        </div>
                    </div>
                    <div class="col-9 card-detail">
                        <h4 class="card-title">{{$total_orders}}</h4>
                        <p class="card-text">{{__('Total Orders')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card bg-success bg-dark">
            <div class="card-body">
                <div class="row text-white">
                    <div class="col-3 card-icon-holder">
                        <div class="card-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <div class="col-9 card-detail">
                        <h4 class="card-title">{{$registered_users}}</h4>
                        <p class="card-text">{{__('Registered Users')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-3 mt-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4>{{__('Sales Overview')}}</h4>
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body">
                <h4>{{__('Recent Orders')}}</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{__('Order number')}}</th>
                            <th scope="col">{{__('Total price')}}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($recent_orders as $order)
                    <tr>
                        <td>#{{$order->id}}</td>
                        <td>${{number_format($order->total_price)}}</td>
                        <td>
                            <a href="{{route('order.details', $order->id)}}" class="btn action-btn btn-primary" data-bs-tooltip="tooltip" data-bs-placement="top" data-bs-title="{{__('View details')}}">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">{{__('No orders yet.')}}</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body">
        <h4>{{__('Top Selling Products')}}</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">{{__('Product name')}}</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($top_selling as $product)
            <tr>
                <td>{{$product->product_name}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">{{__('No orders yet.')}}</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection