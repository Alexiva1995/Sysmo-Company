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

<div id="record">
    <div class="card col-12">
        <div class="card-content">
            <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-12 mt-2">
                        <label class="custom-file-label" for="img"><b>Seleccione una imagen para el Slider</b></label>
                        <input type="file" id="img" class="form-control border border-info rounded" name="img"
                            onchange="previewFile(this, 'photo_preview')" accept="image/*" />
                    </div>
                    <small>Recomendado: 1200px X 400px</small>
                </div>
                <div class="row mb-4 mt-4 d-none" id="photo_preview_wrapper">
                    <div class="col"></div>
                    <div class="col-auto">
                      <img id="photo_preview" class="img-fluid rounded" />
                    </div>
                    <div class="col"></div>
                </div>

                <div class="form-row my-3">
                    <div class="col-4">
                        <label for="">Nombre</label>
                        <input type="text" name="name" class="form-control border border-info rounded"
                            placeholder="Nombre de la imagen">
                    </div>
                    <div class="col-4">
                        <label for="">Descripción</label>
                        <input type="text" name="description" class="form-control border border-info rounded"
                            placeholder="Descripción de la imagen">
                    </div>
                    <div class="col-4">
                        <label for="">Estado</label>
                       <select name="status" class="form-control">
                           <option value="">--Seleccione una opción</option>
                           <option value="1">Activo</option>
                           <option value="0">Inactivo</option>
                       </select>
                    </div>
                    <input type="submit" class="btn btn-success btn-block mt-3" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
{{-- permite llamar a las opciones de las tablas --}}
@section('page-script')


<script>
    function previewFile(input, preview_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#" + preview_id).attr('src', e.target.result);
                $("#" + preview_id).css('height', '300px');
                $("#" + preview_id).parent().parent().removeClass('d-none');
            }
            $("label[for='" + $(input).attr('id') + "']").text(input.files[0].name);
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewPersistedFile(url, preview_id) {
        $("#" + preview_id).attr('src', url);
        $("#" + preview_id).css('height', '300px');
        $("#" + preview_id).parent().parent().removeClass('d-none');

    }

</script>
@endsection
