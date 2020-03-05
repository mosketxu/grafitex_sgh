@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Editar Tarifa')
@section('titlePag','Editar Tarifa')
@section('navbar')
    @include('_partials._navbar')
@endsection
@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('campaignElementos') }} --}}
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        {{-- content header --}}
        <div class="content-header">
            <div class="container">
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
        {{-- - /.content-header --}}
        {{-- main content  --}}
        <section class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $tarifa->id }}"/>
                                    <input type="hidden" name="tipo" value="0"/>
                                    <div class="form-group col">
                                        <label for="zona">Zona</label>
                                        <input type="text" class="form-control form-control-sm" id="zona"
                                            name="zona" value="{{ $tarifa->zona }}"
                                            disabled />
                                    </div>
                                    <div class="form-group col">
                                        <label for="zona">Familia</label>
                                        <input type="text" class="form-control form-control-sm" id="familia"
                                            name="familia" value="{{ $tarifa->familia }}"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('tarifa.update',$tarifa->id) }}"> 
                            @method("PUT")
                            @csrf
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <label for="tramo1" class="col-sm-1 col-form-label">Tramo1</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="tramo1" id="tramo1" value="{{$tarifa->tramo1}}">
                                </div>
                                <label for="tarifa1" class="col-sm-1 col-form-label">Tarifa1</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control"  name="tarifa1" id="tarifa1" value="{{$tarifa->tarifa1}}">
                                </div>
                                <label for="" class="col-sm-2 col-form-label"></label>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <label for="tramo2" class="col-sm-1 col-form-label">Tramo2</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="tramo2" id="tramo2" value="{{$tarifa->tramo2}}">
                                </div>
                                <label for="tarifa2" class="col-sm-1 col-form-label">Tarifa2</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control"  name="tarifa2" id="tarifa2" value="{{$tarifa->tarifa2}}">
                                </div>
                                <label for="" class="col-sm-2 col-form-label"></label>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <label for="tramo3" class="col-sm-1 col-form-label">Tramo3</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="tramo3" id="tramo3" value="{{$tarifa->tramo3}}">
                                </div>
                                <label for="tarifa3" class="col-sm-1 col-form-label">Tarifa3</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control"  name="tarifa3" id="tarifa3" value="{{$tarifa->tarifa3}}">
                                </div>
                                <label for="" class="col-sm-2 col-form-label"></label>
                            </div> --}}
                            <div class="footer text-center">
                                <a type="button" class="btn btn-default" href="{{route('tarifa.index')}}">Volver</a>
                                <input class="btn btn-primary" type="submit" value="Guardar">
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
    $('#menumantenimiento').addClass('active');
    // $('#navelemento').toggleClass('activo'); 
</script>
<script>@include('_partials._errortemplate')</script>

@endpush