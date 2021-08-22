<?php
if(isset($URL[2]) && (is_numeric($URL[2])) && (isset($URL[3]))){
        $CheckAccount = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE id = :id AND usuario = :u");
        $CheckAccount->execute([":id" => intval($URL[2]), ":u" => $_SESSION["Usuario"]]);
        $CheckAccountR = $CheckAccount->fetch(PDO::FETCH_ASSOC);
        $UR = $URL[3];
        if($CheckAccountR){
            $Status = $CheckAccountR["playing"] == 1 ? 0: 1;
            $ChangerStatus = $Server->prepareStatment("UPDATE elo_users_accounts SET playing = :p WHERE id = :id AND usuario = :us");
            $ChangerStatus->execute([":us" => $_SESSION["Usuario"], ":id" => $URL[2], ":p" => $Status]);
            header("Location: /user/compra/$UR/chat"); exit;
        }
        header("Location: /saguao"); exit;
    }else{
        header("Location: /saguao"); exit;
    }


