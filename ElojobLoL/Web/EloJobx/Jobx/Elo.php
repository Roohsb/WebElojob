<?php

date_default_timezone_set('America/Bahia');
setlocale(LC_MONETARY,"pt_BR", "ptb");
function outputPDOerror($errorCode = 0) {
    include  __ROOT__."/EloJobx/500.php";
  }

class DatabaseUtility {
    private $dsn, $username, $password, $database, $pdo;
    public function __construct($host = HOST, $username = USER, $password = PASSWORD, $database) {
        $this->dsn = "mysql:dbname=$database;charset=utf8;host=$host";
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }
    public function connect() {
        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password, null);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch(PDOException $err) {
            die(outputPDOerror($err->getCode()));
        }
    }
    public function prepareStatment($query) {
        return $this->pdo->prepare($query);
    }
    public function bindmNow($query) {
        return $this->pdo->bindParam($query);
    }
    public function query2($query) {
        return $this->pdo->query($query);
    }
}
$Server = new DatabaseUtility(HOST, USER, PASSWORD, 'lorenjob');
$Server->connect();
session_start();
spl_autoload_register(
    function ($class){
        require __ROOT__."/EloJobx/Class/$class.php";
    });
    $REQUEST_URI = $_SERVER['REQUEST_URI']; // ALTERADO AQUI
    $INITE = strpos($REQUEST_URI, '?');
    if ($INITE):
    $REQUEST_URI = substr($REQUEST_URI, 0, $INITE);
    endif;
    $REQUEST_URI_PASTA = substr($REQUEST_URI, 1);
    $URL = explode('/', $REQUEST_URI_PASTA);    
    $EloTools = new EloTools();


function Auth($Date,$Server){
    if(!isset($Date["nomeusuario"]) || !isset($Date["senha"])){
        $_SESSION['Aviso'] = "Usuario ou senha Invalidos!";
        header("Location: /user/entrar");
        exit;
    }
    $User = $Server->prepareStatment("SELECT * FROM elo_users WHERE user = :user");
    $User->execute([":user" => $Date["nomeusuario"]]);
    $UserResult = $User->fetch(PDO::FETCH_ASSOC);
    if($UserResult){
        if (password_verify($Date["senha"], $UserResult["password"])) {
            $_SESSION["Usuario"] = $UserResult["user"];
            header("Location: /user/centro");
            exit;
        }else{
            $_SESSION["Aviso"] = "Usuario ou senha invalidos!";
            header("Location: /user/entrar");
            exit;
        }
    }
    $_SESSION['Aviso'] = "Usuario ou senha Invalidos!";
    header("Location: /user/entrar");
    exit;
}

function Register($Date,$Server){
    if(!isset($Date["nome"],$Date["usuario"],$Date["email"],$Date["senha"],$Date["confirmarsenha"])){
        $_SESSION['Aviso'] = "Preencha todos os campos!";
        header("Location: /user/cadastrar");
        exit;
    }
    if($Date["senha"] != $Date["confirmarsenha"]){
        $_SESSION['Aviso'] = "As senhas não são iguais!";
        header("Location: /user/cadastrar");
        exit;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$Date["nome"])) {
        $_SESSION['Aviso'] = "Coloque um Nome Valido!";
        header("Location: /user/cadastrar");
        exit;
    }
    try{
    if (filter_var($Date["email"], FILTER_VALIDATE_EMAIL)) {
        $User = $Server->prepareStatment("SELECT * FROM elo_users WHERE user = :user");
        $User->execute([":user" => $Date["usuario"]]);
        $UserResult = $User->fetch(PDO::FETCH_ASSOC);
        if($UserResult){
            $_SESSION['Aviso'] = "Este nome de usuario já está sendo usado!";
            header("Location: /user/cadastrar");
            exit;
            }
            $Register = $Server->prepareStatment("INSERT INTO elo_users (user,password,nome,email) VALUES(:user,:password,:nome,:email)");
            $Register->execute([":user" => $Date["usuario"], ":password" => password_hash($Date["senha"], PASSWORD_DEFAULT), ":nome" => $Date["nome"], ":email" => $Date["email"]]);
            $_SESSION['Success'] = "Conta cadastrada com sucesso!";
            header("Location: /user/entrar");
            exit;
      }else{
        $_SESSION['Aviso'] = "Coloque um Endereço de Email Valido!";
        header("Location: /user/cadastrar");
        exit;
      }
    } catch(PDOException $e) {
        $_SESSION['Aviso'] = "Erro interno!";
        header("Location: /user/cadastrar");
        exit;
    }
}

function GetDateUser($Server){
    $User = $Server->prepareStatment("SELECT * FROM elo_users WHERE user = :user");
    $User->execute([":user" => $_SESSION["Usuario"]]);
    $Personalty = $Server->prepareStatment("SELECT * FROM elo_users_personalization WHERE usuario = :user");
    $Personalty->execute([":user" => $_SESSION["Usuario"]]);
    
    $UserResult = $User->fetch(PDO::FETCH_ASSOC);
    $PersonaltyResult = $Personalty->fetch(PDO::FETCH_ASSOC);

    return array($UserResult, $PersonaltyResult);
}

function UserSearch($Server,$Email){
    $User = $Server->prepareStatment("SELECT * FROM elo_users WHERE email = :user");
    $User->execute([":user" => $Email]);
    return $UserResult = $User->fetch(PDO::FETCH_ASSOC);
}

function GenerateLostPass($Server,$Email,$F,$Token){
    try{
        if($F == 1){
        $Register = $Server->prepareStatment("INSERT INTO elo_users_lostpassword (usuario,token) VALUES(:user,:token)");
        $Register->execute([":user" => $Email, ":token" => $Token]);
        }else{
            $Delete = $Server->prepareStatment("DELETE FROM  elo_users_lostpassword WHERE usuario = :user");
            $Delete->execute([":user" => $Email]); 
        }
            return true;
    }  catch(PDOException $err) {
        return false;
    }
}

function TokenLostPassword($Server,$Token){
    $TokenSearch = $Server->prepareStatment("SELECT * FROM elo_users_lostpassword WHERE token = :token");
    $TokenSearch->execute([":token" => $Token]);
    $TokenSearchResult = $TokenSearch->fetch(PDO::FETCH_ASSOC);
    if($TokenSearchResult){
        return $TokenSearchResult;
    }
    return false;

}

function UpdatePasswordLostPass($Server,$Token,$Post){
    if(isset($Post["senha"],$Post["senha-2"])){
        if($Post["senha"] == $Post["senha-2"] && (strlen($Post["senha"]) > 1)){
        $UpdateUser = $Server->prepareStatment("UPDATE elo_users SET password = :pass WHERE email = :us");
        $UpdateUser->execute([":pass" => password_hash($Post["senha"], PASSWORD_DEFAULT), ":us" => $Token["usuario"]]);

        $Delete = $Server->prepareStatment("DELETE FROM elo_users_lostpassword WHERE token = :tok");
        $Delete->execute([":tok" => $Token["token"]]);
        $_SESSION["LostPassOK"] = 'Senha redefinida!';  header("Location: /user/entrar"); exit;
        }else { 
            $_SESSION["ErrorPass"] = 'As senhas devem ser iguais!';  header("Location: /user/nova-senha/".$Token["token"].""); exit;}
    }else { 
        $_SESSION["ErrorPass"] = 'Preencha todos os campos';  header("Location: /user/nova-senha/".$Token["token"].""); exit; }
}

function UserPassLost($Server,$Email){
        $Register = $Server->prepareStatment("SELECT * FROM elo_users_lostpassword WHERE usuario = :user");
            $Register->execute([":user" => $Email]);
                $UserResult = $Register->fetch(PDO::FETCH_ASSOC);
                    if($UserResult){
                     return $UserResult;
                }
            return false;
}

function GetDateProfile($Server,$UserR){
    $User = $Server->prepareStatment("SELECT * FROM elo_users WHERE user = :user");
    $User->execute([":user" => $UserR]);
    $Personalty = $Server->prepareStatment("SELECT * FROM elo_users_personalization WHERE usuario = :user");
    $Personalty->execute([":user" => $UserR]);
    
    $UserResult = $User->fetch(PDO::FETCH_ASSOC);
    $PersonaltyResult = $Personalty->fetch(PDO::FETCH_ASSOC);

    return array($UserResult, $PersonaltyResult);
}


function ImagesUser($T,$I,$Server){
    if($T == 1){
        $User = $Server->prepareStatment("SELECT * FROM personalization_avatar WHERE id = :id");
        $User->execute([":id" => $I]);
    return $UserResult = $User->fetch(PDO::FETCH_ASSOC);
    }
        $User = $Server->prepareStatment("SELECT * FROM personalization_banner WHERE id = :id");
        $User->execute([":id" => $I]);
    return $UserResult = $User->fetch(PDO::FETCH_ASSOC);
}

function AvatarSelect($Server,$Us){
    $Avatar = $Server->prepareStatment("SELECT * FROM personalization_avatar ORDER BY id DESC");
    $Avatar->execute();
    while ($Results = $Avatar->fetch(PDO::FETCH_ASSOC)) {
        if($Us == $Results["id"]){
            echo '<option value="'.$Results["id"].'" data-imagem="/Template/imagens/profiles/avatar/'.$Results["img"].'" selected="selected">'.$Results["name"].'</option>';
        }else{
        echo '<option value="'.$Results["id"].'" data-imagem="/Template/imagens/profiles/avatar/'.$Results["img"].'">'.$Results["name"].'</option>';
        }
    }
}

function BannerSelect($Server,$Us){
    $Avatar = $Server->prepareStatment("SELECT * FROM personalization_banner ORDER BY id DESC");
    $Avatar->execute();
    while ($Results = $Avatar->fetch(PDO::FETCH_ASSOC)) {
        if($Us == $Results["id"]){
            echo '    <option value="'.$Results["id"].'" data-imagem="/Template/imagens/profiles/banners/'.$Results["img"].'" selected="selected">'.$Results["name"].'</option>';
        }else{
        echo '    <option value="'.$Results["id"].'" data-imagem="/Template/imagens/profiles/banners/'.$Results["img"].'">'.$Results["name"].'</option>';
        }
    }
}

function ThemesEloList($Server,$Method,$File){
    if($Method == 0){
    $Theme = $Server->prepareStatment("SELECT * FROM personalization_themes ORDER BY id DESC");
    $Theme->execute();
    while ($ThemeResults = $Theme->fetch(PDO::FETCH_ASSOC)) {
           echo '<li>
           <a href="javascript:void(0)" class="themed-background-dark-'.$ThemeResults["file"].' themed-border-'.$ThemeResults["file"].'" data-theme="/Template/css/themes/'.$ThemeResults["file"].'.css" data-toggle="tooltip" title="" data-original-title="'.$ThemeResults["name"].'">
           </a></li>';
            }
        }   
    if($Method == 1){
        $Notice = $Server->prepareStatment("SELECT * FROM personalization_themes WHERE file = :fil");
        $Notice->execute([":fil" => $File]);
        $NoticeResult = $Notice->fetch(PDO::FETCH_ASSOC);
        if($NoticeResult){
            return true;
        }
        return false;
    }
}

function SetTheme($Server,$Theme){
    $SetTheme = $Server->prepareStatment("UPDATE elo_users_personalization SET thema = :th WHERE usuario = :us");
    $SetTheme->execute([":th" => $Theme, ":us" => $_SESSION["Usuario"]]);
}

function Publish($Server,$ID){
    $Notice = $Server->prepareStatment("SELECT * FROM updates_published WHERE id = :id");
    $Notice->execute([":id" => $ID]);
    return $NoticeResult = $Notice->fetch(PDO::FETCH_ASSOC);
}




function MyAccounts($Server){
    $Accounts = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE usuario = :us ORDER BY id DESC");
    $Accounts->execute([":us" => $_SESSION["Usuario"]]);
    while($Resultado = $Accounts->fetch(PDO::FETCH_ASSOC)){
        if($Resultado["conta"] == null){
            echo ' <tr>
            <td colspan="100%">Nenhum registro encontrado.</td>
         </tr>';
            return;
        }
        echo ' <tr>
        <td>'.$Resultado["invocador"].'</td>
        <td>'.$Resultado["conta"].'</td>
        <td class="text-center">
           <div class="btn-group btn-group-xs">
              <a href="/user/editar-lol/'.$Resultado["id"].'" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
              <a href="javascript:void(0)" onclick="if (!window.__cfRLUnblockHandlers) return false; excluirContaLOL(\''.$Resultado["id"].'\');" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Excluir"><i class="fa fa-times"></i></a>
           </div>
        </td>
     </tr>';
    }
}

function AccountLol($Server,$ID){
    if(is_numeric($ID)){
    $Lol = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE id = :id AND usuario = :u");
    $Lol->execute([":id" => $ID, ":u" => $_SESSION["Usuario"]]);
    return $ResultLol = $Lol->fetch(PDO::FETCH_ASSOC);
    }
}

function AccountLolTwo($Server,$ID){
    if(is_numeric($ID)){
    $Lol = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE id = :id AND usuario = :u");
    $Lol->execute([":id" => $ID, ":u" => $_SESSION["Usuario"]]);
    return $ResultLol = $Lol->fetch(PDO::FETCH_ASSOC);
    }else{
        $Lol = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE conta = :cc AND usuario = :u");
        $Lol->execute([":cc" => $ID, ":u" => $_SESSION["Usuario"]]);
        return $ResultLol = $Lol->fetch(PDO::FETCH_ASSOC);
    }
}

function asdx($s){
    $xx = str_replace(str_split("'\""), "", $s);
    return $xx;
  }
  

function EditAccountLol($Data,$Server,$SET){
    if(isset($Data["invocador"],$Data["conta"],$Data["senha"]) && (strlen(asdx($Data["invocador"])) > 1) && (strlen(asdx($Data["conta"])) > 1) && (strlen(asdx($Data["senha"])) > 1) && is_numeric($SET)){
        $Invocador = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE id = :cc AND usuario = :us");
        $Invocador->execute([":cc" => $SET, ":us" => $_SESSION["Usuario"]]);
        $InvocadorR = $Invocador->fetch(PDO::FETCH_ASSOC);
        if($InvocadorR){
            if($InvocadorR["working"] != 0){
                $_SESSION["EditAlert"] = 'Não é possivel editar essa conta enquanto houver um serviço vinculado a ela.'; header("Location: /user/editar-lol/".$InvocadorR["id"].""); exit;
            }
            if($InvocadorR["invocador"] != $Data["invocador"] || $InvocadorR["conta"] != $Data["conta"]  ||  $InvocadorR["senha"] != $Data["senha"]){
          
            $UpdateLol = $Server->prepareStatment("UPDATE elo_users_accounts SET conta = :c, invocador = :in, senha = :s WHERE usuario = :us AND id = :id");
            $UpdateLol->execute([":c" => asdx($Data["conta"]), ":in" => asdx($Data["invocador"]), ":s" => asdx($Data["senha"]), ":us" => $_SESSION["Usuario"], ":id" => $SET]);
            header("Location: /user/gerenciar-lol"); exit;
            }
            $_SESSION["EditAlert"] = 'Preencha todos os campos ou mude algo.'; header("Location: /user/editar-lol/".$InvocadorR["id"].""); exit;
        }
            header("Location: /user/gerenciar-lol"); exit;
    }
}

function AddAccountLol($Data,$Server){
    if(isset($Data["invocador"],$Data["conta"],$Data["password"],$Data["new-password"]) && (strlen(asdx($Data["invocador"])) > 1) && (strlen(asdx($Data["conta"])) > 1) && (strlen(asdx($Data["password"])) > 1) && (strlen(asdx($Data["new-password"])) > 1)){
        if($Data["password"] != $Data["new-password"]){
            $_SESSION["AddAlert"] = 'As senhas não combinam!.'; header("Location: /user/cadastrar-lol"); exit;
        }
            $ADdLol = $Server->prepareStatment("INSERT INTO elo_users_accounts (usuario,conta,senha,invocador) VALUES(:us,:co,:se,:in)");
            $ADdLol->execute([":us" => $_SESSION["Usuario"], ":co" => $Data["conta"], ":se" => $Data["password"], ":in" => $Data["invocador"]]);
            header("Location: /user/gerenciar-lol"); exit;
    }
    $_SESSION["AddAlert"] = 'Preencha todos os campos.'; header("Location: /user/cadastrar-lol"); exit;
}





function Notices($Server,$Search,$OFF){
    if(isset($Search)){
        $Notices = $Server->prepareStatment("SELECT * FROM updates_published WHERE title LIKE :searc ORDER BY date DESC");  
        $Notices->execute([":searc" => "%$Search%"]);
    }else{  
        
        $Notices = $Server->prepareStatment("SELECT * FROM updates_published ORDER BY date DESC LIMIT 5 OFFSET :offs");  $Notices->execute([":offs" => $OFF]);}
    while($NoticesResulte = $Notices->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>
        <td class="text-center">
           <a href="/user/perfil/'.$NoticesResulte["owner"].'" title="'.GetDateProfile($Server,$NoticesResulte["owner"])[0]["nome"].'">
           <img src="/Template/imagens/profiles/avatar/'.ImagesUser(1,GetDateProfile($Server,$NoticesResulte["owner"])[1]["avatar"],$Server)["img"].'" class="img-circle" style="max-height: 50px;">
           <br><small>'.GetDateProfile($Server,$NoticesResulte["owner"])[0]["nome"].'</small>
           </a>
        </td>
        <td><a href="/user/atualizacao/'.$NoticesResulte["id"].'" title="'.$NoticesResulte["title"].'">'.$NoticesResulte["title"].'</a></td>
        <td>'.date("d/m/Y H:i", strtotime($NoticesResulte["date"])).'</td>
        <td class="text-center">
           <div class="btn-group btn-group-xs">
              <a href="/user/atualizacao/'.$NoticesResulte["id"].'" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Visualizar"><i class="fa fa-eye"></i></a>
           </div>
        </td>
     </tr>';
    }
}

function NoticesHome($Server){
        
        $Notices = $Server->prepareStatment("SELECT * FROM updates_published ORDER BY date DESC LIMIT 3");  $Notices->execute();
        while($NoticesResulte = $Notices->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>
        <td class="text-center">
           <a href="/user/perfil/'.$NoticesResulte["owner"].'" title="'.GetDateProfile($Server,$NoticesResulte["owner"])[0]["nome"].'">
           <img src="/Template/imagens/profiles/avatar/'.ImagesUser(1,GetDateProfile($Server,$NoticesResulte["owner"])[1]["avatar"],$Server)["img"].'" class="img-circle" style="max-height: 50px;">
           <br><small>'.GetDateProfile($Server,$NoticesResulte["owner"])[0]["nome"].'</small>
           </a>
        </td>
        <td><a href="/user/atualizacao/'.$NoticesResulte["id"].'" title="'.$NoticesResulte["title"].'">'.$NoticesResulte["title"].'</a></td>
        <td>'.date("d/m/Y H:i", strtotime($NoticesResulte["date"])).'</td>
        <td class="text-center">
           <div class="btn-group btn-group-xs">
              <a href="/user/atualizacao/'.$NoticesResulte["id"].'" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Visualizar"><i class="fa fa-eye"></i></a>
           </div>
        </td>
     </tr>';
    }
}


function NoticesPages($PAtual, $Count){
    if($PAtual > 1){
        echo '<li class="paginate_button page-item previous" id="dtBasicExample_previous"><a href="/user/atualizacoes?pagina='.($PAtual-1).'" aria-controls="dtBasicExample" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>';
    }else{
        echo '<li class="paginate_button page-item previous disabled" id="dtBasicExample_previous"><a href="#" aria-controls="dtBasicExample" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>';
    }
    if($Count == 1){
        echo '<li class="paginate_button page-item active"><a href="#" aria-controls="dtBasicExample" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>';
    }else{
    for($i = 1; $i <= $Count; $i++){
        if($PAtual == $i){
            echo '<li class="paginate_button page-item active"><a href="/user/atualizacoes?pagina='.$i.'" aria-controls="dtBasicExample" data-dt-idx="1" tabindex="0" class="page-link">'.$i.'</a></li>';
        }else{
            echo '<li class="paginate_button page-item"><a href="/user/atualizacoes?pagina='.$i.'" aria-controls="dtBasicExample" data-dt-idx="1" tabindex="0" class="page-link">'.$i.'</a></li>';
        }
    }
}   
    if($Count > 1){
        if($PAtual == $Count){
            echo '<li class="paginate_button page-item next disabled" id="dtBasicExample_next"><a href="#" aria-controls="dtBasicExample" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>';
        }else{
        echo '<li class="paginate_button page-item next" id="dtBasicExample_next"><a href="/user/atualizacoes?pagina='.$PAtual++.'" aria-controls="dtBasicExample" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>';
        }
    }else{
        echo '<li class="paginate_button page-item next disabled" id="dtBasicExample_next"><a href="#" aria-controls="dtBasicExample" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>';
    }
}


/**
 * PAGINA DE COMPRAR O SERVICO
 * @param USER 
 *   */ 
    function MyAccountsLol($USER,$Server)
    {
       
        $checkOne = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE (usuario = :us  AND conta != :cx AND working = 0)");
        $checkOne->execute([":us" => $USER, ":cx" => '']);
        $checkOneR = $checkOne->fetch(PDO::FETCH_ASSOC);
        if($checkOneR)
            {
                echo' <label for="escolhaconta">Escolha a sua conta LOL:</label>
                     <select name="escolhaconta" id="escolhaconta" class="form-control">
                        <option value="adicionarconta">Adicionar conta</option>
                        <option value="contaexistente" selected="selected">Usar conta já cadastrada</option>
                     </select>
                  </div>
                  <div id="box_contaexistente" class="">
                   <div class="form-group">
                        <label for="contalol">Conta LOL</label>
                        <select name="contalol" id="contalol" class="form-control">
                           <option value="">Selecione</option>';
                           $checkOne2 = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE (usuario = :us  AND conta != :cx AND working = 0)");
                           $checkOne2->execute([":us" => $USER, ":cx" => '']);
                           while($one = $checkOne2->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo '<option value="'.$one["id"].'" selected="selected">Invocador: '.$one["invocador"].' | Conta: '.$one["conta"].' | Senha: '.$one["senha"].'</option>';
                                }
                        echo '</select>
                     </div>
                  </div>
                  <div id="box_adicionarconta" class="display-none">';
                  if(isset($_SESSION["PARAMSComplet"])){ echo '<p style="color: red;text-align: center;">'.$_SESSION["PARAMSComplet"].'!</p>'; unset($_SESSION['PARAMSComplet']);}
                     echo '<div class="col-md-6">
                        <div class="form-group">
                           <label for="login">Conta</label>
                           <input type="text" name="login" value="" id="login" class="form-control" placeholder="Usuário para acessar sua conta">
                           </div>';
                           if(isset($_SESSION["PARAMSAccount"])){ echo '<p style="color: red;margin-left: 10px;">'.$_SESSION["PARAMSAccount"].'!</p>'; unset($_SESSION['PARAMSAccount']);}
                        echo '<div class="form-group">
                           <label for="invocador">Invocador</label>
                           <input type="text" name="invocador" value="" id="invocador" class="form-control" placeholder="Seu nome dentro do jogo">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="senha">Senha</label>
                           <input type="text" name="senha" value="" id="senha" class="form-control" placeholder="Senha">
                        </div>
                        <div class="form-group">
                           <label for="confirmarsenha">Confirmar Senha</label>
                           <input type="text" name="confirmarsenha" value="" id="confirmarsenha" class="form-control" placeholder="Confirmar Senha">
                        </div>';
                        if(isset($_SESSION["PARAMSPass!="])){ echo '<p style="color: red;margin-left: 10px;">'.$_SESSION["PARAMSPass!="].'!</p>'; unset($_SESSION['PARAMSPass!=']);}
                     echo '</div>
                  </div>';
            }
            else
            {
                echo' <label for="escolhaconta">Escolha a sua conta LOL:</label>
                     <select name="escolhaconta" id="escolhaconta" class="form-control">
                        <option value="adicionarconta" selected="selected">Adicionar conta</option>
                     </select>
                  </div>
                  <div id="box_adicionarconta" class="">';
                  if(isset($_SESSION["PARAMSComplet"])){ echo '<p style="color: red;text-align: center;">'.$_SESSION["PARAMSComplet"].'!</p>'; unset($_SESSION['PARAMSComplet']);}
                  echo '<div class="col-md-6">
                     <div class="form-group">
                        <label for="login">Conta</label>
                        <input type="text" name="login" value="" id="login" class="form-control" placeholder="Usuário para acessar sua conta">
                        </div>';
                        if(isset($_SESSION["PARAMSAccount"])){ echo '<p style="color: red;margin-left: 10px;">'.$_SESSION["PARAMSAccount"].'!</p>'; unset($_SESSION['PARAMSAccount']);}
                     echo '<div class="form-group">
                        <label for="invocador">Invocador</label>
                        <input type="text" name="invocador" value="" id="invocador" class="form-control" placeholder="Seu nome dentro do jogo">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="text" name="senha" value="" id="senha" class="form-control" placeholder="Senha">
                     </div>
                     <div class="form-group">
                        <label for="confirmarsenha">Confirmar Senha</label>
                        <input type="text" name="confirmarsenha" value="" id="confirmarsenha" class="form-control" placeholder="Confirmar Senha">
                     </div>';
                     if(isset($_SESSION["PARAMSPass!="])){ echo '<p style="color: red;margin-left: 10px;">'.$_SESSION["PARAMSPass!="].'!</p>'; unset($_SESSION['PARAMSPass!=']);}
                  echo '</div>
               </div>';
            }
    }

    function Boosters($Server){
        $Boosters = $Server->prepareStatment("SELECT * FROM elo_users WHERE level = 2");
        $Boosters->execute();
        echo '<option value="">Selecione</option>';
        while($Result = $Boosters->fetch(PDO::FETCH_ASSOC)){
            echo ' <option value="'.$Result["id"].'">'.$Result["nome"].'</option>';
        }
        
    }

    function searchOrder($Server,$User,$Id)
    {
        $MatchDetails = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE id = :id AND usuario = :user");
        $MatchDetails->execute([":id" => $Id, "user" => $User]);
        $MatchDetailsResult = $MatchDetails->fetch(PDO::FETCH_ASSOC);
        if(!$MatchDetailsResult){
            return false;
        }
    return $MatchDetailsResult;
    }
    function CheckToken($Server,$ID,$EloTools)
    {
        $TokenDetails = $Server->prepareStatment("SELECT * FROM orders_tokens WHERE order_id = :id");
        $TokenDetails->execute([":id" => $ID]);
        $TokenDetailsResult = $TokenDetails->fetch(PDO::FETCH_ASSOC);
        $Token = $EloTools->getToken(50);
        if(!$TokenDetailsResult){
            $Register = $Server->prepareStatment("INSERT INTO orders_tokens (order_id,token) VALUES(:o,:t)");
            $Register->execute([":o" => $ID,":t" => $Token]);
            return $Token;
        }
        $minutes_to_add = 5; $time = new DateTime($TokenDetailsResult["date"]); $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

        if(date("Y-m-d H:i:s") > $time->format('Y-m-d H:i:s')){
        $UpdateToken = $Server->prepareStatment("UPDATE orders_tokens SET token = :t, date = :d WHERE order_id = :o");
        $UpdateToken->execute([":t" => $Token, "d" => date("Y-m-d H:i:s"), ":o" => $ID]);
        }
        return $TokenDetailsResult["token"];
    }

    /**
     * BRINCANDO COM OS VALORES EM ARRAYS
     * 
     * ABAIXO POR FAVOR SÓ USAR FUNCOES UNICAS DISTO.
     */
     function MyShoppingTable($Server,$EloTools,$Filtro)
    {   
        if($Filtro && ($EloTools->PaymentStatusSearch($Filtro) != 99)){
            $Table = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE usuario = :u AND payment = :p ORDER BY id DESC");
            $Table->execute([":u" => $_SESSION["Usuario"], ":p" => $EloTools->PaymentStatusSearch($Filtro)]);
        }else{
        $Table = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE usuario = :u ORDER BY id DESC");
        $Table->execute([":u" => $_SESSION["Usuario"]]);}



        while($Shopping = $Table->fetch(PDO::FETCH_ASSOC))
            {
              
                $Arrays = json_decode($Shopping["data"]);
                if(isset($Arrays->Curso)){
                    echo '<tr id="pedido-id-'.$Shopping["id"].'">
                    <td>'.$Shopping["id"].'</td>
                    <td>'.$EloTools->PaymentStatus($Shopping["payment"]).'</td>
                    <td class="text-center">
                       -
                    </td>
                    <td>COACH'.$Shopping["assessment"].'</td>
                    <td>'.strtoupper($Arrays->Curso).' / '.$Arrays->Aulas.' DIAS DE AULA</td>
                    <td>'.$Shopping["valor"].'</td>
                 
                    <td class="text-center">
                       <div class="btn-group btn-group-xs">
                          <a href="/user/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Visualizar"><i class="fa fa-eye"></i></a>';
                          
                          if($Shopping["payment"] == 1){
                          echo '<a href="/user/finalizar/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-success" data-original-title="Efetuar pagamento"><i class="fa fa-money"></i></a>';
                          }
                          if($Shopping["payment"] != 3){
                          echo '<a href="/user/compra/'.$Shopping["id"].'/chat" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Chat"><i class="fa fa-comment"></i></a>';
                          }
                          if($Shopping["assessment"] === null && $Shopping["payment"] == 3){
                            echo '<a href="#" data-pedido-avalaicao="'.$Shopping["id"].'" class="btn btn-default avaliar" data-original-title="Avaliar"><i class="fa fa-check-circle-o" data-pedido-avalaicao="'.$Shopping["id"].'"></i></a>';
                            }
                    echo '</div>
                    </td>
                 </tr>';
                }else if(isset($Arrays->Servico) && $Arrays->Servico == 'MD10'){
                    echo '<tr id="pedido-id-'.$Shopping["id"].'">
                    <td>'.$Shopping["id"].'</td>
                    <td>'.$EloTools->PaymentStatus($Shopping["payment"]).'</td>
                    <td class="text-center">
                       -
                    </td>
                    <td>MD 10</td>
                    <td> '.strtoupper($Arrays->Fila).' / <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->Temporada,'I','imagem').'.png" style="max-height: 30px;"> '.strtoupper($Arrays->Temporada).' '.$Arrays->Detalhes->divisao.' / '.$Arrays->Aulas.' PARTIDAS</td>
                    <td>'.$Shopping["valor"].'</td>
                 
                    <td class="text-center">
                       <div class="btn-group btn-group-xs">
                          <a href="/user/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Visualizar"><i class="fa fa-eye"></i></a>';
                          if($Shopping["payment"] == 1){
                            echo '<a href="/user/finalizar/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-success" data-original-title="Efetuar pagamento"><i class="fa fa-money"></i></a>';
                            }
                            if($Shopping["payment"] != 3){
                            echo '<a href="/user/compra/'.$Shopping["id"].'/chat" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Chat"><i class="fa fa-comment"></i></a>';
                            }
                            if($Shopping["assessment"] === null && $Shopping["payment"] == 3){
                                echo '<a href="#" data-pedido-avalaicao="'.$Shopping["id"].'" class="btn btn-default avaliar" data-original-title="Avaliar"><i class="fa fa-check-circle-o" data-pedido-avalaicao="'.$Shopping["id"].'"></i></a>';
                                }
                             echo '</div>
                    </td>
                 </tr>';
                }else{
                echo '<tr id="pedido-id-'.$Shopping["id"].'">
                        <td>'.$Shopping["id"].'</td>
                        <td>'.$EloTools->PaymentStatus($Shopping["payment"]).'</td>
                        <td class="text-center">
                           -
                        </td>
                        <td>'.strtoupper($Arrays->Servico).'</td>
                        <td>'.strtoupper($Arrays->Fila).' / <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->EloSelecionado,$Arrays->DivisaoSelecionada,'imagem').'.png" style="max-height: 30px;">
                        '.$EloTools->ElosImg($Arrays->EloSelecionado,$Arrays->DivisaoSelecionada,'nome').' / 
                         <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'imagem').'.png" data-toggle="tooltip" style="max-height: 30px;">'.$EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'nome').'</td>
                        <td>'.$Shopping["valor"].'</td>
                     
                        <td class="text-center">
                           <div class="btn-group btn-group-xs">
                              <a href="/user/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Visualizar"><i class="fa fa-eye"></i></a>';
                              if($Shopping["payment"] == 1){
                                echo '<a href="/user/finalizar/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-success" data-original-title="Efetuar pagamento"><i class="fa fa-money"></i></a>';
                                }
                                if($Shopping["payment"] != 3){
                                    echo '<a href="/user/compra/'.$Shopping["id"].'/chat" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Chat"><i class="fa fa-comment"></i></a>';
                                      }
                                      if($Shopping["assessment"] === null && $Shopping["payment"] == 3){
                                        echo '<a href="#" data-pedido-avalaicao="'.$Shopping["id"].'" class="btn btn-default avaliar" data-original-title="Avaliar"><i class="fa fa-check-circle-o" data-pedido-avalaicao="'.$Shopping["id"].'"></i></a>';
                                        }
                                 echo '</div>
                        </td>
                     </tr>';
                }
                     
            }
    }
    
    function MyShoppingTableHome($Server,$EloTools)
    {   
        $Table = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE usuario = :u ORDER BY id DESC LIMIT 3");
        $Table->execute([":u" => $_SESSION["Usuario"]]);

        while($Shopping = $Table->fetch(PDO::FETCH_ASSOC))
            {   
                if(!isset($Shopping["data"])){
                    echo '<tr>
                        <td colspan="100%">Nenhum registro encontrado.</td>
                             </tr>';
                     break;
                }
              
                $Arrays = json_decode($Shopping["data"]);
                if(isset($Arrays->Curso)){
                    


                    echo '<tr>
                    <td>'.$Shopping["id"].'</td>
                    <td>'.$EloTools->PaymentStatus($Shopping["payment"]).'</td>
                    <td class="text-center">
                       -
                    </td>
                    <td>COACH</td>
                    <td>'.strtoupper($Arrays->Curso).' / '.$Arrays->Aulas.' DIAS DE AULA</td>
                    <td>'.$Shopping["valor"].'</td>
                    <td class="text-center">
                    -
                    </td>
                    <td class="text-center">
                       <div class="btn-group btn-group-xs">
                          <a href="/user/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Visualizar"><i class="fa fa-eye"></i></a>';
                          if($Shopping["payment"] === 1){
                            echo '<a href="/user/finalizar/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-success" data-original-title="Efetuar pagamento"><i class="fa fa-money"></i></a>';
                            }
                          if($Shopping["payment"] != 3){
                          echo '<a href="/user/compra/'.$Shopping["id"].'/chat" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Chat"><i class="fa fa-comment"></i></a>';
                            }
                       echo '</div>
                    </td>
                 </tr>';
                }else if(isset($Arrays->Servico) && $Arrays->Servico == 'MD10'){
                    echo '<tr>
                    <td>'.$Shopping["id"].'</td>
                    <td>'.$EloTools->PaymentStatus($Shopping["payment"]).'</td>
                    <td class="text-center">
                       -
                    </td>
                    <td>MD 10</td>
                    <td> '.strtoupper($Arrays->Fila).' / <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->Temporada,'I','imagem').'.png" style="max-height: 30px;"> '.strtoupper($Arrays->Temporada).' '.$Arrays->Detalhes->divisao.' / '.$Arrays->Aulas.' PARTIDAS</td>
                    <td>'.$Shopping["valor"].'</td>
                    <td class="text-center">
                    -
                    </td>
                    <td class="text-center">
                       <div class="btn-group btn-group-xs">
                          <a href="/user/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Visualizar"><i class="fa fa-eye"></i></a>';
                          if($Shopping["payment"] === 1){
                            echo '<a href="/user/finalizar/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-success" data-original-title="Efetuar pagamento"><i class="fa fa-money"></i></a>';
                            }
                            if($Shopping["payment"] != 3){
                                echo '<a href="/user/compra/'.$Shopping["id"].'/chat" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Chat"><i class="fa fa-comment"></i></a>';
                                  }
                        echo '</div>
                    </td>
                 </tr>';

                }else{
                echo '<tr>
                        <td>'.$Shopping["id"].'</td>
                        <td>'.$EloTools->PaymentStatus($Shopping["payment"]).'</td>
                        <td class="text-center">
                           -
                        </td>
                        <td>'.strtoupper($Arrays->Servico).'</td>
                        <td>'.strtoupper($Arrays->Fila).' / <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->EloSelecionado,$Arrays->DivisaoSelecionada,'imagem').'.png" style="max-height: 30px;">
                        '.$EloTools->ElosImg($Arrays->EloSelecionado,$Arrays->DivisaoSelecionada,'nome').' / 
                         <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'imagem').'.png" data-toggle="tooltip" style="max-height: 30px;">'.$EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'nome').'</td>
                        <td>'.$Shopping["valor"].'</td>
                        <td class="text-center">
                        -
                        </td>
                        <td class="text-center">
                           <div class="btn-group btn-group-xs">
                              <a href="/user/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Visualizar"><i class="fa fa-eye"></i></a>';
                              if($Shopping["payment"] === 1){
                                echo '<a href="/user/finalizar/compra/'.$Shopping["id"].'" data-toggle="tooltip" title="" class="btn btn-success" data-original-title="Efetuar pagamento"><i class="fa fa-money"></i></a>';
                                }
                              if($Shopping["payment"] != 3){
                                    echo '<a href="/user/compra/'.$Shopping["id"].'/chat" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Chat"><i class="fa fa-comment"></i></a>';
                                }
                    echo '</div>
                        </td>
                     </tr>';
                }
                     
            }
    }
    
    function MyShoppingDetailAccount($Server,$Type){
        if(is_numeric($Type)){
            $SearchAccount = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE id = :i AND Usuario = :u");
            $SearchAccount->execute([":i" => $Type, ":u" => $_SESSION["Usuario"]]);
            $SearchAccountR = $SearchAccount->fetch(PDO::FETCH_ASSOC);
                echo '<th width="20%">Invocador</th>
                <td>'.$SearchAccountR["invocador"].'</td>
             </tr>
             <tr>
                <th width="20%">Conta</th>
                <td>'.$SearchAccountR["conta"].'</td>
             </tr>
             <tr>
                <th width="20%">Senha</th>
                <td>'.$SearchAccountR["senha"].'</td>
             </tr>';
        }else{
            $SearchAccount = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE conta = :c AND Usuario = :u");
            $SearchAccount->execute([":c" => $Type, ":u" => $_SESSION["Usuario"]]);
            $SearchAccountR = $SearchAccount->fetch(PDO::FETCH_ASSOC);
                echo '<th width="20%">Invocador</th>
                <td>'.$SearchAccountR["invocador"].'</td>
             </tr>
             <tr>
                <th width="20%">Conta</th>
                <td>'.$SearchAccountR["conta"].'</td>
             </tr>
             <tr>
                <th width="20%">Senha</th>
                <td>'.$SearchAccountR["senha"].'</td>
             </tr>';
        }
    }

    function MyShoppingDetailAccount2($Server,$Type){
        if(is_numeric($Type)){
            $SearchAccount = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE id = :i AND Usuario = :u");
            $SearchAccount->execute([":i" => $Type, ":u" => $_SESSION["Usuario"]]);
            $SearchAccountR = $SearchAccount->fetch(PDO::FETCH_ASSOC);
                echo '<th width="50%">Invocador</th>
                <td>'.$SearchAccountR["invocador"].'</td>
             </tr>
             <tr>
                <th width="50%">Conta</th>
                <td>'.$SearchAccountR["conta"].'</td>
             </tr>
             <tr>
                <th width="50%">Senha</th>
                <td>'.$SearchAccountR["senha"].'</td>
             </tr>';
        }else{
            $SearchAccount = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE conta = :c AND Usuario = :u");
            $SearchAccount->execute([":c" => $Type, ":u" => $_SESSION["Usuario"]]);
            $SearchAccountR = $SearchAccount->fetch(PDO::FETCH_ASSOC);
                echo '<th width="50%">Invocador</th>
                <td>'.$SearchAccountR["invocador"].'</td>
             </tr>
             <tr>
                <th width="50%">Conta</th>
                <td>'.$SearchAccountR["conta"].'</td>
             </tr>
             <tr>
                <th width="50%">Senha</th>
                <td>'.$SearchAccountR["senha"].'</td>
             </tr>';
        }
    }


    function MyShoppingMyBooster($Server,$ID){
        $Booste = $Server->prepareStatment("SELECT * FROM elo_users WHERE id = :i");
        $Booste->execute([":i" => $ID]);
        return $Booste->fetch(PDO::FETCH_ASSOC);
    }
