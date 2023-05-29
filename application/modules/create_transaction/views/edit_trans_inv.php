<?php
	$id;
	$customer;
	$tgl_inv;
	$nomor;
	$no_inv;
	$no_kontrak;
	$no_po_spk;
	$remark;
	$bank;
	$dp;
	$tgl_kirim_inv;
	$periode_kegiatan;
	$term_pembayaran;
	$status;
	foreach($data_transaction AS $q)
	{
		$id=$q->id_tr;
		$customer=$q->customer;
		$tgl_inv=$q->tgl_inv;
		$nomor=$q->nomor;
		$no_inv=$q->no_inv;
		$no_kontrak=$q->no_kontrak;
		$no_po_spk=$q->no_po_spk;
		$remark=$q->remark;
		$bank=$q->bank;
		$dp=$q->dp;
		$tgl_kirim_inv=$q->tgl_kirim_inv;
		$periode_kegiatan=$q->periode_kegiatan;
		$term_pembayaran=$q->term_pembayaran; 
		$status=$q->statusnya; 
	}
	$mdl;
?>
<div class="row mb-3">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<span class="text-white">
				<i class="bi bi-receipt"></i> Form Edit Invoice Penjualan 			
			</span>
			<a href="<?php echo base_url();?>" class="btn btn-secondary ms-auto"><i class="bi bi-arrow-bar-left"></i> Back to Home</a>
		</div>
	</div>
</div>
<!-- <form> -->
	<div class="row g-2">
		<div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
			<input type="hidden" name="id_tr" id="id_tr" value="<?= $id;?>">
			<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="customer" name="customer" data-live-search="true" data-size="8" disabled>
				<?php
					foreach ($data_customer->result() as $x) {   
				?>
					<option value="<?= $x->kode_kustomer?>" <?php if($x->kode_kustomer==$customer){ echo 'selected="selected"'; } ?> data-subtext="<?= $x->kode_kustomer?>" data-token="<?= $x->kode_kustomer?>"><?= $x->nama_kustomer?></option>
				<?php
					}
					foreach ($data_vendor->result() as $x) {
				?>
					<option value="<?= $x->vendor_id?>" data-subtext="<?= $x->vendor_id?>" data-token="<?= $x->vendor_id?>" <?php if($x->vendor_id==$customer){ echo 'selected="selected"'; } ?>><?= $x->vendor?></option>
				<?php
					}
				?>
			</select>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<input type="date" class="form-control shadow-sm" id="tgl_inv" name="tgl_inv" placeholder="Tanggal Invoice" value="<?=$tgl_inv;?>">
				<label for="tgl_inv">Tanggal Invoice</label>
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<input type="hidden" id="nomor" value=" <?php echo $nomor; ?>">
				<input type="text" class="form-control shadow-sm" id="no_inv" name="no_inv" placeholder="Nomor Invoice" value="<?=$no_inv;?>">
				<label for="no_inv">Nomor Invoice</label>
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<input type="text" class="form-control shadow-sm" id="no_kontrak" name="no_kontrak" placeholder="Nomor Kontrak" value="<?=$no_kontrak;?>">
				<label for="no_kontrak">Nomor Kontrak</label>
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<input type="text" class="form-control shadow-sm" id="no_po_spk" name="no_po_spk" placeholder="Nomor PO/SPK" value="<?=$no_po_spk;?>">
				<label for="no_po_spk">Nomor PO/SPK</label>
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<textarea class="form-control shadow-sm" placeholder="Masukkan keterangan" id="remark" name="remark"><?=$remark;?></textarea>
				<label for="remark">Keterangan</label>
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
			<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="bank" name="bank" data-live-search="true" data-size="8"  required="">
			    <option>Pilih Bank</option>
				<?php
					foreach ($data_bank->result() as $x) {
				?>
					<option value="<?= $x->bank_account;?>" <?php if($x->bank_account==$bank){ echo 'selected="selected"'; } ?> data-subtext="<?= $x->bank_account;?>" data-token="<?= $x->bank_account;?>"><?= $x->bank_name;?></option>
				<?php
					}
				?>
			</select>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<input type="text" class="form-control shadow-sm" id="uang_muka" name="uang_muka" placeholder="DP" required="" value="<?= $dp;?>">
				<label for="uang_muka">DP</label>
			</div>
		</div>
		<div class="col-12">
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
									<th scope="col">Deskripsi&nbsp;Pesanan</th>
									<th scope="col">Departement</th>
									<th scope="col">Project</th>
									<th scope="col">Akun&nbsp;Pendapatan</th>
									<th scope="col">Akun&nbsp;Piutang</th>
									<th scope="col">Satuan</th>
									<th scope="col">Jumlah</th>
									<th scope="col">Harga</th>
									<th scope="col">Total&nbsp;(Jml*Harga)</th>
									<th scope="col">Pajak</th>
									<th scope="col">Netto&nbsp;(Total+Pajak)</th>
								</tr>
								<?php
									$i=1;
									$detail=$this->Create_transaction_m->getDataInvoiceDetail($no_inv);
									$jumlahny=count($detail);
									foreach($detail AS $z)
									{
								?>
									<tr id="rowCount<?=$i;?>">
										<td><?=$i?><input type="hidden" name="id_tr_detail<?=$i;?>" id="id_tr_detail<?=$i;?>" value="<?=$z->id_tr_detail;?>"></td>
										<td><input class="form-control form-control-sm"  type="text" id="deskripsi<?=$i?>" name="deskripsi<?=$i?>" value="<?=$z->deskripsi_pesanan;?>" required=""></td>
										<td>
											<select class="selectpicker form-control form-control-sm border bg-white" id="department<?= $i; ?>" name="department<?= $i; ?>" data-live-search="true" data-size="8">
											    <option>Pilih Department</option>
												<?php
													foreach ($data_department_hris->result() as $x) {
												?>
													<option value="<?= $x->dept_code?>" <?php if($x->dept_code==$z->department){ echo 'selected="selected"'; } ?> data-subtext="<?= $x->dept_code?>" data-token="<?= $x->dept_code?>"><?= $x->dept_name?></option>
												<?php
													}
												?>
											</select>
										</td>
										<td>
											<select class="form-control form-control-sm border bg-white" id="project<?= $i; ?>" name="project<?= $i; ?>" id="project<?= $i; ?>" style="min-width:200px!important;max-width:100%!important">
											    <option>Pilih Project</option>
											    <?php
													foreach ($data_project->result() as $x) {
												?>
													<option value="<?= $x->project_code;?>" <?php if($x->project_code==$z->project){ echo 'selected="selected"'; } ?> data-subtext="<?= $x->project_code;?>" data-token="<?= $x->project_code;?>"><?= $x->project_code;?> - <?= $x->project;?></option>
												<?php
													}
												?>
											</select>
										</td>
										<td id="render_akunPendapatan<?= $i; ?>">
											<input value="<?= $z->akun_pendapatan;?>" type="hidden" class="form-control" id="id_akunPendapatan<?= $i; ?>" name="id_akunPendapatan<?= $i; ?>">
											<input value="<?= $z->kode_akun_pendapatannya;?>" type="hidden" class="form-control" id="kode_akunPendapatan<?= $i; ?>" name="kode_akunPendapatan<?= $i; ?>">
											<div class="input-group input-group-sm" style="min-width:150px!important;max-width:100%!important">
												<input value="<?= $z->akun_pendapatannya;?>" type="text" class="form-control" id="nama_akunPendapatan<?= $i; ?>" name="nama_akunPendapatan<?= $i; ?>" readonly>
											</div>
										</td>
										<td id="render_akunPiutang<?= $i; ?>">
											<input value="<?= $z->akun_piutang;?>" type="hidden" class="form-control" id="id_akunPiutang<?= $i; ?>" name="id_akunPiutang<?= $i; ?>">
											<input value="<?= $z->kode_akun_piutangnya;?>" type="hidden" class="form-control" id="kode_akunPiutang<?= $i; ?>" name="kode_akunPiutang<?= $i; ?>">
											<div class="input-group input-group-sm" style="min-width:150px!important;max-width:100%!important">
												<input value="<?= $z->akun_piutangnya;?>" type="text" class="form-control" id="nama_akunPiutang<?= $i; ?>" name="nama_akunPiutang<?= $i; ?>" readonly>
											</div>
										</td>
										<td id="render_satuan<?=$i?>">
											<div class="input-group input-group-sm" style="min-width:100px!important;max-width:100%!important"> 
												<input type="text" class="form-control" id="satuan<?=$i?>" name="satuan<?=$i?>" value="<?=$z->satuan?>" readonly>
												<button class="btn btn-outline-secondary" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#modalSatuan<?=$i?>"><i class="fas fa-search"></i></button>
											</div>
										</td>
										<td><input class="form-control form-control-sm"  type="number" id="no_jumlah<?=$i?>" name="no_jumlah<?=$i?>" value="<?=$z->jumlah;?>" required=""></td>
										<td><input class="form-control form-control-sm"  type="text" id="no_harga<?=$i?>" name="no_harga<?=$i?>" value="<?=$z->harga;?>" required="" data-type="currency"></td>
										<td><input class="form-control form-control-sm"  type="text" id="no_total<?=$i?>" name="no_total<?=$i?>" value="<?=$z->total;?>" required="" readonly></td>
										<td id="render_pajak<?=$i?>">
											<div class="input-group input-group-sm" style="min-width:200px!important;max-width:100%!important">
												<input type="hidden" class="form-control" id="id_pajak<?=$i?>" name="id_pajak<?=$i?>" value="<?=$z->id_pajak?>">
												<input type="hidden" class="form-control" id="kode_pajak<?=$i?>" name="kode_pajak<?=$i?>" value="<?=$z->kode_pajak?>" readonly>
												<input type="hidden" class="form-control" id="nilai<?=$i?>" name="nilai<?=$i?>" value="<?=$z->value?>" readonly>
												<!-- <input type="text" class="form-control" id="nama_pajak<?=$i?>" name="nama_pajak<?=$i?>" value="<?=$z->nama_pajak?>" readonly> -->
												<input type="text" class="form-control" id="nama_pajak<?=$i?>" name="nama_pajak<?=$i?>" value="<?= $z->total*$z->value/100;?>" readonly>
												<button class="btn btn-outline-secondary" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#modalPajak<?=$i?>"><i class="fas fa-search"></i></button>
											</div>
										</td>
										<td><input class="form-control form-control-sm"  type="text" id="no_netto<?=$i?>" name="no_netto<?=$i?>" value="<?=$z->netto?>" required="" readonly></td>
									</tr>
								<?php
									$i++;
									}
									for($i=($jumlahny+1);$i<=8;$i++){
								?>
										<tr id="rowCount<?= $i; ?>">
											<td><?= $i; ?></td>
											<td><input class="form-control form-control-sm"  type="text" id="deskripsi<?= $i; ?>" name="deskripsi<?= $i; ?>" ></td>
											<td>
												<select class="selectpicker form-control form-control-sm border bg-white" id="department<?= $i; ?>" name="department<?= $i; ?>" data-live-search="true" data-size="8">
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
							<td id="render_satuan<?= $i; ?>">
								<div class="input-group input-group-sm" style="min-width:150px!important;max-width:100%!important"> 
									<input type="text" class="form-control" id="satuan<?= $i; ?>" name="satuan<?= $i; ?>" readonly>
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
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
					<input type="text" class="form-control" id="rowCountnya" name="rowCountnya" value="<?= $i-1;?>">
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<input type="date" class="form-control shadow-sm" id="tgl_kirim_inv" name="tgl_kirim_inv" value="<?=$tgl_kirim_inv;?>">
				<label for="tgl_kirim_inv">Tanggal Diterima Invoice</label>
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<input type="month" class="form-control shadow-sm" id="periode_kegiatan" name="periode_kegiatan" value="<?=$periode_kegiatan;?>">
				<label for="periode_kegiatan">Periode Kegiatan</label>
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<input type="number" class="form-control shadow-sm" id="term_pembayaran" name="term_pembayaran" placeholder="Term Pembayaran (hari)" value="<?=$term_pembayaran;?>">
				<label for="term_pembayaran">Term Pembayaran (hari)</label>
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3 d-grid">
			<div class="input-group">
				<select class="form-select" id="status" name="status" aria-label="Example select with button addon">
				    <option disabled>Draft or Posting</option>
				    <option value="0" <?php if ($status==0) {echo "selected";}?>>Draft</option>
				    <option value="1" <?php if ($status==1) {echo "selected";}?>>Posting</option>
				</select>
				<button type="submit" class="btn btn-primary" id="simpan">Update</button>
			</div>
		</div>
	</div>
<!-- </form> -->
<input type="hidden" id="jumlah_detail" value="<?=$jumlahny?>">
<!--?php for($mdl=1;$mdl<=$jumlahny;$mdl++){?-->
<?php for($mdl=1;$mdl<=8;$mdl++){?>
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
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
<?php } ?>
<script type="text/javascript">
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

	//generet infois
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
	$(document).ready(function() {
		<?php
			$i=1;
			$detail=$this->Create_transaction_m->getDataInvoiceDetail($no_inv);
			$jumlahny=count($detail);
			foreach($detail AS $z)
			{
		?>
			$(".btnSelectSatuan"+<?= $i;?>).on('click',function(){
				var currentRow=$(this).closest("tr");
				var col1=currentRow.find("td:eq(1)").html(); 
				var col2=currentRow.find("td:eq(2)").html(); 
				$('#modalSatuan'+<?= $i;?>).modal('hide');
				$('#satuan'+<?= $i;?>).val(col1); 
			});
			$(".btnSelectPajak"+<?= $i;?>).on('click',function(){
				var currentRow=$(this).closest("tr");
				var col1=currentRow.find("td:eq(1)").html();
				var col2=currentRow.find("td:eq(2)").html();
				var col3=currentRow.find("td:eq(3)").html();
				var col4=currentRow.find("td:eq(4)").html();
				$('#modalPajak'+<?= $i;?>).modal('hide');
				$('#id_pajak'+<?= $i;?>).val(col1);
				$('#kode_pajak'+<?= $i;?>).val(col2);
				$('#nilai'+<?= $i;?>).val(col4);
				var varpajak = 'pajak'+<?= $i;?>;
				var vartot_pajak = 'tot_pajak'+<?= $i;?>;
				var varnetto = 'netto'+<?= $i;?>;
				var tot = $('#no_total'+<?= $i;?>).val();
				var varpajak = $('#nilai'+<?= $i;?>).val()/100;
				var vartot_pajak = varpajak*tot;
				var varnetto = parseFloat(vartot_pajak)+parseFloat(tot);
				// $('#nama_pajak'+<?= $i;?>).val(col3);
				$('#nama_pajak'+<?= $i;?>).val(vartot_pajak);
				$('#no_netto'+<?= $i;?>).val(varnetto);
			});
			$('#no_jumlah'+<?= $i;?>).keyup(function(event) {
				$('#no_total'+<?= $i;?>).val($('#no_jumlah'+<?= $i;?>).val()*$('#no_harga'+<?= $i;?>).val());
				$('#no_netto'+<?= $i;?>).val('');
				$('#id_pajak'+<?= $i;?>).val('');
				$('#kode_pajak'+<?= $i;?>).val('');
				$('#nama_pajak'+<?= $i;?>).val('');
				$('#nilai'+<?= $i;?>).val('');
			});
			$('#no_harga'+<?= $i;?>).keyup(function(event) {
				$('#no_total'+<?= $i;?>).val($('#no_jumlah'+<?= $i;?>).val()*$('#no_harga'+<?= $i;?>).val());
				$('#no_netto'+<?= $i;?>).val('');
				$('#id_pajak'+<?= $i;?>).val('');
				$('#kode_pajak'+<?= $i;?>).val('');
				$('#nama_pajak'+<?= $i;?>).val('');
				$('#nilai'+<?= $i;?>).val('');
			});
		<?php
			$i++;
			}
		?>
		$(".btnSelectSatuan2").on('click',function(){
				var currentRow=$(this).closest("tr");
				var col1=currentRow.find("td:eq(1)").html(); 
				var col2=currentRow.find("td:eq(2)").html(); 
				$('#modalSatuan2').modal('hide');
				$('#satuan2').val(col1); 
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
			$('#nilai2').val(col4);
			var varpajak = 'pajak2';
			var vartot_pajak = 'tot_pajak2';
			var varnetto = 'netto2';
			var tot = $('#no_total2').val();
			var varpajak = $('#nilai2').val()/100;
			var vartot_pajak = varpajak*tot;
			var varnetto = parseFloat(vartot_pajak)+parseFloat(tot);
			// $('#nama_pajak'+<?= $i;?>).val(col3);
			$('#nama_pajak2').val(vartot_pajak);
			$('#no_netto2').val(varnetto);
		});
		$('#no_jumlah2').keyup(function(event) {
			$('#no_total2').val($('#no_jumlah2').val()*$('#no_harga2').val());
			$('#no_netto2').val('');
			$('#id_pajak2').val('');
			$('#kode_pajak2').val('');
			$('#nama_pajak2').val('');
			$('#nilai2').val('');
		});
		$('#no_harga2').keyup(function(event) {
			$('#no_total2').val($('#no_jumlah2').val()*$('#no_harga2').val());
			$('#no_netto2').val('');
			$('#id_pajak2').val('');
			$('#kode_pajak2').val('');
			$('#nama_pajak2').val('');
			$('#nilai2').val('');
		});
		$(".btnSelectSatuan3").on('click',function(){
				var currentRow=$(this).closest("tr");
				var col1=currentRow.find("td:eq(1)").html(); 
				var col2=currentRow.find("td:eq(2)").html(); 
				$('#modalSatuan3').modal('hide');
				$('#satuan3').val(col1); 
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
			$('#nilai3').val(col4);
			var varpajak = 'pajak2';
			var vartot_pajak = 'tot_pajak2';
			var varnetto = 'netto2';
			var tot = $('#no_total3').val();
			var varpajak = $('#nilai3').val()/100;
			var vartot_pajak = varpajak*tot;
			var varnetto = parseFloat(vartot_pajak)+parseFloat(tot);
			// $('#nama_pajak'+<?= $i;?>).val(col3);
			$('#nama_pajak3').val(vartot_pajak);
			$('#no_netto3').val(varnetto);
		});
		$('#no_jumlah3').keyup(function(event) {
			$('#no_total3').val($('#no_jumlah3').val()*$('#no_harga3').val());
			$('#no_netto3').val('');
			$('#id_pajak3').val('');
			$('#kode_pajak3').val('');
			$('#nama_pajak3').val('');
			$('#nilai3').val('');
		});
		$('#no_harga3').keyup(function(event) {
			$('#no_total3').val($('#no_jumlah3').val()*$('#no_harga3').val());
			$('#no_netto3').val('');
			$('#id_pajak3').val('');
			$('#kode_pajak3').val('');
			$('#nama_pajak3').val('');
			$('#nilai3').val('');
		});
		$(".btnSelectSatuan4").on('click',function(){
				var currentRow=$(this).closest("tr");
				var col1=currentRow.find("td:eq(1)").html(); 
				var col2=currentRow.find("td:eq(2)").html(); 
				$('#modalSatuan4').modal('hide');
				$('#satuan4').val(col1); 
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
			// $('#nama_pajak4').val(col3);
			$('#nilai4').val(col4);
			var varpajak = 'pajak2';
			var vartot_pajak = 'tot_pajak2';
			var varnetto = 'netto2';
			var tot = $('#no_total4').val();
			var varpajak = $('#nilai4').val()/100;
			var vartot_pajak = varpajak*tot;
			var varnetto = parseFloat(vartot_pajak)+parseFloat(tot);
			$('#nama_pajak4').val(vartot_pajak);
			$('#no_netto4').val(varnetto);
		});
		$('#no_jumlah4').keyup(function(event) {
			$('#no_total4').val($('#no_jumlah4').val()*$('#no_harga4').val());
			$('#no_netto4').val('');
			$('#id_pajak4').val('');
			$('#kode_pajak4').val('');
			$('#nama_pajak4').val('');
			$('#nilai4').val('');
		});
		$('#no_harga4').keyup(function(event) {
			$('#no_total4').val($('#no_jumlah4').val()*$('#no_harga4').val());
			$('#no_netto4').val('');
			$('#id_pajak4').val('');
			$('#kode_pajak4').val('');
			$('#nama_pajak4').val('');
			$('#nilai4').val('');
		});
		$(".btnSelectSatuan5").on('click',function(){
				var currentRow=$(this).closest("tr");
				var col1=currentRow.find("td:eq(1)").html(); 
				var col2=currentRow.find("td:eq(2)").html(); 
				$('#modalSatuan5').modal('hide');
				$('#satuan5').val(col1); 
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
			// $('#nama_pajak5').val(col3);
			$('#nilai5').val(col4);
			var varpajak = 'pajak2';
			var vartot_pajak = 'tot_pajak2';
			var varnetto = 'netto2';
			var tot = $('#no_total5').val();
			var varpajak = $('#nilai5').val()/100;
			var vartot_pajak = varpajak*tot;
			var varnetto = parseFloat(vartot_pajak)+parseFloat(tot);
			$('#nama_pajak5').val(vartot_pajak);
			$('#no_netto5').val(varnetto);
		});
		$('#no_jumlah5').keyup(function(event) {
			$('#no_total5').val($('#no_jumlah5').val()*$('#no_harga5').val());
			$('#no_netto5').val('');
			$('#id_pajak5').val('');
			$('#kode_pajak5').val('');
			$('#nama_pajak5').val('');
			$('#nilai5').val('');
		});
		$('#no_harga5').keyup(function(event) {
			$('#no_total5').val($('#no_jumlah5').val()*$('#no_harga5').val());
			$('#no_netto5').val('');
			$('#id_pajak5').val('');
			$('#kode_pajak5').val('');
			$('#nama_pajak5').val('');
			$('#nilai5').val('');
		});
		$(".btnSelectSatuan6").on('click',function(){
				var currentRow=$(this).closest("tr");
				var col1=currentRow.find("td:eq(1)").html(); 
				var col2=currentRow.find("td:eq(2)").html(); 
				$('#modalSatuan6').modal('hide');
				$('#satuan6').val(col1); 
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
			// $('#nama_pajak6').val(col3);
			$('#nilai6').val(col4);
			var varpajak = 'pajak2';
			var vartot_pajak = 'tot_pajak2';
			var varnetto = 'netto2';
			var tot = $('#no_total6').val();
			var varpajak = $('#nilai6').val()/100;
			var vartot_pajak = varpajak*tot;
			var varnetto = parseFloat(vartot_pajak)+parseFloat(tot);
			$('#nama_pajak6').val(vartot_pajak);
			$('#no_netto6').val(varnetto);
		});
		$('#no_jumlah6').keyup(function(event) {
			$('#no_total6').val($('#no_jumlah6').val()*$('#no_harga6').val());
			$('#no_netto6').val('');
			$('#id_pajak6').val('');
			$('#kode_pajak6').val('');
			$('#nama_pajak6').val('');
			$('#nilai6').val('');
		});
		$('#no_harga6').keyup(function(event) {
			$('#no_total6').val($('#no_jumlah6').val()*$('#no_harga6').val());
			$('#no_netto6').val('');
			$('#id_pajak6').val('');
			$('#kode_pajak6').val('');
			$('#nama_pajak6').val('');
			$('#nilai6').val('');
		});
		$(".btnSelectSatuan7").on('click',function(){
				var currentRow=$(this).closest("tr");
				var col1=currentRow.find("td:eq(1)").html(); 
				var col2=currentRow.find("td:eq(2)").html(); 
				$('#modalSatuan7').modal('hide');
				$('#satuan7').val(col1); 
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
			// $('#nama_pajak7').val(col3);
			$('#nilai7').val(col4);
			var varpajak = 'pajak2';
			var vartot_pajak = 'tot_pajak2';
			var varnetto = 'netto2';
			var tot = $('#no_total7').val();
			var varpajak = $('#nilai7').val()/100;
			var vartot_pajak = varpajak*tot;
			var varnetto = parseFloat(vartot_pajak)+parseFloat(tot);
			$('#nama_pajak7').val(vartot_pajak);
			$('#no_netto7').val(varnetto);
		});
		$('#no_jumlah7').keyup(function(event) {
			$('#no_total7').val($('#no_jumlah7').val()*$('#no_harga7').val());
			$('#no_netto7').val('');
			$('#id_pajak7').val('');
			$('#kode_pajak7').val('');
			$('#nama_pajak7').val('');
			$('#nilai7').val('');
		});
		$('#no_harga7').keyup(function(event) {
			$('#no_total7').val($('#no_jumlah7').val()*$('#no_harga7').val());
			$('#no_netto7').val('');
			$('#id_pajak7').val('');
			$('#kode_pajak7').val('');
			$('#nama_pajak7').val('');
			$('#nilai7').val('');
		});
		$(".btnSelectSatuan8").on('click',function(){
				var currentRow=$(this).closest("tr");
				var col1=currentRow.find("td:eq(1)").html(); 
				var col2=currentRow.find("td:eq(2)").html(); 
				$('#modalSatuan8').modal('hide');
				$('#satuan8').val(col1); 
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
			// $('#nama_pajak8').val(col3);
			$('#nilai8').val(col4);
			var varpajak = 'pajak2';
			var vartot_pajak = 'tot_pajak2';
			var varnetto = 'netto2';
			var tot = $('#no_total8').val();
			var varpajak = $('#nilai8').val()/100;
			var vartot_pajak = varpajak*tot;
			var varnetto = parseFloat(vartot_pajak)+parseFloat(tot);
			$('#nama_pajak8').val(vartot_pajak);
			$('#no_netto8').val(varnetto);
		});
		$('#no_jumlah8').keyup(function(event) {
			$('#no_total8').val($('#no_jumlah8').val()*$('#no_harga8').val());
			$('#no_netto8').val('');
			$('#id_pajak8').val('');
			$('#kode_pajak8').val('');
			$('#nama_pajak8').val('');
			$('#nilai8').val('');
		});
		$('#no_harga8').keyup(function(event) {
			$('#no_total8').val($('#no_jumlah8').val()*$('#no_harga8').val());
			$('#no_netto8').val('');
			$('#id_pajak8').val('');
			$('#kode_pajak8').val('');
			$('#nama_pajak8').val('');
			$('#nilai8').val('');
		});
	});
	$('#simpan').click(function(){
		var id_tr=$('#id_tr').val();
		var customer=$('#customer').val();
		var tgl_inv=$('#tgl_inv').val(); 
		var no_inv=$('#no_inv').val();
		var nomor=$('#nomor').val();
		var no_kontrak=$('#no_kontrak').val();
		var no_po_spk=$('#no_po_spk').val();
		var remark=$('#remark').val();
		var bank=$('#bank').val();
		var dp=$('#uang_muka').val();
		var tgl_kirim_inv=$('#tgl_kirim_inv').val();
		var periode_kegiatan=$('#periode_kegiatan').val();
		var term_pembayaran=$('#term_pembayaran').val();
		var rowCountnya=$('#rowCountnya').val();
		var status=$('#status').val();
		var i;
	
		$.ajax({
                url: '<?php echo base_url();?>create_transaction/update_transaction',
                dataType: 'json',
                type: 'POST', 
                data: { id_tr : id_tr, customer : customer, tgl_inv:tgl_inv, no_inv:no_inv, nomor:nomor, no_kontrak:no_kontrak, no_po_spk:no_po_spk, remark:remark, bank:bank, dp:dp, tgl_kirim_inv:tgl_kirim_inv,periode_kegiatan:periode_kegiatan,term_pembayaran:term_pembayaran,rowCountnya:rowCountnya,status:status},
                success: function (response){  
					// alert(response);
                }   
        });

        for (i=1;i<=rowCountnya;i++)
		{
			var id_tr_detail=$('#id_tr_detail'+i).val();
			var deskripsi=$('#deskripsi'+i).val();
			var department=$('#department'+i).val();
			var project=$('#project'+i).val();
			var akun_pendapatan=$('#id_akunPendapatan'+i).val();
			var akun_piutang=$('#id_akunPiutang'+i).val();
			var no_jumlah=$('#no_jumlah'+i).val();
			var satuan=$('#satuan'+i).val();
			var no_harga=$('#no_harga'+i).val();
			var no_total=$('#no_total'+i).val();
			var id_pajak=$('#id_pajak'+i).val();
			var no_netto=$('#no_netto'+i).val(); 
			$.ajax({
					url: '<?php echo base_url();?>create_transaction/update_transaction_detail',
					dataType: 'json',
					type: 'POST', 
					data: {id_tr_detail : id_tr_detail, no_inv : no_inv, deskripsi:deskripsi, department:department, project:project, akun_pendapatan:akun_pendapatan, akun_piutang:akun_piutang, no_jumlah:no_jumlah, satuan:satuan, no_harga:no_harga, no_total:no_total,id_pajak:id_pajak,no_netto:no_netto},
					success: function (response){    
						// alert(response)
					}   
			}); 			
		}
    	alert ('DATA TERSIMPAN'); 
		window.location = '<?php echo base_url();?>home';
		return false;
	});
</script>