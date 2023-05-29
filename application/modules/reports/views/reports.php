<div class="row">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<span class="fw-bold text-white"><i class="bi bi-file-earmark-bar-graph"></i> Reports</span>
			<a href="<?php echo base_url();?>" class="btn btn-secondary ms-auto d-flex"><i class="bi bi-arrow-bar-left me-1"></i><span class="d-none d-sm-block">Back to Home</span></a>
		</div>
	</div>
</div>
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 d-flex justify-content-center non-staff-home">
	<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
		<div class="title-block">
			<lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_zXczVg.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
			<h4 class="mb-0">Account Receivable</h4>
		</div>
		<div class="back-layer">
			Menu ini digunakan untuk melihat Report piutang usaha
		</div>
		<a href="<?php echo base_url();?>reports/account_receivable" class="stretched-link text-decoration-none text-reset"></a>
	</div>
	<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
		<div class="title-block">
			<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_pxyddxdx.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
			<h4 class="mb-0">Account Payable</h4>
		</div>
		<div class="back-layer">
			Menu ini digunakan untuk melihat Report utang usaha
		</div>
		<a href="<?php echo base_url();?>reports/account_payable" class="stretched-link text-decoration-none text-reset"></a>
	</div>
	<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
		<div class="title-block">
			<lottie-player src="https://assets5.lottiefiles.com/packages/lf20_2wetcdw9.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
			<h4 class="mb-0">General Accounting</h4>
		</div>
		<div class="back-layer">
			Menu ini digunakan untuk melihat Report di luar A/R, A/P, dan C/A
		</div>
		<a href="<?php echo base_url();?>reports/general_accounting" class="stretched-link text-decoration-none text-reset"></a>
	</div>
	<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
		<div class="title-block">
			<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_pbdrsjah.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
			<h4 class="mb-0">Cash Advance</h4>
		</div>
		<div class="back-layer">
			Menu ini digunakan untuk melihat Report uang muka
		</div>
		<a href="<?php echo base_url();?>reports/cash_advance" class="stretched-link text-decoration-none text-reset"></a>
	</div>
</div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>