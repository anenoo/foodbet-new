<?php

namespace App\Controller\API\v1;

use App\Repository\UserRepository;
use Snappfood\ApiResponseBundle\Response\ResponseTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;

class AuthController extends AbstractController
{
    use ResponseTrait;

    public function __construct(private UserRepository $userRepository)
    {
    }

    #[Route('/auth/login', name: 'api_login')]
    public function index(Request $request): Response
    {
        $qb = $this->userRepository->createQueryBuilder('u');
        $email = $request->request->get('email');
        $password = $request->request->get('password');


        if (!$email || !$password) {
            throw new \InvalidArgumentException('User password khalie -_-');
        }

        $user = $this->userRepository->findOneBy(compact('email', 'password'));
        if (!$user) {
            return $this->respondError("Invalid username or password.");
        }

        return $this->respondSuccess('Successful', [
            'token' => $user->getApiKey(),
        ]);
    }
}
