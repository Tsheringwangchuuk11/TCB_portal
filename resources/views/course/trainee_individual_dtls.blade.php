<form id="registration_form" action="{{ url('course/update_status') }}" class="form-horizontal" method="POST">
    @csrf
    <input type="hidden" class="form-control" name="course_dtl_id" value="{{$submittedTraineeLists->course_dtl_id}}">
    <input type="hidden" class="form-control" name="application_no" value="{{$submittedTraineeLists->application_no}}">
    <div class="modal-header">
        <h4 class="modal-title">Applicant Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
        <div class="row"> 
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">CID<span class="text-danger "> *</span></label>
                    <input type="text" id="applicant_cid_no" name="applicant_cid_no" class="form-control" value="{{$submittedTraineeLists->applicant_cid_no}}" readonly>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Name<span class="text-danger "> *</span></label>
                    <input type="text" id= "applicant_name" name="applicant_name" class="form-control"  value="{{$submittedTraineeLists->applicant_name}}" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">DOB<span class="text-danger "> *</span></label>
                    <input type="date" id= "applicant_dob" name="applicant_dob" class="form-control"  value="{{$submittedTraineeLists->applicant_dob}}" readonly>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Contact No.<span class="text-danger "> *</span></label>
                    <input type="text" id= "applicant_contact_no" name="applicant_contact_no" class="form-control"  value="{{$submittedTraineeLists->applicant_contact_no}}" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Email<span class="text-danger "> *</span></label>
                    <input type="email" id= "applicant_email" name="applicant_email" class="form-control"  value="{{$submittedTraineeLists->applicant_email}}" readonly>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                <label for="">Gender<span class="text-danger "> *</span></label>
                @if ($submittedTraineeLists->applicant_gender=='M')
                    <input type="text" id= "applicant_gender" name="applicant_gender" class="form-control"  value="Male" readonly>
                @else
                    <input type="text" id= "applicant_gender" name="applicant_gender" class="form-control"  value="Female" readonly>
                @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                <input type="text" id= "dzongkhag_name" name="dzongkhag_name" class="form-control"  value="{{$submittedTraineeLists->dzongkhag_name}}" readonly>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <input type="text" id= "gewog_name" name="gewog_name" class="form-control"  value="{{$submittedTraineeLists->gewog_name}}" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <input type="text" id= "village_name" name="village_name" class="form-control"  value="{{$submittedTraineeLists->village_name}}" readonly>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Present working Address</label>
                    <textarea class="form-control" name="present_working_address" readonly>{{$submittedTraineeLists->present_working_address}}</textarea>
                </div>
            </div>
        </div>
        @if ($submittedTraineeLists->status==1)
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                <label for="">Status<span class="text-danger"> *</span></label>
                <select  name="status" id="status" class="form-control select2bs4" style="width: 100%;">
                    <option value=""> -Select-</option>
                    @foreach ($course_status_type as $course_status_type)
                        <option value="{{ $course_status_type->id }}" {{ old('dzongkhag_id', $course_status_type->id) == $submittedTraineeLists->status ? 'selected' : '' }}>{{ $course_status_type->course_status_name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endif
        <h6> <strong>Supporting Documents:</strong></h6><hr>
        <div class="row"> 
            <div class="col-md-8">
                @if (isset($documents)) 
                    @foreach($documents as $documnent)
                    <div>
                        <a href="{{ URL::to($documnent->upload_url) }}" target="_blank"> {{ $documnent->document_name }}&nbsp; <i class="fa fa-download"></i> </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="modal-footer">
        @if ($submittedTraineeLists->status==1)
            <button type="submit" class="btn btn-success btn-flat margin-r-5">Update</button>
        @endif
        <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
    </div>
</form>