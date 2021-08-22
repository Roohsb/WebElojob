<?php

require __ROOT__."/EloJobx/Essential/JOBXCalculator/Calculator.php";
require __ROOT__."/EloJobx/Essential/JOBXCalculator/Essential.php";
require __ROOT__."/EloJobx/Essential/JOBXCalculator/Exception.php";

use JOBXCalculator\JOBXCalculator\{Coach,MyException};

/**
* Table of values ​​and terms
* Enable only if there is an intention to change prices.
* @author CastroMS
$Table = [
    array("level" => "iniciante",       "value" => 5),
    array("level" => "intermediario",   "value" => 10),
    array("level" => "experiente",      "value" => 20),
];
* @var Table 
* Create a table with the same structure and start in the FUNCTION setJOBX
* Minimum Level = 3
**/

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
header('Content-Type: application/json; charset=utf-8');




$Parameters = array(
  'servico' =>          $_POST["servico"] ?? null,
  'curso' =>        $_POST["curso"] ?? null,
  'qtdaulas' =>     $_POST["qtdaulas"] ?? null,
);
$CalculateElo = new Coach($Parameters);

try{
   /**
     * @var Table 
     * @param Array[array()...]
    
     $CalculateElo->setJOBX(@var);
    */

    /**
     * Calculation results Within an array
     * @param Variable->startCoach()["Value"]
     */
    $Resultados = $CalculateElo->startCoach();
    if(!isset($_SESSION["CoachDetails"]) || $_SESSION["CoachDetails"]["Valor"] != $Resultados["total"]){
    $_SESSION["CoachDetails"] = array("Curso" => $_POST["curso"], "Aulas" => $_POST["qtdaulas"], "Valor" => $Resultados["total"]);
    }
    echo json_encode($Resultados);

}catch(MyException $e){
  echo json_encode($e->errorJOBX());
}
}

?>