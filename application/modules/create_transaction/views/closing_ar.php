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
  <li class="nav-item" role="presentation">
    <a class="nav-link" href="<?= base_url();?>create_transaction/ar_correction">AR Correction</a>
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
                            <option value="<?= $x->inisial1?>" data-subtext="<?= $x->inisial1?>" data-token="<?= $x->inisial1?>" <?= ($x->inisial1==$y->customer)? "selected":""; ?>><?= $x->nama_kustomer?></option>
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
                <?php
                    $akun_banknya='';
                    $akun_ppnnya='';
                    foreach ($data_closing_dt->result() as $w) {
                        $akun_banknya=$w->akun_bank;
                        $akun_ppnnya=$w->akun_ppn;
                    }
                ?>
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
                                <select class="selectpicker form-control shadow-sm" id="akun_bank" name="akun_bank" data-live-search="true" data-size="8" data-container="body">
                                    <option value="">- Pilih Bank - </option>
                                    <?php
                                    	foreach($data_bank->result() AS $x){
                                    ?>
                                            <option value="<?= $x->id_akun;?>" <?php if ($x->id_akun==$akun_banknya) {echo 'selected';} ?>><?=$x->description;?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <select class="selectpicker form-control shadow-sm" id="akun_pph" name="akun_pph" data-live-search="true" data-size="8" data-container="body">
                                    <option value="">- Pilih PPh - </option>
                                    <?php
                                    	foreach($data_akun_setting->result() AS $x)
                                        {
                                    ?>
                                            <option value="<?= $x->id_akun;?>" <?php if($x->id_akun=='90'){echo 'selected';}?>><?= $x->description;?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <select class="selectpicker form-control shadow-sm" id="akun_ppn" name="akun_ppn" data-live-search="true" data-size="8" data-container="body">
                                    <option value="">- Pilih PPN - </option>
                                    <?php
                                    	foreach($data_akun_setting->result() AS $x)
                                        {
                                    ?>
                                            <option value="<?= $x->id_akun;?>" <?php if ($x->id_akun==$akun_ppnnya) {echo 'selected';} ?>><?= $x->description;?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <select class="selectpicker form-control shadow-sm" id="akun_adminbank" name="akun_adminbank" data-live-search="true" data-size="8" data-container="body">
                                    <option value="">- Pilih ADMIN BANK - </option>
                                    <?php
                                    	foreach($data_akun_setting->result() AS $x)
                                        {
                                    ?>
                                            <option value="<?= $x->id_akun;?>" <?php if($x->id_akun=='331'){echo 'selected';}?>><?= $x->description;?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <select class="selectpicker form-control shadow-sm" id="akun_bungafactoring" name="bank" data-live-search="true" data-size="8" data-container="body">
                                    <option value="">- Pilih Akun - </option>
                                    <?php
                                    	foreach($data_akun_setting->result() AS $x)
                                        {
                                    ?>
                                            <option value="<?= $x->id_akun;?>" <?php if($x->id_akun=='327'){echo 'selected';}?>><?= $x->description;?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $bank = '';
                            $ppn = '';
                            $pph = '';
                            $admin_bank = '';
                            $bunga_factoring = '';
                            $saldoakhir = '';
                            foreach ($data_closing_dt->result() as $x){
                                if ($x->bank==NULL || $x->bank=='') {$bank=0;}else{$bank=$x->bank;}
                                if ($x->ppn==NULL || $x->ppn=='') {$ppn=0;}else{$ppn=$x->ppn;}
                                if ($x->total==NULL || $x->total=='') {$pph=0;}else{$pph=floor($x->total*0.02);}
                                if ($x->admin_bank==NULL || $x->admin_bank=='') {$admin_bank=0;}else{$admin_bank=$x->admin_bank;}
                                if ($x->bunga_factoring==NULL || $x->bunga_factoring=='') {$bunga_factoring=0;}else{$bunga_factoring=$x->bunga_factoring;}
                                if ($x->saldoakhir==NULL || $x->saldoakhir=='') {$saldoakhir=0;}else{$saldoakhir=$x->saldoakhir;}
                        ?>
                            <tr>
                                <td id="no_inv<?= $i;?>"><?= $x->no_inv; ?></td>
                                <td align="right">Rp <?= number_format($x->amount,2); ?><input type="hidden" id="saldoawal<?= $i;?>" value="<?= $x->amount;?>"></td>
                                <td><input type="text" id="bank<?= $i;?>" value="<?= $bank;?>"></td>
                                <td><input type="text" id="pph<?= $i;?>" value="<?= $pph;?>"></td>
                                <td><input type="text" id="ppn<?= $i;?>" value="<?= $ppn;?>"></td>
                                <td><input type="text" id="adminbank<?= $i;?>" value="<?= $admin_bank;?>"></td>
                                <td><input type="text" id="bungafactoring<?= $i;?>" value="<?= $bunga_factoring;?>"></td>
                                <td><input type="text" id="saldoakhir<?= $i;?>" value="<?= $saldoakhir;?>" readonly></td>
                            </tr>
                        <?php $i++;} ?>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-primary" id="closing">Submit</button>
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
    function formatAngka(angka) {
        return angka.toLocaleString('en-US'); // 'id-ID' digunakan untuk format angka di Indonesia
    }
    function formatAngkaInput(inputElement) {
      // Mengambil nilai dari input
      let angka = inputElement.value;

      // Menghapus semua karakter selain angka, titik (.) dan tanda minus (jika ada)
      angka = angka.replace(/[^\d.-]/g, '');

      // Menghilangkan karakter titik yang lebih dari satu
      angka = angka.replace(/(\..*)\./g, '$1');

      // Mencegah lebih dari satu tanda minus di awal angka
      angka = angka.replace(/^-/g, '');

      // Mengatasi kasus input kosong
      if (angka === '') {
        inputElement.value = 0;
        return;
      }

      // Memformat angka sesuai dengan 'en-US' atau 'id-ID'
      const hasilPemformatan = parseFloat(angka).toLocaleString('en-US', { maximumFractionDigits: 2 }); // Ganti dengan 'id-ID' jika ingin format Indonesia

      // Memasukkan hasil pemformatan kembali ke input
      inputElement.value = hasilPemformatan;
    }

    $('#loading_wallet').hide();
    $('#success_submit').hide();
	$(document).ready(function() {
        $('#bank1').toLocaleString('en-US');
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

                var bank_from_db = parseFloat($('#bank'+index).val());
                var pph_from_db = parseFloat($('#pph'+index).val());
                var ppn_from_db = parseFloat($('#ppn'+index).val());
                var adminbank_from_db = parseFloat($('#adminbank'+index).val());
                var bungafactoring_from_db = parseFloat($('#bungafactoring'+index).val());
                // var saldoakhir_from_db = parseFloat($('#saldoakhir'+index).val());
                $('#bank'+index).val(formatAngka(bank_from_db));
                $('#pph'+index).val(formatAngka(pph_from_db));
                $('#ppn'+index).val(formatAngka(ppn_from_db));
                $('#adminbank'+index).val(formatAngka(adminbank_from_db));
                $('#bungafactoring'+index).val(formatAngka(bungafactoring_from_db));
                // $('#saldoakhir'+index).val(formatAngka(saldoakhir_from_db));

                $('#bank'+index).keyup(function(){
                    formatAngkaInput(this);
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseFloat(bank.replace(/,/g, ""))+parseFloat(pph.replace(/,/g, ""))+parseFloat(ppn.replace(/,/g, ""))+parseFloat(adminbank.replace(/,/g, ""))+parseFloat(bungafactoring.replace(/,/g, "")));  
                    saldoakhir        =(parseFloat(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir.toFixed(2));
                });

                $('#pph'+index).keyup(function(){
                    formatAngkaInput(this);
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseFloat(bank.replace(/,/g, ""))+parseFloat(pph.replace(/,/g, ""))+parseFloat(ppn.replace(/,/g, ""))+parseFloat(adminbank.replace(/,/g, ""))+parseFloat(bungafactoring.replace(/,/g, "")));  
                    saldoakhir        =(parseFloat(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir.toFixed(2));
                });

                $('#ppn'+index).keyup(function(){
                    formatAngkaInput(this);
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseFloat(bank.replace(/,/g, ""))+parseFloat(pph.replace(/,/g, ""))+parseFloat(ppn.replace(/,/g, ""))+parseFloat(adminbank.replace(/,/g, ""))+parseFloat(bungafactoring.replace(/,/g, "")));  
                    saldoakhir        =(parseFloat(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir.toFixed(2));
                });

                $('#adminbank'+index).keyup(function(){
                    formatAngkaInput(this);
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseFloat(bank.replace(/,/g, ""))+parseFloat(pph.replace(/,/g, ""))+parseFloat(ppn.replace(/,/g, ""))+parseFloat(adminbank.replace(/,/g, ""))+parseFloat(bungafactoring.replace(/,/g, "")));  
                    saldoakhir        =(parseFloat(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir.toFixed(2));
                });
                
                $('#bungafactoring'+index).keyup(function(){
                    formatAngkaInput(this);
                    saldoawal         = $('#saldoawal'+index).val();
                    bank              = $('#bank'+index).val();
                    pph               = $('#pph'+index).val();
                    ppn               = $('#ppn'+index).val();
                    adminbank         = $('#adminbank'+index).val();
                    bungafactoring    = $('#bungafactoring'+index).val();
                    pengurang         =(parseFloat(bank.replace(/,/g, ""))+parseFloat(pph.replace(/,/g, ""))+parseFloat(ppn.replace(/,/g, ""))+parseFloat(adminbank.replace(/,/g, ""))+parseFloat(bungafactoring.replace(/,/g, "")));    
                    saldoakhir        =(parseFloat(saldoawal)-pengurang);
                    $('#saldoakhir'+index).val(saldoakhir.toFixed(2));
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
            var id_tr = '<?= $this->uri->segment(3);?>';
            var revisi = '<?= $this->uri->segment(4);?>';
            for (var i = 1; i <= jml_inv; i++) {
                var no_inv            = $('#no_inv'+i).text();
                var saldoawal         = $('#saldoawal'+i).val();
                var bank              = $('#bank'+i).val().replace(/,/g, "");
                var pph               = $('#pph'+i).val().replace(/,/g, "");
                var ppn               = $('#ppn'+i).val().replace(/,/g, "");
                var adminbank         = $('#adminbank'+i).val().replace(/,/g, "");
                var bungafactoring    = $('#bungafactoring'+i).val().replace(/,/g, "");
                var pengurang         =(parseFloat(bank)+parseFloat(pph)+parseFloat(ppn)+parseFloat(adminbank)+parseFloat(bungafactoring));  
                var saldoakhir        =parseFloat(saldoawal)-pengurang;
                
                $('#saldoakhir'+i).val(saldoakhir.toFixed(2));
                $.ajax({
                    url: '<?= base_url();?>create_transaction/close_invoice',
                    type: 'POST',
                    dataType: 'json',
                    data: {id_tr:id_tr, no_inv: no_inv, akun_bank:akun_bank, akun_pph:akun_pph, akun_ppn:akun_ppn, akun_adminbank:akun_adminbank, akun_bungafactoring:akun_bungafactoring, saldoawal:saldoawal, bank:bank, pph:pph, ppn:ppn, adminbank:adminbank, bungafactoring:bungafactoring, saldoakhir:saldoakhir.toFixed(2), revisi:revisi},
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