<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5"><?php echo $serviceInfo; ?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mt-2 mb-2">
					<input type="text" id="txt-new-price" class="form-control required" placeholder="<?php echo lang('Text.tpv_modal_new_price'); ?>" maxlength="7">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang("Text.btn_cancel"); ?></button>
				<button id="btn-save" type="button" class="btn btn-primary"><?php echo lang("Text.btn_save"); ?></button>
			</div>
		</div>
	</div>
</div>

<script>
	$('#modal').modal('show');
	$('#modal').on('hidden.bs.modal', function(event) {
		$('#app-modal').html('');
	});

	$('#modal').on('shown.bs.modal', function() {
		$('#txt-new-price').focus();
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

	$('#btn-save').on('click', function() {
		let newPrice = $('#txt-new-price').val();
		let result = checkRequiredValues();
		if (result == '') {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('TPV/editPriceProcessTPV') ?>",
				data: {
					'basketServiceID': "<?php echo $basketServiceID; ?>",
					'newPrice': newPrice
				},
				dataType: "json",
				success: function(response) {
					if (response.error == 0) {
						$('#modal').modal('hide');
						Swal.fire({
							position: "top-end",
							icon: "warning",
							text: "<?php echo lang('Text.tpv_alert_success_save_new_price'); ?>" + '..!',
							showConfirmButton: false,
							timer: 2500
						});
						getDtBasket();
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
				text: "<?php echo lang('Text.msg_required_values'); ?>" + '..!',
				showConfirmButton: false,
				timer: 2500
			});
		}
	});

	$('.required').on('focus', function() {
		$(this).removeClass('is-invalid');
	});

	$('#txt-new-price').keypress(function(event) {
		var charCode = event.which;
		if ((charCode < 48 || charCode > 57) && charCode != 45) {
			event.preventDefault();
		}
	});
</script>