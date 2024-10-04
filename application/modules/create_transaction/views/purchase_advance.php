<div class="row mb-3">
	<div class="col bg-info shadow-sm p-3">
		<div class="d-flex align-items-center">
			<span class="text-white">
				<i class="bi bi-receipt"></i> Purchase Advance
			</span>
			<a href="<?php echo base_url();?>" class="btn btn-secondary ms-auto"><i class="bi bi-arrow-bar-left"></i> Back to Home</a>
		</div>
	</div>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="purchaseAdvance-tab" data-bs-toggle="tab" data-bs-target="#purchaseAdvance" type="button" role="tab" aria-controls="purchaseAdvance" aria-selected="true">Purchase Advance Form</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active p-3 bg-white border" id="purchaseAdvance" role="tabpanel" aria-labelledby="purchaseAdvance-tab">
	<form>
		<div class="row g-2">
			<div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
				<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="cash_account" name="cash_account" data-live-search="true" data-size="8" autofocus>
				    <option value="">Cash Account</option>
					<?php
						foreach ($data_akun_setting->result() as $x) {
					?>
						<option value="<?= $x->id_akun?>" data-subtext="<?= $x->acc_no?>" data-token="<?= $x->id_akun?>"><?= $x->description?></option>
					<?php
						}
					?>			
				</select>
			</div> 
            <div class="col-sm-6 col-md-4 col-lg-3" style="min-height:58px;">
				<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="vendor" name="vendor" data-live-search="true" data-size="8" autofocus>
				    <option>Vendor Name</option>
					<?php
						foreach ($data_vendor->result() as $x) {
					?>
						<option value="<?= $x->id_vendor?>" data-subtext="<?= $x->alias?>" data-token="<?= $x->id_vendor?>"><?= $x->vendor?></option>
					<?php
						}
					?>				
				</select>
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<input type="text" id="nilai_value" name="nilai_value" class="form-control h-100 border mod-height-form-floating bg-white shadow-sm" required="" placeholder="Value">
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<input type="text" id="ref_no" name="ref_no" class="form-control h-100 border mod-height-form-floating bg-white shadow-sm" required="" placeholder="Referensi Number">
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="date" class="form-control shadow-sm" id="date" name="date"  placeholder="Date" required="">
					<label for="tgl_input">Date</label>
				</div>
			</div>				
			<div class="col-sm-6 col-md-4 col-lg-3">
				<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="department" name="department" data-live-search="true" data-size="8">
					<option>Department</option>		
					<?php
						foreach ($data_department_hris->result() as $x) {
					?>
						<option value="<?= $x->id?>" data-subtext="<?= $x->dept_code?>" data-token="<?= $x->dept_code?>"><?= $x->dept_name?></option>
					<?php
						}
					?>		
				</select>
			</div>	
			<div class="col-sm-6 col-md-4 col-lg-3">
				<select class="selectpicker form-control h-100 border mod-height-form-floating bg-white shadow-sm" id="project" name="project" data-live-search="true" data-size="8" autofocus>
					<option>Project</option>		
					<?php
						$o=1;
						foreach ($data_project->result() as $x) {
					?>
						<option value="<?= $x->id?>" data-subtext="<?= $x->project_code?>" data-token="<?= $x->id?>"><?= $x->project_code?> <?= $x->Site?></option>
					<?php
							$o++;
						}
					?>		
				</select>
			</div>	
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-floating">
					<input type="text" class="form-control shadow-sm" placeholder="Memo" id="memo" name="memo" required="">
					<label for="">Memo</label>
				</div>
			</div>				
			<div class="col-sm-6 col-md-4 col-lg-3">
				<button type="submit" class="btn btn-primary" id="simpan">Save</button>
			</div>	
		</div>
	</form>
  </div>
  <div class="table-responsive mt-3">
			<table class="table table-striped table-hover table-sm table-bordered" id="data_pa">
				<thead>
					<tr>
						<th>No.</th>
						<th>Cash Account</th> 
						<th>Vendor Name</th> 
						<th>Value</th> 
						<th>Ref Number</th> 
						<th>Date</th> 
						<th>Department</th> 
						<th>Project</th> 
						<th>Memo</th> 
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>  
					<?php					
						$i=1;
						foreach ($data_purchase_advance as $x){
							echo '<tr>
									<td>'.$i.'</td>
									<td>'.$x->account_desc.'</td>
									<td>'.$x->vendor.'</td>
									<td>Rp. '.number_format($x->nilai,0).'</td>
									<td>'.$x->ref_no.'</td>
									<td>'.date('d-m-Y', strtotime($x->tanggal)).'</td>
									<td>'.$x->dept_name.'</td>
									<td>'.$x->Site.'</td>
									<td>'.$x->memo.'</td>
									<td>
										<div class="btn-group btn-group-sm">
											<a href="#modalView" class="btn btn-primary text-white tooltipnya" title="Lihat detail" data-bs-toggle="modal"
												data-bs-id="'.$x->id.'"
												data-bs-cash_account="'.$x->account_desc.'"
												data-bs-vendor="'.$x->vendor.'"
												data-bs-nilai="Rp. '.number_format($x->nilai,0).'"
												data-bs-ref_no="'.$x->ref_no.'"
												data-bs-tanggal="'.date('d-m-Y', strtotime($x->tanggal)).'"
												data-bs-dept_name="'.$x->dept_name.'"
												data-bs-Site="'.$x->Site.'"
												data-bs-memo="'.$x->memo.'"
												data-bs-status="'.$x->status.'"
											>
												<i class="bi bi-eye"></i>
											</a> 
											<a href="#modalEdit" class="btn btn-warning text-white tooltipnya" title="Ubah" data-bs-toggle="modal"
												data-bs-id_purchase_advance="'.$x->id.'"
												data-bs-cash_account="'.$x->account_desc.'"
												data-bs-cash_account_id="'.$x->cash_account.'"
												data-bs-id_vendor ="'.$x->id_vendor.'"
												data-bs-vendor="'.$x->vendor.'"
												data-bs-nilai="'.$x->nilai.'"
												data-bs-ref_no="'.$x->ref_no.'"
												data-bs-tanggal="'.date('d/m/Y', strtotime($x->tanggal)).'"
												data-bs-id_dept="'.$x->id_dept.'"
												data-bs-dept_name="'.$x->dept_name.'"
												data-bs-id_project="'.$x->id_project.'"
												data-bs-Site="'.$x->Site.'"
												data-bs-memo="'.$x->memo.'"
												data-bs-status="'.$x->status.'"
											>
												<i class="bi bi-pencil-square"></i>
											</a>
											
											<a href="#modalHapus" class="btn btn-danger text-white tooltipnya" title="Hapus" data-bs-toggle="modal"
											data-bs-id="'.$x->id.'"
											data-bs-descr="'.$x->account_desc.'"
											data-bs-nilai=Rp. '.number_format($x->nilai,0).'">
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
					<input type="text" class="form-control bg-white" id="cash_account_view" placeholder="Cash Account" readonly>
					<label for="cash_account_view">Cash Account</label>
				</div>
        	</div>			
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control bg-white" id="vendor_view" name="vendor_view" placeholder="Vendor Name">
					<label for="vendor_view">Vendor Name</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control bg-white" id="nilai_view" name="nilai_view" placeholder="Value">
					<label for="nilai_view">Value</label>
				</div>
			</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="ref_number_view" name="ref_number_view" placeholder="Ref. Number" readonly>
					<label for="ref_number_view">Ref. Number</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="tanggal_view" name="tanggal_view" placeholder="Date" readonly>
					<label for="tanggal_view">Date</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="department_view" placeholder="Department" readonly>
					<label for="department_view">Department</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="project_view" placeholder="Project" readonly>
					<label for="project_view">Project</label>
				</div>
        	</div>
        	<div class="col">
        		<div class="form-floating">
					<input type="text" class="form-control bg-white" id="memo_view" placeholder="Memo" readonly>
					<label for="memo_view">Memo</label>
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
     	<form action="<?php echo base_url();?>create_transaction/edit_purchase_advance" method="POST">
	      <div class="modal-body">
			<div class="row row-cols-1 g-2">				
				<div class="col" style="min-height:58px;">	
					<input type="hidden" id="id_purchase_advance" name="id_purchase_advance">			
					<select  class="form-control bg-white" id="cash_account_edit"  name="cash_account_edit">
						<option>-Cash Account-</option>
						<?php
							foreach ($data_akun_setting->result() as $x) {
						?>
							<option value="<?= $x->id_akun?>" data-subtext="<?= $x->acc_no?>" data-token="<?= $x->id_akun?>"><?= $x->description?></option>
						<?php
							}
						?>	
					</select>
				</div>									
				<div class="col" style="min-height:58px;">				
					<select  class="form-control bg-white" id="vendor_edit"  name="vendor_edit">
						<option>Vendor Name</option>
						<?php
							foreach ($data_vendor->result() as $x) {
						?>
							<option value="<?= $x->id_vendor?>" data-subtext="<?= $x->alias?>" data-token="<?= $x->id_vendor?>"><?= $x->vendor?></option>
						<?php
							}
						?>	
					</select>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="text" class="form-control bg-white" id="nilai_edit" name="nilai_edit" placeholder="Value">
						<label for="nilai_edit">Value</label>
					</div>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="text" class="form-control bg-white" id="ref_number_edit" name="ref_number_edit" placeholder="Ref. Number">
						<label for="ref_number_edit">Ref. Number</label>
					</div>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="date" class="form-control bg-white datepicker" id="tanggal_edit" name="tanggal_edit" placeholder="Date" >
						<label for="tanggal_edit">Date</label>
					</div>
				</div>			
				<div class="col" style="min-height:58px;">				
					<select  class="form-control bg-white" id="department_edit"  name="department_edit">
						<option>Department</option>		
						<?php
							foreach ($data_department_hris->result() as $x) {
						?>
							<option value="<?= $x->id?>" data-subtext="<?= $x->dept_code?>" data-token="<?= $x->dept_code?>"><?= $x->dept_name?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="col" style="min-height:58px;">				
					<select  class="form-control bg-white" id="project_edit"  name="project_edit">
						<option>Project</option>		
						<?php
							$o=1;
							foreach ($data_project->result() as $x) {
						?>
							<option value="<?= $x->id?>" data-subtext="<?= $x->project_code?>" data-token="<?= $x->id?>"><?= $x->project_code?> <?= $x->Site?></option>
						<?php
								$o++;
							}
						?>
					</select>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="text" class="form-control bg-white" id="memo_edit" name="memo_edit" placeholder="Memo">
						<label for="memo_edit">Memo</label>
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
	        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
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
     	<form action="<?php echo base_url();?>create_transaction/delete_purchase_advance" method="POST">
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
		$('#data_pa').DataTable();
		
		var modalView = document.getElementById('modalView')
		modalView.addEventListener('show.bs.modal', function (event) {
			var button = event.relatedTarget

			var id = button.getAttribute('data-bs-id')
			var cash_account = button.getAttribute('data-bs-cash_account')
			var vendor = button.getAttribute('data-bs-vendor')
			var nilai = button.getAttribute('data-bs-nilai')
			var ref_no = button.getAttribute('data-bs-ref_no')
			var tanggal = button.getAttribute('data-bs-tanggal')
			var dept_name = button.getAttribute('data-bs-dept_name')
			var Site = button.getAttribute('data-bs-Site')
			var memo = button.getAttribute('data-bs-memo')
			var status = button.getAttribute('data-bs-status')

			var modalTitle = modalView.querySelector('.modal-title')
			var cash_accountInput = modalView.querySelector('.modal-body input#cash_account_view')
			var vendorInput = modalView.querySelector('.modal-body input#vendor_view')
			var nilaiInput = modalView.querySelector('.modal-body input#nilai_view')
			var ref_noInput = modalView.querySelector('.modal-body input#ref_number_view')
			var tanggalInput = modalView.querySelector('.modal-body input#tanggal_view')
			var dept_nameInput = modalView.querySelector('.modal-body input#department_view')
			var SiteInput = modalView.querySelector('.modal-body input#project_view')
			var memoInput = modalView.querySelector('.modal-body input#memo_view')
			var statusSwitch = modalView.querySelector('.modal-body input#status')

			modalTitle.textContent = 'Detail ' + cash_account
			cash_accountInput.value = cash_account
			vendorInput.value = vendor
			nilaiInput.value = nilai
			ref_noInput.value = ref_no
			tanggalInput.value = tanggal
			dept_nameInput.value = dept_name
			SiteInput.value = Site
			memoInput.value = memo

			if (status=='aktif') {
				$('#status').attr('checked', true);
					$('label[for="status"]').html('Active');
			}
			if (status=='nonaktif') {
				$('#status').attr('checked', false);
				$('label[for="status"]').html('Non-Active');
			}
		});


		var modalEdit = document.getElementById('modalEdit')
		modalEdit.addEventListener('show.bs.modal', function (event) {
			var button = event.relatedTarget

			var id_purchase_advance = button.getAttribute('data-bs-id_purchase_advance')
			var cash_account = button.getAttribute('data-bs-cash_account')
			var cash_account_id = button.getAttribute('data-bs-cash_account_id')			
			var id_vendor = button.getAttribute('data-bs-id_vendor')		
			var vendor = button.getAttribute('data-bs-vendor')
			var nilai = button.getAttribute('data-bs-nilai')
			var ref_no = button.getAttribute('data-bs-ref_no')
			var tanggal = button.getAttribute('data-bs-tanggal')
			var id_dept = button.getAttribute('data-bs-id_dept')
			var dept_name = button.getAttribute('data-bs-dept_name')
			var id_project = button.getAttribute('data-bs-id_project')
			var Site = button.getAttribute('data-bs-Site')
			var memo = button.getAttribute('data-bs-memo')
			var status = button.getAttribute('data-bs-status')
			
			document.getElementById("id_purchase_advance").value = id_purchase_advance;
			document.getElementById("cash_account_edit").value = cash_account_id;
			document.getElementById("vendor_edit").value = id_vendor;
			document.getElementById("department_edit").value = id_dept;
			document.getElementById("project_edit").value = id_project;			
			document.getElementById("nilai_edit").value = nilai;
			document.getElementById("ref_number_edit").value = ref_no;
			document.getElementById("tanggal_edit").value = tanggal;
			document.getElementById("memo_edit").value = memo;
			
			var modalTitle = modalEdit.querySelector('.modal-title')	
			var statusSwitch = modalEdit.querySelector('.modal-body input#status')

			modalTitle.textContent = 'Detail ' + cash_account
			cash_accountInput.value = cash_account
			nilaiInput.value = nilai
			ref_noInput.value = ref_no
			tanggalInput.value = tanggal
			SiteInput.value = Site
			memoInput.value = memo

			if (status=='aktif') {
				$('#status').attr('checked', true);
					$('label[for="status"]').html('Active');
			}
			if (status=='nonaktif') {
				$('#status').attr('checked', false);
				$('label[for="status"]').html('Non-Active');
			}
		});

		var modalHapus = document.getElementById('modalHapus')
		modalHapus.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget

		var id = button.getAttribute('data-bs-id')
		var nama = button.getAttribute('data-bs-descr')

		var modalTitle = modalHapus.querySelector('.modal-title')
		var idInput = modalHapus.querySelector('.modal-body input#id_delete')

		modalTitle.textContent = 'Hapus ' + nama + '?'
		idInput.value = id
		});
	});
	$('#simpan').click(function(){
		var cash_account=$('#cash_account').val();
		var vendor=$('#vendor').val();
		var nilai=$('#nilai_value').val();
		var ref_no=$('#ref_no').val();
		var tanggal=$('#date').val();
		var department=$('#department').val();
		var project=$('#project').val();
		var memo=$('#memo').val();
		if(cash_account=='' || vendor==''){
			alert('mohon diisi lengkap');
		}else{
			$.ajax({
					url: '<?php echo base_url();?>create_transaction/save_purchase_advance',
					dataType: 'json',
					type: 'POST', 
					data: {cash_account:cash_account, 
							vendor:vendor,
							nilai:nilai,
							ref_no:ref_no,
							tanggal:tanggal,
							department:department,
							project:project, 
							memo:memo},
						success: function (response){
						}   
					});
				
			Swal.fire({
				icon: 'success',
				title: 'Success!',
				html: 'Data is submitted successfully',
				showConfirmButton: false,
				timer: 1500
			}).then((result) => {
				if (result.dismiss === Swal.DismissReason.timer) {
				window.location="<?= base_url('create_transaction/purchase_advance')?>";
				}
			});
			return false;
		}
	});
	
</script>