<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.menu_services_list'); ?></h4>
	</div>

	<div class="d-flex align-items-center justify-content-between gap-6">
		<?php if (sizeof($services) > 1) { ?>
			<button type="button" id="btn-order-services" class="btn btn-muted"><?php echo lang('Text.services_text_order_services'); ?></button>
		<?php } ?>
		<button type="button" id="btn-create-service" class="btn btn-success"><?php echo lang('Text.btn_create_service'); ?></button>
	</div>
</div>

<!-- Page Content -->
<div class="row">
	<?php if (empty($services)) { ?>
		<div class="alert alert-warning" role="alert">
			<?php echo lang('Text.services_alert_empty_services'); ?>
		</div>
	<?php } ?>
	<?php foreach ($services as $s) { ?>
		<div class="col-12 col-md-6 col-lg-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title mb-1"><?php echo $s->name; ?>
						<div class="float-end">
							<button type="button" class="btn btn-muted btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-ellipsis-v"></i>
							</button>
							<ul class="dropdown-menu">
								<li><a href="#" class="dropdown-item btn-edit-service" data-service-id='<?php echo $s->id; ?>'>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
											<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
											<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
										</svg>
										<?php echo lang('Text.btn_edit'); ?>
									</a>
								</li>
								<li><a href="#" class="dropdown-item btn-delete-service" data-service-id='<?php echo $s->id; ?>'>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
											<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
											<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
										</svg>
										<?php echo lang('Text.btn_delete'); ?>
									</a>
								</li>
							</ul>
						</div>
					</h5>
					<h5 class="card-subtitle"><?php echo getMoneyFormat($config[0]->currency, $s->price); ?></h5>
					<p class="mt-2"><?php echo $s->description; ?></p>
					<div class="row mt-3">
						<div class="col-6">
							<p class="fw-bold mb-0"><?php echo lang('Text.service_text_date_created'); ?></p>
							<p class="mt-1"><?php echo $s->created; ?></p>
						</div>
						<div class="col-6">
							<p class="fw-bold mb-0"><?php echo lang('Text.service_text_date_updated'); ?></p>
							<p class="mt-1"><?php echo $s->updated; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

<script>
	$('#btn-create-service').on('click', function() {
		$('#btn-create-service').attr('disabled', true);
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Services/addEditService') ?>",
			data: "",
			dataType: "html",
			success: function(response) {
				$('#btn-create-service').removeAttr('disabled');
				$('#app-modal').html(response);
			},
			error: function(error) {
				globalError();
			}
		});
	});

	$('.btn-edit-service').on('click', function(e) {
		e.preventDefault();
		let serviceID = $(this).attr('data-service-id');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Services/addEditService'); ?>",
			data: {
				'serviceID': serviceID
			},
			dataType: "html",
			success: function(response) {
				$('#app-modal').html(response);
			},
			error: function(error) {
				globalError();
			}
		});
	});

	$('#btn-order-services').on('click', function() {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Services/showOrderModal') ?>",
			data: {},
			dataType: "html",
			success: function(response) {
				$('#app-modal').html(response);
			},
			error: function() {
				globalError();
			}
		});
	});

	$('.btn-delete-service').on('click', function(e) {
		e.preventDefault();
		let serviceID = $(this).attr('data-service-id');
		Swal.fire({
			title: '<?php echo lang('Text.are_you_sure_msg'); ?>',
			text: "<?php echo lang('Text.not_revert_this_msg'); ?>",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '<?php echo lang('Text.yes_remove_msg'); ?>',
			cancelButtonText: '<?php echo lang('Text.no_cancel_msg'); ?>'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('Services/deleteService'); ?>",
					data: {
						'serviceID': serviceID
					},
					dataType: "json",
					success: function(response) {
						if (response.error == 0) {
							Swal.fire({
								position: "top-end",
								icon: "success",
								text: "<?php echo lang('Text.services_msg_success_deleted'); ?>" + '..!',
								showConfirmButton: false,
								timer: 2500
							});
							setTimeout(() => {
								window.location.reload();
							}, 2500);
						} else if (response.error == 2) {
							window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
						} else
							globalError();
					},
					error: function(error) {
						globalError();
					}
				});
			}
		});

	});
</script>