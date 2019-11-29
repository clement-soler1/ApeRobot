<?php

    require File::build_path(array('view','dashboard','load.koolreport.php'));
    require File::build_path(array('view', 'dashboard','graphs', 'koolreport','core', 'src', 'KoolReport.php'));

    class GraphAccueil extends \koolreport\KoolReport {
                
        public function settings() {
            return array(
                "dataSources"=>array(
                    "automaker"=>array(
                        "connectionString"=>"mysql:host=webinfo;dbname=sornayj",
                        "username"=>"sornayj",
                        "password"=>"<wxcvbn,;:!123",
                        "charset"=>"utf8"
                    )
                )
            );
        }
        
        public function setup() {
            $sql = "SELECT dateNaissance FROM Ap_User";
            $this->src("automaker")
                    ->query($sql)
                    ->pipe($this->dataStore("result"));
        }
    }
?>