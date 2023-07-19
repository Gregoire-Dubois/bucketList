<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use App\service\Censurator;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/create", name="create")
     */
    public function createWish(
        Request $request,
        EntityManagerInterface $entityManager,
        Censurator $censurator
    ) {
        $wish = new Wish();
        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);

        // vérification si submit fait et si valide
        if ($wishForm->isSubmitted() && $wishForm->isValid()) {
            // Purifie le souhait avant de le sauver
            $purifiedDescription = $censurator->purify($wish);
            $wish->setDescription($purifiedDescription);

            // ajoute la date de création
            $wish->setDateCreated(new \DateTime());

            // enregistre en base de données
            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Wish enregistré !!');

            return $this->redirectToRoute('wishs_detail', ['id' => $wish->getId()]);
        }

        return $this->render('wish/create.html.twig', [
            'wishForm' => $wishForm->createView(),
        ]);
    }

}