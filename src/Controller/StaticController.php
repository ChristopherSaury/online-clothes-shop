<?php

namespace App\Controller;

use App\Repository\ClothesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController{
    #[Route('/', name:'home')]
    public function homePage(ClothesRepository $clothe){
        $home_product = [$clothe->find(26), $clothe->find(31), $clothe->find(19), $clothe->find(22)];
        return $this->render('static/home.html.twig', compact('home_product'));
    }

    #[Route('/about', name:'about')]
    public function aboutPage(){
        return $this->render('static/about.html.twig');
    }
}