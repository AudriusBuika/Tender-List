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
        return $this->render('tender/tender.html.twig', [
        ]);
    }

    /**
     * Get tender record list
     * 
     * @Route("/list", methods={"GET"})
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
     * Create tender
     * 
     * @Route("/create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $response = new JsonResponse();
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
        $doctrine = $this->getDoctrine();
        $entityManager = $doctrine->getManager();

        $tender = $doctrine->getRepository(Tender::class)->find($id);

        if(!$tender) {
            return $response->setData([
                'success' => 0
            ]);
        }

        $postData = json_decode($request->getContent());

        // $tender->setTitle($request->title);
        // $tender->setDescription($request->description);

        // $entityManager->update($tender);
        // $entityManager->flush();

        return $response->setData([
            'success' => 1,
            'ok' => $request->query->get('title'),
            'o1k' => $request->query->get('description'),
            'bbbbb' => json_decode($request->getContent())
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