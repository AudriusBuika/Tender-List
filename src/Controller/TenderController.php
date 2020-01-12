<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Tender;

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
     * Get tender record list
     * 
     * @Route("/list")
     */
    public function list()
    {
        $response = new JsonResponse();
        $doctrine = $this->getDoctrine();

        $tender = $doctrine->getRepository(Tender::class)->findTenders(20);

        return $response->setData([
                'success' => 1,
                'tender'  => $tender,
        ]);
    }
    
    /**
     * Update edit tender record 
     * 
     * @Route("/update")
     */
    public function update()
    {
    }

    /**
     * Delete tender record
     * 
     * @Route("/delete/{id}")
     */
    public function delete(int $id)
    {
        $response = new JsonResponse();
        $doctrine = $this->getDoctrine();
        $entityManager = $doctrine->getManager();

        $tender = $doctrine->getRepository(Tender::class)->find($id);

        if(!$tender) {
            return $response->setData([
                'success' => 0
            ]);
        }

        $entityManager->remove($tender);
        $entityManager->flush();

        return $response->setData([
            'success' => 1
        ]);
    }

}