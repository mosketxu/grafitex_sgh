@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Galeria Editar')
@section('titlePag','Edición de Imagenes de la Campaña')
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
                <form id="formgaleria" role="form" method="post" action="{{ route('campaign.galeria.update') }}" enctype="multipart/form-data">
                {{-- <form id="imageUploadForm" role="form" method="post" action="javascript:void(0)" enctype="multipart/form-data"> --}}
                    @csrf
                    <div class="card-body">
                        <input type="text" class="d-none" id="campaigngaleria" name="campaigngaleria" value="{{$campaigngaleria}}">
                        <div class="row" > 
                            <div class="col-6 img-thumbnail"  style="max-height: 350px;">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="carteleria">Carteleria</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-sm form-control-plaintext" id="carteleria" name="carteleria"
                                            value="{{$campaigngaleria->carteleria}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="mobiliario">Mobiliario</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-sm form-control-plaintext" id="mobiliario" name="mobiliario"
                                            value="{{$campaigngaleria->mobiliario}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="medida">Medida</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-sm form-control-plaintext" id="medida" name="medida"
                                            value="{{$campaigngaleria->medida}}">
                                    </div>
                                </div>
                                <input type="hidden" readonly class="form-control-sm form-control-plaintext" id="elemento" name="elemento"
                                    value="{{$campaigngaleria->elemento}}">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="imagen">Imagen</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-sm form-control-plaintext" id="imagen" name="imagen"
                                            value="{{$campaigngaleria->imagen}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="observaciones">Observaciones</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="observaciones" name="observaciones"
                                            value="{{$campaigngaleria->observaciones}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" style="">
                                <div class="col-sm-9">
                                    <input type="file" id="inputFile{{$campaigngaleria->id}}" name="photo" style="display:none">
                                    @if(file_exists( 'storage/galeria/'.$campaign->id.'/'.$campaigngaleria->imagen ))
                                        <img src="{{asset('storage/galeria/'.$campaign->id.'/'.$campaigngaleria->imagen.'?'.time())}}" alt={{$campaigngaleria->imagen}} title={{$campaigngaleria->imagen}}
                                            id="original" class="img-fluid img-thumbnail" 
                                            style="max-height: 250px; max-width: 350px;cursor:pointer"
                                            onclick='document.getElementById("inputFile{{$campaigngaleria->id}}").click()'/>
                                    @else
                                        <img src="{{asset('storage/galeria/pordefecto.jpg')}}"  alt={{$campaigngaleria->imagen}} title={{$campaigngaleria->imagen}}
                                            id="original" class="img-fluid img-thumbnail" 
                                            style="max-height: 250px; max-width: 350px;cursor:pointer"
                                            onclick='document.getElementById("inputFile{{$campaigngaleria->id}}").click()'/>
                                        @endif                                        
                                    <a href="#" name="Upload" onclick="subirImagen('formgaleria','{{$campaigngaleria->id}}')"><i class="fas fa-upload text-primary fa-lg mx-1"></i></a>
                                    {{-- <button type="submit"><i class="fas fa-upload text-primary fa-lg mx-1"></i></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-default" href="{{route('campaign.galeria',$campaigngaleria->campaign_id)}}" title="Ir la página anterior">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scriptchosen')
{{-- <script src="{{ asset('js/campaignElementos.js')}}"></script> --}}

<script>
    $(document).ready(function (e) {
        var token= $('#token').val();
        let timestamp = Math.floor( Date.now() );
        $('#imageUploadForm').on('submit',(function(e) {
            $('#original').attr('src', '');
            $.ajaxSetup({
                headers: { "X-CSRF-TOKEN": $('#token').val() },
            });
  
            e.preventDefault();
  
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{ route('campaign.galeria.update') }}",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    $('#uploadForm + img').remove();
                    $('#original').attr('src', '/storage/galeria/'+ data.campaign_id+'/'+ data.imagen+'?ver=' + timestamp);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }));
    });

    function subirImagen(formulario,imagenId){
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
                // $('#'+formulario +' img').remove();
                $('#original').attr('src', '/storage/galeria/'+ data.campaign_id+'/'+ data.imagen+'?ver=' + timestamp);
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

</script> 

<script>
    $('#menucampaign').addClass('active');
    $('#navgaleria').toggleClass('activo');
</script>

@endpush