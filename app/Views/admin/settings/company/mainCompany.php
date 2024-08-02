<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<div class="d-flex  align-items-center">
						<h4 class="card-title mb-0">Detalle de la compañía</h4>
						<div class="ms-auto">
							<button type="button" id="btn-edit<?php echo $uniqid; ?>" class="btn bg-primary-subtle text-primary">Editar</button>
						</div>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="row">
					<!-- ID -->
					<div class="col-12 col-lg-3 mb-4">
						<label for="txt-company-id<?php echo $uniqid; ?>" class="form-label">ID</label>
						<input type="text" id="txt-company-id<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $company[0]->companyID; ?>" disabled>
					</div>
					<!-- NAME -->
					<div class="col-12 col-lg-3 mb-4">
						<label for="txt-company-name<?php echo $uniqid; ?>" class="form-label">Nombre</label>
						<input type="text" id="txt-company-name<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $company[0]->name; ?>" disabled>
					</div>
					<!-- EMAIL -->
					<div class="col-12 col-lg-3 mb-4">
						<label for="txt-company-email<?php echo $uniqid; ?>" class="form-label">Correo Electrónico</label>
						<input type="email" id="txt-company-email<?php echo $uniqid; ?>" class="form-control email<?php echo $uniqid; ?> required<?php echo $uniqid; ?>" value="<?php echo $company[0]->email; ?>" disabled>
					</div>
					<!-- PHONE -->
					<div class="col-12 col-lg-3 mb-4">
						<label for="txt-company-phone<?php echo $uniqid; ?>" class="form-label">Telefono</label>
						<input type="tel" id="txt-company-phone<?php echo $uniqid; ?>" class="form-control phone<?php echo $uniqid; ?> required<?php echo $uniqid; ?>" value="<?php echo $company[0]->phone; ?>" disabled>
					</div>
					<!-- ADD 1 -->
					<div class="col-12 col-lg-3 mb-4">
						<label for="txt-company-address-1<?php echo $uniqid; ?>" class="form-label">Dirección 1</label>
						<input type="text" id="txt-company-address-1<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $company[0]->address1; ?>" disabled>
					</div>
					<!-- ADD 2 -->
					<div class="col-12 col-lg-3 mb-4">
						<label for="txt-company-address-2<?php echo $uniqid; ?>" class="form-label">Dirección 2</label>
						<input type="text" id="txt-company-address-2<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $company[0]->address2; ?>" disabled>
					</div>
					<!-- ZIP CODE -->
					<div class="col-12 col-lg-3 mb-4">
						<label for="txt-company-zip<?php echo $uniqid; ?>" class="form-label">Codigo Postal</label>
						<input type="text" id="txt-company-zip<?php echo $uniqid; ?>" class="form-control number<?php echo $uniqid; ?> required<?php echo $uniqid; ?>" value="<?php if (!empty($company[0]->zipCode)) echo $company[0]->zipCode; ?>" maxlength="5" disabled>
					</div>
					<!-- COUNTRY -->
					<div class="col-12 col-lg-3 mb-4">
						<label for="txt-company-country<?php echo $uniqid; ?>" class="form-label">País</label>
						<input type="text" id="txt-company-country<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $company[0]->country; ?>" disabled>
					</div>
				</div>
				<div id="div-actions" class="text-end mt-2" hidden>
					<button id="btn-cancel<?php echo $uniqid; ?>" class="btn bg-danger-subtle">Cancelar</button>
					<button id="btn-save<?php echo $uniqid; ?>" class="btn bg-primary-subtle">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#btn-edit<?php echo $uniqid; ?>').on('click', function() {
			$(this).attr('hidden', true);

			$('.required<?php echo $uniqid; ?>').each(function() {
				$(this).removeAttr('disabled');
			});

			$('#div-actions').removeAttr('hidden');
		});

		$('#btn-cancel<?php echo $uniqid; ?>').on('click', function() {
			$('#div-actions').attr('hidden', true);

			$('.required<?php echo $uniqid; ?>').each(function() {
				$(this).attr('disabled', true);
			});

			$("#btn-edit<?php echo $uniqid; ?>").removeAttr('hidden');
		});

		$('#btn-save<?php echo $uniqid; ?>').on('click', function() {
			let requiredValues = checkRequiredValues();
			let emailFormat = checkEmailFormat();

			let companyID = $('#txt-company-id<?php echo $uniqid; ?>').val();
			let name = $('#txt-company-name<?php echo $uniqid; ?>').val();
			let email = $('#txt-company-email<?php echo $uniqid; ?>').val();
			let phone = $('#txt-company-phone<?php echo $uniqid; ?>').val();
			let address1 = $('#txt-company-address-1<?php echo $uniqid; ?>').val();
			let address2 = $('#txt-company-address-2<?php echo $uniqid; ?>').val();
			let zip = $('#txt-company-zip<?php echo $uniqid; ?>').val();
			let country = $('#txt-company-country<?php echo $uniqid; ?>').val();

			if (requiredValues == 0 && emailFormat == 0) {
				$('#btn-save<?php echo $uniqid; ?>').attr('disaled', true);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('Company/saveCompanyInfo') ?>",
					data: {
						'companyID': companyID,
						'name': name,
						'email': email,
						'phone': phone,
						'address1': address1,
						'address2': address2,
						'zip': zip,
						'country': country,
					},
					dataType: "json",
					success: function(res) {
						if (res.error == 0) {
							successAlert('Compañía Actualizada');
							setTimeout(() => {
								window.location.reload();
							}, 2500);
						} else if (res.error == 2)
							window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
						else
							globalError();
						$('#btn-save<?php echo $uniqid; ?>').removeAttr('disaled');
					},
					error: function(error) {
						globalError();
						$('#btn-save<?php echo $uniqid; ?>').removeAttr('disaled');
					}
				});
			} else {
				if (requiredValues != 0)
					warningAlert('Hay campos requeridos');
				else if (emailFormat != 0) {
					$('#txt-company-email<?php echo $uniqid; ?>').addClass('is-invalid');
					warningAlert('Correo electrónico incorrecto');
				}
			}

		});

		function checkRequiredValues() {
			let res = 0;
			let value = "";

			$('.required<?php echo $uniqid; ?>').each(function() {
				value = $(this).val();

				if (value == "") {
					$(this).addClass('is-invalid');
					res = 1;
				}
			});

			return res;
		}

		function checkEmailFormat() {
			let inputValue = '';
			let response = 0;
			let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
			$('.email<?php echo $uniqid; ?>').each(function() {
				inputValue = $(this).val();
				if (!regex.test(inputValue)) {
					$(this).addClass('is-invalid');
					response = 1;
				}
			});
			return response;
		}

		$('.required<?php echo $uniqid; ?>').on('input change', function() {
			$(this).removeClass('is-invalid');
		});

		$('.number<?php echo $uniqid; ?>').on('input', function() { // INPUT ONLY NUMBERS
			jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
		});

		$('.phone<?php echo $uniqid; ?>').each(function() {
			$(this).on('keypress', function(event) {
				var charCode = event.which;
				if ((charCode < 48 || charCode > 57) && charCode !== 43) {
					event.preventDefault();
				}
			});
		});
	});
</script>