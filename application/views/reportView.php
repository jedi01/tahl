<?php
    // dnp($tmtTrade);
    // dnp($tmtsubscription);
    // dnp($floor);
    // dnp($upstairs);
   
   
$allTotal = 0;

$tmttradeTotal = 0;
foreach ($tmtTrade as $key => $value) {

    $tmttradeTotal += $value->TotalCommission;
    //$allTotal+=$tmttradeTotal;

}

$upstairsTotal = 0;
foreach ($upstairs as $key1 => $value1) {

    $upstairsTotal += $value1->TotalCommission;
    //$allTotal+=$upstairsTotal;

}



$tmtsubscriptionTotal = 0;
foreach ($tmtsubscription as $key2 => $value2) {

    $tmtsubscriptionTotal += $value2->TotalCommission;
    //$allTotal+=$tmtsubscriptionTotal;

}


$floorTotal = 0;
foreach ($floor as $key3 => $value3) {

    $floorTotal += $value3->TotalCommission;
    //$allTotal+=$floorTotal;

}
    $allTotal = $floorTotal + $tmtsubscriptionTotal + $upstairsTotal + $tmttradeTotal;

 ?>
 <style type="text/css">
    .margintop{
        margin-top: 60px;
    }
    table , tr{
        width: 100%;
    }
    th, td{
        width: 50%;
    }

    td{
        text-align: center;
    }
    .heading{
            width: 100%;
            display: flex;
    }
    .wd50{
        width: 50%;
    }
    h4{
        font-size: 25px;
    }
    
 </style>
<div class="margintop">
    <div class="row heading">
        <div class="col-6 wd50">
            <h4>Date: <?php echo $startDate." - ".$endDate; ?></h4>
        </div>
    </div>

<?php if(!empty($tmtTrade)){ ?>

<div class="row heading">
    <div class="col-6 wd50">
        <h4>Group: TMT Trades</h4>
    </div>
</div>
 <div class="row">
    <div class="col-12">
            <table>
                <thead>
                    <tr>            
                        <th>Client</th>
                        <th>Shares</th>                           
                        <th>Trader</th>
                        <th>Total Commission</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                          foreach ($tmtTrade as $key => $value) {
                   ?>

                        <tr>
                            <td><?php echo $value->clientName; ?></td>
                            <td><?php echo $value->Shares; ?></td>
                            <td><?php echo $value->firstName." ".$value->lastName; ?></td>
                            <td><?php echo "$".number_format((float)$value->TotalCommission, 2, '.', ''); ?></td>
                        </tr>

                    <?php }  ?>
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Subtotal =</b> <?php echo "$".number_format((float)$tmttradeTotal, 2, '.', ''); ?></td>
                        </tr>
                </tbody>
                
            </table>
        
    </div>
</div>

<!-- <div class="col-6 wd50">
        <h4>Subtotal = <?php echo "$".number_format((float)$tmttradeTotal, 2, '.', ''); ?></h4>
    </div> -->

<hr>

<?php } ?>

<?php if(!empty($floor)){ ?>
<div class="row heading">
    <div class="col-6 wd50">
        <h4>Group: Floor</h4>
    </div>
    
</div>
<div class="row">
    <div class="col-12">
        <div class=" table-responsive">
            <table class="table table-striped table-bordered serverSide-table">
                <thead>
                    <tr>            
                        <th>Client</th>
                        <th>Shares</th>                           
                        <th>Trader</th>
                        <th>Total Commission</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($floor as $key3 => $value3) { ?>

                        <tr>
                            <td><?php echo $value3->clientName; ?></td>
                            <td><?php echo $value3->Shares; ?></td>
                            <td><?php echo $value3->firstName." ".$value3->lastName; ?></td>
                             <td><?php echo "$".number_format((float)$value3->TotalCommission, 2, '.', ''); ?></td>
                        </tr>

                    <?php } ?>
                        <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Subtotal =</b> <?php echo "$".number_format((float)$floorTotal, 2, '.', ''); ?></td>
                        </tr>
                </tbody>
                
            </table>
        </div>
    </div>
</div>
<!-- <div class="col-6 wd50">
        <h4>Subtotal = <?php echo "$".number_format((float)$floorTotal, 2, '.', ''); ?></h4>
    </div> -->
<hr>
<?php } ?>

<?php if(!empty($upstairs)){ ?>
<div class="row heading">
    <div class="col-6 wd50">
        <h4>Group: Upstairs/Desk</h4>
    </div>
    
</div>
<div class="row">
    <div class="col-12">
       
            <table>
                <thead>
                    <tr>            
                        <th>Client</th>
                        <th>Shares</th>                           
                        <th>Trader</th>
                        <th>Total Commission</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($upstairs as $key1 => $value1) { ?>

                        <tr>
                            <td><?php echo $value1->clientName; ?></td>
                            <td><?php echo $value1->Shares; ?></td>
                            <td><?php echo $value1->firstName." ".$value1->lastName; ?></td>
                             <td><?php echo "$".number_format((float)$value1->TotalCommission, 2, '.', ''); ?></td>
                        </tr>

                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Subtotal =</b> <?php echo "$".number_format((float)$upstairsTotal, 2, '.', ''); ?></td>
                        </tr>
                </tbody>
                
            </table>
        </div>

</div>
 <!--<div class="col-6 wd50">
        <h4>Subtotal = <?php echo "$".number_format((float)$upstairsTotal, 2, '.', ''); ?></h4>
    </div> -->


<hr>
<?php } ?>


<?php if(!empty($tmtsubscription)){ ?>
<div class="row heading">
    <div class="col-6 wd50">
        <h4>Group: TMT Subscriptions</h4>
    </div>

</div>
<div class="row">
    <div class="col-12">
        <div class=" table-responsive">
            <table class="table table-striped table-bordered serverSide-table">
                <thead>
                    <tr>            
                        <th>Client</th>
                        <th>Shares</th>                           
                        <th>Trader</th>
                        <th>Total Commission</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tmtsubscription as $key2 => $value2) { ?>

                        <tr>
                            <td><?php echo $value2->clientName; ?></td>
                            <td><?php echo $value2->Shares; ?></td>
                            <td><?php echo $value2->firstName." ".$value2->lastName; ?></td>
                             <td><?php echo "$".number_format((float)$value2->TotalCommission, 2, '.', ''); ?></td>
                        </tr>

                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Subtotal =</b> <?php echo "$".number_format((float)$tmtsubscriptionTotal, 2, '.', ''); ?></td>
                        </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
  <!--  <div class="col-6 wd50">
        <h4>Subtotal = <?php echo "$".number_format((float)$tmtsubscriptionTotal, 2, '.', ''); ?></h4>
    </div> -->
<hr>
<?php }  ?>



<div class="row">
    <div class="col-12">
        <h4>Total Commissions for all groups: <?php echo"$".number_format((float)$allTotal, 2, '.', ''); ?></h4>
    </div>
    
</div>
</div>