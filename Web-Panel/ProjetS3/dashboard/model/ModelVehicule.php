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

        if (count($tab) > 0) {
            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getVehicleById($idv) {

        $sql = "SELECT * FROM Ap_Vehicule WHERE idVehicule=:tag_idv;";

        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_idv" => $idv,
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVehicule');
        $tab = $req_prep->fetchAll();

        return $tab[0];

    }

    /**
     * @return null
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @return null
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @return null
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    public function printImmat()
    {
        $immat = $this->immatriculation;
        $str = str_split($immat, 2);
        $str2 = str_split($str[2]);

        $formatedImmat = "" . $str[0] . "-" . $str[1] . $str2[0] . "-" . $str2[1] . $str[3];
        return $formatedImmat;
    }

    public function printAuthorizedPerson() {
        $sql = "SELECT prenom,nom FROM Ap_User APU JOIN"
            . " Ap_PossesVehicule APV ON APV.idUser=APU.idUser WHERE idVehicule=:tag_idv;";

        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_idv" => $this->idVehicule,
        );

        $req_prep->execute($values);
        $tab = $req_prep->fetchAll();

        $strReturn = " ";

        foreach ($tab as $val) {
            $strReturn = $strReturn . ucfirst($val["prenom"]). " " . ucfirst($val["nom"]) . ', ';
        }

        return (substr($strReturn, 0, -2));
    }

    /**
     * @return null
     */
    public function getIdCreateur()
    {
        return $this->idCreateur;
    }

    public static function generateID() {

        $sql = "SELECT MAX(idVehicule) FROM Ap_Vehicule;";

        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();
        $tab = $req_prep->fetch();

        return ($tab[0] + 1);

    }

    public function save() {
        $sql = "INSERT INTO `Ap_Vehicule` (`idVehicule`, `marque`, `modele`, `couleur`, `immatriculation`, `surnom`, `idCreateur`) VALUES (:tag_idv, :tag_mq, :tag_md, :tag_col, :tag_immat, :tag_sn, :tag_idc);";

        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_idv" => $this->idVehicule,
            "tag_mq" => $this->marque,
            "tag_md" => $this->modele,
            "tag_col" => $this->couleur,
            "tag_immat" => $this->immatriculation,
            "tag_sn" => $this->surnom,
            "tag_idc" => $this->idCreateur,
        );

        $req_prep->execute($values);

        $sql2 = "INSERT INTO Ap_PossesVehicule (idUser,idVehicule) VALUES (:tag_idu, :tag_idv);";
        $req_prep2 = Model::$pdo->prepare($sql2);
        $values2 = array(
            "tag_idv" => $this->idVehicule,
            "tag_idu" => $this->idCreateur,
        );
        $req_prep2->execute($values2);
    }

    /**
     * @return null
     */
    public function getImmatriculation()
    {
        return $this->immatriculation;
    }

    public function update($mq,$mo,$col,$immat,$sn) {
        $sql = "UPDATE `Ap_Vehicule` SET `marque`=:tag_mq,`modele`=:tag_md,`couleur`=:tag_col,`immatriculation`=:tag_immat,`surnom`=:tag_sn WHERE `idVehicule`=:tag_idv;";

        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_mq" => $mq,
            "tag_md" => $mo,
            "tag_col" => $col,
            "tag_immat" => $immat,
            "tag_sn" => $sn,
            "tag_idv" => $this->idVehicule,
        );

        $req_prep->execute($values);
    }

    public function partage($idu) {
        $sql2 = "INSERT INTO Ap_PossesVehicule (idUser,idVehicule) VALUES (:tag_idu, :tag_idv);";
        $req_prep2 = Model::$pdo->prepare($sql2);
        $values2 = array(
            "tag_idv" => $this->idVehicule,
            "tag_idu" => $idu,
        );
        $req_prep2->execute($values2);
    }

    public function delete($idv) {
        $sql = "DELETE FROM `Ap_Vehicule` WHERE `idVehicule`=:tag_idv; DELETE FROM `Ap_PossesVehicule` WHERE `idVehicule`=:tag_idv;";
        $req_prep = Model::$pdo->prepare($sql);
        $values['tag_idv'] = $idv;
        $req_prep->execute($values);
    }

}

?>