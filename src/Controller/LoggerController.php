<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoggerController extends AbstractController
{
    #[Route('/logger', name: 'app_logger')]
    public function index(LoggerInterface $logger): Response {

        $logger->info('I just got the logger');
        $logger->error('An error occurred');

        $logger->critical('I left the oven on!', [
            // include extra "context" info in your logs
            'cause' => 'in_hurry',
        ]);

        return $this->render('logger/hello.html.twig', [
            'controller_name' => 'LoggerController',
        ]);
    }
}
