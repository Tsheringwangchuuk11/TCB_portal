$(document).ready(function () {

    //displays the star cost of a star type according to its billing type
    var checklist;
    var currentRow;
    var starTypeIdArray = new Array(); //stores the star type id as an array
    $(document).on('change', 'select.star', function(e) {
        currentRow = $(this).closest('tr');
        checklist = $('option:selected', this).val();
        // starTypeIdArray = currentRow.val('null');
        if (checklist != '') {
            if(jQuery.inArray(checklist, starTypeIdArray ) < 0) {   // checks whether the array has the particular selected star array in it
                // alert(starTypeIdArray);
                starTypeIdArray.push(checklist);

            } else {
                $('#alertMessage').find('p.alert-message').html("The selected data is already in the list. Select other");
                $('#alertMessage').modal('show');
                currentRow.closest('tr').find('select.star').val('');
                return false;
            }
        }
    });
    // starTypeIdArray = currentRow.val('null');


});