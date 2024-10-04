<div class="row">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<span class="text-white d-none d-sm-block">
				You are here :<br>
				<a href="<?= base_url();?>master_data" class="text-reset text-decoration-none"><i class="bi bi-list-ul"></i> Master Data</a> <i class="bi bi-chevron-right"></i>&nbsp;
				<select id="selek" class="p-1 border-white text-white rounded bg-info" aria-label="Default select example">
				  <option selected><?=$title; ?></option>
				  <optgroup label="halaman lain :">
						<?php foreach ($menu as $data): ?>
							<option value="<?= $data; ?>"><?= $data; ?></option>
						<?php endforeach ?>
				  </optgroup>
				</select>
			</span>
			<a href="<?= base_url();?>master_data" class="btn btn-secondary ms-auto"><i class="bi bi-arrow-bar-left"></i> Back</a>
		</div>
	</div>
</div>
<div class="card mt-4 shadow-sm">
	<div class="card-body position-relative">
		<button class="btn btn-primary rounded-lg position-absolute top-0 translate-middle ms-3" title="Tambah data" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="fas fa-plus"></i></button>
		&nbsp; <a href="<?php base_url();?>akun_setting" title="Akun Setting" class="btn btn-success rounded-lg position-absolute top-0 translate-middle end-0 ms-3">Akun Setting Menu</a>
		<div class="table-responsive mt-3">
			<table class="table table-striped table-hover table-sm table-bordered" id="data_akun">
				<thead>
					<tr>
						<th>ID No.</th>
						<th>Acc. No</th>
						<th>Description</th>  
						<th>Currency</th>  
						<th>Acc. Level 1</th>
						<th>Acc. Level 2</th>
						<th>Acc. Level 3</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i=1;
					$status_txt='';
					foreach ($data_akun->result() as $x) {
				?>
				
				<tr>
						<td><?= $x->id;?></td>
						<td><?= $x->acc_no;?></td>
						<td><?= $x->description;?></td>
						<td><?= $x->currency;?></td>
						<td><?= $x->acc_lev_1;?></td>
						<td><?= $x->acc_lev_2;?></td>
						<td><?= $x->acc_lev_3;?></td>
						<td>
							<div class="btn-group btn-group-sm">
								<a href="#modalView" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-kode="<?= $x->acc_no;?>"
									data-bs-nama="<?= $x->description;?>"
									data-bs-currency="<?= $x->currency;?>"
									data-bs-level1="<?= $x->acc_lev_1;?>"
									data-bs-level2="<?= $x->acc_lev_2;?>"
									data-bs-level3="<?= $x->acc_lev_3;?>"
								>
									<i class="bi bi-eye"></i>
								</a>
								<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-kode="<?= $x->acc_no;?>"
									data-bs-nama="<?= $x->description;?>"
									data-bs-currency="<?= $x->currency;?>"
									data-bs-level1="<?= $x->acclev1;?>"
									data-bs-level2="<?= $x->acclev2;?>"
									data-bs-level3="<?= $x->acclev3;?>"
								>
									<i class="bi bi-pencil-square"></i>
								</a>
								<a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-kode="<?= $x->acc_no;?>"
									data-bs-nama="<?= $x->description;?>"
								>
									<i class="bi bi-trash3"></i>
								</a>
							</div>
						</td>
					</tr>
				<?php
					$i++;}
				?> 
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/add_akun" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 g-2">
	        	<div class="col">
	        		<div class="form-floating">
                        <input type="text" class="form-control bg-white" id="acc_no" name="acc_no" placeholder="Acc. No">
                        <label for="acc_no">Acc. No</label>
                    </div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
                        <input type="text" class="form-control bg-white" id="description" name="description" placeholder="Description">
                        <label for="description">Description</label>
                    </div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating"> 
						<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="currency" name="currency" data-live-search="true">
							<option>-Pilih-</option>
							<option value="IDR">IDR</option>
							<option value="SGD">SGD</option>
							<option value="USD">USD</option>
							<option value="UERO">UERO</option>
							<option value="YEN">YEN</option>
                        </select>
                        <label for="currency">Currency</label>
                    </div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
                        <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="acc_lev1" name="acc_lev1" data-live-search="true">
							<option>-Pilih-</option>
							<?php
								foreach($data_akun_1 AS $d)
								{
									echo'<option value="'.$d->acc_no.'">'.$d->acc_no.' - '.$d->description.'</option>';
								}
							?>
                        </select>
                        <label for="nama_add">Acc. Level 1</label>
                    </div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
                        <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="acc_lev2" name="acc_lev2" data-live-search="true">
							<option>-Pilih-</option>
							<?php
								foreach($data_akun_2 AS $d)
								{
									echo'<option value="'.$d->acc_no.'">'.$d->acc_no.' - '.$d->description.'</option>';
								}
							?>
                        </select>
                        <label for="nama_add">Acc. Level 2</label>
                    </div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
                        <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="acc_lev3" name="acc_lev3" data-live-search="true">
							<option>-Pilih-</option>
							<?php
								foreach($data_akun_3 AS $d)
								{
									echo'<option value="'.$d->acc_no.'">'.$d->acc_no.' - '.$d->description.'</option>';
								}
							?>
                        </select>
                        <label for="nama_add">Acc. Level 3</label>
                    </div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary">Simpan</button>
	      </div>
     	</form>
    </div>
  </div>
</div>
 
<div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">		
		<div class="row row-cols-1 g-2">
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control bg-white" id="kode" name="acc_no" placeholder="Acc. No" readonly="">
					<label for="acc_no">Acc. No</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control bg-white" id="nama" name="description" placeholder="Description"  readonly="">
					<label for="description">Description</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control bg-white" id="currency" readonly="">
					<label for="currency">Currency</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control bg-white" id="level1" readonly="">
					<label for="nama_add">Acc. Level 1</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control bg-white" id="level2" readonly="">
					<label for="nama_add">Acc. Level 2</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control bg-white" id="level3" readonly="">
					<label for="nama_add">Acc. Level 3</label>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
				<div class="form-check form-switch me-auto">
				  <input class="form-check-input" type="checkbox" role="switch" id="status" checked disabled>
				  <label class="form-check-label" for="status">Status Active</label>
				</div>
        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/edit_akun" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 g-2">
	        	<div class="col">
						<input type="hidden" class="form-control bg-white" id="id_edit" name="id_edit" readonly>
	        		<div class="form-floating">
						<input type="number" class="form-control" id="kode_edit" name="kode_edit" placeholder="Kode_edit" max="99" readonly>
						<label for="kode">Kode</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control" id="nama_edit" name="nama_edit" placeholder="Nama">
						<label for="nama">Nama</label>
					</div>
	        	</div>
				
	        	<div class="col">
	        		<div class="form-floating"> 
						<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="currency_edit" name="currency_edit" data-live-search="true">
							<option value="IDR">IDR</option>
							<option value="SGD">SGD</option>
							<option value="USD">USD</option>
							<option value="UERO">UERO</option>
							<option value="YEN">YEN</option>
                        </select>
                        <label for="currency">Currency</label>
                    </div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<select  class="form-control bg-white" id="acc_lev1_edit"  name="acc_lev1_edit" placeholder="Account level 1">
                      		<?php
								foreach ($data_akun_1 as $x) {
							?>
								<option value="<?= $x->acc_no?>" data-subtext="<?= $x->acc_no?>" data-token="<?= $x->acc_no?>"><?= $x->acc_no?> - <?= $x->description?></option>
							<?php
								}
							?>
                        </select>
                        <label for="acc_lev1_edit">Acc. Level 1</label>
                    </div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<select  class="form-control bg-white" id="acc_lev2_edit"  name="acc_lev2_edit" placeholder="Account level 2">
                        	<?php
								foreach($data_akun_2 AS $x){
							?>
								<option value="<?= $x->acc_no?>" data-subtext="<?= $x->acc_no?>" data-token="<?= $x->acc_no?>"><?= $x->acc_no?> - <?= $x->description?></option>
							<?php
								}
							?>
                        </select>
                        <label for="acc_lev2_edit">Acc. Level 2</label>
                    </div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<select  class="form-control bg-white" id="acc_lev3_edit"  name="acc_lev3_edit" placeholder="Account level 3">
                        	<?php
								foreach($data_akun_3 AS $x){
							?>
								<option value="<?= $x->acc_no?>" data-subtext="<?= $x->acc_no?>" data-token="<?= $x->acc_no?>"><?= $x->acc_no?> - <?= $x->description?></option>
							<?php
								}
							?>
                        </select>
                        <label for="acc_lev3_edit">Acc. Level 3</label>
                    </div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
					<div class="form-check form-switch me-auto">
					  <input class="form-check-input" type="checkbox" role="switch" id="status_edit" name="status_edit" onclick="fungsi_cek()">
					  <label class="form-check-label" for="status_edit"></label>
					</div>
	        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
	      </div>
     	</form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/delete_akun" method="POST">
	      <div class="modal-body">
					<input type="hidden" class="form-control bg-white" id="id_delete" name="id_delete" readonly>
					<lottie-player src="https://assets8.lottiefiles.com/private_files/lf30_rj4ooq2j.json"  background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop  autoplay class="mx-auto"></lottie-player>
	      	<div class="d-grid">
	      		<div class="btn-group">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
			        <button type="submit" class="btn btn-danger">Hapus</button>
	      		</div>
	      	</div>
	      </div>
     	</form>
    </div>
  </div>
</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('.tooltipnya'));
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		  return new bootstrap.Tooltip(tooltipTriggerEl);
		});

		$('#data_akun').DataTable({
			dom: "<'row border rounded'<'col-sm-12 col-md-4 p-2'B><'col-sm-12 col-md-4 p-2 text-center'l><'col-sm-12 col-md-4 p-2'f>>" +
		         "<'row'<'col-sm-12'tr>>" +
		         "<'row'<'col-sm-12 col-md-6 pe-0'i><'col-sm-12 col-md-6 ps-0'p>>",
   			buttons: [
   				{ extend:'colvis', text:'<i class="fas fa-columns"></i>', className:'btn btn-sm btn-outline-primary bg-white text-primary'},
   				{ extend:'copy', text:'<i class="far fa-copy"></i> Copy', className:'btn btn-sm btn-outline-primary bg-white text-primary' },
   				{ extend:'excel', text:'<i class="far fa-file-excel"></i> Excel', className:'btn btn-sm btn-outline-primary bg-white text-primary' },
   				{ extend:'print', text:'<i class="fas fa-print"></i> Print', className:'btn btn-sm btn-outline-primary bg-white text-primary' }
   			],
   			colReorder: true
		});

		$('#selek').change(function() {
			var link = $('#selek').val();
			var base_url = '<?= base_url();?>master_data/';
			location.href = base_url+link;
		});
	});
	
	var modalView = document.getElementById('modalView')
	modalView.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var kode = button.getAttribute('data-bs-kode')
	  var nama = button.getAttribute('data-bs-nama')
	  var currency = button.getAttribute('data-bs-currency')
	  var level1 = button.getAttribute('data-bs-level1')
	  var level2 = button.getAttribute('data-bs-level2')
	  var level3 = button.getAttribute('data-bs-level3')
	  var status = button.getAttribute('data-bs-status')

	  var modalTitle = modalView.querySelector('.modal-title')
	  var kodeInput = modalView.querySelector('.modal-body input#kode')
	  var namaInput = modalView.querySelector('.modal-body input#nama')
	  var currencyInput = modalView.querySelector('.modal-body input#currency')
	  var level1Input = modalView.querySelector('.modal-body input#level1')
	  var level2Input = modalView.querySelector('.modal-body input#level2')
	  var level3Input = modalView.querySelector('.modal-body input#level3')
	  var statusSwitch = modalView.querySelector('.modal-body input#status')

	  modalTitle.textContent = 'Detail ' + nama
	  kodeInput.value = kode
	  namaInput.value = nama
	  currencyInput.value = currency
	  level1Input.value = level1
	  level2Input.value = level2
	  level3Input.value = level3
	  
	  if (status=='aktif') {
	  	$('#status').attr('checked', true);
			$('label[for="status"]').html('Active');
	  }
	  if (status=='nonaktif') {
	  	$('#status').attr('checked', false);
	  	$('label[for="status"]').html('Non-Active');
	  }
	})
	
	var modalEdit = document.getElementById('modalEdit')
	modalEdit.addEventListener('show.bs.modal', function (event) {
	var button = event.relatedTarget
	var id = button.getAttribute('data-bs-id')
	var kode = button.getAttribute('data-bs-kode')
	var nama = button.getAttribute('data-bs-nama')
	var currency = button.getAttribute('data-bs-currency')
	var level1 = button.getAttribute('data-bs-level1')
	var level2 = button.getAttribute('data-bs-level2')
	var level3 = button.getAttribute('data-bs-level3')
	var status = button.getAttribute('data-bs-status')

	var modalTitle = modalEdit.querySelector('.modal-title')
	var idInput = modalEdit.querySelector('.modal-body input#id_edit')
	var kodeInput = modalEdit.querySelector('.modal-body input#kode_edit')
	var namaInput = modalEdit.querySelector('.modal-body input#nama_edit')
	var currencyInput = modalEdit.querySelector('.modal-body input#currency_edit')
	var statusSwitch = modalEdit.querySelector('.modal-body input#status_edit')
	  
	document.getElementById("acc_lev1_edit").value = level1;
	document.getElementById("acc_lev2_edit").value = level2;
	document.getElementById("acc_lev3_edit").value = level3;

	modalTitle.textContent = 'Edit ' + nama
	idInput.value = id
	kodeInput.value = kode
	namaInput.value = nama
	currencyInput.value = currency
	level1Input.value = level1
	level2Input.value = level2
	level3Input.value = level3

		if (status=='aktif') {
			$('#status_edit').attr('checked', true);
			$('label[for="status_edit"]').html('Active');
		}
		if (status=='nonaktif') {
			$('#status_edit').attr('checked', false);
			$('label[for="status_edit"]').html('Non-Active');
		}
	})
	
	var modalHapus = document.getElementById('modalHapus')
	modalHapus.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var kode = button.getAttribute('data-bs-kode')
	  var nama = button.getAttribute('data-bs-nama')

	  var modalTitle = modalHapus.querySelector('.modal-title')
	  var idInput = modalHapus.querySelector('.modal-body input#id_delete')

	  modalTitle.textContent = 'Hapus ' + nama + '?'
	  idInput.value = id
	})

  function fungsi_cek(){
  	var status_check = document.getElementById('status_edit');
		if (status_check.checked==true) {
			$('label[for="status_edit"]').html('Active');
		}else{
	  	$('label[for="status_edit"]').html('Non-Active');
		}
  }
</script>