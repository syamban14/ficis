<?php
	$id;
	$customer;
	$department;
	$project;
	$akun_pendapatan;
	$akun_piutang;
	$tgl_inv;
	$nomor;
	$no_inv;
	$no_kontrak;
	$no_po_spk;
	$akun_pendapatan;
	$akun_piutang;
	$remark;
	$tgl_kirim_inv;
	$periode_kegiatan;
	$term_pembayaran;
	$status;
	foreach($data_transaction AS $q)
	{
		$id=$q->id_tr;
		$customer=$q->customer;
		$department=$q->department;
		$project=$q->project;
		$akun_pendapatan=$q->akun_pendapatan;
		$akun_piutang=$q->akun_piutang;
		$tgl_inv=$q->tgl_inv;
		$nomor=$q->nomor;
		$no_inv=$q->no_inv;
		$no_kontrak=$q->no_kontrak;
		$no_po_spk=$q->no_po_spk;
		$akun_pendapatan=$q->akun_pendapatan;
		$nama_akun_pendapatan=$q->nama_akun_pendapatan;
		$akun_piutang=$q->akun_piutang;
		$nama_akun_piutang=$q->nama_akun_piutang;
		$remark=$q->remark;
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
<form>
	<div class="row g-2">
		<div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
			<input type="hidden" name="id_tr" id="id_tr" value="<?= $id;?>">
			<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="customer" name="customer" data-live-search="true" data-size="8">
				<?php
					foreach ($data_customer->result() as $x) {   
				?>
					<option value="<?= $x->kode_kustomer?>" <?php if($x->kode_kustomer==$customer){ echo 'selected="selected"'; } ?> data-subtext="<?= $x->kode_kustomer?>" data-token="<?= $x->kode_kustomer?>"><?= $x->nama_kustomer?></option>
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
		<div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
			<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="department" name="department" data-live-search="true" data-size="8">
				<?php
					foreach ($data_department_hris->result() as $x) {
				?>
					<option value="<?= $x->dept_code?>" <?php if($x->dept_code==$department){ echo 'selected="selected"'; } ?> data-subtext="<?= $x->dept_code?>" data-token="<?= $x->dept_code?>"><?= $x->dept_name?></option>
				<?php
					}
				?>	
			</select>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
			<select class="form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="project" name="project" data-live-search="true" data-size="8">
				<?php
					$data_project=$this->Create_transaction_m->getDataProject($project,$department);
					foreach ($data_project->result() as $x) {
				?>
					<option value="<?= $x->project_code?>" <?php if($x->project_code==$project){ echo 'selected="selected"'; } ?> data-subtext="<?= $x->project_code?>" data-token="<?= $x->project_code?>"><?= $x->project?></option>
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
				<input type="text" class="form-control shadow-sm" id="akun_pendapatan_txt" name="akun_pendapatan_txt" value="<?=$nama_akun_pendapatan?>" readonly>
				<label for="akun_pendapatan_txt">Akun Pendapatan</label>
				<input type="hidden" id="akun_pendapatan" name="akun_pendapatan" value="<?=$akun_pendapatan;?>">
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<input type="text" class="form-control shadow-sm" id="akun_piutang_txt" name="akun_piutang_txt" value="<?=$nama_akun_piutang?>" readonly>
				<label for="akun_piutang_txt">Akun Piutang</label>
				<input type="hidden" id="akun_piutang" name="akun_piutang" value="<?=$akun_piutang;?>">
			</div>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="form-floating">
				<textarea class="form-control shadow-sm" placeholder="Masukkan keterangan" id="remark" name="remark"><?=$remark;?></textarea>
				<label for="remark">Keterangan</label>
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
					<!-- <div class="btn-group btn-group-sm mb-2" role="group" aria-label="Basic example">
						<button type="button" class="btn btn-outline-primary" onClick="addMoreRows(this.form);"><i class="fas fa-folder-plus fa-lg fa-fw"></i> Tambah</button>
						<button type="button" class="btn btn-outline-danger" onClick="removeRow();"><i class="fas fa-folder-minus fa-lg fa-fw"></i> Kurangi</button>
					</div> -->
					<div class="table-responsive">
						<table class="table table-bordered table-sm" width="100%" cellspacing="0">
							<tbody id="dataDeskripsi">
								<tr class="bg-secondary text-white">
									<th scope="col">#</th>
									<th scope="col">Deskripsi&nbsp;Pesanan</th>
									<th scope="col">Satuan</th>
									<th scope="col">Jumlah</th>
									<th scope="col">Harga</th>
									<th scope="col">Total&nbsp;(jml*harga)</th>
									<th scope="col">Pajak</th>
									<th scope="col">Netto&nbsp;(total+pajak)</th>
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
												<input type="text" class="form-control" id="nama_pajak<?=$i?>" name="nama_pajak<?=$i?>" value="<?=$z->nama_pajak?>" readonly>
												<button class="btn btn-outline-secondary" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#modalPajak<?=$i?>"><i class="fas fa-search"></i></button>
											</div>
										</td>
										<td><input class="form-control form-control-sm"  type="text" id="no_netto<?=$i?>" name="no_netto<?=$i?>" value="<?=$z->netto?>" required="" readonly></td>
									</tr>
								<?php
									$i++;
									}
								?>
							</tbody>
						</table>
					</div>
					<input type="hidden" class="form-control" id="rowCountnya" name="rowCountnya" value="<?= $i-1;?>">
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
</form>
<input type="hidden" id="jumlah_detail" value="<?=$jumlahny?>">
<?php for($mdl=1;$mdl<=$jumlahny;$mdl++){?>
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
	$('#department').change(function(){
		var id=$('#department').val();
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
				$('#project').html('<option>Pilih Project</<option>'+html);
			}
		});
	});
	
	$('#project').change(function(){
		var id=$('#project').val();
		$.ajax({
			url : "<?php echo base_url();?>master_data/getpendapatan",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				var isi;
				var txt;
				for(i=0; i<data.length; i++){
					isi=data[i].kode_akun;
					txt=data[i].nama_akun;
				}
				$('#akun_pendapatan').val(isi);
				$('#akun_pendapatan_txt').val(txt);
			}
		});
		$.ajax({
			url : "<?php echo base_url();?>master_data/getpiutang",
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				var isi;
				var txt;
				for(i=0; i<data.length; i++){
					isi=data[i].kode_akun;
					txt=data[i].nama_akun;
				}
				$('#akun_piutang').val(isi);
				$('#akun_piutang_txt').val(txt);
			}
		});
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
				$('#nama_pajak'+<?= $i;?>).val(col3);
				$('#nilai'+<?= $i;?>).val(col4);
				var varpajak = 'pajak'+<?= $i;?>;
				var vartot_pajak = 'tot_pajak'+<?= $i;?>;
				var varnetto = 'netto'+<?= $i;?>;
				var tot = $('#no_total'+<?= $i;?>).val();
				var varpajak = $('#nilai'+<?= $i;?>).val()/100;
				var vartot_pajak = varpajak*tot;
				var varnetto = parseFloat(vartot_pajak)+parseFloat(tot);
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
	});
	$('#simpan').click(function(){
		var id_tr=$('#id_tr').val();
		var customer=$('#customer').val();
		var department=$('#department').val();
		var project=$('#project').val();
		var akun_pendapatan=$('#akun_pendapatan').val();
		var akun_piutang=$('#akun_piutang').val();
		var tgl_inv=$('#tgl_inv').val(); 
		var no_inv=$('#no_inv').val();
		var nomor=$('#nomor').val();
		var no_kontrak=$('#no_kontrak').val();
		var no_po_spk=$('#no_po_spk').val();
		var remark=$('#remark').val();
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
                data: { id_tr : id_tr, customer : customer, department:department, project:project, akun_pendapatan:akun_pendapatan, akun_piutang:akun_piutang, tgl_inv:tgl_inv, no_inv:no_inv, nomor:nomor, no_kontrak:no_kontrak,no_po_spk:no_po_spk,remark:remark,tgl_kirim_inv:tgl_kirim_inv,periode_kegiatan:periode_kegiatan,term_pembayaran:term_pembayaran,rowCountnya:rowCountnya,status:status},
                success: function (response){  
                }   
        });

        for (i=1;i<=rowCountnya;i++)
		{
			var id_tr_detail=$('#id_tr_detail'+i).val();
			var deskripsi=$('#deskripsi'+i).val();
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
					data: {id_tr_detail : id_tr_detail, no_inv : no_inv, deskripsi:deskripsi, no_jumlah:no_jumlah, satuan:satuan, no_harga:no_harga, no_total:no_total,id_pajak:id_pajak,no_netto:no_netto},
					success: function (response){    
					}   
			}); 			
		}
    	alert ('DATA TERSIMPAN'); 
		window.location = '<?php echo base_url();?>home';
		return false;
	});
</script>