@extends('layouts.tiendasSGH')

@section('styles')
@endsection

@section('title','Grafitex-Elementos Campaña') 
@section('titlePag','Tienda: '.$store->id .'-'.$store->name.'. Control recepción de la campaña: '.$campaign->campaign_name) 
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
                                <form method="GET" action="{{route('campaign.elementos',$campaign) }}">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search fa-sm text-primary"></i></span>
                                        </div>
                                        <input id="busca" name="busca"  type="text" class="form-control" name="search" value='{{$busqueda}}' placeholder="Search for..."/>
                                    </div>
                                </form>
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
                                            Estado Recepción <br>
                                            <a href="{{route('tienda.edit',[$campaign->id,$store->id])}}" class="text-primary"><i class="fas fa-sync-alt fa-lg"></i> &nbsp;&nbsp;</a>
                                            <span class="badge badge-dark"><i class="fas fa-question fa-lg "></i> <span id="nv">{{$sinvalorar}}</span></span> &nbsp;&nbsp;
                                            <span class="badge badge-success" ><i class="far fa-thumbs-up  fa-lg"></i> <span id="ok">{{$correctos}}</span></span> &nbsp;&nbsp;
                                            <span class="badge badge-danger" ><i class="far fa-thumbs-down  fa-lg"></i> <span id="ko">{{$incidencias}}</span></span> &nbsp;&nbsp;
                                        </th>
                                        <th class="text-center">Observaciones</th>
                                        <th ></th>
                                        <th class="text-center"><span class="ml-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($elementos as $elemento)
                                   <tr>
                                    <form id="form{{$elemento->id}}" role="form" method="post" action="{{route('tienda.update')}}">
                                        @method('PUT')
                                        @csrf
                                        <input type="text" class="d-none" name="storeId" value="{{$store->id}}">
                                        <input type="text" class="d-none" name="elementoId" value="{{$elemento->id}}">
                                        <input type="text" class="d-none" name="campaignId" value="{{$campaign->id}}">
                                        <td class="d-none">{{$elemento->id}}</td>
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
                                            @endif
                                            <span>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm" name="estadorecepcion"  onchange="update('form{{$elemento->id}}',{{$elemento->id}})" id="valorestado{{$elemento->id}}">
                                                <option value="0" {{$elemento->estadorecepcion == "0" ? 'selected' : ''}}>Selecciona...</option>
                                                <option value="1" {{$elemento->estadorecepcion == "1" ? 'selected' : ''}}>OK</option>
                                                <option value="2" {{$elemento->estadorecepcion == "2" ? 'selected' : ''}}>No recibido</option>
                                                <option value="3" {{$elemento->estadorecepcion == "3" ? 'selected' : ''}}>Defectuoso</option>
                                                <option value="4" {{$elemento->estadorecepcion == "4" ? 'selected' : ''}}>Idioma incorrecto</option>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea class="form-control form-control-sm" name="obsrecepcion" onchange="update('form{{$elemento->id}}',{{$elemento->id}})" placeholder="Escribe tus comentarios">{{old('obsrecepcion', $elemento->obsrecepcion)}}</textarea>
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
                                        <td>
                                            {{-- <button type="submit" class="enlace"><i class="far fa-check-circle text-success fa-2x"></i></button> --}}
                                            <a href="#" name="Upload" onclick="update('form{{$elemento->id}}',{{$elemento->id}})"><i class="far fa-check-circle text-success fa-2x"></i></a>
                                        </td>
                                    </form>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-default" href="{{route('tienda.index')}}" title="Ir la página anterior">Volver</a>
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
                console.log(data);
                if(valest==1){
                    // $('#nv').text(parseInt($('#nv').text())-1);
                    // $('#ok').text(parseInt($('#ok').text())+1);
                    $(estado).html('<i class="far fa-thumbs-up text-success fa-lg"></i>');
                }else if(valest>1){
                    // $('#nv').text(parseInt($('#nv').text())-1);
                    // $('#ko').text(parseInt($('#ko').text())+1);
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