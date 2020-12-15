@extends('layouts.enduser')
@section('page-title', 'Application')
@section('content')
<div class="row">
    <section class="col-lg-12 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    New Application
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tourism Services</label>
                                <select class="form-control select2bs4" name="modules" id="modules_id" style="width: 100%;" onchange="loadServices(this.value);">
                                  <option value="">- Select -</option>
                                  @foreach ($servicemodules as $servicemodule)
                                  <option value="{{$servicemodule->id}}">{{$servicemodule->module_name}}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="col-md-7 offset-md-1">
                            <div class="form-group">
                                <label for="">Services</label>
                                <span id="list_id"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
      </section>
    </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function () {
    var dropDown = document.getElementById("modules_id");
    dropDown.selectedIndex = 0;
  });
    function loadServices(id)
    {
      var modules_id=id;
      if(modules_id)
      {
        $.ajax({
          url: 'get-services',
          type: "GET",
          data : {moduleId : modules_id},
          dataType: "JSON",
          success:function(data1) {
            if(data1){
              $('#list_id').empty();
              $('#list_id').focus;
              var list = "<ul>";
              $.each(data1.data,function(index,row){
               var url = '{{ url("application/service-create", "page_link") }}';
               var page_link=""+index+"";
               page_link = page_link.replace(/\//g, "-");
               url = url.replace('page_link', page_link);
               list += "<li type='1'>&nbsp;<a href='"+url+"'>" + row + "</a></li>";
             });
              list += "</ul>";
              $("#list_id").html(list);
            }else{
              $('#list_id').empty();
            }
          }
        });
      }
      else
      {
        $("#list_id").empty();
      }
    }
  </script>
  @endsection
