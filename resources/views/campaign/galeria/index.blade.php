@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Galeria Campaña')
@section('titlePag','Galeria de la Campaña')
@section('navbar')
    @include('campaign._navbarcampaign')
@endsection
@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('campaignGaleria') }} --}}
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
                                {{ $campaigngaleria->links() }} &nbsp; &nbsp;
                                Hay {{$totalGaleria}} imágenes
                                
                            </div>
                            <div class="col-2 float-right mb-2">
                                <form method="GET" action="{{route('campaign.galeria',$campaign) }}">
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
                            <table id="tcampaignElementos" class="table table-hover table-sm small" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mobiliario</th>
                                        <th>Carteleria</th>
                                        <th>Medidas</th>
                                        {{-- <th>Elemento</th> --}}
                                        <th>Observaciones</th>
                                        <th>Eci</th>
                                        <th>Imagen</th>
                                        <th width="100px">Img</th>
                                        <th width="100px" class="text-center"><span class="ml-1">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($campaigngaleria as $imagen)
                                   <tr>
                                    <form id="form{{$imagen->id}}" role="form" method="post" action="javascript:void(0)" enctype="multipart/form-data"">
                                    {{-- <form id="" role="form" method="post" action="{{ route('campaign.galeria.updateindex') }}" enctype="multipart/form-data" id="uploadimage{{$imagen->id}}"> --}}
                                        @csrf
                                        <input type="text" class="d-none" name="imagenId" value="{{$imagen->id}}">
                                        <td>{{$imagen->id}}</td>
                                        <td>{{$imagen->mobiliario}}</td>
                                        <td>{{$imagen->carteleria}}</td>
                                        <td>{{$imagen->medida}}</td>
                                        <td class="d-none">{{$imagen->elemento}}</td>
                                        <td>{{$imagen->observaciones}}</td>
                                        <td>{{$imagen->eci}}</td>
                                        <td id="imagen{{$imagen->id}}">{{$imagen->imagen}}</td>
                                        <td>
                                            <div class="">
                                                <input type="file" id="inputFile{{$imagen->id}}" name="photo" style="display:none">
                                                @if(file_exists( 'storage/galeria/'.$campaign->id.'/'.$imagen->imagen ))
                                                    <img src="{{asset('storage/galeria/'.$campaign->id.'/'.$imagen->imagen)}}" alt={{$imagen->imagen}} title={{$imagen->imagen}}
                                                        id="original{{$imagen->id}}" class="img-fluid img-thumbnail" 
                                                        style="width: 100%;cursor:pointer"
                                                        onclick='document.getElementById("inputFile{{$imagen->id}}").click()'/>
                                                @else
                                                    <img src="{{asset('storage/galeria/pordefecto.jpg')}}"  alt={{$imagen->imagen}} title={{$imagen->imagen}}
                                                        id="original{{$imagen->id}}" class="img-fluid img-thumbnail" 
                                                        style="width: 100%;cursor:pointer"
                                                        onclick='document.getElementById("inputFile{{$imagen->id}}").click()'/>
                                                @endif                                        
                                                {{-- <button type="submit"><i class="fas fa-upload text-primary fa-lg mx-1"></i></a> --}}
                                            </div>
                                        </td>
                                        <td width="100px">
                                            <div class="text-center">
                                                <a href="#" name="Upload" onclick="subirImagenIndex('form{{$imagen->id}}','{{$imagen->id}}')"><i class="fas fa-upload text-primary fa-2x mx-1"></i></a>
                                                <a href="{{ route('campaign.galeria.editgaleria',[$campaign->id,$imagen->id]) }}" title="Edit"><i class="far fa-edit text-primary fa-2x mx-1"></i></a>
                                                {{-- <a href="" title="Delete"><i class="far fa-trash-alt text-danger fa-lg ml-1"></i></a> --}}
                                            </div>
                                       </td>
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
{{-- <script src="{{ asset('js/campaignElementos.js')}}"></script> --}}

<script>
    $(document).ready(function() {
   
    });
   function subirImagenIndex(formulario,imagenId){
        var token= $('#token').val();
        let timestamp = Math.floor( Date.now() );
        $.ajaxSetup({
            headers: { "X-CSRF-TOKEN": $('#token').val() },
        });
        
        var formElement = document.getElementById(formulario);
        var formData = new FormData(formElement);
        formData.append("imagenId", imagenId);
        
        $.ajax({
            type:'POST',
            url: "{{ route('campaign.galeria.updateimagenindex') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                $('#'+formulario +' img').remove();
                $('#original'+imagenId).attr('src', '/storage/galeria/'+ data.campaign_id+'/'+ data.imagen+'?ver=' + timestamp);
                $('#imagen'+imagenId).html(data.imagen);
                toastr.info('Imagen actualizada con éxito','Imagen',{
                    "progressBar":true,
                    "positionClass":"toast-top-center"
                });
            },
            error: function(data){
                console.log(data);
                toastr.error("No se ha actualizado la imagen.<br>"+ data.responseJSON.message,'Error actualización',{
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

    $('#menucampaign').addClass('active');
    $('#navgaleria').toggleClass('activo');

</script>

@endpush