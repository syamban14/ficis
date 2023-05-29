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
    <div class="tab-pane fade show active p-3 bg-white border position-relative" id="closeinvoice" role="tabpanel" aria-labelledby="closeinvoice-tab">
        <div class="row g-2">
            <div class="col-md-4" style="min-height:58px;">
                <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="customer" name="customer" data-live-search="true" data-size="8" autofocus disabled>
                    <option>Pilih Customer</option>
                    <?php foreach ($data_invoice_penjualan->result() as $x): ?>
                        <?php foreach ($data_closing_hd->result() as $y): ?>
                            <option value="<?= $x->kode_kustomer?>" data-subtext="<?= $x->kode_kustomer?>" data-token="<?= $x->kode_kustomer?>" <?= ($x->kode_kustomer==$y->customer)? "selected":""; ?>><?= $x->nama_kustomer?></option>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="date" class="form-control shadow-sm" id="tgl_closing" name="tgl_closing" placeholder="Tanggal Closing" required="" value="<?= $data_closing_hd->row()->tgl_closing; ?>">
                    <label for="tgl_closing">Tanggal Closing</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <textarea class="form-control shadow-sm" placeholder="Masukkan remark" id="remark" name="remark" required=""><?= $data_closing_hd->row()->remark; ?>
                    </textarea>
                    <label for="remark">Masukkan remark</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-none">
                <div class="d-grid">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalInvoice" id="pilihInvoice">Pilih Invoice</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="row g-2">
            <div class="table-responsive small">
                <table class="table table-striped table-hover table-sm table-bordered" style="width:100%" id="tbl-result">
                    <thead>
                        <tr class="text-uppercase">
                            <th rowspan="2">Nomor Invoice</th>
                            <th rowspan="2">Outstanding A/R</th>
                            <th colspan="5" class="text-center">Akun</th>
                            <th rowspan="2">Saldo Akhir</th>
                        </tr>
                        <tr>
                            <th>
                                <select class="selectpicker form-control shadow-sm" id="akun_bank" name="akun_bank" data-live-search="true" data-size="8">
                                    <option>- Pilih Bank - </option>
                                    <?php
                                    	foreach($data_bank->result() AS $x)
                                        {
                                            echo "<option value='".$x->id_akun."'>$x->description</option>";
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <select class="selectpicker form-control shadow-sm" id="akun_pph" name="akun_pph" data-live-search="true" data-size="8">
                                    <option>- Pilih PPh - </option>
                                    <?php
                                    	foreach($data_akun_setting->result() AS $x)
                                        {
                                            echo "<option value='".$x->id_akun."'>$x->description</option>";
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <select class="selectpicker form-control shadow-sm" id="akun_ppn" name="akun_ppn" data-live-search="true" data-size="8">
                                    <option>- Pilih PPN - </option>
                                    <?php
                                    	foreach($data_akun_setting->result() AS $x)
                                        {
                                            echo "<option value='".$x->id_akun."'>$x->description</option>";
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <select class="selectpicker form-control shadow-sm" id="akun_adminbank" name="akun_adminbank" data-live-search="true" data-size="8">
                                    <option>- Pilih ADMIN BANK - </option>
                                    <?php
                                    	foreach($data_akun_setting->result() AS $x)
                                        {
                                            echo "<option value='".$x->id_akun."'>$x->description</option>";
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <select class="selectpicker form-control shadow-sm" id="akun_bungafactoring" name="bank" data-live-search="true" data-size="8">
                                    <option>- Pilih Bunga Factoring - </option>
                                    <?php
                                    	foreach($data_akun_setting->result() AS $x)
                                        {
                                            echo "<option value='".$x->id_akun."'>$x->description</option>";
                                        }
                                    ?>
                                </select>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1; 
                            foreach ($data_closing_dt->result() as $x): ?>
                            <tr>
                                <td id="no_inv<?= $i;?>"><?= $x->no_inv; ?></td>
                                <td align="right">Rp <?= number_format($x->amount,2); ?><input type="hidden" id="saldoawal<?= $i;?>" value="<?= $x->amount;?>"></td>
                                <td><input type="text" id="bank<?= $i;?>" value="0"></td>
                                <td><input type="text" id="pph<?= $i;?>" value="0"></td>
                                <td><input type="text" id="ppn<?= $i;?>" value="0"></td>
                                <td><input type="text" id="adminbank<?= $i;?>" value="0"></td>
                                <td><input type="text" id="bungafactoring<?= $i;?>" value="0"></td>
                                <td><input type="text" id="saldoakhir<?= $i;?>" readonly></td>
                            </tr>
                        <?php $i++; endforeach ?>
                    </tbody>
                </table>
                <div style="height: 150px;"></div>
            </div>
            <button class="btn btn-secondary" id="closing">Submit</button>
            <input type="hidden" value="<?= $i-1;?>" id="jml_inv">
        </div>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <div id="loading_wallet" class="bg-dark w-100 h-100 position-absolute top-50 start-50 translate-middle align-items-center justify-content-center" style="backdrop-filter:blur(2px);--bs-bg-opacity: .1;">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_yZpLO2.json" background="rgba(0, 0, 0, 0)" speed="1" style="width:250px;height:auto;" loop autoplay></lottie-player>
        </div>
        <div id="success_submit" class="bg-dark w-100 h-100 position-absolute top-50 start-50 translate-middle align-items-center justify-content-center" style="backdrop-filter:blur(2px);--bs-bg-opacity: .1;">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_ebpy0jqw.json" background="rgba(0, 0, 0, 0)" speed="1" style="width:250px;height:auto;" loop autoplay></lottie-player>
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
                <span><em>Harap lengkapi Customer, Akun Kas, dan Tanggal Closing</em></span>
                <div class="table-responsive small">
                    <form method="post" action="<?= base_url();?>create_transaction/add_to_closing/">
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
    $('#loading_wallet').hide();
    $('#success_submit').hide();
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
        $('#pilihInvoice').click(function(){
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
        modalInvoice.addEventListener('shown.bs.modal', function (event) {
            var cust = $("#customer").val();
            var bank = $("#bank").val();
            var tgl_closing = $("#tgl_closing").val();
            if (cust=='' || bank=='' || tgl_closing=='') {
                $("#content-modal-invoice > span").removeClass('d-none').addClass('d-block');
                $("#content-modal-invoice > div.table-responsive").removeClass('d-block').addClass('d-none');
            } else {
                $("#content-modal-invoice > div.table-responsive").removeClass('d-none').addClass('d-block');
                $("#content-modal-invoice > span").removeClass('d-block').addClass('d-none');
            }
        })

        var jml_inv = $('#jml_inv').val();        
        for (var i = 1; i <= jml_inv; i++) {
            (function(index){
                var no_inv= $('#no_inv'+index).text();
                var saldoawal;
                var bank;
                var pph;
                var ppn;
                var adminbank;
                var bungafactoring;
                var pengurang;
                var saldoakhir;
                
                $('#bank'+index).change(function(){
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseInt(bank)+parseInt(pph)+parseInt(ppn)+parseInt(adminbank)+parseInt(bungafactoring));  
                    saldoakhir        =(parseInt(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir);
                });

                $('#pph'+index).change(function(){
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseInt(bank)+parseInt(pph)+parseInt(ppn)+parseInt(adminbank)+parseInt(bungafactoring));  
                    saldoakhir        =(parseInt(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir);
                });

                $('#ppn'+index).change(function(){
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseInt(bank)+parseInt(pph)+parseInt(ppn)+parseInt(adminbank)+parseInt(bungafactoring));  
                    saldoakhir        =(parseInt(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir);
                });

                $('#adminbank'+index).change(function(){
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseInt(bank)+parseInt(pph)+parseInt(ppn)+parseInt(adminbank)+parseInt(bungafactoring));  
                    saldoakhir        =(parseInt(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir);
                });
                
                $('#bungafactoring'+index).change(function(){
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseInt(bank)+parseInt(pph)+parseInt(ppn)+parseInt(adminbank)+parseInt(bungafactoring));  
                    saldoakhir        =(parseInt(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir);
                });

            })(i) 
        }

        $('#closing').click(function(event) {
            var akun_bank=$('#akun_bank').val();
            var akun_pph=$('#akun_pph').val();
            var akun_ppn=$('#akun_ppn').val();
            var akun_adminbank=$('#akun_adminbank').val();
            var akun_bungafactoring=$('#akun_bungafactoring').val();
            var jml_inv = $('#jml_inv').val();
                        
            for (var i = 1; i <= jml_inv; i++) {
                var no_inv            = $('#no_inv'+i).text();
                var saldoawal         = $('#saldoawal'+i).val();
                var bank              = $('#bank'+i).val();
                var pph               = $('#pph'+i).val();
                var ppn               = $('#ppn'+i).val();
                var adminbank         = $('#adminbank'+i).val();
                var bungafactoring    = $('#bungafactoring'+i).val();
                var pengurang         =(parseInt(bank)+parseInt(pph)+parseInt(ppn)+parseInt(adminbank)+parseInt(bungafactoring));  
                var saldoakhir        =parseInt(saldoawal)-pengurang;
                
                $('#saldoakhir'+i).val(saldoakhir);
                $.ajax({
                    url: '<?= base_url();?>create_transaction/close_invoice',
                    type: 'POST',
                    dataType: 'json',
                    data: {no_inv: no_inv, akun_bank:akun_bank, akun_pph:akun_pph, akun_ppn:akun_ppn, akun_adminbank:akun_adminbank, akun_bungafactoring:akun_bungafactoring, saldoawal:saldoawal, bank:bank, pph:pph, ppn:ppn, adminbank:adminbank, bungafactoring:bungafactoring, saldoakhir:saldoakhir},
                    success: function(result){
                        setTimeout(function(){
                            if (result==1) {
                                $('#loading_wallet').fadeOut();
                                $('#loading_wallet').addClass('d-none').removeClass('d-flex');
                                $('#success_submit').fadeIn();
                                $('#success_submit').addClass('d-flex');
                                setTimeout(function(){
                                    window.location.replace('<?= base_url();?>');
                                }, 3000);
                            }
                        }, 2000);
                    }
                })
                .always(function() {
                    $('#loading_wallet').fadeIn();
                    $('#loading_wallet').addClass('d-flex');
                });
            }
        });
	});
</script>