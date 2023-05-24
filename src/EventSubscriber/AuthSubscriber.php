<?php

namespace App\EventSubscriber;

use App\Repository\UserRepository;
use App\Services\AuthService;
use JetBrains\PhpStorm\ArrayShape;
use ReflectionAttribute;
use ReflectionClass;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AuthSubscriber implements EventSubscriberInterface
{
    public function __construct(readonly private ContainerInterface $container,
                                readonly private UserRepository     $userRepository,
                                readonly private AuthService        $authService,

    )
    {
    }

    #[ArrayShape([KernelEvents::CONTROLLER => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController'
        ];
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controllerArray = $event->getController();

        if (!is_array($controllerArray)) {
            return;
        }

        $controller = $controllerArray[0];
        $methodName = $controllerArray[1];

//        if (!$this->supports($controller, $methodName)) {
//            return;
//        }
//
//        if (str_contains($controller::class, 'App\Controller\V1\BackOffice')) {
//            $this->handleBackofficeAuth($event);
//        } else {
//            $this->handleCustomerAuth($event);
//        }

        if (str_contains($controller::class, 'AuthController')) {
            return;
        }

        $apiKey = $event->getRequest()->headers->get('x-api-key');
        if (!$apiKey) {
            throw new \RuntimeException('Access denied');
        }

        $user = $this->userRepository->findOneBy([
            'api_key' => $apiKey,
        ]);

        $this->authService->setUser($user);
    }
}