<?php
#Author: DIEGO CASALLAS
#Date: 16/09/2019
#Description : Is BO Quote
include "../class/connectionDB.php";
header("Content-Type: application/json;charset=utf-8");
class BoQuote
{
    private $objConntion;
    private $arrayResult;
    private $intValidatio;

    public function __construct()
    {
        $this->objConntion = new Connection();
        $this->arrayResult = array();
        $this->intValidatio;
    }
    #Description : Function for select all city
    public function selectCitys()
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("CALL sp_city()")) {
                    while ($row = $result->fetch_assoc()) {

                        $this->arrayResult[] =  array('id_city'=>$row['id_city'],'name_city'=>$row['name_city']); 
                       
                    };
                    $result->free();
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
        }
        return json_encode($this->arrayResult);
    }
    #Description : Function for select all Branch Office
    public function selectBranchOffice()
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("CALL sp_branch_office()")) {
                    while ($row = $result->fetch_assoc()) {
                        $this->arrayResult[] =  array('id_branch_office'=>$row['id_branch_office'],'name_branch_office'=>$row['name_branch_office'],'addres_branch_office'=>$row['addres_branch_office']); 
                    };
                    $result->free();
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";

        }

        return json_encode($this->arrayResult);
    }
    #Description : Function for select all Line car
    public function selectLine()
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if (!$con->connect_errno) {
                
                if ($result = $con->query("CALL sp_line()")) {
                    
                    while ($row = $result->fetch_assoc()) {
                        $this->arrayResult[] =  array('id_line'=>$row['id_line'],'name_line'=>$row['name_line']); 
                    };
                    $result->free();
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
        }
        return json_encode($this->arrayResult);
    }
    public function selectQuote()
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("CALL sp_quote()")) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $this->arrayResult[] = $row;
                    };
                    mysqli_free_result($result);
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
        }
        return json_encode($this->arrayResult);
    }
    public function selectKM()
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("CALL sp_mp()")) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $this->arrayResult[] = $row;
                    };
                    mysqli_free_result($result);
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
        }
        return json_encode($this->arrayResult);
    }
    public function selectMP($line, $mp)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                $srtQuery = 'CALL sp_mp_cost(' . $line . ',' . $mp . ')';
                if ($result = $con->query($srtQuery)) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $this->arrayResult[] = $row;
                    };
                    mysqli_free_result($result);
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
        }
        return json_encode($this->arrayResult);
    }
    public function sendQuote($name, $mail, $cellphone, $line, $km, $model, $doc, $city)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                $srtQuery='CALL sp_create_quote("'.$doc.'","'.$model.'","'.$name.'","'.$mail.'","'.$cellphone.'",'.$line.','.$km.','.$city.')';
                //echo $srtQuery;
                if ($result = $con->query($srtQuery)) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $this->arrayResult[] = $row;
                    };
                    mysqli_free_result($result);
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
        }
        return json_encode($this->arrayResult);
    }   
    public function getQuote($code)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                $srtQuery='SELECT QUO.date_quote,QUO.id_line,QUO.id_mp,BOF.name_branch_office,MP.name_mp, LINE.name_line, name_client,mail_client,cellphone_client,model_quote,document_client,code_quote, date_quote FROM wp_quote QUO INNER JOIN wp_city CITY ON QUO.id_city=CITY.id_city INNER JOIN wp_line LINE ON QUO.id_line=LINE.id_line INNER JOIN wp_mp MP ON QUO.id_mp=MP.id_mp INNER JOIN wp_branch_office BOF ON CITY.id_city=BOF.id_city WHERE code_quote="'.$code.'"';
               // $srtQuery = 'CALL sp_mp_cost(' . $line . ',' . $mp . ')';
                if ($result = $con->query($srtQuery)) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $this->arrayResult[] = $row;
                    };
                    mysqli_free_result($result);
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
        }
        return json_encode($this->arrayResult);
    }

}
$obj = new BoQuote();
$getData = file_get_contents('php://input');
$data = json_decode($getData);
/**********CREATE ************/
if (isset($data->POST)) {
    if ($data->POST == "CITY") {
        echo $obj->selectCitys();
    }

}
if (isset($data->POST)) {
    if ($data->POST == "OFFICE") {
        echo $obj->selectBranchOffice();
    }

}
if (isset($data->POST)) {
    if ($data->POST == "LINE") {
        echo $obj->selectLine();
    }

}
if (isset($data->POST)) {
    if ($data->POST == "KM") {
        echo $obj->selectKM();
    }

}
if (isset($data->POST)) {
    if ($data->POST == "MP") {
        echo $obj->selectMP($data->line, $data->mp);
    }

}
if (isset($data->POST)) {
    if ($data->POST == "CREATE") {
        echo $obj->sendQuote($data->name, $data->mail, $data->cellphone, $data->idLine, $data->idMP, $data->model, $data->doc, $data->city);
    }
}
if (isset($data->POST)) {
    if ($data->POST == "QUOTE") {
        echo $obj->selectQuote();
    }
}

//echo $obj->sendQuote("Diego","Diego","30234567", 1, 1, "2019", "899989", 1);

//echo $obj->selectMP(1,1);
//echo "<br>Separador <br>";
//echo $obj->selectBranchOffice(1);
//echo $obj->selectQuote();
