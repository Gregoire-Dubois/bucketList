<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    // affiche la liste de tous les wishs
    /**
     * @Route("/wish", name="wishs_list")
     */
        public function listWischs(WishRepository $wishRepository): Response
    {
        $wishs = $wishRepository->findAll();
        return  $this->render('wish/wishs.html.twig', [
            'wishs' => $wishs
        ]);
    }
    // affiche le détail d'un wish
    /**
     * @Route("/detail/{id}", name="wishs_detail")
     */

    public function detailWisch(int $id, WishRepository $wishRepository) :Response
    {

        $wish = $wishRepository ->find($id);

        return $this->render('wish/detail.html.twig',[
            'wish' => $wish
        ]);
    }






}






