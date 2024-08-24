<?php $total = 0; ?>
<div class="scroll-container">
	<?php if (empty($items)) { ?>
		<div class="text-center ">
			<h1 class="text-danger"><?php echo lang('Text.tpv_empty_basket'); ?></h1>
		</div>
	<?php } else { ?>
		<table class="table">
			<tbody>
				<?php
				foreach ($items as $item) {
					$total = $total + $item->amount; ?>
					<tr>
						<td class="dt-vertical-align p-2 fs-4">
							<?php echo getService($item->service_id)[0]->name; ?>
						</td>
					</tr>

					<tr style="border-bottom: 1px;">
						<td class="dt-vertical-align p-2 fs-7 text-primary">
							<div class="row d-flex align-items-center">
								<div class="col-4 ms-auto d-flex align-items-center">
									<a href="#" class="edit-price pe-4" data-invoice-items-id="<?php echo $item->id; ?>" data-service-info="<?php echo getService($item->service_id)[0]->name . ' (' . getMoneyFormat($config[0]->currency, $item->amount) . ')'; ?>"><i class="fas fa-pen-square text-warning fs-5"></i></a>
									<a href="#" class="delete-service pe-4" data-invoice-items-id="<?php echo $item->id; ?>" data-service-id="<?php echo $item->service_id; ?>"><i class="fas fa-trash text-danger fs-5"></i></a>
								</div>
								<div class="col-4 ms-auto">
									<div class="position-relative d-flex align-items-center" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="10" data-kt-dialer-step="1" data-kt-dialer-decimals="0">
										<button type="button" class="btn btn-icon btn-sm btn-quantity btn-light btn-icon-gray-400 w-30px h-30px" data-kt-dialer-control="rest" data-invoice-items-id="<?php echo $item->id; ?>" data-quantity="<?php echo $item->quantity; ?>" data-service-id="<?php echo $item->service_id; ?>" data-amount="<?php echo $item->amount; ?>">
											<i class="fas fa-minus fs-1"></i>
										</button>
										<input type="text" class="form-control border-0 text-center px-0 fs-5 fw-bold text-gray-800 w-30px" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="<?php echo $item->quantity; ?>">
										<button type="button" class="btn btn-icon btn-sm btn-quantity btn-light btn-icon-gray-400 w-30px h-30px" data-kt-dialer-control="add" data-invoice-items-id="<?php echo $item->id; ?>" data-quantity="<?php echo $item->quantity; ?>" data-service-id="<?php echo $item->service_id; ?>" data-amount="<?php echo $item->amount; ?>">
											<i class="fa fa-plus fs-1"></i>
										</button>
									</div>
								</div>
								<div class="col-4 text-end">
									<span class="text-black fs-7">
										<?php echo getMoneyFormat($config[0]->currency, $item->amount); ?>
									</span>
								</div>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>
</div>

<script>
	$('#total-price').html("<?php echo getMoneyFormat($config[0]->currency, $total); ?>");

	var totalPrice = "<?php echo @$total; ?>";
	basket = "<?php echo sizeof($items); ?>"

	$('.edit-price').on('click', function(e) {
		e.preventDefault();
		let invoiceItemsID = $(this).attr('data-invoice-items-id');
		let serviceInfo = $(this).attr('data-service-info');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('TPV/editPriceTPV') ?>",
			data: {
				'invoiceItemsID': invoiceItemsID,
				'serviceInfo': serviceInfo
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

	$('.delete-service').on('click', function(e) {
		e.preventDefault();
		let invoiceItemsID = $(this).attr('data-invoice-items-id');

		Swal.fire({
			title: '<?php echo lang('Text.are_you_sure_msg'); ?>',
			text: "<?php echo lang('Text.not_revert_this_msg'); ?>",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: '<?php echo lang('Text.yes_remove_msg'); ?>',
			cancelButtonText: '<?php echo lang('Text.no_cancel_msg'); ?>'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url('TPV/removeInvoiceItem'); ?>",
					data: {
						'id': invoiceItemsID
					},
					dataType: "json",
					success: function(response) {
						if (response.error == 0)
							getItems();
						else if (response.error == 2)
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

	$('.btn-quantity').on('click', function() {
		let action = $(this).attr('data-kt-dialer-control');
		let invoiceItemsID = $(this).attr('data-invoice-items-id');
		let quantity = $(this).attr('data-quantity');
		let serviceID = $(this).attr('data-service-id');
		let currentAmount = $(this).attr('data-amount');
		let newQuantity = 0;

		if (action == 'add')
			newQuantity = parseInt(quantity) + 1;

		if (action == 'rest') {
			if (quantity > 1) {
				newQuantity = parseInt(quantity) - 1;
			} else {
				Swal.fire({
					title: '<?php echo lang('Text.are_you_sure_msg'); ?>',
					text: "<?php echo lang('Text.not_revert_this_msg'); ?>",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: '<?php echo lang('Text.yes_remove_msg'); ?>',
					cancelButtonText: '<?php echo lang('Text.no_cancel_msg'); ?>'
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							type: "post",
							url: "<?php echo base_url('TPV/removeInvoiceItem'); ?>",
							data: {
								'id': invoiceItemsID
							},
							dataType: "json",
							success: function(response) {
								if (response.error == 0)
									getItems();
								else if (response.error == 2)
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
			}
		}

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('TPV/changeQuantity'); ?>",
			data: {
				'invoiceItemsID': invoiceItemsID,
				'quantity': newQuantity,
				'serviceID': serviceID,
				'currentAmount': currentAmount,
				'action': action
			},
			dataType: "json",
			success: function(response) {
				if (response.error == 0)
					getItems();
				else if (response.error == 2)
					window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
				else if (response.error == 1)
					globalError();
			},
			error: function(error) {
				globalError();
			}
		});
	});
</script>