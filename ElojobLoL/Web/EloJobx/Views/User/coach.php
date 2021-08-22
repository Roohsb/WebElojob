<?php
if(!isset($URL[2]) || $URL[2] != 'contratar'){
   header("Location: /saguao");
   exit;
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
   if(!isset($_POST["curso"],$_POST["aulas"]) && (!is_numeric($_POST["aulas"]))){
      header("Location: /saguao");
      exit;
   }
}


if($_SERVER["REQUEST_METHOD"] != "POST"){
   if(!isset($_SESSION["COACHAlert"])){
      header("Location: /saguao");
      exit;
   }
}

echo '<!DOCTYPE html>
<html class="no-js" lang="pt">
   <head>
      <meta charset="utf-8">
      <title>LorenJob - Comprar > Coach</title>
      <meta name="description" content="A maneira mais fácil e rápida de subir de ELO! Adquira já o seu serviço conosco!">
      <meta name="author" content="CastroMS">
      <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
      <link rel="shortcut icon" href="http://localhost:81/Template/imagens/logo_w.png">
      <link rel="stylesheet" href="/Template/css/user/bootstrap.min.css">
      <link rel="stylesheet" href="/Template/css/user/plugins.css">
      <link href="/Template/css/user/vex.css" rel="stylesheet" />
      <link href="/Template/css/user/vex-theme-os.css" rel="stylesheet" />
      <link rel="stylesheet" href="/Template/css/user/main.css">
      <link id="theme-link" rel="stylesheet" href="/Template/css/themes/'.GetDateUser($Server)[1]['thema'].'.css">
      <link rel="stylesheet" href="/Template/css/user/themes.css">
      <link rel="stylesheet" href="https://elojobhigh.com.br/app/assets/select2/css/select2-bootstrap.min.css">
      <script src="https://elojobhigh.com.br/app/assets/js/vendor/modernizr.min.js" type="0e6b3505e99ef04ad7e3c5ed-text/javascript"></script>
      <style type="text/css">
         #box_campeoesespecificos ul{margin:0;padding:0;display:flex;flex-wrap:wrap;justify-content:center}#box_campeoesespecificos ul li{display:none;height:40px;width:40px;filter:grayscale(100%);transition:all .2s;cursor:pointer;border:2px solid #ddd;margin-right:2px;margin-left:2px;margin-bottom:2px;margin-top:2px;list-style:none;float:left}#box_campeoesespecificos ul li.mostrar{display:block!important}#box_campeoesespecificos ul li.selecionado{border:2px solid #2896c8;filter:grayscale(0)}#box_campeoesespecificos ul li img{width:40px;height:auto;max-width:100%}
         #box_maestria table{width:100%}#box_maestria table thead tr th{padding:5px 0}#box_maestria table tbody tr{border:1px dashed #fff;margin-bottom:2px}#box_maestria table tbody tr td{padding:3px 5px}#box_maestria table tbody tr td img{width:40px;height:auto;max-width:100%;border:2px solid #ddd}
      </style>
   </head>
   <body>
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZTSHM2"
         height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
         <script>var total = '. $_SESSION["CoachDetails"]["Valor"].';</script>
      <div id="page-wrapper">
         <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">';
         include 'EloJobx/Components/Header-User.php';
               echo '<div id="page-content">
                  <div class="block">
                     <div class="block-title">
                        <h3>Serviço <strong>Coach</strong></h3>
                     </div>
                     <form action="/api/purchase-coach" method="post" class="form-horizontal form-bordered">
                        <div class="form-group">
                           <div class="col-md-12">
                              <h3><i class="gi gi-edit"></i> Serviço</h3>
                              <p style="margin: 0 0 15px 0;"><strong>Este é o serviço que deseja contratar, certifique-se que está corretamente preenchido.</strong></p>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="modocoach">Modo do Coach</label>
                                    <select name="modocoach" disabled="disabled" id="modocoach" class="form-control">
                                       <option value="leagueoflegends" selected="selected">League Of Legends</option>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="curso">Nível de Curso</label>
                                    <select name="curso" disabled="disabled" id="curso" class="form-control">';
                                    if($_POST["curso"] == 'iniciante'){
                                       echo '<option value="iniciante" selected="selected">Iniciante (Bronze - Prata)</option>';
                                    }else if($_POST["curso"] == 'intermediario'){
                                       echo ' <option value="intermediario" selected="selected">Intermediário (Ouro - Platina)</option>';
                                    }else{
                                       echo ' <option value="experiente" selected="selected">Experiente (Diamante - Mestre)</option>';
                                    }
                                    echo '</select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="qtdaulas">Quantidade de Aulas</label>
                                    <select name="qtdaulas" disabled="disabled" id="qtdaulas" class="form-control">
                                    <option value="'.$_POST["aulas"].'" selected="selected">'.$_POST["aulas"].' Aulas</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <h3><i class="gi gi-keys"></i> Dados da Conta</h3>';
                              if(isset($_SESSION["COACHAlert"])){
                                 echo '<p style="text-align: center; color: red;">'.$_SESSION["COACHAlert"].'</p>';
                                 unset($_SESSION["COACHAlert"]);
                              }
                              echo '<div class="form-group">
                                 <label for="invocador">Invocador</label>
                                 <input type="text" name="invocador" value="" id="invocador" class="form-control" placeholder="Seu nome dentro do jogo">
                              </div>
                           </div>
                           <div class="col-md-12">
                              <h3><i class="gi gi-plus"></i> Adicionais</h3>
                              <p style="margin: 0;"><strong>Abaixo, você adicionará informações adicionais para o seu serviço, assim encontraremos o profissional certo para executar o seu serviço!</strong></p>
                              <p style="margin: 0 0 15px 0;"><strong>Selecione com atenção, pois uma vez finalizado o pedido, não é possível alteração, adição e a remoção dos adicionais.</strong></p>
                              <div class="col-md-6">
                                 <div id="box_rota" class="themed-background text-light " style="margin-bottom:5px; padding: 10px;">
                                    <div class="form-group">
                                       <label class="control-label">Rota</label>
                                       <div>
                                          <table class="table table-striped">
                                             <tr class="themed-color-dark">
                                                <td align="center">
                                                   <img src="https://elojobhigh.com.br/app/assets/imagens/lane-top.png" style="max-height: 25px;" alt="TOP"> TOP
                                                </td>
                                                <td align="center">
                                                   <img src="https://elojobhigh.com.br/app/assets/imagens/lane-jungle.png" style="max-height: 25px;" alt="JNG"> JNG
                                                </td>
                                                <td align="center">
                                                   <img src="https://elojobhigh.com.br/app/assets/imagens/lane-mid.png" style="max-height: 25px;" alt="MID"> MID
                                                </td>
                                                <td align="center">
                                                   <img src="https://elojobhigh.com.br/app/assets/imagens/lane-adc.png" style="max-height: 25px;" alt="ADC"> ADC
                                                </td>
                                                <td align="center">
                                                   <img src="https://elojobhigh.com.br/app/assets/imagens/lane-support.png" style="max-height: 25px;" alt="SUP"> SUP
                                                </td>
                                             </tr>
                                             <tr>
                                                <td align="center">
                                                   <input type="radio" name="rota" value="top">
                                                </td>
                                                <td align="center">
                                                   <input type="radio" name="rota" value="jng">
                                                </td>
                                                <td align="center">
                                                   <input type="radio" name="rota" value="mid" checked="checked">
                                                </td>
                                                <td align="center">
                                                   <input type="radio" name="rota" value="adc">
                                                </td>
                                                <td align="center">
                                                   <input type="radio" name="rota" value="sup">
                                                </td>
                                             </tr>
                                          </table>
                                       </div>
                                    </div>
                                    <p style="margin: 0;">Selecione a rota em que você joga.</p>
                                 </div>
                                 <div id="box_diasdisponiveis" class="themed-background text-light" style="padding: 10px;">
                                    <div class="form-group">
                                       <label class="control-label">Dias Disponíveis</label>
                                       <div>
                                          <div class="checkbox-inline" style="margin-left: 10px;">
                                             <label for="dias-segunda">
                                             <input type="checkbox" name="dias[]" id="dias-segunda" value="segunda-feira"> Segunda-feira
                                             </label>
                                          </div>
                                          <div class="checkbox-inline">
                                             <label for="dias-terca">
                                             <input type="checkbox" name="dias[]" id="dias-terca" value="terca-feira"> Terça-feira
                                             </label>
                                          </div>
                                          <div class="checkbox-inline">
                                             <label for="dias-quarta">
                                             <input type="checkbox" name="dias[]" id="dias-quarta" value="quarta-feira"> Quarta-feira
                                             </label>
                                          </div>
                                          <div class="checkbox-inline">
                                             <label for="dias-quinta">
                                             <input type="checkbox" name="dias[]" id="dias-quinta" value="quinta-feira"> Quinta-feira
                                             </label>
                                          </div>
                                          <div class="checkbox-inline">
                                             <label for="dias-sexta">
                                             <input type="checkbox" name="dias[]" id="dias-sexta" value="sexta-feira"> Sexta-feira
                                             </label>
                                          </div>
                                          <div class="checkbox-inline">
                                             <label for="dias-sabado">
                                             <input type="checkbox" name="dias[]" id="dias-sabado" value="sabado"> Sábado
                                             </label>
                                          </div>
                                          <div class="checkbox-inline">
                                             <label for="dias-domingo">
                                             <input type="checkbox" name="dias[]" id="dias-domingo" value="domingo"> Domingo
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                    <p style="margin: 0;">Selecione os dias que você estará disponível.</p>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div id="box_horariosdisponiveis" class="themed-background text-light" style="padding: 10px;">
                                    <div class="form-group">
                                       <label class="control-label">Horários Disponíveis</label>
                                       <div>
                                          <textarea name="horarios" rows="3" class="form-control" placeholder=""></textarea>
                                       </div>
                                    </div>
                                    <p style="margin: 0;">Digite aqui, de forma clara, os horários que você estará disponível.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <h3><i class="gi gi-cogwheel"></i> Extras</h3>
                              <p style="margin: 0;"><strong>Abaixo, você poderá adicionar configurações adicionais e personalizar seu serviço, totalmente customizável. Nós fazemos do seu jeito!</strong></p>
                              <p style="margin: 0 0 15px 0;"><strong>Selecione com atenção, pois uma vez finalizado o pedido, não é possível alteração, adição e a remoção de extras.</strong></p>
                              <div class=""></div>
                              <div class="col-md-6">
                                 <label class="checkbox-inline" for="boosterfavorito">
                                 <input type="checkbox" id="boosterfavorito" name="boosterfavorito" value="1" class="extras" data-porcentagem="15"> Booster Favorito (+ 15%) </label>
                                 <p>
                                    <small>Desejo escolher meu booster favorito</small>
                                 </p>
                                 <div id="box_boosterfavorito" class="themed-background text-light display-none" style="padding: 10px;">
                                    <p style="margin: 0; margin-bottom: 10px;">Com esta opção selecionada, você poderá escolher um booster específico para realizar seu serviço. nota: se o booster escolhido estiver realizando outro serviço, este tem prioridade, logo após será iniciado o seu serviço.</p>
                                    <select name="boosterfavorito_booster" id="boosterfavorito_booster" class="form-control select2">'; 
                                    Boosters($Server);
                                    ?>
                                  
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4 col-md-offset-8 text-right">
                              <div class="form-group">
                                 <label for="cupom">Cupom de Desconto</label>
                                 <input type="text" name="cupom" value="" id="cupom" class="form-control" placeholder="Informe o seu cupom de desconto!">
                                 <a href="javascript:void(0);" onclick="if (!window.__cfRLUnblockHandlers) return false; aplicarCupom();" id="aplicarcupom" class="btn btn-default" data-cf-modified-0e6b3505e99ef04ad7e3c5ed-="">Aplicar</a>
                                 <a href="javascript:void(0);" onclick="if (!window.__cfRLUnblockHandlers) return false; removerCupom();" id="removercupom" class="btn btn-default hide" data-cf-modified-0e6b3505e99ef04ad7e3c5ed-="">Remover</a>
                                 <div id="resultadodesconto"></div>
                              </div>
                           </div>
                           <div class="col-md-12 text-right" style="margin: 20px 0;">
                              <div><?php
                                 echo '<p style="margin: 0;"><strong>Subtotal</strong></p>
                                 <h4 style="margin: 0; text-decoration: line-through;" id="subtotal" class="hide" data-total="'.$_SESSION["CoachDetails"]["Valor"].'">R$ 0</h4>
                                 <h1 style="margin: 0;" id="subtotaldesconto" data-total="'.$_SESSION["CoachDetails"]["Valor"].'">R$ 0</h1>'; ?>
                              </div>
                           </div>
                           <div class="form-group form-actions text-right">
                              <div class="col-md-12">
                                 <button type="submit" name="submit" value="1" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Comprar</button>
                              </div>
                           </div>
                        </div>
                     </form>
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
      <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="0e6b3505e99ef04ad7e3c5ed-text/javascript"></script>
      <script src="https://elojobhigh.com.br/app/assets/js/vendor/bootstrap.min.js" type="0e6b3505e99ef04ad7e3c5ed-text/javascript"></script>
      <script src="/Template/js/user/plugins.js" type="0e6b3505e99ef04ad7e3c5ed-text/javascript"></script>
      <script src="/Template/js/user/maskedinput.js" type="0e6b3505e99ef04ad7e3c5ed-text/javascript"></script>
      <script src="/Template/js/dinheiro.js" type="0e6b3505e99ef04ad7e3c5ed-text/javascript"></script>
      <script src="https://elojobhigh.com.br/app/assets/vex/js/vex.combined.min.js" type="0e6b3505e99ef04ad7e3c5ed-text/javascript"></script>
      <script src="https://elojobhigh.com.br/app/assets/select2/js/i18n/pt-BR.js" type="0e6b3505e99ef04ad7e3c5ed-text/javascript"></script>
      <script type="0e6b3505e99ef04ad7e3c5ed-text/javascript">
         var base_url = 'http://localhost:81';
         var descontoTipo = 0;
         var descontoValor = 0;
         vex.defaultOptions.className = 'vex-theme-os';
         vex.dialog.buttons.YES.text = 'OK';
         vex.dialog.buttons.NO.text = 'CANCELAR';
         
         		
         function aplicarCupom() {
            	descontoTipo = 0;
            	descontoValor = 0;
            	$('#subtotal').addClass('hide');
            	calculaSubTotal();
            	$('#resultadodesconto').html('');
            	
            	$.ajax({
            		url: '/api/use-cupom',
            		type: 'POST',
            		dataType: 'json',
            		data: 'cupom=' + $('#cupom').val(),
            		beforeSend: function() {
            			$('#resultadodesconto').html('<p class="text-info">carregando...</p>');
            		},
            		success: function(data) {
            			if(data.status) {
            				if(data.type == 0) {
            					$('#resultadodesconto').html('<p class="text-success">O seu cupom de ' + data.desconto + '% foi aplicado com sucesso.</p>');
            					descontoTipo = 1;
            					descontoValor = data.desconto;
            				} else {
            					$('#resultadodesconto').html('<p class="text-success">O seu cupom de R$ ' + formatMoneyBR(data.desconto) + ' foi aplicado com sucesso.</p>');
            					descontoTipo = 0;
            					descontoValor = data.desconto;
            				}
            				
            				$('#subtotal').removeClass('hide');
            				
            				calculaSubTotal();
            				
            				$('#cupom').attr('readonly', true);
            				$('#aplicarcupom').addClass('hide');
            				$('#removercupom').removeClass('hide');
            			} else {
            				$('#resultadodesconto').html('<p class="text-danger">' + data.mensagem + '</p>');
            			}
            		}
            	});
            }
         
         function removerCupom() {
         	descontoTipo = 0;
         	descontoValor = 0;
         	$('#subtotal').addClass('hide');
         	calculaSubTotal();
         	$('#resultadodesconto').html('');
         	$('#cupom').val('').attr('readonly', false);
         	$('#removercupom').addClass('hide');
         	$('#aplicarcupom').removeClass('hide');
         }
         
         function calculaSubTotal() {
         	var porcentagemTotal = 0;
         	var dinheiroTotal = 0;
         	$('.extras').each(function(index, data) {
         		if($(this).prop('checked')) {
         			var porcentagem = $(this).data('porcentagem');
         			porcentagemTotal += porcentagem;
         			
         			if($(this).attr('name') == "maestria") {
         				$('#box_maestria table tbody tr').each(function(index_maestria, data_maestria) {
         					dinheiroTotal += parseFloat($(this).data('preco'));
         				});
         			}
         		}
         		if(index == $('.extras').length - 1) {
         			var totalPorcentagem = parseFloat(total * (porcentagemTotal/100));
         			var totalAtualizado = (total + (totalPorcentagem + dinheiroTotal));
         			
         			if(descontoTipo == '0') {
         				var totalDesconto = descontoValor;
         			} else {
         				var totalDesconto = parseFloat(totalAtualizado * (descontoValor/100));
         			}
         			
         			var totalDescontoAtualizado = (totalAtualizado - totalDesconto);
         			
         			$('#subtotal').html('R$ ' + formatMoneyBR(totalAtualizado));
         			$('#subtotaldesconto').html('R$ ' + formatMoneyBR(totalDescontoAtualizado));
         		}
         	});
         	
         	if($('.extras').length == 0) {
         		if(descontoTipo == '0') {
         			var totalDesconto = descontoValor;
         		} else {
         			var totalDesconto = parseFloat(total * (descontoValor/100));
         		}
         		
         		var totalDescontoAtualizado = (total - totalDesconto);
         		$('#subtotaldesconto').html('R$ ' + formatMoneyBR(totalDescontoAtualizado));
         	}
         }
         
         function filtrarCampeoes() {
         	var input = $("#pesquisar");
         	var string = input.val().toLowerCase().trim();
         	$("#box_campeoesespecificos ul li").each(function(){
         		var championName = $(this).attr("data-title").toLowerCase().trim();
         		if (championName.indexOf(string) >= 0){
         			if(!$(this).hasClass("mostrar")) $(this).addClass("mostrar");
         		} else {
         			$(this).removeClass("mostrar");
         		}
         	});
         }
         
         $(function() {
         	$(".phone").mask("(99) 99999-9999");
         	
         	$('.select2').select2({
         		language: 'pt-BR',
         		theme: 'bootstrap',
         		width: '100%'
         	});
         	
         	calculaSubTotal();
         	
         	$('#escolhaconta').change(function() {
         		if($(this).val() == 'adicionarconta') {
         			$('#box_contaexistente').hide();
         			$('#box_adicionarconta').show();
         		} else {
         			$('#box_adicionarconta').hide();
         			$('#box_contaexistente').show();
         		}
         	});
         	
         	$('#modocoach').change(function() {
         		if($(this).val() == 'teamfighttactics') {
         			$('#box_rota').hide();
         		} else {
         			$('#box_rota').show();
         		}
         	});
         	
         	$("#box_campeoesespecificos #pesquisar").on("input", function(){
         		filtrarCampeoes();
         	});
         	
         	$("#box_campeoesespecificos ul").on("click", "li", function(){
         		var championCheckbox = $(this).find("input[type=checkbox]");
         		if($(this).hasClass('selecionado')) {
         			$(this).removeClass("selecionado");
         			championCheckbox.attr('checked', false);
         		} else {
         			$(this).addClass("selecionado");
         			championCheckbox.attr('checked', true);
         		}
         	});
         	
         	var maestria_fila = "0";
         	$("#add-maestria").click(function() {
         		var campeao_id = $("#maestria_campeao option:selected").val(), 
         		campeao_nome = $("#maestria_campeao option:selected").data('nome'),
         		campeao_avatar = $("#maestria_campeao option:selected").data('avatar');
         		
         		var maestria_id = $("#maestria_maestria option:selected").val(),
         		maestria_nome = $("#maestria_maestria option:selected").data('nome'),
         		maestria_preco = $("#maestria_maestria option:selected").data('preco')
         		
         		if(campeao_id == '') {
         			vex.dialog.alert({
         				unsafeMessage: 'Selecione um campeão para adicionar a maestria.'
         			});
         		} else if(maestria_id == '') {
         			vex.dialog.alert({
         				unsafeMessage: 'Selecione uma maestria para adicionar ao campeão.'
         			});
         		} else if($("#box_maestria table tbody tr[data-campeao='" + campeao_id + "'][data-maestria='" + maestria_id + "']").html() != undefined) {
         			vex.dialog.alert({
         				unsafeMessage: 'Você já adicionou essa maestria para esse campeão.'
         			});
         		} else {
         			var html = '<tr class="bg-primary" data-campeao="' + campeao_id + '" data-maestria="' + maestria_id + '" data-preco="' + maestria_preco + '">' +
         			'	<td>' +
         			'		<img src="' + campeao_avatar + '" alt="' + campeao_nome + '"> ' + campeao_nome +
         			'	</td>' +
         			'	<td>' + maestria_nome + '</td>' +
         			'	<td>' + formatMoneyBR(maestria_preco) + '</td>' +
         			'	<td>' +
         			'		<div class="btn-group btn-group-xs">' +
         			'			<input type="hidden" name="maestrias[' + campeao_id + '-' + maestria_id + '][campeoes][id]" value="' + campeao_id + '">' +
         			'			<input type="hidden" name="maestrias[' + campeao_id + '-' + maestria_id + '][campeoes][nome]" value="' + campeao_nome + '">' +
         			'			<input type="hidden" name="maestrias[' + campeao_id + '-' + maestria_id + '][campeoes][avatar]" value="' + campeao_avatar + '">' +
         			'			<input type="hidden" name="maestrias[' + campeao_id + '-' + maestria_id + '][maestrias][id]" value="' + maestria_id + '">' +
         			'			<input type="hidden" name="maestrias[' + campeao_id + '-' + maestria_id + '][maestrias][nome]" value="' + maestria_nome + '">' +
         			'			<input type="hidden" name="maestrias[' + campeao_id + '-' + maestria_id + '][maestrias][preco]" value="' + maestria_preco + '">' +
         			'			<a href="javascript:void();" data-toggle="tooltip" title="Remover" class="btn btn-danger remove-maestria"><i class="fa fa-trash"></i></a></a>' +
         			'		</div>' +
         			'	</td>' +
         			'</tr>';
         			
         			if(maestria_fila == 0) {
         				$("#box_maestria table tbody tr").fadeOut('slow', function() {
         					$(this).remove();
         				});
         			}
         			
         			$("#box_maestria table tbody").append($(html).hide().fadeIn('slow'));
         			$(".remove-maestria").tooltip();
         			
         			calculaSubTotal();
         			
         			maestria_fila++;
         		}
         	});
         	
         	$('#box_maestria table tbody').on('click', '.remove-maestria', function() {
         		var campeao_id = $(this).parent().parent().parent().data('campeao'),
         		maestria_id = $(this).parent().parent().parent().data('maestria');
         		
         		if($("#box_maestria table tbody tr[data-campeao='" + campeao_id + "'][data-maestria='" + maestria_id + "']").html() != undefined) {
         			$(this).parent().parent().parent().data('campeao', 0);
         			$(this).parent().parent().parent().data('maestria', 0);
         			
         			$(this).parent().parent().parent().fadeOut('slow', function() {
         				$(this).remove();
         				calculaSubTotal();
         			});
         			
         			if(maestria_fila == 1) {
         				var html = '<tr class="bg-primary" data-preco="0">' +
         				'	<td colspan="100%">' +
         				'		<p style="margin:10px 2px;">Nenhum registro encontrado.</p>' +
         				'	</td>' +
         				'</tr>';
         				$("#box_maestria table tbody").append($(html).hide().fadeIn('slow'));
         			}
         			
         			if(maestria_fila > 0) {
         				maestria_fila--;
         			}
         		}
         	});
         	
         	$('.extras').click(function() {
         		var idBox = '#box_' + $(this).attr('id');
         		
         		if($(this).attr('id') == 'superrestricao') {
         			if($(this).prop('checked')) {
         				$('#aviso10campeoes').hide();
         			} else {
         				$('#aviso10campeoes').show();
         			}
         		}
         		
         		if($(this).attr('id') == 'maestria' && !$('#campeoesespecificos').is(':checked')) {
         			vex.dialog.alert({
         				unsafeMessage: 'Para ativar o extra de maestria é obrigatório a ativação do extra campeões específicos.'
         			});
         			return false;
         		} else if($(this).attr('id') == 'campeoesespecificos' && $('#maestria').is(':checked')) {
         			if(!$(this).prop('checked')) {
         				$("#maestria").prop('checked', false);
         				$("#box_maestria").hide();
         			}
         		}
         		
         		if ($(idBox).length) {
         			if($(this).prop('checked')) {
         				$(idBox).show();
         			} else {
         				$(idBox).hide();
         			}
         		}
         		calculaSubTotal();
         	});
         });
      </script>
      <script src="https://elojobhigh.com.br/app/assets/js/app.js" type="0e6b3505e99ef04ad7e3c5ed-text/javascript"></script>
      <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="0e6b3505e99ef04ad7e3c5ed-|49" defer=""></script>
   </body>
</html>