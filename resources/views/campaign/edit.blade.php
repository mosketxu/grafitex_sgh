@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Campaña Editar')
@section('titlePag','Edición de la campaña')
@section('navbar')
@include('campaign._navbarcampaign')
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
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-info">
                    {{Session::get('success')}}
                </div>
                @endif
            <div class="card">
                <form id="formcampaign" role="form" method="POST" action="{{ route('campaign.update',$campaign->id) }}">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="card-header">
                        Modifica los datos
                    </div>
                    <div class="card-body">
                        <div class="form-group col">
                            <label for="campaign_name">Campaña</label>
                            <input type="text" class="form-control form-control-sm" id="campaign_name" name="campaign_name" value="{{ old('campaign_name',$campaign->campaign_name) }}"/>
                        </div>
                        <div class="form-group col">
                            <label for="campaign_initdate">Fecha Inicio</label>
                            <input type="date" class="form-control form-control-sm" id="campaign_initdate" name="campaign_initdate" value="{{ old('campaign_initdate',$campaign->campaign_initdate) }}"/>
                        </div>
                        <div class="form-group col">
                            <label for="campaign_enddate">Fecha Fin Prevista</label>
                            <input type="date" class="form-control form-control-sm" id="campaign_enddate" name="campaign_enddate" value="{{ old('campaign_enddate',$campaign->campaign_enddate) }}"/>
                        </div>
                        <div class="form-group col">
                            <label for="campaign_state">Estado</label>
                            <select name="campaign_state" id="campaign_state" class="form-control form-control-sm">
                                <option value="{{$campaign->campaign_state}}">{{$campaign->campaign_state}}</option>                                
                                <option value="Creada">Creada</option>                                
                                <option value="Iniciada">Iniciada</option>                                
                                <option value="Finalizada">Finalizada</option>                                
                                <option value="Cancelada">Cancelada</option>                             
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <input type ='button' class="btn btn-default" onclick="javascript:history.back()" value="Volver"/>
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

</script>

<script>
    $('#menucampaign').addClass('active');
    $('#navcampaignedit').toggleClass('activo');
</script>

@endpush
