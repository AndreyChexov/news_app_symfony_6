<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\CommentsRepository;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class NewsController extends AbstractController
{
    #[Route('/', name: 'app_news_index', methods: ['GET'])]
    public function index(NewsRepository $newsRepository): Response
    {
       
        return $this->render('news/allNews.html.twig', [
            'news' => $newsRepository->findAll()
            
        ]);
    }

    #[Route('/animals', name: 'app_news_animals', methods: ['GET'])]
    public function animals(NewsRepository $newsRepository): Response
    {

        
        return $this->render('news/allNews.html.twig', [
            'news' => $newsRepository->findby([
                'category' => 'animals'
            ]),
            
        ]);
    }

    #[Route('/cars', name: 'app_news_cars', methods: ['GET'])]
    public function cars(NewsRepository $newsRepository): Response
    {

        
        return $this->render('news/allNews.html.twig', [
            'news' => $newsRepository->findby([
                'category' => 'cars'
            ]),
            
        ]);
    }

    #[Route('/cities', name: 'app_news_cities', methods: ['GET'])]
    public function cities(NewsRepository $newsRepository): Response
    {

        
        return $this->render('news/allNews.html.twig', [
            'news' => $newsRepository->findby([
                'category' => 'cities'
            ]),
            
        ]);
    }

    #[Route('/newsList', name: 'app_news_list')]
    public function listUsersNews (NewsRepository $newsRepository): Response
    {
        $user = $this->getUser();

        return $this->render('news/index.html.twig', [
            'news' => $newsRepository->findAll(),
            'user' => $user
           
        ]);
    }


    #[Route('/new', name: 'app_news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NewsRepository $newsRepository): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);
        $user = $this->getUser();
        $date = date('Y-m-d H:i:s');

        if ($form->isSubmitted() && $form->isValid()) {
            $newsRepository->save($news, true);

            return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('news/new.html.twig', [
            'news' => $news,
            'form' => $form,
            'user' => $user,
            'date' => $date
        ]);
    }
   

    #[Route('/{id}', name: 'app_news_show')]
    public function show(News $news, CommentsRepository $commentsRepository, Request $request): Response
    {
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);
        $user = $this->getUser();
        $date = date('Y-m-d H:i:s');
   

        if ($form->isSubmitted() && $form->isValid()) {
             $commentsRepository->save($comment, true);
            
        }

        return $this->render('news/showSingle.html.twig', [
            'news' => $news,
            'comments' => $commentsRepository->findAll(),
            'form' => $form,
            'user' => $user,
            'date' => $date
        ]);
    }

    #[Route('/{id}/edit', name: 'app_news_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, News $news, NewsRepository $newsRepository): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsRepository->save($news, true);

            return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('news/edit.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_delete', methods: ['POST'])]
    public function delete(Request $request, News $news, NewsRepository $newsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$news->getId(), $request->request->get('_token'))) {
            $newsRepository->remove($news, true);
        }

        return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
    }
}
