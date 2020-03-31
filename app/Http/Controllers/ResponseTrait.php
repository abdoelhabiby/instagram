<?php

namespace App\Http\Controllers;



trait ResponseTrait{

  

  public function responseStatus($data =null,$error =null,$status,$code){

  	 $array = [
        'data' => $data,
        'status' => $status,
        'error' => $error
  	 ]; 


  	 return response($array,$code);

  }



  public function notFound(){

  	  return $this->responseStatus(null,'not found',false,404);
  }



}