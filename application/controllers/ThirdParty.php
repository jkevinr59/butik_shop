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
		$this->load->model('Model');
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
		// echo("<pre>");
		// var_dump($origin_id,$destination_id);
		// var_dump($this->rajaongkir->cost($origin_id,$destination_id)) ;
		$result = $this->rajaongkir->getCostList($origin_id,$destination_id);
		// var_dump($result);
		// echo("</pre>");

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
	public function midtrans_callback()
	{
		$input = $this->input->post();
	}
}
?>
