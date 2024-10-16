<aside class="left-sidebar with-vertical">
	<div>

		<!-- Logo -->
		<div class="brand-logo d-flex align-items-center">
			<a href="<?php echo base_url('Dashboard'); ?>" class="text-nowrap logo-img">
				<img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="Logo" class="dark-logo">
			</a>
		</div>

		<nav class="sidebar-nav scroll-sidebar" data-simplebar>
			<ul class="sidebar-menu" id="sidebarnav">
				<!-- User Profile-->
				<li>
					<div class="user-profile text-center position-relative pt-4 mt-1">
						<div class="profile-img m-auto">
							<?php if (!empty($profile->logo)) { ?>
								<img src="data:image/png;base64, <?php echo base64_encode($profile->logo); ?>" alt="logo" class="w-100 rounded-circle">
							<?php } else { ?>
								<img src="<?php echo base_url('public/assets/images/avatar/logoBlank.png') ?>" alt="logo" class="w-100 rounded-circle">
							<?php } ?>
						</div>
					</div>
				</li>

				<li class="nav-small-cap">
					<span class="hide-menu"><?php echo lang('Text.menu_statistics') ?></span>
				</li>

				<!-- Dashboard -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$dashboardActive; ?>" href="<?php echo base_url('Dashboard'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
							<path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_dashboard'); ?></span>
					</a>
				</li>

				<!-- Reports -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$reportsActive; ?>" href="<?php echo base_url('Reports'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
							<g fill="none" stroke="currentColor" stroke-width="1.5">
								<path d="M16 4.002c2.175.012 3.353.109 4.121.877C21 5.758 21 7.172 21 10v6c0 2.829 0 4.243-.879 5.122C19.243 22 17.828 22 15 22H9c-2.828 0-4.243 0-5.121-.878C3 20.242 3 18.829 3 16v-6c0-2.828 0-4.242.879-5.121c.768-.768 1.946-.865 4.121-.877"></path>
								<path stroke-linecap="round" d="M8 14h8m-9-3.5h10m-8 7h6"></path>
								<path d="M8 3.5A1.5 1.5 0 0 1 9.5 2h5A1.5 1.5 0 0 1 16 3.5v1A1.5 1.5 0 0 1 14.5 6h-5A1.5 1.5 0 0 1 8 4.5z"></path>
							</g>
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_reports'); ?></span>
					</a>
				</li>

				<li class="nav-small-cap">
					<span class="hide-menu">SERV / CRM</span>
				</li>

				<!-- Services -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$servicesActive; ?>" href="<?php echo base_url('Services'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
							<g fill="none" stroke="currentColor" stroke-width="1.5">
								<path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z"></path>
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 15.8L7.143 17L10 14M6 8.8L7.143 10L10 7"></path>
								<path stroke-linecap="round" d="M13 9h5m-5 7h5"></path>
							</g>
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_services'); ?></span>
					</a>
				</li>

				<!-- Customer Profile -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$customerActive; ?>" href="<?php echo base_url('Customer'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
							<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_customers'); ?></span>
					</a>
				</li>

				<li class="nav-small-cap">
					<span class="hide-menu"><?php echo lang('Text.menu_invoices') ?></span>
				</li>

				<!-- TPV -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$tpvActive; ?>" href="<?php echo base_url('TPV'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
							<path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
							<path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
							<path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_tpv'); ?></span>
					</a>
				</li>

				<!-- Invoices -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$invoiceActive; ?>" href="<?php echo base_url('Invoice/invoice'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stickies" viewBox="0 0 16 16">
							<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1z" />
							<path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293z" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_invoice'); ?></span>
					</a>
				</li>

				<!-- Tickets -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$ticketActive; ?>" href="<?php echo base_url('Invoice/ticket'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stickies" viewBox="0 0 16 16">
							<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1z" />
							<path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293z" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_tickets'); ?></span>
					</a>
				</li>

				<!-- Invoice Series -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$invoiceSeriesActive; ?>" href="<?php echo base_url('Invoice/series'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ol" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5" />
							<path d="M1.713 11.865v-.474H2c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 0 1-.492.594v.033a.615.615 0 0 1 .569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V9H1.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 0 0-.342.338zM2.564 5h-.635V2.924h-.031l-.598.42v-.567l.629-.443h.635z" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_series'); ?></span>
					</a>
				</li>

				<!-- Invoice Taxs -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$invoiceTaxsActive; ?>" href="<?php echo base_url('Taxs'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
							<path fill="currentColor" fill-rule="evenodd" d="M14.325 3.75h-4.65A3.75 3.75 0 0 1 6.75 6.675v.65a3.75 3.75 0 0 1 2.925 2.925h4.65a3.75 3.75 0 0 1 2.925-2.925v-.65a3.75 3.75 0 0 1-2.925-2.925m.605-1.497q-.412-.004-.878-.003H9.948q-.466 0-.877.003a1 1 0 0 0-.164.003c-.452.008-.853.027-1.201.074c-.628.084-1.195.27-1.65.725c-.456.456-.642 1.023-.726 1.65c-.047.349-.066.75-.074 1.202a1 1 0 0 0-.003.163q-.004.413-.003.878v.104q0 .465.003.878a1 1 0 0 0 .003.163c.008.453.027.853.074 1.201c.084.628.27 1.195.726 1.65c.455.456 1.022.642 1.65.726c.348.047.749.066 1.201.074a1 1 0 0 0 .164.003q.411.004.877.003h4.104q.465 0 .878-.003a1 1 0 0 0 .163-.003c.453-.008.854-.027 1.201-.074c.628-.084 1.195-.27 1.65-.726c.456-.455.642-1.022.726-1.65a11 11 0 0 0 .074-1.201a1 1 0 0 0 .003-.163q.004-.413.003-.878v-.104q0-.465-.003-.878a1 1 0 0 0-.003-.163a11 11 0 0 0-.074-1.201c-.084-.628-.27-1.195-.725-1.65c-.456-.456-1.023-.642-1.65-.726a11 11 0 0 0-1.202-.074a1 1 0 0 0-.163-.003m.964 1.541a2.26 2.26 0 0 0 1.312 1.312a5 5 0 0 0-.023-.2c-.061-.462-.169-.66-.3-.79s-.327-.237-.788-.3a5 5 0 0 0-.2-.022m1.312 5.1a2.26 2.26 0 0 0-1.312 1.312q.105-.01.2-.022c.462-.063.66-.17.79-.3s.238-.328.3-.79q.012-.095.022-.2m-9.1 1.312a2.26 2.26 0 0 0-1.312-1.312q.01.105.023.2c.062.462.169.66.3.79s.327.237.788.3q.096.012.201.022m-1.312-5.1a2.26 2.26 0 0 0 1.312-1.312q-.105.01-.2.023c-.462.062-.66.169-.79.3s-.237.327-.3.788zM12 6.75a.25.25 0 1 0 0 .5a.25.25 0 0 0 0-.5M10.25 7a1.75 1.75 0 1 1 3.5 0a1.75 1.75 0 0 1-3.5 0m-1.566 7.448c1.866-.361 3.863-.28 5.48.684c.226.135.44.304.625.512c.376.423.57.947.579 1.473q.286-.186.577-.407l1.808-1.365a2.64 2.64 0 0 1 3.124 0c.835.63 1.169 1.763.57 2.723c-.425.681-1.065 1.624-1.717 2.228c-.66.61-1.597 1.124-2.306 1.466c-.862.416-1.792.646-2.697.792c-1.85.3-3.774.254-5.602-.123a14.3 14.3 0 0 0-2.865-.293H4a.75.75 0 0 1 0-1.5h2.26c1.062 0 2.135.111 3.168.324a14.1 14.1 0 0 0 5.06.111c.828-.134 1.602-.333 2.284-.662c.683-.33 1.451-.764 1.938-1.215c.493-.457 1.044-1.248 1.465-1.922c.127-.204.109-.497-.202-.732c-.37-.28-.947-.28-1.316 0l-1.807 1.365c-.722.545-1.61 1.128-2.711 1.304a9 9 0 0 1-.347.048q-.086.015-.179.02a10 10 0 0 1-1.932 0a.75.75 0 1 1 .141-1.493a8.5 8.5 0 0 0 1.668-.003l.03-.003a.742.742 0 0 0 .15-1.138a1.2 1.2 0 0 0-.275-.222c-1.181-.705-2.759-.822-4.426-.5a12.1 12.1 0 0 0-4.535 1.935a.75.75 0 0 1-.868-1.224a13.6 13.6 0 0 1 5.118-2.183" clip-rule="evenodd" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_taxs'); ?></span>
					</a>
				</li>

				<li class="nav-small-cap">
					<span class="hide-menu"><?php echo lang('Text.menu_bills'); ?></span>
				</li>

				<!-- Upload Files -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$uploadFileActive; ?>" href="<?php echo base_url('Bills/uploadFiles'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-upload">
							<path stroke="none" d="M0 0h24v24H0z" fill="none" />
							<path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
							<path d="M9 15l3 -3l3 3" />
							<path d="M12 12l0 9" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_upload_files'); ?></span>
					</a>
				</li>

				<!-- Files List -->
				<li class="sidebar-item">
					<a class="sidebar-link <?php echo @$fileListActive; ?>" href="<?php echo base_url('Bills/fileList'); ?>" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-files">
							<path stroke="none" d="M0 0h24v24H0z" fill="none" />
							<path d="M15 3v4a1 1 0 0 0 1 1h4" />
							<path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
							<path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_list_files'); ?></span>
					</a>
				</li>

				<li class="nav-small-cap">
					<span class="hide-menu"><?php echo lang('Text.menu_config'); ?></span>
				</li>

				<!-- Profile -->
				<li class="sidebar-item">
					<a href="<?php echo base_url('Profile'); ?>" class="sidebar-link <?php echo @$profileActive; ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-gear" viewBox="0 0 16 16">
							<path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1z" />
							<path d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.386 1.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_profile'); ?></span>
					</a>
				</li>

				<!-- System -->
				<li class="sidebar-item">
					<a href="<?php echo base_url('Config'); ?>" class="sidebar-link <?php echo @$configActive; ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
							<path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
							<path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_system'); ?></span>
					</a>
				</li>

				<!-- Change Access Key -->
				<li class="sidebar-item">
					<a id="btn-change-password" href="·" class="sidebar-link">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
							<path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
							<path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_access_key'); ?></span>
					</a>
				</li>

				<!-- Logout -->
				<li class="sidebar-item">
					<a href="<?php echo base_url('/'); ?>" class="sidebar-link">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
							<path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
						</svg>
						<span class="hide-menu"><?php echo lang('Text.menu_logout'); ?></span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</aside>

<script>
	$('#btn-change-password').on('click', function(e) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Profile/changePassword') ?>",
			data: "data",
			dataType: "html",
			success: function(response) {
				$('#app-modal').html(response);
			},
			error: function(error) {
				globalError();
			}
		});
	});
</script>