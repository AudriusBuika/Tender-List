<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TenderController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('tender/tender.html.twig', [
        ]);
    }
    
    /**
     * @Route("/update")
     */
    public function update()
    {

    }

    /**
     * @Route("/delete")
     */
    public function delete()
    {

    }

}