<?php

namespace App\Controller\Api;

use App\Entity\Socio;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SocioController extends AbstractController
{
    #[Route('/api/socios', methods:['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->json(
            $entityManager->getRepository(Socio::class)->findAll()
        );
    }

    #[Route('/api/socio', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $socio = new Socio();
        $socio->setNome($data['nome']);
        $socio->setCpf($data['cpf']);

        $entityManager->persist($socio);
        $entityManager->flush();

        return new JsonResponse(
            ['status' => 'Sócio criado'],
            JsonResponse::HTTP_CREATED
        );
    }

    #[Route('/api/socio/{id}', methods: ['PUT'])]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $socio = $entityManager->getRepository(Socio::class)->find($id);

        if (!$socio) {
            return new JsonResponse(['status' => 'Sócio não encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $socio->setNome($data['nome'] ?? $socio->getNome());
        $socio->setCpf($data['cpf'] ?? $socio->getCpf());

        $entityManager->flush();

        return new JsonResponse(['status' => 'Sócio atualizado'], JsonResponse::HTTP_OK);
    }

    #[Route('/api/socio/{id}', methods: ['DELETE'])]
    public function delete(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $socio = $entityManager->getRepository(Socio::class)->find($id);

        if (!$socio) {
            return new JsonResponse(['status' => 'Sócio não encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($socio);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Sócio removido'], JsonResponse::HTTP_OK);
    }
}
