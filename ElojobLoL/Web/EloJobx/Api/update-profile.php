<?php
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(is_numeric($_POST["avatar"]) || is_numeric($_POST["capa"]) && ctype_alpha(str_replace(' ', '', $_POST["nome"])) === true){
        $Avatar = GetDateUser($Server)[1]["avatar"];
        $Banner = GetDateUser($Server)[1]["banner"];
        $Nome = GetDateUser($Server)[0]["nome"];
        $Celular = GetDateUser($Server)[0]["celular"];
        if($Avatar != $_POST["avatar"]){
            $AvatarSearch = $Server->prepareStatment("SELECT * FROM personalization_avatar WHERE id = :id");
            $AvatarSearch->execute([":id" => $_POST["avatar"]]);
            $AvatarSearchResult = $AvatarSearch->fetch(PDO::FETCH_ASSOC);
            if($AvatarSearchResult){
                $ChangerPass = $Server->prepareStatment("UPDATE elo_users_personalization SET avatar = :rr WHERE usuario = :us");
                $ChangerPass->execute([":us" => $_SESSION["Usuario"], ":rr" => $_POST["avatar"]]);
            }
        }

        if($Banner != $_POST["capa"]){
            $BannerSearch = $Server->prepareStatment("SELECT * FROM personalization_banner WHERE id = :id");
            $BannerSearch->execute([":id" => $_POST["capa"]]);
            $BannerSearchResult = $BannerSearch->fetch(PDO::FETCH_ASSOC);
            if($BannerSearchResult){
                $ChangerPass = $Server->prepareStatment("UPDATE elo_users_personalization SET banner = :rr WHERE usuario = :us");
                $ChangerPass->execute([":us" => $_SESSION["Usuario"], ":rr" => $_POST["capa"]]);
            }
        }

        if($Nome != $_POST["nome"]){
            if (preg_match("/^[a-zA-Z-' ]*$/",$_POST["nome"])) {
                $ChangerPass = $Server->prepareStatment("UPDATE elo_users SET nome = :nm WHERE user = :us");
                $ChangerPass->execute([":us" => $_SESSION["Usuario"], ":nm" => $_POST["nome"]]);
            }
        }

        if(isset($_POST["celular"]) && is_numeric($_POST["celular"])){
            if($_POST["celular"] != $Celular){
            $ChangerPass = $Server->prepareStatment("UPDATE elo_users SET celular = :cc WHERE user = :us");
            $ChangerPass->execute([":us" => $_SESSION["Usuario"], ":cc" => $_POST["celular"]]);
            }
        }

        if(isset($_POST["senha"],$_POST["confirmasenha"]) && strlen($_POST["senha"]) > 1){
            if($_POST["senha"] != $_POST["confirmasenha"]){
                echo '{"status":"fail","err_code":1,"err_msg":"Senhas diferentes"}';
                exit;
            }else{
                $ChangerPass = $Server->prepareStatment("UPDATE elo_users SET password = :pwd WHERE user = :us");
                $ChangerPass->execute([":us" => $_SESSION["Usuario"], ":pwd" => password_hash($_POST["senha"], PASSWORD_DEFAULT)]);
            }
        }
        echo '{"status":"ok","err_code":0,"err_msg":""}';
        exit;
    }
        echo '{"status":"fail","err_code":2,"err_msg":"Ajustes invalidos"}';
        exit;
}
header("Location: /user/centro");
exit;