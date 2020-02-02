<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('img/grafitexLogo.png')}}" alt="Grafitex Logo" class="brand-image elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Grafitex</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul id="main-menu" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @can('store.index')
                <li class="nav-item">
                    <a href="{{route('store.index') }}" id="menustores" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>Stores</p>
                    </a>
                </li>
                @endcan
                @can('tiendas.index')
                <li class="nav-item">
                    <a href="{{route('tienda.control') }}" id="menutiendas" class="nav-link"> 
                        <i class="nav-icon fas fa-glasses"></i>
                        <p>Tiendas</p>
                    </a>
                </li>
                @endcan
                @can('elemento.index')
                <li class="nav-item">
                    <a href="{{route('elemento.index') }}" id="menuelementos" class="nav-link">
                        <i class="nav-icon far fas fa-cubes"></i>
                        <p>Elementos</p>
                    </a>
                </li>
                @endcan
                @can('auxiliares.index')
                <li class="nav-item">
                    <a href="{{route('auxiliares.index')}}" id="menuauxiliares" class="nav-link">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>Auxiliares</p>
                    </a>
                </li>
                @endcan
                @can('campaign.index')
                <li class="nav-item">
                    <a href="{{route('campaign.index') }}" id="menucampaign" class="nav-link">
                        <i class="nav-icon fas fa-campground "></i>
                        <p>Campañas </p>
                    </a>
                </li>
                @endcan
                @can('tarifa.index')
                <li class="nav-item">
                    <a href="{{route('tarifa.index') }}" id="menutarifa" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-alt"></i>
                        <p>Tarifas</p>
                    </a>
                </li>
                @endcan
                @can('maestro.index')
                <li class="nav-item">
                    <a href="{{route('maestro.index') }}" id="menumaestro" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Maestro</p>
                    </a>
                </li>
                @endcan
                @can('user.index')
                <li class="nav-item">
                    <a href="{{route('user.index') }}" id="menuusers" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>
                @endcan
                @can('roles.index')
                <li class="nav-item">
                    <a href="{{route('roles.index') }}" id="menuroles" class="nav-link">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>Roles</p>
                    </a>
                </li>
                @endcan
                @can('permission.index')
                <li class="nav-item">
                    <a href="{{route('permission.index') }}" id="menupermisos" class="nav-link">
                        <i class="nav-icon fas fa-unlock-alt"></i>
                        <p>Permisos</p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>