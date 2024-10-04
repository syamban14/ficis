<div class="row justify-content-center">
	<div class="col-xl-6 col-lg-8">
		<div class="card bg-white">
			<div class="card-header bg-transparent p-0">
				<div class="row g-0">
					<div class="col">
						<div class="form-floating">
						  <input type="date" class="form-control" id="start_date">
						  <label for="start_date">Start Date</label>
						</div>
					</div>
					<div class="col">
						<div class="form-floating">
						  <input type="date" class="form-control" id="end_date">
						  <label for="end_date">End Date</label>
						</div>
					</div>
					<!-- <div class="col border-end border-start">
						<div class="p-3 text-center">Expenses (AP)</div>
					</div>
					<div class="col">
						<div class="p-3 text-center">Transfer</div>
					</div> -->
				</div>
			</div>
			<div class="card-body d-flex align-items-center justify-content-center" style="height:400px;">
				<h1 class="mb-0" id="numberDisplay">Rp ********</h1>
			</div>
			<div class="card-footer bg-transparent p-0 overflow-hidden">
				<div class="row g-0">
					<div class="col-6 col-sm-4">
						<div class="form-group border">
						  <select class="selectpicker form-control form-control-lg" id="bank" data-container="body" data-live-search="true" data-size="10">
					    	<option selected>- Select Bank -</option>
					    	<?php
					    		foreach ($data_bank->result() as $x) {
					    	?>
						    	<option value="<?= $x->id;?>"><?= $x->bank_name;?></option>
					    	<?php
					    		}
					    	?>
						  </select>
						</div>
					</div>
					<div class="col-6 col-sm-4">
						<div class="form-group border">
						  <select class="selectpicker form-control form-control-lg" id="category" data-container="body" data-live-search="true" data-size="10">
					    	<option selected>- Select Category -</option>
					    	<?php
					    		foreach ($data_project->result() as $x) {
					    	?>
						    	<option value="<?= $x->id;?>"><?= $x->project_code;?> | <?= $x->project;?></option>
					    	<?php
					    		}
					    	?>
						  </select>
						</div>
					</div>
					<div class="col-6 col-sm-4">
						<div class="form-group border">
						  <select class="selectpicker form-control form-control-lg" id="account" data-container="body" data-live-search="true" data-size="10">
					    	<option selected>- Select Account -</option>
					    	<?php
					    		foreach ($data_akun->result() as $x) {
					    	?>
						    	<option value="<?= $x->id;?>"><?= $x->description;?></option>
					    	<?php
					    		}
					    	?>
						  </select>
						</div>
					</div>
					<div class="col-6 col-sm-12">
						<div class="d-grid">
						  <button class="btn btn-primary btn-lg rounded-0" id="submitButton">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	const submitButton = document.getElementById('submitButton');
	const numberDisplay = document.getElementById('numberDisplay');

	submitButton.addEventListener('click', startAnimation);
	function generateRandomNumber() {
	    return Math.floor(Math.random() * 10000000); // Angka acak 7 digit
	}

	function startAnimation() {
	    numberDisplay.classList.remove('animate__animated', 'animate__tada');
	    const targetNumber = generateRandomNumber();
	    const animationDuration = 1000; // Durasi animasi dalam milidetik
	    const steps = 50; // Jumlah langkah animasi

	    const currentNumber = 0;
	    const increment = targetNumber / steps;
	    let step = 0;

	    const numberFormatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }); // Ganti 'id-ID' dengan kode bahasa dan negara yang sesuai

	    const interval = setInterval(() => {
	        const displayNumber = Math.round(currentNumber + step * increment);
	        const formattedNumber = numberFormatter.format(displayNumber); // Format angka tanpa simbol mata uang
	        numberDisplay.innerText = formattedNumber;
	        step++;

	        if (step >= steps) {
	            const finalFormattedNumber = numberFormatter.format(targetNumber);
	            numberDisplay.innerText = finalFormattedNumber; // Memastikan tampilan akhir benar
	            // numberDisplay.innerText = 'Rp 9.999.999'; // Memastikan tampilan akhir benar
	            clearInterval(interval);
				numberDisplay.classList.add('animate__animated', 'animate__tada');
	        }
	    }, animationDuration / steps);
	}
</script>