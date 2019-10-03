<?php
    #Author: DIEGO CASALLAS
    #Date: 26/09/2019
    #Description : Is PDF Quote
    //include "../bo/bo_quote.php";
    require "../bo/bo_quote.php";
    header("Content-type: application/json; charset=utf-8");
    
    if(isset($_GET['Quo_consec'])) {
        $objBo = new BoQuote();
        $Quo_consec = $_GET['Quo_consec'];
        $json = json_decode($objBo->getQuote($Quo_consec),true); 
        $name = $json[0]['name_client'];
        $mail = $json[0]['mail_client'];
        $celPhone = $json[0]['cellphone_client'];
        $branchOffice = $json[0]['name_branch_office'];
        $line=$json[0]['name_line'];
        $mp=$json[0]['name_mp'];
        $model=$json[0]['model_quote'];
        $idLine=$json[0]['id_line'];
        $idMp=$json[0]['id_mp'];
        $date=$json[0]['date_quote'];
        $jsonArticle = json_decode($objBo->selectMP($idLine,$idMp),JSON_FORCE_OBJECT);
    }
    $html="";
    $htmlEstructur="<!DOCTYPE html>
    <html lang='en'>
    
    <head>
        <title></title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
    
        <style>
            table,
            th,
            td {
                border: 0px;
            }
            
            .table2 {
                border: solid 1px black;
                margin: auto;
                text-align: center;
                border: 1px solid black;
            }
            
            tfoot {
                background: black;
                color: white;
            }
            
            .td-2 {
                text-align: right;
                padding: 5px;
            }
            
            .td-3 {
                text-align: left;
                padding: 5px;
            }
            
            .img-logo {
                width: 200px;
            }
            
            .text-logo {
                color: #00AF50;
                font-weight: bold;
                font-size: 30px;
                text-align: center;
            }
            
            .table-2 {
                position: absolute;
                top: 25px;
                right: 25px;
            }
            
            .table-2 table {
                text-align: left;
                margin-left: 30px;
            }
            
            .text-footer {
                text-align: center;
                width: 400px;
                margin: auto;
                margin-top: auto;
                margin-top: 60px;
            }
            .text-right {
                text-align: right;
            }
        </style>
    </head>
    
    <body>
        <div style='margin-left:50px'>
            <table>
                <tr>
                    <td>
                        <img class='img-logo' src='logo.png'>
                    </td>
                    <td class='text-logo'>
                        Sistemas Web
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <b>Dirección: Calle 224 # 9 - 60 Piso 2</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Ciudad: Bogotá</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Teléfono:018000185393</b>
                    </td>
                </tr>
            </table>
        </div>
        <div class='table-2'>
            <h2 class='text-logo'>COTIZACIÓN</h2>
            <table>
    
                <tr>
                    <td><b>N°: $Quo_consec</b></td>
    
                </tr>
                <tr>
                    <td><b>Fecha:$date</b></td>
                </tr>
                <tr>
                    <td><b>Concesionario: $branchOffice</b></td>
                </tr>
                <tr>
                    <td><b>Línea: $line</b></td>
                </tr>
                <tr>
                    <td><b>Km: $mp</b></td>
                </tr>
                <tr>
                    <td><b>Modelo: $model</b></td>
                </tr>
            </table>
        </div>
    
        <div class='table-3' style='margin-left:50px'>
    
            <table>
                <tr>
                    <td style='background:#00AF50; font-weight: bold; width: 250px;color: white'>CLIENTE</td>
                </tr>
                <tr>
                    <td><b>Cliente: $name</b></td>
    
                </tr>
                <tr>
                    <td><b>Correo: $mail</b></td>
    
                </tr>
                <tr>
                    <td><b>Teléfono: $celPhone</b></td>
    
                </tr>
            </table>
        </div>
    
        <hr>
    
        <table class='table2'>
    
            <tr>
                <th style='width:500px; background:#00AF50; color: white' class='td-3'>DESCRIPCIÓN</th>
                <th style=' background:#00AF50; color: white' class='td-3'>CANTIDAD</th>
                <th style=' background:#00AF50'></th>
                <th style=' width: 50px; background:#00AF50;text-align:center; color: white'>TOTAL</th>
            </tr>
            <tbody>
            ";
            $items="";
            $sumCost=0;
            foreach($jsonArticle as $article){
                $sumCost+=$article['cost_article_mp'];
                $items.="<tr>
                <td class='td-3'>".$article['name_article']."</td><td>1</td><td>$</td><td class='td-2'>".$article['cost_article_mp']."</td>
            </tr>";
          
            }
            $iva=$sumCost*0.19;  
            $total=$iva+$sumCost;
            $tfoot="</tbody>
            <tfoot style='margin-top:50px'>
                <tr>
                    <td colspan='2' class='text-right' style='background:gray;color:white'>Sub Total</td>
                    <td class='text-right' style='background:gray;color:white'>$</td>
                    <td class='td-2' style='background:gray;color:white'>$sumCost</td>
                </tr>
                <tr>
                    <td colspan='2' class='text-right' style='background:gray;color: white'>IVA 19 %</td>
                    <td class='text-right' style='background:gray;color:white'>$</td>
                    <td class='td-2' style='background:gray;color:white'>$iva</td>
                </tr>
    
                <tr>
                    <td colspan='2' class='text-right' style='background:gray;color:white'>Total</td>
                    <td class='text-right' style='background:gray;color:white'>$</td>
                    <td class='td-2 ' style='background:gray;color:white'>$total</td>
                </tr>
            </tfoot>
        </table>
    
        <div class='footer'>
            <p class='text-footer'>
                Todos los precios a cliente son sugeridos. Los precios de mano de obra pueden variar según el taller o ciudad Para más información www.autocom.com.co
            </p>
        </div>";
    $html=$htmlEstructur.$items.$tfoot;
?>
<?php
require '../vendor/autoload.php';


$nameFile = 'solicitud_imprenta'.$Quo_consec.'.pdf';
use Spipu\Html2Pdf\Html2Pdf;

$size=[216,279];
$html2pdf = new Html2Pdf('p',$size,'es','true','UTF-8',[0,0,0,0] );
ob_end_clean();
$html2pdf->writeHTML($html);
$html2pdf->output($nameFile);
?>