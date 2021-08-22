<?php
 $CheckInvoice = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE id = :i AND Usuario = :u");
 $CheckInvoice->execute(["i" => $URL[2], ":u" => $_SESSION["Usuario"]]);
 $CheckInvoiceR = $CheckInvoice->fetch(PDO::FETCH_ASSOC);
 if(!$CheckInvoiceR){
   header("Location: /user/centro");
   exit;
 }
 $Arrays = json_decode($CheckInvoiceR["data"]);
 if(isset($Arrays->Curso)){
   require('EloJobx/Views/User/Compra/chat-coach.php');
   exit;
 }
 if(isset($Arrays->Servico) && $Arrays->Servico == 'MD10'){
   require('EloJobx/Views/User/Compra/chat-md10.php');
   exit;
 }
 $Account = isset($Arrays->Login) ? $Arrays->Login: $Arrays->LolAccount;
 $AccountDetails = AccountLolTwo($Server,$Account);
echo '<!DOCTYPE html>
<html class="no-js" lang="pt">
   <head>';
      include 'EloJobx/Components/Head-User.php';  
      echo '<style type="text/css">
            #chat{top:0;bottom:50px}#chat #mensagens{height:350px;overflow-y:scroll;overflow-x:hidden}#chat #mensagens ul{padding:15px;margin:0;list-style:none}#chat #mensagens li{margin-bottom:7px;padding:15px 10px;padding-right:10px;padding-left:50px;border-left:5px solid #333;background-color:#f6f6f6;position:relative}#chat #mensagens li.highlight{padding-left:50px;border-left:none;border-right-width:5px;border-right-style:solid}#chat #mensagens li img.avatar{position:absolute;top:8px;width:32px;height:32px;right:auto;left:8px}#chat #mensagens li small{float:right}@media screen and (min-width:768px){#chat #mensagens li{width:50%;margin-left:50%}#chat #mensagens li.highlight{margin-left:0;margin-right:50%}}
            .dropzone{width:max-content!important}.dropzone .dz-message{font-size:inherit!important;margin: auto!important}
         </style>
         <script>var id_chat = \''.$URL[2].'\'; </script>
            <body>
               <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZTSHM2"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
                  <div id="page-wrapper">
                  <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">';
                     include 'EloJobx/Components/Header-User.php'; 
                  echo '<div id="page-content">
                     <div class="block">
                        <div class="block-title">
                           <div class="block-options pull-right">
                              <a href="javascript:void(0)" title="Ao Vivo" id="btn-aovivo" onclick="if (!window.__cfRLUnblockHandlers) return false; $(\'#modal-user-aovivo\').modal(\'show\');" class="label label-default" data-cf-modified-18efb70b4938c5508bdece3e-="">
                              <i class="fa fa-circle text-white animation-pulse"></i> Ao Vivo
                              </a>
                           </div>
                           <h3><strong>Chat</strong> do Serviço</h3>
                        </div>
                        <div class="row">
                           <div class="col-md-12">';
                           if($AccountDetails["playing"] == 0){
                              echo '<div class="alert alert-success alert-dismissable">
                                 <h4><strong>Status da Conta:</strong> Conta Disponível!</h4>
                                 <p>Não tem nenhum jogador na conta neste momento!</p>
                                 <p><a href="javascript: void(0);" onclick="if (!window.__cfRLUnblockHandlers) return false; statusConta(\'Tem certeza que deseja mudar o status para conta em uso?\', \'/api/account-status/'.$AccountDetails["id"].'/'.$URL[2].'\');" class="btn btn-xs btn-success" data-cf-modified-18efb70b4938c5508bdece3e-=""><i class="fa fa-sign-in"></i> Jogar</a></p>
                              </div>';
                                 }else if($AccountDetails["playing"] == 1){
                                    echo '<div class="alert alert-warning alert-dismissable">
                                       <h4><strong>Status da Conta:</strong> Conta em Jogo!</h4>
                                       <p>Voce alterou o estado da conta para <strong>Jogando</strong> enquanto estiver neste status, seu Booster nao pode jogar !</p>
                                       <p><a href="javascript: void(0);" onclick="if (!window.__cfRLUnblockHandlers) return false; statusConta(\'Ao clicar em confimar, voce liberará a conta para seu Booster retornar ao trabalho, quer realmente fazer isso?\', \'/api/account-status/'.$AccountDetails["id"].'/'.$URL[2].'\');" class="btn btn-xs btn-danger" data-cf-modified-18efb70b4938c5508bdece3e-=""><i class="fa fa-sign-in"></i> Liberar</a></p>
                                    </div>';
                                       }
                           echo '</div>
                           <div class="col-md-12">
                              <h4 class="sub-header">- Dados do <strong>Serviço</strong></h4>
                              <div class="table-responsive">
                                 <table class="table table-vcenter table-striped">
                                     <tbody>
                                    <tr>
                                       <th>Número da Compra</th>
                                       <td>#'.$URL[2].'</td>
                                       <th>Status</th>
                                       <td>'.$EloTools->PaymentStatus($CheckInvoiceR["payment"]).'</td>
                                       <th>Serviço</th>
                                       <td>'.strtoupper($Arrays->Servico).'</td>
                                    </tr>
                                    <tr>
                                       <th>Compra</th>
                                       <td>'.strtoupper($Arrays->Fila).' / <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->EloSelecionado,$Arrays->DivisaoSelecionada,'imagem').'.png" style="max-height: 30px;">
                                       '.$EloTools->ElosImg($Arrays->EloSelecionado,$Arrays->DivisaoSelecionada,'nome').' / 
                                        <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'imagem').'.png" data-toggle="tooltip" style="max-height: 30px;">'.$EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'nome').'</td>
                                       <td></td>
                                    </tr>
                                    <tr>
                                       <th>Booster</th>
                                       <td>
                                          -
                                       </td>
                                       <th>Valor</th>
                                       <td>'.$CheckInvoiceR["valor"].'</td>
                                       <th>Prazo</th>';
                                       if(isset($Arrays->ReducePrazo)){
                                          echo '<td><small class="text-danger" style="text-decoration: line-through;">'.$Arrays->Prazo.' dias após aprovação</small><br>
                                          '.intval($Arrays->Prazo / 2) .' dias após aprovação</td>';
                                       }else{
                                       echo '<td>'.$Arrays->Prazo.' dias após aprovação</td>';
                                       }
                                    echo '</tr>
                                    <tr>
                                       <th>Solicitação</th>
                                       <td>'.date_format(date_create($CheckInvoiceR["date"]), 'd/m/Y H:i:s').'</td>
                                       <th>Aprovação</th>
                                       <td>-</td>
                                       <th>Finalizado</th>
                                       <td>'.$CheckInvoiceR["payment"] == 2 ? date_format(date_create($CheckInvoiceR["date_aproved"]), 'd/m/Y H:i:s') : '-' .'</td>
                                    </tr>
                                 </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-8">
                              <div id="chat">
                                 <div id="mensagens" style="border: 1px solid #c9c9c9;">
                                    <ul></ul>
                                 </div>
                                 <form action="javascript:void(0);" method="post" class="form-horizontal form-bordered" id="chat-enviar">
                                    <div class="form-group">
                                       <div class="col-md-12">
                                          <div class="input-group">
                                             <input type="text" name="mensagem" id="mensagem" class="form-control" placeholder="Digite aqui sua mensagem e pressione enter...">
                                             <span class="input-group-btn">
                                             <input type="hidden" name="compra" value="'.$URL[2].'">
                                             <button type="submit" class="btn btn-primary">enviar</button>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-default">
                                 <div class="widget-simple">
                                 <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->EloSelecionado,$Arrays->DivisaoSelecionada,'imagem').'.png"  class="widget-image img-circle pull-left">
                                    <h4 class="widget-content widget-content-light text-right">
                                       <strong>'.$EloTools->ElosImg($Arrays->EloSelecionado,$Arrays->DivisaoSelecionada,'nome').'</strong>
                                       <small>Liga atual</small>
                                    </h4>
                                 </div>
                              </a>
                              <a href="javascript:void(0)" class="widget widget-hover-effect2 themed-background-spring">
                                 <div class="widget-simple">
                                 <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'imagem').'.png" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content widget-content-light text-right">
                                       <strong>'.$EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'nome').'</strong>
                                       <small>Liga desejada</small>
                                    </h4>
                                 </div>
                              </a>
                           </div>
                        </div>
                        <div class="row">
                           <div id="boxDadosCompra" class="col-md-4">
                              <h4 class="sub-header">- Serviço <strong>'.ucwords($Arrays->Servico).'</strong></h4>
                              <div class="table-responsive">
                                 <table class="table table-vcenter table-striped">
                                    <tbody>
                                        <tr>
                                       <th width="50%">Fila Desejada</th>
                                       <td>'.ucwords($Arrays->Fila).'</td>
                                    </tr>
                                    <tr>
                                       <th width="50%">Liga Atual</th>
                                       <td>'.ucwords($Arrays->EloSelecionado).'</td>
                                    </tr>
                                    <tr>
                                       <th width="50%">Divisão Atual</th>
                                       <td>'.$Arrays->DivisaoSelecionada.'</td>
                                    </tr>
                                    <tr>
                                       <th width="50%">Liga Desejada</th>
                                       <td>'.ucwords($Arrays->EloDesejado).'</td>
                                    </tr>
                                    <tr>
                                       <th width="50%">Divisão Desejada</th>
                                       <td>'.ucwords($EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'formulario')).'</td>
                                    </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <h4 class="sub-header">- Conta <strong>LOL</strong></h4>
                              <div class="table-responsive">
                              <table class="table table-vcenter table-striped">
                              <tbody>';
                              MyShoppingDetailAccount2($Server,$Account);

                              echo '</tbody>
                           </table>
                              </div>
                              <h4 class="sub-header">- <strong>Extras</strong> Contratados</h4>
                              <div class="table-responsive">
                                 <table class="table table-vcenter table-striped">
                                 <tbody>';
                                 if(isset($Arrays->Chat)){
                                 echo '<tr>
                                 <th width="50%">Chat Offline</th>
                                 <td><span class="label label-success">sim</span></td>
                                 </tr>';
                                 } 
                                 if(isset($Arrays->ReducePrazo)){
                                    echo '<tr>
                                    <th width="50%">Redução do Prazo</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                 }
                                 if(isset($Arrays->SpellsPosi)){
                                    echo '<tr>
                                    <th width="50%">Posição de Feitiços</th>
                                    <td><span class="label label-success">sim</span></td>
                                 </tr>
                                 <tr>
                                 <th width="50%">Flash</th>
                                 <td><img src="https://elojobhigh.com.br/app/assets/imagens/spell-flash.png" style="max-height: 25px;"> <span>FLASH - '.$Arrays->FlashPosi.'</span></td>
                                 </tr>';
                                 }
                                 
                                 if(isset($Arrays->RateMMR)){
                                    echo '<tr>
                                    <th width="50%">Taxa MMR</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                 }
                                 if(isset($Arrays->SoloService)){
                                    echo '<tr>
                                    <th width="50%">Serviço Solo</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                 }
                                 if(isset($Arrays->SchedulesREST)){
                                    echo '<tr>
                                    <th width="50%">Horários Restritos</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                    echo '<tr>
                                    <th width="50%">Horários</th>
                                    <td>'.$Arrays->Schedules.'.</td>
                                    </tr>';
                                 }
                                 if(isset($Arrays->BoosterFavority)){
                                    $Detalhes = MyShoppingMyBooster($Server,$Arrays->BoosterFavorityB);
                                    echo '<tr>
                                    <th width="50%">Booster Favorito</th>
                                    <td>
                                    <a href="/user/perfil/'.$Detalhes["user"].'" title="Akali"><img src="/Template/imagens/profiles/avatar/'.ImagesUser(1,GetDateProfile($Server,$Detalhes["user"])[1]["avatar"],$Server)["img"].'" class="img-circle avatar" style="max-height: 30px;"> '.$Detalhes["nome"].'</a>
                                    </td>
                                    </tr>';

                                 }
                                 if(isset($Arrays->SpecificCHAMPs)){
                                    if(isset($Arrays->SuperRESTR)){
                                       echo '<tr>
                                       <th width="50%">Super Restrição</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                    }else{
                                          echo '<tr>
                                          <th width="50%">Super Restrição</th>
                                          <td><span class="label label-danger">não</span></td>
                                          </tr>';
                                    }
                                    echo ' <th width="50%">Campeões</th>
                                    <td>';
                                    foreach($Arrays->Champions as $Campeoes){
                                    echo '<img src="'.$EloTools->Champions(intval($Campeoes))["Img"].'.png" data-toggle="tooltip" title="" alt="'.$EloTools->Champions(intval($Campeoes))["Name"].'" style="max-height: 35px;" data-original-title="'.$EloTools->Champions(intval($Campeoes))["Name"].'">';
                                    }
                                    echo '</td>
                                    </tr>';
                                 }
                                if(isset($Arrays->Mastery)){
                                   echo '<tr>
                                   <th width="50%">Maestria(s)</th>
                                   <td><span class="label label-info" style="margin-right: 10px;">';
                                   foreach($Arrays->MasteryHero as $Maestrias){
                                    $Explodindo = explode("/", $Maestrias);
                                      echo '<img src="'.$EloTools->Champions(intval($Explodindo[0]))["Img"].'.png" data-toggle="tooltip" title="" alt="Aatrox" style="max-height: 35px;" data-original-title="Aatrox"> '.$EloTools->MaestriasTO($Explodindo[1]).'</span><span class="label label-info" style="margin-right: 10px;">';
                                   }
                                   echo '</td>
                                   </tr>';
                                }
                                
                                 if(isset($Arrays->SpecificRO)){
                                    echo '<tr>
                                    <th width="50%">Rotas Específicas</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                    echo '<tr>
                                    <th width="50%">Rota - Primário</th>
                                    <td><img src="/Template/imagens/routes/lane-'.$Arrays->RoutePrimary.'.png" style="max-height: 25px;"> '.strtoupper($Arrays->RoutePrimary).'</td>
                                    </tr>';
                                    echo '<tr>
                                    <th width="50%">Rota - Secundário</th>
                                    <td><img src="/Template/imagens/routes/lane-'.$Arrays->RouteSecondary.'.png" style="max-height: 25px;"> '.strtoupper($Arrays->RouteSecondary).'</td>
                                    </tr>';
                                 }
                                 if(isset($Arrays->KDAReduce)){
                                    echo '<tr>
                                    <th width="50%">Redução do KDA</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                 }
                                
                                 if(isset($Arrays->StreamON)){
                                    echo '<tr>
                                    <th width="50%">Stream Online</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                 } 
                                 if(isset($Arrays->ExtraWin)){
                                    echo '<tr>
                                    <th width="50%">Vitória Extra</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                 }
                                 if(isset($Arrays->PrioritySER)){
                                    echo '<tr>
                                    <th width="50%">Serviço Prioritário</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                 } 
                                   echo '</tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="col-md-8">
                              <h4 class="sub-header">- Histórico de <strong>Partidas</strong></h4>
                              <div class="table-responsive">
                                 <iframe id="iframeHistorico" src="javascript:void();" frameborder="0" style="border:none;height:100vh;width:100%;"></iframe>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>'; ?>
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
         <div id="modal-user-aovivo" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header text-center">
                     <h3 id="title-aovivo" class="modal-title text-default"><i class="fa fa-circle text-white animation-pulse"></i> Ao Vivo</h3>
                  </div>
                  <div class="modal-body">
                     <div id="boxAoVivo">
                        <center>
                           <img src="https://elojobhigh.com.br/app/assets/imagens/preloader.gif" alt="carregando...">
                        </center>
                     </div>
                  </div>
               </div>
            </div>
         </div>
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
         <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="18efb70b4938c5508bdece3e-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/vendor/bootstrap.min.js" type="18efb70b4938c5508bdece3e-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/plugins.js" type="18efb70b4938c5508bdece3e-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/maskedinput.js" type="18efb70b4938c5508bdece3e-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/ion.sound.min.js" type="18efb70b4938c5508bdece3e-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/vex/js/vex.combined.min.js" type="18efb70b4938c5508bdece3e-text/javascript"></script>
         <script type="18efb70b4938c5508bdece3e-text/javascript">
            var base_url = 'https://elojobhigh.com.br/app/';
            vex.defaultOptions.className = 'vex-theme-os';
            vex.dialog.buttons.YES.text = 'CONFIRMAR';
            vex.dialog.buttons.NO.text = 'CANCELAR';
            
            		
            ion.sound({
            	sounds: [
            		{name: "button_tiny"},
            		{name: "door_bell"},
            		{name: "button_click"}
            	],
            	path: "https://elojobhigh.com.br/app/assets/sounds/",
            	preload: true,
            	multiplay: true,
            	volume: 0.9
            });
            
            var lista = new Array();
            
          
            var id_mensagem = 0;
            var invocador = 'Bruninha';
            var token = 'a02c86e111c9744a0bf8dceb87b894d6';
            
            		var status_aovivo = -1;
            var spectator = "";
            var notificacao_aovivo = "0";
            var pasta_windows = "C:\\";
            var pasta_mac = "/Applications";
            
            function statusAovivo(status) {
            	if(status_aovivo == "-1") {
            		var colorOld = "default";
            	} else if(status_aovivo == "0") {
            		var colorOld = "info";
            	} else if(status_aovivo == "1") {
            		var colorOld = "success";
            	} else if(status_aovivo == "2") {
            		var colorOld = "danger";
            	}
            	
            	if(status == "0") {
            		var colorNew = "info";
            	} else if(status == "1") {
            		var colorNew = "success";
            	} else if(status == "2") {
            		var colorNew = "danger";
            	}
            	
            	status_aovivo = status;
            	
            	$('#btn-aovivo').removeClass('label-' + colorOld);
            	$('#btn-aovivo').addClass('label-' + colorNew);
            	$('#title-aovivo').removeClass('text-' + colorOld);
            	$('#title-aovivo').addClass('text-' + colorNew);
            }
            
            function setAoVivo(status, invocador, id) {
            	statusAovivo(status);
            	if(status == '0') {
            		var html = '<div class="alert alert-info"><h4><i class="fa fa-info-circle"></i> Offline</h4> O booster está offline, ative a notificação, que te avisaremos quando ele ficar online para você assistir a partida ao vivo!<br><strong>Obs:</strong> Deixe essa página aberta que emitiremos um som para avisar quando o booster ficar online.</div>';
            	} else if(status == '1') {
            		var html = '<div class="alert alert-success"><h4><i class="fa fa-check-circle"></i> Online</h4> O booster está online, assista agora mesmo!</div>';
            	} else if(status == '2') {
            		var html = '<div class="alert alert-danger"><h4><i class="fa fa-times-circle"></i> Erro</h4> O invocador informado não existe!</div>';
            	}
            	
            				if(status == '0' || status == '1') {
            		html += '<form action="javascript:void(0);" id="form-notificacao-aovivo" method="post" class="form-horizontal">';
            		html += '	<div class="form-group">';
            		html += '		<div class="col-md-12">';
            		html += '			<div class="checkbox">';
            		html += '				<label for="notificacao-aovivo">';
            		if(notificacao_aovivo == '1') {
            			html += '					<input type="checkbox" name="notificacao-aovivo" id="notificacao-aovivo" checked="checked" value="1"> Receber notificação via e-mail quando o booster estiver ao vivo.';
            		} else {
            			html += '					<input type="checkbox" name="notificacao-aovivo" id="notificacao-aovivo" value="1"> Receber notificação via e-mail quando o booster estiver ao vivo.';
            		}
            		html += '				</label>';
            		html += '				<span id="resultado-notificacao-aovivo"></span>';
            		html += '			</div>';
            		html += '		</div>';
            		html += '	</div>';
            		html += '</form>';
            	}
            				
            	if(status == '1') {
            		var codigo_mac = 'if test -d  ' + pasta_mac + '/League\\ of\\ Legends.app/Contents/LoL/Game/ ; then cd ' + pasta_mac + '/League\\ of\\ Legends.app/Contents/LoL/Game/ && chmod +x ./LeagueofLegends.app/Contents/MacOS/LeagueofLegends ; else cd ' + pasta_mac + '/League\\ of\\ Legends.app/Contents/LoL/RADS/solutions/lol_game_client_sln/releases/ && cd $(ls -1vr -d */ | head -1) && cd deploy && chmod +x ./LeagueofLegends.app/Contents/MacOS/LeagueofLegends ; fi && riot_launched=true ./LeagueofLegends.app/Contents/MacOS/LeagueofLegends "' + spectator + '" "-UseRads" "-Locale=en_US" "-GameBaseDir=.."';
            		
            		html += '<div>';
            		html += '	<ul class="nav nav-tabs" role="tablist">';
            		html += '		<li role="presentation" class="active"><a href="#windows" aria-controls="windows" role="tab" data-toggle="tab">Windows</a></li>';
            		html += '		<li role="presentation"><a href="#mac" aria-controls="mac" role="tab" data-toggle="tab">Mac</a></li>';
            		html += '	</ul>';
            		html += '	<div class="tab-content">';
            		html += '		<div role="tabpanel" class="tab-pane active" id="windows">';
            		html += '			<h3>Instruções para Windows</h3>';
            		html += '			<p style="margin-bottom: 5px;">Se a sua pasta Riot Games estiver localizada em uma pasta diferente de C:\\, insira-a aqui.</p>';
            		html += '			<input type="text" name="pasta-windows" id="pasta-windows" style="margin-bottom: 10px;" class="form-control" value="' + pasta_windows + '">';
            		html += '			<p>Agora basta você baixar o arquivo de execução e assistir a partida ao vivo.</p>';
            		html += '			<p><a href="https://opgg.elojobhigh.com/home/aovivo?invocador=' + invocador + '&download=1&id=' + id + '&pasta=' + pasta_windows + '" target="_blank" id="download-aovivo" class="btn btn-sm btn-primary">ELOHIGH_' + id + '.bat</a></p>';
            		html += '		</div>';
            		html += '		<div role="tabpanel" class="tab-pane" id="mac">';
            		html += '			<h3>Instruções para Mac</h3>';
            		html += '			<p style="margin-bottom: 5px;">Basta copiar o texto e colá-lo no aplicativo Terminal. Para abrir o Terminal, pressione Command + Space, procure "Terminal", e pressione enter.</p>';
            		html += '			<textarea name="codigo-mac" id="codigo-mac" rows="4" style="margin-bottom: 10px;" class="form-control">' + codigo_mac + '</textarea>';
            		html += '			<p style="margin-bottom: 5px;">Se o seu aplicativo League of Legends estiver localizado em uma pasta diferente de /Aplicativos, digite-o aqui.</p>';
            		html += '			<input type="text" name="pasta-mac" id="pasta-mac" class="form-control" value="' + pasta_mac + '">';
            		html += '		</div>';
            		html += '	</div>';
            		html += '</div>';
            	}
            	
            	$('#boxAoVivo').html(html);
            }
            
            function carregaAoVivo(invocador, id) {
            	$.ajax({
            		url: 'https://opgg.elojobhigh.com/home/aovivo?invocador=' + invocador,
            		type: 'GET',
            		dataType: 'json',
            		success: function(data) {
            			if(data.status == '1') {
            				if(data.spectator != spectator) {
            					spectator = data.spectator;
            					setAoVivo('1', invocador, id);
            					ion.sound.play("button_click");
            				}
            			} else {
            				spectator = "";
            				setAoVivo(data.cod, null, null);
            			}
            		}
            	});
            }
            		
            function statusConta(mensagem, url) {
            	vex.dialog.confirm({
            		message: mensagem,
            		callback: function (value) {
            			if (value) {
            				window.location = url;
            			}
            		}
            	});
            }
            function carregarMensagens(verifica = 0, som = 0) {
            	$.ajax({
            		url: '/api/chat',
            		type: 'POST',
            		dataType: 'json',
            		data: 'compra=' + id_chat + '&mensagem=' + id_mensagem,
            		success: function(data) {
            			if(verifica && data.data.length == 0) {
            				$('#mensagens ul').append('<li style="width: 100%;margin-left: 0;">Nenhuma mensagem encontrada</li>');
            			}
            			$.each(data.data, function(id, mensagem) {
            				if(id_mensagem == '0') {
            					$('#mensagens ul').html('');
            				}
            				if(!lista[mensagem.id]) {
            					lista[mensagem.id] = true;
            					if(som) {
            						ion.sound.play("button_tiny");
            					}
            					var tipo = '';
            					if(mensagem.tipo == '1') {
            						tipo = 'highlight';
            					}
            					var html = '<li class="' + tipo + '">' +
            						'<small>' + mensagem.data + '</small>' +
            						'<a href="' + mensagem.usuario.url + '" title="' + mensagem.usuario.nome + '"><img src="' + mensagem.usuario.avatar + '" alt="' + mensagem.usuario.nome + '" class="img-circle avatar"> <strong>' + mensagem.usuario.nome + '</strong></a> diz: ' + mensagem.mensagem + '' +
            					'</li>';
            					$('#mensagens ul').append(html);
            					id_mensagem = mensagem.id;
            					
            					$('#mensagens').scrollTop($('#mensagens')[0].scrollHeight);
            				}
            			});
            		}
            	});
            }
            function enviarMensagem(data) {
            	$.ajax({
            		url: '/api/chat/enviar',
            		type: 'POST',
            		dataType: 'json',
            		data: data,
            		beforeSend: function() {
            			$('#mensagem').val('');
            		}, 
            		success: function(data) {
            			if(data.status) {
            				carregarMensagens();
            			}
            		}
            	});
            }
            $(function() {
            	$(".phone").mask("(99) 99999-9999");
            	
            	carregarMensagens(1);
            	
            				$('#iframeHistorico').css('height', ($('#boxDadosCompra').height() - 90) + 'px');
            	         $('#iframeHistorico').attr('src', 'http://localhost:81/highlights/historic?id='+ id_chat);
            				
            				carregaAoVivo(invocador, id_chat);
            	setInterval(function(){ carregaAoVivo(invocador, id_chat); }, 60000);
            	
            	$('#boxAoVivo').on('change', '#notificacao-aovivo', function() {
            		var notificaoAoVivo = $(this).is(':checked') ? "1" : "0";
            		
            		$.ajax({
            			url: 'https://elojobhigh.com.br/app/cliente/notificacao_aovivo.json',
            			type: 'POST',
            			dataType: 'json',
            			data: 'id=' + id_chat + '&notificacao=' + notificaoAoVivo,
            			success: function(data) {
            				if(data.status == '1') {
            					notificacao_aovivo = notificaoAoVivo;
            					$('#resultado-notificacao-aovivo').hide().html('<i class="fa fa-check-circle text-success"> atualizado!</i>').fadeIn('slow');
            				} else {
            					$('#resultado-notificacao-aovivo').hide().html('<i class="fa fa-times-circle text-danger"> erro ao atualizar!</i>').fadeIn('slow');
            				}
            			}
            		});
            	});
            	
            	$('#boxAoVivo').on('keyup', '#pasta-windows', function() {
            		pasta_windows = $(this).val();
            		$('#download-aovivo').attr('href', 'https://opgg.elojobhigh.com/home/aovivo?invocador=' + invocador + '&download=1&id=' + id_chat + '&pasta=' + pasta_windows);
            	});
            	
            	$('#boxAoVivo').on('keyup', '#pasta-mac', function() {
            		pasta_mac = $(this).val();
            		var codigo_mac = 'if test -d  ' + pasta_mac + '/League\\ of\\ Legends.app/Contents/LoL/Game/ ; then cd ' + pasta_mac + '/League\\ of\\ Legends.app/Contents/LoL/Game/ && chmod +x ./LeagueofLegends.app/Contents/MacOS/LeagueofLegends ; else cd ' + pasta_mac + '/League\\ of\\ Legends.app/Contents/LoL/RADS/solutions/lol_game_client_sln/releases/ && cd $(ls -1vr -d */ | head -1) && cd deploy && chmod +x ./LeagueofLegends.app/Contents/MacOS/LeagueofLegends ; fi && riot_launched=true ./LeagueofLegends.app/Contents/MacOS/LeagueofLegends "' + spectator + '" "-UseRads" "-Locale=en_US" "-GameBaseDir=.."';
            		$('#codigo-mac').val(codigo_mac);
            	});
            	
            	$('#boxAoVivo').on('click', '#codigo-mac', function() {
            		$(this).select();
            	});
            				
            				
            	setInterval(function(){ carregarMensagens(0, 1); }, 16000);
            	
            				
            	$('#chat-enviar').submit(function() {
            		var mensagem = $('#mensagem').val();
            		if(mensagem != '') {
            			enviarMensagem($(this).serialize());
            			$('#mensagem').val('');
            		}
            		return false;
            	});
            });
         </script>
         <script src="/Template/js/profile/app.js" type="18efb70b4938c5508bdece3e-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="18efb70b4938c5508bdece3e-|49" defer=""></script>
      </body>
   </html>