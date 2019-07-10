
<style>
    .gty{

    }
</style>
<div class=" table-responsive">
    <table class="table table-striped table-bordered serverSide-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Account Name</th>
                <th>Coverage</th>
                <th>Payment</th>
                <th>Notes</th>
        
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($tmtSub)){
                    foreach ($tmtSub as $key => $value) { ?>
                      <tr>
                            <td><?=$value->Date?></td>
                            <td><?=$value->accountName?></td>
                            <td><?=$value->accountCoverage?></td>
                            <td><?="$".number_format((float)$value->sub_payment, 2, '.', '')?></td>
                            <td><?=$value->notes?></td>
                            
                                
                                
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
                
               
            ]
        });

    }
</script>

