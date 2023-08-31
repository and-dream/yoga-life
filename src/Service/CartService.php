<?php

namespace App\Service;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{

    private $repo;
    private $rs;

    public function __construct(ProduitRepository $repo, RequestStack $rs)
    {
        $this->rs = $rs;
        $this->repo = $repo;
    }

    public function add($id)
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);
        $qty = $session->get('qty', 0);

        if(!empty($cart[$id]))
        {
            $cart[$id]++;
            $qty++;
        }else{
            $qty++;
            $cart[$id] =1;
        }

        $session->set('cart', $cart);
        $session->set('qty', $qty);
    }


    public function remove($id)
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);
        $qty = $session->get('qty', 0);

        if(!empty($cart[$id]))
        {
            $qty -= $cart[$id];
            unset($cart[$id]);
        }

        if($qty < 0)
        {
            $qty = 0;
        }
        $session->set('qty', $qty);
        $session->set('cart', $cart);
    }


    public function getCartWithData()
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);
        $cartWithData = [];
        
        foreach ($cart as $id => $quantity)
    {
        $cartWithData[] = [
            'product' => $this->repo->find($id),
            'quantity' => $quantity
        ];
    }
        return $cartWithData;
    }


    public function getTotal()
    {
        $total = 0;

        foreach($this->getCartWithData() as $item)
        {
            $sousTotal = $item['product']->getPrice() * $item['quantity'];
            $total += $sousTotal;
        }
        return $total;
    }

    
}