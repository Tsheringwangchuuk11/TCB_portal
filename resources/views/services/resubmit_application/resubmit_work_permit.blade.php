@extends('layouts.enduser')
@section('page-title','Issuance Of Recommendation Letter For Work Permit')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Company Information</h4>
        </div>
        <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" >Recommendationn Letter Type<span class="text-danger"> *</span></label>
                                <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                                    <option value="">- Select -</option>
                                    @foreach ($workpermitTypes as $workpermitType)
                                    <option value="{{ $workpermitType->id }}" {{ old('application_type_id', $applicantInfo->application_type_id) == $workpermitType->id ? 'selected' : '' }}> {{ $workpermitType->dropdown_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="" >Application Number<span class="text-danger"> *</span></label>
                                <input type="hidden" class="form-control" name="dispatch_no" value="{{ old('dispatch_no',$applicantInfo->dispatch_no) }}">
                                <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                        <div class="form-group">
                            <label for="" >License No<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}" autocomplete="off">
                        </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="" >Comapany Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="company_name" value="{{ old('company_name',$applicantInfo->company_title_name) }}" autocomplete="off">
                            </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                        <div class="form-group">
                            <label for="" >Citizen ID<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no}}" autocomplete="off">
                        </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="" >Email<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="email" value="{{ $applicantInfo->email }}" autocomplete="off">
                            </div>
                    </div>
                    </div>
                    @if ($applicantInfo->application_type_id==38 || $applicantInfo->application_type_id==40)
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="" >Total workers<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="total_worker" value="{{ $applicantInfo->number }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-2">
                                <div class="form-group">
                                    <label for="" >Nationality<span class="text-danger"> *</span></label>
                                    <select  name="country_id" class="form-control select2bs4" style="width: 100%;">
                                        <option value=""> -Select-</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id', $applicantInfo->country_id) == $country->id ? 'selected' : '' }}> {{ $country->dropdown_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                            <div class="form-group">
                                <label for="" >From Date<span class="text-danger"> *</span></label>
                                <div class="input-group date" id="from_date" data-target-input="nearest">
                                    <input type="text" name="from_date" class="form-control datetimepicker-input" data-target="#from_date" value="{{ $applicantInfo->from_date}}">
                                    <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            <div class="col-md-5 offset-md-2">
                                <div class="form-group">
                                    <label for="" >To Date<span class="text-danger"> *</span></label>
                                    <div class="input-group date" id="to_date" data-target-input="nearest">
                                        <input type="text" name="to_date" class="form-control datetimepicker-input" data-target="#to_date" value="{{ $applicantInfo->to_date}}">
                                        <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div> 
                                </div>
                        </div>
                        </div>
                     @endif

        </div>
    </div>
    <div class="card">
    <div class="card-header">
        <h4 class="card-title">Company Location</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $applicantInfo->dzongkhag_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                        <option value="">{{ $applicantInfo->gewog_name }} </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value="{{ $applicantInfo->establishment_village_id }}">{{ $applicantInfo->village_name }} </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($applicantInfo->application_type_id==39 || $applicantInfo->application_type_id==41)
<div class="card">
    <div class="card-header">
        <h4 class="card-title"> Foreign worker Personal Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" >Passport No.<span class="text-danger"> *</span></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" >Name<span class="text-danger"> *</span></label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" >From Date<span class="text-danger"> *</span></label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" >To Date<span class="text-danger"> *</span></label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" >Nationality<span class="text-danger"> *</span></label>
                </div>
            </div>
        </div>
        <div class="parent_div" id="parent_div">
            @forelse ($workerdtls as $workerdtl)
                <div class="row worker" id="record{{ $loop->index }}">
                    <input type="hidden" class="form-control worker_record_id" name="worker_record_id[]" value="{{$workerdtl->id}}">
                    <div class="col-md-2">
                        <div class="form-group">
                        <input type="text" class="form-control" name="passport_no[]" value="{{ $workerdtl->passport_no }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name[]" value="{{ old('name',$workerdtl->name) }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                        <input type="date" name="start_date[]" class="form-control" value="{{ $workerdtl->start_date }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" name="end_date[]" class="form-control" value="{{ old('end_date',$workerdtl->end_date) }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select  name="nationality[]" class="form-control" style="width: 100%;">
                                <option value=""> -Select-</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ old('nationality', $workerdtl->nationality) == $country->id ? 'selected' : '' }}> {{ $country->dropdown_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @if($loop->index >=1)
                <span id="remove{{ $loop->index }}" class="btn-group" style=" margin-top:-50px; float:right">
                    <span id="remove" onclick="removeworker('{{ $workerdtl->id }}','{{ $loop->index }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span>
                </span>
                <div id="line{{ $loop->index }}"></div>
                @endif  
            @empty
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control" name="passport_no[]">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name[]" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="date" name="start_date[]" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="date" name="end_date[]" class="form-control" value="{{ old('end_date') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <select  name="nationality[]" class="form-control" style="width: 100%;">
                            <option value=""> -Select-</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->dropdown_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @endforelse
            <div id="adddiv"></div>
            <span class="btn bg-purple btn-sm float-right" onclick="addMoreWorker(this)"> <i class="fas fa-plus fa-sm"> Add New Row</i></span><br>
         </div>
    </div>
</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <ol>
                <li>
                    <em>
                        valid License copy
                    </em>
                </li>
                <li>
                    <em>
                        Tax Clearance
                    </em>
                </li>
                <li>
                    <em>
                        CV/Skills certificate                    
                    </em>
                </li>
            </ol>
            @include('services/fileupload/fileupload')
        </div>
        <!-- card body ends -->
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-ban"></i> RESET</button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#from_date').datetimepicker({
                format: 'MM/DD/YYYY',
            });
            $('#to_date').datetimepicker({
                format: 'MM/DD/YYYY',
            });
        });
        id=1;
                function addMoreWorker(this_id){
                    var parentdivId = $(this_id).parents("div.parent_div").attr('id');
                    curRow = $('#'+parentdivId).find('div.worker').attr('id');
                    $("#"+curRow).clone().attr('id', curRow+id).after("#id").appendTo("#adddiv").find("input[type='text'],select,input[type='date']").val("");
                    $addRow ='<span id="remove'+curRow+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
                    +'<span id="remove" onClick="removeForm('+id+',curRow)"' 
                    +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
                    +'<div id="line'+curRow+id+'"></div>';
                    $('#adddiv').append($addRow);
                    $('#'+curRow+id).find('input.worker_record_id').val(""); 
                    id++;
                }
                function removeForm(id,curRow){ 
                    if (confirm('Are you sure you want to delete this form?')){
                        $('#'+curRow+id).remove();
                        $('#remove'+curRow+id).remove();
                        $('#line'+curRow+id).remove();
                    }
                }

            function removeworker(roomId,rowId){
                if (confirm('Are you sure you want to delete this form?')){
                    $.ajax({
                        url:'/application/delete-data-record',
                        type:"GET",
                        data: {
                            recordId: roomId,
                            table_name: 't_foreign_worker_applications',
                        },
                    success: function (data) {
                        if(data =='1'){
                            $('#record'+rowId).remove();
                            $('#remove'+rowId).remove();
                            $('#line'+rowId).remove();
                        }else{
                            alert("Some thing went wrong");
                        }
                    }
                });
              }
            }
    </script>
@endsection




