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
            }
           
            tfoot{
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
        </style>
    </head>
    
    <body>
        <h2>Cotización N° $Quo_consec</h2>
        <hr>
    
        <table>
    
            <tr>
                <td><b>Cotización N°: $Quo_consec</b></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Cliente: $name</b></td>
                <td> </td>
            </tr>
            <tr>
                <td><b>Correo: $mail</b></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Teléfono: $celPhone</b></td>
                <td></td>
            </tr>
        </table>
        <hr>
        <table class='table2'>
            <tr>
                <th style='width:300px; background:gray'>Concesionario</th>
                <th style='width:100px; background:gray'>Linea</th>
                <th style='width:100px; background:gray'>Km</th>
                <th style='width:100px; background:gray'>Modelo</th>
            </tr>
            <tr>
                <td>$branchOffice</td>
                <td>$line</td>
                <td>$mp</td>
                <td>$model</td>
            </tr>
        </table>
        <table class='table2'>
    
            <tr>
                <th style='width:500px; background:gray' class='td-3'>Ítems</th>
                <th></th>
                <th style='background:gray; width:100px;text-align:center'>Costo</th>
            </tr    >
            <tbody>
            ";
            $items="";
            $sumCost=0;
            foreach($jsonArticle as $article){
                $sumCost+=$article['cost_article_mp'];
                $items.="<tr>
                <td class='td-3'>".$article['name_article']."</td><td>$</td><td class='td-2'>".$article['cost_article_mp']."</td>
            </tr>";
          
            }
            $iva=$sumCost*0.19;  
            $total=$iva+$sumCost;
            $tfoot="</tbody>
            <tfoot>
                <tr>
                    <td class='text-center' style='background:blue'>IVA 19 %</td>
                    <td class='text-right' style='background:blue'>$</td>
                    <td class='td-2'style='background:blue'>$iva</td>
                </tr>
                <tr>
                    <td class='text-center' style='background:blue'>Sub Total</td>
                    <td class='text-right' style='background:blue'>$</td>
                    <td class='td-2'style='background:blue'>$sumCost</td>
                </tr>
                <tr>
                    <td class='text-center' style='background:blue'>Total</td>
                    <td class='text-right' style='background:blue'>$</td>
                    <td class='td-2'style='background:blue'>$total</td>
                </tr>
            </tfoot>
        </table>
    </body>
    </html>";
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