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
    @if($totalMaterialesEs>0)
        @include('reporting._presupNacional')
        <div style="page-break-after:always;"></div>
    @endif
    @if($totalMaterialesEs>0)
        @include('reporting._presupPortugal')
    @endif

</body>

</html>