<?php
 header('Content-Type: application/json; charset=utf-8');

$Pedidos = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE payment = :p AND usuario = :us");
$Pedidos->execute([":p" => 2, ":us" => $_SESSION["Usuario"]]);
$count = $Pedidos->rowCount();
if($count > 0)
{
  $dates = array();
  foreach($Pedidos as $p){
    $Message = $Server->prepareStatment("SELECT * FROM booster_messages WHERE order_id = :id AND user_send != :us ORDER BY id ASC LIMIT 1");
    $Message->execute([":id" => $p["id"], "us" => $_SESSION["Usuario"]]);
    while($Menssagens = $Message->fetch(PDO::FETCH_ASSOC))
    {
        $Type = $Menssagens["user_send"] != $_SESSION["Usuario"] ? 0 : 1;
        $dates[] =  array("id" => $Menssagens["id"], "order" => $Menssagens["order_id"],"tipo" => $Type,"usuario" => array("nome" => GetDateProfile($Server,$Menssagens["user_send"])[0]["nome"],"avatar" => "/Template/imagens/profiles/avatar/".ImagesUser(1,GetDateProfile($Server,$Menssagens["user_send"])[1]["avatar"],$Server)["img"]),"mensagem" => $Menssagens["message"],"data" => date_format(date_create($Menssagens["date"]), 'd/m/Y H:i:s'));
    }

  }

  echo '{"status":1,"data":'.json_encode($dates).'}'; exit;
} else {
  echo '{"status":1,"data":[]}'; exit;
}

