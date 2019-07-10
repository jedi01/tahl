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
<?php
echo "tet<pre>";
print_r($client);
exit;
//$default_tradeType = $currentUser->default_tradeType;
/* $single_stock_val = '';
  $basket_val = '';
  $floor_basket_val = '';
  $default_tradeType = "Single Stock";
  if($default_tradeType == "Single Stock"){
  $single_stock_val = 'selected';
  }
  else if($default_tradeType == "Desk Basket"){
  $basket_val = 'selected';
  }
  else if($default_tradeType == "Floor Basket"){
  $floor_basket_val = 'selected';
  } */
?>
<form class="form" action="<?= dashboard_url("addAlertList") ?>" method="post" novalidate id="addAlert_form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12 col-lg-12" style="text-align: center;">
                <h2><span>Email Alerts</span></h2>
            </div>
            <div class="col-md-9 col-lg-9">
                <fieldset class="form-group">
                    <label for="userinput1">Soft Dollar Alert Email</label>
                    <textarea class="form-control" col="4" name="soft_dollar_alert" id="soft_dollar_alert"></textarea>
                    <p class="help-block m-0 danger"></p>
                    <small>an email alert will be sent to the above address(es) any time a trade is saved where the soft dollars field is not empty.</small>
                </fieldset>
            </div>
            <div class="col-md-9 col-lg-9">
                <fieldset class="form-group">
                    <label for="userinput1">Notes Alert Email</label>
                    <textarea class="form-control" col="4" name="notes_alert" id="notes_alert"></textarea>
                    <p class="help-block m-0 danger"></p>
                    <small>an email alert will be sent to the above address(es) any time a trade is saved where the notes field is not empty.</small>
                </fieldset>
            </div>
            <div class="col-md-9 col-lg-9">
                <fieldset class="form-group">
                    <label for="userinput1">Commission Alert Email</label>
                    <textarea class="form-control" col="4" name="commission_alert" id="commission_alert"></textarea>
                    <p class="help-block m-0 danger"></p>
                    <small>an email alert will be sent to the above address(es) any time a trade is saved where the commission value is manually overwritten.</small>
                </fieldset>
            </div>
            <div class="col-md-9 col-lg-9">
                <fieldset class="form-group">
                    <label for="userinput1">Client Alert Email</label>
                    <textarea class="form-control" col="4" name="client_alert" id="client_alert"></textarea>
                    <p class="help-block m-0 danger"></p>
                    <small>an email alert will be sent to the above address(es) any time a trade is saved where the soft dollars field is not empty.</small>
                </fieldset>
            </div>

            <div class="col-md-9 col-lg-9">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Save
                </button>
            </div>
        </div>
    </div>

</form>
