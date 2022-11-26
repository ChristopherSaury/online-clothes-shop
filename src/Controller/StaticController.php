<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController{
    #[Route('/', name:'home')]
    public function homePage(){
        return $this->render('static/home.html.twig');
    }

    #[Route('/login', name:'login')]
    public function displayLogin(){
        return $this->render('login/login.html.twig');
    }

    #[Route('/signup', name:'signup')]
    public function displaySignUp(){
        return $this->render('static/signup.html.twig');
    }
}