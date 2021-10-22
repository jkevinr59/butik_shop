<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cont extends CI_Controller {

public function __construct()
  {
	parent::__construct();
    $this->load->helper("form");
	$this->load->helper('url');
	$this->load->library('form_validation');
	$this->load->model('Model');
	$this->load->model('toko_model');
	$this->load->library('session');
	$this->load->library('rajaongkir');
	$this->load->library('pagination');
	$this->load->library('cart');
  }
	 
	public function index($id="")
	{
		//SORTING SESSION
		$best=$this->Model->selectBestSeller();
		$denganrating=[];
		$tanparating=[];
		foreach ($best as $key) {
			$star=$key->star;
			$jml=$key->Jumlah;
			if($star==null){
				$star=0;
			}
			if($jml==null){
				$jml=0;
			}
			if($key->Id_barang!=null){
				// echo $key->Id_barang."-".$star."-".$jml."<br>";
				if($star!=0){
					array_push($denganrating, $key);
				}
				else{
					array_push($tanparating,$key);
				}
			}
		}

		function cmp_yes($a,$b)
		{
			return $a->Jumlah*$a->star<$b->Jumlah*$b->star;
		}
		function cmp_no($a,$b)
		{
			return $a->Jumlah<$b->Jumlah;
		}
		usort($denganrating, 'cmp_yes');
		usort($tanparating, 'cmp_no');
		$best_seller=array_merge($denganrating,$tanparating);
		$data['best_seller']=[];
		foreach ($best_seller as $key) {
			array_push($data['best_seller'], $this->Model->selectbarangbyid($key->Id_barang));
		}

		//AFTER SORTING
		if($id==""){
			if($this->session->userdata('login')!=null){
				$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
				if($data['toko']!=null){
					$data['jualan']=$this->Model->getJualanoranglain($data['toko']->id_toko);		
				}
				else{
					$data['jualan']=$this->Model->selectAllbarang();			
				}
			}
			else{
				$data['jualan']=$this->Model->selectAllbarang();	
			}
			$data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			$data['slider']= $this->Model->selectSlider();
			$data['barang']=$this->Model->selectBlog();
			$jumlah = $this->Model->cekStatusPromo();
			$this->load->view("index",$data);
		}
		else{
			$data['toko']= $this->Model->getTokoLink($id);
			$data['jualan']=$this->Model->getJualan($data['toko']->id_toko);
			$data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			$data['slider']= $this->Model->selectSlider();
			$data['barang']=$this->Model->selectBlog();
			$jumlah = $this->Model->cekStatusPromo();
			$this->load->view("index",$data);
		}
	}

	public function showeditprofile()
	{
		$data['data'] = $this->Model->getuserprofile($this->session->userdata('login'));
		print_r($data['data']->Nama_user);
		$this->load->view("profile",$data);
	}

	public function ke_toko()
	{
		// print_r($this->session->userdata);
		$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		$data['kategori']=$this->Model->getKategori();
		if($data['toko']!=null){
			if($data['toko']->nama_toko!=""){	
				$this->load->view('tokojualan',$data);	
			}
			else{
				$this->ke_edit_toko();
			}
		}
		else{
			$this->load->view('form_toko',$data);
		}
	}

	public function detail_toko($id_toko)
	{
		$data['toko']= $this->toko_model->getTokoDetail($id_toko);
		$data['kategori']=$this->Model->getKategori();
		$data['jualan']=$this->Model->getJualan($data['toko']->id_toko);
		$data['barang']=$this->Model->selectBlog();
		$this->load->view('isitoko', $data);
	}
	public function ke_isi_toko()
	{
		$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		$data['kategori']=$this->Model->getKategori();
		$data['jualan']=$this->Model->getJualan($data['toko']->id_toko);
		$data['barang']=$this->Model->selectBlog();
		$this->load->view('isijualan', $data);
	}

	public function ke_pembayaran_toko()
	{
		$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		$data['trans']=$this->Model->getorderperToko($data['toko']->id_toko);
		$data['barang']=$this->Model->selectBlog();
		$this->load->view('tokopembayaran', $data);
	}

	public function ke_edit_toko()
	{
		$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		$this->load->view('toko', $data);
	}

	public function bukatoko()
	{
		$this->Model->openToko($this->session->userdata('id_login'));
		// $data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		// $this->load->view('toko', $data);
		$this->ke_edit_toko();
	}

	public function updateprofile()
	{
		$nama = $this->input->post('nama');
		$password = $this->input->post('password');
		$confirm = $this->input->post('confirm');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('notelp');
		$this->form_validation->set_rules('nama','Nama','required|alpha');
		$this->form_validation->set_rules('password','Password','min_length[4]');
		if($password!=""){
			$this->form_validation->set_rules('confirm','Confirm','required|matches[password]');	
		}
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('notelp','Notelp','required|integer');
		if($this->form_validation->run()){
			$array = array(
				'login' => $nama
			);
			$this->session->set_userdata( $array );

			if($_FILES['foto_user']['size'] == 0) {
				echo "<script>alert('Berhasil Update');</script>";
				$this->Model->updateprofile($nama,$password,$alamat,$telp,$this->session->userdata('id_login'));	
		  	}
			else if($_FILES['foto_user']['size'] > 0){
				$config['upload_path'] = './fotouser/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['overwrite'] = TRUE;
				$config['file_name'] = $this->session->userdata('id_login');
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload("foto_user"))
				{
					$error = $this->upload->display_errors();
					echo "<script>alert('File salah!!');</script>";
				}
				else
				{
					$info = $this->upload->data();
					$foto = $info["file_name"];
					$this->Model->updateprofilefoto($nama,$password,$alamat,$telp,$this->session->userdata('id_login'),$foto);
					echo "<script>alert('Berhasil Update');</script>";	
				}
			}
			$data['data'] = $this->Model->getuserprofile($this->session->userdata('login'));
			$this->load->view("profile",$data);
		}
		else
		{
			echo "<script>Form tidak boleh kosong!!</script>";
			$data['data'] = $this->Model->getuserprofile($this->session->userdata('login'));
			$this->load->view("profile",$data);
		}
			
	}
	
	public function admin() 
	{
		$this->load->view("admin");
	}

	
	public function getpricecart()
	{
		$idbarang = $this->input->post('id');
		$jumlah = $this->input->post('jumlah');
		$size = $this->input->post('size');
		$this->session->set_userdata('idbarangcart',$idbarang);
		$this->session->set_userdata('jumlah',$jumlah);
		$this->session->set_userdata('size',$size);
		$this->updatecart();
	}

	public function updatecart()
	{
		$id = $this->session->userdata('idbarangcart');
		$jumlah = $this->session->userdata('jumlah');
		$size=$this->session->userdata('size');
		$this->Model->updatecart($id,$this->session->userdata('login'),$jumlah,$size);
		echo $jumlah;
		echo $id;
		echo $size;
		$this->viewcart();
	}
	
	public function viewcart()
	{
		$tmp = $this->Model->getIdUser($this->session->userdata('login'));
		$id='';
		foreach($tmp as $row)
		{
			$id = $row->Id_user;
		}
		$data['barang'] = $this->Model->getcart($id);
		$temp = $this->Model->ceksudahbayar($id);
		$data['info'] = $this->Model->selectbarang();
		$data['total'] = $this->Model->gettotalprice($this->session->userdata('login'));
		$data['kota'] = $this->rajaongkir->getCityList(11);
		$cek=false;
		foreach($temp as $row)
		{
			if($row->Status_pembayaran == 0)
			{
				$cek=true;
			}
		}
		if($cek==true){
			echo "<script>alert('Pembayaran belum dilakukan!!');</script>";
			$this->session->unset_userdata('kodepromo');
			$data['payment'] = $this->Model->getpayment($this->session->userdata('login'));
			$this->load->view('payment',$data);
		}else{
			$this->load->view('cart2',$data);		
		}
	}
	
	public function getcart()
	{
	   if($this->session->userdata('idbarang2')=="")
	   {
	   	   $this->session->unset_userdata('idbarang2');
	   }
	   $id=$this->input->post('id');
	   $this->session->set_userdata('idbarang2',$id);
	   $this->addcart();
	}

	public function deletecart()
	{
		$idcart = $this->input->post('id');
		$tmp = $this->Model->getIdUser($this->session->userdata('login'));
		$iduser=0;
		foreach($tmp as $row)
		{
			$iduser = $row->Id_user;
		}
		$this->Model->deletecart($idcart,$iduser);
		$this->viewcart();
	}

	public function deleteallcart()
	{
		$tmp = $this->Model->getIdUser($this->session->userdata('login'));
		$iduser=0;
		foreach($tmp as $row)
		{
			$iduser = $row->Id_user;
		}
		$this->Model->deleteallcart($iduser);
		$this->viewcart();
	}
	
	public function redir()
	{
		$tmp = $this->Model->getIdUser($this->session->userdata('login'));
		$id=0;
		foreach($tmp as $row)
		{
			$id = $row->Id_user;
		}
		$data['total'] = $this->Model->gettotalprice($this->session->userdata('login'));
	   $data['barang'] = $this->Model->getcart($id);
	   $data['info'] = $this->Model->selectbarang();
	   $this->load->view('cart',$data);	
	}
	//add cart pakai button add to cart pada halaman index & hasil
	public function addcart()
	{
		if($this->session->userdata('login')=="") {
			echo "<script>alert('Login terlebih dahulu');</script>";
				$this->index();
		}
		else
		{
				$id = $this->session->userdata('idbarang2');
				$this->Model->insertcart($id,$this->session->userdata('login'),1,'M');
				echo "<script>alert('Sukses Menambahkan ke Cart');</script>";
				$data['kategori'] = $this->Model->getKategori();
				$data['merk'] = $this->Model->getJumlahMerk();
				$data['barang'] = $this->Model->selectbarangbyid($id);
				//$this->session->unset_userdata('idbarang2');
				
				$this->index();
		}
		
	}
	
	public function cart()
	{
		if($this->session->userdata('login')=="") {
			echo "<script>alert('Login terlebih dahulu');</script>";
			$this->index();
		}
		else
		{	
			$id = $this->input->post('id');
			$size = $this->input->post('size');
			$this->Model->insertcart($id,$this->session->userdata('login'),$this->input->post('jumlah'),$size);
			$this->Model->getIdUser($this->session->userdata('login'));
			echo "<script>alert('Sukses Menambahkan ke Cart');</script>";
			$data['barang'] = $this->Model->selectbarangbyid($id);
			$data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			$data['detail_foto']=$this->Model->selectDetailFoto($id);
			$this->load->view('single',$data);
		}		
	}
	
	public function pindah()
	{
	   	if($this->input->post('get')) {
		   $id = $this->input->post('id');
			$data['barang'] = $this->Model->selectbarangbyid($id);
		$data['kategori'] = $this->Model->getKategori();
		$data['merk'] = $this->Model->getJumlahMerk();
		$this->session->unset_userdata('idbarang');
		$this->session->set_userdata('idbarang',$id);
		$this->load->view('product-details',$data);
		}
	}
	
	public function detail()
	{
		$this->load->view("product-details");
	}
	
	public function getdetail()
	{
	   $id=$this->input->post('id');
	   $this->session->set_userdata('idbarang',$id);
	   $this->showdetail();
	}
	
	public function showdetail()
	{
		$id = $this->session->userdata('idbarang');
		$data['barang'] = $this->Model->selectbarangbyid($id);
		$data['kategori'] = $this->Model->getKategori();
		$data['merk'] = $this->Model->getJumlahMerk();
		$data['detail_foto']=$this->Model->selectDetailFoto($id);
		$data['komentar']=$this->Model->selectrating($id);
		$data['user']=$this->Model->getuserprofile($this->session->userdata('login'));
		$this->load->view('single',$data);
	}

	public function ke_blog()
	{
		$id=$this->session->userdata('idbarang');
		$barang=$this->Model->searchBlog($id);
		if($barang==null){
			echo "<script>alert('Tidak ada blog!!!')</script>";
			$this->showdetail();
		}
		else{
			$data['isi_blog']=$this->Model->searchBlog($id);
			$gambar['gambar_blog']=$this->Model->selectgambarblog($id);
			$data['carosel']=$this->load->view('carosel', $gambar, TRUE);
			$this->load->view('blog', $data);
		}
	}
	public function ke_blog_bawah($barang_id)
	{
		$barang_id=str_replace('%20', ' ',$barang_id);
		$data['isi_blog']=$this->Model->searchBlog($barang_id);
		$gambar['gambar_blog']=$this->Model->selectgambarblog($barang_id);
		$data['carosel']=$this->load->view('carosel', $gambar, TRUE);
		$this->load->view('blog', $data);
	}
	
	public function addRating()
	{
		$id = $this->session->userdata('idbarang');
		$rate=$this->input->post('rate');
		$iduser=$this->input->post('user');
		$isi=$this->input->post('message');
		$date=date("d/m/Y") ;
		// echo $date;
		$this->Model->addrate($iduser,$id,$rate,$isi,$date);
		$this->showdetail();
	}

	public function getsort()
	{
		$sort=$this->input->post('sort');
	   $this->session->set_userdata('sort',$sort);
	   $this->showsort();
	}
	
	public function showsort()
	{
	   $sort = $this->session->userdata('sort');
	   $tempid=0;
	   $temp="";
	   if($this->session->userdata('merk')==null) {
		   $tempid = $this->session->userdata('kategori');
		   $this->session->unset_userdata('kategori');
		   $temp= $this->Model->JumlahKategori($tempid);
		    $jumlah=0;
			foreach($temp as $row) {
				$jumlah = $row->jumlah;
			}
			 if($jumlah<=9) {
				$data['barang'] = $this->Model->sortbarangkategori($tempid,$sort);
			   $data['kategori'] = $this->Model->getKategori();
				$data['merk'] = $this->Model->getJumlahMerk();
				$this->session->set_userdata('kategori',$tempid);
			   $this->load->view('hasil',$data);
			}
			 else if($jumlah>9) {
				   $config = array();
				$config['base_url'] = base_url()."index.php/Cont/showsort";
				$config['total_rows'] = $jumlah;
				$config['per_page'] = 6;
				$config['uri_segment'] = 3;
				$config['first_link'] = '<|';
				$config['last_link'] = '|>';
				$config['next_link'] = '>';
				$config['prev_link'] = '<';
				$config['num_links'] = 1;
				$this->pagination->initialize($config);
				if($this->uri->segment(3) > 1){
					$data['barang'] = $this->Model->sortbarangbykategori($config['per_page'],$this->uri->segment(3),$tempid,$sort);
				}
				else if($this->uri->segment(3) < 1){
					$data['barang'] = $this->Model->sortbarangbykategori($config['per_page'],0,$tempid,$sort);
				}
				$data['links'] = $this->pagination->create_links();
				 $data['kategori'] = $this->Model->getKategori();
					$data['merk'] = $this->Model->getJumlahMerk();
					$this->session->set_userdata('kategori',$tempid);
				   $this->load->view('hasil',$data);
			   }
			
	   }
	   else if($this->session->userdata('kategori')==null) {
		   $tempid = $this->session->userdata('merk');
		   $this->session->unset_userdata('merk');
		   $temp = $this->Model->JumlahMerk($tempid);
		   $jumlah=0;
			foreach($temp as $row) {
				$jumlah = $row->jumlah;
			}
			 if($jumlah<=9) {
				$data['barang'] = $this->Model->sortbarangmerk($tempid,$sort);
			   $data['kategori'] = $this->Model->getKategori();
				$data['merk'] = $this->Model->getJumlahMerk();
				$this->session->set_userdata('kategori',$tempid);
			   $this->load->view('hasil',$data);
			}
			 else if($jumlah>9) {
				   $config = array();
				$config['base_url'] = base_url()."index.php/Cont/showsort";
				$config['total_rows'] = $jumlah;
				$config['per_page'] = 6;
				$config['uri_segment'] = 3;
				$config['first_link'] = '<|';
				$config['last_link'] = '|>';
				$config['next_link'] = '>';
				$config['prev_link'] = '<';
				$config['num_links'] = 1;
				$this->pagination->initialize($config);
				if($this->uri->segment(3) > 1){
					$data['barang'] = $this->Model->sortbarangbymerk($config['per_page'],$this->uri->segment(3),$tempid,$sort);
				}
				else if($this->uri->segment(3) < 1){
					$data['barang'] = $this->Model->sortbarangbymerk($config['per_page'],0,$tempid,$sort);
				}
				$data['links'] = $this->pagination->create_links();
				 $data['kategori'] = $this->Model->getKategori();
					$data['merk'] = $this->Model->getJumlahMerk();
					$this->session->set_userdata('kategori',$tempid);
				   $this->load->view('hasil',$data);
			   }
			
	   }
	  
	  
	}
	
	public function getbarangkategori()
	{
	   $id = $this->input->post('id');
	   $this->session->set_userdata('id',$id);
	   $this->showbarangkategori();
	}
	
	public function showbarangkategori()
	{
	   $id = $this->session->userdata('id');
	   $toko = $this->Model->getToko($this->session->userdata('id_login'));
	   $temp = $this->Model->JumlahKategori($id,$toko->id_toko);
	   $jumlah=0;
	   foreach($temp as $row) {
		   $jumlah = $row->jumlah;
	   }
	   if($jumlah<=9) {
		    $data['barang'] = $this->Model->getBarangByKategori($id,$toko->id_toko);
		   $data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			$this->session->set_userdata('kategori',$id);
		   $this->load->view('hasil',$data);
	   }
	   else if($jumlah>9) {
		   $config = array();
        $config['base_url'] = base_url()."index.php/Cont/showbarangkategori";
        $config['total_rows'] = $jumlah;
        $config['per_page'] = 9;
        $config['uri_segment'] = 3;
		$config['first_link'] = '<|';
		$config['last_link'] = '|>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 1;
        $this->pagination->initialize($config);
        if($this->uri->segment(3) > 1){
			$data['barang'] = $this->Model->fetchkategori($config['per_page'],$this->uri->segment(3),$id,$toko->id_toko);
		}
		else if($this->uri->segment(3) < 1){
			$data['barang'] = $this->Model->fetchkategori($config['per_page'],0,$id,$toko->id_toko);
		}
		$data['links'] = $this->pagination->create_links();
		 $data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			$this->session->set_userdata('kategori',$id);
		   $this->load->view('hasil',$data);
	   }
	 
	}
	
	public function getbarangmerk()
	{
		$id = $this->input->post('id');
   		$this->session->set_userdata('id',$id);
   		$this->showbarangmerk();
	}
	
	public function showbarangmerk()
	{
	   $id = $this->session->userdata('id');
	   $toko = $this->Model->getToko($this->session->userdata('id_login'));
	   $temp = $this->Model->JumlahMerk($id,$toko->id_toko);
	   $jumlah=0;
	   foreach($temp as $row) {
		   $jumlah = $row->jumlah;
	   }
	   if($jumlah<=6) {
		    $data['barang'] = $this->Model->getBarangByMerk($id,$toko->id_toko);
		   $data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			$this->session->set_userdata('merk',$id);
		   $this->load->view('hasil',$data);
	   }
	   else if($jumlah>6) {
		   $config = array();
        $config['base_url'] = base_url()."index.php/Cont/showbarangmerk";
        $config['total_rows'] = $jumlah;
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
		$config['first_link'] = '<|';
		$config['last_link'] = '|>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 1;
        $this->pagination->initialize($config);
        if($this->uri->segment(3) > 1){
			$data['barang'] = $this->Model->fetchmerk($config['per_page'],$this->uri->segment(3),$id,$toko->id_toko);
		}
		else if($this->uri->segment(3) < 1){
			$data['barang'] = $this->Model->fetchmerk($config['per_page'],0,$id,$toko->id_toko);
		}
		$data['links'] = $this->pagination->create_links();
		 $data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			$this->session->set_userdata('merk',$id);
		   $this->load->view('hasil',$data);
	   }
	 
	}
	
	public function getsearch()
	{
		$key = $this->input->post('search');
		$this->session->set_userdata('key',$key);
	    $this->showsearch();
	}
	
	public function showsearch()
	{
		$key = $this->session->userdata('key');
		if($this->session->userdata('login')!=null){
			$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
			if($data['toko']!=null){
				$data['jualan']=$this->Model->getSearchJualanoranglain($data['toko']->id_toko,$key);		
			}
			else{
				$data['jualan']=$this->Model->fetchsearch($key);			
			}
		}
		else{
			$data['jualan']=$this->Model->fetchsearch($key);	
		}
		$data['kategori'] = $this->Model->getKategori();
		$data['merk'] = $this->Model->getJumlahMerk();
		$data['slider']= $this->Model->selectSlider();
		$jumlah = $this->Model->cekStatusPromo();
		$this->load->view("index",$data);
	}
	
	public function update_barang($id_barang)
	{
		$data['barang']=$this->Model->selectbarangbyid($id_barang);
		$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		if($data['toko']!=null){
			$data['jualan']=$this->Model->getJualan($data['toko']->id_toko);	
		}
		$data['kategori']=$this->Model->getKategori();
		$this->load->view('barang_update',$data);
	}

	public function update_toko()
	{
		$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
		$data['jualan']=$this->Model->getJualan($data['toko']->id_toko);
		$data['kategori']=$this->Model->getKategori();
		$fototoko = $this->input->post('id_toko');
		$toko= $this->input->post("input-nama");
		$telp= $this->input->post("input-telp");
		$link= $this->input->post("input-link");
		$slogan= $this->input->post("input-slogan");
		$about= $this->input->post("input-about");
		$provinsi= $this->input->post("input-provinsi");
		$kota= $this->input->post("input-kota");
		$kecamatan= $this->input->post("input-kecamatan");
		$kodepos= $this->input->post("input-kodepos");
		$alamat= $this->input->post("input-alamat");
		$this->form_validation->set_rules('input-nama', 'Nama toko', 'trim|required');
		$this->form_validation->set_rules('input-telp', 'Telepon toko', 'trim|required|numeric');
		$this->form_validation->set_rules('input-link', 'Domain toko', 'trim|alpha_dash');
		$this->form_validation->set_rules('input-provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('input-kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('input-kecamatan', 'Kecamatan', 'trim|required');
		$this->form_validation->set_rules('input-kodepos', 'Kode Pos', 'trim|required|numeric');
		$this->form_validation->set_rules('input-alamat', 'Alamat toko', 'trim|required');

		if ($this->form_validation->run()) {
			if($_FILES['foto_toko']['size'] == 0) {
			    
				$this->Model->updateToko($data['toko']->id_toko,$toko,$telp,$link,$slogan,$about,$provinsi,$kota,$kecamatan,$kodepos,$alamat);
		  	}
			else if($_FILES['foto_toko']['size'] > 0){
				$config['upload_path'] = './ikontoko/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['overwrite'] = TRUE;
				$config['file_name'] = $fototoko;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload("foto_toko"))
				{
					$error = $this->upload->display_errors();
					echo "<script>alert('$error');</script>";
				}
				else
				{
					$info = $this->upload->data();
					$foto = $info["file_name"];
					if($this->Model->updateTokofoto($data['toko']->id_toko,$toko,$telp,$link,$slogan,$about,$provinsi,$kota,$kecamatan,$kodepos,$alamat,$foto)>0) //insert jika berhasil return 1
					{
						echo "<script>alert('Berhasil Update');</script>";
					}
					else{
						echo "<script>alert('Gagal Update');</script>";
					}
				}
			}
			$data['toko']= $this->Model->getToko($this->session->userdata('id_login'));
			$this->load->view('tokojualan', $data);

		} else {
			echo "<script>alert('Field Tidak boleh kosong!!')</script>";
			$data["error"] = validation_errors();
			$this->load->view('toko', $data);
		}
	}


	public function updatingBarang()
	{      
		if($this->input->post('update')){
			$id_toko=$this->input->post("id_toko");
			$id = $this->input->post("id_barang");
			$namabarang = $this->input->post("nama");
			$stok = $this->input->post("stok");
			$harga = $this->input->post("harga");
			$deskripsi = $this->input->post("deskripsi");
			$kategori = $this->input->post("kategori");
			$merk = substr($namabarang,0,strpos($namabarang," "));
			$tempmerk = $this->Model->getmerk($merk);
			$idmerk='';
			foreach($tempmerk as $row) {
			  $idmerk = $row->id_merk;	
			}
		  	if($_FILES['foto']['size'] == 0) {
			    
				$this->Model->updatetanpafoto($id,$namabarang,$stok,$harga,$deskripsi,$kategori,$idmerk,$id_toko);
				$this->ke_toko();
		  	}
			else if($_FILES['foto']['size'] > 0){
				   //redirect('Admin/updatepakefoto');
				$config['upload_path'] = './resource/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['overwrite'] = TRUE;
				$config['file_name'] = $namabarang;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload("foto"))
				{
					$error = $this->upload->display_errors();
					echo "<script>alert('$error');</script>";
				}
				else
				{
					$info = $this->upload->data();
					$foto = $info["file_name"];
					if($this->Model->updatepfoto($id,$namabarang,$stok,$harga,$deskripsi,$idmerk,$kategori,$foto,$id_toko)>0) //insert jika berhasil return 1
					{
						echo "<script>alert('Berhasil Update');</script>";
						$this->ke_toko();
					}
					else{
						echo "<script>alert('Gagal Update');</script>";
						$this->ke_toko();
					}
					$count_detail=count($_FILES['files']['name']);
			for ($i=0; $i < $count_detail; $i++) { 
				if(!empty($_FILES['files']['name'][$i])){
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$konfig['upload_path'] = './detail/'; 
					$konfig['allowed_types'] = 'jpg|jpeg|png';
					$config['overwrite'] = TRUE;
					$konfig['file_name'] = $namabarang.$i;

					// $this->load->library('upload',$konfig);
					$this->upload->initialize($konfig);
					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						$data['filenames'][] = $filename;
						$this->Model->updatedetailbarang($kode,$filename);
					}
				}
			}
				}
			}
		}
		else if($this->input->post('back')){
			$this->ke_toko();
		}
	}

	public function tambah_barang()
	{
		$blog=$this->input->post('blog');
		$isi_blog=$this->input->post('isiblog');
	    $namabarang = $this->input->post("nama");
		$post = $this->input->post();
		$tempid='';
	  	$id_toko = $this->input->post("id_toko");
	    $stok = $this->input->post("stok");
	    $harga = $this->input->post("harga");
	    $deskripsi = $this->input->post("deskripsi");
	    $kategori = $this->input->post("kategori");
	    $merk = substr($namabarang,0,strpos($namabarang," "));
		$tempmerk = $this->Model->getmerk($merk);
		$idmerk='';
		foreach($tempmerk as $row) {
		  $idmerk = $row->id_merk;	
		}
		$tempid = $this->Model->getLastIdBarang();
		$id = $tempid+1;
		$kode = "B".str_pad($id, 5, "0",STR_PAD_LEFT);
		$config['upload_path'] = './resource/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $namabarang;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload("foto"))
		{
			$data["error"] = $this->upload->display_errors();
			if($blog=="1"){
				echo "<script>alert('Blog harus disertai pembuatan barang!!');</script>";
			}
			else{
				echo "<script>alert('Format foto salah');</script>";
			}
		}
		else
		{
			$info = $this->upload->data();
			$foto = $info["file_name"];
			$this->Model->insertbarang($kode,$namabarang,$stok,$harga,$deskripsi,$idmerk,$kategori,$foto,$id_toko,0);
			echo "<script>alert('Upload foto barang Sukses!!')</script>";
			$count_detail=count($_FILES['files']['name']);
			for ($i=0; $i < $count_detail; $i++) { 
				if(!empty($_FILES['files']['name'][$i])){
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$konfig['upload_path'] = './detail/'; 
					$konfig['allowed_types'] = 'jpg|jpeg|png';
					$config['overwrite'] = TRUE;
					$konfig['file_name'] = $namabarang.$i;

					$this->upload->initialize($konfig);
					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						$data['filenames'][] = $filename;
						$this->Model->insertdetailbarang($kode,$filename);
					}
				}
			}

			if($blog=="1"){
				//nambah blog
				//gambar tampilan blog
				$configblog['upload_path'] = './ikonblog/';
				$configblog['allowed_types'] = 'jpg|jpeg|png';
				$configblog['overwrite'] = TRUE;
				$configblog['file_name'] = $namabarang;
				$this->upload->initialize($configblog);
				if ($this->upload->do_upload('foto_blog')){
					$uploadData = $this->upload->data();
					$namafile=$uploadData['file_name'];
					$this->Model->insertBlog($kode,$isi_blog,$namafile);
					echo "<script>alert('Upload foto blog Sukses!!')</script>";
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
							$configg['overwrite'] = TRUE;
							$konfigg['file_name'] = $namabarang.$i;

							$this->upload->initialize($konfigg);
							if($this->upload->do_upload('file')){
								$uploadData = $this->upload->data();
								$filename = $uploadData['file_name'];

								$data['filenames'][] = $filename;
								$this->Model->insertGambarBlog($kode,$filename);
							}
						}
					}
				}
				else{
					echo "<script>alert('Gambar Blog salah!!')</script>";
				}
			}
		}	
		$this->ke_toko();
	}

	public function ke_forget_pass()
	{
		$this->load->view('forgetpass');
	}

	public function generateRandomString() {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 10; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function forget_pass()
	{
		$pass = $this->generateRandomString();
		$database_pass = password_hash($pass,PASSWORD_DEFAULT);
		$email= $this->input->post('email');
		if($this->Model->isEmailExist($email)){
			$this->session->set_userdata('email',$email);
			$this->session->set_userdata('new_pass',$pass);
			$this->Model->updatePassword($email, $database_pass);
			redirect('/Mailer/sendpass');	
			// $this->load->view('forgetpass');
		}
		else{
			$data['email_error']="Tidak ada email";
			$this->load->view('forgetpass', $data);
		}
	}

	public function login() 
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$temp = $this->Model->selectAllUser();
		$tampung = "";
		$cek = false;
		$adaemail = false;
		$passBenar=false;
		$getAdmin = $this->Model->getAdmin();
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run()==TRUE) {

			if($email == $getAdmin->user_admin && $pass == $getAdmin->pass_admin)
			{
				redirect(site_url("Admin/user"));
			}
			else 
			{
				foreach ($temp as $t) 
				{
					if($email == $t->Email)
					{
						$adaemail=true;
						if(password_verify($pass,$t->Password))
						{
							$passBenar=true;
							if($this->Model->isUserVerified($email))
							{
								$cek = true;
								$tampung = $t->Nama_user;
								$id_tampung = $t->Id_user;
							}
						}						
					}
				}
				if($cek == true)
				{
						echo "<script>alert('Sukses Login!')</script>";
						$data['nama'] = $tampung;
						$this->session->set_userdata('login',$data['nama']);
						$this->session->set_userdata('id_login',$id_tampung);
						$this->index();
				}
				else
				{
					$error="";
					if($adaemail==false){
						$data['email_error']="Email tidak ditemukan";
						$error = $error."Email belum register!<br>";
					}
					if($passBenar==false){
						$data['pass_salah']="Password tidak sesuai";
						$error = $error."Password salah!<br>";
					}
					if($adaemail && $passBenar && $cek==false){
						$data['email_error']="Email belum di verifikasi";
						$error = $error."Email belum di verifikasi!<br>";
					}
					echo "<script>alert('Gagal Login:".$error."')</script>";
					$data['jualan']=$this->Model->selectAllbarang();	
	    			$data['kategori'] = $this->Model->getKategori();
	    			$data['merk'] = $this->Model->getJumlahMerk();
					$data['error'] = $error;
	    			$data['slider']= $this->Model->selectSlider();
	    			$jumlah = $this->Model->cekStatusPromo();
	    			$this->load->view("index",$data);
				}
			}
		} 
		else {
			$data['jualan']=$this->Model->selectAllbarang();	
			$data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			$data['slider']= $this->Model->selectSlider();
			$jumlah = $this->Model->cekStatusPromo();
			$this->load->view("index",$data);
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('login');
		$this->index();
	}

	public function register()
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$conpass= $this->input->post('conpass');
		$alamat = "";
		$telp = "";
		$this->form_validation->set_rules('email','Email','required|is_unique[user.email]|valid_email');
		$this->form_validation->set_rules('nama','Nama','required|alpha|min_length[4]');
		$this->form_validation->set_rules('password','Password','required|min_length[4]');
		$this->form_validation->set_rules('conpass','Confirm Password','required|matches[password]');
		$this->form_validation->set_message('required', "%s tidak boleh kosong");
		$this->form_validation->set_message('is_unique', "{field} sudah digunakan");
		$this->form_validation->set_message('alpha', "%s hanya boleh mengandung alphabet");
		$this->form_validation->set_message('valid_email', "%s harus valid");
		$this->form_validation->set_message('min_length', "{field} tidak boleh kurang dari {param}");
		$this->form_validation->set_message('matches', "{field} harus sama dengan {param}");
		$this->form_validation->set_message('regex_match', "{field} harus valid");
		if($this->form_validation->run() && $this->Model->register($nama, $email,$pass,$alamat,$telp))
		{				
				// echo "<script>alert('Sukses Register!')</script>";
				$this->session->set_userdata('email',$email);
				redirect('/Mailer/sendemail');
		}
		else
		{
			echo "<script>alert('Persyaratan field tidak sesuai!')</script>";
			$data['jualan']=$this->Model->selectAllbarang();
			$data['kategori'] = $this->Model->getKategori();
			$data['merk'] = $this->Model->getJumlahMerk();
			$data['slider']= $this->Model->selectSlider();
			$jumlah = $this->Model->cekStatusPromo();
			$data["error"]=validation_errors();
			$this->load->view("index",$data);
		}
	}
	
	
}
