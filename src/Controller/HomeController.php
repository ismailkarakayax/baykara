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

    /**
     * @Route("/creatCity",name="app.create")
     * @return mixed
     */
    public function mainPage3()
    {
        return $this->render('home/createCity.html.twig');
    }


     /**
     * @Route("/updateCity",name="app.update")
     * @return mixed
     */
    public function mainPage4()
    {
        return $this->render('home/update.html.twig');
    }
}




