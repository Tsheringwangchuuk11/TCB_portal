@extends('layouts.manager')
@section('page-title','Tourism Product Development')
@section('content')
<form action="{{ url('verification/tourism-product-development') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Basic Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Application No.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Events Title<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="title_name" value="{{ $applicantInfo->company_title_name }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Financial year<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="financial_year" value="{{ $applicantInfo->financial_year }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Location<span class="text-danger"> *</label>
                            <input type="text" class="form-control" name="location" value="{{ $applicantInfo->location }}" >
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Date<span class="text-danger"> *</span></label>
                        <input type="date" class="form-control" name="dates" value="{{ $applicantInfo->date }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Contact person (person who wrote or has the most knowledge about this application)</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name<span class="text-danger"> *</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $applicantInfo->applicant_name }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">CID<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}" >
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Contact No. <span class="text-danger"> *</span></label>
                        <input type="text" name="contact_no" class="form-control numeric-only" value="{{ $applicantInfo->contact_no }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email<span class="text-danger"> *</span></label>
                        <input type="email" class="form-control" name="email" value="{{ $applicantInfo->email }}" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Address<span class="text-danger"> *</span></label>
                        <input type="text" name="address" class="form-control" value="{{ $applicantInfo->address }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Organizer(Person with legal authority to sign a contract with the TCB)</h4>
        </div>
        <div class="card-body">
            <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Organizer Name<span class="text-danger"> *</span></label>                                        
                            <input type="text" class="form-control required" name="organizer_name" value="{{ $organizerInfo->organizer_name }}"> 
                        </div>
                    </div>
                    
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Address <span class="text-danger"> *</span></label>                                        
                        <input type="text" class="form-control required" name="organizer_address" value="{{ $organizerInfo->organizer_address }}"> 
                    </div>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Email<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="organizer_email" value="{{ $organizerInfo->organizer_email }}"> 
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Contact No.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="organizer_phone" value="{{ $organizerInfo->organizer_phone }}">
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Organizer<span class="text-danger"> *</label>
                                <select  name="organizer_type" class="form-control select2bs4">
                                   <option value="">-Select-</option>
                                    @foreach (config()->get('settings.organizerType') as $k => $v)
                                    <option value="{{ $k }}" {{ old('organizerType', $organizerInfo->organizer_type) == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Amount Requested:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control required" name="amount_requested" value="{{ $organizerInfo->amount_requested }}">
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Bhutan Coverage & Distribution Channel</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm" id="dataTable" indexId="index"> 
            <tbody>
                <tr>        
                    <th>Sl.No</th>
                    <th>Particulars/Items</th>
                    <th>Costs (Nu.)</th>
                </tr>
                @php
                    $total=0;
                @endphp
                @forelse ($itemsInfos as $itemsInfo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><input type="hidden" class="form-control" name="items_name[]" value="{{ $itemsInfo->items_name }}">{{ $itemsInfo->items_name }}</td>              
                    <td><input type="hidden" class="form-control" name="item_costs[]" value="{{ $itemsInfo->item_costs }}">{{ $itemsInfo->item_costs }}</td> 
                    @php
                    ($total +=$itemsInfo->item_costs);
                   @endphp              
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-dager text-center">No Data Availlable</td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="2">Total</td>
                    <td>{{number_format($total, 2)}}</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Document Attachment</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Title</label>
                </div>
                <div class="form-group col-md-6">
                    <label>Download Files</label>
                </div>
                @forelse ($documentInfos as $documentInfo)
                <div class="form-group col-md-6">
                    <span>{{ $documentInfo->document_name }}</span>
                </div>
                <div class="form-group col-md-6">
                <span><a href="{{ URL::to($documentInfo->upload_url) }}">{{ $documentInfo->document_name }}</a></span>
                </div>
                @empty
                <div class="form-group col-md-12">
                    <p>No data availlable</p>
                </div>
                @endforelse                
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Remarks <span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button name="status" value="APPROVED" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal"><li class="fas fa-times"></li> REJECT</button>
        </div>
    </div>
    <div class="modal fade" id="confirmModal">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Message</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>Are you sure,you want to reject &hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button name="status"value="REJECTED" class="btn btn-outline-light" data-dismiss="modal">Confirm</button>
            </div>
          </div>
        </div>
      </div>
</form>
@endsection
    @section('scripts')
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
            var counter = 2;
            $("#addrow").on("click", function () {
                var items = $("#items").val();
                var cost= $("#cost").val();
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td> '+counter+'</td>';
                cols += '<td><input type="text" class="form-control" name="items_name[]' + counter + '" value="'+ items +' "/></td>';
                cols += '<td><input type="text" class="form-control" name="item_costs[]' + counter + '" id="cost" value="'+ cost +' " readonly="true"></td>';
                cols += '<td><button type="button" class="btn btn-danger btn-xs tooltip-top" id="delete" title="Delete"><li class="fas fa-trash"> Delete</li></button></td>';
                newRow.append(cols);
                $("table.table-sm").append(newRow);
                counter++;
                $("#items").val('');
                $("#cost").val('');
            });
            $("table.table-sm").on("click", "#delete", function (event) {
                $(this).closest("tr").remove();       
                counter -= 1
            });
        });
  </script>
  @endsection





