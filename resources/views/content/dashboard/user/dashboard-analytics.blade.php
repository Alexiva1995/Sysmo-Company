
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
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice-list.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom-dashboard.css') }}">
  @endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  <div class="row match-height">
    <!-- Greetings Card starts -->
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card card-light">
        <div class="card-body text-left">
          <div class="row">
            <div class="col-6 d-flex flex-column">

              <h1 class="mb-1 text-dark texto-card-1">Saldo Disponible</h1>
              <h1 class="mb-1 text-primary texto-card-2">$78.20</h1>
              
              <div class="text-left">
                <p class="card-text m-auto w-75">
                  <button class="btn btn-outline-warning text-dark font-bold px-3">Retirar</button>
                </p>
              </div>
            </div>

            <div class="col-6">

              <div class="img-card">
                <svg width="151" height="136" viewBox="0 0 151 136" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M135.9 0H22.65C10.1623 0 0 10.1698 0 22.6667V113.333C0 125.83 10.1623 136 22.65 136H135.9C144.228 136 151 129.223 151 120.889V105.778H90.6C82.2723 105.778 75.5 99.0004 75.5 90.6667V45.3333C75.5 36.9996 82.2723 30.2222 90.6 30.2222H151V15.1111C151 6.77733 144.228 0 135.9 0Z" fill="#0050AF" fill-opacity="0.1"/>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card card-congratulations">
        <div class="card-body text-left">
          <div class="row">
            <div class="col-6 d-flex flex-column">

              <h1 class="mb-1 text-white texto-card-1">Membresía</h1>
              <h1 class="mb-1 text-white texto-card-2">Crypto <br>
                <span style="font-weight: 300; font-size: 13pt;">Academia</span>
              </h1>
              
              
            </div>

            <div class="col-6">

              <div class="img-card">
                <svg width="123" height="85" viewBox="0 0 123 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M119.396 0.413483H98.7385V7.62081C98.7385 13.5818 93.8891 18.4314 87.9279 18.4314H35.0721C29.1109 18.4314 24.2615 13.5818 24.2615 7.62081V0.413483H3.60354C1.61319 0.413483 0 2.02691 0 4.01703V80.895C0 82.8852 1.61319 84.4986 3.60354 84.4986H119.396C121.387 84.4986 123 82.8852 123 80.895V4.01703C123 2.02691 121.387 0.413483 119.396 0.413483ZM79.5196 32.2457H94.1692C96.1594 32.2457 97.7728 33.8592 97.7728 35.8493C97.7728 37.8394 96.1594 39.4528 94.1692 39.4528H79.5196C77.5295 39.4528 75.9161 37.8394 75.9161 35.8493C75.9161 33.8592 77.5295 32.2457 79.5196 32.2457ZM50.5697 70.0837H21.7414C19.751 70.0837 18.1378 68.4703 18.1378 66.4801C18.1378 60.0677 21.5076 54.4306 26.567 51.2369C24.6838 49.0327 23.5432 46.1763 23.5432 43.0571C23.5432 36.1025 29.2012 30.4447 36.1556 30.4447C43.1099 30.4447 48.768 36.1025 48.768 43.0571C48.768 46.1763 47.6273 49.0327 45.7441 51.2369C50.8035 54.4306 54.1733 60.0677 54.1733 66.4801C54.1733 68.4703 52.5598 70.0837 50.5697 70.0837ZM101.377 68.2826H72.3118C70.3217 68.2826 68.7083 66.6692 68.7083 64.6791C68.7083 62.689 70.3217 61.0755 72.3118 61.0755H101.377C103.367 61.0755 104.981 62.689 104.981 64.6791C104.981 66.6692 103.367 68.2826 101.377 68.2826ZM101.377 53.8677H72.3118C70.3217 53.8677 68.7083 52.2543 68.7083 50.2642C68.7083 48.2741 70.3217 46.6606 72.3118 46.6606H101.377C103.367 46.6606 104.981 48.2741 104.981 50.2642C104.981 52.2543 103.367 53.8677 101.377 53.8677Z" fill="white" fill-opacity="0.08"/>
                  </svg>
              </div>
            </div>
            <div class="text-center col-12">
              <p class="card-text m-auto w-100">
                {{-- <button class="btn  btn-outline-danger border-radius-30 text-dark font-bold px-3">Retirar</button> --}}
                <button class="btn btn-warning btn-block" data-link="{{Request::url()}}/register?referred_id={{Auth::user()->id}}" id="referrals_link" onclick="copyReferralsLink();">Copiar link de referido <i class="far fa-copy"></i></button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Greetings Card ends -->


  </div>

    <div class="card col-12">
      <h1 class="text-dark texto-card-2 p-2">Premios</h1>
      <div class="card-body row">
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card border mt-5">
            <img src="{{asset('assets/app-assets/images/backgrounds/chat-bg.png')}}" alt="">
            <p class="texto-card-1 text-center py-1">Premio 1</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card border">
            <img src="{{asset('assets/app-assets/images/backgrounds/chat-bg.png')}}" alt="">
            <p class="texto-card-2 text-center py-1">Premio 2</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card border mt-5">
            <img src="{{asset('assets/app-assets/images/backgrounds/chat-bg.png')}}" alt="">
            <p class="texto-card-1 text-center py-1">Premio 3</p>
          </div>
        </div>
      </div>
    </div>

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
    function copyReferralsLink(){   
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
</script>
@endsection
