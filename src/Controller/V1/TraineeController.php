<?php

namespace App\Controller\V1;

use App\Entity\Trainee;
use App\Repository\TraineeRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
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

    #[Route('/trainee/{id}', name: 'app_trainee_get', methods: ['GET'])]
    public function getTrainee(TraineeRepository $traineeRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $trainee = $traineeRepository->find($id);

        if ($trainee instanceof Trainee) {
            return $this->json(
                [
                    'success' => true,
                    'data' => json_decode($serializer->serialize($trainee, 'json'), true),
                ],
                status: 200
            );
        } else {
            return $this->json(
                [
                    'success' => false,
                    'data' => [],
                ],
                status: 403
            );
        }
    }
}
