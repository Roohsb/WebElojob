<?php

require __ROOT__."/EloJobx/Essential/JOBXCalculator/Calculator.php";
require __ROOT__."/EloJobx/Essential/JOBXCalculator/Essential.php";
require __ROOT__."/EloJobx/Essential/JOBXCalculator/Exception.php";

use JOBXCalculator\JOBXCalculator\{DuoBooster,EloBooster,MyException};

const SERVICES = ["eloboost", "duoboost", "md10"];

/**
* Table of values ​​and terms
* Enable only if there is an intention to change prices.
* @author CastroMS
$Table = [
  array( "elo" => "ferro",      "value" => 28,    "parcelado" => 7,   "prazo" => 1),
  array( "elo" => "bronze",     "value" => 32,    "parcelado" => 8,   "prazo" => 1),
  array( "elo" => "prata",      "value" => 48,    "parcelado" => 12,  "prazo" => 1),
  array( "elo" => "ouro",       "value" => 60,    "parcelado" => 15,  "prazo" => 1),
  array( "elo" => "platina",    "value" => 80,    "parcelado" => 20,  "prazo" => 1),
  array( "elo" => "diamante",   "value" => 200,   "parcelado" => 50,  "prazo" => 2),
  array( "elo" => "mestre",     "value" => 160,   "parcelado" => 0,   "prazo" => 4),
  array( "elo" => "grao-mestre","value" => 900,   "parcelado" => 0,   "prazo" => 7),
  array( "elo" => "desafiante", "value" => 2000,  "parcelado" => 0,   "prazo" => 15)
];
* @var Table 
* Create a table with the same structure and start in the FUNCTION setJOBX
* Minimum ELOS = 9 
**/

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
header('Content-Type: application/json; charset=utf-8');

$Parameters = array(
  'servico' =>          $_POST["servico"] ?? null,
  'ligaatual' =>        $_POST["atualelo"] ?? null,
  'divisaoatual' =>     $_POST["atualdivisao"] ?? null,
  'ligadesejada' =>     $_POST["deseelo"] ?? null,
  'divisaodesejada' =>  $_POST["desedivisao"] ?? null,
  //'fila' =>             $'solo/duo'
);

if (!in_array(strtolower($_POST["servico"]) , SERVICES, true))
{
  $Error = array("Code" => 4, "Mensagem" => 'Servico invalido');
  echo json_encode($Error); exit;
}

  if($Parameters["servico"] == 'duoboost'){
    $CalculateElo = new DuoBooster($Parameters);
  }
  if($Parameters["servico"] == 'eloboost'){
    $CalculateElo = new EloBooster($Parameters);
  }
  if($Parameters["servico"] == 'md10'){
    //$CalculateElo = new DuoBooster($Parameters);
  }


try{
   /**
     * @var Table 
     * @param Array[array()...]
    
     $CalculateElo->setJOBX(@var);
    */

    /**
     * Calculation results Within an array
     * @param Variable->startBooster()["Value"]
     */
    $Resultados = $CalculateElo->startBooster();

    echo json_encode($Resultados);

}catch(MyException $e){
  echo json_encode($e->errorJOBX());
}
}

?>