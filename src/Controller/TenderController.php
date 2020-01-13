<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Tender;

class TenderController extends AbstractController
{

    /**
     * @Route("/", methods={"GET"})
     */
    public function index()
    {
        return $this->render('tender/tender.html.twig', []);
    }

    /**
     * Get tender record list
     * 
     * @Route("/list/{limit}", methods={"GET"})
     */
    public function list(int $limit)
    {
        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $doctrine = $this->getDoctrine();

        if($limit >= 100) {
            $limit = 100;
        }

        $tender = $doctrine->getRepository(Tender::class)->findTenders($limit);

        return $response->setData([
                'success' => 1,
                'tender'  => $tender,
        ]);
    }

    /**
     * Create tender
     * 
     * @Route("/create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $doctrine = $this->getDoctrine();
        $entityManager = $doctrine->getManager();

        $postData = json_decode($request->getContent());

        $tender = new Tender();

        $tender->setTitle($postData->title);
        $tender->setDescription($postData->description);
        $tender->updatedTimestamps();

        $entityManager->persist($tender);
        $entityManager->flush();

        return $response->setData([
            'success' => 1
        ]);
    }
    
    /**
     * Update edit tender record
     * 
     * @Route("/update/{id}", methods={"POST"})
     */
    public function update(Request $request, int $id)
    {
        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $postData = json_decode($request->getContent());
        $doctrine = $this->getDoctrine();
        $entityManager = $doctrine->getManager();

        $tender = $doctrine->getRepository(Tender::class)->find($id);

        // not found tender record
        if(!$tender) {
            return $response->setData([
                'success' => 0
            ]);
        }

        $tender->setTitle($postData->title);
        $tender->setDescription($postData->description);
        $tender->updatedTimestamps();

        $entityManager->persist($tender);
        $entityManager->flush();

        return $response->setData([
            'success' => 1,
        ]);
    }

    /**
     * Delete tender record
     * 
     * @Route("/delete/{id}", methods={"GET"})
     */
    public function delete(int $id)
    {
        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $doctrine = $this->getDoctrine();
        $entityManager = $doctrine->getManager();

        $tender = $doctrine->getRepository(Tender::class)->find($id);

        // not found tender record
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