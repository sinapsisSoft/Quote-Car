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
                if ($result = $con->query("SELECT id_city,name_city FROM wp_city")) {
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
    #Description : Function for select all Branch Office
    public function selectBranchOffice()
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("SELECT id_branch_office,name_branch_office, addres_branch_office FROM wp_branch_office")) {
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
    #Description : Function for select all Line car
    public function selectLine()
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("SELECT id_line,name_line FROM wp_line")) {
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
                if ($result = $con->query("SELECT * FROM wp_mp")) {
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
    public function selectMP($line,$mp)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                $srtQuery='SELECT name_article,cost_article_mp, LI.name_line, MP.name_mp FROM wp_article_mp AMP 
                INNER JOIN wp_mp MP ON AMP.id_mp=MP.id_mp
                INNER JOIN wp_line LI ON AMP.id_line=LI.id_line
                INNER JOIN wp_article ART ON AMP.id_article= ART.id_article 
                WHERE AMP.id_line='.$line.' AND AMP.id_mp='.$mp.' ORDER BY name_article ASC';

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
        echo $obj->selectMP($data->line,$data->mp);
    }

}

//echo $obj->selectMP(1,1);
//echo "<br>Separador <br>";
//echo $obj->selectBranchOffice(1);
//echo $obj->selectLine();
