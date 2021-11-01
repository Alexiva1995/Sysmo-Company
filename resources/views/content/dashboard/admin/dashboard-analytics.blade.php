@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset('vendors/css/charts/apexcharts.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset('css/base/plugins/charts/chart-apex.css') }}">
<link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom-dashboard.css') }}">
@endsection

@section('content')
<!-- Dashboard Analytics Start -->
<div id="carouselIndicators" class="carousel slide my-2" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($slider as $key => $slide)
        <li data-target="#carouselIndicators" data-slide-to="{{$key}}" class="@if($key == 0) active @endif"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($slider as $key => $slide)
        <div class="carousel-item @if($key == 0) active @endif">
            <img class="d-block w-100" style="max-height:400px; object-fit: cover; position-attachment" src="{{asset('storage/slider/'.$slide->img)}}" alt="{{$slide->description}}" title="{{$slide->name}}">
        </div>
        @endforeach

    </div>
    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

<section id="dashboard-analytics">
    {{-- Cuadros Informativos zero --}}
    @include('content.dashboard.admin.sections.zero')

    {{-- Cuadros Informativos primeros --}}
    @include('content.dashboard.admin.sections.first')

    {{-- Cuadros Informativos segundos --}}
    @include('content.dashboard.admin.sections.seconds')

    {{-- Cuadros Informativos de grafica y tabla --}}
    @include('content.dashboard.admin.sections.third')

</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset('vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset('js/scripts/pages/dashboard-analytics.js') }}"></script>
<script src="{{ asset('js/scripts/pages/app-invoice-list.js') }}"></script>


<script>
    function copyReferralsLink() {
        let copyText = $('#referrals_link').attr('data-link');
        const textArea = document.createElement('textarea');
        textArea.textContent = copyText;
        document.body.append(textArea);
        textArea.select();
        document.execCommand("copy");
        textArea.remove();
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: 'Se copió el link de referido'
        })
    }

    $(document).ready(function () {
        $url = "{{route('graphic.orders')}}"
        $.get($url, [], function (response) {
            graphipOrdens(response)
        })
    })

    var $primary = '#7367F0',
        $success = '#28C76F',
        $danger = '#EA5455',
        $warning = '#FF9F43',
        $info = '#00cfe8',
        $label_color_light = '#dae1e7';

    var themeColors = [$primary, $success, $danger, $warning, $info];

    $year = new Date().getFullYear()

    function graphipOrdens(data) {
        // Line Chart
        // ----------------------------------
        var lineChartOptions = {
            chart: {
                width: '180%',
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            colors: themeColors,
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            series: [{
                name: "Ordenes",
                data: data,
            }],
            title: {
                text: 'Ordenes por mes - '+$year,
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            yaxis: {
                tickAmount: 5,
            }
        }
        var lineChart = new ApexCharts(
            document.querySelector("#line-chart"),
            lineChartOptions
        );
        lineChart.render();
    }

</script>
@endsection
