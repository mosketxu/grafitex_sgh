@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Tarifas')
@section('titlePag','Tarifas')
@section('navbar')
@include('tarifa._navbartarifa')
@endsection
@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('campaignElementos') }} --}}
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
                    <a href="" role="button" data-toggle="modal" data-target="#tarifaCreateModal">
                        <i class="fas fa-plus-circle fa-lg text-primary mt-2"></i>
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
    {{-- main content  --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    {{-- tarifas pricking --}}
                    @include('tarifa._tarifaPicking')
                </div>
                <div class="col-6">
                    {{-- tarifas transporte --}}
                        @include('tarifa._tarifaTransportes')
                </div>
            </div>
            <div class="row">
                <div class="col">
                {{-- tarifas materiales --}}
                    @include('tarifa._tarifaMateriales')
                </div>
            </div>


           
        </div>
        <!-- Modal -->
        <div class="modal fade" id="tarifaCreateModal" tabindex="-1" role="dialog"
            aria-labelledby="tarifaCreateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tarifaCreateModalLabel">Nueva Tarifa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('tarifa.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col">
                                    <label for="familia">Familia</label>
                                    <input type="text" class="form-control form-control-sm" id="familia" name="familia"
                                        value="{{ old('familia') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="tramo1">Tramo 1</label>
                                    <input type="number" class="form-control form-control-sm" id="tramo1" name="tramo1"
                                        value="{{ old('tramo1') }}" />
                                </div>
                                <div class="form-group col">
                                    <label for="tarifa1">Tarifa 1</label>
                                    <input type="number" step="0.01" class="form-control form-control-sm" id="tarifa1"
                                        name="tarifa1" value="{{ old('tarifa1') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="tramo2">Tramo 2</label>
                                    <input type="number" class="form-control form-control-sm" id="tramo2" name="tramo2"
                                        value="{{ old('tramo2') }}" />
                                </div>
                                <div class="form-group col">
                                    <label for="tarifa2">Tarifa 2</label>
                                    <input type="number" step="0.01" class="form-control form-control-sm" id="tarifa2"
                                        name="tarifa2" value="{{ old('tarifa2') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="tramo3">Tramo 3</label>
                                    <input type="number" class="form-control form-control-sm" id="tramo3" name="tramo3"
                                        value="{{ old('tramo3') }}" />
                                </div>
                                <div class="form-group col">
                                    <label for="tarifa3">Tarifa 3</label>
                                    <input type="number" step="0.01" class="form-control form-control-sm" id="tarifa3"
                                        name="tarifa3" value="{{ old('tarifa3') }}" />
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

{{-- <script src="{{ asset('js/sortTable.js')}}"></script> --}}

<script>
    @include('_partials._errortemplate')
</script>


<script>
    $(document).ready(function() {
   
    });

    $('#menutarifa').addClass('active');
    $('#navtarifas').toggleClass('activo');

</script>

@endpush