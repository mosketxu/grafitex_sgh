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
                        <a href="" role="button" data-toggle="modal" data-target="#campaignCreateModal">
                            <i class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
                        </a>
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
                        <div class="table-responsive">
                            <table id="tCampaigns" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Campaña</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin Prevista</th>
                                        {{-- <th>Estado</th> --}}
                                        {{-- <th>Creada el:</th>
                                        <th>Modificada el:</th> --}}
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="">
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
        $('#tCampaigns').DataTable({
            'ajax': "{{ route('api.campaigns.index') }}",
            'columns': [
                { 'data': 'id' },
                { 'data': 'campaign_name' },
                { 'data': 'campaign_initdate' },
                { 'data': 'campaign_enddate' },
                { 'data': 'campaign_state' },
                { 'data': 'btn' },
            ],
            'processing': true,
            'serverSide': true,
            'paging':true,
            'orderMulti': true,
            'keys': false,
            'stateSave': false,
            'blurable': false,
            'responsive': true,
            'colReorder': true,
            'dom': 'lfrtip',
            'language': {'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'}
        });
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $('#menucampaign').addClass('active');
        $('#navcampaigns').toggleClass('activo');
    });
</script>

@endpush

