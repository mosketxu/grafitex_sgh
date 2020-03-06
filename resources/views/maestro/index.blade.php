@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Maestro')
@section('titlePag','Maestro')
@section('navbar')
    @include('_partials._navbar')
@endsection


@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('campaign') }} --}}
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
                        @can('maestro.create')
                        {{-- <a href="" role="button" data-toggle="modal" data-target="#importMaestro" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
                            <span class="badge badge-primary">Fichero Grafitex</span>
                        </a>
                        &nbsp;&nbsp;
                        <a href="" role="button" data-toggle="modal" data-target="#actualizaTablas" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-sync-alt fa-2x text-primary mt-2"></i>
                            <span class="badge badge-primary">Actualizar tablas Grafitex</span>
                        </a> --}}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="" role="button" data-toggle="modal" data-target="#importMaestroSHG" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-plus-circle fa-2x text-success mt-2"></i>
                            <span class="badge badge-success">Fichero SGH</span>
                        </a>
                        &nbsp;&nbsp;
                        <a href="" role="button" data-toggle="modal" data-target="#actualizaTablasSGH" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-sync-alt fa-2x text-success mt-2"></i>
                            <span class="badge badge-success">Actualizar tablas SGH</span>
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="" role="button" data-toggle="modal" data-target="#actualizaTiendas" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-sync-alt fa-2x text-warning mt-2"></i>
                            <span class="badge badge-warning">Actualizar tiendas</span>
                        </a>
                        &nbsp;&nbsp;
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
        {{-- main content  --}}
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        {{-- links  y cuadro busqueda --}}
                        <div class="row">
                            <div class="col-10 row">
                                {{$maestros->appends(request()->except('page'))->links() }} &nbsp; &nbsp;
                                Hay {{$maestros->total()}} registros
                            </div>
                            <div class="col-2 float-right mb-2">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tMaestro" class="table table-hover table-sm small sortable" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <form method="GET" action="{{route('maestro.index') }}">
                                            <th><input id="sto" name="sto" type="text" class="form-control form-control-sm" value='{{$sto}}' placeholder="Filtro Store"/></th>
                                            <th><input id="nam" name="nam" type="text" class="form-control form-control-sm" value='{{$nam}}' placeholder="Filtro Name"/></th>
                                            <th><input id="coun" name="coun" type="text" class="form-control form-control-sm" value='{{$coun}}' placeholder="Filtro country"/></th>
                                            <th><input id="are" name="are" type="text" class="form-control form-control-sm" value='{{$are}}' placeholder="Filtro Area"/></th>
                                            <th><input id="seg" name="seg" type="text" class="form-control form-control-sm" value='{{$seg}}' placeholder="Filtro Segmento"/></th>
                                            <th><input id="cha" name="cha" type="text" class="form-control form-control-sm" value='{{$cha}}' placeholder="Filtro Channel"/></th>
                                            <th><input id="clu" name="clu" type="text" class="form-control form-control-sm" value='{{$clu}}' placeholder="Filtro Cluster"/></th>
                                            <th><input id="conce" name="conce" type="text" class="form-control form-control-sm" value='{{$conce}}' placeholder="Filtro Concept"/></th>
                                            <th><input id="fur" name="fur" type="text" class="form-control form-control-sm" value='{{$fur}}' placeholder="Filtro Furniture"/></th>
                                            <th><input id="ubi" name="ubi" type="text" class="form-control form-control-sm" value='{{$ubi}}' placeholder="Filtro Ubicación"/></th>
                                            <th><input id="mob" name="mob" type="text" class="form-control  form-control-sm" value='{{$mob}}'  placeholder="Filtro Mobiliario"/></th>
                                            <th><input id="propx" name="propx" type="text" class="form-control  form-control-sm" value='{{$propx}}'  placeholder="Filtro Prop x Elem"/></th>
                                            <th><input id="cart" name="cart" type="text" class="form-control  form-control-sm" value='{{$cart}}'  placeholder="Filtro Carteleria"/></th>
                                            <th><input id="med" name="med" type="text" class="form-control  form-control-sm" value='{{$med}}'  placeholder="Filtro Medida"/></th>
                                            <th><input id="mat" name="mat" type="text" class="form-control  form-control-sm" value='{{$mat}}'  placeholder="Filtro Material"/></th>
                                            <th width="100px">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="submit" class="form-control  form-control-sm enlace" name="Filtra"><i class="fas fa-search fa-lg text-primary"></i></button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" class="form-control  form-control-sm enlace" name="Borrar Filtros" onclick="borrarFiltros()"><i class="far fa-times-circle fa-lg text-danger"></i></button>
                                                    </div>
                                                </div>
                                            </th>
                                            <th></th>
                                        </form>
                                    </tr>
                                    <tr>
                                        <th>Store</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>Area</th>
                                        <th>Segmento</th>
                                        <th>Channel</th>
                                        <th>Cluster</th>
                                        <th>Storeconcept</th>
                                        <th>Furniture Type</th>
                                        <th>Ubicacion</th>
                                        <th>Mobiliario</th>
                                        <th>Propxelemento</th>
                                        <th>Carteleria</th>
                                        <th>Medida</th>
                                        <th>Material</th>
                                        <th>Unitxprop</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($maestros as $maestro)
                                    <tr>
                                        <td>{{$maestro->store}}</td>
                                        <td>{{$maestro->name}}</td>
                                        <td>{{$maestro->country}}</td>
                                        <td>{{$maestro->area}}</td>
                                        <td>{{$maestro->segmento}}</td>
                                        <td>{{$maestro->channel}}</td>
                                        <td>{{$maestro->store_cluster}}</td>
                                        <td>{{$maestro->storeconcept}}</td>
                                        <td>{{$maestro->furniture_type}}</td>
                                        <td>{{$maestro->ubicacion}}</td>
                                        <td>{{$maestro->mobiliario}}</td>
                                        <td>{{$maestro->propxmaestro}}</td>
                                        <td>{{$maestro->carteleria}}</td>
                                        <td>{{$maestro->medida}}</td>
                                        <td>{{$maestro->material}}</td>
                                        <td>{{$maestro->unitxprop}}</td>
                                        <td>{{$maestro->observaciones}}</td>
                                    </tr>
                                    </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Maestro Grafitex-->
            <div class="modal fade" id="importMaestro" tabindex="-1" role="dialog" aria-labelledby="importMaestroLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importMaestroLabel">Nueva importacion de maestro modificado Grafitex</h5>
                        </div>
                        <div class="modal-body">
                            <form id="formulario" role="form" method="post" action="{{ route('maestro.import','Grafitex') }}" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="campaign_initdate">Fichero</label>
                                        <input type="file" class="form-control form-control-sm" id="maestro" name="maestro" value=""/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary modalSubir" data-dismiss="modal">Cerrar</button>
                                    @can('maestro.create')
                                    <button type="button" class="btn btn-primary modalSubir" name="Guardar" onclick="subirfichero('#formulario')">Subir Maestro Grafitex</button>
                                    @endcan
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Maestro SGH-->
            <div class="modal fade" id="importMaestroSHG" tabindex="-1" role="dialog" aria-labelledby="importMaestroSHGLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importMaestroSHGLabel">Nueva importacion de maestro original SGH</h5>
                        </div>
                        <div class="modal-body">
                            <form id="formularioSGH" role="form" method="post" action="{{ route('maestro.import','SGH') }}" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="campaign_initdate">Fichero</label>
                                        <input type="file" class="form-control form-control-sm" id="maestro" name="maestro" value=""/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary modalSubir" data-dismiss="modal">Cerrar</button>
                                    @can('maestro.create')
                                    <button type="button" class="btn btn-success modalSubir" name="Guardar" onclick="subirfichero('#formularioSGH')">Subir Maestro SGH</button>
                                    @endcan
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Actualiza tablas-->
            <div class="modal fade" id="actualizaTablas" tabindex="-1" role="dialog" aria-labelledby="actualizaTablasLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importMaestroLabel">Actualiza las tablas principales con fichero Grafitex</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="campaign_initdate">Pulse actualizar para continuar</label>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary modalSubir" data-dismiss="modal">Cerrar</button>
                                @can('maestro.create')
                                <form id="formularioAct" role="form" method="get" action="{{ route('maestro.actualizatablas','Grafitex') }}">
                                    @csrf
                                    <button type="button" class="btn btn-primary modalSubir" name="Guardar" onclick="actualizaTablas('#formularioAct')">Actualizar con fichero Grafitex</button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Actualiza tablas SGH-->
            <div class="modal fade" id="actualizaTablasSGH" tabindex="-1" role="dialog" aria-labelledby="actualizaTablasSGHLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importMaestroSGHLabel">Actualiza las tablas principales con fichero SGH</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="campaign_initdate">Pulse actualizar para continuar</label>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary modalSubir" data-dismiss="modal">Cerrar</button>
                                @can('maestro.create')
                                <form id="formularioActSGH" role="form" method="get" action="{{ route('maestro.actualizatablas','SGH') }}">
                                    @csrf
                                    <button type="button" class="btn btn-success modalSubir" name="Guardar" onclick="actualizaTablas('#formularioActSGH')">Actualizar con fichero SGH</button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Actualiza tiendas-->
            <div class="modal fade" id="actualizaTiendas" tabindex="-1" role="dialog" aria-labelledby="actualizaTiendasLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="actualizaTiendasLabel">Actualiza datos de las tiendas: direcciones, email,...</h5>
                        </div>
                        <div class="modal-body">
                            <form id="formActTienda" role="form" method="post" action="{{ route('store.updatetiendas') }}" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="campaign_initdate">Fichero</label>
                                        <input type="file" class="form-control form-control-sm" id="maestro" name="maestro" value=""/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary modalSubir" data-dismiss="modal">Cerrar</button>
                                    @can('maestro.create')
                                    <button type="button" class="btn btn-warning modalSubir" name="Guardar" onclick="subirfichero('#formActTienda')">Actualizar Datos Tiendas</button>
                                    @endcan
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
    // @include('_partials._errortemplate')
    @if(Session::has('message'))
        toastr.options={
                progressBar:true,
                positionClass:"toast-top-center"
            };
        toastr.success("{{ Session::get('message') }}");
    @endif
    @if(session('error'))
        toastr.options={
                closeButton: true,
                progressBar:true,
                positionClass:"toast-top-center",
                showDuration: "300",
                hideDuration: "1000",
                timeOut: 0,
        };
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>
        
<script>
    function subirfichero(form){
        $('.modalSubir').attr('disabled',true);
        $(form).submit();
    }

    function actualizaTablas(form){
        $('.modalSubir').attr('disabled',true);
        $(form).submit();
    }

    function borrarFiltros(){
            $("#sto").val('');   
            $("#nam").val('');   
            $("#coun").val('');   
            $("#are").val('');   
            $("#seg").val('');   
            $("#conce").val('');   
            $("#ubi").val('');   
            $("#mob").val('');   
            $("#propx").val(''); 
            $("#cart").val('');  
            $("#med").val('');
            $("#mat").val('');
        }

    $(document).ready( function () {
        $('#menumaestro').toggleClass('activo');
        // $('#navmaestro').toggleClass('activo');
    });
</script>
@endpush

