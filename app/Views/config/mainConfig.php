<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.config_page_title'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6">
		<div class="col-12 mb-2 text-center">
			<button id="backup-db" class="btn btn-primary"><?php echo lang('Text.config_btn_create_bd_backup'); ?></button>
		</div>
	</div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12 col-md-4 col-lg-4"></div>
	<div class="col-12 col-md-4 col-lg-4">
		<div class="card shadow-none border">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-12 mb-2">
						<label for="sel-lang" class="form-label"><?php echo lang('Text.config_text_lang'); ?></label>
						<select id="sel-lang" class="form-select config-disabled required" disabled>
							<option value="" hidden></option>
							<option value="es" <?php if ($config[0]->lang == "es") echo 'selected'; ?>>Español</option>
							<option value="en" <?php if ($config[0]->lang == "en") echo 'selected'; ?>>English</option>
						</select>
					</div>
					<div class="col-12 mb-2">
						<label for="txt-timezone" class="form-label"><?php echo lang('Text.config_text_timezone'); ?></label>
						<input type="text" id="txt-timezone" class="form-control config-disabled required" value="<?php echo $config[0]->timezone; ?>" disabled />
					</div>
					<div class="col-12 mb-2">
						<label for="sel-currency" class="form-label"><?php echo lang('Text.config_text_currency'); ?></label>
						<select id="sel-currency" class="form-select config-disabled required" disabled>
							<option value="" hidden></option>
							<option value="€" <?php if ($config[0]->currency == "€") echo 'selected'; ?>>Euro (€)</option>
							<option value="$" <?php if ($config[0]->currency == "$") echo 'selected'; ?>>USD ($)</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-end">
						<button id="btn-edit-config" class="btn btn-warning"><?php echo lang('Text.btn_edit'); ?></button>
						<button id="btn-cancel-config" class="btn btn-secondary" hidden><?php echo lang('Text.btn_cancel'); ?></button>
						<button id="btn-save-config" class="btn btn-primary" hidden><?php echo lang('Text.btn_save'); ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-4"></div>
</div>

<script>
	$('#btn-save-config').on('click', function() {
		let requiredValues = checkRequiredValues();

		if (requiredValues == 0) {
			$('#btn-save-config').attr('disabled', true);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Config/saveConfig'); ?>",
				data: {
					'lang': $('#sel-lang').val(),
					'timezone': $('#txt-timezone').val(),
					'currency': $('#sel-currency').val(),
				},
				dataType: "json",
				success: function(response) {
					if (response.error == 0) {
						Swal.fire({
							position: "top-end",
							icon: "success",
							text: "<?php echo lang('Text.config_msg_success_save_config'); ?>" + '..!',
							showConfirmButton: false,
							timer: 2500
						});
						$('#btn-cancel-config').trigger('click');
						setTimeout(() => {
							window.location.reload();
						}, 2500);
					} else if (response.error == 2)
						window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
					else
						globalError();
					$('#btn-save-config').removeAttr('disabled');
				},
				error: function(error) {
					globalError();
					$('#btn-save-config').removeAttr('disabled');
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

	$('#backup-db').on('click', function() {
		$(this).attr('disabled', true);
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('Backup/createBackup'); ?>',
			data: {},
			success: function(response) {
				$('#backup-db').removeAttr('disabled');
				Swal.fire({
					position: "top-end",
					icon: "success",
					text: "Copia de seguridad " + response + " exitosa..!",
					showConfirmButton: false,
					timer: 2500
				});
			}
		});

	});

	$('#btn-edit-config').on('click', function() {
		$('.config-disabled').each(function() {
			$(this).removeAttr('disabled');
		});

		$(this).attr('hidden', true);
		$('#btn-cancel-config').removeAttr('hidden');
		$('#btn-save-config').removeAttr('hidden');
	});

	$('#btn-cancel-config').on('click', function() {
		$('.config-disabled').each(function() {
			$(this).attr('disabled', true);
		});

		$('#btn-cancel-config').attr('hidden', true);
		$('#btn-save-config').attr('hidden', true);

		$('#btn-edit-config').removeAttr('hidden');
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
</script>