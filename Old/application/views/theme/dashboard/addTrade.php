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
<form class="form" action="<?= dashboard_url("addTrade") ?>" method="post" novalidate id="addTrade_form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="userinput1">Date</label>
                    <input type="text" id="userinput1" class="form-control  <?= $currentUser->position == USER_TRADER ? "" : "todayDate" ?>" 
                           readonly="" value="<?= date("d M, Y")?>"
                           required placeholder="Date" name="Date" >
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="ClientList">Client List</label>
                    <select type="text" id="ClientList" class="form-control" style="width: 100%;" required
                            placeholder="Client" name="Client">
                        <option value=""></option>
                    </select>                    
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="AccountSelection">Account Selection</label>
                    <select type="text" id="AccountSelection" class="form-control" style="width: 100%;"
                            placeholder="Account Selection" name="AccountSelection">
                        <option value="0"></option>
                    </select>                    
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="Commission">Commission</label>
                    <input type="text" id="Commission" class="form-control" style="width: 100%;" onchange="chgTotalComm()"
                           pattern="^\$?[\d,]*.[\d]{0,5}$"
                           data-validation-pattern-message="Up to 5 places decimal point"
                           placeholder="Commission" name="Commission">
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <fieldset class="form-group">
                    <label for="tradeType">Trade Type </label>
                    <select class="form-control" id="tradeType" style="width: 100%;"
                            placeholder="Trade Type" name="TradeType">
                        <option>Single Stock</option>
                        <option>Basket</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col" id="side-holder">
                <fieldset class="form-group">
                    <label for="Side">Side </label>
                    <select class="form-control" id="Side" style="width: 100%;"
                            placeholder="Side" name="Side">
                        <option>Buy</option>
                        <option>Sell</option>
                        <option>Sell Short</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>

            <div class="col" id="symbol-holder">
                <fieldset class="form-group">
                    <label for="symbol">Symbol</label>
                    <input class="form-control" id="symbol" style="width: 100%;"  required=""
                           placeholder="Symbol" name="Symbol">                        
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="Shares">Shares</label>
                    <input class="form-control" id="Shares" style="width: 100%;" required type="text" value="0"
                           pattern="^(?=.*[1-9])\d*$"
                           data-validation-pattern-message="Has to be a positive integer greater than 0"
                           placeholder="Shares" name="Shares">                        
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="AveragePrice">Average Price</label>
                    <input class="form-control" id="AveragePrice" style="width: 100%;" required type="text" value="0.00"
                           pattern="^(?=.*[1-9])\d*(?:\.\d{1,5})?$"
                           data-validation-pattern-message="Up to 5 places decimal point and greater than 0"
                           placeholder="Average Price" name="AveragePrice">                        
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="TotalCommission">Total Commission</label>
                    <input class="form-control" id="TotalCommission" style="width: 100%;" readonly
                           placeholder="Total Commission" name="TotalCommission">                        
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>


            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="SoftDollars">Soft Dollars</label>
                    <input class="form-control" id="SoftDollars" style="width: 100%;" value="0"
                           pattern="^(?=.*[0-9])\d*$"
                           data-validation-pattern-message="Has to be zero or positive number"
                           placeholder="Soft Dollars" name="SoftDollars">       
                    <p class="help-block m-0 danger">                    
                    </p>
                    <p class="m-0 danger" id="softDollHelp">    
                        Soft Dollars can't be greater than Total Commission
                    </p>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="NetCommission">Net Commission</label>
                    <input class="form-control" id="NetCommission" style="width: 100%;"
                           readonly
                           placeholder="Net Commission" name="NetCommission">                        
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6">
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
                               pattern="^\$?[\d,]*[.]*[\d]*$"
                               data-validation-pattern-message="Only Number"
                               style=" -ms-flex-preferred-size: 0;  flex-basis: 0;
                               -ms-flex-positive: 1;  flex-grow: 1;  max-width: 100%;">
                    </div>
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label for="PotentialReferral">Potential Referral</label>
                    <select class="form-control  select2-dopdown" id="PotentialReferral" style="width: 100%;" multiple required
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
            <div class="col-md-12">
                <fieldset class="form-group">
                    <label>Notes</label>
                    <textarea placeholder="Notes" class="form-control" name="Notes" rows="4"></textarea>
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>




        </div>


        <div class="form-actions right">
            <a class="btn btn-warning mr-1" href="<?= dashboard_url() ?>">
                <i class="ft-x"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-check-square-o"></i> Save
            </button>
        </div>
    </div>
</form>
<script>
    var acc;
    function chgTotalComm() {
        var share = parseFloat($("#Shares").val().toString().replace(",", ""));
        var comm = parseFloat($("#Commission").val().toString().replace(",", ""));
        var softDoll = parseFloat($("#SoftDollars").val().toString().replace(",", ""));
        if ($.isNumeric(share) && $.isNumeric(comm)) {
            var shLen = parseInt($("#Shares").val().toString().split('.')[1] ? $("#Shares").val().toString().split('.')[1].length : 0);
            var cLen = parseInt($("#Commission").val().toString().split('.')[1] ? $("#Commission").val().toString().split('.')[1].length : 0);
            var tolen = shLen >= cLen ? shLen : cLen;
            $("#TotalCommission").val(parseFloat(share * comm).toFixed(tolen));
            var sLen = parseInt(softDoll.toString().split('.')[1] ? softDoll.toString().split('.')[1].length : 0);
            var tLen = parseInt($("#TotalCommission").val().toString().split('.')[1] ? $("#TotalCommission").val().toString().split('.')[1].length : 0);
            var len = sLen >= tLen ? sLen : tLen;
            if ($.isNumeric(softDoll)) {
                $("#NetCommission").val(parseFloat($("#TotalCommission").val() - softDoll).toFixed(len));
            } else {
                $("#NetCommission").val("");
            }
        } else {
            $("#NetCommission").val("");
            $("#TotalCommission").val("");
        }
        var softDoll = parseFloat($("#SoftDollars").val());
        var totalComm = parseFloat($("#TotalCommission").val());
        if (softDoll > totalComm) {
            //console.log("Soft Dollars can't be greater than Total Commission");
            //$("#softDollHelp").html("");
            $("#softDollHelp").show();
        } else {
            //$("#softDollHelp").html("");
            $("#softDollHelp").hide();
        }

    }
    window.onload = function (event) {
        'use strict';
        $("#softDollHelp").hide();
        $("#Shares").keyup(function (e) {
            // $(this).val(format($(this).val()));
        });
        $(".select2-dopdown").select2();
        $("#Shares").on("keyup", function (e) {
            chgTotalComm();
        });
        $("#Commission").on("keyup", function (e) {
            chgTotalComm();
        });
        $("#Commission").on("change", function (e) {
            chgTotalComm();
        });
        $("#SoftDollars").on("keyup", function (e) {
            var softDoll = parseFloat($("#SoftDollars").val().toString().replace(",", ""));
            var totalComm = parseFloat($("#TotalCommission").val().toString().replace(",", ""));
            if ($.isNumeric(softDoll) && $.isNumeric(totalComm)) {
                var sLen = parseInt(softDoll.toString().split('.')[1] ? softDoll.toString().split('.')[1].length : 0);
                var tLen = parseInt(totalComm.toString().split('.')[1] ? totalComm.toString().split('.')[1].length : 0);
                var len = sLen >= tLen ? sLen : tLen;
                $("#NetCommission").val(parseFloat(totalComm - softDoll).toFixed(len));
            } else {
                $("#NetCommission").val("");
            }
            chgTotalComm();
        });
        $("#fr").hide();
        $('input[name="allocationToFR"]').on("change", function (e) {

            if ($('input[name="allocationToFR"]:checked').val() == "Yes") {
                $("#fr").show();
                $("#fr").attr("required", true);
                $("#fr").val("");
            } else {
                $("#fr").hide();
                $("#fr").attr("required", false);
                $("#fr").val(0);
            }
            setVald();
        });
        $("#tradeType").on("change", function (e) {
            var tradeValue = $("#tradeType").val();
            if ("Basket" == tradeValue) {
                $("#symbol").attr("disabled", true);
                $("#symbol").removeAttr("required");
                $("#symbol").attr("type", "hidden");
                $("#Side").attr("disabled", true);
                $("#Side").attr("required", false);
                $("#side-holder").hide();
                $("#symbol-holder").hide();
            } else {
                $("#symbol").attr("disabled", false);
                $("#symbol").attr("type", "text");
                $("#symbol").attr("required", true);
                $("#Side").attr("disabled", false);
                $("#Side").attr("required", true);
                $("#side-holder").show();
                $("#symbol-holder").show();

            }
            setVald();

        });
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
                    console.log(e, f, d);
                }
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
                    console.log(er, f, d);
                }
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
                        if (dat.length) {
                            $("#AccountSelection").html("<option value='" + dat[0].id + "'>" + dat[0].text + "</option>")
                            acc.select2("data", dat[0]);
                            $("#AccountSelection").attr("required", true);
                            $("#Commission").val(dat[0].commission);
                            chgTotalComm();
                        } else {
                            $("#AccountSelection").attr("required", false);
                        }
                    },
                    error: function (d, e, f) {
                        console.log(d, e, f);
                    }
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
</script>