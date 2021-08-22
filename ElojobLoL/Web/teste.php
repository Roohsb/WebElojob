<?php
$url = "https://example.com/test/1234?email=xyz@test.com";
date_default_timezone_set('America/Bahia');
function Url($o){
  $Querys = parse_url($o);
  parse_str($Querys['query'], $Query);
  return $Query;
}
//echo Url($url)["email"];
function AddMinutes($M, $D){
  $time = new DateTime($D); 
  $time->add(new DateInterval('PT' . $M . 'M')); 
  $Sum = $time->format('Y-m-d H:i:s');
  if($Sum <= date("Y-m-d H:i:s")){
      return true;
  }
  return false;
}

//header('Content-Type: application/json; charset=utf-8');

function JsonJobx($Data){
  $a = array( 'datajobx' => array($Data));
  return json_encode($a);
}




$records = array(
  "ferro" => array(
    "name" => "ferro",
    "IV" => array(
        "nome" => "IV",
        "preco" => 18,
        "prazo" => 1
    ) ,
    "III" => array(
        "nome" => "III",
        "preco" => 18,
        "prazo" => 1
    ) ,
    "II" => array(
        "nome" => "II",
        "preco" => 18,
        "prazo" => 1
    ) ,
    "I" => array(
        "nome" => "I",
        "preco" => 18,
        "prazo" => 1
    )
    ),
    "ferroy" => array(
      "name" => "ferroy",
      "IV" => array(
          "nome" => "IV",
          "preco" => 18,
          "prazo" => 1
      ) ,
      "III" => array(
          "nome" => "III",
          "preco" => 20,
          "prazo" => 1
      ) ,
      "II" => array(
          "nome" => "II",
          "preco" => 20,
          "prazo" => 1
      ) ,
      "I" => array(
          "nome" => "I",
          "preco" => 20,
          "prazo" => 1
      )
      ),
);

//$first_names = array_column($records->IV, 'preco');
//print_r($first_names);

function RomanToNumber($roman){
  $romans = array(
      'M' => 1000,
      'CM' => 900,
      'D' => 500,
      'CD' => 400,
      'C' => 100,
      'XC' => 90,
      'L' => 50,
      'XL' => 40,
      'X' => 10,
      'IX' => 9,
      'V' => 5,
      'IV' => 4,
      'I' => 1,
  );
  $result = 0;
  foreach ($romans as $key => $value) {
      while (strpos($roman, $key) === 0) {
          $result += $value;
          $roman = substr($roman, strlen($key));
      }
  }
  return $result;
}

function numberToRomanRepresentation($number) {
  $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
  $returnValue = '';
  while ($number > 0) {
      foreach ($map as $roman => $int) {
          if($number >= $int) {
              $number -= $int;
              $returnValue .= $roman;
              break;
          }
      }
  }
  return $returnValue;
}



//echo count($records);
/*





function seila($y){
  if($y == 4){
    return 1;
  }
  if($y == 3){
    return 2;
  }
  if($y == 2){
    return 3;
  }
  if($y == 1){
    return 4;
  }
}

 $arrayTeste = [
  array( "prop" => "ferro", "value" => 28, "parcelado" => 7, "prazo" => 1) ,
  array( "prop" => "bronze", "value" => 32, "parcelado" => 8, "prazo" => 1) ,
  array( "prop" => "prata", "value" => 48, "parcelado" => 12, "prazo" => 1) ,
  array( "prop" => "ouro", "value" => 60, "parcelado" => 15, "prazo" => 1) ,
  array( "prop" => "platina", "value" => 80, "parcelado" => 20, "prazo" => 1),
  array( "prop" => "diamante", "value" => 200, "parcelado" => 50, "prazo" => 2),
  array( "prop" => "mestre", "value" => 160, "parcelado" => 0, "prazo" => 4),
  array( "prop" => "grao-mestre", "value" => 900, "parcelado" => 0, "prazo" => 7),
  array( "prop" => "desafiante", "value" => 2000, "parcelado" => 0, "prazo" => 15)
];



$Post = array(
  ['servidor' => 'elojoblol',
  'servico' => 'eloboost',
  'ligaatual' => $_GET["atualelo"],
  'divisaoatual' => $_GET["atualdivisao"],
  'ligadesejada' => $_GET["deseelo"],
  'divisaodesejada' => $_GET["desedivisao"],
  'fila' => 'solo/duo']
);


$valorFinal = 0;
$valorPrazoFinal = 0;
$iniciaSoma = false;
$ValorPorDivisao = 0;
$ValorPorDivisaoDDesejada = 0;
$DivisoDesejada = RomanToNumber($Post[0]["divisaodesejada"]);
$DivisaoAtual = RomanToNumber($Post[0]["divisaoatual"]); //  PELO FATO DO USUARIO JA SER A DIVISAO ;
$IgualSomado = 0;
$zx = 0;

function testex($x,$y){
  $zx = 1;
    for($x > $y; $x--;){
      if($x == $y){
        break;
      }
      $zx++;
    }
    return $zx;
}

function ConvertEloToNumber($i){
  switch($i){
    case 'ferro':
    return 0;
    case 'bronze':
    return 1;
    case 'prata':
    return 2;
    case 'ouro':
    return 3;
    case 'platina':
    return 4;
    case 'diamante':
    return 5;
    case 'mestre':
    return 6;
    case 'grao-mestre':
    return 7;
    case 'desafiante':
    return 8;
  }
}

function DivisoesCorretas($a,$b,$c,$d)
{
  if($a == $b){
    if($c >= $d){
      return true;
    }
  }
  return false;
}


if(ConvertEloToNumber($Post[0]["ligaatual"]) > ConvertEloToNumber($Post[0]["ligadesejada"]) || (DivisoesCorretas($Post[0]["ligaatual"],$Post[0]["ligadesejada"],$DivisoDesejada,$DivisaoAtual))){
  echo 'Elo Invalido';
  echo '</br>Elo / Divisao Atual  '. $_GET["atualelo"] .' '. $_GET["atualdivisao"];
  echo '</br>Elo / Divisao Desejada  '. $_GET["deseelo"] .' '. $_GET["desedivisao"];
  echo '</br>Prazo de '.$valorPrazoFinal.' Dias';
  echo '<style> body{ background-color: black; color: #fff; font-size: 30px; }</style>';
  exit;
}

for ($i = 0;$i < count($arrayTeste);$i++)
{
    if (!$iniciaSoma && $arrayTeste[$i]["prop"] === $Post[0]["ligaatual"])
    {
        if ($Post[0]["ligaatual"] == 'mestre' || $Post[0]["ligaatual"] == 'grao-mestre' || $Post[0]["ligaatual"] == 'desafiante')
        {
            $ValorPorDivisao = intval($arrayTeste[$i]["value"]); // VALOR A SER SOMADO
            $ValorPorPrazoY = $arrayTeste[$i]["prazo"];

        }
        else
        {
            $ValorPorDivisao = intval($arrayTeste[$i]["parcelado"]) * intval($DivisaoAtual - 1); // VALOR A SER SOMADO
            $ValorPorPrazoY = $arrayTeste[$i]["prazo"] * intval($DivisaoAtual - 1); // TALVEZ TIRAR O MENOS 1
            
        }

        $iniciaSoma = true;
    }
    if ($iniciaSoma && ($arrayTeste[$i]["prop"] != $Post[0]["ligadesejada"]) && ($arrayTeste[$i]["prop"] != $Post[0]["ligaatual"]))
    {
        $valorFinal += $arrayTeste[$i]["value"];
        if($arrayTeste[$i]["prop"] == 'mestre' || $arrayTeste[$i]["prop"] == 'grao-mestre' || $arrayTeste[$i]["prop"] == 'desafiante')
        {
          $valorPrazoFinal += $arrayTeste[$i]["prazo"];
        }
        else
        {
          $valorPrazoFinal += $arrayTeste[$i]["prazo"] * 4;
        }
    }



    if ($iniciaSoma && $arrayTeste[$i]["prop"] === $Post[0]["ligadesejada"])
    {
        if ($Post[0]["ligadesejada"] == 'mestre' || $Post[0]["ligadesejada"] == 'grao-mestre' || $Post[0]["ligadesejada"] == 'desafiante')
        {
            $ValorPorDivisaoDDesejada = intval($arrayTeste[$i]["value"]);
            $ValorPorPrazoX = $arrayTeste[$i]["prazo"];
        }
        else
        {
            $ValorPorDivisaoDDesejada = intval($arrayTeste[$i]["parcelado"]) * intval(seila($DivisoDesejada));
            $ValorPorPrazoX = $arrayTeste[$i]["prazo"] * intval(seila($DivisoDesejada)); //AQUI//
        }
        $TESTE = $ValorPorDivisaoDDesejada + $ValorPorDivisao;
        if ($Post[0]["ligaatual"] == $Post[0]["ligadesejada"])
        {
            $valorFinal = intval($arrayTeste[$i]["parcelado"]) * intval(testex($DivisaoAtual, $DivisoDesejada));  
        }
        else
        {
            $valorFinal += $TESTE;
        }
        $TESTE2 = $ValorPorPrazoY + $ValorPorPrazoX;
        $valorPrazoFinal += $TESTE2;
        $iniciaSoma = false;
    }
}





//?atualelo=prata&atualdivisao=II&deseelo=ouro&desedivisao=IV

//echo 'Dividir : '. intval(2 / 120);



echo 'Valor final: '. $valorFinal;
echo '</br>Elo / Divisao Atual  '. $_GET["atualelo"] .' '. $_GET["atualdivisao"];
echo '</br>Elo / Divisao Desejada  '. $_GET["deseelo"] .' '. $_GET["desedivisao"];
echo '</br>Prazo de '.$valorPrazoFinal.' Dias';
echo '<style> body{ background-color: black; color: #fff; font-size: 30px; }</style>';



//ECHO '</br>'. $ValorPorDivisao;
//echo '</br>'.$tesxx;








*/



//require "EloJobx/Essential/JOBXCalculator/Calculator.php";
//require "EloJobx/Essential/JOBXCalculator/Essential.php";
//require "EloJobx/Essential/JOBXCalculator/Exception.php";
//
//use JOBXCalculator\JOBXCalculator\{Calculator,MyException};




//$arrayTeste = [
//  array( "elo" => "ferro", "value" => 28, "parcelado" => 7, "prazo" => 1) ,
//  array( "elo" => "bronze", "value" => 32, "parcelado" => 8, "prazo" => 1) ,
//  array( "elo" => "prata", "value" => 48, "parcelado" => 12, "prazo" => 1) ,
//  array( "elo" => "ouro", "value" => 60, "parcelado" => 15, "prazo" => 1) ,
//  array( "elo" => "platina", "value" => 80, "parcelado" => 20, "prazo" => 1),
//  array( "elo" => "diamante", "value" => 200, "parcelado" => 50, "prazo" => 2),
//  array( "elo" => "mestre", "value" => 160, "parcelado" => 0, "prazo" => 4),
//  array( "elo" => "grao-mestre", "value" => 900, "parcelado" => 0, "prazo" => 7),
//  array( "elo" => "desafiante", "value" => 2000, "parcelado" => 0, "prazo" => 15)
//];
//
//$Post = array('servidor' => 'elojoblol',
//  'servico' => 'eloboost',
//  'ligaatual' => $_GET["atualelo"],
//  'divisaoatual' => $_GET["atualdivisao"],
//  'ligadesejada' => $_GET["deseelo"],
//  'divisaodesejada' => $_GET["desedivisao"],
//  'fila' => 'solo/duo'
//);

//$TesteUse = new Calculator($Post);
//
//try{
//  $TesteUse->setJOBX($arrayTeste);
//  $TesteUse->startBooster();
//  //echo $TesteUse->valorFinal;
//
//}catch(MyException $e){
//  //echo $e;
//  echo $e->customFunction();
//}


//if(!is_array('$arrayTeste') || count($arrayTeste) < 9){
//$error = !is_array('$arrayTeste') ?? 69;
//$error = $error != 69 ? 2 : 1;
//echo $error;
//}


function money_format($format, $number)
    {
        $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.
                  '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
        if (setlocale(LC_MONETARY, 0) == 'C') {
            setlocale(LC_MONETARY, '');
        }
        $locale = localeconv();
        preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
        foreach ($matches as $fmatch) {
            $value = floatval($number);
            $flags = array(
                'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
                               $match[1] : ' ',
                'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
                'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
                               $match[0] : '+',
                'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
                'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
            );
            $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
            $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
            $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
            $conversion = $fmatch[5];
    
            $positive = true;
            if ($value < 0) {
                $positive = false;
                $value  *= -1;
            }
            $letter = $positive ? 'p' : 'n';
    
            $prefix = $suffix = $cprefix = $csuffix = $signal = '';
    
            $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
            switch (true) {
                case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
                    $prefix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
                    $suffix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
                    $cprefix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
                    $csuffix = $signal;
                    break;
                case $flags['usesignal'] == '(':
                case $locale["{$letter}_sign_posn"] == 0:
                    $prefix = '(';
                    $suffix = ')';
                    break;
            }
            if (!$flags['nosimbol']) {
                $currency = $cprefix .
                            ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
                            $csuffix;
            } else {
                $currency = '';
            }
            $space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';
    
            $value = number_format($value, $right, $locale['mon_decimal_point'],
                     $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
            $value = @explode($locale['mon_decimal_point'], $value);
    
            $n = strlen($prefix) + strlen($currency) + strlen($value[0]);
            if ($left > 0 && $left > $n) {
                $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
            }
            $value = implode($locale['mon_decimal_point'], $value);
            if ($locale["{$letter}_cs_precedes"]) {
                $value = $prefix . $currency . $space . $value . $suffix;
            } else {
                $value = $prefix . $value . $space . $currency . $suffix;
            }
            if ($width > 0) {
                $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
                         STR_PAD_RIGHT : STR_PAD_LEFT);
            }
    
            $format = str_replace($fmatch[0], $value, $format);
        }
        return $format;
    }
  

    echo money_format('%n', 8);
