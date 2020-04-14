
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


//  fileupload
var count=0, deleteId;
$(function () {
   'use strict';
   $('#fileuploaded').fileupload({
      add: function(e, data) {
            data.submit();
      },
      url: '/application/documentattach',
      type: 'POST',
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      autoUpload: true,
      dataType : 'json',
      success: function (data) {
            jQuery.each(data.data, function(index, row) {
               $('#files').append('<div class="image_wrap">'
                  +'<input type="hidden" name="files['+row.document_id+']" value="'+row.document_id+'"/><strong>'+row.document_name+'</strong>'
                  +' <span onClick="deletefile(this.id,\'' + row.document_id + '\',\'' + row.upload_url + '\')" id="deleteId'+count+'" class="delete-line btn btn-danger btn-sm" data-file_id="'+row.document_id+'">'
                  +'<i class="fas fa-trash-alt"></i> Delete</span></div>'); 
               count++;                        
            });
      },
      progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
               'width',
               progress + '%'
               );
      }
   });
});

function deletefile(id,fileId,url){         
   if (confirm('Are you sure you want to delete this file?')){
      var id = id;
      var fileId = fileId;
      var url = url;
      $.ajax({
            url  : '/application/deletefile',
            type : "POST",
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {id : fileId, url : url },                      
            success: function(data) {
               if (data == "success")
                  { $('#'+id).parent('div').remove(); }
               else
                  { alert('Something went wrong when deleteing the file, please try again'); }                        
            }
      });
   }
}