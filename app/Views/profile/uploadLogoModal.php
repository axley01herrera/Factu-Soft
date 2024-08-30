<!-- dropzone -->
<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/dropzone/dist/dropzone.css'); ?>">
<script src="<?php echo base_url('public/assets/libs/dropzone/dist/dropzone.js'); ?>"></script>

<div class="modal fade show" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal" style="display: block;" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header d-flex align-items-center">
				<h4 class="modal-title">
					<?php echo lang('Text.profile_upload_logo_modal_title'); ?>
				</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="col-12">
					<div id="dropzone_1" class="dropzone">
						<div class="dz-message needsclick">
							<i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>
							<div class="ms-4">
								<h3 class="fs-5 fw-bold text-gray-900 mb-1"><?php echo lang('Text.profile_upload_logo_modal_dropzone_text_1'); ?></h3>
								<span class="fs-7 fw-semibold text-gray-500"><?php echo lang('Text.profile_upload_logo_modal_dropzone_text_2'); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn bg-danger-subtle text-danger waves-effect text-start" data-bs-dismiss="modal"><?php echo lang('Text.btn_cancel'); ?></button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#modal').modal('show');
		$('#modal').on('hidden.bs.modal', function(event) {
			$('#app-modal').html('');
		});

		function initializeDropzone(selector) {
			return new Dropzone(selector, {
				url: "<?php echo base_url('Profile/uploadLogo'); ?>",
				method: 'POST',
				autoProcessQueue: true,
				acceptedFiles: 'image/*',
				maxFiles: 1,
				paramName: "file",
				maxFilesize: 10,
				addRemoveLinks: true,
				init: function() {
					let dropzone = this;
					let element = dropzone.element.id;
					this.on("sending", function(file, xhr, formData) {
						$('button').attr('disabled', true);
					});
					this.on("success", function(file, xhr, formData) {
						$('#modal').modal('hide');
						Swal.fire({
							position: "top-end",
							icon: "success",
							text: "<?php echo lang("Text.profile_msg_success_upload_logo"); ?>..!",
							showConfirmButton: false,
							timer: 2500
						});
						setTimeout(() => {
							window.location.reload();
						}, 1500);

					});
					this.on("error", function(file, response) {
						$('button').removeAttr('disabled');
					});
				}
			});
		}

		let dropzone_1 = initializeDropzone("#dropzone_1");
	});
</script>