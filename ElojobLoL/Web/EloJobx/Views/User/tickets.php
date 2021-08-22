<!DOCTYPE html>
   <html class="no-js" lang="pt">
      <head>
         <meta charset="utf-8">
         <title><?php echo name; ?> - Tickets</title>
         <meta name="description" content="A maneira mais fácil e rápida de subir de ELO! Adquira já o seu serviço conosco!">
         <meta name="author" content="CastroMS">
         <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
         <link rel="shortcut icon" href="https://elojobhigh.com.br/app/favicon.ico">
         <link rel="stylesheet" href="/Template/css/user/bootstrap.min.css">
         <link rel="stylesheet" href="/Template/css/user/plugins.css">
         <link href="/Template/css/user/vex.css" rel="stylesheet" />
         <link href="/Template/css/user/vex-theme-os.css" rel="stylesheet" />
         <link rel="stylesheet" href="/Template/css/user/main.css">
         <link id="theme-link" rel="stylesheet" href="/Template/css/user/fancy.css">
         <link rel="stylesheet" href="/Template/css/user/themes.css">
         <script src="https://elojobhigh.com.br/app/assets/js/vendor/modernizr.min.js" type="58b24b72a19721981832dfee-text/javascript"></script>
         <script type="58b24b72a19721981832dfee-text/javascript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WZTSHM2');
         </script>
      </head>
      <body>
         <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZTSHM2"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
         <div id="page-wrapper">
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
            <?php 
               include 'EloJobx/Components/Header-User.php'; 
               ?>
                  <div id="page-content">
                     <div class="row">
                        <div class="col-sm-4 col-lg-3">
                           <div class="block full">
                              <div class="block-title clearfix">
                                 <h3>Filtros</h3>
                              </div>
                              <ul class="nav nav-pills nav-stacked">
                                 <li class="active">
                                    <a href="https://elojobhigh.com.br/app/ticket/gerenciar">
                                    <span class="badge pull-right">0</span>
                                    <i class="fa fa-ticket fa-fw"></i> <strong>Todos</strong>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://elojobhigh.com.br/app/ticket/gerenciar?pesquisar=[aguardando administração]">
                                    <span class="badge pull-right">0</span>
                                    <i class="fa fa-exclamation-triangle fa-fw"></i> <strong>Aguardando Administração</strong>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://elojobhigh.com.br/app/ticket/gerenciar?pesquisar=[aguardando cliente]">
                                    <span class="badge pull-right">0</span>
                                    <i class="fa fa-folder-open-o fa-fw"></i> <strong>Aguardando Cliente</strong>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://elojobhigh.com.br/app/ticket/gerenciar?pesquisar=[cancelado]">
                                    <span class="badge pull-right">0</span>
                                    <i class="fa fa-ban fa-fw"></i> <strong>Cancelado</strong>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://elojobhigh.com.br/app/ticket/gerenciar?pesquisar=[finalizado]">
                                    <span class="badge pull-right">0</span>
                                    <i class="fa fa-folder-o fa-fw"></i> <strong>Finalizado</strong>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-sm-8 col-lg-9">
                           <div class="block">
                              <div class="block-title clearfix">
                                 <h3>Gerenciar <strong>Tickets</strong></h3>
                              </div>
                              <div class="block-content-full">
                                 <div class="table-responsive remove-margin-bottom">
                                    <table class="table table-striped table-vcenter remove-margin-bottom">
                                       <thead>
                                          <tr>
                                             <th class="text-center">#</th>
                                             <th>Status</th>
                                             <th>Setor</th>
                                             <th>Prioridade</th>
                                             <th>Assunto</th>
                                             <th style="width: 150px;" class="text-center">Ações</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td colspan="100%">Nenhum registro encontrado.</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="text-center"></div>
                              </div>
                           </div>
                        </div>
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
         <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="58b24b72a19721981832dfee-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/vendor/bootstrap.min.js" type="58b24b72a19721981832dfee-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/plugins.js" type="58b24b72a19721981832dfee-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/vex/js/vex.combined.min.js" type="58b24b72a19721981832dfee-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/maskmoney.js" type="58b24b72a19721981832dfee-text/javascript"></script>
         <script type="58b24b72a19721981832dfee-text/javascript">
            var base_url = 'http://localhost:81';
            vex.defaultOptions.className = 'vex-theme-os';
            vex.dialog.buttons.YES.text = 'OK';
            vex.dialog.buttons.NO.text = 'CANCELAR';
            
            $(function() {
            	$(".phone").mask("(99) 99999-9999");
            	
            	$('.finalizar').click(function() {
            		var url = $(this).data('url');
            		vex.dialog.confirm({
            			message: 'Tem certeza que deseja finalizar esse ticket?',
            			callback: function (value) {
            				if (value) {
            					window.location = url;
            				}
            			}
            		});
            	});
            });
         </script>
         <script src="/Template/js/profile/app.js?v=22" type="58b24b72a19721981832dfee-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="58b24b72a19721981832dfee-|49" defer=""></script>
      </body>
   </html>