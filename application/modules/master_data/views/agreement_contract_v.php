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
		&nbsp;
		<!-- <button class="btn btn-success rounded-lg position-absolute top-0 translate-middle ms-3" title="Upload data excel" data-bs-toggle="modal" data-bs-target="#modalUpload"><i class="fas fa-plus"></i></button> -->
		<div class="table-responsive mt-3">
			<table class="table table-striped table-hover table-sm table-bordered" id="data_agreement_contract">
				<thead>
					<tr>
						<th>No.</th>
						<th>Description</th> 
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>  
					<?php
						$i=1; 
						foreach ($data_agreement_contract as $x) {
							echo'<tr>
									<td>'.$i.'</td>
									<td>'.$x->description.'</td>
									<td>
										<div class="btn-group btn-group-sm">
											<a href="#modalView" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
												data-bs-id="'.$x->id.'"
												data-bs-description="'.$x->description.'"
											>
												<i class="bi bi-eye"></i>
											</a> 
											<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
												data-bs-id="'.$x->id.'"
												data-bs-description="'.$x->description.'"
											>
												<i class="bi bi-pencil-square"></i>
											</a>
											<a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
												data-bs-id="'.$x->id.'"
												data-bs-description="'.$x->description.'"
											>
												<i class="bi bi-trash3"></i>
											</a>
										</div>
									</td> 
								</tr>';
							$i++;
						} 
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
     	<form action="<?php echo base_url();?>master_data/add_agreement" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md g-2">
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="description" name="description" placeholder="Description">
						<label for="description">Description</label>
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
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row row-cols-1 row-cols-md g-2">
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="description" placeholder="Description" readonly>
					<label for="nama">Description</label>
				</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
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
     	<form action="<?php echo base_url();?>master_data/edit_agreement" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md g-2">
	        	<div class="col">
	        		<div class="form-floating">
						<input type="hidden" class="form-control" id="id_edit" name="id_edit" placeholder="Satuan">
						<input type="text" class="form-control" id="description_edit" name="description_edit" placeholder="Bank Name">
						<label for="agreement">Description</label>
					</div>
	        	</div> 
	        </div>
	      </div>
	      <div class="modal-footer">
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
     	<form action="<?php echo base_url();?>master_data/delete_agreement" method="POST">
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
		$('#data_agreement_contract').DataTable();
	
		$('#selek').change(function() {
			var link = $('#selek').val();
			var base_url = '<?= base_url();?>master_data/';
			location.href = base_url+link;
		});
	});
	 	
	var modalView = document.getElementById('modalView')
	modalView.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var description	   = button.getAttribute('data-bs-description')
	  var agreement_account = button.getAttribute('data-bs-agreement_account')

	  var modalTitle = modalView.querySelector('.modal-title')
	  var agreementInput = modalView.querySelector('.modal-body input#description')
	  var agreementAccountInput = modalView.querySelector('.modal-body input#agreement_account')

	  modalTitle.textContent = 'Detail ' + description
	  agreementInput.value = description
	  agreementAccountInput.value = agreement_account
	})
	
	var modalEdit = document.getElementById('modalEdit')
	  modalEdit.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var description	   = button.getAttribute('data-bs-description')
	  var agreement_account = button.getAttribute('data-bs-agreement_account')
	
	  var modalTitle = modalEdit.querySelector('.modal-title')
	  var idInput = modalEdit.querySelector('.modal-body input#id_edit')
	  var agreementInput = modalEdit.querySelector('.modal-body input#description_edit')
	  var agreementAccountInput = modalEdit.querySelector('.modal-body input#agreement_account_edit')

	  modalTitle.textContent = 'Edit ' + description
	  idInput.value = id
	  agreementInput.value = description 
	  agreementAccountInput.value = agreement_account
	});
	
	var modalHapus = document.getElementById('modalHapus')
	modalHapus.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var agreement = button.getAttribute('data-bs-description')

	  var modalTitle = modalHapus.querySelector('.modal-title')
	  var agreementInput = modalHapus.querySelector('.modal-body input#id_delete')

	  modalTitle.textContent = 'Hapus ' + agreement + '?'
	  agreementInput.value = id
	})
</script>