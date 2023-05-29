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
						<th>Nama</th>
						<th>Inisial</th>
						<th>Alamat</th> 
						<th>PIC</th>
						<th>Telp. PIC</th> 
						<th>Kategory</th>
						<th>Negara</th> 
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i=1; 
					foreach ($data_customer->result() as $x) {
						echo'<tr>
								<td>'.$i.'</td>
								<td>'.$x->kode_kustomer.'</td>
								<td>'.$x->nama_kustomer.'</td> 
								<td>'.$x->inisial1.'</td>
								<td>'.$x->alamat.'</td>
								<td>'.$x->contact_person.'</td>
								<td>'.$x->tlp.'</td>
								<td>Customer</td>
								<td></td> 
								<td>
									<div class="btn-group btn-group-sm">
										<a href="#modalView" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
											data-bs-id="'.$x->nid.'"
											data-bs-kode="'.$x->kode_kustomer.'"
											data-bs-nama="'.$x->nama_kustomer.'" 
											data-bs-alamat="'.$x->alamat.'" 
											data-bs-contact_person="'.$x->contact_person.'" 
											data-bs-tlp="'.$x->tlp.'" 
											data-bs-kategori="customer"
										>
											<i class="bi bi-eye"></i>
										</a>
										<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
											data-bs-id="'.$x->nid.'"
											data-bs-kode="'.$x->kode_kustomer.'"
											data-bs-nama="'.$x->nama_kustomer.'" 
											data-bs-alamat="'.$x->alamat.'" 
											data-bs-contact_person="'.$x->contact_person.'" 
											data-bs-tlp="'.$x->tlp.'" 
											data-bs-kategori="customer"
										>
											<i class="bi bi-pencil-square"></i>
										</a>
										<a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
											data-bs-id="'.$x->nid.'"
											data-bs-kode="'.$x->kode_kustomer.'"
											data-bs-nama="'.$x->nama_kustomer.'"
											data-bs-kategori="customer"
										>
											<i class="bi bi-trash3"></i>
										</a>
									</div>
								</td>
							</tr>';
						$i++;
					} 
					foreach ($data_vendor->result() as $y) {
						echo'<tr>
								<td>'.$i.'</td>
								<td>'.$y->vendor_id.'</td>
								<td>'.$y->vendor.'</td> 
								<td>'.$y->address1.'</td>
								<td>'.$y->alias.'</td>
								<td>'.$y->cp.'</td>
								<td>'.$y->phone.'</td>
								<td>Vendor</td>
								<td>'.$y->country.'</td>
								<td>
									<div class="btn-group btn-group-sm">
										<a href="#modalView" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
											data-bs-id="'.$y->id_vendor.'"
											data-bs-kode="'.$y->vendor_id.'"
											data-bs-nama="'.$y->vendor.'" 
											data-bs-alamat="'.$y->address1.'" 
											data-bs-contact_person="'.$y->cp.'" 
											data-bs-tlp="'.$y->phone.'" 
											data-bs-kategori="vendor"
										>
											<i class="bi bi-eye"></i>
										</a>
										<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
											data-bs-id="'.$y->id_vendor.'"
											data-bs-kode="'.$y->vendor_id.'"
											data-bs-nama="'.$y->vendor.'" 
											data-bs-alamat="'.$y->address1.'" 
											data-bs-contact_person="'.$y->cp.'" 
											data-bs-tlp="'.$y->phone.'" 
											data-bs-kategori="vendor"
										>
											<i class="bi bi-pencil-square"></i>
										</a>
										<a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
											data-bs-id="'.$y->id_vendor.'"
											data-bs-kode="'.$y->vendor_id.'"
											data-bs-nama="'.$y->vendor.'"
											data-bs-kategori="vendor"
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
     	<form action="<?php echo base_url();?>master_data/add_customer" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md-2 g-2">
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="kode_kustomer" name="kode_kustomer" placeholder="Kode">
								<label for="kode_kustomer">Kode</label>
							</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="nama_kustomer" name="nama_kustomer" placeholder="nama kustomer/vendor">
								<label for="nama_kustomer">Nama Kustomer/Vendor</label>
							</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
								<textarea class="form-control bg-white" id="alamat" name="alamat" placeholder="Alamat"></textarea>
								<label for="alamat">Alamat</label>
							</div>
	        	</div>	
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="contact_person" name="contact_person" placeholder="Contact Person">
								<label for="contact_person">Contact Person</label>
							</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="jabatan" name="jabatan" placeholder="Jabatan">
								<label for="jabatan">Jabatan</label>
							</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="tlp" name="tlp" placeholder="Telepon">
								<label for="tlp">Telepon</label>
							</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="inisial" name="inisial" placeholder="Inisial">
								<label for="inisia">Inisial</label>
							</div>
	        	</div>			
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="phone" name="phone" placeholder="Phone">
								<label for="phone">Phone</label>
							</div>
	        	</div>	
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="negara" name="negara" placeholder="Negara">
								<label for="negara">Negara</label>
							</div>
	        	</div>	
	        	<div class="col">
	        		<div class="form-floating">
								<select id="category" name="category" class="form-control">
									<option>Pilih</option>
									<option value="Customer">Customer</option>
									<option value="Vendor">Vendor</option>
								</select>
								<label for="phone">Kategori</label>
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
					<input type="text" class="form-control bg-white" id="alamat" placeholder="alamat" readonly>
					<label for="alamat">Alamat</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="contact_person" placeholder="contact_person" readonly>
					<label for="pic">PIC</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="tlp" placeholder="tlp" readonly>
					<label for="pic">Telp. PIC</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="kategori" placeholder="kategori" readonly>
					<label for="kategori">Kategori</label>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/edit_customer" method="POST">
	      <div class="modal-body">
	        <div class="row row-cols-1 row-cols-md-2 g-2">
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
									<input type="text" class="form-control bg-white" id="alamat_edit" name="alamat_edit" placeholder="alamat_edit">
									<label for="alamat_edit">Alamat</label>
								</div>
        		</div>
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="contact_person_edit" name="contact_person_edit" placeholder="contact person">
								<label for="pic">PIC</label>
							</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="tlp_edit" name="tlp_edit" placeholder="Telepon">
								<label for="pic">Telp. PIC</label>
							</div>
	        	</div>
	        	<div class="col">
	        		<div class="form-floating">
								<input type="text" class="form-control bg-white" id="kategori_edit" name="kategori_edit" placeholder="kategori" readonly>
								<label for="kategori">Kategori</label>
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
        <h5 class="modal-title" id="exampleModalLabel">Hapus </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <div class="modal-body">
		<form action="<?php echo base_url();?>master_data/delete_customer" method="POST">
			<input type="hidden" class="form-control bg-white" id="id_delete" name="id_delete" readonly>
			<input type="hidden" class="form-control bg-white" id="kategori_delete" name="kategori_delete" readonly>
			<lottie-player src="https://assets8.lottiefiles.com/private_files/lf30_rj4ooq2j.json"  background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop  autoplay class="mx-auto"></lottie-player>
			<div class="d-grid">
				<div class="btn-group">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-danger">Hapus</button>
				</div>
			</div>
		</form>
	  </div>
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
	  var alamat = button.getAttribute('data-bs-alamat')
	  var pic = button.getAttribute('data-bs-contact_person')
	  var tlp = button.getAttribute('data-bs-tlp')
	  var kategori = button.getAttribute('data-bs-kategori')
	  var status = button.getAttribute('data-bs-status')

	  var modalTitle = modalView.querySelector('.modal-title')
	  var kodeInput = modalView.querySelector('.modal-body input#kode')
	  var namaInput = modalView.querySelector('.modal-body input#nama') 
	  var alamatInput = modalView.querySelector('.modal-body input#alamat') 
	  var picInput = modalView.querySelector('.modal-body input#contact_person') 
	  var tlpInput = modalView.querySelector('.modal-body input#tlp') 
	  var kategoriInput = modalView.querySelector('.modal-body input#kategori') 
	  var statusSwitch = modalView.querySelector('.modal-body input#status')

	  modalTitle.textContent = 'Detail ' + nama
	  kodeInput.value = kode
	  namaInput.value = nama 
	  alamatInput.value = alamat 
	  picInput.value = pic 
	  tlpInput.value = tlp 
	  kategoriInput.value = kategori 
	  
	  if (status=='Y') {
	  	$('#status').attr('checked', true);
			$('label[for="status"]').html('Active');
	  }
	  if (status=='N') {
	  	$('#status').attr('checked', false);
	  	$('label[for="status"]').html('Non-Active');
	  }
	}); 

	
	var modalEdit = document.getElementById('modalEdit')
	modalEdit.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var kode = button.getAttribute('data-bs-kode')
	  var nama = button.getAttribute('data-bs-nama')
	  var status = button.getAttribute('data-bs-status')
	  var alamat = button.getAttribute('data-bs-alamat')
	  var pic = button.getAttribute('data-bs-contact_person')
	  var kategori = button.getAttribute('data-bs-kategori')
	  var tlp = button.getAttribute('data-bs-tlp')

	  var modalTitle = modalEdit.querySelector('.modal-title')
	  var idInput = modalEdit.querySelector('.modal-body input#id_edit')
	  var kodeInput = modalEdit.querySelector('.modal-body input#kode_edit')
	  var namaInput = modalEdit.querySelector('.modal-body input#nama_edit')
	  var alamatInput = modalEdit.querySelector('.modal-body input#alamat_edit') 
	  var picInput = modalEdit.querySelector('.modal-body input#contact_person_edit') 
	  var tlpInput = modalEdit.querySelector('.modal-body input#tlp_edit') 
	  var kategoriInput = modalEdit.querySelector('.modal-body input#kategori_edit') 
	  var statusSwitch = modalEdit.querySelector('.modal-body input#status_edit')

	  modalTitle.textContent = 'Edit ' + nama
	  idInput.value = id
	  kodeInput.value = kode
	  namaInput.value = nama
	  alamatInput.value = alamat 
	  picInput.value = pic 
	  tlpInput.value = tlp 
	  kategoriInput.value = kategori
	});
	
	var modalHapus = document.getElementById('modalHapus')
	modalHapus.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget

	  var id = button.getAttribute('data-bs-id')
	  var kode = button.getAttribute('data-bs-kode')
	  var nama = button.getAttribute('data-bs-nama')
	  var kategori = button.getAttribute('data-bs-kategori')

	  var modalTitle = modalHapus.querySelector('.modal-title')
	  var idInput = modalHapus.querySelector('.modal-body input#id_delete')
	  var kategoriInput = modalHapus.querySelector('.modal-body input#kategori_delete') 

	  modalTitle.textContent = 'Hapus ' + nama + '?'
	  idInput.value = id
	  kategoriInput.value = kategori
	//   alert(id);
	//   alert(kategori);
	});
	
</script>