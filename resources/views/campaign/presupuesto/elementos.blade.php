@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Elementos famila prespuesto') 
@section('titlePag','Detalle elementos del presupuesto') 
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
                        <div class="row">
                            <div class="col-10 row">
                            </div>
                            <div class="col-2 float-right mb-2">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm small sortable" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Material</th>
                                        <th>Medida</th>
                                        <th>Id tarifa</th>
                                        <th>Tarifa Antigua</th>
                                        <th>Tarifa Nueva</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($elementos as $elemento)
                                    <form id="form{{$elemento->id}}" role="form" method="post" action="{{ route('campaign.presupuesto.updateelemento') }}" >
                                    @method('PUT')
                                    @csrf
                                        <tr>
                                            <input type="hidden" name="elemento_id" value="{{$elemento->elemento_id}}" >
                                            <td>{{$elemento->elemento_id}}</td>
                                            <td>{{$elemento->material}}</td>
                                            <td>{{$elemento->medida}}</td>
                                            <td>{{$elemento->familia}}</td>
                                            <td>{{$elemento->tarifa->familia}}</td>
                                            <td>
                                                <select class="form-control-sm" name="familia" id="familia" onchange="update('form{{$elemento->id}}',{{$elemento->id}})" class="form-control-plaintext my-0 py-0">
                                                    <option value="{{$elemento->familia}}" selected>{{$elemento->tarifa->familia}}</option>
                                                    @foreach($tarifas as $tarifa)
                                                    <option value="{{$tarifa->id}}">{{$tarifa->familia}}</option>                                
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button type="submit" class="enlace">
                                                    <i class="far fa-edit text-primary fa-2x mx-1"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </form>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-default" href="{{route('campaign.presupuesto.cotizacion',$presupuesto)}}" title="Ir la página anterior">Volver</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scriptchosen')

<script>
    function update(formulario,id) {
        var token= $('#token').val();
         $.ajaxSetup({
             headers: { "X-CSRF-TOKEN": $('#token').val() },
         });
        var formElement = document.getElementById(formulario);
        var formData = new FormData(formElement);
 
        $.ajax({
            type:'POST',
            url: "{{ route('campaign.presupuesto.updateelemento') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                toastr.info('Asignacion actualizada con éxito',{
                    "progressBar":true,
                    "positionClass":"toast-top-center"
                });
            },
            error: function(data){
                console.log(data);
                toastr.error("No se ha actualizado la asignacion",{
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
    $('#navelementos').toggleClass('activo');
</script>

@endpush