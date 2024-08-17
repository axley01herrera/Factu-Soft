<div class="card shadow-none border">
	<div class="card-body">
		<div class="row mb-3 mt-3">
			<div class="col-12 col-md-6 col-lg-6 mb-2">
				<label for="txt-name" class="form-label"><?php echo lang('Text.customer_text_name'); ?></label>
				<input type="text" id="txt-name" class="form-control c-disabled required" value="<?php echo $customer[0]->name; ?>" disabled />
			</div>

			<div id="div-particular" class="col-12 col-md-6 col-lg-6 mb-2" <?php if ($customer[0]->type == 1) echo 'hidden'; ?>>
				<label for="txt-last-name" class="form-label"><?php echo lang('Text.customer_text_last_name'); ?></label>
				<input type="text" id="txt-last-name" class="form-control c-disabled <?php if ($customer[0]->type == 0) echo 'required'; ?>" value="<?php echo $customer[0]->last_name; ?>" disabled />
			</div>

			<div id="div-enterprise" class="col-12 col-md-6 col-lg-6 mb-2" <?php if ($customer[0]->type == 0) echo 'hidden'; ?>>
				<label for="txt-nif" class="form-label"><?php echo lang('Text.customer_text_nif'); ?></label>
				<input type="text" id="txt-nif" class="form-control c-disabled <?php if ($customer[0]->type == 1) echo 'required'; ?>" value="<?php echo $customer[0]->nif; ?>" disabled />
			</div>

			<div class="col-12 col-md-6 col-lg-6 mb-2">
				<label for="txt-email" class="form-label"><?php echo lang('Text.customer_text_email'); ?></label>
				<input type="text" id="txt-email" class="form-control c-disabled email" value="<?php echo $customer[0]->email; ?>" disabled />
			</div>

			<div class="col-12 col-md-6 col-lg-6 mb-2">
				<label for="txt-phone" class="form-label"><?php echo lang('Text.customer_text_phone'); ?></label>
				<input type="text" id="txt-phone" class="form-control c-disabled" value="<?php echo $customer[0]->phone; ?>" disabled />
			</div>

			<div class="col-12 mb-2">
				<label for="txt-address_a" class="form-label"><?php echo lang('Text.customer_text_address_a'); ?></label>
				<input type="text" id="txt-address_a" class="form-control c-disabled" value="<?php echo $customer[0]->address_a; ?>" disabled />
			</div>

			<div class="col-12 col-md-6 col-lg-6 mb-2">
				<label for="txt-ciy" class="form-label"><?php echo lang('Text.customer_text_city'); ?></label>
				<input type="text" id="txt-city" class="form-control c-disabled" value="<?php echo $customer[0]->address_city; ?>" disabled />
			</div>

			<div class="col-12 col-md-6 col-lg-6 mb-2">
				<label for="txt-state" class="form-label"><?php echo lang('Text.customer_text_state'); ?></label>
				<input type="text" id="txt-state" class="form-control c-disabled" value="<?php echo $customer[0]->address_state; ?>" disabled />
			</div>

			<div class="col-12 col-md-6 col-lg-6 mb-2">
				<label for="txt-zip" class="form-label"><?php echo lang('Text.customer_text_zip'); ?></label>
				<input type="text" id="txt-zip" class="form-control c-disabled" maxlength="5" value="<?php if (!empty($customer[0]->address_zip)) echo $customer[0]->address_zip; ?>" disabled />
			</div>

			<div class="col-12 col-md-6 col-lg-6 mb-2">
				<label for="txt-country" class="form-label"><?php echo lang('Text.customer_text_country'); ?></label>
				<input type="text" id="txt-country" class="form-control c-disabled" value="<?php echo $customer[0]->address_country; ?>" disabled />
			</div>
		</div>

		<div class="row">
			<div class="col-12 text-end">
				<button id="btn-edit-customer" class="btn btn-warning"><?php echo lang('Text.btn_edit'); ?></button>
				<button id="btn-cancel-customer" class="btn btn-secondary" hidden><?php echo lang('Text.btn_cancel'); ?></button>
				<button id="btn-save-customer" class="btn btn-primary" hidden><?php echo lang('Text.btn_update'); ?></button>
			</div>
		</div>
	</div>
</div>

<script>
	$('#btn-edit-customer').on('click', function() {
		$('.c-disabled').each(function() {
			$(this).removeAttr('disabled');
		});

		$(this).attr('hidden', true);
		$('#btn-cancel-customer').removeAttr('hidden');
		$('#btn-save-customer').removeAttr('hidden');
	});

	$('#btn-cancel-customer').on('click', function() {
		$('.c-disabled').each(function() {
			$(this).attr('disabled', true);
		});

		$('#btn-cancel-customer').attr('hidden', true);
		$('#btn-save-customer').attr('hidden', true);

		$('#btn-edit-customer').removeAttr('hidden');
	});

	$('#sel-type').on('change', function() {
		let value = $(this).val();

		if (value == 1) { // CASE ENTERPRISE
			$('#div-particular').attr('hidden', true);
			$('#div-enterprise').removeAttr('hidden');

			$('#txt-last-name').val('');
			$('#txt-last-name').removeClass('required');

			$('#txt-nif').val('<?php echo $customer[0]->nif; ?>');
			$('#txt-nif').addClass('required');
		} else if (value == 0) { // CASE PARTICULAR
			$('#div-enterprise').attr('hidden', true);
			$('#div-particular').removeAttr('hidden');

			$('#txt-nif').val('');
			$('#txt-nif').removeClass('required');

			$('#txt-last-name').val('<?php echo $customer[0]->last_name; ?>');
			$('#txt-last-name').addClass('required');
		}
	});

	$('#btn-save-customer').on('click', function() {
		let requiredValues = checkRequiredValues();
		let resultEmail = checkEmailFormat();

		if (requiredValues == 0 && resultEmail == 0) {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Customer/saveCustomer'); ?>",
				data: {
					'customerID': '<?php echo $customer[0]->id; ?>',
					'name': $('#txt-name').val(),
					'last_name': $('#txt-last-name').val(),
					'nif': $('#txt-nif').val(),
					'email': $('#txt-email').val(),
					'phone': $('#txt-phone').val(),
					'address_a': $('#txt-address_a').val(),
					'address_city': $('#txt-city').val(),
					'address_state': $('#txt-state').val(),
					'address_zip': $('#txt-zip').val(),
					'address_country': $('#txt-country').val(),
				},
				dataType: "json",
				success: function(response) {
					if (response.error == 0) {
						Swal.fire({
							position: "top-end",
							icon: "success",
							text: "<?php echo lang('Text.customer_msg_success_update'); ?>" + '..!',
							showConfirmButton: false,
							timer: 2500
						});
						setTimeout(() => {
							window.location.reload();
						}, 2500);
					} else if (response.error == 2)
						window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
					else
						globalError();
				},
				error: function(error) {
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
			} else if (resultEmail != 0) {
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
			if (inputValue != "") {
				if (!regex.test(inputValue)) {
					$(this).addClass('is-invalid');
					response = 1;
				}
			}
		});
		return response;
	}

	$('.required').on('focus', function() {
		$(this).removeClass('is-invalid');
	});
</script>