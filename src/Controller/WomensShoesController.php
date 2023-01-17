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


class WomensShoesController extends AbstractController{
    #[Route('/shoes/women/sneakers', name: 'shoes_women_sneakers')]
    public function displayWomensSneakers(ItemCategoryRepository $categorie, ColorRepository $color, ShoesRepository $shoes, Request $request): Response
    {
        $product_name = 'Womens Sneakers';
        $categories = $categorie->findBy(array('id' => 12));
        $colors = $color->findAll();
        $filter_color = $request->get('colors');
        $filter_sort = $request->get('sort');
        $product = $shoes->getAllShoes($shoes_catId = 12, $filter_color, $filter_sort);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }

        return $this->render('product/product.html.twig', compact('product_name', 'categories', 'colors', 'product'));
}

#[Route('/shoes/women/sport-shoes', name: 'shoes_women_sport_shoes')]
public function displayWomensSportShoes(ItemCategoryRepository $categorie, ColorRepository $color, ShoesRepository $shoes, Request $request): Response
{
    $product_name = 'Womens Sport Shoes';
    $categories = $categorie->findBy(array('id' => 14));
    $colors = $color->findAll();
    $filter_color = $request->get('colors');
    $filter_sort = $request->get('sort');
    $product = $shoes->getAllShoes($shoes_catId = 14, $filter_color, $filter_sort);

    if($request->get('ajax')){
        return new JsonResponse([
            'content' => $this->renderView('product/content.html.twig', compact('product'))
        ]);
    }
    
    return $this->render('product/product.html.twig', compact('product_name', 'categories', 'colors', 'product'));

}

#[Route('/shoes/women/boots', name: 'shoes_women_boots')]
public function displayWomensBoots(ItemCategoryRepository $categorie, ColorRepository $color, ShoesRepository $shoes, Request $request): Response
{
    $product_name = 'Womens Boots';
    $categories = $categorie->findBy(array('id' => 16));
    $colors = $color->findAll();
    $filter_color = $request->get('colors');
    $filter_sort = $request->get('sort');
    $product = $shoes->getAllShoes($shoes_catId = 16, $filter_color, $filter_sort);

    if($request->get('ajax')){
        return new JsonResponse([
            'content' => $this->renderView('product/content.html.twig', compact('product'))
        ]);
    }
    
    return $this->render('product/product.html.twig', compact('product_name', 'categories', 'colors', 'product'));

}

#[Route('/shoes/women/slingbacks', name: 'shoes_women_slingbacks')]
public function displayWomensSlingbacks(ItemCategoryRepository $categorie, ColorRepository $color, ShoesRepository $shoes, Request $request): Response
{
    $product_name = 'Womens Slingbacks';
    $categories = $categorie->findBy(array('id' => 18));
    $colors = $color->findAll();
    $filter_color = $request->get('colors');
    $filter_sort = $request->get('sort');
    $product = $shoes->getAllShoes($shoes_catId = 18, $filter_color, $filter_sort);

    if($request->get('ajax')){
        return new JsonResponse([
            'content' => $this->renderView('product/content.html.twig', compact('product'))
        ]);
    }
    
    return $this->render('product/product.html.twig', compact('product_name', 'categories', 'colors', 'product'));

}
}