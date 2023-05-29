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
			<table class="table table-striped table-hover table-sm table-bordered" id="data_project">
				<thead>
					<tr>
						<th>No.</th>
						<th>Department</th>
						<th>Project Code</th>
						<th>Project Name</th> 
						<th>Site Alias</th>
						<th>Remark</th> 
						<th>Site</th> 
						<th>Contact Person</th> 
						<th>Address</th> 
						<th>Phone</th> 
						<th>Akun</th> 
						<th>Opsi</th> 
					</tr>
				</thead>
				<tbody> 
				<?php
					$i=1;
					$status_txt='';
					foreach ($data_project->result() as $x) {
						echo'<tr>
								<td>'.$i.'</td>
								<td>'.$x->dept_name.'</td>
								<td>'.$x->project_code.'</td>
								<td>'.$x->project.'</td>
								<td>'.$x->site_alias.'</td>
								<td>'.$x->remarks.'</td>
								<td>'.$x->Site.'</td>
								<td>'.$x->cp_name.'</td>
								<td>'.$x->address.'</td>
								<td>'.$x->phone.'</td>
								<td style="text-align:center;"><a href="#modalAkun" class="btn btn-info btn-sm text-white tooltipnya" style=" title="Lihat Akun" data-bs-toggle="modal"
								data-bs-id="'.$x->id.'"									
								data-bs-kode="'.$x->project_code.'"							
								data-bs-nama="'.$x->project.'" ><i class="bi bi-zoom-in"></i> </a></td>
								<td>
									<div class="btn-group btn-group-sm">
										<a href="#modalView" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
											data-bs-id="'.$x->id.'"
											data-bs-dept_name="'.$x->dept_name.'"
											data-bs-kode="'.$x->project_code.'"
											data-bs-nama="'.$x->project.'" 
											data-bs-site_alias="'.$x->site_alias.'" 
											data-bs-remarks="'.$x->remarks.'" 
											data-bs-Site="'.$x->Site.'" 
											data-bs-cp_name="'.$x->cp_name.'" 
											data-bs-address="'.$x->address.'" 
											data-bs-phone="'.$x->phone.'" 
											data-bs-status="'.$x->status.'" 
										>
											<i class="bi bi-eye"></i>
										</a>
										<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
											data-bs-id="'.$x->id.'"
											data-bs-dept_code="'.$x->dept_code.'"
											data-bs-kode="'.$x->project_code.'"
											data-bs-nama="'.$x->project.'" 
											data-bs-site_alias="'.$x->site_alias.'" 
											data-bs-remarks="'.$x->remarks.'" 
											data-bs-Site="'.$x->Site.'" 
											data-bs-cp_name="'.$x->cp_name.'" 
											data-bs-address="'.$x->address.'" 
											data-bs-phone="'.$x->phone.'" 
											data-bs-status="'.$x->status.'" 
										>
											<i class="bi bi-pencil-square"></i>
										</a>
										<a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
											data-bs-id="'.$x->id.'"
											data-bs-dept_code="'.$x->dept_code.'"
											data-bs-kode="'.$x->project_code.'"
											data-bs-nama="'.$x->project.'"
											data-bs-site_alias="'.$x->site_alias.'" 
											data-bs-remarks="'.$x->remarks.'" 
											data-bs-Site="'.$x->Site.'" 
											data-bs-cp_name="'.$x->cp_name.'" 
											data-bs-address="'.$x->address.'" 
											data-bs-phone="'.$x->phone.'"
											data-bs-status="'.$x->status.'"  
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
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/add_project" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md-2 g-2">
				<div class="col" style="min-height:58px;">
						<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="department" name="department" data-live-search="true" data-size="8">
							<option>-Pilih Departement-</option>
							<?php
								foreach ($data_department->result() as $x) {
							?>
								<option value="<?= $x->dept_code?>" data-subtext="<?= $x->dept_code?>" data-token="<?= $x->dept_code?>"><?= $x->dept_name?></option>
							<?php
								}
							?>
						</select>
				</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="project_code" name="project_code" placeholder="Project Code">
						<label for="project_code">Project Code</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="project_name" name="project_name" placeholder="Project Name">
						<label for="project_name">Project Name</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="site_alias" name="site_alias" placeholder="Site Alias">
						<label for="site_alias">Site Alias</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="remark" name="remark" placeholder="Remark">
						<label for="remark">Remark</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="site" name="site" placeholder="Site">
						<label for="site">Site</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="contact_person" name="contact_person" placeholder="contact person">
						<label for="contact_person">Contact Person</label>
					</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
						<textarea class="form-control bg-white"  id="address" name="address"></textarea>
						<label for="address">Address</label>
					</div>
	        	</div>				
	        	<div class="col">
	        		<div class="form-floating">
						<input type="text" class="form-control bg-white" id="phone" name="phone" placeholder="Phone">
						<label for="phone">Phone</label>
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
        <div class="row row-cols-1 row-cols-md-2 g-2">
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="dept_name" placeholder="Department" readonly>
					<label for="dept_name">Department</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="kode" placeholder="Kode" readonly>
					<label for="kode">Project Code</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="nama" placeholder="Nama" readonly>
					<label for="nama">Project Name</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="site_alias" placeholder="Site Alias" readonly>
					<label for="site_alias">Site Alias</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="remarks" placeholder="remark" readonly>
					<label for="remark">Remark</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="site" placeholder="site" readonly>
					<label for="site">Site</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="contact_person" placeholder="Contact Person" readonly>
					<label for="contact_person">Contact Person</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="address" placeholder="address" readonly>
					<label for="address">Address</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="phone" placeholder="Phone" readonly>
					<label for="phone">Phone</label>
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
     	<form action="<?php echo base_url();?>master_data/edit_project" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md-2 g-2">
	        	<div class="col">
	        		<div class="form-floating">
						<select  class="form-control bg-white" id="department_edit"  name="department_edit">
							<option>-Pilih-</option>
							<?php
								foreach ($data_department->result() as $x) {
							?>
								<option value="<?= $x->dept_code?>" data-subtext="<?= $x->dept_code?>" data-token="<?= $x->dept_code?>"><?= $x->dept_name?></option>
							<?php
								}
							?>
						</select>
						<label for="department">Department</label>
					</div>
	        	</div>
	        	<div class="col">
					<input type="hidden" class="form-control bg-white" id="id_edit" name="id_edit" readonly>
	        		<div class="form-floating">
						<input type="text" class="form-control" id="kode_edit" name="kode_edit" placeholder="Kode_edit" max="99" readonly>
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
						<input type="text" class="form-control bg-white" id="site_alias_edit" name="site_alias_edit" placeholder="Site Alias">
						<label for="site_alias_edit">Site Alias</label>
					</div>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="text" class="form-control bg-white" id="remarks_edit" name="remarks_edit" placeholder="remark">
						<label for="remark_edit">Remark</label>
					</div>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="text" class="form-control bg-white" id="site_edit" name="site_edit" placeholder="site" >
						<label for="site_edit">Site</label>
					</div>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="text" class="form-control bg-white" id="contact_person_edit" name="contact_person_edit" placeholder="Contact Person">
						<label for="contact_person_edit">Contact Person</label>
					</div>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="text" class="form-control bg-white" id="address_edit" name="address_edit" placeholder="address">
						<label for="address_edit">Address</label>
					</div>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="text" class="form-control bg-white" id="phone_edit" name="phone_edit" placeholder="Phone">
						<label for="phone_edit">Phone</label>
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

<div class="modal fade" id="modalAkun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
	  	<div class="modal-body">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#daftar_akun" type="button" role="tab" aria-controls="home" aria-selected="true">Daftar Akun</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#form_akun" type="button" role="tab" aria-controls="profile" aria-selected="false">Tambah Akun</button>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="daftar_akun" role="tabpanel" aria-labelledby="home-tab">
						<div class="table-responsive mt-3">
							<table class="table table-striped table-hover table-sm table-bordered" id="data_akun">
								<thead>
									<tr>
										<th>Id</th>
										<th>Account Number</th>
										<th>Account Name</th>
										<th>Hapus</th> 
									</tr>
								</thead>
								<tbody id="get_data_akun">
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="form_akun" role="tabpanel" aria-labelledby="profile-tab">
						<form action="<?php echo base_url();?>master_data/add_project_akun" method="POST" class="mt-3">
								<div class="row row-cols-1 row-cols-md-2 g-2">
									<div class="col">
										<div class="form-floating">
											<input type="text" class="form-control bg-white" id="project_code_akun" name="project_code_akun" placeholder="Project Code" readonly>
											<label for="project_code_akun">Project Code</label>
										</div>
									</div>
									<div class="col">
										<div class="form-floating">
											<input type="text" class="form-control bg-white" id="project_name_akun" name="project_name_akun" placeholder="Project Name" readonly>
											<label for="project_name_akun">Project Name</label>
										</div>
									</div>
									<div class="col" style="min-height:58px;">
											<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="akun" name="akun" data-live-search="true" data-size="8">
												<option>-Pilih Akun-</option>
												<?php
													foreach ($data_akun->result() as $x) {
												?>
													<option value="<?= $x->acc_no?>" data-subtext="<?= $x->acc_no?>" data-token="<?= $x->acc_no?>"><?= $x->description?></option>
												<?php
													}
												?>
											</select>
									</div>
								</div>
								<hr>
								<div class="d-flex mt-3">
									<button type="submit" class="btn btn-primary ms-auto">Simpan</button>
								</div>
						</form>
					</div>
				</div>
			</div>
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
     	<form action="<?php echo base_url();?>master_data/delete_project" method="POST">
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
<script type="text/javascript">
	$(document).ready(function() {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('.tooltipnya'));
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		  return new bootstrap.Tooltip(tooltipTriggerEl);
		});

		$('#data_project').DataTable();
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
	  var dept_name = button.getAttribute('data-bs-dept_name')
	  var kode = button.getAttribute('data-bs-kode')
	  var nama = button.getAttribute('data-bs-nama')
	  var site_alias = button.getAttribute('data-bs-site_alias')
	  var remarks = button.getAttribute('data-bs-remarks')
	  var site = button.getAttribute('data-bs-site')
	  var cp_name = button.getAttribute('data-bs-cp_name')
	  var address = button.getAttribute('data-bs-address')
	  var phone = button.getAttribute('data-bs-phone')
	  var status = button.getAttribute('data-bs-status')

	  var modalTitle = modalView.querySelector('.modal-title')
	  var deptname_kodeInput = modalView.querySelector('.modal-body input#dept_name')
	  var kodeInput = modalView.querySelector('.modal-body input#kode')
	  var namaInput = modalView.querySelector('.modal-body input#nama')
	  var sitealiasInput = modalView.querySelector('.modal-body input#site_alias')
	  var remarksInput = modalView.querySelector('.modal-body input#remarks')
	  var siteInput = modalView.querySelector('.modal-body input#site')
	  var cp_nameInput = modalView.querySelector('.modal-body input#contact_person')
	  var addressInput = modalView.querySelector('.modal-body input#address')
	  var phoneInput = modalView.querySelector('.modal-body input#phone')
	  var statusSwitch = modalView.querySelector('.modal-body input#status')

	  modalTitle.textContent = 'Detail ' + nama
	  deptname_kodeInput.value = dept_name
	  kodeInput.value = kode
	  namaInput.value = nama
	  sitealiasInput.value = site_alias
	  remarksInput.value = remarks
	  siteInput.value = site
	  cp_nameInput.value = cp_name
	  addressInput.value = address
	  phoneInput.value = phone
	});
	
	var modalEdit = document.getElementById('modalEdit')
	modalEdit.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget
	  var id = button.getAttribute('data-bs-id')
	  var dept_code = button.getAttribute('data-bs-dept_code')
	  var kode = button.getAttribute('data-bs-kode')
	  var nama = button.getAttribute('data-bs-nama')
	  var site_alias = button.getAttribute('data-bs-site_alias')
	  var remarks = button.getAttribute('data-bs-remarks')
	  var site = button.getAttribute('data-bs-site')
	  var cp_name = button.getAttribute('data-bs-cp_name')
	  var address = button.getAttribute('data-bs-address')
	  var phone = button.getAttribute('data-bs-phone')
	  var status = button.getAttribute('data-bs-status')

	  document.getElementById("department_edit").value = dept_code;
	  var modalTitle = modalEdit.querySelector('.modal-title')
	  var idInput = modalEdit.querySelector('.modal-body input#id_edit')
	  var kodeInput = modalEdit.querySelector('.modal-body input#kode_edit')
	  var namaInput = modalEdit.querySelector('.modal-body input#nama_edit')
	  var sitealiasInput = modalEdit.querySelector('.modal-body input#site_alias_edit')
	  var remarksInput = modalEdit.querySelector('.modal-body input#remarks_edit')
	  var siteInput = modalEdit.querySelector('.modal-body input#site_edit')
	  var cp_nameInput = modalEdit.querySelector('.modal-body input#contact_person_edit')
	  var addressInput = modalEdit.querySelector('.modal-body input#address_edit')
	  var phoneInput = modalEdit.querySelector('.modal-body input#phone_edit')
	  var statusSwitch = modalEdit.querySelector('.modal-body input#status_edit')

	  modalTitle.textContent = 'Edit ' + nama
	  idInput.value = id
	  kodeInput.value = kode
	  namaInput.value = nama
	  sitealiasInput.value = site_alias
	  remarksInput.value = remarks
	  siteInput.value = site
	  cp_nameInput.value = cp_name
	  addressInput.value = address
	  phoneInput.value = phone
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

	
	var modalAkun = document.getElementById('modalAkun')
	modalAkun.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget
		var id = button.getAttribute('data-bs-id')
		var kode = button.getAttribute('data-bs-kode')
		var nama = button.getAttribute('data-bs-nama')
	  	var modalTitle = modalAkun.querySelector('.modal-title')
		var kodeInput = modalAkun.querySelector('.modal-body input#project_code_akun')
		var namaInput = modalAkun.querySelector('.modal-body input#project_name_akun')
		$.ajax({
			url : "<?php echo base_url();?>master_data/getprojectAkun",
			method : "POST",
			data : {id: kode},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<tr><td>'+data[i].id+'</td><td>'+data[i].acc_no+'</td><td>'+data[i].description+'</td>'+
							'<td><div class="btn-group btn-group-sm"><a href="<?= base_url();?>master_data/delete_project_akun/'+data[i].id+'" class="btn btn-danger text-white tooltipnya" title="Hapus" >'+
							'<i class="bi bi-trash3"></i></a></div></td></tr>';
				}
				$('#get_data_akun').html(html);
			}
		});
		modalTitle.textContent = 'Daftar Akun Project '+nama
		kodeInput.value = kode
		namaInput.value = nama
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