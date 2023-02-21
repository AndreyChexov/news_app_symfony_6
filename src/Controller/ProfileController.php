<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NewsRepository;

#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(NewsRepository $newsRepository): Response
    {
     
        $user = $this->getUser();
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'news' => $newsRepository->findAll()
        ]);
    }
}
