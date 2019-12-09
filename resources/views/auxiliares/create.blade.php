@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Nuevo '.ucfirst($campo))
@section('titlePag','Nuevo '.ucfirst($campo))
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
            <div class="container">
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
            <div class="container">
                <div class="card"  style="width:65%;">
                    <div class="card-header">
                        <div class="row">
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('elemento.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-2">
                                    <label for="ubicacion_id">Ubicación</label>
                                    <select class="form-control form-control-sm" id="ubicacion_id" name="ubicacion_id">
                                        <option value="">Selecciona</option>
                                        @foreach($ubicaciones as $ubicacion )
                                        <option value="{{old('ubicacion_id', $ubicacion->id)}}" required>{{$ubicacion->ubicacion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-4">
                                    <label for="mobiliario_id">Mobiliario</label>
                                    <select class="form-control form-control-sm" id="mobiliario_id" name="mobiliario_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($mobiliarios as $mobiliario )
                                        <option value="{{$mobiliario->id}}">{{$mobiliario->mobiliario}} required</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="propxelemento_id">Prop x Elemento</label>
                                    <select class="form-control form-control-sm" id="propxelemento_id" name="propxelemento_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($propxelementos as $propxelemento )
                                        <option value="{{$propxelemento->id}}">{{$propxelemento->propxelemento}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-3">
                                    <label for="carteleria_id">Carteleria</label>
                                    <select class="form-control form-control-sm" id="carteleria_id" name="carteleria_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($cartelerias as $carteleria )
                                        <option value="{{$carteleria->id}}">{{$carteleria->carteleria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="medida_id">Medida</label>
                                    <select class="form-control form-control-sm" id="medida_id" name="medida_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($medidas as $medida )
                                        <option value="{{$medida->id}}">{{$medida->medida}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-4">
                                    <label for="material_id">Material</label>
                                    <select class="form-control form-control-sm" id="material_id" name="material_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($materiales as $material )
                                        <option value="{{$material->id}}">{{$material->material}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-1">
                                    <label for="unitxprop">Uds</label>
                                    <select class="form-control form-control-sm" id="unitxprop" name="unitxprop" >
                                        <option value="">Selecciona</option>
                                        @for($i = 0; $i<20; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="observaciones">Observaciones</label>
                                    <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" ></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" name="Guardar" onclick="form.submit()">Guardar</button>
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
    $('#menumantenimiento').addClass('active');
    // $('#navelemento').toggleClass('activo'); 
</script>
<script>@include('_partials._errortemplate')</script>

@endpush