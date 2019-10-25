<?php
#Author: DIEGO  CASALLAS
#Date: 21/03/2019
#Description : Is connection data 
    class DtoConnection {
    private $user;
    private $password;
    private $server;
    private $database;

    function __construct(){ 
       /* $this->user="jacmotor";
        $this->password="FzSFzpF^O$0N";
        $this->server="localhost";
        $this->database="jacmotor_wordpress2019";*/
        $this->user="jacmotor_admin19";
        $this->password="yp8Q{$UbD2DE";
        $this->server="localhost";
        $this->database="jacmotor_wordpress2019";
        /*$this->user="root";
        $this->password="";
        $this->server="localhost";
        $this->database="u725020941_wp";*/
        }
        public function getUser()
        {
            return $this->user;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function getServer()
        {
            return $this->server;
        }
        public function getDataase()
        {
            return $this->database;
        }
        public function getData(){
                
            return array($this->server,$this->user,$this->password,$this->database);
        }
    }
?> 