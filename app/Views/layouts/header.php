<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="Software de Facturacion" name="description" />
	<meta content="Axley Herrera" name="author" />

	<!-- Favicon icon-->
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('public/assets/images/logos/favicon.png'); ?>" />

	<!-- css -->
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/styles.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/sweetalert/sweetalert2.css'); ?>" />

	<script>
		var userSettings = {
			Layout: "vertical", // vertical | horizontal
			SidebarType: "full", // full | mini-sidebar
			BoxedLayout: true, // true | false
			Direction: "ltr", // ltr | rtl
			Theme: "light", // light | dark
			ColorTheme: "Blue_Theme", // Blue_Theme | Aqua_Theme | Purple_Theme | Green_Theme | Cyan_Theme | Orange_Theme
			cardBorder: false, // true | false
		};
	</script>

	<!-- js -->
	<script src="<?php echo base_url('public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/assets/libs/jquery/3.7.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/assets/libs/sweetalert/sweetalert2.js'); ?>"></script>

	<script>
		function globalError() {
			Swal.fire({
				position: "top-end",
				icon: "error",
				text: "<?php echo lang("Text.msg_ajax_error"); ?>..!",
				showConfirmButton: false,
				timer: 2500
			});
		}
	</script>

	<title>Factu-Soft</title>
</head>