<style>
	.scroll-container {
		max-height: 325px;
		overflow-y: auto;
		overflow-x: hidden;
		max-width: 100%;
		box-sizing: border-box;
	}

	.scroll-container-description {
		max-height: 30px;
		overflow-y: auto;
		overflow-x: hidden;
	}
</style>

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.menu_tpv'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6"></div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12 col-md-8 col-lg-8">
		<div class="row">
			<?php if (empty($services)) { ?>
				<div class="alert bg-light-subtle alert-dismissible fade show text-center" role="alert">
					<?php echo lang('Text.tpv_empty_services_label'); ?>
				</div>
			<?php } ?>
			<?php foreach ($services as $s) { ?>
				<div class="col-12 col-md-3 col-lg-3">
					<div class="text-center alert-dismissible fade show p-0 alert card-hover" role="alert">
						<div class="card card-services" style="cursor: pointer; height: 200px;" data-service-id="<?php echo $s->id; ?>">
							<div class="card-body text-center">

								<?php if (!empty($profile->logo)) { ?>
									<img src="data:image/png;base64, <?php echo base64_encode($profile->logo); ?>" alt="logo" class="w-40 rounded-circle">
								<?php } else { ?>
									<img src="<?php echo base_url('public/assets/images/avatar/logoBlank.png') ?>" alt="logo" class="w-40 rounded-circle">
								<?php } ?>

								<div style="height: 75px;" class="mt-2">
									<h7 class="card-title mb-1"><?php echo $s->name; ?></h7>
								</div>

								<div style="height: 10px;">
									<p class="fs-2 mb-0"><?php echo getMoneyFormat($config[0]->currency, $s->price); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-4">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center">
					<h4 class="card-title mb-0">#: <?php echo str_pad($invoice[0]->number, STR_PAD_LEFT_NUMBER, '0', STR_PAD_LEFT); ?></h4>
					<div class="ms-auto">
						<button id="btn-clear-basket" class="btn btn-rounded btn-danger hstack gap-1">
							<?php echo lang('Text.tpv_basket_btn_clear'); ?>
						</button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<!-- Main Items -->
				<div id="main-items" class="mb-3 mt-3"></div>
				<div class="row">
					<div class="col-12 text-end">
						<?php echo lang('Text.tax_base'); ?> <span id="tax-base"></span>
						<br>
						<?php foreach($invoiceTax as $it) { ?>
							<?php echo $it->taxDesc; ?> <span id="tax-<?php echo $it->itID; ?>"></span>
						<?php } ?>
					</div>
				</div>
				<div class="d-flex flex-stack bg-success rounded-3 p-3 mb-2 mt-2">
					<div class="fs-6 fw-bold text-white">
						<span class="d-block fs-6 lh-6">Total</span>
					</div>
					<div class="fs-6 fw-bold text-white ms-auto">
						<span id="total-price" class="d-block fs-6 lh-6" data-kt-pos-element="grant-total">$0.00</span>
					</div>
				</div>
				<div class="row">
					<div class="fs-7 mb-2"><?php echo lang('Text.tpv_basket_payment_type_label'); ?></div>
					<div class="col-12 col-md-6 col-lg-6">
						<div class="card bg-box position-relative text-bg-muted border border-2 payType-card" style="cursor: pointer;" data-pay-type="1">
							<div class="card-body text-center p-3">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
									<defs>
										<mask id="solarCardBold0">
											<g fill="none">
												<path fill="#fff" d="M14 4h-4C6.229 4 4.343 4 3.172 5.172c-.844.843-1.08 2.057-1.146 4.078h19.948c-.066-2.021-.302-3.235-1.146-4.078C19.657 4 17.771 4 14 4m-4 16h4c3.771 0 5.657 0 6.828-1.172S22 15.771 22 12q0-.662-.002-1.25H2.002Q1.999 11.338 2 12c0 3.771 0 5.657 1.172 6.828S6.229 20 10 20" />
												<path fill="#000" fill-rule="evenodd" d="M5.25 16a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75m6.5 0a.75.75 0 0 1 .75-.75H14a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75" clip-rule="evenodd" />
											</g>
										</mask>
									</defs>
									<path fill="currentColor" d="M0 0h24v24H0z" mask="url(#solarCardBold0)" />
								</svg>
								<h6 class="text-white mb-0 fw-medium"><?php echo lang('Text.tpv_basket_payment_type_target'); ?></h6>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6">
						<div class="card bg-box position-relative text-bg-muted border border-2 payType-card" style="cursor: pointer;" data-pay-type="2">
							<div class="card-body text-center p-3">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
									<path fill="currentColor" fill-rule="evenodd" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10m.75-16a.75.75 0 0 0-1.5 0v.317c-1.63.292-3 1.517-3 3.183c0 1.917 1.813 3.25 3.75 3.25c1.377 0 2.25.906 2.25 1.75s-.873 1.75-2.25 1.75c-1.376 0-2.25-.906-2.25-1.75a.75.75 0 0 0-1.5 0c0 1.666 1.37 2.891 3 3.183V18a.75.75 0 0 0 1.5 0v-.317c1.63-.292 3-1.517 3-3.183c0-1.917-1.813-3.25-3.75-3.25c-1.376 0-2.25-.906-2.25-1.75s.874-1.75 2.25-1.75c1.377 0 2.25.906 2.25 1.75a.75.75 0 0 0 1.5 0c0-1.666-1.37-2.891-3-3.183z" clip-rule="evenodd" />
								</svg>
								<h6 class="text-white mb-0 fw-medium"><?php echo lang('Text.tpv_basket_payment_type_cash'); ?></h6>
							</div>
						</div>
					</div>
				</div>
				<button id="btn-Charge" class="btn btn-primary fs-6 w-100 p-2"><?php echo lang('Text.tpv_basket_btn_ticket'); ?></button>
			</div>
		</div>
	</div>
</div>

<script>
	var invoiceID = "<?php echo $invoice[0]->id; ?>";
	var payType = 0;
	var basket = 0;

	getItems();

	$('.card-services').on('click', function() {
		let serviceID = $(this).attr('data-service-id');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('TPV/addInvoiceItem') ?>",
			data: {
				'invoiceID': invoiceID,
				'serviceID': serviceID
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
	});

	$('.payType-card').on('click', function() {
		payType = $(this).attr('data-pay-type');
		$('.payType-card').each(function() {
			$(this).removeClass('border-primary');
			$(this).removeClass('border-danger');
		});
		$(this).addClass('border-primary');
	});

	$('#btn-clear-basket').on('click', function() {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('TPV/clearInvoiceItems') ?>",
			data: {
				'invoiceID': invoiceID,
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
	});

	$('#btn-Charge').on('click', function() {
		if (basket != 0 && payType != 0) {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('TPV/saveInvoice'); ?>",
				data: {
					'invoiceID': invoiceID,
					'payType': payType,
					'totalAmount': totalPrice
				},
				dataType: "json",
				success: function(response) {
					if (response.error == 0) {
						Swal.fire({
							position: "top-end",
							icon: "success",
							text: "<?php echo lang('Text.tpv_alert_success_save_invoice'); ?>" + '..!',
							showConfirmButton: false,
							timer: 2500
						});
						url = "<?php echo base_url('TPV/printTicket?invoiceID='); ?>" + invoiceID;
						window.open(url, '_blank');
						setTimeout(() => {
							window.location.reload();
						}, 2500);
					} else if (response.error == 2) {
						window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
					} else
						globalError();
				},
				error: function(error) {
					globalError();
				}
			});
		} else {
			if (basket == 0) {
				Swal.fire({
					position: "top-end",
					icon: "warning",
					text: "<?php echo lang('Text.tpv_alert_not_services_basket'); ?>" + '..!',
					showConfirmButton: false,
					timer: 2500
				});
			} else if (payType == 0) {
				$('.payType-card').each(function() {
					$(this).addClass('border-danger');
				});
				Swal.fire({
					position: "top-end",
					icon: "warning",
					text: "<?php echo lang('Text.tpv_alert_not_payment_basket'); ?>" + '..!',
					showConfirmButton: false,
					timer: 2500
				});
			}
		}
	});

	function getItems() {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('TPV/invoiceItems') ?>",
			data: {
				'invoiceID': invoiceID,
			},
			dataType: "html",
			success: function(response) {
				$('#main-items').html(response);
			},
			error: function(error) {
				globalError();
			}
		});
	}
</script>