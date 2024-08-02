<!-- Header -->
<?php echo view('layouts/header'); ?>

<body>
	<div id="main-wrapper">
		<!-- LEFT SIDE BAR -->
		<aside class="left-sidebar with-vertical">
			<div>
				<div class="brand-logo d-flex align-items-center">
					<div class="text-nowrap logo-img">
						<img src="<?php echo base_url('public/assets/images/logos/dark-logo.svg'); ?>" alt="Logo" class="dark-logo" />

					</div>
				</div>
				<nav class="sidebar-nav scroll-sidebar" data-simplebar>
					<ul class="sidebar-menu" id="sidebarnav">
						<li>
							<div class="user-profile text-center position-relative pt-4 mt-1">
								<div class="profile-img m-auto">
									<img src="<?php echo base_url('public/assets/images/profile/user-1.jpg'); ?>" alt="user" class="w-100 rounded-circle" />
								</div>
								<div class="profile-text py-2 dropdown-center hide-menu">
									<a href="javascript:void(0)" class="dropdown-toggle link u-dropdown" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe <span class="caret"></span>
									</a>
									<div class="dropdown-menu">
										<a class="dropdown-item d-flex align-items-center gap-2" href="./main/page-user-profile.html">
											<iconify-icon icon="solar:user-linear" class="fs-5 text-primary"></iconify-icon>
											My Profile
										</a>
										<a class="dropdown-item d-flex align-items-center gap-2" href="./main/page-user-profile.html">
											<iconify-icon icon="solar:card-linear" class="fs-5 text-primary"></iconify-icon>
											My Balance
										</a>
										<a class="dropdown-item d-flex align-items-center gap-2" href="./main/app-email.html">
											<iconify-icon icon="solar:inbox-linear" class="fs-5 text-primary"></iconify-icon>
											Inbox
										</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item d-flex align-items-center gap-2" href="./main/page-account-settings.html">
											<iconify-icon icon="solar:settings-linear" class="fs-5 text-primary"></iconify-icon>
											Account Setting
										</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item d-flex align-items-center gap-2" href="./main/authentication-login.html">
											<iconify-icon icon="solar:login-2-linear" class="fs-5 text-primary"></iconify-icon>
											Logout
										</a>
										<div class="dropdown-divider"></div>
										<div class="p-2">
											<button type="button" class="btn d-block w-100 btn-info">
												View Profile
											</button>
										</div>
									</div>
								</div>
							</div>
						</li>
						<!-- DASHBOARD -->
						<li class="nav-small-cap">
							<iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
							<span class="hide-menu">Inicio</span>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link <?php if ($tab == 'dashboard') echo 'active'; ?>" href="<?php echo base_url('Dashboard'); ?>" aria-expanded="false">
								<iconify-icon icon="solar:screencast-2-linear"></iconify-icon>
								<span class="hide-menu">Tablero</span>
							</a>
						</li>
						<!-- CLIENTS -->
						<li class="nav-small-cap">
							<iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
							<span class="hide-menu">Clientes</span>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link <?php if ($tab == 'clients' && $subTab == 'list') echo 'active'; ?>" href="<?php echo base_url('Clients'); ?>" aria-expanded="false">
								<iconify-icon icon="solar:screencast-2-linear"></iconify-icon>
								<span class="hide-menu">Listado de Clientes</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link <?php if ($tab == 'clients' && $subTab == 'create') echo 'active'; ?>" href="<?php echo base_url('Clients/createClientModal'); ?>" aria-expanded="false">
								<iconify-icon icon="solar:screencast-2-linear"></iconify-icon>
								<span class="hide-menu">Crear Cliente</span>
							</a>
						</li>
						<!-- COMPANY -->
						<li class="nav-small-cap">
							<iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
							<span class="hide-menu">Compañía</span>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link <?php if ($tab == 'company') echo 'active'; ?>" href="<?php echo base_url('Company'); ?>" aria-expanded="false">
								<iconify-icon icon="solar:screencast-2-linear"></iconify-icon>
								<span class="hide-menu">Configuración</span>
							</a>
						</li>
					</ul>
				</nav>

				<div class="sidebar-footer hide-menu">
					<a href="" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings"><iconify-icon icon="solar:settings-linear"></iconify-icon></a>
					<a href="" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"><iconify-icon icon="solar:inbox-linear"></iconify-icon></a>
					<a href="" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"><iconify-icon icon="solar:power-bold"></iconify-icon></a>
				</div>
			</div>
		</aside>
		<!-- PAGE -->
		<div class="page-wrapper">
			<header class="topbar">
				<div class="with-vertical">
					<nav class="navbar navbar-expand-lg p-0">
						<ul class="navbar-nav">
							<li class="nav-item nav-icon-hover-bg dark rounded-circle d-flex">
								<a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
									<iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-6"></iconify-icon>
								</a>
							</li>
							<li class="nav-item dropdown nav-icon-hover-bg dark rounded-circle d-none d-xl-flex">
								<a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
									<iconify-icon icon="solar:bell-bing-line-duotone" class="fs-6"></iconify-icon>
									<div class="notify">
										<span class="heartbit"></span>
										<span class="point"></span>
									</div>
								</a>
								<div class="dropdown-menu content-dd dropdown-menu-animate-up" aria-labelledby="drop2">
									<div class="py-3 px-4 border-bottom">
										<h5 class="mb-0 fs-4 fw-normal">Notifications</h5>
									</div>
									<div class="message-body" data-simplebar>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-danger">
												<iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Launch Admin</h6>
													<span class="d-block fs-2 text-body-color">9:30 AM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just see the my new admin!</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
												<iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Event today</h6>
													<span class="d-block fs-2 text-body-color">9:15 AM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just a reminder that you have event</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
												<iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Settings</h6>
													<span class="d-block fs-2 text-body-color">4:36 PM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">You can customize this template as you want</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-warning-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-warning">
												<iconify-icon icon="solar:widget-4-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Launch Admin</h6>
													<span class="d-block fs-2 text-body-color">9:30 AM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just see the my new admin!</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
												<iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Event today</h6>
													<span class="d-block fs-2 text-body-color">9:15 AM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just a reminder that you have event</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
												<iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Settings</h6>
													<span class="d-block fs-2 text-body-color">4:36 PM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">You can customize this template as you want</span>
											</div>
										</a>
									</div>
									<div>
										<a class="d-flex align-items-center pt-3 pb-2 justify-content-center link-primary text-dark" href="javascript:void(0);">
											<span class="fw-semibold">Check all notifications</span>
											<iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
										</a>
									</div>

								</div>
							</li>
							<li class="nav-item dropdown nav-icon-hover-bg dark rounded-circle d-none d-xl-flex">
								<a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
									<iconify-icon icon="solar:inbox-line-duotone" class="fs-6"></iconify-icon>
									<div class="notify">
										<span class="heartbit"></span>
										<span class="point"></span>
									</div>
								</a>
								<div class="dropdown-menu content-dd dropdown-menu-animate-up" aria-labelledby="drop2">
									<div class="py-3 px-4 border-bottom">
										<h5 class="mb-0 fs-4 fw-normal">You have 4 new messages</h5>
									</div>
									<div class="message-body" data-simplebar>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-5.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-warning border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Mathew Anderson</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just see the my new admin!</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-3.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Bianca Anderson</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:10 AM</span>
												</div>

												<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just a reminder that you have event</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-6.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Andrew Johnson</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:08 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">You can customize this template as you want</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-7.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
												</button>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Mark Strokes</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just see the my new admin!</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-8.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Mark, Stoinus & Rishvi..</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:10 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just a reminder that you have event</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-9.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-warning border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Settings</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:08 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">You can customize this template as you want</span>
											</div>
										</a>
									</div>
									<div>
										<a class="d-flex align-items-center pt-3 pb-2 justify-content-center link-primary text-dark" href="javascript:void(0);">
											<span class="fw-semibold">See all e-Mails</span>
											<iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
										</a>
									</div>

								</div>
							</li>
							<li class="nav-item dropdown nav-icon-hover-bg dark rounded-circle d-none d-xl-flex">
								<div class="hover-dd">
									<a class="nav-link" id="drop2" href="javascript:void(0)" aria-haspopup="true" aria-expanded="false">
										<iconify-icon icon="solar:widget-3-line-duotone" class="fs-6"></iconify-icon>
									</a>
									<div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0 overflow-hidden" aria-labelledby="drop2">
										<div class="position-relative">
											<div class="row">
												<div class="col-8">
													<div class="p-4 pb-3">
														<div class="row">
															<div class="col-6">
																<div class="position-relative">
																	<a href="./main/app-chat.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-primary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:chat-line-linear" class="text-primary fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Chat Application</h6>
																			<span class="fs-11 d-block text-muted">New messages arrived</span>
																		</div>
																	</a>
																	<a href="./main/app-invoice.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-secondary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:bill-list-linear" class="text-secondary fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Invoice App</h6>
																			<span class="fs-11 d-block text-muted">Get latest invoice</span>
																		</div>
																	</a>
																	<a href="./main/app-contact2.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-warning-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:bedside-table-2-linear" class="text-warning fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Contact Application</h6>
																			<span class="fs-11 d-block text-muted">2 Unsaved Contacts</span>
																		</div>
																	</a>
																	<a href="./main/app-email.html" class="d-flex align-items-center position-relative">
																		<div class="bg-danger-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:letter-unread-linear" class="text-danger fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Email App</h6>
																			<span class="fs-11 d-block text-muted">Get new emails</span>
																		</div>
																	</a>
																</div>
															</div>
															<div class="col-6">
																<div class="position-relative">
																	<a href="./main/page-user-profile.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-success-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:cart-large-2-linear" class="text-success fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">User Profile</h6>
																			<span class="fs-11 d-block text-muted">learn more information</span>
																		</div>
																	</a>
																	<a href="./main/app-calendar.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-primary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:calendar-linear" class="text-primary fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Calendar App</h6>
																			<span class="fs-11 d-block text-muted">Get dates</span>
																		</div>
																	</a>
																	<a href="./main/app-contact.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-secondary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:bedside-table-linear" class="text-secondary fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Contact List Table</h6>
																			<span class="fs-11 d-block text-muted">Add new contact</span>
																		</div>
																	</a>
																	<a href="./main/app-notes.html" class="d-flex align-items-center position-relative">
																		<div class="bg-warning-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:palette-linear" class="text-warning fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Notes Application</h6>
																			<span class="fs-11 d-block text-muted">To-do and Daily tasks</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													</div>
													<div class="row align-items-center border-top">
														<div class="col-8">
															<div class="ps-3 py-3">
																<a class="text-dark d-flex align-items-center lh-1 fs-3" href="javascript:void(0)">
																	<i class="ti ti-help fs-5 me-2"></i>Frequently Asked Questions
																</a>
															</div>
														</div>
														<div class="col-4">
															<div class="d-flex justify-content-end pe-2 py-3">
																<button class="btn btn-primary">Check</button>
															</div>
														</div>
													</div>
												</div>
												<div class="col-4 ms-n3">
													<div class="position-relative p-3 border-start h-100">
														<h5 class="fs-5 mb-9 fw-semibold">Quick Links</h5>
														<ul>
															<li class="mb-3">
																<a class="fs-3" href="./main/page-pricing.html">Pricing Page</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/authentication-login.html">Authentication Design</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/authentication-register.html">Register Now</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/authentication-error.html">404 Error Page</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/app-notes.html">Notes App</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/page-user-profile.html">User Application</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/page-account-settings.html">Account Settings</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>

						<div class="d-block d-lg-none py-4 py-xl-0">
							<img src="<?php echo base_url('public/assets/images/logos/light-logo.svg'); ?>" alt="Logo" />
						</div>
						<ul class="navbar-nav navbar-toggler p-0 border-0">
							<li class="nav-item nav-icon-hover-bg dark rounded-circle d-flex">
								<a class="nav-link rounded-circle" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
									<iconify-icon icon="solar:menu-dots-bold-duotone" class="fs-6"></iconify-icon>
								</a>
							</li>
						</ul>

						<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
							<div class="d-flex align-items-center justify-content-between">
								<ul class="navbar-nav d-flex d-xl-none flex-row">
									<li class="nav-item hover-dd dropdown">
										<a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" aria-expanded="false">
											<iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
											<div class="notify">
												<span class="heartbit"></span>
												<span class="point"></span>
											</div>
										</a>
										<div class="dropdown-menu dropdown-menu-start content-dd dropdown-menu-animate-up mailbox" aria-labelledby="drop2">
											<div class="py-3 px-4 border-bottom">
												<h5 class="mb-0 fs-4 fw-normal">Notifications</h5>
											</div>
											<div class="message-body" data-simplebar>
												<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
													<span class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-danger">
														<iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
													</span>
													<div class="w-75 d-inline-block ">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 fw-semibold">Launch Admin</h6>
															<span class="d-block fs-2 text-body-color">9:30 AM</span>
														</div>
														<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just see the my new admin!</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
													<span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
														<iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
													</span>
													<div class="w-75 d-inline-block ">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 fw-semibold">Event today</h6>
															<span class="d-block fs-2 text-body-color">9:15 AM</span>
														</div>
														<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just a reminder that you have event</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
													<span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
														<iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
													</span>
													<div class="w-75 d-inline-block ">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 fw-semibold">Settings</h6>
															<span class="d-block fs-2 text-body-color">4:36 PM</span>
														</div>
														<span class="d-block text-truncate text-truncate fs-11 text-body-color">You can customize this template as you want</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
													<span class="flex-shrink-0 bg-warning-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-warning">
														<iconify-icon icon="solar:widget-4-line-duotone"></iconify-icon>
													</span>
													<div class="w-75 d-inline-block ">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 fw-semibold">Launch Admin</h6>
															<span class="d-block fs-2 text-body-color">9:30 AM</span>
														</div>
														<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just see the my new admin!</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
													<span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
														<iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
													</span>
													<div class="w-75 d-inline-block ">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 fw-semibold">Event today</h6>
															<span class="d-block fs-2 text-body-color">9:15 AM</span>
														</div>
														<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just a reminder that you have event</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
													<span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
														<iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
													</span>
													<div class="w-75 d-inline-block ">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 fw-semibold">Settings</h6>
															<span class="d-block fs-2 text-body-color">4:36 PM</span>
														</div>
														<span class="d-block text-truncate text-truncate fs-11 text-body-color">You can customize this template as you want</span>
													</div>
												</a>
											</div>
											<div>
												<a class="d-flex align-items-center pt-3 pb-2 justify-content-center link-primary text-dark" href="javascript:void(0);">
													<span class="fw-semibold">Check all notifications</span>
													<iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
												</a>
											</div>

										</div>
									</li>
									<li class="nav-item hover-dd dropdown">
										<a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" aria-expanded="false">
											<iconify-icon icon="solar:inbox-linear" class="fs-6"></iconify-icon>
											<div class="notify">
												<span class="heartbit"></span>
												<span class="point"></span>
											</div>
										</a>
										<div class="dropdown-menu dropdown-menu-start content-dd dropdown-menu-animate-up mailbox" aria-labelledby="drop2">
											<div class="py-3 px-4 border-bottom">
												<h5 class="mb-0 fs-4 fw-normal">You have 4 new messages</h5>
											</div>
											<div class="message-body" data-simplebar>
												<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
													<span class="user-img position-relative d-inline-block">
														<img src="<?php echo base_url('public/assets/images/profile/user-5.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
														<span class="position-absolute top-0 start-100 translate-middle p-1 bg-warning border border-light rounded-circle">
															<span class="visually-hidden">New alerts</span>
														</span>
													</span>
													<div class="w-75 d-inline-block">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 lh-base">Mathew Anderson</h6>
															<span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
														</div>
														<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just see the my new admin!</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
													<span class="user-img position-relative d-inline-block">
														<img src="<?php echo base_url('public/assets/images/profile/user-3.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
														<span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
															<span class="visually-hidden">New alerts</span>
														</span>
													</span>
													<div class="w-75 d-inline-block">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 lh-base">Bianca Anderson</h6>
															<span class="fs-2 text-nowrap d-block text-body-color">9:10 AM</span>
														</div>

														<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just a reminder that you have event</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
													<span class="user-img position-relative d-inline-block">
														<img src="<?php echo base_url('public/assets/images/profile/user-6.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
														<span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
															<span class="visually-hidden">New alerts</span>
														</span>
													</span>
													<div class="w-75 d-inline-block">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 lh-base">Andrew Johnson</h6>
															<span class="fs-2 text-nowrap d-block text-body-color">9:08 AM</span>
														</div>
														<span class="fs-2 d-block text-truncate text-truncate text-body-color">You can customize this template as you want</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
													<span class="user-img position-relative d-inline-block">
														<img src="<?php echo base_url('public/assets/images/profile/user-7.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
														<span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
															<span class="visually-hidden">New alerts</span>
														</span>
														</button>
													</span>
													<div class="w-75 d-inline-block">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 lh-base">Mark Strokes</h6>
															<span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
														</div>
														<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just see the my new admin!</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
													<span class="user-img position-relative d-inline-block">
														<img src="<?php echo base_url('public/assets/images/profile/user-8.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
														<span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
															<span class="visually-hidden">New alerts</span>
														</span>
													</span>
													<div class="w-75 d-inline-block">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 lh-base">Mark, Stoinus & Rishvi..</h6>
															<span class="fs-2 text-nowrap d-block text-body-color">9:10 AM</span>
														</div>
														<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just a reminder that you have event</span>
													</div>
												</a>
												<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
													<span class="user-img position-relative d-inline-block">
														<img src="<?php echo base_url('public/assets/images/profile/user-9.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
														<span class="position-absolute top-0 start-100 translate-middle p-1 bg-warning border border-light rounded-circle">
															<span class="visually-hidden">New alerts</span>
														</span>
													</span>
													<div class="w-75 d-inline-block">
														<div class="d-flex align-items-center justify-content-between">
															<h6 class="mb-1 lh-base">Settings</h6>
															<span class="fs-2 text-nowrap d-block text-body-color">9:08 AM</span>
														</div>
														<span class="fs-2 d-block text-truncate text-truncate text-body-color">You can customize this template as you want</span>
													</div>
												</a>
											</div>
											<div>
												<a class="d-flex align-items-center pt-3 pb-2 justify-content-center link-primary text-dark" href="javascript:void(0);">
													<span class="fw-semibold">See all e-Mails</span>
													<iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
												</a>
											</div>

										</div>
									</li>
									<li class="nav-item dropdown mega-dropdown">
										<a href="javascript:void(0)" class="nav-link nav-icon-hover-bg dark rounded-circle d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
											<iconify-icon icon="solar:widget-linear" class="fs-6"></iconify-icon>
										</a>
									</li>
								</ul>
								<ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">

									<li class="nav-item search-box d-none d-xl-flex align-items-center">
										<div class="nav-link">
											<form class="app-search position-relative">
												<input type="text" class="form-control rounded-pill border-0 shadow-none" placeholder="Search for..." />
												<a href="javascript:void(0)" class="srh-btn">
													<iconify-icon icon="solar:magnifer-linear" class="position-absolute top-50 end-0 translate-middle-y me-2 fs-5"></iconify-icon>
												</a>
											</form>
										</div>
									</li>
									<li class="nav-item">
										<a class="nav-link moon dark-layout nav-icon-hover-bg dark rounded-circle" href="javascript:void(0)">
											<iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
										</a>
										<a class="nav-link sun light-layout nav-icon-hover-bg dark rounded-circle" href="javascript:void(0)" style="display: none">
											<iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
										</a>
									</li>
									<li class="nav-item dropdown nav-icon-hover-bg dark rounded-circle">
										<a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
											<img src="<?php echo base_url('public/assets/images/flag/icon-flag-en.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
										</a>
										<div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
											<div class="message-body">
												<a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
													<div class="position-relative">
														<img src="<?php echo base_url('public/assets/images/flag/icon-flag-en.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
													</div>
													<p class="mb-0 fs-3">English (UK)</p>
												</a>
												<a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
													<div class="position-relative">
														<img src="<?php echo base_url('public/assets/images/flag/icon-flag-cn.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
													</div>
													<p class="mb-0 fs-3">中国人 (Chinese)</p>
												</a>
												<a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
													<div class="position-relative">
														<img src="<?php echo base_url('public/assets/images/flag/icon-flag-fr.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
													</div>
													<p class="mb-0 fs-3">français (French)</p>
												</a>
												<a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
													<div class="position-relative">
														<img src="<?php echo base_url('public/assets/images/flag/icon-flag-sa.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
													</div>
													<p class="mb-0 fs-3">عربي (Arabic)</p>
												</a>
											</div>
										</div>
									</li>
									<li class="nav-item dropdown">
										<a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
											<div class="d-flex align-items-center lh-base">
												<img src="<?php echo base_url('public/assets/images/profile/user-1.jpg'); ?>" class="rounded-circle" width="35" height="35" alt="monster-img" />
											</div>
										</a>
										<div class="dropdown-menu content-dd dropdown-menu-end animated flipInY" aria-labelledby="drop1">
											<div class="profile-dropdown position-relative" data-simplebar>
												<div class="py-3 px-7 pb-0">
													<h5 class="mb-0 fs-5">User Profile</h5>
												</div>
												<div class="d-flex align-items-center py-9 mx-7 border-bottom">
													<img src="<?php echo base_url('public/assets/images/profile/user-1.jpg'); ?>" class="rounded-circle" width="80" height="80" alt="" />
													<div class="ms-3">
														<h5 class="mb-1 fs-4">Markarn Doe</h5>
														<span class="mb-1 d-block">Designer</span>
														<p class="mb-0 d-flex align-items-center gap-2">
															<i class="ti ti-mail fs-4"></i> info@monster.com
														</p>
													</div>
												</div>
												<div class="message-body">
													<a href="./main/page-user-profile.html" class="py-8 px-7 mt-8 d-flex align-items-center">
														<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
															<iconify-icon icon="solar:user-circle-line-duotone"></iconify-icon>
														</span>
														<div class="w-75 d-inline-block v-middle ps-3">
															<h6 class="mb-1 fs-3 lh-base">My Profile</h6>
															<span class="fs-2 d-block text-body-secondary">Account Settings</span>
														</div>
													</a>
													<a href="./main/app-email.html" class="py-8 px-7 d-flex align-items-center">
														<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
															<iconify-icon icon="solar:inbox-line-line-duotone"></iconify-icon>
														</span>
														<div class="w-75 d-inline-block v-middle ps-3">
															<h6 class="mb-1 fs-3 lh-base">My Inbox</h6>
															<span class="fs-2 d-block text-body-secondary">Messages & Emails</span>
														</div>
													</a>
													<a href="./main/app-kanban.html" class="py-8 px-7 d-flex align-items-center">
														<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
															<iconify-icon icon="solar:checklist-minimalistic-line-duotone"></iconify-icon>
														</span>
														<div class="w-75 d-inline-block v-middle ps-3">
															<h6 class="mb-1 fs-3 lh-base">My Task</h6>
															<span class="fs-2 d-block text-body-secondary">To-do and Daily Tasks</span>
														</div>
													</a>
												</div>
												<div class="d-grid py-4 px-7 pt-8">
													<a href="<?php echo base_url('/') ?>" class="btn btn-info">Log Out</a>
												</div>
											</div>

										</div>
									</li>
								</ul>
							</div>
						</div>
					</nav>
					<div class="offcanvas offcanvas-start pt-0" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
						<nav class="sidebar-nav scroll-sidebar">
							<div class="offcanvas-header justify-content-between ps-0 pt-0">
								<div class="brand-logo d-flex align-items-center">
									<div class="text-nowrap logo-img">
										<img src="<?php echo base_url('public/assets/images/logos/dark-logo.svg'); ?>" alt="Logo" class="dark-logo" />
									</div>
								</div>
								<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body pt-0" data-simplebar style="height: calc(100vh - 80px)">
								<ul id="sidebarnav">
									<li class="sidebar-item">
										<a class="sidebar-link has-arrow ms-0 rounded" href="javascript:void(0)" aria-expanded="false">
											<span>
												<iconify-icon icon="solar:slider-vertical-line-duotone" class="fs-7"></iconify-icon>
											</span>
											<span class="hide-menu">Apps</span>
										</a>
										<ul aria-expanded="false" class="collapse first-level my-3 ps-3">
											<li class="sidebar-item py-2">
												<a href="./main/app-chat.html" class="d-flex align-items-center">
													<div class="bg-primary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
														<iconify-icon icon="solar:chat-line-linear" class="text-primary fs-5"></iconify-icon>
													</div>
													<div class="d-inline-block">
														<h6 class="mb-0">Chat Application</h6>
														<span class="fs-11 d-block text-muted">New messages arrived</span>
													</div>
												</a>
											</li>
											<li class="sidebar-item py-2">
												<a href="./main/app-invoice.html" class="d-flex align-items-center">
													<div class="bg-secondary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
														<iconify-icon icon="solar:bill-list-linear" class="text-secondary fs-5"></iconify-icon>
													</div>
													<div class="d-inline-block">
														<h6 class="mb-0">Invoice App</h6>
														<span class="fs-11 d-block text-muted">Get latest invoice</span>
													</div>
												</a>
											</li>
											<li class="sidebar-item py-2">
												<a href="./main/app-contact2.html" class="d-flex align-items-center">
													<div class="bg-warning-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
														<iconify-icon icon="solar:bedside-table-2-linear" class="text-warning fs-5"></iconify-icon>
													</div>
													<div class="d-inline-block">
														<h6 class="mb-0">Contact Application</h6>
														<span class="fs-11 d-block text-muted">2 Unsaved Contacts</span>
													</div>
												</a>
											</li>
											<li class="sidebar-item py-2">
												<a href="./main/app-email.html" class="d-flex align-items-center">
													<div class="bg-danger-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
														<iconify-icon icon="solar:letter-unread-linear" class="text-danger fs-5"></iconify-icon>
													</div>
													<div class="d-inline-block">
														<h6 class="mb-0">Email App</h6>
														<span class="fs-11 d-block text-muted">Get new emails</span>
													</div>
												</a>
											</li>
											<li class="sidebar-item py-2">
												<a href="./main/page-user-profile.html" class="d-flex align-items-center">
													<div class="bg-success-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
														<iconify-icon icon="solar:cart-large-2-linear" class="text-success fs-5"></iconify-icon>
													</div>
													<div class="d-inline-block">
														<h6 class="mb-0">User Profile</h6>
														<span class="fs-11 d-block text-muted">learn more information</span>
													</div>
												</a>
											</li>
											<li class="sidebar-item py-2">
												<a href="./main/app-calendar.html" class="d-flex align-items-center">
													<div class="bg-primary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
														<iconify-icon icon="solar:calendar-linear" class="text-primary fs-5"></iconify-icon>
													</div>
													<div class="d-inline-block">
														<h6 class="mb-0">Calendar App</h6>
														<span class="fs-11 d-block text-muted">Get dates</span>
													</div>
												</a>
											</li>
											<li class="sidebar-item py-2">
												<a href="./main/app-contact.html" class="d-flex align-items-center">
													<div class="bg-secondary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
														<iconify-icon icon="solar:bedside-table-linear" class="text-secondary fs-5"></iconify-icon>
													</div>
													<div class="d-inline-block">
														<h6 class="mb-0">Contact List Table</h6>
														<span class="fs-11 d-block text-muted">Add new contact</span>
													</div>
												</a>
											</li>
											<li class="sidebar-item py-2">
												<a href="./main/app-notes.html" class="d-flex align-items-center">
													<div class="bg-warning-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
														<iconify-icon icon="solar:palette-linear" class="text-warning fs-5"></iconify-icon>
													</div>
													<div class="d-inline-block">
														<h6 class="mb-0">Notes Application</h6>
														<span class="fs-11 d-block text-muted">To-do and Daily tasks</span>
													</div>
												</a>
											</li>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
				<div class="app-header with-horizontal">
					<nav class="navbar navbar-expand-xl container-fluid p-0">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item d-flex d-xl-none">
								<a class="nav-link sidebartoggler nav-icon-hover-bg rounded-circle" id="sidebarCollapse" href="javascript:void(0)">
									<iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
								</a>
							</li>
							<li class="nav-item d-none d-xl-flex align-items-center">
								<a href="./horizontal/index.html" class="text-nowrap nav-link">

									<img src="<?php echo base_url('public/assets/images/logos/light-logo.svg'); ?>" alt="Logo" />
								</a>
							</li>
							<!-- ------------------------------- -->
							<!-- start notification Dropdown -->
							<!-- ------------------------------- -->
							<li class="nav-item dropdown nav-icon-hover-bg dark rounded-circle d-none d-xl-flex">
								<a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
									<iconify-icon icon="solar:bell-bing-line-duotone" class="fs-6"></iconify-icon>
									<div class="notify">
										<span class="heartbit"></span>
										<span class="point"></span>
									</div>
								</a>
								<div class="dropdown-menu content-dd dropdown-menu-animate-up" aria-labelledby="drop2">
									<div class="py-3 px-4 border-bottom">
										<h5 class="mb-0 fs-4 fw-normal">Notifications</h5>
									</div>
									<div class="message-body" data-simplebar>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-danger">
												<iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Launch Admin</h6>
													<span class="d-block fs-2 text-body-color">9:30 AM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just see the my new admin!</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
												<iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Event today</h6>
													<span class="d-block fs-2 text-body-color">9:15 AM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just a reminder that you have event</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
												<iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Settings</h6>
													<span class="d-block fs-2 text-body-color">4:36 PM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">You can customize this template as you want</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-warning-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-warning">
												<iconify-icon icon="solar:widget-4-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Launch Admin</h6>
													<span class="d-block fs-2 text-body-color">9:30 AM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just see the my new admin!</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
												<iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Event today</h6>
													<span class="d-block fs-2 text-body-color">9:15 AM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">Just a reminder that you have event</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 border-bottom d-flex align-items-center dropdown-item gap-3">
											<span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
												<iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block ">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 fw-semibold">Settings</h6>
													<span class="d-block fs-2 text-body-color">4:36 PM</span>
												</div>
												<span class="d-block text-truncate text-truncate fs-11 text-body-color">You can customize this template as you want</span>
											</div>
										</a>
									</div>
									<div>
										<a class="d-flex align-items-center pt-3 pb-2 justify-content-center link-primary text-dark" href="javascript:void(0);">
											<span class="fw-semibold">Check all notifications</span>
											<iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
										</a>
									</div>

								</div>
							</li>
							<!-- ------------------------------- -->
							<!-- end notification Dropdown -->
							<!-- ------------------------------- -->

							<!-- ------------------------------- -->
							<!-- start messages Dropdown -->
							<!-- ------------------------------- -->
							<li class="nav-item dropdown nav-icon-hover-bg dark rounded-circle d-none d-xl-flex">
								<a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
									<iconify-icon icon="solar:inbox-line-duotone" class="fs-6"></iconify-icon>
									<div class="notify">
										<span class="heartbit"></span>
										<span class="point"></span>
									</div>
								</a>
								<div class="dropdown-menu content-dd dropdown-menu-animate-up" aria-labelledby="drop2">
									<div class="py-3 px-4 border-bottom">
										<h5 class="mb-0 fs-4 fw-normal">You have 4 new messages</h5>
									</div>
									<div class="message-body" data-simplebar>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-5.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-warning border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Mathew Anderson</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just see the my new admin!</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-3.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Bianca Anderson</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:10 AM</span>
												</div>

												<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just a reminder that you have event</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-6.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Andrew Johnson</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:08 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">You can customize this template as you want</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-7.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
												</button>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Mark Strokes</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:30 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just see the my new admin!</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-8.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Mark, Stoinus & Rishvi..</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:10 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">Just a reminder that you have event</span>
											</div>
										</a>
										<a href="javascript:void(0)" class="p-3 pe-0 d-flex align-items-center dropdown-item gap-3 border-bottom">
											<span class="user-img position-relative d-inline-block">
												<img src="<?php echo base_url('public/assets/images/profile/user-9.jpg'); ?>" alt="user" class="rounded-circle w-100 round-40" />
												<span class="position-absolute top-0 start-100 translate-middle p-1 bg-warning border border-light rounded-circle">
													<span class="visually-hidden">New alerts</span>
												</span>
											</span>
											<div class="w-75 d-inline-block">
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="mb-1 lh-base">Settings</h6>
													<span class="fs-2 text-nowrap d-block text-body-color">9:08 AM</span>
												</div>
												<span class="fs-2 d-block text-truncate text-truncate text-body-color">You can customize this template as you want</span>
											</div>
										</a>
									</div>
									<div>
										<a class="d-flex align-items-center pt-3 pb-2 justify-content-center link-primary text-dark" href="javascript:void(0);">
											<span class="fw-semibold">See all e-Mails</span>
											<iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
										</a>
									</div>

								</div>
							</li>
							<!-- ------------------------------- -->
							<!-- end messages Dropdown -->
							<!-- ------------------------------- -->
							<li class="nav-item d-none d-lg-flex dropdown nav-icon-hover-bg dark rounded-circle d-none d-xl-flex">
								<div class="hover-dd">
									<a class="nav-link" id="drop2" href="javascript:void(0)" aria-haspopup="true" aria-expanded="false">
										<iconify-icon icon="solar:widget-3-line-duotone" class="fs-6"></iconify-icon>
									</a>
									<div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0 overflow-hidden" aria-labelledby="drop2">
										<div class="position-relative">
											<div class="row">
												<div class="col-8">
													<div class="p-4 pb-3">
														<div class="row">
															<div class="col-6">
																<div class="position-relative">
																	<a href="./main/app-chat.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-primary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:chat-line-linear" class="text-primary fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Chat Application</h6>
																			<span class="fs-11 d-block text-muted">New messages arrived</span>
																		</div>
																	</a>
																	<a href="./main/app-invoice.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-secondary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:bill-list-linear" class="text-secondary fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Invoice App</h6>
																			<span class="fs-11 d-block text-muted">Get latest invoice</span>
																		</div>
																	</a>
																	<a href="./main/app-contact2.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-warning-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:bedside-table-2-linear" class="text-warning fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Contact Application</h6>
																			<span class="fs-11 d-block text-muted">2 Unsaved Contacts</span>
																		</div>
																	</a>
																	<a href="./main/app-email.html" class="d-flex align-items-center position-relative">
																		<div class="bg-danger-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:letter-unread-linear" class="text-danger fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Email App</h6>
																			<span class="fs-11 d-block text-muted">Get new emails</span>
																		</div>
																	</a>
																</div>
															</div>
															<div class="col-6">
																<div class="position-relative">
																	<a href="./main/page-user-profile.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-success-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:cart-large-2-linear" class="text-success fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">User Profile</h6>
																			<span class="fs-11 d-block text-muted">learn more information</span>
																		</div>
																	</a>
																	<a href="./main/app-calendar.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-primary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:calendar-linear" class="text-primary fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Calendar App</h6>
																			<span class="fs-11 d-block text-muted">Get dates</span>
																		</div>
																	</a>
																	<a href="./main/app-contact.html" class="d-flex align-items-center pb-9 position-relative">
																		<div class="bg-secondary-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:bedside-table-linear" class="text-secondary fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Contact List Table</h6>
																			<span class="fs-11 d-block text-muted">Add new contact</span>
																		</div>
																	</a>
																	<a href="./main/app-notes.html" class="d-flex align-items-center position-relative">
																		<div class="bg-warning-subtle rounded-circle round me-3 d-flex align-items-center justify-content-center">
																			<iconify-icon icon="solar:palette-linear" class="text-warning fs-5"></iconify-icon>
																		</div>
																		<div class="d-inline-block">
																			<h6 class="mb-0">Notes Application</h6>
																			<span class="fs-11 d-block text-muted">To-do and Daily tasks</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													</div>
													<div class="row align-items-center border-top">
														<div class="col-8">
															<div class="ps-3 py-3">
																<a class="text-dark d-flex align-items-center lh-1 fs-3" href="javascript:void(0)">
																	<i class="ti ti-help fs-5 me-2"></i>Frequently Asked Questions
																</a>
															</div>
														</div>
														<div class="col-4">
															<div class="d-flex justify-content-end pe-2 py-3">
																<button class="btn btn-primary">Check</button>
															</div>
														</div>
													</div>
												</div>
												<div class="col-4 ms-n3">
													<div class="position-relative p-3 border-start h-100">
														<h5 class="fs-5 mb-9 fw-semibold">Quick Links</h5>
														<ul>
															<li class="mb-3">
																<a class="fs-3" href="./main/page-pricing.html">Pricing Page</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/authentication-login.html">Authentication Design</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/authentication-register.html">Register Now</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/authentication-error.html">404 Error Page</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/app-notes.html">Notes App</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/page-user-profile.html">User Application</a>
															</li>
															<li class="mb-3">
																<a class="fs-3" href="./main/page-account-settings.html">Account Settings</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<div class="d-block d-xl-none">
							<div class="text-nowrap nav-link">
								<img src="<?php echo base_url('public/assets/images/logos/light-logo.svg'); ?>" alt="Logo" />
							</div>
						</div>
						<ul class="navbar-nav navbar-toggler p-0 border-0">
							<li class="nav-item nav-icon-hover-bg dark rounded-circle d-flex">
								<a class="nav-link rounded-circle" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
									<iconify-icon icon="solar:menu-dots-bold-duotone" class="fs-6"></iconify-icon>
								</a>
							</li>
						</ul>
						<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
							<div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
								<ul class="navbar-nav flex-row mx-auto ms-lg-auto align-items-center justify-content-center">
									<li class="nav-item dropdown">
										<a href="javascript:void(0)" class="nav-link nav-icon-hover-bg rounded-circle d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
											<iconify-icon icon="solar:sort-line-duotone" class="fs-6"></iconify-icon>
										</a>
									</li>
									<li class="nav-item search-box d-none d-xl-flex align-items-center">
										<div class="nav-link">
											<form class="app-search position-relative">
												<input type="text" class="form-control rounded-pill border-0 shadow-none" placeholder="Search for..." />
												<a href="javascript:void(0)" class="srh-btn">
													<iconify-icon icon="solar:magnifer-linear" class="position-absolute top-50 end-0 translate-middle-y me-2 fs-5"></iconify-icon>
												</a>
											</form>
										</div>
									</li>
									<li class="nav-item">
										<a class="nav-link nav-icon-hover-bg rounded-circle moon dark-layout" href="javascript:void(0)">
											<iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
										</a>
										<a class="nav-link nav-icon-hover-bg rounded-circle sun light-layout" href="javascript:void(0)" style="display: none">
											<iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
										</a>
									</li>
									<li class="nav-item d-block d-xl-none">
										<a class="nav-link nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
											<iconify-icon icon="solar:magnifer-line-duotone" class="fs-6"></iconify-icon>
										</a>
									</li>

									<!-- ------------------------------- -->
									<!-- start language Dropdown -->
									<!-- ------------------------------- -->
									<li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
										<a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
											<img src="<?php echo base_url('public/assets/images/flag/icon-flag-en.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
										</a>
										<div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
											<div class="message-body">
												<a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
													<div class="position-relative">
														<img src="<?php echo base_url('public/assets/images/flag/icon-flag-en.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
													</div>
													<p class="mb-0 fs-3">English (UK)</p>
												</a>
												<a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
													<div class="position-relative">
														<img src="<?php echo base_url('public/assets/images/flag/icon-flag-cn.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
													</div>
													<p class="mb-0 fs-3">中国人 (Chinese)</p>
												</a>
												<a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
													<div class="position-relative">
														<img src="<?php echo base_url('public/assets/images/flag/icon-flag-fr.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
													</div>
													<p class="mb-0 fs-3">français (French)</p>
												</a>
												<a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
													<div class="position-relative">
														<img src="<?php echo base_url('public/assets/images/flag/icon-flag-sa.svg'); ?>" alt="monster-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
													</div>
													<p class="mb-0 fs-3">عربي (Arabic)</p>
												</a>
											</div>
										</div>
									</li>
									<!-- ------------------------------- -->
									<!-- end language Dropdown -->
									<!-- ------------------------------- -->

									<!-- ------------------------------- -->
									<!-- start profile Dropdown -->
									<!-- ------------------------------- -->
									<li class="nav-item dropdown">
										<a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
											<div class="d-flex align-items-center lh-base">
												<img src="<?php echo base_url('public/assets/images/profile/user-1.jpg'); ?>" class="rounded-circle" width="35" height="35" alt="monster-img" />
											</div>
										</a>
										<div class="dropdown-menu content-dd dropdown-menu-end animated flipInY" aria-labelledby="drop1">
											<div class="profile-dropdown position-relative" data-simplebar>
												<div class="py-3 px-7 pb-0">
													<h5 class="mb-0 fs-5">User Profile</h5>
												</div>
												<div class="d-flex align-items-center py-9 mx-7 border-bottom">
													<img src="<?php echo base_url('public/assets/images/profile/user-1.jpg'); ?>" class="rounded-circle" width="80" height="80" alt="" />
													<div class="ms-3">
														<h5 class="mb-1 fs-4">Markarn Doe</h5>
														<span class="mb-1 d-block">Designer</span>
														<p class="mb-0 d-flex align-items-center gap-2">
															<i class="ti ti-mail fs-4"></i> info@monster.com
														</p>
													</div>
												</div>
												<div class="message-body">
													<a href="./main/page-user-profile.html" class="py-8 px-7 mt-8 d-flex align-items-center">
														<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
															<iconify-icon icon="solar:user-circle-line-duotone"></iconify-icon>
														</span>
														<div class="w-75 d-inline-block v-middle ps-3">
															<h6 class="mb-1 fs-3 lh-base">My Profile</h6>
															<span class="fs-2 d-block text-body-secondary">Account Settings</span>
														</div>
													</a>
													<a href="./main/app-email.html" class="py-8 px-7 d-flex align-items-center">
														<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
															<iconify-icon icon="solar:inbox-line-line-duotone"></iconify-icon>
														</span>
														<div class="w-75 d-inline-block v-middle ps-3">
															<h6 class="mb-1 fs-3 lh-base">My Inbox</h6>
															<span class="fs-2 d-block text-body-secondary">Messages & Emails</span>
														</div>
													</a>
													<a href="./main/app-kanban.html" class="py-8 px-7 d-flex align-items-center">
														<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
															<iconify-icon icon="solar:checklist-minimalistic-line-duotone"></iconify-icon>
														</span>
														<div class="w-75 d-inline-block v-middle ps-3">
															<h6 class="mb-1 fs-3 lh-base">My Task</h6>
															<span class="fs-2 d-block text-body-secondary">To-do and Daily Tasks</span>
														</div>
													</a>
												</div>
												<div class="d-grid py-4 px-7 pt-8">
													<a href="" class="btn btn-info">Log Out</a>
												</div>
											</div>

										</div>
									</li>
									<!-- ------------------------------- -->
									<!-- end profile Dropdown -->
									<!-- ------------------------------- -->
								</ul>
							</div>
						</div>
					</nav>

				</div>
			</header>
			<aside class="left-sidebar with-horizontal">
				<div>
					<nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
						<ul id="sidebarnav">
							<li class="nav-small-cap">
								<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
								<span class="hide-menu">Home</span>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
									<span>
										<iconify-icon icon="solar:layers-line-duotone" class="ti"></iconify-icon>
									</span>
									<span class="hide-menu">Dashboard</span>
								</a>
								<ul aria-expanded="false" class="collapse first-level">
									<li class="sidebar-item">
										<a href="./main/index.html" class="sidebar-link">
											<i class="ti ti-aperture"></i>
											<span class="hide-menu">Dashboard 1</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/index2.html" class="sidebar-link">
											<i class="ti ti-shopping-cart"></i>
											<span class="hide-menu">Dashboard 2</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-small-cap">
								<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
								<span class="hide-menu">Apps</span>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link two-column has-arrow" href="javascript:void(0)" aria-expanded="false">
									<span>
										<iconify-icon icon="solar:widget-line-duotone" class="ti"></iconify-icon>
									</span>
									<span class="hide-menu">Apps</span>
								</a>
								<ul aria-expanded="false" class="collapse first-level">
									<li class="sidebar-item">
										<a href="./main/app-calendar.html" class="sidebar-link">
											<i class="ti ti-calendar"></i>
											<span class="hide-menu">Calendar</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/apps-kanban.html" class="sidebar-link">
											<i class="ti ti-layout-kanban"></i>
											<span class="hide-menu">Kanban</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/app-chat.html" class="sidebar-link">
											<i class="ti ti-message-dots"></i>
											<span class="hide-menu">Chat</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a class="sidebar-link" href="./main/app-email.html" aria-expanded="false">
											<span>
												<i class="ti ti-mail"></i>
											</span>
											<span class="hide-menu">Email</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/app-contact.html" class="sidebar-link">
											<i class="ti ti-phone"></i>
											<span class="hide-menu">Contact Table</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/app-contact2.html" class="sidebar-link">
											<i class="ti ti-list-details"></i>
											<span class="hide-menu">Contact List</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/app-notes.html" class="sidebar-link">
											<i class="ti ti-notes"></i>
											<span class="hide-menu">Notes</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/app-invoice.html" class="sidebar-link">
											<i class="ti ti-file-text"></i>
											<span class="hide-menu">Invoice</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/page-user-profile.html" class="sidebar-link">
											<i class="ti ti-user-circle"></i>
											<span class="hide-menu">User Profile</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/blog-posts.html" class="sidebar-link">
											<i class="ti ti-article"></i>
											<span class="hide-menu">Posts</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/blog-detail.html" class="sidebar-link">
											<i class="ti ti-details"></i>
											<span class="hide-menu">Detail</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/eco-shop.html" class="sidebar-link">
											<i class="ti ti-shopping-cart"></i>
											<span class="hide-menu">Shop</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/eco-shop-detail.html" class="sidebar-link">
											<i class="ti ti-basket"></i>
											<span class="hide-menu">Shop Detail</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/eco-product-list.html" class="sidebar-link">
											<i class="ti ti-list-check"></i>
											<span class="hide-menu">List</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/eco-checkout.html" class="sidebar-link">
											<i class="ti ti-brand-shopee"></i>
											<span class="hide-menu">Checkout</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-small-cap">
								<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
								<span class="hide-menu">PAGES</span>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
									<span>
										<iconify-icon icon="solar:notes-line-duotone" class="ti"></iconify-icon>
									</span>
									<span class="hide-menu">Pages</span>
								</a>
								<ul aria-expanded="false" class="collapse first-level">
									<li class="sidebar-item">
										<a href="./main/page-faq.html" class="sidebar-link">
											<i class="ti ti-help"></i>
											<span class="hide-menu">FAQ</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/page-account-settings.html" class="sidebar-link">
											<i class="ti ti-user-circle"></i>
											<span class="hide-menu">Account Setting</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/page-pricing.html" class="sidebar-link">
											<i class="ti ti-currency-dollar"></i>
											<span class="hide-menu">Pricing</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/widgets-cards.html" class="sidebar-link">
											<i class="ti ti-cards"></i>
											<span class="hide-menu">Card</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/widgets-banners.html" class="sidebar-link">
											<i class="ti ti-ad"></i>
											<span class="hide-menu">Banner</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/widgets-charts.html" class="sidebar-link">
											<i class="ti ti-chart-bar"></i>
											<span class="hide-menu">Charts</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/starter.html" class="sidebar-link">
											<i class="ti ti-file"></i>
											<span class="hide-menu">Starter</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./landingpage/index.html" class="sidebar-link">
											<i class="ti ti-app-window"></i>
											<span class="hide-menu">Landing Page</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-small-cap">
								<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
								<span class="hide-menu">UI</span>
							</li>
							<li class="sidebar-item mega-dropdown">
								<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
									<span class="rounded-3">
										<iconify-icon icon="solar:archive-line-duotone" class="ti"></iconify-icon>
									</span>
									<span class="hide-menu">UI</span>
								</a>
								<ul aria-expanded="false" class="collapse first-level">
									<li class="sidebar-item">
										<a href="./main/ui-accordian.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Accordian</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-badge.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Badge</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-buttons.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Buttons</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-dropdowns.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Dropdowns</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-modals.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Modals</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-tab.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Tab</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-tooltip-popover.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Tooltip & Popover</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-notification.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Notification</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-progressbar.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Progressbar</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-pagination.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Pagination</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-typography.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Typography</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-bootstrap-ui.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Bootstrap UI</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-breadcrumb.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Breadcrumb</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-offcanvas.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Offcanvas</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-lists.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Lists</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-grid.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Grid</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-carousel.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Carousel</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-scrollspy.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Scrollspy</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-spinner.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Spinner</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/ui-link.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Link</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-small-cap">
								<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
								<span class="hide-menu">Forms</span>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link two-column has-arrow" href="javascript:void(0)" aria-expanded="false">
									<span class="rounded-3">
										<iconify-icon icon="solar:folder-line-duotone" class="ti"></iconify-icon>
									</span>
									<span class="hide-menu">Forms</span>
								</a>
								<ul aria-expanded="false" class="collapse first-level">
									<li class="sidebar-item">
										<a href="./main/form-inputs.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Forms Input</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-input-groups.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Input Groups</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-input-grid.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Input Grid</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-checkbox-radio.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Checkbox & Radios</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-bootstrap-switch.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Bootstrap Switch</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-select2.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Select2</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-basic.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Basic Form</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-vertical.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Form Vertical</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-horizontal.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Form Horizontal</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-actions.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Form Actions</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-row-separator.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Row Separator</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-bordered.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Form Bordered</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-detail.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Form Detail</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-wizard.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Form Wizard</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-editor-quill.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Quill Editor</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/form-editor-tinymce.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Tinymce Editor</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-small-cap">
								<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
								<span class="hide-menu">Tables</span>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
									<span class="rounded-3">
										<iconify-icon icon="solar:tuning-square-2-line-duotone" class="ti"></iconify-icon>
									</span>
									<span class="hide-menu">Tables</span>
								</a>
								<ul aria-expanded="false" class="collapse first-level">
									<li class="sidebar-item">
										<a href="./main/table-basic.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Basic Table</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/table-dark-basic.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Dark Table</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/table-sizing.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Sizing Table</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/table-layout-coloured.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Coloured Table</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/table-datatable-basic.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Basic Initialisation</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/table-datatable-api.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">API</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/table-datatable-advanced.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Advanced</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-small-cap">
								<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
								<span class="hide-menu">Charts</span>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
									<span class="rounded-3">
										<iconify-icon icon="solar:chart-square-line-duotone" class="ti"></iconify-icon>
									</span>
									<span class="hide-menu">Charts</span>
								</a>
								<ul aria-expanded="false" class="collapse first-level">
									<li class="sidebar-item">
										<a href="./main/chart-apex-line.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Line Chart</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/chart-apex-area.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Area Chart</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/chart-apex-bar.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Bar Chart</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/chart-apex-pie.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Pie Chart</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/chart-apex-radial.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Radial Chart</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="./main/chart-apex-radar.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Radar Chart</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-small-cap">
								<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
								<span class="hide-menu">Icons</span>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
									<span class="rounded-3">
										<iconify-icon icon="solar:sticker-smile-square-line-duotone" class="ti"></iconify-icon>
									</span>
									<span class="hide-menu">Icons</span>
								</a>
								<ul aria-expanded="false" class="collapse first-level">
									<li class="sidebar-item">
										<a class="sidebar-link" href="./main/icon-tabler.html" aria-expanded="false">
											<span class="rounded-3">
												<i class="ti ti-circle"></i>
											</span>
											<span class="hide-menu">Tabler Icon</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a class="sidebar-link sidebar-link" href="./main/icon-solar.html" aria-expanded="false">
											<span class="rounded-3">
												<i class="ti ti-circle"></i>
											</span>
											<span class="hide-menu">Solar Icon</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
									<span class="rounded-3">
										<iconify-icon icon="solar:airbuds-case-minimalistic-line-duotone" class="ti"></iconify-icon>
									</span>
									<span class="hide-menu">Multi DD</span>
								</a>
								<ul aria-expanded="false" class="collapse first-level">
									<li class="sidebar-item">
										<a href="./docs/index.html" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Documentation</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="javascript:void(0)" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Page 1</span>
										</a>
									</li>
									<li class="sidebar-item">
										<a href="javascript:void(0)" class="sidebar-link has-arrow">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Page 2</span>
										</a>
										<ul aria-expanded="false" class="collapse second-level">
											<li class="sidebar-item">
												<a href="javascript:void(0)" class="sidebar-link">
													<i class="ti ti-circle"></i>
													<span class="hide-menu">Page 2.1</span>
												</a>
											</li>
											<li class="sidebar-item">
												<a href="javascript:void(0)" class="sidebar-link">
													<i class="ti ti-circle"></i>
													<span class="hide-menu">Page 2.2</span>
												</a>
											</li>
											<li class="sidebar-item">
												<a href="javascript:void(0)" class="sidebar-link">
													<i class="ti ti-circle"></i>
													<span class="hide-menu">Page 2.3</span>
												</a>
											</li>
										</ul>
									</li>
									<li class="sidebar-item">
										<a href="javascript:void(0)" class="sidebar-link">
											<i class="ti ti-circle"></i>
											<span class="hide-menu">Page 3</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</aside>

			<div class="body-wrapper">
				<div class="container-fluid">
					<!-- PAGE TITLE -->
					<div class="d-md-flex align-items-center justify-content-between mb-7">
						<div class="mb-4 mb-md-0">
							<h4 class="fs-6 mb-0"><?php echo @$pageTitle; ?></h4>
						</div>
						<div class="d-flex align-items-center justify-content-between gap-6">
							<button class="d-none btn btn-primary d-flex align-items-center gap-1 fs-3 py-2 px-9">
								<i class="ti ti-plus fs-4"></i>
								Crear
							</button>
						</div>
					</div>
					<?php echo view($page); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="dark-transparent sidebartoggler"></div>
</body>