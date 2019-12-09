{{-- cabecera del formulario --}}
<div>
   <table width="100%" style="margin:0 auto" cellspacing="0">
         <tbody>
            <tr>
               <td style="width: 49%;">
                     <img src="{{asset('storage/grafitexLogo.png')}}" width="50px">
                     <b>Grafitex Servicios Digitales, S.A</b><br>
                     Ferrocarrils Catalans, 103-107<br>
                     08038 Barcelona<br>
                     Tlf. 93.200.73.22
               </td>
               <td style="width: 49%;text-align:center;">
                     <img src="{{asset('storage/SGH.jpg')}}" width="200"><br>
                     www.sunglasshut.com
               </td>
            </tr>
         </tbody>
   </table>
</div>
<br />
{{-- datos generales del presupuesto --}}
<div>
   <table width="100%" style="margin:0 auto" cellspacing="0">
         <tbody>
            <tr>
               <td width="49%" ></td>
               <td width="25%" style="padding-left:10px;">Ámbito</td>
               <td width="25%" style="padding-left:10px;">PORTUGAL</td>
            </tr>
            <tr>
               <td width="49%" ></td>
               <td width="25%" style="padding-left:10px;">A la atención de:</td>
               <td width="25%" style="padding-left:10px;border-bottom:1px solid">{{$presupuesto->atencion}}</td>
            </tr>
            <tr>
               <td width="49%">&nbsp;</td>
               <td width="25%">&nbsp;</td>
               <td width="25%">&nbsp;</td>
            </tr>
            <tr>
               <td width="49%" ></td>
               <td width="25%" style="padding-left:10px; border:1px solid"><span style="font-size: small">Campaña</span></td>
               <td width="25%" style="padding-left:10px; border:1px solid"><span style="font-size: small">{{$presupuesto->campaign->campaign_name}}</span></td>
            </tr>
            <tr>
               <td width="49%" ><span style="font-size: small">Presupuesto tiendas Portugal</span></td>
               <td width="25%" style="padding-left:10px; border:1px solid"><span style="font-size: small">Fecha</span></td>
               <td width="25%" style="padding-left:10px; border:1px solid"><span style="font-size: small">{{$presupuesto->fecha->format('d-m-Y')}}</span></td>
               {{-- para que funcione la fecha he tenido que poner en el modelo: protected $dates = ['fecha']; --}}
            </tr>
            <tr>
               <td width="49%" ></td>
               <td width="25%" style="padding-left:10px; border:1px solid"><span style="font-size: small">Núm.Presupuesto</span></td>
               <td width="25%" style="padding-left:10px; border:1px solid"><span style="font-size: small">{{$presupuesto->referencia}}-es</span></td>
            </tr>
      </tbody>
   </table>
</div>  
<br>
{{-- Línea numero de tiendas --}}
<div>
   <table width="100%" style="margin:0 auto" cellspacing="0">
         <tbody>
            <tr>
               <td>
                     {{$presupuesto->referencia}}-pt, {{$totalStores}} tiendas, de ellas
                     @foreach($promedios as $promedio)
                        {{$promedio->stores}}
                        @switch($promedio->zona)
                           @case("PT")
                           Portugal
                           @break
                           @case("CA")
                           Canarias
                           @break
                           @default
                           Nacional
                        @endswitch
                        @if (!$loop->last)
                           ,
                        @else
                           .
                        @endif
                     @endforeach
               </td>
            </tr>
         </tbody>
   </table>
</div>
<br>
{{-- tabla presupuesto materiales --}}
@if(count($materiales)>0)
   <div>
         <table width="100%" style="margin:0 auto" cellspacing="0">
            <thead>
               <tr>
                     <th width="49%" style="text-align: left;padding-left:10px;border:1px solid">Referencia Material</th>
                     <th width="17%" style="text-align: right;padding-right:10px;border:1px solid">Unidades</th>
                     <th width="17%" style="text-align: right;padding-right:10px;border:1px solid"><span style="font-family: sans-serif;">€</span>/Unidad</th>
                     <th width="17%" style="text-align: right;padding-right:10px;border:1px solid">Total</th>
               </tr>
            </thead>
            <tbody>
               @foreach($materiales as $material)
               <tr>
                     <td style="text-align: left;padding-left:10px;border:1px solid">{{$material->tarifa->familia}}</td>
                     <td style="text-align: right;padding-right:10px;border:1px solid">{{$material->unidades}}</td>
                     <td style="text-align: right;padding-right:10px;border:1px solid">{{number_format($material->precio,2,',','.')}}</td>
                     <td style="text-align: right;padding-right:10px;border:1px solid">{{number_format($material->tot,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
               </tr>
               @endforeach
            </tbody>
            <tfoot>
               <tr>
                     <th></th>
                     <th style="text-align: right;padding-right:10px;background-color:#CEE9F5;border:1px solid" colspan="2">Total Materiales</th>
                     <th style="text-align: right;padding-right:10px;background-color:#CEE9F5;border:1px solid">{{number_format($totalMateriales,2,',','.')}} <span style="font-family: sans-serif;">€</span></th>
               </tr>
               <tr>>
                     <td></td>
                     <th style="text-align: right;padding-right:10px;background-color:#03a9f4;border:1px solid" colspan="2">Total Materiales Portugal</th>
                     <th style="text-align: right;padding-right:10px;background-color:#03a9f4;border:1px solid">{{number_format($totalMaterialesPt,2,',','.')}} <span style="font-family: sans-serif;">€</span></th>
               </tr>
            </tfoot>
         </table>
   </div>
@endif
<br>
{{-- tabla presupuesto extras --}}
@if($totalExtrasPt>0)
   <div>
         <table width="100%" style="margin:0 auto" cellspacing="0">
            <thead>
               <tr>
                     <th width="49%" style="text-align: left;padding-left:10px;border:1px solid">Extras</th>
                     <th width="17%" style="text-align: right;padding-right:10px;border:1px solid">Unidades</th>
                     <th width="17%" style="text-align: right;padding-right:10px;border:1px solid"><span style="font-family: sans-serif;">€</span>/Unidad</th>
                     <th width="17%" style="text-align: right;padding-right:10px;border:1px solid">Total</th>
               </tr>
            </thead>
            <tbody>
               @foreach($extras as $extra)
                  @if($extra->zona=="PT")
                     <tr>
                        <td style="text-align: left;padding-left:10px;border:1px solid">{{$extra->concepto}}</td>
                        <td style="text-align: right;padding-right:10px;border:1px solid">{{$extra->unidades}}</td>
                        <td style="text-align: right;padding-right:10px;border:1px solid">{{number_format($extra->preciounidad,2,',','.')}} </td>
                        <td style="text-align: right;padding-right:10px;border:1px solid">{{number_format($extra->unidades * $extra->preciounidad,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
                     </tr>
                  @endif
               @endforeach
            </tbody>
            <tfoot>
               <tr>
                     <td></td>
                     <th style="text-align: right;padding-right:10px;background-color:#03a9f4;border:1px solid" colspan="2">Total Extras</th>
                     <th style="text-align: right;padding-right:10px;background-color:#03a9f4;border:1px solid">{{number_format($totalExtrasPt,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
               </tr>
            </tfoot>
         </table>
   </div>
@endif
<br>
{{-- Promedio tiendas --}}
<div>
   <table width="100%" style="margin:0 auto" cellspacing="0">
         <thead>
            <tr>
               <th width="49%" style="text-align: left;padding-left:10px;border:1px solid">Promedios</th>
               <th width="25.5%" style="text-align: right;padding-right:10px;border:1px solid">Nº Tiendas</th>
               <th width="25.5%" style="text-align: right;padding-right:10px;border:1px solid"><span style="font-family: sans-serif;">€</span></th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td style="text-align: left;padding-left:10px;border:1px solid">Total por tienda (Nacional + Canarias + Portugal</td>
               <td style="text-align: right;padding-right:10px;border:1px solid">{{$totalStores}}</td> 
               <td style="text-align: right;padding-right:10px;border:1px solid">{{number_format($totalMateriales/$totalStores,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
            </tr>
            <tr style="border:1px solid;">
               <td style="text-align: left;padding-left:10px;border:1px solid">Por tienda Portugal</td>
               <td style="text-align: right;padding-right:10px;border:1px solid">{{$totalStoresPt}}</td>
               <td style="text-align: right;padding-right:10px;border:1px solid">{{number_format($totalMaterialesPt/$totalStoresPt,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
            </tr>
         </tbody>
   </table>
</div>
<br>
{{-- Picking y transporte Portugal--}}
<div>
   <table width="100%" style="margin:0 auto" cellspacing="0">
         <thead>
            <tr>
               <th width="49%" style="text-align: left;padding-left:10px;border:1px solid">Picking y Transportes</th>
               <th width="12.75%" style="text-align: right;padding-right:10px;border:1px solid">Nº Tiendas</th>
               <th width="12.75%" style="text-align: right;padding-right:10px;border:1px solid"><span style="font-family: sans-serif;">€</span>/Picking</th>
               <th width="12.75%" style="text-align: right;padding-right:10px;border:1px solid"><span style="font-family: sans-serif;">€</span>Transp.</th>
               <th width="12.75%" style="text-align: right;padding-right:10px;border:1px solid">Total<span style="font-family: sans-serif;"> €</span></th>
            </tr>
         </thead>
         <tbody>
            @foreach($promedios as $picking)
               @if($picking->zona=="PT")
               <tr>
                     <td style="text-align: left;padding-left:10px;border:1px solid">{{$picking->zona=="ES"?"Nacional":"Canarias"}}</td>
                     <td style="text-align: right;padding-right:10px;border:1px solid">{{$picking->stores}}</td>
                     <td style="text-align: right;padding-right:10px;border:1px solid">{{number_format($picking->picking,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
                     <td style="text-align: right;padding-right:10px;border:1px solid">{{number_format($picking->transporte,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
                     <td style="text-align: right;padding-right:10px;border:1px solid">{{number_format($picking->picking * $picking->stores + $picking->transporte * $picking->stores ,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
               </tr>
               @endif
            @endforeach
         </tbody>
         <tfoot>
            <tr>
               <th></th>
               <th style="text-align: right;padding-right:10px;background-color:#03a9f4;border:1px solid">Total</th>
               <th style="text-align: right;padding-right:10px;background-color:#03a9f4;border:1px solid">{{number_format($totalPickingPt->picking,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
               <th style="text-align: right;padding-right:10px;background-color:#03a9f4;border:1px solid">{{number_format($totalPickingPt->transporte,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
               <th style="text-align: right;padding-right:10px;background-color:#03a9f4;border:1px solid">{{number_format($totalPickingPt->transporte + $totalPickingPt->picking,2,',','.')}} <span style="font-family: sans-serif;">€</span></td>
            </tr>
         </tfoot>
   </table>
</div>
<br>
{{-- Línea Totales --}}
<div>
   <table width="100%" style="margin:0 auto" cellspacing="0">
      <thead>
         <tr style="background-color:#D4AF37;">
            <th width="49%" style="text-align: left;padding-left:10px;border-top:1px solid; border-bottom:1px solid; border-left:1px solid;">Total Portugal (Producción + Picking + Envíos)</th>
            <th width="25.5%" style="text-align: right;padding-right:10px;border-top:1px solid; border-bottom:1px solid; border-right:1px solid;">
               {{number_format($totalMaterialesPt + $totalPickingPt->picking + $totalPickingPt->transporte,2,',','.')}} <span style="font-family: sans-serif;">€</span>
            </th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td width="49%"></th>
            <td width="51%" style="text-align: right;padding-right:10px;"> <span style="font-size:xx-small">(IVA no incluido)</span></td>
         </tr>
      </tbody>
   </table>
</div>
<br>
{{-- Resumen --}}
<div>
   <table width="100%" style="margin:0 auto" cellspacing="0">
      <thead>
         <tr>
            <th width="49%"></th>
            <th width="25.5%" style="text-align: left;padding-left:10px;border:1px solid">Picking Portugal</th>
            <th width="25.5%" style="text-align: right;padding-right:10px;border:1px solid">{{number_format($totalPickingPt->picking ,2,',','.')}} <span style="font-family: sans-serif;">€</span></th>
         </tr>
         <tr>
            <th width="49%"></th>
            <th width="25.5%" style="text-align: left;padding-left:10px;border:1px solid">Transporte Portugal</th>
            <th width="25.5%" style="text-align: right;padding-right:10px;border:1px solid">{{number_format($totalPickingPt->transporte,2,',','.')}} <span style="font-family: sans-serif;">€</span></th>
         </tr>
         <tr>
            <th width="49%"></th>
            <th width="25.5%" style="text-align: left;padding-left:10px;border:1px solid">Extras</th>
            <th width="25.5%" style="text-align: right;padding-right:10px;border:1px solid">{{number_format($totalExtrasPt,2,',','.')}} <span style="font-family: sans-serif;">€</span></th>
         </tr>
         <tr>
            <th width="49%"></th>
            <th width="25.5%" style="text-align: left;padding-left:10px;border:1px solid">Campaña</th>
            <th width="25.5%" style="text-align: right;padding-right:10px;border:1px solid">{{number_format($totalMaterialesPt,2,',','.')}} <span style="font-family: sans-serif;">€</span></th>
         </tr>
         <tr>
            <th width="49%"></th>
            <th width="25.5%" style="text-align: left;padding-left:10px;border:1px solid;background-color: #03a9f4;"><span style="font-size:medium">Total</span></th>
            <th width="25.5%" style="text-align: right;padding-right:10px;border:1px solid;background-color: #03a9f4">
               <span style="font-size: medium">
                  {{number_format($totalPickingPt->picking + $totalPickingPt->transporte + $totalExtrasPt +$totalMaterialesPt,2,',','.')}} <span style="font-family: sans-serif;">€</span>
               </span>
            </th>
         </tr>
      </thead>
   </table>
</div>
<br>
   
   