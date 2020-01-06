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
                    @can('campaign.create')
                    <a type="button" href="#" title="Generar" class="nav-link btn-outline-primary" data-toggle="modal"
                        data-target="#campaignFiltrarModal" data-backdrop="static" data-keyboard="false">
                        <i class="fas fa-plus-circle fa-2x text-primary"></i>
                        <span class="badge badge-primary">Generar</span>
                    </a>
                    @endcan
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
    <section class="content pb-1">
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
                                        name="campaign_enddate"
                                        value="{{ old('campaign_enddate',$campaign->campaign_enddate) }}" disabled />
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
                                    <div class="card-header text-white bg-primary p-0" data-card-widget="collapse"
                                        style="cursor: pointer">
                                        <h3 class="card-title pl-3">Stores</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        {{-- <form action="#" method="post"> --}}
                                        <form action="{{route('campaign.asociarstore')}}" method="post">
                                            <div class="form-group">
                                                @csrf
                                                <input type="hidden" name="_tokenStore" value="{{ csrf_token()}}"
                                                    id="tokenStore">
                                                <input type="hidden" class="" name="campaign_id"
                                                    value="{{$campaign->id}} " />
                                                <select class="duallistbox" multiple="multiple"
                                                    name="storesduallistbox[]" size="5">
                                                    @foreach ($storesDisponibles as $store )
                                                    <option value="{{$store}}">{{$store->store}} {{$store->name}}
                                                    </option>
                                                    </option>
                                                    @endforeach
                                                    @foreach ($storesAsociadas as $store )
                                                    <option value="{{$store}}" selected="selected">{{$store->store}}
                                                        {{$store->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @can('campaign.create')
                                            {{-- <button type="button" class="btn btn-default btn-block" name="Guardar"
                                                onclick="asociar({{ $campaign->id}},'/campaign/asociarstore','#tokenStore','storesduallistbox[]','Stores','store','campaign_stores')">Asociar
                                            Stores</button> --}}
                                            <button type="submit" class="btn btn-default btn-block"
                                                name="Guardar">Asociar Stores</button>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                                <!-- Filtro Segmento -->
                                <div class="card collapsed-card">
                                    <div class="card-header text-white bg-success p-0" data-card-widget="collapse"
                                        style="cursor: pointer">
                                        <h3 class="card-title pl-3">Segmentos</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('campaign.asociar')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="_tokenSegmento" value="{{ csrf_token()}}"
                                                    id="tokenSegmento">
                                                <input type="hidden" class="" name="campaign_id"
                                                    value="{{$campaign->id}} " />
                                                <input type="hidden" class="" name="campo" value="segmento" />
                                                <input type="hidden" class="" name="tabla" value="campaign_segmentos" />
                                                <select class="duallistboxSinFiltro" multiple="multiple"
                                                    name="duallistbox[]" size="5">
                                                    @foreach ($segmentosDisponibles as $segmento )
                                                    <option value="{{$segmento}}">{{$segmento->segmento}}</option>
                                                    @endforeach
                                                    @foreach ($segmentosAsociadas as $segmento )
                                                    <option value="{{$segmento}}" selected="selected">
                                                        {{$segmento->segmento}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @can('campaign.create')
                                            <button type="submit" class="btn btn-default btn-block"
                                                name="Guardar">Asociar Segmentos</button>
                                            @endcan
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
                                <!-- Filtro Ubicacion -->
                                <div class="card collapsed-card">
                                    <div class="card-header text-black bg-warning p-0" data-card-widget="collapse"
                                        style="cursor: pointer">
                                        <h3 class="card-title pl-3">Ubicación</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body collapse">
                                        <form action="{{route('campaign.asociar')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="_tokenUbicacion" value="{{ csrf_token()}}"
                                                    id="tokenUbicacion">
                                                <input type="hidden" class="" name="campaign_id"
                                                    value="{{$campaign->id}} " />
                                                <input type="hidden" class="" name="campo" value="ubicacion" />
                                                <input type="hidden" class="" name="tabla"
                                                    value="campaign_ubicacions" />
                                                <select class="duallistboxSinFiltro" multiple="multiple"
                                                    name="duallistbox[]" size="5">
                                                    @foreach ($ubicacionesDisponibles as $ubicacion )
                                                    <option value="{{$ubicacion}}">{{$ubicacion->ubicacion}}</option>
                                                    @endforeach
                                                    @foreach ($ubicacionesAsociadas as $ubicacion )
                                                    <option value="{{$ubicacion}}" selected="selected">
                                                        {{$ubicacion->ubicacion}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @can('campaign.create')
                                            <button type="submit" class="btn btn-default btn-block"
                                                name="Guardar">Asociar Ubicacion</button>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                                <!-- Filtro Medida -->
                                <div class="card collapsed-card">
                                    <div class="card-header text-white bg-secondary p-0" data-card-widget="collapse"
                                        style="cursor: pointer">
                                        <h3 class="card-title pl-3">Medida</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body collapse">
                                        <form action="{{route('campaign.asociar')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="_tokenMedida" value="{{ csrf_token()}}"
                                                    id="tokenMedida">
                                                <input type="hidden" class="" name="campaign_id"
                                                    value="{{$campaign->id}} " />
                                                <input type="hidden" class="" name="campo" value="medida" />
                                                <input type="hidden" class="" name="tabla" value="campaign_medidas" />
                                                <select class="duallistbox" multiple="multiple" name="duallistbox[]"
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
                                            @can('campaign.create')
                                            <button type="submit" class="btn btn-default btn-block"
                                                name="Guardar">Asociar Medida</button>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                                <!-- Filtro Mobiliario -->
                                <div class="card collapsed-card">
                                    <div class="card-header text-white bg-indigo p-0" data-card-widget="collapse"
                                        style="cursor: pointer">
                                        <h3 class="card-title pl-3">Mobiliario</h3>
                                        <div class="card-tools pr-3">
                                            <button type="button" class="btn btn-tool">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body collapse">
                                        <form action="{{route('campaign.asociar')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="_tokenMobiliario" value="{{ csrf_token()}}"
                                                    id="tokenMobiliario">
                                                <input type="hidden" class="" name="campaign_id"
                                                    value="{{$campaign->id}} " />
                                                <input type="hidden" class="" name="campo" value="mobiliario" />
                                                <input type="hidden" class="" name="tabla"
                                                    value="campaign_mobiliarios" />
                                                <select class="duallistbox" multiple="multiple" name="duallistbox[]"
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
                                            @can('campaign.create')
                                            <button type="submit" class="btn btn-default btn-block"
                                                name="Guardar">Asociar Mobiliario</button>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- listado de elementos --}}
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-10 row">
                            {{ $elementos->links() }} &nbsp; &nbsp;
                            Hay {{$elementos->total()}} elementos disponibles.
                        </div>
                        <div class="col-2 float-right mb-2">
                            <form method="GET" action="{{route('campaign.filtrar',$campaign) }}">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search fa-sm text-primary"></i></span>
                                    </div>
                                    <input id="busca" name="busca"  type="text" class="form-control" name="search" value='{{$busqueda}}' placeholder="Search for..."/>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm small" cellspacing="0" width=100%>
                            <thead>
                                <tr>
                                    <th>Store</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Zona</th>
                                    <th>Area</th>
                                    <th>Segmento</th>
                                    <th>Concepto</th>
                                    <th>Ubicación</th>
                                    <th>Mobiliario</th>
                                    <th>Prop x Elemento</th>
                                    <th>Carteleria</th>
                                    <th>Medida</th>
                                    <th>Material</th>
                                    <th>Unit x Prop</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($elementos as $elemento)
                                <tr>
                                    <td>{{$elemento->store_id}}</td>
                                    <td>{{$elemento->name}}</td>
                                    <td>{{$elemento->country}}</td>
                                    <td>{{$elemento->area}}</td>
                                    <td>{{$elemento->zona}}</td>
                                    <td>{{$elemento->segmento}}</td>
                                    <td>{{$elemento->concepto}}</td>
                                    <td>{{$elemento->ubicacion}}</td>
                                    <td>{{$elemento->mobiliario}}</td>
                                    <td>{{$elemento->propxelemento}}</td>
                                    <td>{{$elemento->carteleria}}</td>
                                    <td>{{$elemento->medida}}</td>
                                    <td>{{$elemento->material}}</td>
                                    <td>{{$elemento->unitxprop}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="campaignFiltrarModal" tabindex="-1" role="dialog"
            aria-labelledby="campaignFiltrarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="campaignFiltrarModalLabel">Generar Campaña</h5>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <p>Pulsar <span class="badge badge-primary">Nueva Campaña</span> para comenzar de 0.</p>
                            <p>Pulsar <span class="badge badge-success">Añadir Elemento</span> para añadir nuevos
                                elementos.</p>
                            <p>Pulsar <span class="badge badge-secondary">Cerrar</span> para cancelar.</p>
                        </div>
                        <div class="modal-footer">
                            @can('campaign.create')
                            <form id="formularioNueva" method="post"
                                action="{{route('campaign.generar',['0',$campaign->id]) }}">
                                @csrf
                                <button type="button" onclick="generar('#formularioNueva')"
                                    title="Generar Nueva Campaña" class="btn btn-primary modalSubir"
                                    name="Generar">Nueva Campaña</a>
                            </form>
                            <form id="formularioMas" method="post"
                                action="{{route('campaign.generar',['1',$campaign->id]) }}">
                                @csrf
                                <button type="button" onclick="generar('#formularioMas')"
                                    title="Añadir Elementos a la Campaña" class="btn btn-success modalSubir"
                                    name="Generar">Añadir Elementos</a>
                            </form>
                            @endcan
                            <button type="button" class="btn btn-secondary modalSubir"
                                data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scriptchosen')
<script>
    @include('_partials._errortemplate')

    function generar(form){
        $('.modalSubir').attr('disabled',true);
        $(form).submit();
    }

    $('#menucampaign').addClass('active');
    $('#navfiltros').toggleClass('activo');

</script>
<script src="{{ asset('js/campaignFiltros.js')}}"></script>


@endpush