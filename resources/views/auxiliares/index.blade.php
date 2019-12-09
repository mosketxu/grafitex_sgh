@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Estadísticas Auxiliares')
@section('titlePag','Tablas auxiliares')
@section('navbar')
    @include('maestro._navbarmaestro')
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Country --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-indigo p-0 row">
                                    <div class="col-5" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Country</h3>
                                    </div>
                                    <div class="col-1" >
                                        <a href="{{route('country.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tCountry" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Country</th>
                                                    <th class="text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Area --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-olive p-0 row">
                                    <div class="col-5" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Area</h3>
                                    </div>
                                    <div class="col-1" >
                                        <a href="{{route('area.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tArea" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Area<a href="{{route('area.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-primary fa-lg mx-3"></i></a></th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Segmento --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-navy p-0 row">
                                    <div class="col-5" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Segmento</h3>
                                    </div>
                                    <div class="col-1" >
                                        <a href="{{route('segmento.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tSegmento" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Segmento</th>
                                                    <th>&nbsp;</th>
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
                        {{-- Store Concept --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-purple p-0 row">
                                    <div class="col-5" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Store Concept</h3>
                                    </div>
                                    <div class="col-1" >
                                        <a href="{{route('storeconcept.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tStoreconcept" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Store Concept</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Ubicacion --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-fuchsia p-0 row">
                                    <div class="col-5" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Ubicación</h3>
                                    </div>
                                    <div class="col-1" >
                                        <a href="{{route('ubicacion.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tUbicacion" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Ubicación<a href="{{route('ubicacion.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-primary fa-lg mx-3"></i></a></th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Mobiliario --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-pink p-0 row">
                                    <div class="col-5" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Mobiliario</h3>
                                    </div>
                                    <div class="col-1" >
                                        <a href="{{route('mobiliario.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>        
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tMobiliario" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Mobiliario<a href="{{route('mobiliario.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-primary fa-lg mx-3"></i></a></th>
                                                    <th>&nbsp;</th>
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
                        {{-- Propxelemento --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-maroon p-0 row">
                                    <div class="col-5" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Prop x Elemento</h3>
                                    </div>
                                    <div class="col-1" >
                                        <a href="{{route('propxelemento.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>        
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tPropxelemento" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Prop x Elemento<a href="{{route('propxelemento.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-primary fa-lg mx-3"></i></a></th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                        {{-- Carteleria --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-orange p-0 row">
                                    <div class="col-5" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Carteleria</h3>
                                    </div>
                                    <div class="col-1" >
                                        <a href="{{route('carteleria.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>        
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tCarteleria" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Carteleria<a href="{{route('carteleria.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-primary fa-lg mx-3"></i></a></th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Medida --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-lime p-0 row">
                                    <div class="col-5" data-card-widget="collapse" style="cursor: pointer">
                                        <h3 class="card-title pl-3">Medida</h3>
                                    </div>
                                    <div class="col-1" >
                                        <a href="{{route('medida.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tMedida" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Medida<a href="{{route('medida.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-primary fa-lg mx-3"></i></a></th>
                                                    <th>&nbsp;</th>
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
                        {{-- Material --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-teal p-0 row">
                                    <div class="col-5" dta-card-widget="collapse" style="cursor: pointer">
                                            <h3 class="card-title pl-3">Material</h3>
                                        </div>
                                        <div class="col-1" >
                                            <a href="{{route('material.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-white fa-lg mx-3"></i></a>
                                        </div>
                                        <div class="col-6">
                                            <div class="card-tools pr-3 text-right" data-card-widget="collapse" style="cursor: pointer">
                                                <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tMaterial" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Material<a href="{{route('material.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-primary fa-lg mx-3"></i></a></th>
                                                    <th>&nbsp;</th>
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

<script>
    function datasT(tabla,ruta,campo,paginas,boton,busqueda,dom){
        $(tabla).DataTable({
            'ajax': "http://grafitexlte.test/api/api/"+ruta,
            'columns': [
                { 'data': campo },
                {'data':'btn'},
            ],
            'columnDefs':[{
                targets:-1,
                render:function(data,type,row){
                    return '<div class="text-right"><a href="/auxiliares/'+campo+'/' + row['id'] + '/edit" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>'+
                        '<form action="/auxiliares/'+campo+'/' + row['id'] + '" method="POST" style="display:inline">' +
                            '<input type="hidden" name="_method" value="DELETE" />' +
                            '<input type="hidden" name="_token" value="{{ csrf_token() }}" />' +
                            '<button id="'+campo+row['id']+'" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>'+
                        '</form></div>' ;
                    }
                },
            ],
            'buttons':boton,
            'keys': false,
            'info':false,
            'searching':busqueda,
            'paging':paginas,
            'dom':dom,
        });

    }

        datasT('#tCountry','country','country',false,[],false,'lfBrtipT');
        datasT('#tArea','area','area',false,[],false,'lfBrtipT');
        datasT('#tSegmento','segmento','segmento',false,[],false,'lfBrtipT');
        datasT('#tStoreconcept','storeconcept','storeconcept',true,['excel'],true,'fBrtipT');
        datasT('#tUbicacion','ubicacion','ubicacion',false,[],false,'fBrtipT');
        datasT('#tMobiliario','mobiliario','mobiliario',true,['excel'],true,'fBrtipT');
        datasT('#tPropxelemento','propxelemento','propxelemento',true,['excel'],true,'fBrtipT');
        datasT('#tCarteleria','carteleria','carteleria',true,['excel'],true,'fBrtipT');
        datasT('#tMedida','medida','medida',true,['excel'],true,'fBrtipT');
        datasT('#tMaterial','material','material',true,['excel'],true,'fBrtipT');
    
    $(document).ready( function () {
    });

    $('#menuauxiliares').addClass('active');
    $('#navauxiliares').toggleClass('activo');
</script>
<script>@include('_partials._errortemplate')</script>
@endpush