<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a  href="{{route('campaign.index') }}" class="nav-link" title="Campañas"><span id="navcampaigns"  class="px-1"> <i class="nav-icon fas fa-campground text-warning fa-lg"></i></span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block" >
      <a  href="{{route('campaign.filtrar',$campaign->id) }}"class="nav-link" title="Filtros"><span id="navfiltros" class="px-1"><i class="fas fa-filter text-navy fa-lg"></i></span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.elementos',$campaign->id) }}"  class="nav-link" title="Elementos"><span id="navelementos"  class="px-1"><i class="far fas fa-cubes text-teal fa-lg"></i></span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.conteo',$campaign->id) }}" class="nav-link" title="Estadísticas"><span id="navestadisticas" class="px-1"><i class="fas fa-chart-bar text-orange fa-lg"></i></span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.galeria',$campaign->id) }}" class="nav-link" title="Galeria"><span id="navgaleria" class="px-1"><i class="far fa-images text-purple fa-lg"></i></span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.presupuesto',$campaign->id) }}" class="nav-link" title="Presupuesto"><span id="navpresupuesto" class="px-1"><i class="fas fa-money-check-alt text-fuchsia fa-lg"></i></span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.etiquetas.pdf',$campaign->id) }}" class="nav-link" title="Etiquetas"><span id="navetiquetas" class="px-1"><i class="fas fa-tags text-maroon fa-lg"></i></span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a  href="{{route('campaign.etiquetas.index',$campaign->id) }}" class="nav-link" title="Etiquetas HTML"><span id="navetiquetas" class="px-1"><i class="fas fa-code text-indigo fa-lg"></i></span></a>
    </li>
  </ul>

  
</nav>
<!-- /.navbar -->