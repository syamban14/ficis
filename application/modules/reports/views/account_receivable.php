<div class="row">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<span class="fw-bold text-white"><i class="bi bi-file-earmark-bar-graph"></i> Reports <i class="bi bi-chevron-right"></i> Account Receivable</span>
			<a href="<?= base_url();?>reports" class="btn btn-secondary ms-auto d-flex"><i class="bi bi-arrow-bar-left me-1"></i><span class="d-none d-sm-block">Back</span></a>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col-12">
		<div class="card shadow bg-white">
			<div class="card-body">
				<form action="<?= base_url();?>reports/account_receivable" method="post">
					<div class="row g-3">
						<div class="col-lg-4 col-md-6">
							<div class="form-floating">
							  <input type="date" class="form-control" id="periode_start" name="periode_start" value="<?= $periode_start;?>" required>
							  <label for="periode_start">Tanggal Awal</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="form-floating">
							  <input type="date" class="form-control" id="periode_end" name="periode_end" value="<?= $periode_end;?>">
							  <label for="periode_end">Tanggal Akhir</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-12">
							<div class="d-grid h-100">
								<button type="submit" class="btn btn-lg btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col-12">
		<div class="card shadow bg-white">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped mb-0" id="data_reports">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nomor Invoice</th>
								<th>Customer</th>
								<th>Tanggal Invoice</th>
								<th>Tanggal Kirim Invoice</th>
								<th>Periode Kegiatan</th>
								<th>Tgl Transaksi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$i = 1;
							if ($data_reports->num_rows() > 0) {
								foreach ($data_reports->result() as $x) {
						?>
									<tr>
										<td><?= $i;?></td>
										<td><?= $x->no_inv;?></td>
										<td><?= $x->nama_kustomer;?></td>
										<td><?= $x->tgl_inv;?></td>
										<td><?= $x->tgl_kirim_inv;?></td>
										<td><?= $x->periode_kegiatan;?></td>
										<td><?= $x->create_date;?></td>
										<td>
											<div class="d-flex">
												<a class="btn btn-primary py-1 px-2 me-1" data-bs-toggle="tooltip" href="<?= base_url('create_transaction/rpt_invoice_penjualan/'.$x->no_inv);?>" title="Print Invoice" target="_BLANK"><i class="bi bi-printer-fill"></i></a>
												<a class="btn btn-outline-primary py-1 px-2" data-bs-toggle="tooltip" href="<?= base_url('create_transaction/kwi_invoice_penjualan/'.$x->no_inv);?>" title="Print Kwitansi" target="_BLANK"><i class="bi bi-printer-fill"></i></a>
											</div>
										</td>
									</tr>
						<?php
									$i++;
								}
							}else{
						?>
								<tr>
									<td colspan="8" class="fw-bold text-center">No data available</td>
								</tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#data_reports').DataTable();
	});
</script>