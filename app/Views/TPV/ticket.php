<?php $baseImponible = 0; ?>
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

	<title>FactuHi</title>
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
				<b><?php echo lang('Text.ticket_establishment') ?>:</b>
				<br>
				<?php echo $profile->name; ?>
				<br>
				<?php echo $profile->company_id; ?>
				<br>
				<b><?php echo lang('Text.simple_invoice'); ?>:</b>
				<br>
				<?php echo $invoice[0]->number; ?>
				<br>
				<b><?php echo lang('Text.ticket_date'); ?>:</b>
				<br>
				<?php echo $invoice[0]->added; ?>

			</div>
		</div>

		<div class="row">
			<?php foreach ($items as $i) {
				$baseImponible = $baseImponible + $i->amount; ?>
				<div class="col-6 text-center mb-2 text-truncate">
					<?php echo 'x' . $i->quantity . ' ' .  getService($i->service_id)[0]->name; ?>
				</div>
				<div class="col-6 text-center mb-2">
					<?php echo getMoneyFormat($config[0]->currency, $i->amount); ?>
				</div>
			<?php } ?>
		</div>

		<hr>

		<div class="row">
			<div class="row">
				<div class="col-6 text-center mb-5">
					<?php echo lang('Text.ticket_pay_type') ?>
				</div>
				<div class="col-6 text-center mb-5">
					<?php
					if ($invoice[0]->pay_type == 1)
						echo lang("Text.card");
					else if ($invoice[0]->pay_type == 2)
						echo lang("Text.cash");
					?>
				</div>
			</div>

			<div class="col-6 text-center mb-1">
				<?php echo lang('Text.tax_base'); ?>
			</div>
			<div class="col-6 text-center mb-1">
				<?php echo getMoneyFormat($config[0]->currency, $baseImponible); ?>
			</div>

			<?php foreach ($invoiceTax as $it) { ?>

				<div class="<?php if (empty($it->taxPercent)) echo 'col-12';
							else echo 'col-6'; ?> text-center mb-1">
					<?php echo $it->taxDesc; ?>
				</div>


				<div class="<?php if (empty($it->taxPercent)) echo 'col-12';
							else echo 'col-6'; ?> text-center mb-1">
					<span id="tax-<?php echo $it->itID; ?>"></span>
				</div>
			<?php } ?>

			<?php
			$total = $baseImponible;
			foreach ($invoiceTax as $it) {
				$aux = 0;
				if ($it->taxPercent != 0) {
					$aux = $it->taxPercent / 100 * $baseImponible;
					if ($it->taxOperator == "-") {
						$total -= $aux;  // Forma abreviada de restar
					} else if ($it->taxOperator == "+") {
						$total += $aux;  // Forma abreviada de sumar
					}

					// Formatear el valor del impuesto
					$auxFormatted = getMoneyFormat($config[0]->currency, $aux);
					$auxFormatted = $it->taxOperator . $auxFormatted;

					// Escapar el valor formateado para evitar problemas de inyección de código
					$auxEscaped = htmlspecialchars($auxFormatted, ENT_QUOTES, 'UTF-8');

					// Usar JSON para evitar problemas de sintaxis en JavaScript
					echo "<script>document.getElementById('tax-" . $it->itID . "').innerHTML = " . json_encode($auxEscaped) . ";</script>";
				}
			}
			?>

			<div class="col-6 text-center mb-1">
				<b>Total</b>
			</div>
			<div class="col-6 text-center mb-1">
				<?php echo getMoneyFormat($config[0]->currency, $total); ?>
			</div>

		</div>
		<div class="row">
			<div class="col-12 text-center">
				<?php echo lang('Text.ticket_msg'); ?>..!
			</div>
		</div>
	</div>
</body>

<script>
	window.print();
</script>