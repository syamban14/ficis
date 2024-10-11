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
		<button class="nav-link active" id="closeinvoice-tab" data-bs-toggle="tab" data-bs-target="#closeinvoice" type="button" role="tab" aria-controls="closeinvoice" aria-selected="true">Close Invoice</button>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" href="<?= base_url(); ?>create_transaction/ar_correction">AR Correction</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" href="<?= base_url(); ?>create_transaction/sales_advance">Sales Advance</a>
	</li>
</ul>
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active p-3 bg-white border" id="closeinvoice" role="tabpanel" aria-labelledby="closeinvoice-tab">
		<div class="row g-2">
			<div class="col-md-4" style="min-height:58px;">
				<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="customer" name="customer" data-live-search="true" data-size="8" autofocus>
					<option value="">Pilih Customer</option>
					<?php
					foreach ($data_invoice_penjualan->result() as $x) {
					?>
						<option value="<?= $x->inisial1 ?>" data-subtext="<?= $x->inisial1 ?>" data-token="<?= $x->inisial1 ?>"><?= $x->nama_kustomer ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<!-- <div class="col-sm-6 col-lg-3" style="min-height:58px;">
                <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="bank" name="bank" data-live-search="true" data-size="8">
                    <option value="">Pilih Akun Kas</option>
                    <?php
					foreach ($data_bank->result() as $x) {
					?>
                        <option value="<?= $x->bank_account ?>" data-subtext="<?= $x->bank_account ?>" data-token="<?= $x->bank_name ?>"><?= $x->bank_name ?></option>
                    <?php
					}
					?>
                </select>
            </div> -->
			<div class="col-md-4">
				<div class="form-floating">
					<input type="date" class="form-control shadow-sm" id="tgl_closing" name="tgl_closing" placeholder="Tanggal Closing">
					<label for="tgl_closing">Tanggal Closing</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-floating">
					<textarea class="form-control shadow-sm" placeholder="Masukkan remark" id="remark" name="remark"></textarea>
					<label for="remark">Masukkan remark</label>
				</div>
			</div>
			<div class="col-md-12">
				<div class="d-grid">
					<button class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#modalInvoice" id="pilihInvoice">Pilih Invoice</button>
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
			<div class="modal-body" id="content-modal-invoice">
				<span><em>Harap lengkapi Customer dan Tanggal Closing</em></span>
				<div class="table-responsive small">
					<form method="post" action="<?= base_url(); ?>create_transaction/add_to_closing/">
						<input type="text" id="cari_invoice" class="w-100 mb-2 form-control" placeholder="Cari di sini..">
						<input type="hidden" id="txt_cust" name="txt_cust" class="w-100 mb-2 form-control">
						<input type="hidden" id="txt_bank" name="txt_bank" class="w-100 mb-2 form-control">
						<input type="hidden" id="txt_tgl_closing" name="txt_tgl_closing" class="w-100 mb-2 form-control">
						<input type="hidden" id="txt_remark" name="txt_remark" class="w-100 mb-2 form-control">
						<table class="table table-striped table-hover table-sm table-bordered" style="width:100%" id="tbl-result">
							<thead>
								<tr>
									<th onclick="alert('ted');">No</th>
									<th>Nomor Invoice</th>
									<th>Amount</th>
									<th>Tgl Terima Invoice</th>
									<th>Term Pembayaran</th>
								</tr>
							</thead>
							<tbody id="result-table">
							</tbody>
						</table>
						<button class="btn btn-secondary" id="add_to_closing" type="submit">Tambahkan</button>
					</form>
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
				url: '<?= base_url(); ?>create_transaction/get_invoice/' + cust,
				type: 'GET',
				dataType: 'html',
				data: {
					cust: cust
				},
				success: function(result) {
					$("#result-table").html(result);
				}
			})
		});
		$('#cari_invoice').keyup(function() {
			var value = $(this).val().toLowerCase();
			$("#tbl-result > tbody > tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
		$('#pilihInvoice').click(function() {
			var txt_cust = $("#txt_cust").val($("#customer").val());
			var txt_bank = $("#txt_bank").val($("#bank").val());
			var txt_tgl_closing = $("#txt_tgl_closing").val($("#tgl_closing").val());
			var txt_remark = $("#txt_remark").val($("#remark").val());
		});
		// $('#dataInvoicePenjualan').DataTable({
		// 	"scrollX": true,
		// 	"scrollY": "250px",
		//     "scrollCollapse": true,
		// 	"paging": true,
		// 	"info": true,
		// 	"filter": true
		// });
		var modalInvoice = document.getElementById('modalInvoice')
		modalInvoice.addEventListener('shown.bs.modal', function(event) {
			var cust = $("#customer").val();
			var tgl_closing = $("#tgl_closing").val();
			if (cust == '' || tgl_closing == '') {
				$("#content-modal-invoice > span").removeClass('d-none').addClass('d-block');
				$("#content-modal-invoice > div.table-responsive").removeClass('d-block').addClass('d-none');
			} else {
				$("#content-modal-invoice > div.table-responsive").removeClass('d-none').addClass('d-block');
				$("#content-modal-invoice > span").removeClass('d-block').addClass('d-none');
			}
		})

		// $('.cekbok').change(function() {
		//     if(this.checked) {
		//         alert('test');
		//     }
		// });
		$('#result-table > tr').on('click', 'td>label', function() {
			alert($(this).text());
		});
		$(".cekbok").live('click', function() {
			alert()
		});
	});
</script>
