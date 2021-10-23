@extends('layouts/contentLayoutMaster')

@section('title', 'Pagos')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/additional/data-tables/dataTables.min.css')}}">
@endsection

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <h1 class="content-header-title float-left mr-2">Sysmo Company</h1>
                        <li class="breadcrumb-item"><a href="#">Slider</a></li>
                        <li class="breadcrumb-item"><a href="#">Index</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="{{route('slider.create')}}" class="btn btn-success p-1 my-2">Crear Slider</a>
<div class="accordion" id="accordionExample">
    <div class="card">
        @foreach ($sliders as $key => $slider)
        <button class="btn btn-link btn-block col-12 text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapse{{$key+1}}" aria-expanded="false" aria-controls="collapseOne">
            <div class="d-flex justify-content-between">
                        <h2 class="font-weight-bold">Slider #{{($key+1)}}</h2>
                        <a href="{{route('slider.edit', $slider)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
            </div>
        </button>
        <div id="collapse{{($key+1)}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <img class="d-block mx-auto w-50 my-1" style="object-fit: cover;" src="{{asset('storage/slider/'.$slider->img)}}" alt="">
                <div class="form-row">
                    <div class="col-4">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control border border-info rounded" readonly
                            placeholder="Nombre Imagen" value="{{$slider->name}}">
                    </div>
                    <div class="col-4">
                        <label for="">Descripción</label>
                        <input type="text" class="form-control border border-info rounded" readonly
                            placeholder="Descripción de la imagen" value="{{$slider->description}}">
                    </div>
                    <div class="col-4 text-center mx-auto mt-2">
                        <label for="">Status</label>
                        @if($slider->status == 1)
                        <div class="badge badge-success">Activo</div>
                        @elseif($slider->status == 0)
                        <div class="badge badge-danger">Inactivo</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection