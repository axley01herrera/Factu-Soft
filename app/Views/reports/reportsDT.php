<?php if (empty($reports)) { ?>
	<div class="alert customize-alert alert-dismissible text-danger alert-light-danger bg-danger-subtle fade show remove-close-icon" role="alert">
		<span class="side-line bg-danger"></span>
		<div class="d-flex align-items-center ">
			<i class="ti ti-info-circle fs-5 me-2 flex-shrink-0 text-danger"></i>
			<span class="text-truncate"><?php echo lang('Text.reports_not_results_label'); ?></span>
		</div>
	</div>
<?php } else { ?>
	<div class="card card-flush mt-10">
		<div class="card-header d-flex align-items-center">
			<h4 class="card-title mb-0"><?php echo lang('Text.reports_search_date_label') . '<span class="ms-1 fst-italic fs-4">( ' . sizeof($reports) . ' )</span>'; ?></h4>
			<div class="card-actions cursor-pointer ms-auto d-flex button-group">
				<button type="button" id="btn-print" class="btn btn-muted">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer me-1" viewBox="0 0 16 16">
						<path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"></path>
						<path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"></path>
					</svg>
					<?php echo lang('Text.btn_print'); ?>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div id="print" class="table-responsive">
				<table id="dt-print" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
					<thead>
						<tr class="fs-4">
							<th class="p-2"><?php echo lang('Text.table_reports_col_invoice_number'); ?></th>
							<th class="p-2"><?php echo lang('Text.table_reports_col_customer_name'); ?></th>
							<th class="p-2"><?php echo lang('Text.table_reports_col_date'); ?></th>
							<th class="text-end p-2"><?php echo lang('Text.table_reports_col_amount'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$totalAmount = 0;
						foreach ($reports as $r) {
							$totalAmount = $totalAmount + $r->amount; ?>
							<tr>
								<td class="p-2"><?php echo $r->invoiceNumber; ?></td>
								<td class="p-2"><?php echo $r->customerName; ?></td>
								<td class="p-2"><?php echo $r->added; ?></td>
								<td class="text-end p-2"><?php echo getMoneyFormat($config[0]->currency, $r->amount); ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="text-end">
					<p class="fw-bold fs-6 mb-0"><?php echo lang('Text.report_print_total'); ?>: <?php echo getMoneyFormat($config[0]->currency, $totalAmount); ?></p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<script>
	$('#btn-print').on('click', function() {
		var printContent = $('#print').html();
		var printWindow = window.open('', '_blank');
		printWindow.document.write(printContent);
		printWindow.document.close();
		printWindow.print();
	});
</script>