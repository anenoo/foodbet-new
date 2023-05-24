<?php

namespace App\Controller\API\v1;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Services\AuthService;
use Snappfood\ApiResponseBundle\Response\ResponseTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;

class DashboardController extends AbstractController
{
    use ResponseTrait;

    public function __construct(
        private UserRepository $userRepository,
        readonly private AuthService $authService,
        private readonly CategoryRepository $categoryRepository
    )
    {
    }

    #[Route('/dash', name: 'api_dash_index')]
    public function index(Request $request): Response
    {
        //user
        //categories
        return $this->respondSuccess('Successful', [
            'user' => $this->authService->getUser(),
            'categories' => $this->categoryRepository->getActiveCategories(),
        ]);
    }

    #[Route('/dash/category/{category}/ideas', name: 'api_dash_index')]
    public function getCategoryIdeas(Request $request, Category $category): Response
    {
        return $this->respondSuccess('Successful', [
            'category' => $category,
            'ideas' => $category->getIdeas(),
        ]);
    }


}
