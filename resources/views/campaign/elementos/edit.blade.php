@extends('layouts.grafitex')

@section('styles')
@endsection     

@section('title','Grafitex-Elemento Editar')
@section('titlePag','Selección del elemento')
@section('navbar')
@include('campaign._navbarcampaign')
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
                            <input type="hidden" id="campaignID" value='{{$campaign->id}}'>
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
                    <form id="formelemento" role="form" method="post" action="{{ route('campaign.elemento.update') }}"
                        enctype="multipart/form-data" id="uploadimage">
                        {{-- <form id="imageUploadForm" role="form" method="post" action="javascript:void(0)" enctype="multipart/form-data" id="uploadimage"> --}}
                        @csrf
                        <div class="card-body">
                            <input type="text" class="d-none" id="campaignelemento" name="campaignelemento"
                                value="{{$campaignelemento}}">
                            <div class="row">
                                <div class="col-9 img-thumbnail">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="store">Store</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext" id="Store" name="store" value="{{$campaignelemento->store}} - {{$campaignelemento->name}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="country">Country</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="country" name="country" value="{{$campaignelemento->country}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="area">Area</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="area" name="area" value="{{$campaignelemento->area}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="segmento">Segmento</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="segmento" name="segmento" value="{{$campaignelemento->segmento}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="storeconcept">Storeconcept</label> 
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="storeconcept" name="storeconcept" value="{{$campaignelemento->storeconcept}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="observaciones">Observaciones</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control-sm form-control" id="observaciones" name="observaciones" value="{{$campaignelemento->observaciones}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="precio">Precio</label>
                                                <div class="col-sm-9">
                                                    <input type="number" step=0.01 class="form-control-sm form-control" id="precio" name="precio" value="{{$campaignelemento->precio}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="ubicacion">Ubicación</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="ubicacion" name="ubicacion" value="{{$campaignelemento->ubicacion}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="mobiliario">Mobiliario</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="mobiliario" name="mobiliario" value="{{$campaignelemento->mobiliario}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="propxelemento">Prop x Elemento</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="propxelemento" name="propxelemento" value="{{$campaignelemento->propxelemento}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="carteleria">Carteleria</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="carteleria" name="carteleria" value="{{$campaignelemento->carteleria}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="medida">Medida</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="medida" name="medida" value="{{$campaignelemento->medida}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="material">Material</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="material" name="material" value="{{$campaignelemento->material}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label col-form-label-sm" for="unitxprop">Unit x Prop</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-sm form-control-plaintext"  id="unitxprop" name="unitxprop" value="{{$campaignelemento->unitxprop}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3" style="max-height: 350px;">
                                    @can('campaign.edit')
                                    <input type="file" id="inputFile{{$campaignelemento->id}}" name="photo"
                                    style="display:none">
                                    @endcan
                                    @if(file_exists( 'storage/galeria/'.$campaign->id.'/'.$campaignelemento->imagen ))
                                    <img src="{{asset('storage/galeria/'.$campaign->id.'/'.$campaignelemento->imagen.'?'.time())}}"
                                        alt={{$campaignelemento->imagen}} title={{$campaignelemento->imagen}} id="original"
                                        class="img-fluid img-thumbnail" style="height: 350px;cursor:pointer"
                                        onclick='document.getElementById("inputFile{{$campaignelemento->id}}").click()' />
                                    @else
                                    <img src="{{asset('storage/galeria/pordefecto.jpg')}}" alt={{$campaignelemento->imagen}}
                                        title={{$campaignelemento->imagen}} id="original" class="img-fluid img-thumbnail"
                                        style="height: 350px;cursor:pointer"
                                        onclick='document.getElementById("inputFile{{$campaignelemento->id}}").click()' />
                                    @endif
                                    @can('campaign.edit')
                                    <a href="#" name="Upload"
                                    onclick="subirImagen('formelemento','{{$campaignelemento->id}}')"><i
                                    class="fas fa-upload text-primary fa-lg mx-1"></i></a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @can('campaign.edit')
                            <button type="submit" class="btn btn-primary">Submit</button>
                            @endcan
                            <a class="btn btn-default" href="{{route('campaign.elementos',$campaign->id)}}" title="Ir la página anterior">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scriptchosen')

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
                url: "{{ route('campaign.elemento.update') }}",
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

    function subirImagen(formulario,elementoId){
        var token= $('#token').val();
        var campaignID=$('#campaignID').val();
        let timestamp = Math.floor( Date.now() );
        $.ajaxSetup({
            headers: { "X-CSRF-TOKEN": $('#token').val() },
        });
        
        var formElement = document.getElementById(formulario);
        var formData = new FormData(formElement);
        formData.append("elementoId", elementoId);
        
        $.ajax({
            type:'POST',
            url: "{{ route('campaign.elementos.updateimagenindex') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                // $('#'+formulario +' img').remove();
                $('#original').attr('src', '/storage/galeria/'+ campaignID+'/'+ data.imagen+'?ver=' + timestamp);
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
    $('#navelemento').toggleClass('activo');
</script>

@endpush