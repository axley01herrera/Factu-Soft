<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.menu_customers_list'); ?></h4>
	</div>

	<div class="d-flex align-items-center justify-content-between gap-6">
		<button type="button" id="btn-create-customer" class="btn btn-success"><?php echo lang('Text.btn_create_customer'); ?></button>
	</div>
</div>

<!-- Page Content -->
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="dt-clients" class="table text-nowrap align-middle" style="width: 100%;">
				<thead>
					<tr>
						<th><?php echo lang('Text.customer_dt_col_type'); ?></th>
						<th><?php echo lang('Text.customer_dt_col_name'); ?></th>
						<th><?php echo lang('Text.customer_dt_col_lastName'); ?></th>
						<th><?php echo lang('Text.customer_dt_col_email'); ?></th>
						<th><?php echo lang('Text.customer_dt_col_phone'); ?></th>
						<th><?php echo lang('Text.customer_dt_col_updated'); ?></th>
						<th><?php echo lang('Text.customer_dt_col_added'); ?></th>
						<th style="width: 75px;"></th>
					</tr>
				</thead>
			</table>
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

	$('#btn-create-customer').on('click', function() {
		$('#btn-create-customer').attr('disabled', true);
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Customer/addEditCustomer') ?>",
			data: "",
			dataType: "html",
			success: function(response) {
				$('#btn-create-customer').removeAttr('disabled');
				$('#app-modal').html(response);
			},
			error: function(error) {
				globalError();
			}
		});
	});

	var dtClients = $('#dt-clients').DataTable({
		processing: true,
		serverSide: true,
		pageLength: 10,
		language: {
			url: dtLang
		},
		buttons: [],
		ajax: {
			url: "<?php echo base_url('Customer/processingCustomers'); ?>",
			type: "POST"
		},
		order: [
			[6, 'desc']
		],
		columns: [{
				data: 'type',
				class: 'dt-vertical-align p-2',
				searchable: false
			}, {
				data: 'name',
				class: 'dt-vertical-align p-2',
			},
			{
				data: 'nif',
				class: 'dt-vertical-align p-2',
				orderable: false
			},
			{
				data: 'email',
				class: 'dt-vertical-align p-2'
			},
			{
				data: 'phone',
				class: 'dt-vertical-align p-2',
			},
			{
				data: 'updated',
				class: 'dt-vertical-align p-2',
			},
			{
				data: 'added',
				class: 'dt-vertical-align p-2',
			},
			{
				data: 'action',
				class: 'dt-vertical-align text-end p-2',
				orderable: false,
				searchable: false
			},
		],
		dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
	});

	dtClients.on('click', '.btn-edit-customer', function(e) {
		e.preventDefault();
		let customerID = $(this).attr('data-customer-id');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Customer/addEditCustomer'); ?>",
			data: {
				'customerID': customerID
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

	dtClients.on('click', '.btn-delete-customer', function(e) {
		e.preventDefault();
		let customerID = $(this).attr('data-customer-id');
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
					url: "<?php echo base_url('Customer/deleteCustomer'); ?>",
					data: {
						'customerID': customerID
					},
					dataType: "json",
					success: function(response) {
						if (response.error == 0) {
							Swal.fire({
								position: "top-end",
								icon: "success",
								text: "<?php echo lang('Text.customer_msg_success_deleted'); ?>" + '..!',
								showConfirmButton: false,
								timer: 2500
							});

							dtClients.draw();
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