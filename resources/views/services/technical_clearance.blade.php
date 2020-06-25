@extends('layouts.manager')
@section('page-title','Issuance Of Technical Clearance Of Tourist Standard Accommodation')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">General Information</h4>
    </div>
    <form class="bootstrap-form" action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="formdata">
        @csrf
        <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
        <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" >Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">CID No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control numeric-only" name="cid_no" value="{{ old('cid_no') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Proposed location for construction.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="location"  value="{{ old('location') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                                <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                                <option value=""> -Select-</option>
                                    @foreach ($dzongkhagLists as $dzongkhagList)
                                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                                    @endforeach
                                </select>
                            </div>                                       
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Gewog<span class="text-danger"> *</span></label>
                                <select  name="gewog_id" class="form-control select2bs4" id="gewog_id" style="width: 100%;">
                                    <option value=""> -Select-</option>
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Contact No.<span class="text-danger"> *</span></label>
                                <input type="text" name="contact_no" class="form-control numeric-only" value="{{ old('contact_no') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">No of rooms proposed<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="number" value="{{ old('number') }}" autocomplete="off" >
                            </div>
                        </div>

                            <div class="col-md-5 offset-md-2">
                                <div class="form-group">
                                    <label for="">Tentative construction<span class="text-danger"> *</span> </label>
                                    <input type="text" name="tentative_cons" class="form-control" value="{{ old('tentative_cons') }}" autocomplete="off">
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="tentative_com" value="{{ old('tentative_com') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Drawing submission date<span class="text-danger"> *</span></label>
                                <input type="date" class="form-control" name="drawing_date" value="{{ old('drawing_date') }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="row">         
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Note:</label>
                                <span>Please kindly submit architectural drawing (soft copy) to <a href="ipdd@tourism.gov.bt">ipdd@tourism.gov.bt</a><span>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
            <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
   $('.select2bs4').on('change', function () {
      $(this).valid();
     });
});
   /*  var validation=function(){
	var submitted;
	function validate(form) {
        submitted=true;
        var requiredvalid = true;
        var numbervalid = true;
        var passwordvalid = true;
        var confirmpasswordvalid = true;
        var emailvalid = true;
        var fixedLengthValid=true;
        var timeValid=true;
        var message = '';
        form.find('input, textarea').each(function () {
            var curInput = $(this);
            if ($(this).hasClass('required')) {
                if (!$(this).val()) {
                    requiredvalid = false;
                    curInput.closest('.form-control').addClass('is-valid');
                    curInput.closest('.form-control').addClass('is-invalid');
                    curInput.parents('.form-group').find('span.help-block').remove();
                    curInput.parents('td').find('span.help-block').remove();
                    if (!curInput.parents('.form-group label').find('span.help-block.required-message').length && !curInput.parents('td').find('span.help-block.required-message').length) {
                        curInput.before("<span class='help-block error-span required-message'>This field is required!</span>");
                    }
                    curInput.addClass('error');
                } else {
                    curInput.removeClass('error');
                    curInput.closest('.form-control').removeClass('is-invalid');
                    curInput.parents('.form-group').find('span.help-block.required-message').remove();
                    curInput.parents('td').find('span.help-block.required-message').remove();
                    curInput.parents('.form-group').addClass('has-success');
                }
            }
            if ($(this).hasClass('number')) {
                if (isNaN($(this).val())) {
                    numbervalid = false;
                    curInput.parents('.form-group').removeClass('has-success');
                    curInput.parents('.form-group').addClass('has-error');
                    if (!curInput.parents('.form-group').find('span.help-block.number-message').length && !curInput.parents('td').find('span.help-block.number-message').length) {
                        curInput.before("<span class='help-block error-span number-message'>Please enter a number!</span>");
                    }
                    curInput.addClass('error');
                } else {
                    if(curInput.hasClass('range')){
                        var min = curInput.data('min');
                        var max = curInput.data('max');
                        var numericValue = curInput.val();
                        if(numericValue <= max && numericValue >= min){
                            curInput.removeClass('error');
                            curInput.parents('.form-group').removeClass('has-error');
                            curInput.parents('.form-group').find('span.help-block.number-message').remove();
                            curInput.parents('td').find('span.help-block.number-message').remove();
                        }else{
                            numbervalid = false;
                            if (!curInput.parents('.form-group').find('span.help-block.number-message').length && !curInput.parents('td').find('span.help-block.number-message').length) {
                                curInput.before("<span class='help-block error-span number-message'>Number should be in the range of "+min+" to "+max+"! </span>");
                            }
                            curInput.addClass('error');
                        }
                    }else{
                        if (requiredvalid && curInput.val()) {
                            curInput.removeClass('error');
                            curInput.parents('.form-group').removeClass('has-error');
                        }
                        curInput.parents('.form-group').find('span.help-block.number-message').remove();
                        curInput.parents('td').find('span.help-block.number-message').remove();
                        if (!curInput.hasClass('required')) {
                            numbervalid = true;
                            curInput.removeClass('error');
                            curInput.parents('.form-group').removeClass('has-error');
                            curInput.parents('.form-group').find('span.help-block.number-message').remove();
                            curInput.parents('td').find('span.help-block.number-message').remove();
                            curInput.parents('.form-group').addClass('has-success');
                        }
                    }
                }
            }
            //time validation
            if ($(this).hasClass('time')) {
                if (!$(this).val()) {
                    timeValid = false;
                    curInput.parents('.form-group').removeClass('has-success');
                    curInput.parents('.form-group').addClass('has-error');
                    curInput.parents('.form-group').find('span.help-block').remove();
                    curInput.parents('td').find('span.help-block').remove();
                    if (!curInput.parents('.form-group').find('span.help-block.required-message').length && !curInput.parents('td').find('span.help-block.required-message').length) {
                        curInput.before("<span class='help-block error-span required-message'>Not a valid Time!</span>");
                    }
                    curInput.addClass('error');
                } else {
                    curInput.removeClass('error');
                    curInput.parents('.form-group').removeClass('has-error');
                    curInput.parents('.form-group').find('span.help-block.required-message').remove();
                    curInput.parents('td').find('span.help-block.required-message').remove();
                    curInput.parents('.form-group').addClass('has-success');
                }
            }
            if($(this).hasClass('fixedlengthvalidate')){
                var value = $(this).val();
                var valueLength = value.length;
                var fixedlength=parseInt($(this).data('fixedlength'));
                if(valueLength==fixedlength) {
                    if (requiredvalid) {
                        curInput.removeClass('error');
                        curInput.parents('.form-group').removeClass('has-error');
                    }
                    curInput.parents('.form-group').find('span.help-block.fixed-length-message').remove();
                    curInput.parents('td').find('span.help-block.fixed-length-message').remove();
                    curInput.parents('.form-group').addClass('has-success');
                } else {
                    fixedLengthValid = false;
                    curInput.parents('.form-group').removeClass('has-success');
                    curInput.parents('.form-group').addClass('has-error');
                    if (!curInput.hasClass('error') && curInput.val()) {
                        if (!curInput.parents('.form-group').find('span.help-block.fixed-length-message').length && !curInput.parents('td').find('span.help-block.number-message').length) {
                            curInput.before("<span class='help-block error-span fixed-length-message'>Please enter a valid "+fixedlength+" digit mobile number!</span>");
                        }
                        curInput.addClass('error');
                    } else {
                        if (!curInput.hasClass('required') && !curInput.val()) {
                            fixedLengthValid = true;
                            curInput.removeClass('error');
                            curInput.parents('.form-group').removeClass('has-error');
                            curInput.parents('.form-group').find('span.help-block.fixed-length-message').remove();
                            curInput.parents('td').find('span.help-block.fixed-length-message').remove();
                            curInput.parents('.form-group').addClass('has-success');
                        }
                    }
                }
            }
            if ($(this).hasClass('password')){
                var value = $(this).val();
                var number = /\d/;
                var specialchar = /[^A-z0-9_]/;
                var alpha = /[A-z]/;
                if ((value.search(number) !== -1) && (value.search(specialchar) !== -1) && (value.search(alpha) !== -1) && (value.length >= 5)) {
                    if (requiredvalid) {
                        curInput.removeClass('error');
                    }
                    curInput.parents('.form-group').find('span.help-block.password-message').remove();
                    curInput.parents('td').find('span.help-block.password-message').remove();
                    curInput.parents('.form-group').addClass('has-success');
                } else {
                    passwordvalid = false;
                    curInput.parents('.form-group').removeClass('has-success');
                    curInput.parents('.form-group').addClass('has-error');
                    if (!curInput.hasClass('error') && curInput.val()) {
                        if (!curInput.parents('.form-group').find('span.help-block.password-message').length && !curInput.parents('td').find('span.help-block.number-message').length) {
                            curInput.before("<span class='help-block error-span password-message'>Password should contain numbers, alphabets and a special character and must be more than five characters long!</span>");
                        }
                        curInput.addClass('error');
                    } else {
                        if (!curInput.hasClass('required') && !curInput.val()) {
                            passwordvalid = true;
                            curInput.removeClass('error');
                            curInput.parents('.form-group').removeClass('has-error');
                            curInput.parents('.form-group').find('span.help-block.password-message').remove();
                            curInput.parents('td').find('span.help-block.password-message').remove();
                            curInput.parents('.form-group').addClass('has-success');
                        }
                    }
                }
            }
            if ($(this).hasClass('confirmpassword')) {
                if ($(this).val() == $('.password').val()) {
                    if (requiredvalid) {
                        curInput.removeClass('error');
                        curInput.parents('.form-group').removeClass('has-error');
                        curInput.parents('.form-group').removeClass('has-error');
                    }
                    curInput.parents('.form-group').find('span.help-block.confirmpassword-message').remove();
                    curInput.parents('td').find('span.help-block.confirmpassword-message').remove();
                    curInput.parents('.form-group').addClass('has-success');
                } else {
                    confirmpasswordvalid = false;
                    curInput.parents('.form-group').removeClass('has-success');
                    curInput.parents('.form-group').addClass('has-error');
                    if ((!curInput.hasClass('error') || !confirmpasswordvalid) && curInput.val()) {
                        if (!curInput.parents('.form-group').find('span.help-block.confirmpassword-message').length && !curInput.parents('td').find('span.help-block.number-message').length) {
                            curInput.before("<span class='help-block error-span confirmpassword-message'>Passwords should match!</span>");
                        }
                        curInput.addClass('error');
                    } else {
                        if (!curInput.hasClass('required') && !curInput.val()) {
                            confirmpasswordvalid = true;
                            curInput.removeClass('error');
                            curInput.parents('.form-group').removeClass('has-error');
                            curInput.parents('.form-group').find('span.help-block.confirmpassword-message').remove();
                            curInput.parents('td').find('span.help-block.confirmpassword-message').remove();
                            curInput.parents('.form-group').addClass('has-success');
                        }
                    }
                }
            }
            if ($(this).hasClass('email')) {
                var str = $(this).val();
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (re.test(str)) {
                    //emailvalid = true;
                    if (requiredvalid || emailvalid) {
                        curInput.removeClass('error');
                        curInput.parents('.form-group').removeClass('has-error');
                    }
                    curInput.parents('.form-group').find('span.help-block.email-message').remove();
                    curInput.parents('td').find('span.help-block.email-message').remove();
                    curInput.parents('.form-group').addClass('has-success');
                } else {
                    emailvalid = false;
                    curInput.parents('.form-group').removeClass('has-success');
                    curInput.parents('.form-group').addClass('has-error');
                    if (!curInput.hasClass('error') && curInput.val()) {
                        if (!curInput.parents('.form-group').find('span.help-block.email-message').length && !curInput.parents('td').find('span.help-block.number-message').length) {
                            curInput.before("<span class='help-block error-span email-message'>Enter a valid Email!</span>");
                        }
                        curInput.addClass('error');
                    } else {
                        if (!curInput.hasClass('required') && !curInput.val()) {
                            emailvalid = true;
                            curInput.removeClass('error');
                            curInput.parents('.form-group').removeClass('has-error');
                            curInput.parents('.form-group').find('span.help-block.email-message').remove();
                            curInput.parents('td').find('span.help-block.email-message').remove();
                            curInput.parents('.form-group').addClass('has-success');
                        }
                    }
                }
            }

        });
        form.find('select').each(function () {
            if ($(this).hasClass('required')) {
                var curInput = $(this);
                var name = curInput.attr('name');
                if ($(this).val() == '') {
                    requiredvalid = false;
                    curInput.parents('.form-group').removeClass('has-success');
                    curInput.parents('.form-group').addClass('has-error');
                    if (!curInput.parents('.form-group').find('span.help-block').length && !curInput.parents('td').find('span.help-block').length) {
                        curInput.before("<span class='help-block error-span required-message'>This field is required!</span>");
                    }
                    curInput.addClass('error');
                } else {
                    curInput.removeClass('error');
                    curInput.parents('.form-group').removeClass('has-error');
                    curInput.parents('.form-group').find('span.help-block.required-message').remove();
                    curInput.parents('td').find('span.help-block.required-message').remove();
                    curInput.parents('.form-group').addClass('has-success');
                }
            }
        });
        if (!requiredvalid || !numbervalid || !passwordvalid || !confirmpasswordvalid || !emailvalid || !fixedLengthValid){
            $('button[type="submit"],input[type="submit"]').attr('disabled','disabled');
            return false;
        } else {
            $('button[type="submit"],input[type="submit"]').removeAttr('disabled');
            $('h4.text-red').remove();
            return true;
        }
    }
	function initialize(){
		$(document).on('keyup change','input, textarea',function() {
            var form = $(this).parents('form');
            if(submitted){
                validate(form);
            }
        });

        $(document).on('change','select',function(){
            var form = $(this).parents('form');
            if(submitted){
                validate(form);
            }
        });
        $(document).on('click','button[type="submit"], input[type="submit"]',function(e){
            submitted = true;
            var flag = false;
            var form = $(this).parents('form');
            var valid = validate(form);
            if(!valid){
                $(this).parent().append('<h4 class="text-red" style="font-size: 14px;"><i class="fa fa-warning"></i> You have errors in your form. Please correct them and submit again</h4>');
                return false;
            }else{
                $(this).attr('disabled', true);
                $(this).closest('form').submit();
                return true;
            }
        });
	}
	return{
        Validate: validate,
        Initialize:initialize
    }
}();
$(document).ready(function(){
    validation.Initialize();
}); */
</script>
@endsection



