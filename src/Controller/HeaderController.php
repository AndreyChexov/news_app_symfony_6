<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeaderController extends AbstractController
{
   
    public function index(): Response

    {
        $user = $this->getUser();
        return $this->render('header/index.html.twig', [
            'user' => $user
        ]);
    }
}
