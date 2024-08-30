<div class="table-responsive overflow-hidden">
	<table id="dt-pending-invoices" class="table text-nowrap align-middle" style="width: 100%;">
		<thead>
			<tr>
				<th><?php echo lang('Text.inv_dt_col_number'); ?></th>
				<th><?php echo lang('Text.inv_dt_col_customer'); ?></th>
				<th><?php echo lang('Text.inv_dt_col_added'); ?></th>
				<th class="text-end"><?php echo lang('Text.inv_t_dt_col_amount'); ?></th>
				<th class="text-end"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($pendingInvoices as $pi) { ?>
				<tr>
					<td><?php echo $pi->invoiceNumber; ?></td>
					<td><?php echo $pi->customerName; ?></td>
					<td><?php echo $pi->added; ?></td>
					<td class="text-end"><?php echo getMoneyFormat($config[0]->currency, $pi->amount); ?></td>
					<td class="text-end">
						<a class="me-2 pay-invoice" href="#" data-invoice-id="<?php echo $pi->invoiceID; ?>" title="<?php echo lang('Text.inv_set_paid'); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
								<path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z" />
							</svg>
						</a>
						<a class="me-2 rectify-invoice" href="#" data-invoice-id="<?php echo $pi->invoiceID; ?>" title="<?php echo lang('Text.inv_create_rec'); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-x" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708" />
								<path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
								<path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
							</svg>
						</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function() {
		let lang = "<?php echo $lang; ?>";
		let dtLang = "";

		if (lang == "es")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/es.json'); ?>";
		else if (lang == "en")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/en.json'); ?>";

		var dPendingInvoices = $('#dt-pending-invoices').DataTable({ // DATA TABLE SENT INVOICES
			processing: false,
			serverSide: false,
			pageLength: 10,
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

		dPendingInvoices.on('click', '.pay-invoice', function(e) {
			e.preventDefault();
			let invoiceID = $(this).attr('data-invoice-id');

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Invoice/payInvoiceModal'); ?>",
				data: {
					'invoiceID': invoiceID
				},
				dataType: "html",
				success: function(response) {
					$('#app-modal').html(response);
				},
				error: function(error) {
					globalError();
				}
			});
		});

		dPendingInvoices.on('click', '.rectify-invoice', function(e) {
			e.preventDefault();
			let invoiceID = $(this).attr('data-invoice-id');

			Swal.fire({
				title: '<?php echo lang('Text.rectify_inv_are_you_sure_msg'); ?>',
				text: "<?php echo lang('Text.rectify_inv_not_revert_this_msg'); ?>",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '<?php echo lang('Text.rectify_inv_yes_rectify_msg'); ?>',
				cancelButtonText: '<?php echo lang('Text.no_cancel_msg'); ?>'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "<?php echo base_url('Invoice/rectifyInvoice?id='); ?>" + invoiceID;
				}
			});

		});
	});
</script>