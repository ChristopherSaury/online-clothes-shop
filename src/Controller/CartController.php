<?php

namespace App\Controller;

use App\Repository\ClothesRepository;
use App\Repository\ShoesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function cart(Request $request, ClothesRepository $clothes, ShoesRepository $shoes): Response
    {
        $session = $request->getSession();
        $clothes_cart = $session->get('clothes_cart', []);
        $shoes_cart = $session->get('shoes_cart', []);

        $clothes_dataCart = [];
        $total_clothes = 0;

        $shoes_dataCart = [];
        $total_shoes = 0;

        foreach ($clothes_cart as $id => $quantity){
           $clothes_product = $clothes->find($id);
           $clothes_dataCart[] = [
            'clothes' => $clothes_product,
            'quantity' => $quantity
           ];
           $total_clothes += $clothes_product->getPrice() * $quantity;
            
        }

        foreach ($shoes_cart as $id => $quantity){
            $shoes_product = $shoes->find($id);
            $shoes_dataCart[] = [
                'shoes' => $shoes_product,
                'quantity' => $quantity
            ];

            $total_shoes += $shoes_product->getPrice() * $quantity;
        }

        $total_cart = $total_clothes + $total_shoes;
        
        return $this->render('cart/cart.html.twig', compact('clothes_dataCart', 'shoes_dataCart', 'total_cart'));
    }

    #[Route('/cart/add/clothes/{id}', name:'add_to_clothes')]
    public function addClothesCart($id, Request $request){
        $session = $request->getSession();

        $clothes_cart = $session->get('clothes_cart', []);

        if(!empty($clothes_cart[$id])){
            $clothes_cart[$id]++;
        }else{
            $clothes_cart[$id] = 1;
        }

        $session->set('clothes_cart', $clothes_cart);
        
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/remove/clothes/{id}', name:'remove_clothes_cart')]
    public function removeClothesCart($id, Request $request){
        $session = $request->getSession();
        $clothes_cart = $session->get('clothes_cart', []);

        if(!empty($clothes_cart[$id])){
            if($clothes_cart[$id] > 1){
                $clothes_cart[$id]--;
            }else{
                unset($clothes_cart[$id]);
            }
        }else{
            $clothes_cart[$id] = 1;
        }

        $session->set('clothes_cart', $clothes_cart);
        
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/delete/clothes/{id}', name:'delete_clothes_cart')]
    public function deleteClothesCart($id, Request $request){
        $session = $request->getSession();
        $clothes_cart = $session->get('clothes_cart', []);

        if(!empty($clothes_cart[$id])){
            unset($clothes_cart[$id]);
        }

        $session->set('clothes_cart', $clothes_cart);
        
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/add/shoes/{id}', name:'add_to_shoes')]
    public function addShoesCart($id, Request $request){
        $session = $request->getSession();

        $shoes_cart = $session->get('shoes_cart', []);

        if(!empty($shoes_cart[$id])){
            $shoes_cart[$id]++;
        }else{
            $shoes_cart[$id] = 1;
        }

        $session->set('shoes_cart', $shoes_cart);
        
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/remove/shoes/{id}', name:'remove_shoes_cart')]
    public function removeShoesCart($id, Request $request){
        $session = $request->getSession();
        $shoes_cart = $session->get('shoes_cart', []);

        if(!empty($shoes_cart[$id])){
            if($shoes_cart[$id] > 1){
                $shoes_cart[$id]--;
            }else{
                unset($shoes_cart[$id]);
            }
        }else{
            $shoes_cart[$id] = 1;
        }

        $session->set('shoes_cart', $shoes_cart);
        
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/delete/shoes/{id}', name:'delete_shoes_cart')]
    public function deleteShoesCart($id, Request $request){
        $session = $request->getSession();
        $shoes_cart = $session->get('shoes_cart', []);

        if(!empty($shoes_cart[$id])){
            unset($shoes_cart[$id]);
        }

        $session->set('shoes_cart', $shoes_cart);
        
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/empty', name:'empty_cart')]
    public function emptyCart(Request $request){
        $session = $request->getSession();

        $clothes_cart = $session->get('clothes_cart', []);
        $shoes_cart = $session->get('shoes_cart', []);

        if(!empty($clothes_cart)){
            unset($clothes_cart);
            $session->set('clothes_cart', []);
        }

        if(!empty($shoes_cart)){
            unset($shoes_cart);
            $session->set('shoes_cart', []);
        }

        return $this->redirectToRoute('cart');
    }

}
