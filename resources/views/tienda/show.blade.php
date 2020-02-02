@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Elementos Campaña') 
@section('titlePag',$store->id .'-'.$store->name.': Elementos de la Campaña') 
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
                                {{ $elementos->appends(request()->except('page'))->links() }} &nbsp; &nbsp;
                                Hay {{$elementos->total()}} elementos
                            </div>
                            <div class="col-2 float-right mb-2">
                                {{-- <form method="GET" action="{{route('tienda.control') }}">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search fa-sm text-primary"></i></span>
                                        </div>
                                        <input id="busca" name="busca"  type="text" class="form-control" name="search" value='{{$busqueda}}' placeholder="Search for..."/>
                                    </div>
                                </form> --}}
                            </div>
                        </div>
                        
                        <div class="table-responsive mb-0 pb-0">
                            <table id="tcampaignElementos" class="table table-hover table-sm small mb-0 pb-0" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th class="d-none">#</th>
                                        <th>Ubicación</th>
                                        <th>Mobiliario</th>
                                        <th>Prop x Elemento</th>
                                        <th>Carteleria</th>
                                        <th>Medida</th>
                                        <th>Material</th>
                                        <th class="text-center">Unit x Prop</th>
                                        <th width="5px"></th>
                                        <th class="text-center">
                                            <div style="display:flex">
                                                <div style="margin-left:auto;margin-right:auto;">
                                                    Estado Recepción 
                                                </div>
                                            </div>
                                            <div style="display:flex;">
                                                <div style="display:flex;margin-left:auto;margin-right:auto;">
                                                    <form action="{{route('tienda.show',[$campaign,$store])}}">
                                                        <input type="hidden" name="busqueda" value="total">
                                                        <button type="submit"  class="enlace"> <span class="badge badge-info"> Total {{$total}}</span></button>
                                                    </form>
                                                    <form action="{{route('tienda.show',[$campaign,$store])}}">
                                                        <input type="hidden" name="busqueda" value="nv">
                                                        <button type="submit"  class="enlace"> <span class="badge badge-dark"><i class="fas fa-question fa-lg"></i> {{$sinvalorar}}</span></button>
                                                    </form>
                                                    <form action="{{route('tienda.show',[$campaign,$store])}}">
                                                        <input type="hidden" name="busqueda" value="OK">
                                                        <button type="submit"  class="enlace"><span class="badge badge-success"><i class="far fa-thumbs-up  fa-lg"></i> {{$correctos}}</span> </button>
                                                    </form>
                                                    <form action="{{route('tienda.show',[$campaign,$store])}}">
                                                        <input type="hidden" name="busqueda" value="KO">
                                                            <button type="submit" class="enlace"><span class="badge badge-danger"><i class="far fa-thumbs-down  fa-lg"></i> {{$incidencias}}</span> </button>
                                                    </form>
                                                </div>
                                        </div>
                                        </th>
                                        <th>Observaciones</th>
                                        <th ></th>
                                        <th class="text-center"><span class="ml-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($elementos as $elemento)
                                   <tr>
                                        <td>{{$elemento->ubicacion}}</td>
                                        <td>{{$elemento->mobiliario}}</td>
                                        <td>{{$elemento->propxelemento}}</td>
                                        <td>{{$elemento->carteleria}}</td>
                                        <td>{{$elemento->medida}}</td>
                                        <td>{{$elemento->material}}</td>
                                        <td class="text-center">{{$elemento->unitxprop}}</td>
                                        <td><span id="estado{{$elemento->id}}">
                                            @if($elemento->estadorecepcion=='1')
                                            <i class="far fa-thumbs-up text-success fa-lg"></i>
                                            @elseif($elemento->estadorecepcion>'1')
                                            <i class="far fa-thumbs-down text-danger fa-lg"></i>
                                            @else
                                            <i class="fas fa-question fa-lg"></i>
                                            @endif
                                            <span>
                                        </td>
                                        <td  class="text-center">
                                            @if($elemento->estadorecepcion=="0")
                                                
                                            @elseif ($elemento->estadorecepcion=="1")
                                                OK
                                            @elseif ($elemento->estadorecepcion=="2")
                                                No recibido
                                            @elseif ($elemento->estadorecepcion=="3")
                                                Defectuoso
                                            @elseif ($elemento->estadorecepcion=="4")
                                                Idioma incorrecto
                                            @endif
                                        </td>
                                        <td>
                                            {{$elemento->obsrecepcion}}
                                        </td>
                                        <td>
                                            @if(file_exists( 'storage/galeria/'.$campaign->id.'/'.$elemento->imagen ))
                                                <img src="{{asset('storage/galeria/'.$campaign->id.'/'.$elemento->imagen.'?'.time())}}"
                                                    alt={{$elemento->imagen}} title={{$elemento->imagen}} id="original"
                                                    class="img-fluid img-thumbnail" style="height: 60px"/>
                                            @else
                                                <img src="{{asset('storage/galeria/pordefecto.jpg')}}" alt={{$elemento->imagen}}
                                                    title={{$elemento->imagen}} id="original" class="img-fluid img-thumbnail"
                                                    style="height: 60px"/>
                                            @endif
                                        </td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-default" href="{{route('tienda.campaignstores',$campaign->id)}}" title="Ir la página anterior">Volver</a>
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
function update(formulario,id){
        var token= $('#token').val();
        $.ajaxSetup({
            headers: { "X-CSRF-TOKEN": $('#token').val() },
        });
        var formElement = document.getElementById(formulario);
        var formData = new FormData(formElement);
        var estado='#estado'+id;
        var valest=$('#valorestado'+id).val();

        $.ajax({
            type:'POST',
            url: "{{ route('tienda.update') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if(valest==1){
                    $(estado).html('<i class="far fa-thumbs-up text-success fa-lg"></i>');
                }else{
                    $(estado).html('<i class="far fa-thumbs-down text-danger fa-lg"></i>');
                }
                toastr.info('Recepción actualizada con éxito',{
                    "progressBar":true,
                    "positionClass":"toast-top-center"
                });
            },
            error: function(data){
                console.log(data);
                toastr.error("No se ha actualizado la recepcion",{
                    "closeButton": true,
                    "progressBar":true,
                    "positionClass":"toast-top-center",
                    "options.escapeHtml" : true,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": 0,
                });
            }
        }); 
    }
</script>

<script>
    $('#menutiendas').addClass('active');
</script>

@endpush