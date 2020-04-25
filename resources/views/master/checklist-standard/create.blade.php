@extends('layouts.manager')
@section('page-title', 'Create Checklist Stanadard')
@section('content')
<form action="{{ url('master/checklist-standards') }}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Checklist Standard</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="" >Checklist Area *</label>
                        <select name="checklist_area" class="form-control required select2bs4" id="checklistArea">
                            <option value="">---SELECT---</option>
                            @foreach ($checklistAreas as $checklistArea)
                            <option value="{{ $checklistArea->id }}" {{ old('checklist_area') == $checklistArea->id ? 'selected' : '' }}>{{ $checklistArea->checklist_area }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Checklist Standard Name*</label>
                        <input type="text" id= "checklist_standard_name" name="checklist_standard_name" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="">Checklist Point</label>
                        <input type="text" id= "checklist_point" name="checklist_point" class="form-control numeric-only">
                    </div>
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
                                        <select name="checklist[AAAAA][star_category]" id="star" class="form-control resetKeyForNew required select star">
                                            <option value="">Select Star Category</option>
                                            @foreach ($starCategories as $starCategory)
                                                <option value="{{ $starCategory->id }}" data-id={{ $starCategory->id }} data-name="{{ $starCategory->star_category_name }}">{{ $starCategory->star_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="checklist[AAAAA][basic_standard]" class="form-control resetKeyForNew select required">
                                            <option value="">Select Basic Standard</option>
                                            @foreach ($basicStandards as $basicStandard)
                                                <option value="{{ $basicStandard->id }}" data-id={{ $basicStandard->id }} data-name="{{ $basicStandard->standard_code }}">{{ $basicStandard->standard_code }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" name="checklist[AAAAA][mandatory]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="1"/>
                                            <input type="hidden" name="checklist[AAAAA][mandatory]" class="check-perm resetKeyForNew ace ace-checkbox-2" value="0"/>
                                            <span class="lbl"></span>
                                        </label>
                                    </td>
                                    <td width="20%">
                                        <select  name="checklist[AAAAA][status]" class="form-control resetKeyForNew select">
                                            <option value="">-Select-</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
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
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success margin-r-5 btn-flat btn-sm"><i class="fas fa-check"></i> CREATE CHECKLIST STANDARD</button>
                    <a href="{{ url('master/checklist-standards') }}" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-undo"></i> CANCEL</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/checklist.js') }}"></script>
@endsection