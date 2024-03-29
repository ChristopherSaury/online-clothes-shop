<?php

namespace App\Controller;

use App\Repository\ColorRepository;
use App\Repository\ClothesRepository;
use App\Repository\ItemCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClothesController extends AbstractController
{
    #[Route('/clothes/headwear', name: 'clothes_headwear')]
    public function displayHeadwear(ColorRepository $color, ItemCategoryRepository $categorie, ClothesRepository $clothes, Request $request): Response
    {
        $product_name = 'Headwear';
        $category_id = 1;
        $colors = $color->findAll();
        $categories = $categorie->findBy(array('type' => 1));
        $filter_colors = $request->get('colors');
        $filter_category = $request->get('category');
        $filter_sort = $request->get('sort'); 
        $product = $clothes->getAllClothes($categorie, $category_id, $filter_colors, $filter_category, $filter_sort);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }

        return $this->render('product/product.html.twig', compact('product_name', 'colors', 'categories', 'product'));
    }

    #[Route('/clothes/tshirt', name:'clothes_tshirt')]
    public function displayTshirt(ColorRepository $color, ItemCategoryRepository $categorie, ClothesRepository $clothes, Request $request){
        $product_name = 'T-Shirt';
        $category_id = 2;
        $colors = $color->findAll();
        $categories = $categorie->findBy(array('type' => 2));
        $filter_colors = $request->get('colors');
        $filter_category = $request->get('category');
        $filter_sort = $request->get('sort'); 
        $product = $clothes->getAllClothes($categorie, $category_id, $filter_colors, $filter_category, $filter_sort);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }

        return $this->render('product/product.html.twig', compact('product_name','colors', 'categories', 'product'));
    }

    #[Route('/clothes/sweatshirt', name:'clothes_sweatshirt')]
    public function displaySweatshirt(ColorRepository $color, ItemCategoryRepository $categorie, ClothesRepository $clothes, Request $request){
        $product_name = 'Sweatshirt';
        $category_id = 4;
        $colors = $color->findAll();
        $categories = $categorie->findBy(array('type' => 4));
        $filter_colors = $request->get('colors');
        $filter_category = $request->get('category');
        $filter_sort = $request->get('sort'); 
        $product = $clothes->getAllClothes($categorie, $category_id, $filter_colors, $filter_category, $filter_sort);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }

        return $this->render('product/product.html.twig', compact('product_name','colors', 'categories', 'product'));
    }


    #[Route('/clothes/bottoms', name:'clothes_bottoms')]
    public function displayBottoms(ColorRepository $color, ItemCategoryRepository $categorie, ClothesRepository $clothes, Request $request){
        $product_name = 'Bottoms';
        $category_id = 3;
        $colors = $color->findAll();
        $categories = $categorie->findBy(array('type' => 3));
        $filter_colors = $request->get('colors');
        $filter_category = $request->get('category');
        $filter_sort = $request->get('sort'); 
        $product = $clothes->getAllClothes($categorie, $category_id, $filter_colors, $filter_category, $filter_sort);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }

        return $this->render('product/product.html.twig', compact('product_name','colors', 'categories', 'product'));
    }

    #[Route('/clothes/collection/{season}', name:'clothes_collection')]
    public function display_ClothesSeasons($season, ColorRepository $color, ItemCategoryRepository $categorie, ClothesRepository $clothes, Request $request){

        if($season == 2){
            $product_name = 'Fall Collection';
        }elseif($season == 3){
            $product_name = 'Spring/Summer Collection';
        }elseif($season == 4){
            $product_name = 'Winter Collection';
        }
        $colors = $color->findAll();
        $categories = $categorie->findAll();
        $filter_colors = $request->get('colors');
        $filter_category = $request->get('category');
        $filter_sort = $request->get('sort'); 
        $product = $clothes->getAllSeasonClothes($season, $filter_colors, $filter_sort,$filter_category);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('product/content.html.twig', compact('product'))
            ]);
        }

        return $this->render('product/product.html.twig', compact('product_name','colors', 'categories', 'product'));
    }
}
