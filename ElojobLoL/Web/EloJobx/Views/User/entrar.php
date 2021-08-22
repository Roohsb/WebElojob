<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   Auth($_POST,$Server);
}
?>
<!DOCTYPE html>
   <html class="no-js" lang="pt">
      <head>
         <meta charset="utf-8">
         <title><?php echo name; ?> - Área do Cliente</title>
         <meta name="description" content="A maneira mais fácil e rápida de subir de ELO! Adquira já o seu serviço conosco!">
         <meta name="author" content="Diego Trindade">
         <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
         <link rel="shortcut icon" href="<?php echo logo; ?>">
         <link rel="stylesheet" href="/Template/css/user/bootstrap.min.css">
         <link rel="stylesheet" href="/Template/css/user/plugins.css">
         <link rel="stylesheet" href="/Template/css/user/main.css">
         <link rel="stylesheet" href="/Template/css/user/themes.css">
         <script src="/Template/js/user/modernizr.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
         <script type="06e977cfbac3002e518f74a0-text/javascript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WZTSHM2');
         </script>
      </head>
      <body>
        
         <img src="/Template/imagens/user/01.jpg" alt="ELOJOBX" class="full-bg animation-pulseSlow">
         <div id="login-container" class="animation-fadeIn">
            <div class="login-title text-center">
               <img src="<?php echo logo; ?>" width="400" alt="ELOJOBX" />
               <h3><small style="color: #fff;">Por favor faça o <strong>Login</strong> ou <strong>Registre-se</strong></small></h3>
            </div>
            <div class="block push-bit">
               <form action="/user/entrar" method="post" class="form-horizontal form-bordered form-control-borderless">
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-user"></i></span>
                           <input type="text" name="nomeusuario" value="" id="nomeusuario" class="form-control input-lg" placeholder="Nome de Usuário ou Endereço de E-mail">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                           <input type="password" name="senha" value="" id="senha" class="form-control input-lg" placeholder="******">
                           <?php
                   if (isset($_SESSION['Aviso'])) { 
                  echo '<div class="text-danger">'.$_SESSION['Aviso'].'.</div>';
                  unset($_SESSION['Aviso']);
                              }
                              if(isset($_SESSION["LostPassOK"])){  echo '<div class="text-danger" style="color: green;">'.$_SESSION['LostPassOK'].'.</div>';
                                 unset($_SESSION['LostPassOK']);}
                              ?>               
                         
                        </div>
                     </div>
                  </div>
                  <div class="form-group form-actions">
                     <div class="col-xs-4">
                        <label class="switch switch-primary" data-toggle="tooltip" title="Lembrar-me?">
                        <input type="checkbox" id="lembrarme" name="lembrarme" checked="checked">
                        <span></span>
                        </label>
                     </div>
                     <div class="col-xs-8 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Entrar</button>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12 text-center">
                        <a href="/user/redefinir-senha"><small>Esqueceu a senha?</small></a> -
                        <a href="/user/cadastrar" class="btn btn-primary"><small>Criar uma nova conta</small></a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <script src="/Template/js/user/jquery.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
         <script src="/Template/js/user/bootstrap.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="06e977cfbac3002e518f74a0-|49" defer=""></script>
      </body>
   </html>