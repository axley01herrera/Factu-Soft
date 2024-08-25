<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
    <div class="mb-4 mb-md-0">
        <h4 class="fs-6 mb-0"><?php echo lang('Text.inv_t_page_title'); ?></h4>
    </div>

    <div class="d-flex align-items-center justify-content-between gap-6"></div>
</div>

<!-- Page Content -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive overflow-hidden">
                    <table id="dt-tickets" class="table text-nowrap align-middle" style="width: 100%;">
                        <thead>
                            <tr>
                                <th><?php echo lang('Text.inv_t_dt_col_number'); ?></th>
                                <th><?php echo lang('Text.inv_t_dt_col_pay_type'); ?></th>
                                <th><?php echo lang('Text.inv_t_dt_col_added'); ?></th>
                                <th><?php echo lang('Text.inv_t_dt_col_amount'); ?></th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var lang = "<?php echo $lang; ?>";
    var dtLang = "";

    if (lang == "es")
        dtLang = "<?php echo base_url('public/assets/js/dataTableLang/es.json'); ?>";
    else if (lang == "en")
        dtLang = "<?php echo base_url('public/assets/js/dataTableLang/en.json'); ?>";

    var dtTickets = $('#dt-tickets').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 10,
        language: {
            url: dtLang
        },
        buttons: [],
        ajax: {
            url: "<?php echo base_url('Invoice/processingTickets'); ?>",
            type: "POST"
        },
        order: [
            [0, 'desc']
        ],
        columns: [{
                data: 'number',
                class: 'dt-vertical-align p-2',
            }, {
                data: 'pay_type',
                class: 'dt-vertical-align p-2',
                searchable: false
            },
            {
                data: 'added',
                class: 'dt-vertical-align p-2',
            },
            {
                data: 'amount',
                class: 'dt-vertical-align p-2',
                searchable: false
            },
            {
                data: 'print',
                class: 'dt-vertical-align p-2 text-center',
                orderable: false,
                searchable: false
            }
        ],
        dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
    });
</script>