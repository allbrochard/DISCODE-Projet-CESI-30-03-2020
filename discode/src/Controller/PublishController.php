<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublishController extends AbstractController
{
    /**
     * @Route("/publish", name="publish")
     */
    public function index()
    {
        return $this->render('publish/index.html.twig', [
            'controller_name' => 'PublishController',
        ]);
    }
}
