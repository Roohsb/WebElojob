<?php
    require __ROOT__."/EloJobx/Essential/PHPMailer/PHPMailer.php";
    require __ROOT__."/EloJobx/Essential/PHPMailer/SMTP.php";
    require __ROOT__."/EloJobx/Essential/PHPMailer/Exception.php";
    use PHPMailer\PHPMailer\{PHPMailer,SMTP,Exception};
    class EloTools{
    function BlockAuth($L){switch($L){case 'entrar': return true; case 'cadastrar': return true; case 'redefinir-senha': return true; case 'nova-senha': return true; default: return false;}}
    function NamesRanks($l){switch($l){case 0: return 'Usuario'; case 2: return 'Booster'; case 3: return 'Administrador';}}
    function NewGet($o){$Querys = parse_url($o); if(!isset($Querys["query"])){return false;} parse_str($Querys['query'], $Query); return $Query; }
    function CountPages($Server, $Query, $Ceil) {$CountPage = $Server->prepareStatment($Query); $CountPage->execute(); $query_result = $CountPage->fetchAll(PDO::FETCH_ASSOC); $query_count = $CountPage->rowCount(); return $qtdPag = ceil($query_count / $Ceil);}
    function SomenteNumero($Obejto){$res = preg_replace("/[^0-9.]/", "", "$Obejto"); return $res;}
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

function getToken($length)
{
    function crypto_rand_secure($min, $max){
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}
    function BlockApi($B){
        switch($B){
            case 'calculate-booster':
            return true;
            case 'calculate-coach':
            return true;
            case 'calculate-md10':
            return true;
            case 'lost-password':
            return true;
            default:
            return false;
        }
    }
    function AddMinutes($M, $D){
        $time = new DateTime($D); 
        $time->add(new DateInterval('PT' . $M . 'M')); 
        $Sum = $time->format('Y-m-d H:i:s');
        if($Sum <= date("Y-m-d H:i:s")){
            return true;
        }
        return false;
    }

    function SelectedElo($elo){
        $array = [
            array("elo" => "ferro"),
            array("elo" => "bronze"),
            array("elo" => "prata"),
            array("elo" => "ouro"),
            array("elo" => "platina"),
            array("elo" => "diamante"),
            array("elo" => "mestre"),
            array("elo" => "grao-mestre"),
            array("elo" => "desafiante")
        ];
        foreach($array as $key){
            if($key["elo"] == $elo){
                return '<option value="'.$key["elo"].'" selected="selected">'.ucwords($key["elo"]).'</option>';
            }
        }
    }



    function SelectedDivison($divisao){
        $array = [
            array("division" => "I"),
            array("division" => "II"),
            array("division" => "III"),
            array("division" => "IV"),
        ];
        foreach($array as $key){
            if($key["division"] == $divisao){
                return '<option value="'.$key["division"].'" selected="selected">'.$key["division"].'</option>';
            }
        }
    }

    function sendEloMail($Title, $To, $Body){
      
        $Mail = new PHPMailer(true);
        try{
        $Mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $Mail->isSMTP();
        $Mail->Host = 'mail.localhost:81';
        $Mail->SMTPAuth = true;
        $Mail->Username = 'noreply@localhost:81';
        $Mail->Password = 'KhB$ucm.gpG3';
        $Mail->Port = 587;
        $Mail->setFrom('noreply@localhost:81');

        $Mail->addAddress($To);

        $Mail->isHTML(true);
        $Mail->Subject = $Title;
        $Mail->Body = $Body;
        if($Mail->send()){
           return true;
        }else{
           return false;
        }
    }catch(Exception $error){
        return false;
        }
    }
    //function ThemesJobx($Select){
    //    switch($Select){
    //        case 0:
    //            return 'fancy';
    //            case 1:
    //                return 'night';
    //                default : 
    //                return 'fancy';
    //    }
    
    function LevelsUser($x){
        switch($x){
            case 1:
            return 'Comum';
            case 2:
            return 'Booster';
            case 5:
            return 'Master';
        }
    }

 

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

    function CalcularPorcentagem($Total,$Porcentagem, $Type){
        if($Type == 0){
        $Valor1 = ($Porcentagem / 100) * $Total;
        return $Valor1;
        }else{
            $Valor1 = ($Porcentagem / 100) * $Total;
            return $Valor1;
        }
    }

    

    function MaestriaForech($m){
        $explode = array();
        foreach($m as $k){
            $explode[] = intval(explode("/", $k)[0]); 
        }
        return $explode;
    }


    function MaestriaForech2($m){
        $explode = array();
        foreach($m as $k){
            $explode[] = explode("/", $k)[1]; 
        }
        return $explode;
    }

    function PaymentStatus($Status){
        switch($Status){
            case 1:
            return '<span class="label label-warning">aguardando pagamento</span>';
            case 0:
            return '<span class="label label-danger">cancelado</span>';
            case 2:
            return '<span class="label label-info">pagamento aprovado</span>';
            case 3:
            return '<span class="label label-success">finalizado</span>';
            case 4:
            return '<span class="label label-danger">reclamação</span>';
        }
    }

    function PaymentStatusSearch($Status){
        switch($Status){
            case 'aguardando':
            return 1;
            case 'cancelado':
            return 0;
            case 'aprovado':
            return 2;
            case 'finalizado':
            return 3;
            case 'reclamacao':
            return 4;
            default:
            return 99;
        }
    }

    function ElosImg($elo,$div,$type)
    {
        if($type == 'imagem'){
        if($elo == 'desafiante' || $elo == 'grao-mestre' || $elo == 'mestre'){
            return $elo;
        }
        return  $elo.'_'.$div;
        }
        if($type == 'nome'){
            if($elo == 'desafiante' || $elo == 'grao-mestre' || $elo == 'mestre'){
                return strtoupper($elo);
            } 
            return strtoupper($elo).' '.$div;
        }
        if($type == 'formulario'){
            if($elo == 'desafiante' || $elo == 'grao-mestre' || $elo == 'mestre'){
                return null;
            }
            return $div;
        }

    }

    function Champions($e){
        $Heros = [
            array("HeroID" => "1",   "Name" => "Aatrox"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Aatrox"),
            array("HeroID" => "2",   "Name" => "Ahri"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ahri"),
            array("HeroID" => "3",   "Name" => "Akali"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Akali"),
            array("HeroID" => "4",   "Name" => "Alistar"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Alistar"),
            array("HeroID" => "5",   "Name" => "Amumu"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Amumu"),
            array("HeroID" => "6",   "Name" => "Anivia"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Anivia"),
            array("HeroID" => "7",   "Name" => "Annie"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Annie"),
            array("HeroID" => "150", "Name" => "Aphelios"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Aphelios"),
            array("HeroID" => "8",   "Name" => "Ashe"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ashe"),
            array("HeroID" => "9",   "Name" => "Aurelion Sol"    ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/AurelionSol"),
            array("HeroID" => "10",  "Name" => "Azir"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Azir"),
            array("HeroID" => "11",  "Name" => "Bardo"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Bard"),
            array("HeroID" => "12",  "Name" => "Blitzcrank"      ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Blitzcrank"),
            array("HeroID" => "13",  "Name" => "Brand"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Brand"),
            array("HeroID" => "14",  "Name" => "Braum"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Braum"),
            array("HeroID" => "15",  "Name" => "Caitlyn"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Caitlyn"   ),
            array("HeroID" => "16",  "Name" => "Camille"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Camille"),
            array("HeroID" => "17",  "Name" => "Cassiopeia"      ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Cassiopeia"),
            array("HeroID" => "18",  "Name" => "Cho'Gath"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Chogath"),
            array("HeroID" => "19",  "Name" => "Corki"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Corki"),
            array("HeroID" => "20",  "Name" => "Darius"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Darius"),
            array("HeroID" => "21",  "Name" => "Diana"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Diana"),
            array("HeroID" => "23",  "Name" => "Dr. Mundo"       ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/DrMundo"  ),
            array("HeroID" => "22",  "Name" => "Draven"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Draven"),
            array("HeroID" => "24",  "Name" => "Ekko"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ekko"),
            array("HeroID" => "25",  "Name" => "Elise"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Elise"),
            array("HeroID" => "26",  "Name" => "Evelynn"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Evelynn"),
            array("HeroID" => "27",  "Name" => "Ezreal"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ezreal"),
            array("HeroID" => "28",  "Name" => "Fiddlesticks"    ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Fiddlesticks"),
            array("HeroID" => "29",  "Name" => "Fiora"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Fiora"),
            array("HeroID" => "30",  "Name" => "Fizz"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Fizz"),
            array("HeroID" => "31",  "Name" => "Galio"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Galio"),
            array("HeroID" => "32",  "Name" => "Gangplank"       ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Gangplank"),
            array("HeroID" => "33",  "Name" => "Garen"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Garen"),
            array("HeroID" => "34",  "Name" => "Gnar"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Gnar"),
            array("HeroID" => "35",  "Name" => "Gragas"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Gragas"),
            array("HeroID" => "36",  "Name" => "Graves"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Graves"),
            array("HeroID" => "165", "Name" => "Gwen"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Gwen"),
            array("HeroID" => "37",  "Name" => "Hecarim"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Hecarim"),
            array("HeroID" => "38",  "Name" => "Heimerdinger"    ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Heimerdinger"),
            array("HeroID" => "39",  "Name" => "Illaoi"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Illaoi"),
            array("HeroID" => "40",  "Name" => "Irelia"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Irelia"),
            array("HeroID" => "41",  "Name" => "Ivern"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ivern"),
            array("HeroID" => "42",  "Name" => "Janna"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Janna"),
            array("HeroID" => "43",  "Name" => "Jarvan IV"       ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/JarvanIV"),
            array("HeroID" => "44",  "Name" => "Jax"             ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Jax"),
            array("HeroID" => "45",  "Name" => "Jayce"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Jayce"),
            array("HeroID" => "46",  "Name" => "Jhin"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Jhin"),
            array("HeroID" => "47",  "Name" => "Jinx"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Jinx"),
            array("HeroID" => "48",  "Name" => "Kai\'Sa"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kaisa"),
            array("HeroID" => "49",  "Name" => "Kalista"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kalista"),
            array("HeroID" => "50",  "Name" => "Karma"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Karma"),
            array("HeroID" => "51",  "Name" => "Karthus"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Karthus"),
            array("HeroID" => "52",  "Name" => "Kassadin"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kassadin"),
            array("HeroID" => "53",  "Name" => "Katarina"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Katarina"),
            array("HeroID" => "54",  "Name" => "Kayle"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kayle"),
            array("HeroID" => "55",  "Name" => "Kayn"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kayn"),
            array("HeroID" => "56",  "Name" => "Kennen"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kennen"),
            array("HeroID" => "57",  "Name" => "Kha\'Zix"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Khazix"),
            array("HeroID" => "58",  "Name" => "Kindred"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kindred"),
            array("HeroID" => "59",  "Name" => "Kled"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kled"),
            array("HeroID" => "60",  "Name" => "Kog\'Maw"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/KogMaw"),
            array("HeroID" => "61",  "Name" => "LeBlanc"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Leblanc"),
            array("HeroID" => "62",  "Name" => "Lee Sin"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/LeeSin"),
            array("HeroID" => "63",  "Name" => "Leona"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Leona"),
            array("HeroID" => "154", "Name" => "Lillia"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lillia"),
            array("HeroID" => "64",  "Name" => "Lissandra"       ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lissandra"),
            array("HeroID" => "65",  "Name" => "Lucian"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lucian"),
            array("HeroID" => "66",  "Name" => "Lulu"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lulu"),
            array("HeroID" => "67",  "Name" => "Lux"             ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lux"),
            array("HeroID" => "68",  "Name" => "Malphite"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Malphite"),
            array("HeroID" => "69",  "Name" => "Malzahar"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Malzahar"),
            array("HeroID" => "70",  "Name" => "Maokai"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Maokai"),
            array("HeroID" => "71",  "Name" => "Master Yi"       ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/MasterYi"),
            array("HeroID" => "72",  "Name" => "Miss Fortune"    ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/MissFortune"),
            array("HeroID" => "160", "Name" => "Mordekaiser"     ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Mordekaiser1"),
            array("HeroID" => "75",  "Name" => "Morgana"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Morgana"),    
            array("HeroID" => "76",  "Name" => "Nami"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nami"),
            array("HeroID" => "77",  "Name" => "Nasus"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nasus"),
            array("HeroID" => "78",  "Name" => "Nautilus"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nautilus"),
            array("HeroID" => "79",  "Name" => "Neeko"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Neeko"),
            array("HeroID" => "80",  "Name" => "Nidalee"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nidalee"),
            array("HeroID" => "81",  "Name" => "Nocturne"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nocturne"), 
            array("HeroID" => "82",  "Name" => "Nunu e Willump"  ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nunu"),
            array("HeroID" => "83",  "Name" => "Olaf"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Olaf"),
            array("HeroID" => "84",  "Name" => "Orianna"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Orianna"),
            array("HeroID" => "85",  "Name" => "Ornn"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ornn"),
            array("HeroID" => "86",  "Name" => "Pantheon"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Pantheon"),
            array("HeroID" => "87",  "Name" => "Poppy"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Poppy"),
            array("HeroID" => "88",  "Name" => "Pyke"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Pyke"),
            array("HeroID" => "153", "Name" => "Qiyana"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Qiyana"),
            array("HeroID" => "89",  "Name" => "Quinn"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Quinn"),
            array("HeroID" => "90",  "Name" => "Rakan"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rakan"),
            array("HeroID" => "91",  "Name" => "Rammus"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rammus"),
            array("HeroID" => "92",  "Name" => "Rek\'Sai"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/RekSai"),
            array("HeroID" => "163", "Name" => "Rell"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rell"),
            array("HeroID" => "93",  "Name" => "Renekton"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Renekton"),  
            array("HeroID" => "94",  "Name" => "Rengar"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rengar"),
            array("HeroID" => "95",  "Name" => "Riven"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Riven"),
            array("HeroID" => "96",  "Name" => "Rumble"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rumble"),
            array("HeroID" => "97",  "Name" => "Ryze"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ryze"),
            array("HeroID" => "156", "Name" => "Samira"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Samira"),
            array("HeroID" => "98",  "Name" => "Sejuani"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sejuani"),
            array("HeroID" => "152", "Name" => "Senna"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Senna"),
            array("HeroID" => "162", "Name" => "Seraphine"       ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Seraphine"),
            array("HeroID" => "151", "Name" => "Sett"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sett"),
            array("HeroID" => "99",  "Name" => "Shaco"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Shaco"),
            array("HeroID" => "100", "Name" => "Shen"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Shen"),
            array("HeroID" => "101", "Name" => "Shyvana"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Shyvana"),
            array("HeroID" => "102", "Name" => "Singed"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Singed"),
            array("HeroID" => "103", "Name" => "Sion"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sion"),
            array("HeroID" => "104", "Name" => "Sivir"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sivir" ),
            array("HeroID" => "105", "Name" => "Skarner"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Skarner"),
            array("HeroID" => "106", "Name" => "Sona"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sona"),
            array("HeroID" => "107", "Name" => "Soraka"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Soraka"),
            array("HeroID" => "108", "Name" => "Swain"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Swain"),
            array("HeroID" => "109", "Name" => "Sylas"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sylas"),
            array("HeroID" => "110", "Name" => "Syndra"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Syndra"),
            array("HeroID" => "111", "Name" => "Tahm Kench"      ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/TahmKench"),
            array("HeroID" => "112", "Name" => "Taliyah"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Taliyah"),
            array("HeroID" => "113", "Name" => "Talon"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Talon"),
            array("HeroID" => "114", "Name" => "Taric"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Taric"),
            array("HeroID" => "115", "Name" => "Teemo"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Teemo"),
            array("HeroID" => "116", "Name" => "Thresh"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Thresh"),
            array("HeroID" => "117", "Name" => "Tristana"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Tristana" ),
            array("HeroID" => "118", "Name" => "Trundle"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Trundle"),
            array("HeroID" => "119", "Name" => "Tryndamere"      ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Tryndamere"),
            array("HeroID" => "120", "Name" => "Twisted Fate"    ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/TwistedFate"),
            array("HeroID" => "121", "Name" => "Twitch"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Twitch"),
            array("HeroID" => "122", "Name" => "Udyr"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Udyr"),
            array("HeroID" => "123", "Name" => "Urgot"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Urgot"),
            array("HeroID" => "124", "Name" => "Varus"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Varus"),
            array("HeroID" => "125", "Name" => "Vayne"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Vayne"),
            array("HeroID" => "126", "Name" => "Veigar"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Veigar"),
            array("HeroID" => "127", "Name" => "Vel\'Koz"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Velkoz"),
            array("HeroID" => "128", "Name" => "Vi"              ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Vi"),
            array("HeroID" => "164", "Name" => "Viego"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Viego"),
            array("HeroID" => "129", "Name" => "Viktor"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Viktor"),
            array("HeroID" => "130", "Name" => "Vladimir"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Vladimir"),
            array("HeroID" => "161", "Name" => "Volibear"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Volibear"),
            array("HeroID" => "132", "Name" => "Warwick"         ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Warwick"),
            array("HeroID" => "73",  "Name" => "Wukong"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/MonkeyKing"),
            array("HeroID" => "133", "Name" => "Xayah"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Xayah"),
            array("HeroID" => "134", "Name" => "Xerath"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Xerath"),
            array("HeroID" => "135", "Name" => "Xin Zhao"        ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/XinZhao" ), 
            array("HeroID" => "136", "Name" => "Yasuo"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Yasuo"),
            array("HeroID" => "155", "Name" => "Yone"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Yone"),
            array("HeroID" => "137", "Name" => "Yorick"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Yorick"),
            array("HeroID" => "138", "Name" => "Yuumi"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Yuumi"),
            array("HeroID" => "139", "Name" => "Zac"             ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zac"),
            array("HeroID" => "140", "Name" => "Zed"             ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zed"),
            array("HeroID" => "141", "Name" => "Ziggs"           ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ziggs"),
            array("HeroID" => "142", "Name" => "Zilean"          ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zilean"),
            array("HeroID" => "143", "Name" => "Zoe"             ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zoe"),
            array("HeroID" => "144", "Name" => "Zyra"            ,"Img" => "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zyra")
            ];

            foreach($Heros as $Key){
                if(intval($Key["HeroID"]) == $e){
                    return $Key;
                }
            }
        }
        
        function GameMode($m){
            $Modes = [array(
                "queueId" => 0,
                "map" => "Custom games",
                "description" => null,
                "notes" => null
            ),
            array(
                "queueId" => 2,
                "map" => "Summoner's Rift",
                "description" => "5v5 Blind Pick games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 430"
            ),
            array(
                "queueId" => 4,
                "map" => "Summoner's Rift",
                "description" => "5v5 Ranked Solo games",
                "notes" => "Deprecated in favor of queueId 420"
            ),
            array(
                "queueId" => 6,
                "map" => "Summoner's Rift",
                "description" => "5v5 Ranked Premade games",
                "notes" => "Game mode deprecated"
            ),
            array(
                "queueId" => 7,
                "map" => "Summoner's Rift",
                "description" => "Co-op vs AI games",
                "notes" => "Deprecated in favor of queueId 32 and 33"
            ),
            array(
                "queueId" => 8,
                "map" => "Twisted Treeline",
                "description" => "3v3 Normal games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 460"
            ),
            array(
                "queueId" => 9,
                "map" => "Twisted Treeline",
                "description" => "3v3 Ranked Flex games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 470"
            ),
            array(
                "queueId" => 14,
                "map" => "Summoner's Rift",
                "description" => "5v5 Draft Pick games",
                "notes" => "Deprecated in favor of queueId 400"
            ),
            array(
                "queueId" => 16,
                "map" => "Crystal Scar",
                "description" => "5v5 Dominion Blind Pick games",
                "notes" => "Game mode deprecated"
            ),
            array(
                "queueId" => 17,
                "map" => "Crystal Scar",
                "description" => "5v5 Dominion Draft Pick games",
                "notes" => "Game mode deprecated"
            ),
            array(
                "queueId" => 25,
                "map" => "Crystal Scar",
                "description" => "Dominion Co-op vs AI games",
                "notes" => "Game mode deprecated"
            ),
            array(
                "queueId" => 31,
                "map" => "Summoner's Rift",
                "description" => "Co-op vs AI Intro Bot games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 830"
            ),
            array(
                "queueId" => 32,
                "map" => "Summoner's Rift",
                "description" => "Co-op vs AI Beginner Bot games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 840"
            ),
            array(
                "queueId" => 33,
                "map" => "Summoner's Rift",
                "description" => "Co-op vs AI Intermediate Bot games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 850"
            ),
            array(
                "queueId" => 41,
                "map" => "Twisted Treeline",
                "description" => "3v3 Ranked Team games",
                "notes" => "Game mode deprecated"
            ),
            array(
                "queueId" => 42,
                "map" => "Summoner's Rift",
                "description" => "5v5 Ranked Team games",
                "notes" => "Game mode deprecated"
            ),
            array(
                "queueId" => 52,
                "map" => "Twisted Treeline",
                "description" => "Co-op vs AI games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 800"
            ),
            array(
                "queueId" => 61,
                "map" => "Summoner's Rift",
                "description" => "5v5 Team Builder games",
                "notes" => "Game mode deprecated"
            ),
            array(
                "queueId" => 65,
                "map" => "Howling Abyss",
                "description" => "5v5 ARAM games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 450"
            ),
            array(
                "queueId" => 67,
                "map" => "Howling Abyss",
                "description" => "ARAM Co-op vs AI games",
                "notes" => "Game mode deprecated"
            ),
            array(
                "queueId" => 70,
                "map" => "Summoner's Rift",
                "description" => "One for All games",
                "notes" => "Deprecated in patch 8.6 in favor of queueId 1020"
            ),
            array(
                "queueId" => 72,
                "map" => "Howling Abyss",
                "description" => "1v1 Snowdown Showdown games",
                "notes" => null
            ),
            array(
                "queueId" => 73,
                "map" => "Howling Abyss",
                "description" => "2v2 Snowdown Showdown games",
                "notes" => null
            ),
            array(
                "queueId" => 75,
                "map" => "Summoner's Rift",
                "description" => "6v6 Hexakill games",
                "notes" => null
            ),
            array(
                "queueId" => 76,
                "map" => "Summoner's Rift",
                "description" => "Ultra Rapid Fire games",
                "notes" => null
            ),
            array(
                "queueId" => 78,
                "map" => "Howling Abyss",
                "description" => "One For All => Mirror Mode games",
                "notes" => null
            ),
            array(
                "queueId" => 83,
                "map" => "Summoner's Rift",
                "description" => "Co-op vs AI Ultra Rapid Fire games",
                "notes" => null
            ),
            array(
                "queueId" => 91,
                "map" => "Summoner's Rift",
                "description" => "Doom Bots Rank 1 games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 950"
            ),
            array(
                "queueId" => 92,
                "map" => "Summoner's Rift",
                "description" => "Doom Bots Rank 2 games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 950"
            ),
            array(
                "queueId" => 93,
                "map" => "Summoner's Rift",
                "description" => "Doom Bots Rank 5 games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 950"
            ),
            array(
                "queueId" => 96,
                "map" => "Crystal Scar",
                "description" => "Ascension games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 910"
            ),
            array(
                "queueId" => 98,
                "map" => "Twisted Treeline",
                "description" => "6v6 Hexakill games",
                "notes" => null
            ),
            array(
                "queueId" => 100,
                "map" => "Butcher's Bridge",
                "description" => "5v5 ARAM games",
                "notes" => null
            ),
            array(
                "queueId" => 300,
                "map" => "Howling Abyss",
                "description" => "Legend of the Poro King games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 920"
            ),
            array(
                "queueId" => 310,
                "map" => "Summoner's Rift",
                "description" => "Nemesis games",
                "notes" => null
            ),
            array(
                "queueId" => 313,
                "map" => "Summoner's Rift",
                "description" => "Black Market Brawlers games",
                "notes" => null
            ),
            array(
                "queueId" => 315,
                "map" => "Summoner's Rift",
                "description" => "Nexus Siege games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 940"
            ),
            array(
                "queueId" => 317,
                "map" => "Crystal Scar",
                "description" => "Definitely Not Dominion games",
                "notes" => null
            ),
            array(
                "queueId" => 318,
                "map" => "Summoner's Rift",
                "description" => "ARURF games",
                "notes" => "Deprecated in patch 7.19 in favor of queueId 900"
            ),
            array(
                "queueId" => 325,
                "map" => "Summoner's Rift",
                "description" => "All Random games",
                "notes" => null
            ),
            array(
                "queueId" => 400,
                "map" => "Summoner's Rift",
                "description" => "5v5 Draft Pick games",
                "notes" => null
            ),
            array(
                "queueId" => 410,
                "map" => "Summoner's Rift",
                "description" => "5v5 Ranked Dynamic games",
                "notes" => "Game mode deprecated in patch 6.22"
            ),
            array(
                "queueId" => 420,
                "map" => "Summoner's Rift",
                "description" => "Rankeada Solo",
                "notes" => null
            ),
            array(
                "queueId" => 430,
                "map" => "Summoner's Rift",
                "description" => "5v5 Blind Pick games",
                "notes" => null
            ),
            array(
                "queueId" => 440,
                "map" => "Summoner's Rift",
                "description" => "5v5 Ranked Flex games",
                "notes" => null
            ),
            array(
                "queueId" => 450,
                "map" => "Howling Abyss",
                "description" => "5v5 ARAM games",
                "notes" => null
            ),
            array(
                "queueId" => 460,
                "map" => "Twisted Treeline",
                "description" => "3v3 Blind Pick games",
                "notes" => "Deprecated in patch 9.23"
            ),
            array(
                "queueId" => 470,
                "map" => "Twisted Treeline",
                "description" => "3v3 Ranked Flex games",
                "notes" => "Deprecated in patch 9.23"
            ),
            array(
                "queueId" => 600,
                "map" => "Summoner's Rift",
                "description" => "Blood Hunt Assassin games",
                "notes" => null
            ),
            array(
                "queueId" => 610,
                "map" => "Cosmic Ruins",
                "description" => "Dark Star => Singularity games",
                "notes" => null
            ),
            array(
                "queueId" => 700,
                "map" => "Summoner's Rift",
                "description" => "Clash games",
                "notes" => null
            ),
            array(
                "queueId" => 800,
                "map" => "Twisted Treeline",
                "description" => "Co-op vs. AI Intermediate Bot games",
                "notes" => "Deprecated in patch 9.23"
            ),
            array(
                "queueId" => 810,
                "map" => "Twisted Treeline",
                "description" => "Co-op vs. AI Intro Bot games",
                "notes" => "Deprecated in patch 9.23"
            ),
            array(
                "queueId" => 820,
                "map" => "Twisted Treeline",
                "description" => "Co-op vs. AI Beginner Bot games",
                "notes" => null
            ),
            array(
                "queueId" => 830,
                "map" => "Summoner's Rift",
                "description" => "Co-op vs. AI Intro Bot games",
                "notes" => null
            ),
            array(
                "queueId" => 840,
                "map" => "Summoner's Rift",
                "description" => "Co-op vs. AI Beginner Bot games",
                "notes" => null
            ),
            array(
                "queueId" => 850,
                "map" => "Summoner's Rift",
                "description" => "Co-op vs. AI Intermediate Bot games",
                "notes" => null
            ),
            array(
                "queueId" => 900,
                "map" => "Summoner's Rift",
                "description" => "URF games",
                "notes" => null
            ),
            array(
                "queueId" => 910,
                "map" => "Crystal Scar",
                "description" => "Ascension games",
                "notes" => null
            ),
            array(
                "queueId" => 920,
                "map" => "Howling Abyss",
                "description" => "Legend of the Poro King games",
                "notes" => null
            ),
            array(
                "queueId" => 940,
                "map" => "Summoner's Rift",
                "description" => "Nexus Siege games",
                "notes" => null
            ),
            array(
                "queueId" => 950,
                "map" => "Summoner's Rift",
                "description" => "Doom Bots Voting games",
                "notes" => null
            ),
            array(
                "queueId" => 960,
                "map" => "Summoner's Rift",
                "description" => "Doom Bots Standard games",
                "notes" => null
            ),
            array(
                "queueId" => 980,
                "map" => "Valoran City Park",
                "description" => "Star Guardian Invasion => Normal games",
                "notes" => null
            ),
            array(
                "queueId" => 990,
                "map" => "Valoran City Park",
                "description" => "Star Guardian Invasion => Onslaught games",
                "notes" => null
            ),
            array(
                "queueId" => 1000,
                "map" => "Overcharge",
                "description" => "PROJECT => Hunters games",
                "notes" => null
            ),
            array(
                "queueId" => 1010,
                "map" => "Summoner's Rift",
                "description" => "Snow ARURF games",
                "notes" => null
            ),
            array(
                "queueId" => 1020,
                "map" => "Summoner's Rift",
                "description" => "One for All games",
                "notes" => null
            ),
            array(
                "queueId" => 1030,
                "map" => "Crash Site",
                "description" => "Odyssey Extraction => Intro games",
                "notes" => null
            ),
            array(
                "queueId" => 1040,
                "map" => "Crash Site",
                "description" => "Odyssey Extraction => Cadet games",
                "notes" => null
            ),
            array(
                "queueId" => 1050,
                "map" => "Crash Site",
                "description" => "Odyssey Extraction => Crewmember games",
                "notes" => null
            ),
            array(
                "queueId" => 1060,
                "map" => "Crash Site",
                "description" => "Odyssey Extraction => Captain games",
                "notes" => null
            ),
            array(
                "queueId" => 1070,
                "map" => "Crash Site",
                "description" => "Odyssey Extraction => Onslaught games",
                "notes" => null
            ),
            array(
                "queueId" => 1090,
                "map" => "Convergence",
                "description" => "Teamfight Tactics games",
                "notes" => null
            ),
            array(
                "queueId" => 1100,
                "map" => "Convergence",
                "description" => "Ranked Teamfight Tactics games",
                "notes" => null
            ),
            array(
                "queueId" => 1110,
                "map" => "Convergence",
                "description" => "Teamfight Tactics Tutorial games",
                "notes" => null
            ),
            array(
                "queueId" => 1111,
                "map" => "Convergence",
                "description" => "Teamfight Tactics test games",
                "notes" => null
            ),
            array(
                "queueId" => 1200,
                "map" => "Nexus Blitz",
                "description" => "Nexus Blitz games",
                "notes" => "Deprecated in patch 9.2"
            ),
            array(
                "queueId" => 1300,
                "map" => "Nexus Blitz",
                "description" => "Nexus Blitz games",
                "notes" => null
            ),
            array(
                "queueId" => 2000,
                "map" => "Summoner's Rift",
                "description" => "Tutorial 1",
                "notes" => null
            ),
            array(
                "queueId" => 2010,
                "map" => "Summoner's Rift",
                "description" => "Tutorial 2",
                "notes" => null
            ),
            array(
                "queueId" => 2020,
                "map" => "Summoner's Rift",
                "description" => "Tutorial 3",
                "notes" => null
            )
            ];

            foreach($Modes as $Key){
                if(intval($Key["queueId"]) == $m){
                    return $Key;
                }
            }
    }



        function MaestriasTO($sw){
            switch($sw){
                case 'm1':
                return 'M0 até M1';
                case 'm2':
                return 'M1 até M2';
                case 'm3':
                return 'M2 até M3';
                case 'm4':
                return 'M3 até M4';
                case 'm5':
                return 'M4 até M5';
                case 'm6':
                return 'M5 até M6';
                case 'm7':
                return 'M6 até M7';
            }
        }
            function MaestriasValues($sw){
                switch($sw){
                    case 'm1':
                    return 10;
                    case 'm2':
                    return 10;
                    case 'm3':
                    return 15;
                    case 'm4':
                    return 20;
                    case 'm5':
                    return 35;
                    case 'm6':
                    return 20;
                    case 'm7':
                    return 30;
                }
        }
    
        function tirarAcentos($string){
            return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
        }
        

        /**
         *  MELHOR DE 10
         * 
         * FUNCOES  A BAIXO ESPECIFICAMENTE PARA ISSO
         * 
         */
        const ELO_NAME = ["unranked", "ferro", "bronze", "prata", "ouro", "platina", "diamante", "grao-mestre", "mestre","desafiante"];
        const ROUTES = ["flex", "solo/duo"];
        const MODES = ["boost", "duoboost"];
        const DONT_HAVE_DIVISIONS = ['mestre', 'grao-mestre', 'desafiante'];
        const BEST_OF_10_TABLE = [array(
            "Elo" => "unranked",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 5
                    ) ,
                    "flex" => array(
                        "Price" => 5
                    )
                )
            ) ,
            "duoboost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 7
                    ) ,
                    "flex" => array(
                        "Price" => 7
                    )
                )
            )
        ) , array(
            "Elo" => "ferro",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 4
                    ) ,
                    "flex" => array(
                        "Price" => 4
                    )
                )
            ) ,
            "duoboost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 5
                    ) ,
                    "flex" => array(
                        "Price" => 5
                    )
                )
            )
        ) , array(
            "Elo" => "bronze",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 4.5
                    ) ,
                    "flex" => array(
                        "Price" => 4.5
                    )
                )
            ) ,
            "duoboost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" =>5.5
                    ) ,
                    "flex" => array(
                        "Price" => 5.5
                    )
                )
            )
        ) , array(
            "Elo" => "prata",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 5.5
                    ) ,
                    "flex" => array(
                        "Price" => 5.5
                    )
                )
            ) ,
            "duoboost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 6.5
                    ) ,
                    "flex" => array(
                        "Price" => 65
                    )
                )
            )
        ) , array(
            "Elo" => "ouro",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 5.5
                    ) ,
                    "flex" => array(
                        "Price" => 5.5
                    )
                )
            ) ,
            "duoboost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 6.5
                    ) ,
                    "flex" => array(
                        "Price" => 6.5
                    )
                )
            )
        ) , array(
            "Elo" => "platina",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 6.5
                    ) ,
                    "flex" => array(
                        "Price" => 6.5
                    )
                )
            ) ,
            "duoboost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 8.0
                    ) ,
                    "flex" => array(
                        "Price" => 8.0
                    )
                )
            )
        ) , array(
            "Elo" => "diamante",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 10.0
                    ) ,
                    "flex" => array(
                        "Price" => 10.0
                    )
                )
            ) ,
            "duoboost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 15.0
                    ) ,
                    "flex" => array(
                        "Price" => 15.0
                    )
                )
            )
        ) , array(
            "Elo" => "mestre",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 19.0
                    ) ,
                    "flex" => array(
                        "Price" => 19.0
                    )
                )
            ) ,
            "duoboost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 300
                    ) ,
                    "flex" => array(
                        "Price" => 300
                    )
                )
            )
        ) , array(
            "Elo" => "grao-mestre",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 29.0
                    ) ,
                    "flex" => array(
                        "Price" => 29.0
                    )
                )
            ) ,
        ) , array(
            "Elo" => "desafiante",
            "boost" => array(
                "Fila" => array(
                    "solo/duo" => array(
                        "Price" => 50.0
                    ) ,
                    "flex" => array(
                        "Price" => 50.0
                    )
                )
            ) ,
        ) ,
        
        ];

        function SeachBest10($Temporada,$Modo,$Fila,$Quantidade,$Metodo){
            foreach (EloTools::BEST_OF_10_TABLE as $Table){
            if (strtolower($this->tirarAcentos($Temporada)) == $Table["Elo"])
            {
                if($Metodo == 0){
                return '{"status":true,"url":"http://localhost:81/user/md10/comprar","total":' . $Table[$Modo]["Fila"][$Fila]["Price"] * $Quantidade.',"temporada": "'.strtolower($this->tirarAcentos($Temporada)).'","quantidade":'.$Quantidade.',"fila":"'.strtolower($Fila).'","modo":"'.$Modo.'"}';
                break;
                exit;
                }else{ return $Table; break; exit;}
            }
        }
        return '{"status":false, "Mensagem": "Servico nao encontrado"}';
    }


    function TempoIntervalo($time)
    {
        $date_1 = new DateTime($time);
        $date_2 = new DateTime(date("y-m-d h:i:s"));
        $datafinal = $date_2->diff($date_1)->format("%a:%h:%i");
        $explode = explode(":", $datafinal);
        if ($explode[0] != 0)
        {
            $dia = $explode[0] > 1 ? 'dias atrás' : 'dia atrás';
            return $explode[0] . ' ' . $dia;
        }
        if ($explode[1] != 00)
        {
            $hora = $explode[1] > 1 ? 'horas atrás' : 'hora atrás';
            return "$explode[1] $hora";
        }
    
        if ($explode[2] != 00)
        {
            $minutos = $explode[1] > 1 ? 'minutos atrás' : 'minuto atrás';
            return "$explode[2] $minutos";
            
        }else{
            return "há alguns segundos";
        }
    }

    }


