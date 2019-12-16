<?php 

require_once File::build_path(array("model","Model.php"));

class ModelVehicule {
    
    private $idVehicule;
    private $marque;
    private $modele;
    private $couleur;
    private $immatriculation;
    private $surnom;
    private $idCreateur;
    
    public function __construct($idv = NULL, $mq = NULL, $mdl = NULL, $col = NULL, $immat = NULL, $snom = NULL, $idc = NULL) {
        if (!is_null($idv) && !is_null($mq) && !is_null($mdl) && !is_null($col) && !is_null($immat) && !is_null($snom) && !is_null($idc)) {
            $this->idVehicule = $idv;
            $this->marque = $mq;
            $this->modele = $mdl;
            $this->couleur = $col;
            $this->immatriculation = $immat;
            $this->surnom = $snom;
            $this->idCreateur = $idc;
        }
    }
    
    public static function getVehicleByPossesors($idP) {
        
        $sql = "SELECT AV.idVehicule,marque,modele,couleur,immatriculation,surnom,idCreateur FROM Ap_PossesVehicule APV JOIN"
                . " Ap_Vehicule AV ON APV.idVehicule=AV.idVehicule WHERE idUser=:tag_idp;";
        
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_idp" => $idP,
        );
        
        $req_prep->execute($values);
        
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVehicule');
        $tab = $req_prep->fetchAll();
        
        return $tab;
        
    }
    
    function getIdVehicule() {
        return $this->idVehicule;
    }

    function getSurnom() {
        return $this->surnom;
    }
    
    public static function getOneCarByPossesors($idP) {
        
        $tab = ModelVehicule::getVehicleByPossesors($idP);
        
        return $tab[0];
        
    }


    
    
}

?>