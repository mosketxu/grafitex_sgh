@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Maestro')
@section('titlePag','Maestro')
@section('navbar')
    @include('maestro._navbarmaestro')
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
                        <a href="" role="button" data-toggle="modal" data-target="#importMaestro" data-backdrop="static" data-keyboard="false">
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
                            <table id="tMaestro" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th>Store</th>
                                        <th>Country</th>
                                        <th>Name</th>
                                        <th>Area</th>
                                        <th>Segmento</th>
                                        <th>Storeconcept</th>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="importMaestro" tabindex="-1" role="dialog" aria-labelledby="importMaestroLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importMaestroLabel">Nueva importacion de maestro</h5>
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> --}}
                        </div>
                        <div class="modal-body">
                            <form id="formulario" role="form" method="post" action="{{ route('maestro.import') }}" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="campaign_initdate">Fichero</label>
                                        <input type="file" class="form-control form-control-sm" id="maestro" name="maestro" value=""/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary modalSubir" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary modalSubir" name="Guardar" onclick="subirfichero()">Subir</button>
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
        
    
<script src="{{ asset('js/datatablesdefault.js')}}"></script>


<script>

    function subirfichero(){
        $('.modalSubir').attr('disabled',true);
        $('#formulario').submit();
    }

    $(document).ready( function () {
        $('#tMaestro').DataTable({
            'ajax': "{{ route('api.maestros.index') }}",
            'columns': [
                { 'data': 'store'},
                { 'data': 'country'},
                { 'data': 'name'},
                { 'data': 'area'},
                { 'data': 'segmento'},
                { 'data': 'storeconcept'},
                { 'data': 'ubicacion'},
                { 'data': 'mobiliario'},
                { 'data': 'propxelemento'},
                { 'data': 'carteleria'},
                { 'data': 'medida'},
                { 'data': 'material'},
                { 'data': 'unitxprop'},
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
        $('#menumaestro').toggleClass('activo');
        $('#navmaestro').toggleClass('activo');
    });
</script>
@endpush

