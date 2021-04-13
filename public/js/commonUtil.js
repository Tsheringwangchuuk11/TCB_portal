

$(document).ready(function () {
   $("#bs4-slide-carousel").carousel();
   $('.dzongkhagdropdown').on('change',function(e) {
      var dzongkhag_id = e.target.value;
      if(dzongkhag_id){
         $("#gewog_id option:gt(0)").remove();	
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
            $.each(data, function(key, value) {
                   $('select[name="gewog_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
             }
         });
      }else{
         $("#gewog_id option:gt(0)").remove();	
         $("#chiwog_id option:gt(0)").remove();
         $("#village_id option:gt(0)").remove();
      }		 
   });

   $('.permanentdzongkhagdropdown').on('change',function(e) {
      var dzongkhag_id = e.target.value;
      if(dzongkhag_id){
         $("#permanent_gewog_id option:gt(0)").remove();	
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
            $.each(data, function(key, value) {
                   $('select[name="permanent_gewog_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
             }
         });
      }else{
         $("#permanent_gewog_id option:gt(0)").remove();	
         $("#permanent_village_id option:gt(0)").remove();
      }		 
   });

   $('.gewogdropdown').on('change',function(e) {
      var gewog_id = e.target.value;
      if(gewog_id){
         $("#chiwog_id option:gt(0)").remove();	
         $.ajax({			   
                  url:'/json-dropdown',
                  type:"GET",
                  data: {
                     table_name: 't_chiwog_masters',
                           id: 'id',
                           name: 'chiwog_name',
                     parent_id: gewog_id,
               parent_name_id: 'gewog_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
               $('select[name="chiwog_id"]').append('<option value="'+ key +'">'+ value +'</option>');
            });
            }
         });
      }else{
         $("#chiwog_id option:gt(0)").remove();	
      }		 
   });
    
   $('.gewogdropdown').on('change',function(e) {
      var gewog_id = e.target.value;
      if(gewog_id){
         $("#village_id option:gt(0)").remove();	
         $.ajax({			   
                  url:'/json-dropdown',
                  type:"GET",
                  data: {
                     table_name: 't_village_masters',
                           id: 'id',
                           name: 'village_name',
                     parent_id: gewog_id,
               parent_name_id: 'gewog_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
                  $('select[name="establishment_village_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
            }
         });
      }else{
         $("#village_id option:gt(0)").remove();	
      }		 
   });

   $('.permanentgewogdropdown').on('change',function(e) {
      var gewog_id = e.target.value;
      if(gewog_id){
         $("#permanent_village_id option:gt(0)").remove();	
         $.ajax({			   
                  url:'/json-dropdown',
                  type:"GET",
                  data: {
                     table_name: 't_village_masters',
                           id: 'id',
                           name: 'village_name',
                     parent_id: gewog_id,
               parent_name_id: 'gewog_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
                  $('select[name="permanent_village_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
            }
         });
      }else{
         $("#permanent_village_id option:gt(0)").remove();	
      }		 
   });
    
   $('.partnerdzongkhagdropdown').on('change',function(e) {
      var dzongkhag_id = e.target.value;
      if(dzongkhag_id){
         $("#partner_gewog_id option:gt(0)").remove();	
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
            $.each(data, function(key, value) {
                  $('select[name="partner_gewog_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
            }
         });
      }else{
         $("#partner_gewog_id option:gt(0)").remove();	
         $("#partner_village_id option:gt(0)").remove();
      }		 
   });
   $('.partnergewogropdown').on('change',function(e) {
      var gewog_id = e.target.value;
      if(gewog_id){
         $("#partner_village_id option:gt(0)").remove();	
         $.ajax({			   
            url:'/json-dropdown',
            type:"GET",
            data: {
               table_name: 't_village_masters',
                       id: 'id',
                     name: 'village_name',
                parent_id: gewog_id,
           parent_name_id: 'gewog_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
               $('select[name="partner_village_id"]').append('<option value="'+ key +'">'+ value +'</option>');
            });
            }
         });
      }else{
         $("#partner_village_id option:gt(0)").remove();	
      }		 
   });
});
//  fileupload
var count=0, deleteId;
$(function () {
   'use strict';
   $('#fileuploaded').fileupload({
      add: function (e, data) {
         var serviceId = $("#service_id").val();
         var uploadErrors = [];
         var acceptFileTypes = /(\.|\/)(gif|jpe?g|png|pdf|tiff)$/i;
         if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['name'])) {
            uploadErrors.push(data.originalFiles[0]['name'] + ' is not alloawed. Invalid file type.');
         }
         if(serviceId==1) {
            if (data.originalFiles[0]['size'] >= 10000000) {
               uploadErrors.push(data.originalFiles[0]['name'] + ' is too big, ' + parseInt(data.originalFiles[0]['size'] / 1024 / 1024) + 'M.. Maximum file size should be 10MB.');
            }
         }else {
            if (data.originalFiles[0]['size'] > 2000000) {
               uploadErrors.push(data.originalFiles[0]['name'] + ' is too big, ' + parseInt(data.originalFiles[0]['size'] / 1024 / 1024) + 'M.. File should be smaller than 2MB.');
            }
         }
         if (uploadErrors.length > 0) {
            $('#msgId').html(uploadErrors);
            $('#alertErrorId').show().delay(6000).queue(function (n) {
                  $(this).hide();
                  n();
            });
         } else {
            data.submit();
         }
      },
      beforeSend:function(){
         $('#success').empty();
         $('.progress-bar').text('0%');
         $('.progress-bar').css('width', '0%');
         $('#progress').show();
      },
      uploadProgress: function (event, position, total, percentComplete) {
         $('.progress-bar').text(percentComplete + '0%');
         $('.progress-bar').css('width', percentComplete + '0%');
     },
    
      url: '/documentattach',
      type: 'POST',
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      autoUpload: true,
      dataType : 'json',
      success: function (data) {
         var baseurl = window.location.origin;
         if (data.status == 'true') {
            $('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
            $('.progress-bar').text('Uploaded');
            $('.progress-bar').css('width', '100%');
            setTimeout(function() {
               $('.progress-bar').css('width', '0%').attr('aria-valuenow', 0);
               $('#progress').hide();
            }, 3000);
            jQuery.each(data.data, function (index, row) {
               $('#files').append('<div class="image_wrap mb-2">'
                  + '<input type="hidden" name="documentId[]" value="' + row.id + '"/><strong>' + row.document_name + '</strong> &nbsp;'
                  + '<a href=" '+baseurl+'/'+row.upload_url+'"  class="btn btn-sm btn-info" target="_blank"><i class="fa fa-link"></i> View </a> &nbsp;'
                  + '<span onClick="deletefile(this.id,\'' + row.id + '\',\'' + row.upload_url + '\')" id="deleteId' + count + '" class="delete-line btn btn-danger btn-sm" data-file_id="' + row.id + '">'
                  + '<i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>');
               count++;
            });
         } else {
            $('#msgId').html(data.message);
            $('#alertErrorId').show().delay(6000).queue(function (n) {
                  $(this).hide();
                  n();
            });
         }
      },
   });
});
function deletefile(id, fileId, url) { 
   if (confirm('Are you sure you want to delete this file?')){
      var id = id;
      var fileId = fileId;
      var url = url;
      $.ajax({
            url  : '/deletefile',
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

