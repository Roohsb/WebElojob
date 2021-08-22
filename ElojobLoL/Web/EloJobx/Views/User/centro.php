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
                     <div class="content-header content-header-media">
                        <div class="header-section">
                           <div class="row">
                              <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                                 <h3>Olá, <strong><?php echo GetDateUser($Server)[0]["nome"]; ?></strong></h3>
                              </div>
                           </div>
                        </div>
                       <?php 
                       echo '<img src="/Template/imagens/profiles/banners/'.ImagesUser(2,GetDateUser($Server)[1]["banner"],$Server)["img"].'" alt="Capa" class="animation-pulseSlow">'; 
                       ?>
                     </div>
                   <!-- <div class="alert alert-warning">
                        <h4><i class="fa fa-exclamation-circle"></i> Aviso - endereço de e-mail não confirmado!</h4>
                        A sua conta ainda não foi confirmada, acesse o seu e-mail e verifique a caixa de entrada ou a caixa de spam. Confirme a sua conta para a sua segurança! <a href="https://elojobhigh.com.br/app/cliente/reenviaremail" class="alert-link">Reenviar e-mail de confirmação</a>!
                     </div> -->
                     <div class="block">
                        <div class="block-title">
                           <h3>Últimos <strong>Avisos</strong></h3>
                           <small><a href="/user/atualizacoes"><strong>Visualizar Todos</strong></a></small>
                        </div>
                        <div class="table-responsive">
                           <table class="table table-vcenter table-striped">
                              <thead>
                                 <tr>
                                    <th class="text-center">Administrador</th>
                                    <th>Título</th>
                                    <th>Data</th>
                                    <th style="width: 150px;" class="text-center">Ações</th>
                                 </tr>
                              </thead>
                              <tbody>
                           <?php 
                           NoticesHome($Server);
                           ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="block">
                              <div class="block-title">
                                 <h3>Chat's <strong>Não Lidos</strong></h3>
                              </div>
                              <div class="table-responsive">
                                 <table class="table table-vcenter table-striped" id="chats">
                                    <thead>
                                       <tr>
                                          <th>Título</th>
                                          <th style="width: 150px;" class="text-center">Ações</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td colspan="100%">
                                             <img src="https://elojobhigh.com.br/app/assets/imagens/preloader.gif" height="15" alt="carregando..." /> carregando...
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="block">
                        <div class="block-title">
                           <h3>Últimas <strong>Compras</strong></h3>
                           <small><a href="/user/compras"><strong>Visualizar Todos</strong></a></small>
                        </div>
                        <div class="table-responsive">
                           <table class="table table-vcenter table-striped">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th class="text-center">Booster</th>
                                    <th>Serviço</th>
                                    <th>Compra</th>
                                    <th>Valor</th>
                                    <th>Finalizado</th>
                                    <th style="width: 150px;" class="text-center">Ações</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php
                              
                              MyShoppingTableHome($Server,$EloTools,null);
                                 //<tr>
                                   // <td colspan="100%">Nenhum registro encontrado.</td>
                                 //</tr> ?>
                              </tbody>
                           </table>
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
         <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script src="/Template/js/user/bootstrap.min.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script src="/Template/js/user/plugins.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script src="/Template/js/user/maskedinput.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script src="/Template/js/user/ion.sound.min.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script src="/Template/js/user/vex.combined.min.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script type="86d7530037d1dd452fe77e2e-text/javascript">
            var base_url = 'http://localhost:81';
            vex.defaultOptions.className = 'vex-theme-os';
            vex.dialog.buttons.YES.text = 'OK';
            vex.dialog.buttons.NO.text = 'CANCELAR';
            

            var carregando = '<img src="https://elojobhigh.com.br/app/assets/imagens/preloader.gif" height="15" alt="carregando..." /> carregando...';
            
            var lista_chats = new Array();
            

            function carregarChats(som = 0) {
            	$.ajax({
            		url: base_url+'/api/chat/procurar',
            		type: 'GET',
            		dataType: 'json',
            		beforeSend: function() {
            			// $('#chats tbody').html('<tr><td colspan="100%">' + carregando + '</td></tr>');
            		}, 
            		success: function(data) {
            			if(data.data.length == 0) {
            				$('#chats tbody').html('<tr><td colspan="100%">Nenhuma nova mensagem encontrada.</td></tr>');
            			} else {
                        var html = '';
                        for(var mensagem of data.data){
                           html += '<tr>' +
            						'<td>' + mensagem.mensagem + '</td>' +
                              '<td>' + mensagem.order + '</td>' +
                              '<td>' + mensagem.data + '</td>' +
            						'<td class="text-center"><a href="/user/compra/'+mensagem.order+'/chat">Chat</a></td>' +
            					'</tr>';
                        }
            				
                        console.log(data.data)
            				$('#chats tbody').html(html);
            				
            			}
            		}
            	});
            }
            
            $(function() {
            
            	
            	carregarChats();
            	
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
            	

            	
            	setInterval(function(){ carregarChats('1'); }, 60000);
            });
         </script>
         <script src="/Template/js/profile/app.js?v=22" type="86d7530037d1dd452fe77e2e-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="86d7530037d1dd452fe77e2e-|49" defer=""></script>
      </body>
   </html>