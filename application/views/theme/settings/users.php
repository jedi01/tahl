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
        <a class="btn btn-primary" href="<?= user_url("addUser") ?>">Add User</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class=" table-responsive">
            <table class="table table-striped table-bordered serverSide-table dtr-inline table-responsive">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot><tr><th></th><th></th><th></th><th></th><th></th><th></th></tr></tfoot>
            </table>
        </div>
    </div>
</div>
<script>
    window.onload = function () {
        geTableData();
    };
    var Table;
    function geTableData() {
        Table = $('.serverSide-table').DataTable({
            'aoColumns': [{mData: "firstName"}, {mData: "lastName"}, {mData: "position"}, {mData: "email"}, {mData: "phoneNumber"}, {mData: "actions"}],
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
            'sAjaxSource': '<?= settings_url("getUsers") ?>',
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
        yadcf.init(Table, [

            {column_number: 0, filter_default_label: "Type First Name", filter_type: "text", data: []},

            {column_number: 1, filter_default_label: "Type Last Name", filter_type: "text", data: []},

            {column_number: 2, filter_default_label: "Type Position", filter_type: "text", data: []},

            {column_number: 3, filter_default_label: "Type Email", filter_type: "text", data: []},

            {column_number: 4, filter_default_label: "Type Phone", filter_type: "text", data: []}
        ], "footer");

    }
</script>