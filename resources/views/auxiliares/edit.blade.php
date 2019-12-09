@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Edición '.ucfirst($campo))
@section('titlePag','Edición '.ucfirst($campo))
@section('navbar')
    @include('_partials._navbar')
@endsection
@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('campaignElementos') }} --}}
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        {{-- content header --}}
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-auto ">
                        <span class="h3 m-0 text-dark">@yield('titlePag')</span>
                        <span class="hidden" id="campaign_id"></span>
                    </div>
                    <div class="col-auto mr-auto">
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
            <div class="container">
                <div class="card"  style="width:65%;">
                    <div class="card-header">
                        <div class="row">
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="formelemento" role="form" method="POST" action="{{ route($route,$datos->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <input type="text" class="d-none" id="id" name="id"
                                    value="{{$datos->id}}">
                                <div class="form-group row justify-content-md-center">
                                    <label class="col-sm-2 col-form-label col-form-label-sm" for="store">{{ucfirst($campo)}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control-sm form-control" id={{$campo}} name={{$campo}} value="{{$datos->$campo}}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a class="btn btn-default" href="{{route('auxiliares')}}" title="Ir la página anterior">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scriptchosen')

<script>
    $('#menumantenimiento').addClass('active');
    // $('#navelemento').toggleClass('activo'); 
</script>
<script>@include('_partials._errortemplate')</script>
@endpush