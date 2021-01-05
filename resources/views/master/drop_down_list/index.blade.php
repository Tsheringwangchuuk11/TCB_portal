@extends('layouts.manager')
@section('page-title', 'Master')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dropdown Master</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Master Name</label>
                                <select class="form-control" name="master_name" id="master_name" style="width: 100%;" onchange="getmasterdropdownlist()">
                                    @foreach ($masterDropDownLists as $masterDropDownList)
                                    <option value="{{$masterDropDownList->id}}">{{$masterDropDownList->master_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display: none" id="product_types">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Product Types</label>
                                <select class="form-control select2bs4" name="dropdown_name" id="dropdown_name" style="width: 100%;">
                                    <option value=""> -Select-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display: none" id="keyhigh_lights">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Key highlights Types</label>
                                <select class="form-control select2bs4" name="highlight_type_id" id="highlight_type_id" style="width: 100%;">
                                    <option value=""> -Select-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="dataResult">
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        getmasterdropdownlist();
    })
    function getmasterdropdownlist() {
     var masterId=$("#master_name").val();
     if(masterId == 12){
        $('#dataResult').load('{{url("master/drop-down-master/")}}/'+masterId);
        $("#product_types").show();
        $("#keyhigh_lights").hide();
        if(masterId){
         $("#dropdown_name option:gt(0)").remove();	
         $.ajax({			   
            url:'/json-dropdown',
            type:"GET",
            data: {
               table_name: 't_dropdown_lists',
                       id: 'id',
                     name: 'dropdown_name',
                parent_id: masterId,
           parent_name_id: 'master_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
               $('select[name="dropdown_name"]').append('<option value="'+ key +'">'+ value +'</option>');
            });
            }
         });
      }else{
         $("#dropdown_name option:gt(0)").remove();	
      }	
     }
     else if(masterId == 19){
        $('#dataResult').load('{{url("master/drop-down-master/")}}/'+masterId);
        $("#keyhigh_lights").show();
        $("#product_types").hide();
        if(masterId){
         $("#highlight_type_id option:gt(0)").remove();	
         $.ajax({			   
            url:'/json-dropdown',
            type:"GET",
            data: {
               table_name: 't_dropdown_lists',
                       id: 'id',
                     name: 'dropdown_name',
                parent_id: masterId,
           parent_name_id: 'master_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
               $('select[name="highlight_type_id"]').append('<option value="'+ key +'">'+ value +'</option>');
            });
            }
         });
      }else{
         $("#highlight_type_id option:gt(0)").remove();	
      }	
     }
     else{
      $("#product_types").hide();
      $('#dataResult').load('{{url("master/drop-down-master/")}}/'+masterId);
     }
    }
    $('#dropdown_name').on('change',function(e) {
      var dropdownId= e.target.value;
      $('#dataResult').load('{{url("master/producttypes/")}}/'+dropdownId);
   });

   $('#highlight_type_id').on('change',function(e) {
      var highlight_type_id= e.target.value;
      $('#dataResult').load('{{url("master/highlight_types/")}}/'+highlight_type_id);
   });

</script>
@endsection
