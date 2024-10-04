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
			<table class="table table-striped table-hover table-sm table-bordered" id="data_department">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode Department</th>
						<th>Nama Department</th>  
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i=1;
					$status_txt=''; 
				foreach ($data_department_hris->result() as $x) {
						if ($x->active=='Y') {$status_txt='<span class="badge bg-success">Active</span>';}
						if ($x->active=='N') {$status_txt='<span class="badge bg-danger">Non-Active</span>';}
				?> 
				<tr>
						<td><?= $i;?></td>
						<td><?= $x->dept_code;?></td>
						<td><?= $x->dept_name;?></td>
						<td><?= $status_txt;?></td>
						<td>
							<div class="btn-group btn-group-sm">
								<a href="#modalViewHris" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-kode="<?= $x->dept_code;?>"
									data-bs-nama="<?= $x->dept_name;?>"  
									data-bs-status="<?= $x->active;?>"
								>
									<i class="bi bi-eye"></i>
								</a> 
								<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-kode="<?= $x->dept_code;?>"
									data-bs-nama="<?= $x->dept_name;?>"  
									data-bs-status="<?= $x->active;?>"
								>
									<i class="bi bi-pencil-square"></i>
								</a>
								<a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-kode="<?= $x->dept_code;?>"
									data-bs-nama="<?= $x->dept_name;?>"  
									data-bs-status="<?= $x->active;?>"
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
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/add_department" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md-2 g-2">
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="kode_add" name="kode_add" placeholder="Kode Department">
						<label for="kode_add">Kode Department</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="nama_add" name="nama_add" placeholder="Nama Department">
						<label for="nama_add">Nama Department</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating"> 
								<select class="form-control" id="status" name="status">
									<option value="Y">aktif</option>
									<option value="N">nonaktif</option> 
								</select>
								<label for="status">Status</label>
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
 
<div class="modal fade" id="modalViewHris" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row row-cols-1 row-cols-md-2 g-2">
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="kode" placeholder="Kode Department" readonly>
					<label for="kode">Kode Department</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="nama" placeholder="Nama Department" readonly>
					<label for="nama">Nama Department</label>
				</div>
        	</div> 
        </div>
      </div>
      <div class="modal-footer">
				<div class="form-check form-switch me-auto">
				  <input class="form-check-input" type="checkbox" role="switch" id="status_view" disabled>
				  <label class="form-check-label" for="status_view">Status Active</label>
				</div>
        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/edit_department" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md-2 g-2">
	        	<div class="col">
					<input type="hidden" class="form-control bg-white" id="id_edit" name="id_edit" readonly>
	        		<div class="form-floating">
						<input type="text" class="form-control" id="kode_edit" name="kode_edit" placeholder="Kode_edit" max="99" readonly>
						<label for="kode">Kode Department</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control" id="nama_edit" name="nama_edit" placeholder="Nama">
						<label for="nama">Nama Department</label>
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
     	<form action="<?php echo base_url();?>master_data/delete_department" method="POST">
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

		$('#data_department').DataTable();

		$('#selek').change(function() {
			var link = $('#selek').val();
			var base_url = '<?= base_url();?>master_data/';
			location.href = base_url+link;
		});
	});
	
	var modalViewHris = document.getElementById('modalViewHris')
	modalViewHris.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var kode = button.getAttribute('data-bs-kode')
	  var nama = button.getAttribute('data-bs-nama')
	  var status = button.getAttribute('data-bs-status')

	  var modalTitle = modalViewHris.querySelector('.modal-title')
	  var kodeInput = modalViewHris.querySelector('.modal-body input#kode')
	  var namaInput = modalViewHris.querySelector('.modal-body input#nama') 
	  var statusSwitch = modalViewHris.querySelector('.modal-body input#status')

	  modalTitle.textContent = 'Detail ' + nama
	  kodeInput.value = kode
	  namaInput.value = nama 
	  
	  if (status=='Y') {
	  	$('#status_view').attr('checked', true);
			$('label[for="status_view"]').html('Active');
	  }
	  if (status=='N') {
	  	$('#status_view').attr('checked', false);
	  	$('label[for="status_view"]').html('Non-Active');
	  }
	});

	var modalEdit = document.getElementById('modalEdit')
	modalEdit.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var kode = button.getAttribute('data-bs-kode')
	  var nama = button.getAttribute('data-bs-nama')
	  var status = button.getAttribute('data-bs-status')

	  var modalTitle = modalEdit.querySelector('.modal-title')
	  var idInput = modalEdit.querySelector('.modal-body input#id_edit')
	  var kodeInput = modalEdit.querySelector('.modal-body input#kode_edit')
	  var namaInput = modalEdit.querySelector('.modal-body input#nama_edit')
	  var statusSwitch = modalEdit.querySelector('.modal-body input#status_edit')

	  modalTitle.textContent = 'Edit ' + nama
	  idInput.value = id
	  kodeInput.value = kode
	  namaInput.value = nama

	  if (status=='Y') {
	  	$('#status_edit').attr('checked', true);
			$('label[for="status_edit"]').html('Active');
	  }
	  if (status=='N') {
	  	$('#status_edit').attr('checked', false);
	  	$('label[for="status_edit"]').html('Non-Active');
	  }
	});
	
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
	});

  function fungsi_cek(){
  	var status_check = document.getElementById('status_edit');
		if (status_check.checked==true) {
			$('label[for="status_edit"]').html('Active');
		}else{
	  	$('label[for="status_edit"]').html('Non-Active');
		}
  }
</script>