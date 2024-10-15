<div class="row mb-3">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<span class="text-white">
				<i class="bi bi-receipt"></i> Daftar Invoice
			</span>
			<a href="<?php echo base_url(); ?>" class="btn btn-secondary ms-auto"><i class="bi bi-arrow-bar-left"></i> Back to Home</a>
		</div>
	</div>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item" role="presentation">
		<a class="nav-link" href="<?= base_url(); ?>create_transaction/form_invoice_penjualan">Create Invoice</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" href="<?= base_url(); ?>create_transaction/account_receivable">Close Invoice</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" href="<?= base_url(); ?>create_transaction/ar_correction">AR Correction</a>
	</li>
	<li class="nav-item" role="presentation">
		<button class="nav-link active" id="salesadvance-tab" data-bs-toggle="tab" data-bs-target="#salesadvance" type="button" role="tab" aria-controls="salesadvance" aria-selected="true">Sales Advance</button>
	</li>
</ul>
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active p-3 bg-white border" id="salesadvance" role="tabpanel" aria-labelledby="salesadvance-tab">
		<!-- make a sales advance -->
		<div class="row">
			<div class="col-md-12">
				<form>
					<div class="row">
						<div class="col-md-4">
							<div class="form-floating">
								<input type="text" class="form-control" id="no_advance" placeholder="No. Sales Advance">
								<label for="no_advance">No. Sales Advance</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-floating">
								<input type="date" class="form-control" id="tanggal_advance" placeholder="Tanggal">
								<label for="tanggal_advance">Tanggal</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-floating">
								<input type="text" class="form-control" id="customer_name" placeholder="Customer Name">
								<label for="customer_name">Customer Name</label>
							</div>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-md-6">
							<div class="form-floating">
								<input type="text" class="form-control" id="amount" placeholder="Amount">
								<label for="amount">Amount</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating">
								<input type="text" class="form-control" id="notes" placeholder="Notes">
								<label for="notes">Notes</label>
							</div>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end make a sales advance -->
	</div>
</div>
