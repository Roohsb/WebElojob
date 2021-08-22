<?php
if(isset($URL[2])){
    if (file_exists('EloJobx/Api/Comments/' . $URL[2] . '.php')){
        require('EloJobx/Api/Comments/' . $URL[2] . '.php');
        exit;
     }
}
if($_SERVER["REQUEST_METHOD"] === "POST"){
  header('Content-Type: application/json; charset=utf-8');
    if(isset($_POST["usuario"],$_POST["paginacao"]) && (is_numeric($_POST["usuario"]) && is_numeric($_POST["paginacao"]))){
        $CheckComment = $Server->prepareStatment("SELECT * FROM elo_users_comments WHERE usuario = :us");
        $CheckComment->execute([":us" => $_POST["usuario"]]);
          if($CheckComment->rowCount() == 0){
            echo '[]';
            exit;
          }
        $CheckCommentR = $CheckComment->fetch(PDO::FETCH_ASSOC);
        $Comentarios = json_decode($CheckCommentR["classificacao"]);
          $NovosArray = array();
          foreach($Comentarios as $Comentario){
            $usuarioDetalhes = GetDateProfile($Server,$Comentario->usuario);
            $prepareArray = array_push($NovosArray,array("nome" => $usuarioDetalhes[0]["nome"], "avatar" => ImagesUser(1,$usuarioDetalhes[1]["avatar"],$Server)["img"], "usuario" => $Comentario->usuario, "order" => $Comentario->order, "mensagem" => $Comentario->mensagem, "avaliacao" => $Comentario->avaliacao, "date" => $Comentario->date));
           }
           
           $Siclado = array_slice($NovosArray, intval($_POST["paginacao"]) * 3, 3);
        echo json_encode($Siclado);
        exit;
    }
    header("Location: /saguao"); exit;
}else{ header("Location: /saguao"); exit; }
?>