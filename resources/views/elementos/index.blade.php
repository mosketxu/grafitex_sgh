@extends('layouts.grafitex') 

@section('styles')
@endsection

@section('title','Grafitex-Elementos')
@section('titlePag','Elementos')
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
                        @can('elemento.create')
                        <a href="" role="button" data-toggle="modal" data-target="#elementoCreateModal">
                            <i class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
                        </a>
                        @endcan
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
                                {{ $elementos->appends(request()->except('page'))->links() }} &nbsp; &nbsp;
                                Hay {{$elementos->total()}} elementos.
                            </div>
                            <div class="col-2 float-right mb-2">
                                <form method="GET" action="{{route('elemento.index') }}">
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
                                        <th>#</th>
                                        <th>Ubicación</th>
                                        <th>Mobiliario</th>
                                        <th>Prop x Elemento</th>
                                        <th>Carteleria</th>
                                        <th>Medida</th>
                                        <th>Material</th>
                                        <th>Familia</th>
                                        <th  class="text-center">Unit x Prop</th>
                                        <th>Observaciones</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($elementos as $elemento)
                                    <tr data-id="{{$elemento->id}}">
                                            <td>{{$elemento->id}}</td>
                                            <td>{{$elemento->ubica->ubicacion}}</td>
                                            <td>{{$elemento->mobi->mobiliario}}</td>
                                            <td>{{$elemento->propx->propxelemento}}</td>
                                            <td>{{$elemento->carte->carteleria}}</td>
                                            <td>{{$elemento->medi->medida}}</td>
                                            <td>{{$elemento->mater->material}}</td>
                                            <td>{{$elemento->famil->familia}}</td>
                                            <td  class="text-center">{{$elemento->unitxprop}}</td>
                                            <td>{{$elemento->observaciones}}</td>
                                            <td  width="100px">
                                                <div class="text-center">
                                                    @can('elemento.edit')
                                                    <a href="{{route('elemento.edit',$elemento->id)}}" title="Editar"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
                                                    @endcan
                                                    @can('elemento.destroy')
                                                    <a href="#!" class="btn-delete " title="Eliminar"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></a>
                                                    @endcan
                                                </div>
                                             </td>
                                         {{-- </form> --}}
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="elementoCreateModal" tabindex="-1" role="dialog" aria-labelledby="elementoCreateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="elementoCreateModalLabel">Nuevo elemento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('elemento.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-2">
                                            <label for="ubicacion_id">Ubicación</label>
                                            <select class="form-control form-control-sm" id="ubicacion_id" name="ubicacion_id">
                                                <option value="">Selecciona</option>
                                                @foreach($ubicaciones as $ubicacion )
                                                <option value="{{$ubicacion->id}}" {{old('ubicacion_id')==$ubicacion->id ? 'selected' : ''}}>{{$ubicacion->ubicacion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group  col-4">
                                            <label for="mobiliario_id">Mobiliario</label>
                                            <select class="form-control form-control-sm" id="mobiliario_id" name="mobiliario_id" >
                                                <option value="">Selecciona</option>
                                                @foreach($mobiliarios as $mobiliario )
                                                <option value="{{$mobiliario->id}}" {{old('mobiliario_id')==$mobiliario->id ? 'selected' : ''}}>{{$mobiliario->mobiliario}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="propxelemento_id">Prop x Elemento</label>
                                            <select class="form-control form-control-sm" id="propxelemento_id" name="propxelemento_id" >
                                                <option value="">Selecciona</option>
                                                @foreach($propxelementos as $propxelemento )
                                                <option value="{{$propxelemento->id}}" {{old('propxelemento_id')==$propxelemento->id ? 'selected' : ''}}>{{$propxelemento->propxelemento}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group  col-3">
                                            <label for="carteleria_id">Carteleria</label>
                                            <select class="form-control form-control-sm" id="carteleria_id" name="carteleria_id" >
                                                <option value="">Selecciona</option>
                                                @foreach($cartelerias as $carteleria )
                                                <option value="{{$carteleria->id}}" {{old('carteleria_id')==$carteleria->id ? 'selected' : ''}}>{{$carteleria->carteleria}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-3">
                                            <label for="medida_id">Medida</label>
                                            <select class="form-control form-control-sm" id="medida_id" name="medida_id" >
                                                <option value="">Selecciona</option>
                                                @foreach($medidas as $medida )
                                                <option value="{{$medida->id}}" {{old('medida_id')==$medida->id ? 'selected' : ''}}>{{$medida->medida}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group  col-3">
                                            <label for="material_id">Material</label>
                                            <select class="form-control form-control-sm" id="material_id" name="material_id" >
                                                <option value="">Selecciona</option>
                                                @foreach($materiales as $material )
                                                <option value="{{$material->id}}" {{old('material_id')==$material->id ? 'selected' : ''}}>{{$material->material}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group  col-3">
                                            <label for="unitxprop">Uds</label>
                                            <select class="form-control form-control-sm" id="unitxprop" name="unitxprop" >
                                                <option value="">Selecciona</option>
                                                @for($i = 1; $i<20; $i++)
                                                <option value="{{$i}}" {{old('unitxprop')==$i ? 'selected' : ''}}>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group  col-3">
                                            <label for="material_id">Familia</label>
                                            <select class="form-control form-control-sm" id="familia_id" name="familia_id" >
                                                <option value="">Selecciona</option>
                                                @foreach($familias as $familia )
                                                <option value="{{$familia->id}}" {{old('familia_id')==$familia->id ? 'selected' : ''}}>{{$familia->familia}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <input  type="text" class="form-control form-control-sm" id="observaciones" name="observaciones" value="{{old('observaciones')}}">
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    @can('elemento.edit')
                                    <button type="button" class="btn btn-primary" name="Guardar" onclick="form.submit()">Guardar</button>
                                    @endcan
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <form id="formDelete" action="{{route('elemento.destroy',':ELEMENTO_ID')}}" method="POST" style="display:inline">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            {{-- <button type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button> --}}
    </form>

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
                    toastr.error("Este elemento está en Stores. No se puede eliminar.");
                });
            }
        });
    });

    $('#menuelementos').addClass('active');
    $('#navcampaigns').toggleClass('activo');

</script>

@endpush

