<html>
    <head>
        <style>
            @page {
               margin: 10px 25px;
            }
        </style>
        <link rel="stylesheet" href="{{ asset('css/pdf.css')}}">
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
        </header>
        <footer>
            {{now()}} 
        </footer>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            {{-- // dd($etiquetas->tiendaselementos->elementos); --}}
            @foreach($etiquetas->tiendaselementos as $campaignstore)
            
            <div class="">
                <table width="100%" cellspacing="0">
                    <thead>
                        <tr style="background-color: #139cdc;">
                            <th style="text-align: right;" width="25%">
                                <img src="{{asset('img/grafitexLogo.png')}}" width="50px"></th>
                            <th style="color:#ffffff;text-align:center;"  width="50%">
                                Material Interno <br>
                                Campaña: {{$etiquetas->campaign_name}}<br>
                                Grafitex Servicios Digitales, S.A.
                            </th>
                            <th style="color:#ffffff;text-align:center;font-size:0.9em;"  width="25%">
                                Fecha prevista: <br>
                                {{$etiquetas->campaign_enddate}}
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="etiquetas">
                    <table width="100%" cellspacing="0" border="1">
                        <thead>
                            <tr>
                                <th style="text-align: center;" width="25%">
                                    {{$campaignstore->store_id}} <br>
                                    {{$campaignstore->tienda->segmento}}
                                </th>
                                <th class="{{trim(strtolower($campaignstore->tienda->segmento))}}"  width="50%">
                                    {{$campaignstore->tienda->name}}
                                </th>
                                <th style="text-align:center;"  width="25%">
                                    <img src="{{asset('img/SGH.jpg')}}" height="25px">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
                <div>
                    <table width="100%">
                        <thead>
                            <tr>
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($campaignstore->elementos->chunk(5) as $chunk)
                            <tr>
                                @foreach($chunk as $etiqueta)
                                <td class="celda">
                                    Nombre: {{$etiqueta['carteleria'] }}<br>
                                    Mobiliario: {{$etiqueta['mobiliario'] }}<br>
                                    Material: {{$etiqueta['material'] }}<br>
                                    Medida: {{$etiqueta['medida'] }}<br>
                                    Cantidad: {{$etiqueta['unitxprop'] }}<br>
                                    @if(file_exists( 'storage/galeria/'.$etiquetas->id.'/'.$etiqueta['imagen'] ))
                                        <img src="{{asset('storage/galeria/'.$etiquetas->id.'/'.$etiqueta['imagen'])}}" class="img-thumbnail" alt="{{$etiqueta['imagen']}}"/>
                                    @else
                                        <img src="{{asset('storage/galeria/pordefecto.jpg')}}" class="img-thumbnail" alt="pordefecto.jpg"/>
                                    @endif                                        
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="idioma">
                    Idioma:{{$campaignstore->tienda->idioma}}
                </div>
                <div style="page-break-after:always;"></div>
            @endforeach
            </div>
        </main>
    </body>
</html>