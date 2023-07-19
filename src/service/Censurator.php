<?php

namespace App\service;

use App\Entity\Wish;
use function PHPUnit\Framework\equalToIgnoringCase;

class Censurator
{

    public function __constructor(Wish $wish){

    }

    public function purify($wish)
    {
        $grosMots = array("con", "connard", "enfoiré");
        $titre = $wish->getTitle();
        $description = $wish->getDescription();
        $descriptionPurify="";

        foreach ($grosMots as $moche) {
            // Vérification dans le titre
            if (stripos($titre, $moche) !== false) {
                $titrePurify = str_replace($moche, "*", $titre);
                file_put_contents('test.txt', "Le purify contient" . $titrePurify  ."\n", FILE_APPEND);
            }

            // Vérification dans la description
            if (stripos($description, $moche) !== false) {
                $descriptionPurify = str_replace($moche, "*", $description);
                file_put_contents('test.txt', "Le purify contient" . $descriptionPurify  ."\n", FILE_APPEND);
            }
        }
        return $descriptionPurify;
    }

}