<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.inv_serie_page_title'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6">
		<button type="button" id="btn-create-serie" class="btn btn-success"><?php echo lang('Text.inv_create_serial'); ?></button>
	</div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive overflow-hidden">
					<table id="dt-serie" class="table text-nowrap align-middle" style="width: 100%;">
						<thead>
							<tr>
								<th><?php echo lang('Text.inv_serial_dt_col_name'); ?></th>
								<th><?php echo lang('Text.inv_serial_dt_col_serial'); ?></th>
								<th><?php echo lang('Text.inv_serial_dt_col_updated'); ?></th>
								<th><?php echo lang('Text.inv_serial_dt_col_added'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($series as $s) { ?>
								<td><?php echo $s->name; ?></td>
								<td><?php echo str_pad($s->count, 4, '0', STR_PAD_LEFT); ?></td>
								<td><?php echo $s->updated; ?></td>
								<td><?php echo $s->created; ?></td>
							<?php } ?>
						</tbody>
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

	var dtSerie = $('#dt-serie').DataTable({
		processing: true,
		pageLength: 10,
		language: {
			url: dtLang
		},
		buttons: [],
		order: [
			[3, 'desc']
		],
		
		dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
	});

	$(document).ready(function() {
		$('#btn-create-serie').on('click', function() {
			$('#btn-create-serie').attr('disabled', true);
			$.ajax({
				type: "post",
				url: "<?php echo base_url('Invoice/createSerie') ?>",
				data: "",
				dataType: "html",
				success: function(response) {
					$('#btn-create-serie').removeAttr('disabled');
					$('#app-modal').html(response);
				},
				error: function(error) {
					$('#btn-create-serie').removeAttr('disabled');
					globalError();
				}
			});
		});
	});
</script>