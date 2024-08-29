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
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="dt-reports" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
					<thead>
						<tr class="fs-4">
							<th><?php echo lang('Text.table_reports_col_date'); ?></th>
							<th><?php echo lang('Text.table_reports_col_invoice_number'); ?></th>
							<th><?php echo lang('Text.table_reports_col_invoice_concept'); ?></th>
							<th class="text-end"><?php echo lang('Text.table_reports_col_amount'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($reports as $r) { ?>
							<tr>
								<td><?php echo date('Y-m-d', strtotime($r->date)); ?></td>
								<td><?php echo $r->invoiceNumber; ?></td>
								<td>
									<?php
									$concepto = "";
									if (!empty($r->customer)) {

										if ($r->serie == 1)
											$concepto = lang('Text.simple_invoice');
										else if ($r->serie == 2)
											$concepto = lang('Text.invoice_retify');
										else if ($r->serie == 3)
											$concepto = lang('Text.invoice');
										else
											$concepto = lang('Text.invoice');

										$concepto .= ' ' . $r->customer;
									} else {
										if ($r->serie == 1)
											$concepto = lang('Text.simple_invoice');
										if ($r->serie == 2)
											$concepto = lang('Text.invoice_retify');
										if ($r->serie == 3)
											$concepto = lang('Text.invoice');
									}

									echo $concepto;

									?>
								</td>
								<td class="text-end">
									<?php echo getMoneyFormat($config[0]->currency, $r->totalAmount); ?>
								</td>
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