<?php
/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : May 12, 2018, 2:54:35 PM
 */
# echo "<pre>";
# print_r($TraderList);
# exit;

 
$columns = ["Date", "Client", "AccountSelection", "Commission", "CommissionEdited", "TradeType", "Side", "Symbol", "Shares", "AveragePrice", "TotalCommission", "SoftDollars", "NetCommission", "Notes"];
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
                    $mColumns[] = ["mData" => "TraderID"];
                    ?> <th>Trader<br></th><?php
                    }
                    $mColumns[] = ["mData" => "actions", "bSortable" => false];
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
            aoColumnDefs: [{
                    "render": function (data, type, row) {
                        return moment(data, "YYYY-MM-DD").format("DD MMM, YYYY");
                    },
                    "targets": 0
                }],
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
            'sAjaxSource': '<?= dashboard_url("getTrades") ?>',
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
                      /*  {
                            extend: 'csv',
                            text: 'Export as Csv [All]',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'csv',
                            text: 'Export as Csv [Selected]',
                            exportOptions: {
                                columns: ':visible',
                                modifier: {
                                    selected: true
                                }
                            },
                        },*/
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
                        }/*,
                        {
                            extend: 'pdf',
                            text: 'Export as PDF [All]',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdf',
                            text: 'Export as PDF [Selected]',
                            exportOptions: {
                                columns: ':visible',
                                modifier: {
                                    selected: true
                                }
                            },
                        },
                        {
                            extend: 'print',
                            text: 'Print [All]',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Print [Selected]',
                            exportOptions: {
                                columns: ':visible',
                                modifier: {
                                    selected: true
                                }
                            },
                        }*/
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
        yadcf.init(Table, [
<?php
if ($_SESSION["user"]->position === USER_ADMIN_EDITOR) {
    echo ' {column_number: 17, filter_default_label: "All Trader", data: ' . json_encode($TraderList) . ', filter_type: "select", filter_reset_button_text: "<i class=\"fa fa-close\"></i>"            }, ';
}
?>
            {column_number: 0, filter_default_label: ["From Date", "End Date"],
                filter_type: "range_date",
                date_format: 'dd M, yyyy',
                filter_delay: 500,
                filter_reset_button_text: "<i class='fa fa-close'></i>",
                filter_plugin_options: {
                    changeMonth: true,
                    changeYear: true
                }
            },
            {column_number: 1, filter_default_label: "All Client",
                data: <?= json_encode($clientList) ?>,
                filter_type: "select", filter_reset_button_text: "<i class='fa fa-close'></i>"
            },
            {column_number: 2, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 3, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 4, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 5, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 6, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 7, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 8, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 9, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 10, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 11, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 12, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 13, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 14, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 15, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"},
            {column_number: 16, filter_default_label: "Type here...", filter_type: "text", filter_reset_button_text: "<i class='fa fa-close'></i>"}

        ], "header");

    }
</script>
