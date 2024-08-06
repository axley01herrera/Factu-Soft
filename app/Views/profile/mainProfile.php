<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.profile_page_title'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6"></div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12 col-md-4 col-lg-4">
		<!-- Card Profile Information -->
		<div class="card shadow-none border">
			<div class="card-body">
				<img src="<?php echo base_url('public/assets/images/backgrounds/profilebg.jpg'); ?>" alt="profile-bg" class="img-fluid">
				<div class="row align-items-center">
					<div class="col-lg-4 order-lg-1 order-2">
						<div class="d-flex align-items-center justify-content-around m-4">
						</div>
					</div>
					<div class="col-lg-4 mt-n3 order-lg-2 order-1">
						<div class="mt-n5">
							<div class="d-flex align-items-center justify-content-center mb-2">
								<div class="d-flex align-items-center justify-content-center round-110">
									<div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
										<?php if (!empty($profile->logo)) { ?>
											<img src="data:image/png;base64, <?php echo base64_encode($profile->logo); ?>" alt="profile-logo" class="w-100 h-100">
										<?php } else { ?>
											<img src="<?php echo base_url('public/assets/images/avatar/logoBlank.png') ?>" alt="profile-logo" class="w-100 h-100">
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="text-center">
								<h5 class="mb-0">
									<?php
									if (!empty($profile->name))
										echo $profile->name;
									else
										echo lang('Text.profile_text_name'); ?></h5>
								<p class="mb-0 text-center">
									<button type="button" id="edit-logo" class="btn btn-sm btn-rounded btn-outline-warning border-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
											<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
											<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
										</svg>
									</button>
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 order-last">
					</div>
				</div>


				<div class="vstack gap-3 mt-4">
					<div class="hstack gap-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-postcard" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5M10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM13 8h-2V6h2z" />
						</svg>
						<h6 class="mb-0"><?php if (!empty($profile->company_id)) echo $profile->company_id;
											else echo lang('Text.profile_text_nif'); ?></h6>
					</div>
					<div class="hstack gap-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
							<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
						</svg>
						<h6 class="mb-0"><?php if (!empty($profile->email)) echo $profile->email;
											else echo lang('Text.profile_text_email'); ?></h6>
					</div>
					<div class="hstack gap-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
							<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
						</svg>
						<h6 class="mb-0"><?php if (!empty($profile->phone)) echo $profile->phone;
											else echo lang('Text.profile_text_phone'); ?></h6>
					</div>
					<div class="hstack gap-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
							<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
							<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
						</svg>
						<h6 class="mb-0">
							<?php
							if (!empty($profile->address_a)) {
								echo $profile->address_a;
							} else {
								echo lang('Text.profile_text_address_a');
							}

							if (!empty($profile->city)) {
								echo '<br>' . $profile->city;
							} else {
								echo '<br>' . lang('Text.profile_text_city');
							}

							if (!empty($profile->state)) {
								echo ', ' . $profile->state;
							} else {
								echo ', ' . lang('Text.profile_text_state');
							}

							if (!empty($profile->zip)) {
								echo '<br>' . $profile->zip;
							} else {
								echo '<br>' . lang('Text.profile_text_zip');
							}

							if (!empty($profile->country)) {
								echo ', ' . $profile->country;
							} else {
								echo ', ' . lang('Text.profile_text_country');
							}
							?>
						</h6>
					</div>
				</div>

				<p class="card-subtitle mt-4">
					<?php
					if (!empty($profile->description))
						echo $profile->description;
					else
						echo lang('Text.profile_text_desc');
					?>
				</p>
			</div>
		</div>
	</div>

	<div class="col-12 col-md-8 col-lg-8">
		<div class="card shadow-none border">
			<div class="card-body">
				<h4 class="mb-3"><?php echo lang('Text.profile_text_company_data'); ?></h4>
				<div class="row mb-3">
					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-name" class="form-label"><?php echo lang('Text.profile_text_name'); ?></label>
						<input type="text" id="txt-name" class="form-control ci-disabled required" value="<?php echo $profile->name; ?>" disabled />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-nif" class="form-label"><?php echo lang('Text.profile_text_nif'); ?></label>
						<input type="text" id="txt-nif" class="form-control ci-disabled required" value="<?php echo $profile->company_id; ?>" disabled />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-email" class="form-label"><?php echo lang('Text.profile_text_email'); ?></label>
						<input type="text" id="txt-email" class="form-control ci-disabled required email" value="<?php echo $profile->email; ?>" disabled />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-phone" class="form-label"><?php echo lang('Text.profile_text_phone'); ?></label>
						<input type="text" id="txt-phone" class="form-control ci-disabled required" value="<?php echo $profile->phone; ?>" disabled />
					</div>

					<div class="col-12 mb-2">
						<label for="txt-address_a" class="form-label"><?php echo lang('Text.profile_text_address_a'); ?></label>
						<input type="text" id="txt-address_a" class="form-control ci-disabled required" value="<?php echo $profile->address_a; ?>" disabled />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-ciy" class="form-label"><?php echo lang('Text.profile_text_city'); ?></label>
						<input type="text" id="txt-city" class="form-control ci-disabled required" value="<?php echo $profile->city; ?>" disabled />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-state" class="form-label"><?php echo lang('Text.profile_text_state'); ?></label>
						<input type="text" id="txt-state" class="form-control ci-disabled required" value="<?php echo $profile->state; ?>" disabled />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-zip" class="form-label"><?php echo lang('Text.profile_text_zip'); ?></label>
						<input type="text" id="txt-zip" class="form-control ci-disabled required" maxlength="5" value="<?php if (!empty($profile->zip)) echo $profile->zip; ?>" disabled />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-country" class="form-label"><?php echo lang('Text.profile_text_country'); ?></label>
						<input type="text" id="txt-country" class="form-control ci-disabled required" value="<?php echo $profile->country; ?>" disabled />
					</div>

					<div class="col-12">
						<label for="txt-desc" class="form-label"><?php echo lang('Text.profile_text_desc'); ?></label>
						<textarea id="txt-desc" class="form-control ci-disabled required" rows="5" disabled><?php echo $profile->description; ?></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-12 text-end">
						<button id="btn-edit-company-info" class="btn btn-warning"><?php echo lang('Text.btn_edit');?></button>
						<button id="btn-cancel-company-info" class="btn btn-secondary" hidden><?php echo lang('Text.btn_cancel');?></button>
						<button id="btn-save-company-info" class="btn btn-primary" hidden><?php echo lang('Text.btn_save');?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

		$('#edit-logo').on('click', function() {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Profile/editCompanyLogo'); ?>",
				dataType: "html",
				success: function(response) {
					$('#app-modal').html(response);
				},
				error: function(error) {}
			});
		});

		$('#btn-save-company-info').on('click', function() {
			let requiredValues = checkRequiredValues();
			let emailFormat = checkEmailFormat();

			if (requiredValues == 0 && emailFormat == 0) {
				$('#btn-save-company-info').attr('disabled', true);
				$.ajax({
					type: "post",
					url: "<?php echo base_url('Profile/updateProfile'); ?>",
					data: {
						'name': $('#txt-name').val(),
						'company_id': $('#txt-nif').val(),
						'email': $('#txt-email').val(),
						'phone': $('#txt-phone').val(),
						'address_a': $('#txt-address_a').val(),
						'city': $('#txt-city').val(),
						'state': $('#txt-state').val(),
						'zip': $('#txt-zip').val(),
						'country': $('#txt-country').val(),
						'description': $('#txt-desc').val()

					},
					dataType: "json",
					success: function(response) {
						console.log(response);
						if (response.error == 0) { // Success
							Swal.fire({
								position: "top-end",
								icon: "success",
								text: "<?php echo lang("Text.profile_msg_success_update_profile"); ?>..!",
								showConfirmButton: false,
								timer: 2500
							});

							setTimeout(() => {
								window.location.reload();
							}, 2501);
						} else if (response.error == 1) { // Error
							$('#btn-save-company-info').removeAttr('disabled');
							globalError();
						} else if (response.error == 2) { // Session Expired
							window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
						}
					},
					error: function(error) {
						$('#btn-save-company-info').removeAttr('disabled');
						globalError();
					}
				});
			} else {
				if (requiredValues != 0) {
					Swal.fire({
						position: "top-end",
						icon: "warning",
						text: "<?php echo lang("Text.msg_required_values"); ?>..!",
						showConfirmButton: false,
						timer: 2500
					});
				} else if (emailFormat != 0) {
					Swal.fire({
						position: "top-end",
						icon: "warning",
						text: "<?php echo lang("Text.msg_invalid_email_format"); ?>..!",
						showConfirmButton: false,
						timer: 2500
					});
				}
			}

		});

		$('#btn-edit-company-info').on('click', function() {
			$('.ci-disabled').each(function() {
				$(this).removeAttr('disabled');
			});

			$(this).attr('hidden', true);
			$('#btn-cancel-company-info').removeAttr('hidden');
			$('#btn-save-company-info').removeAttr('hidden');
		});

		$('#btn-cancel-company-info').on('click', function() {
			$('.ci-disabled').each(function() {
				$(this).attr('disabled', true);
			});

			$('#btn-cancel-company-info').attr('hidden', true);
			$('#btn-save-company-info').attr('hidden', true);

			$('#btn-edit-company-info').removeAttr('hidden');
		});

		function checkRequiredValues() {
			let result = 0;
			let value = "";

			$('.required').each(function() {
				value = $(this).val();
				if (value == "") {
					$(this).addClass('is-invalid');
					result = 1;
				}
			});

			return result;
		}

		function checkEmailFormat() {
			let inputValue = '';
			let response = 0;
			let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
			$('.email').each(function() {
				inputValue = $(this).val();
				if (!regex.test(inputValue)) {
					$(this).addClass('is-invalid');
					response = 1;
				}
			});
			return response;
		}

		$('.required').on('focus', function() {
			$(this).removeClass('is-invalid');
		});
	});
</script>