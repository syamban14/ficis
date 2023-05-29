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
			<table class="table table-striped table-hover table-sm table-bordered" id="data_akun">
				<thead>
					<tr>
						<th>ID</th>
						<th>Akun</th>
						<th>Menu </th>  
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i=1;
					$status_txt='';
					foreach ($data_akun_setting->result() as $x) {
				?>
				
				<tr>
						<td><?= $x->id;?></td>
						<td><?= $x->description;?> <?= $x->description;?></td>
						<td><?= $x->menuname;?> <?= $x->menu;?></td>
						<td>
                            <div class="btn-group btn-group-sm">
								<a href="#modalView" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-nama="<?= $x->description;?>"
									data-bs-menu="<?= $x->menuname;?>"
								>
									<i class="bi bi-eye"></i>
								</a>
								<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-id_akun="<?= $x->id_akun;?>"
									data-bs-nama="<?= $x->description;?>"
									data-bs-menu="<?= $x->menu;?>"
								>
									<i class="bi bi-pencil-square"></i>
								</a>
								<a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
									data-bs-id="<?= $x->id;?>"
									data-bs-nama="<?= $x->description;?>"
									data-bs-menu="<?= $x->menuname;?>"								>
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
     	<form action="<?php echo base_url();?>master_data/add_akun_setting" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 g-2">
	        	<div class="col">
	        		<div class="form-floating">
                        <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="account_id" name="account_id" data-live-search="true">
					        <option></option>
                            <?php
                                foreach($data_akun->result() as $x)
                                {
                                    echo'<option value="'.$x->id.'">'.$x->acc_no.' - '.$x->description.'</option>';
                                }
                            ?>
                        </select>
                        <label for="acc_no">Account</label>  
                    </div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">      
                        <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="menu" name="menu" data-live-search="true">
			                <option></option>
                            <option value="AR">Account Receivable</option>
                            <option value="AP">Account Payable</option>
                            <option value="GA">General Accounting</option>
                            <option value="CA">Cash Advance</option>        
                        </select>
                        <label for="menu">Menu</label>
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
					<input type="text" class="form-control bg-white" id="account_id" name="account_id" placeholder="Akun" readonly="">
					<label for="acc_no">Akun</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control bg-white" id="menu" name="menu" placeholder="Menu" readonly="">
					<label for="menu">Menu</label>
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
     	<form action="<?php echo base_url();?>master_data/edit_akun_setting" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 g-2">
	        	<div class="col">
					<input type="hidden" class="form-control bg-white" id="id_edit" name="id_edit" readonly>
	        		<div class="form-floating">
						<!-- <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="akun_edit" name="akun_edit" data-live-search="true"> -->
					 	<select  class="form-control bg-white" id="akun_edit"  name="akun_edit">       
							<?php
                                foreach($data_akun->result() as $x)
                                {
							?>							
									<option value="<?= $x->id?>"><?= $x->description?></option>
                                    <!-- echo'<option value="'.$x->id.'">'.$x->acc_no.' - '.$x->description.'</option>'; -->
							<?php
								}
                            ?>
                        </select>
						<label for="kode">Akun</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">   
                        <!-- <select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="menu_edit" name="menu_edit" data-live-search="true"> -->
			            <select  class="form-control bg-white" id="menu_edit"  name="menu_edit">     
							<option value="AR">Account Receivable</option>
                            <option value="AP">Account Payable</option>
                            <option value="GA">General Accounting</option>
                            <option value="CA">Cash Advance</option>        
                        </select>
						<label for="nama">Menu</label>
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
     	<form action="<?php echo base_url();?>master_data/delete_akun_setting" method="POST">
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

		$('#data_akun').DataTable();

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
	  var nama = button.getAttribute('data-bs-nama')
	  var menu = button.getAttribute('data-bs-menu')
	  var status = button.getAttribute('data-bs-status')
	  var modalTitle = modalView.querySelector('.modal-title')
	  var namaInput = modalView.querySelector('.modal-body input#account_id')
	  var menuInput = modalView.querySelector('.modal-body input#menu')
	  var statusSwitch = modalView.querySelector('.modal-body input#status')

	  modalTitle.textContent = 'Detail ' + nama
	  namaInput.value = nama
	  menuInput.value = menu
	  
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
	var akun = button.getAttribute('data-bs-id_akun')
	var nama = button.getAttribute('data-bs-nama')
	var menu = button.getAttribute('data-bs-menu')
	var modalTitle = modalEdit.querySelector('.modal-title')
	var idInput = modalEdit.querySelector('.modal-body input#id_edit')
	// var akunInput = modalEdit.querySelector('.modal-body input#akun_edit')
	// const akunInput = document.getElementById('akun_edit')
	var menuInput = modalEdit.querySelector('.modal-body input#menu_edit')
	var statusSwitch = modalEdit.querySelector('.modal-body input#status_edit')

	modalTitle.textContent = 'Edit ' + nama
	idInput.value = id
	
	document.getElementById("akun_edit").value = akun;
	document.getElementById("menu_edit").value = menu;
	
	// akunInput.value = akun
	// akunInput.addEventListener('click', () => {
	// 	select.value = akun
	// })
	// menuInput.addEventListener('click', () => {
	// 	select.value = menu
	// })

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