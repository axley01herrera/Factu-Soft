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
                                <span class="align-items-center d-flex justify-content-center logo-img mb-5 text-center text-nowrap w-100">
                                    <img src="<?php echo base_url('public/assets/images/logos/dark-logo.svg'); ?>" class="dark-logo" alt="Factu-Soft" />
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
                                            <input id="cbx-rememberme" class="form-check-input primary" type="checkbox" checked />
                                            <label class="form-check-label text-dark" for="cbx-rememberme">
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
                            window.location.href = "<?php echo base_url('Dashboard/index'); ?>";
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

        $(document).ready(function () {
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
    </script>
</body>