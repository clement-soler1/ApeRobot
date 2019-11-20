<?php

class Security {
    
    private static $seed = 'vvVwobuS2o';

    static public function getSeed() {
       return self::$seed;
    }

    static function chiffrer($texte_en_clair) {
      $texte_a_chiffrer = self::$seed . texte_en_clair . self::$seed;
      $texte_chiffre = hash('sha256', $texte_a_chiffrer);
      return $texte_chiffre;
    }
}
?>
