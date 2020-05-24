<div class="row">
    <div class="col-md-2">
    <div class="form-group">
        <span class="btn btn-success fileinput-button btn-sm">
            <i class="fas fa-plus fa-sm"></i>
            <span>Add files...</span>
            <!-- The file input field used as target for the file upload widget -->
            <input id="fileuploaded" type="file" name="filename" multiple> 
        </span>
    </div>
    </div>
    <div class="col-md-8">
        <div class="col-md-10" id="files">
        </div>
        <div class="form-group progress"  id="progress">
            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
              <span class="sr-only">40% Complete (success)</span>
          </div>
        </div>
    </div>
</div>
