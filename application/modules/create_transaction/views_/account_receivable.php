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
    <button class="nav-link active" id="closeinvoice-tab" data-bs-toggle="tab" data-bs-target="#closeinvoice" type="button" role="tab" aria-controls="closeinvoice" aria-selected="true">Close Invoice</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active p-3 bg-white border" id="closeinvoice" role="tabpanel" aria-labelledby="closeinvoice-tab">
        <div class="row g-2">
            <div class="col-sm-6 col-lg-3" style="min-height:58px;">
                <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="customer" name="customer" data-live-search="true" data-size="8" autofocus>
                    <option>Pilih Customer</option>
                    <?php
                        foreach ($data_invoice_penjualan->result() as $x) {
                    ?>
                        <option value="<?= $x->kode_kustomer?>" data-subtext="<?= $x->kode_kustomer?>" data-token="<?= $x->kode_kustomer?>"><?= $x->nama_kustomer?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-6 col-lg-3" style="min-height:58px;">
                <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="customer" name="customer" data-live-search="true" data-size="8" autofocus>
                    <option>Pilih Akun Kas</option>
                    <?php
                        foreach ($data_bank->result() as $x) {
                    ?>
                        <option value="<?= $x->bank_account?>" data-subtext="<?= $x->bank_account?>" data-token="<?= $x->bank_name?>"><?= $x->bank_name?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="form-floating">
                    <input type="date" class="form-control shadow-sm" id="tgl_closing" name="tgl_closing" placeholder="Tanggal Closing" required="">
                    <label for="tgl_closing">Tanggal Closing</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="form-floating">
                    <textarea class="form-control shadow-sm" placeholder="Masukkan remark" id="remark" name="remark" required=""></textarea>
                    <label for="remark">Masukkan remark</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="d-grid">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalInvoice">Pilih Invoice</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modalInvoice" id="modalInvoice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <i class="far fa-list-alt"></i> Pilih Invoice
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body">
                <div class="table-responsive small">
                    <input type="text" id="cari_invoice" class="w-100 mb-2 form-control" placeholder="Cari di sini..">
                    <table class="table table-striped table-hover table-sm table-bordered" style="width:100%" id="tbl-result">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Invoice</th>
                                <th>Amount</th>
                                <th>Term Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody id="result-table">
                        </tbody>
                    </table>
                    <button class="btn btn-secondary">Tambahkan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
        $("#customer").change(function(event) {
            var cust = $(this).val();
            $.ajax({
                url: '<?= base_url();?>create_transaction/get_invoice/'+cust,
                type: 'GET',
                dataType: 'html',
                data: {cust: cust},
                success: function (result) {
                    $("#result-table").html(result);
                }
            })
        });
        $('#cari_invoice').keyup(function(){
            var value = $(this).val().toLowerCase();
            $("#tbl-result > tbody > tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
		// $('#dataInvoicePenjualan').DataTable({
		// 	"scrollX": true,
		// 	"scrollY": "250px",
        //     "scrollCollapse": true,
        // 	"paging": true,
        // 	"info": true,
        // 	"filter": true
		// });
	});
</script>