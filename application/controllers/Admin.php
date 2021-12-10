<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

public function __construct()
  {
	parent::__construct();
    $this->load->helper("form");
	$this->load->helper('url');
	$this->load->library('form_validation');
	$this->load->library('session');
	$this->load->library('pagination');
	$this->load->model('Model');
	$this->load->model('toko_model');
	$this->load->model('admin_model');
  }
	 //contoh perubahan

  private function yearFormat(){
		$current = date('Y');
		$lower_limit = date('Y',strtotime('-3 years'));
		$year = [];
		for($i = $lower_limit;$i<=$current;$i++){
			array_push($year,$i);
		}
		return $year;
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
	public function index()
	{
		redirect('Admin/user');
	}

	public function test_toko()
	{
		$data = $this->toko_model->getTokoWithUser();
		echo(json_encode($data,JSON_PRETTY_PRINT));
		echo("\r\n");
		$dataDetail = $this->toko_model->getTokoDetail($data[0]->id_toko);
		echo(json_encode($dataDetail,JSON_PRETTY_PRINT));
		echo("\r\n");
		die;
	}
	public function view_toko()
	{
		$toko = $this->toko_model->getTokoWithUser();
		$this->load->view('admin_toko',compact('toko'));
	}

	public function toko_detail($id_toko)
	{
		$toko = $this->toko_model->getTokoDetail($id_toko);
		$transaksi = $this->toko_model->getTransaction($id_toko);
		$summary = $this->toko_model->getTransactionSummary($id_toko);
		$bulan = $this->monthFormat();
		$tahun = $this->yearFormat();
		$summary_array =[];
		foreach($summary as $row){
			$summary_array[$row->bulan][$row->tahun] = $row->total;
		}
		// echo(json_encode($toko,JSON_PRETTY_PRINT));
		// echo(json_encode($transaksi,JSON_PRETTY_PRINT));
		// echo("\r\n");
		return $this->load->view('admin_toko_detail',compact('toko','transaksi','summary','summary_array',"bulan"));
	}


//BLOG SECTION

	public function ke_master_blog()
	{
		$data['barang']=$this->Model->selectBlog();
		$this->load->view('masterblog', $data);
	}

	public function ke_buat_blog()
	{
		$this->load->view('adminblog');
	}

	public function updateblog()
	{
		$idbarang= $this->input->post('id');
		$data['id']=$idbarang;
		$data['blog']=$this->Model->searchBlog($idbarang);
		$this->load->view('adminblog', $data);
	}

	public function addblog()
	{
		$idbarang=$this->input->post('id');
		$isi_blog=$this->input->post('isiblog');
		
		//nambah blog
		//gambar tampilan blog
		$configblog['upload_path'] = './ikonblog/';
		$configblog['allowed_types'] = 'jpg|jpeg|png';
		$configblog['overwrite'] = TRUE;
		$configblog['file_name'] = $idbarang;
		// $this->upload->initialize($configblog);
		$this->load->library('upload', $configblog);

		if ($this->upload->do_upload('foto_blog')){
			$uploadData = $this->upload->data();
			$namafile=$uploadData['file_name'];
			$this->Model->insertBlog($idbarang,$isi_blog,$namafile);

			//list gambar blog
			$count_detail=count($_FILES['files_blog']['name']);
			for ($i=0; $i < $count_detail; $i++) { 
				if(!empty($_FILES['files_blog']['name'][$i])){
					$_FILES['file']['name'] = $_FILES['files_blog']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files_blog']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files_blog']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files_blog']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files_blog']['size'][$i];

					$konfigg['upload_path'] = './detail_blog/'; 
					$konfigg['allowed_types'] = 'jpg|jpeg|png';
					$konfigg['overwrite'] = TRUE;
					$konfigg['file_name'] = $idbarang.$i;

					$this->upload->initialize($konfigg);
					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						$data['filenames'][] = $filename;
						$this->Model->insertGambarBlog($idbarang,$filename);
					}
				}
			}
			$this->ke_buat_blog();
		}
		else{
			echo "<script>alert('Gambar Blog salah!!')</script>";
			$this->ke_buat_blog();
		}
	
	}

	public function update_Blog()
	{
		$idbarang=$this->input->post('id');
		// $namabarang=$this->input->post('nama');
		$idbaru =$this->input->post('id_baru');
		$isi_blog=$this->input->post('isiblog');
		// echo $idbaru." ".$idbarang;
		
		if($_FILES['foto_blog']['size']==0){
			if($_FILES['files_blog']['size']==0){
			$this->Model->updateblogNoFotoNoDetail($idbarang,$isi_blog,$idbaru);
			}
			else{
				$this->Model->updateblogNoFotoWithDetail($idbarang,$isi_blog,$namafile,$idbaru);
				$this->Model->deleteGambarBlog($idbarang);
				$count_detail=count($_FILES['files_blog']['name']);
				for ($i=0; $i < $count_detail; $i++) { 
					if(!empty($_FILES['files_blog']['name'][$i])){
						$_FILES['file']['name'] = $_FILES['files_blog']['name'][$i];
						$_FILES['file']['type'] = $_FILES['files_blog']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['files_blog']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['files_blog']['error'][$i];
						$_FILES['file']['size'] = $_FILES['files_blog']['size'][$i];

						$konfigg['upload_path'] = './detail_blog/'; 
						$konfigg['allowed_types'] = 'jpg|jpeg|png';
						$configg['overwrite'] = TRUE;
						$konfigg['file_name'] = $idbarang.$i;

						$this->upload->initialize($konfigg);
						if($this->upload->do_upload('file')){
							$uploadData = $this->upload->data();
							$filename = $uploadData['file_name'];

							$data['filenames'][] = $filename;
							$this->Model->insertGambarBlog($idbaru,$filename);
						}
					}
				}
			}
		}
		else{
			$configblog['upload_path'] = './ikonblog/';
			$configblog['allowed_types'] = 'jpg|jpeg|png';
			$configblog['overwrite'] = TRUE;
			$configblog['file_name'] = $idbarang;

			$this->load->library('upload', $configblog);
			
			if ($this->upload->do_upload('foto_blog')){
				$uploadData = $this->upload->data();
				$namafile=$uploadData['file_name'];
				if($_FILES['files_blog']['size']==0){
					$this->Model->updateblogNoDetail($idbarang,$isi_blog,$namafile,$idbaru);
				}
				else{
					$this->Model->updateblogWithDetail($idbarang,$isi_blog,$namafile,$idbaru);
					$this->Model->deleteGambarBlog($idbarang);
					$count_detail=count($_FILES['files_blog']['name']);
					for ($i=0; $i < $count_detail; $i++) { 
						if(!empty($_FILES['files_blog']['name'][$i])){
							$_FILES['file']['name'] = $_FILES['files_blog']['name'][$i];
							$_FILES['file']['type'] = $_FILES['files_blog']['type'][$i];
							$_FILES['file']['tmp_name'] = $_FILES['files_blog']['tmp_name'][$i];
							$_FILES['file']['error'] = $_FILES['files_blog']['error'][$i];
							$_FILES['file']['size'] = $_FILES['files_blog']['size'][$i];

							$konfigg['upload_path'] = './detail_blog/'; 
							$konfigg['allowed_types'] = 'jpg|jpeg|png';
							$konfigg['overwrite'] = TRUE;
							$konfigg['file_name'] = $idbarang.$i;

							$this->upload->initialize($konfigg);
							if($this->upload->do_upload('file')){
								$uploadData = $this->upload->data();
								$filename = $uploadData['file_name'];

								$data['filenames'][] = $filename;
								$this->Model->insertGambarBlog($idbaru,$filename);
							}
						}
					}
				}
			}
			else{
				echo "<script>alert('Gambar Blog salah!!')</script>";
				$data['id']=$idbarang;
				$data['blog']=$this->Model->searchBlog($idbarang);
				$this->load->view('adminblog',$data);
			}
			
		}
		$this->ke_master_blog();
	}

	public function deleteblog()
	{
		$idblog=$this->input->post('id');
		$this->Model->delete_Blog($idblog);
		$this->Model->deleteGambarBlog($idblog);
		$this->ke_master_blog();
	}

//ADMIN SECTION
	public function masteradmin()
	{
		$data['admin']= $this->Model->getAdmin();
		$this->load->view('a', $data);
	}

	public function updateAdmin()
	{
		$admin = $this->Model->getAdmin();
		$nama_baru = $this->input->post('namaadmin');
		$pass_lama = $this->input->post('passlama');
		$pass_baru = $this->input->post('passbaru');
		$conpass = $this->input->post('conpass');
		if($pass_baru==""){
			$this->Model->updateAdmin($admin->user_admin,$nama_baru,$admin->pass_admin);
			$data['admin']= $this->Model->getAdmin();
			$this->load->view('a', $data);
		}
		else{
			if($pass_baru==$conpass){
				if($pass_lama==$admin->pass_admin){
					$this->Model->updateAdmin($admin->user_admin,$nama_baru,$pass_baru);
					$data['admin']= $this->Model->getAdmin();
					$this->load->view('a', $data);
				}
				else{
					$data['error']="Password Lama tidak sesuai";
					$data['admin']= $this->Model->getAdmin();
					$this->load->view('a', $data);
				}
			}
			else{
				$data['error']="Password Baru dan Konfirmasi password baru harus sama";
				$data['admin']= $this->Model->getAdmin();
				$this->load->view('a', $data);
			}
		}
	}

	public function slider()
	{
		$data['slider']= $this->Model->selectSlider();
		$data['barang']= $this->Model->selectAllbarangBukanSlider();
		$this->load->view('masterslider', $data);
	}

	public function gantislider($value='')
	{
		$id_lama= $this->input->post('id');
		$id_baru= $this->input->post('new_barang');
		$this->Model->updateSlider($id_lama,$id_baru);
		redirect('Admin/slider');
	}

	public function user()
	{
		$data['user']=$this->Model->selectAllUser();
		$this->load->view('masteruser', $data);
	}

	public function getgantistatus()
	{
		$id = $this->input->post("id");
		$this->session->set_userdata('iduserstatus',$id);
		redirect('Admin/gantistatus');
	}

	public function gantistatus() {
	  $id = $this->session->userdata("iduserstatus");
	  $this->Model->gantiVerify($id);
	  $this->session->unset_userdata('iduserstatus');
	  redirect('Admin/user');
	}

	public function halamanpromo()
	{
		$data['promo'] = $this->Model->showpromo();

		$this->load->view('promo',$data);
	}

	public function halamanreport()
	{
		$transaksi = $this->toko_model->getTransactionReport();
		$user = $this->admin_model->getJumlahUser();
		$barang = $this->admin_model->getBarangPerKategori();
		return $this->load->view('report',compact('transaksi','user','barang'));
	}

	public function getdetailorder()
	{
		$nota = $this->input->post('nota');
		$nama = $this->input->post('nama');
		$this->session->set_userdata('notajual',$nota);
		$this->session->set_userdata('nama',$nama);
		redirect('Admin/detailorder');
	}


	public function ubahstatus()
	{
		$nota = $this->input->post('nota');
		$this->Model->ubahstatus($nota);
		redirect('Admin/order');
	}

	public function promo()
	{
		$nama = $this->input->post('namapromo');
		 	 $jenis = $this->input->post('jenispromo');
		 	 $kode = $this->input->post('kodepromo');
		 	 $tglmulai = $this->input->post('tanggalmulai');
		 	 $tglberakhir = $this->input->post('tanggalberakhir');
		 if($this->input->post('insertpromo'))
		 {
		 	 
		 	 //Cek persen diskon kosong atau tidak
		 	if($this->input->post('persendiskon')=="")
		 	 {
		 	 	//cek apakah jenis promo adalah diskon 
		 	 		if($jenis==1)
		 	 		{			
		 	 		    echo "<script>alert('Persen diskon belum diisi')</script>";
		 	 		     $this->load->view('promo');
		 	 		}
		 	 		else
		 	 		{
		 	 			$this->Model->insertpromo2($nama,$jenis,$kode,$tglmulai,$tglberakhir);
		 	 			echo "<script>alert('Sukses insert')</script>";
		 	 				$data['promo'] = $this->Model->showpromo();
		 	 		     $this->load->view('promo',$data);
		 	 		}
		 	 }
		 	 else
		 	 {
		 	 	$this->Model->insertpromo($nama,$jenis,$kode,$tglmulai,$tglberakhir,$this->input->post('persendiskon'));
		 	 			echo "<script>alert('Sukses insert')</script>";
		 	 				$data['promo'] = $this->Model->showpromo();
		 	 		     $this->load->view('promo',$data);
		 	 }
		 }
		 else if($this->input->post('update'))
		 {
		 		if($this->input->post('persendiskon')=="")
		 		{
		 				$id = $this->input->post('id');
		 				$this->Model->updatepromo($nama,$id,$tglmulai,$tglberakhir);
		 		}
		 		else
		 		{
		 			$id = $this->input->post('id');
		 			$this->Model->updatepromo2($nama,$id,$tglmulai,$tglberakhir,$this->input->post('persendiskon'));
		 		}
		 		redirect('Admin/halamanpromo');
		 
		 }
	}
	
	
	public function search()
	{
		$index = $this->input->post('jumlah');
		$this->session->set_userdata('jumlah',$index);
		$keyword = $this->input->post('keyword');
		$this->session->set_userdata('cari',$keyword);
		redirect('Admin/hasilsearch');
	}
	
	public function hasilsearch()
	{
		$cari = $this->session->userdata('cari');

		if($this->session->userdata('jumlah') == false || $this->session->userdata('jumlah') == 'false'){
			$jumlah = 5;
		}
		else{
			$jumlah = $this->session->userdata('jumlah');
		}
		if($this->session->userdata('toko_terpilih')==false ||$this->session->userdata('toko_terpilih')=="false"){
			$row = $this->db->count_all('barang');
		}
		else{
			$this->db->count_all_results('barang');
			$this->db->like('id_toko', $this->session->userdata('toko_terpilih'), 'BOTH');
			$this->db->from('barang');
			$row= $this->db->count_all_results();
		}
		$config = array();
        $config['base_url'] = base_url()."index.php/Admin/hasilsearch";
        $config['total_rows'] = $this->Model->jumlahsearch($cari);
        $config['per_page'] = $jumlah;
        $config['uri_segment'] = 3;
		$config['first_link'] = '<|';
		$config['last_link'] = '|>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 1;
        $this->pagination->initialize($config);
        if($this->uri->segment(3) > 1){
			$data['data'] = $this->Model->search($cari,$config['per_page'],$this->uri->segment(3));
		}
		else if($this->uri->segment(3) < 1){
			$data['data'] = $this->Model->search($cari,$config['per_page'],0);
		}
		$data['barang'] = $this->Model->selectbarang();
        $data['links'] = $this->pagination->create_links();
		$data['halaman'] = $this->pagination->cur_page;
		$data['toko']= $this->Model->selectToko();
		$this->session->set_userdata('def',$jumlah);
        $this->load->view('masterbarang',$data);
	}
	
	
	public function getdelete()
	{
		 $id = $this->input->post("id");
		 $this->session->set_userdata("id",$id);
	   redirect('Admin/deletebarang');
	}

	public function getdeletepromo()
	{
		$id = $this->input->post("id");
		$this->session->set_userdata('idpromo',$id);
		redirect('Admin/deletepromo');
	}

	public function deletepromo() {
	  $id = $this->session->userdata("idpromo");
	  $this->Model->deletepromo($id);
	  $this->session->unset_userdata('idpromo');
	  redirect('Admin/halamanpromo');
	}
	
	public function logout()
	{
		session_destroy();
		redirect(site_url("Cont/index"));
	}
}
