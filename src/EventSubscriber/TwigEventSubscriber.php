<?php

namespace App\EventSubscriber;

use App\Repository\CategoryRepository;
use App\Repository\NavbarCategoryRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{

    private Environment $twig;
    private NavbarCategoryRepository $navbarCategoryRepository;

    public function __construct(Environment $twig, NavbarCategoryRepository $navbarCategoryRepository)
    {
        $this->twig = $twig;
        $this->navbarCategoryRepository = $navbarCategoryRepository;
    }


    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('navbarCategories', $this->navbarCategoryRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
