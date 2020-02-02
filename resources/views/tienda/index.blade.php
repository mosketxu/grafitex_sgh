@extends('layouts.tiendasSGH')

@section('styles')
@endsection

@section('title','Grafitex-Campañas Tienda')
@section('titlePag','Campañas de la tienda '.$store->id.'-'.$store->name)
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($campaigns as $campaign)
                                    <tr id="t{{$campaign->id}}">
                                        <td>{{$campaign->id}}</td>
                                        <td>{{$campaign->campaign_name}}</td>
                                        <td>{{$campaign->campaign_initdate}}</td>
                                        <td>{{$campaign->campaign_enddate}}</td>
                                        <td>{{$campaign->campaign_state}} aldasldjaslkj</td>
                                        <td>
                                            {{-- @can('tiendas.index') --}}
                                            <a href="{{route('tienda.edit', [$campaign,$store->id] ) }}" title="Estado recepción"><i class="far fas fa-cubes text-teal fa-2x mr-1"></i><span class="text-teal h6">Recepción</span></a>
                                            {{-- @endcan --}}
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

