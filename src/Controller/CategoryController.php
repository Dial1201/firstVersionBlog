<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category")
     */
    public function category(?Category $category, EntityManagerInterface $em): Response
    {
        $categoryRepository = $em->getRepository(Category::class);
        $categories = $categoryRepository->findAll();

        if (!$category) {
            return $this->redirectToRoute('home');
        }
        return $this->render('category/category.html.twig', [
            'category' => $category,
            'categories' => $categories
        ]);
    }
}
