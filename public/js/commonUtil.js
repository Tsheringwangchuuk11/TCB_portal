
$(document).ready(function(){
    $("#bs4-slide-carousel").carousel();
    $(function() {
      $('#drawing_date').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      autoUpdateInput: false,
   });
      $('#drawing_date').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY'));
      });
   
   });
 });

 $(document).ready(function(){
   $('#dzongkhag_id').on('change',function(e) {
      var dzongkhag_id = e.target.value;
      if(dzongkhag_id){
         $("#location_id option:gt(0)").remove();	
         $.ajax({			   
            url:'/json-dropdown',
            type:"GET",
            data: {
               table_name: 't_gewog_masters',
                       id: 'id',
                     name: 'gewog_name',
                parent_id: dzongkhag_id,
           parent_name_id: 'dzongkhag_id'					 
            },
            success:function (data) {	
            $('#location_id').append('<option value=""> -Select- </option>'); 
            $.each(data, function(key, value) {
               $('select[name="location_id"]').append('<option value="'+ key +'">'+ value +'</option>');
            });
            }
         });
      }else{
         $("#location_id option:gt(0)").remove();	
      }		 
   });
});
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
                  +'<input type="hidden" name="documentId[]" value="'+row.id+'"/><strong>'+row.document_name+'</strong>'
                  +' <span onClick="deletefile(this.id,\'' + row.id + '\',\'' + row.upload_url + '\')" id="deleteId'+count+'" class="delete-line btn btn-danger btn-sm" data-file_id="'+row.id+'">'
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




