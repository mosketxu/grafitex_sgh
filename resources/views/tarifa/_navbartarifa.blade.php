<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav  mr-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    @can('tarifa.index')
    <li class="nav-item d-none d-sm-inline-block">
      <a  href="{{route('tarifa.index') }}" class="nav-link" title="Familas"><span id="navtarifas"  class="px-1">Tarifas</span></a>
    </li>
    @endcan
    @can('tarifafamilia.index')
    <li class="nav-item d-none d-sm-inline-block" >
      <a  href="{{route('tarifafamilia.index') }}"class="nav-link" title="Familias"><span id="navfamilias" class="px-1">Familias</span></a>
    </li>
    @endcan
  </ul>
    <!-- Right Side Of Navbar --> 
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
          <li class="nav-item">
              {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
          </li>
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
      @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>
  
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
  
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li>
        @endguest
    </ul>
</nav>
<!-- /.navbar -->