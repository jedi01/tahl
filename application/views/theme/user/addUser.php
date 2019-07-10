<?php
/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : May 12, 2018, 11:32:33 AM
 */
?>
<form class="form" novalidate action="<?= user_url("addUser") ?>" method="post" autocomplete>
    <div class="form-body">
        <h4 class="form-section"><i class="fa fa-user"></i>  Personal Info</h4>
        <div class="row">
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="userinput1">Fist Name</label>
                    <input type="text" id="userinput1" class="form-control border-primary" required placeholder="First Name" name="firstName">
                    <p class="help-block m-0 danger"></p>
                </fieldset>

            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="userinput2">Last Name</label>
                    <input type="text" id="userinput2" class="form-control border-primary" required placeholder="Last Name" name="lastName">

                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="userinput4">Position</label>
                    <select id="userinput4" class="form-control border-primary" style="width: 100%;" name="position">
                        <option><?= USER_TRADER ?></option>
                        <option><?= USER_ADMIN_VIEWER ?></option>
                        <option><?= USER_ADMIN_EDITOR ?></option>
                        <option><?=USER_TMT_SUBSCRIPTION?></option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
        </div>

        <h4 class="form-section"><i class="ft-mail"></i> Contact Info &amp; Notes</h4>

        <fieldset class="form-group">
            <label for="userinput5">Email</label>
            <input class="form-control border-primary" type="email" placeholder="email" id="userinput5" required name="email">
            <p class="help-block m-0 email_error danger"></p>
        </fieldset>
        <fieldset class="form-group">
            <label>Phone Number</label>
            <input class="form-control border-primary" id="userinput7" onkeypress="return isNumber(event)" type="tel" placeholder="Phone Number" name="phoneNumber">
            <p class="help-block m-0 danger"></p>
        </fieldset>       

        <h4 class="form-section"><i class="ft-lock"></i>Password</h4>

        <fieldset class="form-group">
            <label for="userinput6">Password</label>
            <input class="form-control border-primary" type="password" placeholder="password" id="userinput6" name="password" required autocomplete="off">
            <p class="help-block m-0 danger"></p>
        </fieldset>        
    </div>

    <div class="form-actions right">
        <button type="button" class="btn btn-warning mr-1">
            <i class="ft-x"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-check-square-o"></i> Save
        </button>
    </div>
</form>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
$(document).on('keyup','#userinput5',function(){
    var email_id = $(this).val();
    if(isEmail(email_id)){
        var trade_position = $('#userinput4 option:selected').text();
        $.ajax({
            type: "POST",
            url: base_url + "user/emailUserCheck",
            data: {
                'email_id': email_id,
                'position': trade_position
            },
            dataType:'json',
            success: function (e) {
//                console.log(e);
                if(e.valid == 0){
                    alert("This email already exist");
                    $('.email_error').html("This email already exist.");
                }else{
                    $('.email_error').html("");
                }
            }
        });
    }
    
});
</script>