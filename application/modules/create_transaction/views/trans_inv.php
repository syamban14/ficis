<div class="row mb-3">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<span class="text-white">
				<i class="bi bi-receipt"></i> Form Invoice Penjualan
			</span>
			<a href="<?php echo base_url();?>" class="btn btn-secondary ms-auto"><i class="bi bi-arrow-bar-left"></i> Back to Home</a>
		</div>
	</div>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="createinvoice-tab" data-bs-toggle="tab" data-bs-target="#createinvoice" type="button" role="tab" aria-controls="createinvoice" aria-selected="true">Create Invoice</button>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" href="<?= base_url();?>create_transaction/account_receivable">Close Invoice</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" href="<?= base_url();?>create_transaction/ar_correction">AR Correction</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active p-3 bg-white border" id="createinvoice" role="tabpanel" aria-labelledby="createinvoice-tab">
		<form>
			<div class="row g-2">
				<div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
					<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="customer" name="customer" data-live-search="true" data-size="8">
					    <option>Pilih Customer</option>
						<?php
							foreach ($data_customer->result() as $x) {
						?>
							<option value="<?= $x->inisial1?>" data-subtext="<?= $x->inisial1?>" data-token="<?= $x->inisial1?>"><?= $x->nama_kustomer?></option>
						<?php
							}
							foreach ($data_vendor->result() as $x) {
						?>
							<option value="<?= $x->vendor_id?>" data-subtext="<?= $x->vendor_id?>" data-token="<?= $x->vendor_id?>"><?= $x->vendor?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="form-floating">
						<input type="date" class="form-control shadow-sm" id="tgl_inv" name="tgl_inv" placeholder="Tanggal Invoice" required="">
						<label for="tgl_inv">Tanggal Invoice</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="form-floating">
						<input type="hidden" id="nomor" value="*****">
						<input type="hidden" id="formatnomor">
						<input type="text" class="form-control shadow-sm" id="no_inv" name="no_inv" placeholder="Nomor Invoice" value="*****/cust_code/dept_code/project_code/romawi_month/yyyy">
						<label for="no_inv">Nomor Invoice</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="form-floating">
						<!-- <input type="text" class="form-control shadow-sm" id="no_kontrak" name="no_kontrak" placeholder="Nomor Kontrak"  required=""> -->
						<select class="form-control" id="no_kontrak" name="no_kontrak" data-live-search="true" data-size="8"  required="">
							<option>Pilih Nomor Kontrak</option>
						</select>
						<label for="no_kontrak">Nomor Kontrak</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="form-floating">
						<input type="text" class="form-control shadow-sm" id="no_po_spk" name="no_po_spk" placeholder="Nomor PO/SPK" required="">
						<label for="no_po_spk">Nomor PO/SPK</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="form-floating">
						<textarea class="form-control shadow-sm" placeholder="Masukkan keterangan" id="remark" name="remark" required=""></textarea>
						<label for="remark">Keterangan</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
					<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="bank" name="bank" data-live-search="true" data-size="8"  required="">
					    <option>Pilih Bank</option>
						<?php
							foreach ($data_bank->result() as $x) {
						?>
							<option value="<?= $x->bank_account?>" data-subtext="<?= $x->bank_account?>" data-token="<?= $x->bank_account?>"><?= $x->bank_name?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="form-floating">
						<input type="text" class="form-control shadow-sm" id="uang_muka" name="uang_muka" placeholder="DP" required="">
						<label for="uang_muka">DP</label>
					</div>
				</div>
				<!-- <div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
					<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="type_detail" name="type_detail" data-live-search="true" data-size="8"  required="">
					    <option>Pilih</option>
						<option value="All">All</option>
						<option value="Multi">Multi</option>
					</select>
				</div> -->
				<div class="col-12 mb-3">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Deskripsi pesanan</button>
						</li>
					</ul>
					<div class="tab-content shadow-sm" id="myTabContent">
						<div class="tab-pane fade show active p-3 bg-white border border-top-0" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="table-responsive">
								<table class="table table-bordered table-sm" width="100%" cellspacing="0">
									<tbody id="dataDeskripsi">
										<tr class="bg-secondary text-white">
											<th scope="col">#</th>
											<th scope="col">Departement</th>
											<th scope="col">Project</th>
											<th scope="col">Akun&nbsp;Pendapatan</th>
											<th scope="col">Akun&nbsp;Piutang</th>
											<th scope="col">ID&nbsp;Customer&nbsp;DN</th>
											<th scope="col">Deskripsi&nbsp;Pesanan</th>
											<th scope="col">Satuan</th>
											<th scope="col">Jumlah</th>
											<th scope="col">Harga</th>
											<th scope="col">Total&nbsp;(Jml*Harga)</th>
											<th scope="col">Pajak</th>
											<th scope="col">Netto&nbsp;(Total+Pajak)</th>
										</tr>
										<?php for ($i=1; $i <= 8 ; $i++) { ?>								
											<tr id="rowCount<?= $i; ?>">
												<td><?= $i; ?></td>
												<td>
													<select class="selectpicker form-control form-control-sm border bg-white" id="department<?= $i; ?>" name="department<?= $i; ?>" data-live-search="true" data-size="8" data-container="body">
													    <option>Pilih Department</option>
														<?php
															foreach ($data_department_hris->result() as $x) {
														?>
															<option value="<?= $x->dept_code?>" data-subtext="<?= $x->dept_code?>" data-token="<?= $x->dept_code?>"><?= $x->dept_name?></option>
														<?php
															}
														?>
													</select>
												</td>
												<td>
													<select class="form-control form-control-sm border bg-white" id="project<?= $i; ?>" name="project<?= $i; ?>" id="project<?= $i; ?>" style="min-width:200px!important;max-width:100%!important">
													    <option>Pilih Project</option>
													</select>
												</td>												
												<td id="render_akunPendapatan<?= $i; ?>">
													<input type="hidden" class="form-control" id="id_akunPendapatan<?= $i; ?>" name="id_akunPendapatan<?= $i; ?>">
													<input type="hidden" class="form-control" id="kode_akunPendapatan<?= $i; ?>" name="kode_akunPendapatan<?= $i; ?>">
													<div class="input-group input-group-sm" style="min-width:150px!important;max-width:100%!important">
														<input type="text" class="form-control" id="nama_akunPendapatan<?= $i; ?>" name="nama_akunPendapatan<?= $i; ?>" readonly>
													</div>
												</td>
												<td id="render_akunPiutang<?= $i; ?>">
													<input type="hidden" class="form-control" id="id_akunPiutang<?= $i; ?>" name="id_akunPiutang<?= $i; ?>">
													<input type="hidden" class="form-control" id="kode_akunPiutang<?= $i; ?>" name="kode_akunPiutang<?= $i; ?>">
													<div class="input-group input-group-sm" style="min-width:150px!important;max-width:100%!important">
														<input type="text" class="form-control" id="nama_akunPiutang<?= $i; ?>" name="nama_akunPiutang<?= $i; ?>" readonly>
													</div>
												</td>												
												<td>
													<select  class="form-control form-control-sm"  id="id_customer_dn<?= $i; ?>" name="id_customer_dn<?= $i; ?>" data-live-search="true" data-size="12" data-container="body">
													    <option>Pilih ID Customer DN</option>
													</select>
												</td>
												<td><input class="form-control form-control-sm"  type="text" id="deskripsi<?= $i; ?>" name="deskripsi<?= $i; ?>" ></td>
												<td id="render_satuan<?= $i; ?>">
													<div class="input-group input-group-sm" style="min-width:150px!important;max-width:100%!important"> 
														<input type="text" class="form-control bg-white" id="satuan<?= $i; ?>" name="satuan<?= $i; ?>" readonly>
														<button class="btn btn-outline-secondary d-none" type="button" id="button-addon-hapus-satuan-<?= $i; ?>" data-bs-toggle="tooltip" title="Hapus?"><i class="fas fa-times-circle"></i></button>
														<button class="btn btn-outline-secondary" type="button" id="button-addon-cari-satuan-<?= $i; ?>" data-bs-toggle="modal" data-bs-target="#modalSatuan<?= $i; ?>"><i class="fas fa-search"></i></button>
													</div>
												</td>
												<td><input class="form-control form-control-sm"  type="text" id="no_jumlah<?= $i; ?>" name="no_jumlah<?= $i; ?>" style="width: 80px;" data-bs-toggle="tooltip" title="Desimal menggunakan titik"></td>
												<td><input class="form-control form-control-sm"  type="text" id="no_harga<?= $i; ?>" name="no_harga<?= $i; ?>" data-type="currency" style="min-width:150px!important;max-width:100%!important"></td>
												<td><input class="form-control form-control-sm"  type="text" id="no_total<?= $i; ?>" name="no_total<?= $i; ?>" readonly style="min-width:150px!important;max-width:100%!important"></td>
												<td id="render_pajak<?= $i; ?>">
													<input type="hidden" class="form-control" id="id_pajak<?= $i; ?>" name="id_pajak<?= $i; ?>">
													<input type="hidden" class="form-control" id="kode_pajak<?= $i; ?>" name="kode_pajak<?= $i; ?>" readonly>
													<input type="hidden" class="form-control" id="nilai<?= $i; ?>" name="nilai<?= $i; ?>" readonly>
													<div class="input-group input-group-sm" style="min-width:150px!important;max-width:100%!important">
														<input type="text" class="form-control" id="nama_pajak<?= $i; ?>" name="nama_pajak<?= $i; ?>" readonly>
														<button class="btn btn-outline-secondary d-none" type="button" id="button-addon-hapus-pajak-<?= $i; ?>" data-bs-toggle="tooltip" title="Hapus?"><i class="fas fa-times-circle"></i></button>
														<button class="btn btn-outline-secondary" type="button" id="button-addon-cari-pajak-<?= $i; ?>" data-bs-toggle="modal" data-bs-target="#modalPajak<?= $i; ?>"><i class="fas fa-search"></i></button>
													</div>
												</td>
												<td><input class="form-control form-control-sm netto" type="text" id="no_netto<?= $i; ?>" name="no_netto<?= $i; ?>" style="min-width:150px!important;max-width:100%!important" readonly></td>
											</tr>
										<?php } ?>
										<tr>
											<td colspan="8"></td>
											<td align="right"><b>Subtotal :</b></td>
											<td><button type="button" class="btn btn-success fw-bold btn-sm w-100" id="subtotal" data-bs-toggle="tooltip" title="Klik untuk cek">Cek Subtotal</button></td>
											<td align="right"><b>Total Netto :</b></td>
											<td><button type="button" class="btn btn-success fw-bold btn-sm w-100" id="total_netto" data-bs-toggle="tooltip" title="Klik untuk cek">Cek Total Netto</button></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="form-floating">
						<input type="date" class="form-control shadow-sm" id="tgl_kirim_inv" name="tgl_kirim_inv" required="">
						<label for="tgl_kirim_inv">Tanggal Diterima Invoice</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="form-floating">
						<input type="month" class="form-control shadow-sm" id="periode_kegiatan" name="periode_kegiatan" required="">
						<label for="periode_kegiatan">Periode Kegiatan</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="form-floating">
						<input type="number" class="form-control shadow-sm" id="term_pembayaran" name="term_pembayaran" placeholder="Term Pembayaran (hari)" required="">
						<label for="term_pembayaran">Term Pembayaran (hari)</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3 d-grid">
					<div class="input-group">
						<select class="form-select" id="status" aria-label="Example select with button addon" required="">
						    <option value="">Draft or Posting</option>
						    <option value="0">Draft</option>
						    <option value="1" disabled>Posting</option>
						</select>
						<button type="submit" class="btn btn-primary" id="simpan">Submit</button>
					</div>
				</div>
			</div>
		</form>
  </div>
</div>


<?php for($mdl=1;$mdl<=8;$mdl++): ?>
<div class="modal fade modalAkunPendapatan" id="modalAkunPendapatan<?= $mdl;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					<i class="far fa-list-alt"></i> Pilih Akun Pendapatan
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div> 
			<div class="modal-body">
				<div class="row g-2">
					<div class="col-md-12">
						<input type="text" id="cari_AkunPendapatan_row<?= $mdl;?>" class="w-100 border border-success mb-2" placeholder="Cari di sini..">
						<div class="table-responsive">
							<table id="dataAkunPendapatan<?= $mdl;?>" class="table table-hover table-sm" style="width: 100%;">
								<thead>
						            <tr>
						                <th class="d-none">#</th>
						                <th>Id Akun</th>
						                <th>Kode Akun</th>
						                <th>Nama Akun</th>
						                <th>Action</th>
						            </tr>
						        </thead>
								<tbody>
									<?php $no=0; foreach($data_akun_pendapatan->result_array() as $x): $no++ ?>
									<tr>
										<td class="d-none"><?= $no; ?></td>
										<td><?= $x['id']; ?></td>
										<td><?= $x['kode_akun']; ?></td>
										<td><?= $x['nama_akun']; ?></td>
										<td><button class="btnSelect<?= $mdl;?> btn btn-success btn-sm">Select</button> </td>
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
<div class="modal fade modalAkunPiutang" id="modalAkunPiutang<?= $mdl;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					<i class="far fa-list-alt"></i> Pilih Akun Piutang
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div> 
			<div class="modal-body">
				<div class="row g-2">
					<div class="col-md-12">
						<input type="text" id="cari_AkunPiutang_row<?= $mdl;?>" class="w-100 border border-success mb-2" placeholder="Cari di sini..">
						<div class="table-responsive">
							<table id="dataAkunPiutang<?= $mdl;?>" class="table table-hover table-sm" style="width: 100%;">
								<thead>
						            <tr>
						                <th class="d-none">#</th>
						                <th>Id Akun</th>
						                <th>Kode Akun</th>
						                <th>Nama Akun</th>
						                <th>Action</th>
						            </tr>
						        </thead>
								<tbody>
									<?php $no=0; foreach($data_akun_piutang->result_array() as $x): $no++ ?>
									<tr>
										<td class="d-none"><?= $no; ?></td>
										<td><?= $x['id']; ?></td>
										<td><?= $x['kode_akun']; ?></td>
										<td><?= $x['nama_akun']; ?></td>
										<td><button class="btnSelectPiutang<?= $mdl;?> btn btn-success btn-sm">Select</button> </td>
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

<div class="modal fade modalSatuan" id="modalSatuan<?= $mdl;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					<i class="far fa-list-alt"></i> Pilih Satuan
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div> 
			<div class="modal-body">
				<div class="row g-2">
					<div class="col-md-12">
						<input type="text" id="cari_satuan_row<?= $mdl;?>" class="w-100 border border-success mb-2" placeholder="Cari di sini..">
						<div class="table-responsive">
							<table id="dataSatuan<?= $mdl;?>" class="table table-hover table-sm" style="width: 100%;">
								<thead>
						            <tr>
						                <th class="d-none">#</th> 
						                <th>Satuan</th>
						                <th>Action</th>
						            </tr>
						        </thead>
								<tbody>
									<?php $no=0; foreach($data_satuan->result_array() as $x): $no++ ?>
									<tr>
										<td class="d-none"><?= $no; ?></td> 
										<td><?= $x['satuan']; ?></td> 
										<td><button class="btnSelectSatuan<?= $mdl;?> btn btn-success btn-sm">Select</button> </td>
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

<div class="modal fade modalPajak" id="modalPajak<?= $mdl;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					<i class="far fa-list-alt"></i> Pilih Pajak
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div> 
			<div class="modal-body">
				<div class="row g-2">
					<div class="col-md-12">
						<input type="text" id="cari_pajak_row<?= $mdl;?>" class="w-100 border border-success mb-2" placeholder="Cari di sini..">
						<div class="table-responsive">
							<table id="dataPajak<?= $mdl;?>" class="table table-hover table-sm" style="width: 100%;">
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
										<td><button class="btnSelectPajak<?= $mdl;?> btn btn-success btn-sm">Select</button> </td>
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
<?php endfor;?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#no_kontrak').change(function(event) {
			if ($('#no_kontrak').val()=='') {
				$('select#status > option[value="1"]').attr('disabled', true);
				$('select#status > option[value=""]').attr('selected', true);
			}else{
				$('select#status > option[value="1"]').attr('disabled', false);
				$('select#status > option[value=""]').attr('selected', false);
			}
		});
	});
	$('#department1').change(function(){
		var id=$('#department1').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getproject",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].project_code+'">'+data[i].project_code+' - '+data[i].project+'</option>';
				}
				$('#project1').html('<option>Pilih Project</<option>'+html);
			}
		});
	});
	$('#department2').change(function(){
		var id=$('#department2').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getproject",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].project_code+'">'+data[i].project_code+' - '+data[i].project+'</option>';
				}
				$('#project2').html('<option>Pilih Project</<option>'+html);
			}
		});
	});
	$('#department3').change(function(){
		var id=$('#department3').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getproject",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].project_code+'">'+data[i].project_code+' - '+data[i].project+'</option>';
				}
				$('#project3').html('<option>Pilih Project</<option>'+html);
			}
		});
	});
	$('#department4').change(function(){
		var id=$('#department4').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getproject",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].project_code+'">'+data[i].project_code+' - '+data[i].project+'</option>';
				}
				$('#project4').html('<option>Pilih Project</<option>'+html);
			}
		});
	});
	$('#department5').change(function(){
		var id=$('#department5').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getproject",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].project_code+'">'+data[i].project_code+' - '+data[i].project+'</option>';
				}
				$('#project5').html('<option>Pilih Project</<option>'+html);
			}
		});
	});
	$('#department6').change(function(){
		var id=$('#department6').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getproject",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].project_code+'">'+data[i].project_code+' - '+data[i].project+'</option>';
				}
				$('#project6').html('<option>Pilih Project</<option>'+html);
			}
		});
	});
	$('#department7').change(function(){
		var id=$('#department7').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getproject",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].project_code+'">'+data[i].project_code+' - '+data[i].project+'</option>';
				}
				$('#project7').html('<option>Pilih Project</<option>'+html);
			}
		});
	});
	$('#department8').change(function(){
		var id=$('#department8').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getproject",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].project_code+'">'+data[i].project_code+' - '+data[i].project+'</option>';
				}
				$('#project8').html('<option>Pilih Project</<option>'+html);
			}
		});
	});
	$('#project1').change(function(){
		var pcode=$('#project1').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpendapatan",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPendapatan1").value = desc;
				document.getElementById("kode_akunPendapatan1").value = nomor;
				document.getElementById("id_akunPendapatan1").value = id_akun;
			}
		});
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpiutang",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPiutang1").value = desc;
				document.getElementById("kode_akunPiutang1").value = nomor;
				document.getElementById("id_akunPiutang1").value = id_akun;
			}
		});
		var nomor=$('#nomor').val();
		var customer=$('#customer').val();
		var department=$('#department1').val();
		var project=$('#project1').val();
		var tgl_inv=$('#tgl_inv').val();
		var tglinv=tgl_inv.split("-");
		var tahun=tglinv[0];
		var bulan=tglinv[1];
		var bln;
		if (bulan==1){
			bln='I';
		}else if(bulan==2){
			bln='II';
		}else if(bulan==3){
			bln='III';
		}else if(bulan==4){
			bln='IV';
		}else if(bulan==5){
			bln='V';
		}else if(bulan==6){
			bln='VI';
		}else if(bulan==7){
			bln='VII';
		}else if(bulan==8){
			bln='VIII';
		}else if(bulan==9){
			bln='IX';
		}else if(bulan==10){
			bln='X';
		}else if(bulan==11){
			bln='XI';
		}else if(bulan==12){
			bln='XII';
		} 
		var value=nomor+'/'+customer+'/'+department+'/'+project+'/'+bln+'/'+tahun;
		$('#no_inv').val(value); 
	});
	$('#project2').change(function(){
		var pcode=$('#project2').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpendapatan",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPendapatan2").value = desc;
				document.getElementById("kode_akunPendapatan2").value = nomor;
				document.getElementById("id_akunPendapatan2").value = id_akun;
			}
		});
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpiutang",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPiutang2").value = desc;
				document.getElementById("kode_akunPiutang2").value = nomor;
				document.getElementById("id_akunPiutang2").value = id_akun;
			}
		});
	});
	$('#project3').change(function(){
		var pcode=$('#project3').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpendapatan",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPendapatan3").value = desc;
				document.getElementById("kode_akunPendapatan3").value = nomor;
				document.getElementById("id_akunPendapatan3").value = id_akun;
			}
		});
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpiutang",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPiutang3").value = desc;
				document.getElementById("kode_akunPiutang3").value = nomor;
				document.getElementById("id_akunPiutang3").value = id_akun;
			}
		});
	});
	$('#project4').change(function(){
		var pcode=$('#project4').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpendapatan",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPendapatan4").value = desc;
				document.getElementById("kode_akunPendapatan4").value = nomor;
				document.getElementById("id_akunPendapatan4").value = id_akun;
			}
		});
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpiutang",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPiutang4").value = desc;
				document.getElementById("kode_akunPiutang4").value = nomor;
				document.getElementById("id_akunPiutang4").value = id_akun;
			}
		});
	});
	$('#project5').change(function(){
		var pcode=$('#project5').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpendapatan",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPendapatan5").value = desc;
				document.getElementById("kode_akunPendapatan5").value = nomor;
				document.getElementById("id_akunPendapatan5").value = id_akun;
			}
		});
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpiutang",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPiutang5").value = desc;
				document.getElementById("kode_akunPiutang5").value = nomor;
				document.getElementById("id_akunPiutang5").value = id_akun;
			}
		});
	});
	$('#project6').change(function(){
		var pcode=$('#project6').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpendapatan",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPendapatan6").value = desc;
				document.getElementById("kode_akunPendapatan6").value = nomor;
				document.getElementById("id_akunPendapatan6").value = id_akun;
			}
		});
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpiutang",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPiutang6").value = desc;
				document.getElementById("kode_akunPiutang6").value = nomor;
				document.getElementById("id_akunPiutang6").value = id_akun;
			}
		});
	});
	$('#project7').change(function(){
		var pcode=$('#project7').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpendapatan",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPendapatan7").value = desc;
				document.getElementById("kode_akunPendapatan7").value = nomor;
				document.getElementById("id_akunPendapatan7").value = id_akun;
			}
		});
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpiutang",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPiutang7").value = desc;
				document.getElementById("kode_akunPiutang7").value = nomor;
				document.getElementById("id_akunPiutang7").value = id_akun;
			}
		});
	});
	$('#project8').change(function(){
		var pcode=$('#project8').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpendapatan",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPendapatan8").value = desc;
				document.getElementById("kode_akunPendapatan8").value = nomor;
				document.getElementById("id_akunPendapatan8").value = id_akun;
			}
		});
		$.ajax({
			url : "<?php echo base_url();?>master_data/getAkunpiutang",
			method : "POST",
			data : {pcode: pcode},
			async : false,
			dataType : 'json',
			success: function(data){
				var nomor = '';
				var desc ='';
				var id_akun ='';
				var i;
				for(i=0; i<data.length; i++){					
					id_akun += data[i].id_akun;
					nomor += data[i].acc_no;
					desc  += data[i].description;
				}
				document.getElementById("nama_akunPiutang8").value = desc;
				document.getElementById("kode_akunPiutang8").value = nomor;
				document.getElementById("id_akunPiutang8").value = id_akun;
			}
		});
	});

	$(document).ready(function() {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl);
		});
		$(".btnSelect1").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPendapatan1').modal('hide');
			$('#id_akunPendapatan1').val(col1);
			$('#kode_akunPendapatan1').val(col2);
			$('#nama_akunPendapatan1').val(col3);
			$('#button-addon-hapus-akun-pendapatan-1').addClass('text-danger');
			$('#button-addon-hapus-akun-pendapatan-1').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-pendapatan-1').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPendapatan1').val('');
			$('#kode_akunPendapatan1').val('');
			$('#nama_akunPendapatan1').val('');
		});
		$(".btnSelect2").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPendapatan2').modal('hide');
			$('#id_akunPendapatan2').val(col1);
			$('#kode_akunPendapatan2').val(col2);
			$('#nama_akunPendapatan2').val(col3);
			$('#button-addon-hapus-akun-pendapatan-2').addClass('text-danger');
			$('#button-addon-hapus-akun-pendapatan-2').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-pendapatan-2').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPendapatan2').val('');
			$('#kode_akunPendapatan2').val('');
			$('#nama_akunPendapatan2').val('');
		});
		$(".btnSelect3").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPendapatan3').modal('hide');
			$('#id_akunPendapatan3').val(col1);
			$('#kode_akunPendapatan3').val(col2);
			$('#nama_akunPendapatan3').val(col3);
			$('#button-addon-hapus-akun-pendapatan-3').addClass('text-danger');
			$('#button-addon-hapus-akun-pendapatan-3').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-pendapatan-3').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPendapatan3').val('');
			$('#kode_akunPendapatan3').val('');
			$('#nama_akunPendapatan3').val('');
		});
		$(".btnSelect4").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPendapatan4').modal('hide');
			$('#id_akunPendapatan4').val(col1);
			$('#kode_akunPendapatan4').val(col2);
			$('#nama_akunPendapatan4').val(col3);
			$('#button-addon-hapus-akun-pendapatan-4').addClass('text-danger');
			$('#button-addon-hapus-akun-pendapatan-4').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-pendapatan-4').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPendapatan4').val('');
			$('#kode_akunPendapatan4').val('');
			$('#nama_akunPendapatan4').val('');
		});
		$(".btnSelect5").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPendapatan5').modal('hide');
			$('#id_akunPendapatan5').val(col1);
			$('#kode_akunPendapatan5').val(col2);
			$('#nama_akunPendapatan5').val(col3);
			$('#button-addon-hapus-akun-pendapatan-5').addClass('text-danger');
			$('#button-addon-hapus-akun-pendapatan-5').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-pendapatan-5').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPendapatan5').val('');
			$('#kode_akunPendapatan5').val('');
			$('#nama_akunPendapatan5').val('');
		});
		$(".btnSelect6").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPendapatan6').modal('hide');
			$('#id_akunPendapatan6').val(col1);
			$('#kode_akunPendapatan6').val(col2);
			$('#nama_akunPendapatan6').val(col3);
			$('#button-addon-hapus-akun-pendapatan-6').addClass('text-danger');
			$('#button-addon-hapus-akun-pendapatan-6').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-pendapatan-6').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPendapatan6').val('');
			$('#kode_akunPendapatan6').val('');
			$('#nama_akunPendapatan6').val('');
		});
		$(".btnSelect7").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPendapatan7').modal('hide');
			$('#id_akunPendapatan7').val(col1);
			$('#kode_akunPendapatan7').val(col2);
			$('#nama_akunPendapatan7').val(col3);
			$('#button-addon-hapus-akun-pendapatan-7').addClass('text-danger');
			$('#button-addon-hapus-akun-pendapatan-7').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-pendapatan-7').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPendapatan7').val('');
			$('#kode_akunPendapatan7').val('');
			$('#nama_akunPendapatan7').val('');
		});
		$(".btnSelect8").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPendapatan8').modal('hide');
			$('#id_akunPendapatan8').val(col1);
			$('#kode_akunPendapatan8').val(col2);
			$('#nama_akunPendapatan8').val(col3);
			$('#button-addon-hapus-akun-pendapatan-8').addClass('text-danger');
			$('#button-addon-hapus-akun-pendapatan-8').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-pendapatan-8').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPendapatan8').val('');
			$('#kode_akunPendapatan8').val('');
			$('#nama_akunPendapatan8').val('');
		});

		$(".btnSelectPiutang1").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPiutang1').modal('hide');
			$('#id_akunPiutang1').val(col1);
			$('#kode_akunPiutang1').val(col2);
			$('#nama_akunPiutang1').val(col3);
			$('#button-addon-hapus-akun-piutang-1').addClass('text-danger');
			$('#button-addon-hapus-akun-piutang-1').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-piutang-1').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPiutang1').val('');
			$('#kode_akunPiutang1').val('');
			$('#nama_akunPiutang1').val('');
		});
		$(".btnSelectPiutang2").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPiutang2').modal('hide');
			$('#id_akunPiutang2').val(col1);
			$('#kode_akunPiutang2').val(col2);
			$('#nama_akunPiutang2').val(col3);
			$('#button-addon-hapus-akun-piutang-2').addClass('text-danger');
			$('#button-addon-hapus-akun-piutang-2').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-piutang-2').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPiutang2').val('');
			$('#kode_akunPiutang2').val('');
			$('#nama_akunPiutang2').val('');
		});
		$(".btnSelectPiutang3").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPiutang3').modal('hide');
			$('#id_akunPiutang3').val(col1);
			$('#kode_akunPiutang3').val(col2);
			$('#nama_akunPiutang3').val(col3);
			$('#button-addon-hapus-akun-piutang-3').addClass('text-danger');
			$('#button-addon-hapus-akun-piutang-3').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-piutang-3').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPiutang3').val('');
			$('#kode_akunPiutang3').val('');
			$('#nama_akunPiutang3').val('');
		});
		$(".btnSelectPiutang4").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPiutang4').modal('hide');
			$('#id_akunPiutang4').val(col1);
			$('#kode_akunPiutang4').val(col2);
			$('#nama_akunPiutang4').val(col3);
			$('#button-addon-hapus-akun-piutang-4').addClass('text-danger');
			$('#button-addon-hapus-akun-piutang-4').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-piutang-4').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPiutang4').val('');
			$('#kode_akunPiutang4').val('');
			$('#nama_akunPiutang4').val('');
		});
		$(".btnSelectPiutang5").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPiutang5').modal('hide');
			$('#id_akunPiutang5').val(col1);
			$('#kode_akunPiutang5').val(col2);
			$('#nama_akunPiutang5').val(col3);
			$('#button-addon-hapus-akun-piutang-5').addClass('text-danger');
			$('#button-addon-hapus-akun-piutang-5').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-piutang-5').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPiutang5').val('');
			$('#kode_akunPiutang5').val('');
			$('#nama_akunPiutang5').val('');
		});
		$(".btnSelectPiutang6").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPiutang6').modal('hide');
			$('#id_akunPiutang6').val(col1);
			$('#kode_akunPiutang6').val(col2);
			$('#nama_akunPiutang6').val(col3);
			$('#button-addon-hapus-akun-piutang-6').addClass('text-danger');
			$('#button-addon-hapus-akun-piutang-6').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-piutang-6').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPiutang6').val('');
			$('#kode_akunPiutang6').val('');
			$('#nama_akunPiutang6').val('');
		});
		$(".btnSelectPiutang7").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPiutang7').modal('hide');
			$('#id_akunPiutang7').val(col1);
			$('#kode_akunPiutang7').val(col2);
			$('#nama_akunPiutang7').val(col3);
			$('#button-addon-hapus-akun-piutang-7').addClass('text-danger');
			$('#button-addon-hapus-akun-piutang-7').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-piutang-7').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPiutang7').val('');
			$('#kode_akunPiutang7').val('');
			$('#nama_akunPiutang7').val('');
		});
		$(".btnSelectPiutang8").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			$('#modalAkunPiutang8').modal('hide');
			$('#id_akunPiutang8').val(col1);
			$('#kode_akunPiutang8').val(col2);
			$('#nama_akunPiutang8').val(col3);
			$('#button-addon-hapus-akun-piutang-8').addClass('text-danger');
			$('#button-addon-hapus-akun-piutang-8').removeClass('d-none');
		});
		$('#button-addon-hapus-akun-piutang-8').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_akunPiutang8').val('');
			$('#kode_akunPiutang8').val('');
			$('#nama_akunPiutang8').val('');
		});

		$(".btnSelectSatuan1").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html(); 
			var col2=currentRow.find("td:eq(2)").html(); 
			$('#modalSatuan1').modal('hide');
			$('#satuan1').val(col1);
			$('#button-addon-hapus-satuan-1').addClass('text-danger');
			$('#button-addon-hapus-satuan-1').removeClass('d-none');
		});
		$('#button-addon-hapus-satuan-1').on('click',function(event) {
			$(this).addClass('d-none');
			$('#satuan1').val('');
		});
		$(".btnSelectSatuan2").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html(); 
			var col2=currentRow.find("td:eq(2)").html(); 
			$('#modalSatuan2').modal('hide');
			$('#satuan2').val(col1);
			$('#button-addon-hapus-satuan-2').addClass('text-danger');
			$('#button-addon-hapus-satuan-2').removeClass('d-none');
		});
		$('#button-addon-hapus-satuan-2').on('click',function(event) {
			$(this).addClass('d-none');
			$('#satuan2').val('');
		});
		$(".btnSelectSatuan3").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html(); 
			var col2=currentRow.find("td:eq(2)").html(); 
			$('#modalSatuan3').modal('hide');
			$('#satuan3').val(col1);
			$('#button-addon-hapus-satuan-3').addClass('text-danger');
			$('#button-addon-hapus-satuan-3').removeClass('d-none');
		});
		$('#button-addon-hapus-satuan-3').on('click',function(event) {
			$(this).addClass('d-none');
			$('#satuan3').val('');
		});
		$(".btnSelectSatuan4").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html(); 
			var col2=currentRow.find("td:eq(2)").html(); 
			$('#modalSatuan4').modal('hide');
			$('#satuan4').val(col1);
			$('#button-addon-hapus-satuan-4').addClass('text-danger');
			$('#button-addon-hapus-satuan-4').removeClass('d-none');
		});
		$('#button-addon-hapus-satuan-4').on('click',function(event) {
			$(this).addClass('d-none');
			$('#satuan4').val('');
		});
		$(".btnSelectSatuan5").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html(); 
			var col2=currentRow.find("td:eq(2)").html(); 
			$('#modalSatuan5').modal('hide');
			$('#satuan5').val(col1);
			$('#button-addon-hapus-satuan-5').addClass('text-danger');
			$('#button-addon-hapus-satuan-5').removeClass('d-none');
		});
		$('#button-addon-hapus-satuan-5').on('click',function(event) {
			$(this).addClass('d-none');
			$('#satuan5').val('');
		});
		$(".btnSelectSatuan6").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html(); 
			var col2=currentRow.find("td:eq(2)").html(); 
			$('#modalSatuan6').modal('hide');
			$('#satuan6').val(col1);
			$('#button-addon-hapus-satuan-6').addClass('text-danger');
			$('#button-addon-hapus-satuan-6').removeClass('d-none');
		});
		$('#button-addon-hapus-satuan-6').on('click',function(event) {
			$(this).addClass('d-none');
			$('#satuan6').val('');
		});
		$(".btnSelectSatuan7").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html(); 
			var col2=currentRow.find("td:eq(2)").html(); 
			$('#modalSatuan7').modal('hide');
			$('#satuan7').val(col1);
			$('#button-addon-hapus-satuan-7').addClass('text-danger');
			$('#button-addon-hapus-satuan-7').removeClass('d-none');
		});
		$('#button-addon-hapus-satuan-7').on('click',function(event) {
			$(this).addClass('d-none');
			$('#satuan7').val('');
		});
		$(".btnSelectSatuan8").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html(); 
			var col2=currentRow.find("td:eq(2)").html(); 
			$('#modalSatuan8').modal('hide');
			$('#satuan8').val(col1);
			$('#button-addon-hapus-satuan-8').addClass('text-danger');
			$('#button-addon-hapus-satuan-8').removeClass('d-none');
		});
		$('#button-addon-hapus-satuan-8').on('click',function(event) {
			$(this).addClass('d-none');
			$('#satuan8').val('');
		});

		var jumlah1 = $('#no_jumlah1').val();
		var harga1 = $('#no_harga1').val();
		var total1 = $('#no_total1');
		var jumlah2 = $('#no_jumlah2');
		var harga2 = $('#no_harga2');
		var total2 = $('#no_total2');
		var jumlah3 = $('#no_jumlah3');
		var harga3 = $('#no_harga3');
		var total3 = $('#no_total3');
		var jumlah4 = $('#no_jumlah4');
		var harga4 = $('#no_harga4');
		var total4 = $('#no_total4');
		var jumlah5 = $('#no_jumlah5');
		var harga5 = $('#no_harga5');
		var total5 = $('#no_total5');
		var jumlah6 = $('#no_jumlah6');
		var harga6 = $('#no_harga6');
		var total6 = $('#no_total6');
		var jumlah7 = $('#no_jumlah7');
		var harga7 = $('#no_harga7');
		var total7 = $('#no_total7');
		var jumlah8 = $('#no_jumlah8');
		var harga8 = $('#no_harga8');
		var total8 = $('#no_total8');

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
		$('#no_jumlah1').keyup(function(event) {
			$('#no_total1').val(parseFloat($('#no_jumlah1').val()*$('#no_harga1').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto1').val('');
			$('#id_pajak1').val('');
			$('#kode_pajak1').val('');
			$('#nama_pajak1').val('');
			$('#nilai1').val('');
		});
		$('#no_harga1').keyup(function(event) {
			formatAngkaInput(this);
			$('#no_total1').val(parseFloat($('#no_jumlah1').val()*$('#no_harga1').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto1').val('');
			$('#id_pajak1').val('');
			$('#kode_pajak1').val('');
			$('#nama_pajak1').val('');
			$('#nilai1').val('');
		});
		$('#no_jumlah2').keyup(function(event) {
			$('#no_total2').val(parseFloat($('#no_jumlah2').val()*$('#no_harga2').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto2').val('');
			$('#id_pajak2').val('');
			$('#kode_pajak2').val('');
			$('#nama_pajak2').val('');
			$('#nilai2').val('');
		});
		$('#no_harga2').keyup(function(event) {
			formatAngkaInput(this);
			$('#no_total2').val(parseFloat($('#no_jumlah2').val()*$('#no_harga2').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto2').val('');
			$('#id_pajak2').val('');
			$('#kode_pajak2').val('');
			$('#nama_pajak2').val('');
			$('#nilai2').val('');
		});
		$('#no_jumlah3').keyup(function(event) {
			$('#no_total3').val(parseFloat($('#no_jumlah3').val()*$('#no_harga3').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto3').val('');
			$('#id_pajak3').val('');
			$('#kode_pajak3').val('');
			$('#nama_pajak3').val('');
			$('#nilai3').val('');
		});
		$('#no_harga3').keyup(function(event) {
			formatAngkaInput(this);
			$('#no_total3').val(parseFloat($('#no_jumlah3').val()*$('#no_harga3').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto3').val('');
			$('#id_pajak3').val('');
			$('#kode_pajak3').val('');
			$('#nama_pajak3').val('');
			$('#nilai3').val('');
		});
		$('#no_jumlah4').keyup(function(event) {
			$('#no_total4').val(parseFloat($('#no_jumlah4').val()*$('#no_harga4').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto4').val('');
			$('#id_pajak4').val('');
			$('#kode_pajak4').val('');
			$('#nama_pajak4').val('');
			$('#nilai4').val('');
		});
		$('#no_harga4').keyup(function(event) {
			formatAngkaInput(this);
			$('#no_total4').val(parseFloat($('#no_jumlah4').val()*$('#no_harga4').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto4').val('');
			$('#id_pajak4').val('');
			$('#kode_pajak4').val('');
			$('#nama_pajak4').val('');
			$('#nilai4').val('');
		});
		$('#no_jumlah5').keyup(function(event) {
			$('#no_total5').val(parseFloat($('#no_jumlah5').val()*$('#no_harga5').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto5').val('');
			$('#id_pajak5').val('');
			$('#kode_pajak5').val('');
			$('#nama_pajak5').val('');
			$('#nilai5').val('');
		});
		$('#no_harga5').keyup(function(event) {
			formatAngkaInput(this);
			$('#no_total5').val(parseFloat($('#no_jumlah5').val()*$('#no_harga5').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto5').val('');
			$('#id_pajak5').val('');
			$('#kode_pajak5').val('');
			$('#nama_pajak5').val('');
			$('#nilai5').val('');
		});
		$('#no_jumlah6').keyup(function(event) {
			$('#no_total6').val(parseFloat($('#no_jumlah6').val()*$('#no_harga6').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto6').val('');
			$('#id_pajak6').val('');
			$('#kode_pajak6').val('');
			$('#nama_pajak6').val('');
			$('#nilai6').val('');
		});
		$('#no_harga6').keyup(function(event) {
			formatAngkaInput(this);
			$('#no_total6').val(parseFloat($('#no_jumlah6').val()*$('#no_harga6').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto6').val('');
			$('#id_pajak6').val('');
			$('#kode_pajak6').val('');
			$('#nama_pajak6').val('');
			$('#nilai6').val('');
		});
		$('#no_jumlah7').keyup(function(event) {
			$('#no_total7').val(parseFloat($('#no_jumlah7').val()*$('#no_harga7').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto7').val('');
			$('#id_pajak7').val('');
			$('#kode_paja7').val('');
			$('#nama_pajak7').val('');
			$('#nilai7').val('');
		});
		$('#no_harga7').keyup(function(event) {
			formatAngkaInput(this);
			$('#no_total7').val(parseFloat($('#no_jumlah7').val()*$('#no_harga7').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto7').val('');
			$('#id_pajak7').val('');
			$('#kode_pajak7').val('');
			$('#nama_pajak7').val('');
			$('#nilai7').val('');
		});
		$('#no_jumlah8').keyup(function(event) {
			$('#no_total8').val(parseFloat($('#no_jumlah8').val()*$('#no_harga8').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto8').val('');
			$('#id_pajak8').val('');
			$('#kode_pajak8').val('');
			$('#nama_pajak8').val('');
			$('#nilai8').val('');
		});
		$('#no_harga8').keyup(function(event) {
			formatAngkaInput(this);
			$('#no_total8').val(parseFloat($('#no_jumlah8').val()*$('#no_harga8').val().replace(/,/g, "")).toFixed(2));
			$('#no_netto8').val('');
			$('#id_pajak8').val('');
			$('#kode_pajak8').val('');
			$('#nama_pajak8').val('');
			$('#nilai8').val('');
		});
		
		$(".btnSelectPajak1").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			var col4=currentRow.find("td:eq(4)").html();
			$('#modalPajak1').modal('hide');
			$('#id_pajak1').val(col1);
			$('#kode_pajak1').val(col2);
			$('#nama_pajak1').val(col3);
			$('#nilai1').val(col4);
			var pajak1 = $('#nilai1').val()/100;
			var tot_pajak1 = pajak1*total1.val().replace(/,/g, "");
			var netto1 = Math.floor(tot_pajak1)+parseFloat(total1.val());
			$('#no_netto1').val(netto1.toFixed(2));
			$('#button-addon-hapus-pajak-1').addClass('text-danger');
			$('#button-addon-hapus-pajak-1').removeClass('d-none');
		});
		$('#button-addon-hapus-pajak-1').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_pajak1').val('');
			$('#kode_pajak1').val('');
			$('#nama_pajak1').val('');
			$('#nilai1').val('');
			$('#no_netto1').val('');
		});
		$(".btnSelectPajak2").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			var col4=currentRow.find("td:eq(4)").html();
			$('#modalPajak2').modal('hide');
			$('#id_pajak2').val(col1);
			$('#kode_pajak2').val(col2);
			$('#nama_pajak2').val(col3);
			$('#nilai2').val(col4);
			var pajak2 = $('#nilai2').val()/100;
			var tot_pajak2 = pajak2*total2.val();
			var netto2 = Math.floor(tot_pajak2)+parseFloat(total2.val());
			$('#no_netto2').val(netto2.toFixed(2));
			$('#button-addon-hapus-pajak-2').addClass('text-danger');
			$('#button-addon-hapus-pajak-2').removeClass('d-none');
		});
		$('#button-addon-hapus-pajak-2').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_pajak2').val('');
			$('#kode_pajak2').val('');
			$('#nama_pajak2').val('');
			$('#nilai2').val('');
			$('#no_netto2').val('');
		});
		$(".btnSelectPajak3").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			var col4=currentRow.find("td:eq(4)").html();
			$('#modalPajak3').modal('hide');
			$('#id_pajak3').val(col1);
			$('#kode_pajak3').val(col2);
			$('#nama_pajak3').val(col3);
			$('#nilai3').val(col4);
			var pajak3 = $('#nilai3').val()/100;
			var tot_pajak3 = pajak3*total3.val();
			var netto3 = Math.floor(tot_pajak3)+parseFloat(total3.val());
			$('#no_netto3').val(netto3.toFixed(2));
			$('#button-addon-hapus-pajak-3').addClass('text-danger');
			$('#button-addon-hapus-pajak-3').removeClass('d-none');
		});
		$('#button-addon-hapus-pajak-3').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_pajak3').val('');
			$('#kode_pajak3').val('');
			$('#nama_pajak3').val('');
			$('#nilai3').val('');
			$('#no_netto3').val('');
		});
		$(".btnSelectPajak4").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			var col4=currentRow.find("td:eq(4)").html();
			$('#modalPajak4').modal('hide');
			$('#id_pajak4').val(col1);
			$('#kode_pajak4').val(col2);
			$('#nama_pajak4').val(col3);
			$('#nilai4').val(col4);
			var pajak4 = $('#nilai4').val()/100;
			var tot_pajak4 = pajak4*total4.val();
			var netto4 = Math.floor(tot_pajak4)+parseFloat(total4.val());
			$('#no_netto4').val(netto4.toFixed(2));
			$('#button-addon-hapus-pajak-4').addClass('text-danger');
			$('#button-addon-hapus-pajak-4').removeClass('d-none');
		});
		$('#button-addon-hapus-pajak-4').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_pajak4').val('');
			$('#kode_pajak4').val('');
			$('#nama_pajak4').val('');
			$('#nilai4').val('');
			$('#no_netto4').val('');
		});
		$(".btnSelectPajak5").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			var col4=currentRow.find("td:eq(4)").html();
			$('#modalPajak5').modal('hide');
			$('#id_pajak5').val(col1);
			$('#kode_pajak5').val(col2);
			$('#nama_pajak5').val(col3);
			$('#nilai5').val(col4);
			var pajak5 = $('#nilai5').val()/100;
			var tot_pajak5 = pajak5*total5.val();
			var netto5 = Math.floor(tot_pajak5)+parseFloat(total5.val());
			$('#no_netto5').val(netto5.toFixed(2));
			$('#button-addon-hapus-pajak-5').addClass('text-danger');
			$('#button-addon-hapus-pajak-5').removeClass('d-none');
		});
		$('#button-addon-hapus-pajak-5').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_pajak5').val('');
			$('#kode_pajak5').val('');
			$('#nama_pajak5').val('');
			$('#nilai5').val('');
			$('#no_netto5').val('');
		});
		$(".btnSelectPajak6").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			var col4=currentRow.find("td:eq(4)").html();
			$('#modalPajak6').modal('hide');
			$('#id_pajak6').val(col1);
			$('#kode_pajak6').val(col2);
			$('#nama_pajak6').val(col3);
			$('#nilai6').val(col4);
			var pajak6 = $('#nilai6').val()/100;
			var tot_pajak6 = pajak6*total6.val();
			var netto6 = Math.floor(tot_pajak6)+parseFloat(total6.val());
			$('#no_netto6').val(netto6.toFixed(2));
			$('#button-addon-hapus-pajak-6').addClass('text-danger');
			$('#button-addon-hapus-pajak-6').removeClass('d-none');
		});
		$('#button-addon-hapus-pajak-6').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_pajak6').val('');
			$('#kode_pajak6').val('');
			$('#nama_pajak6').val('');
			$('#nilai6').val('');
			$('#no_netto6').val('');
		});
		$(".btnSelectPajak7").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			var col4=currentRow.find("td:eq(4)").html();
			$('#modalPajak7').modal('hide');
			$('#id_pajak7').val(col1);
			$('#kode_pajak7').val(col2);
			$('#nama_pajak7').val(col3);
			$('#nilai7').val(col4);
			var pajak7 = $('#nilai7').val()/100;
			var tot_pajak7 = pajak7*total7.val();
			var netto7 = Math.floor(tot_pajak7)+parseFloat(total7.val());
			$('#no_netto7').val(netto7.toFixed(2));
			$('#button-addon-hapus-pajak-7').addClass('text-danger');
			$('#button-addon-hapus-pajak-7').removeClass('d-none');
		});
		$('#button-addon-hapus-pajak-7').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_pajak7').val('');
			$('#kode_pajak7').val('');
			$('#nama_pajak7').val('');
			$('#nilai7').val('');
			$('#no_netto7').val('');
		});
		$(".btnSelectPajak8").on('click',function(){
			var currentRow=$(this).closest("tr");
			var col1=currentRow.find("td:eq(1)").html();
			var col2=currentRow.find("td:eq(2)").html();
			var col3=currentRow.find("td:eq(3)").html();
			var col4=currentRow.find("td:eq(4)").html();
			$('#modalPajak8').modal('hide');
			$('#id_pajak8').val(col1);
			$('#kode_pajak8').val(col2);
			$('#nama_pajak8').val(col3);
			$('#nilai8').val(col4);
			var pajak8 = $('#nilai8').val()/100;
			var tot_pajak8 = pajak8*total8.val();
			var netto8 = Math.floor(tot_pajak8)+parseFloat(total8.val());
			$('#no_netto8').val(netto8.toFixed(2));
			$('#button-addon-hapus-pajak-8').addClass('text-danger');
			$('#button-addon-hapus-pajak-8').removeClass('d-none');
		});
		$('#button-addon-hapus-pajak-8').on('click',function(event) {
			$(this).addClass('d-none');
			$('#id_pajak8').val('');
			$('#kode_pajak8').val('');
			$('#nama_pajak8').val('');
			$('#nilai8').val('');
			$('#no_netto8').val('');
		});

		$('#subtotal').click(function(event) {
			var total = 0;
			$('input[id^=no_total]').each(function(index, el) {
				if ($(this).val() == '') {
					$(this).val(0);
				}
				total += parseFloat($(this).val());
			});
			$('#subtotal').html('Rp '+total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		});

		$('#total_netto').click(function(event) {
			var total = 0;
			$('input[id^=no_netto]').each(function(index, el) {
				if ($(this).val() == '') {
					$(this).val(0);
				}
				total += parseFloat($(this).val());
			});
			$('#total_netto').html('Rp '+total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		});
	});

    $('#cari_AkunPendapatan_row1').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPendapatan1 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPendapatan_row2').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPendapatan2 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPendapatan_row3').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPendapatan3 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPendapatan_row4').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPendapatan4 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPendapatan_row5').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPendapatan5 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPendapatan_row6').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPendapatan6 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPendapatan_row7').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPendapatan7 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPendapatan_row8').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPendapatan8 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });

    $('#cari_AkunPiutang_row1').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPiutang1 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPiutang_row2').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPiutang2 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPiutang_row3').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPiutang3 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPiutang_row4').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPiutang4 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPiutang_row5').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPiutang5 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPiutang_row6').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPiutang6 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPiutang_row7').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPiutang7 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_AkunPiutang_row8').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataAkunPiutang8 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });

    $('#cari_satuan_row1').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataSatuan1 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_satuan_row2').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataSatuan2 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_satuan_row3').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataSatuan3 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_satuan_row4').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataSatuan4 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_satuan_row5').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataSatuan5 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_satuan_row6').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataSatuan6 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_satuan_row7').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataSatuan7 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_satuan_row8').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataSatuan8 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });

    $('#cari_pajak_row1').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataPajak1 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_pajak_row2').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataPajak2 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_pajak_row3').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataPajak3 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_pajak_row4').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataPajak4 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_pajak_row5').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataPajak5 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_pajak_row6').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataPajak6 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_pajak_row7').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataPajak7 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#cari_pajak_row8').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataPajak8 > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });

    // genereate nomor invoice
	$('#customer').change(function(){
		$('select#status > option[value="1"]').attr('disabled', true);
		$('select#status > option[value=""]').attr('selected', true);
		var nomor=$('#nomor').val();
		var customer=$('#customer').val();
		var department=$('#department1').val();
		var project=$('#project').val();
		var tgl_inv=$('#tgl_inv').val();
		var tglinv=tgl_inv.split("-");
		var tahun=tglinv[0];
		var bulan=tglinv[1];
		var bln;
		if (bulan==1){
			bln='I';
		}else if(bulan==2){
			bln='II';
		}else if(bulan==3){
			bln='III';
		}else if(bulan==4){
			bln='IV';
		}else if(bulan==5){
			bln='V';
		}else if(bulan==6){
			bln='VI';
		}else if(bulan==7){
			bln='VII';
		}else if(bulan==8){
			bln='VIII';
		}else if(bulan==9){
			bln='IX';
		}else if(bulan==10){
			bln='X';
		}else if(bulan==11){
			bln='XI';
		}else if(bulan==12){
			bln='XII';
		} 
		var value=nomor+'/'+customer+'/'+department+'/'+project+'/'+bln+'/'+tahun;
		$('#no_inv').val(value); 
		$.ajax({
			url : "<?php echo base_url();?>create_transaction/getKontrak",
			method : "POST",
			data : {customer: customer},
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].id_contract+'">'+data[i].no_of_contract_help+' - '+data[i].title_contract+'</option>';
				}
				$('#no_kontrak').html('<option value="">Pilih Nomor Kontrak</<option>'+html);
			}
		});

		$.ajax({
			url : "<?php echo base_url();?>create_transaction/getHeaderDn",
			method : "POST",
			data : {customer: customer},
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+data[i].id+'">'+data[i].id+' - '+data[i].nama_proyek+'</option>';
				}
				for (let i = 1; i <= 8; i++) {
					console.log(i);
					$('#id_customer_dn'+i).html('<option value="">Pilih ID Customer Dn</<option>'+html);
				}


			}
		});
	}); 
	
	$('#department1').change(function(){
		var nomor=$('#nomor').val();
		var customer=$('#customer').val();
		var department=$('#department1').val();
		var project=$('#project1').val();
		var tgl_inv=$('#tgl_inv').val();
		var tglinv=tgl_inv.split("-");
		var tahun=tglinv[0];
		var bulan=tglinv[1];
		var bln;
		if (bulan==1){
			bln='I';
		}else if(bulan==2){
			bln='II';
		}else if(bulan==3){
			bln='III';
		}else if(bulan==4){
			bln='IV';
		}else if(bulan==5){
			bln='V';
		}else if(bulan==6){
			bln='VI';
		}else if(bulan==7){
			bln='VII';
		}else if(bulan==8){
			bln='VIII';
		}else if(bulan==9){
			bln='IX';
		}else if(bulan==10){
			bln='X';
		}else if(bulan==11){
			bln='XI';
		}else if(bulan==12){
			bln='XII';
		} 
		var value=nomor+'/'+customer+'/'+department+'/'+project+'/'+bln+'/'+tahun;
		$('#no_inv').val(value); 
	});
	
	$('#tgl_inv').change(function(){
		var nomor=$('#nomor').val();
		var customer=$('#customer').val();
		var department=$('#department').val();
		var project=$('#project').val();
		var tgl_inv=$('#tgl_inv').val();
		var tglinv=tgl_inv.split("-");
		var tahun=tglinv[0];
		var bulan=tglinv[1];
		var bln;
		if (bulan==1){
			bln='I';
		}else if(bulan==2){
			bln='II';
		}else if(bulan==3){
			bln='III';
		}else if(bulan==4){
			bln='IV';
		}else if(bulan==5){
			bln='V';
		}else if(bulan==6){
			bln='VI';
		}else if(bulan==7){
			bln='VII';
		}else if(bulan==8){
			bln='VIII';
		}else if(bulan==9){
			bln='IX';
		}else if(bulan==10){
			bln='X';
		}else if(bulan==11){
			bln='XI';
		}else if(bulan==12){
			bln='XII';
		} 
		var value=nomor+'/'+customer+'/'+department+'/'+project+'/'+bln+'/'+tahun;
		$('#no_inv').val(value); 
	});

	$('#customer').change(function(){
		$("select#customer+button").removeClass('btn-danger');
		$("select#customer+button").addClass('btn-light');
	});

	$('#bank').change(function(){
		$("select#bank+button").removeClass('btn-danger');
		$("select#bank+button").addClass('btn-light');
	});

	$('#simpan').click(function(){  
		var customer=$('#customer').val();
		var tgl_inv=$('#tgl_inv').val(); 
		var no_inv=$('#no_inv').val();
		var nomor=$('#nomor').val();
		var no_kontrak=$('#no_kontrak').val();
		var no_po_spk=$('#no_po_spk').val();
		var remark=$('#remark').val();
		var bank=$('#bank').val();
		var uang_muka=$('#uang_muka').val();
		var tgl_kirim_inv=$('#tgl_kirim_inv').val();
		var periode_kegiatan=$('#periode_kegiatan').val();
		var term_pembayaran=$('#term_pembayaran').val();
		var status=$('#status').val();
		var i;
		if(customer=='' || customer=='Pilih Customer'){
			alert("Mohon untuk mengisi Customer !!!");
			$("select#customer+button").removeClass('btn-light');
			$("select#customer+button").addClass('btn-danger');
		}else if(bank=='' || bank=='Pilih Bank'){
			alert("Mohon untuk mengisi Bank !!!");
			$("select#bank+button").removeClass('btn-light');
			$("select#bank+button").addClass('btn-danger');
		}else if(tgl_inv=='' || no_inv=='' || no_kontrak=='' || no_po_spk=='' || remark=='' || tgl_kirim_inv=='' || periode_kegiatan=='' || term_pembayaran=='' || status==''){
			alert("Mohon untuk diisi dengan lengkap !!!");
		}else{
			$.ajax({
					url: '<?php echo base_url();?>create_transaction/save_transaction',
					dataType: 'json',
					type: 'POST', 
					data: { customer : customer,
							tgl_inv:tgl_inv,
							no_inv:no_inv,
							nomor:nomor,
							no_kontrak:no_kontrak,
							no_po_spk:no_po_spk,
							remark:remark,
							bank:bank,
							uang_muka:uang_muka,
							tgl_kirim_inv:tgl_kirim_inv,
							periode_kegiatan:periode_kegiatan,
							term_pembayaran:term_pembayaran,
							status:status
					},
					beforeSend: function() {
			      $('#simpan').attr('disabled', true);
			    },
					success: function (response){
			      $('#formatnomor').val(response.result);
						Swal.fire({
			        icon: 'success',
			        title: 'Success!',
			        html: 'Berikut adalah nomor invoicenya :<br><b>'+response.result+'</b>',
			        showConfirmButton: true,
			        allowOutsideClick: false,
			        allowEscapeKey: false
			      }).then((result) => {
			        for (i=1;i<=8;i++)
							{
								var no_inv_nya=$('#formatnomor').val();
								var id_customer_dn=$('#id_customer_dn'+i).val();
								var deskripsi=$('#deskripsi'+i).val();
								var department=$('#department'+i).val();
								var project=$('#project'+i).val();
								var id_akunPendapatan=$('#id_akunPendapatan'+i).val();
								var id_akunPiutang=$('#id_akunPiutang'+i).val();
								var satuan=$('#satuan'+i).val();
								var no_jumlah=$('#no_jumlah'+i).val();
								var no_harga=$('#no_harga'+i).val();
								var no_total=$('#no_total'+i).val();
								var id_pajak=$('#id_pajak'+i).val();
								var no_netto=$('#no_netto'+i).val();
								if (no_inv!='' && deskripsi!='' && department!='Pilih Department' && project!='Pilih Project' && id_akunPendapatan!='' && id_akunPiutang!='' && satuan!='' && no_jumlah!='' && no_harga!='' && (no_total!='' || no_total!='0') && id_pajak!='' && no_netto!='') {
									$.ajax({
											url: '<?php echo base_url();?>create_transaction/save_transaction_detail',
											dataType: 'json',
											type: 'POST', 
											data: {no_inv : no_inv_nya, deskripsi:deskripsi, id_customer_dn:id_customer_dn, department:department,project:project,id_akunPendapatan:id_akunPendapatan, id_akunPiutang:id_akunPiutang, no_jumlah:no_jumlah, satuan:satuan, no_harga:no_harga.replace(/,/g, ""), no_total:no_total,id_pajak:id_pajak,no_netto:no_netto},
											success: function (response){}   
									});
								}
							}
			      	if (result.isConfirmed) {
			          window.location="<?= base_url('home')?>";
						  }
			      });
					},
					error: function(xhr, status, error) {
			        alert("Terjadi kesalahan dalam permintaan AJAX. Silakan coba lagi nanti.");
			    },
			    complete: function() {
			        $('#simpan').attr('disabled', false);
			    }
			});
			return false;
		}
	});
</script>