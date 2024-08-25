<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.inv_page_title'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6">
		<a href="<?php echo base_url('Invoice/createInvoice'); ?>" class="btn btn-success"><?php echo lang('Text.inv_create'); ?></a>
	</div>
</div>

<!-- Page Content -->
<div class="card">
	<div class="card-body">
		<div class="table-responsive overflow-hidden">
			<table id="dt-invoice" class="table text-nowrap align-middle" style="width: 100%;">
				<thead>
					<tr>
						<th><?php echo lang('Text.inv_dt_col_status'); ?></th>
						<th><?php echo lang('Text.inv_dt_col_number'); ?></th>
						<th><?php echo lang('Text.inv_dt_col_added'); ?></th>
						<th><?php echo lang('Text.inv_t_dt_col_amount'); ?></th>
						<th class="text-center"></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var lang = "<?php echo $lang; ?>";
		var dtLang = "";

		if (lang == "es")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/es.json'); ?>";
		else if (lang == "en")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/en.json'); ?>";

		var dtInvoice = $('#dt-invoice').DataTable({
			processing: true,
			serverSide: true,
			pageLength: 10,
			language: {
				url: dtLang
			},
			buttons: [],
			ajax: {
				url: "<?php echo base_url('Invoice/processingInvoice'); ?>",
				type: "POST"
			},
			order: [
				[2, 'desc']
			],
			columns: [{
					data: 'status',
					class: 'dt-vertical-align p-2',
				}, {
					data: 'number',
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
					data: 'action',
					class: 'dt-vertical-align p-2 text-center',
					orderable: false,
					searchable: false
				}
			],
			dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
		});
	});
</script>