<?php
if (!isset($URL[2], $URL[3]) || $URL[2] != 'compra' || !is_numeric($URL[3]))
{
    header("Location: /user/centro");
    exit;
}

$Order = searchOrder($Server, $_SESSION["Usuario"], $URL[3]);
if (!$Order)
{
    header("Location: /user/centro");
    exit;
}

if($Order["payment"] == 2)
{
   header("Location: /user/centro");
   exit;
}

$Token = CheckToken($Server,$URL[3],$EloTools);

$Arrays = json_decode($Order["data"]);

$elocrypt = new EloEncry();



if(!isset($_SESSION["ORDER:".$URL[3]])){
   $elocrypt->_updatetoken($URL[3]);
}else{
   $obj = json_decode($elocrypt->_decry($_SESSION["ORDER:".$URL[3]]));
        if(date("Y-m-d H:i:s") > $obj->data){ 
         $elocrypt->_updatetoken($URL[3]);
        }
}
//echo 'encry: '.$elocrypt->_hash($_SESSION["Usuario"],date("Y-m-d h:i:s"), $URL[3]);
//echo $elocrypt->_decry("rxFKR2eLm06q27bjxXHZfOJeyJvcmRlciI6IDc3LCAidXNlcrk2QhzJEkmvIicmQ118GD2aiI6ICJjYXJsb3NpbmhhZGFqYW6pixELJfC3dZc6MT1R8XKmtNhMTIzNCIsICJleHAiOiAiMjAojlgDcNclPfdDaCdnoCNnVAyMS0wNi0xMSAxMjozMjoyMiJ9");



if (isset($Arrays->Curso))
{
    $Detalhes = ["COACH", "$Arrays->Curso / $Arrays->Aulas DIAS DE AULA"];
}
else if (isset($Arrays->Servico) && $Arrays->Servico == 'MD10')
{
    $Detalhes = ["MD 10", ' ' . strtoupper($Arrays->Fila) . ' / <img src="/Template/imagens/badges/' . $EloTools->ElosImg($Arrays->Temporada, 'I', 'imagem') . '.png" style="max-height: 30px;"> ' . strtoupper($Arrays->Temporada) . ' ' . $Arrays
        ->Detalhes->divisao . ' / ' . $Arrays->Aulas . ' PARTIDAS'];
}
else
{
    $Detalhes = ["DUOBOOST", '' . strtoupper($Arrays->Fila) . ' / <img src="/Template/imagens/badges/' . $EloTools->ElosImg($Arrays->EloSelecionado, $Arrays->DivisaoSelecionada, 'imagem') . '.png" style="max-height: 30px;">
' . $EloTools->ElosImg($Arrays->EloSelecionado, $Arrays->DivisaoSelecionada, 'nome') . ' / 
 <img src="/Template/imagens/badges/' . $EloTools->ElosImg($Arrays->EloDesejado, $Arrays->DivisaoDesejada, 'imagem') . '.png" data-toggle="tooltip" style="max-height: 30px;">' . $EloTools->ElosImg($Arrays->EloDesejado, $Arrays->DivisaoDesejada, 'nome') . ''];
}
?>

<!DOCTYPE html>
   <html class="no-js" lang="pt">
   <?php 
      include 'EloJobx/Components/Head-User.php'; 
      echo '<body>
         <div id="page-wrapper">
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
            <script>var Produto = '.$URL[3].'</script>
            <script>var Token = "'.$Token.'"</script>
            <script src="https://sdk.mercadopago.com/js/v2"></script>';
            include 'EloJobx/Components/Header-User.php'; 
           
                  echo '<div id="page-content">
                     <div class="block">
                        <div class="block-title">
                           <h3>Pagamento da <strong>Compra</strong> #'.$URL[3].'</h3>
                        </div>
                        <div class="table-responsive">
                           <table class="table table-vcenter table-striped">
                              <thead>
                                 <tr>
                                    <th width="20%">N. da Compra</th>
                                    <th>Serviço</th>
                                    <th>Compra</th>
                                    <th>Valor</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>#'.$URL[3].'</td>
                                    <td>'.$Detalhes[0].'</td>
                                    <td>'.$Detalhes[1].'</td>
                                    <td>'.$Order["valor"].'</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>' ?>
                        <div class="table-responsive">
                           <table class="table table-vcenter table-striped">
                              <thead>
                                 <tr>
                                    <th>Formas de Pagamentos</th>
                                    <th>Ações</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr onclick="if (!window.__cfRLUnblockHandlers) return false; formaPagamento('#pix');" data-cf-modified-a434555b49bb48360cc7d000-="">
                                    <td>
                                       <img src="https://elojobhigh.com.br/app/assets/imagens/bancos/pix.png" width="16" height="16" data-toggle="tooltip" title="Pix" />
                                       Pix
                                       <em>(Método preferencial e rápido)</em>
                                       <em class="label label-success">[APROVAÇÃO AUTOMÁTICA]</em>
                                    </td>
                                    <td>
                                       <div class="btn-group btn-group-xs">
                                          <a href="javascript:void(0);" onclick="if (!window.__cfRLUnblockHandlers) return false; formaPagamento('#pix');" data-toggle="tooltip" title="Pagar" class="btn btn-warning" data-cf-modified-a434555b49bb48360cc7d000-=""><i class="gi gi-check"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr onclick="if (!window.__cfRLUnblockHandlers) return false; formaPagamento('#mercadoPago');">
                                     <td>
                                         <img src="https://elojobhigh.com.br/app/assets/imagens/bancos/mercado-pago.png" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Mercado Pago">
                                         Mercado Pago
                                         <em>(Boleto Bancário, Saldo MP, Cartão de Crédito - até 12x, Pagamento na Lotérica, Cartão de Débito Caixa)</em>
                                         <em class="label label-success">[APROVAÇÃO AUTOMÁTICA]</em>
                                         </td>
                                         <td>
                                             <div class="btn-group btn-group-xs">
                                                 <a href="javascript:void(0);" onclick="if (!window.__cfRLUnblockHandlers) return false; formaPagamento('#mercadoPago');" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Pagar"><i class="gi gi-check"></i></a>
                                                 </div>
                                                 </td>
                                                 </tr>
                                 <tr onclick="if (!window.__cfRLUnblockHandlers) return false; formaPagamento('#depositoTransferencia');" data-cf-modified-a434555b49bb48360cc7d000-="">
                                    <td>
                                       Pix
                                       
                                       <img src="https://elojobhigh.com.br/app/assets/imagens/bancos/nubank.png" width="16" height="16" data-toggle="tooltip" title="NuBank" />
                                       
                                       <em>(Método alternativo e rápido)</em>
                                       <em class="label label-info">[APROVAÇÃO MANUAL]</em>
                                    </td>
                                    <td>
                                       <div class="btn-group btn-group-xs">
                                          <a href="javascript:void(0);" onclick="if (!window.__cfRLUnblockHandlers) return false; formaPagamento('#depositoTransferencia');" data-toggle="tooltip" title="Pagar" class="btn btn-warning" data-cf-modified-a434555b49bb48360cc7d000-=""><i class="gi gi-check"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                
                              </tbody>
                           </table>
                        </div>
                        <?php
                        echo '<div class="block pagamentos display-none" id="mercadoPago">
                        <div class="block-title">
                        <h4>- Pagamento via <strong>Mercado Pago</strong></h4>
                        </div>
                        <div>
                        <div class="alert alert-success alert-dismissable">
                        <h4><i class="fa fa-exclamation-circle"></i> APROVAÇÃO AUTOMÁTICA!</h4> Assim que o seu pagamento for detectado pelo sistema, o seu pedido será aprovado e daremos andamento no seu pedido!
                        </div>
                        <div class="text-center" id="mercadopagobutton">
                      <div class="buymercadopago" id="buymercadopago"></div>
                        </div>'; ?>
</div>
</div>
                        <div class="block pagamentos" id="pix">
                           <div class="block-title">
                              <h4>- Pagamento via <strong>Pix</strong></h4>
                           </div>
                           <div>
                              <div class="alert alert-success alert-dismissable">
                                 <h4><i class="fa fa-exclamation-circle"></i> APROVAÇÃO AUTOMÁTICA!</h4>
                                 Assim que o seu pagamento for detectado pelo sistema, o seu pedido será aprovado e daremos andamento no seu pedido!
                              </div>
                              <div class="row">
                                 <div class="col-sm-12 col-lg-12">
                                    <div id="boxPixQrCode" class="text-center hide">
                                       <h3>QRCode do Pix:</h3>
                                       <?php echo '<h4>Núm. da Compra - #'.$URL[3].'</h4>
                                       <img src="" id="pixImgQrCode" class="img-responsive" alt="QRCode Pix" style="display: inline; width: 300px">
                                       <h3>Linha do Pix (Copia e Cola):</h3>
                                       <textarea name="pixCopiaCola" id="pixCopiaCola" rows="2" style="margin-bottom: 10px;" class="form-control"></textarea>
                                       <div class="alert alert-warning alert-dismissable">
                                          <h4><i class="fa fa-exclamation-circle"></i> Já fez o pagamento do Pix - QrCode?</h4>
                                          Agora <a href="'.$URL[3].'" id="CheckPixPayment">clique aqui</a> e aguarde que daremos andamento no seu pedido!
                                       </div>
                                    </div>'; ?>
                                    <div id="boxPixCadastro">
                                       <form action="javascript:void(0);" method="post" id="formPix" class="form-horizontal form-bordered">
                                          <fieldset>
                                             <legend>Dados Pessoais</legend>
                                             <div class="form-group">
                                                <div class="alert alert-info">
                                                   <i class="fa fa-info-circle"></i> Para gerar o QR Code do Pix é necessário informar os dados abaixo!
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <label class="col-md-1 control-label" for="cpf">CPF</label>
                                                <div class="col-md-2">
                                                   <input type="text" name="cpf" id="cpf" class="form-control cpf" placeholder="___.___.___-__">
                                                   <span style="color: red; display: none" id="errorcpf">CPF Invalido</span>
                                                </div>
                                                <label class="col-md-1 control-label" for="nome">Nome</label>
                                                <div class="col-md-3">
                                                   <input type="text" name="nome" id="nome" class="form-control">
                                                </div>
                                                <label class="col-md-1 control-label" for="sobrenome">Sobrenome</label>
                                                <div class="col-md-3">
                                                   <input type="text" name="sobrenome" id="sobrenome" class="form-control">
                                                </div>
                                             </div>
                                            
                                             <div class="form-group">
                                                <label class="col-md-1 control-label" for="cep">CEP</label>
                                                <div class="col-md-2">
                                                   <input type="text" name="cep" id="cep" class="form-control" placeholder="______-___">
                                                   <span id="ceperror" style="color: red; display: none;">Cep invalido</span>
                                                </div>
                                              
                                                <label class="col-md-1 control-label" for="rua">Nome da Rua</label>
                                                <div class="col-md-2">
                                                   <input type="text" name="rua" id="rua" class="form-control">
                                                </div>

                                                <label class="col-md-1 control-label" for="bairro">Bairro</label>
                                                <div class="col-md-2">
                                                   <input type="text" name="bairro" id="bairro" class="form-control">
                                                </div>

                                                <label class="col-md-1 control-label" for="numero">Numero</label>
                                                <div class="col-md-1">
                                                   <input type="text" name="numero" id="numero" class="form-control">
                                                </div>

                                             </div>

                                             <div class="form-group">
                                                <label class="col-md-1 control-label" for="cidade">Cidade</label>
                                                <div class="col-md-2">
                                                   <input type="text" name="cidade" id="cidade" class="form-control">
                                                </div>
                                                <label class="col-md-1 control-label" for="estado">Estado</label>
                                                <div class="col-md-3">
                                                   <input type="text" name="estado" id="estado" class="form-control">
                                                </div>

                                             </div>
                                            <?php echo '<input type="hidden" name="token" value="'.$Token.'" id="token"/>'; ?>
                                          </fieldset>
                                          <div class="form-group form-actions">
                                             <div id="retornoPix" class="text-center"></div>
                                             <div class="col-xs-12 text-center">
                                                <button type="submit" id="btnSubmitPix" class="btn btn-sm btn-primary">Enviar</button>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="block pagamentos display-none" id="depositoTransferencia">
                           <div class="block-title">
                              <h4>- Pagamento via <strong>Pix</strong></h4>
                           </div>
                           <div>
                              <div class="alert alert-info alert-dismissable">
                                 <h4><i class="fa fa-exclamation-circle"></i> APROVAÇÃO MANUAL!</h4>
                                 Assim que você efetuar o pagamento você deve enviar o comprovante e o número da compra via WhatsApp, para o administrador aprovar o seu pedido!
                              </div>
                              <p>Para realizar o pagamento via &quot;<strong>Pix</strong>&quot;, &eacute; necess&aacute;rio realizar o pagamento para uma das seguintes contas.</p>
                              <p><span style="color:#e74c3c"><strong>- ATEN&Ccedil;&Atilde;O</strong></span><br />
                                 Ap&oacute;s realizar o pagamento, enviar o <span style="color:#e74c3c"><u><strong>n&uacute;mero da compra e o comprovante de pagamento</strong></u></span> para <u><a href="https://wa.me/5511972805118" target="_blank">(11) 97280-5118 (WhatsApp)</a></u>.<br />
                                 <br />
                                 Verifique se a conta está correta</span> antes de transferir.
                              </p>
                              <hr />
                              <p><strong><img alt="NuBank" src="https://elojobhigh.com.br/app/assets/imagens/bancos/nubank.png" style="height:16px; width:16px" /> <span style="color:#8e44ad">260</span></strong><span style="color:#8e44ad"> - </span><strong><span style="color:#8e44ad">NUBANK PAGAMENTOS</span><br />
                                 <span style="color:#8e44ad">PIX:</span></strong> lucassanto132@gmail.com<br />
                                 <span style="color:#8e44ad"><strong>Favorecido:</strong></span> Lucas Santos<br />
                              <p>&nbsp;</p>
                              <hr />
                              <p>&nbsp;</p>
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
         <div id="modal-picpay" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header text-center">
                     <h3 class="modal-title"><i class="fa fa-list-alt"></i> PicPay</h3>
                  </div>
                  <div class="modal-body">
                     <div class="alert alert-info">
                        <h4><i class="fa fa-info-circle"></i> Aviso - informe os seus dados pessoais!</h4>
                        Para gerar o QR Code no PicPay é necessário informar os dados abaixo!
                     </div>
                     <form action="javascript:void(0);" method="post" id="formPicPay" class="form-horizontal form-bordered">
                        <fieldset>
                           <legend>Dados Pessoais</legend>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="nome">Nome</label>
                              <div class="col-md-8">
                                 <input type="text" name="nome" id="nome" class="form-control">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="sobrenome">Sobrenome</label>
                              <div class="col-md-8">
                                 <input type="text" name="sobrenome" id="sobrenome" class="form-control">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="cpf">CPF</label>
                              <div class="col-md-8">
                                 <input type="text" name="cpf" class="form-control cpf" placeholder="___.___.___-__">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="email">E-mail</label>
                              <div class="col-md-8">
                                 <input type="text" name="email" id="email" class="form-control">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="celular">Celular</label>
                              <div class="col-md-8">
                                 <input type="text" name="celular" id="celular" class="form-control" placeholder="(__) _____-____">
                              </div>
                           </div>
                        </fieldset>
                        <div class="form-group form-actions">
                           <div id="retornoPicPay" class="text-center"></div>
                           <div class="col-xs-12 text-right">
                              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
                              <button type="submit" id="btnSubmitPicPay" class="btn btn-sm btn-primary">Enviar</button>
                           </div>
                        </div>
                     </form>
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
      

         <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://elojobhigh.com.br/app/assets/js/vendor/jquery.min.js" type="a434555b49bb48360cc7d000-text/javascript"></script>
         <script src="/Template/js/user/bootstrap.min.js" type="a434555b49bb48360cc7d000-text/javascript"></script>
         <script src="/Template/js/user/plugins.js" type="a434555b49bb48360cc7d000-text/javascript"></script>
         <script src="/Template/js/user/vex.combined.min.js" type="a434555b49bb48360cc7d000-text/javascript"></script>
         <script src="/Template/js/user/maskedinput.js" type="a434555b49bb48360cc7d000-text/javascript"></script>
         <script type="a434555b49bb48360cc7d000-text/javascript">

        const mp = new MercadoPago('APP_USR-0fc071ba-b639-4f32-a8db-4a4f144aa08e', {
        locale: 'pt-BR'
        });
      
            var base_url = 'https://server.localhost:81';
            vex.defaultOptions.className = 'vex-theme-os';
            vex.dialog.buttons.YES.text = 'OK';
            vex.dialog.buttons.NO.text = 'CANCELAR';
            
            $('#cep').mask('99999-999');
            

            $('#CheckPixPayment').click(function (event) {
               event.preventDefault();
               window.open('http://'+window.location.hostname+'/checkout/pix/'+$(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
            });
            
    

            function getCep(cep){
               $.ajax({
            			url: 'https://viacep.com.br/ws/'+cep+'/json/unicode/',
            			type: 'GET',
            			dataType: 'json',
            			beforeSend: function() {
            				$('#cep').attr('disabled', true);
            			},
            			success: function(data) {
                        $("#ceperror").css("display", "none")
                        $('#cep').attr('disabled', false);
                     

                        if(data.erro){
                           return $("#ceperror").css("display", "block")
                        }

                        $("#cidade").val(data.localidade)
                        $("#estado").val(data.uf)
                        data.logradouro.length > 1 ? $("#rua").val(data.logradouro): null
                        data.bairro.length > 1 ? $("#bairro").val(data.bairro): null
            			}
            		});
            }

            $("#cep").keyup(function(){
               if($("#cep").val().length > 0 && $("#cep").val().length < 9){
                  if($("#estado").val().length > 1){
                  $("#cidade").val('')
                  $("#estado").val('')
                  $("#rua").val('')
                  $("#bairro").val('')
                  $("#numero").val('')
               }}
               if($("#cep").val().length === 9){
                  if($("#estado").val().length === 0){
                  getCep($("#cep").val())
                  }
               }
            });
            function CPF(){"user_strict";function r(r){for(var t=null,n=0;9>n;++n)t+=r.toString().charAt(n)*(10-n);var i=t%11;return i=2>i?0:11-i}function t(r){for(var t=null,n=0;10>n;++n)t+=r.toString().charAt(n)*(11-n);var i=t%11;return i=2>i?0:11-i}var n=false,i=true;this.gera=function(){for(var n="",i=0;9>i;++i)n+=Math.floor(9*Math.random())+"";var o=r(n),a=n+"-"+o+t(n+""+o);return a},this.valida=function(o){for(var a=o.replace(/\D/g,""),u=a.substring(0,9),f=a.substring(9,11),v=0;10>v;v++)if(""+u+f==""+v+v+v+v+v+v+v+v+v+v+v)return n;var c=r(u),e=t(u+""+c);return f.toString()===c.toString()+e.toString()?i:n}}
            var CPF = new CPF();

          function formaPagamento(idSelecionado) {
                if (idSelecionado === "#mercadoPago") {
                     if (typeof $("#buymercadopago").attr("token") == 'undefined') {

            $(".btn.btn-success").css('display', 'block');
            $("#buymercadopago").attr('token', 'rads');
            $.ajax({
                url: base_url + '/api/mercadopago/' + Produto + '/buy/alternative',
                type: 'POST',
                data: {
                    token: $("#token").val()
                },
                dataType: 'json',
                success: function(data) {
                    
                    setTimeout(function(){

                              
                 console.log($("iframe#mercadopago-checkout").contents().find(".group-summary__container"))

                       
                    },5000)
                    console.log(data.paymentid)
                    if (data.status) {
                         mp.checkout({ preference: {
                        id: data.paymentid},
                        render: {
                        container: '.buymercadopago'
                        }
                        });
                        return true;
                    }
                   return alert('erro')
                }
            });
          
        }
                  
                }
            	$('.pagamentos').hide();
            	$(idSelecionado).show();
            	$("html, body").delay(2000).animate({scrollTop: $(idSelecionado).offset().top }, 2000);
            }
            $(function() {
            	$(".phone").mask("(99) 99999-9999");
            	
            	$('#pixCopiaCola').click(function() {
            		$(this).select();
            	});
            	
            	$('.cpf').mask('999.999.999-99');
            	$('#celular').mask('(99) 99999-9999');
            	
             
            	$('#formPix').submit(function() {
                  $("#errorcpf").css("display", "none")
                  if(!CPF.valida($("#cpf").val())){
                     return $("#errorcpf").css("display", "block")
                  }

                  if($("#cidade").val().length < 1 || 
                     $("#estado").val().length < 1 || 
                     $("#rua").val().length < 1 || 
                     $("#bairro").val().length < 1 || 
                     $("#cpf").val().length < 1 || 
                     $("#nome").val().length < 1 || 
                     $("#sobrenome").val().length < 1 || 
                     $("#estado").val().length < 1 || 
                     $("#cidade").val().length < 1){
                     return alert("Preencha todos os campos")
                     }
                     
            		$.ajax({
            			url: base_url + '/api/mercadopago/'+Produto+'/buy',
            			type: 'POST',
            			dataType: 'json',
            			data: $(this).serialize(),
            			beforeSend: function() {
            				$('#btnSubmitPix').attr('disabled', true);
            			},
            			success: function(data) {
            				$('#retornoPix').html('');
            				if(data.status == '1') {
            					$('#pixImgQrCode').attr('src', `data:image/jpeg;base64,${data.payment.qrcodeimg}`);

            					$('#pixCopiaCola').html(data.payment.qrcodecopy);
            					
            					$('#boxPixCadastro').addClass('hide');
            					$('#boxPixQrCode').removeClass('hide');
            				} else {
            					$('#retornoPix').html(data.mensagem);
            					$('#btnSubmitPix').attr('disabled', false);
            				}
            			}
            		});
            		return false;
            	});
            	
            	$('#formPicPay').submit(function() {
            		$.ajax({
            			url: base_url + '/cliente/picpay/26090',
            			type: 'POST',
            			dataType: 'json',
            			data: $(this).serialize(),
            			beforeSend: function() {
            				$('#btnSubmitPicPay').attr('disabled', true);
            			},
            			success: function(data) {
            				$('#retornoPicPay').html('');
            				if(data.status == '1') {
            					window.top.location = data.url;
            				} else {
            					$('#retornoPicPay').html(data.mensagem);
            					$('#btnSubmitPicPay').attr('disabled', false);
            				}
            			}
            		});
            		return false;
            	});
            });
         </script>
         <script src="https://elojobhigh.com.br/app/assets/js/app.js" type="a434555b49bb48360cc7d000-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="a434555b49bb48360cc7d000-|49" defer=""></script>
      </body>
   </html>