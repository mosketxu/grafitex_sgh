@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Editar Usuario')
@section('titlePag','Edición de Usuario')
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
                    <h5>Edición del usuario <span class="text-primary">{{$user->id}} - {{$user->name}} </span></h5>
                </div>
                <form id="formuser" role="form" method="post" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group  col-4">
                                <label for="name">Nombre</label>
                                <input  type="text" class="form-control form-control-sm" id="name" name="name" value="{{old('name',$user->name)}}" required>
                            </div>
                            <div class="form-group  col-4">
                                <label for="email">Email</label>
                                <input  type="email" class="form-control form-control-sm" id="email" name="email" value="{{old('email',$user->email)}}" required>
                            </div>
                            <div class="form-group  col-4">
                                <label for="password">Password</label>
                                <input  type="password" class="form-control form-control-sm" id="password" name="password" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <ul class="list-unstyled">
                                    @foreach ($roles as $rol )
                                    <li>
                                        <label>
                                            @can('user.edit')
                                            <input type="checkbox" name="roles[]" value="{{$rol->id}}"  
                                                {{ (in_array($rol->id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'roles.id')->contains($rol->name)) ? 'checked' : '' }}>
                                                {{$rol->name}} - <em>{{$rol->description}} </em>
                                            @elsecan('user.show')
                                            <input type="checkbox" name="roles[]" value="{{$rol->id}}" class="d-none"  
                                                {{ (in_array($rol->id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'roles.id')->contains($rol->name)) ? 'checked' : '' }}>
                                                {{$rol->name}} - <em>{{$rol->description}} </em>
                                            @endcan    
                                        </label>

                                        {{old('rol_id')==$rol->id ? 'checked' : ''}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- <div class="form-group  col-12">
                                <label for="roles">Roles</label>
                                <select name="roles[]" id="roles" data-placeholder="Roles..." class="form-control select2" multiple>
                                    @foreach ($roles as $rol )
                                        <option value="{{$rol->id}}"
                                            {{ (in_array($rol->id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'roles.id')->contains($rol->name)) ? 'selected' : '' }}>
                                            {{$rol->name}}
                                        </option>                                
                                    @endforeach
                                </select>
                            </div> --}}
           
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('home')}}" type="button" class="btn btn-default">Volver</a>
                        @canany(['user.edit','user.show'])
                        <button type="button" class="btn btn-primary" name="Guardar" onclick="form.submit()">Actualizar</button>
                        @endcan
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
        placeholder: 'Roles'
    });

    $('#menuuser').addClass('active');
    // $('#navgaleria').toggleClass('activo');
</script>

<script>@include('_partials._errortemplate')</script>

@endpush