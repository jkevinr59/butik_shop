<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Midtrans\Config;
use Midtrans\Transaction;
use Midtrans\CoreApi;

class Midtrans {

        private $CI;
        private $key="SB-Mid-server-lM_LK52n12o7ey7l7jZaIc-Z";
        public function __construct()
        {
            Config::$serverKey = $this->key;
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;
            $this->CI =& get_instance();
            $this->CI->load->model('midtrans_model');
            // $test = new FPDF();
        }
        
        public function createTransactionBni($order_id,$amount)
        {
            $transaction_detail_bni = array(
                "order_id" => $order_id."-bni",
                "gross_amount" => $amount,
            );
            
            $transaction_data_bni = array(
            'payment_type' =>'bank_transfer',
            'transaction_details' => $transaction_detail_bni,
            'bank_transfer' => array(
                "bank" => "bni"
                ) 
            );
            $response_bni = CoreApi::charge($transaction_data_bni);
            return $response_bni;
        }

        public function createTransactionBca($order_id,$amount)
        {
            $transaction_detail_bca = array(
                "order_id" => $order_id."-bca",
                "gross_amount" => $amount,
            );
            $transaction_data_bca = array(
                'payment_type' =>'bank_transfer',
                'transaction_details' => $transaction_detail_bca,
                'bank_transfer' => array(
                    "bank" => "bca"
                ) 
            );
            $response_bca = CoreApi::charge($transaction_data_bca);
            
            return $response_bca;
        }

        public function cancelTransaction($transactionId){
            $result = Transaction::cancel($transactionId);
            if(substr($result,0,1)=="2")
            {
                $query = $this->CI->midtrans_model->canceling_transaction($transactionId);
            }
            return $result;
        }

        public function createMidtransTransaction($dataCart)
        {
            $trans_id = $dataCart['htrans']['Notajual'];
            $amount = $dataCart['htrans']['Total'];
            $order_id_bca = "Bca_".$trans_id;
            $transactionBca = $this->createTransactionBca($order_id_bca,$amount);
            if(substr($transactionBca->status_code,0,1)=='2'){
                $dataInsert['trans_id'] = $trans_id;
                $dataInsert['midtrans_id'] = $transactionBca->transaction_id;
                $dataInsert['channel'] = 'bca';
                $dataInsert['order_id'] = $order_id_bca;
                $dataInsert['va'] = $transactionBca->va_numbers[0]->va_number;
                $this->CI->midtrans_model->insert($dataInsert);
            }
            $order_id_bni = "Bni_".$trans_id;
            $transactionBni = $this->createTransactionBni($order_id_bni,$amount);
            if(substr($transactionBni->status_code,0,1)=='2'){
                $dataInsert['trans_id'] = $trans_id;
                $dataInsert['midtrans_id'] = $transactionBni->transaction_id;
                $dataInsert['channel'] = 'bni';
                $dataInsert['order_id'] = $order_id_bni;
                $dataInsert['va'] = $transactionBni->va_numbers[0]->va_number;
                $this->CI->midtrans_model->insert($dataInsert);
            }
            return array("bca"=>$transactionBca,"bni"=>$transactionBni);
        }

}