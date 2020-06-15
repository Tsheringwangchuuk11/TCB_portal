

$(document).ready(function () {

   $("#bs4-slide-carousel").carousel();
    validation.Initialize();
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
                  $('select[name="village_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
            }
         });
      }else{
         $("#village_id option:gt(0)").remove();	
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
                  $('select[name="gewog_id"]').append('<option value="'+ key +'">'+ value +'</option>');
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

//Script for approve the application
function approveOrRejectApplication(status) {
   var form= $("#formId");
     $.ajax({
         type: form.attr('method'),
         url: form.attr('action'),
         data: form.serialize()+"&status="+status,
         success: function (data) {
           $('#successMsg').html(data.msg);
           $('#showMsg').show().delay(3000).queue(function (n) {
             $(this).hide();
             n();
           });
           setTimeout(function(){
             window.location.replace = "{{ url('tasklist/tasklist') }}";
          }, 5000); 
         } 
     });
 }
// form validation
var validation = function () {
   $('#formdata').validate({
      ignore: [],
      rules: {
         email: {
            required: true,
            email: true,
         },
         cid_no: {
            required: true,
            maxlength: 11,
            minlength: 11,
            digits: true,
         },
         applicant_name: {
            required: true,
         },
         location: {
            required:true
         },
         dzongkhag_id: {
            required:true
         },
         gewog_id: {
            required:true
         },
         chiwog_id: {
            required:true
         },
         village_id: {
            required:true
         },
         contact_no: {
            required: true,
            digits: true,
            maxlength: 8
         },
         number: {
            required: true,
            digits: true,
         },
         tentative_cons: {
            required: true,
         },
         tentative_com: {
            required: true,
         },
         drawing_date:{
            required: true,
         },
         star_category_id: {
            required: true,
         },
         license_no: {
            required:true,
         },
         license_date: {
            required:true,
         },
         company_title_name: {
            required:true,
         },
         owner_name: {
            required:true,
         },
         address: {
            required:true,
         },
         thram_no: {
            required:true,
         },
         house_no: {
            required:true,
         },
         town_distance: {
            required:true,
         },
         road_distance: {
            required:true,
         },
         condition: {
            required:true,
         },
         validity_date: {
            required:true
         },
         webpage_url: {
            required: true,
            url: true,
            normalizer: function( value ) {
            var url = value;
            // Check if it doesn't start with http:// or https:// or ftp://
            if ( url && url.substr( 0, 7 ) !== "http://"
                  && url.substr( 0, 8 ) !== "https://"
                  && url.substr( 0, 6 ) !== "ftp://" ) {
               // then prefix with http://
               url = "http://" + url;
            }
            // Return the new url
            return url;
            }
         },
         location_id: {
            required:true,
         },
        /*  'room_type_id[]': {
            required:true,
         },
        'room_no[]': {
           required: true,
           digits: true,
         },
         'staff_area_id[]': {
           required:true
         },
         'hotel_div_id[]': {
            required:true
         },
         'staff_name[]': {
            required:true,
         },
         'staff_gender[]': {
            required:true,
         },
         'member_name[]': {
            required:true,
         },
         'relation_type_id[]': {
            required:true,
         },
         'member_age[]': {
            required: true,
            digits: true,
         },
         'member_gender[]': {
            required:true,
         }, */
      },
      messages: {
         email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
         },
         cid_no: {
            required: "Please provide a cid number",
            maxlength: "Your cid must be 11 characters long",
            minlength: "Your cid must be at least 11 characters long",

            digits: "This field accept only digits",

         },

         applicant_name: {
            required: "Please provide a name",
         },
         location: {
            required: "Please provide a location",
         },
         dzongkhag_id: {
            required: "Please select dzongkhag",
         },
         gewog_id: {
            required: "Please select gewog",
         },
         chiwog_id: {
            required: "Please select chiwog",
         },
         village_id: {
            required: "Please select village",
         },
         contact_no: {
            required: "Please provide contact number",
            digits: "This field accept only digits",
            maxlength: "Phone number field accept only 8 digits",
         },
        
         tentative_cons: {
            required: "Please provide tentative construction ",
         },
         tentative_com: {
            required: "Please provide tentative completion of the construction ",
         },
         drawing_date: {
            required: "Please provide drawing date",
         },
         star_category_id: {
            required: "Please select the star category",
         },
         license_no: {
            required: "Please provide the license number",
         },
         license_date: {
            required: "Please provide the license date",
         },
         company_title_name: {
            required: "This field is required",
         },
         owner_name: {
            required: "This field is required",
         },
         
         address: {
            required: "Please provide the address",
         },
         thram_no: {
            required: "Please provide the thram number",
         },
         house_no: {
            required: "Please provide the house number",
         },
         town_distance: {
            required: "This field is required",
         },
         road_distance: {
            required: "This field is required",
         },
         condition: {
            required: "This field is required",
         },
         validity_date: {
            required: "This field is required",
         },
         webpage_url: {
            required: "Please provide the url",
         },
         
         location_id: {
            required: "Please select the location",
         },
       /*  'room_type_id[]':{
            required: "Please select the room type",
         },
        'room_no[]': {
           required: "Please provide number of rooms",
           digits: "This field accept only digits",
         },
         'staff_area_id[]': {
            required: "Please select the area",
         },
         'hotel_div_id[]': {
            required: "Please select the division",
         },
         'staff_name[]': {
            required: "Please provide staff name",
         },
         'staff_gender[]': {
            required: "Please select the gender",
         },
         'member_name[]': {
            required: "Please select the gender",
         },
         'relation_type_id[]': {
            required: "Please select the gender",
         },
         'member_age[]': {
            required: "Please select the gender",
            digits: "This field accept only digits",
         },
         'member_gender[]': {
            required: "Please select the gender",
         } */
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
         error.addClass('invalid-feedback');
         element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
         $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
         $(element).removeClass('is-invalid');
      }
   });
}();


 
