@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Campañas Edit')
@section('titlePag','Filtros campaña')
@section('navbar')
    @include('campaign._navbarcampaign')
@endsection


@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('campaignEdit') }} --}}
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
                </div>
                <div class="col-auto mr-auto">
                    <a  type="button" href="#" title="Generar" class="nav-link btn-outline-primary" data-toggle="modal" data-target="#campaignFiltrarModal">
                        <i class="fas fa-plus-circle fa-lg text-primary"></i>
                        <span class="badge badge-primary">Generar</span>
                    </a>
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
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="campaign_name">Campaña</label>
                                    <input type="text" class="form-control form-control-sm" id="campaign_name"
                                        name="campaign_name"
                                        value="{{ old('campaign_name',$campaign->campaign_name) }}" disabled />
                                </div>
                                <div class="form-group col">
                                    <label for="campaign_initdate">Fecha Inicio</label>
                                    <input type="date" class="form-control form-control-sm" id="campaign_initdate"
                                        name="campaign_initdate"
                                        value="{{ old('campaign_initdate',$campaign->campaign_initdate) }}"
                                        disabled />
                                </div>
                                <div class="form-group col">
                                    <label for="campaign_enddate">Fecha Finalización</label>
                                    <input type="date" class="form-control form-control-sm" id="campaign_enddate"
                                        name="campaign_enddate"
                                        value="{{ old('campaign_enddate',$campaign->campaign_enddate) }}"
                                        disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="card col-6">
                            <div class="card-header">
                                Filtros de Stores
                            </div>
                            <div class="card-body">
                                <!-- Filtro Stores -->
                                <div class="card collapsed-card">
                                    <div class="card-header text-white bg-primary p-0" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Stores</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool"><i  class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="#" method="post">
                                            <input type="hidden" name="_tokenStore" value="{{ csrf_token()}}" id="tokenStore">
                                            <div class="form-group">
                                                @csrf
                                                <input type="hidden" class="" name="campaign_id" value="{{$campaign->id}} " />
                                                <select class="duallistbox" multiple="multiple" name="storesduallistbox[]" size="5">
                                                    @foreach ($storesDisponibles as $store )
                                                    <option value="{{$store}}">{{$store->store}} {{$store->name}}
                                                    </option>
                                                    @endforeach
                                                    @foreach ($storesAsociadas as $store )
                                                    <option value="{{$store}}" selected="selected">{{$store->store}}
                                                        {{$store->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-default btn-block" name="Guardar"
                                                onclick="asociar({{ $campaign->id}},'/campaign/asociarstore','#tokenStore','storesduallistbox[]','Stores','store','campaign_stores')">Asociar
                                            Stores</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Filtro Segmento -->
                                <div class="card collapsed-card">
                                    <div class="card-header text-white bg-success p-0" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Segmentos</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="#" method="post">
                                            <input type="hidden" name="_tokenSegmento" value="{{ csrf_token()}}" id="tokenSegmento">
                                            <div class="form-group">
                                                @csrf
                                                <input type="hidden" class="" name="campaign_id" value="{{$campaign->id}} " />
                                                <select class="duallistboxSinFiltro" multiple="multiple"
                                                    name="segmentosduallistbox[]" size="5">
                                                    @foreach ($segmentosDisponibles as $segmento )
                                                    <option value="{{$segmento}}">{{$segmento->segmento}}</option>
                                                    @endforeach
                                                    @foreach ($segmentosAsociadas as $segmento )
                                                    <option value="{{$segmento}}" selected="selected">
                                                        {{$segmento->segmento}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-default btn-block" name="Guardar"
                                                onclick="asociar({{ $campaign->id}},'/campaign/asociar','#tokenSegmento','segmentosduallistbox[]','Segmentos','segmento','campaign_segmentos')">Asociar
                                                Segmentos</button>

                                        </form>
                                    </div>
                                </div>
                                <!-- Filtro Ubicacion -->
                                <div class="card collapsed-card">
                                    <div class="card-header text-black bg-warning p-0" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Ubicación</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body collapse">
                                        <form action="#" method="post">
                                            <input type="hidden" name="_tokenUbicacion" value="{{ csrf_token()}}"
                                                id="tokenUbicacion">
                                            <div class="form-group">
                                                @csrf
                                                <input type="hidden" class="" name="campaign_id" value="{{$campaign->id}} " />
                                                <select class="duallistboxSinFiltro" multiple="multiple"
                                                    name="ubicacionesduallistbox[]" size="5">
                                                    @foreach ($ubicacionesDisponibles as $ubicacion )
                                                    <option value="{{$ubicacion}}">{{$ubicacion->ubicacion}}</option>
                                                    @endforeach
                                                    @foreach ($ubicacionesAsociadas as $ubicacion )
                                                    <option value="{{$ubicacion}}" selected="selected">
                                                        {{$ubicacion->ubicacion}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-default btn-block" name="Guardar"
                                                onclick="asociar({{ $campaign->id}},'/campaign/asociar','#tokenUbicacion','ubicacionesduallistbox[]','Ubicaciones','ubicacion','campaign_ubicacions')">Asociar
                                                Ubicaciones</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card col-6">
                            <div class="card-header">
                                Filtros de Elementos
                            </div>
                            <div class="card-body">
                                <!-- Filtro Medida -->
                                <div class="card collapsed-card">
                                    <div class="card-header text-white bg-secondary p-0" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Medida</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body collapse">
                                        <form action="#" method="post">
                                            <input type="hidden" name="_tokenMedida" value="{{ csrf_token()}}" id="tokenMedida">
                                            <div class="form-group">
                                                @csrf
                                                <input type="hidden" class="" name="campaign_id"
                                                    value="{{$campaign->id}} " />
                                                <select class="duallistbox" multiple="multiple" name="medidasduallistbox[]"
                                                    size="5">
                                                    @foreach ($medidasDisponibles as $medida )
                                                    <option value="{{$medida}}">{{$medida->medida}}</option>
                                                    @endforeach
                                                    @foreach ($medidasAsociadas as $medida )
                                                    <option value="{{$medida}}" selected="selected">
                                                        {{$medida->medida}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-default btn-block" name="Guardar"
                                                onclick="asociar({{ $campaign->id}},'/campaign/asociar','#tokenMedida','medidasduallistbox[]','Medidas','medida','campaign_medidas')">Asociar
                                                Medidas</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Filtro Mobiliario -->
                                <div class="card collapsed-card">
                                    <div class="card-header text-white bg-indigo p-0" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Mobiliario</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body collapse">
                                        <form id="mobiliarioform" action="#" method="post">
                                            <input type="hidden" name="_tokenMobiliario" value="{{ csrf_token()}}"
                                                id="tokenMobiliario">
                                            <div class="form-group">
                                                @csrf
                                                <input type="hidden" class="" name="campaign_id"
                                                    value="{{$campaign->id}} " />
                                                <select class="duallistbox" multiple="multiple" name="mobiliariosduallistbox[]"
                                                    size="5">
                                                    @foreach ($mobiliariosDisponibles as $mobiliario )
                                                    <option value="{{$mobiliario}}">{{$mobiliario->mobiliario}}</option>
                                                    @endforeach
                                                    @foreach ($mobiliariosAsociadas as $mobiliario )
                                                    <option value="{{$mobiliario}}" selected="selected">
                                                        {{$mobiliario->mobiliario}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-default btn-block" name="Guardar"
                                                onclick="asociar({{ $campaign->id}},'/campaign/asociar','#tokenMobiliario','mobiliariosduallistbox[]','Mobiliarios','mobiliario','campaign_mobiliarios')">Asociar
                                                Mobiliario</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="campaignFiltrarModal" tabindex="-1" role="dialog" aria-labelledby="campaignFiltrarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="campaignFiltrarModalLabel">Generar Campaña</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            @csrf
                            <div class="row">
                                <p>Se va a proceder a generar los elementos de la campaña.</p>
                                <p>En caso de haberse generado previamente, se eliminarán los existentes y se volverán a generar.</p>
                                <p>Pulse <span class="badge badge-primary">Generar</span> para continuar o <span class="badge badge-secondary">Cerrar</span> para cancelar. </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <a  type="button" href="{{route('campaign.generar',$campaign->id) }}" title="Generar" class="btn btn-primary" name="Generar">Generar</a> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scriptchosen')
<script>
    $(document).ready( function () {

    });

    $('#menucampaign').addClass('active');
    $('#navfiltros').toggleClass('activo');

</script>
<script src="{{ asset('js/campaignFiltros.js')}}"></script>


@endpush