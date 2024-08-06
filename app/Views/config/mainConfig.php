<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.config_page_title'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6"></div>
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
						<select id="sel-lang" class="form-select config-disabled required" disabled >
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
						<select id="sel-currency" class="form-select config-disabled required" disabled >
							<option value="" hidden></option>
							<option value="€" <?php if ($config[0]->currency == "€") echo 'selected'; ?>>Euro (€)</option>
							<option value="$" <?php if ($config[0]->currency == "$") echo 'selected'; ?>>USD ($)</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-end">
						<button id="btn-edit-config" class="btn btn-sm btn-primary">Editar</button>
						<button id="btn-cancel-config" class="btn btn-sm btn-gray" hidden>Cancelar</button>
						<button id="btn-save-config" class="btn btn-sm btn-primary" hidden>Guardar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-4"></div>
</div>

<script>

	$('#btn-save-config').on('click', function () {
		
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
</script>