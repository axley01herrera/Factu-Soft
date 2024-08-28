<div class="modal fade show" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal" style="display: block;" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header d-flex align-items-center">
				<h4 class="modal-title">
					<?php echo $modalTitle; ?>
				</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- Name -->
					<div class="col-12 mb-2">
						<label for="txt-name" class="form-label"><?php echo lang('Text.taxs_text_name'); ?></label>
						<input type="text" id="txt-name" class="form-control required" value="<?php echo @$tax[0]->name; ?>" />
					</div>

					<!-- Description -->
					<div class="col-12 mb-2">
						<label for="txt-description" class="form-label"><?php echo lang('Text.taxs_text_description'); ?></label>
						<input type="text" id="txt-description" class="form-control required" value="<?php echo @$tax[0]->description; ?>" />
					</div>

					<!-- Percent -->
					<div class="col-6 mb-2">
						<label for="txt-percent" class="form-label"><?php echo lang('Text.taxs_text_percent'); ?></label>
						<input type="text" id="txt-percent" class="form-control" value="<?php echo @$tax[0]->percent; ?>" />
					</div>

					<!-- Operator -->
					<div class="col-6 mb-2">
						<label for="sel-operator" class="form-label"><?php echo lang('Text.taxs_text_operator'); ?></label>
						<select id="sel-operator" class="form-select">
							<option value=""></option>
							<option value="+" <?php if (@$tax[0]->operator == '+') echo 'selected'; ?>>+</option>
							<option value="-" <?php if (@$tax[0]->operator == '-') echo 'selected'; ?>>-</option>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn-save" class="btn btn-primary"><?php echo lang('Text.btn_save'); ?></button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#modal').modal('show');

		let taxID = '<?php echo @$taxID; ?>';
		let alerMsg = '<?php echo lang('Text.taxs_msg_success_create'); ?>';

		if (taxID != '') { // Update
			$('#btn-save').html('<?php echo lang('Text.btn_update'); ?>');
			alerMsg = '<?php echo lang('Text.taxs_msg_success_update'); ?>';
		}

		$('#btn-save').on('click', function() {
			let result = checkRequiredValues();

			if (result == 0) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('Taxs/saveTax'); ?>",
					data: {
						'taxID': taxID,
						'name': $('#txt-name').val(),
						'description': $('#txt-description').val(),
						'percent': $('#txt-percent').val(),
						'operator': $('#sel-operator').val()
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
				Swal.fire({
					position: "top-end",
					icon: "warning",
					text: "<?php echo lang("Text.msg_required_values"); ?>..!",
					showConfirmButton: false,
					timer: 2500
				});
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

		$('.required').on('focus', function() {
			$(this).removeClass('is-invalid');
		});

		function focused() {
			$('.required').on('focus', function() {
				$(this).removeClass('is-invalid');
			});
		}

		focused();
	});
</script>