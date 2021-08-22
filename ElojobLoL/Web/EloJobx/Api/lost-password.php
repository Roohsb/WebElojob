<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST["email"], $_POST["g-recaptcha-response"]) && (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)))
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = ['secret' => REV2, 'response' => $_POST["g-recaptcha-response"], ];
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $res = json_decode($response, true);
        $Token = bin2hex(random_bytes(64));
        if ($res['success'] == true)
        {
            $User = UserSearch($Server, $_POST["email"]);
            if ($User){
                if ($UseLost = UserPassLost($Server, $_POST["email"]))
                { // SE EXISTIR
                    if ($EloTools->AddMinutes(5, $UseLost["date"]))
                    { // SE A DATA FOR OK,
                        GenerateLostPass($Server, $_POST["email"], 2, $Token); // DELETANDO EXISTENTE
                        if (GenerateLostPass($Server, $_POST["email"], 1, $Token))
                        { // SE OCORRER TUDO OK NA INGRESSAO
                            if ($EloTools->sendEloMail('Recuperar Senha - EloJobx', $_POST["email"], '<div>Ola ' . $User["nome"] . ',
                            <br/>
                            <br/>Aqui esta seu Link de recuperação de conta: <a href="http://localhost/user/nova-senha/' . $Token . '">http://localhost/user/nova-senha/' . $Token . '"</a>
                            <br/> Esse Link se expira em 24 Horas
                            <br/>
                            <br/><span>Este é um email automatico , não deve ser respondido</span>
                         </div>'))
                            { // ENVIANDO EMAIL
                                $_SESSION["OKLostPass"] = "O link de recuperação foi enviado para seu email";
                                header("Location: /user/redefinir-senha");
                                exit;
                            }
                            else
                            {
                                $_SESSION["AlertLostPass"] = "Erro interno! ";
                                header("Location: /user/redefinir-senha");
                                exit;
                            }
                        }
                        else
                        {
                            $_SESSION["AlertLostPass"] = "Erro interno! ";
                            header("Location: /user/redefinir-senha");
                            exit;
                        }
                    }
                    else
                    {
                        $_SESSION["AlertLostPass"] = "Aguarde 5 minutos para soliciar outro link! ";
                        header("Location: /user/redefinir-senha");
                        exit;
                    }
                }
                if (GenerateLostPass($Server, $_POST["email"], 1, $Token))
                { // SE OCORRER TUDO OK NA INGRESSAO
                    if ($EloTools->sendEloMail('Recuperar Senha - EloJobx', $_POST["email"], '<div>Ola ' . $User["nome"] . ',
                    <br/>
                    <br/>Aqui esta seu Link de recuperação de conta: <a href="http://localhost/user/nova-senha/' . $Token . '">http://localhost/user/nova-senha/' . $Token . '"</a>
                    <br/> Esse Link se expira em 24 Horas
                    <br/>
                    <br/><span>Este é um email automatico , não deve ser respondido</span>
                    </div>'))
                    { // ENVIANDO EMAIL
                        $_SESSION["OKLostPass"] = "O link de recuperação foi enviado para seu email";
                        header("Location: /user/redefinir-senha");
                        exit;
                    }
                    else
                    {
                        $_SESSION["AlertLostPass"] = "Não foi possivel enviar! ";
                        header("Location: /user/redefinir-senha");
                        exit;
                    }
                }
                else
                {
                    $_SESSION["AlertLostPass"] = "Erro interno! ";
                    header("Location: /user/redefinir-senha");
                    exit;
                }
            }
            else
            {
                $_SESSION["AlertLostPass"] = "Email desconhecido! ";
                header("Location: /user/redefinir-senha");
                exit;
            }
        }
        else
        {
            $_SESSION["AlertLostPass"] = "reCAPTCHA Invalido! ";
            header("Location: /user/redefinir-senha");
            exit;
        }
    }
    else
    {
        $_SESSION["AlertLostPass"] = "Formulario invalido! ";
        header("Location: /user/redefinir-senha");
        exit;
    }
}
else
{
    header("Location: /saguao");
    exit;
}
?>
