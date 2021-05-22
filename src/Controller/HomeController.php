<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $articleRepository = $em->getRepository(Article::class);
        $categoryRepository = $em->getRepository(Category::class);
        $categories = $categoryRepository->findAll();
        $articles = $articleRepository->findAll();


        return $this->render('home/home.html.twig', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }
}
