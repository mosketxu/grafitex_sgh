@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Editar Store')
@section('titlePag','Edición de Stores')
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
                    <h5>Edición <span class="text-primary">{{$store->id}} {{$store->name}} </span></h5>
                </div>
                <form id="formstore" role="form" method="post" action="{{ route('store.update',$store->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="name">Nombre</label>
                                        <input  type="text" class="form-control form-control-sm" id="name" name="name" value="{{old('name',$store->name)}}">
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="country">Country {{$store->country}}</label>
                                        <select class="form-control form-control-sm" id="country" name="country" >
                                            <option value="ES" {{old('country','ES'==$store->country) ? 'selected' : ''}}>ES</option>
                                            <option value="PT" {{old('country','PT'==$store->country) ? 'selected' : ''}}>PT</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="area">Area</label>
                                        <select class="form-control form-control-sm" id="area_id" name="area_id" >
                                            @foreach($areas as $area )
                                            <option value="{{$area->id}}" {{old('area_id',$area->id==$store->area_id) ? 'selected' : ''}}>{{$area->area}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-3">
                                        <label for="segmento">Segmento</label>
                                        <select class="form-control form-control-sm" id="segmento" name="segmento" >
                                            @foreach($segmentos as $segmento )
                                            <option value="{{$segmento->id}}" {{old('segmento',$segmento->id==$store->segmento_id) ? 'selected' : ''}}>{{$segmento->segmento}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="concepto">Concepto</label>
                                        <select class="form-control form-control-sm" id="concepto_id" name="concepto_id" >
                                            @foreach($conceptos as $concepto )
                                            <option value="{{$concepto->id}}" {{old('concepto_id',$concepto->id==$store->concepto_id) ? 'selected' : ''}}>{{$concepto->storeconcept}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="observaciones">Observaciones</label>
                                        <input  type="text" class="form-control form-control-sm" id="observaciones" name="observaciones" value="{{old('observaciones',$store->observaciones)}}">
                                    </div>
                                </div>
                                <input type="hidden" name="imagen" value="{{$store->imagen}}" readonly>  
                                @can('store.edit')
                                <input type="file" name="photo" value="">  
                                @endcan
                            </div>
                            <div class="col-4">
                            <img src="{{asset('storage/store/'.$store->imagen)}}" alt={{$store->imagen}} title={{$store->imagen}} 
                                class="img-fluid img-thumbnail" style="max-height: 250px; max-width: 350px;">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('store.index')}}" type="button" class="btn btn-default">Volver</a>
                        @can('store.edit')
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
    $('#menumantenimiento').addClass('active');
    // $('#navgaleria').toggleClass('activo');
</script>

<script>@include('_partials._errortemplate')</script>

@endpush