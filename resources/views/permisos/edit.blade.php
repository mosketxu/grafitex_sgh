@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Editar Permiso')
@section('titlePag','Edición de Permiso')
@section('navbar')
    @include('_partials._navbar')
@endsection
@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('campaignGaleria') }} --}}
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    {{-- content header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto ">
                    <span class="h3 m-0 text-dark">@yield('titlePag')</span>
                    <span class="hidden" id="campaign_id"></span>
                </div>
                <div class="col-auto mr-auto">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @yield('breadcrumbs')
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- main content  --}}
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5>Edición del permiso <span class="text-primary">{{$permission->id}} - {{$permission->name}} </span></h5>
                </div>
                <form id="formpermiso" role="form" method="post" action="{{ route('permission.update',$permission->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group  col-4">
                                <label for="name">Nombre</label>
                                <input  type="text" class="form-control form-control-sm" id="name" name="name" value="{{old('name',$permission->name)}}" required>
                            </div>
                            <div class="form-group  col-4">
                                <label for="slug">Slug</label>
                                <input  type="text" class="form-control form-control-sm" id="slug" name="slug" value="{{old('slug',$permission->slug)}}" required>
                            </div>
                            <div class="form-group  col-4">
                                <label for="description">Descripción</label>
                                <input  type="text" class="form-control form-control-sm" id="description" name="description" value="{{old('description',$permission->description)}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('permission.index')}}" type="button" class="btn btn-default">Volver</a>
                        @can('permission.edit')
                        <button type="button" class="btn btn-primary" name="Guardar" onclick="form.submit()">Actualizar</button>
                        @endcan
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scriptchosen')

<script>
    $('.select2').select2({
        placeholder: 'permissions'
    });

    $('#menupermisos').addClass('active');
    // $('#navgaleria').toggleClass('activo');
</script>

<script>@include('_partials._errortemplate')</script>

@endpush