<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
<script src="<?php echo base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>

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
	<div class="card card-flush mb-5">
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-lg-6">
					<label for="sel-start-date" class="form-label"><?php echo lang('Text.reports_date_start_label'); ?></label>
					<input type="date" id="sel-start-date" class="form-control required" />
				</div>
				<div class="col-12 col-lg-6">
					<label for="sel-end-date" class="form-label"><?php echo lang('Text.reports_date_end_label'); ?></label>
					<input type="date" id="sel-end-date" class="form-control" />
				</div>
				<div class="col-12 mt-5 text-end">
					<a href="#" id="btn-view-report" class="btn btn-sm btn-primary"><i class="bi bi-file-earmark-text me-1"></i><?php echo lang('Text.reports_btn_view_report'); ?></a>
				</div>
			</div>
		</div>
	</div>

	<div id="main-search-results">
		<div class="alert alert-dismissible bg-light-danger d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10 border-dashed border-danger">
			<i class="ki-duotone ki-information-5 fs-5tx text-danger mb-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
			<div class="text-center">
				<h5 class="fw-bold mb-5"><?php echo lang('Text.important_label'); ?></h5>
				<div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
				<div class="mb-9 text-gray-900">
					<?php echo lang('Text.reports_not_search_label'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var lang = "<?php echo $config[0]->lang; ?>";
	var dateStart = '';
	var dateEnd = '';
	var dateLabel = "";

	if (lang == 'es') {
		dateLabel = "d-m-Y";
	} else if (lang == 'en') {
		dateLabel = "m-d-Y";
	}

	$('#btn-view-report').on('click', function(e) {
		e.preventDefault();

		dateStart = $('#sel-start-date').val();
		dateEnd = $('#sel-end-date').val();

		let result = checkRequiredValues();

		if (result == 0)
			getReports();
		else {
			Swal.fire({
				position: "top-end",
				icon: "warning",
				text: "<?php echo lang("Text.msg_required_values"); ?>..!",
				showConfirmButton: false,
				timer: 2500
			});
		}

	});

	function getReports() {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Reports/getReports'); ?>",
			data: {
				'dateStart': dateStart,
				'dateEnd': dateEnd
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
	}

	function checkRequiredValues() {
		let result = 0;
		let value = "";

		$('.required').each(function() {
			value = $(this).val();
			if (value == "") {
				$(this).addClass('is-invalid');
				result = 1;
			}
		});

		return result;
	}

	$('.required').on('focus', function() {
		$(this).removeClass('is-invalid');
	});
</script>