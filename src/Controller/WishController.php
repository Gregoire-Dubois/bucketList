<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wishs_list")
     */
    public function listWischs(): Response
    {
        return  $this->render('wish/wishs.html.twig');
    }

    /**
     * @Route("/detail", name="wishs_detail")
     */
    public function detailWisch()
    {
        return $this->render('wish/detail.html.twig');
    }

}






