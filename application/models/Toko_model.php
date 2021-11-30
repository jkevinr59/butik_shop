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
    
    public function getTransaction($id_toko=null,$month = null,$year =null){
        // $barang = $this->db->where('id_toko',$id_toko)->get('barang')->result()
        $dtrans = $this->db->select('dtrans.*,barang.id_toko,barang.barang_nama,user.Nama_user,user.Email,htrans.Tanggal as tanggal_transaksi,htrans.Status_pembayaran,toko.nama_toko')
        ->join('barang','dtrans.Id_barang = barang.barang_id')
        ->join('user','user.Id_user = dtrans.Id_user')
        ->join('htrans','dtrans.Notajual = htrans.Notajual')
        ->join('toko','toko.id_toko=barang.id_toko')
        ->having('htrans.Status_pembayaran',1);
        if($id_toko){
            $dtrans = $dtrans->having('barang.id_toko',$id_toko);
        }
        else{
        }
        if($month)
        {
            $dtrans = $dtrans->having('month(tanggal_transaksi) = '.$month);
        }

        $dtrans = $dtrans->order_by('tanggal_transaksi','desc')->get('dtrans');
        return $dtrans->result();
    }

    public function getTransactionReport($id_toko=null,$month = null,$year =null){
        // $barang = $this->db->where('id_toko',$id_toko)->get('barang')->result()
        $dtrans = $this->db->select('dtrans.*,barang.id_toko,barang.barang_nama,user.Nama_user,user.Email,htrans.Tanggal as tanggal_transaksi,htrans.Status_pembayaran,toko.nama_toko')
        ->join('barang','dtrans.Id_barang = barang.barang_id')
        ->join('user','user.Id_user = dtrans.Id_user')
        ->join('htrans','dtrans.Notajual = htrans.Notajual')
        ->join('toko','toko.id_toko=barang.id_toko')
        ->having('htrans.Status_pembayaran',1);
        if($id_toko){
            $dtrans = $dtrans->having('barang.id_toko',$id_toko);
        }
        else{
        }
        if($month)
        {
            $dtrans = $dtrans->having('month(tanggal_transaksi) = '.$month);
        }

        $dtrans = $dtrans->order_by('tanggal_transaksi','desc')->limit(50)->get('dtrans');
        return $dtrans->result();
    }

    public function getTransactionSummaryMonth($month=null,$year=null,$id_toko=null)
    {
        $htrans = $this->db->select('htrans.*,user.Nama_user,user.Email')
        ->join('user','user.Id_user = htrans.Id_user')
        ->where('MONTH(htrans.tanggal)',$month)
        ->where('YEAR(htrans.tanggal)',$year);
        if($id_toko){
            $htrans = $htrans->where('id_toko',$id_toko);
        }
        $htrans = $htrans->get('htrans');
        return $htrans->result();
    }
    public function getTransactionSummary($id_toko=null)
    {
        $htrans = $this->db->select('SUM(htrans.total) as total,MONTH(htrans.tanggal) as bulan,YEAR(htrans.tanggal) as tahun');
        if($id_toko){
            $htrans = $htrans->where('id_toko',$id_toko);
        }
        $htrans = $htrans->where('status_pembayaran','1')
        ->group_by('YEAR(htrans.tanggal),MONTH(htrans.tanggal)')
        ->order_by('tahun','desc')
        ->order_by('bulan','desc');

        $htrans = $htrans->get('htrans');
        return $htrans->result();
    }
}