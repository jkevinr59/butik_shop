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
            $rowdata = $this->db->where('id_kategori',$row->id_kategori)
            ->join('toko',"barang.id_toko = toko.id_toko")
            ->get('barang')->result();
            array_push($data,[
                "id_kategori" => $row->id_kategori,
                "nama_kategori" => $row->nama_kategori,
                "data" => $rowdata,
            ]);
        }
        return compact("summary","data");
    }

    public function getMidtransReport(){
        $summary = $this->db->select('sum(Total) as total,midtrans_transactions.channel')->join('htrans','htrans.Notajual = midtrans_transactions.trans_id')
        ->group_by('midtrans_transactions.channel')
        ->where('canceled_at is NULL')->get("midtrans_transactions")->result();
        $data = $this->db->join('htrans','htrans.Notajual = midtrans_transactions.trans_id')
        ->where('canceled_at is NULL')->get("midtrans_transactions")->result();
        return compact('summary','data');
    }
    public function getVerifiedUser(){
        $summary = $this->db->select('count(*) as total,user.Status_verify')
        ->group_by('user.Status_verify')
        ->get("user")->result();
        $data_verified = $this->db->where('Status_verify','1')
        ->get("user")->result();
        $data_unverified = $this->db->where('Status_verify','0')
        ->get("user")->result();
        $data=[$data_unverified,$data_verified];
        return compact('summary','data');
    }

    public function getToko(){
        $toko = $this->db
        ->join('user','toko.id_pemilik = user.Id_user')
        ->get('toko')->result();
        return $toko;
    }

    public function getTransaksiTerbayar()
    {
        $data = $this->db
        ->join('barang','barang.barang_id = dtrans.Id_barang')
        ->join('toko','barang.id_toko = toko.id_toko')
        ->where('tanggal_bayar_admin is not NULL')
        ->order_by('tanggal_bayar_admin','desc')
        ->get('dtrans')->result();

        $summary = $this->db->select('toko.id_toko,toko.nama_toko,sum(dtrans.nominal_bayar_admin) as total_bayar')
        ->join('barang','barang.barang_id = dtrans.Id_barang')
        ->join('toko','barang.id_toko = toko.id_toko')
        ->group_by('barang.id_toko')
        ->where('tanggal_bayar_admin is not NULL')
        ->get('dtrans')->result();
        return compact('summary','data');
    }
    

    public function getPendingTransaction(){
        $unpaid = $this->db
        ->join('barang','barang.barang_id = dtrans.Id_barang')
        ->join('toko','barang.id_toko = toko.id_toko')
        ->where('tanggal_kirim is NOT NULL')
        ->where('tanggal_terima is NOT NULL')
        ->where('tanggal_bayar_admin is NULL')
        ->where('tanggal_retur is NULL')
        ->order_by('tanggal_terima','asc')->get('dtrans')->result();
        $returned = $this->db
        ->join('barang','barang.barang_id = dtrans.Id_barang')
        ->join('toko','barang.id_toko = toko.id_toko')
        ->join('user','dtrans.Id_user = user.Id_user')
        ->where('tanggal_kirim is NOT NULL')
        ->where('tanggal_terima is NULL')
        ->where('tanggal_retur is NOT NULL')
        ->where('tanggal_terima_retur is NULL')
        ->order_by('tanggal_terima','asc')->get('dtrans')->result();
        return compact('unpaid','returned');
        
    }
   
    public function updatePaidTransaction($dtrans_id)
    {
        $komisi = 5000;
        $dtrans  = $this->db->where('id',$dtrans_id)->get('dtrans')->row();
        
        $this->db->where('id',$dtrans_id);
        $this->db->set('tanggal_bayar_admin',date('Y-m-d H:i:s'));
        $this->db->set('nominal_bayar_admin',($dtrans->Subtotal-$komisi));
        
        $this->db->update('dtrans');
    }
    public function verifyReturnTransaction($dtrans_id)
    {
        $this->db->where('id',$dtrans_id);
        $this->db->set('tanggal_terima_retur',date('Y-m-d H:i:s'));
        $this->db->update('dtrans');
    }
}