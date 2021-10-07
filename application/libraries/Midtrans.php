<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Midtrans\Config;

class Midtrans {

        private $key="SB-Mid-server-lM_LK52n12o7ey7l7jZaIc-Z";
        public function __construct()
        {
            Config::$serverKey = $this->key;
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;
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
                "bank" => "bca"
                ) 
            );
            $response_bni = Midtrans\CoreApi::charge($transaction_data_bni);
            var_dump($response_bni);
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
            $response_bca = Midtrans\CoreApi::charge($transaction_data_bca);
            
            var_dump($response_bca);
            die;
        }

}