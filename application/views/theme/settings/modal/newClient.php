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
            <h5 class="modal-title" id="newEventMoalLebel">New Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="newForm" novalidate action="<?= settings_url("newClient") ?>" class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Trader Name</label>
                            <select name="traderID" class="form-control" id="traderID" style="width: 100%" required>
                                <option></option>
                                <?php
                                if ($clients) {
                                    foreach ($clients as $client) {
                                        ?>
                                        <option value="<?= $client->id ?>"><?= $client->firstName . " " . $client->lastName ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Client Name</label>
                            <input type="text" name="clientName" class="form-control" required>
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Account Name</label>
                            <input type="text" name="accountName" class="form-control" required>
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label class="h6">Commission</label>                            
                            <input class="form-control" name="commission" required
                                   pattern="^\$?[\d,]*.[\d]{0,5}$">
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>  
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label class="h6">Default Trade Type</label>                            
                            <label>Trader Name</label>
                            <select name="default_tradeType" class="form-control" id="default_tradeType" style="width: 100%" required>
                                <option value="Single Stock" selected="selected">Single Stock</option>
                                <option value="Desk Basket">Desk Basket</option>
                                <option value="Floor Basket">Floor Basket</option>
                            </select>
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                                                     
                            <label>Grouping</label>
                            <select name="grouping" class="form-control" id="grouping" style="width: 100%" required>
                                <option value="TMT Trades" selected="selected">TMT Trades</option>
                                <option value="Floor">Floor</option>
                                <option value="Upstairs/Desk">Upstairs/Desk</option>
                                <option value="TMT Subscriptions">TMT Subscriptions</option>
                            </select>
                            <p class="help-block m-0 danger"></p>
                        </fieldset>
                    </div>  
                    <div class="col-12 text-center">
                        <button type="submit" class="btn bg-blue-grey square" value="SaveNewPayment">Save</button>
                    </div>
                </div>
            </form>            
        </div>
    </div>            
</div>

<script type="text/javascript">
    /* $("#traderID").select2({
     //minimumInputLength: 2,
     tags: [],
     ajax: {
     url: '<?= settings_url("getTraderList") ?>',
     dataType: 'json',
     type: "POST",
     quietMillis: 50,
     data: function (term) {
     return term;
     },
     processResults: function (data) {
     return {
     results: $.map(data, function (item) {
     return {id: item.id, text: item.text};
     })
     };
     }, success(da, f, t) {
     console.log(da, f, t);
     },
     error(er, ff, d) {
     console.log(er, ff, d);
     }
     }
     });*/
    $("#newForm").on("change", function (e) {
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation('destroy');
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
    });
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

</script>