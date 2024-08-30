<?php if (empty($data)) { ?>
	<div class="alert customize-alert alert-dismissible text-danger alert-light-danger bg-danger-subtle fade show remove-close-icon" role="alert">
		<span class="side-line bg-danger"></span>
		<div class="d-flex align-items-center ">
			<i class="ti ti-info-circle fs-5 me-2 flex-shrink-0 text-danger"></i>
			<span class="text-truncate"><?php echo lang('Text.reports_not_results_label'); ?></span>
		</div>
	</div>
<?php } else { ?>
	<div class="card card-flush">
		<div class="card-header d-flex align-items-center">
			<h4 class="card-title mb-0"><?php echo lang('Text.reports_search_date_label'); ?></h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="dt-reports" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
					<thead>
						<tr class="fs-4">
							<?php foreach ($data['cols'] as $c) { ?>
								<th><?php echo $c; ?></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['rows'] as $r) { ?>
							<tr>
								<?php foreach ($r as $d) { ?>
									<td><?php echo $d;?></td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>

				<script>
					$(document).ready(function() {
						let lang = "<?php echo $lang; ?>";
						let dtLang = "";

						if (lang == "es")
							dtLang = "<?php echo base_url('public/assets/js/dataTableLang/es.json'); ?>";
						else if (lang == "en")
							dtLang = "<?php echo base_url('public/assets/js/dataTableLang/en.json'); ?>";

						var dtReports = $('#dt-reports').DataTable({
							processing: true,
							paging: false,
							searching: false,
							ordering: false,
							language: {
								url: dtLang
							},
							buttons: [
								'copy', 'excel', 'csv', 'pdf'
							],
							dom: 'Bfrtip'
						});
					});
				</script>
			</div>
		</div>
	</div>
<?php } ?>
<?php var_dump($data['rows']); ?>