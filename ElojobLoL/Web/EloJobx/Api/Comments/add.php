<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
header('Content-Type: application/json; charset=utf-8');
if(isset($_POST["avaliacao"],$_POST["order"],$_POST["mensagem"]) && is_numeric($_POST["order"]) && is_numeric($_POST["avaliacao"]) && intval($_POST["avaliacao"]) >= 0 && intval($_POST["avaliacao"]) < 2){
        $CheckOrder = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE id = :id AND Usuario = :u AND payment = 3 AND assessment <=> :ass");
        $CheckOrder->execute([":id" => $_POST["order"], ":u" => $_SESSION["Usuario"], "ass" => null]);
        $CheckOrderR = $CheckOrder->fetch(PDO::FETCH_ASSOC);

        if($CheckOrderR){
          $CheckAvaliacao = $Server->prepareStatment("SELECT * FROM elo_users_comments WHERE usuario = :u");
          $CheckAvaliacao->execute([":u" => $CheckOrderR["booster"]]);
          $CheckAvaliacaoR = $CheckAvaliacao->fetch(PDO::FETCH_ASSOC);
          if(!$CheckAvaliacaoR){
            $Json = [array("usuario" => $_SESSION["Usuario"], "order" => $_POST["order"], "mensagem" => $_POST["mensagem"], "avaliacao" => $_POST["avaliacao"], "date" => date("d/m/Y H:i"))];
            $InsertAvaliacao = $Server->prepareStatment("INSERT INTO elo_users_comments (usuario,classificacao) VALUES(:u,:c)");
            $InsertAvaliacao->execute([":u" => $CheckOrderR["booster"], ":c" => json_encode($Json)]);
          }else{
            $Comentarios = json_decode($CheckAvaliacaoR["classificacao"]);
            array_push($Comentarios, array("usuario" => $_SESSION["Usuario"], "mensagem" => $_POST["mensagem"], "avaliacao" => $_POST["avaliacao"], "date" => date("d/m/Y H:i")));
            $InsertAvaliacao = $Server->prepareStatment("UPDATE elo_users_comments SET classificacao = :class WHERE usuario = :us");
            $InsertAvaliacao->execute([":class" => json_encode($Comentarios), ":us" => $CheckOrderR["booster"]]);
          }
          if(intval($_POST["avaliacao"]) === 0){
            $InsertAvaliacaoOrder = $Server->prepareStatment("UPDATE elo_users SET likes = likes + 1 WHERE id = :id");
            $InsertAvaliacaoOrder->execute([":id" => $CheckOrderR["booster"]]);
          }else{
            $InsertAvaliacaoOrder = $Server->prepareStatment("UPDATE elo_users SET deslike = deslike + 1 WHERE id = :id");
            $InsertAvaliacaoOrder->execute([":id" => $CheckOrderR["booster"]]);
          }
        $InsertAvaliacaoOrder = $Server->prepareStatment("UPDATE elo_users_invoices SET assessment = :ass WHERE id = :id");
        $InsertAvaliacaoOrder->execute([":ass" => intval($_POST["avaliacao"]), ":id" => $_POST["order"]]);


        echo '{"status":true}'; exit;
    }
    echo '{"status":false}'; exit;
}else { header("Location: /saguao"); exit; }

}else { header("Location: /saguao"); exit;}