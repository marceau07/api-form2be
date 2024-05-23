<?php

namespace App\Controller\V1;

use App\Repository\TraineeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/v1/trainees')]
class TraineeController extends AbstractController
{
    #[Route('/', name: 'app_trainees_get', methods: ['GET'])]
    public function get(TraineeRepository $traineeRepository, SerializerInterface $serializer): JsonResponse
    {
        return $this->json(
            [
                'success' => true,
                'data' => json_decode($serializer->serialize($traineeRepository->findAll(), 'json'), true),
            ],
            status: 200
        );
    }

    #[Route('/{id}', name: 'app_trainee_get', methods: ['GET'])]
    public function getOne(TraineeRepository $traineeRepository, SerializerInterface $serializer, string|int $id): JsonResponse
    {
        return $this->json(
            [
                'success' => true,
                'data' => json_decode($serializer->serialize($traineeRepository->findOneBy(['id' => $id]), 'json'), true),
            ],
            status: 200
        );
    }
}
