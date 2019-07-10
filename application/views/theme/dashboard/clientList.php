<?php
/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : May 12, 2018, 2:54:35 PM
 */
$userList = [];
if ($users) {
    foreach ($users as $us) {
        array_push($userList, ["value" => $us->id, "label" => $us->firstName . " " . $us->lastName]);
    }
}
#echo "<pre>";
#print_r(TAB_ClientList);
#exit;
$userList = json_encode($userList);
?>
<style>
    .gty{

    }
</style>
<div class="row">
    <div class="col-12 text-center">
        <!--<button class="btn btn-primary" modal-toggler="true" data-target="#remoteModal1" data-remote="<?= settings_url("newClient") ?>">Add Client</button> -->
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class=" table-responsive">
            <table class="table table-striped table-bordered serverSide-table">
                <thead>
                    <tr>            

                        <th>Trader</th>
                        <th>Client</th>
                        <th>Account</th>                
                        <th>Commission</th>                
                        <th>Default Trade Type</th> 
                        <th>Grouping</th>  
                         <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              <tfoot>
                    <tr>
                        <th class="py-1 px-0"></th><th></th><th></th><th></th><th></th>
                    </tr>
                </tfoot> 
            </table>
        </div>
    </div>
</div>
<!-- ALTER TABLE `users` ADD `default_tradeType` VARCHAR(200) NOT NULL DEFAULT 'single stock' AFTER `position`;  -->
<script>
    window.onload = function () {
        geTableData();
    };
    var Table;
    function geTableData() {
        Table = $('.serverSide-table').DataTable({
            'aoColumns': [{mData: "traderID"}, {mData: "clientName"}, {mData: "accountName"}, {mData: "commission"},{mData: "default_tradeType"},{ mData: "grouping"},{mData: "actions", bSortable: false}],
            "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "all"]],
            "iDisplayLength": 25,
            'bProcessing': true,
            "language": {
                buttons: {
                    selectAll: "Select all",
                    selectNone: "Select none"
                },
                processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>'
            },
            'bServerSide': true,
            'sAjaxSource': '<?= base_url("Dashboard/getClientsListTable") ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                $.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': function (d, e, f) {
                        console.log(f);
                        fnCallback(d, e, f);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        if (jqXHR.jqXHRstatusText)
                            alert(jqXHR.jqXHRstatusText);
                    }
                });
            },
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                // console.log(nRow);
            },
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            //dom: '<"top"B<"pull-right"l>>rtip',
            //dom: 'Blfrtip',
            buttons: [
                {
                    text: 'Select all',
                    action: function () {
                        Table.rows().select();
                    }
                },
                {
                    text: 'Select none',
                    action: function () {
                        Table.rows().deselect();
                    }
                }
            ]
        });

<?php 
 if ($_SESSION["user"]->position == USER_ADMIN_EDITOR) { ?>
     
        yadcf.init(Table, [{data: <?= $userList ?>,
                column_number: 0, filter_type: "select", filter_default_label: "Select Trader",
                select_type_options: {
                    width: '180px',
                    dropdownAutoWidth: true
                }},
            {column_number: 1, filter_default_label: "Type here..", filter_type: "text"},
            {column_number: 2, filter_default_label: "Type here..", filter_type: "text"},
            {column_number: 3, filter_default_label: "Type here..", filter_type: "text"},
           {column_number: 4, filter_default_label: "Type here..", filter_type: "text"}
        ], "footer");
<?php } ?>
    }
</script>