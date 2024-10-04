<div class="row gx-3">
	<div class="col-md-4 d-none d-lg-block">
		<div class="d-grid">
			<a href="<?php echo base_url('create_transaction');?>" class="text-white btn btn-warning btn-lg d-flex align-items-center py-4 mb-3 shadow-sm">
          <span>Create Transaction</span>
          <span class="ms-auto h3 mb-0"><i class="bi bi-dash-square"></i></span>
			</a>
			<a href="<?php echo base_url();?>reports" class="text-white btn btn-info btn-lg d-flex align-items-center py-4 mb-3 shadow-sm">
          <span>View Reports</span>
          <span class="ms-auto h3 mb-0"><i class="bi bi-file-earmark-bar-graph"></i></span>
			</a>
			<a href="" class="text-white btn btn-success btn-lg d-flex align-items-center py-4 mb-3 shadow-sm">
          <span>Input Income Payment</span>
          <span class="ms-auto h3 mb-0"><i class="bi bi-plus-square"></i></span>
			</a>
			<a href="" class="text-white btn btn-danger btn-lg d-flex align-items-center py-4 mb-3 shadow-sm">
          <span>Transfer Money / Mutation</span>
          <span class="ms-auto h3 mb-0"><i class="bi bi-arrow-left-right"></i></span>
			</a>
			<a href="" class="text-white btn btn-info btn-lg d-flex align-items-center py-4 mb-3 shadow-sm">
          <span>Attach & Input Invoice Database</span>
          <span class="ms-auto h3 mb-0"><i class="bi bi-paperclip"></i></span>
			</a>
			<?php
				if ($this->session->userdata('role')=='1') {
			?>
				<a href="<?php echo base_url();?>master_data" class="text-white btn btn-primary btn-lg d-flex align-items-center py-4 mb-3 shadow-sm">
	          <span>Master Data</span>
	          <span class="ms-auto h3 mb-0"><i class="bi bi-list-ul"></i></span>
				</a>
			<?php
				}
			?>
		</div>
	</div>
	<div class="col-md-12 col-lg-8">
		<div class="card shadow-sm mb-3">
			<div class="card-header bg-primary text-white">
				<div class="d-flex align-items-center">
					<h6 class="mb-0">Transaction</h6>
					<!-- <input type="text" id="search" class="form-control ms-auto w-50" placeholder="Search here..."> -->
				</div>
			</div>
			<div class="card-body">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" id="ar-tab" data-toggle="tab" href="#transaction-ar">Account Receivable</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="ap-tab" data-toggle="tab" href="#transaction-ap">Account Payable</a>
					</li>
				</ul>
				<div class="tab-content mt-2">
					<div class="tab-pane fade show active" id="transaction-ar">
						<div class="table-responsive small">
							<table id="dataInvoicePenjualan" class="table table-striped table-hover table-sm table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>No Invoice</th>
										<th>Kustomer</th>
										<th>Keterangan</th>
										<th>Alasan</th>
										<th>Diubah oleh</th>
										<th>status</th>
										<th>Option</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=0;
										foreach($dataInv->result() AS $y){
											$no++;
											$status_txt='';
											if($y->statusnya=='0'){$status_txt='<span class="badge bg-secondary p-2"><i class="bi bi-pencil-square"></i> Draft</span>';}
											if($y->statusnya=='1'){$status_txt='<span class="badge bg-primary p-2"><i class="bi bi-send"></i> Post</span>';}
											if($y->statusnya=='2'){$status_txt='<span class="badge bg-success p-2"><i class="bi bi-check-circle"></i> Close</span>';}
											if($y->statusnya=='3'){$status_txt='<span class="badge bg-danger p-2"><i class="bi bi-x-circle"></i> Deleted</span>';}
									?>
										<tr>
											<td><?= $no;?></td>
											<td>
												<a href="#detailInvoice" class="tooltips" title="Click to detail" data-bs-toggle="modal" data-bs-noinv="<?= $y->no_inv;?>"><?= $y->no_inv;?></a>
											</td>
											<td><?= $y->nama_kustomer;?></td>
											<td><?= $y->remark;?></td>
											<td><?= $y->alasan;?></td>
											<td><?= $y->modify_user;?></td>
											<td><?= $status_txt;?></td>
											<td>
												<?php
													if ($y->statusnya!='3'){
												?>
													<div class="dropdown dropstart">
														<span class="badge bg-secondary dropdown-toggle p-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
															Action
														</span>
														<ul class="dropdown-menu py-0" aria-labelledby="dropdownMenuButton1">
															<li>
																<a class="dropdown-item small" href="<?=base_url();?>create_transaction/edit_transaction/<?=$y->id_tr;?>">
																	<i class="bi bi-pencil-square"></i> Edit
																</a>
															</li>
															<li>
																<a class="dropdown-item small" href="#modalDelete" data-bs-toggle="modal"
																data-bs-nomor="<?= $y->nomor;?>" data-bs-nomorinv="<?= $y->no_inv;?>">
																	<i class="bi bi-x-circle text-danger"></i> Delete
																</a>
															</li>
															<li>
																<a class="dropdown-item small" href="#modalPrint" data-bs-toggle="modal"
																data-bs-nomor="<?= $y->nomor;?>" data-bs-nomorinv="<?= $y->no_inv;?>">
																	<i class="bi bi-printer"></i> Print
																</a>
															</li>
														</ul>
													</div>
												<?php
													}
												?>
											</td>
										</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="transaction-ap">
						<div class="table-responsive small">
							<table id="dataPayable" class="table table-striped table-hover table-sm table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Purchase Number</th>
										<th>Vendor</th>
										<th>PO Number</th>
										<th>Invoice Date</th>
										<th>Down Payment</th>
										<th>Diubah oleh</th>
										<th>status</th>
										<th>Option</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=0;
										foreach($dataAp->result() AS $y){
											$no++;
											$status_txt='';
											if($y->statusnya=='0'){$status_txt='<span class="badge bg-secondary p-2"><i class="bi bi-pencil-square"></i> Draft</span>';}
											if($y->statusnya=='1'){$status_txt='<span class="badge bg-primary p-2"><i class="bi bi-send"></i> Post</span>';}
											if($y->statusnya=='2'){$status_txt='<span class="badge bg-success p-2"><i class="bi bi-check-circle"></i> Close</span>';}
											if($y->statusnya=='3'){$status_txt='<span class="badge bg-danger p-2"><i class="bi bi-x-circle"></i> Deleted</span>';}
									?>
										<tr>
											<td><?= $no;?></td>
											<td>
												<a href="#detailPurchase" class="tooltips" title="Click to detail" data-bs-toggle="modal" data-bs-pnno="<?= $y->purchase_number;?>"><?= $y->purchase_number;?></a>
											</td>
											<td><?= $y->vendor_name;?></td>
											<td><?= $y->po_no;?></td>
											<td><?= date('d-m-Y',strtotime($y->invoice_date));?></td>
											<td>Rp. <?= number_format($y->dp,0);?></td>
											<td><?= $y->modify_user;?></td>
											<td><?= $status_txt;?></td>
											<td>
												<?php
													if ($y->statusnya!='3'){
												?>
													<div class="dropdown dropstart">
														<span class="badge bg-secondary no-arrow dropdown-toggle p-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
															Action
														</span>
														<ul class="dropdown-menu py-0" aria-labelledby="dropdownMenuButton1">
															<li>
																<a class="dropdown-item small" href="<?=base_url();?>create_transaction/edit_transaction_ap/<?=$y->id_ap;?>">
																	<i class="bi bi-pencil-square"></i> Edit
																</a>
															</li>
															<li>
																<a class="dropdown-item small" href="#modalApDelete" data-bs-toggle="modal"
																data-bs-purchasenumber="<?= $y->purchase_number;?>" data-bs-nomorpo="<?= $y->po_no;?>">
																	<i class="bi bi-x-circle text-danger"></i> Delete
																</a>
															</li>
															<li>
																<a class="dropdown-item small" href="#modalApPrint" data-bs-toggle="modal"
																data-bs-purchasenumber="<?= $y->purchase_number;?>" data-bs-nomorpo="<?= $y->po_no;?>">
																	<i class="bi bi-printer"></i> Print
																</a>
															</li>
														</ul>
													</div>
												<?php
													}
												?>
											</td>
										</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row g-3">
			<div class="col-lg-6">
				<div class="card shadow-sm mb-3">
					<div class="card-header bg-primary text-white">
						<div class="d-flex align-items-center">
							<h6 class="mb-0">Transaction History</h6>
							<input type="text" id="search2" class="form-control form-control-sm ms-auto w-50" placeholder="Search here...">
						</div>
					</div>
					<div class="card-body mb-3" style="min-height:200px;max-height:200px;overflow-y:scroll;">
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  Data history terbatas hanya untuk 10 data transaksi terakhir.
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
							if ($dataHistory->num_rows() > 0) {
						?>
								<ol class="trans-history mb-0 ps-3 small">
						<?php
								foreach ($dataHistory->result() as $dh) {
						?>
									<li><?= $dh->keterangan;?>. <em><?= $dh->create_date;?></em></li>
						<?php
								}
						?>
								</ol>
						<?php
							}else{
						?>
								<em>No data available.</em>
						<?php
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card shadow-sm">
					<div class="card-header bg-info text-white">
						<div class="d-flex align-items-center">
							<h6 class="mb-0">Permohonan Dana dari BES</h6>
							<input type="text" id="search3" class="form-control form-control-sm ms-auto w-50" placeholder="Search here...">
						</div>
					</div>
					<div class="card-body mb-3" style="min-height:200px;max-height:200px;overflow-y:scroll;">
						<!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
						  Data history terbatas hanya untuk 10 data transaksi terakhir.
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div> -->
						<?php
							if ($dataHistory->num_rows() > 0) {
						?>
								<ol class="bes-history mb-0 ps-3">
						<?php
								foreach ($dataHistory->result() as $dh) {
						?>
									<li><?= $dh->keterangan;?></li>
						<?php
								}
						?>
								</ol>
						<?php
							}else{
						?>
								<em>No data available.</em>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="menu-staff d-block d-lg-none">
	<a class="btn-floating-menu">
		<i class="bi bi-window-stack"></i>
	</a>
	<div class="floating-menu-list d-grid">
		<a href="<?php echo base_url($link);?>" class="btn-floating-menu-list create-transaction text-decoration-none ms-3">
			<div class="d-flex align-items-center justify-content-end">
				<span class="text-dark border rounded p-1 border-secondary bg-white">Create Transaction</span>
				<span class="ms-2 icon-floating-menu-list bg-warning"><i class="bi bi-dash-square"></i></span>
			</div>
		</a>
		<a href="<?php echo base_url();?>reports" class="btn-floating-menu-list income text-decoration-none ms-3">
			<div class="d-flex align-items-center justify-content-end">
				<span class="text-dark border rounded p-1 border-secondary bg-white">View Report</span>
				<span class="ms-2 icon-floating-menu-list bg-success"><i class="bi bi-file-earmark-bar-graph"></i></span>
			</div>
		</a>
		<a href="" class="btn-floating-menu-list income text-decoration-none ms-3">
			<div class="d-flex align-items-center justify-content-end">
				<span class="text-dark border rounded p-1 border-secondary bg-white">Input Income Payment</span>
				<span class="ms-2 icon-floating-menu-list bg-success"><i class="bi bi-plus-square"></i></span>
			</div>
		</a>
		<a href="" class="btn-floating-menu-list transfer text-decoration-none ms-3">
			<div class="d-flex align-items-center justify-content-end">
				<span class="text-dark border rounded p-1 border-secondary bg-white">Transfer Money / Mutation</span>
				<span class="ms-2 icon-floating-menu-list bg-danger"><i class="bi bi-arrow-left-right"></i></span>
			</div>
		</a>
		<a href="" class="btn-floating-menu-list Attach text-decoration-none ms-3">
			<div class="d-flex align-items-center justify-content-end">
				<span class="text-dark border rounded p-1 border-secondary bg-white">Attact & Input Invoice Database</span>
				<span class="ms-2 icon-floating-menu-list bg-info"><i class="bi bi-paperclip"></i></span>
			</div>
		</a>
		<?php
			if ($this->session->userdata('role')=='1') {
		?>
		<a href="<?= base_url();?>master_data" class="btn-floating-menu-list master-data text-decoration-none ms-3">
			<div class="d-flex align-items-center justify-content-end">
				<span class="text-dark border rounded p-1 border-secondary bg-white">Master Data</span>
				<span class="ms-2 icon-floating-menu-list bg-primary"><i class="bi bi-list-ul"></i></span>
			</div>
		</a>
		<?php
			}
		?>
	</div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nomorinvnya">No. Invoice</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url();?>home/deleteInvPenjualan" method="POST">
	      <div class="modal-body">
	          <input type="hidden" name="nomor" id="nomor">
	          <div class="alert alert-danger mb-0"><i class="bi bi-exclamation-triangle"></i> Apakah kamu yakin ingin menghapus data ini?</div>
	          <div class="form-floating mt-3">
						  <input type="text" class="form-control" id="alasan" name="alasan" placeholder="Alasan" required>
						  <label for="alasan">Alasan</label>
						</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
	        <button type="submit" class="btn btn-danger">Yes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalApDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="purchase_number">Purchase Number</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url();?>home/deletePurchase" method="POST">
	      <div class="modal-body">
				<input type="hidden" name="nomorpo" id="nomorpo">
				<div class="alert alert-danger mb-0"><i class="bi bi-exclamation-triangle"></i> Apakah kamu yakin ingin menghapus data ini?</div>
				<div class="form-floating mt-3">
					<input type="text" class="form-control" id="alasanap" name="alasanap" placeholder="Alasan" required>
					<label for="alasan">Alasan</label>
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
	        <button type="submit" class="btn btn-danger">Yes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nomorinvnyaPost">No. Invoice</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url();?>home/postInvPenjualan" method="POST">
	      <div class="modal-body">
	          <input type="hidden" name="nomorPost" id="nomorPost">
	          <div class="alert alert-info mb-0"><i class="bi bi-exclamation-triangle"></i> Do you want to posting this data?</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
	        <button type="submit" class="btn btn-info">Yes</button>
	      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalClose" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nomorinvnyaClose">No. Invoice</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url();?>home/closeInvPenjualan" method="POST">
	      <div class="modal-body">
	          <input type="hidden" name="nomorClose" id="nomorClose">
	          <div class="alert alert-info mb-0"><i class="bi bi-exclamation-triangle"></i> Do you want to closing this data?</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
	        <button type="submit" class="btn btn-info">Yes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="detailInvoice" tabindex="-1" aria-labelledby="detailInvoiceLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nomorinvnyaDetail">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/edit_region" method="POST">
	      <div class="modal-body">
	      	<div class="table-responsive small" id="rendered-table">
	      	</div>
	      </div>
     	</form>
    </div>
  </div>
</div>

<div class="modal fade" id="detailPurchase" tabindex="-1" aria-labelledby="detailPurchaseLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="purchaseNumberDetail">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     	<form action="<?php echo base_url();?>master_data/edit_region" method="POST">
	      <div class="modal-body">
	      	<div class="table-responsive small" id="rendered-table2">
	      	</div>
	      </div>
     	</form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPrint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nomorinvnyaPrint"></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="d-flex w-100">
      		<a class="btn btn-primary w-50 me-1" id="printInv" target="_BLANK">Print Invoice</a>
      		<a class="btn btn-outline-primary w-50" id="printKwi" target="_BLANK">Print Kwitansi</a>
      	</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalApPrint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="purchasenumberPrint"></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="d-flex w-100">
      		<a class="btn btn-primary w-50 me-1" id="printInv" target="_BLANK">Print Invoice</a>
      		<a class="btn btn-outline-primary w-50" id="printKwi" target="_BLANK">Print Kwitansi</a>
      	</div>
      </div>
    </div>
  </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
	// function adjustTab() {
	// 	$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
	// }
	$(document).ready(function() {
		$('#dataInvoicePenjualan').DataTable({
			// untuk botton 26062024
			// dom: '<"row"<"col-sm-4"B"btn-sm"><"col-sm-4 text-center"l><"col-sm-4"f>>rt<"bottom"lp><"clear">',
			// buttons: [
      //   'excel', 'pdf'
    	// ],
			"language": {
				"searchPlaceholder": 'Cari di sini...',
      	"zeroRecords": "Tidak ada yang sesuai",
	      "emptyTable": "Data tidak tersedia",
	      "paginate": {
            "first": '<i class="bi bi-chevron-bar-left"></i>',
            "last": '<i class="bi bi-chevron-bar-right"></i>',
            "previous": '<i class="bi bi-chevron-left"></i>',
            "next": '<i class="bi bi-chevron-right"></i>',
        }
	    },
      "pagingType": "full_numbers",
      "lengthMenu": [5, 10, 20, 50, 100],
		});
		$('#dataPayable').DataTable({
			"language": {
				"searchPlaceholder": 'Cari di sini...',
      	"zeroRecords": "Tidak ada yang sesuai",
	      "emptyTable": "Data tidak tersedia",
	      "paginate": {
            "first": '<i class="bi bi-chevron-bar-left"></i>',
            "last": '<i class="bi bi-chevron-bar-right"></i>',
            "previous": '<i class="bi bi-chevron-left"></i>',
            "next": '<i class="bi bi-chevron-right"></i>',
        }
	    },
      "pagingType": "full_numbers",
      "lengthMenu": [5, 10, 20, 50, 100]
		});
	});
	$('.btn-floating-menu').click(function(event) {
		$('.menu-staff').toggleClass('on');
		$('.btn-floating-menu-list').toggleClass('on');
	});
    $('#search').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("#dataStockOnHand > tbody > tr").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#search2').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("ol.trans-history > li").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
    $('#search3').keyup(function(){
    	var value = $(this).val().toLowerCase();
	    $("ol.bes-history > li").filter(function() {
	      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
    });
	
	var detailInvoice = document.getElementById('detailInvoice')
	detailInvoice.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget		
		var noinv = button.getAttribute('data-bs-noinv')
		
		$('#nomorinvnyaDetail').html('No. Invoice : '+noinv)
		$.ajax({
			url: '<?= base_url();?>home/get_detail_inv',
			type: 'POST',
			dataType: 'html',
			data: {noinv: noinv},
			success: function (result) {
				$('#rendered-table').html(result);
			}
		})
		
	})

	
	var detailPurchase = document.getElementById('detailPurchase')
	detailPurchase.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget		
		var Pnno = button.getAttribute('data-bs-pnno')
		$('#purchaseNumberDetail').html('Purchase Number : '+Pnno)
		$.ajax({
			url: '<?= base_url();?>home/get_detail_pur',
			type: 'POST',
			dataType: 'html',
			data: {Pnno: Pnno},
			success: function (result) {
				$('#rendered-table2').html(result);
			}
		})
		
	})

	var modalDelete = document.getElementById('modalDelete')
	modalDelete.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget		
		var nomor = button.getAttribute('data-bs-nomor')
		var nomorinv = button.getAttribute('data-bs-nomorinv')
		
		$('#nomorinvnya').html('No. Invoice :<br>'+nomorinv)
		$('#nomor').val(nomor)
	})

	var modalApDelete = document.getElementById('modalApDelete')
	modalApDelete.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget
		var purchasenumber = button.getAttribute('data-bs-purchasenumber')
		var nomorpo = button.getAttribute('data-bs-nomorpo')

		$('#purchase_number').html('Purchase Number :<br>'+purchasenumber)
		$('#nomorpo').val(nomorpo)
	})

	var modalPost = document.getElementById('modalPost')
	modalPost.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget		
		var nomor = button.getAttribute('data-bs-nomor')
		var nomorinv = button.getAttribute('data-bs-nomorinv')
		
		$('#nomorinvnyaPost').html('No. Invoice :<br>'+nomorinv)
		$('#nomorPost').val(nomor)
	})

	var modalClose = document.getElementById('modalClose')
	modalClose.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget
		
		var nomor = button.getAttribute('data-bs-nomor')
		var nomorinv = button.getAttribute('data-bs-nomorinv')
		
		$('#nomorinvnyaClose').html('No. Invoice :<br>'+nomorinv)
		$('#nomorClose').val(nomor)
	})

	var modalPrint = document.getElementById('modalPrint')
	modalPrint.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget
		
		var nomor = button.getAttribute('data-bs-nomor')
		var nomorinv = button.getAttribute('data-bs-nomorinv')
		var link_printInv = '<?= base_url('create_transaction/rpt_invoice_penjualan/');?>'+nomorinv
		var link_printKwi = '<?= base_url('create_transaction/kwi_invoice_penjualan/');?>'+nomorinv
		
		$('#nomorinvnyaPrint').html('No. Invoice :<br>'+nomorinv)
		$('#printInv').attr('href', link_printInv);
		$('#printKwi').attr('href', link_printKwi);
	})

	var modalApPrint = document.getElementById('modalApPrint')
	modalApPrint.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget		
		var nomor = button.getAttribute('data-bs-nomor')
		var nomorinv = button.getAttribute('data-bs-nomorinv')
		var link_printInv = '<?= base_url('create_transaction/rpt_purchase_pembelian/');?>'+nomorinv
		var link_printKwi = '<?= base_url('create_transaction/kwi_purchase_pembelian/');?>'+nomorinv
		
		$('#nomorinvnyaPrint').html('No. Invoice :<br>'+nomorinv)
		$('#printInv').attr('href', link_printInv);
		$('#printKwi').attr('href', link_printKwi);
	})

</script>