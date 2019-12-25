@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Campañas')
@section('titlePag','Campañas')
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
                        @can('campaign.create')
                        <a href="" role="button" data-toggle="modal" data-target="#campaignCreateModal">
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
                    <div class="card-body">
                        {{-- links  y cuadro busqueda --}}
                        <div class="row">
                            <div class="col-10 row">
                                {{ $campaigns->links() }} &nbsp; &nbsp;
                                Hay {{$campaigns->total()}} campañas.
                            </div>
                            <div class="col-2 float-right mb-2">
                                <form method="GET" action="{{route('campaign.index') }}">
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
                            <table id="tCampaigns" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Campaña</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin Prevista</th>
                                        <th>Estado</th>
                                        <th width="400px"></th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($campaigns as $campaign)
                                    <tr data-id="{{$campaign->id}}">
                                        <form id="form{{$campaign->id}}" role="form" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                                        @csrf
                                            <input type="text" class="d-none" id="id" name="id" value="{{$campaign->id}}">
                                            <td>{{$campaign->id}}</td>
                                            <td>{{$campaign->campaign_name}}</td>
                                            <td>{{$campaign->campaign_initdate}}</td>
                                            <td>{{$campaign->campaign_enddate}}</td>
                                            <td>{{$campaign->campaign_state}}</td>
                                            <td>
                                                @can('campaign.edit')
                                                <a href="{{route('campaign.filtrar', $campaign->id) }}" title="Filtrar"><i class="fas fa-filter text-navy fa-2x mx-1"></i></a>
                                                @endcan
                                                @can('campaign.index')
                                                <a href="{{route('campaign.elementos', $campaign->id ) }}" title="Elementos"><i class="far fas fa-cubes text-teal fa-2x mr-1"></i></a>
                                                @endcan
                                                @can('campaign.index')
                                                <a href="{{route('campaign.galeria', $campaign->id ) }}" title="Galeria"><i class="far fa-images text-purple fa-2x mr-1"></i></a>
                                                @endcan
                                                @can('campaign.index')
                                                <a href="{{route('campaign.etiquetas.pdf', $campaign->id ) }}" title="Etiquetas"><i class="fas fa-tags text-maroon fa-2x mr-1"></i></a>
                                                @endcan
                                                @can('campaign.index')
                                                <a href="{{route('campaign.etiquetas.index',$campaign->id) }}" title="Etiquetas HTML"><i class="fas fa-code text-indigo fa-2x mr-1"></i></a>
                                                @endcan
                                                @can('presupuesto.index')
                                                <a href="{{route('campaign.presupuesto', $campaign->id ) }}" title="Presupuesto"><i class="fas fa-money-check-alt text-fuchsia fa-2x mr-1"></i></a>
                                                @endcan
                                                @can('campaign.index')
                                                <a href="{{route('campaign.conteo', $campaign->id ) }}" title="Estadísticas"><i class="fas fa-chart-bar text-orange fa-2x mr-3"></i></a>
                                                @endcan
                                                @can('campaign.edit')
                                                <a href="{{route('campaign.edit', $campaign->id )}}" title="Edit"><i class="far fa-edit text-primary fa-2x ml-3"></i></a>
                                                @endcan
                                                @can('campaign.destroy')
                                                <a href="#!" class="btn-delete " title="Eliminar"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></a>
                                                @endcan
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
            <div class="modal fade" id="campaignCreateModal" tabindex="-1" role="dialog" aria-labelledby="campaignCreateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="campaignCreateModalLabel">Nueva campaña</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('campaign.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="campaign_name">Campaña</label>
                                        <input type="text" class="form-control form-control-sm" id="campaign_name" name="campaign_name" value="{{ old('campaign_name') }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="campaign_initdate">Fecha Inicio</label>
                                        <input type="date" class="form-control form-control-sm" id="campaign_initdate" name="campaign_initdate" value="{{ old('campaign_initdate') }}"/>
                                    </div>
                                    <div class="form-group col">
                                        <label for="campaign_enddate">Fecha Finalización</label>
                                        <input type="date" class="form-control form-control-sm" id="campaign_enddate" name="campaign_enddate" value="{{ old('campaign_enddate') }}"/>
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
            </div>
        </section>
    </div>
@endsection

@push('scriptchosen')

<script src="{{ asset('js/datatablesdefault.js')}}"></script>

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

        // $('#tCampaigns').DataTable({
        //     'ajax': "{{ route('api.campaigns.index') }}",
        //     'columns': [
        //         { 'data': 'id' },
        //         { 'data': 'campaign_name' },
        //         { 'data': 'campaign_initdate' },
        //         { 'data': 'campaign_enddate' },
        //         { 'data': 'campaign_state' },
        //         { 'data': 'btn' },
        //     ],
        //     'processing': true,
        //     'serverSide': true,
        //     'paging':true,
        //     'orderMulti': true,
        //     'keys': false,
        //     'stateSave': false,
        //     'blurable': false,
        //     'responsive': true,
        //     'colReorder': true,
        //     'dom': 'lfrtip',
        //     'language': {'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'}
        // });
        // $('.select2').select2({
        //     theme: 'bootstrap4'
        // });

        $('#menucampaign').addClass('active');
        $('#navcampaigns').toggleClass('activo');
    });
</script>

@endpush

