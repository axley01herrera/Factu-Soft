<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.taxs_page_title'); ?></h4>
	</div>
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6">
		<button type="button" id="btn-create-tax" class="btn btn-success"><?php echo lang('Text.btn_create_taxs'); ?></button>
	</div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12 mb-2">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive overflow-hidden">
					<table id="dt-taxs" class="table text-nowrap align-middle" style="width: 100%;">
						<thead>
							<tr>
								<th><?php echo lang('Text.taxs_dt_col_name'); ?></th>
								<th><?php echo lang('Text.taxs_dt_col_description'); ?></th>
								<th><?php echo lang('Text.taxs_dt_col_percent'); ?></th>
								<th><?php echo lang('Text.taxs_dt_col_operator'); ?></th>
								<th style="width: 75px;"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($taxs as $t) { ?>
								<tr>
									<td><?php echo $t->name; ?></td>
									<td><?php echo $t->description; ?></td>
									<td><?php if ($t->percent != 0) echo $t->percent; ?></td>
									<td><?php echo $t->operator; ?></td>
									<td class="text-end">
										<a href="#" class="btn-edit-taxs" data-taxs-id='<?php echo $t->id; ?>'>
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
												<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
												<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
											</svg>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		let lang = "<?php echo $config[0]->lang; ?>";
		let dtLang = "";

		if (lang == "es")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/es.json'); ?>";
		else if (lang == "en")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/en.json'); ?>";

		var dtTaxs = $('#dt-taxs').DataTable({
			processing: false,
			paging: false,
			language: {
				url: dtLang
			},
			columnDefs: [{
				targets: [4],
				searchable: false,
				orderable: false
			}],
			order: [
				[0, 'desc']
			],
			dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
		});

		$('#btn-create-tax').on('click', function() {
			$('#btn-create-tax').attr('disabled', true);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Taxs/createTax') ?>",
				data: "",
				dataType: "html",
				success: function(response) {
					$('#btn-create-tax').removeAttr('disabled');
					$('#app-modal').html(response);
				},
				error: function(error) {
					globalError();
				}
			});
		});
	});
</script>