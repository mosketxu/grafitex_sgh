function subirImagenIndex(formulario,imagenId){
   var token= $('#token').val();
   let timestamp = Math.floor( Date.now() );
   $.ajaxSetup({
       headers: { "X-CSRF-TOKEN": $('#token').val() },
   });
   
   var formElement = document.getElementById(formulario);
   var formData = new FormData(formElement);
   formData.append("imagenId", imagenId);
   
   $.ajax({
       type:'POST',
       url: "{{ route('campaign.galeria.updateindex') }}",
       data:formData,
       cache:false,
       contentType: false,
       processData: false,
       success:function(data){
           $('#'+formulario +' img').remove();
           $('#original'+imagenId).attr('src', '/storage/galeria/'+ data.campaign_id+'/'+ data.imagen+'?ver=' + timestamp);
           toastr.info('Imagen actualizada con éxito','Imagen',{
               "progressBar":true,
               "positionClass":"toast-top-center"
           });
       },
       error: function(data){
           console.log(data);
           toastr.error("No se ha actualizado la imagen.<br>"+ data.responseJSON.message,'Error actualización',{
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
