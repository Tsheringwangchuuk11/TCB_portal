@extends('layouts.manager')
@section('page-title','New : Tourist Standard Hotel Assessment')
{{-- @include('layouts.include.alert_success') --}}
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Registration of Tourist Standard Hotels</h4>
  </div>
  <form action="{{ url('service-create/store') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    @foreach ($idInfos as $idInfo)
    <input type="hidden" name="service_id" value="{{ $idInfo->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfo->module_id }}" id="module_id">
    @endforeach 
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-5">
          <label>Registration Type <span class="text-danger">*</span></label>
          <select class="form-control" name="star_category_id" id="star_category_id">
            <option value="">-select-</option>
            @foreach ($starCategoryLists as $starCategoryList)
          <option value="{{$starCategoryList->star_category_id}}">{{$starCategoryList->star_category_name}}</option>
            @endforeach
          </select>
          <span class="text-danger">{{ $errors->first('star_category_id') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">License Number <span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="license_no" id="" autocomplete="off">
          <span class="text-danger">{{ $errors->first('license_no') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">License Date <span class="text-danger">*</span> </label>
          <input type="date" class="form-control" name="license_date" id="" autocomplete="off">
          <span class="text-danger">{{ $errors->first('license_date') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Name <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="name" autocomplete="off">
          <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">Owner <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="owner" autocomplete="off">
          <span class="text-danger">{{ $errors->first('owner') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Address <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="address" autocomplete="off">
          <span class="text-danger">{{ $errors->first('address') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">Contact No <span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="contact_no" id="" autocomplete="off">
          <span class="text-danger">{{ $errors->first('contact_no') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Fax <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="fax" autocomplete="off">
          <span class="text-danger">{{ $errors->first('fax') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">Email <span class="text-danger">*</span> </label>
          <input type="email" class="form-control" name="email" autocomplete="off">
          <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Internet Homepage <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="internet_url" autocomplete="off">
          <span class="text-danger">{{ $errors->first('internet_url') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">Number of Beds <span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="bed_no" autocomplete="off">
          <span class="text-danger">{{ $errors->first('bed_no') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Location <span class="text-danger">*</span> </label>
          <select class="form-control select2bs4" name="location_id">
            <option value="">-Select-</option>
            <option value="1">Tashigang</option>
          </select>
          <span class="text-danger">{{ $errors->first('location_id') }}</span>
        </div>
      </div>
      <!-- select room -->
      <h5>Room Details</h5>
      <div class="row">
        <div class="form-group col-md-5">
          <label>Room Type <span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Number of Room<span class="text-danger">*</span> </label>
        </div>
      </div>
      <div id="row">
      <div class="row">
        <div class="form-group col-md-5">
          <select class="form-control" name="room_type_id[]" id="room_type_id">
            <option value=""> -Select Room- </option>
            <option value="1">Single</option>
            <option value="2">Double</option>
            <option value="3">Suites</option>
          </select>
          <span class="text-danger">{{ $errors->first('room_type_id') }}</span>
        </div>
        <div class="form-group col-md-4 offset-md-2">
          <input type="text" class="form-control" name="room_no[]" autocomplete="off" id="room_no">
          <span class="text-danger">{{ $errors->first('room_no') }}</span>
        </div>
      </div>
    </div>
      <div id="adddiv"></div>
      <span class="btn btn-success btn-sm float-right" id="add"> <i class="fas fa-plus fa-sm">Add</i></span>

      <!-- staff -->
      <h5>Staff Details</h5>
      <div class="row">
        <div class="form-group col-md-3">
            <label>Area <span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-md-3">
            <label>Division <span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-md-3">
            <label for="">Name <span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-3">
            <label>Gender <span class="text-danger">*</span></label>
        </div>
      </div>
      <div id="row1">
        <div class="row">
        <div class="form-group col-md-3">
          <select class="form-control" name="staff_area_id[]" id="staff_area_id">
            <option value="">-select-</option>
            <option value="1">Lodging</option>
            <option value="2">Food & Beverage</option>
            <option value="3">Recreation,Other</option>
            <option value="4">Administration</option>
            <option value="5">Sales & Marketing</option>
            <option value="6">Pomec (Property Operation & Maintance)</option>
          </select>
          <span class="text-danger">{{ $errors->first('staff_area_id') }}</span>
        </div>
        <div class="form-group col-md-3">
          <select class="form-control" name="hotel_div_id" id="hotel_div_id">
            <option value="">-select-</option>
            <option value="1">Reception</option>
            <option value="2">Reservation</option>
            <option value="3">Front-Office</option>
            <option value="4">Housekeeping</option>
          </select>
          <span class="text-danger">{{ $errors->first('hotel_div_id') }}</span>
        </div>
        <div class="form-group col-md-3">
          <input type="text" class="form-control" name="staff_name[]" autocomplete="off" id="staff_name">
          <span class="text-danger">{{ $errors->first('staff_name') }}</span>
        </div>
        <div class="form-group col-md-2">
          <select class="form-control" name="staff_gender[]" id="staff_gender">
            <option value="">-select-</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select>
          <span class="text-danger">{{ $errors->first('staff_gender') }}</span>
        </div>
      </div>
      </div>
      <div id="field_wrapper1"></div>
        <span class="btn btn-success btn-sm float-right" id="add1"> <i class="fas fa-plus fa-sm">Add</i> </span>
      <div class="row">
        <div class="col-md-12">
          <p><span>Please attach additional sheets where necessary like pictures of buildings.</span></p>
          <div class="mb-3 mt-2">
            <span class="btn btn-success fileinput-button btn-sm">
              <i class="fas fa-plus fa-sm"></i>
              <span>Add files...</span>
              <!-- The file input field used as target for the file upload widget -->
              <input  type="file" name="file[]" id="file" multiple>
            </span>
          </div>
        </div>
      </div>
      <h5>Checklist</h5>
      <div id="showdivid"></div>
     
      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span>Service Facilities</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Sanitary comfort</td>             
                    <td>Daily room cleaning</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Daily change of towels on request</td>
                    <td><input type="checkbox"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span>Additional In-House Facilities and Services</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Media</td>             
                    <td>Security and /or insurance for guest property available</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Conference room(s) of at least 36 m2 to 100 m2</td>
                    <td><input type="checkbox"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span> Environment Friendly Practices</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Reception and Lobby</td>             
                    <td>Provide pamphlets, posters, and pictures to highlight the values of the local area or call visitors’ attention to environment protection</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Provide information to guest about the hotel’s effort to be environment-friendly</td>
                    <td><input type="checkbox"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span> Website Online Pre-Check</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Website Online Pre-Check</td>             
                    <td>Clear website address</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>All links working</td>
                    <td><input type="checkbox"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span> Quality and/or Eco Certifications and (soft) quality/service Criteria</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Nationally and/or Internationally Recogniced Quality Certifications</td>             
                    <td>Total Quality management or Eco Label system like ISO 14001,Green Globe Earth Check, EMAS(Eco-Management and Audit Scheme) , EU Eco label, Green Key, or other recognized quality certification</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Systematic complaint management system-</td>
                    <td><input type="checkbox"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span> Specialisation Schemes</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Bike Hotel</td>             
                    <td>lockable storeroom for bikes is available in the accommodation.</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>A bike cleaning area with a water supply is available in the accommodation.</td>
                    <td><input type="checkbox"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span> Minimum Score Points and Bs</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Minimum Score Points and Bs</td>             
                    <td>Number of Score Points</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Number of Bs (Basic standards).</td>
                    <td><input type="checkbox"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span> Calculation Rules</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Reception and Lobby</td>             
                    <td>PAll Bs have to be met as far as :</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Public technical services are only obligatory when available in the location.</td>
                    <td><input type="checkbox"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span> Results</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Results</td>             
                    <td>Public technical services are only obligatory when available in the location.Financial services are also only obligatory when available (credit cards, electronic payment etc.).</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Number of Score Points:</td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- card body ends -->
    <div class="card-footer text-center">
      <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
      <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
    </div>    
  </form>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){ 
      id=1;
      $("#add").click(function(){
        $("#row").clone().attr('id', 'row'+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
        $addRow ='<div id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
        +'<span id="remove" onClick="removeForm('+id+')"' 
        +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
        +'<div id="line'+id+'"></div>';
        $('#adddiv').append($addRow);
        id++;
      });
    });
  
    function removeForm(id){  
      if (confirm('Are you sure you want to delete this form?')){
        $('#row'+id).remove();
        $('#remove'+id).remove();
        $('#line'+id).remove();
      }
    }
    $(document).ready(function(){
    id1=1;
    $("#add1").click(function(){
      $("#row1").clone().attr('id', 'row1'+id1).after("#id").appendTo("#field_wrapper1").find("input[type='text']").val("");
      $addRow1 ='<div id="remove1'+id1+'" class="btn-group" style=" margin-top:-50px; float:right">' 
      +'<span id="remove1" onClick="removeForm1('+id1+')"' 
      +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
      +'<div id="line1'+id1+'"></div>';
      $('#field_wrapper1').append($addRow1);
      id1++;
    }); 
  });
  function removeForm1(id1){  
    if (confirm('Are you sure you want to delete this form?')){
      $('#row1'+id1).remove();
      $('#remove1'+id1).remove();
      $('#line1'+id1).remove();
    }
  }
  /*$('#star_category_id').on('change',function(ev){
     // debugger;
    var starCategoryId=$("#star_category_id").val();
    var module_id=$("#module_id").val();
    var url="{{ url('service-create/get-checklist') }}";
        $.ajax({
        url: url,
        type: "GET",
        data : {starCategoryId:starCategoryId,moduleId : module_id},
        dataType: "JSON",
        success:function(data) {
            console.log(data);
            for(var i=0; i < data.length; i++){
               var tr_str = '<tr>' +
                   '<td>' + data[i].checklist_area  + '</td>' +
                   '<td>' +  data[i].checklist_standard + '</td>' +
                   '<td>'+ data[i].checklist_pts + '</td>' +
                   '<td>' + data[i].standard_code + '</td>' +
               '</tr>';
               $('#dataTable tbody').append(tr_str);
          }
        }
     });
  })*/
  $(document).ready(function(){
      $('#star_category_id').on('change',function(ev){
        var star_category_id=$("#star_category_id").val();
        var url="{{ url('application/get-checklist') }}";
        var options = {target:'#showdivid',
        url:url,
        type:'POST',
        data: $("#formdata").serialize()};
        $("#formdata").ajaxSubmit(options);
        });
  });
</script>   
@endsection