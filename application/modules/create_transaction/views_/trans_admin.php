<div class="row">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<a href="<?php echo base_url();?>" class="btn btn-secondary ms-auto"><i class="bi bi-arrow-bar-left"></i> Back to Home</a>
		</div>
	</div>
</div>
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 d-flex justify-content-center non-staff-home">
	<!-- <div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
		<div class="title-block">
			<lottie-player src="https://assets8.lottiefiles.com/packages/lf20_w4rmivxa.json" background="transparent" speed="1" style="width:100px; height:100px;" loop autoplay class="mx-auto"></lottie-player>
			<h4 class="mb-0">Invoicing</h4>
		</div>
		<div class="back-layer">
			Menu ini digunakan untuk membuat transaksi invoice penjualan customer
		</div>
		<a href="<?php echo base_url();?>create_transaction/form_invoice_penjualan" class="stretched-link text-decoration-none text-reset"></a>
	</div> -->
	<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
		<div class="title-block">
			<lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_zXczVg.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
			<h4 class="mb-0">Account Receivable</h4>
		</div>
		<div class="back-layer">
			Menu ini digunakan untuk mengelola transaksi piutang usaha
			<div class="d-flex justify-content-center">
				<a href="<?= base_url();?>create_transaction/form_invoice_penjualan" class="btn btn-outline-primary">Invoicing</a>
				<a href="<?= base_url();?>create_transaction/account_receivable" class="btn btn-outline-primary">Close Invoice</a>
			</div>
		</div>
		<!-- <a href="<?php echo base_url();?>create_transaction/account_receivable" class="stretched-link text-decoration-none text-reset"></a> -->
	</div>
	<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
		<div class="title-block">
			<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_pxyddxdx.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
			<h4 class="mb-0">Account Payable</h4>
		</div>
		<div class="back-layer">
			Menu ini digunakan untuk mengelola transaksi utang usaha
		</div>
		<a href="<?php echo base_url();?>create_transaction/account_payable" class="stretched-link text-decoration-none text-reset"></a>
	</div>
	<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
		<div class="title-block">
			<lottie-player src="https://assets5.lottiefiles.com/packages/lf20_2wetcdw9.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
			<h4 class="mb-0">General Accounting</h4>
		</div>
		<div class="back-layer">
			Menu ini digunakan untuk mengelola transaksi di luar A/R, A/P, dan C/A
		</div>
		<a href="<?php echo base_url();?>create_transaction/general_accounting" class="stretched-link text-decoration-none text-reset"></a>
	</div>
	<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
		<div class="title-block">
			<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_pbdrsjah.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
			<h4 class="mb-0">Cash Advance</h4>
		</div>
		<div class="back-layer">
			Menu ini digunakan untuk mengelola transaksi uang muka
		</div>
		<a href="<?php echo base_url();?>create_transaction/cash_advance" class="stretched-link text-decoration-none text-reset"></a>
	</div>
</div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>