<div class="modal fade show" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal" style="display: block;" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header d-flex align-items-center">
				<h4 class="modal-title">
					<?php echo $modalTitle; ?>
				</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-name" class="form-label"><?php echo lang('Text.customer_text_name'); ?></label>
						<input type="text" id="txt-name" class="form-control required" value="<?php echo @$customer[0]->name; ?>" />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-last_name" class="form-label"><?php echo lang('Text.customer_text_last_name'); ?></label>
						<input type="text" id="txt-last_name" class="form-control required" value="<?php echo @$customer[0]->last_name; ?>" />
					</div>

					<div class="col-12 col-md-4 col-lg-4 mb-2">
						<label for="sel-type" class="form-label">Type</label>
						<select id="sel-type" class="form-select required">
							<option value="0" <?php if (@$customer[0]->type == 0) echo 'selected'; ?>>Particular</option>
							<option value="1" <?php if (@$customer[0]->type == 1) echo 'selected'; ?>>Empresa</option>
						</select>
					</div>

					<div class="col-12 col-md-4 col-lg-4 mb-2">
						<label for="txt-email" class="form-label"><?php echo lang('Text.customer_text_email'); ?></label>
						<input type="text" id="txt-email" class="form-control email required" value="<?php echo @$customer[0]->email; ?>" />
					</div>

					<div class="col-12 col-md-4 col-lg-4 mb-2">
						<label for="txt-phone" class="form-label"><?php echo lang('Text.customer_text_phone'); ?></label>
						<input type="text" id="txt-phone" class="form-control required" value="<?php echo @$customer[0]->phone; ?>" />
					</div>

					<div class="col-12 mb-2">
						<label for="txt-address_a" class="form-label"><?php echo lang('Text.customer_text_address_a'); ?></label>
						<input type="text" id="txt-address_a" class="form-control required" value="<?php echo @$customer[0]->address_a; ?>" />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-city" class="form-label"><?php echo lang('Text.customer_text_city'); ?></label>
						<input type="text" id="txt-city" class="form-control required" value="<?php echo @$customer[0]->address_city; ?>" />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-state" class="form-label"><?php echo lang('Text.customer_text_state'); ?></label>
						<input type="text" id="txt-state" class="form-control required" value="<?php echo @$customer[0]->address_state; ?>" />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-zip" class="form-label"><?php echo lang('Text.customer_text_zip'); ?></label>
						<input type="text" id="txt-zip" class="form-control required" maxlength="5" value="<?php if (!empty(@$customer[0]->address_zip)) echo @$customer[0]->address_zip; ?>" />
					</div>

					<div class="col-12 col-md-6 col-lg-6 mb-2">
						<label for="txt-country" class="form-label"><?php echo lang('Text.customer_text_country'); ?></label>
						<input type="text" id="txt-country" class="form-control required" value="<?php echo @$customer[0]->address_country; ?>" />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn bg-danger-subtle text-danger waves-effect text-start" data-bs-dismiss="modal"><?php echo lang('Text.btn_cancel'); ?></button>
				<button type="button" id="btn-save" class="btn bg-primary-subtle text-primary waves-effect text-start"><?php echo lang('Text.btn_save'); ?></button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#modal').modal('show');

		let action = '<?php echo $action; ?>';
		let alerMsg = '<?php echo lang('Text.customer_msg_success_create'); ?>';

		if (action == 'update') {
			$('#btn-save').html('<?php echo lang('Text.btn_update'); ?>');
			alerMsg = '<?php echo lang('Text.customer_msg_success_update'); ?>';
		}

		$('#btn-save').on('click', function() {
			let result = checkRequiredValues();
			let resultEmail = checkEmailFormat();

			if (result == 0 && resultEmail == 0) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('Customer/saveCustomer'); ?>",
					data: {
						'customerID': '<?php echo @$customer[0]->id; ?>',
						'name': $('#txt-name').val(),
						'last_name': $('#txt-last_name').val(),
						'type': $('#sel-type').val(),
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
							$('#modal').modal('hide');
							Swal.fire({
								position: "top-end",
								icon: "success",
								text: alerMsg + '..!',
								showConfirmButton: false,
								timer: 2500
							});
							dtClients.draw();
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
				if (result != 0) {
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