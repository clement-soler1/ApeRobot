<?php
    require_once "../load.koolreport.php";
    class GraphAccueil extends \koolreport\KoolReport {
        
        
        protected function settings() {
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
        
        protected function setup() {
            $sql = "SELECT *"
                    . "FROM table"
                    . "WHERE arg1=:tag_arg1 AND arg2=:tag_arg2";
            $req_prep = Model::$pdo->prepare($sql);
            
            $values = array(
                "tag_arg1" => $this->arg1,
                "tag_arg2" => $this->arg2,
            );

            $req_prep->execute($values);
                $this->src("automaker")
                        ->query($req_prep)
                        ->pipe($this->dataStore("result"));
        }
    }
?>