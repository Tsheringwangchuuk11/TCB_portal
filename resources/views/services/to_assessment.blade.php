@extends('layouts.manager')
@section('page-title','New : Tour Operator Assessment')
@section('content')

<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Tour Operator Assessment/Monitoring Form</h4>
  </div>
  <form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="company_name" autocomplete="off">
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Location <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="proposed_location" autocomplete="off">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="owner" autocomplete="off">
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Telephone/Mobile No. <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="contact_no" autocomplete="off">
          </div>
        </div>
      </div>

      <!-- Tour Operator's License -->
      <div class="row">
        <div class="col-md-12">
          <h5>Tour Operator's License</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label>License details <span class="text-danger">*</span> </label>
            <input type="radio" name="license" required> Valid
            <input type="radio" name="license" required> Invalid
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="">Remarks: </label>
            <textarea class="form-control" name="license_r" rows="2" autocomplete="off"></textarea>
          </div>
        </div>
      </div>

      <!-- Office -->
      <div class="row">
        <div class="col-md-12">
          <h5>Office</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Office Space <span class="text-danger">*</span> </label>
            <input type="radio" name="office" required> Separate Premises          
            <input type="radio" name="office" required> With Residence
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">If Attached with Residence <span class="text-danger">*</span></label>
            <input type="radio" name="residence"> Proper Demarcation
            <input type="radio" name="residence"> No Demarcation
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Proper Sign Board <span class="text-danger">*</span> </label>
            <input type="radio" name="signboard" required> Yes
            <input type="radio" name="signboard" required> No
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="">Remarks: </label>
            <textarea class="form-control" name="office_r" rows="2" autocomplete="off"></textarea>
          </div>
        </div>
      </div>

      <!-- Office Equipment -->
      <div class="row">
        <div class="col-md-12">
          <h5>Office Equipment</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Computers <span class="text-danger">*</span> </label>
            <input type="radio" name="computer" required> Yes          
            <input type="radio" name="computer" required> No
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Printers <span class="text-danger">*</span> </label>
            <input type="radio" name="printer" required> Yes
            <input type="radio" name="printer" required> No
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Photocopy Machine <span class="text-danger">*</span> </label>
            <input type="radio" name="photocopy"> Yes
            <input type="radio" name="photocopy"> No
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Appropriate Office Furniture <span class="text-danger">*</span> </label>
            <input type="radio" name="furniture" required> Yes
            <input type="radio" name="furniture" required> No
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="">Remarks: </label>
            <textarea class="form-control" name="equipment_r" rows="2" autocomplete="off"></textarea>
          </div>
        </div>
      </div>

      <!-- Communication Facilities -->
      <div class="row">
        <div class="col-md-12">
          <h5>Communication Facilities</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Proper Postal Address <span class="text-danger">*</span> </label>
            <input type="radio" name="postal"> Yes
            <input type="radio" name="postal"> No
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Internet Connection <span class="text-danger">*</span> </label>
            <input type="radio" name="in_connection" required> Yes          
            <input type="radio" name="in_connection" required> No
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="">Proper Email Address <span class="text-danger">*</span> </label>
            <input type="radio" name="email" required> Yes
            <input type="radio" name="email" required> No
          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="form-group">
            <label for="">Functional Website <span class="text-danger">*</span> </label>
            <input type="radio" name="website" required> Yes
            <input type="radio" name="website" required> No
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="">Remarks: </label>
            <textarea class="form-control" name="communication_r" rows="2" autocomplete="off"></textarea>
          </div>
        </div>
      </div>

      <!-- Employment -->
      <div class="row">
        <div class="col-md-12">
         <h5>Employment</h5>
       </div>
     </div>

     <div class="row">
       <div class="col-md-5">
         <div class="form-group">
          <label for="">Managing Director/CEO <span class="text-danger">*</span> </label>
          <input type="radio" name="radio1"> Yes
          <input type="radio" name="radio1"> No
          <input type="radio" name="radio1"> Bhutanese
          <input type="radio" name="radio1"> Foreigner
        </div>
      </div>
      <div class="col-md-5 offset-md-2">
        <div class="form-group">
          <label for="">General Manager <span class="text-danger">*</span> </label>
          <input type="radio" name="radio1"> Yes          
          <input type="radio" name="radio1"> No
          <input type="radio" name="radio1"> Bhutanese
          <input type="radio" name="radio1"> Foreigner
        </div>
      </div>
    </div>

    <div class="row">
     <div class="col-md-5">
       <div class="form-group">
        <label for="">Finance/Administration Officer <span class="text-danger">*</span> </label>
        <input type="radio" name="radio1"> Yes          
        <input type="radio" name="radio1"> No
        <input type="radio" name="radio1"> Bhutanese
        <input type="radio" name="radio1"> Foreigner
      </div>
    </div>
    <div class="col-md-5 offset-md-2">
      <div class="form-group">
        <label for="">Tour/trekking Guides <span class="text-danger">*</span> </label>
        <input type="radio" name="radio1"> Yes          
        <input type="radio" name="radio1"> No
        <input type="radio" name="radio1"> Valid License
        <input type="radio" name="radio1"> Invalid License
      </div>
    </div>
  </div>

  <div class="row">
   <div class="col-md-5">
    <div class="form-group">
      <label for="">Operation/Reservation Managers <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1"> Yes
      <input type="radio" name="radio1"> No
      <input type="radio" name="radio1"> Bhutanese
      <input type="radio" name="radio1"> Foreigner
    </div>
  </div>
  <div class="col-md-5 offset-md-2">
    <div class="form-group">
      <label for="">Accountant  <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1"> Yes          
      <input type="radio" name="radio1"> No
      <input type="radio" name="radio1"> Bhutanese
      <input type="radio" name="radio1"> Foreigner
    </div>
  </div>
</div>

<div class="row">
 <div class="col-md-5">
  <div class="form-group">
    <label for="">Assistant Managers <span class="text-danger">*</span> </label>
    <input type="radio" name="radio1"> Yes          
    <input type="radio" name="radio1"> No
    <input type="radio" name="radio1"> Bhutanese
    <input type="radio" name="radio1"> Foreigner
  </div>
</div>
<div class="col-md-5 offset-md-2">
  <div class="form-group">
    <label for="">Office Assistants <span class="text-danger">*</span> </label>
    <input type="radio" name="radio1"> Yes          
    <input type="radio" name="radio1"> No
    <input type="radio" name="radio1"> Bhutanese
    <input type="radio" name="radio1"> Foreigner
  </div>
</div>
</div>
<div class="row">
 <div class="col-md-5">
  <div class="form-group">
    <label for="">Ticketing Staff <span class="text-danger">*</span> </label>
    <input type="radio" name="radio1"> Yes
    <input type="radio" name="radio1"> No
    <input type="radio" name="radio1"> Bhutanese
    <input type="radio" name="radio1"> Foreigner
  </div>
</div>
<div class="col-md-5 offset-md-2">
  <div class="form-group">
    <label for="">Drivers <span class="text-danger">*</span> </label>
    <input type="radio" name="radio1"> Yes          
    <input type="radio" name="radio1"> No
    <input type="radio" name="radio1"> Valid License
    <input type="radio" name="radio1"> Invalid License
  </div>
</div>
</div>
<div class="row">
 <div class="col-md-5">
  <div class="form-group">
    <label for="">Trekking Cooks <span class="text-danger">*</span> </label>
    <input type="radio" name="radio1"> Yes          
    <input type="radio" name="radio1"> No
    <input type="radio" name="radio1"> Bhutanese
    <input type="radio" name="radio1"> Foreigner
  </div>
</div>
<div class="col-md-5 offset-md-2">
  <div class="form-group">
    <label for="">Trek Assistants <span class="text-danger">*</span> </label>
    <input type="radio" name="radio1"> Yes          
    <input type="radio" name="radio1"> No
    <input type="radio" name="radio1"> Bhutanese
    <input type="radio" name="radio1"> Foreigner
  </div>
</div>
</div>
<div class="row">
 <div class="col-md-12">
  <div class="form-group">
    <label for="">Remarks: </label>
    <textarea class="form-control" name="distance3" rows="2" autocomplete="off"></textarea>
  </div>
</div>
</div>

<!-- Trekking Equipments -->
<div class="row">
  <div class="col-md-12">
    <h5>Trekking Equipments</h5>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="">Sleeping tents <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1"> Yes
      <input type="radio" name="radio1"> No
    </div>
  </div>
  <div class="col-md-5 offset-md-2">
    <div class="form-group">
      <label for="">Dining tents <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1" required> Yes          
      <input type="radio" name="radio1" required> No
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="">Toilet tents <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1" required> Yes
      <input type="radio" name="radio1" required> No
    </div>
  </div>
  <div class="col-md-5 offset-md-2">
    <div class="form-group">
      <label for="">Trekking Chairs & Tables <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1" required> Yes
      <input type="radio" name="radio1" required> No
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="">Kitchen Equipments <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1" required> Yes
      <input type="radio" name="radio1" required> No
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="">Remarks: </label>
      <textarea class="form-control" name="distance3" rows="2" autocomplete="off"></textarea>
    </div>
  </div>
</div>

<!-- Transportation -->
<div class="row">
  <div class="col-md-12">
    <h5>Transportation</h5>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="">Coaster Bus <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1"> Yes
      <input type="radio" name="radio1"> No
      <input type="radio" name="radio1"> Valid Fitness
      <input type="radio" name="radio1"> Invalid Fitness
    </div>
  </div>
  <div class="col-md-5 offset-md-2">
    <div class="form-group">
      <label for="">Hiace/Mini Bus <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1"> Yes          
      <input type="radio" name="radio1"> No
      <input type="radio" name="radio1"> Valid Fitness
      <input type="radio" name="radio1"> Invalid Fitness
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="">SUVs <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1"> Yes          
      <input type="radio" name="radio1"> No
      <input type="radio" name="radio1"> Valid Fitness
      <input type="radio" name="radio1"> Invalid Fitness
    </div>
  </div>
  <div class="col-md-5 offset-md-2">
    <div class="form-group">
      <label for="">Cars <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1"> Yes          
      <input type="radio" name="radio1"> No
      <input type="radio" name="radio1"> Valid Fitness
      <input type="radio" name="radio1"> Invalid Fitness
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="">Office Pool Vehicle <span class="text-danger">*</span> </label>
      <input type="radio" name="radio1"> Yes
      <input type="radio" name="radio1"> No
      <input type="radio" name="radio1"> Valid Fitness
      <input type="radio" name="radio1"> Invalid Fitness
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="">Remarks: </label>
      <textarea class="form-control" name="distance3" rows="2" autocomplete="off"></textarea>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <p><span>Please attach additional sheets where necessary like pictures of the office, and office sign board.</span></p>
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

</div> <!-- card body ends -->

<div class="card-footer text-center">
  <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
  <button type="reset"class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
</div>
</form>
</div>

@endsection