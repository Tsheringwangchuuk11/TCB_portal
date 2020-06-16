@extends('layouts.manager')
@section('page-title', 'Create Menus and Sub Menu')
@section('content')         
<form action="{{ url('system/modules') }}" method="POST">
    @csrf    
    <div class="col-md-12">        
        <div class="card card-secondary">  
            <div class="card-header">
                <h3 class="card-title">Add Menu</h3>
            </div>          
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">                                                
                        <div class="form-group">
                            <label for="">Select Menu/Service *</label>
                            <select name="module_display" class="form-control select2bs4 required service-module" style="width: 100%;">
                                <option value="">--SELECT---</option>
                                @foreach (config()->get('settings.module_display_type') as $k => $v)
                                <option value="{{$k}}" {{ old('module_display_type') == $k ? 'selected' : '' }}>{{$v}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2 service hide">
                        <div class="form-group">
                            <label for="">Select Services *</label>
                            <select name="service_id" class="form-control select2bs4 service" style="width: 100%;">
                                <option value="">---SELECT---</option>
                                @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{ old('service') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-5 offset-md-2 module hide">
                        <div class="form-group">
                            <label for="">Main Menu Name *</label>
                            <input type="text" name="main_module_name" class="form-control name" value="{{ old('main_module_name') }}" />
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-md-5 module hide">
                        <div class="form-group">
                            <label for="">Menu Icon *</label>
                            <input type="text" name="module_icon" class="form-control icon" value="{{ old('module_icon') }}" placeholder="example: fa-check"/>
                        </div>
                    </div> 
                    <div class="col-md-5 offset-md-2 module hide">
                        <div class="form-group">
                            <label for="">Display Order *</label>
                            <input type="text" name="module_display_order" class="form-control number display" value="{{ old('module_display_order') }}" />
                        </div>
                    </div>  
                </div>                                                        
            </div>
        </div>
    </div>
    <div class="col-md-12">        
        <div class="card card-secondary">  
            <div class="card-header">
                <h3 class="card-title">Add Sub Menu</h3>
            </div>           
            <div class="card-body">                                                   
                <div class="box-body no-padding">
                    <table id="sub-module" class="table table-condensed table-striped">
                        <thead>
                            <th class="text-center">#</th>
                            <th>Sub Menu Name *</th>
                            <th>Route *</th>
                            <th>Order *</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <a href="#" class="delete-table-row btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                </td>
                                <td>
                                    <input type="text" name="submodules[AAAAA][sub_module_name]" class="required form-control resetKeyForNew" />
                                </td>
                                <td>
                                    <input type="text" name="submodules[AAAAA][route]" class="required form-control resetKeyForNew" />
                                </td>
                                <td width="20%">
                                    <input type="text" name="submodules[AAAAA][display_order]" class="required form-control number resetKeyForNew" />
                                </td>
                            </tr>
                            <tr class="notremovefornew">
                                <td colspan="3s"></td>
                                <td class="text-center">
                                    <a href="#" class="add-table-row btn bg-purple btn-sm"><i class="fa fa-plus"></i> Add New Row</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success btn-flat btn-sm"><i class="fas fa-check"></i> CREATE MENU</button>
                    <a href="{{ url('system/modules') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-undo"></i> CANCEL</a>
                </div>
            </div>
        </div>            
    </div>
</form>
@endsection
@section('scripts')
<script>
$(document).ready(function () {
    $('select.service-module').on('change', function(e){
        var status = $(this).children("option:selected").val();

        if (status != null ) {
            if(status == 'service'){
                $('div.service').addClass('show').removeClass('hide');
                $('div.module').addClass('hide').removeClass('show');
                $('div.module').find('input.name').removeClass('required');
                $('div.module').find('input.icon').removeClass('required');
                $('div.module').find('input.display').removeClass('required');
                // $('div.service').find('select.service').addClass('required');
            }else{
                $('div.module').addClass('show').removeClass('hide');
                $('div.service').addClass('hide').removeClass('show');
                // $('div.module').find('input.name').addClass('required');
                // $('div.module').find('input.icon').addClass('required');
                // $('div.module').find('input.display').addClass('required');
                $('div.service').find('select.service').removeClass('required');
            }
        }else{
            $('div.module').addClass('hde').removeClass('show');
            $('div.service').addClass('hide').removeClass('show');
            $('div.module').find('input.name').removeClass('required');
            $('div.module').find('input.icon').removeClass('required');
            $('div.module').find('input.display').removeClass('required');
            $('div.service').find('select.service').removeClass('required');
        }
    });
});
</script>
@endsection