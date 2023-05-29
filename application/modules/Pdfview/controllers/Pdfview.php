<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pdfview extends CI_Controller { 
		function __construct(){
			parent::__construct();
			// $this->load->model('Pdf_view_m'); 
		}
	    public function index()
	    {
	        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
	        $this->load->library('pdfgenerator');
	        
	        // title dari pdf
	        $this->data['title_pdf'] = 'Laporan';
	        
	        // filename dari pdf ketika didownload
	        $file_pdf = 'laporaan';
	        // setting paper
	        $paper = 'A4';
	        //orientasi paper potrait / landscape
	        $orientation = "portrait";
	        
			$html = $this->load->view('laporan_pdf',$this->data, true);	    
	        
	        // run dompdf
	        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	    }
	}