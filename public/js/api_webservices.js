//pull DCRC data
function api_webservices(cid_no) {
    alert(cid_no);
    $("#loading").show();
    $.ajax({
        type: "GET",
        url: "/api/get_citizen_details",
        data: {cid_no: cid_no},
        dataType: "json",
        success: function (data) {
            console.log(data);
            //alert(JSON.stringify(data));
            if (data) {
                $app_name = "";// get Full Name
                if (data.firstName) {
                    $app_name = data.firstName;
                }
                if (data.middleName) {
                    $app_nam += ' ' + data.middleName;
                }
                if (data.lastName) {
                    $app_name += ' ' + data.lastName;
                }
                $("#app_name").val($app_name);

                //date of birth
                $("#dob").val(data.dob);
                //permanent village
                $("#permanent_village_id").val(data.permanentVillageserialno);
                //gender
                if (data.gender == 'M') {
                    $("#M").prop("checked", true);
                } else {
                    $("#F").prop("checked", true);
                }
                //mobile no
                $("#contact_number").val(data.mobileNumber);
                //dzongkhag
                $("#dzongkhag_id").val(data.dzongkhagSerialno);
                $("#dzongkhag_name").val(data.dzongkhagName);
                //gewog
                $("#gewog_id").val(data.gewogSerialno);
                $("#gewog_name").val(data.gewogName);
                //village
                $("#village_id").val(data.permanentVillageserialno);
                $("#village_name").val(data.permanentVillagename);

                //clear message
                $("#webserviceError").html('');

            } else {
                $("#cid_no").val('');
                $("#app_name").val('');
                $("#dob").val('');
                $("#permanent_village_id").val('');
                $("#M").prop("checked", false);
                $("#F").prop("checked", false);
                $("#contact_number").val('');
                $("#dzongkhag_id").val('');
                $("#dzongkhag_name").val('');
                $("#gewog_id").val('');
                $("#gewog_name").val('');
                $("#village_id").val('');
                $("#village_name").val('');

                $("#webserviceError").html('CID No ' + cid_no + ' is invalid, Please enter correct CID No!');
            }
            $("#loading").hide();
        },
    })
}
// end DCRC
