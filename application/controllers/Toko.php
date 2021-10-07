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
}
?>
