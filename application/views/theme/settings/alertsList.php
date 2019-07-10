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

<form class="form" action="<?= settings_url("alertsList") ?>" method="post" novalidate id="addAlert_form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12 col-lg-12" style="text-align: center;">
                <h2><span>Email Alerts</span></h2>
            </div>
            <div class="col-md-9 col-lg-9">
                <fieldset class="form-group">
                    <label for="userinput1">Soft Dollar Alert Email</label>
                    <textarea class="form-control" col="4" name="soft_dollar_alert" id="soft_dollar_alert"><?php echo $client['soft_dollar_alert']['alert_value'];  ?></textarea>
                    <p class="help-block m-0 danger"></p>
                    <small>an email alert will be sent to the above address(es) any time a trade is saved where the soft dollars field is not empty.</small>
                </fieldset>
            </div>
            <div class="col-md-9 col-lg-9">
                <fieldset class="form-group">
                    <label for="userinput1">Notes Alert Email</label>
                    <textarea class="form-control" col="4" name="notes_alert" id="notes_alert"><?php echo $client['notes_alert']['alert_value'];  ?></textarea>
                    <p class="help-block m-0 danger"></p>
                    <small>an email alert will be sent to the above address(es) any time a trade is saved where the notes field is not empty.</small>
                </fieldset>
            </div>
            <div class="col-md-9 col-lg-9">
                <fieldset class="form-group">
                    <label for="userinput1">Commission Alert Email</label>
                    <textarea class="form-control" col="4" name="commission_alert" id="commission_alert"><?php echo $client['commission_alert']['alert_value'];  ?></textarea>
                    <p class="help-block m-0 danger"></p>
                    <small>an email alert will be sent to the above address(es) any time a trade is saved where the commission value is manually overwritten.</small>
                </fieldset>
            </div>
            <div class="col-md-9 col-lg-9">
                <fieldset class="form-group">
                    <label for="userinput1">Client Alert Email</label>
                    <textarea class="form-control" col="4" name="client_alert" id="client_alert"><?php echo $client['client_alert']['alert_value'];  ?></textarea>
                    <p class="help-block m-0 danger"></p>
                    <small>an email alert will be sent to the above address(es) any time a client record is added or edited.</small>
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

<hr>
<div class="row">
    <div class="col-md-12 col-lg-12" style="text-align: center;">
        <button t class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-sticky-note-o"></i> Reports
                </button>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEventMoalLebel">Report</h5>
      </div>
      <div class="modal-body">
            <form method="post" id="newForm" novalidate action="<?= settings_url("reports") ?>" class="container-fluid">
                <div class="row">
                    <div class="col-12 manual">
                        <div class="row">
                        <fieldset class="form-group col-6">
                            <label>Start Date</label>
                            <input type="text" name="start_date" class="form-control singledate" required>
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                        <fieldset class="form-group col-6">
                            <label>End Date</label>
                            <input type="text" name="end_date" class="form-control singledate" required>
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                        
                    </div>
                     <fieldset class="form-group">
                            <label>Email Recipients</label>
                          <select required="" type="text" id="email_recipients"  multiple="multiple" class="form-control" style="width: 100%;"
                            placeholder="Email Recipients" name="email_recipients[]">
                        <?php
                            foreach ($recipents as $key => $value) { ?>
                                <option value="<?php echo $value->email; ?>"><?php echo $value->email; ?></option>
                           <?php }
                         ?>
                    </select> 
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>
                    
                </div>
                       
        </div>

      <div class="modal-footer">
         <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>  
      </div>
    </div>
    </form> 

  </div>
</div>


<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#reportType").select2();
        $("#email_recipients").select2();
        $('.singledate').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
        $('#reportType').on("change",function(){

            var report = $('#reportType').val();
            // /alert(report);
            if(report == 0)
            {
                $(".manual").fadeIn();
            }
            if(report == 1)
            {
                 $(".manual").fadeOut();
            }
        });
    })
</script>