<?php
#Author: DIEGO  CASALLAS
#Date: 21/03/2019
#Description : Is class connection
include "../dto/dto_connection.php";
header("Content-Type: application/json;charset=utf-8;text/html");

    class Connection
    {
        private $mysqli;
        private $objDto;
        private $getConnection=false;

        public function connect()
        {
            try {
                $objDto = new DtoConnection;
                $dataConnection = $objDto->getData();
                
                $mysqli = new mysqli('localhost', 'jacmotor_admin19', 'yp8Q{$UbD2DE', 'jacmotor_wordpress2019');                
     
                    if ($mysqli->connect_error) {
                        die('Error de Conexión (' . $mysqli->connect_errno . ') '
                                . $mysqli->connect_error);
                    }else{
                        $getConnection=$mysqli;
                        //echo"Completed";
                    }
                    
            }
            catch (PDOException $e) {
                die("Error occurred:" . $e->getMessage());
                $getConnection=false;
            }
            return $getConnection;
        }
    }
      /*$objDto=new Connection();
    $con=$objDto->connect();
    $con->query("SET NAMES 'utf8'");
    
    

if ($result = $con->query("CALL sp_city()")) {
    while ($row = $result->fetch_assoc()) {

        $arrayResult[] =  array('id_city'=>$row['id_city'],'name_city'=>$row['name_city']); 
       
    };
    
    $result->free();
    $con->close();
    echo json_encode($arrayResult);*/
    

 

	


   
    
?>