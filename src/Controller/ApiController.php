<?php

namespace App\Controller;

use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/city",name="app.city.add",methods={"POST"})
     * @OA\Parameter(name="name",in="query",required=true)
     * @return void
     */
    public function addCity(Request $request)
    {

        return $this->json([$request->get("name")]);
    }
    /**
     * @Route("/city/{id}",name="app.city.delete",methods={"DELETE"})
     * @return void
     */
    public function deleteCity(int $id)
    {

    }

    /**
     * @Route("/city/{id}",name="app.city.update",methods={"PUT"})
     * @return void
     */
    public function updateCity()
    {

    }

    /**
     * @Route("/city",name="app.city.list",methods={"GET"})
     * @return void
     */
    public function cityList()
    {
        return $this->json([["id"=>1,"name"=>"istanbul"],["id"=>60,"name"=>"Tokat"]]);
    }
}