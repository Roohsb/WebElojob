<?php

$Account = AccountLol($Server,$URL[2]);
if($Account < 1){
    header("Location: /user/centro");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    EditAccountLol($_POST,$Server,$URL[2]);
 }
$Invocador = $Account["invocador"];
$Conta = $Account["conta"];
$Senha = $Account["senha"];
?>
<!DOCTYPE html>
   <html class="no-js" lang="pt">
   <?php 
   include 'EloJobx/Components/Head-User.php'; 
      echo '<body>
         <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZTSHM2"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <div id="page-wrapper">
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">';
               include 'EloJobx/Components/Header-User.php'; 
               ?>
                  <div id="page-content">
                     <div class="block">
                        <div class="block-title">
                           <h3>Editar <strong>Conta LOL</strong></h3>
                        </div>
                        <?php 
                        if(isset($_SESSION["EditAlert"])){
                            echo '<div class="text-danger" style="
                            text-align: center;
                        ">'.$_SESSION["EditAlert"].'.</div>';
                        unset($_SESSION["EditAlert"]);
                        }
                        echo '<form action="/user/editar-lol/'.$URL[2].'" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                           <div class="form-group">
                              <label class="col-md-3 control-label" for="invocador">Invocador</label>
                              <div class="col-md-9">
                                 <input type="text" name="invocador" value="'.$Invocador.'" id="invocador" class="form-control" placeholder="Invocador">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-3 control-label" for="conta">Conta</label>
                              <div class="col-md-9">
                                 <input type="text" name="conta" value="'.$Conta.'" id="conta" class="form-control" placeholder="Conta">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-3 control-label" for="senha">Senha</label>
                              <div class="col-md-9">
                                 <input type="text" name="senha" value="'.$Senha.'" id="senha" class="form-control" placeholder="******">
                              </div>
                           </div>
                           <div class="form-group form-actions">
                              <div class="col-md-9 col-md-offset-3">
                                 <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Editar</button>
                              </div>
                           </div>
                        </form>'; ?>
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
         <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="2aed1afc4825ea299285dcdd-text/javascript"></script>
         <script src="/Template/js/user/bootstrap.min.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script src="/Template/js/user/plugins.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script src="/Template/js/user/vex.combined.min.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script src="/Template/js/user/maskedinput.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script type="2aed1afc4825ea299285dcdd-text/javascript">
            var base_url = 'http://localhost:81';
            vex.defaultOptions.className = 'vex-theme-os';
            vex.dialog.buttons.YES.text = 'OK';
            vex.dialog.buttons.NO.text = 'CANCELAR';
            
            $(function() {
            	$(".phone").mask("(99) 99999-9999");
            });
         </script>
         <script src="/Template/js/profile/app.js?v=22" type="2aed1afc4825ea299285dcdd-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="2aed1afc4825ea299285dcdd-|49" defer=""></script>
      </body>
   </html>