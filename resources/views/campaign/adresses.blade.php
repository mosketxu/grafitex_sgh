@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Campaign Adresses')
@section('titlePag','Campaign Adresses')
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
                        @can('campaign.index')
                        <a href="{{ route('campaign.exportaddresses',$campaign->id) }}" title="Export Excel"><i class="far fa-file-excel fa-2x text-success "></i></a>
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
                        {{-- links  y cuadro busqueda --}}
                        <div class="row">
                            <div class="col-10 row">
                                {{ $stores->appends(request()->except('page'))->links() }} &nbsp; &nbsp;
                                Hay {{$stores->total()}} stores.
                            </div>
                            <div class="col-2 float-right mb-2">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table  class="table table-hover table-sm small" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th>Luxotica</th>
                                        <th>Store</th>
                                        <th>Nombre</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Province</th>
                                        <th>Postal Code</th>
                                        <th>Phone</th>
                                        <th>email</th>
                                        <th>Winter schedule</th>
                                        <th>Summer schedule</th>
                                        <th>Delivery time</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stores as $store)
                                    <tr data-id="{{$store->id}}">
                                        <form id="form{{$store->id}}" role="form" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" class="d-none" id="id" name="id" value="{{$store->id}}">
                                            <td>{{$store->luxotica}}</td>
                                            <td>{{$store->id}}</td>
                                            <td>{{$store->name}}</td>
                                            <td>{{$store->address}}</td>
                                            <td>{{$store->city}}</td>
                                            <td>{{$store->province}}</td>
                                            <td>{{$store->cp}}</td>
                                            <td>{{$store->phone}}</td>
                                            <td>{{$store->email}}</td>
                                            <td>{{$store->winterschedule}}</td>
                                            <td>{{$store->summerschedule}}</td>
                                            <td>{{$store->deliverytime}}</td>
                                            <td>{{$store->observaciones}}</td>
                                        </form>
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
</script>
    
<script>
    $(document).ready( function () {
    });
    $('.select2').select2();    
    $('#menustores').addClass('active');
    
    function borrarFiltros(form){
        $("#lux").html('');   
        $("#sto").html('');   
        $("#nam").html('');   
        $(form).submit();
    }
</script>

@endpush

