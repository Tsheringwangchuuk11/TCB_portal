var ydf = function(){

    function calculateColumnTotal(tableId, currentValue) {
        var sum = 0;
        $('#'+ tableId +' tbody > tr > td input.column-control').each(function(index){
            if(!isNaN($(this).val()) && $(this).val() !=0 ) {
                sum += parseFloat(this.value);
            }
        });
        if (currentValue != undefined) {
            sum += parseFloat(currentValue);
        }
        $('.gross-total-column,.net-payable').val(sum.toFixed(2));
    }

    function calculateRowQuantityCostTotal(tableId, curRow){
        var total = 0;
        var cost = parseFloat(curRow.find('.item-cost').val());
        var quantity = parseInt(curRow.find('.item-quantity').val());
        var discountCost = parseFloat(curRow.find('.cost-after-discount').val()); // 0
        if(!isNaN(discountCost) && discountCost != 0){
            total = parseFloat((quantity * discountCost));
        } else {
            total = parseFloat(quantity * cost);
        }
        if(!isNaN(total)){
            curRow.find('.total-for-item').val(total.toFixed(2));
        } else {
            curRow.find('.total-for-item').val(0.00);
        }
    }

    function randomKey() {
        var key = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 5; i++) {
            key += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return key;
    };
    function addNewRow(tableId) {
        $('.dateofbirth, .yearonly').datepicker("destroy").removeClass("hasDatepicker").removeAttr('id');
        $(".datepicker").datepicker("destroy").removeClass("hasDatepicker").removeAttr('id');;
        $(".datepickerfrom").datepicker("destroy").removeClass("hasDatepicker").removeAttr('id');
        $(".datepickerto").datepicker("destroy").removeClass("hasDatepicker").removeAttr('id');
        $(".timepicker").datepicker("destroy").removeClass("hasDatepicker").removeAttr('id');
        var lastRow = $('#'+ tableId +' tr:not(.notremovefornew):last');
        $(".select2-ddl").select2("destroy");
        var row = lastRow.clone();
        row.find('span.help-block').remove();
        row.find('input,select').removeClass('error');
        row.insertAfter(lastRow);
        $('.yearonly').datepicker({
            autoclose:true,
            format:'yyyy',
            startView: "years",
            minViewMode: "years",
            orientation: 'bottom'
        });
        $('.dateofbirth').datepicker({
            autoclose:true,
            format: "dd-mm-yyyy",
            startView: 2,
            minViewMode: "days",
            orientation: 'bottom'
        });
        $('.datepicker').datepicker({
            autoclose:true,
            format:'dd-mm-yyyy',
            orientation: 'bottom'
        });
        $('.timepicker').datepicker({
            autoclose:true,
            pickDate: false,
            format: 'hh:mm:ss',
            pick12HourFormat: true,
            orientation: 'bottom'
        });

        var fromDate = $('.datepickerfrom').datepicker({
            format:'dd-mm-yyyy',
            autoclose: true,
            orientation: 'bottom'
        }).on('changeDate', function (ev) {
            if (toDate.datepicker("getDate") != null) {
                if (ev.date.valueOf() > toDate.datepicker("getDate").valueOf()) {
                    var newDate = new Date(ev.date);
                    newDate.setDate(newDate.getDate());
                    toDate.datepicker("update", newDate);
                }
            } else {
                var newDate = new Date(ev.date);
                newDate.setDate(newDate.getDate());
                toDate.datepicker("update", newDate);
            }
            $('.datepickerto')[0].focus();
        });

        var toDate = $('.datepickerto').datepicker({
            beforeShowDay: function (date) {
                if (fromDate.datepicker("getDate") != null){
                    if (!fromDate.datepicker("getDate").valueOf()) {
                        return date.valueOf() >= new Date().valueOf();
                    } else {
                        return date.valueOf() >= fromDate.datepicker("getDate").valueOf();
                    }
                }
            },
            format:'dd-mm-yyyy',
            autoclose: true,
            orientation: 'bottom'
        }).on('changeDate', function (ev) {});

        var key = randomKey();
        row.find('td').each(function () {
            var $this = $(this);
            $this.find('.resetKeyForNew').each(function (index, item) {
                var aa = $(item).attr('name');
                if(aa) {
                    var startIndexOfKey = aa.indexOf('[');
                    var lastKey = aa.substring(startIndexOfKey+1);
                    lastKey=lastKey.substring(0,lastKey.indexOf(']'));
                    $(item).attr('name', aa.replace(lastKey,key));
                }
            });
            var vClear = $this.find('input:not(.notclearfornew)');
            if (vClear) vClear.val('');vClear.attr("placeholder","");
            var vSelect = $this.find('select:not(.notclearfornew)');
            if (vSelect) vSelect.val('');
            var vCheck = $this.find('input[type="checkbox"]');
            if (vCheck) vCheck.removeAttr('checked');
            var vTextAreaClear = $this.find('textarea');
            var vAClear = $this.find('a.url');
            if (vAClear) vAClear.val('');vAClear.removeAttr("href");
            if (vTextAreaClear) vTextAreaClear.val('');vTextAreaClear.attr("placeholder");
            vCheck.parents('span').removeClass('checked');
            $this.find('div.add-row-input-group-ddl').removeClass('show').addClass('hide');
            $this.find('div.add-row-input-group-txt').removeClass('hide').addClass('show');


            //remove disabled for credit and debiot amount
            $this.find('input.debit-amount, input.credit-amount').attr('readonly', false);
        });
        $(".select2-ddl").select2({
            alowClear:true
        });
        $('#' + tableId + ' tr:last td:first' + ' .rowIndex').attr("value", key);
        return key;
    };
    function initialize(){
        $('.select2').select2();
        $('.select2-ddl').select2();
        $('.datepicker').datepicker({
            autoclose:true,
            format:'dd-mm-yyyy',
            pick12HourFormat: true,
            orientation: 'bottom'
        });

        var fromDate = $('.datepickerfrom').datepicker({
            format:'dd-mm-yyyy',
            autoclose: true,
            orientation: 'bottom'
        }).on('changeDate', function (ev) {
            if (toDate.datepicker("getDate") != null) {
                if (ev.date.valueOf() > toDate.datepicker("getDate").valueOf()) {
                    var newDate = new Date(ev.date);
                    newDate.setDate(newDate.getDate());
                    toDate.datepicker("update", newDate);
                }
            } else {
                var newDate = new Date(ev.date);
                newDate.setDate(newDate.getDate());
                toDate.datepicker("update", newDate);
            }
            $('.datepickerto')[0].focus();
        });

        var toDate = $('.datepickerto').datepicker({
            beforeShowDay: function (date) {
                if (fromDate.datepicker("getDate") != null){
                    if (!fromDate.datepicker("getDate").valueOf()) {
                        return date.valueOf() >= new Date().valueOf();
                    } else {
                        return date.valueOf() >= fromDate.datepicker("getDate").valueOf();
                    }
                }
            },
            format:'dd-mm-yyyy',
            autoclose: true,
            orientation: 'bottom'
        }).on('changeDate', function (ev) {});

        $('.yearonly').datepicker({
            autoclose:true,
            format:'yyyy',
            startView: "years",
            minViewMode: "years",
            orientation: 'bottom'
        });

        $('.dateofbirth').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            startView: 2,
            minViewMode: "days",
            orientation: 'bottom'
        });

        //timepicker
        $('.timepicker').datetimepicker({
            showClose: true,
            format: 'LT'
        });

        //datetimepicker
        $('.datetimepicker').datetimepicker({
            showClose: true,
            widgetPositioning:{
                horizontal: 'auto',
                vertical: 'bottom'
            }
        });

        //datetimepickerfrom & datetimepickerto
        $('.datetimepickerfrom').datetimepicker({
            showClose: true,
            format: "DD-MM-YYYY hh:mm A",
            widgetPositioning:{
                horizontal: 'auto',
                vertical: 'bottom'
            }
        });

        $('.datetimepickerto').datetimepicker({
            useCurrent: false,
            showClose: true,
            format: "DD-MM-YYYY hh:mm A",
            widgetPositioning:{
                horizontal: 'auto',
                vertical: 'bottom'
            }
        });

        $(".datetimepickerfrom").on("dp.change", function (e) {
            $('.datetimepickerto').data("DateTimePicker").minDate(e.date);
        });

        $(".datetimepickerto").on("dp.change", function (e) {
            $('.datetimepickerfrom').data("DateTimePicker").maxDate(e.date);
        });

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass   : 'iradio_flat-red'
        });

        $(document).on('click','.add-table-row',function (e){
            e.preventDefault();
            var table = $(this).closest('table').attr('id');
            addNewRow(table);
        });
        $(document).on('click','.delete-table-row',function(e){
            e.preventDefault();
            var thisRow = $(this);
            var table = thisRow.closest('table').attr('id');
            var rowCount = $('#'+table+' >tbody >tr').length;
            for(var i = 0; i <= rowCount; i++){
                if(rowCount == 2){
                    $('#alertMessage').find('p.alert-message').html("You cannot delete all the rows.");
                    $('#alertMessage').modal('show');
                    return false;
                } else {
                    thisRow.closest('tr').remove();
                }
            }
        });
        $('.formConfirm').on('click', function(e) {
            e.preventDefault();
            var el = $(this).next();
            var title = el.attr('data-title');
            var msg = el.attr('data-message');
            var dataForm = el.attr('data-form');

            $('#formConfirm')
            .find('#frm_body').html(msg)
            .end().find('#frm_title').html(title)
            .end().modal('show');

            $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
        });

        $('#formConfirm').on('click', '#frm_submit', function(e) {
            $(this).parent().find('div#post-loading-container').removeClass('hide');
            var id = $(this).attr('data-form');
            $(this).attr('disabled', true);
            $(id).submit();
        });

        $(document).on('keyup', 'input[type="text"].numeric-only', function(){
			if($(this).val() != ""){
				if(isNaN($(this).val()) || $(this).val() < 0) {
                    $('#alertMessage').find('p.alert-message').html("Invalid input. Only numbers are accepted.");
                    $('#alertMessage').modal('show');
                    $(this).val(0);
                    return false;
				}
			}
        });

        $(document).on('keyup', '.item-cost, .item-quantity', function(){
            var tableId = $(this).closest('table').attr('id');
            var curRow = $(this).closest('tr');
            calculateRowQuantityCostTotal(tableId, curRow);
            calculateColumnTotal(tableId);
        });
    }
    return{
        RandomKey:randomKey,
        AddNewRow:addNewRow,
        CalculateColumnTotal: calculateColumnTotal,
        CalculateRowQuantityCostTotal:calculateRowQuantityCostTotal,
        Initialize:initialize
    }
}();
$(document).ready(function(){
    ydf.Initialize();
});
