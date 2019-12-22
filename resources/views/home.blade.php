@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-SHG')
@section('titlePag','Hola '. Auth::user()->name .', bienvenido a tu aplicación de gestión de tiendas y campañas de sunglass Hut')
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
                <div class="text-center">
                    {{-- <div class="col-auto">
                    </div> --}}
                    <div class="h3 m-0 text-dark text-center">
                        @yield('titlePag')
                    </div>
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumbs')
                        </ol>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- - /.content-header --}}
        {{-- main content  --}}
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    {{-- <div class="card-header">
                    
                    </div> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                <img src="{{ asset('img/Grafitex.jpg')}}" id="GrafitexLogo" alt="Grafitex" style="height: 300px">
                            </div>
                            <div class="col-md-8  text-left">
                                <img src="{{ asset('img/SGH.jpg')}}" id="Sunglass Hut"  alt="Sunglass Hut" style="height: 200px">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-footer">

                    </div> --}}
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scriptchosen')


<script>
</script>

@endpush

