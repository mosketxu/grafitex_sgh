@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Añadir Elemento a Stores') 
@section('titlePag','Añadir Elemento a la Store')
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
            <div class="container-fluid">
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
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="row" style="font-size: 0.8rem;">
                                    <div class="form-group col">
                                        <label>Store</label><br>{{ $store->id }}
                                    </div>
                                    <div class="form-group col">
                                        <label>Store Name</label><br>{{ $store->name }}
                                    </div>
                                    <div class="form-group col">
                                        <label>Country</label><br>{{ $store->country }}
                                    </div>
                                    <div class="form-group col">
                                        <label>Area</label><br>{{ $store->are->area }}
                                    </div>
                                    <div class="form-group col">
                                        <label>Segmento</label><br>{{ $store->segmento }}
                                    </div>
                                    <div class="form-group col">
                                        <label>Concept</label><br>{{ $store->concep->storeconcept }}
                                    </div>
                                    <div class="form-group col">
                                        <label>Observaciones</label><br>{{ $store->observaciones }}
                                    </div>
                                    <div class="form-group col">
                                        <img src="{{asset('storage/store/'.$store->imagen)}}" alt="{{$store->imagen}}" title="{{$store->imagen}}" class="img-fluid img-thumbnail" style="height: 50px; max-width: 200px;"/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- links  y cuadro busqueda --}}
                        <div class="row">
                            <div class="col-10 row">
                                {{-- {{ $elementos->links() }} &nbsp; &nbsp; --}}
                                Hay {{$elementosDisp->total()}} elementos diponibles
                                
                            </div>
                            <div class="col-2 float-right mb-2">
                            </div>
                        </div>
                        
                        <div class="table-responsive" style="height: 350px">
                            <table id="tcampaignElementos" class="table table-hover table-sm small sortable" cellspacing="0" width=100%>
                                <thead>
                                    <tr class="">
                                        <form method="GET" action="{{route('storeelementos.edit',$store->id) }}">
                                            <th><input id="ubi" name="ubi" type="text" class="form-control form-control-sm" value='{{$ubi}}' placeholder="Filtro Ubicación"/></th>
                                            <th><input id="mob" name="mob" type="text" class="form-control  form-control-sm" value='{{$mob}}'  placeholder="Filtro Mobiliario"/></th>
                                            <th><input id="propx" name="propx" type="text" class="form-control  form-control-sm" value='{{$propx}}'  placeholder="Filtro Prop x Elem"/></th>
                                            <th><input id="cart" name="cart" type="text" class="form-control  form-control-sm" value='{{$cart}}'  placeholder="Filtro Carteleria"/></th>
                                            <th><input id="med" name="med" type="text" class="form-control  form-control-sm" value='{{$med}}'  placeholder="Filtro Medida"/></th>
                                            <th><input id="mat" name="mat" type="text" class="form-control  form-control-sm" value='{{$mat}}'  placeholder="Filtro Material"/></th>
                                            <th></th>
                                            <th></th>
                                            <th width="100px">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="submit" class="form-control  form-control-sm enlace" name="Filtra"><i class="fas fa-search fa-lg text-primary"></i></button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" class="form-control  form-control-sm enlace" name="Borrar Filtros" onclick="borrarFiltros()"><i class="far fa-times-circle fa-lg text-danger"></i></button>
                                                    </div>
                                                </div>
                                            </th>
                                            <th></th>
                                        </form>
                                    </tr>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th id="tUbicación">Ubicación</th>
                                        <th id="tMobiliario">Mobiliario</th>
                                        <th id="tProp">Prop x Elemento</th>
                                        <th id="tCarteleria">Carteleria</th>
                                        <th id="tMedida">Medida</th>
                                        <th id="tMaterial">Material</th>
                                        <th id="tUnit" class="text-center">Unit x Prop</th>
                                        <th id="tObservaciones">Observaciones</th>
                                        <th width="50px" class="text-center"><span class="ml-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($elementosDisp as $elemento)
                                    <form action="{{route('storeelementos.store',$store->id)}}" method="post">
                                        @csrf
                                    <tr>
                                        <td class="d-none"><input type="hidden" name="elemento_id" value="{{$elemento->id}}"> </td>
                                        <td>{{$elemento->ubicacion}}</td>
                                        <td>{{$elemento->mobiliario}}</td>
                                        <td>{{$elemento->propxelemento}}</td>
                                        <td>{{$elemento->carteleria}}</td>
                                        <td>{{$elemento->medida}}</td>
                                        <td>{{$elemento->material}}</td>
                                        <td>{{$elemento->unitxprop}}</td>
                                        <td>{{$elemento->observaciones}}</td>
                                        <td class=" text-center"><button type="submit" class="btn btn-tool"><i  class="fas fa-plus text-primary"></i></button></td>
                                    </tr>
                                    </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type ='button' class="btn btn-default" onclick="location.href = '{{route('storeelementos.index',$store->id) }}'" value="Volver"/>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        }); 
    
        function borrarFiltros(){
            $("#ubi").val('');   
            $("#mob").val('');   
            $("#propx").val(''); 
            $("#cart").val('');  
            $("#med").val('');
            $("#mat").val('');
        }
        $('#menuelementos').addClass('active');
        $('#navcampaigns').toggleClass('activo');
    
    </script>
    
    @endpush
    
    
    