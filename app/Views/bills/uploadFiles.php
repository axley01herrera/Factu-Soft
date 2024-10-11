<script src="<?php echo base_url('public/assets/libs/dropzone/dist/min/dropzone.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/dropzone/dist/min/dropzone.min.css'); ?>">

<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo lang('Text.menu_bills'); ?></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6">
	</div>
</div>

<!-- Page Content -->
<div class="row">
	<div class="dropzone mb-5" id="dropzone">
		<div class="dz-message needsclick">
			<i class="ki-duotone ki-file-up fs-4x text-primary"><span class="path1"></span><span class="path2"></span></i>
			<div class="ms-4">
				<h3 class="fs-5 fw-bold text-gray-900 mb-1"><?php echo lang('Text.bil_upload_files_title'); ?></h3>
				<span class="fs-7 fw-semibold text-gray-500"><?php echo lang('Text.bil_upload_files_subtitle'); ?></span>
			</div>
		</div>
	</div>
</div>

<script>
	Dropzone.autoDiscover = false;

	let myDropzone = new Dropzone("#dropzone", {
		url: '<?php echo base_url('Bills/uploadFilesProccess'); ?>',
		method: 'post',
		acceptedFiles: 'image/*, application/*, text/*, .pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .zip, .rar, .7z, .gz, .bz2, .tar',
		addRemoveLinks: true,
		maxFiles: 10,
		autoProcessQueue: true,
		paramName: 'files',
		uploadMultiple: true,
		parallelUploads: 10,
		init: function() {
			dropzone = this;
			this.on("sending", function(file, xhr, formData) {});
		}
	});

	myDropzone.on("complete", function(response) {
		Swal.fire({
			position: "top-end",
			icon: "success",
			text: "<?php echo lang("Text.msg_success_upload_files"); ?>..!",
			showConfirmButton: false,
			timer: 2500
		});

		setTimeout(() => {
			myDropzone.removeAllFiles();
		}, 2500);

	});
</script>