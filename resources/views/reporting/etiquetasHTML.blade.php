<html>
    <head>
        <style>
            /** Define the margins of your page **/
        </style>
        <link rel="stylesheet" href="{{ asset('css/impresion.css')}}">
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
        </header>
        <footer>
            {{-- {{now()}}  --}}
        </footer>


        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div class="">
                @foreach($etiquetas->campTiendas as $campaignstore)        
                    <div class="">
                        <table width="100%" cellspacing="0">
                            <thead>
                                <tr style="background-color: #139cdc;">
                                    <th style="text-align: right;" width="25%">
                                        <img src="{{asset('img/grafitexLogo.png')}}" width="50px"></th>
                                    <th style="color:#ffffff;text-align:center;"  width="50%">
                                        MATERIAL INTERNO <br>
                                        CAMPAÑA {{$etiquetas->campaign_name}}<br>
                                        Grafitex Servicios Digitales, S.A.
                                    </th>
                                    <th style="color:#ffffff;text-align:center;"  width="25%">
                                        Fecha prevista:<br> 
                                        {{$etiquetas->campaign_enddate}}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
    
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
                                @foreach($campaignstore->cElementos->chunk(5) as $chunk)
                                <tr>
                                    @foreach($chunk as $etiqueta)
                                    <td class="celda">
                                        Nombre: {{$etiqueta['carteleria'] }}<br>
                                        Mobiliario: {{$etiqueta['mobiliario'] }}<br>
                                        Material: {{$etiqueta['material'] }}<br>
                                        Medida: {{$etiqueta['medida'] }}<br>
                                        Cantidad: {{$etiqueta['unitxprop'] }}<br>
                                        @if(file_exists( 'storage/galeria/'.$etiquetas->id.'/'.$etiqueta['imagen'] ))
                                            <img src="{{asset('storage/galeria/'.$etiquetas->id.'/'.$etiqueta['imagen'].'?'.time())}}" class="img-thumbnail"/>
                                        @else
                                            <img src="{{asset('storage/galeria/pordefecto.jpg')}}" class="img-thumbnail"/>
                                        @endif                                        
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="idioma">
                            Idioma:{{$campaignstore->tienda->country}}
                        </div>
                    <div style="page-break-after:always;"></div>
                @endforeach
            </div>
        </main>
    </body>
</html>