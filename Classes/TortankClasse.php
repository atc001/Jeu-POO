<?php

    require_once('PokemonClasse.php');

    class Tortank extends Pokemon {
        
        private $pistolet_eau = 25;
        private $hydraucanon = 5;
        private $abri = 3;
                
            public function dommage($enemy) {
                $pistolet_eau_count = 0;
                if($this->pistolet_eau > 0) {
                    if($this->pistolet_eau < 5) {
                        $pistolet_eau_count = rand(1, $this->pistolet_eau);
                    } else {
                        $pistolet_eau_count = rand(1, 5);
                    }
                    $enemy->blessure($this->get_puissance() + $pistolet_eau_count);
                    $this->pistolet_eau = $this->pistolet_eau - $pistolet_eau_count;
                } else if($this->pistolet_eau == 0) {
                    $this->pistolet_eau = 25;
                } else {
                    throw new Exception ("Problème de PP " . $this->pistolet_eau);
                }
            }

            public function dommage_bis($enemy) {
                if($this->hydraucanon > 0) {
                    $enemy->blessure($this->get_puissance() + rand (0, 10));
                    $this->hydraucanon = $this->hydraucanon - 1;
                } else if($this->hydraucanon == 0) {
                    //On ne peut pas lancer hydraucanon
                } else {
                    throw new Exception ("Problème de PP " . $this->hydraucanon);
                }
            }

            public function blessure($dommage) {
                if(($dommage - $this->abri) <= 0) {
                    //Aucun dégat est fait
                } else {
                    $this->pv = $this->get_pv() - ($dommage - $this->abri);
                }
            }
        
    }