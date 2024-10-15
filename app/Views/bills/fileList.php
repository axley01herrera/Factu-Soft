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
			processing: true,
			serverSide: true,
			pageLength: 10,
			language: {
				url: dtLang
			},
			order: [
				[0, 'desc']
			],
			dom: '<"top"f>rt<"row"<"col-4 mt-3"l><"col-4 mt-3"i><"col-4 mt-3"p>>',
			ajax: {
				url: '<?php echo base_url('Bills/proccesingFilesDT'); ?>',
				type: "POST"
			},
			columns: [{
					data: 'filename',
					class: 'dt-vertical-align',
				},
				{
					data: 'date',
					class: 'dt-vertical-align'
				},
				{
					data: 'action',
					class: 'dt-vertical-align text-end',
					orderable: false,
					searchable : false,
				}
			],
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

									dtFileList.draw();
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