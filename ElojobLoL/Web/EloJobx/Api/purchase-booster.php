<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_SESSION["SelectElo"])))
{
    $Params = [array(

        "Search" => $_POST["pesquisar"]??null,
        "Coupom" => $_POST["cupom"]??null,
        "Submit" => $_POST["submit"]??null,

        /**
         *
         *  ESTILO DE ESCOLHA SE TEM OU VAI CRIAR UMA CONTA
         * @param POST[escolhaconta]
         *  Caso O @param POST seja contaexistente O @param POST[contalol] E RETORNADO
         */
        "AccountMethod" => $_POST["escolhaconta"]??'adicionarconta', // OR contaexistente
        "Login" => $_POST["login"]??null, // MESMO SENDO contaexistente ELE VEM NULO
        "Summoner" => $_POST["invocador"]??null, // MESMO SENDO contaexistente ELE VEM NULO
        "Password" => $_POST["senha"]??null, // MESMO SENDO contaexistente ELE VEM NULO
        "RPassword" => $_POST["confirmarsenha"]??null, // MESMO SENDO contaexistente ELE VEM NULO
        "LolAccount" => $_POST["contalol"]??null, // ID DA CONTA DO MANO
        

        
        /** OPTIONAL PARAMETERS ⚠️
         *  @param 1 == Checked
         * Below are Parent parameters that are only SET if they are activated
         *
         */
        "Chat" => $_POST["chatoffline"]??false, // This is a free service, by default it is activated.
        "RateMMR" => $_POST["taxammr"]??false,
        "PrioritySER" => $_POST["servicoprioritario"]??false,
        "ExtraWin" => $_POST["vitoriaextra"]??false,
        "StreamON" => $_POST["streamonline"]??false,
        "KDAReduce" => $_POST["reducaokda"]??false,
        "ReducePrazo" => $_POST["reducaoprazo"]??false,
        "SoloService" => $_POST["servicosolo"]??false, // Com isso ativo, o ReducePrazo nao pode ser ativado
        

        
        /**
         * @param POST[posicaofeiticos]
         *
         * Even though the father is FALSE, the son's value is returned
         * ###############################
         * @param POST[flash]  == F OR D #
         * ###############################
         */
        "SpellsPosi" => $_POST["posicaofeiticos"]??false,
        "FlashPosi" => $_POST["flash"]??'F',

        /**
         * @param POST[rotasespecificas]
         *
         * Special parameter, The children only have an effect if the Father is TRUE (1)
         * Even with the Father being FALSE the children return with values
         */
        "SpecificRO" => $_POST["rotasespecificas"]??false,
        "RoutePrimary" => $_POST["rotaprimario"]??null,
        "RouteSecondary" => $_POST["rotasecundario"]??null,

        /**
         * @param POST[boosterfavorito]
         *
         * Special parameter, The children only have an effect if the Father is TRUE (1)
         * Even though the Father is FALSE, some children are still set, but without values! =>
         * @param POST[boosterfavorito_booster] #
         * IF IT IS FALSE, THE BOOSTER IS RANDOM
         * #######################################
         */
        "BoosterFavority" => $_POST["boosterfavorito"]??false,
        "BoosterFavorityB" => $_POST["boosterfavorito_booster"]??null,

        /**
         * @param POST[campeoesespecificos]
         *
         * Special parameter, The children only have an effect if the Father is TRUE (1)
         * Even though the Father is FALSE, some children are still set, but without values!
         *
         * If the  @param POST["superrestricao"] is false, the minimum value of @param POST["campeoes"] MUST BE 10
         * If the  @param POST["superrestricao"] is true, the max value of @param POST["campeoes] is 1
         */

        "SpecificCHAMPs" => $_POST["campeoesespecificos"]??false,
        "SuperRESTR" => $_POST["superrestricao"]??false, // Optional
        "Champions" => $_POST["campeoes"]??null, // multiple Values (nao esquecer de remover [])
        

        
        /**
         * @param POST[maestria]
         *
         * Special parameter, The children only have an effect if the Father is TRUE (1)
         * Even though the Father is FALSE, some children are still set, but without values!
         * This Dad can only be activated if the @param POST["campeoesespecificos"] is TRUE
         *
         *  O Campeão selecionado aqui deve ser o mesmo campeão do @param POST["campeoes"]
         */
        "Mastery" => $_POST["maestria"]??false,
        "MasteryHero" => $_POST["maestrias"]??null, // Value = (id_campeao/maestria_id) talvez Multiple Values
        

        
        /**
         * @param POST["horariosrestritos"]
         *
         * Mesmo se o Pai for FALSE, o Filho é setado um valor, sem nada.
         */
        "SchedulesREST" => $_POST["horariosrestritos"]??false,
        "Schedules" => $_POST["horarios"]??null, // TEXTO
        
        /**
         * @param SESSION["ALLDATE"]
         *
         * Em baixo todos os detalhes do servico PARTE 1
         */
        "EloSelecionado" => $_SESSION["SelectElo"],
        "EloDesejado" => $_SESSION["ToElo"],
        "DivisaoSelecionada" => $_SESSION["SelecetDivision"],
        "DivisaoDesejada" => $_SESSION["ToDivision"],
        "Fila" => $_SESSION["fila"],
        "Servico" => $_SESSION["Service"],
        "Prazo" => $_SESSION["prazo"],

    ) ];

    $ValorSessao = $_SESSION["valor"];

    if ($Params[0]["AccountMethod"] == 'adicionarconta')
    {
        $CheckAccount = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE (conta = :co AND Usuario != :u)");
        $CheckAccount->execute([":co" => $Params[0]["Login"], ":u" => $_SESSION["Usuario"]]);
        $CheckAccountR = $CheckAccount->fetch(PDO::FETCH_ASSOC);
        if (!$CheckAccountR)
        {
            if ($Params[0]["Summoner"] != '' || $Params[0]["Password"] != '' || $Params[0]["Login"] != '')
            {
                if ($Params[0]["Password"] == $Params[0]["RPassword"])
                {

                    $ValorTotal = $ValorSessao;
                    $Params[0]["RateMMR"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 25, 0) : null;
                    $Params[0]["SpecificRO"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 10, 0) : null;
                    $Params[0]["PrioritySER"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 25, 0) : null;
                    $Params[0]["ExtraWin"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 20, 0) : null;
                    $Params[0]["KDAReduce"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 35, 0) : null;
                    $Params[0]["StreamON"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 20, 0) : null;

                    /**
                     *  SpecificCHAMPs VERIFICANDO TUDO
                     *
                     */
                    $CountChampions = isset($Params[0]["Champions"]) == true ? count($Params[0]["Champions"]) : 0;
                    if ($Params[0]["SpecificCHAMPs"])
                    {
                        if ($Params[0]["SuperRESTR"] && ($CountChampions > 1 || $CountChampions == 0))
                        {
                            $_SESSION["PARAMSSUPER"] = 'Com a Super Restrição ativada, voce só pode escolher somente 1 Heroi';
                            header("Location: /user/servico/comprar");
                            exit;
                        }
                        if (!$Params[0]["SuperRESTR"] && ($CountChampions) < 10)
                        {
                            $_SESSION["PARAMSSUPER"] = 'Voce deve escolher no minimo 10 Herois';
                            header("Location: /user/servico/comprar");
                            exit;
                        }
                        $Params[0]["SpecificCHAMPs"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 15, 0) : null;
                    }

                    $Params[0]["SuperRESTR"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 25, 0) : null;
                    /**
                     * Maestria
                     *
                     * SISTEMA CHECKANDO SE ESTA ATIVO , E VERIFICANDO CAMPEOES
                     */
                    if ($Params[0]["Mastery"] && ($Params[0]["SpecificCHAMPs"]))
                    {
                        $MaestryArray = $EloTools->MaestriaForech($Params[0]["MasteryHero"]);

                        foreach ($MaestryArray as $Campeoes)
                        {
                            if (!in_array($Campeoes, $Params[0]["Champions"], false))
                            {
                                $_SESSION["PARAMSCamMaes"] = 'Voce só pode escolher herois já selecionados antes';
                                header("Location: /user/servico/comprar");
                                exit;
                                break;
                            }

                        }
                        $MaestryArrayM = $EloTools->MaestriaForech2($Params[0]["MasteryHero"]);
                        $ValorMaestriazero = 0;

                        foreach ($MaestryArrayM as $Values)
                        {
                            $ValorMaestriazero += $EloTools->MaestriasValues($Values);
                        }
                        $ValorTotal += $ValorMaestriazero; // VALOR 10 CONTO
                        
                    }
                    //$Params[0]["Mastery"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 15, 0) : null;
                    
                    /**
                     * HORARIO ALTERNATIVO
                     * CHECKANDO
                     */
                    if ($Params[0]["SchedulesREST"] && (isset($Params[0]["Schedules"]) && strlen($Params[0]["Schedules"]) == 0))
                    {
                        $_SESSION["PARAMSHorario"] = 'Voce deve especificar qual o horario permitido';
                        header("Location: /user/servico/comprar");
                        exit;
                    }

                    $Params[0]["SchedulesREST"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 30, 0) : null;

                    /**
                     * CHECKANDO SERVICO SOLO E REDUCAO DE PRAZOS JUNTOS
                     *
                     */
                    if ($Params[0]["SoloService"] && ($Params[0]["ReducePrazo"]))
                    {
                        $_SESSION["PARAMSSoloReduce"] = 'Não é possivel ter esses 2 servicos ativos';
                        header("Location: /user/servico/comprar");
                        exit;
                    }
                    $Params[0]["ReducePrazo"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 30, 0) : null;
                    $Params[0]["SoloService"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 30, 0) : null;

                    /**
                     * EXTRA BOOSTER FAVORITO
                     *
                     * CHECKANDO @param id
                     */
                    if ($Params[0]["BoosterFavority"])
                    {
                        $CheckBooster = $Server->prepareStatment("SELECT * FROM elo_users WHERE id = :i AND level >= 2");
                        $CheckBooster->execute([":i" => $Params[0]["BoosterFavorityB"]]);
                        $CheckBoosterR = $CheckBooster->fetch(PDO::FETCH_ASSOC);
                        if ($CheckBoosterR)
                        {
                            $Params[0]["BoosterFavority"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 15, 0) : null;
                            // CONTA ENCONTRADA
                            
                        }
                        else
                        {
                            $_SESSION["PARAMSBoosterFavorito"] = 'Booster Invalido';
                            header("Location: /user/servico/comprar");
                            exit;
                        }
                    }

                    if (strlen($Params[0]["Coupom"]) > 1)
                    {
                        $CheckCoupom = $Server->prepareStatment("SELECT * FROM booster_cupons WHERE code = :c");
                        $CheckCoupom->execute([":c" => $Params[0]["Coupom"]]);
                        $CheckCoupomR = $CheckCoupom->fetch(PDO::FETCH_ASSOC);
                        if ($CheckCoupomR)
                        {
                            $ValorCongelado = $ValorTotal;
                            $ValorCongeladoOK = $ValorCongelado - $EloTools->CalcularPorcentagem($ValorTotal, $CheckCoupomR["discount"], 1);

                            $CreateAccount = $Server->prepareStatment("INSERT INTO elo_users_accounts (usuario,conta,senha,invocador,working) VALUES(:u,:c,:s,:i,:w)");
                            $CreateAccount->execute([":u" => $_SESSION["Usuario"], ":c" => $Params[0]["Login"], ":s" => $Params[0]["Password"], ":i" => $Params[0]["Summoner"], ":w" => 1]);

                            if ($Params[0]["BoosterFavority"])
                            {
                                $Teste = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor,booster) VALUES(:u,:d,:v,:b)");
                                $Teste->execute([":u" => $_SESSION["Usuario"], ":d" => json_encode(array_filter($Params[0])) , ":v" => $EloTools->money_format('%n', $ValorCongeladoOK), ":b" => $Params[0]["BoosterFavorityB"]]);
                            }
                            else
                            {
                                $Teste = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor) VALUES(:u,:d,:v)");
                                $Teste->execute([":u" => $_SESSION["Usuario"], ":d" => json_encode(array_filter($Params[0])) , ":v" => $EloTools->money_format('%n', $ValorCongeladoOK) ]);
                            }
    
                            unset($_SESSION["SelectElo"]);
                            unset($_SESSION["SelecetDivision"]);
                            unset($_SESSION["ToElo"]);
                            unset($_SESSION["ToDivision"]);
                            unset($_SESSION["Service"]);
                            unset($_SESSION["fila"]);
                            unset($_SESSION["prazo"]);
                            unset($_SESSION["valor"]);

                            header("Location: /user/compras");
                            exit;

                        }
                        else
                        {
                            $_SESSION["PARAMSCupom"] = 'Cupom invalido 😭';
                            header("Location: /user/servico/comprar");
                            exit;
                        }
                    }
                    
                    if ($Params[0]["BoosterFavority"])
                    {
                        $Teste = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor,booster) VALUES(:u,:d,:v,:b)");
                        $Teste->execute([":u" => $_SESSION["Usuario"], ":d" => json_encode(array_filter($Params[0])) , ":v" => $EloTools->money_format('%n', $ValorTotal), ":b" => $Params[0]["BoosterFavorityB"] ]);
                    }
                    else
                    {
                        $Teste = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor) VALUES(:u,:d,:v)");
                        $Teste->execute([":u" => $_SESSION["Usuario"], ":d" => json_encode(array_filter($Params[0])) , ":v" => $EloTools->money_format('%n', $ValorTotal) ]);
                    }

                    $CreateAccount = $Server->prepareStatment("INSERT INTO elo_users_accounts (usuario,conta,senha,invocador,working) VALUES(:u,:c,:s,:i,:w)");
                    $CreateAccount->execute([":u" => $_SESSION["Usuario"], ":c" => $Params[0]["Login"], ":s" => $Params[0]["Password"], ":i" => $Params[0]["Summoner"], ":w" => 1]);

                 

                    unset($_SESSION["SelectElo"]);
                    unset($_SESSION["SelecetDivision"]);
                    unset($_SESSION["ToElo"]);
                    unset($_SESSION["ToDivision"]);
                    unset($_SESSION["Service"]);
                    unset($_SESSION["fila"]);
                    unset($_SESSION["prazo"]);
                    unset($_SESSION["valor"]);

                    header("Location: /user/compras");
                    exit;

                }
                else
                {
                    $_SESSION["PARAMSPass!="] = 'As senhas nao são iguais';
                    header("Location: /user/servico/comprar");
                    exit;
                }
            }

            $_SESSION["PARAMSComplet"] = "Preencha todos os campos!";
            header("Location: /user/servico/comprar");
            exit;
        }
        else
        {

            $_SESSION["PARAMSAccount"] = 'A conta que voce digitou já existe!';
            header("Location: /user/servico/comprar");
            exit;
        }
    }

    if ($Params[0]["AccountMethod"] == 'contaexistente')
    {
        $CheckAccount = $Server->prepareStatment("SELECT * FROM elo_users_accounts WHERE (id = :id AND usuario = :u AND working = 0)");
        $CheckAccount->execute([":id" => $Params[0]["LolAccount"], ":u" => $_SESSION["Usuario"]]);
        $CheckAccountR = $CheckAccount->fetch(PDO::FETCH_ASSOC);
        if ($CheckAccountR)
        {
            $ValorTotal = $ValorSessao;
            $Params[0]["RateMMR"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 25, 0) : null;
            $Params[0]["SpecificRO"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 10, 0) : null;
            $Params[0]["PrioritySER"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 25, 0) : null;
            $Params[0]["ExtraWin"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 20, 0) : null;
            $Params[0]["KDAReduce"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 35, 0) : null;
            $Params[0]["StreamON"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 20, 0) : null;

            /**
             *  SpecificCHAMPs VERIFICANDO TUDO
             *
             */
            if ($Params[0]["SpecificCHAMPs"])
            {
                if ($Params[0]["SuperRESTR"] && (count($Params[0]["Champions"]) > 1))
                {
                    $_SESSION["PARAMSSUPER"] = 'Com a Super Restrição ativada, voce só pode escolher somente 1 Heroi';
                    header("Location: /user/servico/comprar");
                    exit;
                }
                if (!$Params[0]["SuperRESTR"] && (count($Params[0]["Champions"]) < 10))
                {
                    $_SESSION["PARAMSSUPER"] = 'Voce deve escolher no minimo 10 Herois';
                    header("Location: /user/servico/comprar");
                    exit;
                }
                $Params[0]["SpecificCHAMPs"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 15, 0) : null;
            }
            $Params[0]["SuperRESTR"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 25, 0) : null;

            /**
             * Maestria
             *
             * SISTEMA CHECKANDO SE ESTA ATIVO , E VERIFICANDO CAMPEOES
             */
            if ($Params[0]["Mastery"] && ($Params[0]["SpecificCHAMPs"]))
            {
                $MaestryArray = $EloTools->MaestriaForech($Params[0]["MasteryHero"]);

                foreach ($MaestryArray as $Campeoes)
                {
                    if (!in_array($Campeoes, $Params[0]["Champions"], false))
                    {
                        $_SESSION["PARAMSCamMaes"] = 'Voce só pode escolher herois já selecionados antes';
                        header("Location: /user/servico/comprar");
                        exit;
                        break;
                    }

                }
                $MaestryArrayM = $EloTools->MaestriaForech2($Params[0]["MasteryHero"]);
                $ValorMaestriazero = 0;

                foreach ($MaestryArrayM as $Values)
                {
                    $ValorMaestriazero += $EloTools->MaestriasValues($Values);
                }
                $ValorTotal += $ValorMaestriazero; // VALOR 10 CONTO
                
            }
            //$Params[0]["Mastery"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 15, 0) : null;
            
            /**
             * HORARIO ALTERNATIVO
             * CHECKANDO
             */
            if ($Params[0]["SchedulesREST"] && (isset($Params[0]["Schedules"]) && strlen($Params[0]["Schedules"]) == 0))
            {
                $_SESSION["PARAMSHorario"] = 'Voce deve especificar qual o horario permitido';
                header("Location: /user/servico/comprar");
                exit;
            }

            $Params[0]["SchedulesREST"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 30, 0) : null;

            /**
             * CHECKANDO SERVICO SOLO E REDUCAO DE PRAZOS JUNTOS
             *
             */
            if ($Params[0]["SoloService"] && ($Params[0]["ReducePrazo"]))
            {
                $_SESSION["PARAMSSoloReduce"] = 'Não é possivel ter esses 2 servicos ativos';
                header("Location: /user/servico/comprar");
                exit;
            }
            $Params[0]["ReducePrazo"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 30, 0) : null;
            $Params[0]["SoloService"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 30, 0) : null;

            /**
             * EXTRA BOOSTER FAVORITO
             *
             * CHECKANDO @param id
             */
            if ($Params[0]["BoosterFavority"])
            {
                $CheckBooster = $Server->prepareStatment("SELECT * FROM elo_users WHERE id = :i AND level > :l");
                $CheckBooster->execute([":i" => $Params[0]["BoosterFavorityB"], ":l" => 1]);
                $CheckBoosterR = $CheckBooster->fetch(PDO::FETCH_ASSOC);
                if ($CheckAccountR)
                {
                    $Params[0]["BoosterFavority"] != false ? $ValorTotal = $ValorTotal + $EloTools->CalcularPorcentagem($ValorSessao, 15, 0) : null;
                    // CONTA ENCONTRADA
                    
                }
                else
                {
                    $_SESSION["PARAMSBoosterFavorito"] = 'Booster Invalido';
                    header("Location: /user/servico/comprar");
                    exit;
                }
            }

            if (strlen($Params[0]["Coupom"]) > 1)
            {
                $CheckCoupom = $Server->prepareStatment("SELECT * FROM booster_cupons WHERE code = :c");
                $CheckCoupom->execute([":c" => $Params[0]["Coupom"]]);
                $CheckCoupomR = $CheckCoupom->fetch(PDO::FETCH_ASSOC);
                if ($CheckCoupomR)
                {
                    $ValorCongelado = $ValorTotal;
                    $ValorCongeladoOK = $ValorCongelado - $EloTools->CalcularPorcentagem($ValorTotal, $CheckCoupomR["discount"], 1);
                    if ($Params[0]["BoosterFavority"])
                    {
                        $Teste = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor,booster) VALUES(:u,:d,:v,:b)");
                        $Teste->execute([":u" => $_SESSION["Usuario"], ":d" => json_encode(array_filter($Params[0])) , ":v" => $EloTools->money_format('%n', $ValorCongeladoOK), ":b" => $Params[0]["BoosterFavorityB"] ]);
                    }
                    else
                    {
                        $Teste = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor) VALUES(:u,:d,:v)");
                        $Teste->execute([":u" => $_SESSION["Usuario"], ":d" => json_encode(array_filter($Params[0])) , ":v" => $EloTools->money_format('%n', $ValorCongeladoOK) ]);
                    }
                    //":b" => $Params[0]["BoosterFavorityB"]
                  

                    $UpdateAccount = $Server->prepareStatment("UPDATE elo_users_accounts SET working = :w WHERE id = :id");
                    $UpdateAccount->execute([":w" => 1, ":id" => $Params[0]["LolAccount"]]);
                    unset($_SESSION["SelectElo"]);
                    unset($_SESSION["SelecetDivision"]);
                    unset($_SESSION["ToElo"]);
                    unset($_SESSION["ToDivision"]);
                    unset($_SESSION["Service"]);
                    unset($_SESSION["fila"]);
                    unset($_SESSION["prazo"]);
                    unset($_SESSION["valor"]);

                    header("Location: /user/compras");
                    exit;
                }
                else
                {
                    $_SESSION["PARAMSCupom"] = 'Cupom invalido 😭';
                    header("Location: /user/servico/comprar");
                    exit;
                }
            }
            if ($Params[0]["BoosterFavority"])
            {
            $Teste = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor) VALUES(:u,:d,:v,:b)");
            $Teste->execute([":u" => $_SESSION["Usuario"], ":d" => json_encode(array_filter($Params[0])) , ":v" => $EloTools->money_format('%n', $ValorTotal),":b" => $Params[0]["BoosterFavorityB"] ]);
            }
            else
            {
                $Teste = $Server->prepareStatment("INSERT INTO elo_users_invoices (usuario,data,valor) VALUES(:u,:d,:v)");
                $Teste->execute([":u" => $_SESSION["Usuario"], ":d" => json_encode(array_filter($Params[0])) , ":v" => $EloTools->money_format('%n', $ValorTotal) ]);    
            }
            $UpdateAccount = $Server->prepareStatment("UPDATE elo_users_accounts SET working = :w WHERE id = :id");
            $UpdateAccount->execute([":w" => 1, ":id" => $Params[0]["LolAccount"]]);

            unset($_SESSION["SelectElo"]);
            unset($_SESSION["SelecetDivision"]);
            unset($_SESSION["ToElo"]);
            unset($_SESSION["ToDivision"]);
            unset($_SESSION["Service"]);
            unset($_SESSION["fila"]);
            unset($_SESSION["prazo"]);
            unset($_SESSION["valor"]);

            header("Location: /user/compras");
            exit;

        }
        else
        {
            header("Location: /saguao");
            exit;
        }

    }

}
else
{
    header("Location: /saguao");
    exit;
}

