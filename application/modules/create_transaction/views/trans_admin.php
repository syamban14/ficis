<div class="row">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<span class="fw-bold text-white"><i class="bi bi-dash-square"></i> Create Transaction</span>
			<a href="<?php echo base_url(); ?>" class="btn btn-secondary ms-auto d-flex"><i class="bi bi-arrow-bar-left me-1"></i><span class="d-none d-sm-block">Back to Home</span></a>
		</div>
	</div>
</div>
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 d-flex justify-content-center non-staff-home">
	<?php
	$role = $this->session->userdata('role');
	$menu_inv = "<a href='" . base_url('create_transaction/form_invoice_penjualan') . "' class='btn btn-outline-primary'>Invoicing</a>";
	$menu_ar = $menu_inv . "<a href='" . base_url('create_transaction/account_receivable') . "' class='btn btn-outline-primary'>Close AR</a><a href='" . base_url('create_transaction/ar_correction') . "' class='btn btn-outline-primary'>AR Correction</a><a href='" . base_url('create_transaction/sales_advance') . "' class='btn btn-outline-primary'>Sales Advance</a>";
	$hasil_sub_menu = '';
	// Sub Menu AR
	if ($role == '6') {
		$hasil_sub_menu = $menu_inv;
	}
	if ($role == '1' || $role == '2') {
		$hasil_sub_menu = $menu_ar;
	}

	// Penentuan Menu Module
	if ($role == '2' || $role == '6') {
	?>
		<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
			<div class="title-block">
				<lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_zXczVg.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
				<h4 class="mb-0">Account Receivable</h4>
			</div>
			<div class="back-layer">
				Menu ini digunakan untuk mengelola transaksi piutang usaha
				<div class="d-flex justify-content-center">
					<?= $hasil_sub_menu; ?>
				</div>
			</div>
		</div>
	<?php
	} elseif ($role == '3') {
	?>
		<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
			<div class="title-block">
				<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_pxyddxdx.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
				<h4 class="mb-0">Account Payable</h4>
			</div>
			<div class="back-layer">
				Menu ini digunakan untuk mengelola transaksi utang usaha
				<div class="d-flex justify-content-center">
					<a href="<?= base_url(); ?>create_transaction/form_account_payable" class="btn btn-outline-primary">Purchase Invoice</a>
					<a href="<?= base_url(); ?>create_transaction/account_payable" class="btn btn-outline-primary">Account Payable Payment</a>
					<a href="<?= base_url(); ?>create_transaction/purchase_advance" class="btn btn-outline-primary">Purchase Advance</a>
				</div>
			</div>
		</div>
	<?php
	} elseif ($role == '4') {
	?>
		<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
			<div class="title-block">
				<lottie-player src="https://assets5.lottiefiles.com/packages/lf20_2wetcdw9.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
				<h4 class="mb-0">General Accounting</h4>
			</div>
			<div class="back-layer">
				Menu ini digunakan untuk mengelola transaksi di luar A/R, A/P, dan C/A
			</div>
			<a href="<?php echo base_url(); ?>create_transaction/general_accounting" class="stretched-link text-decoration-none text-reset"></a>
		</div>
	<?php
	} elseif ($role == '5') {
	?>
		<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
			<div class="title-block">
				<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_pbdrsjah.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
				<h4 class="mb-0">Cash Advance</h4>
			</div>
			<div class="back-layer">
				Menu ini digunakan untuk mengelola transaksi uang muka
			</div>
			<a href="<?php echo base_url(); ?>create_transaction/cash_advance" class="stretched-link text-decoration-none text-reset"></a>
		</div>
	<?php
	} else {
	?>
		<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
			<div class="title-block">
				<lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_zXczVg.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
				<h4 class="mb-0">Account Receivable</h4>
			</div>
			<div class="back-layer">
				Menu ini digunakan untuk mengelola transaksi piutang usaha
				<div class="d-flex justify-content-center">
					<?= $hasil_sub_menu; ?>
				</div>
			</div>
		</div>
		<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
			<div class="title-block">
				<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_pxyddxdx.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
				<h4 class="mb-0">Account Payable</h4>
			</div>
			<div class="back-layer">
				Menu ini digunakan untuk mengelola transaksi utang usaha
				<div class="d-flex justify-content-center">
					<a href="<?= base_url(); ?>create_transaction/form_account_payable" class="btn btn-outline-primary">Purchase Invoice</a>
					<a href="<?= base_url(); ?>create_transaction/account_payable" class="btn btn-outline-primary">Close AP</a>
					<a href="<?= base_url(); ?>create_transaction/purchase_advance" class="btn btn-outline-primary">Purchase Advance</a>
				</div>
			</div>
		</div>
		<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
			<div class="title-block">
				<lottie-player src="https://assets5.lottiefiles.com/packages/lf20_2wetcdw9.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
				<h4 class="mb-0">General Journal</h4>
			</div>
			<div class="back-layer">
				Menu ini digunakan untuk mengelola transaksi di luar A/R, A/P, dan C/A
			</div>
			<a href="<?php echo base_url(); ?>create_transaction/general_accounting" class="stretched-link text-decoration-none text-reset"></a>
		</div>
		<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
			<div class="title-block">
				<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_pbdrsjah.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
				<h4 class="mb-0">Cash Receipts</h4>
			</div>
			<div class="back-layer">
				Menu ini digunakan untuk mengelola transaksi uang muka
			</div>
			<a href="<?php echo base_url(); ?>create_transaction/cash_advance" class="stretched-link text-decoration-none text-reset"></a>
		</div>
		<div class="col text-center bg-white border p-4 py-5 position-relative overflow-hidden boxnya">
			<div class="title-block">
				<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_pbdrsjah.json" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay class="mx-auto"></lottie-player>
				<h4 class="mb-0">Cash Disbursements</h4>
			</div>
			<div class="back-layer">
				Menu ini digunakan untuk mengelola transaksi uang muka
			</div>
			<a href="<?php echo base_url(); ?>create_transaction/cash_advance" class="stretched-link text-decoration-none text-reset"></a>
		</div>
	<?php
	}
	?>
</div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
