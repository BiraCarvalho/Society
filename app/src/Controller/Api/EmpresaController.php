<?php

namespace App\Controller\Api;

use App\Entity\Empresa;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class EmpresaController extends AbstractController
{
    #[Route('/api/empresa', name: 'app_api_empresa', methods:['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $empresas = $entityManager->getRepository(Empresa::class)->findAll();
        return $this->json($empresas);
    }
}
