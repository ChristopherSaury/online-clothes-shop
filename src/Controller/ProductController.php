<?php

namespace App\Controller;

use App\Repository\ClothesRepository;
use App\Repository\ShoesRepository;
use App\Repository\SizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController {
    #[Route('/product/shoes/detail/{id}', name:'shoes_detail')]
    public function shoesDetail($id, ShoesRepository $shoes){
        $product = $shoes->find($id);
        return $this->render('product/shoes-detail.html.twig', compact('product'));
    }

    #[Route('/product/clothes/detail/{id}', name:'clothes_detail')]
    public function clothesDetail($id, ClothesRepository $clothes){
        $product = $clothes->find($id);
        return $this->render('product/clothes-detail.html.twig', compact('product'));
    }
}