<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rajaongkir {

    private $base_url = "https://api.rajaongkir.com/starter/";
    private $key = "01cca3f952b3365761844ab53ae4cdf0";
    public function testConnection()
    {
        return ['message'=>'success connect'];
    }


    public function province($id=null)
    {
        $suffix = "province";
        if($id){
            $suffix = $suffix.'?id'.$id;
        }
        $result = $this->connect_curl($suffix);
        if($result['status']=='200'){
            $result = json_decode($result['data']);
        }
        return $result;        
    }
    public function city($id=null)
    {
        $suffix = "city";
        if($id){
            $suffix = $suffix.'?province='.$id;
        }
        $result = $this->connect_curl($suffix);
        if($result['status']=='200'){
            $result = json_decode($result['data']);
        }
        return $result;        
    }

    public function cost($origin_id,$destination_id,$weight=100,$courier="jne"){
        $suffix = "cost";
        $postfields = "origin=".$origin_id."&destination=".$destination_id."&weight=".$weight."&courier=".$courier;
        $result = $this->connect_curl($suffix,"POST",$postfields);
        if($result['status']=='200'){
            $result = json_decode($result['data']);
        }
        return $result; 
    }

    public function getCityList($id="11")
    {
        $raw = $this->city($id);
        $data = $raw->rajaongkir->results;
        $result = [];
        foreach($data as $city)
        {
            $row = [
                "id" => $city->city_id,
                "name" => $city->city_name,
            ];
            array_push($result,$row);
        }
        return $result;
    }
    public function getCostList($origin_id,$destination_id,$weight=100,$courier="jne")
    {
        $raw = $this->cost($origin_id,$destination_id,$weight,$courier);
        $data = $raw->rajaongkir->results[0];
        $costs = $data->costs;
        $result = [];
        foreach($costs as $cost)
        {
            foreach($cost->cost as $option_cost)
            {
                $service_cost=[];
                $service_cost['name'] = $cost->service." (".$option_cost->etd."hari)";
                $service_cost['value'] = $option_cost->value;
                array_push($result,$service_cost);
            }
        }
        return $result;
    }

    public function connect_curl($suffix = "",$method="GET",$postfields=[])
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->base_url.$suffix,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_HTTPHEADER => array(
            "key: ".$this->key,
          ),
        ));

        if($method=="POST"){
            curl_setopt($curl,CURLOPT_POSTFIELDS,$postfields);
            curl_setopt($curl,CURLOPT_HTTPHEADER,array(
                "content-type: application/x-www-form-urlencoded",
                "key: ".$this->key,
            ));
        }
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        if ($err) {
          $result =  ["message"=>"cURL Error #:" . $err,"status"=>'400'];
        } else {
          $result =  ["message"=>'Sukses',"status"=>'200',"data"=>$response];
        }
        return $result;
    }
}