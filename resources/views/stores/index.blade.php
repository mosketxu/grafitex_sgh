@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Stores')
@section('titlePag','Stores')
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
                        @can('store.create')
                        <a href="" role="button" data-toggle="modal" data-target="#storeCreateModal" title="Crear tienda nueva">
                            <i class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
                        </a>
                        &nbsp;&nbsp;
                        @endcan
                        @can('store.index')
                        <a href="{{route('store.adresses')}}" role="button" title="Direcciones de las tiendas">
                            <i class="fas fa-map-marker-alt fa-2x text-success mt-2"></i>
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
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        {{-- links  y cuadro busqueda --}}
                        <div class="row">
                            <div class="col-10 row">
                                {{ $stores->appends(request()->except('page'))->links() }} &nbsp; &nbsp;
                                Hay {{$stores->total()}} stores.
                            </div>
                            <div class="col-2 float-right mb-2">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table  class="table table-hover table-sm small" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <form id="formfiltro" method="GET" action="{{route('store.index') }}">
                                        {{-- <form id="formfiltro" method="GET" action="{{route('store.export') }}"> --}}
                                            <th>
                                                <select class="form-control form-control-sm select2" id="lux" name="lux[]" data-placeholder="Luxotica" multiple>
                                                    <option value="Oliver Peoples" {{ empty($lux) ? "" : (in_array("Oliver Peoples", $lux) ? "selected" : "")}}>Oliver Peoples</option> 
                                                    <option value="Ray-Ban Store" {{ empty($lux) ? "" : (in_array("Ray-Ban Store", $lux) ? "selected" : "")}}>Ray-Ban Store</option> 
                                                    <option value="Sunglass Hut" {{ empty($lux) ? "" : (in_array("Sunglass Hut", $lux) ? "selected" : "")}}>Sunglass Hut</option> 
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control form-control-sm select2" id="sto" name="sto[]" data-placeholder="stores" multiple>
                                                    @foreach ($stores as $store )
                                                        <option value="{{$store->id}}" {{ empty($sto) ? "" : (in_array($store->id, $sto) ? "selected" : "")}}>{{$store->id}}</option> 
                                                    @endforeach
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control form-control-sm select2" id="nam" name="nam[]" data-placeholder="name" multiple>
                                                    @foreach ($stores as $store )
                                                        <option value="{{$store->name}}" {{ empty($nam) ? "" : (in_array($store->name, $nam) ? "selected" : "")}}>{{$store->name}}</option> 
                                                    @endforeach
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control form-control-sm select2" id="coun" name="coun[]" data-placeholder="country" multiple>
                                                    <option value="ES" {{ empty($coun) ? "" : (in_array("ES", $coun) ? "selected" : "")}}>ES</option> 
                                                    <option value="PT" {{ empty($coun) ? "" : (in_array("PT", $coun) ? "selected" : "")}}>PT</option> 
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control form-control-sm select2" id="are" name="are[]" data-placeholder="area" multiple>
                                                    @foreach ($areas as $area )
                                                    <option value="{{$area->area}}" {{ empty($are) ? "" : (in_array($area->area, $are) ? "selected" : "")}}>{{$area->area}}</option>
                                                    @endforeach
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control form-control-sm select2" id="segmen" name="segmen[]" data-placeholder="segmento" multiple>
                                                    @foreach ($segmentos as $segmento )
                                                        <option value="{{$segmento->segmento}}" {{ empty($segmen) ? "" : (in_array($segmento->segmento, $segmen) ? "selected" : "")}}>{{$segmento->segmento}}</option> 
                                                    @endforeach
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control form-control-sm select2" id="cha" name="cha[]" data-placeholder="channel" multiple>
                                                    <option value="Airport" {{ empty($cha) ? "" : (in_array("Airport", $cha) ? "selected" : "")}}>Airport</option> 
                                                    <option value="Dpt.Store" {{ empty($cha) ? "" : (in_array("Dpt.Store", $cha) ? "selected" : "")}}>Dpt.Store</option> 
                                                    <option value="Mall" {{ empty($cha) ? "" : (in_array("Mall", $cha) ? "selected" : "")}}>Mall</option> 
                                                    <option value="Outlet" {{ empty($cha) ? "" : (in_array("Outlet", $cha) ? "selected" : "")}}>Outlet</option> 
                                                    <option value="Street" {{ empty($cha) ? "" : (in_array("Street", $cha) ? "selected" : "")}}>Street</option> 
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control form-control-sm select2" id="clu" name="clu[]" data-placeholder="cluster" multiple>
                                                    <option value="Basic">Basic</option>
                                                    <option value="ECI">ECI</option>
                                                    <option value="INLINE">INLINE</option>
                                                    <option value="OPEN AIR">OPEN AIR</option>
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control form-control-sm select2" id="conce" name="conce[]" data-placeholder="concepto" multiple>
                                                    @foreach ($conceptos as $concepto )
                                                        <option value="{{$concepto->storeconcept}}" {{ empty($conce) ? "" : (in_array($concepto->storeconcept, $conce) ? "selected" : "")}}>{{$concepto->storeconcept}}</option> 
                                                    @endforeach
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control form-control-sm select2" id="fur" name="fur[]" data-placeholder="furniture_type" multiple>
                                                    @foreach($furnitures as $furniture )
                                                    <option value="{{$furniture->furniture_type}}" {{ empty($fur) ? "" : (in_array($furniture->furniture_type, $fur) ? "selected" : "")}}>{{$furniture->furniture_type}}</option> 
                                                    @endforeach
                                                </select>
                                            </th>
                                            <td width="100px">
                                                <div class="text-center">
                                                    <button type="submit" name="submit" class=" enlace" value="filtrar"><i class="fas fa-search fa-2x text-primary"></i></button>
                                                    <a href="#!" class="btn-borrarfiltro " title="Borrar Filtros" onclick="borrarFiltros('formfiltro')"><i class="far fa-times-circle text-danger fa-2x ml-1"></i></a>
                                                    &nbsp;&nbsp;
                                                    <button type="submit" name="submit" class=" enlace" value="excel"><i class="far fa fa-file-excel text-success fa-2x mx-1"></i></button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    <tr>
                                        <th>Luxotica</th>
                                        <th>Store &nbsp; &nbsp;</th>
                                        <th>Nombre</th>
                                        <th>Country</th>
                                        <th>Area</th>
                                        <th>Segmento</th>
                                        <th>Channel</th>
                                        <th>Cluster</th>
                                        <th>Concepto</th>
                                        <th>Furniture Type</th>
                                        <th width="150px">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stores as $store)
                                    <tr data-id="{{$store->id}}">
                                        <form id="form{{$store->id}}" role="form" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" class="d-none" name="id" value="{{$store->id}}">
                                            <td>{{$store->luxotica}}</td>
                                            <td>{{$store->id}}</td>
                                            <td>{{$store->name}}</td>
                                            <td>{{$store->country}}</td>
                                            <td>{{$store->are->area}}</td>
                                            <td>{{$store->segmento}}</td>
                                            <td>{{$store->channel}}</td>
                                            <td>{{$store->store_cluster}}</td>
                                            <td>{{$store->concep->storeconcept}}</td>
                                            <td>{{$store->furniture_type}}</td>
                                            {{-- <td>
                                                <div class="row">
                                                    <div>
                                                        <input type="file" id="inputFile{{$store->id}}" name="imagen" style="display:none">
                                                        @if(file_exists( 'storage/store/'.$store->imagen ))
                                                            <img src="{{asset('storage/store/'.$store->imagen.'?'.time())}}" 
                                                                alt="{{$store->imagen}}" title="{{$store->imagen}}"
                                                                id="original{{$store->id}}"
                                                                class="img-fluid img-thumbnail" 
                                                                style="height: 50px; max-width: 200px;cursor:pointer"
                                                                onclick='document.getElementById("inputFile{{$store->id}}").click()'/>
                                                        @else
                                                            <img src="{{asset('storage/store/SGH.jpg')}}" 
                                                                alt="{{$store->imagen}}" title="{{$store->imagen}}"
                                                                class="img-fluid img-thumbnail" 
                                                                id="original{{$store->id}}"
                                                                style="height: 50px; max-width: 200px;cursor:pointer"
                                                                onclick='document.getElementById("inputFile{{$store->id}}").click()'/>
                                                        @endif       
                                                    </div>
                                                </div>
                                            </td> --}}
                                            <td width="100px">
                                                <div class="text-center">
                                                    {{-- @can('store.create')
                                                    <a href="#" class="mr-4" name="Upload" onclick="subirImagenIndex('form{{$store->id}}','{{$store->id}}')" title="Subir imagen"><i class="fas fa-upload text-info fa-2x mx-1"></i></a>
                                                    @endcan --}}

                                                    @can('store.edit')
                                                    <a href="{{ route('store.edit',$store) }}" title="Editar tienda"><i class="far fa-edit text-primary fa-2x mx-1"></i></a>
                                                    @endcan
                                                    @can('storeelementos.index')
                                                    <a href="{{ route('storeelementos.index',$store) }}" title="Elementos"><i class="far fas fa-cubes text-teal fa-2x mx-1"></i></a>
                                                    @endcan
                                                    @can('store.destroy')
                                                    <a href="#!" class="btn-delete " title="Eliminar"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></a>
                                                    @endcan
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="storeCreateModal" tabindex="-1" role="dialog" aria-labelledby="storeCreateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="storeCreateModalLabel">Nueva tienda</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('store.store') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                {{-- <input  type="hidden" class="form-control form-control-sm" id="pais" name="pais" value="si no lo pongo da error ¿¿?? algun resto de memoria"> --}}
                                <div class="row">
                                    <div class="form-group col-2">
                                        <label for="id">Store</label>
                                        <input  type="text" class="form-control form-control-sm" id="idstore" name="id" value="{{old('id')}}">
                                    </div>
                                    <div class="form-group  col-4">
                                        <label for="name">Nombre</label>
                                        <input  type="text" class="form-control form-control-sm" id="name" name="name" value="{{old('name')}}">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="country">Country</label>
                                        <select class="form-control form-control-sm" id="country" name="country" >
                                            <option value="">Selecciona</option>
                                            <option value="ES">ES</option>
                                            <option value="PT">PT</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="area">Area</label>
                                        <select class="form-control form-control-sm" id="area_id" name="area_id" >
                                            <option value="">Selecciona</option>
                                            @foreach($areas as $area )
                                            <option value="{{$area->id}}" {{old('area_id')==$area->id ? 'selected' : ''}}>{{$area->area}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-2">
                                        <label for="segmento">Segmento</label>
                                        <select class="form-control form-control-sm" id="segmento" name="segmento" >
                                            <option value="">Selecciona</option>
                                            @foreach($segmentos as $segmento )
                                            <option value="{{$segmento->segmento}}" {{old('segmento')==$segmento->segmento ? 'selected' : ''}}>{{$segmento->segmento}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="concepto">Concepto</label>
                                        <select class="form-control form-control-sm" id="concepto_id" name="concepto_id" >
                                            <option value="">Selecciona</option>
                                            @foreach($conceptos as $concepto )
                                            <option value="{{$concepto->id}}" {{old('concepto_id')==$concepto->id ? 'selected' : ''}}>{{$concepto->storeconcept}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="imagen">Imagen</label>
                                        <input  type="file" class="form-control form-control-sm m-0 p-0" id="imagen" name="imagen" value="{{old('imagen')}}">
                                    </div>
                                </div>
                                <div class="form-group m-0 p-0">
                                        <label for="observaciones">Observaciones</label>
                                        <input  type="text" class="form-control form-control-sm" id="observaciones" name="observaciones" value="{{old('observaciones')}}">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                @can('store.create')
                                <button type="button" class="btn btn-primary" name="Guardar" onclick="form.submit()">Guardar</button>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <form id="formDelete" action="{{route('store.destroy',':ELEMENTO_ID')}}" method="POST" style="display:inline">
                <input type="hidden" name="_method" value="DELETE" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                {{-- <button type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button> --}}
            </form>
        </section>
    </div>


@endsection

@push('scriptchosen')

<script>
    @include('_partials._errortemplate')
</script>
    
<script>
    $(document).ready( function () {
        $('.btn-delete ').click(function(){
           
            $confirmacion=confirm('¿Seguro que lo quieres eliminar?');

            if($confirmacion){
                var row= $(this).parents('tr');
                var id=row.data('id');
                var form=$('#formDelete');
                var url=form.attr('action').replace(':ELEMENTO_ID',id);
                var data=form.serialize();

                $.post(url,data,function(result){
                    toastr.options={
                        progressBar:true,
                        positionClass:"toast-top-center"
                    };
                    toastr.success(result.notificacion.message);
                    row.fadeOut();
                }).fail(function(){
                    toastr.options={
                        closeButton: true,
                        progressBar:true,
                        positionClass:"toast-top-center",
                        showDuration: "300",
                        hideDuration: "1000",
                        timeOut: 0,
                    };
                    toastr.error("No se puede eliminar.");
                });
            }
        });
    });

    function borrarFiltros(form){
        $("#lux").html('');   
        $("#sto").html('');   
        $("#nam").html('');   
        $("#coun").html('');   
        $("#idi").html('');   
        $("#are").html('');   
        $("#segmen").html('');   
        $("#cha").html('');   
        $("#clu").html('');   
        $("#conce").html('');   
        $("#fur").html('');   
    }

    function subirImagenIndex(formulario,imagenId){
        var token= $('#token').val();
        let timestamp = Math.floor( Date.now() );
        $.ajaxSetup({
            headers: { "X-CSRF-TOKEN": $('#token').val() },
        });
        
        var formElement = document.getElementById(formulario);
        var formData = new FormData(formElement);
        formData.append("imagenId", imagenId);
        
        $.ajax({
            type:'POST',
            url: "{{ route('store.updateimagenindex') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                $('#'+formulario +' img').remove();
                $('#original'+imagenId).attr('src', '/storage/store/'+ data.imagen+'?ver=' + timestamp);
                $('#imagen'+imagenId).html(data.imagen);
                toastr.info('Imagen actualizada con éxito','Imagen',{
                    "progressBar":true,
                    "positionClass":"toast-top-center"
                });
            },
            error: function(data){
                console.log(data);
                toastr.error("No se ha actualizado la imagen.<br>"+ data.responseJSON.message,'Error actualización',{
                    "closeButton": true,
                    "progressBar":true,
                    "positionClass":"toast-top-center",
                    "options.escapeHtml" : true,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": 0,
                });
            }
        }); 
    }

    $('.select2').select2();


    $('#menustores').addClass('active');
    $('#navcampaigns').toggleClass('activo');

</script>

@endpush

