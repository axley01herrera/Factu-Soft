<style>
	.scroll-container {
		max-height: 300px;
		overflow: auto;
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
			<?php foreach ($services as $s) { ?>
				<div class="col-12 col-md-3 col-lg-3">
					<div class="text-center alert-dismissible fade show p-0 alert card-hover" role="alert">
						<div class="card card-services" style="cursor: pointer;" data-service-id="<?php echo $s->id; ?>">
							<div class="card-body p-4 text-center border-bottom">
								<img src="<?php echo base_url('public/assets/images/logos/favicon.png'); ?>" alt="monster-img" class="rounded-circle mb-3">
								<h4 class="card-title mb-1"><?php echo $s->name; ?></h4>
								<span class="fs-2"><?php echo $s->description; ?></span>
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
					<h4 class="card-title mb-0">Ticket ID: <?php echo $basket[0]->id; ?></h4>
					<div class="ms-auto">
						<button id="btn-clear-basket" class="btn btn-rounded btn-danger hstack gap-1">
							Limpiar
						</button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<!-- BASKET -->
				<div id="main-basket" class="mb-3 mt-3"></div>

				<div class="d-flex flex-stack bg-success rounded-3 p-3 mb-2 mt-2">
					<div class="fs-6 fw-bold text-white">
						<span class="d-block fs-6 lh-6">Total</span>
					</div>
					<div class="fs-6 fw-bold text-white ms-auto">
						<span id="total-price" class="d-block fs-6 lh-6" data-kt-pos-element="grant-total">$0.00</span>
					</div>
				</div>
				<div class="row">
					<div class="fs-7 mb-2">Método de Pago</div>
					<!-- TYPE TARGET -->
					<div class="col-12 col-md-6 col-lg-6">
						<div class="card bg-box position-relative text-bg-muted border border-4 payType-card" style="cursor: pointer;" data-pay-type="1">
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
								<h6 class="text-white mb-0 fw-medium">Tarjeta</h6>
							</div>
						</div>
					</div>
					<!-- TYPE CASH -->
					<div class="col-12 col-md-6 col-lg-6">
						<div class="card bg-box position-relative text-bg-muted border border-4 payType-card" style="cursor: pointer;" data-pay-type="2">
							<div class="card-body text-center p-3">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
									<path fill="currentColor" fill-rule="evenodd" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10m.75-16a.75.75 0 0 0-1.5 0v.317c-1.63.292-3 1.517-3 3.183c0 1.917 1.813 3.25 3.75 3.25c1.377 0 2.25.906 2.25 1.75s-.873 1.75-2.25 1.75c-1.376 0-2.25-.906-2.25-1.75a.75.75 0 0 0-1.5 0c0 1.666 1.37 2.891 3 3.183V18a.75.75 0 0 0 1.5 0v-.317c1.63-.292 3-1.517 3-3.183c0-1.917-1.813-3.25-3.75-3.25c-1.376 0-2.25-.906-2.25-1.75s.874-1.75 2.25-1.75c1.377 0 2.25.906 2.25 1.75a.75.75 0 0 0 1.5 0c0-1.666-1.37-2.891-3-3.183z" clip-rule="evenodd" />
								</svg>
								<h6 class="text-white mb-0 fw-medium">Efectivo</h6>
							</div>
						</div>
					</div>
				</div>
				<button id="btn-ticket" class="btn btn-primary fs-6 w-100 p-2">Cobrar</button>
			</div>
		</div>
	</div>
</div>

<script>
	let basketID = "<?php echo $basket[0]->id; ?>";
	let payType = 0;

	getDtBasket();

	$('.card-services').on('click', function() {
		let serviceID = $(this).attr('data-service-id');

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('TPV/addServiceToBasket') ?>",
			data: {
				'basketID': basketID,
				'serviceID': serviceID
			},
			dataType: "json",
			success: function(response) {
				if (response.error == 0)
					getDtBasket();
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
		});
		$(this).addClass('border-primary');
	});

	$('#btn-clear-basket').on('click', function() {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('TPV/clearBasketService') ?>",
			data: {
				'basketID': basketID,
			},
			dataType: "json",
			success: function(response) {
				if (response.error == 0)
					getDtBasket();
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

	function getDtBasket() {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('TPV/dtBasket') ?>",
			data: {
				'basketID': basketID,
			},
			dataType: "html",
			success: function(response) {
				$('#main-basket').html(response);
			},
			error: function(error) {
				globalError();
			}
		});
	}
</script>