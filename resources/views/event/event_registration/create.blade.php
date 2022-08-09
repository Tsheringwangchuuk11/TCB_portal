<form id="event_form" action="{{ url('events/travel-fairs-event') }}" class="form-horizontal" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Event Name <span class="text-danger"> *</span></label>
                <input type="text" id= "eventName" name="event_name" class="form-control">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">To Country <span class="text-danger"> *</span></label>
                <select  name="country_id" class="form-control select2bs4" style="width: 100%;" id="countryId">
                    <option value=""> -Select-</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row" style="display:none" id="displaydzongkhag">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Dzongkhag<span class="text-danger"> *</span></label>
            <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                <option value=""> -Select-</option>
                @foreach ($dzongkhagLists as $dzongkhagList)
                  <option value="{{ $dzongkhagList->id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                @endforeach
              </select>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Gewog<span class="text-danger"> *</span></label>
            <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
              <option value=""> -Select-</option>
            </select>   
          </div>
        </div>
      </div>
    
    <div class="row">
        <div class="col-md-5" style="display:none" id="displayvillage">
            <div class="form-group">
              <label for="">Village<span class="text-danger"> *</span></label>
              <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                <option value=""> -Select-</option>
              </select>
            </div>
        </div>
        <div class="col-md-5" id="displaylocation">
            <div class="form-group">
                <label for="">Location <span class="text-danger"> *</span></label>
                <input type="text" id= "eventlocation" name="event_location" class="form-control">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Event Start Date <span class="text-danger"> *</span></label>
                <div class="input-group date" id="eventstartDate" data-target-input="nearest">
                    <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#eventstartDate">
                    <div class="input-group-append" data-target="#eventstartDate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Event End Date <span class="text-danger"> *</span></label>
                <div class="input-group date" id="eventendDate" data-target-input="nearest">
                    <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#eventendDate">
                    <div class="input-group-append" data-target="#eventendDate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Late Date Of Registration <span class="text-danger"> *</span></label>
                <div class="input-group date" id="eventlastDate" data-target-input="nearest">
                    <input type="text" name="last_date" class="form-control datetimepicker-input" data-target="#eventlastDate">
                    <div class="input-group-append" data-target="#eventlastDate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Website<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="web_site"  value="{{ old('web_site') }}" id="web_site" autocomplete="off" >
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Contact Person<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="contact_person"  value="{{ old('contact_person') }}" id="contact_person" autocomplete="off" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Email<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="email"  value="{{ old('email') }}" id="email" autocomplete="off" >
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Contact No<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="mobile_no"  value="{{ old('mobile_no') }}" id="mobile_no" autocomplete="off" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Event Details <span class="text-danger"> *</span></label>
                <textarea type="text" class="form-control" name="event_dtls" id="eventDtl" row="3"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="margin-bottom:-14px;">
        <button type="submit" class="btn btn-success btn-flat margin-r-5">Save</button>
        <button type="button" class="float-left btn btn-flat btn-close btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>
<script>
    $(document).ready(function(){
            $('#eventstartDate').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#eventendDate').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#eventlastDate').datetimepicker({
                format: 'MM/DD/YYYY'
            });
    });
    
    $(function() {
        $('#event_form').validate({
            rules: {
                event_name: {
                required: true,
                },
                country_id: {
                required: true,
                },
                start_date: {
                required: true,
                },
                end_date: {
                required: true,
                },
                last_date: {
                required: true,
                },
                web_site: {
                required: true,
                },
                contact_person: {
                required: true,
                },
                event_dtls: {
                required: true,
                },
                email: {
                required: true,
                email: true,
                },
                mobile_no: {
                required: true,
                digits: true,
                },
                dzongkhag_id: {
                required: true,
                },
                gewog_id: {
                required: true,
                },
                village_id: {
                required: true,
                },
                event_location: {
                required: true,
                },
            },
            
            messages: {
                event_name: {
                required: "Please enter a event name",
                },
                country_id: {
                required: "Please choose country",
                },
                start_date: {
                required: "Please enter the event start date",
                },
                end_date: {
                required: "Please enter the event end date",
                },
                last_date: {
                required: "Please enter the last date of registration",
                },
                web_site: {
                required: "Please enter web_site",
                },
                contact_person: {
                required: "Please enter contact person",
                },
                event_dtls: {
                required: "Please write event details",
                },
                email: {
                required: "Please enter email",
                },
                mobile_no: {
                required: "Please enter phone number",
                },
                dzongkhag_id: {
                required: "Choose the dzongkhag",
                },
                gewog_id: {
                required: "Choose the gewog",
                },
                village_id: {
                required: "Choose the village",
                },
                event_location: {
                required: "Enter event location",
                },
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
    });
    $('#countryId').on('change',function(e) {
      var countryId = e.target.value;
      if(countryId==80){
         $("#displaydzongkhag").show();	
         $("#displayvillage").show();
         $("#displaylocation").hide();

      }else{
         $("#displaydzongkhag").hide();	
         $("#displayvillage").hide();
         $("#displaylocation").show();
      }		 
   });
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
</script>

