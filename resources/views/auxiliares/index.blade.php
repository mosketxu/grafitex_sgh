@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Estadísticas Auxiliares')
@section('titlePag','Tablas auxiliares')
@section('navbar')
    @include('_partials._navbar')
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
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{ $areas->onEachSide(2)->links() }} &nbsp; &nbsp;
                                        <span class="badge">{{$areas->total()}}</span>
                                    </div>
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
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('area.edit',$area->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('area.destroy',$area->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.destroy')
                                                            <button id="area{{$area->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
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
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('segmento.edit',$segmento->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('segmento.destroy',$segmento->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.destroy')
                                                            <button id="segmento{{$segmento->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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
                        {{-- Furniture Type --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-warning p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Furniture Type</h3>
                                    <div class="card-tools pr-3">
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tfurniture" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                            <thead>
                                                <tr> 
                                                    <th>Furniture Type</th>
                                                    <th class="text-right"><a href="{{route('furniture.create') }}" title="Nuevo"><i class="fas fa-plus-circle text-warning fa-2x mx-3"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($furnitures as $furniture)
                                                <tr>
                                                    <td>{{$furniture->furniture_type}}</td>
                                                    <td class="text-right">
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('furniture.edit',$furniture->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('furniture.destroy',$furniture->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.destroy')
                                                            <button id="furniture{{$furniture->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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

                        {{-- Store Concept --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-purple p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Store Concept</h3>
                                    <div class="card-tools pr-3">
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{ $conceptos->onEachSide(2)->links() }} &nbsp; &nbsp;
                                        <span class="badge">{{$conceptos->total()}}</span>
                                    </div>
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
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('storeconcept.edit',$concepto->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('storeconcept.destroy',$concepto->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.destroy')
                                                            <button id="storeconcept{{$concepto->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
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
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('ubicacion.edit',$ubicacion->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('ubicacion.destroy',$ubicacion->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.destroy')
                                                            <button id="ubicacion{{$ubicacion->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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
                        {{-- Mobiliario --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-pink p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Mobiliario</h3>
                                    <div class="card-tools pr-3">
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- links --}}
                                    <div class="row">
                                            {{ $mobiliarios->onEachSide(2)->links() }} &nbsp; &nbsp;
                                            <span class="badge">{{$mobiliarios->total()}}</span>
                                    </div>
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
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('mobiliario.edit',$mobiliario->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('mobiliario.destroy',$mobiliario->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.edit')
                                                            <button id="mobiliario{{$mobiliario->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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
                        {{-- Propxelemento --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-maroon p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Prop x Elemento</h3>
                                    <div class="card-tools pr-3">
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{ $propxelementos->onEachSide(2)->links() }} &nbsp; &nbsp;
                                        <span class="badge">{{$propxelementos->total()}}</span>
                                    </div>
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
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('propxelemento.edit',$propxelemento->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('propxelemento.destroy',$propxelemento->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.destroy')
                                                            <button id="propxelemento{{$propxelemento->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{ $cartelerias->onEachSide(2)->links() }} &nbsp; &nbsp;
                                        <span class="badge">{{$cartelerias->total()}}</span>
                                    </div>
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
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('carteleria.edit',$carteleria->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('carteleria.destroy',$carteleria->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.destroy')
                                                            <button id="carteleria{{$carteleria->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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
                        {{-- Medida --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-lime p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Medida</h3>
                                    <div class="card-tools pr-3">
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{ $medidas->onEachSide(2)->links() }} &nbsp; &nbsp;
                                        <span class="badge">{{$medidas->total()}}</span>
                                    </div>
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
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('medida.edit',$medida->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('medida.destroy',$medida->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.destroy')
                                                            <button id="medida{{$medida->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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
                        {{-- Material --}}
                        <div class="col-4">
                            <div class="card collapsed-card mx-1">
                                <div class="card-header text-white bg-teal p-0" data-card-widget="collapse" style="cursor: pointer">
                                    <h3 class="card-title pl-3">Material</h3>
                                    <div class="card-tools pr-3">
                                        @can('auxiliares.create')
                                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{ $materiales->onEachSide(2)->links() }} &nbsp; &nbsp;
                                        <span class="badge">{{$materiales->total()}}</span>
                                    </div>
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
                                                        @can('auxiliares.edit')
                                                        <a href="{{route('material.edit',$material->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                        @endcan
                                                        <form action="{{route('material.destroy',$material->id)}}" method="POST" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            @can('auxiliares.destroy')
                                                            <button id="material{{$material->id}}" type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                                            @endcan
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

<script>
    $(document).ready( function () {
    });

    $('#menuauxiliares').addClass('active');
    $('#navauxiliares').toggleClass('activo');
</script>
<script>@include('_partials._errortemplate')</script>
@endpush