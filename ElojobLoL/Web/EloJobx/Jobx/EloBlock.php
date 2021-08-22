<?php
if(isset($URL[0],$URL[1]) && $URL[0] == 'user'){
    if($EloTools->BlockAuth($URL[1]) == true && (isset($_SESSION['Usuario']))){
        echo '<script>window.location.replace("/user/centro");</script>';  exit;
        }elseif($EloTools->BlockAuth($URL[1]) == false && (!isset($_SESSION['Usuario']))){
            echo '<script>window.location.replace("/user/entrar");</script>';  exit;
        }
        if (file_exists('EloJobx/Views/User/' . $URL[1] . '.php')):
            require('EloJobx/Views/User/' . $URL[1] . '.php');
            exit;
        else:
           echo '<script>window.location.replace("/saguao");</script>';
                    die();
        endif;    
}

if(isset($URL[0],$URL[1]) && ($URL[0] == 'api')){
    if($EloTools->BlockApi($URL[1]) OR (isset($_SESSION['Usuario']))){
        if (file_exists('EloJobx/Api/' . $URL[1] . '.php')):
            require('EloJobx/Api/' . $URL[1] . '.php');
            exit;
        else:
           echo '<script>window.location.replace("/saguao");</script>';
                    die();
        endif;   
    } 
}

if(isset($URL[0],$URL[1]) && ($URL[0] == 'highlights')){
    if (file_exists('EloJobx/Views/Components/' . $URL[1] . '.php')):
        require('EloJobx/Views/Components/' . $URL[1] . '.php');
        exit;
    else:
       echo '<script>window.location.replace("/saguao");</script>';
                die();
    endif;   
}

?>