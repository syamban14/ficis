<div class="row mb-3">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<span class="text-white">
				<i class="bi bi-receipt"></i> Purchase Invoice Edit
			</span>
			<a href="<?php echo base_url();?>" class="btn btn-secondary ms-auto"><i class="bi bi-arrow-bar-left"></i> Back to Home</a>
		</div>
	</div>
</div>
<?php
    foreach ($data_account_payable as $x){
        $id_ap=$x->id_ap;
        $vendor_id=$x->vendor_id;
        $vendor_name=$x->vendor_name;
        $purchase_number=$x->purchase_number;
        $invoice_date=$x->invoice_date;
        $po_id=$x->po_id;
        $po_number=$x->po_no;
        $tax_number=$x->tax_number;
        $tax_date=$x->tax_date;
        $department=$x->department;
        $dept_code=$x->dept_code;
        $dept_name=$x->dept_name;
        $project_id=$x->project_id;
        $project_code=$x->project_code;
        $project=$x->project;
        $dp=$x->dp;
        $nilai_dp=$x->nilai;
        $payment_terms=$x->payment_terms;
        $delivery_date=$x->delivery_date;
        $purchasing_dept=$x->purchasing_dept;
        $statusnya=$x->statusnya;
    }

?>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active p-3 bg-white border" id="createinvoice" role="tabpanel" aria-labelledby="createinvoice-tab">
	<!-- <form> -->
		<div class="row g-2">
			<div class="col-sm-6 col-md-4 col-lg-3">                
				<div class="form-floating">
				<input type="text" class="form-control shadow-sm" value="<?php echo $vendor_name;?>" readonly="">
                <input type="hidden" id="vendor" name="vendor" value="<?php echo $vendor_id;?>">     
					<label>Vendor Name</label>
				</div>           
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="text" class="form-control shadow-sm" id="no_inv" name="no_inv" value="<?php echo $purchase_number;?>" placeholder="Nomor Invoice"  readonly="">
					<label for="no_inv">Purchase Number</label>
				</div>
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">            
				<div class="form-floating">
					<input type="hidden" id="po_no" name="po_no" value="<?php echo $po_id;?>">
					<input type="text" class="form-control shadow-sm" value="<?php echo $po_number;?>" placeholder="Nomor PO" readonly="">
					<label for="po_no_val">PO Number</label>
				</div>           
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="date" class="form-control shadow-sm" id="tgl_input" name="tgl_input"  placeholder="Tanggal Input" value="<?php echo $invoice_date;?>" required="">
					<label for="tgl_input">Invoice Date </label>
				</div>
			</div>			
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="text" id="tax_number" class="form-control shadow-sm" placeholder="Tax Number" required="" value="<?php echo $tax_number; ?>">
					<label for="">Tax Number</label>
				</div>
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="date" class="form-control shadow-sm" id="tax_date" name="tax_date"  placeholder="Tax Date" required=""  value="<?php echo $tax_date; ?>">
					<label for="">Tax Date</label>
				</div>
			</div>			
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="text" class="form-control shadow-sm" id="department_name"  value="<?php echo $dept_name;?>" name="department_name" placeholder="Department" readonly="">
					<input type="hidden" class="form-control shadow-sm" id="department" name="department" placeholder="Department" value="<?php echo $department;?>">
					<label for="department">Department</label>
				</div>
			</div>	
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="text" class="form-control shadow-sm" value="<?php echo $project;?>" id="project_kosong" name="project_kosong" placeholder="Project" readonly="">
					<input type="hidden" class="form-control shadow-sm" id="project" name="project" value="<?php echo $project_id;?>">
					<label for="project">Project</label>
				</div>
			</div>	
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<select class="form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="dp" name="dp" data-live-search="true" data-size="8"  required="" autofocus>
						<?php
							$id_vendor=$vendor_id;
							$data=$this->Create_transaction_m->getDataPurchaseAdvance($id_vendor);
							foreach ($data as $x) {
								echo'<option value="'.$x->id.'">'.$x->account_desc.' - [Rp. '.number_format($x->nilai,0).']</option>';
							}
						?>
					</select>
					<input type="hidden" id="nilai_dp" name="nilai_dp" value="<?php echo $nilai_dp;?>" readonly>
				</div>
			</div>	
			<div class="col-12 mb-3">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Order Description</button>
					</li>
				</ul>
				<div class="tab-content shadow-sm" id="myTabContent">
					<div class="tab-pane fade show active p-3 bg-white border border-top-0" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="table-responsive">
							<table class="table table-bordered table-sm" width="100%" cellspacing="0">
								<tbody id="dataDeskripsi">
									<tr class="bg-secondary text-white">
										<th scope="col">#</th>
										<th scope="col">Order&nbsp;Description&nbsp;</th>
										<th scope="col">Code&nbsp;Account</th>
										<th scope="col">Received</th>
										<th scope="col">Unit</th>
										<th scope="col">Unit Price</th>
										<th scope="col">Discount&nbsp;(%)</th>
										<th scope="col">Tax 1</th>
										<th scope="col">Tax 2</th>
										<th scope="col">Total&nbsp;</th>
									</tr>
								</tbody>
                                <?php   
                                    $i=1;       
                                    $data_detail=$this->Create_transaction_m->getPodetailedit($purchase_number);
                                    foreach ($data_detail as $x) {
                                        echo'<tr>
                                                <td>'.$i.'<input type="hidden" id="id_ap_detail'.$i.'" value="'.$x->id_ap_detail.'" readonly=""></td>
                                                <td><input type="text" id="description'.$i.'" class="form-control" value="'.$x->order_description.'" readonly=""></td>
                                                <td><select id="code_account'.$i.'" class="code_account form-control form-control-sm border bg-white selectpicker" data-live-search="true" data-size="8" data-container="body">';
												 	$id_akun=$x->code_account;
													$data_akun=$this->Create_transaction_m->getDataAkun($id_akun);
													foreach ($data_akun->result() as $z){
													 	echo'<option value="'.$z->id.'"';
												    	if($z->id==$x->code_account){ echo 'selected="selected"'; }
														echo '>'.$z->id.' '.$z->description.'</option>';
													} 
										echo'		</select>
												</td>
                                                <td><input type="text" id="received'.$i.'" class="form-control" value="'.$x->received.'"></td>
                                                <td><input type="text" id="unit'.$i.'" class="form-control" value="'.$x->unit.'" readonly=""></td>
                                                <td><input type="text" class="form-control" id="price'.$i.'" class="form-control" value="'.$x->unit_price.'"></td>
                                                <td><input type="text" class="form-control" value="Rp. '.number_format($x->discount,0).'" readonly=""><input type="hidden" id="discount_amount'.$i.'" class="form-control" value="'.$x->discount.'" readonly=""></td>
                                          		<td id="render_pajak'.$i.'">
													<input type="hidden" class="form-control" id="id_pajak'.$i.'" name="id_pajak'.$i.'">
													<input type="hidden" class="form-control" id="kode_pajak'.$i.'" name="kode_pajak'.$i.'" readonly>
													<div class="input-group input-group-sm" style="min-width:150px!important;max-width:100%!important">
														<input type="text" class="form-control" id="nilai'.$i.'" name="nilai'.$i.'" value="'.$x->tax_one.'" readonly>
														<input type="text" class="form-control" id="nama_pajak'.$i.'" name="nama_pajak'.$i.'" readonly>
														<button class="btn btn-outline-secondary d-none" type="button" id="button-addon-hapus-pajak-'.$i.'" data-bs-toggle="tooltip" title="Hapus?"><i class="fas fa-times-circle"></i></button>
														<button class="btn btn-outline-secondary" type="button" id="button-addon-cari-pajak-'.$i.'" data-bs-toggle="modal" data-bs-target="#modalPajak'.$i.'"><i class="fas fa-search"></i></button>
													</div>
												</td>												
												<td id="render_pajak_dua'.$i.'">
													<input type="hidden" class="form-control" id="id_pajak_dua'.$i.'" name="id_pajak_dua'.$i.'">
													<input type="hidden" class="form-control" id="kode_pajak_dua'.$i.'" name="kode_pajak_dua'.$i.'" readonly>
													<div class="input-group input-group-sm" style="min-width:150px!important;max-width:100%!important">
														<input type="text" class="form-control" id="nilai_dua'.$i.'" name="nilai_dua'.$i.'" value="'.$x->tax_two.'" readonly>
														<input type="text" class="form-control" id="nama_pajak_dua'.$i.'" name="nama_pajak_dua'.$i.'" readonly>
														<button class="btn btn-outline-secondary d-none" type="button" id="button-addon-hapus-pajak_dua-'.$i.'" data-bs-toggle="tooltip" title="Hapus?"><i class="fas fa-times-circle"></i></button>
														<button class="btn btn-outline-secondary" type="button" id="button-addon-cari-pajak_dua-'.$i.'" data-bs-toggle="modal" data-bs-target="#modalPajakn'.$i.'"><i class="fas fa-search"></i></button>
													</div>
												</td>
                                                <td><input type="text" id="subtotal'.$i.'" name="subtotal'.$i.'" class="form-control" value="'.$x->total.'" readonly=""></td>
                                            </tr>';
                                        $i++;
                                    }
                                ?>
								<tr>
									<td colspan="8"></td>
									<td align="right"><input type="hidden" id="jumlah_detail" name="jumlah_detail" value="<?php echo $i-1;?>"><b>Total :</b></td>
									<td><button type="button"  class="btn btn-success fw-bold btn-sm w-100" id="total_netto" data-bs-toggle="tooltip" title="Klik untuk cek">Cek Total Netto</button></td>
								</tr>
							</table>					
						</div>
					</div>
				</div>
			</div> 
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="number" class="form-control shadow-sm" id="term_pembayaran" value="<?php echo $payment_terms;?>" name="term_pembayaran" placeholder="Term Pembayaran (hari)" required="">
					<label for="term_pembayaran">Payment Terms</label>
				</div>
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="date" class="form-control shadow-sm" id="delivery_date" value="<?php echo $delivery_date;?>" placeholder="Delivery Date" required="" readonly="">
					<label for="tgl_faktur_pajak">Delivery Date</label>
				</div>
			</div>	
			<div class="col-sm-6 col-md-4 col-lg-3">
				<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="purchasing_dept" name="purchasing_dept" data-live-search="true" data-size="8" autofocus>
				    <?php
						foreach ($data_procurement->result() as $x) {
					?>
						<option value="<?= $x->payroll_id?>" data-subtext="<?= $x->payroll_id?>" data-token="<?= $x->payroll_id?>" <?php if($purchasing_dept == $x->payroll_id) echo"selected"; ?>><?= $x->nama_karyawan?></option>
					<?php
						}
					?>		
				</select>
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3 d-grid">
				<div class="input-group">
					<select class="form-select" id="status" aria-label="Example select with button addon" required="">
                        <option value="" <?php if($statusnya == '') echo"selected"; ?> > Draft or Posting</option>
                        <option value="0" <?php if($statusnya == '0') echo"selected"; ?> > Draft </option>
                        <option value="1" <?php if($statusnya == '1') echo"selected"; ?> > Posting </option>
					</select>
					<button type="submit" class="btn btn-primary" id="update">Update</button>
				</div>
			</div>
		</div>
	<!-- </form> -->
  </div>
</div>

<?php 
 for($i=0;$i<=9;$i++){
?>
<div class="modal fade modalPajak" id="modalPajak<?=$i;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					<i class="far fa-list-alt"></i> Pilih Pajak <!--?=$i;?-->
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div> 
			<div class="modal-body">
				<div class="row g-2">
					<div class="col-md-12">
						<input type="text" id="cari_pajak_row<?=$i;?>" class="w-100 border border-success mb-2" placeholder="Cari di sini..">
						<div class="table-responsive">
							<table id="dataPajak1" class="table table-hover table-sm" style="width: 100%;">
								<thead>
						            <tr>
						                <th class="d-none">#</th>
						                <th>Id Pajak</th>
						                <th>Kode Pajak</th>
						                <th>Nama Pajak</th>
						                <th>Nilai</th>
						                <th>No. Akun</th>
						                <th>Nama Akun</th>
						                <th>Action</th>
						            </tr>
						        </thead>
								<tbody>
									<?php $no=0; foreach($data_pajak->result_array() as $x): $no++ ?>
									<tr>
										<td class="d-none"><?= $no; ?></td>
										<td><?= $x['id']; ?></td>
										<td><?= $x['kode_pajak']; ?></td>
										<td><?= $x['nama_pajak']; ?></td>
										<td><?= $x['value']; ?></td>
										<td><?= $x['account_number']; ?></td>
										<td><?= $x['account_name']; ?></td>
										<td><button class="btnSelectPajak<?=$i;?> btn btn-success btn-sm">Select</button> </td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modalPajakn" id="modalPajakn<?=$i;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					<i class="far fa-list-alt"></i> Pilih Pajak <!--?=$i;?-->
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div> 
			<div class="modal-body">
				<div class="row g-2">
					<div class="col-md-12">
						<input type="text" id="cari_pajak_rown<?=$i;?>" class="w-100 border border-success mb-2" placeholder="Cari di sini..">
						<div class="table-responsive">
							<table id="dataPajak2" class="table table-hover table-sm" style="width: 100%;">
								<thead>
						            <tr>
						                <th class="d-none">#</th>
						                <th>Id Pajak</th>
						                <th>Kode Pajak</th>
						                <th>Nama Pajak</th>
						                <th>Nilai</th>
						                <th>No. Akun</th>
						                <th>Nama Akun</th>
						                <th>Action</th>
						            </tr>
						        </thead>
								<tbody>
									<?php $no=0; foreach($data_pajak->result_array() as $x): $no++ ?>
									<tr>
										<td class="d-none"><?= $no; ?></td>
										<td><?= $x['id']; ?></td>
										<td><?= $x['kode_pajak']; ?></td>
										<td><?= $x['nama_pajak']; ?></td>
										<td><?= $x['value']; ?></td>
										<td><?= $x['account_number']; ?></td>
										<td><?= $x['account_name']; ?></td>
										<td><button class="btnSelectPajakn<?=$i;?> btn btn-success btn-sm">Select</button> </td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<script type="text/javascript">

$(".btnSelectPajak0").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price0').val();
		var qty=$('#received0').val();
		var total1=parseInt(price)*parseInt(qty); 

		$('#modalPajak0').modal('hide');
		$('#id_pajak0').val(col1);
		$('#kode_pajak0').val(col2);
		$('#nama_pajak0').val(col3);
		$('#nilai0').val(col4);
		
		var pajak1 = $('#nilai0').val();
		var tot_pajak1 = (parseInt(pajak1)*parseInt(total1))/100;
		var netto1 = parseFloat(tot_pajak1)+parseFloat(total1);

		$('#subtotal0').val(netto1.toFixed(2));
		$('#button-addon-hapus-pajak-0').addClass('text-danger');
		$('#button-addon-hapus-pajak-0').removeClass('d-none');
	});
	$('#button-addon-hapus-pajak-0').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak0').val('');
		$('#kode_pajak0').val('');
		$('#nama_pajak0').val('');
		$('#nilai0').val('');
		$('#subtotal0').val('');
	});
	$(".btnSelectPajak1").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price1').val();
		var qty=$('#received1').val();
		var total1=parseInt(price)*parseInt(qty);

		$('#modalPajak1').modal('hide');
		$('#id_pajak1').val(col1);
		$('#kode_pajak1').val(col2);
		$('#nama_pajak1').val(col3);
		$('#nilai1').val(col4);
		var pajak1 = $('#nilai1').val();
		var pajakdua1 = $('#nilai_dua1').val();

		var tot_pajak1 = (parseInt(pajak1)*parseInt(total1))/100;
		var tot_pajakdua1 = (parseInt(pajakdua1)*parseInt(total1))/100;
		var netto1 = parseFloat(tot_pajak1)+parseFloat(tot_pajakdua1)+parseFloat(total1);

		$('#subtotal1').val(netto1.toFixed(2));
		$('#button-addon-hapus-pajak-1').addClass('text-danger');
		$('#button-addon-hapus-pajak-1').removeClass('d-none');
	});
	$('#button-addon-hapus-pajak-1').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak1').val('');
		$('#kode_pajak1').val('');
		$('#nama_pajak1').val('');
		$('#nilai1').val('');
		$('#subtotal1').val('');
	});
	$(".btnSelectPajak2").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price2').val();
		var qty=$('#received2').val();
		var total2=parseInt(price)*parseInt(qty);

		$('#modalPajak2').modal('hide');
		$('#id_pajak2').val(col1);
		$('#kode_pajak2').val(col2);
		$('#nama_pajak2').val(col3);
		$('#nilai2').val(col4);

		var pajak2 = $('#nilai2').val();
		var pajakdua2 = $('#nilai_dua2').val();
		var tot_pajak2 = (parseInt(pajak2)*parseInt(total2))/100;
		var tot_pajakdua2 = (parseInt(pajakdua2)*parseInt(total2))/100;
		var netto2 = parseFloat(tot_pajak2)+parseFloat(tot_pajakdua2)+parseFloat(total2);

		$('#subtotal2').val(netto2.toFixed(2));
		$('#button-addon-hapus-pajak-2').addClass('text-danger');
		$('#button-addon-hapus-pajak-2').removeClass('d-none');
	});
	$('#button-addon-hapus-pajak-2').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak2').val('');
		$('#kode_pajak2').val('');
		$('#nama_pajak2').val('');
		$('#nilai2').val('');
		$('#subtotal2').val('');
	});
	$(".btnSelectPajak3").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price3').val();
		var qty=$('#received3').val();
		var total3=parseInt(price)*parseInt(qty);

		$('#modalPajak3').modal('hide');
		$('#id_pajak3').val(col1);
		$('#kode_pajak3').val(col2);
		$('#nama_pajak3').val(col3);
		$('#nilai3').val(col4);

		var pajak3 = $('#nilai3').val();
		var pajakdua3 = $('#nilai_dua3').val();
		var tot_pajak3 = (parseInt(pajak3)*parseInt(total3))/100;
		var tot_pajakdua3 = (parseInt(pajakdua3)*parseInt(total3))/100;
		var netto3 = parseFloat(tot_pajak3)+parseFloat(tot_pajakdua3)+parseFloat(total3);

		$('#subtotal3').val(netto3.toFixed(2));
		$('#button-addon-hapus-pajak-3').addClass('text-danger');
		$('#button-addon-hapus-pajak-3').removeClass('d-none');
	});
	$('#button-addon-hapus-pajak-3').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak3').val('');
		$('#kode_pajak3').val('');
		$('#nama_pajak3').val('');
		$('#nilai3').val('');
		$('#subtotal3').val('');
	});
	$(".btnSelectPajak4").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price4').val();
		var qty=$('#received4').val();
		var total4=parseInt(price)*parseInt(qty);

		$('#modalPajak4').modal('hide');
		$('#id_pajak4').val(col1);
		$('#kode_pajak4').val(col2);
		$('#nama_pajak4').val(col3);
		$('#nilai4').val(col4);

		var pajak4 = $('#nilai4').val();
		var pajakdua4 = $('#nilai_dua4').val();
		var tot_pajak4 = (parseInt(pajak4)*parseInt(total4))/100;
		var tot_pajakdua4 = (parseInt(pajakdua4)*parseInt(total4))/100;
		var netto4 = parseFloat(tot_pajak4)+parseFloat(tot_pajakdua4)+parseFloat(total4);

		$('#subtotal4').val(netto4.toFixed(2));
		$('#button-addon-hapus-pajak-4').addClass('text-danger');
		$('#button-addon-hapus-pajak-4').removeClass('d-none');
	});
	$('#button-addon-hapus-pajak-4').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak4').val('');
		$('#kode_pajak4').val('');
		$('#nama_pajak4').val('');
		$('#nilai4').val('');
		$('#subtotal4').val('');
	});
	$(".btnSelectPajak5").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price5').val();
		var qty=$('#received5').val();
		var total5=parseInt(price)*parseInt(qty);

		$('#modalPajak5').modal('hide');
		$('#id_pajak5').val(col1);
		$('#kode_pajak5').val(col2);
		$('#nama_pajak5').val(col3);
		$('#nilai5').val(col4);

		var pajak5 = $('#nilai5').val();
		var pajakdua5 = $('#nilai_dua5').val();
		var tot_pajak5 = (parseInt(pajak5)*parseInt(total5))/100;
		var tot_pajakdua5 = (parseInt(pajakdua5)*parseInt(total5))/100;
		var netto5 = parseFloat(tot_pajak5)+parseFloat(tot_pajakdua5)+parseFloat(total5);

		$('#subtotal5').val(netto3.toFixed(2));
		$('#button-addon-hapus-pajak-5').addClass('text-danger');
		$('#button-addon-hapus-pajak-5').removeClass('d-none');
	});
	$('#button-addon-hapus-pajak-5').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak5').val('');
		$('#kode_pajak5').val('');
		$('#nama_pajak5').val('');
		$('#nilai5').val('');
		$('#subtotal5').val('');
	});
	$(".btnSelectPajak6").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price6').val();
		var qty=$('#received6').val();
		var total6=parseInt(price)*parseInt(qty);

		$('#modalPajak6').modal('hide');
		$('#id_pajak6').val(col1);
		$('#kode_pajak6').val(col2);
		$('#nama_pajak6').val(col3);
		$('#nilai6').val(col4);

		var pajak6 = $('#nilai6').val();
		var pajakdua6 = $('#nilai_dua6').val();
		var tot_pajak6 = (parseInt(pajak6)*parseInt(total6))/100;
		var tot_pajakdua6 = (parseInt(pajakdua6)*parseInt(total6))/100;
		var netto6 = parseFloat(tot_pajak6)+parseFloat(tot_pajakdua6)+parseFloat(total6);

		$('#subtotal6').val(netto6.toFixed(2));
		$('#button-addon-hapus-pajak-6').addClass('text-danger');
		$('#button-addon-hapus-pajak-6').removeClass('d-none');
	});
	$('#button-addon-hapus-pajak-6').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak6').val('');
		$('#kode_pajak6').val('');
		$('#nama_pajak6').val('');
		$('#nilai6').val('');
		$('#subtotal6').val('');
	});
	$(".btnSelectPajak7").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price7').val();
		var qty=$('#received7').val();
		var total7=parseInt(price)*parseInt(qty);

		$('#modalPajak7').modal('hide');
		$('#id_pajak7').val(col1);
		$('#kode_pajak7').val(col2);
		$('#nama_pajak7').val(col3);
		$('#nilai7').val(col4);

		var pajak7 = $('#nilai7').val();
		var pajakdua7 = $('#nilai_dua7').val();
		var tot_pajak7 = (parseInt(pajak7)*parseInt(total7))/100;
		var tot_pajakdua7 = (parseInt(pajakdua7)*parseInt(total7))/100;
		var netto7 = parseFloat(tot_pajak7)+parseFloat(tot_pajakdua7)+parseFloat(total7);

		$('#subtotal7').val(netto7.toFixed(2));
		$('#button-addon-hapus-pajak-7').addClass('text-danger');
		$('#button-addon-hapus-pajak-7').removeClass('d-none');
	});
	$('#button-addon-hapus-pajak-7').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak7').val('');
		$('#kode_pajak7').val('');
		$('#nama_pajak7').val('');
		$('#nilai7').val('');
		$('#subtotal7').val('');
	});
	$(".btnSelectPajak8").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price8').val();
		var qty=$('#received8').val();
		var total8=parseInt(price)*parseInt(qty);

		$('#modalPajak8').modal('hide');
		$('#id_pajak8').val(col1);
		$('#kode_pajak8').val(col2);
		$('#nama_pajak8').val(col3);
		$('#nilai8').val(col4);

		var pajak8 = $('#nilai8').val();
		var pajakdua8 = $('#nilai_dua8').val();
		var tot_pajak8 = (parseInt(pajak8)*parseInt(total8))/100;
		var tot_pajakdua8 = (parseInt(pajakdua8)*parseInt(total8))/100;
		var netto8 = parseFloat(tot_pajak8)+parseFloat(tot_pajakdua8)+parseFloat(total8);

		$('#subtotal8').val(netto8.toFixed(2));
		$('#button-addon-hapus-pajak-8').addClass('text-danger');
		$('#button-addon-hapus-pajak-8').removeClass('d-none');
	});
	$('#button-addon-hapus-pajak-8').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak8').val('');
		$('#kode_pajak8').val('');
		$('#nama_pajak8').val('');
		$('#nilai8').val('');
		$('#subtotal8').val('');
	});

	$(".btnSelectPajakn0").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();		
		var price=$('#price0').val();
		var qty=$('#received0').val();
		var total0=parseInt(price)*parseInt(qty);
		var subtotal0=$('#subtotal0').val();

		$('#modalPajakn0').modal('hide');
		$('#id_pajak_dua0').val(col1);
		$('#kode_pajak_dua0').val(col2);
		$('#nama_pajak_dua0').val(col3);
		$('#nilai_dua0').val(col4);

		var pajak0 = $('#nilai0').val();
		var pajakdua0 = $('#nilai_dua0').val();
		var tot_pajak0 = (parseInt(pajak0)*parseInt(total0))/100;
		var tot_pajakdua0 = (parseInt(pajakdua0)*parseInt(total0))/100;
		var netto0 = parseFloat(tot_pajak0)+parseFloat(tot_pajakdua0)+parseFloat(total0);

		$('#subtotal0').val(netto0.toFixed(2));
		$('#button-addon-hapus-pajak-0').addClass('text-danger');
		$('#button-addon-hapus-pajak-0').removeClass('d-none');		
	});
	$('#button-addon-hapus-pajak-0').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak_dua0').val('');
		$('#kode_pajak_dua0').val('');
		$('#nama_pajak_dua0').val('');
		$('#nilai_dua0').val('');
		$('#subtotal_dua0').val('');
	});	
	$(".btnSelectPajakn1").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price1').val();
		var qty=$('#received1').val();
		var total1=parseInt(price)*parseInt(qty);

		$('#modalPajakn1').modal('hide');
		$('#id_pajak_dua1').val(col1);
		$('#kode_pajak_dua1').val(col2);
		$('#nama_pajak_dua1').val(col3);
		$('#nilai_dua1').val(col4);

		var pajak1 = $('#nilai1').val();
		var pajakdua1 = $('#nilai_dua1').val();
		var tot_pajak1 = (parseInt(pajak1)*parseInt(total1))/100;
		var tot_pajakdua1 = (parseInt(pajakdua1)*parseInt(total1))/100;
		var netto1 = parseFloat(tot_pajak1)+parseFloat(tot_pajakdua1)+parseFloat(total1);
		
		$('#subtotal1').val(netto1.toFixed(2));
		$('#button-addon-hapus-pajak-1').addClass('text-danger');
		$('#button-addon-hapus-pajak-1').removeClass('d-none');		
	});
	$('#button-addon-hapus-pajak-1').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak_dua1').val('');
		$('#kode_pajak_dua1').val('');
		$('#nama_pajak_dua1').val('');
		$('#nilai_dua1').val('');
		$('#subtotal_dua1').val('');
	});	
	$(".btnSelectPajakn2").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price2').val();
		var qty=$('#received2').val();
		var total2=parseInt(price)*parseInt(qty);

		$('#modalPajakn2').modal('hide');
		$('#id_pajak_dua2').val(col1);
		$('#kode_pajak_dua2').val(col2);
		$('#nama_pajak_dua2').val(col3);
		$('#nilai_dua2').val(col4);

		var pajak2 = $('#nilai2').val();
		var pajakdua2 = $('#nilai_dua2').val();
		var tot_pajak2 = (parseInt(pajak2)*parseInt(total2))/100;
		var tot_pajakdua2 = (parseInt(pajakdua2)*parseInt(total2))/100;
		var netto2 = parseFloat(tot_pajak2)+parseFloat(tot_pajakdua2)+parseFloat(total2);
		
		$('#subtotal2').val(netto2.toFixed(2));
		$('#button-addon-hapus-pajak-2').addClass('text-danger');
		$('#button-addon-hapus-pajak-2').removeClass('d-none');	
	});
	$('#button-addon-hapus-pajak-2').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak_dua2').val('');
		$('#kode_pajak_dua2').val('');
		$('#nama_pajak_dua2').val('');
		$('#nilai_dua2').val('');
		$('#subtotal_dua2').val('');
	});	
	$(".btnSelectPajakn3").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price3').val();
		var qty=$('#received3').val();
		var total3=parseInt(price)*parseInt(qty);
		var subtotal3=$('#subtotal3').val();

		$('#modalPajakn3').modal('hide');
		$('#id_pajak_dua3').val(col1);
		$('#kode_pajak_dua3').val(col2);
		$('#nama_pajak_dua3').val(col3);
		$('#nilai_dua3').val(col4);

		var pajak3 = $('#nilai3').val();
		var pajakdua3 = $('#nilai_dua3').val();
		var tot_pajak3 = (parseInt(pajak3)*parseInt(total3))/100;
		var tot_pajakdua3 = (parseInt(pajakdua3)*parseInt(total3))/100;
		var netto3 = parseFloat(tot_pajak3)+parseFloat(tot_pajakdua3)+parseFloat(total3);
		
		$('#subtotal3').val(netto3.toFixed(2));
		$('#button-addon-hapus-pajak-3').addClass('text-danger');
		$('#button-addon-hapus-pajak-3').removeClass('d-none');	
	});
	$('#button-addon-hapus-pajak-3').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak_dua3').val('');
		$('#kode_pajak_dua3').val('');
		$('#nama_pajak_dua3').val('');
		$('#nilai_dua3').val('');
		$('#subtotal_dua3').val('');
	});
	$(".btnSelectPajakn4").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price4').val();
		var qty=$('#received4').val();
		var total4=parseInt(price)*parseInt(qty);
		var subtotal4=$('#subtotal4').val();

		$('#modalPajakn4').modal('hide');
		$('#id_pajak_dua4').val(col1);
		$('#kode_pajak_dua4').val(col2);
		$('#nama_pajak_dua4').val(col3);
		$('#nilai_dua4').val(col4);

		var pajak4 = $('#nilai4').val();
		var pajakdua4 = $('#nilai_dua4').val();
		var tot_pajak4 = (parseInt(pajak4)*parseInt(total4))/100;
		var tot_pajakdua4 = (parseInt(pajakdua4)*parseInt(total4))/100;
		var netto4 = parseFloat(tot_pajak4)+parseFloat(tot_pajakdua4)+parseFloat(total4);
		
		$('#subtotal4').val(netto4.toFixed(2));
		$('#button-addon-hapus-pajak-4').addClass('text-danger');
		$('#button-addon-hapus-pajak-4').removeClass('d-none');	
	});
	$('#button-addon-hapus-pajak-4').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak_dua4').val('');
		$('#kode_pajak_dua4').val('');
		$('#nama_pajak_dua4').val('');
		$('#nilai_dua4').val('');
		$('#subtotal_dua4').val('');
	});
	$(".btnSelectPajakn5").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price5').val();
		var qty=$('#received5').val();
		var total5=parseInt(price)*parseInt(qty);
		var subtotal5=$('#subtotal5').val();

		$('#modalPajakn5').modal('hide');
		$('#id_pajak_dua5').val(col1);
		$('#kode_pajak_dua5').val(col2);
		$('#nama_pajak_dua5').val(col3);
		$('#nilai_dua5').val(col4);

		var pajak5 = $('#nilai5').val();
		var pajakdua5 = $('#nilai_dua5').val();
		var tot_pajak5 = (parseInt(pajak5)*parseInt(total5))/100;
		var tot_pajakdua5 = (parseInt(pajakdua5)*parseInt(total5))/100;
		var netto5 = parseFloat(tot_pajak5)+parseFloat(tot_pajakdua5)+parseFloat(total5);
		
		$('#subtotal5').val(netto5.toFixed(2));
		$('#button-addon-hapus-pajak-5').addClass('text-danger');
		$('#button-addon-hapus-pajak-5').removeClass('d-none');	
	});
	$('#button-addon-hapus-pajak-5').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak_dua5').val('');
		$('#kode_pajak_dua5').val('');
		$('#nama_pajak_dua5').val('');
		$('#nilai_dua5').val('');
		$('#subtotal_dua5').val('');
	});	
	
	$(".btnSelectPajakn6").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price6').val();
		var qty=$('#received6').val();
		var total6=parseInt(price)*parseInt(qty);
		var subtotal6=$('#subtotal6').val();

		$('#modalPajakn6').modal('hide');
		$('#id_pajak_dua6').val(col1);
		$('#kode_pajak_dua6').val(col2);
		$('#nama_pajak_dua6').val(col3);
		$('#nilai_dua6').val(col4);

		var pajak6 = $('#nilai6').val();
		var pajakdua6 = $('#nilai_dua6').val();
		var tot_pajak6 = (parseInt(pajak6)*parseInt(total6))/100;
		var tot_pajakdua6 = (parseInt(pajakdua6)*parseInt(total6))/100;
		var netto6 = parseFloat(tot_pajak6)+parseFloat(tot_pajakdua6)+parseFloat(total6);
		
		$('#subtotal6').val(netto6.toFixed(2));
		$('#button-addon-hapus-pajak-6').addClass('text-danger');
		$('#button-addon-hapus-pajak-6').removeClass('d-none');	
	});
	$('#button-addon-hapus-pajak-6').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak_dua6').val('');
		$('#kode_pajak_dua6').val('');
		$('#nama_pajak_dua6').val('');
		$('#nilai_dua6').val('');
		$('#subtotal_dua6').val('');
	});
	
	$(".btnSelectPajakn7").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price7').val();
		var qty=$('#received7').val();
		var total7=parseInt(price)*parseInt(qty);
		var subtotal7=$('#subtotal7').val();

		$('#modalPajakn7').modal('hide');
		$('#id_pajak_dua7').val(col1);
		$('#kode_pajak_dua7').val(col2);
		$('#nama_pajak_dua7').val(col3);
		$('#nilai_dua7').val(col4);

		var pajak7 = $('#nilai7').val();
		var pajakdua7 = $('#nilai_dua7').val();
		var tot_pajak7 = (parseInt(pajak7)*parseInt(total7))/100;
		var tot_pajakdua7 = (parseInt(pajakdua7)*parseInt(total7))/100;
		var netto7 = parseFloat(tot_pajak7)+parseFloat(tot_pajakdua7)+parseFloat(total7);
		
		$('#subtotal7').val(netto7.toFixed(2));
		$('#button-addon-hapus-pajak-7').addClass('text-danger');
		$('#button-addon-hapus-pajak-7').removeClass('d-none');	
	});
	$('#button-addon-hapus-pajak-7').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak_dua7').val('');
		$('#kode_pajak_dua7').val('');
		$('#nama_pajak_dua7').val('');
		$('#nilai_dua7').val('');
		$('#subtotal_dua7').val('');
	});		
	
	$(".btnSelectPajakn8").on('click',function(){
		var currentRow=$(this).closest("tr");
		var col1=currentRow.find("td:eq(1)").html();
		var col2=currentRow.find("td:eq(2)").html();
		var col3=currentRow.find("td:eq(3)").html();
		var col4=currentRow.find("td:eq(4)").html();
		var price=$('#price8').val();
		var qty=$('#received8').val();
		var total8=parseInt(price)*parseInt(qty);
		var subtotal8=$('#subtotal8').val();

		$('#modalPajakn8').modal('hide');
		$('#id_pajak_dua8').val(col1);
		$('#kode_pajak_dua8').val(col2);
		$('#nama_pajak_dua8').val(col3);
		$('#nilai_dua8').val(col4);

		var pajak8 = $('#nilai8').val();
		var pajakdua8 = $('#nilai_dua8').val();
		var tot_pajak8 = (parseInt(pajak8)*parseInt(total8))/100;
		var tot_pajakdua8 = (parseInt(pajakdua8)*parseInt(total8))/100;
		var netto8 = parseFloat(tot_pajak8)+parseFloat(tot_pajakdua8)+parseFloat(total8);
		
		$('#subtotal8').val(netto8.toFixed(2));
		$('#button-addon-hapus-pajak-8').addClass('text-danger');
		$('#button-addon-hapus-pajak-8').removeClass('d-none');	
	});
	$('#button-addon-hapus-pajak-8').on('click',function(event) {
		$(this).addClass('d-none');
		$('#id_pajak_dua8').val('');
		$('#kode_pajak_dua8').val('');
		$('#nama_pajak_dua8').val('');
		$('#nilai_dua8').val('');
		$('#subtotal_dua8').val('');
	});	

	$('#total_netto').click(function(event) {
		var total = 0;
		var dp = $('#nilai_dp').val();
		$('input[id^=subtotal]').each(function(index, el) {
			if ($(this).val() == '') {
				$(this).val(0);
			}
			total += parseFloat($(this).val());
		});
		total=total-dp;
		$('#total_netto').html('Rp '+total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});

	$('#update').click(function(){
		var vendor_id=$('#vendor').val();
		var purchase_no=$('#no_inv').val();
		var po_no=$('#po_no').val();
		var tgl_input=$('#tgl_input').val();
		var invoice_date=$('#tgl_input').val();
		var tax_number=$('#tax_number').val();
		var tax_date=$('#tax_date').val();
		var department=$('#department').val();
		var project=$('#project').val();
		var dp=$('#dp').val();		
		var term_pembayaran=$('#term_pembayaran').val();
		var delivery_date=$('#delivery_date').val();
		var purchasing_dept=$('#purchasing_dept').val();
		var status=$('#status').val();
		var jumlah_detail=$('#jumlah_detail').val();
		var i;		
	
		$.ajax({
				url: '<?php echo base_url();?>create_transaction/update_transaction_ap',
				dataType: 'json',
				type: 'POST', 
				data: {vendor_id:vendor_id, 
						purchase_no:purchase_no,
						po_no:po_no,
						tgl_input:tgl_input,
						invoice_date:invoice_date,
						tax_number:tax_number,
						tax_date:tax_date, 
						department:department,
						project:project, 
						dp:dp, 
						term_pembayaran:term_pembayaran,
						delivery_date:delivery_date,
						purchasing_dept:purchasing_dept,
						status:status,
						},
					success: function (response){
					}   
				});		
		for (i=1;i<=jumlah_detail;i++)
		{
			var description=$('#description'+i).val();
			var code_account=$('#code_account'+i).val();
			var received=$('#received'+i).val();
			var unit=$('#unit'+i).val();
			var price=$('#price'+i).val();
			var discount_amount=$('#discount_amount'+i).val();
			var id_pajak=$('#id_pajak'+i).val();
			var nilai=$('#nilai'+i).val();
			var id_pajak_dua=$('#id_pajak_dua'+i).val();
			var nilai_dua=$('#nilai_dua'+i).val();
			var subtotal=$('#subtotal'+i).val();
			var id_ap_detail=$('#id_ap_detail'+i).val();
				$.ajax({
					url: '<?php echo base_url();?>create_transaction/update_transaction_ap_detail',
					dataType: 'json',
					type: 'POST', 
					data: {description:description, 
							code_account:code_account,
							received:received,
							unit:unit,
							price:price,
							discount_amount:discount_amount,
							id_pajak:id_pajak, 
							nilai:nilai,
							id_pajak_dua:id_pajak_dua, 
							nilai_dua:nilai_dua, 
							subtotal:subtotal,
							purchase_no:purchase_no,
							po_no:po_no,
							id_ap_detail:id_ap_detail,
							},
						success: function (response){
						}   
					});	
		}		
		Swal.fire({
	        icon: 'success',
	        title: 'Success!',
	        html: 'Data is submitted successfully',
	        showConfirmButton: false,
	        timer: 1500
	    }).then((result) => {
	        if (result.dismiss === Swal.DismissReason.timer) {
	          window.location="<?= base_url('home')?>";
	        }
	    });
		return false;
	 });
</script>