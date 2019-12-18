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
                        <a href="" role="button" data-toggle="modal" data-target="#storeCreateModal">
                            <i class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
                        </a>
                        {{-- <a href="{{route('elemento.create')}}" role="button">
                            <i class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
                        </a> --}}
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
                                {{ $stores->links() }} &nbsp; &nbsp;
                                Hay {{$stores->total()}} stores.
                            </div>
                            <div class="col-2 float-right mb-2">
                                <form method="GET" action="{{route('store.index') }}">
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
                            <table  class="table table-hover table-sm small" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th>Store</th>
                                        <th>Nombre</th>
                                        <th>Country</th>
                                        <th>Area</th>
                                        <th>Segmento</th>
                                        <th>Concepto</th>
                                        <th>Observaciones</th>
                                        <th width="200px"></th>
                                        <th width="150px">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stores as $store)
                                    <tr data-id="{{$store->id}}">
                                        <form id="form{{$store->id}}" role="form" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                                        {{-- <form id="form{{$store->id}}" role="form" method="post" action="{{ route('store.updateimagenindex') }}" enctype="multipart/form-data"> --}}
                                            @csrf
                                            <input type="text" class="d-none" id="id" name="id" value="{{$store->id}}">
                                            <td>{{$store->id}}</td>
                                            <td>{{$store->name}}</td>
                                            <td>{{$store->country}}</td>
                                            <td>{{$store->are->area}}</td>
                                            <td>{{$store->segmento}}</td>
                                            <td>{{$store->concep->storeconcept}}</td>
                                            <td>{{$store->observaciones}}</td>
                                            <td>
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
                                                    <div>
                                                        <a href="#" name="Upload" onclick="subirImagenIndex('form{{$store->id}}','{{$store->id}}')"><i class="fas fa-upload text-info fa-2x mx-1"></i></a>
                                                        {{-- <button type="submit"><i class="fas fa-upload text-primary fa-lg mx-1"></i></a> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="100px">
                                                <div class="text-center">
                                                <a href="{{ route('store.edit',$store) }}" title="Edit"><i class="far fa-edit text-primary fa-2x mx-1"></i></a>
                                                <a href="{{ route('storeelementos.index',$store->id) }}" title="Elementos"><i class="far fas fa-cubes text-teal fa-2x mx-1"></i></a>
                                                <a href="#!" class="btn-delete " title="Eliminar"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></a>
                                            </div>
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
                                        <input  type="text" class="form-control form-control-sm" id="id" name="id" value="{{old('id')}}">
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
                                            <option value="{{$segmento->id}}" {{old('segmento')==$segmento->id ? 'selected' : ''}}>{{$segmento->segmento}}</option>
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
                                <button type="button" class="btn btn-primary" name="Guardar" onclick="form.submit()">Guardar</button>
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


    $('#menustores').addClass('active');
    $('#navcampaigns').toggleClass('activo');

</script>

@endpush

