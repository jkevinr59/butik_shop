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

	public function laporan_toko()
	{
		$month = $this->input->get('month');
		$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		$data['kategori']=$this->Model->getKategori();
		if(!$month){
			$month = date('m');
		}
		$data['jualan'] = $this->toko_model->getTransaction($data['toko']->id_toko,$month);
		$summary = $this->toko_model->getTransactionSummary($data['toko']->id_toko);
		$bulan = $this->monthFormat();
		$summary_array =[];
		foreach($summary as $row){
			$summary_array[$row->bulan] = $row->total;
		}
		$data['bulan'] = $bulan;
		$data['summary'] = $summary_array;
		// var_dump($data['jualan']);
		// die;
		$this->load->view('tokolaporan',$data);
	}
}
?>
