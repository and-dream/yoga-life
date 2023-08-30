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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/membre')]
class AdminMembreController extends AbstractController
{
    #[Route('/', name: 'admin_membre')]
    #[Route('/modifier/{id}', name: 'modifier_membre')]
    public function index(MembreRepository $repo, Request $rq, EntityManagerInterface $manager, Membre $membre =null): Response   
    {
        
        if($membre == null)
        {
            $membre = new Membre;   //nouveau membre ou modifié
            $membre->setDateEnregistrement(new \DateTime);
        }

        $editMode = $membre->getId() !== null;
        $allUsers = $repo->findAll();            // tous les membres à récupérer dans la BDD que je veux afficher
        $form = $this->createForm(AdminMembreType::class, $membre);
        $form->handleRequest($rq);
        
        if ($form->isSubmitted() && $form->isValid()){

            $membre->setDateEnregistrement(new \DateTime);
            // $membre->setPassword(
            //     $passwordHasher->hashPassword(
            //         $membre,
            //         $form->get('plainPassword')->getData()
            //     )
            //     );    

          $manager->persist($membre);
          $manager->flush();

          if($editMode)
          {
             $this->addFlash('success', "Le membre a bien été enregistré");
          }else{
            $this->addFlash('success', "Vous avez bien ajouté un nouveau membre");
          }
          return $this->redirectToRoute('modifier_membre');
        }
         
          $this->addFlash('success',"Vous avez bien ajouté un nouveau membre");
          
          return $this->render('admin_membre/index.html.twig', [
            'formMembre' => $form,
            'editMode' => $editMode,
            'allUsers' => $allUsers,  //afficher tous les users dans la BDD
          ]);
    }     

    #[Route('/supprimer/{id}', name: 'supprimer_membre')]
    public function delete(Membre $membre, EntityManagerInterface $manager)
    {
        $manager->remove($membre);
        $manager->flush();
        return $this->redirectToRoute('admin_membre');
    }

   
}
