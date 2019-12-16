<?php 

    require_once File::build_path(array("model","Model.php"));

class ModelUser {

    private $email;
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $password;
    private $telephone;
    
    
    public function __construct($email = NULL, $nom = NULL, $prenom = NULL, $dateNaissance = NULL, $password = NULL, $telephone = NULL) {
        if (!is_null($email) && !is_null($nom) && !is_null($prenom) && !is_null($dateNaissance) && !is_null($password) && !is_null($telephone)) {
            $this->email = $email;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->dateNaissance = $dateNaissance;
            $this->password = $password;
            $this->telephone = $telephone;
        }
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function save() {
        $sql = "INSERT INTO Ap_User (nom,prenom,dateNaissance,email,password,telephone) VALUES "
                . "(:tag_nom,:tag_prenom,:tag_dob,:tag_mail,:tag_mdp,:tag_tel)";
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_nom" => $this->nom,
            "tag_prenom" => $this->prenom,
            "tag_dob" => $this->dateNaissance,
            "tag_mail" => $this->email,
            "tag_mdp" => $this->password,
            "tag_tel" => $this->telephone,
            
        );
        
        $req_prep->execute($values);
        return true;
    }
    
    public static function verifyExist($email,$pwd) {
        
        $sql = "SELECT COUNT(*) FROM Ap_User WHERE email=:tag_email AND password=:tag_pwd";
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_email" => $email,
            "tag_pwd" => $pwd,
        );
        $req_prep->execute($values);
        
        $req_prep->setFetchMode(PDO::FETCH_NUM);
        $res = $req_prep->fetch();
        
        return ($res[0] != 0);
        
    }
    
    public static function getUserByEmail($email) {
        $sql = "SELECT * FROM Ap_User WHERE email=:tag_email";
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_email" => $email,
        );
        $req_prep->execute($values);
        
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUser');
        $tab = $req_prep->fetchAll();
        
        if (count($tab) > 0) {
            return ($tab[0]);
        }else {
            return null;
        }
    }
    
    public function getUserID() {
        $sql = "SELECT idUser FROM Ap_User WHERE email=:tag_email";
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "tag_email" => $this->email,
        );
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_NUM);
        $tab = $req_prep->fetch();
        
        return $tab[0];
        
        
    }

    
    
    
}

?>