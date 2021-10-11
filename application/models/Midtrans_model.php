<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans_model extends CI_Model {
    
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function insert($data)
    {
        $insert_data = array(
            'trans_id' => $data['trans_id'],
            'channel' => $data['channel'],
            'midtrans_id' => $data['midtrans_id'],
            'order_id' => $data['order_id'],
            'va' => $data['va']?$data['va']:null,
        );
        $this->db->insert('midtrans_transactions',$insert_data);
        return $insert_data;
    }

    public function approving_transaction($midtrans_id)
    {
        $update_data = array(
            'approved_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('midtrans_id',$midtrans_id)->update('midtrans_transactions',$update_data);
        $updated_data = $this->getTransactionByMidtransId($midtrans_id);
        return array('midtrans_id'=>$midtrans_id,"data"=>$updated_data);
    }

    public function canceling_transaction($midtrans_id)
    {
        $cancel_data = array(
            'canceled_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('midtrans_id',$midtrans_id)->update('midtrans_transactions',$cancel_data);
        $updated_data = $this->getTransactionByMidtransId($midtrans_id);
        return array('midtrans_id'=>$midtrans_id,"data"=>$updated_data);
    }
    public function getTransactionsByTransId($trans_id)
    {
        $data = $this->db->where('trans_id',$trans_id)
                ->get('midtrans_transactions');
        return $data;
    }
    public function getTransactionByMidtransId($transaction_id)
    {
        $data = $this->db->where('midtrans_id',$transaction_id)->get('midtrans_transactions',1);
        return $data;
    }
}