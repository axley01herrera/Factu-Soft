<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.customer_profile_page_title'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6"></div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12 col-md-4 col-lg-4">
		<!-- Card Profile Information -->
		<div class="card shadow-none border mt-2">
			<div class="card-body">
				<div class="mt-2 mb-4">
					<div class="d-flex align-items-center justify-content-center mb-2">
						<div class="d-flex align-items-center justify-content-center round-110">
							<div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
								<img src="<?php echo base_url('public/assets/images/avatar/user-1.jpg'); ?>" alt="monster-img" class="w-100 h-100">
							</div>
						</div>
					</div>
					<div class="text-center">
						<h5 class="mb-0"><?php echo $customer[0]->name . ' ' . $customer[0]->last_name; ?></h5>
						<p class="mb-0">
							<?php if ($customer[0]->type == 0) { ?>
								<span class="badge bg-primary-subtle text-primary"><?php echo lang('Text.customer_type_particular'); ?></span>
							<?php } else if (($customer[0]->type == 1)) { ?>
								<span class="badge bg-success-subtle text-success"><?php echo lang('Text.customer_type_enterprise'); ?></span>
							<?php } ?>
						</p>
					</div>
				</div>

				<div class="vstack gap-3">
					<div class="hstack gap-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
							<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
						</svg>
						<h6 class="mb-0"><?php if (!empty($customer[0]->email)) echo $customer[0]->email;
											else echo lang('Text.profile_text_email'); ?></h6>
					</div>
					<div class="hstack gap-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
							<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
						</svg>
						<h6 class="mb-0"><?php if (!empty($customer[0]->phone)) echo $customer[0]->phone;
											else echo lang('Text.profile_text_phone'); ?></h6>
					</div>
					<div class="hstack gap-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
							<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
							<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
						</svg>
						<h6 class="mb-0">
							<?php
							if (!empty($customer[0]->address_a)) {
								echo $customer[0]->address_a;
							} else {
								echo lang('Text.profile_text_address_a');
							}

							if (!empty($customer[0]->address_city)) {
								echo '<br>' . $customer[0]->address_city;
							} else {
								echo '<br>' . lang('Text.profile_text_city');
							}

							if (!empty($customer[0]->address_state)) {
								echo ', ' . $customer[0]->address_state;
							} else {
								echo ', ' . lang('Text.profile_text_state');
							}

							if (!empty($customer[0]->address_zip)) {
								echo '<br>' . $customer[0]->address_zip;
							} else {
								echo '<br>' . lang('Text.profile_text_zip');
							}

							if (!empty($customer[0]->address_country)) {
								echo ', ' . $customer[0]->address_country;
							} else {
								echo ', ' . lang('Text.profile_text_country');
							}
							?>
						</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 col-md-8 col-lg-8">
		<ul class="nav nav-underline mb-2" id="myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<a href="#" class="nav-link tab-link <?php if ($tab == 'info') echo 'active'; ?>" data-tab="info">
					<span><?php echo lang('Text.customer_profile_personal_title'); ?></span>
				</a>
			</li>
			<li class="nav-item" role="presentation">
				<a href="#" class="nav-link tab-link <?php if ($tab == 'invoices') echo 'active'; ?>" data-tab="invoices">
					<span><?php echo lang('Text.customer_profile_invoices_title'); ?></span>
				</a>
			</li>
		</ul>

		<div id="main-tab-content"></div>

	</div>
</div>

<script>
	$(document).ready(function() {
		let tab = "<?php echo $tab; ?>";
		let customerID = "<?php echo $customer[0]->id; ?>";

		getTabContent();

		function getTabContent() {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Customer/getTabContent') ?>",
				data: {
					'tab': tab,
					'customerID': customerID
				},
				dataType: "html",
				success: function(response) {
					$('#main-tab-content').html(response);
				},
				error: function(error) {
					globalError();
				}
			});
		}

		$('.tab-link').on('click', function(e) {
			tab = $(this).attr('data-tab');
			e.preventDefault();

			$('.tab-link').each(function() {
				$(this).removeClass('active');
			});

			$(this).addClass('active');

			window.location.href = "<?php echo base_url('Customer/customerProfile?customerID='); ?>" + "<?php echo $customer[0]->id; ?>" + "&tab=" + tab;
		});


	});
</script>