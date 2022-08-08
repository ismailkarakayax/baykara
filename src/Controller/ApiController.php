<?php

namespace App\Controller;

use App\Entity\DefCity;
use App\Repository\DefCityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/api")
 */
class ApiController extends AbstractController
{
    /** @var DefCityRepository */
    protected $cityRepo;
    /** @var EntityManager */
    protected $em;

    /**
     * @param DefCityRepository $cityRepo
     */
    public function __construct(DefCityRepository $cityRepo, EntityManagerInterface $em)
    {
        $this->cityRepo = $cityRepo;
        $this->em = $em;
    }

    /**
     * @Route("/cityAdd",name="app.city.add",methods={"POST"})
     * @OA\Parameter(name="name",in="query",required=true)
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addCity(Request $request)
    {
        $city = new DefCity();

        $city->setName($request->get("name"));

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $this->em->persist($city);

        // actually executes the queries (i.e. the INSERT query)
        $this->em->flush();
        return $this->json([$request->get("name")]);
    }
    /**
     * @Route("/city/{id}",name="app.city.delete",methods={"DELETE"})
     * @return void
     */
    public function deleteCity(int $id)
    {
        $cityRepo=$this->cityRepo;
        $em=$this->em;

        $name=$cityRepo->find($id);

        $em->remove($name);
        $em->flush();

        return new Response('silindi : '.$name->getName());
    }

    /**
     * @Route("/city/{id}",name="app.city.update",methods={"PUT"})
     * @OA\Parameter(name="name",in="query",required=true)
     * @return Response
     */
    public function updateCity(int $id,Request $request)
    {
        $cityRepo=$this->cityRepo;
        $em=$this->em;

        $product = $cityRepo->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName($request->get("name"));

        $em->flush();
        return new Response('updated product with name ' . $product->getName());
    }

    /**
     * @Route("/city",name="app.city.list",methods={"GET"})
     * @return void
     */
    public function cityList()
    {
        $cityRepo=$this->cityRepo;
        $em=$this->em;

        $cityList=$cityRepo->findAll();


        return $this->json($cityList);
    }
}