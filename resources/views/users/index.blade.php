@extends('layouts.grafitex')

@section('styles')
@endsection

@section('title','Grafitex-Users')
@section('titlePag','Usuarios')
@section('navbar')
    @include('_partials._navbar')
@endsection


@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('campaign') }} --}}
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
                    </div>
                    <div class="col-auto mr-auto">
                        @can('user.create')
                        <a href="" role="button" data-toggle="modal" data-target="#userCreateModal">
                            <i class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
                        </a>
                        @endcan
                        {{-- <a href="{{ route('user.tempo') }}" title="">rol usuarios tiendas</i></a> --}}
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
                    <div class="card-body">
                        {{-- links  y cuadro busqueda --}}
                        <div class="row">
                            <div class="col-10 row">
                                {{ $users->appends(request()->except('page'))->links() }} &nbsp; &nbsp;
                                Hay {{$users->total()}} usuarios.
                            </div>
                            <div class="col-2 float-right mb-2">
                                <form method="GET" action="{{route('user.index') }}">
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
                            <table  class="table table-hover table-sm small" cellspacing="0" width=100%>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>created_at</th>
                                        <th>updated_at</th>
                                        <th width="150px">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr data-id="{{$user->id}}">
                                        <form id="form{{$user->id}}" role="form" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                                        {{-- <form id="form{{$user->id}}" role="form" method="post" action="{{ route('user.updateimagenindex') }}" enctype="multipart/form-data"> --}}
                                            @csrf
                                            {{-- <input type="text" class="d-none" id="id" name="id" value="{{$user->id}}"> --}}
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @foreach($user->roles as $rol)
                                                    {{$rol->name}}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach


                                            </td>
                                            <td>{{$user->created_at}}</td>
                                            <td>{{$user->updated_at}}</td>
                                            <td width="100px">
                                                <div class="text-center">
                                                @can('user.edit')
                                                <a href="{{ route('user.edit',$user->id) }}" title="Edit"><i class="far fa-edit text-primary fa-2x mx-1"></i></a>
                                                @endcan
                                                @can('user.destroy')
                                                <a href="#!" class="btn-delete " title="Eliminar"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></a>
                                                @endcan
                                            </div>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="userCreateModal" tabindex="-1" role="dialog" aria-labelledby="userCreateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userCreateModalLabel">Nuevo usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('user.store') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                {{-- <input  type="hidden" class="form-control form-control-sm" id="pais" name="pais" value="si no lo pongo da error ¿¿?? algun resto de memoria"> --}}
                                <div class="row">
                                    <div class="form-group  col-4">
                                        <label for="name">Nombre</label>
                                        <input  type="text" class="form-control form-control-sm" id="name" name="name" value="{{old('name')}}" required>
                                    </div>
                                    <div class="form-group  col-4">
                                        <label for="email">Email</label>
                                        <input  type="email" class="form-control form-control-sm" id="email" name="email" value="{{old('email')}}" required>
                                    </div>
                                    <div class="form-group  col-4">
                                        <label for="password">Password</label>
                                        <input  type="password" class="form-control form-control-sm" id="password" name="password" value="{{old('password')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                @can('user.create')
                                <button type="button" class="btn btn-primary" name="Guardar" onclick="form.submit()">Guardar</button>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <form id="formDelete" action="{{route('user.destroy',':ELEMENTO_ID')}}" method="POST" style="display:inline">
                <input type="hidden" name="_method" value="DELETE" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                {{-- <button type="submit" class="enlace"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></button> --}}
            </form>
        </section>
    </div>


@endsection

@push('scriptchosen')

<script>
    @include('_partials._errortemplate')
</script>
    
<script>
    $(document).ready( function () {
        $('.btn-delete ').click(function(){
           
            $confirmacion=confirm('¿Seguro que lo quieres eliminar?');

            if($confirmacion){
                var row= $(this).parents('tr');
                var id=row.data('id');
                var form=$('#formDelete');
                var url=form.attr('action').replace(':ELEMENTO_ID',id);
                var data=form.serialize();

                $.post(url,data,function(result){
                    toastr.options={
                        progressBar:true,
                        positionClass:"toast-top-center"
                    };
                    toastr.success(result.notificacion.message);
                    row.fadeOut();
                }).fail(function(){
                    toastr.options={
                        closeButton: true,
                        progressBar:true,
                        positionClass:"toast-top-center",
                        showDuration: "300",
                        hideDuration: "1000",
                        timeOut: 0,
                    };
                    toastr.error("No se puede eliminar.");
                });
            }
        });
    });

    $('#menuusuarios').addClass('active');
    // $('#navcampaigns').toggleClass('activo');

</script>

@endpush

