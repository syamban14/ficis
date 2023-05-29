<div class="card mb-3">
	<div class="card-body bg-white shadow-sm">
		<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
			<small class="text-muted">You are here:</small>
			<ol class="breadcrumb mb-0">
				<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">Customers</li>
			</ol>
		</nav>
	</div>
</div>
<div class="card shadow-sm">
	<div class="card-body">
		<a href="#modalAddCustomers" class="btn btn-primary mb-3" data-bs-toggle="modal">+ Add New Customer</a>
		<div class="table-responsive">
			<table id="dataCustomers" class="table table-striped table-hover table-sm" style="width:100%">
		        <thead>
		            <tr>
		                <th>ID</th>
		                <th>Nama Customer</th>
		                <th>Kode Customer</th> 
		                <th>Email</th>
		                <th>Password</th>
		                <th>Alamat</th>
		                <th>No Telepon</th>
		                <th>PIC</th>
		                <th>No HP</th>
		                <th>Keterangan</th>
		                <th>Start Date</th>
		                <th>Due Date</th>
		                <th>Option</th>
		            </tr>
		        </thead>
		        <tbody>
					<?php
						foreach($master_customer as $dc)
						{
							echo'
								<tr>
									<td>'.$dc->id_kustomer.'</td> 
									<td>'.$dc->nama_kustomer.'</td>
									<td>'.$dc->kode_kustomer.'</td> 
									<td>'.$dc->email.'</td>
									<td>'.$dc->password.'</td>
									<td>'.$dc->alamat.'</td>
									<td>'.$dc->no_telepon.'</td>
									<td>'.$dc->pic.'</td>
									<td>'.$dc->no_hp.'</td>
									<td>'.$dc->keterangan.'</td>
									<td>'.date('d-m-Y',strtotime($dc->start_date)).'</td>
									<td>'.date('d-m-Y',strtotime($dc->due_date)).'</td>
									<td> <center>
											<div class="btn-group">
												<a href="'.base_url().'customers/edit_kustomer/'.$dc->id_kustomer.'" title="Edit" class="btn btn-sm btn-info text-white"><i class="fas fa-edit fa-fw"></i></a></a>
												<a href="'.base_url().'customers/delete_kustomer/'.$dc->id_kustomer.'" title="Remove" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt fa-fw"></i></a>
											</div>
										</center>
									</td>
								</tr>';
						}
					?> 
		             
		        </tbody>
		    </table>
		</div>
	</div>
</div>
<div class="modal fade" id="modalAddCustomers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					+ Add new customer
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
				<div class="modal-body">
					<div class="row g-2">
						<div class="col-md-6">
							<div class="form-floating">
								<input type="text" class="form-control" id="cust_name" placeholder="Customer Name">
								<label for="cust_name">Customer Name</label>
							</div>
						</div>
						<div class="col-md-6">   
							<select class="selectpicker form-control" data-actions-box="true" data-live-search="true" id="wh_designated" name="wh_designated" data-size="8" data-show-subtext="true" multiple data-selected-text-format="count > 8" required onchange="removeBorder();">
						  		<?php
									foreach($master_lokasi as $x){ ?> 
										<option data-tokens="<?php echo $x->nama_lokasi;?>" data-subtext="" class="animated--grow-in"><?php echo $x->nama_lokasi;?></option>
								<?php
									}
								?> 
							</select>
						</div>
						<div class="col-md-6">
							<div class="form-floating">
								<input type="email" class="form-control" id="email" placeholder="Email">
								<label for="email">Email</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating"> 
								<input type="text" class="form-control" id="customer_code" placeholder="Email" readonly="">
								<label for="customer_code">Login ID/Customer Code</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating">
								<input type="password" class="form-control" id="password" placeholder="password">
								<label for="password">Password</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating"> 
								<input type="text" class="form-control" id="telepon" placeholder="telepon">
								<label for="Telepon">Telepon</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating"> 
								<input type="text" class="form-control" id="pic" placeholder="pic">
								<label for="pic">PIC</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating"> 
								<input type="text" class="form-control" id="no_hp" placeholder="no Hp">
								<label for="keterangan">No HP</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating"> 
								<textarea class="form-control"  id="alamat"  placeholder="Alamat"></textarea>
								<label for="alamat">Alamat</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating"> 
								<textarea class="form-control"  id="keterangan"  placeholder="Keterangan"></textarea>
								<label for="keterangan">Keterangan</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating"> 
								<input type="text" class="form-control" id="start_date" placeholder="Start Date"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating"> 
								<input type="text" class="form-control" id="due_date" placeholder="Due Date"> 
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" id="save" class="btn btn-primary">Save</button>
				</div> 
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#dataCustomers').DataTable();

		$('#start_date').datepicker({ 
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome', 
			maxDate: function () {
                return $('#due_date').val();
            } 
        });
		
		$('#due_date').datepicker({ 
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: function () {
                return $('#start_date').val();
            } 
        });

		$('#cust_name').click(function(){
			alert('hi');
		}); 
		$('#cust_name').change(function(){ 
			var str = $('#cust_name').val();
			alert(str);
			var matches = str.match(/\b(\w)/g); // ['J','S','O','N']
			var acronym = matches.join(''); // JSON 

			$('#customer_code').val(acronym);
		});
		$('#save').click(function(){
			var id_kustomer=0;
			var cust_name=$('#cust_name').val();
			var wh_designated=$('#wh_designated').val();
			var email=$('#email').val();
			var customer_code=$('#customer_code').val();
			var password=$('#password').val();
			var telepon=$('#telepon').val(); 
			var pic=$('#pic').val(); 
			var no_hp=$('#no_hp').val(); 
			var alamat=$('#alamat').val(); 
			var keterangan=$('#keterangan').val(); 
			var start_date=$('#start_date').val(); 
			var due_date=$('#due_date').val(); 
			var statt='insert'; 

			if (cust_name==''){
                alert('Nama Kustomer harus diisi !!!'); 
            }else{
    	        $.ajax({
					url: '<?php echo base_url();?>customers/save_customer',
					dataType: 'json',
					type: 'POST',
					data: {statt:statt, id_kustomer:id_kustomer, cust_name:cust_name,wh_designated:wh_designated, email : email, customer_code : customer_code, password:password, keterangan:keterangan, telepon:telepon, pic:pic, no_hp:no_hp, alamat:alamat, start_date:start_date, due_date:due_date},
					success: function (result){\
						alert(result);
						if(result == true){
							alert("data telah disimpan");
							// location.reload(); 
						}else{
							alert("Gagal");
						}  
					}
   			   });   
            }  
		});
	});
</script>