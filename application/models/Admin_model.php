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
        $summary = $this->db->get('barang')->result();
        $data = [];
        $kategori = $this->db->get('kategori')->result();
        foreach($kategori as $row){
            $rowdata = $this->db->where('id_kategori',$row->id_kategori)->get('barang')->result();
            array_push($data,[
                "id_kategori" => $row->id_kategori,
                "nama_kategori" => $row->nama_kategori,
                "data" => $rowdata,
            ]);
        }
        return compact("summary","data");
    }

    public function getPendingTransaction(){
        $unpaid = $this->db
        ->where('tanggal_kirim is NOT NULL')
        ->where('tanggal_terima is NOT NULL')
        ->where('tanggal_bayar_admin is NULL')
        ->where('tanggal_retur is NULL')
        ->order_by('tanggal_terima','asc')->get('dtrans')->result();
        $returned = $this->db
        ->where('tanggal_kirim is NOT NULL')
        ->where('tanggal_terima is NOT NULL')
        ->where('tanggal_retur is NOT NULL')
        ->where('tanggal_terima_retur is NULL')
        ->order_by('tanggal_terima','asc')->get('dtrans')->result();
        return compact('unpaid','returned');
        
    }
   
}