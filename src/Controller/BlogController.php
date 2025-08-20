<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findByPublished(10);
        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
