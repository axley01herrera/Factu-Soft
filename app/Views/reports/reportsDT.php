<?php
$cash = 0;
$card = 0;
$transfer = 0;
$total = 0;
?>
<?php if (empty($reports)) { ?>
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
			<div class="table-responsive">
				<table class="table table-row-bordered no-footer table-hover" style="width: 100%;">
					<thead>
						<tr class="fs-4">
							<th><?php echo lang('Text.table_reports_col_invoice_number'); ?> #</th>
							<th><?php echo lang('Text.table_reports_col_type'); ?></th>
							<th><?php echo lang('Text.table_reports_col_pay_type'); ?></th>
							<th><?php echo lang('Text.table_reports_col_date'); ?></th>
							<th class="text-end"><?php echo lang('Text.table_reports_col_amount'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($reports as $r) { ?>
							<tr>
								<td><?php echo $r->invoiceNumber; ?></td>
								<td>
									<?php
									if ($r->invoiceType == 1)
										echo lang('Text.reports_ticket');
									else if ($r->invoiceType == 2)
										echo lang('Text.reports_invoice');
									?>
								</td>
								<td>
									<?php
									if ($r->payType == 1) {
										echo lang('Text.card');
										$card += $r->totalAmount;
									} else if ($r->payType == 2) {
										echo lang('Text.cash');
										$cash += $r->totalAmount;
									} else if ($r->payType == 3 || empty($r->payType)) {
										echo lang('Text.transfer');
										$transfer += $r->totalAmount;
									}
									?>
								</td>
								<td><?php echo $r->date; ?></td>
								<td class="text-end">
									<?php echo getMoneyFormat($config[0]->currency, $r->totalAmount); ?>
								</td>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="5" class="text-end">
								<span>Tarjeta: <?php echo getMoneyFormat($config[0]->currency, $card); ?></span>
								<br>
								<span>Efectivo: <?php echo getMoneyFormat($config[0]->currency, $cash); ?></span>
								<br>
								<span>Transferencia: <?php echo getMoneyFormat($config[0]->currency, $transfer); ?></span>
								<br>
								<span>Total: <?php echo getMoneyFormat($config[0]->currency, $transfer + $cash + $card); ?></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php } ?>