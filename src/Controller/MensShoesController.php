<?php

namespace App\Controller;

use App\Repository\ColorRepository;
use App\Repository\ShoesRepository;
use App\Repository\ItemCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MensShoesController extends AbstractController
{
    #[Route('/shoes/men/sneakers', name: 'shoes_men_sneakers')]
    public function displayMensSneakers(ItemCategoryRepository $categorie, ColorRepository $color, ShoesRepository $shoes, Request $request): Response
    {
        $product_name = 'Mens Sneakers';
        $categories = $categorie->findBy(array('id' => 11));
        $colors = $color->findAll();
        $filter_color = $request->get('colors');
        $filter_sort = $request->get('sort');
        $product = $shoes->getAllShoes($shoes_catId = 11, $filter_color, $filter_sort);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }
        
        return $this->render('product/product.html.twig', compact('product_name', 'categories', 'colors', 'product'));

    }

    #[Route('/shoes/men/sport-shoes', name: 'shoes_men_sport_shoes')]
    public function displayMensSportShoes(ItemCategoryRepository $categorie, ColorRepository $color, ShoesRepository $shoes, Request $request): Response
    {
        $product_name = 'Mens Sport Shoes';
        $categories = $categorie->findBy(array('id' => 13));
        $colors = $color->findAll();
        $filter_color = $request->get('colors');
        $filter_sort = $request->get('sort');
        $product = $shoes->getAllShoes($shoes_catId = 13, $filter_color, $filter_sort);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }
        
        return $this->render('product/product.html.twig', compact('product_name', 'categories', 'colors', 'product'));

    }

    #[Route('/shoes/men/boots', name: 'shoes_men_boots')]
    public function displayMensBoots(ItemCategoryRepository $categorie, ColorRepository $color, ShoesRepository $shoes, Request $request): Response
    {
        $product_name = 'Mens Boots';
        $categories = $categorie->findBy(array('id' => 15));
        $colors = $color->findAll();
        $filter_color = $request->get('colors');
        $filter_sort = $request->get('sort');
        $product = $shoes->getAllShoes($shoes_catId = 15, $filter_color, $filter_sort);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }
        
        return $this->render('product/product.html.twig', compact('product_name', 'categories', 'colors', 'product'));

    }

    #[Route('/shoes/men/dress-shoes', name: 'shoes_men_dress_shoes')]
    public function displayMensDressShoes(ItemCategoryRepository $categorie, ColorRepository $color, ShoesRepository $shoes, Request $request): Response
    {
        $product_name = 'Mens Dress Shoes';
        $categories = $categorie->findBy(array('id' => 17));
        $colors = $color->findAll();
        $filter_color = $request->get('colors');
        $filter_sort = $request->get('sort');
        $product = $shoes->getAllShoes($shoes_catId = 17, $filter_color, $filter_sort);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }
        
        return $this->render('product/product.html.twig', compact('product_name', 'categories', 'colors', 'product'));

    }
}
