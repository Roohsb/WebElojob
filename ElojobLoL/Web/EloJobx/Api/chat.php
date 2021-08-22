<?php
if(isset($URL[2])){
    if (file_exists('EloJobx/Api/Chat/' . $URL[2] . '.php')){
        require('EloJobx/Api/Chat/' . $URL[2] . '.php');
        exit;
     }
}
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["compra"],$_POST["mensagem"]) && (is_numeric($_POST["compra"]) && is_numeric($_POST["mensagem"]))){
        $CheckAccount = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE id = :id AND Usuario = :u");
        $CheckAccount->execute([":id" => $_POST["compra"], ":u" => $_SESSION["Usuario"]]);
        $CheckAccountR = $CheckAccount->fetch(PDO::FETCH_ASSOC);
        if($CheckAccountR){
            header('Content-Type: application/json; charset=utf-8');
            $Message = $Server->prepareStatment("SELECT * FROM booster_messages WHERE order_id = :id ORDER BY id ASC");
            $Message->execute([":id" => $CheckAccountR["id"]]);
            $dates = array();

            while($Menssagens = $Message->fetch(PDO::FETCH_ASSOC))
                {
                    $Type = $Menssagens["user_send"] != $_SESSION["Usuario"] ? 0 : 1;
                    $dates[] =  array("id" => $Menssagens["id"],"tipo" => $Type,"usuario" => array("url" => "https:\/\/elojobhigh.com.br\/app\/perfil\/vladmirrx","nome" => GetDateProfile($Server,$Menssagens["user_send"])[0]["nome"],"avatar" => "/Template/imagens/profiles/avatar/".ImagesUser(1,GetDateProfile($Server,$Menssagens["user_send"])[1]["avatar"],$Server)["img"]),"mensagem" => $Menssagens["message"],"data" => date_format(date_create($Menssagens["date"]), 'd/m/Y H:i:s'));
                }

                echo '{"status":1,"data":'.json_encode($dates).'}'; exit;
        }
        header("Location: /saguao"); exit;
    }
    header("Location: /saguao"); exit;
}else{ header("Location: /saguao"); exit; }
?>