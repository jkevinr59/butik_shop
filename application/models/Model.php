<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {
	
public function __construct(){
        parent:: __construct();
        $this->load->database();
    }
	//USER SECTION
	public function register($nama,$email,$pass,$alamat,$telp)
	{
		$data = array(
			'Nama_user' => $nama,
			'Email' => $email,
			'Password' => password_hash($pass,PASSWORD_DEFAULT),
			'Alamat' => $alamat,
			'NoTelp' => $telp
		);

		return $this->db->insert('user', $data);
	}

	public function getAdmin()
	{
		$this->db->select('*');
		$this->db->from('admin');
		return $this->db->get()->row();
	}

	public function updateAdmin($userLama,$userBaru,$passBaru)
	{
		$data = array(
			'user_admin' =>$userBaru,
			'pass_admin' =>$passBaru
		);
		$this->db->where('user_admin', $userLama);
		return $this->db->update('admin', $data);
	}

	public function gantiVerify($id_user='')
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('Id_user', $id_user);
		$result = $this->db->get()->row();
		$new=-1;
		if($result->Status_verify==1){
			$new = 0;
		}
		else{
			$new = 1;
		}
		$data = array(
			'Status_verify' => $new
		);
		$this->db->where('Id_user', $id_user);
		return $this->db->update('user', $data);
	}

	public function getToko($Email)
	{
		$this->db->select('*');
		$this->db->from('toko');
		$this->db->where('id_pemilik', $Email);
		return $this->db->get()->row();
	}

	public function getTokoLink($link)
	{
		$this->db->select('*');
		$this->db->from('toko');
		$this->db->where('link', $link);
		return $this->db->get()->row();
	}

	public function openToko($id_user)
	{
		$data= array(
			'id_pemilik'=>$id_user,
		);
		return $this->db->insert('toko', $data);
	}

	public function updateToko($id_toko,$nama_toko,$telp_toko,$link,$slogan,$about,$provinsi,$kota,$kecamatan,$kodepos,$alamat)
	{
		$data= array(
			'nama_toko'=>$nama_toko,
			'telp_toko'=>$telp_toko,
			'link'=>$link,
			'slogan'=>$slogan,
			'about'=>$about,
			'provinsi'=>$provinsi,
			'kota'=>$kota,
			'kecamatan'=>$kecamatan,
			'kodepos'=>$kodepos,
			'alamat_toko'=>$alamat,
		);
		$this->db->where('id_toko', $id_toko);
		return $this->db->update('toko', $data);
	}

	public function updateTokofoto($id_toko,$nama_toko,$telp_toko,$link,$slogan,$about,$provinsi,$kota,$kecamatan,$kodepos,$alamat,$foto)
	{
		$data= array(
			'nama_toko'=>$nama_toko,
			'telp_toko'=>$telp_toko,
			'link'=>$link,
			'slogan'=>$slogan,
			'about'=>$about,
			'provinsi'=>$provinsi,
			'kota'=>$kota,
			'kecamatan'=>$kecamatan,
			'kodepos'=>$kodepos,
			'alamat_toko'=>$alamat,
			'foto_toko'=>$foto
		);
		$this->db->where('id_toko', $id_toko);
		return $this->db->update('toko', $data);
	}

	public function getJualan($toko)
	{
		$id= $toko;
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('id_toko', $toko);
		return $this->db->get()->result();
	}

	public function getuserprofile($nama)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('Nama_user',$nama);
		return $this->db->get()->row();
	}
	
	public function selectAllUser()
	{
		$this->db->select('*');
		$this->db->from('user');
		return $this->db->get()->result();
	}

	public function selectToko()
	{
		$this->db->select('*');
		$this->db->from('toko');
		return $this->db->get()->result();
	}

	public function selectSlider()
	{
		$sql = "SELECT * FROM barang a, slider s WHERE a.barang_id=s.id_barang";
		return $this->db->query($sql)->result();
	}

	public function updateSlider($id_lama,$id_baru)
	{
		$data=array(
			'id_barang' =>$id_baru
		);
		$this->db->where('id_barang', $id_lama);
		return $this->db->update('slider', $data);
	}

	public function selectAllbarang()
	{
		$this->db->select('*');
		$this->db->from('barang');
		return $this->db->get()->result();
	}

	public function selectAllbarangBukanSlider()
	{
		$sql = "SELECT * FROM barang t1 LEFT JOIN slider t2 ON t2.id_barang = t1.barang_id WHERE t2.id_barang IS NULL";
		return $this->db->query($sql)->result();
	}

	public function selectPertokoBukti($id_toko='')
	{
		$sql="SELECT dtrans.Notajual,REPLACE(barang.foto,' ','%20'),barang.barang_nama,dtrans.Jumlah,barang.harga_satuan,dtrans.Subtotal,dtrans.Status_order,htrans.Status_pembayaran FROM dtrans,htrans,barang WHERE dtrans.Id_barang=barang.barang_id AND htrans.Notajual=dtrans.Notajual AND barang.id_toko=$id_toko ORDER BY `dtrans`.`Notajual` ASC";
		return $this->db->query($sql)->result();
	}

	public function getJualanoranglain($id_toko)
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('id_toko !=', $id_toko);
		return $this->db->get()->result();
	}

	public function getSearchJualanoranglain($id_toko,$key)
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('id_toko !=', $id_toko);
		$this->db->like('barang_nama', '%'.$key."%");
		return $this->db->get()->result();
	}

	public function getIdUser($nama)
	{
		$this->db->select('Id_user');
		$this->db->from('user');
		$this->db->where('Nama_user',$nama);
		return $this->db->get()->result();
	}
	
	public function getId($nama)
	{
	  $result = $this->db->select('Id_user')->from('user')->where('Nama_user',$nama)->get()->result_array();
		return isset($result[0]) ? $result[0]['Id_user'] : -1;
	}

	public function isUserVerified($email)
	{
		$result = $this->db->select('Status_verify')->from('user')->where('Email',$email)->get()->result_array();
		return isset($result[0]) ? $result[0]['Status_verify'] : -1;
	}

	public function isEmailExist($email)
	{
		return $this->db->select('*')
			->from('user')
			->where('Email', $email)
			->count_all_results();
	}

	public function verifyEmail($email)
	{
		if(!$this->Model->isEmailExist($email))
		{
			return false;
		}
		$data = array('Status_verify' => 1);
		return $this->db->where('Email',$email)->update('user',$data);
	}

	public function updateprofile($nama,$password,$alamat,$telp,$id)
	{
		if($password==""){
			$data = array(
				'Nama_user' => $nama,
				'Alamat' => $alamat,
				'NoTelp' => $telp
			);
		}
		else{
			$data = array(
				'Nama_user' => $nama,
				'Password' =>  password_hash($password,PASSWORD_DEFAULT),
				'Alamat' => $alamat,
				'NoTelp' => $telp
			);	
		}
		$this->db->where('Id_user',$id);
		$this->db->update('user',$data);

	}

	public function updatePassword($email, $newpass)
	{
		$data=[
			'Password'=>$newpass
		];
		$this->db->where('Email', $email);
		$this->db->update('user', $data);
	}
	public function updateprofilefoto($nama,$password,$alamat,$telp,$id,$foto)
	{
		if($password==""){
			$data = array(
				'Nama_user' => $nama,
				'Alamat' => $alamat,
				'NoTelp' => $telp,
				'foto_user'=>$foto
			);
		}
		else {
			$data = array(
				'Nama_user' => $nama,
				'Password' =>  password_hash($password,PASSWORD_DEFAULT),
				'Alamat' => $alamat,
				'NoTelp' => $telp,
				'foto_user'=>$foto
			);
		}
		$this->db->where('Id_user',$id);
		$this->db->update('user',$data);

	}
	//PROMO SECTION
	public function showpromo()
	{
		return $this->db->select('*')->from('promo')->get()->result();
	}

	public function getKodePromo($kode)
	{
		return $this->db->select('Id_promo')->from('promo')->where('Kode_promo',$kode)->get()->result();
	}

	public function isPromoStillExist($kode)
	{
		return $this->db->select('Status')->from('promo')->where('Kode_promo',$kode)->get()->count_all_results();
	}

	public function EndPromo($kode)
	{
		$data = array('Status' => 1);
		$this->db->where('Kode_promo',$kode);
		$this->db->update('promo',$data);
	}

	public function cekStatusPromo()
	{
			$tgl = $this->db->select('*')->from('promo')->get()->result();
			$tglmulai ='';
			$tglberakhir='';
			foreach($tgl as $row)
			{
				$tglmulai = $row->Tanggal_mulai;
				$tglberakhir = $row->Tanggal_berakhir;
				$tglsekarang = date("Y-m-d");
				if($tglsekarang>=$tglmulai && $tglsekarang<=$tglberakhir) //sedang berlangsung
				{
					$arr = array('Status' => 1);
					$this->db->where('Id_promo',$row->Id_promo);
					$this->db->update('promo',$arr);
				}
				else if($tglsekarang<$tglmulai) //belum berlangsung
				{
					$arr = array('Status' => 0);
					$this->db->where('Id_promo',$row->Id_promo);
					$this->db->update('promo',$arr);
				}
				else if($tglsekarang>$tglberakhir) //berakhir
				{
					$arr = array('Status' => 2);
					$this->db->where('Id_promo',$row->Id_promo);
					$this->db->update('promo',$arr);
				}

			}
	}

	public function deletepromo($id)
	{
		$this->db->where('Id_promo',$id);
		$this->db->delete('promo');
	}

	public function insertpromo($nama,$jenis,$kode,$tglmulai,$tglberakhir,$persendiskon)
			{
			      $data = array(
			      	'Nama_promo' => $nama, 
			      	'Jenis_promo' => $jenis,
			      	'Persen_diskon' => $persendiskon,
			      	'Kode_promo' => $kode,
		 			'Tanggal_mulai' => $tglmulai ,
		 			'Tanggal_berakhir' => $tglberakhir,
		 			'Status' => 0
			      );
			     $this->db->insert('promo', $data);
			}

	public function insertpromo2($nama,$jenis,$kode,$tglmulai,$tglberakhir)
	{
	      $data = array(
	      	'Nama_promo' => $nama, 
	      	'Jenis_promo' => $jenis,
	      	'Kode_promo' => $kode,
 			'Tanggal_mulai' => $tglmulai ,
 			'Tanggal_berakhir' => $tglberakhir,
 			'Status' => 0
	      );
	     $this->db->insert('promo', $data);
	}


	public function updatepromo($nama,$id,$tglmulai,$tglberakhir)
	{
		$data = array(
			'Nama_promo' => $nama,
			'Tanggal_mulai' => $tglmulai,
			'Tanggal_berakhir' => $tglberakhir 
		);
		$this->db->where('Id_promo',$id);
		$this->db->update('promo',$data);
	}

	public function updatepromo2($nama,$id,$tglmulai,$tglberakhir,$persendiskon)
	{
		$data = array(
			'Nama_promo' => $nama,
			'Tanggal_mulai' => $tglmulai,
			'Tanggal_berakhir' => $tglberakhir,
			'Persen_diskon' => $persendiskon
		);
		$this->db->where('Id_promo',$id);
		$this->db->update('promo',$data);
	}

	//cek promo masih valid atau tidak
	public function cekpromo($kode)
	{
		$temp = $this->db->select('*')->from('promo')->where('Kode_promo',$kode)->get()->num_rows();
		if($temp<=0) //promo tidak ada
		{
			return false;
		}
		else
		{
			$tgl = $this->db->select('Tanggal_mulai')->select('Tanggal_berakhir')->from('promo')->where('Kode_promo',$kode)->get()->result();
			$tglmulai ='';
			$tglberakhir='';
			foreach($tgl as $row)
			{
				$tglmulai = $row->Tanggal_mulai;
				$tglberakhir = $row->Tanggal_berakhir;
			}
			$tglsekarang = date("Y-m-d");
			if($tglsekarang>=$tglmulai && $tglsekarang<=$tglberakhir)
			{
				return true;
			}
			else
			{
				return false;
			}
		
		}
		
	}

	public function cekPromoBuy2($iduser) //cek apakah barang sudah 3
	{
		$sql = $this->db->query("SELECT SUM(jumlah) as jumlah FROM cart where id_user=".$iduser." group by id_user");
		return $sql->result();
	}

	public function getMinId($iduser)
	{
		$sql = $this->db->query("SELECT MIN(id_barang) as id from cart where id_user=".$iduser." group by subtotal order by subtotal desc limit 1");
		return $sql->result();
	}

	public function setLaptopFree($iduser)
	{
		// $sql = $this->Model->getMinId($iduser);
		// $idbarang='';
		// foreach($sql as $row)
		// {
		// 	$idbarang = $row->id;
		// }
		// $where = array(
		// 		'id_barang' => $idbarang,
		// 		'id_user' => $iduser 
		// 	);
		// $tempjumlah = $this->db->select('jumlah')->from('cart')->where($where)->get()->result();
		// $jumlah=0;
		// foreach($tempjumlah as $row)
		// {
		// 	$jumlah=$row->jumlah;
		// }
		// $jumlah = intval($jumlah);
		// if($jumlah>1)
		// {
		// 	$tempharga = $this->Model->getPrice($idbarang);
		// 	$harga = 0;
		// 	foreach($tempharga as $row)
		// 	{
		// 		$harga = $row->harga_satuan;
		// 	}	
		// 	$tempsub = $this->db->select('subtotal')->from('cart')->where($where)->get()->result();
		// 	$subtotal = 0;
		// 	foreach($tempsub as $row)
		// 	{
		// 		$subtotal = $row->subtotal;
		// 	}
		// 	$total = $subtotal-$harga;
		// 	//echo "<script>alert(".$total.")</script>";
		// 	$data = array(
		// 		'subtotal' => $total
		// 	);
		// 	$this->db->where($where);
		// 	$this->db->update('cart',$data);	
		// }
		// else{
		// 	$arr = array('subtotal' => 0);
		// 	$this->db->where('id_barang',$idbarang);
		// 	$this->db->update('cart',$arr);
		// }
	}

	public function getpersendiskon($kode)
	{
		$temp = $this->db->select('*')->from('promo')->where('Kode_promo',$kode)->get()->result();
		$persen = 0;
		foreach($temp as $row)
		{
			$persen = $row->Persen_diskon;
		}
		return $persen;
	}

	public function getJenisPromo($kode)
	{
		return $this->db->select('Jenis_promo')->from('promo')->where('Kode_promo',$kode)->get()->result();
	}
	

	//BLOG SECTION
	public function selectBlog()
	{
		$sql="SELECT * FROM isiblog LEFT JOIN barang ON isiblog.id_barang=barang.barang_id ORDER BY `isiblog`.`tgl_blog` DESC";
		return $this->db->query($sql)->result();
	}

	public function searchBlog($id)
	{
		$this->db->select('*');
		$this->db->from('isiblog');
		$this->db->where('id_barang', $id);
		return $this->db->get()->row();
	}

	public function selectBlogtampil()
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('tampil_blog', 1);
		return $this->db->get()->result();
	}

	public function delete_Blog($idblog)
	{
		$this->db->where('id_barang', $idblog);
		$this->db->delete('isiblog');
	}

	public function insertBlog($id_barang,$isi,$foto)
	{
		$object=[
			"id_barang"=>$id_barang,
			'isi'=>$isi,
			'foto_blog'=>$foto,
			'tgl_blog'=>date("Y-m-d")
		];
		return $this->db->insert('isiblog', $object);
	}

	public function insertGambarBlog($id_barang,$foto)
	{
		$object=[
			'id_barang'=>$id_barang,
			'gambar'=>$foto
		];
		return $this->db->insert('gambar_blog', $object);
	}

	public function deleteGambarBlog($idbarang)
	{
		$this->db->where('id_barang', $idbarang);
		$this->db->delete('gambar_blog');
	}

	public function selectgambarblog($id)
	{
		$this->db->select('*');
		$this->db->from('gambar_blog');
		$this->db->where('id_barang', $id);
		return $this->db->get()->result();
	}

	//NO DETAIL
	public function updateblogNoFotoNoDetail($id,$isi,$idbaru)
	{
		$object=[
			'isi'=>$isi,
			'id_barang'=>$idbaru
		];
		$this->db->where('id_barang', $id);
		$this->db->update('isiblog', $object);
		$object=[
			'id_barang'=>$idbaru
		];
		$this->db->where('id_barang', $id);
		$this->db->update('gambar_blog', $object);
	}
	public function updateblogNoDetail($id,$isi,$foto,$idbaru)
	{
		$object=[
			'isi'=>$isi,
			'foto_blog'=>$foto,
			'id_barang'=>$idbaru
		];
		$this->db->where('id_barang', $id);
		$this->db->update('isiblog', $object);
		$object=[
			'id_barang'=>$idbaru
		];
		$this->db->where('id_barang', $id);
		$this->db->update('gambar_blog', $object);
	}

	//WITH DETAIL
	public function updateblogWithDetail($id,$isi,$foto,$idbaru)
	{
		$object=[
			'isi'=>$isi,
			'foto_blog'=>$foto,
			'id_barang'=>$idbaru
		];
		$this->db->where('id_barang', $id);
		$this->db->update('isiblog', $object);
	}

	public function updateblogNoFotoWithDetail($id,$isi,$idbaru)
	{
		$object=[
			'isi'=>$isi,
			'id_barang'=>$idbaru
		];
		$this->db->where('id_barang', $id);
		$this->db->update('isiblog', $object);
	}

	//BARANG SECTION
	public function selectBarangBlog()
	{
		$sql="SELECT barang.barang_id,barang.barang_nama,barang.foto,isiblog.isi FROM barang LEFT JOIN isiblog ON barang.barang_id=isiblog.id_barang";
		return $this->db->query($sql)->result();
	}

	public function selectbarang() {
		return $this->db->select("*")->from("barang")->get();
	}

	public function baranglaris()
	{
		$sql="SELECT Id_barang,SUM(`Jumlah`) AS Jumlah FROM `dtrans` GROUP BY `Id_barang` ORDER BY Jumlah DESC";
		return $this->db->query($sql)->result();
	}

	public function barangratingbagus()
	{
		$sql="SELECT barang_id,AVG(star) AS star FROM `rating` GROUP BY barang_id ORDER BY star DESC";
		return $this->db->query($sql)->result();
	}

	public function selectBestSeller()
	{
		$sql="SELECT * FROM (SELECT Id_barang,SUM(`Jumlah`) AS Jumlah FROM `dtrans` GROUP BY `Id_barang` ORDER BY Jumlah DESC) AS laris LEFT JOIN (SELECT barang_id,AVG(star) AS star FROM `rating` GROUP BY barang_id ORDER BY star DESC) AS toprate on toprate.barang_id=laris.Id_barang UNION SELECT * FROM (SELECT Id_barang,SUM(`Jumlah`) AS Jumlah FROM `dtrans` GROUP BY `Id_barang` ORDER BY Jumlah DESC) AS laris RIGHT JOIN (SELECT barang_id,AVG(star) AS star FROM `rating` GROUP BY barang_id ORDER BY star DESC) AS toprate on toprate.barang_id=laris.Id_barang";
		return $this->db->query($sql)->result();
	}

	public function addrate($id_user,$idbarang,$rate,$komen,$date)
	{
		$object=[
			'user'=>$id_user,
			'barang_id'=>$idbarang,
			'star'=>$rate,
			'komentar'=>$komen,
			'date'=>$date
		];
		return $this->db->insert('rating', $object);
	}

	public function selectrating($idbarang)
	{
		$sql="SELECT rating.*,user.Nama_user AS 'nama_user',user.foto_user AS foto_user FROM `rating`,user WHERE rating.user=user.Id_user AND rating.barang_id='".$idbarang."'";
		return $this->db->query($sql)->result();
	}
	
	public function select_merk()
	{
		return $this->db->select('*')->from('merk')->get()->result();
	}
	
	public function selectbarangbyid($id) 
	{
		return $this->db->select('*')->from('barang')->where('barang_id',$id)->get()->row();
	}
	
	public function getPrice($idbarang) 
	{
		return $this->db->select('harga_satuan')->from('barang')->where('barang_id',$idbarang)->get()->result();
	}

	public function fetch($limit,$start){
		if($this->session->userdata('toko_terpilih')==false || $this->session->userdata('toko_terpilih')=="false"){
			$end = $this->db->select('*')->from('barang')->limit($limit,$start)->get()->result();
		}
		else{
			$end = $this->db->select('*')->from('barang')->where('id_toko',$this->session->userdata('toko_terpilih'))->limit($limit,$start)->get()->result();
		}
        return $end;
    }
	
	public function fetchsearch($key){
        $result = $this->db->select('*')->from('barang')->like('barang_nama',$key)->get();
		var_dump($result,$key);
		die;
		return $result;
    }
	//lebih dari 9 barang
	public function sortbarangbykategori($limit,$start,$id,$sort) {
		if($sort==2) {
		  	  return $this->db->select('*')->from('barang')->limit($limit,$start)->where('id_kategori',$id)->order_by('harga_satuan','desc')->get()->result();
		}
		else if($sort==3){
		   return $this->db->select('*')->from('barang')->limit($limit,$start)->where('id_kategori',$id)->order_by('harga_satuan','asc')->get()->result();
		}
	}
	
	public function sortbarangbymerk($limit,$start,$id,$sort) {
		if($sort==2) {
		  	  return $this->db->select('*')->from('barang')->limit($limit,$start)->where('id_merk',$id)->order_by('harga_satuan','desc')->get()->result();
		}
		else if($sort==3){
		   return $this->db->select('*')->from('barang')->limit($limit,$start)->where('id_merk',$id)->order_by('harga_satuan','asc')->get()->result();
		}
	}
	//kurang dari 9 barang
	public function sortbarangkategori($id,$sort)
	{
		if($sort==2) {
		  	  return $this->db->select('*')->from('barang')->where('id_kategori',$id)->order_by('harga_satuan','desc')->get()->result();
		}
		else if($sort==3){
		   return $this->db->select('*')->from('barang')->where('id_kategori',$id)->order_by('harga_satuan','asc')->get()->result();
		}
	}
	
	public function sortbarangmerk($id,$sort)
	{
		if($sort==2) {
		  	  return $this->db->select('*')->from('barang')->where('id_merk',$id)->order_by('harga_satuan','desc')->get()->result();
		}
		else if($sort==3){
		   return $this->db->select('*')->from('barang')->where('id_merk',$id)->order_by('harga_satuan','asc')->get()->result();
		}
	}
	
	public function jumlahsearch($keyword) {
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->like('barang_nama',$keyword);
		return $this->db->get()->num_rows();
	}
	
	public function jumlahHasilSearch($key,$id_toko)
	{
		if($id_toko!=null){
			$sql = $this->db->query("SELECT count(*) as jumlah from barang where barang_nama like '%".$key."%' and id_toko not like '%".$id_toko."%'");
		}
		else{$sql = $this->db->query("SELECT count(*) as jumlah from barang where barang_nama like '%".$key."%'");
		}
		return $sql->result();
	}
	
	public function search($keyword,$limit,$start) {
		 return $this->db->select('*')->from('barang')->limit($limit,$start)->like('barang_nama',$keyword,'both')->get()->result();
	}
	
	public function getLastIdBarang() {
	  return $this->db->select('*')->from('barang')->order_by('barang_id','desc')->count_all_results();
	}

	public function selectDetailFoto($id)
	{
		$this->db->select('*');
		$this->db->from('foto_detail');
		$this->db->where('id_barang', $id);
		return $this->db->get()->result();
	}
	
	public function insertbarang($id,$nama,$stok,$harga,$deskripsi,$id_merk,$id_kategori,$foto,$id_toko) {
		$data = array(
			'barang_id' => $id,
			'barang_nama' => $nama,
			'barang_stok' => $stok,
			'harga_satuan' => $harga,
			'deskripsi' => $deskripsi,
			'id_merk' => $id_merk,
			'id_kategori' => $id_kategori,
			'foto' => $foto,
			'id_toko'=>$id_toko,
		);
		return $this->db->insert('barang', $data);
	}



	public function insertdetailbarang($id,$foto)
	{
		$data=[
			'id_barang'=>$id,
			'nama_gambar'=>$foto
		];
		return $this->db->insert('foto_detail', $data);
	}

	public function updatedetailbarang($id,$foto)
	{
		$this->db->where('nama_gambar', $foto);
		$this->db->where('id_barang', $id);
		$this->db->delete('foto_detail');
		$data=[
			'id_barang'=>$id,
			'nama_gambar'=>$foto
		];
		return $this->db->insert('foto_detail', $data);
	}

	public function deletebarang($id) 
	{
		$this->db->where('barang_id',$id);
		$this->db->delete('barang');
	}
	
	public function updatetanpafoto($id,$namabarang,$stok,$harga,$deskripsi,$kategori,$merk,$id_toko)
	{
		$data = array(
			'barang_nama' => $namabarang,
			'barang_stok' => $stok,
			'harga_satuan' => $harga,
			'deskripsi' => $deskripsi,
			'id_merk' => $merk,
			'id_kategori' => $kategori
		);
		$this->db->where('barang_id',$id);
		$this->db->where('id_toko', $id_toko);
		$this->db->update('barang',$data);
	}
	//update pakai foto
	public function updatepfoto($id,$namabarang,$stok,$harga,$deskripsi,$kategori,$merk,$foto,$id_toko)
	{
		$data = array(
			'barang_nama' => $namabarang,
			'barang_stok' => $stok,
			'harga_satuan' => $harga,
			'deskripsi' => $deskripsi,
			'id_merk' => $merk,
			'id_kategori' => $kategori,
			'foto' => $foto
		);
		$this->db->where('barang_id',$id);
		$this->db->where('id_toko', $id_toko);
		$this->db->update('barang',$data);
	}
	
	public function getSearch($key,$id_toko)
	{
		if($id_toko==null){
	   		$sql = $this->db->query("SELECT * from barang where barang_nama like '%".$key."%'");
		}
		else{
	   		$sql = $this->db->query("SELECT * from barang where barang_nama like '%".$key."%' and id_toko not like '%".$id_toko."%'");	
		}
		return $sql->result();
	}
	
	public function getFoto($idbarang)
	{
		return $this->db->select('foto')->from('barang')->where('barang_id',$idbarang)->get()->result();
	}
	//KATEGORI & MERK
	public function getMerk($merk)
	{
	   	return $this->db->select('id_merk')->from('merk')->where('nama_merk',$merk)->get()->result();
	}
	
	public function getAllMerk()
	{
	   	return $this->db->select('nama_merk')->from('merk')->get()->result();
	}
	
	public function getJumlahMerk()
	{
		$sql = $this->db->query("SELECT m.id_merk as id,m.nama_merk as nama,count(b.id_merk) as jumlah from barang b,merk m where b.id_merk = m.id_merk group by b.id_merk order by 1");
		return $sql->result();
	}
	
	public function getKategori()
	{
		return $this->db->select('*')->from('kategori')->get()->result();
	}
	
	public function fetchkategori($limit,$start,$id,$id_toko) {
	   return $this->db->select('*')->from('barang')->limit($limit,$start)->where('id_kategori',$id)->not_like('id_toko',$id_toko)->get()->result();
	}
	
	public function fetchmerk($limit,$start,$id,$id_toko) {
	   return $this->db->select('*')->from('barang')->limit($limit,$start)->where('id_merk',$id)->not_like('id_toko',$id_toko)->get()->result();
	}
	
	public function getBarangByKategori($id,$id_toko)
	{
	   return $this->db->select('*')->from('barang')->where('id_kategori',$id)->not_like('id_toko',$id_toko)->get()->result();	
	}
	
	public function getBarangByMerk($id,$id_toko)
	{
	   return $this->db->select('*')->from('barang')->where('id_merk',$id)->not_like('id_toko',$id_toko)->get()->result();	
	}
	
	public function JumlahKategori($id,$id_toko)
	{
		$sql = $this->db->query("SELECT count(*) as jumlah from barang where id_kategori='$id' and id_toko not like '%$id_toko%' group by id_kategori");
		return $sql->result();
	}
	
	public function JumlahMerk($id,$id_toko)
	{
		$sql = $this->db->query("SELECT count(*) as jumlah from barang where id_merk='$id' and id_toko not like '%$id_toko%'group by id_merk");
		return $sql->result();
	}

	//CART SECTION
	public function insertcart($idbarang,$nama,$jumlah,$size)
	{
		$temp = $this->Model->getIdUser($nama);
		$iduser='';
		$tmp = $this->Model->getPrice($idbarang);
		$harga = 0;
		foreach($temp as $row)
		{
			$iduser=$row->Id_user;

		}
		foreach($tmp as $row) 
		{
			$harga = $row->harga_satuan;
		}
		$arr = array(
			'id_barang' => $idbarang,
			'id_user' => $iduser,
			'size'=>$size 
		);
		$sql = $this->db->select('id_barang')->from('cart')->where($arr)->get()->result();
		$cek=false;
		foreach($sql as $val)
		{
			if($val->id_barang!=null)
			{
				$cek=true;
			}
		}
		if($cek==true)
		{
			$query = $this->db->select('jumlah')->from('cart')->where($arr)->get()->result();
			$tempjumlah=0;
			foreach($query as $row)
			{
				$tempjumlah = $row->jumlah;
			}
			$data = array(
				'jumlah'=> $tempjumlah+1
			);
			$this->db->where($arr);
			$this->db->update('cart',$data);
		}
		else {
			$data = array(
				'id_user' => $iduser,
				'id_barang' => $idbarang,
				'jumlah' => $jumlah,
				'subtotal' => $harga,
				'size' =>$size
			);
			$this->db->insert('cart', $data);
		}
	}
	
	public function getcart($iduser)
	{
		$sql = $this->db->query("SELECT B.barang_id as id,B.harga_satuan as harga,B.foto as foto,B.barang_nama as nama,C.jumlah as jumlah,C.subtotal as subtotal,C.size as size,C.id_cart as id_cart from barang B,cart C where B.barang_id=C.id_barang and C.id_user='".$iduser."'");
		return $sql->result();
	}

	public function deletecart($idcart,$iduser)
	{
		$this->db->where('id_cart',$idcart);
		$this->db->where('id_user',$iduser);
		$this->db->delete('cart');
	}

	public function deleteallcart($iduser)
	{
		$this->db->where('id_user',$iduser);
		$this->db->delete('cart');
	}

	public function updatecart($idbarang,$nama,$jumlah,$size)
	{
		
		$temp = $this->Model->getIdUser($nama);
		$iduser='';
		foreach($temp as $row)
		{
			$iduser=$row->Id_user;

		}
		$data = array(
			'jumlah' => $jumlah 
		);
		$where = array(
			'id_cart' =>$idbarang,
			'id_user' => $iduser,
			'size'=>$size
		);
		$this->db->where($where);
		$this->db->update('cart',$data);
	}

	public function gettotalprice($nama)
	{
		$temp = $this->Model->getIdUser($nama);
		$iduser='';
		foreach($temp as $row)
		{
			$iduser=$row->Id_user;
		}
		$query = $this->db->query("select sum(jumlah*subtotal) as total from cart where id_user=".$iduser." group by id_user");
		return $query->result();
	}

	//htrans dtrans
	public function autogeneratedtrans() {
		$num_rows =  $this->db->get("dtrans")->num_rows();
		$kode = "";
		$kode = str_pad(($num_rows+1), 3,'0',STR_PAD_LEFT); 
		return $kode;
	}

	public function insertdtrans_htrans($id,$nota,$ongkir = "0") {
		$select_cart = $this->db->where("Id_user",$id)->get("cart")->result();
		$total = 0;
		foreach ($select_cart as $r) {
			$is_exist = $this->db->where('Notajual',$nota)->get('dtrans')->row();
			$data['Notajual'] = $nota;
			$data['Id_user'] = $id;
			$data['Id_barang'] = $r->id_barang;
			$data['Jumlah'] = $r->jumlah;
			$data['Subtotal'] = $r->subtotal;
			$data['status_order'] = 0;
			$total += $r->jumlah * $r->subtotal;
			if(!$is_exist){
				$this->db->insert('dtrans',$data);
			}
			else{
				$this->db->where('Notajual',$nota)->update('dtrans',$data);
			}
		}
		$is_exist = $this->db->where('Notajual',$nota)->get('htrans')->row();
		$data2['Notajual'] = $nota;
		$data2['Tanggal'] = date("Y-m-d");
		$data2['Id_user'] = $id;
		$data2['Total'] = $total+$ongkir;
		$data2['ongkos_kirim'] = $ongkir;
		// $this->db->insert('htrans',$data2);
		if(!$is_exist){
			$this->db->insert('htrans',$data2);
		}
		else{
			$this->db->where('Notajual',$nota)->update('htrans',$data2);
		}

		$this->db->where('Id_user',$id);
		$this->db->delete('cart');
		return array(
			"dtrans" => $data,
			'htrans' => $data2,
		);
	}

	public function insertdtrans_htranspromo($id,$nota,$kode,$totalpromo) {
		$select_cart = $this->db->where("Id_user",$id)->get("cart")->result();
		$total = 0;
		foreach ($select_cart as $r) {
			$data['Notajual'] = $nota;
			$data['Id_user'] = $id;
			$data['Id_barang'] = $r->id_barang;
			$data['Jumlah'] = $r->jumlah;
			$data['Subtotal'] = $r->subtotal;
			$data['status_order'] = 0;
			$total += $r->jumlah * $r->subtotal;
			$this->db->insert('dtrans',$data);
		}
		$data2['Notajual'] = $nota;
		$data2['Tanggal'] = date("Y-m-d");
		$data2['Id_user'] = $id;
		$data2['Total'] = $totalpromo;
		$data2['Kode_promo'] = $kode;
		$this->db->insert('htrans',$data2);

		$this->db->where('Id_user',$id);
		$this->db->delete('cart');
	}

	//PAYMENT SECTION
	public function getallpayment($nama)
	{
		$temp = $this->Model->getIdUser($nama);
		$iduser='';
		foreach($temp as $row)
		{
			$iduser=$row->Id_user;
		}
		return $this->db->select('*')->from("htrans")->where('Id_User',$iduser)->get()->result();
	}
	public function getpayment($nama)
	{
		$temp = $this->Model->getIdUser($nama);
		$iduser='';
		foreach($temp as $row)
		{
			$iduser=$row->Id_user;
		}
		return $this->db->select('*')->from("htrans")->where('Id_User',$iduser)->where('Status_pembayaran',0)->get()->result();
	}

	public function ceksudahbayar($iduser)
	{
		return $this->db->select('*')->from("htrans")->where('Id_User',$iduser)->get()->result();
	}
	public function getdetailpayment($nama)
	{
		$temp = $this->Model->getIdUser($nama);
		$iduser='';
		foreach($temp as $row)
		{
			$iduser=$row->Id_user;
		}
		$temp = $this->db->select('Notajual')->from("htrans")->where('Id_User',$iduser)->where('Status_pembayaran',0)->get()->result();
		$nota='';
		foreach($temp as $row)
		{
			$nota = $row->Notajual;
		}
		return $this->db->select('*')->from('dtrans')->where('Id_User',$id_user)->where('Notajual',$nota)->get()->result();
	}

	public function uploadpembayaran($nota,$id,$foto=null)
	{
		$data = array(
			'Notajual' => $nota,
			'Id_user' => $id,
			'Tanggal_upload' => date("Y-m-d"),
			'Foto' =>$foto
		);
		$is_exist = $this->db->where('Notajual',$nota)->get('buktipembayaran')->row();
		if(!$is_exist){
			$this->db->insert('buktipembayaran',$data);
			$data = array(
				'Status_pembayaran' => 1 
			);
		}
		$this->db->where('Notajual',$nota);
		$this->db->update('htrans',$data);
	}

	//ORDER SECTION
	public function getorder()
	{
		$query = $this->db->query("select h.notajual as nota,h.tanggal as tanggal,u.nama_user as nama,u.alamat as alamat,u.notelp as nomortelp from htrans h,user u where h.id_user = u.id_user and Status_pembayaran=1");
		return $query->result();
	}

	public function getorderperToko($toko)
	{
		$query = $this->db->query("SELECT barang.id_toko,user.Nama_user,barang.barang_id,REPLACE(barang.foto,' ','%20') as foto_barang,dtrans.Notajual,barang.barang_nama,dtrans.Status_order,dtrans.Jumlah,barang.harga_satuan,dtrans.Subtotal,sub_query.foto,sub_query.Status_pembayaran FROM user,barang,dtrans,(SELECT htrans.Notajual,htrans.Status_pembayaran,buktipembayaran.Foto FROM htrans LEFT JOIN buktipembayaran ON htrans.Notajual=buktipembayaran.Notajual) AS sub_query WHERE barang.barang_id=dtrans.Id_barang AND dtrans.Notajual=sub_query.Notajual AND user.Id_user=dtrans.Id_user AND barang.id_toko='".$toko."'");
		return $query->result();
	}

	public function getdetailorder($iduser,$nota)
	{
		$query = $this->db->query("select d.notajual as nota,b.barang_nama as nama,d.jumlah as jumlah,bp.foto as foto,d.Status_order,b.harga_satuan,d.subtotal from barang b,dtrans d,buktipembayaran bp,user u where b.barang_id = d.id_barang and bp.notajual = d.notajual and u.id_user='".$iduser."' and d.notajual='".$nota."'");
		return $query->result();
	}

	public function detailorderPerToko($nota,$toko)
	{
		//asdfqwer
		$query="SELECT dtrans.Notajual,barang.barang_nama,dtrans.Jumlah,barang.harga_satuan,dtrans.Subtotal FROM dtrans,barang WHERE dtrans.Id_barang=barang.barang_id AND barang.id_toko='".$toko."' AND dtrans.Notajual='".$nota."'";
		return $this->db->query($query)->result();
	}

	public function ubahstatus($nota,$barang_id)
	{
		$data = array(
			'Status_order' => 1
		);
		$this->db->where('Notajual',$nota);
		$this->db->where('id_barang', $barang_id);
		$this->db->update('dtrans',$data);
	}

	public function getuserorder($id)
	{
		return $this->db->select('*')->from('htrans')->where('Id_user',$id)->where('Status_pembayaran',1)->get()->result();
	}
	
	public function getdetailuserorder($id)
	{
		$query = $this->db->query("select d.notajual as nota,b.barang_nama as nama,d.jumlah as jumlah,h.tanggal as tanggal,h.total as total from barang b,dtrans d,htrans h where b.barang_id = d.id_barang and d.notajual = h.notajual and d.id_user ='".$id."'");
		return $query->result();

	}

	public function detailorder($nota)
	{
		$query = $this->db->query("select d.notajual as nota,b.barang_nama as nama,d.jumlah as jumlah,h.tanggal as tanggal,h.total as total,b.foto as foto,b.harga_satuan as harga from barang b,dtrans d,htrans h where b.barang_id = d.id_barang and d.notajual = h.notajual and d.notajual ='".$nota."'");
		return $query->result();
	}

	//REPORT SECTION

	public function getReportPemasukanBulanan()
	{
		$query = $this->db->query("SELECT DISTINCT substring(DATE_FORMAT(Tanggal,'%Y-%m-%d'),6,2) as bulan,SUM(TOTAL) AS total FROM htrans WHERE YEAR(CURRENT_DATE) = 2018 GROUP BY substring(DATE_FORMAT(Tanggal,'%Y-%m-%d'),6,2)");
		return $query->result();
	}

}