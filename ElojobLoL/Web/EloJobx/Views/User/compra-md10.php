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
                   
                  echo '<div id="page-content" style="min-height: 790px;">
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
                              <td>MD 10</td>
                           </tr>
                           <tr>
                              <th>Compra</th>
                              <td colspan="100%">'.strtoupper($Arrays->Fila).' / <img src="/Template/imagens/badges/'.$EloTools->ElosImg($Arrays->Temporada,'I','imagem').'.png" style="max-height: 30px;"> '.strtoupper($Arrays->Temporada).' '.$Arrays->Detalhes->divisao.' / '.$Arrays->Aulas.' PARTIDAS</td>
                           </tr>
                           <tr>
                              <th>Booster</th>
                              <td>
                                 -
                              </td>
                              <th>Valor</th>
                              <td>'.$CheckInvoiceR["valor"].'</td>
                           </tr>
                           <tr>
                              <th>Solicitação</th>
                              <td>'.date_format(date_create($CheckInvoiceR["date"]), 'd/m/Y H:i:s').'</td>
                              <th>Aprovação</th>
                              <td>-</td>
                              <th>Finalizado</th>
                              <td>-</td>
                           </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="block">
                        <div class="block-title">
                           <h4>- Serviço <strong>MD10</strong></h4>
                        </div>
                        <div class="table-responsive">
                           <table class="table table-vcenter table-striped">
                              <tbody>
                              <tr>
                              <th width="20%">Modo</th>
                              <td>'.strtoupper($Arrays->Modo).'</td>
                           </tr>
                           <tr> 
                              <th width="20%">Qtd. Partidas</th>
                              <td>'.strtoupper($Arrays->Aulas).'</td>
                           </tr>
                           <tr>
                              <th width="20%">Rota</th>
                              <td><img src="/Template/imagens/routes/lane-'.$Arrays->Detalhes->rota.'.png" style="max-height: 25px;"> '.strtoupper($Arrays->Detalhes->rota).'</td>
                           </tr>
                           <tr>
                              <th width="20%">Dias</th><td>';
                              $Numero = 0;
                              foreach($Arrays->Detalhes->dias as $Dias){
                                  $Numero++;
                                  if(count($Arrays->Detalhes->dias) > 1){
                                   if($Numero == count($Arrays->Detalhes->dias)){
                                       echo ' e '.$Dias;
                                   }else if($Numero == count($Arrays->Detalhes->dias) - 1){
                                       echo $Dias;
                                   }else{echo $Dias.', ';}
                                  }
                              }
                           echo '</td></tr>
                           <tr>
                              <th width="20%">Horários</th>
                              <td>'.$Arrays->Detalhes->horarios.'</td>
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
                              <tbody>
                                 <tr>
                                    <th width="20%">Invocador</th>
                                    <td>'.$Arrays->Detalhes->invocador.'</td>
                                 </tr>
                              </tbody>
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
                              if(isset($Arrays->Detalhes->boosterfavorito)){
                                 $Detalhes = MyShoppingMyBooster($Server,$Arrays->Detalhes->boosterfavorito_booster);
                                 echo '<tr>
                                 <th width="20%">Booster Favorito</th>
                                 <td>
                                 <a href="/user/perfil/'.$Detalhes["user"].'"><img src="/Template/imagens/profiles/avatar/'.ImagesUser(1,GetDateProfile($Server,$Detalhes["user"])[1]["avatar"],$Server)["img"].'" class="img-circle avatar" style="max-height: 30px;"> '.$Detalhes["nome"].'</a>
                                 </td>
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