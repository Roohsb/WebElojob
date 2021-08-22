<?php
    if(isset($URL[2]) && is_numeric($URL[2])){
        $Publish = Publish($Server,$URL[2]);
        if($Publish < 1){
            header("Location: /user/centro");
            exit;
        }
    }else{
        header("Location: /user/centro");
        exit;
    }
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
                           <h3>Visualizar <strong>Aviso</strong></h3>
                        </div>
                        <div class="text-center">
                         <?php echo $Publish["text"]; ?>
                        </div>
                     </div>
                  </div>
                  <footer class="clearfix">
                     <div class="pull-left">
                        <div class="copyright">l<?php echo copyright; ?></div>
                     </div>
                     <div class="pull-right">
                        Desenvolvido por <a href="http://lorenstudio.com" target="_blank">CastroMS</a>.
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
         <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="6a9e6dbe6c02b41c5a53c5fa-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/vendor/bootstrap.min.js" type="6a9e6dbe6c02b41c5a53c5fa-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/plugins.js" type="6a9e6dbe6c02b41c5a53c5fa-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/vex/js/vex.combined.min.js" type="6a9e6dbe6c02b41c5a53c5fa-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/maskedinput.js" type="6a9e6dbe6c02b41c5a53c5fa-text/javascript"></script>
         <script type="6a9e6dbe6c02b41c5a53c5fa-text/javascript">
            var base_url = 'http://localhost:81';
            vex.defaultOptions.className = 'vex-theme-os';
            vex.dialog.buttons.YES.text = 'OK';
            vex.dialog.buttons.NO.text = 'CANCELAR';
            
            $(function() {
            	$(".phone").mask("(99) 99999-9999");
            });
         </script>
         <script src="/Template/js/profile/app.js?v=22"  type="6a9e6dbe6c02b41c5a53c5fa-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="6a9e6dbe6c02b41c5a53c5fa-|49" defer=""></script>
      </body>