<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a  href="{{route('campaign.index') }}" class="nav-link" title="Campañas"><span id="navcampaigns"  class="px-1">Campañas</span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block" >
      <a  href="{{route('campaign.filtrar',$campaign->id) }}"class="nav-link" title="Filtros"><span id="navfiltros" class="px-1">Filtros</span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.elementos',$campaign->id) }}"  class="nav-link" title="Elementos"><span id="navelementos"  class="px-1">Elementos</span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.conteo',$campaign->id) }}" class="nav-link" title="Estadísticas"><span id="navestadisticas" class="px-1">Estadísticas</span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.galeria',$campaign->id) }}" class="nav-link" title="Galeria"><span id="navgaleria" class="px-1">Galeria</span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.presupuesto',$campaign->id) }}" class="nav-link" title="Presupuesto"><span id="navpresupuesto" class="px-1">Presupuesto</span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.etiquetas.pdf',$campaign->id) }}" class="nav-link" title="Etiquetas"><span id="navetiquetas" class="px-1">Etiquetas</span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.etiquetas.index',$campaign->id) }}" class="nav-link" title="Etiquetas"><span id="navetiquetas" class="px-1"><i class="far fa-file-code"></i></span></a>
    </li>
  </ul>

  
</nav>
<!-- /.navbar -->