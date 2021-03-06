<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ThirdParty extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	    $this->load->helper("form");
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('midtrans');
		$this->load->library('rajaongkir');
		$this->load->library('pagination');
		$this->load->model('model');
		$this->load->model('midtrans_model');
	}

	public function rajaongkir_province()
	{
		echo("<pre>");
		var_dump($this->rajaongkir->province()) ;
		echo("</pre>");
        die;
	}
	public function rajaongkir_city($id)
	{
		$result = $this->rajaongkir->getCityList($id);
		// var_dump($result);
		// echo("</pre>");

		return $this->output
					->set_content_type('application/json')
					->set_status_header('200')
					->set_output(json_encode($result));
	}
	public function rajaongkir_city_raw($id)
	{
		echo("<pre>");
		var_dump($this->rajaongkir->city($id)) ;
		echo("</pre>");
        die;
	}
	public function rajaongkir_cost_raw($origin_id,$destination_id)
	{
		echo("<pre>");
		// var_dump($origin_id,$destination_id);
		// var_dump($this->rajaongkir->cost($origin_id,$destination_id)) ;
		$result = $this->rajaongkir->cost($origin_id,$destination_id);
		var_dump($result->rajaongkir->results[0]);
		foreach($result->rajaongkir->results[0]->costs as $cost)
		{
			foreach($cost->cost as $option_cost){
				echo $cost->service." (".$option_cost->etd."hari) : ".$option_cost->value."\n";
			}
		}
		echo("</pre>");
	}
	public function rajaongkir_cost($origin_id,$destination_id)
	{
		$result = $this->rajaongkir->getCostList($origin_id,$destination_id);
		return $this->output
					->set_content_type('application/json')
					->set_status_header('200')
					->set_output(json_encode($result));
	}


	public function midtrans_create_bca()
	{
		$id="1102345-".rand(1,100);
		$amount="20000";
		$result = $this->midtrans->createTransactionBca($id,$amount);
		
		echo(json_encode($result,JSON_PRETTY_PRINT));
	}

	public function midtrans_create_bni()
	{
		$id="1102345-".rand(1,100);
		$amount="20000";
		$result = $this->midtrans->createTransactionBni($id,$amount);
		
		echo(json_encode($result,JSON_PRETTY_PRINT));
	}

	public function midtrans_create()
	{
		$data = array(
			"dtrans" => array(
				'Notajual' => "N".date('dmYHis'),
				'Jumlah' => "50000",
			)
		);
		$result = $this->midtrans->createMidtransTransaction($data);
		
		echo("<pre>");
		var_dump($result) ;
		echo("</pre>");
		die;
	}
	public function midtrans_callback()
	{
		try {
			//code...
			$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));

			file_put_contents('/home/logs/midtrans'.date('Ymd').'.log','notification at '.date('Y-m-d H:i:s').PHP_EOL,FILE_APPEND);
			file_put_contents('/home/logs/midtrans'.date('Ymd').'.log',json_encode($input).PHP_EOL,FILE_APPEND);
			$transaction_id = $input->transaction_id;
			if(substr($input->status_code,0,1)=="2"&&$input->transaction_status == "settlement"){
				$result = $this->midtrans_model->approving_transaction($transaction_id);
				$user = $this->model->model->getIdUser($this->session->userdata('login'));
				$updated_data = $this->midtrans_model->getTransactionByMidtransId($transaction_id);
				$canceled_transactions = $this->midtrans_model->getUnpaidTransactionsByTransId($updated_data->trans_id);
				foreach($canceled_transactions as $transaction){
					$this->model->midtrans_model->canceling_transaction($transaction->midtrans_id);
				}
				if(isset($user->Id_user)){
					$this->model->model->uploadpembayaran($updated_data->trans_id,$user->Id_user);
				}
				else{
					$this->model->model->uploadpembayaran($updated_data->trans_id,null);
				}
					
			}
		} catch (\Throwable $th) {
			log_message('error',$th->getMessage());
			file_put_contents('/home/logs/midtrans'.date('Ymd').'.log',"error:".json_encode($th).PHP_EOL,FILE_APPEND);
		}
		$respond = (array(
			"code" => "201",
			'message' => "sukses",
			"data" => isset($result)?["new_data"=>$updated_data,"unpaid_data"=>$canceled_transactions]:null
		));

		return $this->output
				->set_content_type('application/json')
				->set_output(json_encode($respond));
	}
}
?>
