<?php

namespace App\Controller\Api;

use App\Entity\Empresa;
use App\Entity\Socio;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class EmpresaController extends AbstractController
{
    #[Route('/api/empresas', methods:['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->json(
            $entityManager->getRepository(Empresa::class)->findAll()
        );
    }

    #[Route('/api/empresa', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $empresa = new Empresa();
        $empresa->setNome($data['nome']);
        $empresa->setCnpj($data['cnpj']);

        $entityManager->persist($empresa);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Empresa criada'], JsonResponse::HTTP_CREATED);
    }

    #[Route('/api/empresa/{id}', methods: ['PUT'])]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $empresa = $entityManager->getRepository(Empresa::class)->find($id);

        if (!$empresa) {
            return new JsonResponse(['status' => 'Empresa não encontrada'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        
        $empresa->setNome($data['nome'] ?? $empresa->getNome());
        $empresa->setCnpj($data['cnpj'] ?? $empresa->getCnpj());
        
        $entityManager->flush();

        return new JsonResponse(['status' => 'Empresa atualizada'], JsonResponse::HTTP_OK);
    }

    #[Route('/api/empresa/{id}/socios', methods: ['POST'])]
    public function addSocios(int $id, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $empresa = $entityManager->getRepository(Empresa::class)->find($id);

        if (!$empresa) {
            return new JsonResponse(['status' => 'Empresa não encontrada'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $sociosIds = $data['socios'] ?? [];

        foreach ($sociosIds as $socioId) {
            $socio = $entityManager->getRepository(Socio::class)->find($socioId);

            if (!$socio) {
                return new JsonResponse(['status' => "Sócio com ID {$socioId} não encontrado"], JsonResponse::HTTP_NOT_FOUND);
            }

            // Adiciona o sócio à empresa
            $empresa->addSocio($socio);
        }

        $entityManager->flush();

        return new JsonResponse(['status' => 'Sócios vinculados à empresa'], JsonResponse::HTTP_OK);
    }
}
