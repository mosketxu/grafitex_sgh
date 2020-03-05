<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Presupuesto {{$presupuesto->referencia}}</title>

<link rel="stylesheet" href="{{ asset('css/pdf.css')}}">

{{-- sobreescribo margenes de pdf.css --}}
<style>
    @page {margin: 50px 50px;}
</style>
</head>

<body>
    @if($totalStoresEs>0)
        @include('reporting._presupNacional')
    @endif
    @if($totalStoresEs>0 && $totalStoresPt>0)
        <div style="page-break-after:always;"></div>
    @endif
    @if($totalStoresPt>0)
        @include('reporting._presupPortugal')
    @endif

</body>

</html>