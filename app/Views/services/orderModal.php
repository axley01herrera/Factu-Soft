<script src="<?php echo base_url('public/assets/js/draggable/draggable.bundle.js'); ?>"></script>

<style>
	.card-heigth {
		width: 70px;
		height: 70px;
	}

	@media only screen and (max-width: 768px) {
		.card-heigth {
			width: 35px;
			height: 70px;
		}
	}
</style>

<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5"><?php echo lang('Text.services_text_order_services'); ?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row mt-2">
					<div class="col-2">
						<?php for ($i = 1; $i <= sizeof($services); $i++) { ?>
							<div class="card mt-0 mb-3 card-heigth">
								<div class="text-center mt-4">
									<?php echo $i; ?>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="col-10">
						<?php foreach ($services as $s) { ?>
							<div class="draggable-zone">
								<div class="card draggable mt-0 mb-3 card-ids" data-id="<?php echo $s->id; ?>" style="height: 70px;">
									<div class="card-body draggable-handle">
										<i class="bi bi-arrows-move me-2"></i>
										<?php echo $s->name; ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
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
	$(document).ready(function() {
		$('#modal').modal('show');
		$('#modal').on('hidden.bs.modal', function(event) {
			$('#app-modal').html('');
		});

		let containers = document.querySelectorAll(".draggable-zone");

		let swappable = new Sortable.default(containers, {
			draggable: ".draggable",
			handle: ".draggable .draggable-handle",
			mirror: {
				appendTo: "#services",
				constrainDimensions: true
			}
		});

		$('#btn-save').on('click', function() {
			let ids = [];
			$('.card-ids').each(function() {
				ids.push($(this).attr('data-id'));
			});

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Services/updateServicesOrder'); ?>",
				data: {
					'ids': ids
				},
				dataType: "json",
				success: function(response) {
					if (response.error == 0) {
						Swal.fire({
							position: "top-end",
							icon: "success",
							text: "<?php echo lang('Text.services_msg_success_order_services'); ?>..!",
							showConfirmButton: false,
							timer: 2500
						});

						setTimeout(() => {
							window.location.reload();
						}, 3000);

						$('#modal').modal('hide');
					} else if (response.error == 2) {
						window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
					} else
						globalError();
				},
				error: function(error) {
					globalError();
				}
			});
		});
	});
</script>