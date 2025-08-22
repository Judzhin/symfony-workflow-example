<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(Request $request, PostRepository $postRepository): Response
    {
        $pagerfanta = $postRepository->findPublished();
        $pagerfanta->setMaxPerPage(16);
        $pagerfanta->setCurrentPage($request->query->get('page', 1));
        return $this->render('post/index.html.twig', [
            'posts' => $pagerfanta
        ]);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @param PostRepository $postRepository
     * @return Response
     */
    #[Route('/post/category/{id}-{slug}.html', name: 'app_post_by_category')]
    public function byCategory(Request $request, Category $category, PostRepository $postRepository): Response
    {
        $pagerfanta = $postRepository->findPublishedByCategory($category);
        $pagerfanta->setMaxPerPage(16);
        $pagerfanta->setCurrentPage($request->query->get('page', 1));
        return $this->render('post/by_category.html.twig', [
            'posts' => $pagerfanta
        ]);
    }

    /**
     * @param Post $post
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    #[Route('/post/{id}-{slug}.html', name: 'app_post_view')]
    public function view(Post $post, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('post/view.html.twig', [
            'post' => $post,
            'categories' => $categories
        ]);
    }
}
