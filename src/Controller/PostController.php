<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
        ]);
    }

    /**
     * @param Post $post
     * @return Response
     */
    #[Route('/post/{id}-{slug}.html', name: 'app_post_view')]
    public function view(Post $post): Response
    {
        return $this->render('post/view.html.twig', [
        ]);
    }
}
