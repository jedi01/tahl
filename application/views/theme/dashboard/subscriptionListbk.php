<?php
/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : May 12, 2018, 2:54:35 PM
 */
$columns = ["Date","accountName","accountCoverage","sub_payment","notes"];
?>
<style>
    .gty{

    }
</style>
<div class=" table-responsive">
    <table class="table table-striped table-bordered serverSide-table">
        <thead>
            <tr>
                <?php
                $mColumns = [];
                foreach ($columns as $column) {
                    $mColumns[] = ["mData" => $column];
                    ?>
                    <th><?= $column ?><br></th>
                    <?php
                }

                if ($_SESSION["user"]->position === USER_ADMIN_EDITOR) {
    
                    $mColumns[] = ["mData" => "actions", "bSortable" => false];
                }
                    ?>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>        
    </table>
</div>
<script>
    window.onload = function () {
        geTableData();
    };
    var Table;
    function geTableData() {
        Table = $('.serverSide-table').DataTable({
            "order": [[ 0, "desc" ]],
            'aoColumns': <?= json_encode($mColumns) ?>,
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
            'sAjaxSource': '<?= dashboard_url("getSubscriptionListTable") ?>',
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
                console.log(nRow);
            },
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            dom: '<"top"B<"pull-right"l>>rtip',
            buttons: ['colvis',
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                     
                        {
                            extend: 'excel',
                            text: 'Export as Excel [All]',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excel',
                            text: 'Export as Excel [Selected]',
                            exportOptions: {
                                columns: ':visible',
                                modifier: {
                                    selected: true
                                }
                            },
                        }
                 
                    ]
                },
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
        yadcf.init(Table, [], "header");

    }
</script>
