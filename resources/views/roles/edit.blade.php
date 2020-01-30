@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Editar Rol')
@section('titlePag','Edición de Rol')
@section('navbar')
    @include('_partials._navbar')
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
                    <h5>Edición del rol <span class="text-primary">{{$role->id}} - {{$role->name}} </span></h5>
                </div>
                <form id="formrol" role="form" method="post" action="{{ route('roles.update',$role->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group  col-4">
                                <label for="name">Nombre</label>
                                <input  type="text" class="form-control form-control-sm" id="name" name="name" value="{{old('name',$role->name)}}" required>
                            </div>
                            <div class="form-group  col-4">
                                <label for="description">Descripción</label>
                                <input  type="text" class="form-control form-control-sm" id="description" name="description" value="{{old('description',$role->description)}}" required>
                            </div>
                            <div class="col-4">
                                <label for="slug">Special Access</label><br>
                                <div class="input-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input  type="radio" class="form-check-input" name="special" value="{{old('special','all-access')}}" {{$role->special=='all-access' ? 'checked' :''}}>
                                            All access &nbsp; &nbsp; 
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input  type="radio" class="form-check-input" name="special" value="{{old('special','no-access')}}" {{$role->special=='no-access' ? 'checked' :''}}>
                                            No access &nbsp; &nbsp;
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input  type="radio" class="form-check-input" name="special" value="{{old('special')}}" {{$role->special=='' ? 'checked' :''}}>
                                            No special access
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <div class="row">
                                @foreach($permissions->chunk(5) as $chunk) 
                                    <ul class="list-unstyled col-2">
                                        @foreach ($chunk as $permission )
                                        <li>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"  
                                                    {{ (in_array($permission->id, old('permissions', [])) || isset($role) && $role->permissions()->pluck('name', 'permissions.id')->contains($permission->name)) ? 'checked' : '' }}>
                                                    <span class="labelpermiso">{{$permission->name}}</span> 
                                            </label>
                                            {{old('permissions_id')==$permission->id ? 'checked' : ''}}
                                        </li>
                                        @endforeach
                                        <hr>
                                    </ul>
                                @endforeach
                                </div>
                            </div>
                             {{-- <div class="form-group  col-12">
                                <label for="permissions">Permisos</label>
                                <select name="permissions[]" id="permissions" data-placeholder="Permisos..." class="form-control select2" multiple>
                                    @foreach ($permissions as $permission )
                                        <option value="{{$permission->id}}"
                                            {{ (in_array($permission->id, old('permissions', [])) || isset($role) && $role->permissions()->pluck('name', 'permissions.id')->contains($permission->name)) ? 'selected' : '' }}>
                                            {{$permission->name}}
                                        </option>                                
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('roles.index')}}" type="button" class="btn btn-default">Volver</a>
                        <button type="button" class="btn btn-primary" name="Guardar" onclick="form.submit()">Actualizar</button>
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
    $('.select2').select2({
        placeholder: 'permissions'
    });

    $('#menuroles').addClass('active');
    // $('#navgaleria').toggleClass('activo');
</script>

<script>@include('_partials._errortemplate')</script>

@endpush