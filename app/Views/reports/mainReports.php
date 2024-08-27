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
	<div class="col-12 mb-2">
		<div class="card">
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
						<a href="#" id="btn-view-report" class="btn btn-primary"><i class="bi bi-file-earmark-text me-1"></i><?php echo lang('Text.reports_btn_view_report'); ?></a>
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

		let correctDate = 0;

		if (dateEnd != '')
			if (dateStart > dateEnd)
				correctDate = 1;


		let result = checkRequiredValues();

		if (result == 0 && correctDate == 0) {
			$('.form-control').each(function() {
				$(this).removeClass('is-invalid');
			});
			getReports();
		} else {
			if (result != 0) {
				Swal.fire({
					position: "top-end",
					icon: "warning",
					text: "<?php echo lang("Text.msg_required_values"); ?>..!",
					showConfirmButton: false,
					timer: 2500
				});
			} else if (correctDate != 0) {
				$('#sel-start-date').addClass('is-invalid');
				$('#sel-end-date').addClass('is-invalid');

				Swal.fire({
					position: "top-end",
					icon: "warning",
					text: "<?php echo lang("Text.reports_search_incorrect_date"); ?>..!",
					showConfirmButton: false,
					timer: 2500
				});
			}
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

	$('.form-control').on('focus', function() {
		$(this).removeClass('is-invalid');
	});
</script>