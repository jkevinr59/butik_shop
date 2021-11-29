<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Toko extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	    $this->load->helper("form");
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('toko_model');
		$this->load->model('Model');
	}

	public function index()
	{
		$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		$data['trans']=$this->Model->getorderperToko($data['toko']->id_toko);
		$data['barang']=$this->Model->selectBlog();
		$this->load->view('tokopembayaran', $data);
	}

	public function getdetailorder()
	{
		$barang = $this->input->post('barang');
		$nota= $this->input->post('nota');
		$toko=$this->Model->getToko($this->session->userdata('id_login'));
		$data = $this->Model->detailorderPerToko($nota,$toko->id_toko);
		// $list=print_r($toko);
		echo json_encode($data);
	}

	public function ubahstatusorder()
	{
		$barang=$this->input->post('barang_ganti');
		$nota=$this->input->post('nota');
		$this->Model->ubahstatus($nota,$barang);
		$this->index();
		// echo $barang." ".$nota;
	}

	private function monthFormat(){

		return [
		  "1"=>"Januari",
		  "2"=>"Februari",
		  "3"=>"Maret",
		  "4"=>"April",
		  "5"=>"Mei",
		  "6"=>"Juni",
		  "7"=>"Juli",
		  "8"=>"Agustus",
		  "9"=>"September",
		  "10"=>"Oktober",
		  "11"=>"November",
		  "12"=>"Desember",
		];
  
	}
	private function yearFormat(){
		$current = date('Y');
		$lower_limit = date('Y',strtotime('-3 years'));
		$year = [];
		for($i = $lower_limit;$i<=$current;$i++){
			array_push($year,$i);
		}
		return $year;
	}

	public function laporan_toko()
	{
		$filter = $this->input->get('filter');
		$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		$data['kategori']=$this->Model->getKategori();
		if(!$filter){
			$filter = date('mY');
			
		}
		if(strlen($filter)==5){
			$month = substr($filter,0,1);
		}
		else{
			$month = substr($filter,0,2);
		}
		$year = substr($filter,-4);
		var_dump($filter);
		$data['jualan'] = $this->toko_model->getTransaction($data['toko']->id_toko,$month,$year);
		$data['transaksi'] = $this->toko_model->getTransactionSummaryMonth($month,$year,$data['toko']->id_toko);
		$summary = $this->toko_model->getTransactionSummary($data['toko']->id_toko);
		$bulan = $this->monthFormat();
		$tahun = $this->yearFormat();
		$summary_array =[];
		foreach($summary as $row){
			$summary_array[$row->bulan][$row->tahun] = $row->total;
		}
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['summary'] = $summary_array;
		$data['filter'] = $filter;
		// var_dump($data['filter']);
		// die;
		$this->load->view('tokolaporan',$data);
	}
}
?>
