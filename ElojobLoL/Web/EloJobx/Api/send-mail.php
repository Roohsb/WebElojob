<?php
require __ROOT__."/EloJobx/Essential/PHPMailer/PHPMailer.php";
require __ROOT__."/EloJobx/Essential/PHPMailer/SMTP.php";
require __ROOT__."/EloJobx/Essential/PHPMailer/Exception.php";


use PHPMailer\PHPMailer\{PHPMailer,SMTP,Exception};

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

    $Mail->addAddress('projecflex@gmail.com');

    $Mail->isHTML(true);
    $Mail->Subject = 'Teste Feito';
    $Mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Creative Email Template HTML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="margin: 0; padding: 0;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
            <tr>
                <td style="padding: 10px 0 30px 0;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                        <tr>
                            <td align="center" bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                <img src="https://www.web-eau.net/images/emailing/creative_logo.png" alt="Creative Email Template" width="250" height="265" style="display: block;" />
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" style="padding: 40px 30px 20px 30px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td style="color: #E56215; font-family: Arial, sans-serif; font-size: 28px;">
                                                        <b>Lorem ipsum dolor!</b>
                                                    </td>
                                                    <td>
                                                        <span style="vertical-align: bottom; float: right; color: #B1D519; font-family: Arial, sans-serif; font-size: 16px;"><i><b>#1 - Janv 2025</b></i></span>
                                                    </td>
                                                </tr>
                                            </table>	
                                        </td>
                                    <tr>
                                        <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed. Morbi porttitor, eget accumsan dictum, nisi libero ultricies ipsum, in posuere mauris neque at erat.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="260" valign="top">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td>
                                                                    <img src="https://www.web-eau.net/images/emailing/design-right.jpg" alt="" width="100%" height="140" style="display: block;" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; text-align: justify;">
                                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed.                                                  
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="font-size: 0; line-height: 0;" width="20">&nbsp;
                                                    </td>
                                                    <td width="260" valign="top">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td>
                                                                    <img src="https://www.web-eau.net/images/emailing/design-left.jpg" alt="" width="100%" height="140" style="display: block;" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; text-align: justify;">
                                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed.
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 30px 30px 30px 30px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="color: #E56215; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
                                            Copyright &reg; Me, My Newsletter - 2020<br/>
                                            <a href="#" style="color: #E56215;"><font color="#E56215">Unsubscribe</font></a> to this newsletter instantly
                                        </td>
                                        <td align="right" width="25%">
                                            <table border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                        <a href="#" style="color: #ffffff;">
                                                            <img src="https://www.web-eau.net/images/emailing/twitter.png" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                                                        </a>
                                                    </td>
                                                    <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                    <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                        <a href="#" style="color: #ffffff;">
                                                            <img src="https://www.web-eau.net/images/emailing/youtube.png" alt="Youtube" width="38" height="38" style="display: block;" border="0" />
                                                        </a>
                                                    </td>
                                                    <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                    <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                        <a href="#" style="color: #ffffff;">
                                                            <img src="https://www.web-eau.net/images/emailing/facebook.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                                                        </a>
                                                    </td>
                                                    </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';
    if($Mail->send()){
        echo 'OK';
    }else{
        echo 'ERRO';
    }

}catch(Exception $error){
    echo "Error = $Mail->ErrorInfo";
}