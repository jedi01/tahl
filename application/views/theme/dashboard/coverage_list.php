<?php
/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : May 12, 2018, 2:54:35 PM
 */
?>
<style>
    .gty{

    }
</style>
<div class="row">
    <div class="col-12 text-center">
        <a href="<?= dashboard_url('tmtAccountCoverage') ?>" class="btn btn-primary">Add Account Coverage</a>
    </div>
</div>
<div class=" table-responsive">
    <table class="table table-striped table-bordered serverSide-table">
        <thead>
            <tr>
                <th>Account Name</th>
                <th>Account Coverage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($accountCoverages)){
                    
    
                    foreach ($accountCoverages as $key => $value) { 
                        $extra = "";
                     $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . dashboard_url('delete/Coverage/').$value->id . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        // $extra = "<a href='" . user_url('edituser/$1') . "' class='btn btn-link p-0 px-1' ><i class=\"fa fa-edit\"></i></a>";
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class=\"text-center\">"
                . "<a href='" . dashboard_url('tmtAccountCoverage/').$value->id . "' class='btn btn-link p-0 px-1'><i class=\"fa fa-pencil-square-o\"></i></a>"
                . $extra
                . "</div>";
                        ?>
                       <tr>
                        <td><?=$value->accountName?></td>
                        <td><?=$value->accountCoverage;?></td>
                        <td><?=$action?></td>
                    </tr>
                   <?php }
                }
             ?>
        </tbody>        
    </table>
</div>
<script>
    window.onload = function () {
        geTableData();
    };
    function geTableData() {
        $('.serverSide-table').DataTable({
            "order": [[ 0, "desc" ]],
        });
    }
</script>
