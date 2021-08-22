<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
header('Content-Type: application/json; charset=utf-8');
if(isset($_POST["mensagem"],$_POST["compra"]) && is_numeric($_POST["compra"])){
        $CheckAccount = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE id = :id AND Usuario = :u");
        $CheckAccount->execute([":id" => $_POST["compra"], ":u" => $_SESSION["Usuario"]]);
        $CheckAccountR = $CheckAccount->fetch(PDO::FETCH_ASSOC);
    if($CheckAccountR){
        $InsertMessage = $Server->prepareStatment("INSERT INTO booster_messages (message,order_id,user_send) VALUES(:a,:e,:i)");
        $InsertMessage->execute([":a" => $_POST["mensagem"], ":e" => $CheckAccountR["id"], ":i" => $_SESSION["Usuario"]]);
        echo '{"status":1}'; exit;
    }
    echo '{"status":0}'; exit;
}else { header("Location: /saguao"); exit; }

}else { header("Location: /saguao"); exit;}