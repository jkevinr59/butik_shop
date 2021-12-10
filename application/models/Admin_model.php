<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function getJumlahUser(){
        $user = $this->db->get('user')->num_rows();
        $pemilik_toko = $this->db->get('toko')->num_rows();
        return compact('user','pemilik_toko');
    }
    public function getBarangPerKategori(){
        $this->db->select('count(*) as jumlah,barang.id_kategori,kategori.nama_kategori');
        $this->db->join('kategori','kategori.id_kategori = barang.id_kategori');
        $this->db->group_by('id_kategori');
        $data = $this->db->get('barang');
        return $data->result();
    }

   
}