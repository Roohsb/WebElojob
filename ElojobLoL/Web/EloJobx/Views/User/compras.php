<?php
   $Filtro = false;
   if(isset($EloTools->NewGet($_SERVER['REQUEST_URI'])["filtro"])){
     $Filtro = $EloTools->NewGet($_SERVER['REQUEST_URI'])["filtro"];
   }

?>
<!DOCTYPE html>
<html class="no-js" lang="pt">
   <head>
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
               <h3>Gerenciar <strong>Minhas Compras</strong></h3>
            </div>
            <form action="/user/compras" method="get" class="form-horizontal form-bordered">
               <div class="form-group">
                
                  <div class="col-md-11">
                   
                     <p class="text-right">
                        Filtros:
                        <a href="/user/compras?filtro=aguardando"><span class="label label-warning">aguardando pagamento</span></a>
                        <a href="/user/compras?filtro=aprovado"><span class="label label-info">pagamento aprovado</span></a>
                        <a href="/user/compras?filtro=reclamacao"><span class="label label-danger">reclamação</span></a>
                        <a href="/user/compras?filtro=finalizado"><span class="label label-success">finalizado</span></a>
                        <a href="/user/compras?filtro=cancelado"><span class="label label-danger">cancelado</span></a>
                        <a href="/user/compras"><span class="label label-default">todos</span></a>
                     </p>
                  </div>
               </div>
               <div class="form-group form-actions">
                 
               </div>
            </form>
            <div class="modal fade" id="avaliar-trabalho" tabindex="-1" role="dialog" aria-labelledby="avaliar-trabalho" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <h4 class="modal-header text-center">Avalie o trabalho do Booster, do pedido : <strong id="avaliar-trabalho-id">XXX</strong></h4>
                     <div class="modal-body">
                        <form>
                           <div>
                              <div class="avaliacao-botoes">
                                 <div><img src="https://www.drupal.org/files/styles/grid-3-2x/public/project-images/like_and_dislike.png?itok=FY2rWYUo">
                                 </div>
                                 <div><img src="https://www.drupal.org/files/styles/grid-3-2x/public/project-images/like_and_dislike.png?itok=FY2rWYUo" class="negative">
                                 </div>
                              </div>
                           </div>
                           <fieldset>
                              <legend class="text-center">Deixe um comentario!</legend>
                              <div class="form-group">
                                 <div class="col-md-12">
                                    <textarea type="text" id="avaliar-trabalho-comentario" class="form-control" placeholder="Otimo trabalho..."></textarea>
                                 </div>
                              </div>
                           </fieldset>
                        </form>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary avalitar-trabalho">Avaliar</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="table-responsive">
               <table class="table table-vcenter table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Status</th>
                        <th class="text-center">Booster</th>
                        <th>Serviço</th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th style="width: 150px;" class="text-center">Ações</th>
                     </tr>
                  </thead>
                  <tbody>
                     <!-- <tr>
                        <td colspan="100%">Nenhum registro encontrado.</td>
                        </tr> -->
                    <?php
                    MyShoppingTable($Server,$EloTools,$Filtro);
                    ?>
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
           <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="ae339bd771247be74b5f6aec-text/javascript"></script>
      <script src="/Template/js/user/bootstrap.min.js" type="ae339bd771247be74b5f6aec-text/javascript"></script>
      <script src="/Template/js/user/plugins.js" type="ae339bd771247be74b5f6aec-text/javascript"></script>
      <script src="/Template/js/user/maskedinput.js" type="ae339bd771247be74b5f6aec-text/javascript"></script>
      <script src="/Template/js/user/vex.combined.min.js" type="ae339bd771247be74b5f6aec-text/javascript"></script>
      <script type="ae339bd771247be74b5f6aec-text/javascript">
         var base_url = 'http://localhost:81';
          vex.defaultOptions.className = 'vex-theme-os';
         vex.dialog.buttons.YES.text = 'OK';
         vex.dialog.buttons.NO.text = 'CANCELAR';

         $(".btn.btn-default.avaliar").click(function(e){
            $('#avaliar-trabalho').modal('show');
            if(e.target.attributes["data-pedido-avalaicao"] === ''){
               $('#avaliar-trabalho').modal('hide')
            }
            $("#avaliar-trabalho-id").text(e.target.attributes["data-pedido-avalaicao"].value)
         })


         $(".avaliacao-botoes > div").click(function(){
            $(".avaliacao-botoes > div.selected").removeClass('selected')
            $(this).addClass('selected');
         })

         $(".btn.btn-primary.avalitar-trabalho").click(function(){

            var pedido = parseInt($("#avaliar-trabalho-id").text())
            var mensagem = $("#avaliar-trabalho-comentario").val()
            var avaliacao = $(".avaliacao-botoes > div.selected > img").attr('class') === 'negative' ? 1 : 0

            if(mensagem.length < 1){
               return alert("Coloque uma mensagem antes de continuar")
            }
            if(typeof $(".avaliacao-botoes > div.selected > img").attr('src')  === 'undefined'){
               return alert("Antes de continuar, marque se voce gostou ou nao do trabalho")
            }
            if(isNaN(pedido)){
               return alert("Não é possivel avaliar o pedido")
            }


            $.ajax({
                url: base_url + '/api/comments/add',
                type: 'POST',
                dataType: 'json',
                data: {order: pedido, mensagem: mensagem, avaliacao: avaliacao},
                success: function(data) {
                   if(data.status){
                      $("a").find(`[data-pedido-avalaicao='${pedido}']`).remove()
                      $("#avaliar-trabalho-id").text('Aguardando')
                      return $('#avaliar-trabalho').modal('hide')
                   }
                   return alert('Não foi possivel avaliar, se o erro persisitir contate um responsavel')
                }
            });
         })

         $(function() {
         	$(".phone").mask("(99) 99999-9999");
         });
      </script>
      <script src="https://elojobhigh.com.br/app/assets/js/app.js" type="ae339bd771247be74b5f6aec-text/javascript"></script>
      <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="ae339bd771247be74b5f6aec-|49" defer=""></script>
      </body>
</html>