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
			<table class="table table-striped table-hover table-sm table-bordered" id="data_bank">
				<thead>
					<tr>
						<th>No.</th>
						<th>Bank Name</th> 
						<th>Bank Account</th> 
						<th>Status</th> 
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>  
					<?php
						$i=1;
						$status_txt='';
						foreach ($data_bank->result() as $x) {
							if ($x->status=='1') {$status_txt='<span class="badge bg-success">Active</span>';}else{$status_txt='<span class="badge bg-danger">Not Active</span>';}
							echo'<tr>
									<td>'.$i.'</td>
									<td>'.$x->bank_name.'</td>
									<td>'.$x->bank_account.'</td>
									<td>'.$status_txt.'</td>
									<td>
										<div class="btn-group btn-group-sm">
											<a href="#modalView" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
												data-bs-id="'.$x->id.'"
												data-bs-bank_name="'.$x->bank_name.'"
												data-bs-bank_account="'.$x->bank_account.'"
												data-bs-status="'.$x->status.'"
											>
												<i class="bi bi-eye"></i>
											</a> 
											<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
												data-bs-id="'.$x->id.'"
												data-bs-bank_name="'.$x->bank_name.'"
												data-bs-bank_account="'.$x->bank_account.'"
												data-bs-status="'.$x->status.'"
											>
												<i class="bi bi-pencil-square"></i>
											</a>
										</div>
									</td> 
								</tr>';
							$i++;
						} 
					?>
					<!-- <a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
						data-bs-id="'.$x->id.'"
						data-bs-bank_name="'.$x->bank_name.'"
						data-bs-bank_account="'.$x->bank_account.'"
						data-bs-status="'.$x->status.'"
					>
						<i class="bi bi-trash3"></i>
					</a> -->
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
     	<form action="<?php echo base_url();?>master_data/add_bank" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md g-2">
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="bank_name" name="bank_name" placeholder="Bank Name">
								<label for="bank">Bank Name</label>
							</div>	
						</div>
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="bank_account" name="bank_account" placeholder="Bank Account">
								<label for="bank">Bank Account</label>
							</div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
					<div class="form-check form-switch me-auto">
					  <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" onclick="fungsi_cek_add()">
					  <label class="form-check-label" for="status">Non Active</label>
					</div>
	        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
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
					<input type="text" class="form-control bg-white" id="bank_name" placeholder="Bank Name" readonly>
					<label for="nama">Bank Name</label>
				</div>
        	</div>
        	<div class="col">
						<div class="form-floating">
							<input type="text" class="form-control bg-white" id="bank_account" placeholder="Bank Account" readonly>
							<label for="bank_account">Bank Account</label>
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
     	<form action="<?php echo base_url();?>master_data/edit_bank" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md g-2">
	        	<div class="col">
	        		<div class="form-floating">
						<input type="hidden" class="form-control" id="id_edit" name="id_edit" placeholder="Satuan">
						<input type="text" class="form-control" id="bank_name_edit" name="bank_name_edit" placeholder="Bank Name">
						<label for="bank">Bank Name</label>
					</div>
	        	</div> 
	        	<div class="col">
					<div class="form-floating">
						<input type="text" class="form-control" id="bank_account_edit" name="bank_account_edit" placeholder="Bank Account">
						<label for="bank">Bank Account</label>
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
     	<form action="<?php echo base_url();?>master_data/delete_bank" method="POST">
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
		$('#data_bank').DataTable();

		$('#selek').change(function() {
			var link = $('#selek').val();
			var base_url = '<?= base_url();?>master_data/';
			location.href = base_url+link;
		});
	});
		function fungsi_cek_add(){
	  	var status_check = document.getElementById('status');
			if (status_check.checked==true) {
				$('label[for="status"]').html('Active');
			}else{
		  	$('label[for="status"]').html('Non-Active');
			}
	  }	
	 	
	var modalView = document.getElementById('modalView')
	modalView.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var bank_name	   = button.getAttribute('data-bs-bank_name')
	  var bank_account = button.getAttribute('data-bs-bank_account')
	  var status = button.getAttribute('data-bs-status')

	  var modalTitle = modalView.querySelector('.modal-title')
	  var bankInput = modalView.querySelector('.modal-body input#bank_name')
	  var bankAccountInput = modalView.querySelector('.modal-body input#bank_account')
	  var statusSwitch = modalView.querySelector('.modal-body input#status')

	  modalTitle.textContent = 'Detail ' + bank_name
	  bankInput.value = bank_name
	  bankAccountInput.value = bank_account
	  if (status=='1') {
	  	$('#status_view').attr('checked', true);
			$('label[for="status_view"]').html('Active');
	  }
	  if (status=='0') {
	  	$('#status_view').attr('checked', false);
	  	$('label[for="status_view"]').html('Non-Active');
	  }
	})
	
	var modalEdit = document.getElementById('modalEdit')
	  modalEdit.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var bank_name	   = button.getAttribute('data-bs-bank_name')
	  var bank_account = button.getAttribute('data-bs-bank_account')
	  var status = button.getAttribute('data-bs-status')
	
	  var modalTitle = modalEdit.querySelector('.modal-title')
	  var idInput = modalEdit.querySelector('.modal-body input#id_edit')
	  var bankInput = modalEdit.querySelector('.modal-body input#bank_name_edit')
	  var bankAccountInput = modalEdit.querySelector('.modal-body input#bank_account_edit')
	  var statusSwitch = modalView.querySelector('.modal-body input#status')

	  modalTitle.textContent = 'Edit ' + bank_name
	  idInput.value = id
	  bankInput.value = bank_name 
	  bankAccountInput.value = bank_account

	  if (status=='1') {
	  	$('#status_edit').attr('checked', true);
			$('label[for="status_edit"]').html('Active');
	  }
	  if (status=='0') {
	  	$('#status_edit').attr('checked', false);
	  	$('label[for="status_edit"]').html('Non-Active');
	  }
	});
	
	var modalHapus = document.getElementById('modalHapus')
	modalHapus.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var bank = button.getAttribute('data-bs-bank_name')

	  var modalTitle = modalHapus.querySelector('.modal-title')
	  var bankInput = modalHapus.querySelector('.modal-body input#id_delete')

	  modalTitle.textContent = 'Hapus ' + bank + '?'
	  bankInput.value = id
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