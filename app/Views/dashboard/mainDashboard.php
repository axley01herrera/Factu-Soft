<!-- Page Header-->
<div class="d-md-flex align-items-center justify-content-between mb-7">
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"><?php echo @$profile->name; ?></h4>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0">
				<li class="breadcrumb-item" aria-current="page">NIF: <?php echo @$profile->company_id; ?></li>
			</ol>
		</nav>
	</div>
	<div class="mb-4 mb-md-0">
		<h4 class="fs-6 mb-0"></h4>
	</div>
	<div class="d-flex align-items-center justify-content-between gap-6"></div>
</div>

<!-- Page Content -->
<div class="row">

	<!-- Collection Day -->
	<div class="col-12 col-md-4 col-lg-3" >
		<div class="card text-white text-bg-success rounded" style="height: 150px;">
			<div class="card-body p-4">
				<span>
					<svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" viewBox="0 0 24 24">
						<path fill="currentColor" d="M19 12a1 1 0 1 1-2 0a1 1 0 0 1 2 0" />
						<path fill="currentColor" fill-rule="evenodd" d="M9.944 3.25h3.112c1.838 0 3.294 0 4.433.153c1.172.158 2.121.49 2.87 1.238c.924.925 1.219 2.163 1.326 3.77c.577.253 1.013.79 1.06 1.47c.005.061.005.126.005.186v3.866c0 .06 0 .125-.004.185c-.048.68-.484 1.218-1.061 1.472c-.107 1.606-.402 2.844-1.326 3.769c-.749.748-1.698 1.08-2.87 1.238c-1.14.153-2.595.153-4.433.153H9.944c-1.838 0-3.294 0-4.433-.153c-1.172-.158-2.121-.49-2.87-1.238c-.748-.749-1.08-1.698-1.238-2.87c-.153-1.14-.153-2.595-.153-4.433v-.112c0-1.838 0-3.294.153-4.433c.158-1.172.49-2.121 1.238-2.87c.749-.748 1.698-1.08 2.87-1.238c1.14-.153 2.595-.153 4.433-.153m10.224 12.5H18.23c-2.145 0-3.981-1.628-3.981-3.75s1.836-3.75 3.98-3.75h1.938c-.114-1.341-.371-2.05-.87-2.548c-.423-.423-1.003-.677-2.009-.812c-1.027-.138-2.382-.14-4.289-.14h-3c-1.907 0-3.261.002-4.29.14c-1.005.135-1.585.389-2.008.812S3.025 6.705 2.89 7.71c-.138 1.028-.14 2.382-.14 4.289s.002 3.262.14 4.29c.135 1.005.389 1.585.812 2.008s1.003.677 2.009.812c1.028.138 2.382.14 4.289.14h3c1.907 0 3.262-.002 4.29-.14c1.005-.135 1.585-.389 2.008-.812c.499-.498.756-1.206.87-2.548M5.25 8A.75.75 0 0 1 6 7.25h4a.75.75 0 0 1 0 1.5H6A.75.75 0 0 1 5.25 8m15.674 1.75H18.23c-1.424 0-2.481 1.059-2.481 2.25s1.057 2.25 2.48 2.25h2.718c.206-.013.295-.152.302-.236V9.986c-.007-.084-.096-.223-.302-.235z" clip-rule="evenodd" />
					</svg>
				</span>
				<h4 class="card-title mt-3 mb-0 text-white">
					<div id="main-collectionDay">
						<div class="spinner-grow text-light" role="status"></div> <?php echo lang('Text.loading'); ?>
					</div>
				</h4>
				<p class="card-text text-white opacity-75 fs-3 fw-normal">
					<?php echo lang('Text.dashboard_collection_day'); ?>
				</p>
			</div>
		</div>
	</div>

	<!-- Customers -->
	<div class="col-12 col-md-4 col-lg-3">
		<div class="card text-white text-bg-warning rounded" style="height: 150px;">
			<div class="card-body p-4">
				<span>
					<svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" viewBox="0 0 24 24">
						<g fill="none" stroke="currentColor" stroke-width="1.5">
							<circle cx="12" cy="6" r="4" />
							<path stroke-linecap="round" d="M19.998 18q.002-.246.002-.5c0-2.485-3.582-4.5-8-4.5s-8 2.015-8 4.5S4 22 12 22c2.231 0 3.84-.157 5-.437" />
						</g>
					</svg>
				</span>
				<h4 class="card-title mt-3 mb-0 text-white">
					<div id="main-customers">
						<div class="spinner-grow text-light" role="status"></div> <?php echo lang('Text.loading'); ?>
					</div>
				</h4>
				<p class="card-text text-white opacity-75 fs-3 fw-normal">
					<?php echo lang('Text.dashboard_cards_customers_active') ?>
				</p>
			</div>
		</div>
	</div>

	<!-- Services -->
	<div class="col-12 col-md-4 col-lg-3">
		<div class="card text-white text-bg-success rounded" style="height: 150px;">
			<div class="card-body p-4">
				<span>
					<svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" viewBox="0 0 24 24">
						<g fill="none" stroke="currentColor" stroke-width="1.5">
							<path d="M10.861 3.363C11.368 2.454 11.621 2 12 2s.632.454 1.139 1.363l.13.235c.145.259.217.388.329.473s.252.117.532.18l.254.058c.984.222 1.476.334 1.593.71s-.218.769-.889 1.553l-.174.203c-.19.223-.285.334-.328.472s-.029.287 0 .584l.026.27c.102 1.047.152 1.57-.154 1.803s-.767.02-1.688-.404l-.239-.11c-.261-.12-.392-.18-.531-.18s-.27.06-.531.18l-.239.11c-.92.425-1.382.637-1.688.404s-.256-.756-.154-1.802l.026-.271c.029-.297.043-.446 0-.584s-.138-.25-.328-.472l-.174-.203c-.67-.784-1.006-1.177-.889-1.553s.609-.488 1.593-.71l.254-.058c.28-.063.42-.095.532-.18s.184-.214.328-.473zm8.569 4.319c.254-.455.38-.682.57-.682s.316.227.57.682l.065.117c.072.13.108.194.164.237s.126.058.266.09l.127.028c.492.112.738.167.796.356s-.109.384-.444.776l-.087.101c-.095.112-.143.168-.164.237s-.014.143 0 .292l.013.135c.05.523.076.785-.077.901s-.383.01-.844-.202l-.12-.055c-.13-.06-.196-.09-.265-.09c-.07 0-.135.03-.266.09l-.119.055c-.46.212-.69.318-.844.202c-.153-.116-.128-.378-.077-.901l.013-.135c.014-.15.022-.224 0-.292c-.021-.07-.069-.125-.164-.237l-.087-.101c-.335-.392-.503-.588-.444-.776s.304-.244.796-.356l.127-.028c.14-.032.21-.048.266-.09c.056-.043.092-.108.164-.237zm-16 0C3.685 7.227 3.81 7 4 7s.316.227.57.682l.065.117c.072.13.108.194.164.237s.126.058.266.09l.127.028c.492.112.738.167.797.356c.058.188-.11.384-.445.776l-.087.101c-.095.112-.143.168-.164.237s-.014.143 0 .292l.013.135c.05.523.076.785-.077.901s-.384.01-.844-.202l-.12-.055c-.13-.06-.196-.09-.265-.09c-.07 0-.135.03-.266.09l-.119.055c-.46.212-.69.318-.844.202c-.153-.116-.128-.378-.077-.901l.013-.135c.014-.15.022-.224 0-.292c-.021-.07-.069-.125-.164-.237l-.087-.101c-.335-.392-.503-.588-.445-.776c.059-.189.305-.244.797-.356l.127-.028c.14-.032.21-.048.266-.09c.056-.043.092-.108.164-.237z" />
							<path stroke-linecap="round" d="M4 21.388h2.26c1.01 0 2.033.106 3.016.308a14.9 14.9 0 0 0 5.33.118m-.93-3.297q.18-.021.345-.047c.911-.145 1.676-.633 2.376-1.162l1.808-1.365a1.89 1.89 0 0 1 2.22 0c.573.433.749 1.146.386 1.728c-.423.678-1.019 1.545-1.591 2.075m-5.544-1.229l-.11.012m.11-.012a1 1 0 0 0 .427-.24a1.49 1.49 0 0 0 .126-2.134a1.9 1.9 0 0 0-.45-.367c-2.797-1.669-7.15-.398-9.779 1.467m9.676 1.274a.5.5 0 0 1-.11.012m0 0a9.3 9.3 0 0 1-1.814.004" />
						</g>
					</svg>
				</span>
				<h4 class="card-title mt-3 mb-0 text-white">
					<div id="main-services">
						<div class="spinner-grow text-light" role="status"></div> <?php echo lang('Text.loading'); ?>
					</div>
				</h4>
				<p class="card-text text-white opacity-75 fs-3 fw-normal">
					<?php echo lang('Text.dashboard_cards_services_active') ?>
				</p>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		collectionDay();
		customers();
		services();
	});

	function collectionDay() {
		$.ajax({
			type: "post",
			url: "<?php echo base_url('Dashboard/collectionDay'); ?>",
			data: "",
			dataType: "json",
			success: function(response) {
				$('#main-collectionDay').html(response.collectionDay);
			}
		});
	}

	function customers() {
		$.ajax({
			type: "post",
			url: "<?php echo base_url('Dashboard/customers'); ?>",
			data: "",
			dataType: "json",
			success: function(response) {
				$('#main-customers').html(response.customers);
			}
		});
	}

	function services() {
		$.ajax({
			type: "post",
			url: "<?php echo base_url('Dashboard/services'); ?>",
			data: "",
			dataType: "json",
			success: function(response) {
				$('#main-services').html(response.services);
			}
		});
	}
</script>