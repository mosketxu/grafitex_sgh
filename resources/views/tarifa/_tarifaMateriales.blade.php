<div class="card">
   <div class="card-header text-white bg-teal p-1" data-card-widget="collapse" style="cursor: pointer">
      <h3 class="card-title pl-3">Tarifas Materiales</h3>
      <div class="card-tools pr-3">
         <button type="button" class="btn btn-tool"><i class="fas fa-minus"></i></button>
      </div>
   </div>
   <div class="card-body">
      {{-- links  y cuadro busqueda --}}
      <div class="row">
         <div class="col-10 row">
            {{ $tarifasMateriales->appends(request()->except('page'))->links() }}
         </div>
         <div class="col-2 float-right mb-2">
            <form method="GET" action="{{route('tarifa.index') }}">
               <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fas fa-search fa-sm text-primary"></i></span>
                  </div>
                  <input id="busca" name="busca" type="text" class="form-control" name="search" value='{{$busqueda}}'
                     placeholder="Search for..." />
               </div>
            </form>
         </div>
      </div>

      <div class="table-responsive">
         <table id="tTarifas" class="table table-hover table-sm small sortable" cellspacing="0" width=100%>
            <thead>
               <tr>
                  <th>Familia</th>
                  <th class="text-center">Tramo 1</th>
                  <th class="bg-light text-center">Tarifa 1</th>
                  {{-- <th class="text-center">Tramo 2</th>
                  <th class="bg-light text-center">Tarifa 2</th>
                  <th class="text-center">Tramo 3</th>
                  <th class="bg-light text-center">Tarifa 3</th> --}}
                  <th width="150px" class="text-center"><span class="ml-1">Acción</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($tarifasMateriales as $tarifaMaterial)
               <tr>
                  {{-- <form id="form{{$tarifaMaterial->id}}" role="form" method="post"
                  action="javascript:void(0)"> --}}
                  <td>{{$tarifaMaterial->familia}}</td>
                  <td class="text-center">{{$tarifaMaterial->tramo1}} </td>
                  <td class="bg-light text-center">{{$tarifaMaterial->tarifa1}} €</td>
                  {{-- <td class="text-center">{{$tarifaMaterial->tramo2}} </td>
                  <td class="bg-light text-center">{{$tarifaMaterial->tarifa2}} €</td>
                  <td class="text-center">{{$tarifaMaterial->tramo3}} </td>
                  <td class="bg-light text-center">{{$tarifaMaterial->tarifa3}} €</td> --}}
                  <td width="100px">
                     <form id="form_id" role="form" method="post"
                        action="{{ route('tarifa.destroy',$tarifaMaterial->id) }}">
                        <div class="text-center">
                           @can('tarifa.create')
                           <a href="{{ route('tarifa.edit',$tarifaMaterial->id) }}" title="Edit">
                              <i class="far fa-edit text-primary fa-2x mx-1"></i>
                           </a>
                           @endcan
                           @csrf
                           @method('DELETE')
                           @can('presupuesto.destroy')
                           <button type="submit" class="enlace"><i
                              class="far fa-trash-alt text-danger fa-2x ml-1"></i></button>
                           @endcan
                        </div>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>