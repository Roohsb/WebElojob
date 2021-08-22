<?php
if ($Token = TokenLostPassword($Server, $URL[2])) {
    $DateToken = date("Y-m-d H:i:s", strtotime($Token["date"] . ' + 1 days'));
    if (date('Y-m-d H:i:s') >= $DateToken) {
        header("Location: /saguao");
        exit;
    }
} else {
    header("Location: /saguao");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    UpdatePasswordLostPass($Server, $Token, $_POST);
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
               <img src="<?php echo logo; ?>" alt="ELOJOBX" />
               <h3><small style="color: #fff;">Altere a <strong>Senha </strong> da sua  <strong>Conta</strong></small></h3>
            </div>
            <div class="block push-bit">
            <?php
               echo '<form action="/user/nova-senha/'.$URL[2].'" method="post" class="form-horizontal form-bordered form-control-borderless">'; 
               if (isset($_SESSION['ErrorPass'])) { 
                echo '<div class="text-danger" style="text-align: center;">'.$_SESSION['ErrorPass'].'.</div>';
                unset($_SESSION['ErrorPass']);
            }
          ?>
         
  
                
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-user"></i></span>
                           <input type="password" name="senha" value="" id="senha" class="form-control input-lg" placeholder="******">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                           <input type="password" name="senha-2" value="" id="senha2" class="form-control input-lg" placeholder="******">
                                      
                         
                        </div>
                     </div>
                  </div>
                  <div class="form-group form-actions">
                    
                     <div class="col-xs-8 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Alterar</button>
                     </div>
                  </div>
                  <div class="form-group">
                    
                  </div>
               </form>
            </div>
         </div>
         <script src="/Template/js/user/jquery.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
         <script src="/Template/js/user/bootstrap.min.js" type="06e977cfbac3002e518f74a0-text/javascript"></script>
         <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="06e977cfbac3002e518f74a0-|49" defer=""></script>
      </body>
   </html>