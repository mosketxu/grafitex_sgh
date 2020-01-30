@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Store Adresses')
@section('titlePag','Store Adresses')
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
                        @can('store.index')
                        <a href="{{route('store.index')}}" role="button" title="stores">
                            <i class="fas fas fa-store fa-2x text-success mt-2"></i>
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
                                        <form id="formfiltro" method="GET" action="{{route('store.adresses') }}">
                                            <th colspan="4">
                                                <select class="form-control form-control-sm select2" id="sto" name="sto[]" data-placeholder="stores" multiple>
                                                    @foreach ($stores as $store )
                                                        <option value="{{$store->id}}" {{ empty($sto) ? "" : (in_array($store->id, $sto) ? "selected" : "")}}>{{$store->id}}</option> 
                                                    @endforeach
                                                </select>
                                            </th>
                                            <th colspan="9">
                                                <select class="form-control form-control-sm select2" id="nam" name="nam[]" data-placeholder="name" multiple>
                                                    @foreach ($stores as $store )
                                                        <option value="{{$store->name}}" {{ empty($nam) ? "" : (in_array($store->name, $nam) ? "selected" : "")}}>{{$store->name}}</option> 
                                                    @endforeach
                                                </select>
                                            </th>
                                            <th>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="submit" class="form-control  form-control-sm enlace" name="Filtra"><i class="fas fa-search fa-2x text-primary"></i></button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" class="form-control  form-control-sm enlace" name="Borrar Filtros" onclick="borrarFiltros()"><i class="far fa-times-circle fa-2x text-danger"></i></button>
                                                    </div>
                                                </div>
                                            </th>
                                        </form>
                                    </tr>

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
                                        <th width="80px">&nbsp;</th>
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
                                            <td width="180px">
                                                <div class="text-center">
                                                @can('store.edit')
                                                <a href="{{ route('store.edit',$store) }}" title="Editar tienda"><i class="far fa-edit text-primary fa-2x mx-1"></i></a>
                                                @endcan
                                            </div>
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

