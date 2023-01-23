<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController{
    #[Route('/', name:'home')]
    public function homePage(){
        return $this->render('static/home.html.twig');
    }

    #[Route('/about', name:'about')]
    public function aboutPage(){
        return $this->render('static/about.html.twig');
    }
}