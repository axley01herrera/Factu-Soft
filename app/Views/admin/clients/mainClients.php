<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<style>
	#dt-clients_info{
		padding-top: 0;
	}
</style>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<div class="d-flex  align-items-center">
						<h4 class="card-title mb-0">Listado de Clientes</h4>
						<div class="ms-auto">
							<button type="button" id="" class="btn bg-primary-subtle text-primary">Crear Cliente</button>
						</div>
					</div>
				</div>
			</div>
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
</div>

<script>
	$(document).ready(function() {
		var lang = "es";
		var dtLang = "";

		if (lang == "es")
			dtLang = "<?php echo base_url('public/assets/js/dataTable/es.json'); ?>";
		else if (lang == "en")
			dtLang = "<?php echo base_url('public/assets/js/dataTable/en.json'); ?>";

		var dtClients = $('#dt-clients').DataTable({ // DATA TABLE USER LIST
			processing: true,
			serverSide: true,
			pageLength: 10,
			language: {
				url: dtLang
			},
			buttons: [],
			ajax: {
				url: "<?php echo base_url('Clients/processingClients'); ?>",
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