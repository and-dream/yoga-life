<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(ProduitRepository $repo): Response
    {
        $produits = $repo->findAll();
        return $this->render('home/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/profil', name:'profil')]
    public function profil(CommandeRepository $repo): Response
    {
        $commandes = $repo->findby(['membre' => $this->getUser()]);
        
        return $this->render('home/profil.html.twig', [
            'commandes' => $commandes
        ]);
    }
}
