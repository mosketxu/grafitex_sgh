<html>
    <head>
        <style>
            /** Define the margins of your page **/
        </style>
        <link rel="stylesheet" href="{{ asset('css/pdf.css')}}">
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <table width="100%" cellspacing="0">
                <thead>
                    <tr style="background-color: #139cdc;">
                        <th style="text-align: right;" width="25%">
                            <img src="{{asset('storage/grafitexLogo.png')}}" width="50px"></th>
                        <th class="titulo"  width="50%">
                            MATERIAL INTERNO <br>
                            CAMPAÑA {{$campaign->campaign_name}}<br>
                            Grafitex Servicios Digitales, S.A.
                        </th>
                        <th style="color:#ffffff;text-align:center;"  width="25%">
                            Fecha prevista: {{$campaign->campaign_enddate}}
                        </th>
                    </tr>
                </thead>
            </table>
        </header>
        <footer>
            {{now()}} 
        </footer>


        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div class="">
                @foreach($etiquetas as $store)        
                    <div class="etiquetas">
                        <table width="100%" cellspacing="0" border="1">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" width="25%">
                                        {{$store->id}} <br>
                                        {{$store->segmento}}
                                    </th>
                                    <th class="{{trim(strtolower($store->segmento))}}"  width="50%" >
                                        {{$store->name}}
                                    </th>
                                    <th style="text-align:center;"  width="25%">
                                        <img src="{{asset('storage/SGH.jpg')}}" height="25px">
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
                                @foreach($store->campaignelementos->chunk(5) as $chunk)
                                <tr>
                                    @foreach($chunk as $etiqueta)
                                    <td class="celda">
                                        Nombre: {{$etiqueta['carteleria'] }}<br>
                                        Mobiliario: {{$etiqueta['mobiliario'] }}<br>
                                        Material: {{$etiqueta['material'] }}<br>
                                        Medida: {{$etiqueta['medida'] }}<br>
                                        Cantidad: {{$etiqueta['unitxprop'] }}<br>
                                        @if(file_exists( 'storage/galeria/'.$campaign->id.'/'.$etiqueta['imagen'] ))
                                            <img src="{{asset('storage/galeria/'.$campaign->id.'/'.$etiqueta['imagen'])}}" class="img-thumbnail"/>
                                        @else
                                            <img src="{{asset('storage/galeria/pordefecto.jpg')}}" class="img-thumbnail"/>
                                        @endif                                        
                                        {{-- <img src="{{asset('storage/galeria/'.$campaign->id.'/'.$etiqueta['imagen'])}}" class="img-thumbnail"/> --}}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="idioma">
                            Idioma:{{$store->country}}
                            
                        </div>
                    <div style="page-break-after:always;"></div>
        
                @endforeach
            </div>
        </main>
    </body>
</html>