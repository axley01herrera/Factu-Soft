<style>
	@media print {
		.no-print {
			display: none;
		}
	}
</style>

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
	<link rel="stylesheet" href="<?php echo base_url('public/assets/libs/sweetalert/sweetalert2.css'); ?>" />

	<!-- js -->
	<script src="<?php echo base_url('public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/assets/libs/jquery/3.7.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/assets/libs/sweetalert/sweetalert2.js'); ?>"></script>

	<title>Factu-Soft</title>
</head>

<body>
	<div class="container mt-10">
		<div class="row">
			<?php if ($status <> 2) { ?>
				<div class="col-6 mb-4">
					<h5><?php echo lang('Text.inv_number_label'); ?></h5>
					<?php echo $invoice[0]->number; ?>
				</div>
				<div class="col-6 mb-4 text-end">
					<h5><?php echo lang('Text.inv_issue_date'); ?></h5>
					<?php echo $invoice[0]->added; ?>
				</div>
			<?php } ?>
			<div class="col-12 mb-4 text-center">
				<?php echo $status_label; ?>
				<?php if ($status == 4) { ?>
					<h4 class="mt-3 mb-0"><?php echo lang('Text.inv_rectified_invoice'); ?></h4>
					<h4><?php echo '<span class="fw-bold">' . $invoiceRectified[0]->number . '</span>'; ?></h4>
				<?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="col-6 mb-5">
				<b><?php echo lang('Text.inv_from_label'); ?></b>:
				<br>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
					<path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
					<path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
				</svg>
				<?php echo $profile->name; ?>
				<br>
				<?php echo $profile->company_id; ?>
				<br><br>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
					<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
					<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
				</svg>
				<?php echo $profile->address_a; ?>
				<br>
				<?php echo $profile->city; ?>, <?php echo $profile->state; ?>
				<br>
				<?php echo $profile->zip; ?>, <?php echo $profile->country; ?>
				<br><br>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
					<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
				</svg>
				<?php echo $profile->phone; ?>
				<br>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
					<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
				</svg>
				<?php echo $profile->email; ?>
			</div>

			<div class="col-6 mb-5 text-end">
				<b><?php echo lang('Text.inv_to_label'); ?></b>:
				<br>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
					<path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
					<path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
				</svg>
				<?php echo @$customer[0]->name; ?>
				<br>
				<?php echo @$customer[0]->nif; ?>
				<?php if (!empty($customer[0]->address_a)) { ?>
					<br><br>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
						<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
						<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
					</svg>
					<?php echo @$customer[0]->address_a; ?>
					<br>
					<?php echo @$customer[0]->address_city; ?>, <?php echo @$customer[0]->address_state; ?>
					<br>
					<?php echo @$customer[0]->address_zip; ?>, <?php echo @$customer[0]->address_country; ?>
				<?php } ?>
				<?php if (!empty($customer[0]->phone)) { ?>
					<br><br>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
						<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
					</svg>
				<?php } ?>
				<?php echo @$customer[0]->phone; ?>
				<?php if (!empty($customer[0]->email)) { ?>
					<br>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
						<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
					</svg>
				<?php } ?>
				<?php echo @$customer[0]->email; ?>
			</div>
		</div>

		<!-- Items -->
		<div class="row">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<th><?php echo lang('Text.inv_dt_item_col_qty'); ?></th>
						<th><?php echo lang('Text.inv_dt_item_col_desc'); ?></th>
						<th class="text-end"><?php echo lang('Text.inv_dt_item_col_price'); ?></th>
						<th class="text-end"><?php echo lang('Text.inv_dt_item_col_amount'); ?></th>
					</thead>
					<tbody>
						<?php foreach ($items as $i) {
							$total = $total + $i->amount; ?>
							<tr>
								<td><?php echo 'x' . $i->quantity; ?></td>
								<td><?php echo $i->description; ?></td>
								<td class="text-end"><?php echo getMoneyFormat($config[0]->currency, $i->price); ?></td>
								<td class="text-end"><?php echo getMoneyFormat($config[0]->currency, $i->amount); ?></td>
							</tr>
						<?php } ?>

						<?php if (empty($items)) { ?>
							<tr>
								<td colspan="3" class="text-center">
									<span class="text-danger"><?php echo lang('Text.inv_not_invoice_lines'); ?></span>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Total -->
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right mt-4 text-end">
					EXENTO IGIC. REPEP, REGIMEN PEQUEÑO EMPRESARIO O PROFESIONAL
					<h3>
						<b>Total :</b> <?php echo getMoneyFormat($config[0]->currency, $total); ?>
					</h3>
				</div>
			</div>
		</div>

		<!-- Actions -->
		<div class="mt-10 text-end no-print">
			<?php if ($status == 3) { ?>
				<!-- Btn Pay -->
				<button type="button" id="btn-pay" class="btn btn-muted">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank me-1" viewBox="0 0 16 16">
						<path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"></path>
					</svg>
					<?php echo lang('Text.inv_set_paid'); ?>
				</button>

				<!-- Btn rectified -->
				<button type="button" id="btn-rectified" class="btn btn-muted">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-x me-1" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708"></path>
						<path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"></path>
						<path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"></path>
					</svg>
					<?php echo lang('Text.inv_create_rec'); ?>
				</button>
			<?php } ?>

			<!-- Btn Print -->
			<button type="button" id="btn-print" class="btn btn-muted">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer me-1" viewBox="0 0 16 16">
					<path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"></path>
					<path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"></path>
				</svg>
				<?php echo lang('Text.btn_print'); ?>
			</button>

		</div>
	</div>
</body>

</html>

<script>
	let invoiceID = "<?php echo $invoice[0]->id; ?>";

	$('#btn-pay').on('click', function() {
		Swal.fire({
			title: '<?php echo lang('Text.pay_inv_are_you_sure_msg'); ?>',
			text: "<?php echo lang('Text.pay_inv_not_revert_this_msg'); ?>",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '<?php echo lang('Text.pay_inv_yes_pay_msg'); ?>',
			cancelButtonText: '<?php echo lang('Text.no_cancel_msg'); ?>'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('Invoice/payInvoice'); ?>",
					data: {
						'id': invoiceID
					},
					dataType: "json",
					success: function(response) {
						if (response.error == 0) {
							window.location.reload();
						} else if (response.error == 2)
							window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
						else
							globalError();
					},
					error: function(error) {
						globalError();
					}
				});
			}
		});
	});

	$('#btn-rectified').on('click', function() {
		Swal.fire({
			title: '<?php echo lang('Text.rectify_inv_are_you_sure_msg'); ?>',
			text: "<?php echo lang('Text.rectify_inv_not_revert_this_msg'); ?>",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '<?php echo lang('Text.rectify_inv_yes_rectify_msg'); ?>',
			cancelButtonText: '<?php echo lang('Text.no_cancel_msg'); ?>'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = "<?php echo base_url('Invoice/rectifyInvoice?id='); ?>" + invoiceID;
			}
		});
	});

	$('#btn-print').on('click', function() {
		window.print();
	});
</script>