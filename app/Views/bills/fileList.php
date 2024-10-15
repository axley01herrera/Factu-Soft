<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.file_list_title'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6">
	</div>
</div>

<!-- Page Content -->
<div class="card">
	<div class="card-header">
		<div class="d-flex align-items-center">
			<h4 class="card-title mb-0"><?php echo lang('Text.menu_list_files'); ?></h4>
			<div class="ms-auto">
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="dt-files" class="table text-nowrap align-middle" style="width: 100%;">
				<thead>
					<tr>
						<th><?php echo lang('Text.bil_dt_col_file_name'); ?></th>
						<th><?php echo lang('Text.bil_dt_col_file_date'); ?></th>
						<th class="text-end"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($files as $f) { ?>
						<tr>
							<td><?php echo $f->filename; ?></td>
							<td><?php echo date('d-m-Y', strtotime($f->date)); ?></td>
							<td class="text-end">
								<a class="me-2" href="<?php echo base_url('public/' . '' . $f->path); ?>" download>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
										<path stroke="none" d="M0 0h24v24H0z" fill="none" />
										<path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
										<path d="M7 11l5 5l5 -5" />
										<path d="M12 4l0 12" />
									</svg>
								</a>
								<a class="me-2 delete-file" href="#" data-file-id="<?php echo $f->id; ?>" data-file-path="<?php echo $f->path; ?>">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
										<path stroke="none" d="M0 0h24v24H0z" fill="none" />
										<path d="M4 7l16 0" />
										<path d="M10 11l0 6" />
										<path d="M14 11l0 6" />
										<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
										<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
									</svg>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		let lang = "<?php echo $lang; ?>";
		let dtLang = "";

		if (lang == "es")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/es.json'); ?>";
		else if (lang == "en")
			dtLang = "<?php echo base_url('public/assets/js/dataTableLang/en.json'); ?>";

		var dtFileList = $('#dt-files').DataTable({ // DATA TABLE 
			processing: false,
			serverSide: false,
			pageLength: 10,
			language: {
				url: dtLang
			},
			columnDefs: [{
				targets: [2],
				searchable: false,
				orderable: false
			}],
			order: [
				[0, 'desc']
			],
			dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
		});

		dtFileList.on('click', '.delete-file', function(e) {
			e.preventDefault();
			let fileID = $(this).attr('data-file-id');
			let path = $(this).attr('data-file-path');

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
						url: "<?php echo base_url('Bills/deleteUploadFile'); ?>",
						data: {
							'fileID': fileID,
							'path': path
						},
						dataType: "json",
						success: function(res) {
							switch (res.error) {
								case 0:
									Swal.fire({
										position: "top-end",
										icon: "success",
										text: "<?php echo lang("Text.msg_success_deleted_files"); ?>..!",
										showConfirmButton: false,
										timer: 2500
									});

									setTimeout(() => {
										window.location.reload();
									}, 2500);
									break;
								case 1:
									globalError();
									break;
								case 2:
									window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
									break;
							}
						},
						error: function(error) {
							globalError();
						}
					});
				}
			});

		});
	});
</script>