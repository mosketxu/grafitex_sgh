@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Stores')
@section('titlePag','Control de recepción de la campaña: '.$campaign->campaign_name)
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="campaign_name">Campaña</label>
                                        <input type="text" class="form-control form-control-sm" id="campaign_name"
                                            name="campaign_name"
                                            value="{{ old('campaign_name',$campaign->campaign_name) }}" disabled />
                                    </div>
                                    <div class="form-group col">
                                        <label for="campaign_initdate">Fecha Inicio</label>
                                        <input type="date" class="form-control form-control-sm" id="campaign_initdate"
                                            name="campaign_initdate"
                                            value="{{ old('campaign_initdate',$campaign->campaign_initdate) }}"
                                            disabled />
                                    </div>
                                    <div class="form-group col">
                                        <label for="campaign_enddate">Fecha Finalización</label>
                                        <input type="date" class="form-control form-control-sm" id="campaign_enddate"
                                            name="campaign_enddate"
                                            value="{{ old('campaign_enddate',$campaign->campaign_enddate) }}"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- links  y cuadro busqueda --}}
                        <div class="row">
                            <div class="col-10 row">
                                {{ $stores->appends(request()->except('page'))->links() }} &nbsp; &nbsp;
                                Hay {{$stores->total()}} stores.
                                {{-- {{$stores->campaign->id}} --}}
                            </div>
                            <div class="col-2 float-right mb-2">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table  class="table table-hover table-sm small" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th>Luxotica</th>
                                        <th>Store &nbsp; &nbsp;</th>
                                        <th>Nombre</th>
                                        <th>eMail</th>
                                        <th>Total</th>
                                        <th><i class="fas fa-question fa-lg "></i></th>
                                        <th><i class="far fa-thumbs-up fa-lg text-success"></i></th>
                                        <th><i class="far fa-thumbs-down fa-lg text-danger"></i></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stores as $store)
                                    <tr>
                                        <input type="text" class="d-none" name="id" value="{{$store->id}}">
                                        <td>{{$store->tienda->luxotica}}</td>
                                        <td>{{$store->tienda->id}}</td>
                                        <td>{{$store->tienda->name}}</td>
                                        <td><a href="mailto:{{$store->tienda->email}}">{{$store->tienda->email}}</a></td>
                                        <td>{{$store->total}}</td>
                                        <td>{{$store->total-$store->OK-$store->KO}}</td>
                                        <td>{{$store->OK}}</td>
                                        <td>{{$store->KO}}</td>
                                        <td>
                                            @can('tiendas.show')
                                                <a href="{{ route('tienda.show',[$campaign,$store->tienda->id]) }}" title="Editar tienda"><i class="fas fa-arrow-right text-teal fa-2x mr-1"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-default" href="{{route('tienda.control')}}" title="Ir la página anterior">Volver</a>
                    </div>

                </div>
            </div>
        </section>
    </div>


@endsection

@push('scriptchosen')

<script>
    @include('_partials._errortemplate')
</script>
    
<script>
    $('#menutiendas').addClass('active');
</script>

@endpush

