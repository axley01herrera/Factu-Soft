<!-- dropzone -->
<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/dropzone/dist/dropzone.css'); ?>">
<script src="<?php echo base_url('public/assets/libs/dropzone/dist/dropzone.js'); ?>"></script>

<div class="modal fade show" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal" style="display: block;" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header d-flex align-items-center">
				<h4 class="modal-title">
					<?php echo lang('Text.profile_change_password_modal_title'); ?>
				</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label for="txt-new-password" class="form-label"><?php echo lang('Text.profile_new_password_label'); ?></label>
				<div class="input-group">
					<input id="txt-new-password" type="password" class="form-control">
					<span class="input-group-text cursor-pointer" id="password-eye">
						<i class="fas fa-eye" aria-hidden="true"></i>
					</span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal"><?php echo lang('Text.btn_cancel'); ?></button>
				<button type="button" id="btn-save" class="btn bg-primary text-white"><?php echo lang('Text.btn_save'); ?></button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#modal').modal('show');

		$("#password-eye").on("click", function() {
			var input = $(this).prev("input");
			if (input.attr("type") === "password") {
				input.attr("type", "text");
				$(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
			} else {
				input.attr("type", "password");
				$(this).find("i").removeClass("fa-eye-slash").addClass("fa-eye");
			}

		});

		$('#btn-save').on('click', function() {
			let newPassword = $('#txt-new-password').val();

			if (newPassword != '') {
				$('#btn-save').attr('disabled', true);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('Profile/changePasswordProcess'); ?>",
					data: {
						'newPassword': newPassword
					},
					dataType: "json",
					success: function(response) {
						if (response.error == 0) {
							$('#modal').modal('hide');
							Swal.fire({
								position: "top-end",
								icon: "success",
								text: "<?php echo lang("Text.profile_msg_success_change_password"); ?>..!",
								showConfirmButton: false,
								timer: 2500
							});
						} else if (response.error == 2)
							window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
						else
							globalError();

						$('#btn-save').removeAttr('disabled');
					},
					error: function(error) {
						globalError();
						$('#btn-save').removeAttr('disabled');
					}
				});
			} else {
				$('#txt-new-password').addClass('is-invalid');
				Swal.fire({
					position: "top-end",
					icon: "warning",
					text: "<?php echo lang("Text.msg_required_values"); ?>..!",
					showConfirmButton: false,
					timer: 2500
				});
			}
		});

		$('.form-control').on('focus', function() {
			$(this).removeClass('is-invalid');
		});

	});
</script>