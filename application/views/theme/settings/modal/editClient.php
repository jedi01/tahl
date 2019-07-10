<?php
/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : Mar 30, 2018, 7:30:04 PM
 */

?><div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="newEventMoalLebel">Edit Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="newForm" novalidate action="<?= settings_url("editClient/" . $client->clientID) ?>" class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Client Name</label>
                            <input type="hidden" class="form-control" name="hideen_traderID" required value="<?= $client->traderID?>">
                             <input type="hidden" class="form-control" name="hideen_clientName" required value="<?= $client->clientName?>">
                            <input type="text" name="clientName" class="form-control" required value="<?= $client->clientName ?>">
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Account Name</label>
                            <input type="hidden" class="form-control" name="hideen_accountName" required value="<?= $client->accountName ?>">
                            <input type="text" name="accountName" class="form-control" required value="<?= $client->accountName ?>">
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label class="h6">Commission</label>     
                            <input type="hidden" class="form-control" name="hideen_commission" required value="<?= $client->commission?>">                       
                            <input class="form-control" name="commission" required value="<?= $client->commission ?>">
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div> 
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label class="h6">Default Trade Type</label>                            
                            <label>Trader Name</label>
                            <input type="hidden" class="form-control" name="hideen_default_tradeType" required value="<?= $client->default_tradeType?>">
                            <select name="default_tradeType" class="form-control" id="default_tradeType" style="width: 100%" required>
                                <option value="Single Stock" <?php if($client->default_tradeType == "Single Stock") echo "selected"; ?>>Single Stock</option>
                                <option value="Desk Basket" <?php if($client->default_tradeType == "Desk Basket") echo "selected"; ?>>Desk Basket</option>
                                <option value="Floor Basket" <?php if($client->default_tradeType == "Floor Basket") echo "selected"; ?>>Floor Basket</option>
                            </select>
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>  
                    <div class="col-12">
                        <fieldset class="form-group">
                                                     
                            <label>Grouping</label>
                            <select name="grouping" class="form-control" id="grouping" style="width: 100%" required>
                                <option value="TMT Trades" <?php if($client->grouping == "TMT Trades") echo "selected"; ?>>TMT Trades</option>
                                <option value="Floor"<?php if($client->grouping == "Floor") echo "selected"; ?>>Floor</option>
                                <option value="Upstairs/Desk"<?php if($client->grouping == "Upstairs/Desk") echo "selected"; ?>>Upstairs/Desk</option>
                                <option value="TMT Subscriptions"<?php if($client->grouping == "TMT Subscriptions") echo "selected"; ?>>TMT Subscriptions</option>
                            </select>
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn bg-blue-grey square" value="SaveNewPayment">Edit</button>
                    </div>
                </div>
            </form>            
        </div>
    </div>            
</div>

<script type="text/javascript">
    $("#newForm").on("change", function (e) {
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation('destroy');
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
    });
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

</script>