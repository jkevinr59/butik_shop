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
    
    public function getTransaction($id_toko=null,$month = null){
        // $barang = $this->db->where('id_toko',$id_toko)->get('barang')->result()
        $dtrans = $this->db->select('dtrans.*,barang.id_toko,barang.barang_nama,user.Nama_user,user.Email,htrans.Tanggal as tanggal_transaksi,htrans.Status_pembayaran')
        ->join('barang','dtrans.Id_barang = barang.barang_id')
        ->join('user','user.Id_user = dtrans.Id_user')
        ->join('htrans','dtrans.Notajual = htrans.Notajual')
        ->having('htrans.Status_pembayaran',1);
        if($id_toko){
            $dtrans = $dtrans->having('barang.id_toko',$id_toko);
        }
        if($month)
        {
            $dtrans = $dtrans->having('month(tanggal_transaksi) = '.$month);
        }

        $dtrans = $dtrans->get('dtrans');
        return $dtrans->result();
    }

    public function getTransactionSummaryMonth($id_toko,$month)
    {
        $htrans = $this->db->select('htrans.*,user.Nama_user,user.Email')
        ->join('user','user.Id_user = dtrans.Id_user')
        ->where('id_toko',$id_toko)
        ->where('MONTH(htrans.tanggal)',$month);


        $htrans = $htrans->get('htrans');
        return $htrans->result();
    }
    public function getTransactionSummary($id_toko)
    {
        $htrans = $this->db->select('SUM(htrans.total) as total,MONTH(htrans.tanggal) as bulan')
        ->where('id_toko',$id_toko)
        ->where('status_pembayaran','1')
        ->group_by('MONTH(htrans.tanggal)');

        $htrans = $htrans->get('htrans');
        return $htrans->result();
    }
}