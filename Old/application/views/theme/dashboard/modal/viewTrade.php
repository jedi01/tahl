<?php
/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : Mar 30, 2018, 7:30:04 PM
 */
$cols = [
    "Date" => "Date",
    "Client" => "Client",
    "AccountSelection" => "Account Selection",
    "Commission" => "Commission",
    "CommissionEdited" => "Commission Edited",
    "TradeType" => "Trade Type",
    "Side" => "Side",
    "Symbol" => "Symbol",
    "Shares" => "Shares",
    "AveragePrice" => "Average Price",
    "TotalCommission" => "Total Commission",
    "SoftDollars" => "Soft Dollars",
    "NetCommission" => "Net Commission",
    "allocationToFR" => "Is there any allocation to FR?",
    "fr" => "FR",
    "PotentialReferral" => "Potential Referral",
    "Notes" => "Notes"];
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title h5"><?= $Trade["Client"] ?> Trade Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">            
            <div class="table-responsive">
                <table class="table table-condensed table-striped table-bordered">
                    <tbody>
                        <?php
                        if ($Trade) {
                            foreach ($cols as $key => $col) {
                                ?>
                                <tr><td><?= $col ?></td><th><?= $Trade[$key] ?></th></tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>