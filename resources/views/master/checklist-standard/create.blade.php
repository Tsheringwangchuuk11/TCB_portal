@extends('layouts.manager')
@section('page-title', 'Create Checklist Stanadard')
@section('content')
<form action="{{ url('master/checklist-standards') }}" method="POST" enctype="multipart/form-data">
@csrf    
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Checklist Standard</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" >Module *</label>
                            <select name="" class="form-control required select2bs4 module" id="module">
                                <option value="">---SELECT---</option>
                                @foreach ($serviceModules as $serviceModule)
                                <option value="{{ $serviceModule->id }}" {{ old('service_module') == $serviceModule->id ? 'selected' : '' }}>{{ $serviceModule->module_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" >Checklist Chapter *</label>
                            <select name="" class="form-control checklist required select2bs4" id="checklist" disabled>
                                <option value="">---SELECT MODULE FIRST---</option>						
                            </select>                               
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">                   
                        <div class="form-group">
                            <label for="" >Checklist Area *</label>
                            <select name="checklist_area" class="form-control required checklistArea select2bs4" id="checklistArea" disabled>
                                <option value="">---SELECT CHAPTER FIRST---</option>	                         
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Checklist Standard Name*</label>
                            <textarea name="checklist_standard_name" rows="3" class="form-control required"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Checklist Point</label>
                            <input type="text" id= "checklist_point" name="checklist_point" class="form-control numeric-only">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Status</label><br>
                            <label>
                                <input type="radio" id="status1" name="status" value="yes" class="flat-red" {{ old('status') == null || old('status') == 'yes' ? 'checked' : '' }}/>
                                Yes
                            </label>
                            <label>
                                <input type="radio" id="status2" name="status" value="no" class="flat-red" {{ old('status') == 'no' ? 'checked' : '' }} />
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body no-padding">
                            <strong class="font-weight-bold">Standard Mapping</strong>
                            <table id="sub-module" class="table table-condensed table-striped">
                                <thead>
                                    <th class="text-center">#</th>
                                    <th>Star Category *</th>
                                    <th>Basic Standard *</th>
                                    <th>Mandatory</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <a href="#" class="delete-table-row btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td>
                                            <select name="checklist[AAAAA][star_category]" id="star" class="form-control resetKeyForNew select star" disabled>
                                                <option value="">Select Star Category</option>
                                                @foreach ($starCategories as $starCategory)
                                                    <option value="{{ $starCategory->id }}" data-id={{ $starCategory->id }} data-name="{{ $starCategory->star_category_name }}">{{ $starCategory->star_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="checklist[AAAAA][basic_standard]" class="form-control resetKeyForNew select basic">
                                                <option value="">Select Basic Standard</option>
                                                @foreach ($basicStandards as $basicStandard)
                                                    <option value="{{ $basicStandard->id }}" data-id={{ $basicStandard->id }} data-name="{{ $basicStandard->standard_code }}">{{ $basicStandard->standard_code }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <select  name="checklist[AAAAA][mandatory]" class="form-control resetKeyForNew select mandatory">
                                                <option value="">-Select-</option>
                                                @foreach (Config::get('settings.status') as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td width="20%">
                                            <select  name="checklist[AAAAA][status]" class="form-control resetKeyForNew select status">
                                                <option value="">-Select-</option>
                                                @foreach (Config::get('settings.status') as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="notremovefornew">
                                        <td colspan="4"></td>
                                        <td class="text-center">
                                            <a href="#" class="add-table-row btn bg-purple btn-sm"><i class="fa fa-plus"></i> Add New Row</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success margin-r-5 btn-flat btn-sm"><i class="fas fa-check"></i> CREATE CHECKLIST STANDARD</button>
                <a href="{{ url('master/checklist-standards') }}" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-undo"></i> CANCEL</a>
            </div>
        </div>
    </div>    
</form>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/checklist.js') }}"></script>
<script>
 $(document).ready(function () {

     //select a module and accordingly get the chapter associated with it using ajax request
        $('select.module').on('change', function(e){
            var selectedModule = $('option:selected', this).val();			
            
            //checking the star category			
            if (selectedModule.length > 0 && selectedModule == 1) 
            { 
                $('select.star').addClass('required');
                $('select.star').removeAttr('disabled', true);
                $('select.basic').removeAttr('disabled', true);                
                $('select.mandatory').removeAttr('disabled', true);                
                $('select.status').removeAttr('disabled', true); 
            }else{
                $('select.star').attr('disabled', true);
                $('select.star').removeClass('required');
            }

            //checking restuarant
            if(selectedModule.length > 0 && (selectedModule == 3 || selectedModule == 4 || selectedModule == 5 || selectedModule == 6 || selectedModule == 7 || selectedModule == 8 ))
            {
                $('select.star').attr('disabled', true);
                $('select.basic').attr('disabled', true);                
                $('select.mandatory').attr('disabled', true);                
                $('select.status').attr('disabled', true); 
            }

            //adding required class
            if (selectedModule.length > 0 && (selectedModule == 1 || selectedModule == 2)) 
            {                                           
               // $('select.basic').addClass('required');                
                $('select.mandatory').addClass('required');                
                $('select.status').addClass('required');                                
            }else{                
                $('select.basic').removeClass('required');
                $('select.mandatory').removeClass('required');
                $('select.status').removeClass('required');
            } 
            
			//check if module is selected or not
			if (selectedModule.length > 0) {
				$.ajax({
					type: 'GET',
					url:"{{ url('master/checklist-areas/module') }}",
					dataType: 'JSON',
					data: { moduleId: selectedModule },
				
					beforeSend: function(){
						$('#ajax-loading-container').removeClass('hide');
					},
					complete: function() {
						$('#ajax-loading-container').addClass('hide');
					},

					success: function(data) {											
						$('select.checklist').empty().removeAttr('disabled', false);
						$('select.checklist').append('<option value="">---SELECT ONE---</option>');
						for (i = 0; i < data.length; i++) {
							$('select.checklist').append('<option value="' + data[i].id + '" data-name="' + data[i].checklist_ch_name + '" >' + data[i].checklist_ch_name + '</option>');												
						}
					}
				});				
			} else {
				$('select.checklist').empty().attr('disabled', true);
				$('select.checklist').append('<option value="">---SELECT MODULE FIRST---</option>');
			}			 			
		});

    $('select.checklist').on('change', function(e){
    var selectedChecklist = $('option:selected', this).val();	      
    
     //check if checklist area is selected or not
     if (selectedChecklist.length > 0) {        
        $.ajax({
            type: 'GET',
            url:"{{ url('master/checklist-standards/chapter') }}",
            dataType: 'JSON',
            data: { checklistId: selectedChecklist },
        
            beforeSend: function(){
                $('#ajax-loading-container').removeClass('hide');
            },
            complete: function() {
                $('#ajax-loading-container').addClass('hide');
            },

            success: function(data) {	
                console.log(data);										
                $('select.checklistArea').empty().removeAttr('disabled', false);
                $('select.checklistArea').append('<option value="">---SELECT ONE---</option>');
                for (i = 0; i < data.length; i++) {
                    $('select.checklistArea').append('<option value="' + data[i].id + '" >' + data[i].checklist_area + '</option>');                                        
                }
            }
        });				
    } else {
        $('select.checklistArea').empty().attr('disabled', true);
        $('select.checklistArea').append('<option value="">---SELECT CHAPTER FIRST---</option>');
    }

    });		 			
});
</script>
@endsection
