<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   Register($_POST,$Server);
}
?>
<!DOCTYPE html>
   <html class="no-js" lang="pt">
      <head>
         <meta charset="utf-8">
         <title><?php echo name; ?> - Área do Cliente</title>
         <meta name="description" content="A maneira mais fácil e rápida de subir de ELO! Adquira já o seu serviço conosco!">
         <meta name="author" content="CastroMS">
         <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
         <link rel="shortcut icon" href="<?php echo logo; ?>">
         <link rel="stylesheet" href="/Template/css/user/bootstrap.min.css">
         <link rel="stylesheet" href="/Template/css/user/plugins.css">
         <link rel="stylesheet" href="/Template/css/user/main.css">
         <link rel="stylesheet" href="/Template/css/user/themes.css">
         <script src="/Template/js/user/modernizr.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

         <script type="06e977cfbac3002e518f74a0-text/javascript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WZTSHM2');
         </script>
      </head>
      <body>
        
         <img src="https://s2.glbimg.com/7GdCbAYhDcrEbIpbx5y6Q_Oyprg=/0x0:1215x717/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_08fbf48bc0524877943fe86e43087e7a/internal_photos/bs/2020/O/Y/A2KuJbTjGK3fJP3xZcVQ/hextech-kassadin.jpg" alt="ELOJOBX" class="full-bg animation-pulseSlow">
         <div id="login-container" class="animation-fadeIn">
            <div class="login-title text-center">
               <img src="<?php echo logo; ?>" width="400" alt="ELOJOBX" />
               <h3><small style="color: #fff;">Por favor faça o <strong>Login</strong> ou <strong>Registre-se</strong></small></h3>
            </div>
            <div class="block push-bit">
               <form action="/user/cadastrar" method="post" class="form-horizontal form-bordered form-control-borderless">
               <?php
      if (isset($_SESSION['Aviso'])) { 
               echo '<div id="erroralert" class="text-danger" style="color: red;display: block;text-align: center;">'.$_SESSION["Aviso"].'</div>';
                              ?><?php
                              unset($_SESSION['Aviso']);
                              } ?>  
               
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-user"></i> <strong class="text-danger">*</strong></span>
                           <input type="text" name="nome" value="" class="form-control input-lg" placeholder="Nome" required>
                           <span class="help-block">Informe o seu nome ou um apelido.</span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-iphone"></i></span>
                           <input type="text" name="celular" value="" class="form-control input-lg" placeholder="(__) _____-____">
                           <span class="help-block">Caso possua, cadastre um celular com WhatsApp.</span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-user"></i> <strong class="text-danger">*</strong></span>
                           <input type="text" name="usuario" value="" class="form-control input-lg" placeholder="Usuário" required>
                           <span class="help-block">O seu usuário será o login do site ELOJOBX e ficará visível para todos os usuários na URL do seu perfil. Exemplo:</span>
                           <span class="help-block">https://elojobhigh.com.br/app/perfil/<strong id="url_usuario">usuario</strong></span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-envelope"></i> <strong class="text-danger">*</strong></span>
                           <input type="email" name="email" value="" class="form-control input-lg" placeholder="E-mail" required>
                           <span class="help-block">Verifique se o endereço de e-mail está correto, enviaremos um e-mail de confirmação.</span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-asterisk"></i> <strong class="text-danger">*</strong></span>
                           <input type="password" name="senha" id="senha" value="" class="form-control input-lg" placeholder="Senha" required>
                           <span class="help-block">Coloque uma senha segura e proteja a sua conta.</span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-asterisk"></i> <strong class="text-danger">*</strong></span>
                           <input type="password" name="confirmarsenha" id="confirmarsenha" value="" class="form-control input-lg" placeholder="Repetir Senha" required>
                           <span class="help-block">Confirme a sua senha segura.</span>
                           <div id="passdoesmatch" class="text-danger"></div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group form-actions">
                     <div class="col-xs-6">
                        <a href="#modal-terms" data-toggle="modal" class="register-terms">Termos</a>
                        <label class="switch switch-primary" data-toggle="tooltip" title="Concorde com os termos">
                        <input type="checkbox" name="termos" value="1" required>
                        <span></span>
                        </label>
                     </div>
                     <div class="col-xs-6 text-right">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Cadastrar</button>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12 text-center">
                        <small>Você tem uma conta?</small> <a href="/user/auth" id="link-register"><small>Login</small></a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div id="modal-terms" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Termos de Serviço</h4>
                  </div>
                  <div class="modal-body">
                     <p>Esteja ciente dos termos e condições ao usar nosso site e nosso serviço. </p>
                     <p>O uso do nosso website limita-o aos termos e condições nesta página.</p>
                     <p>Você é totalmente responsável por estar ciente dos nossos termos e respeitar o uso do nosso site e / ou serviço.</p>
                     <p>Se você deseja recusar nossos termos e condições, entre em contato conosco e explique seus motivos.</p>
                     <br>
                     <p>ELOJOBX está hospedado no site <a href="https://elojobhigh.com.br/app/">https://elojobhigh.com.br/app/</a></p>
                     <br>
                     <p>Todas e quaisquer partes, estão proibidos de usar e ou divulgar dados de quaisquer clientes ou jogadores envolvidos.</p>
                     <p>O cliente estando ciente, aceita todos os riscos e concorda em manter em sigilo quaisquer dados dos profissionais da ELOJOBX, bem como não estão autorizados a usar ou vincular a empresa ELOJOBX, respeitando a propriedade intelectual e imagem.</p>
                     <p>ELOJOBX não reivindica nenhuma afiliação com Riot Games.</p>
                     <p>A ELOJOBX não reivindica qualquer propriedade intelectual da Riot Games ou de qualquer afiliado. Todos os direitos autorais e marcas registradas são de propriedade de seus respectivos proprietários.</p>
                     <p>O cliente reconhece que ELOJOBX não tem nenhuma relação com Riot Games. O cliente reconhece que ELOJOBX não reivindica nenhuma propriedade intelectual da Riot Games ou de outras partes.</p>
                     <p>League of Legends é uma marca registrada da Riot Games, desta forma, a ELOJOBX não tem afiliação com a associação ou endosso da Riot Games.</p>
                     <br>
                     <p><strong>Deveres do Cliente:</strong></p>
                     <br>
                     <p>ELOJOBX não está associado com Riot Games ou qualquer outra entidade vinculada a esta.</p>
                     <p>A ELOJOBX adverte a todas as partes interessadas e potenciais interessados para que se abstenham de violar, infringir ou tomar qualquer ação ilegal relativamente a direitos de propriedade intelectual detidos pela Riot Games ou por qualquer outra entidade vinculada a esta.</p>
                     <p>Ao entrar no nosso site ou em qualquer extensão do nosso site / serviço, incluindo o download e / ou a observação de conteúdo em qualquer plataforma que serve como uma extensão do nosso site ou serviço, você declara sob pena de perjúrio que não está empregado ou afiliado Riot Games e suas respectivas afiliadas e subsidiárias.</p>
                     <p>Ao adquirir ou usar nosso serviço ou qualquer serviço incluído no ELOJOBX, o cliente reconhece que compreende os serviços que você está comprando e que é responsável por fornecer com precisão as informações necessárias no jogo para que possamos concluir e processar seu pedido.</p>
                     <br>
                     <p>Você, o cliente, reconhece que ao comprar um serviço de reforço da nossa empresa, você não é elegível para proteção do comprador no Paypal, Mercado Pago, ou outra forma eletrônica de pagamento e/ou instituição financeira. </p>
                     <p>Qualquer disputa deve ser mediada através de nosso sistema de suporte. Se você, o cliente, abrir uma disputa com o Paypal, ou outra instituição financeira em relação ao nosso serviço, você está em violação dos nossos termos de serviço.</p>
                     <p>A empresa reserva-se o direito de prosseguir ações contra os clientes que abrirem disputas ou estornos, incluindo a adição das informações do cliente a uma lista de compradores inválidos e a divulgação das suas informações a terceiros.</p>
                     <p>ELOJOBX reserva-se o direito de prosseguir ações legais contra pessoas que cometeram fraude financeira relacionada com a compra de serviços no nosso site.</p>
                     <p>Você, o cliente, aceita a responsabilidade de perder pontos de liga devido a seus logins, mesmo caindo da série de promoção devido à razão mencionadas, e que os booster tem o direito de mudar suas runas, e que você, cliente aceitar que booster pode usar Influence Point para melhor adaptação e prosseguimento dos trabalhos.</p>
                     <p>Você, o cliente, aceita que não estará jogando nenhum jogo da promoção enquanto o booster não tiver registrado o serviço como terminado, também caso você joga alguns jogos durante a promoção nós reservamos o direito de jogar apenas a série da promoção, sem qualquer garantia.</p>
                     <p>Você, o cliente, aceita que, se você jogar qualquer jogo enquanto tiver comprado uma divisão ou um aumento de tier, reservamos o direito de parar o serviço e anunciar o booster como completo, sem reembolsos oferecidos.</p>
                     <p>Você, o cliente, aceita que se seu ganho de LP estiver abaixo de 12 LP por vitória em qualquer divisão diferente da primeira divisão que você comprou, você terá que pagar valor extra referente a uma divisão da mesma liga, ou nós converteremos seu pedido em vitórias seguindo. Por exemplo, se você comprou prata 3 ao ouro 5 e seu ganho de LP está abaixo de 12 LP por vitória na divisão de prata 2 ou 1, você tem a opção de converter para ganhar ou pagar extra.</p>
                     <p>Você, o cliente, aceita que se você iniciar um estorno você está em violação direta dos termos de uso de ELOJOBX e legalmente obrigado a fechar o estorno ou pagar o mesmo montante, além de uma taxa determinada pela ELOJOBX.</p>
                     <p>Você, o cliente, aceita que, se você abrir uma reivindicação após o fim do pedido ou o serviço tiver sido iniciado ou concluído, você está em violação direta dos termos de uso do ELOJOBX e legalmente obrigado a fechar o pedido ou a pagar de volta o mesmo montante, além de uma taxa determinada pela ELOJOBX.</p>
                     <p>Você, o cliente, aceita que sua conta será enviada para uma agência de cobradores de dívidas, caso proteste um pagamento feito por um serviço que já havia sido concluído, bem como aceita que você terá que pagar taxas extras cobrindo a agência de cobranças e qualquer outro imprevisto custos em relação ao seu estorno.</p>
                     <p>Você, o cliente, aceita que caso necessário terá que fazer a identificação da sua conta, validando a sua identidade enviando os seus documentos e validando a veracidade dos seus dados informados.</p>
                     <p>Ao comprar um serviço você é elegível para um reembolso no prazo de 48 horas de sua compra, isso se aplica se o booster não começar a trabalhar em sua conta dentro do tempo de entrega. Você pode solicitar este reembolso diretamente no Suporte ao Cliente.</p>
                     <p>Os pedidos que não foram concluídos dentro da duração da época de concessão são tratados em conformidade com o ponto “13” destes termos. No caso do booster iniciar os serviços e não conclui-lo dentro do prazo informado no ato da contratação, será emitido um reembolso parcial, em conformidade ao que foi feito.</p>
                     <p>Aos Clientes, reserve o direito de assistir qualquer jogo durante o processo e questionar o booster sobre quaisquer dúvidas, fazendo este por meio do canal de chat do cliente.</p>
                     <p>Aos Clientes, reserve o direito ao se candidatar a um serviço de fila Duo ou a um serviço de coaching o privilégio de um idioma específico para comunicar ao aplicar o serviço, levando em consideração os nossos idiomas disponíveis e, em qualquer caso, o idioma não está disponível, para pedir um tradutor.</p>
                     <p>Aos Clientes, reserve o direito de comprar o Serviço de Elo Boost, Duo Queue's e Coaching detidos pelo ELOJOBX, consistindo na elevação do montante de elo, o número de duos filas ou o número de horas para o treinador selecionado, isto após o pagamento ser feito.</p>
                     <p>Elo Booster vai contra os termos de serviço da Riot. Isso pode resultar em possíveis ações tomadas contra sua conta. Tomamos todas as precauções necessárias para garantir a sua segurança, mas em última análise, não somos responsáveis por quaisquer ações tomadas contra a sua conta.</p>
                     <p>Você, o cliente, aceita que, se após a compra de um serviço você mostrar inatividade por 28 dias ou mais e não mostrar interesse em encerrar o serviço, vamos fechá-lo e tê-lo como processado.</p>
                  </div>
               </div>
            </div>
         </div>
         <script src="/Template/js/user/jquery.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
        
         <script src="/Template/js/user/bootstrap.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
         <script>
          $('#senha, #confirmarsenha').on('keyup', function () {
                  if ($('#senha').val() != $('#confirmarsenha').val()) {
                     $('#passdoesmatch').html('O campo confirmar senha não é igual ao campo senha.').css({'color': 'red', 'display': 'block'});
                  }else{
                     if ($('#senha').val().length == 0 && $('#confirmarsenha').val().length == 0) {
                     $('#passdoesmatch').css("display", "none")
                     }else{
                     $('#passdoesmatch').css("display", "none")
                     }
                  }
               
                     });
                     $(function() {
            	$("input[name=usuario]").keyup(function() {
            		var usuario = $(this).val();
            		if(usuario == '') {
            			$('#url_usuario').html('usuario');
            		} else {
            			$('#url_usuario').html(usuario);
            		}
            	});
            });
                     </script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="06e977cfbac3002e518f74a0-|49" defer=""></script>   
         </body>
   </html>