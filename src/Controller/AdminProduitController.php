<?php

namespace App\Controller;

use DateTime;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin/produit')]
class AdminProduitController extends AbstractController
{
    
    #[Route('/ajouter', name: 'ajouter_produit')]
    #[Route('/modifier/{id}', name: 'modifier_produit')]
    public function formProduct(Request $rq, EntityManagerInterface $manager, Produit $produit =null, SluggerInterface $slugger, ProduitRepository $repo) : Response
    {
        if($produit == null)
        {
            $produit = new Produit;
            $produit->setDateEnregristrement(new DateTime);
        }

        $editMode = $produit->getId() !== null;
        $allProducts = $repo->findAll();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($rq);

        if($form->isSubmitted() && $form->isValid())
        {

            $imageFile = $form->get('photo')->getData();

            if($imageFile){
                $originalFilename = pathinfo($imageFile->getClientOriginalName(),PATHINFO_FILENAME); 
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                    try{
                        $imageFile->move(
                            $this->getParameter('img_upload'), 
                            $newFilename
                        );
                    }catch (FileException $e){

                    }
                    $produit->setPhoto($newFilename);
            } 
            
            
            $manager->persist($produit); 
            $manager->flush();

            if($editMode)
            {
                $this->addFlash('success', "La modification a été faite");
            }else{
               
                $this->addFlash('success', "Vous avez bien ajouté un nouveau produit");              
            }
            return $this->redirectToRoute('ajouter_produit');

        }


        return $this->render('admin_produit/index.html.twig', [
            'form' => $form,
            'allProducts' => $allProducts,
            'editMode' => $produit->getId()!=null
        ]);

    }

   
}