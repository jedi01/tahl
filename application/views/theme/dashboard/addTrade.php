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

// dnp($clients);
// // echo "<pre>";
// // print_r($hello);
// exit;
//$default_tradeType = $currentUser->default_tradeType;
$single_stock_val = '';
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
}
?>


<style type="text/css">
.select2-results__options {
    height: 130px;
    overflow-y: auto;
}
</style>
<form class="form" action="<?= dashboard_url("addTrade") ?>" method="post" novalidate id="addTrade_form">
    <div class="form-body" id="body_content">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <fieldset class="form-group">
                    <label for="userinput1">Date</label>
                    <input type="text" id="userinput1" class="form-control  <?= $currentUser->position == USER_TRADER ? "" : "todayDate" ?>" 
                           readonly="" value="<?= date("d M, Y") ?>"
                            placeholder="Date" name="Date" >
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-3 col-lg-3">
                <fieldset class="form-group">
                    <label for="ClientList">Client List</label>
                    <select type="text" id="ClientList" class="form-control" style="width: 100%;" 
                            placeholder="Client" name="Client">
                        <option value="" disabled="" selected="">Select Client</option>
                        

                    </select>                    
                    <p class="help-block ClientList m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-3 col-lg-3">
                <fieldset class="form-group">
                    <label for="AccountSelection">Account Selection</label>
                    <select required="" type="text" id="AccountSelection" class="form-control" style="width: 100%;"
                            placeholder="Account Selection" name="AccountSelection">
                        <option value="0"></option>
                    </select>                    
                    <p class="help-block AccountSelection m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-3 col-lg-3">
                <fieldset class="form-group">
                    <label for="Commission">Commission</label>
                    <input type="text" required="" id="Commission" class="form-control" style="width: 100%;" onchange="chgTotalComm()"
                           placeholder="Commission" name="Commission">
                    <p class="help-block Commission m-0 danger"></p>
                </fieldset>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <fieldset class="form-group">
                    <label for="tradeType">Trade Type </label>
                    <select class="form-control" id="tradeType" style="width: 100%;"
                            placeholder="Trade Type" name="TradeType">
                        <option value="Single Stock" <?= $single_stock_val ?>>Single Stock</option>
                        <option value="Desk Basket" <?= $basket_val ?>>Desk Basket</option>
                        <option value="Floor Basket" <?= $floor_basket_val ?>>Floor Basket</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
        </div>

        <div class="singleStock">
        
           <!--  ***************************************************************************** -->
        <div class="" style="<?php if($default_tradeType != "Single Stock"){ echo "display:none;"; } ?>" id="action_type_list">
           <!--  ***************************************************************************** -->
            <div class="row">
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="Side">Side </label>
                        <select class="form-control "   style="width: 100%;"
                        placeholder="Side" name="trade_val[1][Side]">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_1"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[1][Shares]">                        
                        <p class="help-block error_shares_1  m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2" id="symbol-holder">
                    <fieldset class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control symbol_1"  style="width: 100%;"  
                        placeholder="Symbol" name="trade_val[1][Symbol]">                        
                        <p class="help-block error_symbol_1 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="AveragePrice">Average Price</label>
                        <input class="form-control averageprice_1"  style="width: 100%;"  type="text" value="0.00"
                        placeholder="Average Price" name="trade_val[1][AveragePrice]">                        
                        <p class="help-block error_avg_1 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  id="SoftDollars1"  onkeyup="SoftDol(this);" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[1][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp" id=""></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[1][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
           <!--  ***************************************************************************** -->
            <div class="row">
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="Side">Side </label>
                        <select class="form-control "   style="width: 100%;"
                        placeholder="Side" name="trade_val[2][Side]">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_2"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[2][Shares]">                        
                        <p class="help-block error_shares_2  m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2" id="symbol-holder">
                    <fieldset class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control symbol_2"  style="width: 100%;"  
                        placeholder="Symbol" name="trade_val[2][Symbol]">                        
                        <p class="help-block error_symbol_2 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="AveragePrice">Average Price</label>
                        <input class="form-control averageprice_2"  style="width: 100%;"  type="text" value="0.00"
                        placeholder="Average Price" name="trade_val[2][AveragePrice]">                        
                        <p class="help-block error_avg_2 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  onkeyup="SoftDol(this);" id="SoftDollars2" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[2][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp" id=""></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[2][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
           <!--  ***************************************************************************** -->
            
            <div class="row">
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="Side">Side </label>
                        <select class="form-control "   style="width: 100%;"
                        placeholder="Side" name="trade_val[3][Side]">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_3"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[3][Shares]">                        
                        <p class="help-block error_shares_3  m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2" id="symbol-holder">
                    <fieldset class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control symbol_3"  style="width: 100%;"  
                        placeholder="Symbol" name="trade_val[3][Symbol]">                        
                        <p class="help-block error_symbol_3 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="AveragePrice">Average Price</label>
                        <input class="form-control averageprice_3"  style="width: 100%;"  type="text" value="0.00"
                        placeholder="Average Price" name="trade_val[3][AveragePrice]">                        
                        <p class="help-block error_avg_3 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  onkeyup="SoftDol(this);" id="SoftDollars3" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[3][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[3][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
           <!--  ***************************************************************************** -->
                       <div class="row">
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="Side">Side </label>
                        <select class="form-control "   style="width: 100%;"
                        placeholder="Side" name="trade_val[4][Side]">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_4"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[4][Shares]">                        
                        <p class="help-block error_shares_4  m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2" id="symbol-holder">
                    <fieldset class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control symbol_4"  style="width: 100%;"  
                        placeholder="Symbol" name="trade_val[4][Symbol]">                        
                        <p class="help-block error_symbol_4 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="AveragePrice">Average Price</label>
                        <input class="form-control averageprice_4"  style="width: 100%;"  type="text" value="0.00"
                        placeholder="Average Price" name="trade_val[4][AveragePrice]">                        
                        <p class="help-block error_avg_4 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  onkeyup="SoftDol(this);" id="SoftDollars4" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[4][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[4][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
           <!--  ***************************************************************************** -->
                       <div class="row">
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="Side">Side </label>
                        <select class="form-control "   style="width: 100%;"
                        placeholder="Side" name="trade_val[5][Side]">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_5"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[5][Shares] ">                        
                        <p class="help-block error_shares_5  m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2" id="symbol-holder">
                    <fieldset class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control symbol_5"  style="width: 100%;"  
                        placeholder="Symbol" name="trade_val[5][Symbol]">                        
                        <p class="help-block error_symbol_5 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="AveragePrice">Average Price</label>
                        <input class="form-control averageprice_5"  style="width: 100%;"  type="text" value="0.00"
                        placeholder="Average Price" name="trade_val[5][AveragePrice]">                        
                        <p class="help-block error_avg_5 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  onkeyup="SoftDol(this);" id="SoftDollars5" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[5][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp"> </p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[5][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
           <!--  ***************************************************************************** -->
            <div class="row">
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="Side">Side </label>
                        <select class="form-control "   style="width: 100%;"
                        placeholder="Side" name="trade_val[6][Side]">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_6"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[6][Shares]">                        
                        <p class="help-block error_shares_6  m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2" id="symbol-holder">
                    <fieldset class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control symbol_6"  style="width: 100%;"  
                        placeholder="Symbol" name="trade_val[6][Symbol]">                        
                        <p class="help-block error_symbol_6 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="AveragePrice">Average Price</label>
                        <input class="form-control averageprice_6"  style="width: 100%;"  type="text" value="0.00"
                        placeholder="Average Price" name="trade_val[6][AveragePrice]">                        
                        <p class="help-block error_avg_6 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  onkeyup="SoftDol(this);" id="SoftDollars6" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[6][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[6][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
           <!--  ***************************************************************************** -->
            <div class="row">
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="Side">Side </label>
                        <select class="form-control "   style="width: 100%;"
                        placeholder="Side" name="trade_val[7][Side]">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_7"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[7][Shares]">                        
                        <p class="help-block error_shares_7  m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2" id="symbol-holder">
                    <fieldset class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control symbol_7"  style="width: 100%;"  
                        placeholder="Symbol" name="trade_val[7][Symbol]">                        
                        <p class="help-block error_symbol_7 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="AveragePrice">Average Price</label>
                        <input class="form-control averageprice_7"  style="width: 100%;"  type="text" value="0.00"
                        placeholder="Average Price" name="trade_val[7][AveragePrice]">                        
                        <p class="help-block error_avg_7 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  onkeyup="SoftDol(this);" id="SoftDollars7" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[7][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp"> </p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[7][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
           <!--  ***************************************************************************** -->
            <div class="row">
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="Side">Side </label>
                        <select class="form-control "   style="width: 100%;"
                        placeholder="Side" name="trade_val[8][Side]">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_8"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[8][Shares]">                        
                        <p class="help-block error_shares_8  m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2" id="symbol-holder">
                    <fieldset class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control symbol_8"  style="width: 100%;"  
                        placeholder="Symbol" name="trade_val[8][Symbol]">                        
                        <p class="help-block error_symbol_8 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="AveragePrice">Average Price</label>
                        <input class="form-control averageprice_8"  style="width: 100%;"  type="text" value="0.00"
                        placeholder="Average Price" name="trade_val[8][AveragePrice]">                        
                        <p class="help-block error_avg_8 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  onkeyup="SoftDol(this);" id="SoftDollars8" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[8][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[8][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
           <!--  ***************************************************************************** -->
            <div class="row">
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="Side">Side </label>
                        <select class="form-control "   style="width: 100%;"
                        placeholder="Side" name="trade_val[9][Side]">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_9"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[9][Shares]">                        
                        <p class="help-block error_shares_9  m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2" id="symbol-holder">
                    <fieldset class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control symbol_9"  style="width: 100%;"  
                        placeholder="Symbol" name="trade_val[9][Symbol]">                        
                        <p class="help-block error_symbol_9 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="AveragePrice">Average Price</label>
                        <input class="form-control averageprice_9"  style="width: 100%;"  type="text" value="0.00"
                        placeholder="Average Price" name="trade_val[9][AveragePrice]">                        
                        <p class="help-block error_avg_9 m-0 danger"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  onkeyup="SoftDol(this);" id="SoftDollars9" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[9][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp"></p>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[9][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
           <!--  ***************************************************************************** -->

            <div id="extra_rows">
                
            </div>
        </div>



        </div> 

        <div class="basket">
            <div class="row">
                <div class="col-md-4 shareIn">
                    <fieldset class="form-group">
                        <label for="Shares">Shares</label>
                        <input class="form-control shares_0"  style="width: 100%;"  type="text" value="0" 
                        placeholder="Shares" name="trade_val[0][Shares]">                        
                        <p class="help-block error_shares_0  m-0 danger"></p>
                    </fieldset>
                </div>
               
                
                <div class="col-md-4">
                    <fieldset class="form-group">
                        <label for="SoftDollars">Soft Dollars</label>
                        <input class="form-control SoftDollars"  onkeyup="SoftDol(this);" id="SoftDollars9" style="width: 100%;" value="0"
                        pattern="^(?=.*[0-9])\d*$"
                        data-validation-pattern-message="Has to be zero or positive number"
                        placeholder="Soft Dollars" name="trade_val[0][SoftDollars]">       
                        <p class="help-block m-0 danger">                    
                        </p>
                        <p class="m-0 danger softDollHelp"></p>
                    </fieldset>
                </div>
                <div class="col-md-4">
                    <fieldset class="form-group">
                        <label>Notes</label>
                        <textarea placeholder="Notes" class="form-control" name="trade_val[0][Notes]" rows="1"></textarea>
                        <p class="help-block m-0 danger"></p>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="" style="<?php if($default_tradeType != "Single Stock"){ echo "display:none;"; } ?>" id="action_addmore">
            <button type="button" class="btn btn-primary addMore">
                <i class="fa fa-inbox"></i> Add 5 More Rows
            </button>
            <input type="hidden" name="total_rows" class="total_rows" id="total_rows" value="10" />
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6" id="shares_div_new" style="display:none">
                <fieldset class="form-group">
                    <label for="Shares">Shares</label>
                    <input class="form-control  shares_1_new" disabled="" id="Shares_new" style="width: 100%;"  type="text" value="0"
                            placeholder="Shares" name="trade_val[0][Shares]">                        
                    <p class="help-block shares_1_new m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6" style="display: none">
                <fieldset class="form-group">
                    <label for="TotalCommission">Total Commission</label>
                    <input class="form-control" id="TotalCommission" style="width: 100%;" readonly
                           placeholder="Total Commission" name="TotalCommission">                        
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>

            <div class="col-md-6" style="display: none">
                <fieldset class="form-group">
                    <label for="NetCommission">Net Commission</label>
                    <input class="form-control" id="NetCommission" style="width: 100%;"
                           readonly
                           placeholder="Net Commission" name="NetCommission">                        
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6" style="display: none">
                <fieldset class="form-group">
                    <label>Is there any allocation to FR?</label>
                    <div class="form-inline">
                        <div class="custom-control custom-radio mr-1">
                            <input type="radio" class="custom-control-input" id="fryes" name="allocationToFR" value="Yes">
                            <label class="custom-control-label" for="fryes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio mx-1">
                            <input type="radio" class="custom-control-input" id="frno" name="allocationToFR" value="No" checked>
                            <label class="custom-control-label" for="frno">No</label>
                        </div>           
                        <input class="form-control" placeholder="FR" name="fr" id="fr" type="text" 
                               style=" -ms-flex-preferred-size: 0;  flex-basis: 0;
                               -ms-flex-positive: 1;  flex-grow: 1;  max-width: 100%;">
                    </div>
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6" style="display: none">
                <fieldset class="form-group">
                    <label for="PotentialReferral">Potential Referral</label>
                    <select class="form-control  select2-dopdown" id="PotentialReferral" style="width: 100%;" multiple 
                            placeholder="Potential Referral" name="PotentialReferral[]">
                        <option>N/A</option>
                        <option>IB</option>
                        <option>FR</option>
                        <option>MS</option>
                        <option>TCA</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
        </div>
        <div class="form-actions right">
            <a class="btn btn-warning mr-1" href="<?= dashboard_url() ?>">
                <i class="ft-x"></i> Cancel
            </a>
            <button type="button" onclick="javascript:checkFormValid();" class="btn btn-primary send">
                <i class="fa fa-check-square-o"></i> Save
            </button>
        </div>
    </div>
</form>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    $('.form-control').focus(function(){
        $(this).css("border-color","");
    });
    function checkFormValid(){
        var total_record = $('#total_rows').val();
        //alert(total_record);
        var valid_row = 0;
        var invalide_row = 0;
        var previous_val = true;
        var pre_val_share = ''; 
        var pre_val_symbol = '';
        var pre_val_avg = '';
        var pre_val_symbol_f = '';
        var pre_val_avg_f = '';
        var v_flag = true;
        var slow_time = 0;
        //pattern="^(?=.*[1-9])\d*(?:\.\d{1,5})?$"
        var treade_type = $('#tradeType').val();;
        if(treade_type == 'Single Stock'){                      
            for(var i=0;i<total_record;i++){
                var share_val = $(".shares_"+i).val();
                var avg_price = $(".averageprice_"+i).val();
                //console.log(share_val);
                if(share_val > 0){
                    var symbol = $(".symbol_"+i).val();
                    // if(symbol.length < 1){
                    //     $(".error_symbol_"+i).html('<ul role="alert"><li>Please enter symbol.</li></ul>');
                    //     $(".symbol_"+i).css("border-color","#981b1e");
                    //     v_flag = false;
                    //     slow_time++;
                    //     if(slow_time == 1){
                    //         $('html, body').animate({
                    //             scrollTop: $('.symbol_'+i).offset().top - 100
                    //         }, 'slow');
                    //     }
                    // }
                    
                    if(avg_price < 0 || avg_price == 0.00){
                        $(".error_avg_"+i).html('<ul role="alert"><li>Not in the expected format.</li></ul>');
                        $(".averageprice_"+i).css("border-color","#981b1e");
                        v_flag = false;
                        slow_time++;
                        if(slow_time == 1){
                            $('html, body').animate({
                                scrollTop: $('.averageprice_'+i).offset().top - 100
                            }, 'slow');
                        }
                    }
                }else{
                    if(i == 0){
                        var symbol = $(".symbol_"+i).val();
                        $('.error_shares_'+i).html('<ul role="alert"><li>Must be greater than 0.</li></ul>');
                        $('.symbol_'+i).css("border-color","#981b1e");
                        // if(symbol.length < 1){
                        //     $(".error_symbol_"+i).html('<ul role="alert"><li>Please enter symbol.</li></ul>');
                        //     $(".symbol_"+i).css("border-color","#981b1e");
                        //     v_flag = false;
                        //     slow_time++;
                        //     if(slow_time == 1){
                        //         $('html, body').animate({
                        //             scrollTop: $('.symbol_'+i).offset().top - 100
                        //         }, 'slow');
                        //     }
                        // }
                        
                        if(avg_price < 0 || avg_price == 0.00){
                            $(".error_avg_"+i).html('<ul role="alert"><li>Not in the expected format.</li></ul>');
                            $(".averageprice_"+i).css("border-color","#981b1e");
                            v_flag = false;
                            slow_time++;
                            if(slow_time == 1){
                                $('html, body').animate({
                                    scrollTop: $('.averageprice_'+i).offset().top - 100
                                }, 'slow');
                            }
                        }
                    }
                }
            }
        }else{
            var share_val = $(".shares_1_new").val();
            
        }
        if(Number($('#ClientList').val().length) == 0){
            v_flag = false;
            $('.ClientList').html('<ul role="alert"><li>This is required.</li></ul>');
            $('html, body').animate({
                scrollTop: $('#ClientList').offset().top - 100
            }, 'slow');
        }
        //alert($('#AccountSelection').val());
        //alert($('#AccountSelection').val().length);
        if($('#AccountSelection').val() == 0){
            v_flag = false;
            $('.AccountSelection').html('<ul role="alert"><li>This is required.</li></ul>');
            $('html, body').animate({
                scrollTop: $('#AccountSelection').offset().top - 100
            }, 'slow');
        }
        var com_val = $('#Commission').val();
        //alert(com_val);
        if(com_val.length <= 0 || com_val == ''){
            v_flag = false;
            $('.Commission').html('<ul role="alert"><li>This is required.</li></ul>');
            $('html, body').animate({
                scrollTop: $('#Commission').offset().top - 100
            }, 'slow');
        }
        //alert(v_flag);
        if(v_flag == true){
            $('#addTrade_form').submit();
        }
        
        //var total_rowValid = Number(valid_row) + Number(invalide_row);    
        
    }
    
    function checkFormValid1(){
        var total_record = $('#total_rows').val();
        //alert(total_record);
        var valid_row = 0;
        var invalide_row = 0;
        var previous_val = true;
        var pre_val_share = ''; 
        var pre_val_symbol = '';
        var pre_val_avg = '';
        var pre_val_symbol_f = '';
        var pre_val_avg_f = '';
        var v_flag = false;
        //pattern="^(?=.*[1-9])\d*(?:\.\d{1,5})?$"
                               
        for(var i=0;i<total_record;i++){
            var share_val = $(".shares_"+i).val();
            var avg_price = $(".averageprice_"+i).val();
            //console.log(share_val);
            if(share_val > 0){
                var symbol = $(".symbol_"+i).val();
                // if(symbol.length < 1){
                //     $(".error_symbol_"+i).html('<ul role="alert"><li>Please enter symbol.</li></ul>');
                //     $(".symbol_"+i).css("border-color","#981b1e");
                    
                // }
                
                if(avg_price < 0 || avg_price == 0.00){
                    $(".error_avg_"+i).html('<ul role="alert"><li>Not in the expected format.</li></ul>');
                    $(".averageprice_"+i).css("border-color","#981b1e");
                    
                }
                    
                if(previous_val == false){
                    $(pre_val_share).html('<ul role="alert"><li>Must be greater than 0.</li></ul>');
                    if(pre_val_symbol != ''){
                        $(pre_val_symbol).html('<ul role="alert"><li>please enter symbol.</li></ul>');
                        $(pre_val_symbol_f).css("border-color","#981b1e");
                        $('html, body').animate({
                            scrollTop: $('.symbol_3').offset().top - 100
                        }, 'slow');
                    }
                    
                    if(pre_val_avg != ''){
                        $(pre_val_avg).html('<ul role="alert"><li>Not in the expected format</li></ul>');
                        $(pre_val_avg_f).css("border-color","#981b1e");
                    }
                    break;  
                }
                valid_row++;
            }else{
                if(i == 0){
                    var symbol = $(".symbol_"+i).val();
                    $('.error_shares_'+i).html('<ul role="alert"><li>Must be greater than 0.</li></ul>');
                    $('.symbol_'+i).css("border-color","#981b1e");
                    // if(symbol.length < 1){
                    //     $(".error_symbol_"+i).html('<ul role="alert"><li>Please enter symbol.</li></ul>');
                    //     $(".symbol_"+i).css("border-color","#981b1e");
                    // }
                    
                    if(avg_price < 0 || avg_price == 0.00){
                        $(".error_avg_"+i).html('<ul role="alert"><li>Not in the expected format.</li></ul>');
                        $(".averageprice_"+i).css("border-color","#981b1e");
                    }
                }
                previous_val = false;
                invalide_row++;
                if(invalide_row > 1){
                    pre_val_share += ',.error_shares_'+i;
                    var symbol = $(".symbol_"+i).val();
                    // if(symbol.length < 1){
                    //     pre_val_symbol += ',.error_symbol_'+i;
                    //     pre_val_symbol_f += ',.symbol_'+i;
                    // }
                    
                    
                    if(avg_price < 0 || avg_price == 0.00){
                        pre_val_avg += ',.error_avg_'+i;
                        pre_val_avg_f += ',.averageprice_'+i;
                    }
                }else{
                    pre_val_share += '.error_shares_'+i;
                    var symbol = $(".symbol_"+i).val();
                    // if(symbol.length < 1){
                    //     pre_val_symbol += '.error_symbol_'+i;
                    //     pre_val_symbol_f += '.symbol_'+i;
                    // }
                    
                    var avg_price = $(".averageprice_"+i).val();
                    if(avg_price < 0 || avg_price == 0.00){
                        pre_val_avg += '.error_avg_'+i;
                        pre_val_avg_f += '.averageprice_'+i;
                    }
                }
            }
        }
        
        if(valid_row == 0){
            //alert("Please insert atleast 1 row.");
            v_flag = false;
        }
        
        if(Number($('#ClientList').val().length) == 0){
            v_flag = false;
            $('.ClientList').html('<ul role="alert"><li>This is required.</li></ul>');
            $('html, body').animate({
                scrollTop: $('#ClientList').offset().top - 100
            }, 'slow');
        }
        //alert($('#AccountSelection').val());
        //alert($('#AccountSelection').val().length);
        if($('#AccountSelection').val() == 0){
            v_flag = false;
            $('.AccountSelection').html('<ul role="alert"><li>This is required.</li></ul>');
            $('html, body').animate({
                scrollTop: $('#AccountSelection').offset().top - 100
            }, 'slow');
        }
        var com_val = $('#Commission').val();
        //alert(com_val);
        if(com_val.length <= 0 || com_val == ''){
            v_flag = false;
            $('.Commission').html('<ul role="alert"><li>This is required.</li></ul>');
            $('html, body').animate({
                scrollTop: $('#Commission').offset().top - 100
            }, 'slow');
        }
        
        //var total_rowValid = Number(valid_row) + Number(invalide_row);    
        
    }

    $(document).on('click','.addMore',function(){
        var total_rows = Number($('#total_rows').val());
        var old_rows = total_rows;
        total_rows = total_rows + 5;
        $('#total_rows').val(total_rows);
        var extra_row5 = '';
        for(i=0;i<5;i++){
            var old_rows_val = 0;
            old_rows_val = old_rows + i;
            extra_row5 += '<div class="row">'+
                '<div class="col-md-2">'+
                    '<fieldset class="form-group">'+
                        '<label for="Side">Side </label>'+
                        '<select class="form-control"  style="width: 100%;" placeholder="Side" name="trade_val['+old_rows_val+'][Side]">'+
                            '<option>Buy</option>'+
                            '<option>Sell</option>'+
                            '<option>Sell Short</option>'+
                        '</select>'+
                        '<p class="help-block m-0 danger"></p>'+
                    '</fieldset>'+
                '</div>'+
                '<div class="col-md-2">'+
                    '<fieldset class="form-group">'+
                        '<label for="Shares">Shares</label>'+
                        '<input class="form-control share_'+i+'"  style="width: 100%;"  type="text" value="0"  placeholder="Shares" name="trade_val['+old_rows_val+'][Shares]">'+                        
                        '<p class="help-block m-0 danger"></p>'+
                    '</fieldset>'+
                '</div>'+
                '<div class="col-md-2" id="symbol-holder">'+
                    '<fieldset class="form-group">'+
                        '<label for="symbol">Symbol</label>'+
                        '<input class="form-control symbol_'+i+'"  style="width: 100%;"   placeholder="Symbol" name="trade_val['+old_rows_val+'][Symbol]">'+                        
                        '<p class="help-block m-0 danger"></p>'+
                    '</fieldset>'+
                '</div>'+
                '<div class="col-md-2">'+
                    '<fieldset class="form-group">'+
                        '<label for="AveragePrice">Average Price</label>'+
                        '<input class="form-control averageprice_'+i+'"  style="width: 100%;"  type="text" value="0.00" pattern="^(?=.*[1-9])\d*(?:\.\d{1,5})?$" placeholder="Average Price" name="trade_val['+old_rows_val+'][AveragePrice]">'+                        
                        '<p class="help-block m-0 danger"></p>'+
                    '</fieldset>'+
                '</div>'+
                '<div class="col-md-2">'+
                    '<fieldset class="form-group">'+
                        '<label for="SoftDollars">Soft Dollars</label>'+
                        '<input class="form-control SoftDollars"  onkeyup="SoftDol(this);"  style="width: 100%;" value="0" pattern="^(?=.*[0-9])\d*$"'+
                        'data-validation-pattern-message="Has to be zero or positive number"  placeholder="Soft Dollars" name="trade_val['+old_rows_val+'][SoftDollars]">'+       
                        '<p class="help-block m-0 danger ">' +                  
                        '</p>'+
                        '<p class="m-0 danger softDollHelp"> Soft Dollars cant be greater than Total Commission</p>'+
                    '</fieldset>'+
                '</div>'+
                '<div class="col-md-2">'+
                    '<fieldset class="form-group">'+
                        '<label>Notes</label>'+
                        '<textarea placeholder="Notes" class="form-control" name="trade_val['+old_rows_val+'][Notes]" rows="1"></textarea>'+
                        '<p class="help-block m-0 danger softDollHelp"></p>'+
                    '</fieldset>'+
                '</div>'+
            '</div>';



        }
        $('#extra_rows').append(extra_row5);
        //$('#action_type_list').append(extra_row5);
    });

    function SoftDol(ele)
    {
       
        var softDoll = $(ele).val();

        var shares = $(ele).closest(".row").find(".shareIn").find("input").val();

        var commission = $("#Commission").val();
        var totalCommision = parseFloat(shares)*parseFloat(commission);
        if(softDoll>totalCommision)
        {   
            $(".softDollHelp").slideDown();
            $(ele).next().next().html("Soft Dollars can't be greater than Total Commission"); 
            $(".send").prop("disabled",true);
        }
        else
        {
            $(".softDollHelp").hide();
            $(ele).next().next().html("");
            $(".send").prop("disabled",false);
        }

        
      
    }
    
            var acc;
            function chgTotalComm() {
                $(".softDollHelp").hide();

            }


    window.onload = function (event) {
    'use strict';
            $("#softDollHelp").hide();
            
            $(".select2-dopdown").select2();

        
            $("#fr").hide();

    $("#ClientList").select2({

    //minimumInputLength: 2,
    tags: [],
    createTag: function () {
            // Disable tagging
            return null;
        },
        ajax: {
            url: '<?= dashboard_url("getClientList") ?>',
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
            }, success(e, f, d) {
                        // console.log(e, f, d);
                    },
                    error(e, f, d) {
                        console.log(e, f, d);             }
                    }
                });




                        acc = $("#AccountSelection").select2({
                //minimumInputLength: 2,
                tags: [],
                        createTag: function () {
                        // Disable tagging
                        return null;
                        },
                        ajax: {
                        url: '<?= dashboard_url("getAccountSelection") ?>',
                                            dataType: 'json',
                                            type: "POST",
                                            quietMillis: 50,
                                            data: function (term) {
                                            return {term: term, client: $("#ClientList option:selected").text()};
                                            },
                                            processResults: function (data) {
                                            return {
                                            results: $.map(data, function (item) {
                                            return {id: item.id, text: item.text, commission: item.commission};
                                            })
                                            };
                                            }, success(da, f, t) {
                                    //   console.log( da,f,t);
                                    },
                                            error(er, f, d) {
                                    console.log(er, f, d);             }
                                    }
                            });
                                    $("#ClientList").on("select2:select", function (evt) {
                            if ($("#ClientList").val()) {
                            $.ajax({
                            url: '<?= dashboard_url("getAccountSelection") ?>',
                                        dataType: 'json',
                                        type: "POST",
                                        quietMillis: 50,
                                        data: {client: $("#ClientList option:selected").text()},
                                        success: function (dat, e, f) {
                                            console.log(dat);
                                        if (dat.length) {
                                        $("#AccountSelection").html("<option value='" + dat[0].id + "'>" + dat[0].text + "</option>")
                                                acc.select2("data", dat[0]);
                                                $("#AccountSelection").attr("required", true);                     
                                                $("#Commission").val(dat[0].commission);
                                                //alert(dat[0].default_tradeType);
                                                $('#tradeType option[value="'+dat[0].default_tradeType+'"]').attr('selected','selected');
                                                $('#tradeType').val(dat[0].default_tradeType);
                                                if ("Desk Basket" == dat[0].default_tradeType || "Floor Basket" == dat[0].default_tradeType) {
                                                    // $('#total_rows').val(1);
                                                    // $('#action_type_list').hide();
                                                    // $('#action_addmore').hide();
                                                    // $("#symbol").attr("disabled", true);                 
                                                    // $("#symbol").removeAttr("required");
                                                    // $("#symbol").attr("type", "hidden");
                                                    // $("#Side").attr("disabled", true);                 
                                                    // $("#Side").attr("required", false);
                                                    // $("#side-holder").hide();
                                                    // $("#symbol-holder").hide();
                                                    // $('#notes_div').addClass('col-md-12');
                                                    // $("#shares_div_new").show();
                                                    // $("#Shares_new").removeAttr('disabled');

                                                    // $('#Shares').attr('disabled',true);
                                                    // $('#AveragePrice').attr('disabled',true);
                                                    // $('#shares_div').hide();
                                                    // $('#avgprice_div').hide();
                                                    // alert("aaaa");
                                                    
//                                                    $('#shares_div').removeClass('col-md-3');
//                                                    $('#shares_div').addClass('col-md-6');
//                                                    $('#avgprice_div').removeClass('col-md-3');
//                                                    $('#avgprice_div').addClass('col-md-6');
$(".singleStock").hide();
$(".basket").slideDown();
                                                } 
                                                else {

                                                     $(".singleStock").slideDown();
            $(".basket").hide();
                                        //             $("#Shares_new").attr('disabled',true);
                                        //             $("#shares_div_new").hide();

                                        //             $('#Shares').removeAttr('disabled');
                                        //             $('#AveragePrice').removeAttr('disabled');
                                        //             $('#shares_div').show();
                                        //             $('#avgprice_div').show();

                                        //             $('#notes_div').removeClass('col-md-12');
                                        //             $('#notes_div').addClass('col-md-6');
                                        //             $('#total_rows').val(10);
                                        //             $('#action_type_list').show(); 
                                        //             $('#action_addmore').show(); 

                                        // //            $('#shares_div').removeClass('col-md-6');
                                        // //            $('#shares_div').addClass('col-md-3');
                                        // //            $('#avgprice_div').removeClass('col-md-6');
                                        // //            $('#avgprice_div').addClass('col-md-3');


                                        //             $("#symbol").attr("disabled", false);
                                        //             $("#symbol").attr("type", "text");
                                        //             $("#symbol").attr("required", true);             
                                        //             $("#Side").attr("disabled", false);
                                        //             $("#Side").attr("required", true);             
                                        //             $("#side-holder").show();
                                        //             $("#symbol-holder").show();
                                                }
                                                setVald();
                                                chgTotalComm();
                                        } else {             
                                            $("#AccountSelection").attr("required", false);
                                        }
                                        },
                                        error: function (d, e, f) {
                                        console.log(d, e, f);             }
                                });
    }
                                });
                                        $("#AccountSelection").on("select2:select", function (evt) {
                                var data = evt.params.data;
                                        $("#Commission").val(data.commission);
                                });
                                        /*$("#addTrade_form").on("change", function (e) {
                                         $("input,select,textarea").not("[type=submit]").jqBootstrapValidation('destroy');
                                         $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
                                         });*/

                                        setVald();
    };
                                        function setVald() {
                                        console.log("sv");
                                                $("input,select,textarea").not("[type=submit]").jqBootstrapValidation('destroy');
                                                $("input,select,textarea").not("[type=submit]").jqBootstrapValidation({
                                        filter: function () {
                                        return $(this).is(":visible");
                                        }
                                        });
                                        }



$(document).ready(function() {
     $(".basket").hide();
    $("#tradeType").on("change",function () {
        
        var tradeType = $("#tradeType").val();
        if(tradeType == "Single Stock")
        {
            $(".singleStock").slideDown();
            $(".basket").hide();
        }
        else
        {
            $(".singleStock").hide();
            $(".basket").slideDown();
        }

    })
})

</script>