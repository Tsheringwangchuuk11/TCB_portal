@extends('layouts.manager')
@section('page-title','New : Village Home Stay Assessment')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <div class="card-title">Village Home Stay Registration</div>
  </div>
  <form action="{{ url('service-create/store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h5>Applicant’s details</h5>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="name" autocomplete="off" required>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group ">
                <label for="">CID No.<span class="text-danger"> *</span></label>
                <input type="number" class="form-control" name="cid" id="cid" autocomplete="off" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Contact No.<span class="text-danger"> *</span> </label>
                <input type="number" class="form-control" name="phone_number" id="phone_number" autocomplete="off" required>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                <select class="form-control select2bs4" style="width: 100%;" required>
                  <option value="1" selected="selected">-select-</option>
                  <option value="">Thimphu</option>
                  <option value="2">Paro</option>
                </select>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Gewog<span class="text-danger"> *</span></label>
                <select class="form-control select2bs4" style="width: 100%;" required>
                  <option value="1" selected="selected">-select-</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Chiwog<span class="text-danger"> *</span></label>
                <select class="form-control select2bs4" style="width: 100%;" required>
                  <option value="1" selected="selected">-select-</option>
                </select>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Village <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="village" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Thram No.<span class="text-danger"> *</span> </label>
                <input type="text" class="form-control" name="thram_no" required>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">House No.<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="house_no" required>
              </div>
            </div>
          </div>
          <h5>Locations</h5>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Distance from the nearest town/urban centre (hrs or kms)<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="distance1" autocomplete="off" required>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Distance from the main road (hrs or kms)<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="distance2" autocomplete="off" required>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Condition of the pathway to house from the road point<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="distance3" autocomplete="off" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p><span>Please attach additional sheets where necessary like pictures of buildings,no objection letter from the head of the family, authentication letter from the gewog, recommendation letter from the dzongkhag and the letter of undertaking.</span></p>
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
          <h5>Details Of The Family Members Residing In The Same House</h5>
          <div class="row">
            <div class="col-md-12">
              <table class="table table order-list table-bordered" id="dataTable">
                <tbody>
                  <tr><td>Name</td>
                    <td>Relationship with the applicant</td>
                    <td>Age</td>
                    <td>Gender</td>
                    <td></td>
                  </tr>    
                  <tr>
                    <td><input type="text" id="fname" class="form-control" name="name" autocomplete="off" required>
                    </td>              
                    <td><input  type="text" id="frelation" class="form-control" name="relation" autocomplete="off" required>
                    </td> 
                    <td><input  type="number" id="fage" class="form-control" name="age" autocomplete="off" required>
                    </td>              
                    <td>
                      <select name="gender" id="fgender" class="form-control select2bs4" required>
                        <option value="" selected>-select-</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option> 
                      </select>
                    </td>
                    <td>
                      <button type="button" class="btn btn-success btn-xs tooltip-top" title="Add More" id="addrow"><i class="fas fa-plus"> Add</i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <h5>Self-assessment form (Annexure II)</h5>
          <div class="row">
            <div class="col-md-12">
              <p><strong>M:</strong> Parameters with M are mandatory requirements for the VHS to be approved</p>
              <p><strong>D:</strong> Parameters with D are desirable and recommended to be in place</p>
              <table class="table table table-bordered" id="dataTable">
                <tbody>
                  <tr>
                    <td>Areas</td>
                    <td>Parameters</td>
                    <td>Checklist</td>
                  </tr> 
                  <!-- general -->
                  <tr>
                    <td rowspan="6">General</td>
                    <td>VHS is in a traditional building or house and conforms to the architecture of the locality (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr> 
                  <tr>
                    <td>VHS is managed by family residing in the same house (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr>
                  <tr>
                    <td>VSurrounding is pleasant, safe and clean (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr>
                  <tr>
                    <td>Personal hygiene of the host family is good (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr>
                  <tr>
                    <td>Access to the house from the road point is convenient and safe (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr>
                  <tr>
                    <td>Basic heating/cooling facilities depending on the climatic condition (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr>
                  <!-- guest rooms -->
                  <tr>
                    <td rowspan="6">Guest rooms</td>
                    <td>No of guest rooms does not exceed 5 (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr> 
                  <tr>
                    <td>Altar room is not used as guest room (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr>
                  <tr>
                    <td>Guest rooms are clean and well-maintained with proper ventilation (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr>
                  <tr>
                    <td>Mattresses, blankets, pillows and linens are clean and comfortable (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr>
                  <tr>
                    <td>Dressing mirror and wardrobe are provided (D)</td>
                    <td><input type="checkbox" name=""></td>
                  </tr>
                  <tr>
                    <td>Hanger/hook is provided (M)</td>
                    <td><input type="checkbox" name=""><span class="text-danger"> *</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-center" >
      <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
      <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
    </div>
  </form>
</div>
@endsection
@section('page_scripts')
<script>
 $(document).ready(function () {
  var counter = 0;
  $("#addrow").on("click", function () {
    var name = $("#fname").val();
    var gender = $("#fgender").val();
    var age= $("#fage").val();
    var relation= $("#frelation").val();
    var newRow = $("<tr>");
    var cols = "";
    cols += '<td><input type="text" class="form-control" name="name[]' + counter + '" value="'+ name +' " /></td>';
    cols += '<td><input type="text" class="form-control" name="relation[]' + counter + '" value="'+ relation +' "/></td>';
    cols += '<td><input type="text" class="form-control" name="age[]' + counter + '" value="'+ age +' "/></td>';
    cols += '<td><select class="form-control" name="gender[]' + counter + '" value="'+ gender +' "><option value="Male">Male</option><option value="Female">Female</option></select></td>';
    cols += '<td><button type="button" class="btn btn-danger btn-xs tooltip-top" id="delete" title="Delete"><li class="fas fa-trash"></li></button></td>';
    newRow.append(cols);
    $("table.order-list").append(newRow);
    counter++;
    $("#fname").val('');
    $("#frelation").val('');
    $("#fage").val('');
    $("#fgender").val('');
  });
  $("table.order-list").on("click", "#delete", function (event) {
    $(this).closest("tr").remove();       
    counter -= 1
  });

});

</script>
@endsection