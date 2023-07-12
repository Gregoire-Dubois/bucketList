<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main_home")
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route("/aboutUs", name="aboutUs")
     */
    /**
     * @Route("/aboutUs", name="aboutUs")
     */
    public function aboutUs(SerializerInterface $serializer)
    {
// Chemin vers le fichier JSON
        $jsonFile = $this->getParameter('kernel.project_dir') . '/src/data/team.json';

        // Lecture du fichier JSON
        $jsonData = file_get_contents($jsonFile);

        // Désérialisation des données JSON
        $data = $serializer->decode($jsonData, 'json');

        return $this->render('main/aboutUs.html.twig', [
            "personnes" => $data["personnes"]
        ]);

    }

}