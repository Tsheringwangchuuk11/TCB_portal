
$(document).ready(function(){
    $("#bs4-slide-carousel").carousel();
 });

function gewogdropdown(id) {
    var dzongkhagId=id;
     if(dzongkhagId) {
      $.ajax({
               url:'/application/gewog-list/'+dzongkhagId,
               type: "GET",
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
               dataType: "json",
               success:function(data) {
                  console.log(data);
                    if(data){
                     $('#gewog').empty();
                     $('#gewog').focus;
                     $('#gewog').append('<option value="">-- Select  gewog--</option>'); 
                     $.each(data, function(key, value){
                     $('#gewog').append('<option value="'+ key +'">' + value+ '</option>');
                 });
              }else{
                 $('#gewog').empty();
                  }
               }
            });
         }else{
       $('#gewog').empty();
      }
}