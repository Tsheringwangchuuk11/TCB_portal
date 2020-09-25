<div class=" row alert alert-danger alert-dismissible" id="alertErrorId" style="display: none">
    <i class="fa fa-info-circle fa-lg"> </i>&nbsp;<strong><span id="msgId"></span></strong>
</div>
<div class="row">
    @if ($status==3)
        @if ($applicantInfo->service_id==1 )
            <div class="col-md-2" id="add_files">
                <div class="form-group">
                    <span class="btn bg-purple fileinput-button btn-sm">
                        <i class="fas fa-plus fa-sm"></i>
                        <span>Add files...</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileuploaded" type="file" name="filename" multiple> 
                    </span>
                </div>
            </div>
        @endif 
    @endif
    @if ($status==9 || $status==10 || $status==1)
        <div class="col-md-2" id="add_files">
            <div class="form-group">
                <span class="btn bg-purple fileinput-button btn-sm">
                    <i class="fas fa-plus fa-sm"></i>
                    <span>Add files...</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileuploaded" type="file" name="filename" multiple> 
                </span>
            </div>
        </div>
    @endif
    <div class="col-md-8">
    @if ($status==9 || $status==10)
        @if ($documentInfos->count() > 0)
            @foreach ($documentInfos as $documentInfo)
                <div class="col-md-10" id="{{$loop->iteration}}" >
                    <span><strong>{{ $documentInfo->document_name }} </strong> &nbsp;<a href="{{ url($documentInfo->upload_url) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-link"></i> View</a>  </span>&nbsp;
                    <button type="button" class ="btn btn-danger btn-sm" id="fileUploadId{{$loop->iteration}}" onclick ="deletefile(this.id,'{{ $documentInfo->id}}','{{ $documentInfo->upload_url}}');"><i class="fas fa-trash-alt fa-sm"></i> Delete</button>
                </div><br>
            @endforeach
        @endif
    @elseif($status==3)
        @if ($documentInfos->count() > 0)
            @foreach ($documentInfos as $documentInfo)
                <div class="col-md-10" id="{{$loop->iteration}}" >
                    <span><strong>{{ $documentInfo->document_name }} </strong> &nbsp;<a href="{{ url($documentInfo->upload_url) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-link"></i> View</a>  </span>&nbsp;
                </div><br>
            @endforeach
        @endif
    @endif
     <div class="col-md-10" id="files"></div>
     @if ($status==9 || $status==10 || $status==1)
        <div class="form-group progress"  id="progress">
            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">0% Complete (success)</span>
            </div>
        </div>
     @endif
     @if ($status==3)
        @if ($applicantInfo->service_id==1 )
        <div class="form-group progress"  id="progress">
            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">0% Complete (success)</span>
            </div>
        </div>
        @endif 
    @endif
    </div>
</div>



   
