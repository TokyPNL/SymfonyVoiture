<?php

namespace App\Controller;
use App\Repository\LouerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/getAllLouer", name="getAllLouer", methods={"GET"})
     */
    public function getAllLouer(LouerRepository $louerRepository): Response
    {
        return $this->json($louerRepository-> getAllLouer());
    }

    /**
     * @Route("/findFactureVoiture/{id}", name="findFactureVoiture", methods={"GET"})
     */
    public function findFactureVoiture(LouerRepository $louerRepository,$id): Response
    {
        return $this->json($louerRepository-> findFactureVoiture($id));
    }

    /**
     * @Route("/total/{id}", name="total", methods={"GET"})
     */
    public function findFactureTotal(LouerRepository $louerRepository,$id): Response
    {
        return $this->json($louerRepository-> findFactureTotal($id));
    }

    /**
     * @Route("/findMoneyTotal", name="findMoneyTotal", methods={"GET"})
     */
    public function findMoneyTotal(LouerRepository $louerRepository): Response
    {
        return $this->json($louerRepository-> findMoneyTotal());
    }
}
