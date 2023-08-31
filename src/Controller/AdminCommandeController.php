<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/commande')]
class AdminCommandeController extends AbstractController
{
    #[Route('/', name: 'app_admin_commande')]
    public function index(CommandeRepository $repo, EntityManagerInterface $manager ): Response
    {
        
        $tab = $manager->getClassMetadata(Commande::class)->getFieldNames();
        $orders = $repo->findAll();

        return $this->render('admin_commande/index.html.twig', [
            'orders' => $orders,
            'tab' => $tab
        ]);
    }

    #[Route('/editer', name: 'editer_commande')]
    public function form(Commande $commande =null, EntityManagerInterface $manager, Request $rq)
    {
        if(!$commande)
        {
            $commande = new Commande;
            $commande->setDateEnregistrement(new \Datetime);
        }
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($rq);

        if($form->isSubmitted() && $form->isValid())
        {
            $product = $commande->getProduit();
            $qty = $commande->getQuantite();

            
        }
    }
}
