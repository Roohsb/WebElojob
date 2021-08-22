<?php
if(!isset($URL[2]) || !is_numeric($URL[2])){
    header("Location: /user/centro");
    exit;
 }
 $CheckInvoice = $Server->prepareStatment("SELECT * FROM elo_users_invoices WHERE id = :i AND Usuario = :u");
 $CheckInvoice->execute(["i" => $URL[2], ":u" => $_SESSION["Usuario"]]);
 $CheckInvoiceR = $CheckInvoice->fetch(PDO::FETCH_ASSOC);
 if(!$CheckInvoiceR){
   header("Location: /user/centro");
   exit;
 }
 if(isset($URL[3])){
   if (file_exists('EloJobx/Views/User/Compra/' . $URL[3] . '.php')){
      require('EloJobx/Views/User/Compra/' . $URL[3] . '.php');
      exit;
   }
 }
 $Arrays = json_decode($CheckInvoiceR["data"]);
 if(isset($Arrays->Curso)){
   require('EloJobx/Views/User/compra-coach.php');
   exit;
 }
 if(isset($Arrays->Servico) && $Arrays->Servico == 'MD10'){
   require('EloJobx/Views/User/compra-md10.php');
   exit;
 }
echo '<!DOCTYPE html>
   <html class="no-js" lang="pt">
      <head>';
         include 'EloJobx/Components/Head-User.php'; 
            echo '<body>
               <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZTSHM2"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
                  <div id="page-wrapper">
                  <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">';
                     include 'EloJobx/Components/Header-User.php'; 
                   
                  echo '<div id="page-content">
                     <div class="block">
                        <div class="block-title">
                           <h3>Visualizar <strong>Compra</strong></h3>
                        </div>
                        <div class="block">
                           <div class="block-title">
                              <h4>- Dados da <strong>Compra</strong></h4>
                           </div>
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
                                          '.$CheckInvoiceR["booster"].'
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
                                       <td>'.$CheckInvoiceR["date_aproved"].'</td>
                                       <th>Finalizado</th>
                                       <td>'.$CheckInvoiceR["finish_date"].'</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="block">
                           <div class="block-title">
                              <h4>- Serviço <strong>'.strtoupper($Arrays->Servico).'</strong></h4>
                           </div>
                           <div class="table-responsive">
                              <table class="table table-vcenter table-striped">
                                 <tbody>
                                    <tr>
                                       <th width="20%">Fila Desejada</th>
                                       <td>'.ucwords($Arrays->Fila).'</td>
                                    </tr>
                                    <tr>
                                       <th width="20%">Liga Atual</th>
                                       <td>'.ucwords($Arrays->EloSelecionado).'</td>
                                    </tr>
                                    <tr>
                                       <th width="20%">Divisão Atual</th>
                                       <td>'.$Arrays->DivisaoSelecionada.'</td>
                                    </tr>
                                    <tr>
                                       <th width="20%">Liga Desejada</th>
                                       <td>'.ucwords($Arrays->EloDesejado).'</td>
                                    </tr>
                                    <tr>
                                       <th width="20%">Divisão Desejada</th>
                                       <td>'.ucwords($EloTools->ElosImg($Arrays->EloDesejado,$Arrays->DivisaoDesejada,'formulario')).'</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="block">
                           <div class="block-title">
                              <h4>- Conta <strong>LOL</strong></h4>
                           </div>
                           <div class="table-responsive">
                              <table class="table table-vcenter table-striped">
                                 <tbody>';
                                 $Account = isset($Arrays->Login) ? $Arrays->Login: $Arrays->LolAccount;
                                 MyShoppingDetailAccount($Server,$Account);

                                 echo '</tbody>
                              </table>
                           </div>
                        </div>
                        <div class="block">
                           <div class="block-title">
                              <h4>- <strong>Extras</strong> Contratados</h4>
                           </div>
                           <div class="table-responsive">
                              <table class="table table-vcenter table-striped">
                                 <tbody>';
                                    if(isset($Arrays->Chat)){
                                    echo '<tr>
                                    <th width="20%">Chat Offline</th>
                                    <td><span class="label label-success">sim</span></td>
                                    </tr>';
                                    } 
                                    if(isset($Arrays->ReducePrazo)){
                                       echo '<tr>
                                       <th width="20%">Redução do Prazo</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                    }
                                    if(isset($Arrays->SpellsPosi)){
                                       echo '<tr>
                                       <th width="20%">Posição de Feitiços</th>
                                       <td><span class="label label-success">sim</span></td>
                                    </tr>
                                    <tr>
                                    <th width="20%">Flash</th>
                                    <td><img src="https://elojobhigh.com.br/app/assets/imagens/spell-flash.png" style="max-height: 25px;"> <span>FLASH - '.$Arrays->FlashPosi.'</span></td>
                                    </tr>';
                                    }
                                    
                                    if(isset($Arrays->RateMMR)){
                                       echo '<tr>
                                       <th width="20%">Taxa MMR</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                    }
                                    if(isset($Arrays->SoloService)){
                                       echo '<tr>
                                       <th width="20%">Serviço Solo</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                    }
                                    if(isset($Arrays->SchedulesREST)){
                                       echo '<tr>
                                       <th width="20%">Horários Restritos</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                       echo '<tr>
                                       <th width="20%">Horários</th>
                                       <td>'.$Arrays->Schedules.'.</td>
                                       </tr>';
                                    }
                                    if(isset($Arrays->BoosterFavority)){
                                       $Detalhes = MyShoppingMyBooster($Server,$Arrays->BoosterFavorityB);
                                       echo '<tr>
                                       <th width="20%">Booster Favorito</th>
                                       <td>
                                       <a href="/user/perfil/'.$Detalhes["user"].'" title="Akali"><img src="/Template/imagens/profiles/avatar/'.ImagesUser(1,GetDateProfile($Server,$Detalhes["user"])[1]["avatar"],$Server)["img"].'" class="img-circle avatar" style="max-height: 30px;"> '.$Detalhes["nome"].'</a>
                                       </td>
                                       </tr>';

                                    }
                                    if(isset($Arrays->SpecificCHAMPs)){
                                       if(isset($Arrays->SuperRESTR)){
                                          echo '<tr>
                                          <th width="20%">Super Restrição</th>
                                          <td><span class="label label-success">sim</span></td>
                                          </tr>';
                                       }else{
                                             echo '<tr>
                                             <th width="20%">Super Restrição</th>
                                             <td><span class="label label-danger">não</span></td>
                                             </tr>';
                                       }
                                       echo ' <th width="20%">Campeões</th>
                                       <td>';
                                       foreach($Arrays->Champions as $Campeoes){
                                       echo '<img src="'.$EloTools->Champions(intval($Campeoes))["Img"].'.png" data-toggle="tooltip" title="" alt="'.$EloTools->Champions(intval($Campeoes))["Name"].'" style="max-height: 35px;" data-original-title="'.$EloTools->Champions(intval($Campeoes))["Name"].'">';
                                       }
                                       echo '</td>
                                       </tr>';
                                    }
                                   if(isset($Arrays->Mastery)){
                                      echo '<tr>
                                      <th width="20%">Maestria(s)</th>
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
                                       <th width="20%">Rotas Específicas</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                       echo '<tr>
                                       <th width="20%">Rota - Primário</th>
                                       <td><img src="/Template/imagens/routes/lane-'.$Arrays->RoutePrimary.'.png" style="max-height: 25px;"> '.strtoupper($Arrays->RoutePrimary).'</td>
                                       </tr>';
                                       echo '<tr>
                                       <th width="20%">Rota - Secundário</th>
                                       <td><img src="/Template/imagens/routes/lane-'.$Arrays->RouteSecondary.'.png" style="max-height: 25px;"> '.strtoupper($Arrays->RouteSecondary).'</td>
                                       </tr>';
                                    }
                                    if(isset($Arrays->KDAReduce)){
                                       echo '<tr>
                                       <th width="20%">Redução do KDA</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                    }
                                   
                                    if(isset($Arrays->StreamON)){
                                       echo '<tr>
                                       <th width="20%">Stream Online</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                    } 
                                    if(isset($Arrays->ExtraWin)){
                                       echo '<tr>
                                       <th width="20%">Vitória Extra</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                    }
                                    if(isset($Arrays->PrioritySER)){
                                       echo '<tr>
                                       <th width="20%">Serviço Prioritário</th>
                                       <td><span class="label label-success">sim</span></td>
                                       </tr>';
                                    } 

                                  
                                  
                                  
                                 echo '</tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <footer class="clearfix">
                     <div class="pull-left">
                         <div class="copyright">l<?php echo copyright; ?></div>
                     </div>
                     <div class="pull-right">
                        Desenvolvido por <a href="http://www.lorenstudio.com" target="_blank">CastroMS</a>.
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
                        <fieldset>';
                         include 'EloJobx/Components/Form-Definicoes.php'; ?>
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
         <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="39c77964f627c7c33a9964f6-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/vendor/bootstrap.min.js" type="39c77964f627c7c33a9964f6-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/plugins.js" type="39c77964f627c7c33a9964f6-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/vex/js/vex.combined.min.js" type="39c77964f627c7c33a9964f6-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/maskedinput.js" type="39c77964f627c7c33a9964f6-text/javascript"></script>
         <script type="39c77964f627c7c33a9964f6-text/javascript">
            var base_url = 'http://localhost:81';
            vex.defaultOptions.className = 'vex-theme-os';
            vex.dialog.buttons.YES.text = 'OK';
            vex.dialog.buttons.NO.text = 'CANCELAR';
            
            $(function() {
            	$(".phone").mask("(99) 99999-9999");
            });
         </script>
         <script src="https://elojobhigh.com.br/app/assets/js/app.js" type="39c77964f627c7c33a9964f6-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="39c77964f627c7c33a9964f6-|49" defer=""></script>
      </body>
   </html>