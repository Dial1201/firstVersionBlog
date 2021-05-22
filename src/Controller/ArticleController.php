<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article")
     */
    public function article(EntityManagerInterface $em, ?Article $article): Response
    {
        $categoryRepository = $em->getRepository(Category::class);
        $categories = $categoryRepository->findAll();

        if (!$article) {
            return $this->redirectToRoute('home');
        }
        return $this->render('article/article.html.twig', [
            'article' => $article,
            'categories' => $categories
        ]);
    }
}
