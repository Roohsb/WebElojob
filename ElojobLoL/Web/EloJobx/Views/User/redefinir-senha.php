<!DOCTYPE html>
   <html class="no-js" lang="pt">
      <head>
         <meta charset="utf-8">
         <title><?php echo name; ?> - Esqueceu a senha?</title>
         <meta name="description" content="A maneira mais fácil e rápida de subir de ELO! Adquira já o seu serviço conosco!">
         <meta name="author" content="CastroMS">
         <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
         <link rel="shortcut icon" href="<?php echo logo; ?>">
         <link rel="stylesheet" href="/Template/css/user/bootstrap.min.css">
         <link rel="stylesheet" href="/Template/css/user/plugins.css">
         <link rel="stylesheet" href="/Template/css/user/main.css">
         <link rel="stylesheet" href="/Template/css/user/themes.css">
         <script src="https://elojobhigh.com.br/app/assets/js/vendor/modernizr.min.js" type="f656f969bd388b2534a57d41-text/javascript"></script>
         <script type="f656f969bd388b2534a57d41-text/javascript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WZTSHM2');
         </script>
         <script src="https://www.google.com/recaptcha/api.js" async defer></script>

      </head>
      <body>
         <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZTSHM2"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
         <img src="https://elojobhigh.com.br/app/assets/imagens/backgrounds/01.jpg" alt="ELOJOBX" class="full-bg animation-pulseSlow">
         <div id="login-container" class="animation-fadeIn">
            <div class="login-title text-center">
               <img src="<?php echo logo; ?>" width="400" alt="ELOJOBX" />
               <h3><small style="color: #fff;">Por favor faça o <strong>Login</strong> ou <strong>Registre-se</strong></small></h3>
            </div>
            <div class="block push-bit">
               <form action="/api/lost-password" method="post" class="form-horizontal form-bordered form-control-borderless">
               <?php
                 if(isset($_SESSION["AlertLostPass"])){ 
                  echo '<div id="erroralert" class="text-danger" style="color: red;display: block;text-align: center;font-size: 14px;">'.$_SESSION["AlertLostPass"].'</div>';
                  unset($_SESSION["AlertLostPass"]);
                 }
                 if(isset($_SESSION["OKLostPass"])){ 
                  echo '<div id="erroralert" class="text-danger" style="color: green;display: block;text-align: center;font-size: 14px;">'.$_SESSION["OKLostPass"].'</div>';
                  unset($_SESSION["OKLostPass"]);
                 }
                  ?>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                           <input type="email" name="email" value="" class="form-control input-lg" placeholder="E-mail">
                        </div>
                     </div>
                  </div>

                  <div class="form-group" style="margin-left: 15%;">
                     <div class="col-xs-12">
                  <div class="g-recaptcha" data-sitekey="6LfSGsUaAAAAAHC2Kw4KsUvj4ejZx8S1zbmtRPgM"></div>
                  </div>
                  </div>
                  
                  <div class="form-group form-actions">
                     <div class="col-xs-12 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Enviar</button>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12 text-center">
                        <small>Você se lembrou da sua senha?</small> <a href="https://elojobhigh.com.br/app/autenticacao/login" id="link-reminder"><small>Login</small></a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <script src="/Template/js/user/jquery.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
         <script src="/Template/js/user/bootstrap.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="f656f969bd388b2534a57d41-|49" defer=""></script>
      </body>
   </html>