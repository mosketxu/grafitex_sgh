@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Control de Campañas Tienda')
@section('titlePag','Control de recepción de material')
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
                                {{ $campaigns->appends(request()->except('page'))->links() }} &nbsp; &nbsp;
                                Hay {{$campaigns->total()}} campañas.
                            </div>
                            <div class="col-2 float-right mb-2">
                                <form method="GET" action="{{route('tienda.control') }}">
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
                                        <th>Total</th>
                                        <th><i class="fas fa-question fa-lg "></i></th>
                                        <th><i class="far fa-thumbs-up fa-lg text-success"></i></th>
                                        <th><i class="far fa-thumbs-down fa-lg text-danger"></i></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach($campaigns as $campaign)
                                    <tr>
                                        <td>{{$campaign->campaign->id}}</td>
                                        <td>{{$campaign->campaign->campaign_name}}</td>
                                        <td>{{$campaign->campaign->campaign_initdate}}</td>
                                        <td>{{$campaign->campaign->campaign_enddate}}</td>
                                        <td>{{$campaign->total}}</td>
                                        <td>{{$campaign->total-$campaign->OK-$campaign->KO}}</td>
                                        <td>{{$campaign->OK}}</td>
                                        <td>{{$campaign->KO}}</td>
                                        <td>
                                            @can('tiendas.index')
                                            <a href="{{route('tienda.campaignstores',$campaign->campaign ) }}" title="tiendas de la campaña"><i class="fas fa-arrow-right text-teal fa-2x mr-1"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scriptchosen')


<script>
    @include('_partials._errortemplate')

    $(document).ready( function () {
        $('#menutiendas').addClass('active');
    });
</script>


@endpush

