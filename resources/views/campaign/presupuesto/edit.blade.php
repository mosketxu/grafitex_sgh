@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Presupuesto Editar')
@section('titlePag','Edición del presupuesto')
@section('navbar')
@include('campaign._navbarcampaign')
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
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="form-group col">
                                <label for="campaign_name">Campaña</label>
                                <input type="text" class="form-control form-control-sm" id="campaign_name"
                                    name="campaign_name" value="{{ old('campaign_name',$campaign->campaign_name) }}"
                                    disabled />
                                </div>
                                <div class="form-group col">
                                <label for="campaign_initdate">Fecha Inicio</label>
                                <input type="date" class="form-control form-control-sm" id="campaign_initdate"
                                    name="campaign_initdate"
                                    value="{{ old('campaign_initdate',$campaign->campaign_initdate) }}" disabled />
                                </div>
                                <div class="form-group col">
                                <label for="campaign_enddate">Fecha Finalización</label>
                                <input type="date" class="form-control form-control-sm" id="campaign_enddate"
                                    name="campaign_enddate" value="{{ old('campaign_enddate',$campaign->campaign_enddate) }}"
                                    disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formpresupuesto" role="form" method="post" action="{{ route('campaign.presupuesto.update',$campaignpresupuesto->id) }}">
                        @csrf
                        <input type="hidden" name="campaign_id" value="{{$campaign->id}}">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="form-label-sm" for="referencia">Referencia</label>
                                        <input type="text" class="form-control-sm form-control" id="referencia"
                                        name="referencia" value="{{$campaignpresupuesto->referencia}}">
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="form-label-sm" for="version">Versión</label>
                                        <input type="number" step="0.1" class="form-control-sm form-control" id="version"
                                        name="version" value="{{$campaignpresupuesto->version}}">
                                    </div>
                                    <div class="form-group col">
                                        <label class="form-label-sm" for="fecha">Fecha</label>
                                        <input type="date" class="form-control-sm form-control" id="fecha" name="fecha"
                                        value="{{$campaignpresupuesto->fecha}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-5">
                                        <label class="form-label-sm" for="atencion">Atención</label>
                                        <input type="text" class="form-control-sm form-control" id="atencion"
                                        name="atencion" value="{{$campaignpresupuesto->atencion}}">
                                    </div>
                                    <div class="form-group col-4">
                                        <label class="form-label-sm" for="ambito">Ámbito</label>
                                        <input type="text" class="form-control-sm form-control" id="ambito" name="ambito"
                                        value="{{$campaignpresupuesto->ambito}}">
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="form-label-sm" for="estado">Estado</label>
                                        <select name="estado" id="estado" class="form-control form-control-sm">
                                            <option value="{{$campaignpresupuesto->estado}}">{{$campaignpresupuesto->estado}}</option>
                                            <option value="Creado">Creado</option>
                                            <option value="Iniciado">Iniciado</option>
                                            <option value="Aceptado">Aceptado</option>
                                            <option value="Rechazado">Rechazado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group col">
                                    <label class="form-label-sm" for="observaciones">Observaciones</label>
                                    <textarea class="form-control-sm form-control" id="observaciones"
                                        name="observaciones" rows="5">{{$campaignpresupuesto->observaciones}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer  p-0">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                                </div>
                                <div class="col-6">
                                    <input type ='button' class="btn btn-default btn-block" onclick="location.href = '{{route('campaign.presupuesto',$campaign->id) }}'" value="Volver"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scriptchosen')
{{-- <script src="{{ asset('js/campaignElementos.js')}}"></script> --}}

<script>
    @include('_partials._errortemplate')
</script>
        

<script>
    $('#menucampaign').addClass('active');
    $('#navpresupuesto').toggleClass('activo');
</script>


@endpush
