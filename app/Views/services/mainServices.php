<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.menu_services_list'); ?></h4>
	</div>

	<div class="d-flex align-items-center justify-content-between gap-6">
		<button type="button" id="btn-create-service" class="btn btn-success"><?php echo lang('Text.btn_create_service'); ?></button>
	</div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive overflow-hidden">
					<table id="dt-services" class="table text-nowrap align-middle" style="width: 100%;">
						<thead>
							<tr>
								<th><?php echo lang('Text.services_dt_col_name'); ?></th>
								<th><?php echo lang('Text.services_dt_col_description'); ?></th>
								<th><?php echo lang('Text.services_dt_col_price'); ?></th>
								<th><?php echo lang('Text.services_dt_col_date_updated'); ?></th>
								<th><?php echo lang('Text.services_dt_col_date_created'); ?></th>
								<th style="width: 75px;"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($services as $s) { ?>
								<tr>
									<td><?php echo $s->name; ?></td>
									<td><?php echo $s->description; ?></td>
									<td><?php echo getMoneyFormat($config[0]->currency, $s->price); ?></td>
									<td><?php echo $s->updated; ?></td>
									<td><?php echo $s->created; ?></td>
									<td>
										<button type="button" class="btn btn-sm btn-rounded btn-outline-warning border-0 btn-edit-service" data-service-id='<?php echo $s->id; ?>'>
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
												<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
												<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
											</svg>
										</button>
										<button type="button" class="btn btn-sm btn-rounded btn-outline-danger border-0 btn-delete-service" data-service-id='<?php echo $s->id; ?>'>
											<i class="fas fa-trash fs-3"></i>
										</button>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var lang = "<?php echo $lang; ?>";
	var dtLang = "";

	if (lang == "es")
		dtLang = "<?php echo base_url('public/assets/js/dataTableLang/es.json'); ?>";
	else if (lang == "en")
		dtLang = "<?php echo base_url('public/assets/js/dataTableLang/en.json'); ?>";

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

	var dtServices = $('#dt-services').DataTable({ // DATA TABLE SERVICES LIST
		processing: false,
		serverSide: false,
		pageLength: 10,
		language: {
			url: dtLang
		},
		columnDefs: [{
			targets: [5],
			searchable: false,
			orderable: false
		}],
		order: [
			[4, 'desc']
		],
		dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
	});

	dtServices.on('click', '.btn-edit-service', function() {
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

	dtServices.on('click', '.btn-delete-service', function() {
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