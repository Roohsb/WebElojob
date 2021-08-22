<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    if(isset($_POST["theme"])){
        if(ThemesEloList($Server, 1 , $_POST["theme"])){
            SetTheme($Server,$_POST["theme"]);
            echo '{done: true}'; exit;
        }
        echo '{done: false}'; exit;
        }
    }else{
    header("Location: /saguao"); exit;
}
?>