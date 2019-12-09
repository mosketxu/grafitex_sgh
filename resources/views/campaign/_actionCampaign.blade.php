<div class="text-right">
        @if($campaign_state==="Creada")
                <i class="fas fa-circle text-primary fa-2x"></i>
        @elseif($campaign_state==="Iniciada")
                <i class="fas fa-circle text-teal fa-2x"></i>
        @elseif($campaign_state==="Finalizada")
                <i class="fas fa-circle text-fuchsia fa-2x"></i>
        @else
                <i class="fas fa-circle text-warning fa-2x"></i>
        @endif
        &nbsp; &nbsp;&nbsp;
        <a href="{{route('campaign.filtrar', $id) }}" title="Filtrar"><i class="fas fa-filter text-navy fa-2x mx-1"></i></a>
        <a href="{{route('campaign.elementos', $id ) }}" title="Elementos"><i class="far fas fa-cubes text-teal fa-2x mr-1"></i></a>
        <a href="{{route('campaign.galeria', $id ) }}" title="Galeria"><i class="far fa-images text-purple fa-2x mr-1"></i></a>
        <a href="{{route('campaign.presupuesto', $id ) }}" title="Presupuesto"><i class="fas fa-money-check-alt text-fuchsia fa-2x mr-1"></i></a>
        {{-- <a href="{{route('campaign.albaranes', $id ) }}" title="Albaranes"><i class="fas fa-truck text-orange fa-2x mr-1"></i></a> --}}
        <a href="{{route('campaign.edit', $id )}}" title="Edit"><i class="far fa-edit text-primary fa-2x ml-1"></i></a>
        <a href="{{route('campaign.eliminar', $id )}}" title="Delete"><i class="far fa-trash-alt text-danger fa-2x ml-1"></i></a>
</div> 