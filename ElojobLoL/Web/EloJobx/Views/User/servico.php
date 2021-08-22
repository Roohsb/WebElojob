<?php
if(!isset($URL[2]) || (isset($URL[2]) && $URL[2] != 'comprar')){
   header("Location: /user/centro");
   exit;
}
require __ROOT__."/EloJobx/Essential/JOBXCalculator/Calculator.php";
require __ROOT__."/EloJobx/Essential/JOBXCalculator/Essential.php";
require __ROOT__."/EloJobx/Essential/JOBXCalculator/Exception.php";

use JOBXCalculator\JOBXCalculator\{DuoBooster,EloBooster,MyException};


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if(isset($_SESSION["ToElo"]) && ($_SESSION["ToElo"] != $_POST["ToElo"])){
   unset($_SESSION["SelectElo"]);
   unset($_SESSION["SelecetDivision"]);
   unset($_SESSION["ToElo"]);
   unset($_SESSION["ToDivision"]);
   unset($_SESSION["Service"]);
   unset($_SESSION["fila"]);
   unset($_SESSION["prazo"]);
   unset($_SESSION["valor"]);
  }

 $Parameters = array(
       "ligaatual" =>         $_POST["SelectElo"] ?? null,
       "divisaoatual" =>      $_POST["SelecetDivision"] ?? null,
       "ligadesejada" =>      $_POST["ToElo"] ?? null,
       "divisaodesejada" =>   $_POST["ToDivision"] ?? null,
       "servico" =>           $_POST["Service"] ?? null,
       "fila" =>              @$_POST["fila"] != 'solo/duo' ? 'flex': 'solo/duo' 
    );

   $CalculateElo = $Parameters["servico"] == 'duoboost' ? new DuoBooster($Parameters): new EloBooster($Parameters);

   try{
      $Resultados = $CalculateElo->startBooster();
      if(!isset($_SESSION["SelectElo"]))
      {
      $_SESSION["SelectElo"] =       $_POST["SelectElo"];
      $_SESSION["SelecetDivision"] = $_POST["SelecetDivision"];
      $_SESSION["ToElo"] =           $_POST["ToElo"];
      $_SESSION["ToDivision"] =      $_POST["ToDivision"];
      $_SESSION["Service"] =         $_POST["Service"];
      $_SESSION["fila"] =           @$_POST["fila"] != 'solo/duo' ? 'flex': 'solo/duo';
      $_SESSION["prazo"] =           $Resultados["Deadline"];
      $_SESSION["valor"] =           $Resultados["Value"];
      }
   }catch(MyException $e){
      header("Location: /user/centro");
      exit;
   }
}else if($_SERVER['REQUEST_METHOD'] === 'GET' && (isset($_SESSION["SelectElo"]) && (isset($_SESSION["ToElo"]))))
{
   $Parameters = array(
      "ligaatual" =>         $_SESSION["SelectElo"] ?? null,
      "divisaoatual" =>      $_SESSION["SelecetDivision"]?? null,
      "ligadesejada" =>      $_SESSION["ToElo"] ?? null,
      "divisaodesejada" =>   $_SESSION["ToDivision"] ?? null,
      "servico" =>           $_SESSION["Service"] ?? null,
      "fila" =>              $_SESSION["fila"] != 'solo/duo' ? 'flex': 'solo/duo' 
   );

  $CalculateElo = $Parameters["servico"] == 'duoboost' ? new DuoBooster($Parameters): new EloBooster($Parameters);

  try{
     $Resultados = $CalculateElo->startBooster();
  }catch(MyException $e){
     //echo $e;
     header("Location: /user/centro");
     exit;
  }
}else{ header("Location: /user/centro"); exit;}


echo '<!DOCTYPE html>
   <html class="no-js" lang="pt">
      <head>
         <meta charset="utf-8">
         <title>LorenJob - Comprar > Elo Boost</title>
         <meta name="description" content="A maneira mais fácil e rápida de subir de ELO! Adquira já o seu serviço conosco!">
         <meta name="author" content="Diego Trindade">
         <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
         <link rel="shortcut icon" href="http://localhost:81/Template/imagens/logo_w.png">
         <link rel="stylesheet" href="/Template/css/user/bootstrap.min.css">
         <link rel="stylesheet" href="/Template/css/user/plugins.css">
         <link href="/Template/css/user/vex.css" rel="stylesheet" />
         <link href="/Template/css/user/vex-theme-os.css" rel="stylesheet" />
         <link rel="stylesheet" href="/Template/css/user/main.css">
         <link id="theme-link" rel="stylesheet" href="/Template/css/themes/'.GetDateUser($Server)[1]['thema'].'.css">
         <link rel="stylesheet" href="/Template/css/user/themes.css">
         <link rel="stylesheet" href="https://elojobhigh.com.br/app/assets/select2/css/select2-bootstrap.min.css">
         <script src="https://elojobhigh.com.br/app/assets/js/vendor/modernizr.min.js" type="d0e84d083d5609b84b74a572-text/javascript"></script>
         <style type="text/css">
            #box_campeoesespecificos ul{margin:0;padding:0;display:flex;flex-wrap:wrap;justify-content:center}#box_campeoesespecificos ul li{display:none;height:40px;width:40px;filter:grayscale(100%);transition:all .2s;cursor:pointer;border:2px solid #ddd;margin-right:2px;margin-left:2px;margin-bottom:2px;margin-top:2px;list-style:none;float:left}#box_campeoesespecificos ul li.mostrar{display:block!important}#box_campeoesespecificos ul li.selecionado{border:2px solid #2896c8;filter:grayscale(0)}#box_campeoesespecificos ul li img{width:40px;height:auto;max-width:100%}
            #box_maestria table{width:100%}#box_maestria table thead tr th{padding:5px 0}#box_maestria table tbody tr{border:1px dashed #fff;margin-bottom:2px}#box_maestria table tbody tr td{padding:3px 5px}#box_maestria table tbody tr td img{width:40px;height:auto;max-width:100%;border:2px solid #ddd}
         </style>
         <script>
         var total = '.$Resultados["Value"].';
         </script>
      </head>
      <body>
         <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZTSHM2"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
         <div id="page-wrapper">
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">';
            include 'EloJobx/Components/Header-User.php';
                  echo'<div id="page-content">
                     <div class="block">
                        <div class="block-title">
                           <h3>Serviço <strong>'.ucwords($_SESSION["Service"]).'</strong></h3>
                        </div>
                        <form action="http://localhost:81/api/purchase-booster" method="post" class="form-horizontal form-bordered">
                           <div class="form-group">


                              <div class="col-md-12">
                                 <h3><i class="gi gi-edit"></i> Serviço</h3>
                                 <p style="margin: 0 0 15px 0;"><strong>Este é o serviço que deseja contratar, certifique-se que está corretamente preenchido.</strong></p>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="ligaatual">Liga atual</label>
                                       <select name="ligaatual" disabled="disabled" id="ligaatual" class="form-control">
                                          '.$EloTools->SelectedElo($Parameters["ligaatual"]).'
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="divisaoatual">Divisão atual</label>
                                       <select name="divisaoatual" disabled="disabled" id="divisaoatual" class="form-control">
                                       '.$EloTools->SelectedDivison($Parameters["divisaoatual"]).'
                                       </select>
                                    </div>
                                  
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="ligadesejada">Liga desejada</label>
                                       <select name="ligadesejada" disabled="disabled" id="ligadesejada" class="form-control">
                                        '.$EloTools->SelectedElo($Parameters["ligadesejada"]).'
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="divisaodesejada">Divisão desejada</label>
                                       <select name="divisaodesejada" disabled="disabled" id="divisaodesejada" class="form-control">
                                       '.$EloTools->SelectedDivison($Parameters["divisaodesejada"]).'
                                       </select>
                                    </div>
                                  
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="fila">Fila desejada</label>
                                       <select name="fila" disabled="disabled" id="fila" class="form-control">
                                       <option value="'.$Parameters["fila"].'" selected="selected">'.ucwords($Parameters["fila"]).'</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="prazo">Prazo de entrega</label>
                                       <input type="text" name="prazo" value="'.$Resultados["Deadline"].' dia após a confirmação do pagamento + 5 dias" disabled="disabled" id="prazo" class="form-control" placeholder="Prazo">
                                       <span class="help-block">Normalmente os booster acabam bem antes desse prazo, mas em último caso, terá que esperar o prazo final.</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                              <h3>
                                 <i class="gi gi-keys"></i> Dados da Conta
                              </h3>
                              <p style="margin: 0;">
                                 <strong>Estes são os dados referentes ao acesso da sua conta no League of Legends.</strong>
                              </p>
                              <p style="margin: 0 0 15px 0;"><strong>OBS:</strong> 
                                 Os dados preenchidos só serão enviados ao nosso Banco de Dados se o pagamento for confirmado. Caso contrário, estes dados serão descartados e deletados. Nenhum dos dados serão acessados até a aprovação do pagamento e instruções. Somente a Administração terá acesso aos seus dados.
                              </p>
                              <div class="form-group">';
                                 MyAccountsLol($_SESSION["Usuario"],$Server);
                                 echo '</div>
                              <div class="col-md-12">
                                 <h3><i class="gi gi-cogwheel"></i> Extras</h3>
                                 <p style="margin: 0;"><strong>Abaixo, você poderá adicionar configurações adicionais e personalizar seu serviço, totalmente customizável. Nós fazemos do seu jeito!</strong></p>
                                 <p style="margin: 0 0 15px 0;"><strong>Selecione com atenção, pois uma vez finalizado o pedido, não é possível alteração, adição e a remoção de extras.</strong></p>
                                 <div class="col-md-6">
                                    <label class="checkbox-inline" for="taxammr">
                                    <input type="checkbox" id="taxammr" name="taxammr" value="1" class="extras" data-porcentagem="25"> Taxa MMR (+ 25%) </label>
                                    <p>
                                       <small>Marque esta opção caso esteja ganhando menos de 15 pontos de liga por vitória.
                                       <br />
                                       Caso contrário, valor da compra será convertido em vitórias do elo contratado.</small>
                                    </p>
                                    <label class="checkbox-inline" for="chatoffline">
                                    <input type="checkbox" id="chatoffline" name="chatoffline" value="1" checked="checked" class="extras" data-porcentagem="0"> Chat Offline (Grátis) </label>
                                    <p>
                                       <small>Desejo que o serviço seja feito no modo Offline</small>
                                    </p>
                                    <div id="box_chatoffline" class="themed-background text-light " style="padding: 10px;">
                                       <p style="margin: 0;">Com esta opção, sua conta ficará Offline (PVP.NET Desabilitado) e não será possível receber mensagens da sua lista de amigos. Além disso, ninguém verá que seu usuário está online ou dentro do jogo.</p>
                                    </div>
                                    <label class="checkbox-inline" for="posicaofeiticos">
                                    <input type="checkbox" id="posicaofeiticos" name="posicaofeiticos" value="1" checked="checked" class="extras" data-porcentagem="0"> Posição de Feitiços (Grátis) </label>
                                    <p>
                                       <small>Desejo escolher a posição do Feitiço FLASH (D ou F)</small>
                                    </p>
                                    <div id="box_posicaofeiticos" class="themed-background text-light " style="padding: 10px;">
                                       <p style="margin: 0 0 5px 0;">A seguir, você poderá escolher a posição do Feitiço de Invocador (Flash) que nossos profissionais irão utilizar durante o processo de Boosting.</p>
                                       <label class="bg-primary" for="flash_f" style="margin-right: 10px;padding: 10px;border-radius: 6px;">
                                       <input type="radio" name="flash" id="flash_f" value="F" checked="checked"> <img src="https://elojobhigh.com.br/app/assets/imagens/spell-flash.png" style="max-height: 25px;" alt="Flash F"> <span>FLASH - F</span>
                                       </label>
                                       <label class="bg-primary" for="flash_d" style="padding: 10px;border-radius: 6px;">
                                       <input type="radio" name="flash" id="flash_d" value="D"> <img src="https://elojobhigh.com.br/app/assets/imagens/spell-flash.png" style="max-height: 25px;" alt="Flash D"> <span>FLASH - D</span>
                                       </label>
                                    </div>
                                    <label class="checkbox-inline" for="rotasespecificas">
                                    <input type="checkbox" id="rotasespecificas" name="rotasespecificas" value="1" class="extras" data-porcentagem="10"> Rotas Específicas (+ 10%) </label>
                                    <p>
                                       <small>Desejo determinar as rotas prioritárias para o serviço</small>
                                    </p>
                                    <div id="box_rotasespecificas" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0 0 5px 0;">Escolha a prioridade de rotas que nossos jogadores irão utilizar durante o processo de Boosting. Você deverá escolher <strong>2 rotas distintas</strong>, sendo elas: uma primária e uma secundária. A rota "Primária" é sua principal rota, enquanto a "Secundária" é sua rota alternativa.</p>
                                       <table class="table table-striped">
                                          <tr class="themed-color-dark">
                                             <td>
                                                &nbsp;
                                             </td>
                                             <td>
                                                <img src="https://elojobhigh.com.br/app/assets/imagens/lane-top.png" style="max-height: 25px;" alt="TOP"> TOP
                                             </td>
                                             <td>
                                                <img src="https://elojobhigh.com.br/app/assets/imagens/lane-jungle.png" style="max-height: 25px;" alt="JNG"> JNG
                                             </td>
                                             <td>
                                                <img src="https://elojobhigh.com.br/app/assets/imagens/lane-mid.png" style="max-height: 25px;" alt="MID"> MID
                                             </td>
                                             <td>
                                                <img src="https://elojobhigh.com.br/app/assets/imagens/lane-adc.png" style="max-height: 25px;" alt="ADC"> ADC
                                             </td>
                                             <td>
                                                <img src="https://elojobhigh.com.br/app/assets/imagens/lane-support.png" style="max-height: 25px;" alt="SUP"> SUP
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Primário</td>
                                             <td>
                                                <input type="radio" name="rotaprimario" value="top">
                                             </td>
                                             <td>
                                                <input type="radio" name="rotaprimario" value="jng">
                                             </td>
                                             <td>
                                                <input type="radio" name="rotaprimario" value="mid" checked="checked">
                                             </td>
                                             <td>
                                                <input type="radio" name="rotaprimario" value="adc">
                                             </td>
                                             <td>
                                                <input type="radio" name="rotaprimario" value="sup">
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="text-primary">Secundário</td>
                                             <td>
                                                <input type="radio" name="rotasecundario" value="top" checked="checked">
                                             </td>
                                             <td>
                                                <input type="radio" name="rotasecundario" value="jng">
                                             </td>
                                             <td>
                                                <input type="radio" name="rotasecundario" value="mid">
                                             </td>
                                             <td>
                                                <input type="radio" name="rotasecundario" value="adc">
                                             </td>
                                             <td>
                                                <input type="radio" name="rotasecundario" value="sup">
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                    <label class="checkbox-inline" for="servicoprioritario">
                                    <input type="checkbox" id="servicoprioritario" name="servicoprioritario" value="1" class="extras" data-porcentagem="25"> Serviço Prioritário (+ 25%) </label>
                                    <p>
                                       <small>Desejo que esse serviço seja feito de forma prioritária</small>
                                    </p>
                                    <div id="box_servicoprioritario" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0;">Com esta opção selecionada, seu serviço terá prioridade urgencial para ser executado, isto é, iremos fazer com que ele seja imediatamente iniciado.</p>
                                    </div>
                                    <label class="checkbox-inline" for="vitoriaextra">
                                    <input type="checkbox" id="vitoriaextra" name="vitoriaextra" value="1" class="extras" data-porcentagem="20"> Vitória Extra (+ 20%) </label>
                                    <p>
                                       <small>Desejo uma vitória adicional ao término do serviço</small>
                                    </p>
                                    <div id="box_vitoriaextra" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0;">Com esta opção selecionada, após o booster alcançar o elo desejado, ele fará uma vitória adicional para a conta não ficar com 0 pdls. oferecendo assim, maior segurança para a conta não correr o risco de rebaixamento de elo ("drop"), em caso de sequência de derrotas.(extra indisponível para Diamante I ou superior)</p>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <label class="checkbox-inline" for="boosterfavorito">
                                    <input type="checkbox" id="boosterfavorito" name="boosterfavorito" value="1" class="extras" data-porcentagem="15"> Booster Favorito (+ 15%) </label>
                                    <p>
                                       <small>Desejo escolher meu booster favorito</small>
                                    </p>';
                                     if(isset($_SESSION["PARAMSBoosterFavorito"])){echo '<p style="color: red;">'.$_SESSION["PARAMSBoosterFavorito"].'</p>'; unset($_SESSION["PARAMSBoosterFavorito"]);} 
                                    echo '<div id="box_boosterfavorito" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0; margin-bottom: 10px;">Com esta opção selecionada, você poderá escolher um booster específico para realizar seu serviço. nota: se o booster escolhido estiver realizando outro serviço, este tem prioridade, logo após será iniciado o seu serviço.</p>
                                       <select name="boosterfavorito_booster" id="boosterfavorito_booster" class="form-control select2">';
                                       Boosters($Server);
                                          ?>
                                       </select>
                                    </div>
                                    <label class="checkbox-inline" for="campeoesespecificos">
                                    <input type="checkbox" id="campeoesespecificos" name="campeoesespecificos" value="1" class="extras" data-porcentagem="15"> Campeões Específicos (+ 15%) </label>
                                    <p>
                                       <small>Desejo determinar os campeões prioritários para o serviço</small>
                                    </p> <?php if(isset($_SESSION["PARAMSSUPER"])){echo '<p style="color: red;">'.$_SESSION["PARAMSSUPER"].'</p>'; unset($_SESSION["PARAMSSUPER"]); } ?>
                                    <div id="box_campeoesespecificos" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0 0 5px 0;">Com esta opção, você escolhe a prioridade de campeões que nossos jogadores irão utilizar durante o processo de Boosting. <span id="aviso10campeoes">Você deverá escolher, no mínimo, 10 campeões.</span></p>
                                       <label class="checkbox-inline" for="superrestricao">
                                       <input type="checkbox" id="superrestricao" name="superrestricao" value="1" class="extras" data-porcentagem="25"> Super Restrição (+ 25%) </label>
                                       <p style="margin: 0;">
                                          <small>Com esta opção selecionada, você poderá escolher somente 1 campeão, em vez de no mínimo 10 campeões, para executarmos o serviço com total prioridade. (Extra disponível até o Mestre)</small>
                                       </p>
                                       <div class="form-group" style="margin-bottom:10px;">
                                          <label for="pesquisar">Pesquisar</label>
                                          <input type="text" name="pesquisar" value="" id="pesquisar" class="form-control" placeholder="Pesquise os campeões aqui...">
                                       </div>
                                       <ul>
                                          <li class="mostrar " data-title="Aatrox" data-id="1">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="1" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Aatrox.png" data-toggle="tooltip" title="Aatrox" alt="Aatrox">
                                          </li>
                                          <li class="mostrar " data-title="Ahri" data-id="2">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="2" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ahri.png" data-toggle="tooltip" title="Ahri" alt="Ahri">
                                          </li>
                                          <li class="mostrar " data-title="Akali" data-id="3">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="3" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Akali.png" data-toggle="tooltip" title="Akali" alt="Akali">
                                          </li>
                                          <li class="mostrar " data-title="Alistar" data-id="4">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="4" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Alistar.png" data-toggle="tooltip" title="Alistar" alt="Alistar">
                                          </li>
                                          <li class="mostrar " data-title="Amumu" data-id="5">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="5" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Amumu.png" data-toggle="tooltip" title="Amumu" alt="Amumu">
                                          </li>
                                          <li class="mostrar " data-title="Anivia" data-id="6">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="6" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Anivia.png" data-toggle="tooltip" title="Anivia" alt="Anivia">
                                          </li>
                                          <li class="mostrar " data-title="Annie" data-id="7">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="7" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Annie.png" data-toggle="tooltip" title="Annie" alt="Annie">
                                          </li>
                                          <li class="mostrar " data-title="Aphelios" data-id="150">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="150" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Aphelios.png" data-toggle="tooltip" title="Aphelios" alt="Aphelios">
                                          </li>
                                          <li class="mostrar " data-title="Ashe" data-id="8">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="8" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ashe.png" data-toggle="tooltip" title="Ashe" alt="Ashe">
                                          </li>
                                          <li class="mostrar " data-title="Aurelion Sol" data-id="9">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="9" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/AurelionSol.png" data-toggle="tooltip" title="Aurelion Sol" alt="Aurelion Sol">
                                          </li>
                                          <li class="mostrar " data-title="Azir" data-id="10">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="10" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Azir.png" data-toggle="tooltip" title="Azir" alt="Azir">
                                          </li>
                                          <li class="mostrar " data-title="Bardo" data-id="11">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="11" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Bard.png" data-toggle="tooltip" title="Bardo" alt="Bardo">
                                          </li>
                                          <li class="mostrar " data-title="Blitzcrank" data-id="12">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="12" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Blitzcrank.png" data-toggle="tooltip" title="Blitzcrank" alt="Blitzcrank">
                                          </li>
                                          <li class="mostrar " data-title="Brand" data-id="13">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="13" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Brand.png" data-toggle="tooltip" title="Brand" alt="Brand">
                                          </li>
                                          <li class="mostrar " data-title="Braum" data-id="14">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="14" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Braum.png" data-toggle="tooltip" title="Braum" alt="Braum">
                                          </li>
                                          <li class="mostrar " data-title="Caitlyn" data-id="15">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="15" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Caitlyn.png" data-toggle="tooltip" title="Caitlyn" alt="Caitlyn">
                                          </li>
                                          <li class="mostrar " data-title="Camille" data-id="16">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="16" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Camille.png" data-toggle="tooltip" title="Camille" alt="Camille">
                                          </li>
                                          <li class="mostrar " data-title="Cassiopeia" data-id="17">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="17" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Cassiopeia.png" data-toggle="tooltip" title="Cassiopeia" alt="Cassiopeia">
                                          </li>
                                          <li class="mostrar " data-title="Cho'Gath" data-id="18">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="18" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Chogath.png" data-toggle="tooltip" title="Cho'Gath" alt="Cho'Gath">
                                          </li>
                                          <li class="mostrar " data-title="Corki" data-id="19">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="19" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Corki.png" data-toggle="tooltip" title="Corki" alt="Corki">
                                          </li>
                                          <li class="mostrar " data-title="Darius" data-id="20">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="20" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Darius.png" data-toggle="tooltip" title="Darius" alt="Darius">
                                          </li>
                                          <li class="mostrar " data-title="Diana" data-id="21">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="21" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Diana.png" data-toggle="tooltip" title="Diana" alt="Diana">
                                          </li>
                                          <li class="mostrar " data-title="Dr. Mundo" data-id="23">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="23" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/DrMundo.png" data-toggle="tooltip" title="Dr. Mundo" alt="Dr. Mundo">
                                          </li>
                                          <li class="mostrar " data-title="Draven" data-id="22">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="22" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Draven.png" data-toggle="tooltip" title="Draven" alt="Draven">
                                          </li>
                                          <li class="mostrar " data-title="Ekko" data-id="24">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="24" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ekko.png" data-toggle="tooltip" title="Ekko" alt="Ekko">
                                          </li>
                                          <li class="mostrar " data-title="Elise" data-id="25">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="25" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Elise.png" data-toggle="tooltip" title="Elise" alt="Elise">
                                          </li>
                                          <li class="mostrar " data-title="Evelynn" data-id="26">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="26" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Evelynn.png" data-toggle="tooltip" title="Evelynn" alt="Evelynn">
                                          </li>
                                          <li class="mostrar " data-title="Ezreal" data-id="27">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="27" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ezreal.png" data-toggle="tooltip" title="Ezreal" alt="Ezreal">
                                          </li>
                                          <li class="mostrar " data-title="Fiddlesticks" data-id="28">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="28" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Fiddlesticks.png" data-toggle="tooltip" title="Fiddlesticks" alt="Fiddlesticks">
                                          </li>
                                          <li class="mostrar " data-title="Fiora" data-id="29">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="29" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Fiora.png" data-toggle="tooltip" title="Fiora" alt="Fiora">
                                          </li>
                                          <li class="mostrar " data-title="Fizz" data-id="30">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="30" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Fizz.png" data-toggle="tooltip" title="Fizz" alt="Fizz">
                                          </li>
                                          <li class="mostrar " data-title="Galio" data-id="31">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="31" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Galio.png" data-toggle="tooltip" title="Galio" alt="Galio">
                                          </li>
                                          <li class="mostrar " data-title="Gangplank" data-id="32">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="32" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Gangplank.png" data-toggle="tooltip" title="Gangplank" alt="Gangplank">
                                          </li>
                                          <li class="mostrar " data-title="Garen" data-id="33">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="33" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Garen.png" data-toggle="tooltip" title="Garen" alt="Garen">
                                          </li>
                                          <li class="mostrar " data-title="Gnar" data-id="34">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="34" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Gnar.png" data-toggle="tooltip" title="Gnar" alt="Gnar">
                                          </li>
                                          <li class="mostrar " data-title="Gragas" data-id="35">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="35" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Gragas.png" data-toggle="tooltip" title="Gragas" alt="Gragas">
                                          </li>
                                          <li class="mostrar " data-title="Graves" data-id="36">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="36" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Graves.png" data-toggle="tooltip" title="Graves" alt="Graves">
                                          </li>
                                          <li class="mostrar " data-title="Gwen" data-id="165">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="165" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Gwen.png" data-toggle="tooltip" title="Gwen" alt="Gwen">
                                          </li>
                                          <li class="mostrar " data-title="Hecarim" data-id="37">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="37" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Hecarim.png" data-toggle="tooltip" title="Hecarim" alt="Hecarim">
                                          </li>
                                          <li class="mostrar " data-title="Heimerdinger" data-id="38">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="38" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Heimerdinger.png" data-toggle="tooltip" title="Heimerdinger" alt="Heimerdinger">
                                          </li>
                                          <li class="mostrar " data-title="Illaoi" data-id="39">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="39" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Illaoi.png" data-toggle="tooltip" title="Illaoi" alt="Illaoi">
                                          </li>
                                          <li class="mostrar " data-title="Irelia" data-id="40">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="40" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Irelia.png" data-toggle="tooltip" title="Irelia" alt="Irelia">
                                          </li>
                                          <li class="mostrar " data-title="Ivern" data-id="41">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="41" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ivern.png" data-toggle="tooltip" title="Ivern" alt="Ivern">
                                          </li>
                                          <li class="mostrar " data-title="Janna" data-id="42">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="42" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Janna.png" data-toggle="tooltip" title="Janna" alt="Janna">
                                          </li>
                                          <li class="mostrar " data-title="Jarvan IV" data-id="43">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="43" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/JarvanIV.png" data-toggle="tooltip" title="Jarvan IV" alt="Jarvan IV">
                                          </li>
                                          <li class="mostrar " data-title="Jax" data-id="44">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="44" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Jax.png" data-toggle="tooltip" title="Jax" alt="Jax">
                                          </li>
                                          <li class="mostrar " data-title="Jayce" data-id="45">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="45" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Jayce.png" data-toggle="tooltip" title="Jayce" alt="Jayce">
                                          </li>
                                          <li class="mostrar " data-title="Jhin" data-id="46">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="46" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Jhin.png" data-toggle="tooltip" title="Jhin" alt="Jhin">
                                          </li>
                                          <li class="mostrar " data-title="Jinx" data-id="47">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="47" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Jinx.png" data-toggle="tooltip" title="Jinx" alt="Jinx">
                                          </li>
                                          <li class="mostrar " data-title="Kai'Sa" data-id="48">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="48" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kaisa.png" data-toggle="tooltip" title="Kai'Sa" alt="Kai'Sa">
                                          </li>
                                          <li class="mostrar " data-title="Kalista" data-id="49">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="49" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kalista.png" data-toggle="tooltip" title="Kalista" alt="Kalista">
                                          </li>
                                          <li class="mostrar " data-title="Karma" data-id="50">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="50" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Karma.png" data-toggle="tooltip" title="Karma" alt="Karma">
                                          </li>
                                          <li class="mostrar " data-title="Karthus" data-id="51">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="51" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Karthus.png" data-toggle="tooltip" title="Karthus" alt="Karthus">
                                          </li>
                                          <li class="mostrar " data-title="Kassadin" data-id="52">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="52" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kassadin.png" data-toggle="tooltip" title="Kassadin" alt="Kassadin">
                                          </li>
                                          <li class="mostrar " data-title="Katarina" data-id="53">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="53" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Katarina.png" data-toggle="tooltip" title="Katarina" alt="Katarina">
                                          </li>
                                          <li class="mostrar " data-title="Kayle" data-id="54">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="54" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kayle.png" data-toggle="tooltip" title="Kayle" alt="Kayle">
                                          </li>
                                          <li class="mostrar " data-title="Kayn" data-id="55">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="55" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kayn.png" data-toggle="tooltip" title="Kayn" alt="Kayn">
                                          </li>
                                          <li class="mostrar " data-title="Kennen" data-id="56">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="56" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kennen.png" data-toggle="tooltip" title="Kennen" alt="Kennen">
                                          </li>
                                          <li class="mostrar " data-title="Kha'Zix" data-id="57">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="57" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Khazix.png" data-toggle="tooltip" title="Kha'Zix" alt="Kha'Zix">
                                          </li>
                                          <li class="mostrar " data-title="Kindred" data-id="58">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="58" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kindred.png" data-toggle="tooltip" title="Kindred" alt="Kindred">
                                          </li>
                                          <li class="mostrar " data-title="Kled" data-id="59">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="59" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kled.png" data-toggle="tooltip" title="Kled" alt="Kled">
                                          </li>
                                          <li class="mostrar " data-title="Kog'Maw" data-id="60">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="60" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/KogMaw.png" data-toggle="tooltip" title="Kog'Maw" alt="Kog'Maw">
                                          </li>
                                          <li class="mostrar " data-title="LeBlanc" data-id="61">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="61" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Leblanc.png" data-toggle="tooltip" title="LeBlanc" alt="LeBlanc">
                                          </li>
                                          <li class="mostrar " data-title="Lee Sin" data-id="62">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="62" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/LeeSin.png" data-toggle="tooltip" title="Lee Sin" alt="Lee Sin">
                                          </li>
                                          <li class="mostrar " data-title="Leona" data-id="63">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="63" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Leona.png" data-toggle="tooltip" title="Leona" alt="Leona">
                                          </li>
                                          <li class="mostrar " data-title="Lillia" data-id="154">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="154" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lillia.png" data-toggle="tooltip" title="Lillia" alt="Lillia">
                                          </li>
                                          <li class="mostrar " data-title="Lissandra" data-id="64">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="64" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lissandra.png" data-toggle="tooltip" title="Lissandra" alt="Lissandra">
                                          </li>
                                          <li class="mostrar " data-title="Lucian" data-id="65">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="65" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lucian.png" data-toggle="tooltip" title="Lucian" alt="Lucian">
                                          </li>
                                          <li class="mostrar " data-title="Lulu" data-id="66">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="66" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lulu.png" data-toggle="tooltip" title="Lulu" alt="Lulu">
                                          </li>
                                          <li class="mostrar " data-title="Lux" data-id="67">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="67" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lux.png" data-toggle="tooltip" title="Lux" alt="Lux">
                                          </li>
                                          <li class="mostrar " data-title="Malphite" data-id="68">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="68" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Malphite.png" data-toggle="tooltip" title="Malphite" alt="Malphite">
                                          </li>
                                          <li class="mostrar " data-title="Malzahar" data-id="69">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="69" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Malzahar.png" data-toggle="tooltip" title="Malzahar" alt="Malzahar">
                                          </li>
                                          <li class="mostrar " data-title="Maokai" data-id="70">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="70" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Maokai.png" data-toggle="tooltip" title="Maokai" alt="Maokai">
                                          </li>
                                          <li class="mostrar " data-title="Master Yi" data-id="71">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="71" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/MasterYi.png" data-toggle="tooltip" title="Master Yi" alt="Master Yi">
                                          </li>
                                          <li class="mostrar " data-title="Miss Fortune" data-id="72">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="72" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/MissFortune.png" data-toggle="tooltip" title="Miss Fortune" alt="Miss Fortune">
                                          </li>
                                          <li class="mostrar " data-title="Mordekaiser" data-id="160">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="160" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Mordekaiser1.png" data-toggle="tooltip" title="Mordekaiser" alt="Mordekaiser">
                                          </li>
                                          <li class="mostrar " data-title="Morgana" data-id="75">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="75" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Morgana.png" data-toggle="tooltip" title="Morgana" alt="Morgana">
                                          </li>
                                          <li class="mostrar " data-title="Nami" data-id="76">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="76" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nami.png" data-toggle="tooltip" title="Nami" alt="Nami">
                                          </li>
                                          <li class="mostrar " data-title="Nasus" data-id="77">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="77" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nasus.png" data-toggle="tooltip" title="Nasus" alt="Nasus">
                                          </li>
                                          <li class="mostrar " data-title="Nautilus" data-id="78">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="78" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nautilus.png" data-toggle="tooltip" title="Nautilus" alt="Nautilus">
                                          </li>
                                          <li class="mostrar " data-title="Neeko" data-id="79">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="79" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Neeko.png" data-toggle="tooltip" title="Neeko" alt="Neeko">
                                          </li>
                                          <li class="mostrar " data-title="Nidalee" data-id="80">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="80" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nidalee.png" data-toggle="tooltip" title="Nidalee" alt="Nidalee">
                                          </li>
                                          <li class="mostrar " data-title="Nocturne" data-id="81">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="81" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nocturne.png" data-toggle="tooltip" title="Nocturne" alt="Nocturne">
                                          </li>
                                          <li class="mostrar " data-title="Nunu e Willump" data-id="82">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="82" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nunu.png" data-toggle="tooltip" title="Nunu e Willump" alt="Nunu e Willump">
                                          </li>
                                          <li class="mostrar " data-title="Olaf" data-id="83">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="83" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Olaf.png" data-toggle="tooltip" title="Olaf" alt="Olaf">
                                          </li>
                                          <li class="mostrar " data-title="Orianna" data-id="84">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="84" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Orianna.png" data-toggle="tooltip" title="Orianna" alt="Orianna">
                                          </li>
                                          <li class="mostrar " data-title="Ornn" data-id="85">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="85" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ornn.png" data-toggle="tooltip" title="Ornn" alt="Ornn">
                                          </li>
                                          <li class="mostrar " data-title="Pantheon" data-id="86">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="86" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Pantheon.png" data-toggle="tooltip" title="Pantheon" alt="Pantheon">
                                          </li>
                                          <li class="mostrar " data-title="Poppy" data-id="87">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="87" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Poppy.png" data-toggle="tooltip" title="Poppy" alt="Poppy">
                                          </li>
                                          <li class="mostrar " data-title="Pyke" data-id="88">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="88" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Pyke.png" data-toggle="tooltip" title="Pyke" alt="Pyke">
                                          </li>
                                          <li class="mostrar " data-title="Qiyana" data-id="153">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="153" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Qiyana.png" data-toggle="tooltip" title="Qiyana" alt="Qiyana">
                                          </li>
                                          <li class="mostrar " data-title="Quinn" data-id="89">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="89" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Quinn.png" data-toggle="tooltip" title="Quinn" alt="Quinn">
                                          </li>
                                          <li class="mostrar " data-title="Rakan" data-id="90">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="90" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rakan.png" data-toggle="tooltip" title="Rakan" alt="Rakan">
                                          </li>
                                          <li class="mostrar " data-title="Rammus" data-id="91">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="91" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rammus.png" data-toggle="tooltip" title="Rammus" alt="Rammus">
                                          </li>
                                          <li class="mostrar " data-title="Rek'Sai" data-id="92">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="92" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/RekSai.png" data-toggle="tooltip" title="Rek'Sai" alt="Rek'Sai">
                                          </li>
                                          <li class="mostrar " data-title="Rell" data-id="163">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="163" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rell.png" data-toggle="tooltip" title="Rell" alt="Rell">
                                          </li>
                                          <li class="mostrar " data-title="Renekton" data-id="93">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="93" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Renekton.png" data-toggle="tooltip" title="Renekton" alt="Renekton">
                                          </li>
                                          <li class="mostrar " data-title="Rengar" data-id="94">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="94" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rengar.png" data-toggle="tooltip" title="Rengar" alt="Rengar">
                                          </li>
                                          <li class="mostrar " data-title="Riven" data-id="95">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="95" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Riven.png" data-toggle="tooltip" title="Riven" alt="Riven">
                                          </li>
                                          <li class="mostrar " data-title="Rumble" data-id="96">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="96" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rumble.png" data-toggle="tooltip" title="Rumble" alt="Rumble">
                                          </li>
                                          <li class="mostrar " data-title="Ryze" data-id="97">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="97" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ryze.png" data-toggle="tooltip" title="Ryze" alt="Ryze">
                                          </li>
                                          <li class="mostrar " data-title="Samira" data-id="156">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="156" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Samira.png" data-toggle="tooltip" title="Samira" alt="Samira">
                                          </li>
                                          <li class="mostrar " data-title="Sejuani" data-id="98">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="98" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sejuani.png" data-toggle="tooltip" title="Sejuani" alt="Sejuani">
                                          </li>
                                          <li class="mostrar " data-title="Senna" data-id="152">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="152" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Senna.png" data-toggle="tooltip" title="Senna" alt="Senna">
                                          </li>
                                          <li class="mostrar " data-title="Seraphine" data-id="162">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="162" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Seraphine.png" data-toggle="tooltip" title="Seraphine" alt="Seraphine">
                                          </li>
                                          <li class="mostrar " data-title="Sett" data-id="151">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="151" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sett.png" data-toggle="tooltip" title="Sett" alt="Sett">
                                          </li>
                                          <li class="mostrar " data-title="Shaco" data-id="99">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="99" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Shaco.png" data-toggle="tooltip" title="Shaco" alt="Shaco">
                                          </li>
                                          <li class="mostrar " data-title="Shen" data-id="100">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="100" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Shen.png" data-toggle="tooltip" title="Shen" alt="Shen">
                                          </li>
                                          <li class="mostrar " data-title="Shyvana" data-id="101">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="101" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Shyvana.png" data-toggle="tooltip" title="Shyvana" alt="Shyvana">
                                          </li>
                                          <li class="mostrar " data-title="Singed" data-id="102">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="102" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Singed.png" data-toggle="tooltip" title="Singed" alt="Singed">
                                          </li>
                                          <li class="mostrar " data-title="Sion" data-id="103">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="103" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sion.png" data-toggle="tooltip" title="Sion" alt="Sion">
                                          </li>
                                          <li class="mostrar " data-title="Sivir" data-id="104">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="104" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sivir.png" data-toggle="tooltip" title="Sivir" alt="Sivir">
                                          </li>
                                          <li class="mostrar " data-title="Skarner" data-id="105">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="105" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Skarner.png" data-toggle="tooltip" title="Skarner" alt="Skarner">
                                          </li>
                                          <li class="mostrar " data-title="Sona" data-id="106">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="106" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sona.png" data-toggle="tooltip" title="Sona" alt="Sona">
                                          </li>
                                          <li class="mostrar " data-title="Soraka" data-id="107">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="107" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Soraka.png" data-toggle="tooltip" title="Soraka" alt="Soraka">
                                          </li>
                                          <li class="mostrar " data-title="Swain" data-id="108">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="108" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Swain.png" data-toggle="tooltip" title="Swain" alt="Swain">
                                          </li>
                                          <li class="mostrar " data-title="Sylas" data-id="109">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="109" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sylas.png" data-toggle="tooltip" title="Sylas" alt="Sylas">
                                          </li>
                                          <li class="mostrar " data-title="Syndra" data-id="110">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="110" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Syndra.png" data-toggle="tooltip" title="Syndra" alt="Syndra">
                                          </li>
                                          <li class="mostrar " data-title="Tahm Kench" data-id="111">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="111" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/TahmKench.png" data-toggle="tooltip" title="Tahm Kench" alt="Tahm Kench">
                                          </li>
                                          <li class="mostrar " data-title="Taliyah" data-id="112">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="112" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Taliyah.png" data-toggle="tooltip" title="Taliyah" alt="Taliyah">
                                          </li>
                                          <li class="mostrar " data-title="Talon" data-id="113">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="113" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Talon.png" data-toggle="tooltip" title="Talon" alt="Talon">
                                          </li>
                                          <li class="mostrar " data-title="Taric" data-id="114">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="114" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Taric.png" data-toggle="tooltip" title="Taric" alt="Taric">
                                          </li>
                                          <li class="mostrar " data-title="Teemo" data-id="115">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="115" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Teemo.png" data-toggle="tooltip" title="Teemo" alt="Teemo">
                                          </li>
                                          <li class="mostrar " data-title="Thresh" data-id="116">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="116" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Thresh.png" data-toggle="tooltip" title="Thresh" alt="Thresh">
                                          </li>
                                          <li class="mostrar " data-title="Tristana" data-id="117">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="117" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Tristana.png" data-toggle="tooltip" title="Tristana" alt="Tristana">
                                          </li>
                                          <li class="mostrar " data-title="Trundle" data-id="118">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="118" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Trundle.png" data-toggle="tooltip" title="Trundle" alt="Trundle">
                                          </li>
                                          <li class="mostrar " data-title="Tryndamere" data-id="119">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="119" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Tryndamere.png" data-toggle="tooltip" title="Tryndamere" alt="Tryndamere">
                                          </li>
                                          <li class="mostrar " data-title="Twisted Fate" data-id="120">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="120" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/TwistedFate.png" data-toggle="tooltip" title="Twisted Fate" alt="Twisted Fate">
                                          </li>
                                          <li class="mostrar " data-title="Twitch" data-id="121">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="121" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Twitch.png" data-toggle="tooltip" title="Twitch" alt="Twitch">
                                          </li>
                                          <li class="mostrar " data-title="Udyr" data-id="122">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="122" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Udyr.png" data-toggle="tooltip" title="Udyr" alt="Udyr">
                                          </li>
                                          <li class="mostrar " data-title="Urgot" data-id="123">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="123" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Urgot.png" data-toggle="tooltip" title="Urgot" alt="Urgot">
                                          </li>
                                          <li class="mostrar " data-title="Varus" data-id="124">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="124" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Varus.png" data-toggle="tooltip" title="Varus" alt="Varus">
                                          </li>
                                          <li class="mostrar " data-title="Vayne" data-id="125">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="125" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Vayne.png" data-toggle="tooltip" title="Vayne" alt="Vayne">
                                          </li>
                                          <li class="mostrar " data-title="Veigar" data-id="126">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="126" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Veigar.png" data-toggle="tooltip" title="Veigar" alt="Veigar">
                                          </li>
                                          <li class="mostrar " data-title="Vel'Koz" data-id="127">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="127" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Velkoz.png" data-toggle="tooltip" title="Vel'Koz" alt="Vel'Koz">
                                          </li>
                                          <li class="mostrar " data-title="Vi" data-id="128">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="128" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Vi.png" data-toggle="tooltip" title="Vi" alt="Vi">
                                          </li>
                                          <li class="mostrar " data-title="Viego" data-id="164">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="164" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Viego.png" data-toggle="tooltip" title="Viego" alt="Viego">
                                          </li>
                                          <li class="mostrar " data-title="Viktor" data-id="129">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="129" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Viktor.png" data-toggle="tooltip" title="Viktor" alt="Viktor">
                                          </li>
                                          <li class="mostrar " data-title="Vladimir" data-id="130">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="130" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Vladimir.png" data-toggle="tooltip" title="Vladimir" alt="Vladimir">
                                          </li>
                                          <li class="mostrar " data-title="Volibear" data-id="161">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="161" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Volibear.png" data-toggle="tooltip" title="Volibear" alt="Volibear">
                                          </li>
                                          <li class="mostrar " data-title="Warwick" data-id="132">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="132" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Warwick.png" data-toggle="tooltip" title="Warwick" alt="Warwick">
                                          </li>
                                          <li class="mostrar " data-title="Wukong" data-id="73">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="73" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/MonkeyKing.png" data-toggle="tooltip" title="Wukong" alt="Wukong">
                                          </li>
                                          <li class="mostrar " data-title="Xayah" data-id="133">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="133" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Xayah.png" data-toggle="tooltip" title="Xayah" alt="Xayah">
                                          </li>
                                          <li class="mostrar " data-title="Xerath" data-id="134">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="134" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Xerath.png" data-toggle="tooltip" title="Xerath" alt="Xerath">
                                          </li>
                                          <li class="mostrar " data-title="Xin Zhao" data-id="135">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="135" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/XinZhao.png" data-toggle="tooltip" title="Xin Zhao" alt="Xin Zhao">
                                          </li>
                                          <li class="mostrar " data-title="Yasuo" data-id="136">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="136" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Yasuo.png" data-toggle="tooltip" title="Yasuo" alt="Yasuo">
                                          </li>
                                          <li class="mostrar " data-title="Yone" data-id="155">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="155" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Yone.png" data-toggle="tooltip" title="Yone" alt="Yone">
                                          </li>
                                          <li class="mostrar " data-title="Yorick" data-id="137">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="137" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Yorick.png" data-toggle="tooltip" title="Yorick" alt="Yorick">
                                          </li>
                                          <li class="mostrar " data-title="Yuumi" data-id="138">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="138" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Yuumi.png" data-toggle="tooltip" title="Yuumi" alt="Yuumi">
                                          </li>
                                          <li class="mostrar " data-title="Zac" data-id="139">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="139" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zac.png" data-toggle="tooltip" title="Zac" alt="Zac">
                                          </li>
                                          <li class="mostrar " data-title="Zed" data-id="140">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="140" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zed.png" data-toggle="tooltip" title="Zed" alt="Zed">
                                          </li>
                                          <li class="mostrar " data-title="Ziggs" data-id="141">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="141" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ziggs.png" data-toggle="tooltip" title="Ziggs" alt="Ziggs">
                                          </li>
                                          <li class="mostrar " data-title="Zilean" data-id="142">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="142" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zilean.png" data-toggle="tooltip" title="Zilean" alt="Zilean">
                                          </li>
                                          <li class="mostrar " data-title="Zoe" data-id="143">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="143" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zoe.png" data-toggle="tooltip" title="Zoe" alt="Zoe">
                                          </li>
                                          <li class="mostrar " data-title="Zyra" data-id="144">
                                             <input type="checkbox" style="display:none;" class="checkboxCampeoes" name="campeoes[]" value="144" />
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zyra.png" data-toggle="tooltip" title="Zyra" alt="Zyra">
                                          </li>
                                       </ul>
                                    </div>
                                    <label class="checkbox-inline" for="maestria">
                                    <input type="checkbox" id="maestria" name="maestria" value="1" class="extras" data-porcentagem="0"> Maestria (+ R$)
                                    </label>
                                    <p>
                                       <small>Desejo que seja ganho os níveis de maestria com meus campeões</small>
                                    </p>
                                    <?php if(isset($_SESSION["PARAMSCamMaes"])){echo '<small><p style="color: red;">'.$_SESSION["PARAMSCamMaes"].'</p></small>'; unset($_SESSION["PARAMSCamMaes"]); } ?>
                                    <div id="box_maestria" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 5px;">
                                          Com essa opção, você escolhe com quais campeões e o nível de maestria que será feito durante o serviço. Caso chegue ao fim do serviço e a maestria não tenha sido finalizada, a maestria será feita em normal game (não ranqueado).
                                       </p>
                                       <div class="form-group col-sm-5" style="margin-bottom:10px;">
                                          <label for="campeao">Campeão</label>
                                          <select name="maestria_campeao" id="maestria_campeao" class="form-control select2">
                                             <option value="">Selecione</option>
                                             <option value="1" data-nome="Aatrox" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Aatrox.png">Aatrox</option>
                                             <option value="2" data-nome="Ahri" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ahri.png">Ahri</option>
                                             <option value="3" data-nome="Akali" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Akali.png">Akali</option>
                                             <option value="4" data-nome="Alistar" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Alistar.png">Alistar</option>
                                             <option value="5" data-nome="Amumu" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Amumu.png">Amumu</option>
                                             <option value="6" data-nome="Anivia" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Anivia.png">Anivia</option>
                                             <option value="7" data-nome="Annie" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Annie.png">Annie</option>
                                             <option value="150" data-nome="Aphelios" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Aphelios.png">Aphelios</option>
                                             <option value="8" data-nome="Ashe" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ashe.png">Ashe</option>
                                             <option value="9" data-nome="Aurelion Sol" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/AurelionSol.png">Aurelion Sol</option>
                                             <option value="10" data-nome="Azir" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Azir.png">Azir</option>
                                             <option value="11" data-nome="Bardo" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Bard.png">Bardo</option>
                                             <option value="12" data-nome="Blitzcrank" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Blitzcrank.png">Blitzcrank</option>
                                             <option value="13" data-nome="Brand" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Brand.png">Brand</option>
                                             <option value="14" data-nome="Braum" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Braum.png">Braum</option>
                                             <option value="15" data-nome="Caitlyn" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Caitlyn.png">Caitlyn</option>
                                             <option value="16" data-nome="Camille" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Camille.png">Camille</option>
                                             <option value="17" data-nome="Cassiopeia" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Cassiopeia.png">Cassiopeia</option>
                                             <option value="18" data-nome="Cho'Gath" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Chogath.png">Cho'Gath</option>
                                             <option value="19" data-nome="Corki" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Corki.png">Corki</option>
                                             <option value="20" data-nome="Darius" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Darius.png">Darius</option>
                                             <option value="21" data-nome="Diana" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Diana.png">Diana</option>
                                             <option value="23" data-nome="Dr. Mundo" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/DrMundo.png">Dr. Mundo</option>
                                             <option value="22" data-nome="Draven" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Draven.png">Draven</option>
                                             <option value="24" data-nome="Ekko" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ekko.png">Ekko</option>
                                             <option value="25" data-nome="Elise" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Elise.png">Elise</option>
                                             <option value="26" data-nome="Evelynn" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Evelynn.png">Evelynn</option>
                                             <option value="27" data-nome="Ezreal" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ezreal.png">Ezreal</option>
                                             <option value="28" data-nome="Fiddlesticks" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Fiddlesticks.png">Fiddlesticks</option>
                                             <option value="29" data-nome="Fiora" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Fiora.png">Fiora</option>
                                             <option value="30" data-nome="Fizz" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Fizz.png">Fizz</option>
                                             <option value="31" data-nome="Galio" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Galio.png">Galio</option>
                                             <option value="32" data-nome="Gangplank" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Gangplank.png">Gangplank</option>
                                             <option value="33" data-nome="Garen" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Garen.png">Garen</option>
                                             <option value="34" data-nome="Gnar" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Gnar.png">Gnar</option>
                                             <option value="35" data-nome="Gragas" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Gragas.png">Gragas</option>
                                             <option value="36" data-nome="Graves" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Graves.png">Graves</option>
                                             <option value="165" data-nome="Gwen" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Gwen.png">Gwen</option>
                                             <option value="37" data-nome="Hecarim" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Hecarim.png">Hecarim</option>
                                             <option value="38" data-nome="Heimerdinger" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Heimerdinger.png">Heimerdinger</option>
                                             <option value="39" data-nome="Illaoi" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Illaoi.png">Illaoi</option>
                                             <option value="40" data-nome="Irelia" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Irelia.png">Irelia</option>
                                             <option value="41" data-nome="Ivern" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ivern.png">Ivern</option>
                                             <option value="42" data-nome="Janna" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Janna.png">Janna</option>
                                             <option value="43" data-nome="Jarvan IV" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/JarvanIV.png">Jarvan IV</option>
                                             <option value="44" data-nome="Jax" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Jax.png">Jax</option>
                                             <option value="45" data-nome="Jayce" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Jayce.png">Jayce</option>
                                             <option value="46" data-nome="Jhin" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Jhin.png">Jhin</option>
                                             <option value="47" data-nome="Jinx" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Jinx.png">Jinx</option>
                                             <option value="48" data-nome="Kai'Sa" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kaisa.png">Kai'Sa</option>
                                             <option value="49" data-nome="Kalista" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kalista.png">Kalista</option>
                                             <option value="50" data-nome="Karma" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Karma.png">Karma</option>
                                             <option value="51" data-nome="Karthus" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Karthus.png">Karthus</option>
                                             <option value="52" data-nome="Kassadin" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kassadin.png">Kassadin</option>
                                             <option value="53" data-nome="Katarina" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Katarina.png">Katarina</option>
                                             <option value="54" data-nome="Kayle" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kayle.png">Kayle</option>
                                             <option value="55" data-nome="Kayn" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kayn.png">Kayn</option>
                                             <option value="56" data-nome="Kennen" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kennen.png">Kennen</option>
                                             <option value="57" data-nome="Kha'Zix" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Khazix.png">Kha'Zix</option>
                                             <option value="58" data-nome="Kindred" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kindred.png">Kindred</option>
                                             <option value="59" data-nome="Kled" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Kled.png">Kled</option>
                                             <option value="60" data-nome="Kog'Maw" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/KogMaw.png">Kog'Maw</option>
                                             <option value="61" data-nome="LeBlanc" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Leblanc.png">LeBlanc</option>
                                             <option value="62" data-nome="Lee Sin" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/LeeSin.png">Lee Sin</option>
                                             <option value="63" data-nome="Leona" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Leona.png">Leona</option>
                                             <option value="154" data-nome="Lillia" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lillia.png">Lillia</option>
                                             <option value="64" data-nome="Lissandra" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lissandra.png">Lissandra</option>
                                             <option value="65" data-nome="Lucian" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lucian.png">Lucian</option>
                                             <option value="66" data-nome="Lulu" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lulu.png">Lulu</option>
                                             <option value="67" data-nome="Lux" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Lux.png">Lux</option>
                                             <option value="68" data-nome="Malphite" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Malphite.png">Malphite</option>
                                             <option value="69" data-nome="Malzahar" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Malzahar.png">Malzahar</option>
                                             <option value="70" data-nome="Maokai" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Maokai.png">Maokai</option>
                                             <option value="71" data-nome="Master Yi" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/MasterYi.png">Master Yi</option>
                                             <option value="72" data-nome="Miss Fortune" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/MissFortune.png">Miss Fortune</option>
                                             <option value="160" data-nome="Mordekaiser" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Mordekaiser1.png">Mordekaiser</option>
                                             <option value="75" data-nome="Morgana" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Morgana.png">Morgana</option>
                                             <option value="76" data-nome="Nami" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nami.png">Nami</option>
                                             <option value="77" data-nome="Nasus" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nasus.png">Nasus</option>
                                             <option value="78" data-nome="Nautilus" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nautilus.png">Nautilus</option>
                                             <option value="79" data-nome="Neeko" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Neeko.png">Neeko</option>
                                             <option value="80" data-nome="Nidalee" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nidalee.png">Nidalee</option>
                                             <option value="81" data-nome="Nocturne" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nocturne.png">Nocturne</option>
                                             <option value="82" data-nome="Nunu e Willump" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Nunu.png">Nunu e Willump</option>
                                             <option value="83" data-nome="Olaf" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Olaf.png">Olaf</option>
                                             <option value="84" data-nome="Orianna" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Orianna.png">Orianna</option>
                                             <option value="85" data-nome="Ornn" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ornn.png">Ornn</option>
                                             <option value="86" data-nome="Pantheon" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Pantheon.png">Pantheon</option>
                                             <option value="87" data-nome="Poppy" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Poppy.png">Poppy</option>
                                             <option value="88" data-nome="Pyke" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Pyke.png">Pyke</option>
                                             <option value="153" data-nome="Qiyana" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Qiyana.png">Qiyana</option>
                                             <option value="89" data-nome="Quinn" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Quinn.png">Quinn</option>
                                             <option value="90" data-nome="Rakan" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rakan.png">Rakan</option>
                                             <option value="91" data-nome="Rammus" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rammus.png">Rammus</option>
                                             <option value="92" data-nome="Rek'Sai" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/RekSai.png">Rek'Sai</option>
                                             <option value="163" data-nome="Rell" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rell.png">Rell</option>
                                             <option value="93" data-nome="Renekton" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Renekton.png">Renekton</option>
                                             <option value="94" data-nome="Rengar" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rengar.png">Rengar</option>
                                             <option value="95" data-nome="Riven" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Riven.png">Riven</option>
                                             <option value="96" data-nome="Rumble" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Rumble.png">Rumble</option>
                                             <option value="97" data-nome="Ryze" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ryze.png">Ryze</option>
                                             <option value="156" data-nome="Samira" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Samira.png">Samira</option>
                                             <option value="98" data-nome="Sejuani" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sejuani.png">Sejuani</option>
                                             <option value="152" data-nome="Senna" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Senna.png">Senna</option>
                                             <option value="162" data-nome="Seraphine" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Seraphine.png">Seraphine</option>
                                             <option value="151" data-nome="Sett" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sett.png">Sett</option>
                                             <option value="99" data-nome="Shaco" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Shaco.png">Shaco</option>
                                             <option value="100" data-nome="Shen" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Shen.png">Shen</option>
                                             <option value="101" data-nome="Shyvana" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Shyvana.png">Shyvana</option>
                                             <option value="102" data-nome="Singed" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Singed.png">Singed</option>
                                             <option value="103" data-nome="Sion" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sion.png">Sion</option>
                                             <option value="104" data-nome="Sivir" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sivir.png">Sivir</option>
                                             <option value="105" data-nome="Skarner" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Skarner.png">Skarner</option>
                                             <option value="106" data-nome="Sona" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sona.png">Sona</option>
                                             <option value="107" data-nome="Soraka" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Soraka.png">Soraka</option>
                                             <option value="108" data-nome="Swain" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Swain.png">Swain</option>
                                             <option value="109" data-nome="Sylas" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Sylas.png">Sylas</option>
                                             <option value="110" data-nome="Syndra" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Syndra.png">Syndra</option>
                                             <option value="111" data-nome="Tahm Kench" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/TahmKench.png">Tahm Kench</option>
                                             <option value="112" data-nome="Taliyah" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Taliyah.png">Taliyah</option>
                                             <option value="113" data-nome="Talon" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Talon.png">Talon</option>
                                             <option value="114" data-nome="Taric" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Taric.png">Taric</option>
                                             <option value="115" data-nome="Teemo" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Teemo.png">Teemo</option>
                                             <option value="116" data-nome="Thresh" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Thresh.png">Thresh</option>
                                             <option value="117" data-nome="Tristana" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Tristana.png">Tristana</option>
                                             <option value="118" data-nome="Trundle" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Trundle.png">Trundle</option>
                                             <option value="119" data-nome="Tryndamere" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Tryndamere.png">Tryndamere</option>
                                             <option value="120" data-nome="Twisted Fate" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/TwistedFate.png">Twisted Fate</option>
                                             <option value="121" data-nome="Twitch" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Twitch.png">Twitch</option>
                                             <option value="122" data-nome="Udyr" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Udyr.png">Udyr</option>
                                             <option value="123" data-nome="Urgot" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Urgot.png">Urgot</option>
                                             <option value="124" data-nome="Varus" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Varus.png">Varus</option>
                                             <option value="125" data-nome="Vayne" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Vayne.png">Vayne</option>
                                             <option value="126" data-nome="Veigar" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Veigar.png">Veigar</option>
                                             <option value="127" data-nome="Vel'Koz" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Velkoz.png">Vel'Koz</option>
                                             <option value="128" data-nome="Vi" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Vi.png">Vi</option>
                                             <option value="164" data-nome="Viego" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Viego.png">Viego</option>
                                             <option value="129" data-nome="Viktor" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Viktor.png">Viktor</option>
                                             <option value="130" data-nome="Vladimir" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Vladimir.png">Vladimir</option>
                                             <option value="161" data-nome="Volibear" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Volibear.png">Volibear</option>
                                             <option value="132" data-nome="Warwick" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Warwick.png">Warwick</option>
                                             <option value="73" data-nome="Wukong" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/MonkeyKing.png">Wukong</option>
                                             <option value="133" data-nome="Xayah" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Xayah.png">Xayah</option>
                                             <option value="134" data-nome="Xerath" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Xerath.png">Xerath</option>
                                             <option value="135" data-nome="Xin Zhao" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/XinZhao.png">Xin Zhao</option>
                                             <option value="136" data-nome="Yasuo" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Yasuo.png">Yasuo</option>
                                             <option value="155" data-nome="Yone" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Yone.png">Yone</option>
                                             <option value="137" data-nome="Yorick" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Yorick.png">Yorick</option>
                                             <option value="138" data-nome="Yuumi" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Yuumi.png">Yuumi</option>
                                             <option value="139" data-nome="Zac" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zac.png">Zac</option>
                                             <option value="140" data-nome="Zed" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zed.png">Zed</option>
                                             <option value="141" data-nome="Ziggs" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Ziggs.png">Ziggs</option>
                                             <option value="142" data-nome="Zilean" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zilean.png">Zilean</option>
                                             <option value="143" data-nome="Zoe" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zoe.png">Zoe</option>
                                             <option value="144" data-nome="Zyra" data-avatar="https://elojobhigh.com.br/app/assets/imagens/campeoes/Zyra.png">Zyra</option>
                                          </select>
                                       </div>
                                       <div class="form-group col-sm-5" style="margin-bottom:10px;">
                                          <label for="maestria">Maestria</label>
                                          <select name="maestria_maestria" id="maestria_maestria" class="form-control select2">
                                             <option value="">Selecione</option>
                                             <option value="m1" data-nome="M0 até M1" data-preco="10.00">M0 até M1 - R$ 10,00</option>
                                             <option value="m2" data-nome="M1 até M2" data-preco="10.00">M1 até M2 - R$ 10,00</option>
                                             <option value="m3" data-nome="M2 até M3" data-preco="15.00">M2 até M3 - R$ 15,00</option>
                                             <option value="m4" data-nome="M3 até M4" data-preco="20.00">M3 até M4 - R$ 20,00</option>
                                             <option value="m5" data-nome="M4 até M5" data-preco="35.00">M4 até M5 - R$ 35,00</option>
                                             <option value="m6" data-nome="M5 até M6" data-preco="20.00">M5 até M6 - R$ 20,00</option>
                                             <option value="m7" data-nome="M6 até M7" data-preco="30.00">M6 até M7 - R$ 30,00</option>
                                          </select>
                                       </div>
                                       <div class="form-group col-sm-2" style="margin-bottom:10px;">
                                          <p style="margin:0; margin-top: 1px;">&nbsp;</p>
                                          <a href="javascript:void();" id="add-maestria" data-toggle="tooltip" title="Adicionar" class="form-control btn btn-success"><i class="fa fa-plus"></i></a>
                                       </div>
                                       <table>
                                          <thead>
                                             <tr>
                                                <th>Camepão</th>
                                                <th>Maestria</th>
                                                <th>R$</th>
                                                <th>Ações</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr class="bg-primary" data-preco="0">
                                                <td colspan="100%">
                                                   <p style="margin:10px 2px;">Nenhum registro encontrado.</p>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                    <label class="checkbox-inline" for="horariosrestritos">
                                    <input type="checkbox" id="horariosrestritos" name="horariosrestritos" value="1" class="extras" data-porcentagem="30"> Horários Restritos (+ 30%) </label>
                                    <p>
                                       <small>Desejo determinar horários específicos a execução do serviço</small>
                                    </p>
                                    <?php if(isset($_SESSION["PARAMSHorario"])){echo '<small><small style="color: red;">'.$_SESSION["PARAMSHorario"].'<p></p></small></small>'; unset($_SESSION["PARAMSHorario"]); } ?>
                                    <div id="box_horariosrestritos" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0;">Com esta opção, você define os horários para realizar o Boosting.</p>
                                       <p style="margin: 0 0 5px 0;"><strong>Atenção:</strong> Quanto mais restringir o horário, mais demorado será a conclusão do serviço, sendo assim, o prazo de entrega não irá se aplicar com esta opção ativada.</p>
                                       <textarea name="horarios" rows="3" class="form-control" placeholder="Digite aqui, de forma clara, os horários em que será permitido a utilização da conta."></textarea>
                                    </div>
                                    <label class="checkbox-inline" for="streamonline">
                                    <input type="checkbox" id="streamonline" name="streamonline" value="1" class="extras" data-porcentagem="20"> Stream Online (+ 20%) </label>
                                    <p>
                                       <small>Desejo assistir Stream durante execução do serviço</small>
                                    </p>
                                    <div id="box_streamonline" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0;">Com esta opção, o jogador irá abrir uma Stream para o cliente acompanhar o serviço em 1ª pessoa, em horários pré-estabelecidos. Além disso, esse serviço exclusivo oferece dicas e macetes durante a Stream.</p>
                                    </div>
                                    <label class="checkbox-inline" for="reducaokda">
                                    <input type="checkbox" id="reducaokda" name="reducaokda" value="1" class="extras" data-porcentagem="35"> Redução do KDA (+ 35%) </label>
                                    <p>
                                       <small>Desejo reduzir meu KDA durante o serviço</small>
                                    </p>
                                    <div id="box_reducaokda" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0;">Com esta opção, iremos reduzir propositalmente o KDA durante as partidas, quando possível. Pelo fato de nossos jogadores serem High-Elo, KDA's altos são comuns, então iremos mascarar o EloBoost para a conta diminuindo esse KDA , ficando por exemplo, 8/2/4. Assim, o serviço torna-se discreto e difícil a identificação de EloBoost, sem levantar suspeitas para seus amigos. <strong>(Extra disponível até o Diamante IV)</strong></p>
                                    </div>
                                    <label class="checkbox-inline" for="reducaoprazo">
                                    <input type="checkbox" id="reducaoprazo" name="reducaoprazo" value="1" class="extras" data-porcentagem="30"> Redução do Prazo (+ 30%) </label>
                                    <p>
                                       <small>Desejo reduzir meu prazo de entrega</small>
                                    </p>
                                    <div id="box_reducaoprazo" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0;">Com esta opção, iremos reduzir o prazo de entrega em até 50%, exemplo: se o seu prazo de entrega estiver marcando 6 dias, com essa opção iremos reduzir ele para 3 dias. Isso só é possível pelo fato de nossos jogadores serem High-Elo.</p>
                                    </div>
                                    <label class="checkbox-inline" for="servicosolo">
                                    <input type="checkbox" id="servicosolo" name="servicosolo" value="1" class="extras" data-porcentagem="30"> Serviço Solo (+ 30%) </label>
                                    <p>
                                       <small>Desejo que as partidas sejam jogadas solo</small>
                                    </p>
                                    <div id="box_servicosolo" class="themed-background text-light display-none" style="padding: 10px;">
                                       <p style="margin: 0;">Com esta opção, nossos jogadores irão jogar solo durante o boosting e não duo com outro booster. Com este extra ativado, não há possibilidade da redução no prazo de entrega)</p>
                                    </div>
                                    <?php if(isset($_SESSION["PARAMSSoloReduce"])){echo '<p style="color: red;">'.$_SESSION["PARAMSSoloReduce"].'</p>'; unset($_SESSION["PARAMSSoloReduce"]);} ?>
                                 </div>
                              </div>
                              <div class="col-md-4 col-md-offset-8 text-right">
                                 <div class="form-group">
                                    <label for="cupom">Cupom de Desconto</label>
                                    <input type="text" name="cupom" value="" id="cupom" class="form-control" placeholder="Informe o seu cupom de desconto!">
                                    <a href="javascript:void(0);" onclick="if (!window.__cfRLUnblockHandlers) return false; aplicarCupom();" id="aplicarcupom" class="btn btn-default" data-cf-modified-d0e84d083d5609b84b74a572-="">Aplicar</a>
                                    <a href="javascript:void(0);" onclick="if (!window.__cfRLUnblockHandlers) return false; removerCupom();" id="removercupom" class="btn btn-default hide" data-cf-modified-d0e84d083d5609b84b74a572-="">Remover</a>
                                    <div id="resultadodesconto"><?php if(isset($_SESSION["PARAMSCupom"])){ echo '<p class="text-danger">Cupom invalido 😭</p>'; unset($_SESSION["PARAMSCupom"]);}?></div>
                                 </div>
                              </div>
                              <div class="col-md-12 text-right" style="margin: 20px 0;">
                                 <div>
                                 <?php
                                    echo '<p style="margin: 0;"><strong>Subtotal</strong></p>
                                    <h4 style="margin: 0; text-decoration: line-through;" id="subtotal" class="hide" data-total="'.$Resultados["Value"].'">R$ '.$Resultados["Value"].'</h4>
                                    <h1 style="margin: 0;" id="subtotaldesconto" data-total="'.$Resultados["Value"].'">R$ '.$Resultados["Value"].'</h1>';
                                    ?>
                                 </div>
                              </div>
                              <div class="form-group form-actions text-right">
                                 <div class="col-md-12">
                                    <button type="submit" name="submit" value="1" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Comprar</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <footer class="clearfix">
                     <div class="pull-left">
                         <div class="copyright">l<?php echo copyright; ?></div>
                     </div>
                     <div class="pull-right">
                      Desenvolvido por <a href="#" target="_blank">CastroMS</a>.
                     </div>
                  </footer>
               </div>
            </div>
         </div>
         <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
         <div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header text-center">
                     <h3 class="modal-title"><i class="fa fa-pencil"></i> Definições</h3>
                  </div>
                  <div class="modal-body">
                     <form action="javascript:void(0);" method="post" id="formDefinicoes" class="form-horizontal form-bordered">
                        <fieldset>
                        <?php include 'EloJobx/Components/Form-Definicoes.php'; ?>
                        </fieldset>
                        <fieldset>
                           <legend>Atualização de Senha</legend>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="senha">Nova senha</label>
                              <div class="col-md-8">
                                 <input type="password" name="senha" id="senha" class="form-control" placeholder="Por favor, escolha uma senha complexa..">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="confirmasenha">Confirme a nova senha</label>
                              <div class="col-md-8">
                                 <input type="password" name="confirmasenha" id="confirmasenha" class="form-control" placeholder="... e confirme aqui!">
                              </div>
                           </div>
                        </fieldset>
                        <div class="form-group form-actions">
                           <div id="retornoDefinicoes" class="text-center"></div>
                           <div class="col-xs-12 text-right">
                              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
                              <button type="submit" class="btn btn-sm btn-primary">Salvar Alterações</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div id="modal-user-discord" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header text-center">
                     <h3 class="modal-title"><i class="fa fa-pencil"></i> Discord</h3>
                  </div>
                  <div class="modal-body">
                     <form action="javascript:void(0);" method="post" id="formDiscord" class="form-horizontal form-bordered">
                        <fieldset>
                           <legend>Informações</legend>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Discord</label>
                              <div class="col-md-8">
                                 <p class="form-control-static">
                                    <a href="javascript:void(0);" id="sair-cliente-discord" class="btn btn-xs btn-danger">
                                    <i class="fa fa-close"></i> Sair
                                    </a>
                                 </p>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <legend>Geral - Notificações</legend>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="alertabooster">Alerta do Booster</label>
                              <div class="col-md-8">
                                 <label class="switch switch-primary">
                                 <input type="checkbox" name="alertabooster" id="alertabooster" value="1">
                                 <span></span>
                                 </label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="statusservico">Status do Serviço</label>
                              <div class="col-md-8">
                                 <label class="switch switch-primary">
                                 <input type="checkbox" name="statusservico" id="statusservico" value="1">
                                 <span></span>
                                 </label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="mensagensservico">Mensagens do Serviço</label>
                              <div class="col-md-8">
                                 <label class="switch switch-primary">
                                 <input type="checkbox" name="mensagensservico" id="mensagensservico" value="1">
                                 <span></span>
                                 </label>
                              </div>
                           </div>
                        </fieldset>
                        <div class="form-group form-actions">
                           <div id="retornoDiscord" class="text-center"></div>
                           <div class="col-xs-12 text-right">
                              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
                              <button type="submit" class="btn btn-sm btn-primary">Salvar Alterações</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="d0e84d083d5609b84b74a572-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/vendor/bootstrap.min.js" type="d0e84d083d5609b84b74a572-text/javascript"></script>
         <script src="/Template/js/user/plugins.js" type="d0e84d083d5609b84b74a572-text/javascript"></script>
         <script src="/Template/js/user/maskedinput.js" type="d0e84d083d5609b84b74a572-text/javascript"></script>
         <script src="/Template/js/dinheiro.js" type="d0e84d083d5609b84b74a572-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/vex/js/vex.combined.min.js" type="d0e84d083d5609b84b74a572-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/select2/js/i18n/pt-BR.js" type="d0e84d083d5609b84b74a572-text/javascript"></script>
         <script type="d0e84d083d5609b84b74a572-text/javascript">
            var base_url = 'http://localhost:81/';
            var descontoTipo = 0;
            var descontoValor = 0;
            vex.defaultOptions.className = 'vex-theme-os';
            vex.dialog.buttons.YES.text = 'OK';
            vex.dialog.buttons.NO.text = 'CANCELAR';
            
            		
            function aplicarCupom() {
            	descontoTipo = 0;
            	descontoValor = 0;
            	$('#subtotal').addClass('hide');
            	calculaSubTotal();
            	$('#resultadodesconto').html('');
            	
            	$.ajax({
            		url: '/api/use-cupom',
            		type: 'POST',
            		dataType: 'json',
            		data: 'cupom=' + $('#cupom').val(),
            		beforeSend: function() {
            			$('#resultadodesconto').html('<p class="text-info">carregando...</p>');
            		},
            		success: function(data) {
            			if(data.status) {
            				if(data.type == 0) {
            					$('#resultadodesconto').html('<p class="text-success">O seu cupom de ' + data.desconto + '% foi aplicado com sucesso.</p>');
            					descontoTipo = 1;
            					descontoValor = data.desconto;
            				} else {
            					$('#resultadodesconto').html('<p class="text-success">O seu cupom de R$ ' + formatMoneyBR(data.desconto) + ' foi aplicado com sucesso.</p>');
            					descontoTipo = 0;
            					descontoValor = data.desconto;
            				}
            				
            				$('#subtotal').removeClass('hide');
            				
            				calculaSubTotal();
            				
            				$('#cupom').attr('readonly', true);
            				$('#aplicarcupom').addClass('hide');
            				$('#removercupom').removeClass('hide');
            			} else {
            				$('#resultadodesconto').html('<p class="text-danger">' + data.mensagem + '</p>');
            			}
            		}
            	});
            }
            
            function removerCupom() {
            	descontoTipo = 0;
            	descontoValor = 0;
            	$('#subtotal').addClass('hide');
            	calculaSubTotal();
            	$('#resultadodesconto').html('');
            	$('#cupom').val('').attr('readonly', false);
            	$('#removercupom').addClass('hide');
            	$('#aplicarcupom').removeClass('hide');
            }
            
            function calculaSubTotal() {
            	var porcentagemTotal = 0;
            	var dinheiroTotal = 0;
            	$('.extras').each(function(index, data) {
            		if($(this).prop('checked')) {
            			var porcentagem = $(this).data('porcentagem');
            			porcentagemTotal += porcentagem;
            			
            			if($(this).attr('name') == "maestria") {
            				$('#box_maestria table tbody tr').each(function(index_maestria, data_maestria) {
            					dinheiroTotal += parseFloat($(this).data('preco'));
            				});
            			}
            		}
            		if(index == $('.extras').length - 1) {
            			var totalPorcentagem = parseFloat(total * (porcentagemTotal/100));
            			var totalAtualizado = (total + (totalPorcentagem + dinheiroTotal));
            			
            			if(descontoTipo == '0') {
            				var totalDesconto = descontoValor;
            			} else {
            				var totalDesconto = parseFloat(totalAtualizado * (descontoValor/100));
            			}
            			
            			var totalDescontoAtualizado = (totalAtualizado - totalDesconto);
            			
            			$('#subtotal').html('R$ ' + formatMoneyBR(totalAtualizado));
            			$('#subtotaldesconto').html('R$ ' + formatMoneyBR(totalDescontoAtualizado));
            		}
            	});
            	
            	if($('.extras').length == 0) {
            		if(descontoTipo == '0') {
            			var totalDesconto = descontoValor;
            		} else {
            			var totalDesconto = parseFloat(total * (descontoValor/100));
            		}
            		
            		var totalDescontoAtualizado = (total - totalDesconto);
            		$('#subtotaldesconto').html('R$ ' + formatMoneyBR(totalDescontoAtualizado));
            	}
            }
            
            function filtrarCampeoes() {
            	var input = $("#pesquisar");
            	var string = input.val().toLowerCase().trim();
            	$("#box_campeoesespecificos ul li").each(function(){
            		var championName = $(this).attr("data-title").toLowerCase().trim();
            		if (championName.indexOf(string) >= 0){
            			if(!$(this).hasClass("mostrar")) $(this).addClass("mostrar");
            		} else {
            			$(this).removeClass("mostrar");
            		}
            	});
            }
            
            $(function() {
            	$(".phone").mask("(99) 99999-9999");
            	
            	$('.select2').select2({
            		language: 'pt-BR',
            		theme: 'bootstrap',
            		width: '100%'
            	});
            	
            	calculaSubTotal();
            	
            	$('#escolhaconta').change(function() {
            		if($(this).val() == 'adicionarconta') {
            			$('#box_contaexistente').hide();
            			$('#box_adicionarconta').show();
            		} else {
            			$('#box_adicionarconta').hide();
            			$('#box_contaexistente').show();
            		}
            	});
            	
            	$('#modocoach').change(function() {
            		if($(this).val() == 'teamfighttactics') {
            			$('#box_rota').hide();
            		} else {
            			$('#box_rota').show();
            		}
            	});
            	
            	$("#box_campeoesespecificos #pesquisar").on("input", function(){
            		filtrarCampeoes();
            	});
            	
            	$("#box_campeoesespecificos ul").on("click", "li", function(){
            		var championCheckbox = $(this).find("input[type=checkbox]");
            		if($(this).hasClass('selecionado')) {
            			$(this).removeClass("selecionado");
            			championCheckbox.attr('checked', false);
            		} else {
            			$(this).addClass("selecionado");
            			championCheckbox.attr('checked', true);
            		}
            	});
            	
            	var maestria_fila = "0";
            	$("#add-maestria").click(function() {
            		var campeao_id = $("#maestria_campeao option:selected").val(), 
            		campeao_nome = $("#maestria_campeao option:selected").data('nome'),
            		campeao_avatar = $("#maestria_campeao option:selected").data('avatar');
            		
            		var maestria_id = $("#maestria_maestria option:selected").val(),
            		maestria_nome = $("#maestria_maestria option:selected").data('nome'),
            		maestria_preco = $("#maestria_maestria option:selected").data('preco')
            		
            		if(campeao_id == '') {
            			vex.dialog.alert({
            				unsafeMessage: 'Selecione um campeão para adicionar a maestria.'
            			});
            		} else if(maestria_id == '') {
            			vex.dialog.alert({
            				unsafeMessage: 'Selecione uma maestria para adicionar ao campeão.'
            			});
            		} else if($("#box_maestria table tbody tr[data-campeao='" + campeao_id + "'][data-maestria='" + maestria_id + "']").html() != undefined) {
            			vex.dialog.alert({
            				unsafeMessage: 'Você já adicionou essa maestria para esse campeão.'
            			});
            		} else {
            			var html = '<tr class="bg-primary" data-campeao="' + campeao_id + '" data-maestria="' + maestria_id + '" data-preco="' + maestria_preco + '">' +
            			'	<td>' +
            			'		<img src="' + campeao_avatar + '" alt="' + campeao_nome + '"> ' + campeao_nome +
            			'	</td>' +
            			'	<td>' + maestria_nome + '</td>' +
            			'	<td>' + formatMoneyBR(maestria_preco) + '</td>' +
            			'	<td>' +
            			'		<div class="btn-group btn-group-xs">' +
            			'			<input type="hidden" name="maestrias[]" value="' + campeao_id + '/' + maestria_id + '">' +
            			'			<a href="javascript:void();" data-toggle="tooltip" title="Remover" class="btn btn-danger remove-maestria"><i class="fa fa-trash"></i></a></a>' +
            			'		</div>' +
            			'	</td>' +
            			'</tr>';
            			
            			if(maestria_fila == 0) {
            				$("#box_maestria table tbody tr").fadeOut('slow', function() {
            					$(this).remove();
            				});
            			}
            			
            			$("#box_maestria table tbody").append($(html).hide().fadeIn('slow'));
            			$(".remove-maestria").tooltip();
            			
            			calculaSubTotal();
            			
            			maestria_fila++;
            		}
            	});
            	
            	$('#box_maestria table tbody').on('click', '.remove-maestria', function() {
            		var campeao_id = $(this).parent().parent().parent().data('campeao'),
            		maestria_id = $(this).parent().parent().parent().data('maestria');
            		
            		if($("#box_maestria table tbody tr[data-campeao='" + campeao_id + "'][data-maestria='" + maestria_id + "']").html() != undefined) {
            			$(this).parent().parent().parent().data('campeao', 0);
            			$(this).parent().parent().parent().data('maestria', 0);
            			
            			$(this).parent().parent().parent().fadeOut('slow', function() {
            				$(this).remove();
            				calculaSubTotal();
            			});
            			
            			if(maestria_fila == 1) {
            				var html = '<tr class="bg-primary" data-preco="0">' +
            				'	<td colspan="100%">' +
            				'		<p style="margin:10px 2px;">Nenhum registro encontrado.</p>' +
            				'	</td>' +
            				'</tr>';
            				$("#box_maestria table tbody").append($(html).hide().fadeIn('slow'));
            			}
            			
            			if(maestria_fila > 0) {
            				maestria_fila--;
            			}
            		}
            	});
            	
            	$('.extras').click(function() {
            		var idBox = '#box_' + $(this).attr('id');
            		
            		if($(this).attr('id') == 'superrestricao') {
            			if($(this).prop('checked')) {
            				$('#aviso10campeoes').hide();
            			} else {
            				$('#aviso10campeoes').show();
            			}
            		}
            		
            		if($(this).attr('id') == 'maestria' && !$('#campeoesespecificos').is(':checked')) {
            			vex.dialog.alert({
            				unsafeMessage: 'Para ativar o extra de maestria é obrigatório a ativação do extra campeões específicos.'
            			});
            			return false;
            		} else if($(this).attr('id') == 'campeoesespecificos' && $('#maestria').is(':checked')) {
            			if(!$(this).prop('checked')) {
            				$("#maestria").prop('checked', false);
            				$("#box_maestria").hide();
            			}
            		}
            		
            		if ($(idBox).length) {
            			if($(this).prop('checked')) {
            				$(idBox).show();
            			} else {
            				$(idBox).hide();
            			}
            		}
            		calculaSubTotal();
            	});
            });
         </script>
         <script src="/Template/js/profile/app.js" type="d0e84d083d5609b84b74a572-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="d0e84d083d5609b84b74a572-|49" defer=""></script>
      </body>
   </html>