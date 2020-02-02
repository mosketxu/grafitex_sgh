        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
    
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        
        <!-- Select2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>

        <!-- Bootstrap4 Duallistbox -->
        <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
        
        <!-- datatables todo  -->
        {{-- incluido pero no estilo bootstrap pq no queda del todo bien --}}
        <script type="text/javascript" src="{{ asset('plugins/datatables/datatables.min.js')}}"></script>
    
        <!-- ekko-lightbox -->
        <script type="text/javascript" src=https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js></script>
    
        <!-- Toastr -->
        <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>
        
        <!-- AdminLTE App -->
        <script src="{{ asset('js/adminlte.js')}}"></script>

