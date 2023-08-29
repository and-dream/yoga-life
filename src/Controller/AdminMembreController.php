<?php

namespace App\Controller;

use DateTime;
use App\Entity\Membre;
use App\Form\AdminMembreType;
use App\Form\RegistrationFormType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/membre')]
class AdminMembreController extends AbstractController
{
    #[Route('/', name: 'admin_membre')]
    public function index(MembreRepository $repo, EntityManagerInterface $manager, Membre $membres): Response   //type du return
    {
        $membres = $repo->findAll();

        return $this->render('admin_membre/index.html.twig');
    }  
    
    #[Route('/ajouter', name:'ajouter_membre')]
    #[Route('/modifier{id}', name: 'modifier_membre')]
    public function updateMembre(Request $rq, EntityManagerInterface $manager, Membre $membre =null, UserPasswordHasher $passwordHasher, MembreRepository $repo): Response
    {
        if($membre == null)
        {
            $membre = new Membre;
            $membre->setDateEnregistrement(new DateTime());
        }

        $editMode = $membre->getId() !== null;
        $form = $this->createForm(AdminMembreType::class, $membre);
        $form->handleRequest($rq);
        
        if ($form->isSubmitted() && $form->isValid()){

            $membre->setDateEnregistrement(new \DateTime());
            $membre->setPassword(
                $passwordHasher->hashPassword(
                    $membre,
                    $form->get('plainPassword')->getData()
                )
                );    

          $manager->persist($membre);
          $manager->flush();

          if($editMode)
          {
             $this->addFlash('success', "Le membre a bien été enregistré");
          }else{
            $this->addFlash('success', "Vous avez bien ajouté un nouveau membre");
          }
         
          $this->addFlash('success',"Vous avez bien ajouté un nouveau membre");
          
          return $this->redirectToRoute('ajouter_membre');
        }
        
    }

   
}
