<?php 
require 'EloJobx/Elo.php';
require 'EloJobx/Jobx/Elo.php';
require 'EloJobx/Jobx/EloBlock.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Preços baixos e segurança para você chegar no elo que merece! Elo Job (elojob), Elo Boost, Coach e Duo Boost. Compre já!">
      <meta name="keywords" content="elorocket,elo rocket,league of legends,lol,eloboost,elojob,conta,coach,riot,elo,job,elo job,boost,elo boost,subir,bronze,prata,ouro,platina,diamante,mestre,challenger,desafiante,tier,liga,divisao,duo boost,duo,unranked,smurf">
      <meta name="author" content="ElojobX">
      <link rel="shortcut icon" href="<?php echo logo; ?>">
      <title><?php echo titulo; ?></title>
      <link rel="stylesheet" href="/Template/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&amp;display=swap" rel="stylesheet">
      <link rel="stylesheet" href="/Template/css/main6da2.css?v=2.2">
      
   </head>
   <body>
    
      <div class="container-fluid b-div">
         <div class="row fullvh">
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144914921-1" type="beb136a3a17ce96caf0fcab3-text/javascript"></script>
            <script type="beb136a3a17ce96caf0fcab3-text/javascript">
               window.dataLayer = window.dataLayer || [];
               function gtag(){dataLayer.push(arguments);}
               gtag('js', new Date());
               
               gtag('config', 'UA-144914921-1');
            </script>
           <?php 
           include 'EloJobx/Components/NavBar.php'; 
           $URL[0] = ($URL[0] != '' ? $URL[0] : 'saguao');
           if (file_exists('EloJobx/Views/' . $URL[0] . '.php')):
               require('EloJobx/Views/' . $URL[0] . '.php');
           else:
              echo '<script>window.location.replace("/saguao");</script>';
                       die();
           endif;
           ?>
          
         </div>
      </div>
      <script src="/Template/js/jquery-3.4.1.min.js" type="beb136a3a17ce96caf0fcab3-text/javascript"></script>
      <script src="/Template/js/bootstrap.min.js" type="beb136a3a17ce96caf0fcab3-text/javascript"></script>
      <script src="/Template/js/comments.js" type="beb136a3a17ce96caf0fcab3-text/javascript"></script>
      <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="beb136a3a17ce96caf0fcab3-|49" defer=""></script>
   </body>
</html>