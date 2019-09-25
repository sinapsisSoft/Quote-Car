<?php
#Author: DIEGO CASALLAS
#Date: 27/08/2019
#Description : Is Class Notification
header("Content-type: application/json; charset=utf-8");
class Notification
{

    private $from;
    private $title;
    private $message;
    private $headboard;
    private $to;
    private $cc;
    private $messageContact;

    public function __construct()
    {

        $this->from = "info@sinapsistechnologies.co";
        $this->cc = "wilpul@gmail.com";

    }

    public function __sendUserContact($name, $mail, $cellphone, $line, $km, $model, $doc, $address)
    {
        $this->to = $mail;
        $this->to;

        $this->messageContact = '<p>Plataforma WEB de Cotización APP informa, la creación de una solicitud '
            . '<table>' .
            '<tr><td>Nombre:' . $name . '</td></tr>' .
            '<tr><td>Documento:' . $doc . '</td></tr>' .
            '<tr><td>Teléfono:' . $cellphone . '</td></tr>' .
            '<tr><td>Email:' . $mail . '</td></tr>' .
            '<tr><td>Linea:' . $line . '</td></tr>' .
            '<tr><td>Km:' . $km . '</td></tr>' .
            '<tr><td>Dirección:' . $address . '</td></tr>' .
            '<tr><td>Modelo:' . $model . '</td></tr></table></p>';
    }

    public function selectHeadboard($select)
    {
        // To send an HTML email, the Content-type header must be set
        $this->headboard = 'MIME-Version: 1.0' . "\r\n";
        $this->headboard .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        switch ($select) {

            case 0:
                $this->title = "Solicitud desde la WEB";
                $this->headboard .= 'To:' . $this->to . "\r\n";
                $this->headboard .= 'From:' . $this->from . "\r\n";
                $this->headboard .= 'Cc:' . $this->cc . "\r\n";
                $this->message = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><head><title><b>Solicitud de cotización</b></title></head><body><h5>Cordial saludo,</h5>' . $this->messageContact . '</body></html>';
            break;
        }

    }

    public function sendMail()
    {
        if (mail($this->for, $this->title, $this->message, $this->headboard)) {
            return 1;
        };
        return 0;
    }
}
$getData = file_get_contents('php://input');
$data = json_decode($getData);
/**********CREATE ************/
if (isset($data->POST)) {
    $mail = new Notification();

    if ($data->POST == "MAIL") {
        $mail->__sendUserContact($data->name, $data->mail, $data->cellphone, $data->line, $data->km, $data->model, $data->doc, $data->address);
        $mail->selectHeadboard(0);
        echo $mail->sendMail();
    }

}
