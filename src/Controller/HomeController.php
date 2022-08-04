<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{



    /**
     * @Route("/",name="app.home")
     * @return mixed
     */
    public function mainPage2()
    {
    return $this->render('home/index.html.twig');
    }
}




