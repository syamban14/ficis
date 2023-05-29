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
		<div class="table-responsive mt-3">
			<table class="table table-striped table-hover table-sm table-bordered" id="data_customer">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode</th>
						<th>Nama Pajak</th>
						<th>Account Number</th>
						<th>Account Name</th>
						<th>Nilai</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i=1;
					$status_txt='';
					foreach ($data_pajak->result() as $x) {
						if ($x->status=='aktif') {$status_txt='<span class="badge bg-success">Active</span>';}
						if ($x->status=='nonaktif') {$status_txt='<span class="badge bg-danger">Non-Active</span>';}
				?>
					<tr>
						<td><?= $i;?></td>
						<td><?= $x->kode_pajak;?></td>
						<td><?= $x->nama_pajak;?></td>
						<td><?= $x->account_number;?></td>
						<td><?= $x->account_name;?></td>
						<td><?= $x->value;?></td>
						<td><?= $status_txt;?></td>
						<td>
							<div class="btn-group btn-group-sm">
								<a href="#modalView" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-kode="<?= $x->kode_pajak;?>"
									data-bs-nama="<?= $x->nama_pajak;?>"
									data-bs-account_number="<?= $x->account_number;?>"
									data-bs-account_name="<?= $x->account_name;?>"
									data-bs-nilai="<?= $x->value;?>"
									data-bs-status="<?= $x->status;?>"
								>
									<i class="bi bi-eye"></i>
								</a>
								<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-kode="<?= $x->kode_pajak;?>"
									data-bs-nama="<?= $x->nama_pajak;?>"
									data-bs-account_number="<?= $x->account_number;?>"
									data-bs-account_name="<?= $x->account_name;?>"
									data-bs-nilai="<?= $x->value;?>"
									data-bs-status="<?= $x->status;?>"
								>
									<i class="bi bi-pencil-square"></i>
								</a>
								<a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-kode="<?= $x->kode_pajak;?>"
									data-bs-nama="<?= $x->nama_pajak;?>"
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
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/add_pajak" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 g-2">
	        	<div class="col">
	        		<div class="form-floating">
						<input type="number" class="form-control bg-white" id="kode_add" name="kode_add" placeholder="Kode" max="99">
						<label for="kode_add">Kode</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="nama_add" name="nama_add" placeholder="Nama">
						<label for="nama_add">Nama</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="account_number" name="account_number" placeholder="Account Number">
						<label for="account_number">Account Number</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="account_name" name="account_name" placeholder="Account Name">
						<label for="account_name">Account Name</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="nilai_add" name="nilai_add" placeholder="Nilai">
						<label for="nilai_add">Nilai</label>
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
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row row-cols-1 g-2">
        	<div class="col">
        		<div class="form-floating">
						  <input type="text" class="form-control bg-white" id="kode" placeholder="Kode" readonly>
						  <label for="kode">Kode</label>
						</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
						  <input type="text" class="form-control bg-white" id="nama" placeholder="Nama" readonly>
						  <label for="nama">Nama</label>
						</div>
        	</div>
			
			<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="account_number" name="account_number" placeholder="Account Number">
						<label for="account_number">Account Number</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="account_name" name="account_name" placeholder="Account Name">
						<label for="account_name">Account Name</label>
					</div>
	        	</div>
        	<div class="col">
        		<div class="form-floating">
						  <input type="text" class="form-control bg-white" id="nilai" placeholder="Nilai" readonly>
						  <label for="nilai">Nilai</label>
						</div>
        	</div>
        	<div class="col-12">
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
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/edit_pajak" method="POST">
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
						<input type="text" class="form-control bg-white" id="account_number_edit" name="account_number_edit" placeholder="Account Number">
						<label for="account_number">Account Number</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="account_name_edit" name="account_name_edit" placeholder="Account Name">
						<label for="account_name">Account Name</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
							  <input type="text" class="form-control" id="nilai_edit" name="nilai_edit" placeholder="Nilai">
							  <label for="nilai_edit">Nilai</label>
							</div>
	        	</div>
	        	<div class="col-12">
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
     	<form action="<?php echo base_url();?>master_data/delete_pajak" method="POST">
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

		$('#data_customer').DataTable();

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
	  var account_number = button.getAttribute('data-bs-account_number')
	  var account_name = button.getAttribute('data-bs-account_name')
	  var nilai = button.getAttribute('data-bs-nilai')
	  var status = button.getAttribute('data-bs-status')

	  var modalTitle = modalView.querySelector('.modal-title')
	  var kodeInput = modalView.querySelector('.modal-body input#kode')
	  var namaInput = modalView.querySelector('.modal-body input#nama')
	  var account_numberInput = modalView.querySelector('.modal-body input#account_number')
	  var account_nameInput = modalView.querySelector('.modal-body input#account_name')
	  var nilaiInput = modalView.querySelector('.modal-body input#nilai')
	  var statusSwitch = modalView.querySelector('.modal-body input#status')

	  modalTitle.textContent = 'Detail ' + nama
	  kodeInput.value = kode
	  namaInput.value = nama
	  account_numberInput.value = account_number
	  account_nameInput.value = account_name
	  nilaiInput.value = nilai
	  
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
	  var account_number = button.getAttribute('data-bs-account_number')
	  var account_name = button.getAttribute('data-bs-account_name')
	  var nilai = button.getAttribute('data-bs-nilai')
	  var status = button.getAttribute('data-bs-status')

	  var modalTitle = modalEdit.querySelector('.modal-title')
	  var idInput = modalEdit.querySelector('.modal-body input#id_edit')
	  var kodeInput = modalEdit.querySelector('.modal-body input#kode_edit')
	  var namaInput = modalEdit.querySelector('.modal-body input#nama_edit')
	  var account_numberInput = modalEdit.querySelector('.modal-body input#account_number_edit')
	  var account_nameInput = modalEdit.querySelector('.modal-body input#account_name_edit')
	  var nilaiInput = modalEdit.querySelector('.modal-body input#nilai_edit')
	  var statusSwitch = modalEdit.querySelector('.modal-body input#status_edit')

	  modalTitle.textContent = 'Edit ' + nama
	  idInput.value = id
	  kodeInput.value = kode
	  namaInput.value = nama
	  account_numberInput.value = account_number
	  account_nameInput.value = account_name
	  nilaiInput.value = nilai

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