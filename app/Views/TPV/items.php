<?php
$baseImponible = 0;
?>
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
					$baseImponible += $item->amount;
				?>

					<tr>
						<td class="dt-vertical-align p-2 fs-4">
							<?php echo getService($item->service_id)[0]->name; ?>
						</td>
					</tr>

					<tr style="border-bottom: 1px;">
						<td class="dt-vertical-align p-2 fs-7 text-primary">
							<div class="row d-flex align-items-center">
								<div class="col-2 ms-auto d-flex align-items-center">
									<a href="#" class="edit-price pe-1" data-invoice-items-id="<?php echo $item->id; ?>" data-service-info="<?php echo getService($item->service_id)[0]->name . ' (' . getMoneyFormat($config[0]->currency, $item->amount) . ')'; ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
											<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
											<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
										</svg>
									</a>
									<a href="#" class="delete-service pe-4" data-invoice-items-id="<?php echo $item->id; ?>" data-service-id="<?php echo $item->service_id; ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
											<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
											<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
										</svg>
									</a>
								</div>
								<div class="col-4 ms-auto d-flex align-items-center">
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
								<div class="col-6 text-end">
									<span class="text-black fs-8">
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

<?php
$total = $baseImponible;
foreach ($invoiceTax as $it) {
	$aux = 0;
	if ($it->taxPercent != 0) {
		$aux = $it->taxPercent / 100 * $baseImponible;
		if ($it->taxOperator == "-") {
			$total -= $aux;  // Forma abreviada de restar
		} else if ($it->taxOperator == "+") {
			$total += $aux;  // Forma abreviada de sumar
		}

		// Formatear el valor del impuesto
		$auxFormatted = getMoneyFormat($config[0]->currency, $aux);
		$auxFormatted = $auxFormatted;

		// Escapar el valor formateado para evitar problemas de inyección de código
		$auxEscaped = htmlspecialchars($auxFormatted, ENT_QUOTES, 'UTF-8');

		// Usar JSON para evitar problemas de sintaxis en JavaScript
		echo "<script>document.getElementById('tax-" . $it->itID . "').innerHTML = " . json_encode($auxEscaped) . ";</script>";
	}
}
?>

<script>
	$('#tax-base').html("<?php echo getMoneyFormat($config[0]->currency, $baseImponible); ?>");
	$('#total-price').html("<?php echo getMoneyFormat($config[0]->currency, $total); ?>");

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

	totalPrice = "<?php echo $total; ?>";
	basket = "<?php echo sizeof($items); ?>";

</script>