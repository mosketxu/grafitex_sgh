<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Descripcion -->        
        <meta name="description" content="Aplicación desarrollada por Grafitex">

        <!-- styles -->
        @include('_partials._styles')
        @yield('styles')

        <title>@yield('title')</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
        <div class="wrapper">
            <!-- Navbar -->
            @yield('navbar')
            <!-- Main Sidebar Container -->            
            @include('_partials._sidebar')
            <!-- Content Wrapper. Contains page content -->
            {{-- @include('_partials._content') --}}
            @yield('content')
            <!-- Footer -->
            @include('_partials._footer')
  
            <!-- Control Sidebar -->
            @include('_partials._controlsidebar')
         </div>
        <!-- ./wrapper -->

        @include('_partials._scripts')

        @yield('script')
        @stack('scriptchosen')
    </body>
</html>
