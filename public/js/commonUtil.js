

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

$(function () {
   'use strict';
   $('#upload_file').fileupload({
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

$(function () {
   'use strict';
   $('#license_upload').fileupload({
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
               $('#license_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#taxuploaded').fileupload({
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
               $('#tax_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#work_license_upload').fileupload({
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
               $('#work_license_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#work_tc_upload').fileupload({
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
               $('#work_tc_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#work_cv_upload').fileupload({
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
               $('#work_cv_files').append('<div class="image_wrap mb-2">'
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

//home stay file attach
$(function () {
   'use strict';
   $('#family_tree_upload').fileupload({
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
               $('#family_tree_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#house_pic_upload').fileupload({
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
               $('#house_pic_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#toilet_bath_upload').fileupload({
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
               $('#toilet_bath_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#guest_room_upload').fileupload({
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
               $('#guest_room_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#kitchen_file_upload').fileupload({
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
               $('#kitchen_files').append('<div class="image_wrap mb-2">'
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


$(function () {
   'use strict';
   $('#waste_file_upload').fileupload({
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
               $('#waste_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#dining_living_file_upload').fileupload({
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
               $('#dining_living_files').append('<div class="image_wrap mb-2">'
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

//to_license_clearance_new_license_file_attach
$(function () {
   'use strict';
   $('#academic_transcript_upload').fileupload({
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
               $('#academic_transcript_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#lease_agreement_upload').fileupload({
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
               $('#lease_agreement_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#security_clearance_upload').fileupload({
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
               $('#security_clearance_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#declaration_upload').fileupload({
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
               $('#declaration_files').append('<div class="image_wrap mb-2">'
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

//to_assesement_file_attach
$(function () {
   'use strict';
   $('#to_assement_trade_licn_upload').fileupload({
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
               $('#to_assement_trade_licn_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#to_assement_office_build_upload').fileupload({
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
               $('#to_assement_office_build_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#sign_board_upload').fileupload({
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
               $('#sign_board_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#authorization_upload').fileupload({
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
               $('#authorization_files').append('<div class="image_wrap mb-2">'
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

//proprieter_card_file_attach
$(function () {
   'use strict';
   $('#proprieter_card_license_upload').fileupload({
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
               $('#proprieter_card_license_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#noc_upload').fileupload({
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
               $('#noc_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#bit_upload').fileupload({
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
               $('#bit_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#proprieter_cid_upload').fileupload({
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
               $('#proprieter_cid_files').append('<div class="image_wrap mb-2">'
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

//recommendation_letter_for_tourism_industry_partners
$(function () {
   'use strict';
   $('#license_copy_one_upload').fileupload({
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
               $('#license_copy_one_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#license_copy_two_upload').fileupload({
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
               $('#license_copy_two_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#passport_one_upload').fileupload({
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
               $('#passport_one_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#passport_two_upload').fileupload({
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
               $('#passport_two_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#invitation_letter_upload').fileupload({
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
               $('#invitation_letter_files').append('<div class="image_wrap mb-2">'
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

//to_recoomendation_letter_for_import_license_file_upload
$(function () {
   'use strict';
   $('#proforma_invoice_upload').fileupload({
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
               $('#proforma_invoice_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#to_recomm_license_upload').fileupload({
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
               $('#to_recomm_license_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#to_recomm_tax_clr_upload').fileupload({
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
               $('#to_recomm_tax_clr_files').append('<div class="image_wrap mb-2">'
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

//to_license_renew_clearance
$(function () {
   'use strict';
   $('#to_license_renew_trade_license_upload').fileupload({
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
               $('#to_license_renew_trade_license_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#to_license_renew_tax_clr_upload').fileupload({
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
               $('#to_license_renew_tax_clr_files').append('<div class="image_wrap mb-2">'
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

//EOI File Upload
$(function () {
   'use strict';
   $('#dg_application_upload').fileupload({
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
               $('#dg_application_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#architectural_drawings_upload').fileupload({
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
               $('#architectural_drawings_files').append('<div class="image_wrap mb-2">'
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

//new tourism product development proposal File Upload
$(function () {
   'use strict';
   $('#project_proposal_upload').fileupload({
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
               $('#project_proposal_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#sector_clearance_upload').fileupload({
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
               $('#sector_clearance_files').append('<div class="image_wrap mb-2">'
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

//existing tourism product proposal File Upload
$(function () {
   'use strict';
   $('#dzongkhag_app_upload').fileupload({
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
               $('#dzongkhag_app_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#project_proposal_budget_upload').fileupload({
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
               $('#project_proposal_budget_files').append('<div class="image_wrap mb-2">'
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

//Grievance File Upload
$(function () {
   'use strict';
   $('#power_of_attorney_upload').fileupload({
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
               $('#power_of_attorney_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#grievance_support_doc_upload').fileupload({
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
               $('#grievance_support_doc_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#contract_doc_upload').fileupload({
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
               $('#contract_doc_files').append('<div class="image_wrap mb-2">'
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


//FAM File Upload
$(function () {
   'use strict';
   $('#app_director_upload').fileupload({
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
               $('#app_director_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#staff_desig_upload').fileupload({
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
               $('#staff_desig_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#route_application_upload').fileupload({
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
               $('#route_application_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#approved_fam_upload').fileupload({
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
               $('#approved_fam_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#coverage_upload').fileupload({
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
               $('#coverage_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#permission_tcb_upload').fileupload({
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
               $('#permission_tcb_files').append('<div class="image_wrap mb-2">'
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

$(function () {
   'use strict';
   $('#logo_upload').fileupload({
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
               $('#logo_files').append('<div class="image_wrap mb-2">'
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

