<div class="row mb-3">
    <div class="col bg-info shadow-sm p-3">
        <div class="d-flex align-items-center">
            <span class="text-white">
                <i class="bi bi-receipt"></i> Account Payable Payment
            </span>
            <a href="<?php echo base_url();?>" class="btn btn-secondary ms-auto"><i class="bi bi-arrow-bar-left"></i> Back to Home</a>
        </div>
    </div>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link" href="<?= base_url();?>create_transaction/form_account_payable">Purchase Invoice</a>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="closeinvoice-tab" data-bs-toggle="tab" data-bs-target="#closeinvoice" type="button" role="tab" aria-controls="closeinvoice" aria-selected="true">Close Invoice / Account Payable Payment</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active p-3 bg-white border" id="closeinvoice" role="tabpanel" aria-labelledby="closeinvoice-tab">
        <div class="row g-2">
            <div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
				<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="cash_account" name="cash_account" data-live-search="true" data-size="8" autofocus>
				    <option value="">Cash Account</option>
                    <?php
						foreach ($data_akun_setting->result() as $x) {
					?>
						<option value="<?= $x->id_akun?>" data-subtext="<?= $x->acc_no?>" data-token="<?= $x->id_akun?>"><?= $x->description?></option>
					<?php
						}
					?>	
				</select>
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
                <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="received_by_vendor" name="received_by_vendor" data-live-search="true" data-size="8" autofocus>
                    <option value="">- Pilih Received by Vendor -</option>
                    <?php
                    foreach ($data_vendor->result() as $x) {
                    ?>
                        <option value="<?= $x->id_vendor?>" data-subtext="<?= $x->alias?>" data-token="<?= $x->id_vendor?>"><?= $x->vendor?></option>
                    <?php
                        }
                    ?>
				</select>
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
                <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="department" name="department" data-live-search="true" data-size="8">
                    <option value="">- Pilih Department -</option>
                <?php
                    $get_department = $this->Master_data_m->getDataDepartmentHris();
                    foreach ($get_department->result() as $x) {
                ?>
                    <option value="<?= $x->id;?>" data-token="<?= $x->dept_name;?>"><?= $x->dept_name;?></option>
                <?php
                    }
                ?>
                </select>
			</div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="project" name="project" data-live-search="true" data-size="8">
                    <option value="">- Pilih Project -</option>
                <?php
                    $get_project = $this->Master_data_m->getDataProject(0);
                    foreach ($get_project->result() as $x) {
                ?>
                    <option value="<?= $x->id;?>" data-token="<?= $x->project;?>"><?= $x->project_code.' - '.$x->project;?></option>
                <?php
                    }
                ?>
                </select>
            </div>
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Detail Invoice</button>
                    </li>
                </ul>
                <div class="tab-content shadow-sm" id="myTabContent">
                    <div class="tab-pane fade show active p-3 bg-white border border-top-0" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Purchase Number</th>
                                        <th scope="col">Tanggal Invoice</th>
                                        <th scope="col">Saldo</th>
                                        <th scope="col">Jumlah Bayar</th>
                                    </tr>
                                </thead>
                                <tbody id="detail_invoice"></tbody>
                                <tr>
                                    <td colspan="3"></td>
                                    <td align="right"><b>Total :</b></td>
                                    <td><input type="hidden" id="valuenya"><button type="button"  class="btn btn-success fw-bold btn-sm w-100" id="total_netto" data-bs-toggle="tooltip" title="Klik untuk cek">Cek Total Netto</button></td>
                                </tr>
                            </table>
                        </div>
                        <input type="hidden" name="jml_row" id="jml_row">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="form-floating">
                    <input type="date" class="form-control shadow-sm" id="tgl_pembayaran" name="tgl_pembayaran"  placeholder="tgl_pembayaran" required="">
                    <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 d-grid">
                <div class="input-group">
                    <select class="form-select" id="status" aria-label="Example select with button addon" required="">
                        <option value="">Draft or Posting</option>
                        <option value="0">Draft</option>
                        <option value="1">Posting</option>
                    </select>
                    <button type="submit" class="btn btn-primary" id="simpan">Submit</button>
                </div>
            </div>
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

<script type="text/javascript">
    $('#loading_wallet').hide();
    $('#success_submit').hide();
	$(document).ready(function() {
        // $('#cash_account').change(function() {
        //     var id_cash_account = $(this).val();
        //     $.ajax({
        //         url : "<?php echo base_url();?>create_transaction/getVendorByIdCashAccount",
        //         method : "POST",
        //         data : {id_cash_account: id_cash_account},
        //         dataType : 'json',
        //         success: function(data){
        //             var html = '';
        //             var i;
        //             for(i=0; i<data.length; i++){                   
        //                 html += '<option value="'+data[i].id_vendor+'" data-subtext="'+data[i].alias+'" data-token="'+data[i].vendor+'">'+data[i].vendor+'</option>';
        //             }
        //             $('#received_by_vendor').html('<option value="">- Pilih Received by Vendor -</option>'+html);
        //         }
        //     });
        // });

        $('#received_by_vendor').change(function() {
            var id_vendor = $(this).val();
            $.ajax({
                url: "<?php echo base_url();?>create_transaction/getDataPurchaseInvoice",
                method : "POST",
                data: {id_vendor: id_vendor},
                dataType: 'json',
                success: function (data) {
                    if (id_vendor!='') {
                        if (data!="") {
                            var html = '';
                            var i;
                            var j=1;
                            for(i=0; i<data.length; i++){                
                                html += '<tr>'+
                                            '<td>'+j+'</td>'+
                                            '<td>'+data[i].purchase_number+'</td>'+
                                            '<td>'+data[i].invoice_date+'</td>'+
                                            '<td>'+data[i].total+'</td>'+
                                            '<td>'+
                                                '<input id="purchase_number'+j+'" type="hidden" value="'+data[i].purchase_number+'">'+
                                                '<input id="saldo'+j+'" type="hidden" value="'+data[i].total+'">'+
                                                '<input id="jumlah_bayar'+j+'" type="text" class="form-control" value="'+data[i].total+'">'+
                                            '</td>'+
                                        '</tr>';
                                j++;
                            }
                            $('#detail_invoice').html(html);
                            $('#jml_row').val(j-1);
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: 'Nothing!',
                                html: 'Vendor yang Anda pilih tidak memiliki invoice yg open',
                                showConfirmButton: true
                            });
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            html: 'Silakan pilih vendor',
                            showConfirmButton: true
                        });                        
                    }
                }
            });
        });

        $('#total_netto').click(function(event) {
            var total = 0;
            $('input[id^=jumlah_bayar]').each(function(index, el) {
                if ($(this).val() == '') {
                    $(this).val(0);
                }
                total += parseFloat($(this).val());
            });
            $('#total_netto').html('Rp '+total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('#valuenya').val(total);
        });

        $('#simpan').click(function(event) {
            $(this).attr('disabled', true);
            <?php
                $max_id = $this->db->query("SELECT count(id) as jml FROM tr_closing_ap");
                $get_max_id = $max_id->row()->jml;
                $curr_id = $get_max_id+1;
            ?>
            var curr_id = "<?= $curr_id;?>";
            var code_account = $('#cash_account').val();
            var received_by_vendor = $('#received_by_vendor').val();
            var department = $('#department').val();
            var project = $('#project').val();
            var tgl_pembayaran = $('#tgl_pembayaran').val();
            var status = $('#status').val();
            var total_value = $('#valuenya').val();
            var row_detail = $('#jml_row').val();
            if (code_account!='' && received_by_vendor!='' && department!='' && project!='' && tgl_pembayaran!='' && status != '' && total_value > 0)
            {
                $.ajax({
                    url: '<?= base_url();?>create_transaction/close_purchase_invoice',
                    type: 'POST',
                    dataType: 'json',
                    data: {curr_id:curr_id, code_account:code_account, received_by_vendor: received_by_vendor, department:department, project:project, tgl_pembayaran:tgl_pembayaran, status:status, total_value:total_value},
                    success: function(result){
                        var i;
                        for (i=1; i<=row_detail; i++) {
                            var purchase_number = $('#purchase_number'+i).val();
                            var saldo = $('#saldo'+i).val();
                            var jumlah_bayar = $('#jumlah_bayar'+i).val();
                            var statusnya;
                            if (jumlah_bayar < saldo) {
                                statusnya = "0";
                            }else{
                                statusnya = "1";
                            }
                            if (jumlah_bayar>0) {
                                $.ajax({
                                    url: '<?= base_url();?>create_transaction/close_purchase_invoice_detail',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {curr_id:curr_id, purchase_number:purchase_number, saldo:saldo, jumlah_bayar: jumlah_bayar, statusnya: statusnya},
                                    success: function (result) {
                                        console.log(result);
                                    }
                                });
                            }
                        }
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
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops!',
                    html: 'Silakan lengkapi data atau Cek Total Netto terlebih dahulu!',
                    showConfirmButton: true
                });
                $(this).attr('disabled', false);
            }
        });
	});
</script>