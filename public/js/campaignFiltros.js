// Duallistbox
// ===========
    //Duallistbox Con filtro
    var duallist = $('.duallistbox').bootstrapDualListbox({
        nonSelectedListLabel: 'No Seleccionadas',
        selectedListLabel: 'Seleccionadas',
        selectorMinimalHeight:300,
        preserveSelectionOnMove: 'moved',
        moveOnSelect: false,
        filterPlaceHolder:'Filtros...',
    });
    //Duallistbox Sin filtro
    var duallist = $('.duallistboxSinFiltro').bootstrapDualListbox({
        nonSelectedListLabel: 'No Seleccionadas',
        selectedListLabel: 'Seleccionadas',
        preserveSelectionOnMove: 'moved',
        moveOnSelect: false,
        filterPlaceHolder:'Filtros...', 
        showFilterInputs:false,
    });

// Funciones asociar
// =================

// Asociar 
function asociar(campaignId,ruta,tok,datosduallist,filtro,campo,tabla) {
   var token = $(tok).val();
   var route = ruta;
   // var datosDuallist=$(datosduallist).val();
   var datosDuallist=$('[name="'+datosduallist+'"]').val();
   
   $.ajax({
      url: route,
      headers: { "X-CSRF-TOKEN": token },
      type: "POST",
      dataType: "json",
      data: { campaign_id: campaignId, datoslist:datosDuallist,campo:campo,tabla:tabla},
      success: function(data) {
         if(data.cont==true){
            toastr.info('Datos actualizados con éxito','Filtro ' + filtro,{
               "progressBar":true,
               "positionClass":"toast-top-center"
            });
         }
         else{
            toastr.warning('Todos los filtros Stores borrados','Filtro ' + filtro,{
               "progressBar":true,
               "positionClass":"toast-top-center"
            });
         }
      },
      error:function(msj){
            console.log(msj.responseJSON.errors);
            toastr.error("Ha habido un error. <br />No se ha podido grabar. <br />Si se repite contacte con el Administrador.<br>"+ msj.responseJSON.message,'Fitro ' + filtro,{
               "closeButton": true,
               "progressBar":true,
               "positionClass":"toast-top-center",
               "options.escapeHtml" : true,
               "showDuration": "300",
               "hideDuration": "1000",
               "timeOut": 0,
            });
      }
   });
}