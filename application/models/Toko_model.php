<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko_model extends CI_Model {
    
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function getTokoWithUser(){
        $data = $this->db->select('toko.*,user.Nama_user,user.Id_user')->join('user','user.Id_user = toko.Id_pemilik')->get('toko');
        return $data->result();
    }

    public function getTokoDetail($id_toko){
        $toko = $this->db->where('id_toko',$id_toko)->get('toko')->row();
        $barang = $this->db->where('id_toko',$id_toko)->get('barang')->result();
        $toko->barang = $barang;
        return $toko;
    }
    
    public function getTransaction($id_toko=null){
        // $barang = $this->db->where('id_toko',$id_toko)->get('barang')->result();
        $dtrans = $this->db->select('dtrans.*,barang.id_toko,barang.barang_nama,user.Nama_user,user.Email')
        ->join('barang','dtrans.Id_barang = barang.barang_id')
        ->join('user','user.Id_user = dtrans.Id_user');
        if($id_toko){
            $dtrans = $dtrans->having('barang.id_toko',$id_toko);
        }

        $dtrans = $dtrans->get('dtrans');
    }
}