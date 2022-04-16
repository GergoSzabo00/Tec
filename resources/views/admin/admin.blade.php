@extends('layouts.admin')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js" integrity="sha256-ErZ09KkZnzjpqcane4SCyyHsKAXMvID9/xwbl/Aq1pc=" crossorigin="anonymous"></script>
<script>
    const labels = [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Dec'
    ];
  
    const data = {
      labels: labels,
      datasets: [{
        label: 'Sales',
        backgroundColor: '#198754',
        borderWidth: 0,
        borderSkipped: false,
        borderRadius: Number.MAX_VALUE,
        data: [10],
      }]
    };
  
    const config = {
      type: 'bar',
      data: data,
      options: 
      {
        plugins: 
        {
            legend: false
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

    const salesChart = new Chart(
    document.getElementById('salesChart'),
    config
  );

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
        <div class="card">
            <div class="card-body">
                <h4>{{__('Recent Orders')}}</h4>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body">
        <h4>{{__('Top Selling Products')}}</h4>
    </div>
</div>
@endsection