 <br/>  
 	<?php 
 		foreach($kustomer as $d){
			$id_kustomer=$d->id_kustomer;
			$nama_kustomer=$d->nama_kustomer;
			$kode_kustomer=$d->kode_kustomer; 
			$email=$d->email;
			$password=$d->password;
			$keterangan=$d->keterangan;
			$alamat=$d->alamat;
			$no_telepon=$d->no_telepon;
			$pic=$d->pic;
			$no_hp=$d->no_hp;
			$start_date=$d->start_date;
			$due_date=$d->due_date;
		} 
	?>
	<div class="modal-body">
		<div class="row g-2">
			<div class="col-md-6">
				<div class="form-floating">
					<input type="hidden" class="form-control" id="id_kustomer" value="<?php echo $id_kustomer; ?>" >
					<input type="text" class="form-control" id="cust_name" value="<?php echo $nama_kustomer; ?>" placeholder="Customer Name">
					<label for="cust_name">Customer Name</label>
				</div>
			</div> 
			<div class="col-md-6"> 
				<div class="form-floating">
				<select class="selectpicker form-control" data-actions-box="true" data-live-search="true" id="wh_designated" name="wh_designated" data-size="8" data-show-subtext="true" multiple data-selected-text-format="count > 8"  >
						<?php 
							$wh_design=$this->Customers_m->data_lokasi_edit($kode_kustomer);
							foreach($wh_design as $x){
								echo '<option value="'.$x->wh_designated.'" selected>'.$x->wh_designated.'</option>';
							}  
							$master_lokasi=$this->Customers_m->data_lokasi_edit2();
							foreach($master_lokasi as $x){   
								echo '<option value="'.$x->nama_lokasi.'">'.$x->nama_lokasi.'</option>';
						
							}
						?> 
					</select> 
				</div>	
			</div>
			<div class="col-md-6">
				<div class="form-floating">
					<input type="email" class="form-control" id="email" value="<?php echo $email; ?>" placeholder="Email">
					<label for="email">Email</label>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-floating"> 
					<input type="text" class="form-control" id="customer_code" value="<?php echo $kode_kustomer; ?>" placeholder="Email" readonly="">
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
					<input type="text" class="form-control" id="telepon" placeholder="telepon" value="<?php echo $no_telepon; ?>">
					<label for="Telepon">Telepon</label>
				</div>
			</div> 
			
			<div class="col-md-6">
				<div class="form-floating"> 
					<input type="text" class="form-control" id="pic" placeholder="pic"  value="<?php echo $pic; ?>">
					<label for="pic">PIC</label>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-floating"> 
					<input type="text" class="form-control" id="no_hp" placeholder="no Hp"  value="<?php echo $no_hp; ?>">
					<label for="keterangan">No HP</label>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-floating"> 
					<textarea class="form-control"  id="alamat"  placeholder="Alamat"><?php echo $alamat; ?></textarea>
					<label for="alamat">Alamat</label>
				</div>
			</div> 
			<div class="col-md-6">
				<div class="form-floating"> 
					<textarea class="form-control"  id="keterangan"  placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
					<label for="keterangan">Keterangan</label>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-floating"> 
					<input type="date" class="form-control" id="start_date" placeholder="Start Date" value="<?php echo $start_date; ?>"> 
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-floating"> 
					<input type="date" class="form-control" id="due_date" placeholder="Due Date"  value="<?php echo $due_date; ?>"> 
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="<?php echo base_url();?>customers" class="btn btn-secondary" title="Kembali">Back </a>
		<button type="submit" id="update" class="btn btn-primary">Update</button>
	</div> 
<script type="text/javascript">
	$(document).ready(function() {  
		$('#cust_name').change(function(){ 
			var str = $('#cust_name').val();
			var matches = str.match(/\b(\w)/g); // ['J','S','O','N']
			var acronym = matches.join(''); // JSON 

			$.ajax({
					url: '<?php echo base_url();?>customers/cek_name',
					dataType: 'json',
					type: 'POST',
					data: {acronym:acronym},
					success: function (result){ 
						if(result==0){
							$('#customer_code').val(acronym);
						}else{
							$('#customer_code').val(acronym+2);
						}
					}
   			}); 
		});

		$('#update').click(function(){
			var id_kustomer=$('#id_kustomer').val();
			var cust_name=$('#cust_name').val();
			var wh_designated=$('#wh_designated').val();
			var email=$('#email').val();
			var customer_code=$('#customer_code').val();
			var password=$('#password').val();
			var keterangan=$('#keterangan').val(); 
			var alamat=$('#alamat').val(); 

			var telepon=$('#telepon').val(); 
			var pic=$('#pic').val(); 
			var no_hp=$('#no_hp').val(); 
			var start_date=$('#start_date').val(); 
			var due_date=$('#due_date').val();  
			var statt='edit';

			if (cust_name==''){
                alert('Nama Kustomer harus diisi !!!'); 
			}else if (email==''){
               alert('Email harus diisi !!!'); 
            }else if (pic==''){
               alert('pic harus diisi !!!'); 
            }else if (start_date==''){
               alert('start date harus diisi !!!'); 
            }else if (due_date==''){
               alert('due date harus diisi !!!'); 
            }else{
    	        $.ajax({
					url: '<?php echo base_url();?>customers/save_customer',
					dataType: 'json',
					type: 'POST',
					data: {statt:statt, id_kustomer:id_kustomer, cust_name:cust_name,wh_designated:wh_designated, email : email, customer_code : customer_code, password:password, keterangan:keterangan, alamat:alamat, telepon:telepon, pic:pic, no_hp:no_hp,start_date:start_date, due_date:due_date},
					success: function (result){
						if(result == true){
							alert("data telah diupdate");
							location.replace("../../customers"); 
						}else{
							alert("Gagal");
						}  
					}
   			   });   
            }  
		});
 
	});
</script>