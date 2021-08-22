<?php

if(isset($URL[2])){
   $Profile = GetDateProfile($Server,$URL[2]);
   if($Profile[0] < 1){
      header("Location: /user/centro");
   }
   $Nome = $Profile[0]["nome"];
   $User = $Profile[0]["user"];
   $Banner = '<img src="/Template/imagens/profiles/banners/'.ImagesUser(2,$Profile[1]["banner"],$Server)["img"].'" alt="Capa" class="animation-pulseSlow">';
}else{
   $Profile = GetDateUser($Server);
   $Nome = $Profile[0]["nome"];
   $User = $Profile[0]["user"];
   $Banner = '<img src="/Template/imagens/profiles/banners/'.ImagesUser(2,$Profile[1]["banner"],$Server)["img"].'" alt="Capa" class="animation-pulseSlow">';
}
?>
<!DOCTYPE html>
   <html class="no-js" lang="pt">
   <?php 
   include 'EloJobx/Components/Head-User.php'; 
      echo '<body>
         <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZTSHM2"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
             <script> var usuario = '.$Profile[0]["id"].'</script>
            <div id="page-wrapper">
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">';
               include 'EloJobx/Components/Header-User.php'; 
              
               echo '<div id="page-content">
                  <div class="content-header content-header-media">
                     <div class="header-section">
                        <img src="/Template/imagens/profiles/avatar/'.ImagesUser(1,GetDateProfile($Server,$User)[1]["avatar"],$Server)["img"].'" alt="Lucifer" style="max-height: 100px;" class="pull-right img-circle">
                        <h3>';
                           echo $Nome;
                           echo '</br>
                           <small>'.$EloTools->NamesRanks($Profile[0]["level"]).'</small>
                        </h3>
                     </div>';
                       echo $Banner; 
                       ?>
                  </div>
                  <div class="row">
                     <div class="col-md-6 col-lg-7">
                        <div class="block">
                           <div class="block-title">
                              <div class="block-options pull-right"></div>
                              <h3 class="h3"><strong>Comentários</strong> Feitos (0)</h3>
                           </div>
                           <div class="block-content-full">
                              <ul class="media-list media-feed media-feed-hover" id="comentarios" style="margin-top: 40px;"></ul>
                              <p class="text-center" id="paginacao" style="margin-top: 10px;">
                                 <a href="javascript:void(0)" class="btn btn-xs btn-default push">Carregar mais...</a>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-5">
                        <div class="block">
                           <div class="block-title">
                              <div class="block-options pull-right"></div>
                              <h3>Sobre</h3>
                           </div>
                           <table class="table table-borderless table-striped">
                           <?php
                              echo '<tbody>
                                 <tr>
                                    <td><strong>Nome</strong></td>
                                    <td>'.$Nome.'</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Usuário</strong></td>
                                    <td>'.$User.'</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Serviços</strong></td>
                                    <td>
                                       <span class="label label-success">positivos ('.$Profile[0]["likes"].')</span>
                                       <span class="label label-danger">negativos ('.$Profile[0]["deslike"].')</span>
                                    </td>
                                 </tr>
                              </tbody>'; ?>
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
         <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="a0b273d856fadc63ee7ba7ca-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/vendor/bootstrap.min.js" type="a0b273d856fadc63ee7ba7ca-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/plugins.js" type="a0b273d856fadc63ee7ba7ca-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/vex/js/vex.combined.min.js" type="a0b273d856fadc63ee7ba7ca-text/javascript"></script>
         <script src="https://elojobhigh.com.br/app/assets/js/maskmoney.js" type="a0b273d856fadc63ee7ba7ca-text/javascript"></script>
         <script type="a0b273d856fadc63ee7ba7ca-text/javascript">
            var base_url = 'http://localhost:81';
             vex.defaultOptions.className = 'vex-theme-os';
            vex.dialog.buttons.YES.text = 'OK';
            vex.dialog.buttons.NO.text = 'CANCELAR';
            var countComents = 0;

            function comentarios(paginacao = 0, limpar = 1) {
            	$.ajax({
            		url: base_url+'/api/comments',
            		type: 'POST',
            		dataType: 'json',
            		data: 'usuario='+usuario+'&paginacao=' + paginacao,
            		beforeSend: function() {
            			if(limpar) {
            				$('#comentarios').html('<li class="text-center">carregando...</li>');
            			}
            		}, 
            		success: function(data) {
            			if(limpar) {
            				$('#comentarios').html('');
            			}
            			var qtdItens = 0;
            			$.each(data, function(id, comentario) {
                        ///console.log(id)
                        var avaliacao = comentario.avaliacao === '0' ? "Avaliação Positiva": "Avaliação Negativa"
            				var html = '<li class="media">' +
            					'<a href="/user/perfil/'+comentario.usuario+'" title="'+comentario.usuario+'" class="pull-left text-center">' +
            						'<img src="/Template/imagens/profiles/avatar/'+ comentario.avatar +'" alt="' + comentario.nome +' " style="max-height: 50px;" class="img-circle">' +
            					'</a>' +
            					'<div class="media-body">' +
            						'<p class="push-bit">' +
            							'<span class="text-muted pull-right">' +
            								'<small> '+ comentario.date +' </small>' +
            							'</span>' +
            							'<strong><a href="/user/perfil/'+comentario.usuario+'" title=" '+ comentario.nome +' "> '+comentario.nome+'</a></strong>' +
            							'<p>' + avaliacao + '</p>' +
            						'</p>' +
            						'<p> '+ comentario.mensagem +' </p>' +
            					'</div>' +
            				'</li>';
            				$('#comentarios').append(html);
            				qtdItens++;
                        countComents++;
            			});
            			if(qtdItens >= 3) {
            				$('#paginacao').html('<a href="javascript:void(0)" onclick="comentarios(' + (paginacao+1) + ', 0);" class="btn btn-xs btn-default push">Carregar mais...</a>');
            			} else {
            				$('#paginacao').html('');
            			}
            			if(qtdItens == 0 && $('#comentarios').html() == '') {
            				$('#comentarios').html('<li class="text-center">Nenhum registro encontrado.</li>');
            			}
                     $(".block-title > h3.h3").html("<strong>Comentários</strong> Feitos ("+countComents+")")
            		}
            	});
            }
            
            $(function() {
            	$(".phone").mask("(99) 99999-9999");
            	
            	comentarios();
            })
         </script>
         <script src="/Template/js/profile/app.js?v=22"  type="a0b273d856fadc63ee7ba7ca-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="a0b273d856fadc63ee7ba7ca-|49" defer=""></script>
      </body>
   </html>