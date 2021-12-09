<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
		$this->load->library("midtrans");
		$this->load->helper('url');
		$this->load->Model('Model');
	}

	public function getdetail()
	{
		$nota = $this->input->post('nota');
		$this->session->set_userdata('notaorder',$nota);
		redirect('Cart/showdetail');
	}

	public function showdetail()
	{
		$nota = $this->session->userdata('notaorder');
		$data['detailorderbarang'] = $this->Model->detailorder($nota);
		$tmp = $this->Model->getIdUser($this->session->userdata('login'));
				$id='';
				foreach($tmp as $row)
				{
					$id = $row->Id_user;
				}
		$data['order'] = $this->Model->getuserorder($id);
		$this->load->view('orderuser',$data);
	}

	public function cekpromo()
	{
		if($this->input->post('apply'))
		{
			$kode = $this->input->post('inputkode');
			$cek = $this->Model->cekpromo($kode);
			if($cek)
			{
				$tempjenis = $this->Model->getJenisPromo($kode);
				$jenis=0;
				foreach($tempjenis as $row)
				{
					$jenis = $row->Jenis_promo;
				}
				if($jenis==1) //jika jenis promo diskon
				{
					$tmp = $this->Model->getIdUser($this->session->userdata('login'));
					$id='';
					foreach($tmp as $row)
					{
						$id = $row->Id_user;
					}
					echo "<script>alert('Sukses Menggunakan Promo');</script>";
				   $data['barang'] = $this->Model->getcart($id);
				   $data['info'] = $this->Model->selectbarang();
				   $data['total'] = $this->Model->gettotalprice($this->session->userdata('login'));
				   $data['persen'] = $this->Model->getpersendiskon($kode);
				   $data['kode'] = $kode;
				   $this->session->set_userdata('kodepromo',$kode);
				   $this->load->view('cartpromo',$data);
				}
				else if($jenis==2)
				{
					$tmp = $this->Model->getIdUser($this->session->userdata('login'));
					$id='';
					foreach($tmp as $row)
					{
						$id = $row->Id_user;
					}
					$tempjumlah = $this->Model->cekPromoBuy2($id);
					$jumlah=0;
					foreach ($tempjumlah as $row)
					{
						$jumlah = $row->jumlah;
					}
					if($jumlah>=3)
					{
						$this->Model->setLaptopFree($id);
						 echo "<script>alert('Sukses Menggunakan Promo');</script>";
						 $data['barang'] = $this->Model->getcart($id);
					   $data['info'] = $this->Model->selectbarang();
					   $data['total'] = $this->Model->gettotalprice($this->session->userdata('login'));
					   $this->session->set_userdata('total',$data['total']);
					    $data['kode'] = $kode;
					   $this->session->set_userdata('kodepromo',$kode);
					   $this->load->view('cartpromo',$data);
					}
					else if($jumlah<3)
					{
						echo "<script>alert('Jumlah barang belum 3');</script>";
							$data['total'] = $this->Model->gettotalprice($this->session->userdata('login'));
					   $data['barang'] = $this->Model->getcart($id);
					   $data['info'] = $this->Model->selectbarang();
					   $this->load->view('cart',$data);	
					}
				}
			}
			else
			{
				echo "<script>alert('Kode Promo Salah');</script>";
				$data['total'] = $this->Model->gettotalprice($this->session->userdata('login'));
			   $data['barang'] = $this->Model->getcart($id);
			   $data['info'] = $this->Model->selectbarang();
			   $this->load->view('cart',$data);	
			}

		}

	}

	public function cekorder()
	{
		$tmp = $this->Model->getIdUser($this->session->userdata('login'));
				$id='';
				foreach($tmp as $row)
				{
					$id = $row->Id_user;
				}
		$data['order'] = $this->Model->getuserorder($id);
		$data['detail'] = $this->Model->getdetailuserorder($id);
		$this->load->view('orderuser',$data);
	}

	public function checkout()
	{
		$tmp = $this->Model->getIdUser($this->session->userdata('login'));
		$id='';
		foreach($tmp as $row)
		{
			$id = $row->Id_user;
		}
		$temp = $this->Model->ceksudahbayar($id);
		$cek = false;
		foreach($temp as $row)
		{
			if($row->Status_pembayaran == 0)
			{
				$cek=true;
			}
		}
		if($cek==true)
		{
			echo "<script>alert('Anda belum menyelesaikan transaksi, selesaikan terlebih dahulu');</script>";
			$this->loadpayment();
		}
		else
		{
			$ongkos_kirim = $this->input->post('ongkos_kirim');
			$alamat = $this->input->post('alamat');
			$kode = $this->Model->autogeneratedtrans();
			$nota="N".date("dmY").$kode;
			$dataCart = $this->Model->insertdtrans_htrans($id,$nota,$ongkos_kirim,$alamat);
			var_dump($dataCart);
			$dataMidtrans = $this->midtrans->createMidtransTransaction($dataCart);
			$data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			echo "<script>alert('Silahkan melakukan pembayaran dan upload bukti pembayaran);</script>";
			$this->loadpayment();
		}
	}

	public function checkoutpromo()
	{
		$tmp = $this->Model->getIdUser($this->session->userdata('login'));
		$id='';
		foreach($tmp as $row)
		{
			$id = $row->Id_user;
		}
		$temp = $this->Model->ceksudahbayar($id);
		$cek = false;
		foreach($temp as $row)
		{
			if($row->Status_pembayaran == 0)
			{
				$cek=true;
			}
		}
		if($cek==true)
		{
			echo "<script>alert('Anda belum menyelesaikan pembayaran, selesaikan pembayaran dahulu');</script>";
			 $data['barang'] = $this->Model->getcart($id);
					   $data['info'] = $this->Model->selectbarang();
					   $data['total'] = $this->Model->gettotalprice($this->session->userdata('login'));
					 
					    $data['kode'] = $kode;
					   $this->session->set_userdata('kodepromo',$kode);
					   $this->load->view('cartpromo',$data);
		}
		else
		{
			$kodepromo = $this->session->userdata('kodepromo');
			$kode = $this->Model->autogeneratedtrans();
			$nota="N".date("dmY").$kode;
			  $temp = $this->Model->gettotalprice($this->session->userdata('login'));
			$total = 0;
			foreach($temp as $row)
			{
				$total = $row->total;
			}
			$temp = $this->Model->getKodePromo($kodepromo);
			$idpromo = 0;
			foreach($temp as $row)
			{
				$idpromo = $row->Id_promo;
			}
			$this->Model->insertdtrans_htranspromo($id,$nota,$idpromo,$total);
			$data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			echo "<script>alert('Silahkan melakukan pembayaran dan upload bukti pembayaran);</script>";
			$this->loadpayment();
		}
	}

	public function loadpayment()
	{
		echo "<script>alert('Silahkan melakukan pembayaran dan upload bukti pembayaran);</script>";
		$this->session->unset_userdata('kodepromo');
		$data['payment'] = $this->Model->getpayment($this->session->userdata('login'));
		$data['midtrans_bca'] = [];
		$data['midtrans_bni'] = [];
		foreach($data['payment'] as $row){
			$midtrans =  $this->midtrans_model->getTransactionsByTransId($row->Notajual);
			foreach($midtrans as $row_midtrans){
				if($row_midtrans->channel=="bca"){
					$data['midtrans_bca'][$row->Notajual]=$row_midtrans;
				}
				if($row_midtrans->channel=="bni"){
					$data['midtrans_bni'][$row->Notajual]=$row_midtrans;
				}
			}
		}
		$this->load->view('payment',$data);
	}

	public function view_payment(){
		$data['payment'] = $this->Model->getallpayment($this->session->userdata('login'));
		$data['midtrans_bca'] = [];
		$data['midtrans_bni'] = [];
		foreach($data['payment'] as $row){
			$midtrans =  $this->midtrans_model->getTransactionsByTransId($row->Notajual);
			foreach($midtrans as $row_midtrans){
				if($row_midtrans->channel=="bca"){
					$data['midtrans_bca'][$row->Notajual]=$row_midtrans;
				}
				if($row_midtrans->channel=="bni"){
					$data['midtrans_bni'][$row->Notajual]=$row_midtrans;
				}
			}
		}
		$data['transaksi_pending'] = $this->Model->getUserPendingTransaction($this->session->userdata('login'));
		$this->load->view('view_payment',$data);
	}
	public function do_upload()
	{
		if($_FILES['fotobukti']['size'] == 0)
		{
			echo "<script>alert('Belum memilih foto');</script>";
			$this->loadpayment();
		}
		else if($_FILES['fotobukti']['size'] > 0)
		{
			$nota = $this->input->post('notajual');
			$tmp = $this->Model->getIdUser($this->session->userdata('login'));
			$id='';
			foreach($tmp as $row)
			{
				$id = $row->Id_user;
			}
		 	$config['upload_path'] = './buktipembayaran/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $nota;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload("fotobukti"))
			{
					$error = $this->upload->display_errors();
					echo "<script>alert('$error');</script>";
			}
			else
			{
				$info = $this->upload->data();
				$foto = $info["file_name"];
				echo "<script>alert('Berhasil Upload');</script>";
			   $this->Model->uploadpembayaran($nota,$id,$foto); //insert jika berhasil return 1
					
						echo "<script>alert('Berhasil Upload');</script>";
					redirect('Cont/index');
					
				
			}
		}
	}


	
}
?>
