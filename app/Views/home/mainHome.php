<!-- Header -->
<?php echo view('layouts/header'); ?>

<body>
	<!-- Main Wrapper -->
	<div id="main-wrapper" class="auth-customizer-none">
		<div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
			<div class="d-flex align-items-center justify-content-center w-100">
				<div class="row justify-content-center w-100">
					<div class="col-md-8 col-lg-6 col-xxl-3 auth-card">
						<div class="card mb-0">
							<div class="card-body">
								<!-- Logo -->
								<span class="align-items-center d-flex justify-content-center logo-img mb-5 text-center text-nowrap w-100px">
									<?php if (!empty($profile->logo)) { ?>
										<img src="data:image/png;base64, <?php echo base64_encode($profile->logo); ?>" alt="logo" class="w-30 rounded-circle">
									<?php } else { ?>
										<img src="<?php echo base_url('public/assets/images/avatar/logoBlank.png') ?>" alt="logo" class="w-30 rounded-circle">
									<?php } ?>
								</span>

								<div class="position-relative text-center my-4">
									<p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative"><?php echo lang('Text.text_start_session'); ?></p>
									<span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
								</div>

								<!-- Form -->
								<form id="form-auth">
									<div class="mb-4">
										<label for="exampleInputPassword1" class="form-label"><?php echo lang('Text.text_access_key') ?></label>
										<input type="password" id="access-key" class="form-control" autofocus />
									</div>
									<div class="d-flex align-items-center justify-content-between mb-4">
										<div class="form-check">
											<input id="cbx-remember" class="form-check-input primary" type="checkbox" data-value="0" />
											<label class="form-check-label text-dark" for="cbx-remember">
												<?php echo lang('Text.text_remember_me'); ?>
											</label>
										</div>
									</div>
									<button type="button" id="sign-in" class="btn btn-primary w-100 py-8 mb-4 rounded-2"><?php echo lang('Text.text_log_in'); ?></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$('#sign-in').on('click', function() {
			let accessKey = $("#access-key").val();

			if (accessKey != "") {
				$.ajax({
					type: "post",
					url: "<?php echo base_url('Home/login'); ?>",
					data: {
						'accessKey': accessKey
					},
					dataType: "json",
					success: function(response) {
						if (response.error == 0) {
							let remember = $('#cbx-remember').attr('data-value');
							if (remember == 1) {
								localStorage.rememberbae = '1';
								localStorage.passbae = $('#access-key').val();
							}
							window.location.href = "<?php echo base_url('Dashboard'); ?>";
						} else if (response.error == 1) {
							Swal.fire({
								position: "top-end",
								icon: "error",
								text: "<?php echo lang("Text.text_error_invalid_access_key"); ?>..!",
								showConfirmButton: false,
								timer: 2500
							});

							$("#access-key").addClass("is-invalid");

							setTimeout(() => {
								$("#access-key").focus();
							}, 2900);
						} else if (response.error == 99) {
							globalError();
						}
					},
					error: function(error) {
						globalError();
					}
				});
			} else {
				Swal.fire({
					position: "top-end",
					icon: "error",
					text: "<?php echo lang("Text.text_error_empty_access_key"); ?>..!",
					showConfirmButton: false,
					timer: 2500
				});

				$("#access-key").addClass("is-invalid");

				setTimeout(() => {
					$("#access-key").focus();
				}, 2900);
			}
		});

		$("#access-key").on('input', function() {
			$(this).removeClass("is-invalid");
		});

		document.addEventListener("DOMContentLoaded", function() {
			let form = document.getElementById("form-auth");
			form.addEventListener("keypress", function(e) {
				if (e.key === "Enter") {
					e.preventDefault();
					$('#sign-in').trigger('click');
				}
			});
		});

		$(document).ready(function() {
			let msg = "<?php echo $msg; ?>";

			if (msg == "expired") {
				Swal.fire({
					position: "top-end",
					icon: "error",
					text: "<?php echo lang("Text.msg_session_expired"); ?>..!",
					showConfirmButton: false,
					timer: 2500
				});
			}
		});

		if (localStorage.rememberbae != undefined && localStorage.rememberbae != '') {
			$('#cbx-remember').trigger('click');
			$('#cbx-remember').attr('data-value', '1');

			let passInput = document.getElementById("access-key");
			passInput.value = localStorage.passbae;
		} else {
			clearRemember();
			$('#cbx-remember').attr('data-value', '0');
		}

		function clearRemember() {
			localStorage.rememberbae = '';
			localStorage.passbae = '';
		}

		$('#cbx-remember').on('click', function() {
			let value = $(this).attr('data-value');

			if (value == 0)
				$('#cbx-remember').attr('data-value', '1');
			else {
				$('#cbx-remember').attr('data-value', '0');
				clearRemember();
			}
		});
	</script>
</body>