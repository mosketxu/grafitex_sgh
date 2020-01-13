@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Presupuestos')
@section('titlePag','Presupuesto')
@section('navbar')
@include('campaign._navbarcampaign')
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
                    @can('presupuesto.create')
                    <a href="" role="button" data-toggle="modal" data-target="#campaignPresupuestoCreateModal">
                        <i class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
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
                    <div class="table-responsive">
                        <table id="tpresupuesto" class="table table-hover table-sm small sortable" cellspacing="0"
                            width=100%>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Referencia</th>
                                    <th>Versión</th>
                                    <th>Fecha Presupuesto</th>
                                    <th>A la Atención</th>
                                    <th>Total</th>
                                    <th>Observaciones</th>
                                    <th class="text-right">Estado</th>
                                    <th class="text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach($presupuestos as $presupuesto)
                                <tr id="t{{$presupuesto->id}}">
                                    <td>{{$presupuesto->id}}</td>
                                    <td>{{$presupuesto->referencia}}</td>
                                    <td>{{$presupuesto->version}}</td>
                                    <td>{{$presupuesto->fecha}}</td>
                                    <td>{{$presupuesto->atencion}}</td>
                                    <td>{{$presupuesto->total}}</td>
                                    <td>{{$presupuesto->observaciones}}</td>
                                    
                                    <td>
                                        <div class="text-right">
                                            @if($presupuesto->estado==="Creado")
                                            <i class="fas fa-circle text-primary fa-lg"></i>
                                            @elseif($presupuesto->estado==="Iniciado")
                                            <i class="fas fa-circle text-teal fa-lg"></i>
                                            @elseif($presupuesto->estado==="Finalizado")
                                            <i class="fas fa-circle text-fuchsia fa-lg"></i>
                                            @else
                                            <i class="fas fa-circle text-warning fa-lg"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-right">
                                            <form action="#" method="post">
                                                <input type="hidden" name="_tokenPresupuesto" value="{{ csrf_token()}}"
                                                    id="tokenPresupuesto">
                                                @csrf
                                                @method('DELETE')
                                                @can('presupuesto.edit')
                                                <a href="{{route('campaign.presupuesto.edit', $presupuesto->id )}}"
                                                    title="Edit"><i class="far fa-edit text-primary fa-2x mx-1"></i></a>
                                                @endcan
                                                @can('presupuesto.index')
                                                <a href="{{route('campaign.presupuesto.cotizacion', $presupuesto->id )}}"
                                                    title="Cotización"><i class="fas fa-calculator  text-primary fa-2x mx-1"></i></a>
                                                @endcan
                                                @can('presupuesto.destroy')
                                                <a href="#" onclick="borrarPresupuesto({{$presupuesto->id}},'campaign.presupuesto.delete','#tokenPresupuesto')" title="Eliminar">
                                                    <i class="far fa-trash-alt text-danger fa-2x ml-1"></i>
                                                </a>
                                                @endcan
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Crear-->
        <div class="modal fade" id="campaignPresupuestoCreateModal" tabindex="-1" role="dialog"
            aria-labelledby="campaignPresupuestoCreateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="campaignPresupuestoCreateModalLabel">Nuevo Presupuesto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('campaign.presupuesto.store') }}">
                            @csrf
                            <input type="hidden" id="campaign_id" name="campaign_id" value="{{ $campaign->id }}" />
                            <input type="hidden" id="estado" name="estado" value="creado" />
                            <div class="row">
                                <div class="form-group col">
                                    <label for="referencia">Referencia</label>
                                    <input type="text" class="form-control form-control-sm" id="referencia"
                                        name="referencia" value="{{ old('referencia') }}" />
                                </div>
                                <div class="form-group col">
                                    <label for="version">Versión</label>
                                    <input type="number" class="form-control form-control-sm" id="version"
                                        name="version" step="0.1" value="{{ old('version','1.0')}}" />
                                </div>
                                <div class="form-group col">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha"
                                        value="{{ old('fecha',date('Y-m-d')) }}" />
                                </div>
                                <div class="form-group col">
                                    <label for="atención">A la atención</label>
                                    <input type="text" class="form-control form-control-sm" id="atencion"
                                        name="atencion" value="{{ old('atención') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="observaciones">Observaciones</label>
                                    <input type="memo" class="form-control form-control-sm" id="observaciones"
                                        name="observaciones" value="{{ old('atención') }}" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" name="Guardar"
                                    onclick="form.submit()">Guardar</button>
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

<script src="{{ asset('js/sortTable.js')}}"></script>

<script>
    $(document).ready( function () {
        $('#menucampaign').addClass('active');
        $('#navpresupuesto').toggleClass('activo');
    });
</script>

<script>
    @include('_partials._errortemplate')
</script>

<script>
    function borrarPresupuesto(presupuestoId,ruta,tok) { 
        var token = $(tok).val();
        var route = ruta;
        route= '/campaign/presupuesto/delete/'+presupuestoId;

        var mensaje;
        var opcion = confirm("¿Estás seguro?");

        if (opcion == true) {
            $.ajax({
                url: route,
                headers: { "X-CSRF-TOKEN": token },
                type: "DELETE",
                dataType: "json",
                data: { 
                    "presupuestoId": presupuestoId,
                    "_method":'DELETE',
                },
                success: function(data) {
                    $('#t'+presupuestoId).remove();
                    // toastr.success("{{ Session::get('message') }}")
                    toastr.success('Presupuesto borrado con éxito',{
                        "progressBar":true,
                        "positionClass":"toast-top-center"
                    });
                },
                error:function(msj){
                        console.log(msj.responseJSON.errors);
                        toastr.error("Ha habido un error. <br />No se ha podido borrar. <br />"+ msj.responseJSON.message,{
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
    }

</script>
@endpush