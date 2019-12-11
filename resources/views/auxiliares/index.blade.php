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
                                <div class="card-header text-white bg-indigo p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Country</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tCountry" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Country</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                                @foreach($countries as $country)
                                                <tr>
                                                    <td>{{$country->country}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Area --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-olive p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Area</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tArea" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Area</th>
                                                    <th class="text-right"><a href="{{route('area.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-olive fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                                @foreach($areas as $area)
                                                <tr>
                                                    <td>{{$area->area}}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('area.edit',$area->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        <form action="{{route('area.destroy',$area->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button id="area{{$area->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Segmento --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-navy p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Segmento</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tSegmento" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr> 
                                                    <th>Segmento</th>
                                                    <th class="text-right"><a href="{{route('segmento.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-navy fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($segmentos as $segmento)
                                                <tr>
                                                    <td>{{$segmento->segmento}}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('segmento.edit',$segmento->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        <form action="{{route('segmento.destroy',$segmento->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button id="segmento{{$segmento->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
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
                                <div class="card-header text-white bg-purple p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Store Concept</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tStoreconcept" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Store Concept</th>
                                                    <th class="text-right" width="100px"><a href="{{route('storeconcept.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-purple fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($conceptos as $concepto)
                                                <tr>
                                                    <td>{{$concepto->storeconcept}}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('storeconcept.edit',$concepto->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        <form action="{{route('storeconcept.destroy',$concepto->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button id="storeconcept{{$concepto->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Ubicacion --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-fuchsia p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Ubicación</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tUbicacion" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Ubicación</th>
                                                    <th class="text-right" width="100px"><a href="{{route('ubicacion.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-fuchsia fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ubicaciones as $ubicacion)
                                                <tr>
                                                    <td>{{$ubicacion->ubicacion}}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('ubicacion.edit',$ubicacion->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        <form action="{{route('ubicacion.destroy',$ubicacion->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button id="ubicacion{{$ubicacion->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Mobiliario --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-pink p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Mobiliario</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tMobiliario" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Mobiliario</th>
                                                    <th class="text-right" width="100px"><a href="{{route('mobiliario.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-fuchsia fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($mobiliarios as $mobiliario)
                                                <tr>
                                                    <td>{{$mobiliario->mobiliario}}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('mobiliario.edit',$mobiliario->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        <form action="{{route('mobiliario.destroy',$mobiliario->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button id="mobiliario{{$mobiliario->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
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
                                <div class="card-header text-white bg-maroon p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Prop x Elemento</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tPropxelemento" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Prop x Elemento</th>
                                                    <th class="text-right" width="100px"><a href="{{route('propxelemento.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-maroon fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($propxelementos as $propxelemento)
                                                <tr>
                                                    <td>{{$propxelemento->propxelemento}}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('propxelemento.edit',$propxelemento->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        <form action="{{route('propxelemento.destroy',$propxelemento->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button id="propxelemento{{$propxelemento->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                        {{-- Carteleria --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-orange p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Carteleria</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tCarteleria" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Carteleria</th>
                                                    <th class="text-right" width="100px"><a href="{{route('carteleria.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-orange fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($cartelerias as $carteleria)
                                                <tr>
                                                    <td>{{$carteleria->carteleria}}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('carteleria.edit',$carteleria->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        <form action="{{route('carteleria.destroy',$carteleria->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button id="carteleria{{$carteleria->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Medida --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-lime p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Medida</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tMedida" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Medida</th>
                                                    <th class="text-right" width="100px"><a href="{{route('medida.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-lime fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($medidas as $medida)
                                                <tr>
                                                    <td>{{$medida->medida}}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('medida.edit',$medida->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        <form action="{{route('medida.destroy',$medida->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button id="medida{{$medida->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
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
                                <div class="card-header text-white bg-teal p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Material</h3>
                                    <div class="card-tools pr-3">
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tMaterial" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr>
                                                    <th>Material</th>
                                                    <th class="text-right" width="100px"><a href="{{route('material.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-teal fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($materiales as $material)
                                                <tr>
                                                    <td>{{$material->material}}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('material.edit',$material->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        <form action="{{route('material.destroy',$material->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button id="material{{$material->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
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
    // function datasT(tabla,ruta,campo,paginas,boton,busqueda,dom){
    //     $(tabla).DataTable({
    //         'ajax': "http://grafitexlte.test/api/api/"+ruta,
    //         'columns': [
    //             { 'data': campo },
    //             {'data':'btn'},
    //         ],
    //         'columnDefs':[{
    //             targets:-1,
    //             render:function(data,type,row){
    //                 return '<div class="text-right"><a href="/auxiliares/'+campo+'/' + row['id'] + '/edit" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>'+
    //                     '<form action="/auxiliares/'+campo+'/' + row['id'] + '" method="POST" style="display:inline">' +
    //                         '<input type="hidden" name="_method" value="DELETE" />' +
    //                         '<input type="hidden" name="_token" value="{{ csrf_token() }}" />' +
    //                         '<button id="'+campo+row['id']+'" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>'+
    //                     '</form></div>' ;
    //                 }
    //             },
    //         ],
    //         'buttons':boton,
    //         'keys': false,
    //         'info':false,
    //         'searching':busqueda,
    //         'paging':paginas,
    //         'dom':dom,
    //     });

    // }

        // datasT('#tCountry','country','country',false,[],false,'lfBrtipT');
        // datasT('#tarea','area','area',false,[],false,'lfBrtipT');
        // datasT('#tSegmento','segmento','segmento',false,[],false,'lfBrtipT');
        // datasT('#tStoreconcept','storeconcept','storeconcept',true,['excel'],true,'fBrtipT');
        // datasT('#tUbicacion','ubicacion','ubicacion',false,[],false,'fBrtipT');
        // datasT('#tMobiliario','mobiliario','mobiliario',true,['excel'],true,'fBrtipT');
        // datasT('#tPropxelemento','propxelemento','propxelemento',true,['excel'],true,'fBrtipT');
        // datasT('#tCarteleria','carteleria','carteleria',true,['excel'],true,'fBrtipT');
        // datasT('#tMedida','medida','medida',true,['excel'],true,'fBrtipT');
        // datasT('#tMaterial','material','material',true,['excel'],true,'fBrtipT');
    
    $(document).ready( function () {
    });

    $('#menuauxiliares').addClass('active');
    $('#navauxiliares').toggleClass('activo');
</script>
<script>@include('_partials._errortemplate')</script>
@endpush