<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.inv_page_title'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6"></div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive overflow-hidden">
					<table id="dt-invoices" class="table text-nowrap align-middle" style="width: 100%;">
						<thead>
							<tr>
								<th style="width: 100px;"><?php echo lang('Text.invoices_dt_col_invoiceStatus'); ?></th>
								<th><?php echo lang('Text.invoices_dt_col_invoiceID'); ?></th>
								<th><?php echo lang('Text.invoices_dt_col_invoiceNumber'); ?></th>
								<th><?php echo lang('Text.invoices_dt_col_created'); ?></th>
								<th><?php echo lang('Text.invoices_dt_col_due_date'); ?></th>
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

	var dtInvoices = $('#dt-invoices').DataTable({
		processing: true,
		serverSide: true,
		pageLength: 10,
		language: {
			url: dtLang
		},
		buttons: [],
		ajax: {
			url: "<?php echo base_url('Invoice/processingInvoices'); ?>",
			type: "POST"
		},
		order: [
			[1, 'desc']
		],
		columns: [{
				data: 'invoiceStatus',
				class: 'dt-vertical-align p-2',
			},
			{
				data: 'invoiceID',
				class: 'dt-vertical-align p-2',
				searchable: false
			},
			{
				data: 'invoiceNumber',
				class: 'dt-vertical-align p-2',
			},
			{
				data: 'created',
				class: 'dt-vertical-align p-2'
			},
			{
				data: 'due_date',
				class: 'dt-vertical-align p-2',
			},
		],
		dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
	});
</script>