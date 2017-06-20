<?php

class Rendu {

    private $color = "black";
    private $error_color = "red";
    private $success_color = "green";
    private $other_color = "blue";
    private static $_instance = null;

    private function __construct() {

    }

    public static function get_instance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new Rendu();
        }
        return self::$_instance;
    }

    public function message($string) {
        echo "<p style='color:" . $this->color . "'>" . $string . "</p>";
    }

    public function erreur($string) {
        echo "<p style='color:" . $this->error_color . "'>" . $string . "</p>";
    }

    public function success($string) {
        echo "<p style='color:" . $this->success_color . "; font-size: 30px;'>" . $string . "</p>";
    }

    public function autre($string) {
        echo "<p style='color:" . $this->other_color . "'>" . $string . "</p>";
    }
    
//    public function action_tour($string, $string_bis) {
//        echo "<div class='tour'>";
//        echo "<p style='" . $this->color . "'>" . $string . "</p>";
//        echo "<p style='" . $this->other_color . "'>" . $string_bis . "</p>";
//        echo "</div>";
//    }
}