<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.menu_dashboard'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6"></div>
</div>

<!-- Page Content -->
<div class="row">
	<!-- Clients -->
	<div class="col-md-4 col-lg-2 col-6">
		<div class="card text-white text-bg-warning rounded">
			<div class="card-body p-4">
				<span>
					<i class="ti ti-users fs-8"></i>
				</span>
				<h4 class="card-title mt-3 mb-0 text-white"><?php echo sizeof($clients); ?></h4>
				<p class="card-text text-white opacity-75 fs-3 fw-normal">
					<?php echo lang('Text.dashboard_cards_customers_active')?>
				</p>
			</div>
		</div>
	</div>

	<!-- Services -->
	<div class="col-md-4 col-lg-2 col-6">
		<div class="card text-white text-bg-success rounded">
			<div class="card-body p-4">
				<span>
					<i class="ti ti-archive fs-8"></i>
				</span>
				<h4 class="card-title mt-3 mb-0 text-white"><?php echo sizeof($services); ?></h4>
				<p class="card-text text-white opacity-75 fs-3 fw-normal">
					<?php echo lang('Text.dashboard_cards_services_active')?>
				</p>
			</div>
		</div>
	</div>
</div>