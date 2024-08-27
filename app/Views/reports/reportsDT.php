<?php if (empty($reports)) { ?>
	<div class="alert alert-dismissible bg-light-danger d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10 border-dashed border-danger">
		<i class="ki-duotone ki-information-5 fs-5tx text-danger mb-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
		<div class="text-center">
			<h5 class="fw-bold mb-5"><?php echo lang('Text.cp_reports_not_results_label'); ?></h5>
			<div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
			<div class="mb-9 text-gray-900">
				<?php echo lang('Text.cp_reports_not_reports_label'); ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="card card-flush mt-10">
		<div class="card-header">
			<div class="card-title">
				<h5><?php echo lang('Text.cp_reports_search_date_label'); ?></h5>
				<h5 id="date-label" class="ms-1"></h5>
			</div>
			<div class="card-toolbar">
				<a href="#" id="btn-print" class="btn btn-sm btn-secondary ms-5"><i class="bi bi-printer me-1"></i><?php echo lang('Text.btn_print'); ?></a>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="dt-print" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
					<thead>
						<tr class="fs-7">
							<th class="p-2"><?php echo lang('Text.table_reports_col_id'); ?></th>
							<th class="p-2"><?php echo lang('Text.table_reports_col_date'); ?></th>
							<th class="p-2"><?php echo lang('Text.table_reports_col_payType'); ?></th>
							<th class="text-end p-2"><?php echo lang('Text.table_reports_col_price'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$totalAmount = 0;
						foreach ($reports as $r) {
							$totalAmount = $totalAmount + $r->amount; ?>
							<tr>
								<td class="p-2"><?php echo $r->title; ?></td>
								<td class="p-2"><?php echo date('d-m-Y G:i a', strtotime($r->dateTime)); ?></td>
								<td class="p-2">
									<?php
									if ($r->payType == 1)
										echo '<span class="badge badge-success">' . lang('Text.cash_label') . '</span>';
									else if ($r->payType == 2)
										echo '<span class="badge badge-primary">' . lang('Text.credit_card_label') . '</span>';
									?>
								</td>
								<td class="text-end p-2"><?php echo getMoneyFormat($config[0]->currency, $r->totalAmount); ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="text-end">
				<p class="fw-bold fs-2 mb-0"><?php echo lang('Text.cp_invoices_print_total'); ?>: <?php echo getMoneyFormat($config[0]->currency, $totalAmount) ?></p>
			</div>
		</div>
	</div>
<?php } ?>

<script>
	$('#btn-print').click(function(e) {
		e.preventDefault();
		var url = "<?php echo base_url('Reports/printReport?customerIDS='); ?>" + customerIDS + '&date=' + date + '&dateReport=' + dateReport;
		window.open(url, '_blank');
	});
</script>