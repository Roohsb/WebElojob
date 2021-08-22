<?php
const DAYS = [
    array("Day" => "segunda-feira"),
    array("Day" => "terca-feira"),
    array("Day" => "quarta-feira"),
    array("Day" => "quinta-feira"),
    array("Day" => "sexta-feira"),
    array("Day" => "sabado"),
    array("Day" => "domingo")
];
const ROUTES = [
    array("Route" => "mid"),
    array("Route" => "top"),
    array("Route" => "jng"),
    array("Route" => "adc"),
    array("Route" => "sup")
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
if(isset($_POST["dias"],$_POST["invocador"],$_POST["horarios"],$_POST["rota"]))
    {
  if(strlen($_POST["invocador"]) == 0)
        {
            $_SESSION["COACHAlert"] = "Preencha todos os campos!"; header("Location: /user/coach/contratar"); exit;
        }

    foreach($_POST["dias"] as $Dias){
        if(!array_search($Dias, array_column(DAYS, 'Day', "Day"))){
           $_SESSION["COACHAlert"] = "Preencha todos os campos!"; header("Location: /user/coach/contratar"); exit;
        }
    }

    if(!array_search($_POST["rota"], array_column(ROUTES, 'Route', "Route")))
    {
           $_SESSION["COACHAlert"] = "Rota invalida!"; header("Location: /user/coach/contratar"); exit;
    }
        $Valor = $_SESSION["CoachDetails"]["Valor"];
        $Encodado = array("Curso" => $_SESSION["CoachDetails"]["Curso"], "Aulas" => $_SESSION["CoachDetails"]["Aulas"], "Detalhes" => $_POST);

    if(isset($_POST["boosterfavorito"],$_POST["boosterfavorito_booster"]))
    {
        $Step1 = $Server->prepareStatment("SELECT * FROM elo_users WHERE id = :c AND level > :e");
        $Step1->execute([":c" => $_POST["boosterfavorito_booster"], ":e" => 1]);
        $Step1R = $Step1->fetch(PDO::FETCH_ASSOC);

        if(!$Step1R)
        { 
            $_SESSION["COACHAlert"] = "Booster invalido!"; header("Location: /user/coach/contratar"); exit; 
        }

        $Valor = $Valor + $EloTools->CalcularPorcentagem($Valor,15,0); 
    }
    if (strlen($_POST["cupom"]) > 1)
    {
        $CheckCoupom = $Server->prepareStatment("SELECT * FROM booster_cupons WHERE code = :c");
        $CheckCoupom->execute([":c" => $_POST["cupom"]]);
        $CheckCoupomR = $CheckCoupom->fetch(PDO::FETCH_ASSOC);
        if ($CheckCoupomR)
        {
            $ValorCongelado = $Valor;
            $ValorCongeladoOK = $ValorCongelado - $EloTools->CalcularPorcentagem($Valor, $CheckCoupomR["discount"], 1);

            if(isset($_POST["boosterfavorito"],$_POST["boosterfavorito_booster"]))
            {
                $Inserir = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor,booster) VALUES(:a,:b,:c,:d)");
                $Inserir->execute([":a" => $_SESSION["Usuario"], ":b" => json_encode($Encodado), ":c" => $EloTools->money_format('%n',$ValorCongeladoOK), ":d" => $_POST["boosterfavorito_booster"]]);
            }
            else
            {
                $Inserir = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor) VALUES(:a,:b,:c)");
                $Inserir->execute([":a" => $_SESSION["Usuario"], ":b" => json_encode($Encodado), ":c" => $EloTools->money_format('%n',$ValorCongeladoOK)]);
            }
            header("Location: /user/compras");
            exit;

        }
        else
        {
            $_SESSION["COACHAlert"] = 'Cupom invalido 😭';
            header("Location: /user/coach/contratar");
            exit;
        }
    }
    if(isset($_POST["boosterfavorito"],$_POST["boosterfavorito_booster"]))
    {
        $Inserir = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor,booster) VALUES(:a,:b,:c,:d)");
        $Inserir->execute([":a" => $_SESSION["Usuario"], ":b" => json_encode($Encodado), ":c" => $EloTools->money_format('%n',$Valor), ":d" => $_POST["boosterfavorito_booster"]]);
    }
    else
    {
        $Inserir = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor) VALUES(:a,:b,:c)");
        $Inserir->execute([":a" => $_SESSION["Usuario"], ":b" => json_encode($Encodado), ":c" => $EloTools->money_format('%n',$Valor)]);
    }
    header("Location: /user/compras"); exit;

}else{  $_SESSION["COACHAlert"] = "Selecione dias corretos!"; header("Location: /user/coach/contratar"); exit; }
}else{   header("Location: /saguao"); exit; }

