@extends('public_view.main')
@section('page-title','New : Grievance')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h3 class="card-title">Grievance Form</h3>
  </div>
  <div class="row">
    <div class="col-md-12">
      <p class="text-danger pt-3">Note: (*) fields are required</p>
    </div>
  </div>

  <form action="{{ url('service-create/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <h5>Person or Firm submitting Application (“Complainant”)</h5>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Name of complainant <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-4 offset-md-2">
          <div class="form-group">
            <label for="">Authentic address for correspondence <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="name" autocomplete="off" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Telephone/Mobile Number <span class="text-danger">*</span> </label>
            <input type="number" class="form-control" name="phone_number" id="" autocomplete="off" required>
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
        <div class="col-md-12">
          I would like to submit this complaint for consideration and review by the Tourism Council of Bhutan as follows:
        </div>
      </div>

      <h5>If this Application is made by Legal or other Third Party Representative representing the Complainant, please provide a copy of the document authorizing the representation (“power of attorney”) together with the following details</h5>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Name of the Representative <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="name" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Authentic address for correspondence <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="name" autocomplete="off" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Telephone/Mobile Number <span class="text-danger">*</span> </label>
            <input type="number" class="form-control" name="phone_number" id="" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Email <span class="text-danger">*</span> </label>
            <input type="email" class="form-control" name="email" autocomplete="off" required>
          </div>
        </div>
      </div>

      <h5>Person or Firm against whom the complaint is made (“Respondent”)</h5>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Name of Respondent <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="name" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label>Category of service provider <span class="text-danger">*</span> </label>
            <select class="select2" multiple="multiple" data-placeholder="-Select service provider-" style="width: 100%;">
              <option>Tourism Council of Bhutan</option>
              <option>Tour guide </option>
              <option>Tour Operator</option>
              <option>Accomodation providers</option>
              <option>Horse contractor</option>
              <option>Transport provider</option>
              <option>Other service provider</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Telephone/Mobile Number <span class="text-danger">*</span> </label>
            <input type="number" class="form-control" name="phone_number" id="" autocomplete="off" required>
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Address <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="name" autocomplete="off" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Email <span class="text-danger">*</span> </label>
            <input type="email" class="form-control" name="email" autocomplete="off" required>
          </div>
        </div>
      </div>

      <h5>Summary of the Claim</h5>
      <div class="row">
        <div class="col-md-12">
          <p><span>Please attach additional sheets where necessary</span></p>
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

      <h5>Supporting Document</h5>
      <div class="row">
        <div class="col-md-12">
          <span>Please indicate what supporting documents you propose to submit in support of your Application and, where appropriate: (Please attach additional sheet where necessary to fully describe your evidence)</span>
          <div>This Claim is accompanied by:</div>
          <div>(a) a copy of the contract document including email correspondences, itinerary, copy of remittance, between the Claimant and the Respondent</div>
          <div>(b) other evidence such follows:</div>

          <div id="row">
            <textarea type="text" class="form-control" name="name" autocomplete="off"></textarea>
          </div>
          <div id="field_wrapper" class="pt-3"></div>
          <div align="right">
            <span class="btn btn-success btn-sm" id="add"> <i class="fas fa-plus fa-sm"><span> Add</span></i> </span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label for="">Remedy sought <span class="text-danger">*</span> </label>
          <textarea type="text" class="form-control" name="name" autocomplete="off" required></textarea>
        </div>
      </div>

      <h5>Statement of Adherence</h5>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div>I/we hereby declare that</div>
            <ul class="list-unstyled pl-4">
              <li>1. the above information is true and accurate to the best of my/our knowledge and belief;</li>
              <li>2.  the complaint submitted are genuine and not in bad faith; and</li>
              <li>3. all important information material for resolving of this complaint are shared or will be shared with the Tourism Council of Bhutan.</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Location <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="name" autocomplete="off" required>
          </div> 
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Date <span class="text-danger">*</span> </label>
            <input type="date" class="form-control">
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
@section('page_scripts')
<script>
  $(document).ready(function(){
    id=1;
    $("#add").click(function(){
      $("#row").clone().attr('id', 'row'+id).after("#id").appendTo("#field_wrapper").find("textarea, input[type=text]").val("");
      $addRow ='<div id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
      +'<span id="remove" onClick="removeForm('+id+')"' 
      +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
      +'<div id="line'+id+'"><br/></div>';
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
@endsection