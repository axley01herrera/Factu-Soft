<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>


<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.menu_customers_list'); ?></h4>
	</div>

	<div class="d-flex align-items-center justify-content-between gap-6">
		<button type="button" id="" class="btn bg-primary-subtle text-primary">Crear Cliente</button>
	</div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive overflow-hidden">
					<table id="dt-clients" class="table text-nowrap align-middle" style="width: 100%;">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Apellidos</th>
								<th>Tipo</th>
								<th>Correo Electrónico</th>
								<th>Telefono</th>
								<th>Estado</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var lang = "es";
		var dtLang = "";

		if (lang == "es")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/es.json'); ?>";
		else if (lang == "en")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/en.json'); ?>";

		var dtClients = $('#dt-clients').DataTable({ // DATA TABLE USER LIST
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
				[1, 'desc']
			],
			columns: [{
					data: 'name',
					class: 'dt-vertical-align p-2',
				},
				{
					data: 'lastName',
					class: 'dt-vertical-align p-2'
				},
				{
					data: 'type',
					class: 'dt-vertical-align p-2',
					searchable: false
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
					data: 'status',
					class: 'dt-vertical-align p-2',
					searchable: false
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

	});
</script>