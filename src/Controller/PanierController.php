<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\RequestStack;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(CartService $cs)
    {
        return $this->render('panier/index.html.twig', [
            'items' => $cs->getCartWithData(),
            'total' => $cs->getTotal()
        ]);
    }

    #[Route('/panier/add/{id}', name: 'ajout_panier')]
    public function add($id, CartService $cs)
    {
        $cs->add($id);
        return $this->redirectToRoute('accueil');
    }

    #[Route('/panier/remove/{id}', name: 'suppression_panier')]
    public function remove($id, CartService $cs)
    {
        $cs->remove($id);
        return $this->redirectToRoute('panier');
    }
}
