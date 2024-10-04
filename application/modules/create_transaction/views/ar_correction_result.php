<div class="row mb-3">
    <div class="col bg-info shadow-sm p-3">
        <div class="d-flex align-items-center">
            <span class="text-white">
                <i class="bi bi-receipt"></i> Daftar Invoice
            </span>
            <a href="<?php echo base_url();?>" class="btn btn-secondary ms-auto"><i class="bi bi-arrow-bar-left"></i> Back to Home</a>
        </div>
    </div>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link" href="<?= base_url();?>create_transaction/form_invoice_penjualan">Create Invoice</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" href="<?= base_url();?>create_transaction/account_receivable">Close Invoice</a>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="arcorrection-tab" data-bs-toggle="tab" data-bs-target="#arcorrection" type="button" role="tab" aria-controls="arcorrection" aria-selected="true">AR Correction</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active p-3 bg-white border" id="arcorrection" role="tabpanel" aria-labelledby="arcorrection-tab">
        <form action="<?= base_url('create_transaction/ar_correction_result_by_date');?>" method="POST">
            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input value="<?= $start_date;?>" type="date" class="form-control shadow-sm" id="start_date" name="start_date" placeholder="Start Date" required>
                        <label for="start_date">Start Date</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input value="<?= $end_date;?>" type="date" class="form-control shadow-sm" id="end_date" name="end_date" placeholder="End Date" required>
                        <label for="end_date">End Date</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-grid h-100">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="table-result">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Invoice</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Saldo Akhir</th>
                        <th>Closing Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    $revisi = 'revisi';
                    foreach ($data->result() as $x) {
                ?>
                    <tr>
                        <td><?= $no;?></td>
                        <td><?= $x->no_inv;?></td>
                        <td><?= $x->nama_kustomer;?></td>
                        <td align="right">Rp <?= number_format($x->amount);?></td>
                        <td align="right">Rp <?= number_format($x->saldoakhir);?></td>
                        <td><?= date('d-m-Y',strtotime($x->tgl_closing));?></td>
                        <td><?= $x->statusnya;?></td>
                        <td><a class="btn btn-info btn-sm" href="<?= base_url('create_transaction/closing_ar/'.$x->id_tr.'/'.$revisi);?>">Correction</a></td>
                    </tr>
                <?php
                    $no++;}
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
        $('#table-result').DataTable();
	});
</script>