<header class="topbar">
	<div class="with-vertical">
		<!-- ---------------------------------- -->
		<!-- Start Vertical Layout Header -->
		<!-- ---------------------------------- -->
		<nav class="navbar navbar-expand-lg p-0">
			<ul class="navbar-nav">
				<li class="nav-item nav-icon-hover-bg dark rounded-circle d-flex">
					<a class="nav-link sidebartoggler headerCollapse" href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
						</svg>
					</a>
				</li>
			</ul>

			<!-- Logo -->
			<div class="d-block d-lg-none py-4 py-xl-0">
				<img src="<?php echo base_url('assets/images/logos/dark-logo.svg'); ?>" alt="Logo" class="dark-logo">
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
					<ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
						<!-- ------------------------------- -->
						<!-- start profile Dropdown -->
						<!-- ------------------------------- -->
						<li class="nav-item dropdown">
							<a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
								<div class="d-flex align-items-center lh-base">
									<img src="<?php echo base_url('public/assets/images/avatar/user-1.jpg'); ?>" class="rounded-circle" width="35" height="35" alt="Avatar" />
								</div>
							</a>
							<div class="dropdown-menu content-dd dropdown-menu-end animated flipInY" aria-labelledby="drop1">
								<div class="profile-dropdown position-relative" data-simplebar>
									<div class="py-3 px-7 pb-0">
										<h5 class="mb-0 fs-5">User Profile</h5>
									</div>
									<div class="d-flex align-items-center py-9 mx-7 border-bottom">
										<img src="<?php echo base_url('public/assets/images/avatar/user-1.jpg'); ?>" class="rounded-circle" width="80" alt="Avatar" />
										<div class="ms-3">
											<h5 class="mb-1 fs-4 text-truncate">Text</h5>
											<span class="mb-1 d-block text-truncate">Text</span>
											<p class="mb-0 d-flex align-items-center gap-2 text-truncate">
												<i class="ti ti-mail fs-4"></i> Text
											</p>
										</div>
									</div>
									<div class="message-body">
										<a href="<?php echo base_url('AccountV2/profile'); ?>" class="py-8 px-7 mt-8 d-flex align-items-center">
											<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
												<iconify-icon icon="solar:user-circle-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block v-middle ps-3">
												<h6 class="mb-1 fs-3 lh-base">My Profile</h6>
												<span class="fs-2 d-block text-body-secondary">Account Settings</span>
											</div>
										</a>
										<a href="<?php echo base_url('AccountV2/resetPassword'); ?>" class="py-8 px-7 d-flex align-items-center">
											<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
												<iconify-icon icon="solar:key-square-outline"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block v-middle ps-3">
												<h6 class="mb-1 fs-3 lh-base">Security</h6>
												<span class="fs-2 d-block text-body-secondary">Reset Password</span>
											</div>
										</a>
									</div>
									<div class="d-grid py-4 px-7 pt-8">
										<a href="<?php echo base_url('/'); ?>" class="btn btn-danger">Log Out</a>
									</div>
								</div>

							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- ---------------------------------- -->
		<!-- End Vertical Layout Header -->
		<!-- ---------------------------------- -->

		<!-- ------------------------------- -->
		<!-- apps Dropdown in Small screen -->
		<!-- ------------------------------- -->
		<!--  Mobilenavbar -->
		<div class="offcanvas offcanvas-start pt-0" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
			<nav class="sidebar-nav scroll-sidebar">
				<div class="offcanvas-header justify-content-between ps-0 pt-0">
					<div class="brand-logo d-flex align-items-center">
						<a href="<?php echo base_url('Dashboard'); ?>" class="text-nowrap logo-img">
							<img src="<?php echo base_url('assets/images/logos/dark-logo.svg'); ?>" alt="Logo" class="dark-logo" />
						</a>
					</div>
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

						<img src="<?php echo base_url('assets/images/logos/dark-logo.svg'); ?>" alt="Logo" />
					</a>
				</li>
			</ul>
			<div class="d-block d-xl-none">
				<a href="<?php echo base_url('DashboardV2/index'); ?>" class="text-nowrap nav-link">
					<img src="<?php echo base_url('assets/images/logos/dark-logo.svg'); ?>" alt="Logo" />
				</a>
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
						<!-- ------------------------------- -->
						<!-- start profile Dropdown -->
						<!-- ------------------------------- -->
						<li class="nav-item dropdown">
							<a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
								<div class="d-flex align-items-center lh-base">
									<img src="<?php echo base_url('public/assets/images/avatar/user-1.jpg'); ?>" class="rounded-circle" width="35" height="35" alt="Avatar" />
								</div>
							</a>
							<div class="dropdown-menu content-dd dropdown-menu-end animated flipInY" aria-labelledby="drop1">
								<div class="profile-dropdown position-relative" data-simplebar>
									<div class="py-3 px-7 pb-0">
										<h5 class="mb-0 fs-5">User Profile</h5>
									</div>
									<div class="d-flex align-items-center py-9 mx-7 border-bottom">
										<img src="<?php echo base_url('public/assets/images/avatar/user-1.jpg'); ?>" class="rounded-circle" width="80" alt="Avatar" />
										<div class="ms-3">
											<h5 class="mb-1 fs-4 text-truncate">Text</h5>
											<span class="mb-1 d-block text-truncate">Text</span>
											<p class="mb-0 d-flex align-items-center gap-2 text-trunate">
												<i class="ti ti-mail fs-4"></i> Text
											</p>
										</div>
									</div>
									<div class="message-body">
										<a href="#" class="py-8 px-7 mt-8 d-flex align-items-center">
											<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
												<iconify-icon icon="solar:user-circle-line-duotone"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block v-middle ps-3">
												<h6 class="mb-1 fs-3 lh-base">My Profile</h6>
												<span class="fs-2 d-block text-body-secondary">Account Settings</span>
											</div>
										</a>
										<a href="<?php echo base_url('AccountV2/resetPassword'); ?>" class="py-8 px-7 d-flex align-items-center">
											<span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
												<iconify-icon icon="solar:key-square-outline"></iconify-icon>
											</span>
											<div class="w-75 d-inline-block v-middle ps-3">
												<h6 class="mb-1 fs-3 lh-base">Security</h6>
												<span class="fs-2 d-block text-body-secondary">Reset Password</span>
											</div>
										</a>
									</div>
									<div class="d-grid py-4 px-7 pt-8">
										<a href="<?php echo base_url('/'); ?>" class="btn btn-danger">Log Out</a>
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