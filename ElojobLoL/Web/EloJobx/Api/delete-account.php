<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && (isset($URL[2]) && (is_numeric($URL[2])))){
    $CheckAccount = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE id = :id AND Usuario = :u");
    $CheckAccount->execute([":id" => $URL[2], ":u" => $_SESSION["Usuario"]]);
    $CheckAccountR = $CheckAccount->fetch(PDO::FETCH_ASSOC);
    if($CheckAccountR){
        if($CheckAccountR["working"] != 0){
            $_SESSION["DeleteError"] = "Não é possivel deletar uma conta que esta vinculada a uma compra!"; header("Location: /user/gerenciar-lol"); exit;
        }
        $CheckDelete = $Server->prepareStatment("DELETE FROM elo_users_accounts WHERE id = :id AND Usuario = :u");
        $CheckDelete->execute([":id" => $URL[2], ":u" => $_SESSION["Usuario"]]);
        header("Location: /user/gerenciar-lol/"); exit;
    }
    header("Location: /user/gerenciar-lol/");
}else{
    header("Location: /saguao"); exit;
}