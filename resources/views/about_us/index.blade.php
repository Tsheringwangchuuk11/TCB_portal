@extends('layouts.manager')
@section('page-title', 'About us')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">About Us Content</h3>
            </div>
            <div class="card-body pad">
                <form method="post" action="{{ url('system/about-us-content') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <textarea name="content" class="textarea form-control" placeholder="Place some text here"
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> </textarea>
                    </div>
                    <input type="hidden" name="recordId" @if(isset($content->id)) value="{{$content->id}}" @endif>
                    <button type="submit" class="btn btn-success btn-sm text-center">Save</button>
                </form>
            </div>
          </div>
         </div>
     </div>
</section>
@endsection
@section('scripts')
    <script>
        
        $(document).ready(function(){
            @if(isset($content->content))
                var content=@json($content->content);
                $('.textarea').summernote('code',content);
            @endif
        });
        var $summernote= $('.textarea').summernote({
            callbacks: {
                onImageUpload: function (files) {
                    uploadFile($summernote, files[0]);
                },
                onMediaDelete: function (target) {
                removeFile(target);
                }
            }
        })
            //upload image 
        function uploadFile($summernote, file) {
            var fd = new FormData();
            fd.append("file", file);
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                url:"/system/image_upload",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {
                    $summernote.summernote('insertImage', data,'img');
                }
            });
        }
        //Delete image
        function removeFile(target){
            var imgsrc = target[0].currentSrc;
            $.ajax({
                    url  : '/system/delete_upload_image',
                    type : "POST",
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {imgSrc:imgsrc},                      
                    success: function(data) {
                        console.log(data);                  
                }
            });
        }

    </script>
@endsection
