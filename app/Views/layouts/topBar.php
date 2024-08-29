<header class="topbar">
	<div class="with-vertical">
		<nav class="navbar navbar-expand-lg p-0">
			<ul class="navbar-nav">
				<li style="cursor: pointer;" class="nav-item nav-icon-hover-bg dark rounded-circle d-flex sidebartoggler">

					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
					</svg>

				</li>
			</ul>
		</nav>
		<div class="offcanvas offcanvas-start pt-0" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
			<nav class="sidebar-nav scroll-sidebar">
				<div class="offcanvas-header justify-content-between ps-0 pt-0">
					<div class="brand-logo d-flex align-items-center">
						<a href="<?php echo base_url('Dashboard'); ?>" class="text-nowrap logo-img">
							<img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="Logo" class="dark-logo" />
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

						<img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="Logo" />
					</a>
				</li>
			</ul>
			<div class="d-block d-xl-none">
				<a href="<?php echo base_url('DashboardV2/index'); ?>" class="text-nowrap nav-link">
					<img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="Logo" />
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
					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>