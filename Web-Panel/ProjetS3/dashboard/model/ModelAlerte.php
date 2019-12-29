<?php

class ModelAlerte {
    private $id;
    private $date;
    private $time;
    private $capteur;
    private $rank;
    private $titre;
    private $description;
    private $type;
    private $idVehicule;
    
    public function __construct($id = NULL, $d = NULL, $ti = NULL, $cpt = NULL, $rk = NULL, $tit = NULL, $desc = NULL, $ty = NULL, $iv = NULL) {
        if (!is_null($id) && !is_null($d) && !is_null($ti) && !is_null($cpt) && !is_null($rk) && !is_null($tit) && !is_null($desc) && !is_null($ty) && !is_null($iv)) {
            $this->id = $id;
            $this->date = $d;
            $this->time = $ti;
            $this->capteur = $cpt;
            $this->rank = $rk;
            $this->titre = $tit;
            $this->description = $desc;
            $this->type = $ty;
            $this->idVehicule = $iv;
        }
    }
    
    public static function selectAlertByVehicle($idv, $offset, $limit, $order) {
        //Impossible de faire un PDOStatement avec un order by
        switch ($order) {
            case "1":
                $sql = "SELECT * FROM Ap_Alert WHERE idVehicule=:tag_idv ORDER BY date DESC, time DESC LIMIT :tag_off, :tag_lim;";
                break;
            case "2":
                $sql = "SELECT * FROM Ap_Alert WHERE idVehicule=:tag_idv ORDER BY rank DESC LIMIT :tag_off, :tag_lim;";
                break;
            case "3":
                $sql = "SELECT * FROM Ap_Alert WHERE idVehicule=:tag_idv ORDER BY titre LIMIT :tag_off, :tag_lim;";
                break;
            default:
                $sql = "SELECT * FROM Ap_Alert WHERE idVehicule=:tag_idv ORDER BY date DESC, time DESC LIMIT :tag_off, :tag_lim;";
                break;
        }

        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->bindValue(':tag_idv', $idv, PDO::PARAM_INT);
        $req_prep->bindValue(':tag_off', $offset, PDO::PARAM_INT);
        $req_prep->bindValue(':tag_lim', $limit, PDO::PARAM_INT);


        $req_prep->execute();
        
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAlerte');
        $tab = $req_prep->fetchAll();
        
        return $tab;
    }

    public static function selectAlertAccueil($idv, $time) {
        $sql = "SELECT * FROM Ap_Alert WHERE idVehicule=:tag_idv AND date BETWEEN date_sub(now(),INTERVAL ". $time .") AND now() ORDER BY date DESC LIMIT 5";
        
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_idv" => $idv,
        );
        
        $req_prep->execute($values);
        
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAlerte');
        $tab = $req_prep->fetchAll();
        
        return $tab;
    }

    public function rankToColor() {
        switch ($this->rank) {
            case 1:
                return  "alerteVerte";
                
            case 2:
                return  "alerteJaune";
                
            case 3:
                return  "alerteOrange";
                 
            case 4:
                return  "alerteRouge";

            default:
                return  "alerteVerte";
        }
    }

    public function findCapteurIcon() {
        $path = './view/icons/';
        $ext = '.png';
        if ($this->rank <= 2) {
            $ext = '_bk.png';
        }
        switch ($this->capteur) {
            case "temperature":
                return  $path.'temp'.$ext;
                
            default:
                return  $path.'carCrash'.$ext;
        }
    }
    
    public function findTypeIcon() {
        $path = './view/icons/';
        $ext = '.png';
        if ($this->rank <= 2) {
            $ext = '_bk.png';
        }
        switch ($this->type) {
            case "alert":
                return  $path.'report'.$ext;
                
            default:
                return  $path.'report'.$ext;
        }
    }

    public function afficher() {
        
        echo '<div class="alerte '. $this->rankToColor() .'">';
		echo '<img class="iconAlerte" src="'. $this->findTypeIcon() .'">';
		echo '<div class="txtContainerAlerte">';
			echo '<p class="titreAlerte">'. $this->titre .'</p>';
			echo '<p class="textAlerte">'. $this->description .'</p>';
			echo '<p class="timeAlerte"><b>'. $this->date .' - '. $this->time .'</b></p>';
		echo '</div>';
		echo '<img class="iconAlerte" src="'. $this->findCapteurIcon() .'">';
	echo '</div>';
        
        
    }

    public static function white_list(&$value, $allowed, $message) {
        if ($value === null) {
            return $allowed[0];
        }
        $key = array_search($value, $allowed, true);
        if ($key === false) { 
            throw new InvalidArgumentException($message); 
        } else {
            return $value;
        }
    }
    
}

?>
