
$(document).ready(function(){
   //$("#studentstbl").DataTable();
   //$("#dob").datepicker();
  // $('#dob').datepicker({
      //autoclose: true
   // })
    // for slider
    $("#bs4-slide-carousel").carousel();
 });

function gewogdropdown(id) {
    var dzongkhagId=id;
     if(dzongkhagId) {
      $.ajax({
               url: '/gewog-list/'+dzongkhagId,
               type: "GET",
               data : {"_token":"{{ csrf_token() }}"},
               dataType: "json",
               success:function(data) {
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