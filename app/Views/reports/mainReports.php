<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/select2/css/select2.min.css'); ?>">
<script src="<?php echo base_url('public/assets/libs/select2/js/select2.min.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.reports_page_title'); ?></h4>
	</div>
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6"></div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="col-12 mb-2">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-lg-4">
						<label for="sel-serie" class="form-label"><?php echo lang('Text.reports_serial_label'); ?></label>
						<select id="sel-serie" class="form-control" multiple>
							<?php foreach ($selFilterSerial as $s) {
								$serieName = "";
								if (!empty($s->customer)) {
									$serieName = $s->customer;
								} else {
									if ($s->serialID == 1)
										$serieName = lang('Text.simple_invoice');
									if ($s->serialID == 2)
										$serieName = lang('Text.invoice_retify');
									if ($s->serialID == 3)
										$serieName = lang('Text.invoice');
								}
							?>
								<option value="<?php echo $s->serialID; ?>" selected><?php echo $s->serialName . '[ ' . $serieName . ' ]'; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-lg-4">
						<label for="sel-start-date" class="form-label"><?php echo lang('Text.reports_date_start_label'); ?></label>
						<input type="date" id="sel-start-date" class="form-control required" />
					</div>
					<div class="col-12 col-lg-4">
						<label for="sel-end-date" class="form-label"><?php echo lang('Text.reports_date_end_label'); ?></label>
						<input type="date" id="sel-end-date" class="form-control" />
					</div>
					<div class="col-12 mt-5 text-end">
						<button type="button" id="btn-view-report" class="btn btn-primary">
							<?php echo lang('Text.reports_btn_view_report'); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 mb-5">
		<div id="main-search-results">
			<div class="alert customize-alert alert-dismissible text-primary alert-light-primary bg-primary-subtle fade show remove-close-icon" role="alert">
				<span class="side-line bg-primary"></span>
				<div class="d-flex align-items-center ">
					<i class="ti ti-info-circle fs-5 me-2 flex-shrink-0 text-primary"></i>
					<span class="text-truncate"><?php echo lang('Text.reports_not_search_label'); ?></span>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

		$('#sel-serie').select2({});

		$('#btn-view-report').on('click', function(e) {
			e.preventDefault();

			let dateStart = $('#sel-start-date').val();
			let dateEnd = $('#sel-end-date').val();

			if (dateEnd == "")
				dateEnd = dateStart;

			let objStartDate = new Date(dateStart);
			let objEndDate = new Date(dateEnd);

			if (dateStart != "") {
				if (objStartDate <= objEndDate) {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('Reports/getReports'); ?>",
						data: {
							'dateStart': dateStart,
							'dateEnd': dateEnd,
							'series': $('#sel-serie').val()
						},
						dataType: "html",
						success: function(response) {
							$('#main-search-results').html(response);
							$('#date-label').html($('#sel-date').val());
						},
						error: function(error) {
							globalError();
						}
					});
				} else {
					Swal.fire({
						position: "top-end",
						icon: "warning",
						text: "<?php echo lang("Text.reports_search_incorrect_date"); ?>..!",
						showConfirmButton: false,
						timer: 2500
					});
				}
			} else {
				$('#sel-start-date').addClass('is-invalid');
				Swal.fire({
					position: "top-end",
					icon: "warning",
					text: "<?php echo lang("Text.msg_required_values"); ?>..!",
					showConfirmButton: false,
					timer: 2500
				});
			}
		});

		$('.form-control').on('input change', function() {
			$(this).removeClass('is-invalid');
		});
	});
</script>