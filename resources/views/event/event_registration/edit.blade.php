<form id="event_form" action="{{ url('events/travel-fairs-event/'.$data->id) }}" class="form-horizontal" method="POST">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Event Name <span class="text-danger"> *</span></label>
                    <input type="text" id= "eventName" name="event_name" value="{{$data->event_name}}" class="form-control">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">To Country <span class="text-danger"> *</span></label>
                    <select  name="country_id" class="form-control select2bs4" style="width: 100%;" id="countryId">
                        <option value=""> -Select-</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id', $data->country_id) == $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row" style="display:none" id="displaydzongkhag">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control dzongkhagdropdown" style="width: 100%;">
                    <option value=""> -Select-</option>
                    @foreach ($dzongkhagLists as $dzongkhagList)
                    <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $data->dzongkhag_id) == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                    @endforeach
                  </select>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Gewog<span class="text-danger"> *</span></label>
                <select  name="gewog_id" class="form-control gewogdropdown" id="gewog_id" style="width: 100%;">
                   <option value="{{$data->gewog_id}}"> {{$data->gewog_name}}</option>
                </select>   
              </div>
            </div>
          </div>
        <div class="row">
            <div class="col-md-5" style="display:none" id="displayvillage">
                <div class="form-group">
                  <label for="">Village<span class="text-danger"> *</span></label>
                  <select  name="village_id" class="form-control" id="village_id" style="width: 100%;">
                    <option value="{{$data->village_id}}"> {{$data->village_name}}</option>
                  </select>
                </div>
            </div>
            <div class="col-md-5" id="displaylocation">
                <div class="form-group">
                    <label for="">Location <span class="text-danger"> *</span></label>
                    <input type="text" id= "eventlocation" name="event_location" value="{{$data->event_location}}" class="form-control">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Event Start Date <span class="text-danger"> *</span></label>
                    <input type="date" id= "eventstartDate" name="start_date" value="{{$data->start_date}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Event End Date <span class="text-danger"> *</span></label>
                    <input type="date" id= "eventendDate" name="end_date" value="{{$data->end_date}}" class="form-control">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Late Date Of Registration <span class="text-danger"> *</span></label>
                    <input type="date" id= "eventlastDate" name="last_date" value="{{$data->last_date}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Website<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="web_site" value="{{$data->web_site}}" id="web_site" autocomplete="off" >
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Contact Person<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="contact_person"  value="{{ $data->contact_person }}" id="contact_person" autocomplete="off" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Email<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="email"  value="{{$data->email }}" id="email" autocomplete="off" >
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Contact No<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="mobile_no"  value="{{ $data->mobile_no }}" id="mobile_no" autocomplete="off" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Event Details <span class="text-danger"> *</span></label>
                <textarea type="text" class="form-control" name="event_dtls" id="eventDtl" row="3">{{$data->event_dtls}}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="margin-bottom:-14px;">
            <button type="submit" class="btn btn-success btn-flat margin-r-5">Update</button>
            <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
        </div>
    </form>
    <script>
         $(document).ready(function () {
            var countryId="{!! $data->country_id !!}";
                if(countryId==1){
                $("#displaydzongkhag").show();	
                $("#displayvillage").show();
                $("#displaylocation").hide();
                }else{
                    $("#displaydzongkhag").hide();	
                    $("#displayvillage").hide();
                    $("#displaylocation").show();
                }	 
         })
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
          if(countryId==1){
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
                    $('select[name="gewog_id"]').append('<option value=" ">Select</option>');
                $.each(data, function(key, value) {
                       $('select[name="gewog_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                   });
                 }
             });
          }else{
             $("#gewog_id option:gt(0)").remove();	
             $("#village_id option:gt(0)").remove();
          }		 
       });
       $('.gewogdropdown').on('change',function(e) {
          var gewog_id = e.target.value;
          if(gewog_id){
            $("#gewog_id option:gt(0)").remove();	
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
                $("#village_id").find("option:selected").remove();
                 $('select[name="village_id"]').append('<option value=" ">Select</option>');
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
    
