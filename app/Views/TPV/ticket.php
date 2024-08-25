<?php $total = 0; ?>
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

	<!-- js -->
	<script src="<?php echo base_url('public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>

	<title>Factu-Soft</title>
</head>

<body>
	<div class="container mt-10">
		<div class="row">
			<div class="col-12 text-center mb-2">
				<?php if (!empty($profile->logo)) { ?>
					<img src="data:image/png;base64, <?php echo base64_encode($profile->logo); ?>" alt="logo" class="rounded-circle" style="width: 150px;">
				<?php } else { ?>
					<img src="<?php echo base_url('public/assets/images/avatar/logoBlank.png') ?>" alt="logo" class="rounded-circle" style="width: 150px;">
				<?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="col-12 text-center mb-2">
				<b><?php echo lang('Text.ticket_establishment')?>:</b>
				<br>
				<?php echo $profile->name; ?>
				<br>
				<?php echo $profile->company_id; ?>
				<br>
				<b><?php echo lang('Text.ticket_date'); ?>:</b>
				<br>
				<?php echo $invoice[0]->added; ?>
				<br>
				<b>Ticket #:</b>
				<br>
				<?php echo $invoice[0]->number; ?>
			</div>
		</div>

		<div class="row">
			<?php foreach ($items as $i) {
				$total = $total + $i->amount; ?>
				<div class="col-6 text-center mb-2">
					<?php echo getService($i->service_id)[0]->name . ' x ' . $i->quantity; ?>
				</div>
				<div class="col-6 text-center mb-2">
					<?php echo getMoneyFormat($config[0]->currency, $i->amount); ?>
				</div>
			<?php } ?>
		</div>

		<hr>

		<div class="row">

			<div class="col-6 text-center">
				<b>Total:</b>
			</div>
			<div class="col-6 text-center">
				<?php echo getMoneyFormat($config[0]->currency, $total); ?>
			</div>

		</div>

		<div class="row">
			<div class="col-6 text-center mb-5">
				<b><?php echo lang('Text.ticket_pay_type')?>:</b>
			</div>
			<div class="col-6 text-center mb-5">
				<?php
					if($invoice[0]->pay_type == 1)
						echo lang("Text.card");
					else if($invoice[0]->pay_type == 2)
						echo lang("Text.cash");
				?>
			</div>
		</div>

		<div class="row">
			<div class="col-12 text-center">
				<?php echo lang('Text.ticket_msg');?>..!
			</div>
		</div>
	</div>
</body>

<script>
	window.print();
</script>