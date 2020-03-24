@extends('public_view.main')
@section('page-title','New : Tourist Standard Restuarant Assessment')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h3 class="card-title">Registration of Tourist Standard Restuarant</h3>
  </div>
  <form action="{{ url('') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">License Number <span class="text-danger">*</span> </label>
            <input type="number" class="form-control" name="license_number" id="" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">License Date <span class="text-danger">*</span> </label>
            <input type="date" class="form-control" name="license_date" id="" autocomplete="off" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Name <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="name" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Owner <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="accomodation" autocomplete="off" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Address <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="address" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Contact No <span class="text-danger">*</span> </label>
            <input type="number" class="form-control" name="phone_number" id="" autocomplete="off" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Fax <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="fax" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Email <span class="text-danger">*</span> </label>
            <input type="email" class="form-control" name="email" autocomplete="off" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Internet Homepage <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="internet" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Number of Beds <span class="text-danger">*</span> </label>
            <input type="number" class="form-control" name="bed_no" autocomplete="off" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Location <span class="text-danger">*</span> </label>
            <select class="form-control select2bs4" required>
              <option selected="selected">-Select-</option>
              @foreach ($location as $locations)
              <option>{{ $locations->location_name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <!-- staff -->
      <h5>Staff Details</h5>
      <div class="row" id="row1">
        <div class="col-md-3">
          <div class="form-group">
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
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Division <span class="text-danger">*</span></label>
            <select class="form-control select2bs4" required>
              <option selected="selected">-select-</option>
              <option>Reception</option>
              <option>Reservation</option>
              <option>Front-Office</option>
              <option>Housekeeping</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="">Name <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="name" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Gender <span class="text-danger">*</span></label>
            <select class="form-control select2bs4" required>
              <option selected="selected">-select-</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
        </div>
      </div>
      <div id="field_wrapper1"></div>
      <div class="float:right">
        <span class="btn btn-success btn-sm" id="add1"> <i class="fas fa-plus fa-sm"><span> Add</span></i> </span>
      </div>

      <div class="row">
        <div class="col-md-12">
          <p><span>Please attach additional sheets where necessary like pictures of the office.</span></p>
          <div class="mb-3 mt-2">
           <div class="form-group">
            <span class="btn btn-success fileinput-button btn-sm">
              <i class="fas fa-plus fa-sm"></i>
              <span>Add files...</span>
              <!-- The file input field used as target for the file upload widget -->
              <input id="fileuploaded" type="file" name="filename"> 
            </span>
            <div id="progress" class="progress">
              <div class="progress-bar progress-bar-success"></div>
            </div>
            <div id="files" class="files"></div>
          </div>
        </div>
      </div>
    </div>

    <h5>Inspector’s Checklist</h5>
    <!-- General/Exterior/Location/Building/Rooms -->
    <div class="card">
      <div class="card-header">
        <span>General/location/Interior</span>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table class="table table order-list table-bordered" id="dataTable">
              <tbody>
                <tr>
                  <td>Area</td>
                  <td>Criteria</td>
                  <td>Checklist</td>
                </tr>    
                <tr>
                  <td rowspan="9">General/location/Interior</td>             
                  <td>Appropriate design, architectural features must be incorporated.</td> 
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
                <tr>
                  <td>Appropriate signage to guide to main entrance and other facilities in the restaurant.</td>
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
                <tr>
                  <td>Restaurant floors and surfaces are cleaned, Maintained and in good condition – all public areas and kitchens are serviced daily.</td>
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
                <tr>
                  <td>Restaurant have appropriate heating and /or air conditioning systems</td>
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
                <tr>
                  <td>All guest facilities and equipment are functional and must be well maintained.</td>
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
                <tr>
                  <td>Lighting and dimension should allow easy passage.</td>
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
                <tr>
                  <td>Lift (if the restaurant is located in more than three floors of the building)</td>
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
                <tr>
                  <td>Segregation of smoking/ nonsmoking designated area as per the Tobacco Act of the Country.</td>
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
                <tr>
                  <td>Proper telephone services provided in the premises</td>
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
                <tr>
                  <td>Staff</td>
                  <td>Staff uniforms should be provided.</td>
                  <td><input type="checkbox"> <span class="text-danger">*</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>

    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label for="">Inspectors Name <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="inspector_name" id="" autocomplete="off" required>
        </div>
      </div>
      <div class="col-md-5 offset-md-2">
        <div class="form-group">
          <label for="">Inspection Date <span class="text-danger">*</span> </label>
          <input type="date" class="form-control" name="inspector_date" id="" autocomplete="off" required>
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

<!-- fileupload -->
<script>
  $(function () {
    'use strict';
    $('#fileuploaded').fileupload({

      add: function(e, data) {
        data.submit();
      },
      url: "{{ url('documentattach') }}",
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      autoUpload: true,
      dataType : 'json',
      success: function (data) {
        alert(data.data);
        var result = jQuery.parseJSON(data);
        $('#files').append('<div class="image_wrap"><strong>'+result.documentName+'</strong><button type="button" onClick="deletefile(this.id)" id="deleteId'+count+'" class="btn btn-danger"  data-file_id="'+result.documentId+'"><i class="glyphicon glyphicon-trash"></i> <span>Delete<span></button></div><br />');  
        $('#files').append('<input name="document_id[]" value="'+result.documentId+'" type="hidden" />');

        count++;
        $('#countId').val(count);
      }
    });
  });
</script>

@endsection
@endsection
