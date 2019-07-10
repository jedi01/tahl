<?php if(isset($coverage)){ } ?>
<style type="text/css">
.select2-results__options {
    height: 130px;
    overflow-y: auto;
}
</style>
<form class="form" action="<?= dashboard_url("tmtAccountCoverage") ?>" method="post" novalidate id="tmtAccountCoverage">
    <div class="form-body" id="body_content">
        <div class="row">
         
            <div class="col-md-6 col-lg-6">
            	<fieldset class="form-group">
            		<label for="Account">Account Name</label>
            		<input type="text" required="" id="Account" class="form-control" style="width: 100%;"placeholder="Account Name" value="<?php if(isset($coverage)){ echo $coverage->accountName; } ?>" name="accountName">
            		
            	               
            	<p class="help-block AccountSelection m-0 danger"></p>
            </fieldset>
        </div>
        <div class="col-md-6 col-lg-6">
        	<fieldset class="form-group">
        		<label for="AccountCoverage">Account Coverage</label>
        		<input type="text" required="" id="AccountCoverage" class="form-control" style="width: 100%;"placeholder="Account Coverage" value="<?php if(isset($coverage)){ echo $coverage->accountCoverage; } ?>" name="accountCoverage">
                             
        	<p class="help-block ClientList m-0 danger"></p>
        </fieldset>
    </div>
    <?php if(isset($coverage)){ ?>
        <input type="hidden" name="id" value="<?php echo $coverage->id; ?>">
    <?php } ?>
   
            

        </div>
        <div class="form-actions right">
            <a class="btn btn-warning mr-1" href="<?= dashboard_url() ?>">
                <i class="ft-x"></i> Cancel
            </a>
            <button type="submit"  class="btn btn-primary">
                <i class="fa fa-check-square-o"></i> <?php if(isset($coverage)){ echo "Update"; }else{ echo "Save"; } ?>
            </button>
        </div>
    </div>
</form>

