<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if (isset($_POST["temporada"], $_POST["quantidade"], $_POST["Fila"], $_POST["modo"]) && is_numeric($_POST["quantidade"]))
    {
        header('Content-Type: application/json; charset=utf-8');
        if($_POST["temporada"] == 'Não Ranqueado')
        {
          $_POST["temporada"] = 'unranked';
        }

        if(strtolower($_POST["temporada"]) == 'grao-mestre' || strtolower($_POST["temporada"]) == 'desafiante' && $_POST["modo"] == 'duoboost')
        {
          echo '{"status":false,"mensagem":"Selecao Invalida."}';
          exit;
        }

        if (!in_array(strtolower($EloTools->tirarAcentos($_POST["temporada"])) , EloTools::ELO_NAME, true) || !in_array($_POST["Fila"], EloTools::ROUTES, true) || !in_array($_POST["modo"], EloTools::MODES, true))
        {
            echo '{"status":false,"mensagem":"Servico invalido."}';
            exit;
        }

        echo $EloTools->SeachBest10($_POST["temporada"],$_POST["modo"],$_POST["Fila"],$_POST["quantidade"],0);
        exit;
    }
}

?>
