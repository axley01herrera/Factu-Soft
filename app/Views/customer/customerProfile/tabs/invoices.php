<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<div class="card shadow-none border">
	<div class="card-body">
		<div class="table-responsive">
			<table id="dt-invoice" class="table text-nowrap align-middle" style="width: 100%;">
				<thead>
					<tr>
						<th><?php echo lang('Text.inv_dt_col_status'); ?></th>
						<th><?php echo lang('Text.inv_dt_col_number'); ?></th>
						<th class="text-center"><?php echo lang('Text.inv_dt_col_added'); ?></th>
						<th class="text-end"><?php echo lang('Text.inv_t_dt_col_amount'); ?></th>
						<th class="text-end"></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		let lang = "<?php echo $lang; ?>";
		let dtLang = "";

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
				url: "<?php echo base_url('Customer/processingInvoice'); ?>",
				type: "POST",
				data: function(d) {
					d.customerID = "<?php echo $customer[0]->id; ?>"
				}
			},
			order: [
				[2, 'desc']
			],
			columns: [{
					data: 'status',
					class: 'dt-vertical-align p-2',
				},
				{
					data: 'number',
					class: 'dt-vertical-align p-2',
					searchable: false
				},
				{
					data: 'added',
					class: 'dt-vertical-align p-2 text-center',
				},
				{
					data: 'amount',
					class: 'dt-vertical-align p-2',
					class: "text-end",
					orderable: false,
					searchable: false
				},
				{
					data: 'action',
					class: 'dt-vertical-align p-2 text-end',
					orderable: false,
					searchable: false
				}
			],
			dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
		});

		dtInvoice.on('click', '.delete-invoice', function(e) {
			e.preventDefault();
			let invoiceID = $(this).attr('data-invoice-id');

			Swal.fire({
				title: '<?php echo lang('Text.are_you_sure_msg'); ?>',
				text: "<?php echo lang('Text.not_revert_this_msg'); ?>",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '<?php echo lang('Text.yes_remove_msg'); ?>',
				cancelButtonText: '<?php echo lang('Text.no_cancel_msg'); ?>'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('Invoice/deleteInvoice'); ?>",
						data: {
							'id': invoiceID
						},
						dataType: "json",
						success: function(response) {
							if (response.error == 0) {
								dtInvoice.draw();
							} else if (response.error == 2)
								window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
							else
								globalError();

						},
						error: function(error) {
							globalError();
						}
					});
				}
			});
		});

		dtInvoice.on('click', '.pay-invoice', function(e) {
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

		dtInvoice.on('click', '.rectify-invoice', function(e) {
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