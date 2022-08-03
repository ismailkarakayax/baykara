<?php

namespace App\Controller;


use App\Entity\DefCity;
use App\Form\DefCityFormType;
use App\Repository\DefCityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
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
     * @Route("/")
     */
    public function addCity(Request $request)
    {

        $city=new DefCity();
        $em=$this->em;

        $form=$this->createForm(DefCityFormType::class,$city);

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $em->persist($city);
            $em->flush();

            return new Response('City Number : '.$city->getId());
        }



        return $this->render("home/custom.html.twig",[
            'defcity_form' => $form->createView()
        ]);

    }


    /**
     * @Route("/delete/{id?}")
     */
    public function deleteCity(int $id,Request $request)
    {
        $cityRepo=$this->cityRepo;
        $em=$this->em;

        $name=$cityRepo->find($id);

        $em->remove($name);
        $em->flush();

        return new Response('silindi : '.$name->getName());
    }

    /**
     * @Route("/list" ,name="city_list")
     * @param $list
     * @param Request $request
     * @return Response
     */
    public function allCity(Request $request): Response
    {
        $cityRepo=$this->cityRepo;
        $em=$this->em;

        $cityList=$cityRepo->findAll();
        dd($cityList);


    }

    /**
     * @Route ("/city/{id?}",name="see_product")
     */
    public function findCity(int $id): Response
    {
        $cityRepo=$this->cityRepo;
        $product = $cityRepo->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        $name=$product->getName();
        return $this->render("home/custom.html.twig",[
            'name' => $product
        ]);

    }

    /**
     * @Route("/addcity",name="create_product")
     * @return Response
     * @throws \Doctrine\ORM\Exception\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createCity():Response
    {
        $city = new DefCity();

        $city->setName('kastamonu');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $this->em->persist($city);

        // actually executes the queries (i.e. the INSERT query)
        $this->em->flush();

        return new Response('Saved new product with id ' . $city->getName());

    }



}

































//    /**
//     * @Route("/custom/{name?}",methods={"GET","HEAD"})
//    * @return Response
//     */
//    public function number(Request $request)
//    {
//





