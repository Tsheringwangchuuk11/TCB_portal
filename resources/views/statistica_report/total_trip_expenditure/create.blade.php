<form id="total_trip_exp_form" action="{{ url('statistical/store-total-trip-exp') }}" method="post"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="report_category_id"  value="{{ $report_category_id }}" class="form-control">
    <div class="row">
        <div class="form-group col-md-2">
            <label>Avg Expenditure Trip<span class="text-danger">*</span></label>
        </div>

        @if ( $report_category_id==3)
            <div class="form-group col-md-2">
                <label for="">Avg Expenditure Night<span class="text-danger">*</span> </label>
            </div>
        @endif

        <div class="form-group col-md-2">
            <label>Total Expenditure<span class="text-danger">*</span></label>
        </div>

        @if ( $report_category_id==1 || $report_category_id==3)
            <div class="form-group col-md-1">
                <label for="">Mean<span class="text-danger">*</span> </label>
            </div>
         @endif

         @if ($report_category_id==3)
            <div class="form-group col-md-1">
                <label for="">Median<span class="text-danger">*</span> </label>
            </div>
          @endif

        @if ( $report_category_id==1)
            <div class="form-group col-md-2">
                <label for="">Country<span class="text-danger">*</span> </label>
            </div>
        @endif
        @if ($report_category_id==3 ||  $report_category_id==4)
            <div class="form-group col-md-2">
                <label for="">Dzongkhag<span class="text-danger">*</span> </label>
            </div>
        @endif

        <div class="form-group col-md-1">
            <label for="">Year<span class="text-danger">*</span> </label>
        </div>
    </div>
    <div class="row" id="rowId">
        <div class="form-group col-md-2">
            <input type="text" class="form-control" name="avg_expenditure_trip[]">
        </div>
        @if ( $report_category_id==3)
            <div class="form-group col-md-2">
                <input type="text" class="form-control" name="avg_expenditure_night[]">
            </div>
        @endif
        <div class="form-group col-md-2">
            <input type="text" class="form-control" name="tot_expenditure[]">
        </div>
        @if ($report_category_id==1 || $report_category_id==3)
            <div class="form-group col-md-1">
                <input type="text" class="form-control" name="mean[]">
            </div>
        @endif

        @if ($report_category_id==3)
            <div class="form-group col-md-1">
                <input type="text" class="form-control" name="median[]">
            </div>
        @endif

         @if ( $report_category_id==1)
            <div class="form-group col-md-2">
                <select class="form-control" name="location_id[]">
                    <option value=""> - Select  - </option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->dropdown_name }}</option>
                            @endforeach
                </select>
            </div>
        @endif
         @if ($report_category_id==3 ||  $report_category_id==4)
            <div class="form-group col-md-2">
                <select class="form-control" name="location_id[]">
                    <option value=""> - Select  - </option>
                    @foreach ($dzongkhagLists as $dzongkhagList)
                    <option value="{{ $dzongkhagList->id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group col-md-1">
            <input type="text" name="year[]" class="form-control">
        </div>
    </div>
    <div id="adddiv"></div>
    <span class="btn bg-purple btn-sm float-right" id="add"><i class="fas fa-plus fa-xs"> Add New Row</i></span><br><br>
    <div class="modal-footer" style="margin-bottom:-14px;">
        <button type="submit" class="btn btn-success btn-flat margin-r-2  float-left">Save</button>
        <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
    </div>
</form>
<script>
     $(document).ready(function(){ 
        id=1;
        $("#add").click(function(){
            $("#rowId").clone().attr('id', 'rowId'+id).after("#id").appendTo("#adddiv").find("input[type='text'],select").val("");
            $addRow ='<span id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
            +'<span id="remove" onClick="removeForm('+id+')"' 
            +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
            +'<div id="line'+id+'"></div>';
            $('#adddiv').append($addRow);
            id++;
            });
        });

        function removeForm(id){ 
            if (confirm('Are you sure you want to delete this form?')){
                $('#rowId'+id).remove();
                $('#remove'+id).remove();
                $('#line'+id).remove();
            }
        }
        $.validator.addMethod("avg_expenditure_trip_validate", function (value, element) {
                 var flag = true;
                 $("[name^=avg_expenditure_trip]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Enter expenditure trip</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("value_validate", function (value, element) {
                 var flag = true;
                 $("[name^=value]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Enter value</div>')
                    }
                });
            return flag;
            }, "");

        $.validator.addMethod("location_id_validate", function (value, element) {
                 var flag = true;
                 $("[name^=location_id]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Select the location</div>')
                    }
                });
            return flag;
            }, "");

           

            $.validator.addMethod("year_validate", function (value, element) {
                 var flag = true;
                 $("[name^=year]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Enter year</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("tot_expenditure_validate", function (value, element) {
                 var flag = true;
                 $("[name^=tot_expenditure]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Enter total expenditure</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("median_validate", function (value, element) {
                 var flag = true;
                 $("[name^=median]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Enter median</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("mean_validate", function (value, element) {
                 var flag = true;
                 $("[name^=mean]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Enter mean</div>')
                    }
                });
            return flag;
            }, "");
            $.validator.addMethod("avg_expenditure_night_validate", function (value, element) {
                 var flag = true;
                 $("[name^=avg_expenditure_night]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Enter avg expenditure night</div>')
                    }
                });
            return flag;
            }, "");
            

        $('#total_trip_exp_form').validate({
            ignore: '',
            onkeyup: false,
            onclick: false,
           // onfocusout: false,
            rules: {
                "avg_expenditure_trip[]": {
                    avg_expenditure_trip_validate:true
                },
                "value[]": {
                    value_validate:true
                },

                "tot_expenditure[]": {
                    tot_expenditure_validate:true
                },

                "avg_expenditure_night[]": {
                    avg_expenditure_night_validate: {
                    depends: function (element) {
                        return ($("#report_category_id").val()==3) ? true : false;
                        }
                    },
                },

                "median[]": {
                    median_validate: {
                    depends: function (element) {
                        return ($("#report_category_id").val()==3) ? true : false;
                        }
                    },
                },

                "location_id[]": {
                    location_id_validate: {
                    depends: function (element) {
                        return ($("#report_category_id").val()==1 || $("#report_category_id").val()==3 || $("#report_category_id").val()==4) ? true : false;
                        }
                    },
                },
                "mean[]": {
                    mean_validate: {
                    depends: function (element) {
                        return ($("#report_category_id").val()==1 || $("#report_category_id").val()==3) ? true : false;
                        }
                    },
                },
                "year[]": {
                    year_validate:true
                }
            },
        });  
        $(document).keypress(function(event){ 
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault();
            }
        });
</script>

