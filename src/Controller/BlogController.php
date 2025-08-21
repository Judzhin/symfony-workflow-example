<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    /**
     * @param Request $request
     * @param PostRepository $postRepository
     * @return Response
     */
    #[Route('/', name: 'app_index')]
    public function index(Request $request, PostRepository $postRepository): Response
    {
        $pagerfanta = $postRepository->findPublished();
        $pagerfanta->setMaxPerPage(16);
        $pagerfanta->setCurrentPage($request->query->get('page', 1));

        return $this->render('blog/index.html.twig', [
            'posts' => $pagerfanta,
        ]);
    }
}
