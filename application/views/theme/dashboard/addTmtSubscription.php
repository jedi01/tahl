
<style type="text/css">
.select2-results__options {
    height: 130px;
    overflow-y: auto;
}
</style>
<form class="form" action="<?= dashboard_url("TmtSubscription") ?>" method="post" novalidate id="add_tmtSubscription">
    <div class="form-body" id="body_content">
        <div class="row">
            <div class="col-md-2 col-lg-2">
                <fieldset class="form-group">
                    <label for="userinput1">Date</label>
                    <input type="text" id="userinput1" class="form-control singledate" value="" placeholder="Date" name="Date" >
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>

        <div class="col-md-2 col-lg-2">
        	<fieldset class="form-group">
        		<label for="Account">Account Name</label>
        		<select type="text" id="Account" class="form-control" style="width: 100%;" 
        		placeholder="Account Name" name="accountName">
        		<option value="" disabled="" selected="">Select Account</option>


        	</select>                    
        	<p class="help-block ClientList m-0 danger"></p>
        </fieldset>
    </div>
        <div class="col-md-2 col-lg-2">
        	<fieldset class="form-group">
        		<label for="AccountCoverage">Account Coverage</label>
        		<input type="text" required="" id="AccountCoverage" class="form-control" style="width: 100%;" 
        		placeholder="Account Coverage" name="accountCoverage">
        		                 
        	<p class="help-block ClientList m-0 danger"></p>
        </fieldset>
    </div>
    <div class="col-md-2 col-lg-2">
            	<fieldset class="form-group">
            		<label for="Payment">Payment</label>
            		<input type="text" required="" id="Payment" class="form-control" style="width: 100%;"placeholder="Payment" name="sub_payment" value="0.00">
            		
            	               
            	<p class="help-block Payment_error m-0 danger"></p>
            </fieldset>
        </div>

    <div class="col-md-4 col-lg-4">
    	<fieldset class="form-group">
    		<label for="Notes">Notes</label>
    		<textarea rows="1" class="form-control"  id="Notes" name="notes"></textarea>
    	<p class="help-block ClientList m-0 danger"></p>
    </fieldset>
</div>

            

        </div>
        <div class="form-actions right">
            <a class="btn btn-warning mr-1" href="<?= dashboard_url() ?>">
                <i class="ft-x"></i> Cancel
            </a>
            <button type="button" onclick="javascript:checkFormValid();"  class="btn btn-primary">
                <i class="fa fa-check-square-o"></i> Save
            </button>
        </div>
    </div>
</form>
<script type = "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">

	function checkFormValid() {
		   var slow_time = 0;
		   var avg_price = $("#Payment").val();
		   var v_flag = true;
			//debugger;
		if(avg_price < 0 || avg_price == 0.00){
			$(".Payment_error").html('<ul role="alert"><li>Not in the expected format.</li></ul>');
			$("#Payment").css("border-color","#981b1e");
			slow_time++;
			v_flag = false;

			if(slow_time == 1){
				$('html, body').animate({
					scrollTop: $('#Payment').offset().top - 100
				}, 'slow');
			}
		}

		if(v_flag == true){
            $('#add_tmtSubscription').submit();
        }

	}

	$(document).ready(function(){
         $('.singledate').daterangepicker({
               singleDatePicker: true,
               showDropdowns: true
           });
		    $("#Account").select2({

    //minimumInputLength: 2,
    tags: [],
    createTag: function () {
            // Disable tagging
            return null;
        },
        ajax: {
            url: '<?= dashboard_url("getAccountCoverageList") ?>',
            dataType: 'json',
            type: "POST",
            quietMillis: 50,
            data: function (term) {
                return term;
            },
            processResults: function (data) {

                return {

                    results: $.map(data, function (item) {
                        return {
                        	id: item.id, 
                        	text: item.text,
                        };

                         

                    })
                };
            }, success(e, f, d) {
                         //console.log(e);
                    },
                    error(e, f, d) {
                        console.log(e, f, d);             }
                    }
                });



		    $("#Account").on("change",function(){
		    	var coverageID = $("#Account").val();
		    	$.ajax({
		    		url: '<?= dashboard_url("getAccountCoverageByID") ?>',
		    		dataType: 'json',
		    		type: "POST",
		    		data: {coverageID:coverageID},
		    		success:function(res)
		    		{
		    			$("#AccountCoverage").val(res);
		    		}
		    	})
		    })

	})
	
</script>

