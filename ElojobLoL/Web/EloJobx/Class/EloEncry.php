<?php

class EloEncry{

  const SECRETE = '0bfa8olhmBcGwa2HxjvC0bfa8olhmBcG';
  const METHOD = 'AES-256-CBC';


  public function _hash(string $user, string $data, int $compra){
    $textToEncrypt = array("order" => $compra, "user" => $user, "data" => $data);
    $iv = substr(EloEncry::SECRETE, 0, 16);
    $encryptedMessage = openssl_encrypt(json_encode($textToEncrypt), EloEncry::METHOD, EloEncry::SECRETE,0,$iv);
    return  $encryptedMessage;
  }

  public function _decry($encryptedMessage){
    $iv = substr(EloEncry::SECRETE, 0, 16);
    return openssl_decrypt($encryptedMessage, EloEncry::METHOD, EloEncry::SECRETE,0,$iv);
  }

  public function _updatetoken(int $order){
    $minutes_to_add = 60; $time = new DateTime(date("Y-m-d H:i:s")); 
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
    $_SESSION["ORDER:".$order] = $this->_hash($_SESSION["Usuario"],$time->format('Y-m-d H:i:s'), $order);
  }
}