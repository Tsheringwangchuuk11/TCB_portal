@extends('public_view.main')
@section('page-title','New : Tourist Standard Hotel Assessment')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Registration of Tourist Standard Hotels</h4>
  </div>
  <form action="{{ url('tourist_standard_hotels/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-5">
          <label>Registration Type <span class="text-danger">*</span></label>
          <select class="form-control select2bs4" style="width: 100%;" required>
            <option value="1" selected="selected">-select-</option>
            <option value="">3 Star</option>
            <option value="2">4 Star</option>
            <option value="3">5 Star</option>
          </select>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">License Number <span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="license_number" id="" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5">
          <label for="">License Date <span class="text-danger">*</span> </label>
          <input type="date" class="form-control" name="license_date" id="" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Name <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="name" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5">
          <label for="">Owner <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="accomodation" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Address <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="address" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5">
          <label for="">Contact No <span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="phone_number" id="" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Fax <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="fax" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5">
          <label for="">Email <span class="text-danger">*</span> </label>
          <input type="email" class="form-control" name="email" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Internet Homepage <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="internet" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5">
          <label for="">Number of Beds <span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="bed_no" autocomplete="off" required>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Location <span class="text-danger">*</span> </label>
          <select class="form-control select2bs4" required>
            <option selected="selected">-Select-</option>
            @foreach ($location as $locations)
            <option>{{ $locations->location_name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <!-- select room -->
      <h5>Room Details</h5>
      <div class="form-row" id="row">
        <div class="form-group col-md-5">
          <label>Room Type <span class="text-danger">*</span></label>
          <select class="form-control select2bs4" required>
            <option selected="selected">-Select Room-</option>
            <option>Single</option>
            <option>Double</option>
            <option>Suites</option>
          </select>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Number of Room<span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="single_room" autocomplete="off" required>
        </div>
      </div>
      <div id="field_wrapper"></div>
      <div align="right">
        <span class="btn btn-success btn-sm" id="add"> <i class="fas fa-plus fa-sm"><span> Add</span></i> </span>
      </div>

      <!-- staff -->
      <h5>Staff Details</h5>
      <div class="form-row" id="row1">
        <div class="form-group col-md-3">
          <label>Area <span class="text-danger">*</span></label>
          <select class="form-control select2bs4" required>
            <option selected="selected">-select-</option>
            <option>Lodging</option>
            <option>Food & Beverage</option>
            <option>Recreation,Other</option>
            <option>Administration</option>
            <option>Sales & Marketing</option>
            <option>Pomec (Property Operation & Maintance)</option>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label>Division <span class="text-danger">*</span></label>
          <select class="form-control select2bs4" required>
            <option selected="selected">-select-</option>
            <option>Reception</option>
            <option>Reservation</option>
            <option>Front-Office</option>
            <option>Housekeeping</option>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label for="">Name <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="name" autocomplete="off" required>
        </div>
        <div class="form-group col-md-3">
          <label>Gender <span class="text-danger">*</span></label>
          <select class="form-control select2bs4" required>
            <option selected="selected">-select-</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
      </div>
      <div id="field_wrapper1"></div>
      <div align="right">
        <span class="btn btn-success btn-sm" id="add1"> <i class="fas fa-plus fa-sm"><span> Add</span></i> </span>
      </div>

      <div class="row">
        <div class="col-md-12">
          <p><span>Please attach additional sheets where necessary like pictures of buildings.</span></p>
          <div class="mb-3 mt-2">
            <span class="btn btn-success fileinput-button btn-sm">
              <i class="fas fa-plus fa-sm"></i>
              <span>Add files...</span>
              <!-- The file input field used as target for the file upload widget -->
              <input id="fileupload" type="file" name="files[]" multiple="">
            </span>
          </div>
        </div>
      </div>

      <h5>Checklist</h5>
      <!-- General/Exterior/Location/Building/Rooms -->
      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span>General/Exterior/Location/Building/Rooms</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" ><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="dataTable">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">General Impression</td>             
                    <td>Accommodation should be in clean and good condition (entry requirement for 3-5*),in harmony with the natural and built up environment and in conformity with planning, environmental and construction laws-with layout and class meeting the image of the respective *rating –required certifications, documents, checked</td> 
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Appropriate design, architectural features and hospitality meets guest expectations in 3-5*</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Capacity</td>
                    <td>The accommodation should have at least 8 rooms in a separate building or a clearly defined part of another building functionally independent</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Access</td>
                    <td>Access to accommodation 24 hours/day.</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Signage</td>
                    <td>Appropriate signage to guide to main entrance, guest rooms and classification signs clearly visible–visibility of classification sign to guests</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Safety and Security</td>
                    <td>Appropriate fire protection/first aid/emergency power/stair case lightning/electrical safety and health protection – check of legally required certifications</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Cleanliness/Hygiene</td>
                    <td>Cleanliness and a hygienically good maintenance are entry requirements and basic conditions in each category – all rooms are clean – BAFRA clearance checked</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Maintenance condition</td>
                    <td>All guest facilities and equipments are functional, operational and have a sufficient degree of maintenance</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Staircases and Hallways</td>
                    <td>Permanent /automatic lighting and dimensions should allow easy passage to all guest areas.</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Assistance</td>
                    <td>Guests must be able to reach an employee 24 hours a day.</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Public Restrooms</td>
                    <td>At least one public WC/restroom with gender separation per 20 rooms and with hot and cold running water, wash-basin, one urinal in male toilet, mirror, soap, provisions to dry hands and litterbin.</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Ventilation</td>
                    <td>Natural or mechanical ventilation in public areas, guest rooms and sanitary rooms with appropriate ventilation capacities.</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td rowspan="2">Staff Facilities</td>
                    <td>Staff changing rooms must be sufficient in size related to number of staff and with WC/shower, locker, toilet and cafeteria and gender separation observed. Staff must have separate entrance away from guests entrance to the main building.</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Staff uniforms provided.</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Staff Numbers</td>
                    <td>Relation to rooms 1:2 as general thump rule. Higher ratio in 4-5* level expected</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Staff Qualifications</td>
                    <td>Must be appropriate and according to labor market supply and conditions-taking into considerations of in Bhutan available professional and adult-learning training coursesie graduates from RITH to be considered etc.</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td rowspan="10">Kitchen</td>
                    <td>Should have deep fridge, dry and cold storage facilities for segregated storage of fish meat and vegetables, cold and hot kitchen, pantry.</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Size should not be less than ½ m2 per bed offered</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Head covering and regular medical checks up for production staff.</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Ventilation must be adequate</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Drinking water treatment equipment</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                  <tr>
                    <td>Equipment and machinery of the kitchen in good technical condition and maintenance. Quality of crockery, glassware and cutlery complying to respective star level.</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Pastry/bakery</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Hand washing basins easily accessible</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>Extraction/pest control/waste collection and storage/drainage/sewage/water supply and storage facilities should be in good maintenance</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>There should always be at least one trained cook (chef) on duty with sufficient skills in HACCP or BAFRA certified.</td>
                    <td><input type="checkbox"> <span class="text-danger">*</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>

      <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse">
          <span>Fittings/Furniture/Equipment</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="dataTable">
                <tbody>
                  <tr>
                    <td>Area</td>
                    <td>Standard</td>
                    <td>Checklist</td>
                  </tr>    
                  <tr>
                    <td rowspan="2">Sanitary comfort</td>             
                    <td>Remark: Hot and cold running water 24 hrs is an entry requirement to the classification and applies to 3– 5*</td> 
                    <td><input type="checkbox"></td>
                  </tr>
                  <tr>
                    <td>50 % of the rooms with shower/WC or bath/WCfor the rest on same floor level</td>
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
          <span>Service Facilities</span>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="dataTable">
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
              <table class="table table order-list table-bordered" id="dataTable">
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
              <table class="table table order-list table-bordered" id="dataTable">
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
                    <td>DProvide information to guest about the hotel’s effort to be environment-friendly</td>
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
              <table class="table table order-list table-bordered" id="dataTable">
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
              <table class="table table order-list table-bordered" id="dataTable">
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
              <table class="table table order-list table-bordered" id="dataTable">
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
              <table class="table table order-list table-bordered" id="dataTable">
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
              <table class="table table order-list table-bordered" id="dataTable">
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
              <table class="table table order-list table-bordered" id="dataTable">
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
@section('page_scripts')
<!-- room type -->
<script>
  $(document).ready(function(){
    id=1;
    $("#add").click(function(){
      $("#row").clone().attr('id', 'row'+id).after("#id").appendTo("#field_wrapper");
      $addRow ='<div id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
      +'<span id="remove" onClick="removeForm('+id+')"' 
      +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
      +'<div id="line'+id+'"></div>';
      $('#field_wrapper').append($addRow);
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
</script>
<!-- staff -->
<script>
  $(document).ready(function(){
    id=1;
    $("#add1").click(function(){
      $("#row1").clone().attr('id', 'row1'+id).after("#id").appendTo("#field_wrapper1");
      $addRow ='<div id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
      +'<span id="remove" onClick="removeForm1('+id+')"' 
      +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
      +'<div id="line'+id+'"></div>';
      $('#field_wrapper1').append($addRow);
      id++;
    });
  });

  function removeForm1(id){  
    if (confirm('Are you sure you want to delete this form?')){
      $('#row1'+id).remove();
      $('#remove'+id).remove();
      $('#line'+id).remove();
    }
  }
</script>
@endsection
@endsection
