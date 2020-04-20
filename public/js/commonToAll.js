var tcb = function(){
    function randomKey() {
        var key = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 5; i++) {
            key += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return key;
    };
    function addNewRow(tableId) {
        var lastRow = $('#'+ tableId +' tr:not(.notremovefornew):last');
        var row = lastRow.clone();
        row.find('span.help-block').remove();
        row.find('input,select').removeClass('error');
        row.insertAfter(lastRow);
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
        $('#' + tableId + ' tr:last td:first' + ' .rowIndex').attr("value", key);
        return key;
    };
    function initialize(){
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
    }
    return{
        RandomKey:randomKey,
        AddNewRow:addNewRow,
        Initialize:initialize
    };
    
}();
$(document).ready(function(){
    tcb.Initialize();
});
