@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Editar Elemento')
@section('titlePag','Editar Elemento')
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
                <div class="card">
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
                                        <option value={{$elemento->ubicacion_id}}>{{$elemento->ubi->ubicacion}}</option>
                                        @foreach($ubicaciones as $ubicacion )
                                        <option value="{{$ubicacion->id}}" {{old('ubicacion_id')==$ubicacion->id ? 'selected' : ''}}>{{$ubicacion->ubicacion}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-4">
                                    <label for="mobiliario_id">Mobiliario</label>
                                    <select class="form-control form-control-sm" id="mobiliario_id" name="mobiliario_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($mobiliarios as $mobiliario )
                                        <option value="{{$mobiliario->id}}" {{old('mobiliario_id')==$mobiliario->id ? 'selected' : ''}}>{{$mobiliario->mobiliario}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="propxelemento_id">Prop x Elemento</label>
                                    <select class="form-control form-control-sm" id="propxelemento_id" name="propxelemento_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($propxelementos as $propxelemento )
                                        <option value="{{$propxelemento->id}}" {{old('propxelemento_id')==$propxelemento->id ? 'selected' : ''}}>{{$propxelemento->propxelemento}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-3">
                                    <label for="carteleria_id">Carteleria</label>
                                    <select class="form-control form-control-sm" id="carteleria_id" name="carteleria_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($cartelerias as $carteleria )
                                        <option value="{{$carteleria->id}}" {{old('carteleria_id')==$carteleria->id ? 'selected' : ''}}>{{$carteleria->carteleria}}</option>
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
                                        <option value="{{$medida->id}}" {{old('medida_id')==$medida->id ? 'selected' : ''}}>{{$medida->medida}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-4">
                                    <label for="material_id">Material</label>
                                    <select class="form-control form-control-sm" id="material_id" name="material_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($materiales as $material )
                                        <option value="{{$material->id}}" {{old('material_id')==$material->id ? 'selected' : ''}}>{{$material->material}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-1">
                                    <label for="unitxprop">Uds</label>
                                    <select class="form-control form-control-sm" id="unitxprop" name="unitxprop" >
                                        <option value="">Selecciona</option>
                                        @for($i = 1; $i<20; $i++)
                                        <option value="{{$i}}" {{old('unitxprop')==$i ? 'selected' : ''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group  col-3">
                                    <label for="material_id">Familia</label>
                                    <select class="form-control form-control-sm" id="familia_id" name="familia_id" >
                                        <option value="">Selecciona</option>
                                        @foreach($familias as $familia )
                                        <option value="{{$familia->id}}" {{old('familia_id')==$familia->id ? 'selected' : ''}}>{{$familia->familia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <input  type="text" class="form-control form-control-sm" id="observaciones" name="observaciones" value="{{old('observaciones')}}">
                            </div>
                            <div class="footer">
                                <a type="button" class="btn btn-default" href="{{route('elemento.index')}}">Volver</a>
                                <input class="btn btn-primary" type="submit" value="Guardar">
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