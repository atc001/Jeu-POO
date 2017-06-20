<?php

    require_once('PokemonClasse.php');

    class Roucarnage extends Pokemon {
        
        private $tornade = 25;
        private $aeropique = 5;
        private $vol;

        public function dommage($enemy) {
            $random_pp = 0;
            if($this->tornade > 0) {
                if($this->tornade < 5) {
                    $random_pp = rand(1, $this->tornade);
                } else {
                    $random_pp = rand(1, 5);
                }
                $enemy->blessure($this->get_puissance() + $random_pp);
                $this->tornade = $this->tornade - $random_pp;
                $this->regeneration_pp();
            } else if($this->tornade == 0) {
                $this->regeneration_pp();
            } else {
                throw new Exception('Erreur de pp' . $this->tornade);
            }
        }

        public function dommage_bis($enemy) {
            if($this->aeropique > 0) {
                $enemy->blessure($this->get_puissance() + rand(1, 10));
                $this->aeropique = $this->aeropique - 1;
            } else if($this->aeropique == 0) {

            } else {
                throw new Exception('Erreur de pp ' . $this->aeropique);
            }
        }

        public function blessure($dommage) {
            $this->vol = rand(1, 5);
            if(($dommage - $this->vol) <= 0) {
                //Aucun dégat est fait
            } else {
                $this->pv = $this->get_pv() - ($dommage - $this->vol);
            }
        }

        private function regeneration_pp() {
            $pp = rand(1, 5);
            $this->tornade = $this->tornade + $pp;
        }
    }