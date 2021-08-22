<?php
   if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){
      echo 'Não encontrado';
      exit;
   }

   if(searchOrder($Server,$_SESSION["Usuario"],$_GET["id"]) == false){
      echo 'Não encontrado';
      exit;
   }

   $MatchDetails = $Server->prepareStatment("SELECT * FROM booster_match_records WHERE order_id = :id");
   $MatchDetails->execute([":id" => $_GET["id"]]);
   $MatchDetailsResult = $MatchDetails->fetch(PDO::FETCH_ASSOC);


echo '
<head>
<title>Historico</title>
<link rel="stylesheet" href="/Template/css/teste/common.css">
<link rel="stylesheet" href="/Template/css/teste/summoner.css">
</head>

<div class="GameItemList">';

if(isset($MatchDetailsResult["data"])){
$decodado2 = json_decode($MatchDetailsResult["data"]);

foreach($decodado2 as $Key){
   $class1 = $Key->result->win == false ? 'Lose': 'Win';
   $winner = $class1 == 'Win' ? 'Vitória' : 'Derrota';
   $ward = $class1 == 'Win' ? 'blue': 'red';
   $kda = ($Key->result->kills + $Key->result->assists) / $Key->result->deaths;
   $duracao = explode(":", $Key->duracao);
   echo '<div class="GameItemWrap">
   <div class="GameItem '.$class1.'" data-summoner-id="42902328" data-game-time="1620899827" data-game-id="2263065778" data-game-result="win">
       <div class="Content">
          <div class="GameStats">
             <div class="GameType" title="'.$EloTools->GameMode($Key->modo2)["description"].'">
             '.$EloTools->GameMode($Key->modo2)["description"].'
             </div>
             <div class="TimeStamp"><span class="_timeago _timeCountAssigned tip" data-datetime="1620899827" data-type="" data-interval="60" title="'.date("d/m/Y",strtotime($Key->criacao)).'7">'.$EloTools->TempoIntervalo($Key->criacao).'</span></div>
             <div class="Bar"></div>
             <div class="GameResult">
                '.$winner.'								
             </div>
             <div class="GameLength">'.$duracao[0].'m '.$duracao[1].'s</div>
          </div>
          <div class="GameSettingInfo">
             <div class="ChampionImage">
                <a  target="_blank"><img src="http://ddragon.leagueoflegends.com/cdn/11.10.1/img/champion/'.$Key->result->championName.'.png" class="Image" alt="Jayce"></a>
             </div>
             
            
             <div class="ChampionName">
                <a  target="_blank">'.$Key->result->championName.'</a>
             </div>
          </div>
          <div class="KDA">
             <div class="KDA">
                <span class="Kill">'.$Key->result->kills.'</span> /
                <span class="Death">'.$Key->result->deaths.'</span> /
                <span class="Assist">'.$Key->result->assists.'</span>
             </div>
             <div class="KDARatio">
                <span class="KDARatio ">'.substr($kda, 0, 4).':'.round($Key->result->kills / $Key->result->deaths).'</span> KDA				
             </div>
           
          </div>
          <div class="Stats">
             <div class="Level">
                Nível'.$Key->result->champLevel.'
             </div>
             <div class="CS">
                <span class="CS tip">'.$Key->result->totalMinionsKilled+$Key->result->neutralMinionsKilled.' Minions</span>
             </div>
             <div class="CKRate tip" title="Contribuição em Abates">
                '.$Key->result->lane.'
             </div>
          </div>
          <div class="Items">
             <div class="ItemList">
                <div class="Item">';
                  if($Key->result->item0 != 0){
                   echo '<img src="//opgg-static.akamaized.net/images/lol/item/'.$Key->result->item0.'.png?image=q_auto:best&amp;v=1620787344" class="Image tip" title="<b style="color: #00cfbc">Muramana</b><br><span><mainText><stats><attention>35</attention> de Dano de Ataque<br><attention>860</attention> de Mana<br><attention>15</attention> de Aceleração de Habilidade</stats><br><li><passive>Receio:</passive> recebe <scaleAD>Dano de Ataque adicional equivalente a 2.5% do Mana máximo</scaleAD>. <li><passive>Choque:</passive> Ataques contra Campeões causam <physicalDamage>Dano Físico adicional equivalente a 1.5% do Mana máximo</physicalDamage> (<OnHit>ao contato</OnHit>). Habilidades de dano contra Campeões causam <physicalDamage>(3.5% usuários de ataque corpo a corpo) | 2.7% usuários de ataque a distância) do Mana máximo + 6% do DdA total como Dano Físico</physicalDamage> adicional.</mainText><br></span><br><span>Custo:</span> <span style="color: #ffc659">3000 (3000)</span>" alt="Muramana">
                </div>';
                  }
                  if($Key->result->item1 != 0){
                  echo '<div class="Item">
                   <img src="//opgg-static.akamaized.net/images/lol/item/'.$Key->result->item1.'.png?image=q_auto:best&amp;v=1620787344" class="Image tip" title="<b style="color: #00cfbc">Serrespada Quimiopunk</b><br><span><mainText><stats><attention>45</attention> de Dano de Ataque<br><attention>250</attention> de Vida<br><attention>15</attention> de Aceleração de Habilidade</stats><br><li><passive>Cisalhar:</passive> causar Dano Físico aplica 40% de <status>Feridas Dolorosas</status> aos Campeões inimigos por 3s. Se o alvo estiver com menos de 50% de Vida, o efeito aumentará para 60% de <status>Feridas Dolorosas</status>.<br><br><rules><status>Feridas Dolorosas</status> reduz a eficácia de efeitos de cura e Regeneração.</rules></mainText><br></span><br><span>Custo:</span> <span style="color: #ffc659">2600 (300)</span>" alt="Serrespada Quimiopunk">
                </div>';}
                if($Key->result->item2 != 0){
                   echo '<div class="Item">
                   <img src="//opgg-static.akamaized.net/images/lol/item/'.$Key->result->item2.'.png?image=q_auto:best&amp;v=1620787344" class="Image tip" title="<b style="color: #00cfbc">Botas Galvanizadas de Aço</b><br><span>Aprimora a Velocidade de Movimento e reduz o dano de ataques básicos recebidos</span><br><span><mainText><stats><attention>20</attention> de Armadura<br><attention>45</attention> de Velocidade de Movimento</stats><br><li>Reduz o dano sofrido de Ataques em 12%.</mainText><br></span><br><span>Custo:</span> <span style="color: #ffc659">1100 (500)</span>" alt="Botas Galvanizadas de Aço">
                </div>';}
                if($Key->result->item3 != 0){
                  echo '<div class="Item">
                   <img src="//opgg-static.akamaized.net/images/lol/item/'.$Key->result->item3.'.png?image=q_auto:best&amp;v=1620787344" class="Image tip" title="<b style="color: #00cfbc">Alteração Vidente</b><br><span>Concede alcance aumentado e revela a área-alvo</span><br><span><mainText><stats></stats><active>Ativo – Amuleto:</active> Revela uma área e posiciona uma Sentinela frágil e visível em até 4000 unidades de distância. Essa Sentinela não pode ser alvo de Feitiços de Invocador nem de Habilidades <scaleLevel>(198s - 99s de Tempo de Recarga)</scaleLevel>.</mainText><br></span>" alt="Alteração Vidente">
                </div>';}
                if($Key->result->item4 != 0){
                  echo '<div class="Item">
                   <img src="//opgg-static.akamaized.net/images/lol/item/'.$Key->result->item4.'.png?image=q_auto:best&amp;v=1620787344" class="Image tip" title="<b style="color: #00cfbc">Eclipse</b><br><span><mainText><stats><attention>55</attention> de Dano de Ataque<br><attention>18</attention> de Letalidade<br><attention>8%</attention> de Vampirismo Universal</stats><br><br><li><passive>Lua Sempre Crescente:</passive> atingir um Campeão com 2 Ataques ou Habilidades separados dentro de 1.5s causa <physicalDamage>6% da Vida máxima como Dano Físico</physicalDamage> adicional, concedendo a você <speed>15% de Velocidade de Movimento</speed> e <shield>150 + 40% de Dano de Ataque adicional como Escudo (100 + 30% de Dano de Ataque adicional para Campeões de ataque à distância)</shield> por 2s (8s de Tempo de Recarga, 16s para Campeões de ataque à distância).<br><br><rarityMythic>Passivo Mítico:</rarityMythic> concede a todos os outros itens <rarityLegendary>Lendários</rarityLegendary> <attention>4%</attention> de Penetração de Armadura.</mainText><br></span><br><span>Custo:</span> <span style="color: #ffc659">3200 (850)</span>" alt="Eclipse">
                </div>';}
                if($Key->result->item5 != 0){
                  echo '<div class="Item">
                   <img src="//opgg-static.akamaized.net/images/lol/item/'.$Key->result->item5.'.png?image=q_auto:best&amp;v=1620787344" class="Image tip" title="<b style="color: #00cfbc">Rancor de Serylda</b><br><span><mainText><stats><attention>45</attention> de Dano de Ataque<br><attention>30%</attention> de Penetração de Armadura<br><attention>20</attention> de Aceleração de Habilidade</stats><br><li><passive>Frio Agonizante:</passive> Habilidades de dano causam 30% de <status>Lentidão</status> aos inimigos por 1s.</mainText><br></span><br><span>Custo:</span> <span style="color: #ffc659">3200 (650)</span>" alt="Rancor de Serylda">
                </div>';}
                if($Key->result->item6 != 0){ echo '<div class="Item">
                   <img src="//opgg-static.akamaized.net/images/lol/item/'.$Key->result->item6.'.png?image=q_auto:best&amp;v=1620787344" class="Image tip" title="<b style="color: #00cfbc">Capa da Agilidade</b><br><span>Aumenta a Chance de Acerto Crítico</span><br><span><mainText><stats><attention>15%</attention> de Chance de Acerto Crítico</stats></mainText><br></span><br><span>Custo:</span> <span style="color: #ffc659">600 (600)</span>" alt="Capa da Agilidade">
                </div>';}

                echo '</div>
             <div class="Trinket">
                <img src="//opgg-static.akamaized.net/images/site/summoner/icon-ward-'.$ward.'.png">
                Control Ward <span class="wards vision">'.$Key->result->visionWardsBoughtInGame.'</span>
             </div>
          </div>
          
          <div class="StatsButton">
             <div class="Content">
                <div class="Item">
                   <a id="right_match" href="#" class="Button MatchDetail">
                   <span class="__spSite __spSite-194 Off"></span>
                   <span class="__spSite __spSite-193 On"></span>
                   </a>
                </div>
             </div>
          </div>
       </div>
       <div class="GameDetail"></div>
    </div>
</div>';
   }
}

echo '</div>';