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
                                <div class="row">
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
                                    <tr>
                                        <form method="GET" action="{{route('storeelementos.edit',$store->id) }}">
                                            <th><input name="ubicacion" type="text" class="form-control" value='{{$ubicacion}}' /></th>
                                            <th><input name="mobiliario" type="text" class="form-control" value='{{$mobiliario}}' /></th>
                                            <th><input name="propxelemento" type="text" class="form-control" value='{{$propxelemento}}' /></th>
                                            <th><input name="carteleria" type="text" class="form-control" value='{{$carteleria}}' /></th>
                                            <th><input name="medida" type="text" class="form-control" value='{{$medida}}' /></th>
                                            <th><input name="material" type="text" class="form-control" value='{{$material}}' /></th>
                                            <button type="submit" class="btn btn-default">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </form>

                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($elementosDisp as $elemento)
                                   <tr>
                                        {{-- <td>{{$elemento->id}}</td> --}}
                                        <td>{{$elemento->ubicacion}}</td>
                                        <td>{{$elemento->mobiliario}}</td>
                                        <td>{{$elemento->propxelemento}}</td>
                                        <td>{{$elemento->carteleria}}</td>
                                        <td>{{$elemento->medida}}</td>
                                        <td>{{$elemento->material}}</td>
                                        <td>{{$elemento->unitxprop}}</td>
                                        <td>{{$elemento->observaciones}}</td>
                                    </tr>
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
    
        $('#menuelementos').addClass('active');
        $('#navcampaigns').toggleClass('activo');
    
    </script>
    
    @endpush
    
    
    