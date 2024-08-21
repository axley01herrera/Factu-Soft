<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Factu-Soft</title>
	<meta name="Factu-Soft" content="Factu-Soft" />
	<meta content="Factu-Soft" name="author" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('public/assets/images/logos/favicon.png'); ?>" />
</head>
<div align="center">
	<!-- Logo -->
	<div>
		<?php
		if (empty($profile->logo))
			$logo = base_url('public/assets/images/avatar/logoBlank.png');
		else
			$logo = "data:image/png;base64," . base64_encode($profile->logo);
		?>
		<img class="rounded-circle img-fluid" src="<?php echo $logo; ?>" alt="Image" width="75">
		<h3><?php echo $profile->name; ?></h3>
		<?php if (!empty($profile->company_id)) { ?>
			<p class="mb-0">CIF: <?php echo $profile->company_id; ?></p>
		<?php } ?>
	</div>

	<div>
		<!-- Tichet ID -->
		<p>Ticket ID: <?php echo $ticket[0]->basketID; ?></p>
		<!-- Tichet Datetime -->
		<p><?php echo date('Y-m-d G:i a', strtotime($ticket[0]->dateTime)) ?></p>
		<!-- Payment Type -->
		<p>
			<?php echo lang('Text.tpv_basket_payment_type_label'); ?>:
			<?php
			if ($ticket[0]->payType == 1)
				echo lang('Text.tpv_basket_payment_type_target');
			else if ($ticket[0]->payType == 2)
				echo lang('Text.tpv_basket_payment_type_cash');
			?>
		</p>
	</div>

	<table style="border: none;">
		<tbody>
			<?php $totalAmount = 0;
			foreach ($ticket as $t) {
				$totalAmount = (float) $totalAmount + (float) $t->amount; ?>
				<tr>
					<td>
						<?php echo $t->serviceName . ' x' . $t->quantity; ?>
					</td>
					<td class="text-end">
						<?php echo getMoneyFormat($config[0]->currency, $t->amount); ?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<p><?php echo 'Total : ' . getMoneyFormat($config[0]->currency, $totalAmount); ?></p>
	<p><?php echo /*ang('Text.cp_tpv_print_ticket_msg1');*/ 'Impuestos Incluidos'; ?></p>

	<!-- Company Info -->
	<div class="col-12 text-center">
		<span><?php echo $profile->address_a;
				if (!empty($profile->address_b)) echo ', ' . $profile->address_b; ?></span>
		<span><?php echo $profile->city . ', ' . $profile->state; ?></span>
		<span><?php echo $profile->zip . ' ' . $profile->country; ?></span>
	</div>
</div>

</body>

</html>

<script>
	window.print();
</script>