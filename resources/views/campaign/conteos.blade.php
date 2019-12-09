@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Estadísticas Campaña')
@section('titlePag','Estadísticas Campaña')
@section('navbar')
@include('campaign._navbarcampaign')
@endsection
@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('campaignConteo') }} --}}
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
                                        name="campaign_enddate"
                                        value="{{ old('campaign_enddate',$campaign->campaign_enddate) }}" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Detallado --}}
                    <div class="card collapsed-card">
                        <div class="card-header text-white bg-info p-0" data-card-widget="collapse"
                            style="cursor: pointer">
                            <h3 class="card-title pl-3">Detallado</h3>
                            <div class="card-tools pr-3">
                                <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10 row">
                                    {{ $conteodetallado->links() }}
                                </div>
                                <div class="col-2 float-right mb-2">
                                    <form method="GET" action="{{route('campaign.conteo',$campaign) }}">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-search fa-sm text-primary"></i></span>
                                            </div>
                                            <input id="busca" name="busca" type="text" class="form-control"
                                                name="search" value='{{$busqueda}}' placeholder="Search for..." />
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="" class="table table-hover table-sm small sortable" cellspacing="0"
                                    width=100%>
                                    <thead>
                                        <tr>
                                            <th>Area</th>
                                            <th>Segmento</th>
                                            <th>Ubicación</th>
                                            <th>Medida</th>
                                            <th>Mobiliario</th>
                                            <th>Material</th>
                                            <th>Totales</th>
                                            <th>Unidades</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach($conteodetallado as $detalle)
                                        <tr>
                                            <td>{{$detalle->area}}</td>
                                            <td>{{$detalle->segmento}}</td>
                                            <td>{{$detalle->ubicacion}}</td>
                                            <td>{{$detalle->medida}}</td>
                                            <td>{{$detalle->mobiliario}}</td>
                                            <td>{{$detalle->material}}</td>
                                            <td>{{$detalle->totales}}</td>
                                            <td>{{$detalle->unidades}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{-- zonas --}}
                            <div class="card collapsed-card ">
                                <div class="card-header text-white bg-indigo p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Tiendas por zonas</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignStores" class="table table-hover table-sm small"
                                            cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Country</th>
                                                    <th>Area</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            {{-- materiales --}}
                            <div class="card collapsed-card">
                                <div class="card-header text-white bg-navy p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Por materiales</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignMateriales" class="table table-hover table-sm small"
                                            cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Material</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{-- segmentos --}}
                            <div class="card collapsed-card ">
                                <div class="card-header text-white bg-purple p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Por segmentos</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignSegmentos" class="table table-hover table-sm small"
                                            cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Segmentos</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            {{-- store concepts --}}
                            <div class="card collapsed-card">
                                <div class="card-header text-white bg-fuchsia p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Por Store Concepts</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignStoreConcepts" class="table table-hover table-sm small"
                                            cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Store Concepts</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            {{-- mobiliario --}}
                            <div class="card collapsed-card ">
                                <div class="card-header text-white bg-pink p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Por Mobiliarios</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignMobiliarios" class="table table-hover table-sm small"
                                            cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Mobiliario</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{-- propxelemento --}}
                            <div class="card collapsed-card">
                                <div class="card-header text-white bg-maroon p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Por Prop x Elemento</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignPropxelementos" class="table table-hover table-sm small"
                                            cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Prop x Elementos</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            {{-- carteleria --}}
                            <div class="card collapsed-card ">
                                <div class="card-header text-white bg-orange p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Por Carteleria</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignCartelerias" class="table table-hover table-sm small"
                                            cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Cartelerias</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            {{-- medidas --}}
                            <div class="card collapsed-card">
                                <div class="card-header text-white bg-lime p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Por medidas</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignMedida" class="table table-hover table-sm small"
                                            cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Medidas</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{-- material medida --}}
                            <div class="card collapsed-card">
                                <div class="card-header text-white bg-teal p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Por Material y Medida</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignMaterialMedida"
                                            class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Material</th>
                                                    <th>Medidas</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            {{-- idioma material medida --}}
                            <div class="card collapsed-card">
                                <div class="card-header text-white bg-olive p-0" data-card-widget="collapse"
                                    style="cursor: pointer">
                                    <h3 class="card-title pl-3">Por Idioma Material Medida</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tcampaignIdiomaMaterialMedida"
                                            class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Idioma</th>
                                                    <th>Material</th>
                                                    <th>Medidas</th>
                                                    <th>Totales</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

@push('scriptchosen')
<script src="{{ asset('js/datatablesdefault.js')}}"></script>
<script src="{{ asset('js/sortTable.js')}}"></script>
<script>
    $(document).ready( function () {
        // $('#tcampaignDetalles').DataTable({
        //     'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaigndetalle",
        //     'columns': [
        //         { 'data': 'segmento' },{ 'data': 'ubicacion' }, { 'data': 'medida' }, { 'data': 'mobiliario' },
        //         { 'data': 'area' }, { 'data': 'material' }, { 'data': 'totales' }, { 'data': 'unidades' },
        //     ],
        //     'paging':true,
        // });
        $('#tcampaignStores').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaignstore",
            'columns': [
                { 'data': 'country' },{ 'data': 'area' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });
        $('#tcampaignMateriales').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaignmaterial",
            'columns': [
                { 'data': 'material' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });
        $('#tcampaignSegmentos').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaignsegmento",
            'columns': [
                { 'data': 'segmento' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });
        $('#tcampaignStoreConcepts').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaignstoreconcept",
            'columns': [
                { 'data': 'storeconcept' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });
        $('#tcampaignMobiliarios').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaignmobiliario",
            'columns': [
                { 'data': 'mobiliario' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });
        $('#tcampaignPropxelementos').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaignpropxelemento",
            'columns': [
                { 'data': 'propxelemento' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });
        $('#tcampaignCartelerias').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaigncarteleria",
            'columns': [
                { 'data': 'carteleria' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });
        $('#tcampaignMedida').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaignmedida",
            'columns': [
                { 'data': 'medida' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });
        $('#tcampaignMaterialMedida').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaignmaterialmedida",
            'columns': [
                { 'data': 'material' },{ 'data': 'medida' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });
        $('#tcampaignIdiomaMaterialMedida').DataTable({
            'ajax': "http://grafitexlte.test/api/api/{{$campaign->id}}/campaignidiomamaterialmedida",
            'columns': [
                { 'data': 'country' },{ 'data': 'material' },{ 'data': 'medida' }, { 'data': 'totales' }, { 'data': 'unidades' }
            ],
            'info':false,
            'searching':false,
        });

    });
    $('#menucampaign').addClass('active');
    $('#navestadisticas').toggleClass('activo');
</script>
@endpush