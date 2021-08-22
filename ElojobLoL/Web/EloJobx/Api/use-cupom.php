<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST["cupom"])))
{
    
    $Cupom = $Server->prepareStatment("SELECT * FROM booster_cupons WHERE code = :c AND expires > :e");
    $Cupom->execute([":c" => $_POST["cupom"], ":e" => date("Y-m-d H:i:s")]);
    $CupomR = $Cupom->fetch(PDO::FETCH_ASSOC);
        if($CupomR)
            {
                header('Content-Type: application/json; charset=utf-8');
                $array = array(
                    "status" =>   true,
                    "type" =>     $CupomR["type"],
                    "desconto" => $CupomR["discount"]
                );
            }
            else
            {
                $array = array(
                    "status" =>   false,
                    "type" =>     null,
                    "desconto" => null,
                    "mensagem" => "Cupom invalido 😭"
                );
            }

            echo json_encode($array);
            exit;
        }
    else
{
    header("Location: /saguao");
    exit;
}

?>