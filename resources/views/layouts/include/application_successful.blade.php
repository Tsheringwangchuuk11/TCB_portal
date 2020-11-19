<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TCB | Received Application Successfully</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            font-family: 'Varela Round', sans-serif;
        }

        .modal-confirm {
            color: #636363;
            width: 325px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h5 {
            text-align: center;
            font-size: 18px;
            margin: 30px 0 -15px;
        }

        .modal-confirm h6 {
            text-align: center;
            font-size: 18px;
            margin: 30px 0 -15px;
            color: darkslategray
        }

        .modal-confirm .form-control, .modal-confirm .btn {
            min-height: 40px;
            border-radius: 3px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
        }

        .modal-confirm .icon-box {
            color: #fff;
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: -70px;
            width: 95px;
            height: 95px;
            border-radius: 50%;
            z-index: 9;
            background: #82ce34;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .modal-confirm .icon-box i {
            font-size: 58px;
            position: relative;
            top: 3px;
        }

        .modal-confirm.modal-dialog {
            margin-top: 150px;
        }

        .modal-confirm .btn {
            color: #fff;
            border-color: black;
            border-radius: 4px;
            background: #82ce34;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
        }

        .modal-confirm .btn:hover, .modal-confirm .btn:focus {
            background: #6fb32b;
            outline: none;
        }
    </style>
</head>
<body>
<div class="modal-dialog modal-confirm ">
    <div class="modal-content">
        <div class="modal-header">
            <div class="icon-box">
                <i class="material-icons">&#xE876;</i>
            </div>
            <h5 class="modal-title">Application Successful Submitted!</h5>
            <hr>
            <h6 class="modal-title">Your Application Number is:</h6>
            <div class="modal-title">
                <h6 id="application_number"><u><b>{{ $application_no }}</b></u></h6>
            </div>
        </div>
        <div class="modal-body">
            <p class="text-center">Now you can use the application number for tracking.</p>
        </div>
        <div class="modal-footer pt-2">
            <button class="btn btn-success btn-block" id="myTooltip" data-dismiss="modal"
                    onclick="copy('#application_number')">
                COPY
            </button>
            <script>
                function copy(element) {
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val($(element).text()).select();
                    document.execCommand("copy");
                    $temp.remove();
                    // alert("Application Number Copied, please save in the safe location.");
                    var tooltip = document.getElementById("myTooltip");
                    tooltip.innerHTML = "COPIED";
                }
            </script>

        </div>
        <div style="float:right; padding-right:15px;">
            <a href="/">CLOSE</a>
        </div>

    </div>
</div>

</body>
</html>
