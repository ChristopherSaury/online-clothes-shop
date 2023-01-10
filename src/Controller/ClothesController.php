<?php

namespace App\Controller;

use App\Entity\ItemType;
use App\Repository\ClothesRepository;
use App\Repository\ColorRepository;
use App\Repository\ItemCategoryRepository;
use App\Repository\ItemTypeRepository;
use App\Repository\SizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClothesController extends AbstractController
{
    #[Route('/clothes/headwear', name: 'clothes_headwear')]
    public function displayHeadwear(ColorRepository $color, ItemCategoryRepository $categorie, ClothesRepository $clothes): Response
    {
        //dd($clothes->getAllHeadwear($categorie));
        return $this->render('clothes/product.html.twig', [
            'controller_name' => 'ClothesController',
            'product_name' => 'Headwear',
            'color' => $color->findAll(),
            'categories' => $categorie->findBy(array('type' => 1)),
            'product' => $clothes->getAllHeadwear($categorie)
            
        ]);
    }
}
