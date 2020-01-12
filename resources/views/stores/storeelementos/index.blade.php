@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Elementos en Stores') 
@section('titlePag','Elementos de la Store')
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
                        <a href="{{route('storeelementos.edit',$store->id)}}" role="button" title="Añadir elemento">
                            <i class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
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
                                {{ $storeelementos->links() }} &nbsp; &nbsp;
                                Hay {{$storeelementos->total()}} elementos
                                
                            </div>
                            <div class="col-2 float-right mb-2">
                                <form method="GET" action="{{route('storeelementos.index',$store->id) }}">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search fa-sm text-primary"></i></span>
                                        </div>
                                        <input id="busca" name="busca"  type="text" class="form-control" name="search" value='{{$busqueda}}' placeholder="Search for..."/>
                                    </div>
                                </form>
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
                                </thead>
                                <tbody>
                                   @foreach ($storeelementos as $elemento)
                                   <tr>
                                        <td>{{$elemento->ubicacion}}</td>
                                        <td>{{$elemento->mobiliario}}</td>
                                        <td>{{$elemento->propxelemento}}</td>
                                        <td>{{$elemento->carteleria}}</td>
                                        <td>{{$elemento->medida}}</td>
                                        <td>{{$elemento->material}}</td>
                                        <td>{{$elemento->unitxprop}}</td>
                                        <td>{{$elemento->observaciones}}</td>
                                        <td  width="100px">
                                            <form id="formDelete" action="{{route('storeelementos.destroy',[$store->id,$elemento->id])}}" method="POST" style="display:inline">
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <button type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                                            </form>
                                                {{-- <div class="text-center">
                                                    <a href="#!" class="btn-delete " title="Eliminar"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></a>
                                                </div> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type ='button' class="btn btn-default" onclick="location.href = '{{route('store.index') }}'" value="Volver"/>
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
    
    
    