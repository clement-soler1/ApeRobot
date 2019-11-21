<?php

class Security {
    
    private static $seed = '02ZbC7okMy';
    private static $seed2 = 'oJi4nJHr2R';

    static public function getSeed() {
       return self::$seed;
    }
    static public function getSeed2() {
       return self::$seed;
    }

    static function chiffrer($texte_en_clair) {
      $texte_a_chiffrer = self::$seed . $texte_en_clair . self::$seed2;
      $texte_chiffre = hash('sha256', $texte_a_chiffrer);
      return $texte_chiffre;
    }
}
?>
