<?php
const DAYS = ["segunda-feira", "terca-feira", "quarta-feira", "quinta-feira", "sexta-feira", "sabado", "domingo"];
const ROUTES = ["mid", "top", "jng", "adc", "sup"];
const DIVISONS = ["I", "II", "III", "IV"];

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST["invocador"], $_POST["horarios"], $_POST["rota"], $_POST["dias"], $_SESSION["MDPrice"]))
    {
        foreach ($_POST["dias"] as $Dias)
        {
            if (!in_array(strtolower($Dias) , DAYS, true))
            {
                $_SESSION["MD10Alert"] = "Escolha um dia correto!";
                header("Location: /user/md10/comprar");
                exit;
            }
        }


        if (!strlen($_POST["invocador"]) > 1)
        {
            $_SESSION["MD10Alert"] = "Adicione um invocador!";
            header("Location: /user/md10/comprar");
            exit;
        }

        if (!strlen($_POST["horarios"]) > 1)
        {
            $_SESSION["MD10Alert"] = "Explique um horario!";
            header("Location: /user/md10/comprar");
            exit;
        }

        if (!in_array(strtolower($_POST["rota"]) , ROUTES, true))
        {
            $_SESSION["MD10Alert"] = "Escolha uma rota correta!";
            header("Location: /user/md10/comprar");
            exit;
        }
        if (!in_array(strtolower($EloTools->tirarAcentos($_SESSION["MDTemporada"])) , EloTools::DONT_HAVE_DIVISIONS, true))
        {
            if(!isset($_POST["divisao"])){
                $_SESSION["MD10Alert"] = "Preencha todos os campos!";
                header("Location: /user/md10/comprar");
                exit;
            }
        if (!in_array($_POST["divisao"] , DIVISONS, true))
        {
            $_SESSION["MD10Alert"] = "Escolha uma Divisao Valida!";
            header("Location: /user/md10/comprar");
            exit;
        }
        }

        $Valor = $_SESSION["MDPrice"];

        if (isset($_POST["boosterfavorito"], $_POST["boosterfavorito_booster"]))
        {
            $Step1 = $Server->prepareStatment("SELECT * FROM elo_users WHERE id = :c AND level > :e");
            $Step1->execute([":c" => $_POST["boosterfavorito_booster"], ":e" => 1]);
            $Step1R = $Step1->fetch(PDO::FETCH_ASSOC);
            if (!$Step1R)
            {
                $_SESSION["MD10Alert"] = "Booster invalido!";
                header("Location: /user/md10/comprar");
                exit;
            }
            $Valor = $Valor + $EloTools->CalcularPorcentagem($Valor, 15, 0);
        }

        $Encodado = array("Servico" => "MD10", "Aulas" => $_SESSION["MDQuantidade"], "Modo" => $_SESSION["MDModo"], "Temporada" => $_SESSION["MDTemporada"], "Fila" => $_SESSION["MDFila"], "Detalhes" => $_POST);

        if (isset($_POST["cupom"]) && strlen($_POST["cupom"]) > 1)
        {
            $CheckCoupom = $Server->prepareStatment("SELECT * FROM booster_cupons WHERE code = :c");
            $CheckCoupom->execute([":c" => $_POST["cupom"]]);
            $CheckCoupomR = $CheckCoupom->fetch(PDO::FETCH_ASSOC);
            if ($CheckCoupomR)
            {
                $ValorCongelado = $Valor;
                $ValorCongeladoOK = $ValorCongelado - $EloTools->CalcularPorcentagem($Valor, $CheckCoupomR["discount"], 1);

                if (isset($_POST["boosterfavorito"], $_POST["boosterfavorito_booster"]))
                {

                    $Inserir = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor,booster) VALUES(:a,:b,:c,:d)");
                    $Inserir->execute([":a" => $_SESSION["Usuario"], ":b" => json_encode($Encodado) , ":c" => $EloTools->money_format('%n', $ValorCongeladoOK), ":d" => $_POST["boosterfavorito_booster"] ]);
                }
                else
                {
                    $Inserir = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor) VALUES(:a,:b,:c)");
                    $Inserir->execute([":a" => $_SESSION["Usuario"], ":b" => json_encode($Encodado) , ":c" => $EloTools->money_format('%n', $ValorCongeladoOK) ]);
                }
                unset($_SESSION["MDPrice"]);
                unset($_SESSION["MDQuantidade"]);
                unset($_SESSION["MDModo"]);
                unset($_SESSION["MDFila"]);
                unset($_SESSION["MDTemporada"]);

                header("Location: /user/compras");
                exit;

            }
            else
            {
                $_SESSION["MD10Alert"] = 'Cupom invalido 😭';
                header("Location: /user/md10/comprar");
                exit;
            }
        }
        if (isset($_POST["boosterfavorito"], $_POST["boosterfavorito_booster"]))
        {
            $Inserir = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor,booster) VALUES(:a,:b,:c,:d)");
            $Inserir->execute([":a" => $_SESSION["Usuario"], ":b" => json_encode($Encodado), ":c" => $EloTools->money_format('%n',$Valor), ":d" => $_POST["boosterfavorito_booster"]]);
        }
        else
        {
            $Inserir = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor) VALUES(:a,:b,:c)");
            $Inserir->execute([":a" => $_SESSION["Usuario"], ":b" => json_encode($Encodado), ":c" => $EloTools->money_format('%n',$Valor)]);
        }
        unset($_SESSION["MDPrice"]);
        unset($_SESSION["MDQuantidade"]);
        unset($_SESSION["MDModo"]);
        unset($_SESSION["MDFila"]);
        unset($_SESSION["MDTemporada"]);
        header("Location: /user/compras"); exit;

    }
    else
    {
        $_SESSION["MD10Alert"] = "Preencha todos os campos!";
        header("Location: /user/md10/comprar");
        exit;
    }
}
else
{
    header("Location: /saguao");
    exit;
}

